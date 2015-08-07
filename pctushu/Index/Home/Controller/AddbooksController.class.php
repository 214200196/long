<?php
namespace Home\Controller;
use Think\Controller;
class AddbooksController extends CommonController {
    public function index(){
    	$cateList= M('books_category')->where(array('pid'=>0))->select();
    	$this->assign('cateList',$cateList);
    	$this->display();
    }

    public function getCate(){
    	if(!IS_AJAX) $this->error("页面不存在");
    	$db=M('books_category');
    	$where=array('pid'=>intval($_POST['topselect']));
    	$midCate=$db->where($where)->select();
    	echo json_encode($midCate);
    }
    public function addBooks(){
    	if(!IS_POST) $this->error("页面不存在");
    	if($_POST['booksname']==''){
    		$this->error("请填写图书名称");exit;
    	}
    	if(!is_numeric($_POST['firstcate'])){
    		$this->error("请选择分类1");exit;
    	}
    	if(isset($_POST['secendcate']) && !is_numeric($_POST['secendcate'])){
    		$this->error("请选择分类2");exit;
    	}
    	if(isset($_POST['thirdcate']) && !is_numeric($_POST['thirdcate'])){
    		$this->error("请选择分类3");exit;
    	}
    	p($_POST);
    	// 如果上传了封面
    	if(isset($_FILES['photo'])){
    		$this->upload();
    	}

    }

    public function upload(){
	    $upload = new \Think\Upload();                             // 实例化上传类
	    $upload->autoSub = true;
		$upload->subName = array('date','Ymd');
	    $upload->maxSize   =  2097152;                            // 设置附件上传大小
	    $upload->exts      =  array('jpg', 'gif', 'png', 'jpeg');  // 设置附件上传类型
	    $upload->rootPath  =  'Uploads';                        // 设置附件上传根目录
	    $upload->savePath  =   'booksphoto';                      // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->uploadOne($_FILES['photo']);
	    if(!$info) {
	    	// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{
	    	// 上传成功
	        //$this->success('上传成功！');
	    }
	}

  
}