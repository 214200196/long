<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("remind.model.php");
class remindClass 
{
	public static function GetList($data = array()) 
	{
		$name = $data ['name'];
		$type_id = $data ['type_id'];
		$_sql = "  1=1 ";
		if ($name != "") 
		{
			$_sql .= " and p1.`name` like '%$name%'";
		}
		if ($type_id != "") 
		{
			$_sql .= " and p1.`type_id` = '$type_id'";
		}
		$field = "p1.*,p2.name as type_name";
		if (IsExiest ( $data ['limit'] ) != false) 
		{
			if ($data ['limit'] != "all") 
			{
				$_limit = $data ['limit'];
			}
			return M ( 'remind')->alias ( 'p1')->join ( presql ( '{remind_type} as p2 on p1.type_id=p2.id') )->where ( $_sql )->limit ( $_limit )->field ( $field )->select ();
		}
		$row = M ( 'remind')->alias ( 'p1')->join ( presql ( '{remind_type} as p2 on p1.type_id=p2.id') )->where ( $_sql )->count ();
		$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
		$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
		$Page = new \Think\Page ( $row,$data ['epage'] );
		$show = $Page->show ();
		$list = M ( 'remind')->alias ( 'p1')->join ( presql ( '{remind_type} as p2 on p1.type_id=p2.id') )->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
	")->field ( $field )->select ();
	$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
	return $result;
}
public static function GetLists($data = array()) 
{
	if (isset ( $data ['user_id'] )) 
	{
		$user_id = $data ['user_id'];
	}
	else 
	{
		return self::ERROR;
	}
	$remind_result = M ( 'remind_user')->where ( "user_id={$user_id}
")->find ();
if ($remind_result == false) 
{
	M ( 'remind_user')->add ( array ( 'user_id'=>$user_id ) );
	$remind_result = M ( 'remind_user')->where ( "user_id={$user_id}
")->find ();
}
$remind_user = unserialize ( $remind_result ['remind'] );
$type_list = M ( 'remind_type')->field ( 'id,name,nid')->order ( 'order desc')->select ();
$remind_list = M ( 'remind')->select ();
$phone_status = $_G ['user_info'] ['phone_status'];
$_result = "";
foreach ( $type_list as $key =>$value ) 
{
$_result [$value ['id']] = $value;
foreach ( $remind_list as $_key =>$_value ) 
{
	if ($_value ['type_id'] == $value ['id']) 
	{
		if ($phone_status != 1) 
		{
			$_value ['phone'] = 2;
		}
		if ($remind_user != false) 
		{
			if (isset ( $remind_user [$_value ['nid']] ['message'] )) 
			{
				if ($_value ['message'] != 1 &&$_value ['message'] != 2) 
				{
					$_value ['message'] = 3;
				}
			}
			else 
			{
				if ($_value ['message'] == 3) 
				{
					$_value ['message'] = 4;
				}
			}
			if (isset ( $remind_user [$_value ['nid']] ['email'] )) 
			{
				if ($_value ['email'] != 1 &&$_value ['email'] != 2) 
				{
					$_value ['email'] = 3;
				}
			}
			else 
			{
				if ($_value ['email'] == 3) 
				{
					$_value ['email'] = 4;
				}
			}
			if (isset ( $remind_user [$_value ['nid']] ['phone'] )) 
			{
				if ($_value ['phone'] != 1 &&$_value ['phone'] != 2) 
				{
					$_value ['phone'] = 3;
				}
				;
			}
			else 
			{
				if ($_value ['phone'] == 3) 
				{
					$_value ['phone'] = 4;
				}
			}
		}
		$_result [$value ['id']] ['list'] [$_value ['id']] = $_value;
	}
}
}
return $_result;
}
public static function GetOne($data = array()) 
{
$id = $data ['id'];
if ($id == "") return "remind_error_id_empty";
return M ( 'remind')->where ( "id=$id")->find ();
}
public static function GetNidOne($data = array()) 
{
$nid = $data ['nid'];
if ($nid == "") return "remind_error_nid_empty";
return M ( 'remind')->where ( "nid='$nid'")->find ();
}
public static function Add($data = array()) 
{
if (!isset ( $data ['name'] ) ||$data ['name'] == "") 
{
return "remind_error_name_empty";
}
if (!isset ( $data ['nid'] ) ||$data ['nid'] == "") 
{
return "remind_error_nid_empty";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$re = M ( 'remind')->add ( $data );
if ($re) return true;
else return false;
}
public static function Update($data = array()) 
{
$id = $data ['id'];
if ($data ['name'] == ""||$data ['id'] == "") 
{
return "remind_error_id_empty";
}
$result = M ( 'remind')->where ( "id = $id")->save ( $data );
if ($result == false) return "remind_error_id_empty";
return true;
}
public static function Delete($data = array()) 
{
$id = $data ['id'];
if (!is_array ( $id )) 
{
$id = array ( $id );
}
M ( 'remind')->where ( "id in (".join ( ",",$id ) .")")->delete ();
return true;
}
public static function Action($data = array()) 
{
$name = $data ['name'];
$nid = $data ['nid'];
$order = $data ['order'];
$message = $data ['message'];
$phone = $data ['phone'];
$email = $data ['email'];
$type = $data ['type'];
unset ( $data ['type'] );
if ($type == "add") 
{
$type_id = $data ['type_id'];
foreach ( $name as $key =>$val ) 
{
	if ($val != ""&&$nid [$key] != "") 
	{
		$sql = "insert into {remind} set `type_id`='".trim ( $type_id ) ."',`name`='".trim ( $name [$key] ) ."',`nid`='".trim ( $nid [$key] ) ."',`message`='".$message [$key] ."',`email`='".$email [$key] ."',`phone`='".$phone [$key] ."',`order`='".trim ( $order [$key] ) ."' ";
		M ()->execute ( presql ( $sql ) );
	}
}
}
else 
{
$id = $data ['id'];
foreach ( $id as $key =>$val ) 
{
	if ($name [$key] != ""&&$nid [$key] != "") 
	{
		$sql = "update {remind} set `name`='".trim ( $name [$key] ) ."',`nid`='".trim ( $nid [$key] ) ."',`order`='".$order [$key] ."',`message`='".$message [$key] ."',`email`='".$email [$key] ."',`phone`='".$phone [$key] ."' where id=$val";
		M ()->execute ( presql ( $sql ) );
	}
}
}
return true;
}
public static function GetTypeList($data = array()) 
{
$name = $data ['name'];
$_sql = " 1=1 ";
if ($name != "") 
{
$_sql .= " and p1.`name` like '%$name%'";
}
$_select = " p1.*";
$sql = "select SELECT from {} as p1 {$_sql}
  ORDER LIMIT";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'remind_type')->alias ( 'p1')->where ( $_sql )->limit ( $_limit )->select ();
}
$row = M ( 'remind_type')->alias ( 'p1')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'remind_type')->alias ( 'p1')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetTypeOne($data = array()) 
{
$id = $data ['id'];
if ($id == "") return "remind_error_id_empty";
$result = M ( 'remind_type')->where ( "id=$id")->find ();
return $result;
}
public static function AddType($data = array()) 
{
if ($data ['name'] == "") 
{
return "remind_error_name_empty";
}
if ($data ['nid'] == "") 
{
return "remind_error_nid_empty";
}
$result = M ( 'remind_type')->where ( "`nid` = '".$data ['nid'] ."'")->find ();
if ($result != null) return "remind_error_id_empty";
return M ( 'remind_type')->add ( $data );
}
public static function UpdateType($data = array()) 
{
if ($data ['name'] == ""||$data ['id'] == "") 
{
return "remind_error_id_empty";
}
$id = $data ['id'];
M ( 'remind_type')->where ( "`id` = $id")->save ( $data );
return true;
}
public static function DeleteType($data = array()) 
{
$id = $data ['id'];
if ($id == "") return "remind_error_id_empty";
if (!is_array ( $id )) 
{
$id = array ( $id );
}
$sql = "delete from {`remind_type`}  where `id` in (".join ( ",",$id ) .")";
M ()->execute ( presql ( $sql ) );
$sql = "delete from {`remind`}  where `type_id` in (".join ( ",",$id ) .")";
M ()->execute ( presql ( $sql ) );
return true;
}
public static function ActionType($data = array()) 
{
$nid = $data ['nid'];
$name = $data ['name'];
$order = $data ['order'];
$type = $data ['type'];
unset ( $data ['type'] );
if ($type == "add") 
{
foreach ( $name as $key =>$val ) 
{
if ($val != ""&&$nid [$key] != "") 
{
$sql = "insert into {remind_type} set `name`='".$name [$key] ."',`nid`='".$nid [$key] ."',`order`='".$order [$key] ."' ";
M()->execute(presql($sql));
}
}
}
else 
{
$id = $data ['id'];
foreach ( $id as $key =>$val ) 
{
$sql = "update {remind_type} set `name`='".$name [$key] ."',`order`='".$order [$key] ."' where id=$val";
M()->execute(presql($sql));
}
}
return true;
}
function ActionRemindUser($data) 
{
if (!isset ( $data ['user_id'] )) return "remind_error_nid_empty";
$user_id = $data ['user_id'];
$remind = $data ['remind'];
$sql = "update {remind_user} set remind='{$remind}
' where user_id=$user_id";
return M ()->execute ( presql ( $sql ) );
}
public static function sendRemind($data) 
{
global $_G;
$remind_user = array ();
if ($data ['receive_user'] != "") 
{
$data ['receive_userid'] = $data ['receive_user'];
}
$remind_result = self::GetNidOne ( array ( "nid"=>$data ['nid'] ) );
$message_status = isset ( $remind_user [$data ['nid']] ['message'] ) ?$remind_user [$data ['nid']] ['message'] : $remind_result ['message'];
$email_status = isset ( $remind_user [$data ['nid']] ['email'] ) ?$remind_user [$data ['nid']] ['email'] : $remind_result ['email'];
if ($data ['phone_status'] == "") 
{
$phone_status = isset ( $remind_user [$data ['nid']] ['phone'] ) ?$remind_user [$data ['nid']] ['phone'] : $remind_result ['phone'];
}
else 
{
$phone_status = $data ['phone_status'];
}
$email = isset ( $data ['email'] ) ?$data ['email'] : $result ['email'];
$phone = isset ( $data ['phone'] ) ?$data ['phone'] : $result ['phone'];
$_result = array ();
if ($message_status == 1 ||$message_status == 3) 
{
$message ['user_id'] = "0";
$message ['receive_userid'] = $data ['receive_userid'];
$message ['name'] = $data ['title'];
$message ['contents'] = $data ['content'];
$message ['type'] = 'user';
$message ['status'] = isset ( $data ['status'] ) ?$data ['status'] : 1;
$_result ['message_result'] = \messageClass::AddMessage ( $message );
}
if ($email_status == 1 ||$email_status == 3) 
{
$remail ['user_id'] = $data ['receive_userid'];
$remail ['title'] = $data ['title'];
if ($data ['email_content'] == "") 
{
$remail ['msg'] = GetEmailCont(array('content'=>$data ['content']));
}
else 
{
$remail ['msg'] = GetEmailCont(array('content'=>$data ['email_content']));
}
$_result ['email_result'] = \usersClass::SendEmail ( $remail );
}
if ($phone_status == 1 ||$phone_status == 3) 
{
$send_sms ['type'] = isset ( $data ['type'] ) ?$data ['type'] : 'remind';
if ($data ['phone_content'] == "") 
{
$send_sms ['contents'] = $data ['content'] ."[{$_G['system']['con_webname']}
]";
}
else 
{
$send_sms ['contents'] = $data ['phone_content']."[{$_G['system']['con_webname']}
]";
}
$send_sms ['phone'] = isset ( $data ['phone'] ) ?$data ['phone'] : '';
$send_sms ['user_id'] = $data ['receive_userid'];
$_result ['phone_result'] = \approveClass::SendSMS ( $send_sms );
}
return $_result;
}
function AddLog($data) 
{
$sql = "insert into `{remind_log}` set `addtime` = '".time () ."',`addip` = '".get_client_ip()."',";
foreach ( $data as $key =>$value ) 
{
$_sql [] .= "`$key` = '$value'";
}
$sql .= join ( ",",$_sql ) ." ";
return M()->execute(presql($sql));
}
}
