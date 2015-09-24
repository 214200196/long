
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
include_once 'users.model.php';
require_once ("users.vip.php");
class uadminClass extends usersvipClass 
{
	public static function AddAdmin($data = array()) 
	{
		global $_G;
		if (!IsExiest ( $data ['username'] )) 
		{
			return "users_username_empty";
		}
		if (!IsExiest ( $data ['password'] )) 
		{
			return "users_password_empty";
		}
		if (!IsExiest ( $data ['type_id'] )) 
		{
			return "users_admin_type_name_empty";
		}
		$info = M ( 'admin')->where ( "username='{$data ['username']}
	'")->find ();
	if ($info == NULL) 
	{
		$data ['password'] = md5 ( $data ['password'] );
		$data ['addtime'] = time ();
		$data ['addip'] = get_client_ip ();
		$result = M ( 'admin')->add ( $data );
		$admin_log ["user_id"] = $_G ['user_id'];
		$admin_log ["code"] = "users";
		$admin_log ["type"] = " admin";
		$admin_log ["operating"] = 'add';
		$admin_log ["article_id"] = $result >0 ?$result : 0;
		$admin_log ["result"] = $result >0 ?1 : 0;
		$admin_log ["content"] = '增加管理员';
		$admin_log ["data"] = $data;
		self::AddAdminLog ( $admin_log );
		if ($result) 
		{
			return 'users_admin_add';
		}
		else 
		{
			return 'users_admin_add_not';
		}
	}
	else return 'users_admin_exist';
}
public static function AdminLogin($data) 
{
	global $_A,$MsgInfo;
	if (!IsExiest ( $data ['username'] )) 
	{
		return "users_username_empty";
	}
	if (!IsExiest ( $data ['password'] )) 
	{
		return "users_password_empty";
	}
	$result = M ( 'admin')->where ( "`username` = '{$data['username']}
'")->find ();
if ($result == false ||$result == NULL) 
{
	return "users_admin_login_password_error";
}
else 
{
	$username = $result ['username'];
	$user_id = $result ['id'];
	$type_id = $result ['type_id'];
	$islog = ($result ['password'] == md5 ( $data ['password'] ));
}
$admin_log ["code"] = "users";
$admin_log ["type"] = "admin";
$admin_log ["operating"] = "login";
if ($islog == false) 
{
	$admin_log ["user_id"] = 0;
	$admin_log ["article_id"] = "0";
	$admin_log ["result"] = "0";
	$admin_log ["content"] = str_replace ( array ( '#username#', '#admin_url#' ),array ( $data ['username'], "/admin" ),$MsgInfo ["users_admin_login_password_error_msg"] );
	$admin_log ["data"] = $data;
	self::AddAdminLog ( $admin_log );
	return "users_admin_login_password_error";
}
else 
{
	$admin_log ["user_id"] = $user_id;
	$admin_log ["article_id"] = $result ['id'];
	$admin_log ["result"] = 1;
	$admin_log ["content"] = str_replace ( array ( '#username#', '#admin_url#' ),array ( $data ['username'], '/admin' ),$MsgInfo ["users_admin_login_success_msg"] );
	$admin_log ["data"] = $data;
	self::AddAdminLog ( $admin_log );
	$udata ['logintimes'] = '`logintimes`+1';
	$udata ['login_time'] = time ();
	$udata ['login_ip'] = get_client_ip ();
	M ( 'admin')->where ( "id={$user_id}
")->save ( $udata );
if ($type_id == 1) 
{
	$admin_type_result ['module'] = "all";
	$admin_type_result ['purview'] = "all";
}
else 
{
	$admin_type_result = M ( "admin_type")->where ( "`id`= '{$type_id}
'")->find ();
if ($admin_type_result == false ||$admin_type_result == NULL) return "users_admin_type_empty";
}
return array ( "user_id"=>$user_id, "username"=>$username, "admin_result"=>$result, "purview"=>$admin_type_result ['purview'], "module"=>$admin_type_result ['module'] );
}
}
public static function AddAdminLog($data) 
{
global $mysql;
$data ["data"] = serialize ( $data ["data"] );
$adata ['addtime'] = time ();
$adata ['addip'] = get_client_ip ();
foreach ( $data as $key =>$value ) 
{
$adata [$key] = $value;
}
M ( "adminlog")->add ( $adata );
}
public static function GetAdminlogList($data) 
{
global $mysql;
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id`  = '{$data['user_id']}
'";
$where ['p1.`user_id`'] = $data ['user_id'];
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.`username` like '%{$data['username']}
%'";
$where ['p2.`username`'] = array ( 'like', $data ['username'] );
}
$row = M ( 'adminlog')->alias ( 'p1')->where ( $where )->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id') )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'adminlog')->alias ( 'p1')->where ( $where )->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id') )->field ( 'p1.*,p2.username')->page ( $data ['page'] .",{$data ['epage']}
")->order ( 'p1.id desc')->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function AddAdminType($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['name'] )) 
{
return "users_admin_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "users_admin_type_nid_empty";
}
$sql = "select 1 from `{users_admin_type}` where nid='{$data['nid']}
'";
$result = M ( 'admin_type')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != false) return "users_admin_type_nid_exiest";
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$data ['update_time'] = time ();
$data ['update_ip'] = get_client_ip ();
$data ['module'] = join ( ",",$data ['module'] );
$data ['purview'] = join ( ",",$data ['purview'] );
$result = M ( 'admin_type')->data ( $data )->add ();
return $result;
}
public static function UpdateAdminType($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['name'] )) 
{
return "users_admin_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "users_admin_type_nid_empty";
}
$sql = "select 1 from `{users_admin_type}` where nid='{$data['nid']}
' and id!={$data['id']}
";
$result = M ( 'admin_type')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != false) return "users_admin_type_nid_exiest";
$data ['update_time'] = time ();
$data ['update_ip'] = get_client_ip ();
$data ['module'] = join ( ",",$data ['module'] );
$data ['purview'] = join ( ",",$data ['purview'] );
$result = M ( 'admin_type')->save ( $data );
return $data ['id'];
}
public static function DelAdminType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "users_admin_type_id_empty";
if ($data ['id'] == 1) return "users_admin_type_not_delete";
$result = M('admin')->where("type_id='{$data['id']}
'")->find();
if ($result != null) return "users_admin_type_user_exiest";
$sql = "delete from `{admin_type}`  where id={$data['id']}
";
M()->execute(presql($sql));
return $data ['id'];
}
public static function GetAdminTypeList($data = array()) 
{
$total = M ( 'admin_type')->count ();
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'admin_type')->limit ( $_limit )->order ( '`order` desc,id desc')->select ();
}
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$total_page = ceil ( $total / $data ['epage'] );
$list = M ( 'admin_type')->page ( $data ['page'] .",{$data ['epage']}
")->order ( '`order` desc,id desc')->select ();
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'page'=>$data ['page'], 'epage'=>$data ['epage'], 'total_page'=>$total_page );
return $result;
}
public static function GetAdminTypeOne($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['id'] )) return "users_admin_type_id_empty";
$sql = "select p1.* from `{users_admin_type}` as p1   where p1.id='{$data['id']}
'";
$result = M ( 'admin_type')->alias ( 'p1')->where ( "p1.id={$data['id']}
")->find ();
if ($result == false) return "users_admin_type_empty";
return $result;
}
public static function UpdateUsersAdmin($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['adminname'] )) 
{
return "users_admin_name_empty";
}
if (!IsExiest ( $data ['user_id'] )) 
{
return "users_admin_user_id_empty";
}
$result = M ( 'admin')->where ( "id={$data['user_id']}
")->find ();
if ($result == false ||$result == NULL) 
{
return "users_admin_not";
}
else 
{
if (!IsExiest ( $data ['password'] )) 
{
unset ( $data ['password'] );
}
else 
{
$data ['password'] = md5 ( $data ['password'] );
}
$udata ['update_time'] = time ();
$udata ['update_ip'] = get_client_ip ();
foreach ( $data as $key =>$value ) 
{
if ($key != 'user_id') $udata [$key] = $value;
}
$result = M ( 'admin')->where ( "id={$data['user_id']}
")->save ( $udata );
}
if ($result === false) return $result;
return $data ['user_id'];
}
public static function DeleteUsersAdmin($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "users_admin_user_id_empty";
$sql = "delete from `{users_admin}`  where user_id='{$data['user_id']}
'";
$result = M ( 'admin')->where ( "id={$data['user_id']}
")->delete ();
;
if (!$data) return false;
return $data ['user_id'];
}
public static function GetUsersAdminList($data = array()) 
{
$_select = " p1.*,p2.username,p3.name as type_name";
if (IsExiest ( $data ['type_id'] ) != false) 
{
$condition ['p1.`type_id`'] = $data ['type_id'];
}
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'admin')->alias ( 'p1')->where ( $condition )->join ( presql ( '`{admin_type}` as p3 on p1.type_id=p3.id') )->field ( 'p1.*,p3.name as type_name')->limit ( $_limit )->select ();
}
$row = M ( 'admin')->alias ( 'p1')->where ( $condition )->join ( presql ( '`{admin_type}` as p3 on p1.type_id=p3.id') )->count ();
$total = $row;
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$list = M ( 'admin')->alias ( 'p1')->where ( $condition )->join ( presql ( '`{admin_type}` as p3 on p1.type_id=p3.id') )->field ( 'p1.*,p3.name as type_name')->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'page'=>$data ['page'], 'epage'=>$data ['epage'] );
return $result;
}
public static function GetUsersAdminOne($data = array()) 
{
$result = M ( 'admin')->alias ( 'p1')->join ( presql ( "`{admin_type}` as p2 on p1.type_id=p2.id") )->where ( "p1.id={$data['user_id']}
")->field ( "p2.*,p1.* ")->find ();
return $result;
}
}
