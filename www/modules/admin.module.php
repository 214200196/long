
<?php
class moduleClass 
{
	function GetModuleList($data = array()) 
	{
		if ($data ['type'] == "system") 
		{
			$_sql = "  type='system' ";
		}
		elseif ($data ['type'] == "all") 
		{
			$_sql = "  1=1 ";
		}
		else 
		{
			$_sql = "  type!='system' ";
		}
		$data ['nid'] = isset ( $data ['nid'] ) ?$data ['nid'] : "";
		if (IsExiest ( $data ['nid'] ) != false) 
		{
			$_sql .= " and p1.nid ='{$data['nid']}
		'";
	}
	$data ['name'] = isset ( $data ['name'] ) ?$data ['name'] : "";
	if (IsExiest ( $data ['name'] ) != false) 
	{
		$_sql .= " and p1.name like '%{$data['name']}
	%'";
}
$_select = " p1.* ";
$_order = "  p1.id desc";
$_limit = "";
if (IsExiest ( $data ['limit'] ) != false) 
{
	if ($data ['limit'] != "all") 
	{
		$_limit = $data ['limit'];
	}
	return M ( 'modules')->alias ( 'p1')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'modules')->alias ( 'p1')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'modules')->alias ( 'p1')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetModule($data) 
{
global $mysql;
if (!IsExiest ( $data ['nid'] )) return "admin_module_nid_empty";
$result = M('modules')->where("nid='{$data['nid']}
'")->find();
if ($result == null) 
{
$code = $data ['nid'];
$result = array_merge ( self::GetModuleInfo ( $code ),array ( "code"=>$code ) );
$result ['nid'] = $result ['code'];
return $result;
}
else 
{
return $result;
}
}
public static function GetModulePurview($data) 
{
global $_G;
$_sql = "";
$result = $_G ['module'];
$_purview = array ();
if ($result != false) 
{
foreach ( $result as $key =>$value ) 
{
if ($value ['purview'] != "") 
{
	$_purview = array_merge ( $_purview,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
}
if (IsExiest ( $data ['code'] ) != false) 
{
$_purview [$data ['code']] ['result'] = isset ( $_purview [$data ['code']] ['result'] ) ?$_purview [$data ['code']] ['result'] : "";
$result = $_purview [$data ['code']] ['result'];
if (IsExiest ( $data ['type_id'] != 1 )) 
{
	if (IsExiest ( $data ['purview'] ) != false) 
	{
		$purview = explode ( ",",$data ['purview'] );
		$_result = array ();
		if ($result != "") 
		{
			foreach ( $result as $key =>$value ) 
			{
				if (in_array ( $key,$purview )) 
				{
					$_result [$key] = $value;
				}
			}
		}
		$result = $_result;
	}
}
return $result;
}
else 
{
return $_purview;
}
}
else 
{
return $result;
}
}
public static function GetModuleAdmin($data) 
{
if (isset ( $data ['user_id'] ) &&$data ['user_id'] == "") 
{
return "";
}
$result = M ( 'admin')->alias ( 'p1')->join ( presql ( "{admin_type} as p2 on p1.type_id=p2.id") )->where ( "p1.id={$data['user_id']}
")->field ( 'p1.*,p2.purview')->find ();
$purview = explode ( ",",$result ['purview'] );
$module_result = M ( 'modules')->order ( '`order` desc,id desc')->select ();
$purview_all = array ();
$purview_top = array ();
$purview_other = array ();
$_purview_top_first = array ( 'approve', 'borrow', 'account', 'system', 'users', 'articles' );
$_purview_other_first = array ( 'linkages', 'message', 'areas', 'linkages', );
$i = 0;
foreach ( $module_result as $key =>$value ) 
{
if ($value ['purview'] != ""&&$value ["type"] != 'system') 
{
if ($value ['status'] == 1 &&$i <6) 
{
$purview_top = array_merge ( $purview_top,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
$i ++;
}
else 
{
$purview_other = array_merge ( $purview_other,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
}
else 
{
$purview_top_other = array_merge ( $purview_top,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
$purview_all = array_merge ( $purview_all,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
if ($result ['type_id'] == 1) 
{
$module_system_result = M ( "modules")->where ( "type='system'")->order ( '`order` desc,id desc')->select ();
foreach ( $module_system_result as $key =>$value ) 
{
if (in_array ( $value ['nid'],$_purview_top_first ) ||$value ['nid'] == "admin") 
{
$purview_top = array_merge ( $purview_top,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
if (in_array ( $value ['nid'],$_purview_other_first )) 
{
$purview_other = array_merge ( $purview_other,unserialize ( html_entity_decode ( $value ['purview'] ) ) );
}
}
return array ( "all"=>$purview_all, "top"=>$purview_top, "other"=>$purview_other, "purview"=>"" );
}
else 
{
$_purview_all = array ();
foreach ( $purview_top_other as $key =>$value ) 
{
foreach ( ( array ) $value ['result'] as $_key =>$_value ) 
{
if (in_array ( $_key,$purview )) 
{
	$_purview_top [$key] = $value;
}
}
}
foreach ( $purview_all as $key =>$value ) 
{
foreach ( ( array ) $value ['result'] as $_key =>$_value ) 
{
if (in_array ( $key,$_purview_top_first ) &&in_array ( $_key,$purview )) 
{
	$_purview_top [$key] = $value;
}
}
}
foreach ( $purview_all as $key =>$value ) 
{
foreach ( ( array ) $value ['result'] as $_key =>$_value ) 
{
if (in_array ( $_key,$purview )) 
{
	$_purview_all [$key] = $value;
}
if (in_array ( $key,$_purview_other_first ) &&in_array ( $_key,$purview )) 
{
	$_purview_other [$key] = $value;
}
}
}
foreach ( $purview_other as $key =>$value ) 
{
foreach ( ( array ) $value ['result'] as $_key =>$_value ) 
{
if (in_array ( $_key,$purview )) 
{
	$_purview_other [$key] = $value;
}
}
}
}
return array ( "all"=>$_purview_all, "top"=>$_purview_top, "other"=>$_purview_other, "purview"=>$purview );
}
}
