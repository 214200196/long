
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("account.model.php");
class accountClass 
{
	function GetList($data = array()) 
	{
		global $mysql;
		$_sql = " 1=1 ";
		if (IsExiest ( $data ['user_id'] ) != false) 
		{
			$_sql .= " and p1.user_id = '{$data['user_id']}
		'";
	}
	else 
	{
		$_sql .= " and p1.user_id !=0";
	}
	if (IsExiest ( $data ['username'] ) != false) 
	{
		$_sql .= " and p2.username = '{$data['username']}
	'";
}
$field = "p1.*,p2.username";
$_order = " p1.id desc";
if (IsExiest ( $data ['excel'] ) == "true") 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
	if ($data ['limit'] != "all") 
	{
		$_limit = $data ['limit'];
	}
	return M ( 'account')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'account')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$_list = M ( 'account')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->select ();
foreach ( $_list as $key =>$value ) 
{
$all_account += $value ['balance'];
$all_account += $value ['frost'];
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'all_account'=>$all_account );
return $result;
}
function GetLogList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
elseif ($data ['user_id'] == ""&&$data ['type'] != 2) 
{
$_sql .= " and p1.user_id !=0";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username='".urldecode ( $data ['username'] ) ."'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
if ($data ['style'] == "fxc") 
{
if ($data ['type'] == 2 &&$_REQUEST ['type'] == "") 
{
	$_sql .= " and (p1.type = 'repay_late_web' or p1.type = 'web_repay' or p1.type like 'þngxianchi%')";
}
else 
{
	$rtype = I ( 'request.type');
	$_sql .= " and p1.type = '{$rtype}
'";
}
}
else 
{
if ($data ['type'] == 3) 
{
$_sql .= " and p1.type = 'tender_spread' or p1.type = 'borrow_spread'";
}
elseif ($data ['type'] == 2) 
{
$_sql .= " and (p1.type = 'repay_late_web' or p1.type = 'web_repay' or p1.type like 'þngxianchi%')";
}
else 
{
$rtype = I ( 'request.type');
$_sql .= " and p1.type = '{$rtype}
'";
}
}
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid = '{$data['nid']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username";
$_order = " p1.id desc ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_log')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_log')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_log')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$all_money = M ( 'account_log')->alias ( 'p1')->join ( presql ( "{users} as p2 on p1.user_id=p2.user_id") )->where ( $_sql )->field ( 'sum(p1.money) as all_money')->find ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'all_money'=>$all_money ['all_money'] );
return $result;
}
function GetWebList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.type = '{$data['type']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username";
$_order = "p1.addtime desc ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_web')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_web')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_web')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$sql = "select  from `{}` as p1 left join  $_sql";
$all_money = M ( 'account_web')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'sum(p1.money) as all_money')->find ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'all_money'=>round ( $all_money ['all_money'],2 ) );
return $result;
}
function GetBalanceList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p1.remark like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.type = '{$data['type']}
'";
}
else 
{
$_sql .= " and (type='borrow_success_manage' or type='borrow_success_account'  or type='borrow_change_sell_fee' or type='vip_success' or type='recharge_fee' or type='cash_fee' or type='late_repay_web' or type='borrow_change_buy_fee' or type='advance_web' or type='web_daicha' or type='web_tender_late_repay_yes' or type='realname_fee' or type='edu_fee')";
}
$field = "p1.*,p2.username";
$_order = " p1.addtime desc ";
if (IsExiest ( $data ['excel'] ) == 1) 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_balance')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_balance')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_balance')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$money = M ( 'account_balance')->where ( "type='borrow_success_manage'")->field ( 'count(1) as gongyijin')->find ();
$gongyijin = $money ['gongyijin'] / 10;
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql1 = " and type = '{$data['type']}
'";
}
else 
{
$_sql1 = " and (type='borrow_success_manage' or type='borrow_success_account'  or type='borrow_change_sell_fee' or type='vip_success' or type='recharge_fee' or type='cash_fee' or type='late_repay_web' or type='borrow_change_buy_fee' or type='advance_web' or type='web_daicha' or type='web_tender_late_repay_yes' or type='realname_fee' or type='edu_fee')";
}
$money = M ( 'account_balance')->where ( "1=1 $_sql1")->field ( 'sum(money) as chengjiaofei')->find ();
$chengjiaofei = $money ['chengjiaofei'];
foreach ( $list as $key =>$value ) 
{
if ($value ['type'] == "borrow_success_manage"||$value ['type'] == "borrow_success_account"||$value ['type'] == "borrow_change_sell_fee"||$value ['type'] == "vip_success"||$value ['type'] == "recharge_fee"||$value ['type'] == "cash_fee"||$value ['type'] == "borrow_change_buy_fee"||$value ['type'] == "advance_web"||$value ['type'] == "web_daicha"||$value ['type'] == "web_tender_late_repay_yes"||$value ['type'] == "realname_fee"||$value ['type'] == "edu_fee") 
{
$table [$key] ['id'] = $value ['id'];
$table [$key] ['total'] = $value ['total'];
$table [$key] ['money'] = $value ['money'];
$table [$key] ['balance'] = $value ['balance'];
$table [$key] ['type'] = $value ['type'];
$table [$key] ['income'] = $value ['income'];
$table [$key] ['expend'] = $value ['expend'];
$table [$key] ['username'] = $value ['username'];
$table [$key] ['remark'] = $value ['remark'];
$table [$key] ['addtime'] = $value ['addtime'];
$table [$key] ['addip'] = $value ['addip'];
}
}
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'page'=>$show, 'gongyijin'=>$gongyijin, 'chengjiaofei'=>$chengjiaofei, 'table'=>$table );
return $result;
}
function GetUsersList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
else 
{
$_sql .= " and p1.user_id !=0";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.type = '{$data['type']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username = '{$data['username']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username,p3.await as account_await";
$_order = "p1.id desc ";
if (IsExiest ( $data ['excel'] ) == "true") 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_users')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_users')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_users')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'total_page'=>$total_page );
return $result;
}
function GetCashList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username,p3.realname,p4.name as bank_name";
$_order = "p1.addtime desc ";
if (IsExiest ( $data ['excel'] ) == 1) 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
$_limit = '';
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_cash')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account_bank} p4 on p1.bank=p4.id') )->join ( presql ( '{users_info} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_cash')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account_bank} p4 on p1.bank=p4.id') )->join ( presql ( '{users_info} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_cash')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{account_bank} p4 on p1.bank=p4.id') )->join ( presql ( '{users_info} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$charge = M ( 'account_cash')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'sum(total) as all_total,sum(fee) as all_fee')->find ();
$all_total = $charge ['all_total'];
$all_fee = $charge ['all_fee'];
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'all_total'=>$all_total, 'all_fee'=>$all_fee );
return $result;
}
function GetBankList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['keywords'] ) != false) 
{
$_sql .= " and p1.`name` like '%{$data['keywords']}
%'";
}
$_order = "p1.addtime desc ";
if (IsExiest ( $data ['excel'] ) == "true") 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_bank')->alias ( 'p1')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_bank')->alias ( 'p1')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_bank')->alias ( 'p1')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function GetUsersBankList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['keywords'] ) != false) 
{
$_sql .= " and p2.`username` like '%{$data['keywords']}
%'";
}
$_order = "p1.id desc";
$field = "p1.*,p2.username,p3.realname,p4.name as bank_name";
if (IsExiest ( $data ['excel'] ) == "true") 
{
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_users_bank')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->join ( presql ( '`{account_bank}` as p4 on p1.bank=p4.id') )->join ( presql ( '`{approve_realname}` as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'account_users_bank')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->join ( presql ( '`{account_bank}` as p4 on p1.bank=p4.id') )->join ( presql ( '`{approve_realname}` as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->count ();
$total = intval ( $row ['num'] );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_users_bank')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->join ( presql ( '`{account_bank}` as p4 on p1.bank=p4.id') )->join ( presql ( '`{approve_realname}` as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
function GetRechargeList($data = array()) 
{
global $_G;
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
if (IsExiest ( $data ['type'] ) != false ||$data ['type'] == "0") 
{
$_sql .= " and p1.type = '{$data['type']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username = '{$data['username']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username,p3.name as payment_name, p4.realname";
if (IsExiest ( $data ['order'] ) != false) 
{
if ($data ['order'] == "addtime_down") 
{
$_order = "  p1.addtime desc";
}
else 
{
$_order = "  p1.addtime asc";
}
}
else 
{
$_order = "  p1.status asc,p1.addtime desc";
}
if (IsExiest ( $data ['excel'] ) == 1) 
{
$result = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{users_info} as p4 on p4.user_id=p1.user_id') )->join ( presql ( '{payment} as p3 on p1.payment=p3.id') )->field ( $field )->order ( 'p1.addtime desc,p1.id desc')->select ();
$title = array ( "类型", "支付方式", "充值金额", "充值时间", "备注", "状态", "管理备注" );
$linkage_result = $_G ['linkage'];
foreach ( $result as $key =>$value ) 
{
if ($value ['status'] == 1) 
{
if ($value ['type'] == 1) 
{
$value ['type'] = "网上充值";
}
else 
{
$value ['type'] = "线下充值";
}
if ($value ['status'] == 0) 
{
$value ['status'] = "审核中";
}
elseif ($value ['status'] == 1) 
{
$value ['status'] = "充值成功";
}
elseif ($value ['status'] == 2) 
{
$value ['status'] = "充值失败";
}
$_data [$key] = array ( $value ['type'], $value ['payment_name'], $value ['money'], date ( "Y-m-d",$value ['addtime'] ), $value ['remark'], $value ['remark'], $value ['status'], $value ['verify_remark'] );
}
}
self::exportData ( date ( "Y-m-d",time () ) ."成功充值记录详情",$title,$_data );
exit ();
}
elseif (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{users_info} as p4 on p4.user_id=p1.user_id') )->join ( presql ( '{payment} as p3 on p1.payment=p3.id') )->where ( $_sql )->limit ( $_limit )->field ( $field )->order ( $_order )->select ();
}
$row = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{users_info} as p4 on p4.user_id=p1.user_id') )->join ( presql ( '{payment} as p3 on p1.payment=p3.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{users_info} as p4 on p4.user_id=p1.user_id') )->join ( presql ( '{payment} as p3 on p1.payment=p3.id') )->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->field ( $field )->order ( $_order )->select ();
$charge = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'sum(money) as all_balance,sum(fee) as all_fee')->find ();
$all_balance = $charge ['all_balance'];
$all_fee = $charge ['all_fee'];
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'all_fee'=>$all_fee, 'all_balance'=>$all_balance );
return $result;
}
public static function GetRecharge($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = {$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p2.user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid = {$data['nid']}
";
}
$field = "p1.*,p2.username,p2.email,p3.name as payment_name,p4.username as verify_username";
$result = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{payment}` as p3 on p1.payment = p3.id') )->join ( presql ( '`{users}` as p4 on p1.verify_userid=p4.user_id') )->where ( $_sql )->field ( $field )->find ();
return $result;
}
function AddRecharge($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_user_id_empty";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$result = M ( 'account_recharge')->add ( $data );
return $result;
}
function VerifyRecharge($data = array()) 
{
global $MsgInfo;
if (!IsExiest ( $data ['nid'] )) 
{
return "account_nid_empty";
}
$result = M ( 'account_recharge')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{payment}` as p3 on p1.payment=p3.id') )->where ( "p1.`nid`='{$data['nid']}
'")->field ( 'p1.*,p2.username,p3.name as payment_name')->find ();
$recharge_userid = $result ['user_id'];
$recharge_balance = $result ['balance'];
$recharge_money = $result ['money'];
$recharge_fee = $result ['fee'];
$recharge_type = $result ['type'];
$username = $result ['username'];
$payment = $result ['payment_name'];
$id = $result ['id'];
if ($result == false) return "account_recharge_not_exiest";
if ($recharge_type != 2 &&$result ['status'] != 2) 
{
if ($result ['status'] != 0) return "account_recharge_yes_verify";
}
$result = M ( 'account_recharge')->where ( "`nid`='{$data['nid']}
'")->field ( 'count(1) as num')->find ();
if ($result ['num'] >1) return "account_recharge_nid_error";
$sql = "update `{account_recharge}` set status='{$data['status']}
',verify_time='".time () ."',verify_userid='".$data ['verify_userid'] ."',verify_remark='".$data ['verify_remark'] ."' where nid = '{$data['nid']}
'";
M ()->execute ( presql ( $sql ) );
if ($data ['status'] == 1) 
{
$log_info ["user_id"] = $recharge_userid;
$log_info ["nid"] = $data ['nid'];
$log_info ["money"] = $recharge_money;
$log_info ["income"] = $recharge_money;
$log_info ["expend"] = 0;
$log_info ["balance"] = $recharge_money;
$log_info ["balance_cash"] = $recharge_money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "recharge";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "通过{$payment}
充值了{$recharge_money}
元";
$result = self::AddLog ( $log_info );
$user_log ["user_id"] = $recharge_userid;
$user_log ["code"] = "account";
$user_log ["type"] = "recharge";
$user_log ["operating"] = "success";
$user_log ["article_id"] = $data ['nid'];
$user_log ["result"] = 1;
$user_log ["content"] = str_replace ( array ( '#keywords#' ),array ( $username ),$MsgInfo ["account_recharge_userlog_success"] .$log_info ["remark"] );
\usersClass::AddUsersLog ( $user_log );
if ($recharge_type == 2) 
{
$log_info ["user_id"] = $recharge_userid;
$log_info ["nid"] = "recharge_fee_".$data ['nid'];
$log_info ["money"] = $recharge_fee;
$log_info ["income"] = $recharge_fee;
$log_info ["expend"] = 0;
$log_info ["balance"] = $recharge_fee;
$log_info ["balance_cash"] = $recharge_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "recharge_jiangli";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "通过{$payment}
充值奖励金额{$recharge_fee}
元";
$result = self::AddLog ( $log_info );
}
else 
{
$log_info ["user_id"] = $recharge_userid;
$log_info ["nid"] = "recharge_fee_".$data ['nid'];
$log_info ["money"] = $recharge_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $recharge_fee;
$log_info ["balance"] = -$recharge_fee;
$log_info ["balance_cash"] = -$recharge_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "recharge_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "通过{$payment}
充值扣除手续费{$recharge_fee}
元";
$result = self::AddLog ( $log_info );
}
$UsersVip = \usersClass::GetUsersVip ( array ( "user_id"=>$recharge_userid ) );
if ($UsersVip ['status'] == 1) 
{
$fee = 0.6 -$_G ['system'] ['con_account_recharge_vip_fee'];
$web ['money'] = $recharge_money / 100 * $fee;
}
else 
{
$fee = 0.6 -$_G ['system'] ['con_account_recharge_fee'];
$web ['money'] = $recharge_money / 100 * $fee;
}
$web ['user_id'] = $recharge_userid;
$web ['nid'] = "web_recharge_fee_".$recharge_userid ."_".time ();
$web ['type'] = "web_recharge_fee";
$web ['remark'] = "用户充值{$recharge_money}
，网站垫付{$web['money']}
";
self::AddAccountWeb ( $web );
}
return $id;
}
function AddLog($data = array()) 
{
if (!IsExiest ( $data ['nid'] )) return "account_log_nid_exiest";
$result = M ( 'account_log')->where ( "nid = '{$data['nid']}
'")->find ();
if ($result!=null) return "account_log_nid_exiest";
$result = M ( 'account')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == null) 
{
M ( 'account')->add ( array ( 'user_id'=>$data ['user_id'], 'total'=>0 ) );
$result = M ( 'account')->where ( "user_id={$data['user_id']}
")->find ();
}
$sql = "insert into `{account_log}` set ";
$sql .= "nid='{$data['nid']}
',";
$sql .= "user_id='{$data['user_id']}
',";
$sql .= "type='{$data['type']}
',";
$sql .= "money='{$data['money']}
',";
$sql .= "remark='{$data['remark']}
',";
$sql .= "to_userid='{$data['to_userid']}
',";
$sql .= "balance_cash_new='{$data['balance_cash']}
',";
$sql .= "balance_cash_old='{$result['balance_cash']}
',";
$sql .= "balance_cash=balance_cash_new+balance_cash_old,";
$sql .= "balance_frost_new='{$data['balance_frost']}
',";
$sql .= "balance_frost_old='{$result['balance_frost']}
',";
$sql .= "balance_frost=balance_frost_new+balance_frost_old,";
$sql .= "balance_new=balance_cash_new+balance_frost_new,";
$sql .= "balance_old='{$result['balance']}
',";
$sql .= "balance=balance_new+balance_old,";
$sql .= "income_new='{$data['income']}
',";
$sql .= "income_old='{$result['income']}
',";
$sql .= "income=income_new+income_old,";
$sql .= "expend_new='{$data['expend']}
',";
$sql .= "expend_old='{$result['expend']}
',";
$sql .= "expend=expend_new+expend_old,";
$sql .= "frost_new='{$data['frost']}
',";
$sql .= "frost_old='{$result['frost']}
',";
$sql .= "frost=frost_new+frost_old,";
$sql .= "await_new='{$data['await']}
',";
$sql .= "await_old='{$result['await']}
',";
$sql .= "await=await_new+await_old,";
$sql .= "total_old='{$result['total']}
',";
$sql .= "total=balance+frost+await,";
$sql .= " `addtime` = '".time () ."',`addip` = '".get_client_ip () ."'";
M ()->execute ( presql ( $sql ) );
$id = M ()->getLastInsID ();
$sql = "select * from `{account_log}` where user_id={$data['user_id']}
and id={$id}
";
$result = M ( 'account_log')->where ( "user_id={$data['user_id']}
and id={$id}
")->find ();
$udata ['income'] = $result ['income'];
$udata ['expend'] = $result ['expend'];
$udata ['balance_cash'] = $result ['balance_cash'];
$udata ['balance_frost'] = $result ['balance_frost'];
$udata ['frost'] = $result ['frost'];
$udata ['await'] = $result ['await'];
$udata ['balance'] = $result ['balance'];
$udata ['total'] = $result ['total'];
M ( 'account')->where ( "user_id={$data['user_id']}
")->save ( $udata );
$result = M ( 'account_balance')->where ( "`nid` = '{$data['nid']}
'")->find ();
if ($result === null) 
{
$result = M ( 'account_balance')->order ( 'id desc')->find ();
if ($result === null) 
{
$result ['total'] = 0;
$result ['balance'] = 0;
}
$total = $result ['total'] +$data ['income'] +$data ['expend'];
$adata ['total'] = $total;
$adata ['balance'] = $result ['balance'] +$data ['income'] -$data ['expend'];
$adata ['income'] = $data ['income'];
$adata ['expend'] = $data ['expend'];
$adata ['type'] = $data ['type'];
$adata ['money'] = $data ['money'];
$adata ['user_id'] = $data ['user_id'];
$adata ['nid'] = $data ['nid'];
$adata ['remark'] = $data ['remark'];
$adata ['addtime'] = time ();
$adata ['addip'] = get_client_ip ();
M ( 'account_balance')->add ( $adata );
}
$result = M ( 'account_users')->where ( "nid = '{$data['nid']}
'")->find ();
if ($result === null) 
{
$result = M ( 'account_users')->where ( "user_id={$data['user_id']}
")->order ( 'id desc')->find ();
if ($result === null) 
{
$result ['total'] = 0;
$result ['balance'] = 0;
}
$total = $result ['total'] +$data ['income'] +$data ['expend'];
$sql = "insert into `{account_users}` set total='{$total}
',balance={$result['balance']}
+".$data ['income'] ."-".$data ['expend'] .",income='{$data['income']}
',expend='{$data['expend']}
',type='{$data['type']}
',`money`='{$data['money']}
',user_id='{$data['user_id']}
',nid='{$data['nid']}
',remark='{$data['remark']}
', `addtime` = '".time () ."',`addip` = '".get_client_ip () ."',await='{$data['await']}
',frost='{$data['frost']}
'";
M ()->execute ( presql ( $sql ) );
}
return $data ['nid'];
}
function AddBank($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "account_bank_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "account_bank_nid_empty";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'account_bank')->add ( $data );
}
function AddUsersBank($data = array()) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'account_users_bank')->add ( $data );
}
function AddAccountWeb($data = array()) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'account_web')->add ( $data );
}
function UpdateBank($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "account_bank_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
return "account_bank_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "account_bank_nid_empty";
}
$sql .= join ( ",",$_sql ) ." where id='{$data['id']}
'";
M ( 'account_bank')->save ( $data );
return $data ['id'];
}
function UpdateUsersBank($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_bank_userid_empty";
}
self::GetUsersBankOne ( array ( "user_id"=>$data ['user_id'] ) );
$user_id = $data ['user_id'];
unset ( $data ['user_id'] );
M ( 'account_users_bank')->where ( "user_id={$user_id}
")->save ( $data );
return $user_id;
}
function UpdateRecharge($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "请求不合法";
}
M ( 'account_recharge')->save ( $data );
return $data ['id'];
}
function GetOne($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
$_select = presql ( "p1.*,(select sum(total) from {account_cash} where user_id=p1.user_id and status=1) as cash_total,(select sum(money) from {account_recharge} where user_id=p1.user_id and status=1) as recharge_total");
$result = M ( 'account')->alias ( 'p1')->where ( $_sql )->field ( $_select )->find ();
if ($result == false) 
{
$sql = "insert into `{account}` set user_id='{$data['user_id']}
',total=0";
$idata ['user_id'] = $data ['user_id'];
$idata ['total'] = 0;
M ( 'account')->add ( $idata );
$result = M ( 'account')->alias ( 'p1')->where ( $_sql )->field ( $_select )->find ();
}
return $result;
}
function DeleteBank($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "account_bank_id_empty";
}
M ( 'account_bank')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
function DeleteUserBank($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "account_bank_id_empty";
}
M ( 'account_users_bank')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
function GetUsersBankOne($data = array()) 
{
$_sql = " 1=1 ";
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_bank_userid_empty";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$field = "p1.*,p2.username,p2.paypassword,p3.realname,p4.name as bank_name,p5.total,p5.balance,p5.balance_cash";
$result = M ( 'account_users_bank')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->join ( presql ( '`{account_bank}` as p4 on p1.bank=p4.id') )->join ( presql ( '`{account}` as p5 on p1.user_id=p5.user_id') )->join ( presql ( '`{approve_realname}` as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->find ();
if ($result === null) 
{
M ( 'account_users_bank')->add ( array ( 'user_id'=>$data ['user_id'] ) );
}
$result ['account_str'] = self::str_mid_replace ( $result ['account'] );
return $result;
}
function str_mid_replace($string) 
{
if (!$string ||!isset ( $string [1] )) return $string;
$len = strlen ( $string );
$starNum = floor ( $len / 2 );
$noStarNum = $len -$starNum;
$leftNum = ceil ( $noStarNum / 2 );
$rightNum = $noStarNum -$leftNum;
$result = substr ( $string,0,$leftNum );
$result .= str_repeat ( '*',$starNum );
$result .= substr ( $string,$len -$rightNum );
return $result;
}
function GetAccountUsers($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_bank_userid_empty";
}
$result = M ( 'account')->where ( "user_id ={$data['user_id']}
")->find ();
return $result;
}
function exportData($filename,$title,$data) 
{
header ( "Content-type: application/vnd.ms-excel");
header ( "Content-disposition: attachment; filename=".$filename .".xls");
if (is_array ( $title )) 
{
foreach ( $title as $key =>$value ) 
{
echo $value ."\t";
}
}
echo "\n";
if (is_array ( $data )) 
{
foreach ( $data as $key =>$value ) 
{
foreach ( $value as $_key =>$_value ) 
{
echo $_value ."\t";
}
echo "\n";
}
}
}
public static function GetRechargeOne($data = array()) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$where .= " and id = {$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$where .= " and user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$where .= " and nid ='{$data['nid']}
'";
}
$result = M ( 'account_recharge')->where ( $where )->find ();
return $result;
}
public static function GetCashOne($data = array()) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$where .= " and p1.id = {$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$where .= " and p1.user_id = {$data['user_id']}
";
}
$field = "p1.*,p2.username,p2.paypassword,p3.realname,p4.name as bank_name";
$result = M ( 'account_cash')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->join ( presql ( '`{account_bank}` as p4 on p1.bank=p4.id') )->join ( presql ( '`{approve_realname}` as p3 on p1.user_id=p3.user_id') )->where ( $where )->field ( $field )->find ();
return $result;
}
public static function AddCash($data = array()) 
{
global $_G;
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_bank_user_id_empty";
}
$result = M ( 'account')->where ( "user_id={$data['user_id']}
")->field ( 'balance,balance_cash')->find ();
if (IsExiest ( $_G ['system'] ['con_account_balance_cash_status'] ) == 1) 
{
if ($result ['balance_cash'] <$data ['total']) 
{
return "account_cash_max_errot";
}
}
else 
{
if ($result ['balance'] <$data ['total']) 
{
return "account_cash_max_errot";
}
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$id = M ( 'account_cash')->add ( $data );
$log_info ["user_id"] = $data ['user_id'];
$log_info ["nid"] = $data ['nid'];
$log_info ["money"] = $data ['total'];
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = -$data ['total'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = $data ['total'];
$log_info ["await"] = 0;
$log_info ["type"] = "cash";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "申请提现,冻结提现金额{$data['account']}
元";
$result = self::AddLog ( $log_info );
$user_log ["user_id"] = $data ['user_id'];
$user_log ["code"] = "account";
$user_log ["type"] = "cash";
$user_log ["operating"] = "require";
$user_log ["article_id"] = $id;
$user_log ["result"] = 1;
$user_log ["content"] = $log_info ["remark"];
usersClass::AddUsersLog ( $user_log );
return $id;
}
public static function VerifyCash($data = array()) 
{
global $MsgInfo;
if (!IsExiest ( $data ['id'] )) 
{
return "account_cash_id_empty";
}
$result = M ( 'account_cash')->where ( "id={$data['id']}
")->find ();
if ($result == false) return "account_cash_not_exiest";
if ($result ['status'] != 0 &&$result ['status'] != 3) return "account_cash_yes_verify";
$sql = "update `{account_cash}` set status='{$data['status']}
',verify_time='".time () ."',verify_userid='".$data ['verify_userid'] ."',verify_remark='".$data ['verify_remark'] ."' where id = {$data['id']}
";
M ()->execute ( presql ( $sql ) );
$user_id = $result ['user_id'];
$cash_account = $result ['account'];
$cash_credited= $result ['credited'];
$total = $result ['total'];
$cash_fee = $result ['fee'];
$nid = "cash_".$_G ['user_id'] .time () .rand ( 100,999 ) .$data ['status'];
if ($data ['status'] == 1) 
{
$log_info ["user_id"] = $user_id;
$log_info ["nid"] = $nid;
$log_info ["money"] = $cash_credited;
$log_info ["income"] = 0;
$log_info ["expend"] = $cash_credited;
$log_info ["balance"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$cash_credited;
$log_info ["await"] = 0;
$log_info ["type"] = "cash_success";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "提现成功{$cash_account}
元实际到账{$cash_credited}
元";
$result = self::AddLog ( $log_info );
$log_info ["user_id"] = $user_id;
$log_info ["nid"] = "cash_fee_".$nid;
$log_info ["money"] = $cash_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $cash_fee;
$log_info ["balance"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$cash_fee;
$log_info ["await"] = 0;
$log_info ["type"] = "cash_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "提现成功扣除手续费{$cash_fee}
元";
$result = self::AddLog ( $log_info );
$user_log ["user_id"] = $user_id;
$user_log ["code"] = "account";
$user_log ["type"] = "cash";
$user_log ["operating"] = "success";
$user_log ["article_id"] = $data ['id'];
$user_log ["result"] = 1;
$user_log ["content"] = $log_info ["remark"];
\usersClass::AddUsersLog ( $user_log );
}
elseif ($data ['status'] == 2) 
{
$log_info ["user_id"] = $user_id;
$log_info ["nid"] = $nid;
$log_info ["money"] = $total;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $total;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$total;
$log_info ["await"] = 0;
$log_info ["type"] = "cash_false";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "申请{$cash_account}
元提现失败，解冻提现金额{$cash_account}
元";
$result = self::AddLog ( $log_info );
$user_log ["user_id"] = $user_id;
$user_log ["code"] = "account";
$user_log ["type"] = "cash";
$user_log ["operating"] = "false";
$user_log ["article_id"] = $data ['id'];
$user_log ["result"] = 1;
$user_log ["content"] = $log_info ["remark"];
\usersClass::AddUsersLog ( $user_log );
}
return $data ['id'];
}
function GetBank($data = array()) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$where .= " and id = {$data['id']}
";
}
$result = M ( 'account_bank')->where ( $where )->find ();
return $result;
}
function GetAccount($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "account_user_id_empty";
}
$result = M ( 'account')->where ( "user_id={$data['user_id']}
")->find ();
return $result;
}
function OnlineReturn($data = array()) 
{
global $mysql;
$trade_no = $data ['trade_no'];
$user_id = substr ( $trade_no,10,strlen ( $trade_no ) );
$user_id = substr ( $user_id,0,strlen ( $user_id ) -4 );
$rechage_result = self::GetRechargeOne ( array ( "nid"=>$trade_no, "user_id"=>$user_id ) );
if ($rechage_result ['status'] == 2 &&$rechage_result != false) 
{
$user_id = $rechage_result ['user_id'];
$log_info ["user_id"] = $user_id;
$log_info ["nid"] = "online_recharge_".$user_id ."_".time ();
$log_info ["money"] = $rechage_result ['money'];
$log_info ["income"] = $rechage_result ['money'];
$log_info ["expend"] = 0;
$log_info ["balance"] = $rechage_result ['money'];
$log_info ["balance_cash"] = $rechage_result ['money'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "online_recharge";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "在线充值";
$result = self::AddLog ( $log_info );
$log_info ["user_id"] = $user_id;
$log_info ["nid"] = "recharge_fee_".$data ['trade_no'] .$user_id;
$log_info ["money"] = $rechage_result ['fee'];
$log_info ["income"] = 0;
$log_info ["expend"] = $rechage_result ['fee'];
$log_info ["balance"] = -$rechage_result ['fee'];
$log_info ["balance_cash"] = -$rechage_result ['fee'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "recharge_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "充值扣除手续费{$rechage_result['fee']}
元";
$result = self::AddLog ( $log_info );
$rec ['id'] = $rechage_result ['id'];
$rec ['return'] = "充值成功";
$rec ['status'] = 1;
$rec ['verify_userid'] = 0;
$rec ['verify_time'] = time ();
$rec ['verify_remark'] = "成功充值";
self::UpdateRecharge ( $rec );
}
return true;
}
public static function Getborrowjin($data = array()) 
{
$result = M ( 'borrow')->where ( "user_id={$data ['user_id']}
and is_jin=1 and (status =1 or (status =3 and repay_account_yes = 0)) ")->field ( 'account')->find ();
return $result;
}
public static function GetAccoutLogAll($data = array()) 
{
$result = M ( 'account_log')->alias ( 'p1')->join ( presql ( '`{linkage}` as p2 on p1.type=p2.value') )->field ( 'sum(p1.money) as account,count(1) as num,p1.type,p2.name as type_name')->group ( 'p1.type')->select ();
if ($result != null) 
{
foreach ( $result as $key =>$value ) 
{
$_result [$value ['type']] = $value ['account'];
}
}
$_result ["tender_recover"] = $_result ["tender_success_frost"] -$_result ["tender_success"];
return $_result;
}
public static function GetRechargeCount($data = array()) 
{
$_sql = 'status=1';
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id = {$data['user_id']}
";
}
$result = M ( 'account_recharge')->where ( $_sql )->field ( 'sum(money) as account,count(1) as num,type')->group ( 'type')->select ();
if ($result != null) 
{
foreach ( $result as $key =>$value ) 
{
if ($value ['type'] == 2) 
{
$_result ['recharge_all_down'] += $value ['account'];
}
elseif ($value ['type'] == 1) 
{
$_result ['recharge_all_up'] += $value ['account'];
}
else 
{
$_result ['recharge_all_other'] += $value ['account'];
}
$_result ['recharge_all'] += $value ['account'];
}
}
return $_result;
}
public static function GetCashCount($data) 
{
$result = M ( 'account_cash')->where ( "status=1 and user_id={$data['user_id']}
")->field ( 'sum(total) as account,sum(credited) as credited_all,sum(fee) as fee_all,count(1) as num')->find ();
return $result;
}
}
