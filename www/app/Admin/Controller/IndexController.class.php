<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class IndexController extends AdminController 
{
	public function index() 
	{
		global $tpldir,$_G,$_A;

		$this->display ( $tpldir .'index.html');
	}
	public function main() 
	{
		global $tpldir,$_G,$_A;
		$_A ['list_name'] = "管理首页";
		$_A ['list_title'] = "系统信息";
		$php_info ["phpv"] = phpversion ();
		$php_info ["sp_os"] = strtolower ( isset ( $_ENV ['OS'] ) ?$_ENV ['OS'] : @getenv ( 'OS') );
		$php_info ["sp_server"] = $_SERVER ["SERVER_SOFTWARE"];
		$php_info ["sp_host"] = (empty ( $_SERVER ["REMOTE_ADDR"] ) ?$_SERVER ["REMOTE_HOST"] : $_SERVER ["REMOTE_ADDR"]);
		$php_info ["sp_name"] = $_SERVER ["SERVER_NAME"];
		$php_info ["sp_max_execution_time"] = ini_get ( 'max_execution_time');
		$php_info ["sp_allow_reference"] = (ini_get ( 'allow_call_time_pass_reference') ?'<font color=green>[√]On</font>': '<font color=red>[×]Off</font>');
		$php_info ["sp_allow_url_fopen"] = (ini_get ( 'allow_url_fopen') ?'<font color=green>[√]On</font>': '<font color=red>[×]Off</font>');
		$php_info ["sp_safe_mode"] = (ini_get ( 'safe_mode') ?'<font color=red>[×]On</font>': '<font color=green>[√]Off</font>');
		$php_info ["sp_mysql"] = (function_exists ( 'mysql_connect') ?'<font color=green>[√]On</font>': '<font color=red>[×]Off</font>');
		$_A ['php_info'] = $php_info;
		$this->display ( $tpldir .'main.html');
	}
	public function login() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$msg = '';
		if ($_G ["user_id"] != "") 
		{
			redirect ( U ( 'admin/index/index'),1,'请不要重复登录...');
			exit ();
		}
		if (IS_POST) 
		{
			if (check_verify ( I ( 'post.valicode') )) 
			{
				if (!IsExiest ( $_POST ['username'] )) 
				{
					$msg [0] = $MsgInfo ['users_username_empty'];
				}
				else 
				{
					$data ['username'] = I ( 'post.username');
					$data ['password'] = I ( 'post.password');
					$result = \uadminClass::AdminLogin ( $data );
					if (!is_array ( $result )) 
					{
						$msg [0] = $MsgInfo [$result];
					}
					else 
					{
						$data ['user_id'] = $result ['user_id'];
						$data ['session_id'] = 'ds_code_userid';
						SetCookies ( $data );
						redirect ( U ( 'admin/index/index'),0,'跳转中...');
						exit ();
					}
				}
			}
			else 
			{
				$msg [0] = '验证码错误';
			}
		}
		$this->display ( $tpldir .'login.html',$msg );
	}
	public function logout() 
	{
		DelCookies ( array ( 'session_id'=>"ds_code_userid" ) );
		header ( "location:".U ( 'admin/index') );
	}
}
