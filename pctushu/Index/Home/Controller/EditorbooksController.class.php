<?php
namespace Home\Controller;
use Think\Controller;
class EditorbooksController extends CommonController {
    public function index(){
    	$this->getLocation();
    	$this->getBooksInfo();
    	$this->display();
    }
    public function addContentCate(){
    	if ( ! IS_POST) $this->error("页面不存在"); 
    	if (!isset($_POST['addContentCate'])){
    		$this -> error("该内容不能为空,请重试");
    	}else{
    		$data = array(
    			'content_category_name' => $_POST['addContentCate'],
    			'pid' => 0
    			);
    		$db = M('content_category');

    		if($db->data($data)->add()){
    			$this->success("数据添加成功",U('index'));
    		}
    	}

    }
}