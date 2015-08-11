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
        $booksinfo = M('books_list')->where(array('uid' => intval($_SESSION['uid'])))->order("add_time DESC")->select();
        $this->booksinfo = $booksinfo;

    	$this->display();
    }
  
}