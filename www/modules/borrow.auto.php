<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

class autoClass extends borrowChangeClass 
{
	public static function GetAutoOne($data) 
	{
		$user_id = $data ['user_id'];
		if (IsExiest ( $data ['user_id'] ) == ""||IsExiest ( $data ['id'] ) == "") return -1;
		return M ( 'borrow_auto')->where ( "user_id={$data['user_id']}
	and id={$data['id']}
")->find ();
}
public static function UpdateAuto($data = array()) 
{
$user_id = $data ['user_id'];
if (IsExiest ( $user_id ) == ""||IsExiest ( $data ['id'] ) == "") return -1;
$data ['updatetime'] = time ();
return M ( 'borrow_auto')->where ( "user_id = {$user_id}
and id={$data['id']}
")->save ( $data );
}
public static function AddAuto($data = array()) 
{
$user_id = $data ["user_id"];
if (!isset ( $user_id )) return -1;
$result = M ( 'borrow_auto')->where ( "user_id={$user_id}
")->field ( 'count(*) as num')->find ();
if ($result ["num"] >= 3) 
{
return -2;
}
else 
{
$data ['updatetime'] = time ();
$result = M ( 'borrow_auto')->add ( $data );
if ($result) 
{
return 1;
}
else 
{
return -1;
}
}
}
public static function GetAutoList($data = array()) 
{
$_sql = "1=1 ";
if (isset ( $data ['status'] ) &&$data ['status'] != "") 
{
$_sql .= " and p1.status = {$data['status']}
";
}
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
if (isset ( $data ['username'] ) &&$data ['username'] != "") 
{
$_sql .= " and p2.username like '%{$data['username']}
%' ";
}
if (isset ( $data ['type'] ) &&$data ['type'] != "") 
{
$_sql .= " and p1.type like '%{$data['type']}
%' ";
}
$field = 'p1.*,p2.username';
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$result = M ( 'borrow_auto')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
return $result;
}
$row = M ( 'borrow_auto')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_auto')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$list = $list ?$list : array ();
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function DelAuto($data) 
{
if ($data ["id"] == ""||$data ["user_id"] == "") 
{
return -1;
}
$sql = "delete from `{borrow_auto}` where user_id={$data['user_id']}
and id={$data['id']}
";
$result = M ()->execute ( presql ( $sql ) );
if ($result) return 1;
return -2;
}
public static function AutoTender($data) 
{
$borrow_nid = $data ["borrow_nid"];
if (IsExiest ( $borrow_nid ) == "") 
{
return "borrow_nid_empty";
}
$_return = array ();
$borrow_result = M ( 'borrow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.borrow_nid='{$borrow_nid}
'")->field ( 'p1.*')->find ();
$credit = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$borrow_result ['user_id'] ) );
$result = M ( 'borrow_auto')->where ( "status=1 and user_id!={$borrow_result['user_id']}
")->select ();
foreach ( $result as $key =>$value ) 
{
$vip = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
$tender_status = 1;
$tender_account = $value ['tender_account'];
if ($value ['tender_type'] == 1 &&$value ['tender_account'] <$borrow_result ["tender_account_min"]) 
{
$tender_status = 0;
}
if ($value ['tender_type'] == 1 &&$value ['tender_account'] >$borrow_result ["tender_account_max"]) 
{
$value ['tender_account'] = $borrow_result ["tender_account_max"];
}
if ($value ['tender_type'] == 2) 
{
$value ['tender_account'] = round ( $borrow_result ["account"] * 0.01 * $value ['tender_scale'],2 );
if ($value ['tender_account'] <50) 
{
$tender_account = 50;
}
else 
{
$tender_account = $value ['tender_account'];
}
}
if ($value ['my_friend'] == 1) 
{
$_sql = "select * from `{users_friends}` where user_id='{$borrow_result['user_id']}
' and friends_userid='{$value['user_id']}
'";
$_result = M ( 'users_friends')->where ( "user_id='{$borrow_result['user_id']}
' and friends_userid='{$value['user_id']}
'")->find ();
if ($_result == null) 
{
$tender_status = 0;
}
}
if ($value ['late_status'] == 1) 
{
$_result = M ( 'borrow_repay')->where ( "user_id='{$borrow_result['user_id']}
' and repay_yestime < ".time () )->count ();
if ($_result >= $value ['late_times']) 
{
$tender_status = 0;
}
}
if ($value ['dianfu_status'] == 1) 
{
$_result = M ( 'borrow_repay')->where ( "user_id='{$borrow_result['user_id']}
' and repay_web=1")->count ();
if ($_result >= $value ['dianfu_times']) 
{
$tender_status = 0;
}
}
if ($value ['not_late_black'] == 1) 
{
$late_day = 60 * 60 * 30 * 24 +time ();
$_result = M ( 'borrow_repay')->where ( "user_id='{$borrow_result['user_id']}
' and repay_status=0 and repay_yestime < ".$late_day )->count ();
if ($_result >0) 
{
$tender_status = 0;
}
}
if ($value ['borrow_credit_status'] == 1) 
{
if ($value ['borrow_credit_first'] != ""&&$value ['borrow_credit_first'] >$credit ['approve_credit']) 
{
$tender_status = 0;
}
if ($value ['borrow_credit_last'] != ""&&$value ['borrow_credit_last'] <$credit ['approve_credit']) 
{
$tender_status = 0;
}
}
if ($value ['borrow_style_status'] == 1 &&$value ['borrow_style'] != $borrow_result ['borrow_style']) 
{
$tender_status = 0;
}
if ($value ['timelimit_status'] == 1 &&($value ['timelimit_month_first'] >$borrow_result ['borrow_period'] ||$value ['timelimit_month_last'] <$borrow_result ['borrow_period'])) 
{
$tender_status = 0;
}
if ($value ['apr_status'] == 1 &&($value ['apr_first'] >$borrow_result ['borrow_apr'] ||$value ['apr_last'] <$borrow_result ['borrow_apr'])) 
{
$tender_status = 0;
}
if ($value ['award_status'] == 1) 
{
if ($borrow_result ['award_status'] == 0) 
{
$tender_status = 0;
}
elseif ($borrow_result ['award_status'] == 1) 
{
$award_scale = round ( $borrow_result ['award_account'] / $borrow_result ['account'],2 );
if ($award_scale <$value ['award_first'] ||$award_scale >$value ['award_last']) 
{
$tender_status = 0;
}
}
elseif ($borrow_result ['award_status'] == 2) 
{
if ($borrow_result ['award_scale'] <$value ['award_first'] ||$borrow_result ['award_scale'] >$value ['award_last']) 
{
$tender_status = 0;
}
}
}
if ($value ['vouch_status'] == 1 &&$borrow_result ['vouchstatus'] != 1) 
{
$tender_status = 0;
}
if ($value ['tuijian_status'] == 1 &&$borrow_result ['fast_status'] != 1) 
{
$tender_status = 0;
}
if ($vip ['status'] != 1 &&$borrow_result ['vouchstatus'] == 1) 
{
$tender_status = 0;
}
if ($vip ['status'] != 1 &&$borrow_result ['fast_status'] == 1) 
{
$tender_status = 0;
}
if ($tender_status == 1) 
{
$_return [$value ['user_id']] = $tender_account;
}
}
return $_return;
}
}
