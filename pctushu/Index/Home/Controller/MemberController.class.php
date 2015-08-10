<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
    public function index(){
        //p($_SESSION);
        $this->uid = $_SESSION['uid'];
        $this->username = $_SESSION['username'];

        $booksinfo = M('books_list')->where(array('uid' => intval($this->uid)))->order("add_time DESC")->select();
        $this->booksinfo = $booksinfo;

    	$this->display();
    }
  
}