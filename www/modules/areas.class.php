
<?php
if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
global $MsgInfo;
require_once ("areas.model.php");
class areasClass 
{
	public static function GetAreas($data = array()) 
	{
		$_limit = "";
		if (IsExiest ( $data ['excel'] ) == "true") 
		{
		}
		elseif (IsExiest ( $data ['limit'] ) != false) 
		{
			if ($data ['limit'] != "all") 
			{
				$_limit = $data ['limit'];
			}
			return M ( 'areas')->limit ( $_limit )->select ();
		}
		$row = M ( 'areas')->count ();
		$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
		$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
		$Page = new \Think\Page ( $row,$data ['epage'] );
		$show = $Page->show ();
		$list = M ( 'areas')->page ( $data ['page'] .",{$data ['epage']}
	")->select ();
	$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
	return $result;
}
public static function GetList($data = array()) 
{
	global $_G;
	$_sql = " 1=1 ";
	if (IsExiest ( $data ['user_id'] ) != false) 
	{
		$_sql .= " and p1.user_id = '{$data['user_id']}
	'";
}
if ($data ['type'] == "province") 
{
	$result = self::GetProvince ( $data );
}
elseif ($data ['type'] == "city") 
{
	$result = self::GetCity ( $data );
}
elseif ($data ['type'] == "area") 
{
	$result = self::GetArea ( $data );
}
else 
{
	$result= $_G ['areas'];
}
$total = count ( $result );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$total_page = ceil ( $total / $data ['epage'] );
$_epage = $data ['epage'] * ($data ['page'] -1);
$Page = new \Think\Page ( $total,$data ['epage'] );
$show = $Page->show ();
if ($total >0) 
{
	foreach ( $result as $key =>$value ) 
	{
		if ($key >= $_epage &&$key <$_epage +$data ['epage']) 
		{
			$_result [$key] = $value;
		}
	}
}
$result = array ( 'list'=>$_result ?$_result : array (), 'page'=>$show, );
return $result;
}
public static function GetProvince($data = array()) 
{
global $_G;
if (!IsExiest ( $_G ['areas'] )) return "areas_data_empty";
$result = array ();
$i = 0;
foreach ( $_G ['areas'] as $key =>$value ) 
{
	if ($value ['province'] == 0) 
	{
		if (IsExiest ( $data ['limit'] ) != false) 
		{
			if ($data ['limit'] == "all") 
			{
				$result [] = $value;
			}
			else 
			{
				if ($data ["limit"] >$i) 
				{
					$result [] = $value;
				}
				$i ++;
			}
		}
		else 
		{
			$result [] = $value;
		}
	}
}
return $result;
}
public static function GetCity($data = array()) 
{
global $_G;
if (!IsExiest ( $_G ['areas'] )) return "areas_data_empty";
$result = array ();
if (IsExiest ( $data ['id'] ) != false) 
{
	foreach ( $_G ['areas'] as $key =>$value ) 
	{
		if (($value ['province'] == $data ['id'] &&$value ['city'] == 0)) 
		{
			if (IsExiest ( $data ['limit'] ) != false) 
			{
				if ($data ['limit'] == "all") 
				{
					$result [] = $value;
				}
				else 
				{
					if ($data ["limit"] >$i) 
					{
						$result [] = $value;
					}
					$i ++;
				}
			}
			else 
			{
				$result [] = $value;
			}
		}
	}
}
else 
{
	foreach ( $_G ['areas'] as $key =>$value ) 
	{
		if (($value ['province'] >0 &&$value ['city'] == 0)) 
		{
			if (IsExiest ( $data ['limit'] ) != false) 
			{
				if ($data ['limit'] == "all") 
				{
					$result [] = $value;
				}
				else 
				{
					if ($data ["limit"] >$i) 
					{
						$result [] = $value;
					}
					$i ++;
				}
			}
			else 
			{
				$result [] = $value;
			}
		}
	}
}
return $result;
}
public static function GetArea($data = array()) 
{
global $_G;
if (!IsExiest ( $_G ['areas'] )) return "areas_data_empty";
$result = array ();
if (IsExiest ( $data ['id'] ) != false) 
{
	foreach ( $_G ['areas'] as $key =>$value ) 
	{
		if ($value ['province'] >0 &&$value ['city'] == $data ['id']) 
		{
			if (IsExiest ( $data ['limit'] ) != false) 
			{
				if ($data ['limit'] == "all") 
				{
					$result [] = $value;
				}
				else 
				{
					if ($data ["limit"] >$i) 
					{
						$result [] = $value;
					}
					$i ++;
				}
			}
			else 
			{
				$result [] = $value;
			}
		}
	}
}
else 
{
	foreach ( $_G ['areas'] as $key =>$value ) 
	{
		if ($value ['province'] >0 &&$value ['city'] >0) 
		{
			if (IsExiest ( $data ['limit'] ) != false) 
			{
				if ($data ['limit'] == "all") 
				{
					$result [] = $value;
				}
				else 
				{
					if ($data ["limit"] >$i) 
					{
						$result [] = $value;
					}
					$i ++;
				}
			}
			else 
			{
				$result [] = $value;
			}
		}
	}
}
return $result;
}
public static function GetOne($data = array()) 
{
$id = $data ['id'];
if ($id == "") return "";
$id = $data ['id'];
return M ( 'areas')->where ( "id=$id")->find ();
}
public static function Add($data = array()) 
{
if (!IsExiest ( $data ['name'] )) 
{
	return "areas_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
	return "areas_nid_empty";
}
$result = M ( 'areas')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != false) return "areas_nid_exiest";
return M ( 'areas')->add ( $data );
}
public static function Update($data = array()) 
{
if (!IsExiest ( $data ['id'] )) 
{
return "areas_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
return "areas_name_empty";
}
if (!IsExiest ( $data ['nid'] )) 
{
return "areas_nid_empty";
}
$result = M ( 'areas')->where ( "nid='{$data['nid']}
' and id !={$data['id']}
")->find ();
if ($result != false) return "areas_nid_exiest";
M ( 'areas')->save ( $data );
return $data ['id'];
}
public static function Delete($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "areas_id_empty";
$result = M ( 'areas')->where ( "province={$data[id]}
")->find ();
if ($result != false) return "areas_del_city_not_empty";
$result = M ( 'areas')->where ( "city={$data[id]}
")->find ();
if ($result != false) return "areas_del_area_not_empty";
M ( 'areas')->where ( "id  ={$data['id']}
")->delete ();
return $data ['id'];
}
public static function Action($data = array()) 
{
global $mysql;
if (count ( $data ['order'] ) >0) 
{
foreach ( $data ['order'] as $key =>$value ) 
{
$sql = "update `{areas}` set `order` = '{$value}
'  where id ='{$data['id'][$key]}
'";
M ()->execute ( presql ( $sql ) );
}
}
return true;
}
public static function GetProvinceAll($data = array()) 
{
global $_G;
$_result = array ();
$areas = $data ['areas'];
foreach ( $areas as $key =>$value ) 
{
if ($value ['pid'] == 0) 
{
$letter = $value ['nid'] 
{
0}
;
$_result [$letter] [$key] ['letter'] = $letter;
$_result [$letter] [$key] ['id'] = $value ['id'];
$_result [$letter] [$key] ['name'] = $value ['name'];
$_result [$letter] [$key] ['nid'] = $value ['nid'];
}
}
ksort ( $_result );
return $_result;
}
public static function GetCityAll($data = array()) 
{
global $_G;
$_result = array ();
$areas = $data ['areas'];
foreach ( $areas as $key =>$value ) 
{
if ($value ['province'] >0 &&$value ['city'] == 0) 
{
$letter = $value ['nid'] 
{
0}
;
$_result [$letter] [$key] ['letter'] = $letter;
$_result [$letter] [$key] ['id'] = $value ['id'];
$_result [$letter] [$key] ['name'] = $value ['name'];
$_result [$letter] [$key] ['nid'] = $value ['nid'];
}
}
ksort ( $_result );
return $_result;
}
}
