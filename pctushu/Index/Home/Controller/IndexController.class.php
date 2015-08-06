<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	//echo htmlspecialchars("alert('hello');");
   		//p($_SESSION['uid']);
    	$this->display();
    }
}