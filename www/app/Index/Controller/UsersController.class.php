<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class UsersController extends HomeController 
{
	public function index() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		$msg = '';
		$tvar ['account'] = \accountClass::GetOne ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['credit'] = \borrowClass::GetBorrowCredit ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['uvip'] = \usersClass::GetUsersVip ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['borrow'] = \borrowClass::GetUserCount ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['recharge'] = \borrowClass::GetRechargeCount_log ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['amount'] = \borrowClass::GetAmountUsers ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['count'] = \borrowClass::GetUserCount ( array ( 'user_id'=>$_G ['user_id'] ) );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_index.html',$msg,'user_header.html');
	}
	public function active() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		require_once (ROOT_PATH ."modules/users.model.php");
		$msg = '';
		$_REQUEST ['id'] = str_replace ( "ds2XURL","/",$_REQUEST ['id'] );
		$id = I('request.id');
		$_id = explode ( ",",authcode ( trim ( $id ),"DECODE") );
		$data ['user_id'] = $_id [0];
		$valid_time = $_id [1];
		if ($valid_time +60 * 60 <time) 
		{
			$msg = array ( $MsgInfo ['users_active_pass'], U ( 'Users/index') );
		}
		else 
		{
			$result = \usersClass::ActiveUsersEmail ( array ( 'user_id'=>$data ['user_id'] ) );
			$msg = array ( $MsgInfo [$result], U ( 'users/index') );
			$user_log ["user_id"] = $data ['user_id'];
			$user_log ["code"] = "users";
			$user_log ["type"] = "action";
			$user_log ["operating"] = "email_active";
			$user_log ["article_id"] = $data ['user_id'];
			$user_log ["result"] = ($result == "users_active_success") ?1 : 0;
			$user_log ["content"] = $MsgInfo [$result];
			\usersClass::AddUsersLog ( $user_log );
		}
		$this->display ( $tpl,$msg );
	}
	public function checkphone() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$data['phone'] = $_REQUEST['phone'];
		$data['user_id'] = $_G['user_id'];
		$result = \usersClass::CheckPhone($data);
		echo $result;
		exit;
	}
	public function paypwd() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$msg = '';
		if (isset ( $_POST ['oldpassword'] )) 
		{
			if ($_G ['user_result'] ['paypassword'] == ""&&md5 ( $_POST ['oldpassword'] ) != $_G ['user_result'] ['password']) 
			{
				$msg = array ( "密码不正确，请输入您的登录密码", "", $url );
			}
			elseif ($_G ['user_result'] ['paypassword'] != ""&&md5 ( $_POST ['oldpassword'] ) != $_G ['user_result'] ['paypassword']) 
			{
				$msg = array ( "密码不正确，请输入您的旧交易密码", "", $url );
			}
			else 
			{
				$data ['user_id'] = $_G ['user_id'];
				$data ['paypassword'] = I ( 'newpassword');
				$result = \usersClass::UpdatePayPassword ( $data );
				if ($result >0) 
				{
					$msg = array ( "交易密码修改成功" );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
			}
		}
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_paypwd.html',$msg,'user_header.html');
	}
	public function userpwd() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$msg = '';
		if (isset ( $_POST ['oldpassword'] )) 
		{
			if ($_POST ['newpassword'] != $_POST ['newpassword1']) 
			{
				$msg = array ( "密码输入不一致" );
			}
			elseif (md5 ( $_POST ['oldpassword'] ) != $_G ['user_result'] ['password']) 
			{
				$msg = array ( "密码不正确，请输入您的旧密码" );
			}
			else 
			{
				$data ['user_id'] = $_G ['user_id'];
				$data ['password'] = I ( 'post.newpassword');
				$result = \usersClass::UpdatePassword ( $data );
				if ($result == false) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "登录密码修改成功" );
				}
			}
		}
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_paypwd.html',$msg,'user_header.html');
	}
	public function protection() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$msg = '';
		if ((isset ( $_POST ['type'] ) &&$_POST ['type'] == 1)) 
		{
			if ($_G ['user_result'] ['answer'] == ""||$_POST ['answer'] == $_G ['user_result'] ['answer']) 
			{
				$_U ['answer_type'] = 2;
			}
			else 
			{
				$msg = array ( "问题答案不正确" );
			}
		}
		elseif (isset ( $_POST ['type'] ) &&$_POST ['type'] == 2) 
		{
			$data ['question'] = I ( 'post.question');
			$data ['answer'] = I ( 'post.answer');
			if ($data ['answer'] == "") 
			{
				$msg = array ( "问题答案不能为空" );
			}
			else 
			{
				$data ['user_id'] = $_G ['user_id'];
				$result = \usersClass::UpdateUsers ( $data );
				if ($result == false) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "密码保护修改成功" );
				}
			}
		}
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_paypwd.html',$msg,'user_header.html');
	}
	public function loginlog() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		$lists = \usersClass::GetLoginLog ( $data );
		$this->assign ( $lists );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_paypwd.html',$msg,'user_header.html');
	}
	public function _initialize() 
	{
		global $tpldir,$_A,$_G;
		parent::_initialize ();
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
	}
	public function avatar() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->display ( $tpldir .'avatar.html',$msg,'user_header.html');
	}
	public function reginvite() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		$lists = \usersClass::GetFriendsInvite ( $data );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'reginvite.html',$msg,'user_header.html');
	}
	public function reginvite_tender() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] )) $data ['keywords'] = I ( 'request.keywords');
		if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
		if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
		if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
		$data ['tender_status'] = 0;
		$data ['borrow_status'] = 1;
		$lists = \borrowClass::GetInviteTenderList ( $data );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'reginvite_tender.html',$msg,'user_header.html');
	}
	public function myfriend() 
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		$lists = \usersClass::GetFriendsList ( $data );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'myfriend.html',$msg,'user_header.html');
	}
	public function getpaypwd()
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		if(isset($_REQUEST['id']) &&$_REQUEST['id']!="")
		{
			if (isset($_POST['paypwd']) &&$_POST['paypwd']!="")
			{
				if ($_POST['paypwd']=="")
				{
					$msg = array("密码不能为空","",$url);
				}
				elseif ($_POST['paypwd']!=$_POST['paypwd1'])
				{
					$msg = array("两次密码不一样","",$url);
				}
				else
				{
					$data['user_id'] = $_G['user_id'];
					$data['paypassword'] = $_POST['paypwd'];
					$result = \usersClass::UpdatePayPassword($data);
					$msg = array("交易密码修改成功");
				}
			}
			else
			{
				$yid= $_REQUEST ['id'];
				$_REQUEST ['id'] = str_replace ( "ds2XURL","/",$_REQUEST ['id'] );
				$id = I('request.id');
				$_id = explode(",",authcode(trim($id),"DECODE"));
				$data['user_id'] = $_id[0];
				if ($_id[1]+60*60<time())
				{
					$msg = array("信息已过期，请重新申请。");
				}
				elseif ($data['user_id']!=$_G['user_id'])
				{
					$msg = array("此信息不是你的信息，请不要乱操作");
				}
				else
				{
					$logs=\usersClass::GetUsersEmailLog(array("user_id"=>$data['user_id']));
					if($po===false)$msg = array("此信息不是你的信息，请不要乱操作");
				}
			}
		}
		elseif (isset($_POST['valicode']))
		{
			if (check_verify ( $_POST ['valicode'] )) 
			{
				if($_POST['answer']!=''&&$_POST['answer']==$_G['user_result']['answer'])
				{
					$data['user_id'] = $_G['user_id'];
					$data['username'] = $_G['user_result']['username'];
					$data['email'] = $_G['user_result']['email'];
					$data['webname'] = $_G['system']['con_webname'];
					$data['title'] = "交易密码取回";
					$data['key'] = "getPayPwd";
					$data['query_url'] = "user/getpaypwd";
					$data['msg'] = GetPaypwdMsg($data);
					$data['type'] = "getpaypwd";
					$result = \usersClass::SendEmail($data);
					$msg = array("信息已发送到您的邮箱，请注意查收");
				}
				else
				{
					$msg=array("密保错误");
				}
			}
			else
			{
				$msg=array('验证码错误');
			}
		}
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->display ( $tpldir .'user_paypwd.html',$msg,'user_header.html');
	}
	public function applyvip()
	{
		global $_G,$tpldir,$MsgInfo,$_U;
		if (isset($_POST['vip_type']))
		{
			$msg='';
			if (md5($_POST['paypassword'])!=$_G['user_result']['paypassword'])
			{
				$msg = array("支付交易密码不正确");
			}
			if($msg=='')
			{
				$data['vip_type'] = I('post.vip_type');
				$data['gold_status'] = I('post.gold_status');
				$data['user_id'] = $_G['user_id'];
				$data['remark'] = 0;
				$data['kefu_userid'] = 0;
				if ($data['gold_status']==1)
				{
					$gold=\creditClass::GetGoldCount(array('user_id'=>$_G['user_id']));
					if($gold['total']<20)$msg = array("金币不足。");
					$data['money'] = $_G['system']['con_vip_fee']-20;
				}
				else
				{
					$data['money'] = $_G['system']['con_vip_fee'];
				}
				$account=\accountClass::GetOne(array("user_id"=>$data['user_id']));
				if ($account['balance']<$data['money'])
				{
					$msg = array("余额不足，不能申请VIP。");
				}
			}
			if($msg=="")
			{
				$result = \usersClass::UsersVipApply($data);
				if ($result===true)
				{
					if ($_G['system']['con_vipfee_now']==1)
					{
						$vip["user_id"] = $data['user_id'];
						$vip["nid"] = "vip_success_".$data['user_id'].time();
						if ($data['gold_status']==1)
						{
							$vip['money'] = $_G['system']['con_vip_fee']-20;
							$credit_log['user_id'] = $data['user_id'];
							$credit_log['nid'] = "vip_gold";
							$credit_log['code'] = "payment";
							$credit_log['type'] = "vip_gold";
							$credit_log['addtime'] = time();
							$credit_log['article_id'] = $data['user_id'];
							$credit_log['remark'] = "升级Vip冲抵金币扣除";
							\creditClass::ActionCreditLog($credit_log);
						}
						else
						{
							$vip['money'] = $_G['system']['con_vip_fee'];
						}
						$vip["income"] = 0;
						$vip["expend"] = $vip["money"];
						$vip["balance"] = -$vip["money"];
						$vip["balance_cash"] = -$vip["money"];
						$vip["balance_frost"] = 0;
						$vip["frost"] = 0;
						$vip["await"] = 0;
						$vip["type"] = "vip_success";
						$vip["to_userid"] = 0;
						$vip["remark"] = "通过Vip审核";
						\accountClass::AddLog($vip);
						$user_log["user_id"] = $data['user_id'];
						$user_log["code"] = "account";
						$user_log["type"] = "vip_success";
						$user_log["operating"] = "account";
						$user_log["article_id"] = $data['user_id'];
						$user_log["result"] = 1;
						if ($data['vip_type']==1)
						{
							$user_log["content"] = "申请成为VIP会员成功";
						}
						else
						{
							$user_log["content"] = "申请成为高级VIP会员成功";
						}
						\usersClass::AddUsersLog($user_log);
					}
					$_result=\usersClass::GetFriendsInvite(array("friends_userid"=>$data['user_id']));
					if ($_result['list'][0]['user_id']>0)
					{
						$credit_invite['user_id'] = $_result['list'][0]['user_id'];
						$credit_invite['nid'] = "invite";
						$credit_invite['code'] = "payment";
						$credit_invite['type'] = "invite";
						$credit_invite['addtime'] = time();
						$credit_invite['article_id'] = $_result['list'][0]['user_id'];
						$credit_invite['remark'] = "邀请人成为Vip获得金币";
						\creditClass::ActionCreditLog($credit_invite);
					}
					$msg = array("Vip申请成功");
				}
				else
				{
					$msg = array($MsgInfo[$result]);
				}
			}
		}
		else
		{
			echo "<script>window.location.href='/404.htm';</script>";
			exit();
		}
		$this->display ( $tpldir .'vip.html',$msg,'user_header.html');
	}
}
?>