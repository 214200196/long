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
    	$this->getContentList();
    	$this->display();
    }
    public function addContentCate() {
    	if ( ! IS_POST) $this->error("页面不存在"); 
    	if ( empty($_POST['addContentCate'])) {
    		$this -> error("该内容不能为空,请重试");
    	} else {

            //$this->ifuserbooks();
            //echo M('books_list')->getLastSql();
            //dump($this->ifuserbooks());
	    	if($this->ifuserbooks()) {
	    		//dump($_POST);exit;
		    		if( ! is_numeric($_POST['addActicleCateName'])) {

				    		$data = array(
				    			'content_category_name' => trim(htmlspecialchars($_POST['addContentCate'])),
				    			'pid' => 0,
				    			'level'=>1,
				    			'bid'=> intval($_GET['bid'])
				    			);

				    		$db = M('content_category');

				    		// ,$_SERVER['REQUEST_URI'] 跳转上次页面
				    		if ($db->data($data)->add()) {
				    			$this->success("数据添加成功",U('index',array('bid'=>intval($_GET['bid']))));

				    		}
		    		} else {

	    					$data = array(
				    			'content_category_name' => trim(htmlspecialchars($_POST['addContentCate'])),
				    			'pid' => intval($_POST['addActicleCateName']),
				    			'level'=>2,
				    			'bid'=> intval($_GET['bid'])
				    			);
				    		$db = M('content_category');

				    		// ,$_SERVER['REQUEST_URI'] 跳转上次页面
				    		if ($db->data($data)->add()) {
				    			$this->success("数据添加成功",U('index',array('bid'=>intval($_GET['bid']))));

				    		}

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


            $books_content_data = array(
            	'acticle_name'   => trim($_POST['acticleName']),
            	'key_word'       => $_POST['keyword'],
            	'acticle_content'=> $_POST['content'],
            	'add_time'       => time(),
            	'books_id'       => intval($_GET['bid'])
            	);
            $content_id = M('books_content')->data($books_content_data)->add();

            if($content_id){
            	// 判断用户绑定目录层级
            	$userSelectCateLeval = M('content_category')->where(array('id'=>intval($_POST['acticleCateName'])))->field('level')->find();
            	$userSelectCateLeval['level'] == 2 ? $addLevel = 3 : $addLevel = 2 ;

	            $content_category_data = array(
	            	'content_category_name'=>trim($_POST['acticleName']),
	            	'pid'  => intval($_POST['acticleCateName']),
	            	'level'=> $addLevel,
	            	'bid'  => intval($_GET['bid']), 
	            	'content_id' =>$content_id                
	            	);
	            if(M('content_category')->data($content_category_data)->add()){
	            	$this->success('图书章节上传成功！',U('index',array('bid'=>$_GET['bid'])));
	            }else{
	            	$this->error('上传失败请重试！');
	            }
        	}


        } else {
            $this->error('非法操作',U('Member/index'));
        }
    	//dump($_POST);
    	//dump($books_content_data);
    }
    // 获取内容
    public function getContentList(){
    	if($_GET['content_id']){
    		$db = D('BookscontentView');
    		$contentList = $db->where(array('content_id'=>$_GET['content_id']))->find();
            // 判断是否操作自己的图书
            if($this->ifuserbooks()){
                $this->getContentList = $contentList;
                //dump($contentList);
            }
    	}

    }

    // 修改内容
    public function modifyContentList(){
        if ( ! IS_POST) $this->error('页面不存在');
        // 判断是否操作自己所编辑的文章
            if ($this->ifuserbooks()) {
                if ( ! is_numeric($_POST['acticleCateName'])) {
                    $this->error('请选择分类名称');
                }
                if (empty($_POST['acticleName'])) {
                    $this->error('标题不能为空');
                }
                if (empty($_POST['keyword'])) {
                    $this->error('关键字不能为空');
                }
                if (empty($_POST['content'])) {
                    $this->error('内容不能为空');
                }

                $userSelectCateLeval = M('content_category')->where(array('id'=>intval($_POST['acticleCateName'])))->field('level')->find();
                $userSelectCateLeval['level'] == 2 ? $addLevel = 3 : $addLevel = 2 ;

                $books_content_modify = array(
                    'acticle_name'   => trim($_POST['acticleName']),
                    'key_word'       => $_POST['keyword'],
                    'acticle_content'=> $_POST['content'],
                    );

                if (M('books_content')->where(array('id'=>$_POST['content_id']))->data($books_content_modify)->save()) {
                    $content_category_modify = array(
                        'content_category_name' => trim($_POST['acticleName']),
                        'pid' => intval($_POST['acticleCateName']),
                        'level' => $addLevel
                        );
                   M('content_category')->where(array('id'=>$_POST['cid']))->data($content_category_modify)->save();
                    
                   $this->success("修改成功！");
                    
                    
                } else {
                    $this->error("修改失败！请重试。。。");
                }
                
            } else {
                $this->error('非法操作',U('Member/index'));
            }

    }





    // 获取左侧分类一级和二级分类
    public function getContentCate() {
    	// 显示一级和二级分类
    	$getContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid']),array('content_id'=>0)),'AND')->select();
    	//dump($getContentCate);
    	//dump($this->cateArr($getContentCate));
    	$getContentCateSelect = $this->cateArr($getContentCate);
    	$this->getContentCate = $getContentCateSelect;
    	// 只显示一级分类
    	$getTopContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid']),array('content_id'=>0),array('pid'=>0)),'AND')->select();
    	$this->getTopContentCate = $getTopContentCate;
    	// 显示所有分类及内容结构
    	$getAllContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid'])))->select();
    	$getAllContentCateResult = $this->cateArr($getAllContentCate);
    	$this->getAllContentCateResult = $getAllContentCateResult;

    }
	
	// 重组数组
    public function cateArr($array,$pid=0){
	   $tree = array();
		    foreach($array as  $v){
		    	if($v['pid']==$pid){
		    		$tree[] = $v;
		    		$tree = array_merge($tree,$this->cateArr($array,$v['id']));
		    	}
		    }
	    return $tree;
	 }
	




}

