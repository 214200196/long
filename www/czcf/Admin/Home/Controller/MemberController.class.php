<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
    public function index(){
    	$db = D('userView');
    	// 获取总记录条数
    	$count = $db->count();
		$Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show  = $Page->show();// 分页显示输出

    	$members = $db->limit($Page->firstRow.','.$Page->listRows)->select();

    	$this->members = $members;
    	$this->show =$show;

        $this->display();
    }
    public function memberSearch() {
    	
    }
}