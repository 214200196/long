<?php
class linksClass 
{
	const ERROR = '操作有误，请不要乱操作';
	public static function GetList($data = array()) 
	{
		$_sql = " 1=1 ";
		if (IsExiest ( $data ['status'] ) != false) 
		{
			$_sql.=" and p1.status={$data ['status']}
		";
	}
	if (isset ( $data ['logo'] )) 
	{
		if ($data ['logo'] == "true") 
		{
			$_sql .= " and p1.logoimg!=''";
		}
		else 
		{
			$_sql .= " and p1.logoimg=''";
		}
	}
	if (isset ( $data ['type_id'] )) 
	{
		if ($data ['type_id'] >0) 
		{
			$_sql .= " and p1.type_id='".$data ['type_id'] ."'";
		}
	}
	$_select = 'p1.*,p2.typename,p3.fileurl ';
	$_limit='';
	if (IsExiest ( $data ['limit'] ) != false) 
	{
		if ($data ['limit'] != "all") 
		{
			$_limit = $data ['limit'];
		}
		$result = M ( 'links')->alias ( 'p1')->join ( presql ( '{links_type} as p2 on p1.type_id= p2.id') )->join ( presql ( '{users_upfiles} as p3 on p1.logoimg= p3.id') )->where ( $_sql )->limit ( $_limit)->field ( $_select )->select ();
		return $result;
	}
	$row = M ( 'links')->alias ( 'p1')->join ( presql ( '{links_type} as p2 on p1.type_id= p2.id') )->join ( presql ( '{users_upfiles} as p3 on p1.logoimg= p3.id') )->where ( $_sql )->count ();
	$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
	$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
	$Page = new \Think\Page ( $row,$data ['epage'] );
	$show = $Page->show ();
	$list = M ( 'links')->alias ( 'p1')->join ( presql ( '{links_type} as p2 on p1.type_id= p2.id') )->join ( presql ( '{users_upfiles} as p3 on p1.logoimg= p3.id') )->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->field ( $_select )->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function GetOne($data = array()) 
{
$id = $data ['id'];
return M ( 'links')->alias ( 'p1')->join ( presql ( '{users_upfiles} as p3 on p1.logoimg= p3.id') )->where ( "p1.id=$id")->field ( 'p1.*,p3.fileurl')->find ();
}
public static function Add($data = array()) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'links')->add ( $data );
}
public static function Update($data = array()) 
{
$id = $data ['id'];
if ($data ['id'] == "") 
{
	return self::ERROR;
}
return M ( 'links')->where ( "id =$id")->save ( $data );
}
public static function Delete($data = array()) 
{
$id = $data ['id'];
if (!is_array ( $id )) 
{
	$id = array ( $id );
}
$re=M ( 'links')->where ( "id in (".join ( ",",$id ) .")")->delete ();
if($re==0||$re==false) return false;
return true;
}
public static function GetTypeList($data = array()) 
{
return M ( 'links_type')->select ();
}
public static function GetTypeOne($data = array()) 
{
return M ( 'links_type')->where ( "id={$data['id']}
")->find ();
}
}
