
<?php
global $MsgInfo;
require_once ("linkages.model.php");
class linkagesClass 
{
	public static function GetList($data = array()) 
	{
		$where = " 1=1 ";
		$data ['type_id'] = isset ( $data ['type_id'] ) ?$data ['type_id'] : "";
		if (IsExiest ( $data ['type_id'] ) != false) 
		{
			$where .= " and p1.type_id ='{$data['type_id']}
		'";
	}
	$data ['name'] = isset ( $data ['name'] ) ?$data ['name'] : "";
	if (IsExiest ( $data ['name'] ) != false) 
	{
		$where .= " and p1.name like '%{$data['name']}
	%'";
}
$data ['limit'] = isset ( $data ['limit'] ) ?$data ['limit'] : "";
$_limit = "";
if (IsExiest ( $data ['limit'] ) != false) 
{
	if ($data ['limit'] != "all") 
	{
		$_limit = $data ['limit'];
	}
	return M ( 'linkages')->alias ( 'p1')->join ( presql ( '{linkages_type} as p2 on p1.type_id=p2.id') )->where ( $where )->limit ( $_limit )->field ( 'p1.* ,p2.code,p2.name as type_name,p2.nid as type_nid')->order ( 'p1.order desc ,p1.id asc')->select ();
}
$row = M ( 'linkages')->alias ( 'p1')->join ( presql ( '{linkages_type} as p2 on p1.type_id=p2.id') )->where ( $where )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'linkages')->alias ( 'p1')->join ( presql ( '{linkages_type} as p2 on p1.type_id=p2.id') )->where ( $where )->page ( $data ['page'] .",{$data ['epage']}
")->field ( 'p1.* ,p2.code,p2.name as type_name,p2.nid as type_nid')->order ( 'p1.order desc ,p1.id asc')->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
}
public static function GetOne($data = array()) 
{
global $mysql;
$id = $data ['id'];
if ($id == "") return self::ERROR;
return M('linkage')->where("id=$id")->find();
}
public static function Add($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "linkages_name_empty";
}
if (!IsExiest ( $data ['value'] ) &&$data ['value'] != 0) 
{
return "linkages_value_empty";
}
return M('linkages')->add($data);
}
public static function Update($data = array()) 
{
$id = $data ['id'];
if ($data ['name'] == ""||$data ['id'] == "") 
{
return self::ERROR;
}
$result = M('linkage')->where("id = $id")->save($data);
if ($result == false) return self::ERROR;
return true;
}
public static function Delete($data = array()) 
{
$id = $data ['id'];
if (!is_array ( $id )) 
{
$id = array ( $id );
}
M('linkages')->where("id in (".join ( ",",$id ) .")")->delete();
return $data ['id'];
}
public static function Action($data = array()) 
{
$name = $data ['name'];
$value = $data ['value'];
$order = $data ['order'];
$type = isset ( $data ['type'] ) ?$data ['type'] : "";
unset ( $data ['type'] );
if ($type == "add") 
{
$type_id = $data ['type_id'];
foreach ( $name as $key =>$val ) 
{
	if ($value [$key] == "") 
	{
		$value [$key] = $val;
	}
	if ($val != "") 
	{
		$sql = "insert into `{linkages}` set `type_id`=".$type_id .",`name`='".$name [$key] ."',`value`='".$value [$key] ."',`order`='".$order [$key] ."' ";
		M()->execute(presql($sql));
	}
}
}
else 
{
$id = $data ['id'];
foreach ( $id as $key =>$val ) 
{
	if ($name [$key] != "") 
	{
		$sql = "update `{linkages}` set `name`='".$name [$key] ."',`value`='".$value [$key] ."',`order`='".$order [$key] ."' where id=$val";
		M()->execute(presql($sql));
	}
}
}
return true;
}
public static function GetTypeList($data =array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['name'] ) != false) 
{
$_sql .= " and name like '%{$data['name']}
%'";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and nid  = '{$data['nid']}
'";
}
if (IsExiest ( $data ['code'] ) != false) 
{
$_sql .= " and code  = '{$data['code']}
'";
}
$_order = "`order` desc,id desc";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M('linkages_type')->where($_sql)->limit($_limit)->order($_order)->select();
}
$row = M('linkages_type')->where($_sql)->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M('linkages_type')->where($_sql)->page ( $data ['page'] .",{$data ['epage']}
")->order($_order)->select();
return array ( 'list'=>$list ?$list : array (), 'page'=>$show );
}
public static function GetType($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['id'] ) != false) 
{
$_sql .= " and id ='{$data['id']}
'";
;
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and nid  = '{$data['nid']}
'";
;
}
$result = M('linkages_type')->where($_sql)->find();
return $result;
}
public static function AddType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
return "linkages_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "linkages_type_nid_empty";
}
$result = M('linkages_type')->where("`nid` = '".$data ['nid'] ."'")->find();
if ($result != null) return "linkages_type_nid_exiest";
return M('linkages_type')->add($data);
}
public static function UpdateType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "linkages_type_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
return "linkages_type_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "linkages_type_nid_empty";
}
$result =M('linkages_type')->where("`nid` = '".$data ['nid'] ."' and id!='{$data['id']}
'")->find();
if ($result != null) return "linkages_type_nid_exiest";
M('linkages_type')->where("`id` ={$data['id']}
")->save($data);
return $data ['id'];
}
public static function DelType($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "linkages_type_id_empty";
}
$result =M('linkages')->where("type_id={$data['id']}
")->find();
if ($result != null) return "linkages_type_sub_exiest";
M('linkages_type')->where("id={$data['id']}
")->delete();
return $data ['id'];
}
public static function ActionType($data = array()) 
{
$nid = $data ['nid'];
$name = $data ['name'];
$order = $data ['order'];
$id = $data ['id'];
foreach ( $id as $key =>$val ) 
{
if ($name [$key] != "") 
{
$sql = "update {linkages_type} set `name`='".$name [$key] ."',`order`='".$order [$key] ."' where id={$val}
";
M()->execute(presql($sql));
}
}
return true;
}
}
