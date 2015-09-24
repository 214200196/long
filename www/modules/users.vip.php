
<?php
class usersvipClass 
{
	public static function GetUsersVipList($data) 
	{
		$_sql = "1=1 ";
		if (IsExiest ( $data ['user_id'] ) != false) 
		{
			$_sql .= " and p1.`user_id`  = '{$data['user_id']}
		'";
	}
	if (IsExiest ( $data ['username'] ) != false) 
	{
		$_sql .= " and p2.`username` like '%".urldecode ( $data ['username'] ) ."%'";
	}
	if (IsExiest ( $data ['vip_type'] ) != false) 
	{
		$_sql .= " and p1.`vip_type` = '{$data['vip_type']}
	'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
	$_sql .= " and p1.`status` = '{$data['status']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
	$_sql .= " and p1.first_date > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
	$_sql .= " and p1.first_date < ".get_mktime ( $dotime2 );
}
}
$field = "p1.*,p2.username,p3.adminname";
$_order = " id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
	$_limit = $data ['limit'];
}
return M ( 'users_vip')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{admin}` as p3 on p1.kefu_userid=p3.id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'users_vip')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{admin}` as p3 on p1.kefu_userid=p3.id') )->where ( $_sql )->count ();
$total = intval ( $row ['num'] );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_vip')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{admin}` as p3 on p1.kefu_userid=p3.id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetUsersVip($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
$result = M ( 'users_vip')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p1.kefu_userid=p2.id') )->join ( presql ( '`{users}` as p3 on p1.user_id=p3.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.adminname,p3.username')->find ();
if ($result == NULL) 
{
$idata ['user_id'] = $data ['user_id'];
M ( 'users_vip')->add ( $idata );
self::GetUsersVip ( $data );
}
else 
{
if ($result ["status"] == 1) 
{
if ($result ["end_date"] != ""&&$result ["end_date"] <time ()) 
{
$result ["status"] = 3;
}
}
return $result;
}
}
public static function GetUsersVipStatus($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
$result = self::GetUsersVip ( $data );
$status = $result ["status"];
if ($result ["status"] == 1) 
{
if ($result ["end_date"] != ""&&$result ["end_date"] <time ()) 
{
$status = 3;
}
}
return $status;
}
public static function UsersVipApply($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
$result = self::GetUsersVip ( $data );
if ($result ["status"] == 1) 
{
return "vip_status_yes";
}
else 
{
if (isset ( $data ['vip_time'] ) &&$data ['vip_time'] >0) 
{
$vip_time = $data ['vip_time'] * 30;
$years = $data ['vip_time'];
}
else 
{
$vip_time = 365;
$years = 12;
}
$udata ['years'] = $years;
$udata ['addtime'] = time ();
$udata ['addip'] = get_client_ip ();
$udata ['kefu_userid'] = $data ['kefu_userid'];
$udata ['remark'] = $data ['remark'];
$udata ['money'] = $data ['money'];
$udata ['vip_type'] = $data ['vip_type'];
$udata ['first_date'] = time ();
$udata ['end_date'] = time () +60 * 60 * 24 * $vip_time;
$udata ['status'] = 1;
$re= M ( 'users_vip')->where ( "user_id={$data['user_id']}
")->save ( $udata );
if($re==0) return false;
return true;
}
}
public static function UpdateUsersVipKefu($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
return M ( 'users_vip')->where ( "user_id={$data['user_id']}
")->save ( $data );
}
public static function CheckUsersVip($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
$result = self::GetUsersVip ( $data );
if ($result ["status"] == 1) 
{
return "users_vip_status_yes";
}
else 
{
$data ['first_date'] = time ();
$data ['end_date'] = time () +60 * 60 * 24 * 365;
M ( 'users_vip')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ['user_id'];
}
}
public static function UpdateUsersVipMoney($data = array()) 
{
if (IsExiest ( $data ['user_id'] ) == "") return false;
return M ( 'users_vip')->where ( "user_id={$data['user_id']}
")->save ( $data );
}
}
