<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

global $MsgInfo;
include_once 'users.model.php';
class usersClass extends usersvipClass 
{
	public static function UpdateEmail($data = array()) 
	{
		global $_G,$MsgInfo;
		if (!IsExiest ( $data ['user_id'] )) 
		{
			return "users_userid_empty";
		}
		if (!IsExiest ( $data ['email'] )) 
		{
			return "users_email_empty";
		}
		if (self::CheckEmail ( array ( "email"=>$data ['email'], "user_id"=>$data ['user_id'] ) )) 
		{
			return "users_email_exist";
		}
		$result =M('users')->where("user_id={$data['user_id']}
	")->setField('email',$data ['email'] );
	if ($result == false||$result==0) 
	{
		return "users_email_exist";
	}
	else 
	{
		return 1;
	}
}
public static function AddCare($data) 
{
	$care =M('users_care')->where("article_id={$data['article_id']}
and user_id={$data['user_id']}
")->find();
if ($care == null) 
{
$data['addtime']=time();
$data['addip']=get_client_ip();
$result=M('users_care')->add($data);
if($result==false) return -1;
return $result;
}
else 
{
return -2;
}
}
public static function GetFriendsList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id` = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['friends_userid'] ) != false) 
{
$_sql .= " and p1.`friends_userid` = '{$data['friends_userid']}
'";
}
$field = "p1.*,p2.username,p3.username as friendname,p4.niname as friendniname";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_friends')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'users_friends')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_friends')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetFriendsInvite($data) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id`  = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['friends_userid'] ) != false) 
{
$_sql .= " and p1.`friends_userid`  = '{$data['friends_userid']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p3.`username` = '".urldecode ( $data ['username'] ) ."'";
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
if (IsExiest ( $data ['spread_name'] ) != false) 
{
$_sql .= " and p2.`username` = '".urldecode ( $data ['spread_name'] ) ."'";
}
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.`status`  = '{$data['status']}
'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.`type`  = '{$data['type']}
'";
}
$field = "p1.*,p2.username,p3.email,p3.username as friend_username,p3.reg_time as friend_reg_time,p4.niname as friendniname";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_friends_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id = p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'users_friends_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id = p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->count ();
$total = intval ( $row ['num'] );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_friends_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id = p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.friends_userid = p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.friends_userid = p4.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
foreach ( $list as $key =>$value ) 
{
$list [$key] ['credit'] = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$list [$key] ['vip'] = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetCareList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id`  = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['article_id'] ) != false) 
{
$_sql .= " and p1.`article_id` = '{$data['article_id']}
'";
}
if (IsExiest ( $data ['code'] ) != false) 
{
$_sql .= " and p1.`code` like '%{$data['code']}
%'";
}
$field = "p1.*,p2.*,p2.user_id as borrow_user,p3.username,p4.username as borrow_username";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_care')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.article_id = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p1.user_id = p3.user_id') )->join ( presql ( '`{users}` as p4 on p2.user_id = p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'users_care')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.article_id = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p1.user_id = p3.user_id') )->join ( presql ( '`{users}` as p4 on p2.user_id = p4.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_care')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.article_id = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p1.user_id = p3.user_id') )->join ( presql ( '`{users}` as p4 on p2.user_id = p4.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
;
foreach ( $list as $key =>$value ) 
{
$list [$key] ["credit"] = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$value ['borrow_user'] ) );
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetLoginLog($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "false";
$_order = 'addtime desc';
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_log')->where ( "user_id={$data['user_id']}
")->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'users_log')->where ( "user_id={$data['user_id']}
")->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_log')->where ( "user_id={$data['user_id']}
")->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function UpdateUsers($data = array()) 
{
if ($data ['user_id'] == "") return false;
$sql .= "where ";
return M ( 'users')->where ( "user_id={$data['user_id']}
")->save ( $data );
}
public static function GetUsersList($data) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and `user_id`  = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and `username` = '".urldecode ( $data ['username'] ) ."'";
}
if (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and `email` like '%{$data['email']}
%'";
}
$_order = "user_id desc";
if (IsExiest ( $data ['order'] ) != "") 
{
$order = $data ['order'];
if ($order == "last_time") 
{
$_order = "last_time desc";
}
if ($order == "reg_time") 
{
$_order = "reg_time desc";
}
}
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'users')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'total'=>$row ) ;
return $result;
}
public static function AddExamine($data = array()) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'examines')->add ( $data );
}
public static function GetUsersInfoList($data = array()) 
{
$_sql = "1=1 ";
$field = " p1.*,p2.username,p3.`name` as type_name,p4.status as vip_status,p5.user_id as invite_user_id,p6.username as invite_username";
$_order = "p1.id desc";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['phone_status'] ) != false) 
{
$_sql .= " and p1.phone_status = '".$data ['phone_status'] ."'";
}
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users_vip}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_friends_invite}` as p5 on p5.friends_userid=p1.user_id') )->join ( presql ( '`{users}` as p6 on p5.user_id=p6.user_id') )->where ( $_sql )->limit ( $_limit )->order ( $_order )->field ( $field )->select ();
}
$row = M ( 'users_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users_vip}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_friends_invite}` as p5 on p5.friends_userid=p1.user_id') )->join ( presql ( '`{users}` as p6 on p5.user_id=p6.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users_vip}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_friends_invite}` as p5 on p5.friends_userid=p1.user_id') )->join ( presql ( '`{users}` as p6 on p5.user_id=p6.user_id') )->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->field ( $field )->select ();
if ($list != false) 
{
foreach ( $list as $key =>$value ) 
{
$list [$key] ["user_credit"] = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
}
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetUsersview($data = array()) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$where .= " and p1.`user_id`  = '{$data['user_id']}
'";
}
elseif (IsExiest ( $data ['username'] ) != false &&IsExiest ( $data ['email'] ) != false) 
{
$where .= " and p1.`username` = '{$data['username']}
' and p1.`email` = '{$data['email']}
' ";
}
elseif (IsExiest ( $data ['username'] ) != false) 
{
$where .= " and p1.`username` = '{$data['username']}
'";
}
elseif (IsExiest ( $data ['email'] ) != false) 
{
$where .= " and p1.`email` = '{$data['email']}
'";
}
$field = "p1.*,p2.total,p2.income,p2.expend,p2.balance,p2.balance_cash,p2.balance_frost,p2.frost,p2.await,p3.realname,p3.sex,p3.birthday,p4.credit,p5.card_id ";
return M ( 'users')->alias ( 'p1')->join ( presql ( '`{account}` as p2 on p2.user_id=p1.user_id') )->join ( presql ( '`{users_info}` as p3 on p3.user_id=p1.user_id') )->join ( presql ( '`{credit}` as p4 on p4.user_id=p1.user_id') )->join ( presql ( '`{approve_realname}` as p5 on p5.user_id=p1.user_id') )->where ( $where )->field ( $field )->find ();
}
public static function GetUsersTypeCheck() 
{
$result = M ( 'users_type')->where ( 'checked=1')->find ();
if ($result == false ||$result == NULL) return "users_type_empty";
return $result;
}
public static function AddUsers($data = array()) 
{
global $_G,$MsgInfo;
if (!IsExiest ( $data ['username'] )) 
{
return "users_username_empty";
}
if (strlen ( $data ['username'] ) >15) 
{
return "users_username_long15";
}
if (!IsExiest ( $data ['password'] )) 
{
return "users_password_empty";
}
if (!IsExiest ( $data ['email'] )) 
{
return "users_email_empty";
}
if (strlen ( $data ['email'] ) >32) 
{
return "users_email_long32";
}
if (self::CheckUsername ( array ( "username"=>$data ['username'] ) )) 
{
return "users_username_exist";
}
if (self::CheckEmail ( array ( "email"=>$data ['email'] ) )) 
{
return "users_email_exist";
}
$data ['password'] = md5 ( $data ['password'] );
$data ['reg_time'] = time ();
$data ['reg_ip'] = get_client_ip ();
$data ['up_time'] = time ();
$data ['up_ip'] = get_client_ip ();
$result = M ( 'users')->add ( $data );
if (!$result) 
{
return "users_add_error";
}
else 
{
$user_id = $result;
$result_users_type = M ( 'users_type')->where ( 'checked=1')->find ();
$idata ['user_id'] = $user_id;
$idata ['type_id'] = $result_users_type ['id'];
M ( 'users_info')->add ( $idata );
return $user_id;
}
}
public static function RegUsers($data = array()) 
{
global $_G,$MsgInfo;
if (!IsExiest ( $data ['username'] )) 
{
return "users_username_empty";
}
if (strlen ( $data ['username'] ) >15) 
{
return "users_username_long15";
}
if (!IsExiest ( $data ['niname'] )) 
{
return "users_niname_empty";
}
if (strlen ( $data ['niname'] ) >15) 
{
return "users_niname_long15";
}
if (!IsExiest ( $data ['password'] )) 
{
return "users_password_empty";
}
if (!IsExiest ( $data ['email'] )) 
{
return "users_email_empty";
}
if (strlen ( $data ['email'] ) >32) 
{
return "users_email_long32";
}
if (self::CheckUsername ( array ( "username"=>$data ['username'] ) )) 
{
return "users_username_exist";
}
if (self::CheckEmail ( array ( "email"=>$data ['email'] ) )) 
{
return "users_email_exist";
}
if ($data ['password'] != $data ['confirm_password']) 
{
return "users_password_error";
}
else 
{
unset ( $data ['confirm_password'] );
}
$password = $data ['password'];
$data ['password'] = md5 ( $data ['password'] );
$niname=$data['niname'];
unset($data['niname']);
$data ['reg_time'] = time ();
$data ['reg_ip'] = get_client_ip ();
$data ['up_time'] = time ();
$data ['up_ip'] = get_client_ip ();
$data ['last_time'] = time ();
$data ['last_ip'] = get_client_ip ();
$result = M ( 'users')->add ( $data );
if (!$result) 
{
return "users_add_error";
}
else 
{
$user_id = $result;
$result_users_type = M ( 'users_type')->where ( 'checked=1')->find ();
$idata ['user_id'] = $user_id;
$idata ['type_id'] = $result_users_type ['id'];
$idata['niname']=$niname;
M ( 'users_info')->add ( $idata );
return $user_id;
}
}
public static function CheckEmail($data = array()) 
{
if (!IsExiest ( $data ['email'] )) 
{
return false;
}
$_sql = "";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql = " and user_id!= {$data['user_id']}
";
}
$result = M ( 'users')->where ( "email = '{$data['email']}
' ".$_sql )->find ();
if ($result == false ||$result == NULL) return false;
return true;
}
public function CheckNiname($data = array())
{
if (!IsExiest ( $data ['niname'] )) 
{
return false;
}
$result=M('users_info')->where("niname={$data ['niname']}
")->find();
if ($result == false ||$result == NULL) return false;
return true;
}
public static function CheckUsername($data = array()) 
{
if (!IsExiest ( $data ['username'] )) 
{
return false;
}
$_sql = "";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql = " and user_id!= {$data['user_id']}
";
}
$result = M ( 'users')->where ( " username = '{$data['username']}
' $_sql")->find ();
if ($result == false ||$result == NULL) return false;
return true;
}
public static function CheckRealname($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['realname'] )) 
{
return false;
}
$_sql = "";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql = " and user_id!= {$data['user_id']}
";
}
$result = M ( 'users_info')->where ( "realname = '{$data['realname']}
' and realname_status=1 $_sql")->find ();
if ($result == false ||$result == NULL) return false;
return true;
}
public static function CheckPhone($data = array()) 
{
if (!IsExiest ( $data ['phone'] )) 
{
return false;
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql = " and user_id!= {$data['user_id']}
";
}
$result = M ( 'users_info')->where ( "phone= '{$data['phone']}
' and phone_status=1 $_sql")->find ();
if ($result == false ||$result == NULL) return false;
return true;
}
public static function GetUsers($data = array()) 
{
$mysql = M ( "users");
$_sql = "  1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id`  = '{$data['user_id']}
'";
}
elseif (IsExiest ( $data ['username'] ) != false &&IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and p1.`username` = '{$data['username']}
' and p1.`email` = '{$data['email']}
' ";
}
elseif (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p1.`username` = '{$data['username']}
'";
}
elseif (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and p1.`email` = '{$data['email']}
'";
}
$result = $mysql->alias ( 'p1')->where ( $_sql )->find ();
return $result;
}
public static function UpdatePayPassword($data = array()) 
{
global $_G,$MsgInfo;
if (!IsExiest ( $data ['user_id'] )) 
{
return "users_userid_empty";
}
if (!IsExiest ( $data ['paypassword'] )) 
{
return "users_paypassword_empty";
}
$user_id = $data ['user_id'];
$result = M ( 'users')->where ( "user_id={$user_id}
")->find ();
if ($result == null) 
{
return "users_user_not_exiest";
}
else 
{
$username = $result ['username'];
}
$result = M ( 'users')->where ( "user_id = {$user_id}
")->setField ( 'paypassword',md5 ( $data ['paypassword'] ) );
return $data ['user_id'];
}
public static function UpdatePassword($data = array()) 
{
global $_G,$MsgInfo;
if (!IsExiest ( $data ['user_id'] )) 
{
return "users_userid_empty";
}
if (!IsExiest ( $data ['password'] )) 
{
return "users_password_empty";
}
$user_id = $data ['user_id'];
$result = M ( 'users')->field ( 'username')->where ( "user_id={$user_id}
")->find ();
if ($result == null) 
{
return "users_user_not_exiest";
}
else 
{
$username = $result ['username'];
}
$result = M ( 'users')->where ( "`user_id` ={$user_id}
")->setField ( 'password',md5 ( $data ['password'] ) );
if ($result == false||$result==0) 
{
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "users";
$admin_log ["type"] = "password";
$admin_log ["operating"] = "update";
$admin_log ["article_id"] = $user_id;
$admin_log ["result"] = 0;
$admin_log ["content"] = str_replace ( array ( '#username#' ),array ( $username ),$MsgInfo ["users_update_password_error_msg"] );
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
return false;
}
else 
{
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "users";
$admin_log ["type"] = "password";
$admin_log ["operating"] = "update";
$admin_log ["article_id"] = $user_id;
$admin_log ["result"] = 1;
$admin_log ["content"] = str_replace ( array ( '#username#' ),array ( $username ),$MsgInfo ["users_update_password_success_msg"] );
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}
return $result;
}
public static function GetUsersInfo($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "users_info_userid_empty";
}
$_result = M ( "approve_flow")->where ( 'user_id='.$data ['user_id'] )->find ();
$mysql = M ( 'users_info');
$result = $mysql->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result != false &&$result != NULl) 
{
$result ['flow_status'] = $_result ['status'];
$result_email = self::GetEmailActiveOne ( array ( "user_id"=>$data ['user_id'] ) );
$result ['email_status'] = $result_email ['status'];
}
return $result;
}
public static function GetEmailActiveOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "users_user_id_empty";
$result = M ( "users_email_active")->where ( "user_id={$data['user_id']}
")->find ();
if ($result == false ||$result == null) return false;
return $result;
}
public static function GetInvite($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['invite_code'] ) != false) 
{
$_sql .= " and `invite_code`  = '{$data['invite_code']}
'";
}
else 
{
return false;
}
$re=M ( 'users_info')->where ( $_sql )->find ();
if($re==null||$re==false) return false;
return $re;
}
public static function UpdateUsersType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "users_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "users_type_nid_empty";
}
$result = M ( 'users_type')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != false) return "users_type_nid_exiest";
if ($data ['checked'] == 1) 
{
$sql = "update `{users_type}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
}
M ( 'users_type')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function UpdateUsersTypeChecked($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "users_type_id_empty";
$sql = "update `{users_type}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
M ( 'users_type')->where ( "id={$data['id']}
")->setField ( 'checked',1 );
return $data ['id'];
}
public static function DelUsersType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "users_type_id_empty";
$result = M ( 'users_info')->where ( "type_id={$data['id']}
")->find ();
if ($result != null) return "users_type_upfiles_exiest";
M ( 'users_type')->where ( " id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function GetUsersTypeOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "users_type_id_empty";
$sql = "select p1.* from `{}` as p1   where p1.";
$result = M ( 'users_type')->where ( "id={$data['id']}
")->find ();
if ($result == false) return "users_type_empty";
return $result;
}
public static function AddUsersType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "users_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "users_type_nid_empty";
}
if ($data ['checked'] == 1) 
{
$sql = "update `{users_type}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
}
$result = M ( 'users_type')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != false) return "users_type_nid_exiest";
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'users_type')->add ( $data );
}
public static function GetExamineList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$field = " p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'examines')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p2.id=p1.verify_userid') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'examines')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p2.id=p1.verify_userid') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'examines')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p2.id=p1.verify_userid') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetUsersTypeList($data = array()) 
{
$_sql = " 1=1 ";
$field = " p1.*";
$_order = "p1.checked desc ,p1.`order` desc,p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_type')->alias ( 'p1')->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'users_type')->alias ( 'p1')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_type')->alias ( 'p1')->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function UpdateUsersInfo($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "users_info_userid_empty";
}
$sql = "select 1 from `{users_info}` where user_id='{$data['user_id']}
' ";
$result = M ( 'users_info')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == false ||$result == NULL) 
{
$udata ['user_id'] = $data ['user_id'];
M ( 'users_info')->add ( $udata );
}
M ( 'users_info')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ['user_id'];
}
public static function SendEmail($data = array()) 
{
global $_G;
$user_id = 0;
$email = "";
if ($data ['user_id'] >0) 
{
$result = M ( 'users')->where ( "user_id={$data['user_id']}
")->find ();
$email = $result ['email'];
$user_id = $data ['user_id'];
}
else 
{
$email = $data ['email'];
}
$title = isset ( $data ['title'] ) ?$data ['title'] : '系统信息';
$msg = isset ( $data ['msg'] ) ?$data ['msg'] : '系统信息';
$type = isset ( $data ['type'] ) ?$data ['type'] : 'system';
if ($data ['email_info'] == "") 
{
$var = array ( "con_email_host", "con_email_url", "con_email_auth", "con_email_from", "con_email_from_name", "con_email_password", "con_email_port", "con_email_now" );
foreach ( $var as $key =>$value ) 
{
$data ['email_info'] [$value] = $_G ['system'] [$value];
}
$send_email = $data ['email_info'] ['con_email_from'];
}
$email_info = isset ( $data ['email_info'] ) ?$data ['email_info'] : '';
if ($_G ['system'] ['con_email_now'] == 1 ||$type == "set") 
{
$result = \Mail::Send ( $title,$msg,array ( $email ) );
$status = $result ?1 : 2;
}
else 
{
$status = 0;
}
if ($email_info == "") 
{
$send_email = $_G ['system'] ['con_email_from'];
}
else 
{
$send_email = $_G ['system'] ['con_email_from'];
}
$idata ['email'] = $email;
$idata ['send_email'] = $send_email;
$idata ['user_id'] = $user_id;
$idata ['title'] = $title;
$idata ['msg'] = $msg;
$idata ['type'] = $type;
$idata ['status'] = $status;
$idata ['addtime'] = time ();
$idata ['addip'] = get_client_ip ();
M ( 'users_email_log')->add ( $idata );
if ($status == 1) return true;
return false;
}
public static function GetUsersEmailLog($data = array()) 
{
$_sql = "  1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and `id`  = '{$data['id']}
'";
}
return M ( 'users_email_log')->where ( $_sql )->order('id desc')->find ();
}
public static function GetEmailLogList($data = array()) 
{
$_sql = "  1=1 ";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.`username` like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and p1.`email` like '%{$data['email']}
%'";
}
$_select = "p1.*,p2.username";
$_order = " id desc";
$join = presql ( '`{users}` as p2 on p1.user_id=p2.user_id');
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_email_log')->alias ( 'p1')->where ( $_sql )->join ( $join )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'users_email_log')->alias ( 'p1')->where ( $_sql )->join ( $join )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_email_log')->alias ( 'p1')->where ( $_sql )->join ( $join )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetEmailActiveList($data) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.`username` like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id` = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and p1.`email` like '%{$data['email']}
%'";
}
$_select = "p1.*,p2.username";
$_order = "id desc";
$sql = "select SELECT from `{users_email_active}` as p1 left join `{users}` as p2 on p1.user_id=p2.user_id SQL ORDER LIMIT";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'users_email_active')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'users_email_active')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_email_active')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function ActiveUsersEmail($data = array()) 
{
$user_id = isset ( $data ['user_id'] ) ?$data ['user_id'] : '';
if (empty ( $user_id )) return "users_active_error";
$result = M ( 'users')->where ( "user_id={$data['user_id']}
")->find ();
$email = $result ['email'];
$result = M ( 'users_email_active')->where ( "user_id={$data['user_id']}
and email='{$email}
'")->find ();
if ($result == NULL||$result['status']==0) 
{
if($result['status']==0&&$result['status']!=NULL) 
{
M('users_email_active')->where("user_id={$data['user_id']}
")->setField('status',1);
return "users_active_success";
}
else
{
$idata ['email'] = $email;
$idata ['user_id'] = $user_id;
$idata ['status'] = 1;
$idata ['addtime'] = time ();
$idata ['addip'] = get_client_ip ();
M ( 'users_email_active')->add ( $idata );
return "users_active_success";
}
}
else 
{
return "users_active_yes";
}
}
public static function AddUsersLog($data) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'users_log')->add ( $data );
}
public static function Login($data = array()) 
{
global $MsgInfo,$_G;
$username = isset ( $data ['username'] ) ?$data ['username'] : "";
$password = isset ( $data ['password'] ) ?$data ['password'] : "";
if ($password == "") return "users_password_empty";
$result = M ( 'users')->alias ( 'p1')->join ( presql ( '{users_info} as p2 on p1.user_id=p2.user_id ') )->where ( "p1.`password` = '".md5 ( $password ) ."' and p1.username = '{$username}
'")->find ();
if ($result == null) 
{
$user_log ["user_id"] = 0;
$user_log ["code"] = "users";
$user_log ["type"] = "action";
$user_log ["operating"] = "login";
$user_log ["article_id"] = 0;
$user_log ["result"] = 0;
$user_log ["content"] = str_replace ( array ( '#keywords#' ),array ( $data ['username'] ),$MsgInfo ["users_login_error_msg"] );
self::AddUsersLog ( $user_log );
return "users_login_error";
}
else 
{
if ($result ['status'] != 1) 
{
return "users_login_lock";
}
$user_id = $result ['user_id'];
$updata ['logintime'] = $result ['logintime'] +1;
$updata ['up_time'] = $result ['last_time'];
$updata ['up_ip'] = $result ['last_ip'];
$updata ['last_time'] = time ();
$updata ['last_ip'] = get_client_ip ();
M ( 'users')->where ( "username='$username'")->save ( $updata );
$user_log ["user_id"] = $user_id;
$user_log ["code"] = "users";
$user_log ["type"] = "action";
$user_log ["operating"] = "login";
$user_log ["article_id"] = $user_id;
$user_log ["result"] = 1;
$user_log ["content"] = $MsgInfo ["users_login_success_msg"];
self::AddUsersLog ( $user_log );
return $user_id;
}
}
public static function GetUserid($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ={$data['user_id']}
";
}
elseif (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and username = '{$data['username']}
'";
}
elseif (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and email = '{$data['email']}
'";
}
$result = M ( 'users')->where ( $_sql )->field ( 'user_id')->find ();
if ($result == false ||(!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] ) &&!IsExiest ( $data ['email'] ))) 
{
return "users_empty";
}
return $result ['user_id'];
}
}
