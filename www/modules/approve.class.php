
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("approve.model.php");
class approveClass 
{
	function GetSmsList($data = array()) 
	{
		$_sql = "1=1 ";
		if (IsExiest ( $data ['user_id'] ) != false) 
		{
			$_sql .= " and p1.user_id ='{$data['user_id']}
		'";
	}
	if (IsExiest ( $data ['username'] ) != false) 
	{
		$_sql .= " and p2.username like '%{$data['username']}
	%'";
}
if (IsExiest ( $data ['phone'] ) != false) 
{
	$_sql .= " and p1.phone like '%{$data['phone']}
%'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
$field = " p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_sms')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_sms')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_sms')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function CheckSmsCode($data) 
{
$result = M ('approve_smslog')->where ( "user_id={$data['user_id']}
and type='{$data['type']}
'")->order ( 'id desc')->find ();
if ($result == null) return "approve_sms_not_exiest";
if ($result ['code_status'] == 1) return "approve_sms_check_yes";
if ($result ['phone'] != $data ['phone'])
{
if(IsExiest ( $data ['phone_old'] ) != false) 
{
if($result ['phone'] != $data ['phone_old'])return "approve_sms_phone_error";
}
else
{
return "approve_sms_phone_error";
}
}
if ($result ['code'] != $data ['code']) return "approve_sms_code_error";
$sql = "update `{approve_smslog}` set code_status=1,code_time='".time () ."' where id={$result['id']}
";
M ()->execute ( presql ( $sql ) );
$result = M ( 'approve_sms')->where ( "user_id={$data['user_id']}
")->field ( 'id')->find ();
$_data ['id'] = $result ['id'];
$_data ['verify_remark'] = "用户手机认证通过";
$_data ['status'] = 1;
$_data ['verify_userid'] = 0;
self::CheckSms ( $_data );
return $data ['user_id'];
}
public static function update_tender_status($data = array()) 
{
$sql = "update `{users_info}` set `tender_status`=1 where `user_id` = {$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
public static function GetSmsOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "approve_sms_id_empty";
$result = M ( 'approve_sms')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_sms_not_exiest";
return $result;
}
public static function AddSms($data = array()) 
{
if (!IsExiest ( $data ['phone'] )) return "approve_sms_phone_empty";
if (!preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/",$data ['phone'] )) 
{
return "approve_sms_phone_error";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == null) return "approve_sms_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
}
if (!IsExiest ( $data ['user_id'] )) 
{
return "approve_sms_userid_not_exiest";
}
$status = 0;
$result = M ( 'approve_sms')->where ( "user_id={$data['user_id']}
")->find ();
if ($result != null) $status = 1;
$result = M ( 'approve_sms')->where ( "phone='{$data['phone']}
' and status=1")->find ();
if ($result != null) return "approve_sms_phone_exiest";
if ($status == 0) 
{
$sql = "insert into `{approve_sms}` set `addtime` = '".time () ."',`addip` = '".get_client_ip () ."',user_id='{$data['user_id']}
',status=0,`phone`='{$data['phone']}
'";
M ()->execute ( presql ( $sql ) );
}
else 
{
$sql = "update `{approve_sms}` set phone='{$data['phone']}
',status=0 where user_id='{$data['user_id']}
'";
M ()->execute ( presql ( $sql ) );
}
return $data ['user_id'];
}
public static function UpdateSms($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "approve_sms_id_empty";
if (!IsExiest ( $data ['phone'] )) return "approve_sms_phone_empty";
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == null) return "approve_sms_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
}
if (!IsExiest ( $data ['user_id'] )) 
{
return "approve_sms_userid_not_exiest";
}
$result = M ( 'approve_sms')->where ( "`id`={$data['id']}
")->find ();
if ($data ['user_id'] == $result ['user_id'] &&$data ['phone'] == $result ['phone']) 
{
return "approve_sms_update_success";
}
$result = M ( 'approve_sms')->where ( "`phone`='{$data['phone']}
' and status<2")->find ();
if ($result != null) return "approve_sms_phone_exiest";
$sql = "update `{approve_sms}` set status=3 where id='{$data['id']}
'";
M ()->execute ( presql ( $sql ) );
return $id;
}
public static function CheckSms($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "approve_sms_id_empty";
$result = M ( 'approve_sms')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "approve_sms_not_exiest";
$user_id = $result ['user_id'];
$phone = $result ['phone'];
if ($data ['status'] == 2) $data ['credit'] = 0;
if ($data ['status'] == 1) 
{
$sql = "update `{approve_sms}` set status=3,credit=0 where user_id={$result['user_id']}
and status=1";
$result = M ()->execute ( presql ( $sql ) );
}
$sql = "update `{approve_sms}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
',credit='{$data['credit']}
' where id={$data['id']}
";
$result = M ()->execute ( presql ( $sql ) );
if ($result != false) 
{
$user_info ['user_id'] = $user_id;
if ($data ['status'] != 1) 
{
$phone = "";
}
$user_info ['phone'] = $phone;
$user_info ['phone_status'] = $data ['status'];
$result = \usersClass::UpdateUsersInfo ( $user_info );
}
$_data ["user_id"] = $user_id;
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "sms";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
$credit_log ['user_id'] = $user_id;
$credit_log ['nid'] = "phone";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "phone";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $user_id;
$credit_log ['remark'] = "手机认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
return $data ['id'];
}
public static function SendSMS($data) 
{
global $_G;
if ($data ['phone'] == ""&&$data ['user_id'] >0) 
{
$result = M ( 'users_info')->where ( "user_id={$data['user_id']}
")->field ( 'phone,phone_status')->find ();
if ($result ['phone_status'] == 1) 
{
$data ['phone'] = $result ['phone'];
}
}
$data ['contents'] = $data ['contents'];
$result = self::SendSMSByPost ( $data );
$adata ['addtime'] = time ();
$adata ['addip'] = get_client_ip ();
$adata ['user_id'] = $data ['user_id'];
$adata ['status'] = $result;
$adata ['phone'] = $data ['phone'];
$adata ['type'] = $data ['type'];
$adata ['code'] = $data ['code'];
$adata ['contents'] = $data ['contents'];
M ( 'approve_smslog')->add ( $adata );
if ($result >0) return array (1,$data,$result);
return array (2,$http .$data,$result );
}
public static function SendSMSByPost($data = array()) 
{
global $_G;
$http = $_G ['system'] ['con_sms_url'];
$uid = $_G ['system'] ['con_phone_user'];
$pwd = $_G ['system'] ['con_phone_userpwd'];
$mobile = $data ['phone'];
$mobileids = '';
$content = $data ['contents'];
$res = self::sendsSMS ( $http,$uid,$pwd,$mobile,$content,$mobileids );
$ra = strpos ( $res,'stat=100');
if ($ra) 
{
return 1;
}
else 
{
return 0;
}
}
public static function sendsSMS($http,$uid,$pwd,$mobile,$content,$mobileids,$times = '',$mid = '') 
{
$data = array ( 'uid'=>$uid, 'pwd'=>md5 ( $pwd .$uid ), 'mobile'=>$mobile, 'content'=>$content, 'mobileids'=>$mobileids, 'time'=>$times );
$re = self::postSMS ( $http,$data );
return $re;
}
public static function postSMS($url,$data = '') {
	$port = "";
	$post = "";
	$row = parse_url ( $url );
	$host = $row ['host'];
	$port = isset ( $row ['port'] ) ?$row ['port'] : 80;
	$file = $row ['path'];
	while ( list ( $k,$v ) = each ( $data ) ) 
	{
	$post .= rawurlencode ( $k ) ."=".rawurlencode ( $v ) ."&";
	}
	$post = substr ( $post,0,-1 );
	$len = strlen ( $post );
	$fp = @fsockopen ( $host,$port,$errno,$errstr,10 );
	if (!$fp) 
	{
	return "$errstr ($errno)\n";
	}
	else 
	{
	$receive = '';
	$out = "POST $file HTTP/1.1\r\n";
	$out .= "Host: $host\r\n";
	$out .= "Content-type: application/x-www-form-urlencoded\r\n";
	$out .= "Connection: Close\r\n";
	$out .= "Content-Length: $len\r\n\r\n";
	$out .= $post;
	fwrite ( $fp,$out );
	while ( !feof ( $fp ) ) 
	{
	$receive .= fgets ( $fp,128 );
	}
	fclose ( $fp );
	$receive = explode ( "\r\n\r\n",$receive );
	unset ( $receive [0] );
	return implode ( "",$receive );
	}
}
public static function GetSmslogList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['phone'] ) != false) 
{
$_sql .= " and p1.phone like '%{$data['phone']}
%'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
$field = " p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_smslog')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_smslog')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_smslog')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function AddSmslogGroup($data = array()) 
{
global $_G;
if (!IsExiest ( $data ['type'] )) return "approve_sms_send_type_empty";
if (!IsExiest ( $data ['contents'] )) return "approve_sms_send_contents_empty";
if (IsExiest ( $data ['user_id1'] ) != false &&IsExiest ( $data ['user_id2'] ) != false) 
{
$sql = "select  from `{}` as p1 where ";
$result = M ( 'approve_sms')->where ( "user_id>={$data['user_id1']}
or user_id<={$data['user_id2']}
and status=1")->field ( 'phone,user_id')->select ();
if ($result != null) 
{
foreach ( $result as $key =>$value ) 
{
$sql = "insert into `{approve_smslog}` set `addtime` = '".time () ."',`addip` = '".get_client_ip () ."',user_id={$value['user_id']}
,status='{$data['status']}
',`phone`='{$value['phone']}
',`type`='{$data['type']}
',`contents`='{$data['contents']}
'";
M ()->execute ( presql ( $sql ) );
$id = M ()->getLastInsID ();
if ($data ['status'] == 1) 
{
if ($_G ["system"] ["con_sms_status"] == 1) 
{
$sql = "update `{approve_smslog}` set status=2 where id={$id}
";
M ()->execute ( presql ( $sql ) );
$send_sms ["phone"] = $value ['phone'];
$send_sms ["contents"] = $data ['contents'];
$send_sms ["time"] = $value ['user_id'];
$result = self::SendSMS ( $send_sms );
$sql = "update `{approve_smslog}` set status='{$result[0]}
',send_code='{$result[1]}
',send_time='".time () ."',send_return='{$result[2]}
',send_status=1 where id={$id}
";
M ()->execute ( presql ( $sql ) );
}
else 
{
$sql = "update `{approve_smslog}` set status=3 where id={$id}
";
M ()->execute ( presql ( $sql ) );
}
}
return 1;
}
}
}
elseif (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'approve_sms')->alias ( 'p1')->join ( presql ( '`{users}`as p2 on p1.user_id = p2.user_id ') )->where ( "p2.username='{$data['username']}
' and p1.status=1")->field ( 'p1.phone,p1.user_id')->find ();
if ($result == null) return "approve_sms_phone_not_check";
$data ["phone"] = $result ['phone'];
$data ["user_id"] = $result ['user_id'];
}
elseif (IsExiest ( $data ['phone'] ) == false) 
{
$data ["user_id"] = 0;
}
elseif (IsExiest ( $data ['user_id'] ) != false) 
{
}
else 
{
return "approve_sms_send_not_select";
}
$sql = "insert into `{approve_smslog}` set `addtime` = '".time () ."',`addip` = '".get_client_ip () ."',user_id={$data['user_id']}
,status='{$data['status']}
',`code`='{$data['code']}
',`phone`='{$data['phone']}
',`type`='{$data['type']}
',`contents`='{$data['contents']}
'";
M ()->execute ( presql ( $sql ) );
$id = M ()->getLastInsID ();
if ($data ['status'] == 1) 
{
if ($_G ["system"] ["con_sms_status"] == 1) 
{
$sql = "update `{approve_smslog}` set status=2 where id={$id}
";
M ()->execute ( presql ( $sql ) );
$send_sms ["phone"] = $data ['phone'];
$send_sms ["contents"] = $data ['contents'];
$send_sms ["time"] = $data ['user_id'];
$result = self::SendSMS ( $send_sms );
$sql = "update `{approve_smslog}` set status='{$result[0]}
',send_code='{$result[1]}
',send_time='".time () ."',send_return='{$result[2]}
',send_status=1 where id={$id}
";
M ()->execute ( presql ( $sql ) );
}
else 
{
$sql = "update `{approve_smslog}` set status=3 where id={$id}
";
M ()->execute ( presql ( $sql ) );
}
}
return $id;
}
public static function GetSmslogOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "approve_smslog_id_empty";
$result = M ( 'approve_smslog')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( "p1.*,p2.username")->find ();
if ($result == null) return "approve_smslog_not_exiest";
return $result;
}
public static function GetUserid($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ='{$data['user_id']}
'";
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
if ($result == null ||(!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] ) &&!IsExiest ( $data ['email'] ))) 
{
return "realname_user_not_exiest";
}
return $result ['user_id'];
}
public static function AddRealname($data) 
{
if ($data ["pic_result"] == "") return "";
foreach ( $data ["pic_result"] as $key =>$value ) 
{
$sql = "insert into `{realname}` set addtime='".time () ."',addip='".ip_address () ."',user_id='{$data['user_id']}
',upfiles_id='{$value['upfiles_id']}
',`order`='{$value['order']}
',type_id='{$data['type_id']}
'";
M ()->execute ( presql ( $sql ) );
}
return $data ['type_id'];
}
public static function GetRealnameList($data = array()) 
{
$_sql = "  1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['realname'] ) != false) 
{
$_sql .= " and p1.realname like '%".urldecode ( $data ['realname'] ) ."%'";
}
if (IsExiest ( $data ['card_id'] ) != false) 
{
$_sql .= " and p1.card_id like '%{$data['card_id']}
%'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$_order = "p1.id desc";
$_select = " p1.*,p2.username,p3.fileurl as card_pic1_url,p4.fileurl as card_pic2_url";
$row = M ( 'approve_realname')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.card_pic1 = p3.id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.card_pic2 = p4.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_realname')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.card_pic1 = p3.id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.card_pic2 = p4.id') )->field ( $_select )->where ( $_sql )->order ( $_order )->page ( $data ['page'],$data ['epage'] )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function GetRealnameOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_realname_user_id_empty";
$field = " p1.*,p2.username,p3.fileurl as card_pic1_url,p4.fileurl as card_pic2_url";
$result = M ( 'approve_realname')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.card_pic1 = p3.id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.card_pic2 = p4.id') )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
if ($result == null) 
{
$sql = " insert into `{approve_realname}` set user_id={$data['user_id']}
,status=0";
M ()->execute ( presql ( $sql ) );
$result = self::GetRealnameOne ( $data );
}
return $result;
}
public static function UpdateRealname($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_realname_user_id_empty";
if (!IsExiest ( $data ['realname'] )) 
{
return "approve_realname_realname_empty";
}
if (!IsExiest ( $data ['card_id'] )) 
{
return "approve_realname_card_id_empty";
}
if (!self::isIdCard ( $data ['card_id'] )) 
{
return "approve_realname_card_id_error";
}
$result = M ( 'approve_realname')->where ( "card_id='{$data['card_id']}
' and status=1 and user_id!={$data['user_id']}
")->find ();
if ($result != null) 
{
return "approve_realname_card_id_exiest";
}
$result = self::GetRealnameOne ( array ( "user_id"=>$data ['user_id'] ) );
if (IsExiest ( $data ['card_pic1'] ) != false) 
{
$_data ['user_id'] = $result ["user_id"];
if ($result ["card_pic1"] != '') 
{
$_data ['id'] = $result ["card_pic1"];
self::updelet ( $_data );
}
}
if (IsExiest ( $data ['card_pic2'] ) != false) 
{
$_data ['user_id'] = $result ["user_id"];
if ($result ["card_pic2"] != '') 
{
$_data ['id'] = $result ["card_pic2"];
self::updelet ( $_data );
}
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$userid = $data ['user_id'];
unset ( $data ['user_id'] );
M ( 'approve_realname')->where ( "user_id={$userid}
")->save ( $data );
return $userid;
}
public static function updelet($data) 
{
$_sql = "id={$data['id']}
";
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and user_id={$data['user_id']}
";
}
$result = M ( 'users_upfiles')->where ( $_sql )->find ();
if ($result != null) 
{
$_dir = explode ( $result ['filename'],$result ['fileurl'] );
$this->delPic ( $_dir [0],$result ['filename'] );
M ( 'users_upfiles')->where ( $_sql )->delete ();
}
}
public static function delPic($dir,$filename) 
{
$_filename = substr ( $filename,0,strlen ( $filename ) -4 );
if (is_dir ( $dir )) 
{
$dh = opendir ( $dir );
while ( false !== ($file = readdir ( $dh )) ) 
{
if ($file != &&$file != "..") 
{
$fullpath = $dir ."/".$file;
$_url = explode ( $_filename,$file );
if (!is_dir ( $fullpath ) &&isset ( $_url [0] ) &&$_url [0] == "") 
{
unlink ( $fullpath );
}
}
}
closedir ( $dh );
}
}
public static function CheckRealname($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_realname_user_id_empty";
$result = M ( 'approve_realname')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( " p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_realname_empty";
$realname = $result ['realname'];
if ($data ['status'] == 1) 
{
$result = M ( 'approve_realname')->where ( "card_id='{$result['card_id']}
' and status=1 and user_id!={$data['user_id']}
")->find ();
if ($result != null) 
{
return "approve_realname_card_id_exiest";
}
}
$sql = "update `{approve_realname}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where user_id='{$data['user_id']}
'";
M ()->execute ( presql ( $sql ) );
$user_info ['user_id'] = $data ["user_id"];
if ($data ['status'] != 1) 
{
$realname = "";
}
$user_info ['realname'] = $realname;
$user_info ['realname_status'] = $data ['status'];
$result = \usersClass::UpdateUsersInfo ( $user_info );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "realname";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
$cre_result = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and type='realname'")->find ();
if ($cre_result == null) 
{
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "realname";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "realname";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "实名认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
}
return $data ['user_id'];
}
function CheckRealnameId5($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_realname_user_id_empty";
$result = M ( 'approve_realname')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_realname_empty";
if ($result ['status'] >0) 
{
return "approve_realname_check_yes";
}
if ($data ['status'] == 1) 
{
$_result = M ( 'approve_realname')->where ( "card_id='{$result['card_id']}
' and status=1 and user_id!={$data['user_id']}
")->find ();
if ($_result != null) 
{
return "approve_realname_card_id_exiest";
}
}
$_id5 ['realname'] = $result ['realname'];
$_id5 ['card_id'] = $result ['card_id'];
$_id5 ['user_id'] = $result ['user_id'];
$_id5 ['type'] = 'realname';
$status = \id5Class::CheckId5 ( $_id5 );
$id5_status = $status >0 ?$status : 0;
if ($id5_status == 3) 
{
$status = 1;
}
else 
{
$status = 2;
}
$sql = "update `{approve_realname}` set verify_id5_userid='{$data['verify_id5_userid']}
',verify_id5_remark='{$data['verify_id5_remark']}
', verify_id5_time='".time () ."',id5_status='{$id5_status}
',status='{$status}
' where user_id='{$data['user_id']}
'";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "realname";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "realname";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "realname";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "实名认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
return $data ['user_id'];
}
public static function CheckEduId5($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$result = M ( 'approve_edu')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_edu_empty";
if ($result ['status'] >0) 
{
return "approve_edu_check_yes";
}
$result = M ( 'approve_realname')->where ( "user_id={$data['user_id']}
")->find ();
if ($result ['status'] != 1) return "approve_edu_realname_not_check";
$_id5 ['realname'] = $result ['realname'];
$_id5 ['card_id'] = $result ['card_id'];
$_id5 ['user_id'] = $result ['user_id'];
$_id5 ['type'] = 'edu';
$status = \id5Class::CheckId5Edu ( $_id5 );
$id5_status = $status >0 ?$status : 0;
if ($id5_status == 3) 
{
$status = 1;
}
else 
{
$status = 2;
}
$sql = "update `{approve_edu}` set verify_id5_userid='{$data['verify_id5_userid']}
',verify_id5_remark='{$data['verify_id5_remark']}
', verify_id5_time='".time () ."',id5_status='{$id5_status}
',status='{$status}
' where user_id='{$data['user_id']}
'";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "realname";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "education";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "education";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "学历认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
$user_info ['user_id'] = $data ['user_id'];
$user_info ['education_status'] = $data ['status'];
$result = \usersClass::UpdateUsersInfo ( $user_info );
return $data ['user_id'];
}
function isIdCard($number) 
{
$wi = array ( 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 );
$ai = array ( '1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2' );
for($i = 0;$i <17;$i ++) 
{
$b = ( int ) $number 
{
$i}
;
$w = $wi [$i];
$sigma += $b * $w;
}
$snumber = $sigma ;
$check_number = $ai [$snumber];
if ($number 
{
17}
== $check_number) 
{
return true;
}
else 
{
return false;
}
}
public static function GetId5List($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['realname'] ) != false) 
{
$_sql .= " and p1.realname = '".urldecode ( $data ['realname'] ) ."'";
}
if (IsExiest ( $data ['card_id'] ) != false) 
{
$_sql .= " and p1.card_id like '%{$data['card_id']}
%'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
$field = "p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetEduId5List($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['realname'] ) != false) 
{
$_sql .= " and p1.realname = '".urldecode ( $data ['realname'] ) ."'";
}
if (IsExiest ( $data ['card_id'] ) != false) 
{
$_sql .= " and p1.card_id like '%{$data['card_id']}
%'";
}
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
$field = " p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_edu_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_order )->select ();
}
$row = M ( 'approve_edu_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_edu_id5')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetEduList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$_order = "p1.id desc";
$field = " p1.*,p2.username,p3.fileurl as edu_pic_url,p4.realname";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_edu')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.edu_pic = p3.id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_edu')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.edu_pic = p3.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_edu')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.edu_pic = p3.id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetEduOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$field = " p1.*,p2.username,p3.fileurl as edu_pic_url,p4.realname";
$sql = "select  left join  left join  left join   where ";
$result = M ( 'approve_edu')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p1.edu_pic = p3.id') )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
if ($result == null) 
{
$sql = " insert into `{approve_edu}` set user_id={$data['user_id']}
,status=0";
M ()->execute ( presql ( $sql ) );
$result = self::GetEduOne ( $data );
}
return $result;
}
function UpdateEdu($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$result = self::GetEduOne ( array ( "user_id"=>$data ['user_id'] ) );
if (IsExiest ( $data ['edu_pic'] ) != false) 
{
$_data ['user_id'] = $result ["user_id"];
if ($result ["edu_pic"] != '') 
{
$_data ['id'] = $result ["edu_pic"];
self::updelet ( $_data );
}
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'approve_edu')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ["user_id"];
}
public static function CheckEdu($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$sql = "select  from `{}` as p1  left join  where ";
$result = M ( 'approve_edu')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_edu_empty";
$sql = "update `{approve_edu}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "edu";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
if ($data ['status'] == 1) 
{
$cre_result = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and type='education'")->find ();
if ($cre_result == null) 
{
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "education";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "education";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "学历认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
}
}
else 
{
$sql = "delete from `{credit_log}` where user_id={$data['user_id']}
and type='education'";
M ()->execute ( presql ( $sql ) );
}
$user_info ['user_id'] = $data ['user_id'];
$user_info ['education_status'] = $data ['status'];
$result = \usersClass::UpdateUsersInfo ( $user_info );
return $data ['user_id'];
}
public static function GetVideoList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$_order = "p1.id desc";
$field = " p1.*,p2.username,p4.realname";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_video')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( 'join `{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_video')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( 'join `{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->count ();
;
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_video')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( 'join `{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
function GetVideoOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_realname_user_id_empty";
$field = " p1.*,p2.username";
$result = M ( 'approve_video')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
if ($result == null) 
{
$sql = " insert into `{approve_video}` set user_id='{$data['user_id']}
',status=0";
M ()->execute ( presql ( $sql ) );
$result = self::GetVideoOne ( $data );
}
return $result;
}
public static function UpdateVideo($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_video_user_id_empty";
$result = self::GetVideoOne ( array ( "user_id"=>$data ['user_id'] ) );
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'approve_video')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ["user_id"];
}
public static function UpdateFlow($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "用户ID非法";
$result = self::GetFlowOne ( array ( "user_id"=>$data ['user_id'] ) );
if ($result == null) 
{
$sql = " insert into `{approve_flow}` set user_id={$data['user_id']}
,status=0,addtime='".time () ."',addip='".get_client_ip () ."' ";
M ()->execute ( presql ( $sql ) );
$result = self::UpdateFlow ( $data );
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'approve_flow')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ["user_id"];
}
function GetFlowList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$_order = "p1.id desc";
$field = " p1.*,p2.username,p4.realname";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_flow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_flow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_flow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function CheckFlow($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$result = M ( 'approve_flow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == false) return "approve_video_empty";
$sql = "update `{approve_flow}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "flow";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['user_id'];
}
public static function GetFlowOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "用户ID非法";
$field = " p1.*,p2.username";
$result = M ( 'approve_flow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
return $result;
}
public static function CheckVideo($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$result = M ( 'approve_video')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_video_empty";
$sql = "update `{approve_video}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "video";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "video";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "video";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "视频认证通过所得积分";
\creditClass::ActionCreditLog ( $credit_log );
$user_info ['user_id'] = $data ['user_id'];
$user_info ['video_status'] = $data ['status'];
$result = \usersClass::UpdateUsersInfo ( $user_info );
return $data ['user_id'];
}
function UpdateInvite($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "用户ID非法";
$result = self::GetInviteOne ( array ( "user_id"=>$data ['user_id'] ) );
if ($result == null) 
{
$sql = " insert into `{approve_invite}` set user_id={$data['user_id']}
,status=0,addtime='".time () ."',addip='".get_client_ip () ."' ";
M ()->execute ( presql ( $sql ) );
}
$sql = "update `{approve_invite}` set addtime='".time () ."',addip='".get_client_ip () ."',";
foreach ( $data as $key =>$value ) 
{
$_sql [] = "`$key` = '$value'";
}
M ()->execute ( presql ( $sql .join ( ",",$_sql ) ." where user_id={$data['user_id']}
") );
return $data ["user_id"];
}
public static function GetInviteOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "用户ID非法";
$field = " p1.*,p2.username";
$result = M ( 'approve_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
return $result;
}
function CheckInvite($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "approve_edu_user_id_empty";
$result = M ( 'approve_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "p1.user_id={$data['user_id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "approve_video_empty";
$sql = "update `{approve_invite}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where user_id='{$data['user_id']}
'";
M ()->execute ( presql ( $sql ) );
$datainfo = array ();
$datainfo ['invite_status'] = $data ['status'];
if ($data ['status']==1) 
{
$datainfo ['invite_code'] = substr ( md5 ( $data ['user_id'] .rand ( 1000,1000 ) ),8,16 );
}
else
{
$datainfo ['invite_code']='';
}
$datainfo ['user_id'] = $result ['user_id'];
\usersClass::UpdateUsersInfo ( $datainfo );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "approve";
$_data ["type"] = "invite";
$_data ["article_id"] = $data ["user_id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['user_id'];
}
function GetInviteList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%".urldecode ( $data ['username'] ) ."%'";
}
$_order = " p1.id desc";
$field = " p1.*,p2.username,p4.realname";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'approve_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'approve_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'approve_invite')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{approve_realname}` as p4 on p1.user_id=p4.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
}
?>