<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends Controller {
    public function index(){
    	//dump($_GET);
    	$this->display();
    }

    // 获取验证码
    public function verify(){
    	$Verify  =  new \Think\Verify();
    	$Verify->fontSize = 40;
    	$Verify->length=4;
    	$Verify->useNoise = false;
    	$Verify->entry();
    }

    // 检测注册
    public function CheckRegister(){
    	if(!IS_POST) $this->error("页面不存在!");
    	dump($_POST);
    }

    // 异步检测用户名是否存在
    public function asynEmail(){
    	if(!IS_AJAX) $this->error("页面不存在");
    	$email = $_POST['email'];
    	$where['email']=array('eq',$email);
    	if(M('user')->where($where)->getField()){
    		echo 0;
    		//echo M('user')->getLastSql();
    	}else{
    		echo 1;
    	}

    }

}