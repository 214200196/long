<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
$message_type = array ( "all"=>"所有用户", "group"=>"群组", "users"=>"多用户", "user"=>"个人", "user_type"=>"用户类型", "admin_type"=>"管理类型" );
global $MsgInfo,$_A;
$_A ['message_type'] = $message_type;
require_once ("message.model.php");
class messageClass 
{
	public static function GetMessageOne($data = array()) 
	{
		if (!IsExiest ( $data ['id'] )) return "message_id_empty";
		$result = M('message')->alias('p1')->join ( presql ( '`{users_info}` as p2 on p1.receive_value=p2.user_id') )->where("p1.id={$data['id']}
	and p1.user_id={$data ['user_id']}
")->field('p1.*,p2.niname as receive_nikename')->find();
if ($result == null) return "message_empty";
return $result;
}
public static function ActionMessageReceive($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "message_receive_id_empty";
if (!IsExiest ( $data ['user_id'] )) return "message_receive_user_id_empty";
foreach ( $data ['id'] as $key =>$value ) 
{
	$_data ['id'] = $value;
	$_data ['user_id'] = $data ['user_id'];
	$_result = self::GetMessageReceiveOne ( $_data );
	$sql = "update `{message_receive}` set status='{$data['status']}
' where user_id={$data['user_id']}
and (id={$value}
 or receive_value='{$value}
')";
M ()->execute ( presql ( $sql ) );
}
return $data ['user_id'];
}
public static function GetUsersMessage($data = array()) 
{
$_sql = "1=1 ";
if ($data ['status'] != ""||$data ['status'] == "0") 
{
$_sql .= " and p1.status='{$data['status']}
'";
}
$receive_result = 1;
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$result =M('users')->alias('p1')->join(presql('`{users_info}` as p2 on p1.user_id=p2.user_id'))->where("p1.user_id ={$data['user_id']}
")->field('p1.user_id,p1.username,p2.type_id')->find();
if ($result == null) 
{
$receive_result = "";
}
else 
{
if(!isset($data['username'])||$data['username']=='') $data['username']=$result['username'];
$receive_result = $result;
$_sql .= " and (p1.user_id='{$result['user_id']}
' or (p1.type='all' and  !find_in_set('{$result['user_id']}
',receive_yes)) or ( p1.type='users' and  find_in_set('{$data['username']}
',receive_value) and  !find_in_set('{$result['user_id']}
',receive_yes)) or (p1.type='user_type' and  p1.receive_id='{$result['type_id']}
'  and  !find_in_set('{$result['user_id']}
',receive_yes)) )";
}
}
$field = "COUNT(*) as num,p1.status";
$_order = "p1.id desc ";
$result = M('message_receive')->alias('p1')->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->join(presql('`{users}` as p3 on p1.send_userid=p3.user_id'))->where($_sql)->field($field)->order($_order)->group('p1.status')->select();
$_result = array ();
foreach ( $result as $key =>$value ) 
{
if ($value ['status'] == 0) 
{
$_result ['message_no'] = $value ['num'];
}
$_result ['message_all'] += $value ['num'];
}
return $_result;
}
public static function AddMessage($data = array()) 
{
$receive_user = $data ['receive_user'];
$receive_userid = $data ['receive_userid'];
$receive_users = $data ['receive_users'];
$receive_user_type = $data ['receive_user_type'];
$receive_admin_type = $data ['receive_admin_type'];
unset ( $data ['receive_user'] );
unset ( $data ['receive_userid'] );
unset ( $data ['receive_users'] );
unset ( $data ['receive_user_type'] );
unset ( $data ['receive_admin_type'] );
if (!IsExiest ( $data ['name'] )) 
{
return "message_name_empty";
}
if (!IsExiest ( $data ['contents'] )) 
{
return "message_contents_empty";
}
if (!IsExiest ( $data ['type'] )) 
{
return "message_type_empty";
}
if ($data ['type'] == "user") 
{
if ($receive_user == ""&&$receive_userid == "") return "message_receive_user_empty";
if ($receive_user != "") 
{
$result = M ( 'users')->where ( "username ='{$receive_user}
'")->field ( 'user_id')->find ();
if ($result == false) return "message_receive_username_not_exiest";
$data ['receive_value'] = $result ['user_id'];
}
elseif ($receive_userid != "") 
{
$result = M ( 'users')->where ( "user_id ={$receive_userid}
")->field ( 'user_id')->find ();
if ($result == false) return "message_receive_username_not_exiest";
$data ['receive_value'] = $result ['user_id'];
}
$data ['status'] = 1;
if ($data ['status'] == "") 
{
$_data ['send_status'] = 2;
}
else 
{
$_data ['send_status'] = 1;
}
}
elseif ($data ['type'] == "users") 
{
if ($receive_users == "") return "message_receive_users_empty";
$data ['receive_value'] = $receive_users;
}
elseif ($data ['type'] == "user_type") 
{
if ($receive_user_type == "") return "message_receive_user_type_empty";
$data ['receive_value'] = $receive_user_type;
}
elseif ($data ['type'] == "admin_type") 
{
if ($receive_admin_type == "") return "message_receive_admin_type_empty";
$data ['receive_value'] = $receive_admin_type;
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$send_id = M ( 'message')->add ( $data );
if ($data ['status'] == 1) 
{
$_data ['send_id'] = $send_id;
$_data ['send_status'] = $data ['status'];
$result = self::SendMessage ( $_data );
}
return 1;
}
public static function SendMessage($data = array()) 
{
if (!IsExiest ( $data ['send_id'] )) 
{
return "message_id_empty";
}
$send_status = $data ['send_status'];
unset ( $data ['send_status'] );
$result = M ( 'message')->where ( "id={$data['send_id']}
")->find ();
if ($result == false) return "message_empty";
$receive_value = $result ['receive_value'];
$data ['contents'] = $result ['contents'];
$data ['name'] = $result ['name'];
$data ['type'] = $result ['type'];
$data ['send_userid'] = $result ['user_id'];
if (!IsExiest ( $data ['contents'] )) 
{
return "message_contents_empty";
}
if ($data ['type'] == "all") 
{
$data ['user_id'] = 0;
}
elseif ($data ['type'] == "users") 
{
$receive_value = explode ( ",",$receive_value );
foreach ( $receive_value as $key =>$value ) 
{
$_receive_value [] = "'".$value ."'";
}
$receive_value = join ( ",",$_receive_value );
$result = M ( 'users')->where ( "username in ({$receive_value}
)")->field ( 'user_id,username')->select ();
if ($result != false) 
{
foreach ( $result as $key =>$value ) 
{
$_result [] = $value ['user_id'];
$_result_username [] = $value ['username'];
}
$data ['receive_id'] = join ( ",",$_result );
$data ['receive_value'] = join ( ",",$_result_username );
}
$data ['user_id'] = 0;
}
elseif ($data ['type'] == "user_type") 
{
$data ['user_id'] = 0;
$data ['receive_id'] = $receive_value;
}
elseif ($data ['type'] == "admin_type") 
{
$data ['user_id'] = 0;
$data ['receive_id'] = $receive_value;
}
elseif ($data ['type'] == "user") 
{
$data ['user_id'] = $receive_value;
$data ['receive_id'] = $receive_value;
}
$udata ['status'] = $send_status;
M ( 'message')->where ( "id={$data['send_id']}
")->save ( $udata );
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'message_receive')->add ( $data );
return 1;
}
public static function DeleteMessage($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "message_id_empty";
if (is_array ( $data ['id'] )) 
{
$data ['id'] = join ( ",",$data ['id'] );
}
$_sql = "id in ({$data['id']}
)";
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and user_id='{$data['user_id']}
' ";
}
M ( 'message')->where ( $_sql )->delete ();
return 1;
}
function GetMessageList($data = array()) 
{
$_sql = "1=1 ";
if (isset ( $data ['username'] ) &&$data ['username'] != "") 
{
$_sql .= " and p2.username = '{$data['username']}
'";
}
$field = "p1.*,p2.username,p3.username as receive_username,p4.niname as receive_nikename,p5.niname as send_nikename";
$_order = "p1.id desc ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'message')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.receive_value =p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.receive_value =p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'message')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.receive_value =p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.receive_value =p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'message')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.receive_value =p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.receive_value =p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function DeleteMessageReceive($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "message_receive_id_empty";
if (is_array ( $data ['id'] )) 
{
$id=$data ['id'];
$data ['id'] = join ( ",",$data ['id'] );
}
$_sql = "id in ({$data['id']}
)";
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and user_id={$data['user_id']}
and type='user'";
M ( 'message_receive')->where ( $_sql )->delete ();
if (is_array ($id )) 
{
$ddata['user_id']=$data ['user_id'];
foreach ($id as $val)
{
$ddata['id']=$val;
$_result = self::GetMessageReceiveOne ( $ddata );
if ($_result ['type'] != 'user') 
{
M ( 'message_receive')->where ( "user_id={$data['user_id']}
and receive_value='{$data['id']}
'")->delete ();
}
}
}
else
{
$_result = self::GetMessageReceiveOne ( $data );
$_sql .= " and user_id={$data['user_id']}
and type='user'";
M ( 'message_receive')->where ( $_sql )->delete ();
if ($_result ['type'] != 'user') 
{
M ( 'message_receive')->where ( "user_id={$data['user_id']}
and receive_value='{$data['id']}
'")->delete ();
}
}
return $data ['user_id'];
}
else 
{
M ( 'message_receive')->where ( $_sql )->delete ();
}
return $data ['id'];
}
public static function GetMessageReceiveOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "message_id_empty";
if (!IsExiest ( $data ['user_id'] )) return "message_user_id_empty";
$result = M ('message_receive')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.send_userid=p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.send_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( "p1.id={$data['id']}
")->field ( 'p1.*,p2.username as receive_username,p3.username,p4.niname as send_nikename,p5.niname as receive_nikename')->find ();
if ($result == null) return "message_receive_empty";
if ($result ['type'] == "user") 
{
if ($result ['user_id'] != $data ['user_id']) return "message_receive_not_view";
if ($data ['status'] != '') 
{
$sql = "update `{message_receive}` set status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
}
}
else 
{
if ($result ['type'] == "users") 
{
$_result = M ( 'message_receive')->where ( "id={$data['id']}
 and  find_in_set('{$data['user_id']}
',receive_id)")->find ();
if ($_result == null) return "message_receive_not_view";
}
elseif ($result ['type'] == "user_type") 
{
$_result = M ( 'users_info')->where ( "user_id={$data['user_id']}
")->field ( 'type_id')->find ();
$_result = M ( 'message_receive')->where ( "id={$data['id']}
 and  find_in_set('{$_result['type_id']}
',receive_id)")->find ();
if ($_result == null) return "message_receive_not_view";
}
elseif ($result ['type'] == "admin_type") 
{
$_result = M ( 'admin')->where ( "id={$data['user_id']}
")->field ( 'type_id')->find ();
$_result = M ( 'message_receive')->where ( "id={$data['id']}
 and  find_in_set('{$_result['type_id']}
',receive_id)")->find ();
if ($_result == null) return "message_receive_not_view";
}
$_result = M ( 'message_receive')->where ( "user_id={$data['user_id']}
and receive_value='{$data['id']}
'")->find ();
if ($_result == null) 
{
if ($result ['receive_yes'] == '') 
{
$receive_yes = $data ['user_id'];
}
else 
{
$receive_yes = $result ['receive_yes'] .','.$data ['user_id'];
}
if (is_array ( $data ['id'] )) 
{
$data ['id'] = join ( ",",$data ['id'] );
}
$sql = "update `{message_receive}` set receive_yes='{$receive_yes}
' where id in ({$data['id']}
)";
M ()->execute ( presql ( $sql ) );
$sql = "insert into `{message_receive}` set type='user',user_id={$data['user_id']}
,status=1,send_id='{$result['send_id']}
',send_userid='{$result['send_userid']}
',receive_id='{$data['user_id']}
',receive_value='{$result['id']}
',`name`='{$result['name']}
',contents='{$result['contents']}
',addtime='{$result['addtime']}
',addip='{$result['addip']}
'";
M ()->execute ( presql ( $sql ) );
$id = M ()->getLastInsID ();
return self::GetMessageReceiveOne ( array ( "id"=>$id, 'user_id'=>$data ['user_id'] ) );
}
else 
{
return self::GetMessageReceiveOne ( array ( "id"=>$_result ['id'], 'user_id'=>$data ['user_id'] ) );
}
}
return $result;
}
public static function GetMessageReceiveList($data = array()) 
{
$_sql = " 1=1 ";
if ($data ['status'] != ""||$data ['status'] == "0") 
{
$_sql .= " and p1.status='{$data['status']}
'";
}
$receive_result = 1;
if (isset ( $data ['username'] ) &&$data ['username'] != "") 
{
$result = M ( 'users')->alias ( 'p1')->join ( presql ( '`{users_info}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.username ='{$data['username']}
'")->field ( "p1.user_id,p2.type_id")->find ();
if ($result == null) 
{
$receive_result = "";
}
else 
{
$receive_result = $result;
$_sql .= " and (p1.user_id='{$result['user_id']}
' or (p1.type='all' and  !find_in_set('{$result['user_id']}
',receive_yes)) or ( p1.type='users' and  find_in_set('{$data['username']}
',receive_value) and  !find_in_set('{$result['user_id']}
',receive_yes)) or (p1.type='user_type' and  p1.receive_id='{$result['type_id']}
'  and  !find_in_set('{$result['user_id']}
',receive_yes)) ";
$_sql .= " )";
}
}
if ($receive_result != "") 
{
$field = "p1.*,p2.username as receive_username,p3.username as send_username,p4.niname as send_nikename,p5.niname as receive_nikename";
$_order = "p1.id desc ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'message_receive')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.send_userid=p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.send_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'message_receive')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.send_userid=p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.send_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'message_receive')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.send_userid=p3.user_id') )->join ( presql ( '`{users_info}` as p4 on p1.send_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p1.user_id=p5.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$user_type_result = \usersClass::GetUsersTypelist ( array ( "limit"=>"all" ) );
foreach ( $user_type_result as $key =>$value ) 
{
$_user_type_result [$value ['id']] = $value ['name'];
}
$admin_type_result = \uadminClass::GetAdminTypelist ( array ( "limit"=>"all" ) );
foreach ( $admin_type_result as $key =>$value ) 
{
$_admin_type_result [$value ['id']] = $value ['name'];
}
foreach ( $list as $key =>$value ) 
{
if ($value ['type'] != "user") 
{
$list [$key] ["send_username"] = "系统";
if ($value ['type'] == "user_type") 
{
$list [$key] ["receive_username"] = $_user_type_result [$value ['receive_id']];
}
elseif ($value ['type'] == "admin_type") 
{
$list [$key] ["receive_username"] = $_admin_type_result [$value ['receive_id']];
}
elseif ($value ['type'] == "users") 
{
$list [$key] ["receive_username"] = $value ['receive_value'];
}
elseif ($value ['type'] == "all") 
{
$list [$key] ["receive_username"] = "所有用户";
}
}
}
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
}
