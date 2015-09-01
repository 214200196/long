
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("credit.model.php");
class creditClass 
{
	public static function GetUserCredit($data = array()) 
	{
		$mysql = M ();
		$result = $mysql->table ( presql ( "{credit_log} as p1 ,{credit_type} as p2 ,{credit_class} as p3") )->where ( "p1.user_id={$data['user_id']}
	and p2.nid=p1.nid and p2.class_id=p3.id")->field ( "sum(p1.credit) as num,p3.nid")->group ( 'p3.nid')->select ();
	$_result = array ();
	if ($result != false &&$result != NULL) 
	{
		foreach ( $result as $key =>$value ) 
		{
			$_result [$value ['nid']] = $value ['num'];
		}
	}
	return $_result;
}
public static function GetClassList($data = array()) 
{
	$_sql = "  1=1 ";
	$_select = " p1.*";
	$_order = "p1.id desc";
	$_limit = "";
	$data ['limit'] = isset ( $data ['limit'] ) ?$data ['limit'] : "";
	if (IsExiest ( $data ['limit'] ) != false) 
	{
		if ($data ['limit'] != "all") 
		{
			$_limit = $data ['limit'];
		}
		return M ( 'credit_class')->alias ( 'p1')->where ( $_sql )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
	}
	$row = M ( 'credit_class')->alias ( 'p1')->where ( $_sql )->count ();
	$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
	$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
	$Page = new \Think\Page ( $row,$data ['epage'] );
	$show = $Page->show ();
	$list = M ( 'credit_class')->alias ( 'p1')->where ( $_sql )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetClassOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_class_id_empty";
$sql = "select p1.* from `{}` as p1 where p1.}";
$result = M ( 'credit_class')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "credit_class_not_exiest";
return $result;
}
public static function AddClass($data = array()) 
{
if (!IsExiest ( $data ['name'] )) return "credit_class_name_empty";
if (!IsExiest ( $data ['nid'] )) return "credit_class_nid_empty";
$result = M ( 'credit_class')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != null) return "credit_class_nid_exiest";
$id = M ( 'credit_class')->add ( $data );
return $id;
}
public static function UpdateClass($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_class_id_empty";
if (!IsExiest ( $data ['name'] )) return "credit_class_name_empty";
if (!IsExiest ( $data ['nid'] )) return "credit_class_nid_empty";
$result = M ( 'credit_class')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != null) return "credit_class_nid_exiest";
M ( 'credit_class')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
function DeleteClass($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_class_id_empty";
$result = M ( 'credit_type')->where ( "FIND_IN_SET('{$data['id']}
',class_id)")->find ();
if ($result != null) return "credit_class_del_type_exiest";
$sql = "select 1 from `{}` where ";
$result = M ( 'credit_rank')->where ( "FIND_IN_SET('{$data['id']}
',class_id)")->find ();
if ($result != null) return "credit_class_del_rank_exiest";
M ( 'credit_class')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function GetTypeList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and `name` like '%{$data['name']}
%'";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and nid like '%{$data['nid']}
%'";
}
if (IsExiest ( $data ['code'] ) != false) 
{
$_sql .= " and code = '{$data['code']}
'";
}
$_order = "id desc";
$sql = "select SELECT from `{}` as p1  SQL ORDER LIMIT ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'credit_type')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'credit_type')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'credit_type')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetTypeOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_type_id_empty";
$result = M ( 'credit_type')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "credit_type_not_exiest";
return $result;
}
public static function AddType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) return "credit_type_name_empty";
if (!IsExiest ( $data ['nid'] )) return "credit_type_nid_empty";
if (!IsExiest ( $data ['value'] )) return "credit_type_value_empty";
if (!IsExiest ( $data ['class_id'] )) return "credit_type_class_id_empty";
if ($data ['cycle'] == 2 &&$data ['award_times'] == "") 
{
return "credit_type_award_times_empty";
}
if ($data ['cycle'] == 3 &&$data ['interval'] == "") 
{
return "credit_type_interval_empty";
}
$result = M ( 'credit_type')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != null) return "credit_type_nid_exiest";
$id = M ( 'credit_type')->add ( $data );
return $id;
}
public static function UpdateType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_type_id_empty";
if (!IsExiest ( $data ['name'] )) return "credit_type_name_empty";
if (!IsExiest ( $data ['nid'] )) return "credit_type_nid_empty";
$result = M ( 'credit_type')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != null) return "credit_type_nid_exiest";
$result = M ( 'credit_type')->where ( "id={$data['id']}
")->find ();
if ($result ['nid'] != $data ['nid']) 
{
$result = M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{credit_type}` as p2 on p1.nid=p2.nid') )->where ( "p2.id={$data['id']}
")->find ();
if ($result != null) return "credit_type_update_credit_exiest";
}
M ( 'credit_type')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function DeleteType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_type_id_empty";
$sql = "select nid from `{}` where";
$result = M ( 'credit_type')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "credit_type_not_exiest";
M ( 'credit_type')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function GetRankList($data = array()) 
{
$_sql = "1=1 ";
$data ['class_id'] = isset ( $data ['class_id'] ) ?$data ['class_id'] : "";
if (IsExiest ( $data ['class_id'] ) != false) 
{
$_sql .= " and p1.`class_id` = '{$data['class_id']}
'";
}
$_select = " p1.*,p2.nid as class_nid";
$_order = "p1.id desc";
$_limit = "";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'credit_rank')->alias ( 'p1')->join ( presql ( '`{credit_class}` as p2 on p1.class_id=p2.id') )->where ( $_sql )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'credit_rank')->alias ( 'p1')->join ( presql ( '`{credit_class}` as p2 on p1.class_id=p2.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'credit_rank')->alias ( 'p1')->join ( presql ( '`{credit_class}` as p2 on p1.class_id=p2.id') )->where ( $_sql )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetRankOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_rank_id_empty";
$result = M ( 'credit_rank')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "credit_rank_not_exiest";
return $result;
}
public static function AddRank($data = array()) 
{
if (!IsExiest ( $data ['name'] )) return "credit_rank_name_empty";
$id = M ( 'credit_rank')->add ( $data );
return $id;
}
public static function UpdateRank($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_rank_id_empty";
if (!IsExiest ( $data ['name'] )) return "credit_rank_name_empty";
M ( 'credit_rank')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function DeleteRank($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_rank_id_empty";
$sql = "delete from `{}` where ";
M ( 'credit_rank')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function GetLogList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['class_id'] ) != false) 
{
$_sql .= " and p1.`class_id` = '{$data['class_id']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.`user_id` = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.`username` like '%".urldecode ( $data ['username'] ) ."%'";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and p1.`nid` like '%{$data['nid']}
%'";
}
$field = " p1.*,p2.username,p3.name as type_name,p3.class_id";
$_order = "p1.id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{credit_type}` as p3 on p1.nid=p3.nid') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{credit_type}` as p3 on p1.nid=p3.nid') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{credit_type}` as p3 on p1.nid=p3.nid') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetLogOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "credit_log_id_empty";
$result = M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{credit_type}` as p3 on p1.nid=p3.nid') )->where ( "p1.id={$data['id']}
")->field ( 'p1.*,p2.username,p3.name as type_name,p3.class_id')->find ();
if ($result == null) return "credit_log_not_exiest";
return $result;
}
public static function ActionCreditLog($data) 
{
$_nid = explode ( ",",$data ['nid'] );
M ( 'credit_log')->where ( "code='{$data['code']}
'  and type='{$data['type']}
' and article_id='{$data['article_id']}
' and nid not in ('{$data['nid']}
')")->delete ();
if (count ( $_nid ) >0) 
{
foreach ( $_nid as $key =>$nid ) 
{
if ($nid != "") 
{
if (isset ( $data ['value'] ) &&$data ['value'] != "") 
{
$_value = $data ['value'];
}
else 
{
$result = M ( 'credit_type')->where ( "nid='{$nid}
'")->find ();
$_value = $result ['value'];
}
$sql = "insert into `{credit_log}` set code='{$data['code']}
',user_id='{$data['user_id']}
',`value`='{$_value}
',`credit`='{$_value}
',type='{$data['type']}
',article_id='{$data['article_id']}
',nid='{$nid}
',addtime='{$data['addtime']}
',remark='{$data['remark']}
'";
$data ['value'] = $_value;
$data ['credit'] = $_value;
$data ['nid'] = $nid;
M ( 'credit_log')->add ( $data );
}
}
self::ActionCredit ( array ( "user_id"=>$data ['user_id'] ) );
}
}
public static function DeleteCreditLog($data) 
{
$result = M ( 'credit_log')->where ( "code='{$data['code']}
'  and type='{$data['type']}
' and article_id={$data['article_id']}
")->field ( 'user_id')->find ();
$user_id = $result ['user_id'];
$sql = "delete from `{credit_log}` where code='{$data['code']}
'  and type='{$data['type']}
' and article_id={$data['article_id']}
";
M ()->execute ( presql ( $sql ) );
self::ActionCredit ( array ( "user_id"=>$user_id ) );
}
public static function ActionCredit($data) 
{
$result = M ( 'credit_log')->alias ( 'p1')->join ( presql ( '`{credit_type}` as p2 on p1.nid=p2.nid') )->where ( "p1.user_id={$data['user_id']}
")->group ( 'p2.class_id')->field ( 'sum(p1.credit) as num,p2.class_id')->order ( 'p2.class_id desc')->select ();
$credits = serialize ( $result );
$result = M ( 'credit')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == NULL) 
{
$indata ['user_id'] = $data ['user_id'];
$indata ['credits'] = $credits;
M ( 'credit')->add ( $indata );
}
else 
{
$udata ['credits'] = $credits;
M ( 'credit')->where ( "user_id={$data['user_id']}
")->save ( $udata );
}
self::CountCredit ( array ( "user_id"=>$data ['user_id'], "type"=>"catoreasy" ) );
}
public static function UpdateCredit($data) 
{
M ( 'credit_log')->where ( "id={$data['id']}
and user_id={$data['user_id']}
")->setField ( 'credit',$data ['credit'] );
self::ActionCredit ( array ( "user_id"=>$data ["user_id"] ) );
return $data ['id'];
}
public static function GetList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.`username` like '%".urldecode ( $data ['username'] ) ."%'";
}
$field = " p1.*,p2.username";
$_order = " p1.id desc";
$result_type = self::GetClassList ( array ( "limit"=>"all" ) );
foreach ( $result_type as $key =>$value ) 
{
$_type_credit [$value ['id']] ['num'] = 0;
$_type_credit [$value ['id']] ['class_id'] = $value ['id'];
}
$row = M ( 'credit')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$_list = M ( 'credit')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->order ( $_order )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
if ($_list != false) 
{
foreach ( $_list as $key =>$value ) 
{
$list [$key] ["username"] = $value ['username'];
$list [$key] ["user_credit"] = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$list [$key] ["user_gold"] = self::GetGoldCount ( array ( "user_id"=>$value ['user_id'] ) );
$list [$key] ["credits"] = $_type_credit;
if ($value ['credits'] != "") 
{
$credits = unserialize ( $value ['credits'] );
foreach ( $credits as $_key =>$_value ) 
{
$list [$key] ["credits"] [$_value ['class_id']] = $_value;
}
}
}
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function CountCredit($data) 
{
if ($data ['type'] == "catoreasy") 
{
$result = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$data ['user_id'] ) );
$udata ['credit'] = $result ['credit_total'];
M ( 'credit')->where ( "user_id={$data['user_id']}
")->save ( $udata );
}
}
function GetCreditCount($data) 
{
$result = M ( 'credit_log')->where ( "user_id={$data['user_id']}
")->field ( 'sum(credit) as num,type')->group ( 'type')->select ();
$_result = array ();
if ($result != false) 
{
foreach ( $result as $key =>$value ) 
{
$_result [$value ['type']] = $value ['num'];
}
}
return $_result;
}
function GetGoldCount($data = array()) 
{
if ($data ['user_id'] == "") return false;
$result = M ( 'credit_log')->where ( "user_id ={$data['user_id']}
and nid='invite'")->field ( 'sum(credit) as invite_gold')->find ();
$gold ['invite_gold'] = $result ['invite_gold'];
$result = M ( 'credit_log')->where ( "user_id = {$data['user_id']}
and nid='vip_gold'")->field ( 'sum(credit) as vip_gold')->find ();
$gold ['vip_gold'] = $result ['vip_gold'];
$result = M ( 'credit_log')->where ( "user_id = {$data['user_id']}
and nid='reg'")->field ( 'sum(credit) as reg_gold')->find ();
$gold ['reg'] = $result ['reg_gold'];
$gold ['invite_tender'] = 0;
$result = M ( 'users_friends_invite')->where ( "user_id = {$data['user_id']}
")->select ();
if ($result >0) 
{
foreach ( $result as $key =>$value ) 
{
$result = M ( 'borrow_count')->where ( "user_id = {$value['friends_userid']}
")->find ();
$gold ['invite_tender'] += $result ['tender_success_account'];
}
}
$gold ['invite_tender'] = floor ( $gold ['invite_tender'] / 5000 );
$sql = "select  from `{}` where ";
$result = M ( 'borrow_count')->where ( "user_id = {$data['user_id']}
")->field ( 'tender_success_account')->find ();
$gold ['tender'] = floor ( $result ['tender_success_account'] / 10000 );
$gold ['total'] = $gold ['invite_tender'] +$gold ['invite_gold'] +$gold ['tender'] +$gold ['reg'] +$gold ['vip_gold'];
return $gold;
}
public static function GetOne($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "credit_user_id_empty";
$result = M ( 'credit')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == null) 
{
M ( 'credit')->add ( array ( 'user_id'=>$data ['user_id'] ) );
$result = self::GetOne ( $data );
}
return $result;
}
public static function GetUserRank($data) 
{
$result = M ( 'credit_class')->where ( "nid='{$data['nid']}
'")->find ();
$class_id = $result ['id'];
$result = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and code='{$data['code']}
'")->field ( 'sum(credit) as num ')->find ();
if ($result == null) return "";
$attcredit = M ( 'attestations')->where ( "user_id={$data['user_id']}
")->field ( 'sum(credit) as num')->find ();
$credit = $result ['num'] +$attcredit ['num'];
$result = M ( 'credit_rank')->where ( "class_id={$class_id}
and point1<={$credit}
and point2>={$credit}
")->find ();
return $result;
}
}
?>