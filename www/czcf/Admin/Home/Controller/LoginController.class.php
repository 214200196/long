<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

	public function index() {

		$this->display();
	}
	// 退出登入
    public function loginOut(){
    	session(null); 			// 清空当前的session
    	session('[destroy]');   // 销毁session
    	//重定向到指定的URL地址
		redirect(U('Login/index'));
    }

	// 检测后台用户登入密码及用户信息
	public function checkLogin() { 
		if( ! IS_POST ) $this->error('非法操作');
		
		if(check_verify($_POST['verify'])) {
			$admin = M('admin')->where(array('username'=>$_POST['adminname'],'password'=>md5($_POST['pwd'])),'AND')->find();
			//$db=M('admin');
			//echo $db->getLastSql();
			//dump($admin);
			if($admin) {
				session('uid',$admin['id']);
				$this->success('登入成功正在为你跳转....',U('Index/index'));
			} else {
				$this->error('账号或密码错误！','',1);
			}
			

		} else {
			$this->error('验证码输入错误！','',1);
		}
	}

	// 获取验证码
    public function verify(){
    	$Verify  =  new \Think\Verify();
    	$Verify->fontSize = 30;
    	$Verify->length=4;
    	//$Verify->codeSet = '123456789'; 
    	$Verify->fontttf = '5.ttf'; 
    	$Verify->useNoise = false;
    	$Verify->entry();
    	//$this->assign('Verifys',$Verify);
    }


}