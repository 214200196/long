<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
    public function index(){
        //p($_SESSION);
        $this->uid=$_SESSION['uid'];
        $this->username=$_SESSION['username'];
    	$this->display();
    }
  
}