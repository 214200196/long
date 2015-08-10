<?php
namespace Home\Controller;
use Think\Controller;
class RegisterController extends CommonController {
    public function index(){
    	//dump($_GET);
    	$this->display();
    }

    // 获取验证码
    public function verify(){
    	$Verify  =  new \Think\Verify();
    	$Verify->fontSize = 30;
    	$Verify->length   = 4;
    	$Verify->codeSet  = '123456789'; 
    	$Verify->fontttf  = '5.ttf'; 
    	$Verify->useNoise = false;
    	$Verify->entry();
    	//$this->assign('Verifys',$Verify);
    }

    // 检测注册
    public function CheckRegister(){
    	if(!IS_POST) $this->error("页面不存在!");
    	$db = D('user');
    	if(!$db->create()){
    		exit($db->getError());
    	}
    	if($uid=$db->add()){
    		// 将用户注册成功后ID 注册到session中
    		session('uid',$uid);
    		$this->success("注册成功,正在为你跳转.....",U('Index/Index'));
    	}else{
    		$this->error("注册失败，请重试！");
    	}
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
    // 异步检测验证码
    public function asynVerify(){
    	if(!IS_AJAX) {
            $this->error("页面不存在");
        }
    	//dump($_POST['verify']);
    	// 检测输入的验证码是否正确，$code为用户输入的验证码字符
		// if(!check_verify($_POST['verify'])){      
  //        	echo 0;
  //       }else{
  //       	echo 1;
  //       }
        echo check_verify($_POST['verify']) ? 1 : 0; 
       
    }    

}