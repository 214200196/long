<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class AccountController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \accountClass::GetList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'account.html',$msg );
	}
	public function log() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['email'] )) $data ['email'] = I ( 'request.email');
		if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
		if (isset ( $_REQUEST ['order'] )) $data ['order'] = I ( 'request.order');
		if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
		if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
		$lists = \accountClass::GetLogList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'accountlog.html',$msg );
	}
	public function bank() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "account_bank");
		if ($_POST ['type'] == "user_id") 
		{
			$data ['username'] = I ( 'post.username');
			$data ['user_id'] = I ( 'post.user_id');
			$data ['email'] = I ( 'post.email');
			$result = \usersClass::GetUserid ( $data );
			if ($result >0) 
			{
				echo "<script>location.href='".U ( 'account/bank?user_id='.$result ) ."'</script>";
				exit ();
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'account/bank') );
			}
		}
		elseif ($_POST ['type'] == "update") 
		{
			$data ['user_id'] = I ( 'post.user_id');
			$data ['province'] = I ( 'post.province');
			$data ['city'] = I ( 'post.city');
			$data ['account'] = I ( 'post.account');
			$data ['bank'] = I ( 'post.bank');
			$data ['branch'] = I ( 'post.branch');
			$result = \accountClass::UpdateUsersBank ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["account_bank_users_update_success"], );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "account";
			$admin_log ["type"] = "bank";
			$admin_log ["operating"] = "users";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['user_id'] != "") 
		{
			$data ['user_id'] = I ( 'request.user_id');
			$result = \accountClass::GetUsersBankOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ['account_bank_result'] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], );
			}
		}
		elseif ($_REQUEST ['action'] == "new"||$_REQUEST ['action'] == "edit") 
		{
			if (isset ( $_POST ['name'] )) 
			{
				if (!empty ( $_FILES ['litpic'] ['name'] )) 
				{
					$info = $this->uploads ( 'litpic','bank');
					$data ['litpic'] = $info ['savepath'] .$info ['savename'];
				}
				$data ['name'] = I ( 'post.name');
				$data ['status'] = I ( 'post.status');
				$data ['nid'] = I ( 'post.nid');
				$data ['cash_money'] = I ( 'post.cash_money');
				$data ['reach_day'] = I ( 'post.reach_day');
				if ($_REQUEST ['id'] != "") 
				{
					$data ['id'] = I ( 'request.id');
					$result = \accountClass::UpdateBank ( $data );
				}
				else 
				{
					$result = \accountClass::AddBank ( $data );
				}
				if ($result >0) 
				{
					if ($_REQUEST ['id'] != "") 
					{
						$msg = array ( $MsgInfo ["account_bank_update_success"], U ( 'Account/bank?&action=bank') );
					}
					else 
					{
						$msg = array ( $MsgInfo ["account_bank_add_success"], U ( 'Account/bank?&action=bank') );
					}
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "account";
				$admin_log ["type"] = "bank";
				$admin_log ["operating"] = $_REQUEST ['action'] == "edit"?"edit": "new";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
			elseif ($_REQUEST ['action'] == "del") 
			{
				$data ['id'] = $_REQUEST ['id'];
				$result = \accountClass::DeleteBank ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["account_bank_del_success"], );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "account";
				$admin_log ["type"] = " bank";
				$admin_log ["operating"] = 'del';
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
			elseif ($_REQUEST ['id'] != "") 
			{
				$data ['id'] = $_REQUEST ['id'];
				$_A ['account_bank_result'] = \accountClass::GetBank ( $data );
			}
		}
		else 
		{
			if (!IsExiest ( $_REQUEST ['action'] )) 
			{
				$data = array ();
				if(isset($_REQUEST['keywords'])) $data['keywords']=I('request.keywords');
				$data ['page'] = I ( 'get.p');
				$lists = \accountClass::GetUsersBankList ( $data );
				$this->assign ( $lists );
			}
			elseif ($_REQUEST ['action'] == 'bank') 
			{
				$data = array ();
				if(isset($_REQUEST['keywords'])) $data['keywords']=I('request.keywords');
				$data ['page'] = I ( 'get.p');
				$lists = \accountClass::GetBankList ( $data );
				$this->assign ( $lists );
			}
		}
		$this->assign ( 'MsgInfo',$MsgInfo );
		$this->display ( $tpldir .'accountbank.html',$msg );
	}
	public function recharge() 
	{
		check_rank("account_recharge");
		global $tpldir,$_G,$_A,$MsgInfo;
		require_once (ROOT_PATH ."modules/account.model.php");
		check_rank ( "account_recharge");
		if (isset ( $_REQUEST ['type_e'] ) &&$_REQUEST ['type_e'] == "excel") 
		{
			$data ['page'] = I ( 'request.p');
			$data ['username'] = I ( 'request.username');
			$data ['status'] = I ( 'request.status');
			\accountexcel::RechargeLog ( $data );
			exit ();
		}
		elseif ($_REQUEST ['view'] != "") 
		{
			if (isset ( $_POST ['nid'] )) 
			{
				$data ['nid'] = I ( 'post.nid');
				$data ['status'] = I ( 'post.status');
				$data ['verify_remark'] = I ( 'post.verify_remark');
				$data ['verify_userid'] = $_G ['user_id'];
				$data ['verify_time'] = time ();
				$result = \accountClass::VerifyRecharge ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["account_reacharge_verify_success"], U ( 'account/recharge') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "account";
				$admin_log ["type"] = "recharge";
				$admin_log ["operating"] = "verify";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
			else 
			{
				$data ['id'] = $_REQUEST ['view'];
				$_A ['account_recharge_result'] = \accountClass::GetRecharge ( $data );
			}
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
			if (isset ( $_REQUEST ['email'] )) $data ['email'] = I ( 'request.email');
			if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
			if (isset ( $_REQUEST ['order'] )) $data ['order'] = I ( 'request.order');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['excel'] )) $data ['excel'] = I ( 'request.excel');
			$lists = \accountClass::GetRechargeList ($data);
			$this->assign ( $lists );
		}
		$this->assign ( 'MsgInfo',$MsgInfo );
		if ($_REQUEST ['view'] == '') $this->display ( $tpldir .'recharge.html',$msg );
		else $this->display ( $tpldir .'rechview.html',$msg );
	}
	public function cash() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "account_cash");
		if (isset ( $_REQUEST ['type'] ) &&$_REQUEST ['type'] == "excel") 
		{
			$data ['page'] = I ( 'request.p');
			$data ['username'] = I ( 'request.username');
			$data ['status'] = I ( 'request.status');
			\accountexcel::CashLog ( $data );
			exit ();
		}
		elseif ($_REQUEST ['action'] == "view") 
		{
			if (isset ( $_POST ['status'] )) 
			{
				if (!check_verify ( I ( 'post.valicode') )) $msg = array ( '验证码错误' );
				if ($msg == "") 
				{
					$data ['status'] = I ( 'post.status');
					$data ['credited'] = I ( 'post.credited');
					$data ['fee'] = I ( 'post.fee');
					$data ['verify_remark'] = I ( 'post.verify_remark');
					$data ['id'] = I ( 'request.id');
					$data ['verify_userid'] = $_G ['user_id'];
					$data ['verify_time'] = time ();
					$result = \accountClass::VerifyCash ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["account_cash_verify_success"], U ( 'account/cash') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "account";
					$admin_log ["type"] = "cash";
					$admin_log ["operating"] = "verify";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
			else 
			{
				$data ['id'] = I('request.id');
				$_A ['account_cash_result'] = \accountClass::GetCashOne ( $data );
			}
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			$lists = \accountClass::GetCashList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'cash.html',$msg );
	}
	public function recharge_new() 
	{
		check_rank("account_recharge_new");
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "account_recharge_new");
		if (isset ( $_POST ['username'] ) &&$_POST ['username'] != "") 
		{
			$_data ['username'] = I ( 'post.username');
			$result = \usersClass::GetUsers ( $_data );
			if ($result == false) 
			{
				$msg = array ( "用户名不存在" );
			}
			else 
			{
				$data ['user_id'] = $result ['user_id'];
				$data ['status'] = 0;
				$data ['type'] == 2;
				$data ['payment'] = 0;
				$data ['fee'] = 0;
				$data ['balance'] = I ( 'post.money');
				$data ['money'] = I ( 'post.money');
				$data ['nid'] = $result ['user_id'] .time () .rand ( 100,999 );
				$data ['remark'] = I ( 'post.remark');
				$result = \accountClass::AddRecharge ( $data );
				if ($result == false) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "操作成功", U ( 'account/recharge') );
				}
			}
		}
		$this->display ( $tpldir .'recharge_new.html',$msg );
	}
	public function web() 
	{
		check_rank("account_web");
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST ['action'] == '') 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			$lists = \accountClass::GetBalanceList ( $data );
		}
		elseif ($_REQUEST ['action'] == 'repay') 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['keywords'] )) $data ['keywords'] = I ( 'request.keywords');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			if (isset ( $_REQUEST ['recover_status'] )) $data ['recover_status'] = I ( 'request.recover_status');
			$data ['borrow_status'] = 3;
			$data ['type'] = 'web';
			$data ['order'] = 'recover_status';
			$data ['order'] = 'recover_status';
			$data ['showtype'] = 'web';
			$lists = \borrowClass::GetRecoverList ( $data );
		}
		elseif ($_REQUEST ['action'] == 'account') 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			$lists = \accountClass::GetWebList ( $data );
		}
		$this->assign ( $lists );
		$this->assign ( 'MsgInfo',$MsgInfo );
		$this->display ( $tpldir .'web.html',$msg );
	}
	public function users() 
	{
		check_rank("account_users");
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_REQUEST ['type'] ) &&$_REQUEST ['type'] == "excel") 
		{
			$data ['page'] = $_REQUEST ['page'];
			$data ['username'] = $_REQUEST ['username'];
			\accountexcel::UsersLog ( $data );
			exit ();
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['email'] )) $data ['email'] = I ( 'request.email');
			if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
			if (isset ( $_REQUEST ['order'] )) $data ['order'] = I ( 'request.order');
			if (isset ( $_REQUEST ['type'] )) $data ['type'] = I ( 'request.type');
			if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
			if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
			$lists = \accountClass::GetUsersList ( $data );
			$this->assign($lists);
		}
		$this->assign ( 'MsgInfo',$MsgInfo );
		$this->display ( $tpldir .'account.users.html',$msg );
	}
	public function tender() 
	{
		check_rank("account_users");
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['borrow_name'] )) $data ['borrow_name'] = I ( 'request.borrow_name');
		if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
		if (isset ( $_REQUEST ['borrow_nid'] )) $data ['borrow_nid'] = I ( 'request.borrow_nid');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['query_type'] )) $data ['query_type'] = I ( 'request.query_type');
		$lists=\borrowClass::GetTenderList($data);
		$this->assign($lists);
		$this->display ( $tpldir .'tender.html',$msg );
	}
	public function exits() 
	{
		check_rank("account_recharge_new");
		global $tpldir,$_G,$_A,$MsgInfo;
		$user_id =I('post.user_id');
		$money =isset($_POST['money'])?I('post.money'):0;
		$log = $_POST['log'];
		if($user_id>0 &&isset($_POST['user_id']))
		{
			if($money>0)
			{
				$log_info["user_id"] = $user_id;
				$log_info["nid"] = "change_add_".time();
				$log_info["money"] = $money;
				$log_info["income"] = $money;
				$log_info["expend"] = 0;
				$log_info["balance"] = $money;
				$log_info["balance_cash"] = $money;
				$log_info["balance_frost"] = 0;
				$log_info["frost"] = 0;
				$log_info["await"] = 0;
				$log_info["type"] = "change_add";
				$log_info["to_userid"] = 0;
				$log_info["remark"] = "管理员添加资金，变动原因：".$log;
				$result = \accountClass::AddLog($log_info);
			}
			elseif($money<0)
			{
				$log_info["user_id"] = $user_id;
				$log_info["nid"] = "change_lessen_".time();
				$log_info["money"] = abs($money);
				$log_info["income"] = 0;
				$log_info["expend"] = abs($money);
				$log_info["balance_cash"] = $money;
				$log_info["balance_frost"] = 0;
				$log_info["frost"] = 0;
				$log_info["await"] = 0;
				$log_info["type"] = "change_lessen";
				$log_info["to_userid"] = 0;
				$log_info["remark"] = "管理员减少资金，变动原因：".$log;
				$result = \accountClass::AddLog($log_info);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "account";
			$admin_log["type"] = "change";
			$admin_log["operating"] = "users";
			$admin_log["article_id"] = $result==$log_info["nid"]?$result:0;
			$admin_log["result"] = $result==$log_info["nid"]?1:0;
			$admin_log["content"] = "管理员变动资金";
			$admin_log["data"] = $log_info;
			\uadminClass::AddAdminLog($admin_log);
			$msg = array("调整成功！");
		}
		$data['username'] =I('request.username');
		$data_h = M('users')->where("username = '{$data['username']}
	'")->field('user_id,username')->find();
	$_A['account_exit_username']=urldecode($data['username']);
	$_A['account_exit_result']=\accountClass::GetOne($data_h);
	$_A['account_exit_result']['user_id']=$data_h['user_id'];
	$this->display ( $tpldir .'exits.html',$msg );
}
}
?>