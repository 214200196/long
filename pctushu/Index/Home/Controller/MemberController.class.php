<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
	public function _initialize(){
		if(empty($_SESSION['uid'])){
			redirect(U('Login/index'), 3,'please login to visitor!');
		}
	}
    public function index(){
        //p($_SESSION);
        $db = M('books_list');                                                              // 实例化User对象
        $count      = $db->where(array('uid' => intval($_SESSION['uid'])))->count();        // 查询满足要求的总记录数
        $Page       = new \Think\Page($count,6);                                            // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();                                                        // 分页显示输出

        $booksinfo = $db->where(array('uid' => intval($_SESSION['uid'])))->order("add_time DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->booksinfo = $booksinfo;
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }
  
}