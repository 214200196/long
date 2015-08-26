<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class IndexController extends HomeController 
{
	public function index() 
	{	
		
		global $_G,$tpldir,$MsgInfo,$_U;
		if (isset ( $_REQUEST ['site'] )) 
		{

			if ($_G ['site_result'] != false) 
			{
				switch ($_G ['site_result'] ['type']) 
				{
					case 'article': if (isset ( $_REQUEST ['id'] )) 
					{
						$_G ['articles_result'] = \articlesClass::GetOne ( array ( "id"=>I ( 'request.id'), "hits_status"=>1 ) );
						$temps = $_G ['site_result'] ['content_tpl'];
					}
					else 
					{
						$data = array ();
						$data ['page'] = I ( 'get.p');
						$data ['type_id'] = $_G ['site_result'] ['value'];
						$lists = \articlesClass::GetList ( $data );
						$this->assign ( $lists );
						$temps = $_G ['site_result'] ['list_tpl'];
					}
					break;
					case 'page': if (isset ( $_REQUEST ['nid'] )) 
					{
						$_G ['page_result'] = \articlesClass::GetPageOne ( array ( "id"=>$_G ['site_result'] ['value'] ) );
						$temps = $_G ['site_result'] ['content_tpl'];
					}
					else 
					{
						$temps = $_G ['site_result'] ['index_tpl'];
					}
					break;
					case 'url': redirect ( $_G ['site_result'] ['value'] );
					exit ();
				}
			}
			else 
			{
				redirect ( '/404.html');
				exit ();
			}
		}
		else 
		{
			if ($_G ['site_result'] == false) 
			{
				$_G ['site_result'] ['id'] = 1;
			}
			$temps = 'index.html';
		}
		$this->display ( $tpldir .$temps );
	}
	public function tool_lixi() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$this->display ( $tpldir .'index.html');
	}
	public function reg() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$msg = '';
		if (IS_AJAX) 
		{
			if ($_GET ['q'] == 'check_email') 
			{
				$result = \usersClass::GetUsers ( array ( "email"=>I ( 'get.email') ) );
				if ($result == NULL) 
				{
					$data = 1;
				}
				else 
				{
					$data = 0;
				}
			}
			elseif ($_GET ['q'] == 'check_username') 
			{
				$result = \usersClass::CheckUsername ( array ( "username"=>I ( 'get.username') ) );
				if ($result == false) 
				{
					$data = 1;
				}
				else 
				{
					$data = 0;
				}
			}
			elseif ($_GET ['q'] == 'check_niname') 
			{
				$result = \usersClass::CheckNiname ( array ( "niname"=>I ( 'get.niname') ) );
				if ($result == false) 
				{
					$data = 1;
				}
				else 
				{
					$data = 0;
				}
			}
			elseif ($_GET ['type'] == 'sendemail') 
			{
				$data ['user_id'] = $_G ['user_result'] ['user_id'];
				$active_id = urlencode ( authcode ( $data ['user_id'] .",".time (),"TTWCGY") );
				$reg_active_url = U ( 'users/active?id='.$active_id );
				$reg_active_url = str_replace ( "/","ds2XURL",$reg_active_url );
				$data ['query_url'] = $reg_active_url;
				$data ['webname'] = $_G ['system'] ['con_webname'];
				$data ['email'] = $_G ['user_result'] ['email'];
				$data ['username'] = $_G ['user_result'] ['username'];
				$email_info ['query_url'] = $reg_active_url;
				$email_info ['user_id'] = $_G ['user_result'] ['user_id'];
				$email_info ['email'] = $_G ['user_result'] ['email'];
				$email_info ['title'] = $MsgInfo ["users_add_reg_email_title"];
				$email_info ["msg"] = RegEmailMsg ( $data );
				$email_info ['type'] = "reg";
				$result = \usersClass::SendEmail ( $email_info );
				if ($result) $data = "发送成功";
				else $data = '发送失败';
			}
			$this->ajaxReturn ( $data );
		}
		if (IS_POST) 
		{
			if (check_verify ( $_POST ['valicode'] )) 
			{
				$data ['email'] = I ( 'post.email');
				$data ['username'] = I ( 'post.username');
				$data ['password'] = I ( 'post.password');
				$data ['confirm_password'] = I ( 'post.confirm_password');
				$data ['niname'] = I ( 'post.niname');
				if (IsExiest ( $_POST ['invite_usercode'] ) != false &&$_POST ['invite_usercode'] != "") 
				{
					$result = \usersClass::GetInvite ( array ( "invite_code"=>I ( 'post.invite_usercode') ) );
					if ($result != false) 
					{
						$data_info ['invite_userid'] = $result ['user_id'];
					}
					else 
					{
						$msg = array ( $MsgInfo ["users_reg_invite_username_not_exiest"] );
					}
				}
				if ($msg == '') 
				{
					$result = \usersClass::RegUsers ( $data );
					if ($result >0) 
					{
						if ($data_info ['invite_userid'] != "") 
						{
							$indata ['user_id'] = $data_info ['invite_userid'];
							$indata ['friends_userid'] = $result;
							$indata ['addtime'] = time ();
							$indata ['addip'] = get_client_ip ();
							$indata ['status'] = 1;
							$indata ['type'] = 1;
							M ( 'users_friends_invite')->add ( $indata );
						}
						$credit_log ['user_id'] = $result;
						$credit_log ['nid'] = "reg";
						$credit_log ['code'] = "reg";
						$credit_log ['type'] = "reg";
						$credit_log ['addtime'] = time ();
						$credit_log ['article_id'] = $result;
						$credit_log ['remark'] = "注册获得金币";
						\creditClass::ActionCreditLog ( $credit_log );
						if ($_G ['system'] ['con_reg_vip'] >0) 
						{
							$data ['vip_type'] = 1;
							$data ['gold_status'] = 0;
							$data ['user_id'] = $result;
							$data ['remark'] = "注册赠送VIP";
							$data ['kefu_userid'] = 0;
							$data ['money'] = 0;
							$data ['vip_time'] = $_G ['system'] ['con_reg_vip'];
							\usersClass::UsersVipApply ( $data );
						}
						$_result = \usersClass::GetUsersTypeCheck ();
						$data_info ['type_id'] = $_result ['id'];
						$data_info ['status'] = 1;
						$data_info ['user_id'] = $result;
						\usersClass::UpdateUsersInfo ( $data_info );
						$data ['user_id'] = $result;
						$data ['cookie_status'] = $_G ['system'] ['con_cookie_status'];
						SetCookies ( $data );
						$active_id = urlencode ( authcode ( $result .",".time (),"TTWCGY") );
						$reg_active_url = U ( 'users/active?id='.$active_id );
						$reg_active_url = str_replace ( "/","ds2XURL",$reg_active_url );
						$data ['query_url'] = $reg_active_url;
						$email_info ['query_url'] = $reg_active_url;
						$email_info ['user_id'] = $result;
						$email_info ['email'] = $data ['email'];
						$email_info ['title'] = $MsgInfo ["users_add_reg_email_title"];
						$data ['webname'] = $_G ['system'] ['con_webname'];
						$email_info ["msg"] = RegEmailMsg ( $data );
						$email_info ['type'] = "reg";
						$result = \usersClass::SendEmail ( $email_info );
						echo "<script>location.href='".U ( 'index/reg?type=email') ."'</script>";
						exit();
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
				}
			}
			else 
			{
				$msg = array ( '验证码错误' );
			}
		}
		elseif ($_REQUEST ["type"] == "email") 
		{
			$emailurl = "http://mail.".str_replace ( "@","",strstr ( $_G ['user_result'] ['email'],"@") );
			$_U ['emailurl'] = $emailurl;
		}

		$this->display ( $tpldir .'reg.html',$msg,'user_header.html');
	}
	public function logout() 
	{
		DelCookies ();
		echo '<script language="javascript">window.location.href="/index.php";</script>';
		exit ();
	}
	public function login() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$msg = '';
		if (IS_POST) 
		{
			$data ['username'] = $_POST ['keywords'];
			$data ['password'] = $_POST ['password'];
			$result = \usersClass::Login ( $data );
			if ($result >0) 
			{
				$data ['user_id'] = $result;
				DelCookies ( $data );
				SetCookies ( $data );
				$msg = array ( $MsgInfo ["users_login_success"], U ( 'index/index') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		$this->display ( $tpldir .'login.html',$msg,'user_header.html');
	}
	public function payResult() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$result = \paymentClass::GetOne ( array ( "nid"=>"ecpss" ) );
		$MD5key = $result ['fields'] ['VerficationCode'] ['value'];
		$BillNo = $_POST ["BillNo"];
		$Amount = $_POST ["Amount"];
		$Succeed = $_POST ["Succeed"];
		$Result = $_POST ["Result"];
		$MD5info = $_POST ["SignMD5info"];
		$Remark = $_POST ["Remark"];
		$md5src = $BillNo ."&".$Amount ."&".$Succeed ."&".$MD5key;
		$md5sign = strtoupper ( md5 ( $md5src ) );
		if ($MD5info == $md5sign) 
		{
			if ($Succeed == "88") 
			{
				\accountClass::OnlineReturn ( array ( "trade_no"=>$BillNo ) );
				$msg = "支付成功";
				echo "<script>alert('{$msg}
			');location.href='".U ( 'account/logs') ."';</script>";
			exit ();
		}
		else 
		{
			$msg = urldecode ( $Result ) .$Succeed;
			echo "<script>alert('{$msg}
		');location.href='".U ( 'account/logs') ."';</script>";
		exit ();
	}
}
else 
{
	$msg = 'Validation failed!';
	echo "<script>alert('{$msg}
');location.href='".U ( 'account/logs') ."';</script>";
exit ();
}
}
public function getpwd() 
{
global $_G,$tpldir,$MsgInfo,$_U;
if (isset ( $_POST ['email'] )) 
{
$getpwd_msg = "";
$var = array ( "email", "username", "valicode" );
$data = post_var ( $var );
if ($data ['email'] == "") 
{
	$getpwd_msg = "邮箱地址不能为空";
	echo "<script>alert('{$getpwd_msg}
');location.href='/'</script>";
exit ();
}
elseif ($data ['username'] == "") 
{
$getpwd_msg = "用户名不能为空";
echo "<script>alert('{$getpwd_msg}
');location.href='/'</script>";
exit ();
}
else 
{
$result = \usersClass::GetUsers ( $data );
if ($result == null ||$result == false) 
{
$getpwd_msg = "邮箱，用户名对应不正确";
echo "<script>alert('{$getpwd_msg}
');location.href='/'</script>";
exit ();
}
else 
{
$data ['user_id'] = $result ['user_id'];
$data ['email'] = $result ['email'];
$data ['username'] = $result ['username'];
$data ['webname'] = $_G ['system'] ['con_webname'];
$data ['title'] = "更改密码确认信";
$data ['msg'] = GetpwdMsg ( $data );
$data ['type'] = "reg";
if (isset ( $_SESSION ['sendemail_time'] ) &&$_SESSION ['sendemail_time'] +60 * 2 >time ()) 
{
$getpwd_msg = "请2分钟后再次请求。";
}
else 
{
$result = \usersClass::SendEmail ( $data );
if ($result) 
{
	$_SESSION ['sendemail_time'] = time ();
	$getpwd_msg = "信息已发送到{$data['email']}
，请注意查收您邮箱的邮件";
echo "<script>alert('{$getpwd_msg}
');location.href='/';</script>";
exit ();
}
else 
{
$getpwd_msg = "发送失败，请跟管理员联系";
echo "<script>alert('{$getpwd_msg}
');location.href='/';</script>";
exit ();
}
}
}
}
$_U ['getpwd_msg'] = $getpwd_msg;
}
$this->display ( $tpldir .'user_getpwd.html',$msg,'user_header.html');
}
public function updatepwd()
{
global $_G,$tpldir,$MsgInfo,$_U;
$updatepwd_msg = "";
if(isset($_REQUEST['id'])&&$_REQUEST['id']!='')
{
$yid=$_REQUEST ['id'];
$_REQUEST ['id'] = str_replace ( "ds2XURL","/",$_REQUEST ['id'] );
$id = I('request.id');
$data = explode(",",authcode(trim($id),"DECODE"));
$user_id = $data[0];
$start_time = $data[1];
if ($user_id=="")
{
$updatepwd_msg = "您的操作有误，请勿乱操作";
}
elseif (time()>$start_time+10*60)
{
$updatepwd_msg = "此链接已经过期，请重新申请";
}
else
{
$result = \usersClass::GetUsers(array("user_id"=>$user_id));
if ($result == null)
{
$updatepwd_msg = "您的操作有误，请勿乱操作";
}
else
{
$_U['user_result'] = $result;
$logs=\usersClass::GetUsersEmailLog(array("user_id"=>$user_id));
if($po===false)$updatepwd_msg = "您没有申请过重置密码，请勿乱操作";
}
}
}
else
{
$updatepwd_msg = "您的操作有误，请勿乱操作";
}
if(isset($_POST['password']) &&$updatepwd_msg=="")
{
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
if ($password=="")
{
$update_msg = "新密码不能为空";
}
elseif ( strlen($password)<6 ||strlen($password)>15)
{
$update_msg = "密码的长度在6到15位之间";
}
elseif ($password != $confirm_password)
{
$update_msg = "两次密码不一样";
}
else
{
$index['user_id'] = $user_id;
$index['password'] = $password;
$result = \usersClass::UpdatePassword($index);
if ($result==false)
{
$update_msg = "您的操作有误，请勿乱操作";
}
else
{
$updatepwd_msg = "密码修改成功。";
}
}
}
$_U['update_msg'] = $update_msg;
$_U['updatepwd_msg'] = $updatepwd_msg;
$template = 'user_updatepwd.html';
$this->display ( $tpldir .$template,$msg,'user_header.html');
}
}
?>