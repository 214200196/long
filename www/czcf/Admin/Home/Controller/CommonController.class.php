<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	//if(empty($_SESSION['uid'])) $this->error("请登入后再操作",U('Login/index'));    
    }
}