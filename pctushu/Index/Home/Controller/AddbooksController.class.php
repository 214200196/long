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
    }
  
}