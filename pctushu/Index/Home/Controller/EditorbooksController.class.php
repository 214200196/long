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
    			// 判断是否为该用户发布书籍
    			$where['id']  = intval($_GET['bid']);
    			$where['uid'] = intval($_SESSION['uid']);
    			$where['_logic'] = 'AND';

	    		$ifuserbooks  = M('books_list')->where($where)->find();
	    		//echo M('books_list')->getLastSql();
	    		//dump($ifuserbooks);die;

	    	if(!empty($ifuserbooks)) {
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
    // 添加内容
    public function addContentList() {
    	if( ! IS_POST) $this->error('页面不存在');
    	dump($_POST);
    }

    // 获取左侧分类
    public function getContentCate(){
    	$getContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid'])))->select();
    	$this->getContentCate = $getContentCate;
    }

}