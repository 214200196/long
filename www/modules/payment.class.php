
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("payment.model.php");
class paymentClass 
{
	public static function GetList($data = array()) 
	{
		$alllist = self::GetListAll ();
		$_sql = "1=1 ";
		if (isset ( $data ['status'] ) &&$data ['status'] != "") 
		{
			$_sql .= " and status = {$data['status']}
		";
	}
	$result = M ( 'payment')->where ( $_sql )->order ( '`order` desc')->select ();
	foreach ( $result as $key =>$value ) 
	{
		$result [$key] ['logo'] = $alllist [$value ['nid']] ['logo'];
	}
	return $result;
}
public static function GetListAll($data = array()) 
{
	$result = get_file ( ROOT_PATH ."modules/paytype","file");
	$_result = "";
	foreach ( $result as $key =>$value ) 
	{
		$_nid = explode ( ".class.php",$value );
		$nid = $_nid [0];
		$_result [$nid] ['nid'] = $nid;
		$classname = $nid ."Payment";
		$o = new $classname ();
		$_result [$nid] ['type'] = $o->type;
		$_result [$nid] ['name'] = $o->name;
		$_result [$nid] ['description'] = $o->description;
		$_result [$nid] ['logo'] = "/statics/images/payment/".$o->logo .".gif";
	}
	return $_result;
}
public static function GetOne($data = array()) 
{
	$nid = $data ['nid'];
	$classname = $nid ."Payment";
	$o = new $classname ();
	$_result ['nid'] = $nid;
	$_result ['type'] = $o->type;
	$_result ['name'] = $o->name;
	$_result ['description'] = $o->description;
	$_result ['fields'] = $o->GetFields ();
	$_result ['logo'] = "/statics/images/payment/".$o->logo .".gif";
	if ($_result ['type'] == 1) 
	{
		$result = M ( 'payment')->where ( "nid = '{$data['nid']}
	'")->find ();
	if ($result != false &&$_result ['type'] == 1) 
	{
		$_config = unserialize ( $result ['config'] );
		$_result ['litpic'] = $result ['litpic'];
		foreach ( $_result ['fields'] as $_key =>$_value ) 
		{
			$_result ['fields'] [$_key] ['value'] = isset ( $_config [$_key] ) ?$_config [$_key] : "";
		}
		$_result ['description'] = $result ['description'];
	}
}
elseif (isset ( $data ['id'] ) &&$data ['id'] != "") 
{
	$result = M ( 'payment')->where ( " id ={$data['id']}
")->find ();
if ($result != false &&$_result ['type'] == 1) 
{
	$_config = unserialize ( $result ['config'] );
	foreach ( $_result ['fields'] as $_key =>$_value ) 
	{
		$_result ['fields'] [$_key] ['value'] = isset ( $_config [$_key] ) ?$_config [$_key] : "";
	}
}
if ($result != false) return $result +$_result;
}
return $_result;
}
public static function Action($data = array()) 
{
$nid = $data ['nid'];
$type = $data ['type'];
unset ( $data ['type'] );
$result = M ( 'payment')->where ( "nid = '{$nid}
'")->find ();
if (($result == null ||$type == "news") &&$type != "edit") 
{
M ( 'payment')->add ( $data );
}
else 
{
$_sql = $__sql = "";
if (isset ( $data ['id'] )) 
{
$__sql .= " and id = {$data['id']}
";
}
M ( 'payment')->where ( "nid = '$nid' {$__sql}
")->save ( $data );
}
return $result ['id'];
}
public static function Update($data = array()) 
{
$id = $data ['id'];
if ($data ['id'] == "") 
{
return self::ERROR;
}
return M ( 'payment')->where ( " id =$id")->save ( $data );
}
public static function ToSubmit($data = array()) 
{
global $_G;
$payment = isset ( $data ['payment'] ) ?$data ['payment'] : "";
$data ['webname'] = $_G ['system'] ['con_webname'];
$data ['subject'] = isset ( $data ['subject'] ) ?$data ['subject'] : "";
$data ['body'] = isset ( $data ['body'] ) ?$data ['body'] : "";
$data ['trade_no'] = isset ( $data ['trade_no'] ) ?$data ['trade_no'] : "";
$user = \usersClass::GetUsers ( array ( "user_id"=>$data ['user_id'] ) );
$data ['username'] = isset ( $user ['username'] ) ?$user ['username'] : "";
$result = M ( 'payment')->where ( "id ={$payment}
")->find ();
if ($result == null) return self::ERROR;
if ($result ['config'] != "") 
{
$data = unserialize ( $result ['config'] ) +$data;
$classname = $result ['nid'] ."Payment";
$payclass = new $classname ();
$url = $payclass->ToSubmit ( $data );
return $url;
}
else 
{
return "";
}
}
public static function Delete($data = array()) 
{
$id = $data ['id'];
if (!is_array ( $id )) 
{
$id = array ( $id );
}
M ( 'payment')->where ( "id in (".join ( ",",$id ) .")")->delete ();
return $id;
}
}
