<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class AccountController extends HomeController 
{
	public function logs() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
		$msg = '';
		$tvar ['accout'] = \accountClass::GetOne ( array ( 'user_id'=>$_G ['user_id'] ) );
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
		if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
		if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
		$lists = \accountClass::GetLogList ( $data );
		$this->assign ( $lists );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
	}
	public function recharge() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
		$msg = '';
		$result = \accountClass::GetRechargeCount ( array ( 'user_id'=>$_G ['user_id'] ) );
		$_U ['recharge'] ['online'] = $result ['recharge_all_up'];
		$_U ['recharge'] ['downline'] = $result ['recharge_all_down'];
		$_U ['recharge'] ['all'] = $result ['recharge_all'];
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		$lists = \accountClass::GetRechargeList ( $data );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
	}
	public function cash() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
		$msg = '';
		$_result = \accountClass::GetCashCount ( array ( 'user_id'=>$_G ['user_id'] ) );
		$_U ['cash'] ['all'] = $_result ['account'];
		$_U ['cash'] ['credited_all'] = $_result ['credited_all'];
		$_U ['cash'] ['fee_all'] = $_result ['fee_all'];
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$data ['user_id'] = $_G ['user_id'];
		$lists = \accountClass::GetCashList ( $data );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
	}
	public function tender_count() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
		$msg = '';
		$tvar ['borrow'] = \borrowClass::GetUserCount ( array ( 'user_id'=>$_G ['user_id'] ) );
		$tvar ['bchange'] = \borrowClass::GetChangeList ( array ( 'buy_userid'=>$_G ['user_id'], 'status'=>1 ) );
		$tvar ['lists'] = \borrowClass::GetChangeList ( array ( 'user_id'=>$_G ['user_id'], 'status'=>1 ) );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $tvar );
		$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
	}
	public function recharge_new() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
		{
			if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
			{
				redirect ( U ( 'index/login'),0,'请登录');
				exit ();
			}
		}
		$msg = '';
		if (isset ( $_POST ['money'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data ['money'] = I ( 'post.money');
				$data ['type'] = I ( 'post.type');
				$data ['remark'] = I ( 'post.');
				$data ['user_id'] = $_G ['user_id'];
				$data ['status'] = 0;
				if (!is_numeric ( $data ['money'] )) 
				{
					$msg = array ( "金额填写有误", U ( 'Account/recharge_new') );
				}
				if ($msg == "") 
				{
					$url = "";
					if ($data ['type'] == 1) 
					{
						$data ['payment'] = I ( 'post.payment1');
						$data ['remark'] = I ( 'post.payname'.$_POST ['payment1'] ) ."在线充值";
						$result = \usersClass::GetUsersVip ( array ( "user_id"=>$data ['user_id'] ) );
						if ($result ['status'] == 1) 
						{
							$data ['fee'] = $_G ['system'] ['con_account_recharge_vip_fee'] / 100 * $data ['money'];
						}
						else 
						{
							$data ['fee'] = $_G ['system'] ['con_account_recharge_fee'] / 100 * $data ['money'];
						}
						$data ['balance'] = $data ['money'] -$data ['fee'];
					}
					else 
					{
						$data ['payment'] = $_POST ['payment2'];
						$data ['fee'] = $_G ['system'] ['con_account_recharge_jiangli'] / 100 * $data ['money'];
						$data ['balance'] = $data ['money'] +$data ['fee'];
					}
					$data ['nid'] = time () .$_G ['user_id'] .rand ( 1000,9999 );
					if ($data ['type'] == 2) 
					{
						$data ['status'] = 0;
					}
					else 
					{
						$data ['status'] = 2;
					}
					$result = \accountClass::AddRecharge ( $data );
					$data ['trade_no'] = $data ['nid'];
					if ($data ['type'] == 1) 
					{
						$data ['subject'] = "账号充值";
						$data ['body'] = "账号充值";
						$url = \paymentClass::ToSubmit ( $data );
					}
					if ($result != true) 
					{
						$msg = array ( $result, U ( 'Account/recharge_new') );
					}
					else 
					{
						if ($url != "") 
						{
							header ( "Location: {$url}
						");
						exit ();
						$msg = array ( "网站正在转向支付网站<br>如果没反应，请点击下面的支付网站接口", $url, "支付网站" );
					}
					else 
					{
						$msg = array ( "你已经成功提交了充值，请等待管理员的审核。", U ( 'Account/recharge_new') );
					}
				}
			}
			else 
			{
				$msg = array ( "金额填写有误", U ( 'Account/recharge_new') );
			}
		}
	}
	else 
	{
		$_U ['account_payment_list'] = \paymentClass::GetList ( array ( "status"=>1 ) );
	}
	$tvar ['uvip'] = \usersClass::GetUsersVip ( array ( 'user_id'=>$_G ['user_id'] ) );
	if ($msg == '') 
	{
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
	}
	$this->assign ( $tvar );
	$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
}
public function cash_new() 
{
	global $_G,$tpldir,$_U,$MsgInfo;
	if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
	{
		if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
		{
			redirect ( U ( 'index/login'),0,'请登录');
			exit ();
		}
	}
	$msg = '';
	$data ['user_id'] = $_G ["user_id"];
	$_result_jin = \accountClass::Getborrowjin ( $data );
	$_U ['result_jin'] = $_result_jin ['account'];
	$smst = include ROOT_PATH ."modules/sms.tempatle.php";
	if (isset ( $_POST ['money'] )) 
	{
		if (!check_verify ( I ( 'post.valicode') )) 
		{
			$msg = array ( '验证码错误' );
		}
		if ($smst ['data'] ['withdraw'] ['isopen'] == 1) 
		{
			if (isset ( $_POST ['code_yz'] )) 
			{
				$code_yz = $_POST ['code_yz'];
				if (empty ( $code_yz )) 
				{
					$msg = array ( "请填写手机验证码" );
				}
				else 
				{
					$code = M ( 'approve_smslog')->where ( "user_id={$data['user_id']}
				and type='smstixian' and code_status=0")->field ( 'code,id')->order ( '`id` DESC')->find ();
				if ($code_yz != $code ['code']) 
				{
					$msg = array ("手机验证码错误");
				}
			}
		}
	}
	if (!is_numeric ( $_POST ['money'] )) 
	{
		$msg = array ( "金额填写有误" );
	}
	if ($_POST ['money'] <0) 
	{
		$msg = array ( "金额必须为正数" );
	}
	if ($msg != "") 
	{
	}
	elseif ($_G ["user_result"] ['paypassword'] != md5 ( $_POST ['paypassword'] )) 
	{
		$msg = array ( "交易密码填写有误" );
	}
	else 
	{
		$data ['status'] = 0;
		$data ['total'] = $_POST ['money'] ;
		$data ['account'] = $_POST ['money'];
		$data ['bank'] = $_POST ['bank'];
		$data ['bank_id'] = $_POST ['bank_id'];
		$data ['nid'] = "cash_".$_G ['user_id'] .time () .rand ( 100,999 );
		$data ['fee'] = $_G ['system'] ['con_account_cash_1'] * $data ['account'] * 0.01;
		if($_G ['system'] ['con_account_cash_fee']>0)
		{
			if($data ['fee']>$_G ['system'] ['con_account_cash_fee']) 
			{
				$data ['fee']=$_G ['system'] ['con_account_cash_fee'];
			}
		}
		$data ['credited'] = $data ['total'] -$data ['fee'];
		$result = \accountClass::AddCash ( $data );
		if ($result >0) 
		{
			if (isset ( $_POST ['code_yz'] )) 
			{
				$cdata['code_status']=1;
				$cdata['code_time']=time();
				M('approve_smslog')->where("id={$code ['id']}
			")->save($cdata);
		}
		$msg = array ( "您的提现申请已经成功提交，除工作日外预计24小时到账", U ( 'account/logs') ) ;
	}
	else 
	{
		$msg = array ( $MsgInfo [$result] ) ;
	}
}
}
else 
{
$account = \accountClass::GetOne ( array ( 'user_id'=>$_G ['user_id'] ) );
$real = \approveClass::GetRealnameOne ( array ( 'user_id'=>$_G ['user_id'] ) );
$bank = \accountClass::GetUsersBankOne ( array ( 'user_id'=>$_G ['user_id'] ) );
$this->assign ( 'bank',$bank );
$this->assign ( 'real',$real );
$this->assign ( 'account',$account );
$this->assign ( 'issms',$smst ['data'] ['withdraw'] ['isopen'] );
}
define ( 'THEME_PATH',$tpldir );
layout ( 'user_main');
$this->assign ( $tvar );
$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
}
public function bank() 
{
global $_G,$tpldir,$_U,$MsgInfo;
$msg = '';
define ( 'THEME_PATH',$tpldir );
layout ( 'user_main');
$this->assign ( $tvar );
$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
}
public function banks() 
{
global $_G,$tpldir,$_U,$MsgInfo;
if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) 
{
if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
{
	redirect ( U ( 'index/login'),0,'请登录');
	exit ();
}
}
$msg = '';
if (IsExiest ( $_POST ['account'] ) != false) 
{
$data ['province'] = I ( 'post.province');
$data ['city'] = I ( 'post.city');
$data ['account'] = I ( 'post.account');
$data ['bank'] = I ( 'post.bank');
$data ['branch'] = I ( 'post.branch');
$data ['user_id'] = $_G ['user_id'];
$result = \accountClass::UpdateUsersBank ( $data );
if ($result >0) 
{
	$msg = array ( "资金账户修改成功", U ( 'account/banks') ) ;
}
else 
{
	$msg = array ( $MsgInfo [$result], U ( 'account/banks') );
}
}
else 
{
$result = \accountClass::GetUsersBankOne ( array ( "user_id"=>$_G ['user_id'] ) );
if (is_array ( $result )) 
{
	$_U ['account_bank_result'] = $result;
}
else 
{
	$sql = "insert into `{account_users_bank}` set user_id='".$_G ['user_id'] ."'";
	M ()->execute ( presql ( $sql ) );
}
}
define ( 'THEME_PATH',$tpldir );
layout ( 'user_main');
$this->assign ( $tvar );
$this->display ( $tpldir .'user_account.html',$msg,'user_header.html');
}
}
?>