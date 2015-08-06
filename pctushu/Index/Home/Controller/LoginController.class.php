<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends CommonController {
    public function index(){
    	$this->display();
    }
    // 退出登入
    public function loginOut(){
    	session(null); 			// 清空当前的session
    	session('[destroy]');   // 销毁session
    	//重定向到指定的URL地址
		redirect(U('Index/index'));
    }

    // 登入检测
    public function CheckLogin(){
    	if(!IS_POST) $this->error("页面不存在");
    	
    	$where['email']=$_POST['email'];
    	$where['passworld']=md5($_POST['pwd']);
    	$userMsg=M('user')->where($where)->field(array('id','name'))->find();

    	if($userMsg){
    		session('uid',$userMsg['id']);
    		session('username',$userMsg['name']);
    		$this->success("登入成功,正在为你跳转....",U('Member/Index'));
    		//dump($userMsg);
    	}else{
    		$this->error("账号或密码错误");
    		//dump($userMsg);
    	}

    }

    // 获取验证码
    public function verify(){
    	$Verify  =  new \Think\Verify();
    	$Verify->fontSize = 30;
    	$Verify->length=4;
    	$Verify->codeSet = '123456789'; 
    	$Verify->fontttf = '5.ttf'; 
    	$Verify->useNoise = false;
    	$Verify->entry();
    	//$this->assign('Verifys',$Verify);
    }

    // 异步检测验证码
    public function asynVerify(){
    	if(!IS_AJAX) $this->error("页面不存在");
    	//dump($_POST['verify']);
    	// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
		if(!check_verify($_POST['verify'])){      
         	echo 0;
        }else{
        	echo 1;
        }
       
    }  
}