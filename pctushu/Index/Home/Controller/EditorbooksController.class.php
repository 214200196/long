<?php
namespace Home\Controller;
use Think\Controller;
class EditorbooksController extends CommonController {
	public function _initialize(){
		if(empty($_SESSION['uid'])){
			redirect(U('Login/index'), 3,'please login to visitor!');
		}
	}

    public function index(){
    	$this->getLocation();
    	$this->getBooksInfo();
    	$this->getContentCate();
    	$this->display();
    }
    public function addContentCate() {
    	if ( ! IS_POST) $this->error("页面不存在"); 
    	if ( ! isset($_POST['addContentCate'])) {
    		$this -> error("该内容不能为空,请重试");
    	} else {

            //$this->ifuserbooks();
            //echo M('books_list')->getLastSql();
            //dump($this->ifuserbooks());
	    	if($this->ifuserbooks()) {
	    		$data = array(
	    			'content_category_name' => htmlspecialchars($_POST['addContentCate']),
	    			'pid' => 0,
	    			'bid'=> intval($_GET['bid'])
	    			);
	    		$db = M('content_category');
	    		// ,$_SERVER['REQUEST_URI'] 跳转上次页面
	    		if ($db->data($data)->add()) {
	    			$this->success("数据添加成功");
	    		}
    		} else{
    			$this->error('图书不存在');
    		}
    	 }

    }
    // 判断是否操作自己所编辑的文章
    public function ifuserbooks() {
        $where['id']  = intval($_GET['bid']);
        $where['uid'] = intval($_SESSION['uid']);
        $where['_logic'] = 'AND';

        $ifuserbooks  = M('books_list')->where($where)->find();
        if( ! empty($ifuserbooks)) {
            return true;
        }else{
            return false;
        }
          
    }
    // 添加内容
    public function addContentList() {
    	if( ! IS_POST) $this->error('页面不存在');
        // 判断是否操作自己所编辑的文章
        if($this->ifuserbooks()){
            if( ! is_numeric($_POST['acticleCateName'])) {
                $this->error('请选择分类名称');
            }
            if(empty($_POST['acticleName'])) {
                $this->error('标题不能为空');
            }
            if(empty($_POST['keyword'])) {
                $this->error('关键字不能为空');
            }
            if(empty($_POST['content'])) {
                $this->error('内容不能为空');
            }

        } else {
            $this->error('非法操作',U('Member/index'));
        }
    	dump($_POST);
    }

    // 获取左侧分类
    public function getContentCate() {
    	$getContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid'])))->select();
    	$this->getContentCate = $getContentCate;
    }

}