
<?php
class scrollpicClass 
{
	const ERROR = '操作有误，请不要乱操作';
	public static function GetList($data = array()) 
	{
		$page = empty ( $data ['page'] ) ?1 : $data ['page'];
		$epage = empty ( $data ['epage'] ) ?10 : $data ['epage'];
		$_sql = " 1=1 ";
		if (isset ( $data ['type_id'] )) 
		{
			$_sql .= " and p1.type_id={$data['type_id']}
		";
	}
	$_select = 'p1.*,p2.typename ';
	$sql = "select SELECT from `{scrollpic}` as p1 
				left join {scrollpic_type} as p2 on p1.type_id= p2.id
				{$_sql}
ORDER LIMIT";
if (isset ( $data ['limit'] )) 
{
	return M ( 'scrollpic')->alias ( 'p1')->join ( presql ( '{scrollpic_type} as p2 on p1.type_id= p2.id') )->where ( $_sql )->limit ( $data ['limit'] )->field ( 'p1.*,p2.typename ')->select ();
}
$row = M ( 'scrollpic')->alias ( 'p1')->join ( presql ( '{scrollpic_type} as p2 on p1.type_id= p2.id') )->where ( $_sql )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'scrollpic')->alias ( 'p1')->join ( presql ( '{scrollpic_type} as p2 on p1.type_id= p2.id') )->where ( $_sql )->field ( 'p1.*,p2.typename ')->page ( $page,$epage )->select ();
$list = $list ?$list : array ();
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function GetOne($data = array()) 
{
$id = $data ['id'];
return M ( 'scrollpic')->where ( "id=$id")->find ();
}
public static function Add($data = array()) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'scrollpic')->add ( $data );
}
public static function Update($data = array()) 
{
if ($data ['id'] == "") 
{
	return self::ERROR;
}
return M ( 'scrollpic')->save ( $data );
}
public static function Delete($data = array()) 
{
global $mysql;
$id = $data ['id'];
if (!is_array ( $id )) 
{
	$id = array ( $id );
}
return M ( 'scrollpic')->where ( "id in (".join ( ",",$id ) .")")->delete ();
}
public static function GetTypeList($data = array()) 
{
return M ( 'scrollpic_type')->select ();
}
public static function GetTypeOne($data = array()) 
{
return M ( 'scrollpic_type')->where ( "id={$data['id']}
")->find ();
}
}
