<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

	public function index() {

		$this->display();
	}

	// 检测后台用户登入密码及用户信息
	public function checkLogin() { 
		if( ! IS_POST ) $this->error('非法操作');
		p($_POST);
	}
}