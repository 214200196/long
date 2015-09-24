
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
require_once ("attestations.model.php");
class attestationsClass 
{
	public static function AddAttestationsType($data = array()) 
	{
		if (!IsExiest ( $data ['name'] )) 
		{
			return "attestations_type_name_empty";
		}
		if (!IsExiest ( $data ['nid'] )) 
		{
			return "attestations_type_nid_empty";
		}
		$result = M ( 'attestations_type')->where ( "nid='{$data['nid']}
	'")->find ();
	if ($result != null) return "attestations_type_nid_exiest";
	$data ['addtime'] = time ();
	$data ['addip'] = get_client_ip ();
	return M ()->add ( $data );
}
public static function AddAttestationsStudy($data = array()) 
{
	if (!IsExiest ( $data ['user_id'] )) return false;
	if (!IsExiest ( $data ['nid'] )) return false;
	if (!IsExiest ( $data ['code'] )) return false;
	if (!IsExiest ( $data ['type'] )) return false;
	$result = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and type='{$data['type']}
'")->find ();
if ($result == null) 
{
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = $data ['nid'];
$credit_log ['code'] = $data ['code'];
$credit_log ['type'] = $data ['type'];
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "通过学习测试获得的积分";
\creditClass::ActionCreditLog ( $credit_log );
}
if ($data ['type'] == "tender_study") 
{
$sql = "update `{users_info}` set `tender_status`=1 where `user_id` = {$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
return true;
}
public static function UpdateAttestationsType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "attestations_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "attestations_type_nid_empty";
}
$result = M ( 'attestations_type')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != null) return "attestations_type_nid_exiest";
M ( 'attestations_type')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function DelAttestationsType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "attestations_type_id_empty";
$result = M ( 'attestations')->where ( "type_id={$data['id']}
")->find ();
if ($result != null) return "attestations_type_upfiles_exiest";
M ( 'attestations_type')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
function GetAttestationsTypeList($data = array()) 
{
$_order = "id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'attestations_type')->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'attestations_type')->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'attestations_type')->page ( $page )->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetAttestationsTypeOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "attestations_type_id_empty";
$result = M ( 'attestations_type')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "attestations_type_empty";
return $result;
}
public static function GetAttestationsUserid($data = array()) 
{
$_sql = "1=1 ";
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
$result = M ( 'users')->where ( $_sql )->find ();
if ($result == null ||(!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] ) &&!IsExiest ( $data ['email'] ))) 
{
return "attestations_user_not_exiest";
}
return $result ['user_id'];
}
public static function AddAttestations($data) 
{
if ($data ["pic_result"] == "") return "";
$arry = $data ["pic_result"];
if (count ( $arry ) == count ( $arry,1 )) 
{
$attestations_type = M ( 'attestations_type')->where ( "id={$data['type_id']}
")->field ( 'credit')->find ();
$sql = "insert into `{attestations}` set addtime='".time () ."',addip='".get_client_ip () ."',user_id={$data['user_id']}
,upfiles_id='{$arry['upfiles_id']}
',`order`=0,type_id='{$data['type_id']}
', credit='".$attestations_type ['credit'] ."'";
M ()->execute ( presql ( $sql ) );
}
else 
{
foreach ( $data ["pic_result"] as $key =>$value ) 
{
$attestations_type = M ( 'attestations_type')->where ( "id={$data['type_id']}
")->field ( 'credit')->find ();
$sql = "insert into `{attestations}` set addtime='".time () ."',addip='".get_client_ip () ."',user_id={$data['user_id']}
,upfiles_id='{$value['upfiles_id']}
',`order`='{$value['order']}
',type_id='{$data['type_id']}
', credit='".$attestations_type ['credit'] ."'";
M ()->execute ( presql ( $sql ) );
}
}
return $data ['type_id'];
}
public static function GetAttestationsList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['type_id'] ) != false) 
{
$_sql .= " and p1.type_id in ({$data['type_id']}
) ";
}
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
$field = " p1.*,p2.username,p3.name as type_name,p3.validity,p4.fileurl,p4.name,p4.contents";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$result = M ( 'attestations')->alias ( 'p1')->join ( presql ( '`{attestations_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.upfiles_id=p4.id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
foreach ( $result as $key =>$value ) 
{
$endtime = strtotime ( "{$value['validity']}
month",$value ['addtime'] );
if ($value ['validity'] >0) 
{
if ($endtime >time ()) 
{
$result [$key] ['validity_time'] = $endtime;
}
else 
{
$result [$key] ['validity_time'] = -1;
$result [$key] ['credit'] = 0;
}
}
else 
{
$result [$key] ['validity_time'] = 0;
}
}
return $result;
}
$row = M ( 'attestations')->alias ( 'p1')->join ( presql ( '`{attestations_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.upfiles_id=p4.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'attestations')->alias ( 'p1')->join ( presql ( '`{attestations_type}` as p3 on p1.type_id=p3.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_upfiles}` as p4 on p1.upfiles_id=p4.id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
foreach ( $list as $key =>$value ) 
{
if ($value ['validity'] >0) 
{
$list [$key] ['validity_time'] = 2;
}
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
function GetAttestationsOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "attestations_id_empty";
$field = " p1.*,p2.username,p3.name as type_name,p4.fileurl,p4.name,p4.contents,p4.addtime";
$result =M('attestations')->alias('p1')->join(presql('`{attestations_type}` as p3 on p1.type_id=p3.id'))->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->join(presql('`{users_upfiles}` as p4 on p1.upfiles_id=p4.id'))->where("p1.id={$data['id']}
")->field($field)->find();
if ($result == false) return "attestations_empty";
$result ["default"] = 0;
if ($result ["litpic"] == $result ["id"]) 
{
$result ["default"] = 1;
}
return $result;
}
function UpdateAttestations($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['id'] )) return "attestations_id_empty";
if (!IsExiest ( $data ['upfiles_id'] )) return "attestations_upfilesid_empty";
if (!IsExiest ( $data ['name'] )) 
{
return "attestations_name_empty";
}
$sql = "update `{attestations}` set `type_id` = '{$data['type_id']}
',`order` = '{$data['order']}
' where id='{$data['id']}
'  and user_id='{$data['user_id']}
'";
M()->execute(presql($sql));
$id = $data ['id'];
$type_id = $data ['type_id'];
$upfiles_id = $data ['upfiles_id'];
unset ( $data ['id'] );
unset ( $data ['order'] );
unset ( $data ['type_id'] );
unset ( $data ['upfiles_id'] );
if ($data ['default'] == 1) 
{
$sql = " update `{attestations}` set litpic={$id}
where id='{$type_id}
'";
M()->execute(presql($sql));
}
unset ( $data ['default'] );
$data['time']=time();
$data['updateip']=get_client_ip();
M('users_upfiles')->where("id='{$upfiles_id}
' and user_id='{$data['user_id']}
'")->save($data);
return $id;
}
function DelAttestations($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "attestations_id_empty";
$result =M('attestations')->where("id='{$data['id']}
' and user_id='{$data['user_id']}
'")->find();
if ($result == null) return "ablums_upfiles_not_exiest";
M('attestations')->where("id='{$data['id']}
'  and user_id='{$data['user_id']}
'")->delete();
return $data ['id'];
}
function CheckAttestations($data = array()) 
{
global $mysql;
echo "<script>alert({$data}
)</script>";
if (!IsExiest ( $data ['id'] )) return "attestations_id_empty";
$result = M('attestations')->alias('p1')->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->where("id={$data['id']}
")->field('p1.*,p2.username')->find();
if ($result == null) return "attestations_empty";
$sql = "update `{attestations}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M()->execute(presql($sql));
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "attestations";
$_data ["type"] = "attestation";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
function CheckCreditAttestations($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "attestations_id_empty";
if (!IsExiest ( $data ['type_id'] )) return "attestations_type_id_empty";
$_credit = array_sum ( $data ['credit'] );
$result = M ( 'attestations_type')->where ( "id={$data['type_id']}
")->field ( 'credit')->find ();
if ($result ['credit'] <$_credit) return "attestations_credit_most";
foreach ( $data ['id'] as $key =>$value ) 
{
$sql = "update `{attestations}` set credit='{$data['credit'][$key]}
',verify_remark='{$data['verify_remark'][$key]}
',status='{$data['status'][$key]}
',verify_userid='{$data['user_id']}
',verify_time='".time () ."' where id={$value}
";
M ()->execute ( presql ( $sql ) );
}
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "attestations";
$_data ["type"] = "attestation";
$_data ["article_id"] = join ( ",",$data ["id"] );
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return 1;
}
public static function GetAttestationsCredit($data = array()) 
{
$_sql = "  1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['type_id'] ) != false) 
{
$_sql .= " and p1.type_id ='{$data['type_id']}
'";
}
$result = M ( 'attestations')->alias ( 'p1')->join ( presql ( '`{attestations_type}` as p2 on p1.type_id=p2.id') )->where ( $_sql )->field ( 'p1.credit,p1.addtime,p2.validity')->select ();
$num = 0;
foreach ( $result as $key =>$value ) 
{
$_time = strtotime ( "{$value['validity']}
month",$value ['addtime'] );
if ($value ['validity'] == 0 ||$_time >time ()) 
{
$num += $value ['credit'];
}
}
return $num;
}
public static function GetAttestationsUserCredit($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
$_result = array ();
if (IsExiest ( $data ['type_id'] ) != false) 
{
$_sql .= " and p1.type_id ='{$data['type_id']}
'";
}
$result = self::GetAttestationsTypeList ( array ( "limit"=>"all" ) );
foreach ( $result as $key =>$value ) 
{
$_result [$value ["nid"]] ['num'] = 0;
$_result [$value ["nid"]] ['name'] = $value ['name'];
}
$result = M ( 'attestations')->alias ( 'p1')->where ( $_sql )->join ( presql ( '`{attestations_type}` as p2 on p1.type_id=p2.id') )->field ( 'p1.type_id,p1.credit,p1.addtime,p1.status,p2.nid,p2.validity,p2.name as type_name')->select ();
if ($result != null) 
{
foreach ( $result as $key =>$value ) 
{
$endtime = strtotime ( "{$value['validity']}
month",$value ['addtime'] );
if ($value ['validity'] == 0 ||$endtime >time ()) 
{
$_result [$value ["nid"]] ['num'] += $value ['credit'];
}
else 
{
$_result [$value ["nid"]] ['num'] = 0;
}
$_result [$value ["nid"]] ['name'] = $value ['type_name'];
$_result [$value ["nid"]] ['status'] = $value ['status'];
}
}
return $_result;
}
public static function GetAttestationsUser($data = array()) 
{
global $mysql;
$result = M ( 'attestations_user')->where ( "user_id={$data['user_id']}
")->select ();
$user_result = array ();
if ($result != null) 
{
foreach ( $result as $key =>$value ) 
{
$user_result [$value ['type_id']] ['status'] = $value ['status'];
$user_result [$value ['type_id']] ['credit'] = $value ['credit'];
}
}
$_result = M ( 'attestations_type')->select ();
foreach ( $_result as $key =>$value ) 
{
$_result [$key] ['credit'] = 0;
$_result [$key] ['status'] = "";
$_result [$key] ['upfiles'] = "";
if (isset ( $user_result [$value ['id']] )) 
{
$_result [$key] ['status'] = $user_result [$value ['id']] ['status'];
$_result [$key] ['credit'] = $user_result [$value ['id']] ['credit'];
if ($_result [$key] ['status'] == 1) 
{
$_data = $data;
$_data ['type_id'] = $value ['id'];
$_data ['limit'] = "all";
$_result [$key] ['upfiles'] = self::GetAttestationsList ( $_data );
}
}
}
return $_result;
}
public static function ActionAttestationsUser($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "attestations_user_id_empty";
if (!IsExiest ( $data ['type_id'] )) return "attestations_type_id_empty";
$result = M ( 'attestations_user')->where ( "type_id ={$data['type_id']}
and user_id={$data['user_id']}
")->find ();
if ($result == null) 
{
$sql = "insert into `{attestations_user}` set user_id={$data['user_id']}
,type_id={$data['type_id']}
";
M ()->execute ( presql ( $sql ) );
}
M ( 'attestations_user')->where ( "type_id ={$data['type_id']}
and user_id={$data['user_id']}
")->save ( $data );
return $data ['user_id'];
}
}
