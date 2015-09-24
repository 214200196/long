
<?php
global $MsgInfo;
require_once ("rating.model.php");
class ratingClass 
{
	public static function AddEducations($data = array()) 
	{
		if (!IsExiest ( $data ['name'] )) 
		{
			return "rating_educations_name_empty";
		}
		if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
		{
			return "rating_educations_user_must_one";
		}
		if (IsExiest ( $data ['username'] ) != false) 
		{
			$result = M ( 'users')->where ( "username ='{$data['username']}
		'")->field ( 'user_id')->find ();
		if ($result == null) return "rating_educations_username_not_exiest";
		$data ['user_id'] = $result ['user_id'];
		unset ( $data ['username'] );
	}
	$result = M ( 'rating_educations')->where ( "user_id={$data['user_id']}
")->field ( 'count(1) as num')->find ();
if ($result ['num'] >10) 
{
	return "rating_educations_num_not_10";
}
return M ( 'rating_educations')->add ( $data );
}
public static function UpdateHouse($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_house_id_empty";
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
	return "rating_house_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
	$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == false) return "rating_house_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
M ( 'rating_houses')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function UpdateEducations($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_educations_id_empty";
if (!IsExiest ( $data ['name'] )) 
{
return "rating_educations_name_empty";
}
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_educations_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == false) return "rating_educations_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
M ( 'rating_educations')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function DelEducations($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_educations_id_empty";
M ( 'rating_educations')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function CheckEducations($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_educations_id_empty";
$result = M ( 'rating_educations')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == false) return "rating_educations_empty";
$sql = "update `{rating_educations}` set verify_userid='{$data['verify_userid']}
',verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id='{$data['id']}
'";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "educations";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function GetEducationsList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
%'";
}
$field = " p1.*,p2.username ";
$_order = "p1.id desc";
$sql = "select SELECT from `{}` as p1 left join  SQL ORDER ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'rating_educations')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_educations')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_educations')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetEducationsOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_educations_id_empty";
$result = M ( 'rating_educations')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_educations_empty";
return $result;
}
public static function AddJob($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "rating_job_name_empty";
}
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_job_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ={$data['username']}
")->field ( 'user_id')->find ();
if ($result == null) return "rating_job_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_job')->add ( $data );
}
public static function AddAssets($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "rating_assets_name_empty";
}
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_assets_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ={$data['username']}
")->field ( 'user_id')->find ();
if ($result == null) return "rating_assets_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_assets')->add ( $data );
}
public static function AddFinance($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "rating_finance_name_empty";
}
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_finance_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->find ();
if ($result == null) return "rating_finance_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
$ind = M ( 'rating_finance')->add ( $data );
$res = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and type='finance_credit'")->find ();
if ($res == false) 
{
$credit_log ['user_id'] = $data ['user_id'];
$credit_log ['nid'] = "finance_credit";
$credit_log ['code'] = "approve";
$credit_log ['type'] = "finance_credit";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['user_id'];
$credit_log ['remark'] = "填写财务信息获得的积分";
\creditClass::ActionCreditLog ( $credit_log );
}
return $ind;
}
public static function AddInfo($data = array()) 
{
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_info_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == null) return "rating_info_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_info')->add ( $data );
}
public static function AddHouse($data = array()) 
{
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_house_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == null) return "rating_house_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_houses')->add ( $data );
}
public static function AddCompany($data = array()) 
{
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_company_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( ' user_id')->find ();
if ($result == null) return "rating_company_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_company')->add ( $data );
}
public static function AddContact($data = array()) 
{
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_contact_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->where ( "username ='{$data['username']}
'")->field ( 'user_id')->find ();
if ($result == null) return "rating_contact_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
return M ( 'rating_contact')->add ( $data );
}
public static function UpdateJob($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ={$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ={$data['user_id']}
";
}
return M ( 'rating_job')->where ( $_sql )->save ( $data );
}
public static function UpdateAssets($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ={$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id = {$data['user_id']}
";
}
return M ( 'rating_assets')->where ( $_sql )->save ( $data );
}
public static function UpdateInfo($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ={$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ={$data['user_id']}
";
}
return M ( 'rating_info')->where ( $_sql )->save ( $data );
}
public static function UpdateFinance($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ={$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id = {$data['user_id']}
";
}
return M ( 'rating_finance')->where ( $_sql )->save ( $data );
}
public static function UpdateContact($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id = {$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ={$data['user_id']}
";
}
return M ( 'rating_contact')->where ( $_sql )->save ( $data );
}
public static function UpdateCompany($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ={$data['id']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id = {$data['user_id']}
";
}
return M ( 'rating_company')->where ( $_sql )->save ( $data );
}
public static function DelJob($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_job_id_empty";
$sql = "delete from `{rating_job}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function DelInfo($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_info_id_empty";
$sql = "delete from `{rating_info}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function DelAssets($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_assets_id_empty";
$sql = "delete from `{rating_assets}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function DelFinance($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_finance_id_empty";
$sql = "delete from `{rating_finance}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function DelCompany($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_company_id_empty";
$sql = "delete from `{rating_company}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function DelContact($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_contact_id_empty";
$sql = "delete from `{rating_contact}`  where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function CheckJobOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_job_id_empty";
$result = M ( 'rating_job')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_job_empty";
$sql = "update `{rating_job}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "job";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function CheckAssetsOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_assets_id_empty";
$result = M ( 'rating_assets')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_assets_empty";
$sql = "update `{rating_assets}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "assets";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function CheckFinanceOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_finance_id_empty";
$result = M ( 'rating_finance')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_finance_empty";
$sql = "update `{rating_finance}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "finance";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function CheckInfoOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_info_id_empty";
$result = M ( 'rating_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_info_empty";
$sql = "update `{rating_info}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "info";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function CheckCompanyOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_company_id_empty";
$result = M ( 'rating_company')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_company_empty";
$sql = "update `{rating_company}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "company";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function GetJobList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_job')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_job')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_job')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetAssetsList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_assets')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $offset )->order ( $_order )->select ();
}
$row = M ( 'rating_assets')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_assets')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'page'=>$data ['page'], 'epage'=>$data ['epage'], 'total_page'=>$total_page );
return $result;
}
public static function GetFinanceList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['use_type'] ) != false) 
{
$_sql .= " and p1.use_type ='{$data['use_type']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id ={$data['user_id']}
";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_finance')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_finance')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_finance')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function GetInfoList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$list = M ( 'rating_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetJobOne($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_job')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_job_empty";
return $result;
}
public static function GetInfoOne($data = array()) 
{
$_sql = " 1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_info')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null||$result==false) return "rating_info_empty";
return $result;
}
public static function GetAssetsOne($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_assets')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_assets_empty";
return $result;
}
public static function GetCompanyList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
%'";
}
$field = "p1.*,p2.username ";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'rating_company')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_company')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_company')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetCompanyOne($data = array()) 
{
$_sql = " 1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_company')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( "p1.*,p2.username")->find ();
if ($result == false) return "rating_company_empty";
return $result;
}
public static function ACtionHouse($data = array()) 
{
if (!IsExiest ( $data ['username'] ) &&!IsExiest ( $data ['user_id'] )) 
{
return "rating_house_user_must_one";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M ( 'users')->field ( 'user_id')->where ( "username ='{$data['username']}
'")->find ();
if ($result == null) return "rating_house_username_not_exiest";
$data ['user_id'] = $result ['user_id'];
unset ( $data ['username'] );
}
$result = M ( 'rating_houses')->where ( "user_id={$data['user_id']}
")->field ( ' count(1) as num')->find ();
if ($result ['num'] >0) 
{
M ( 'rating_houses')->where ( "user_id={$data['user_id']}
")->save ( $data );
return $data ['id'];
}
else 
{
return M ( 'rating_house')->add ( $data );
}
}
public static function CheckHouseOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_house_id_empty";
$result = M ( 'rating_houses')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == false) return "rating_job_empty";
$sql = "update `{rating_houses}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status={$data['status']}
where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "house";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function CheckContactOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "rating_contact_id_empty";
$result = M ( 'rating_contact')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( "id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "rating_contact_empty";
$sql = "update `{rating_contact}` set verify_userid={$data['verify_userid']}
,verify_remark='{$data['verify_remark']}
', verify_time='".time () ."',status='{$data['status']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$_data ["user_id"] = $result ["user_id"];
$_data ["result"] = $data ["status"];
$_data ["code"] = "rating";
$_data ["type"] = "contact";
$_data ["article_id"] = $data ["id"];
$_data ["verify_userid"] = $data ["verify_userid"];
$_data ["remark"] = $data ["verify_remark"];
\usersClass::AddExamine ( $_data );
return $data ['id'];
}
public static function GetHouseList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_houses')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_houses')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_houses')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetContactList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.nid ='{$data['nid']}
'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and p1.name like '%{$data['name']}
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
return M ( 'rating_contact')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'rating_contact')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'rating_contact')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id ') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetContactOne($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_contact')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null) 
{
M ( 'rating_contact')->add ( array ( 'user_id'=>$data ['user_id'] ) );
self::GetContactOne ( $data );
}
return $result;
}
public static function GetHouseOne($data = array()) 
{
$_sql = "1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
$result = M ( 'rating_houses')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null) 
{
M ( 'rating_houses')->add ( array ( 'user_id'=>$data ['user_id'] ) );
self::GetHouseOne ( $data );
}
return $result;
}
public static function GetFinanceOne($data = array()) 
{
$_sql = " 1=1";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and p1.id = '{$data['id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['use_type'] ) != false) 
{
$_sql .= " and p1.use_type = '{$data['use_type']}
'";
}
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.status = '{$data['status']}
'";
}
$result = M ( 'rating_finance')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( 'p1.*,p2.username')->find ();
if ($result == null) 
{
$sql = "insert into `{rating_finance}` set user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
self::GetFinanceOne ( $data );
}
return $result;
}
}
