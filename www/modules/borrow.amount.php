<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。

//发现了time,请自行验证这套程序是否有时间限制.
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

class amountClass extends \autoClass 
{
	function GetAmountList($data = array()) 
	{
		$_sql = " 1=1 ";
		if (isset ( $data ['status'] ) &&$data ['status'] != "") 
		{
			$_sql .= " and p1.status = {$data['status']}
		";
	}
	if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
	{
		$_sql .= " and p1.user_id = {$data['user_id']}
	";
}
if (isset ( $data ['username'] ) &&$data ['username'] != "") 
{
	$_sql .= " and p2.username like '%{$data['username']}
%' ";
}
if (isset ( $data ['type'] ) &&$data ['type'] != "") 
{
$_sql .= " and p1.type like '%{$data['type']}
%' ";
}
$field = 'p1.*,p2.username';
$join = "{users} as p2 on p1.user_id=p2.user_id";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_amount')->alias ( 'p1')->join ( presql ( $join ) )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'borrow_amount')->alias ( 'p1')->join ( presql ( $join ) )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_amount')->alias ( 'p1')->join ( presql ( $join ) )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
if ($list != false) 
{
foreach ( $list as $key =>$value ) 
{
$list [$key] = self::GetAmountUsers ( array ( "user_id"=>$value ['user_id'], "amount_result"=>$value ) );
$list [$key] ['username'] = $value ['username'];
}
}
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'page'=>$show ) ;
return $result;
}
public static function GetAmountApplyList($data = array()) 
{
global $mysql;
$_sql = " 1=1 ";
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.status = {$data['status']}
";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%' ";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.type like '%{$data['type']}
%' ";
}
$_order = " p1.id desc";
$_select = 'p1.*,p2.username';
$_join = "{users} as p2 on p1.user_id=p2.user_id";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_amount_apply')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->limit ( $_limit )->field ( $_select )->order ( $_order )->select ();
}
$row = M ( 'borrow_amount_apply')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_amount_apply')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->field ( $_select )->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function AddAmountLog($data) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "amount_user_id_empty";
}
$result = M ( 'borrow_amount_log')->where ( "nid='{$data['nid']}
'")->find ();
if ($result == false) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'borrow_amount_log')->add ( $data );
}
if (strpos ( "borrrow",$data ['amount_type'] ) >0) 
{
$data ['amount_type'] = "borrow";
}
$usename = $data ['amount_type'] ."_use";
$reducename = $data ['amount_type'] ."_reduce";
$type = $data ['amount_type'];
$account = $data ['account'];
if ($data ['oprate'] == "reduce") 
{
$sql = "update `{borrow_amount}` set `{$usename}
`={$usename}
-$account,`{$reducename}
`={$reducename}
+$account where user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
else 
{
$sql = "update `{borrow_amount}` set `{$usename}
`={$usename}
+$account,`{$reducename}
`={$reducename}
-$account where user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
return $data ['user_id'];
}
function GetAmountLogList($data = array()) 
{
global $mysql;
$_sql = "  1=1 ";
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
if (IsExiest ( $data ['amount_type'] ) != false) 
{
$_sql .= " and p1.amount_type = '{$data['amount_type']}
'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and p1.type = '{$data['type']}
'";
}
$_select = " p1.*,p2.username";
$_order = "p1.id desc";
$_join = "`{users}` as p2 on p1.user_id=p2.user_id";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_amount_log')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'borrow_amount_log')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->count ();
$num_sql = "select p1.oprate,sum(p1.account) as num from `{borrow_amount_log}` as p1 left join `{users}` as p2 on p1.user_id=p2.user_id SQL group by p1.oprate ";
$num_result = M ( 'borrow_amount_log')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->field ( 'p1.oprate,sum(p1.account) as num')->group ( 'p1.oprate')->select ();
$_num_result = array ();
if ($num_result != false) 
{
foreach ( $num_result as $key =>$value ) 
{
$_num_result [$value ['oprate']] = $value ['num'];
}
}
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_amount_log')->alias ( 'p1')->join ( presql ( $_join ) )->where ( $_sql )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, "oprate_add"=>$_num_result ['add'], "oprate_reduce"=>$_num_result ['reduce'] );
return $result;
}
public static function AddAmountApply($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['user_id'] )) 
{
return "amount_user_id_empty";
}
$sql = "select 1 from `{borrow_amount}` where user_id='{$data['user_id']}
'";
$result = M ( 'borrow_amount')->where ( "user_id='{$data['user_id']}
'")->find ();
if ($result == false ||$result == NULL) 
{
M ( 'borrow_amount')->add ( array ( 'user_id'=>$data ['user_id'] ) );
}
$data ['nid'] = "apply".$data ['user_id'] .time () .rand ( 1,99 );
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'borrow_amount_apply')->add ( $data );
}
function GetAmountApplyOne($data) 
{
global $mysql;
$sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$sql .= " and p1.user_id={$data['user_id']}
 ";
}
if (IsExiest ( $data ['id'] ) != false) 
{
$sql .= " and p1.id={$data['id']}
";
}
if (IsExiest ( $data ['amount_type'] ) != false) 
{
$sql .= " and p1.amount_type='{$data['amount_type']}
' ";
}
$result = M ( 'borrow_amount_apply')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $sql )->order ( 'p1.id desc')->find ();
if ($result === false ||$result == NULL) return false;
return $result;
}
public static function CheckAmountApply($data) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "amount_apply_id_empty";
}
$result = self::GetAmountApplyOne ( array ( "id"=>$data ['id'] ) );
if ($result ['status'] != 0) 
{
return "amount_apply_check_yes";
}
$amount_type = $result ['amount_type'];
$user_id = $data ['user_id'];
if ($data ['status'] == 1) 
{
$_data ["user_id"] = $result ['user_id'];
$_data ["amount_type"] = $result ['amount_type'];
$_data ["type"] = "apply";
$_data ["oprate"] = $result ['oprate'];
$_data ["nid"] = $result ['nid'];
$_data ["account"] = $data ['account'];
$_data ["remark"] = "申请额度审核通过";
self::AddAmountLog ( $_data );
if ($result ['oprate'] == "reduce") 
{
$sql = "update {borrow_amount} set {$amount_type}
={$amount_type}
-{$data['account']}
where user_id={$result['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
else 
{
$sql = "update {borrow_amount} set {$amount_type}
={$amount_type}
+{$data['account']}
where user_id={$result['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
}
else 
{
$data ['account'] = 0;
}
$udata ['status'] = $data ['status'];
$udata ['verify_time'] = time ();
$udata ['verify_user'] = $data ['verify_userid'];
$udata ['verify_remark'] = $data ['verify_remark'];
$udata ['account'] = $data ['account'];
M ( 'borrow_amount_apply')->where ( "id = {$data['id']}
")->save ( $udata );
return $data ['id'];
}
function AddAmountType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "amount_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "amount_type_nid_empty";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M('borrow_amount_type')->where("nid ='{$data['nid']}
'")->find();
if ($result != null) return "amount_type_nid_exiest";
}
$data['addtime']=time();
$data['addip']=get_client_ip();
$data['updatetime']=time();
$data['updateip']=get_client_ip();
return M('borrow_amount_type')->add($data);
}
function UpdateAmountType($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['name'] )) 
{
return "amount_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "amount_type_nid_empty";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$result = M('borrow_amount_type')->where("nid ='{$data['nid']}
' and id!={$data['id']}
")->find();
if ($result != null) return "amount_type_nid_exiest";
}
$data['updatetime']=time();
$data['updateip']=get_client_ip();
M('borrow_amount_type')->where("id={$data['id']}
")->save($data);
return $data ['id'];
}
function DelAmountType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "amount_type_id_empty";
$sql = "delete from `{borrow_amount_type}`  where id='{$data['id']}
'";
M()->execute(presql($sql));
return $data ['id'];
}
function GetAmountTypeList($data = array()) 
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
$field = " p1.*,p2.name as credit_name ";
$_order = " order by p1.id desc";
$sql = "select SELECT from `{}` as p1 left join  SQL ORDER ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M('borrow_amount_type')->alias('p1')->join(presql('`{credit_class}` as p2 on p1.credit_nid=p2.nid'))->where($_sql)->field($field)->limit($_limit)->order($_order)->select();
}
$row = M('borrow_amount_type')->alias('p1')->join(presql('`{credit_class}` as p2 on p1.credit_nid=p2.nid'))->where($_sql)->count ();
$total = intval ( $row ['num'] );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M('borrow_amount_type')->alias('p1')->join(presql('`{credit_class}` as p2 on p1.credit_nid=p2.nid'))->where($_sql)->field($field)->page ( $data ['page'] .",{$data ['epage']}
")->order($_order)->select();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
function GetAmountTypeOne($data = array()) 
{
global $mysql;
if (!IsExiest ( $data ['id'] )) return "amount_type_id_empty";
$result =M('borrow_amount_type')->where("id={$data['id']}
")->find();
if ($result == null) return "amount_type_empty";
return $result;
}
public static function GetAmountUsers($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "amount_user_id_empty";
$borrow_first = 0;
if (isset ( $data ['amount_result'] ) &&$data ['amount_result'] != "") 
{
$result = $data ['amount_result'];
}
else 
{
$result = M ( 'borrow_amount')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == false) 
{
$idata ['user_id'] = $data ['user_id'];
M ( 'borrow_amount')->add ( $idata );
$result = M ( 'borrow_amount')->where ( "user_id='{$data['user_id']}
'")->find ();
}
}
$_result = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$data ['user_id'] ) );
$borrow_credit = ($_result ['approve_credit']) * 0 +$_result ['borrow_credit'];
$_data ["borrow_amount"] = $borrow_first +$borrow_credit +$result ['borrow'];
$_data ["borrow_amount_use"] = intval ( $borrow_first +$borrow_credit +$result ['borrow_use'] );
$_data ["borrow_amount_nouse"] = intval ( $_data ["borrow_amount"] -$_data ["borrow_amount_use"] );
return $_data;
}
}
