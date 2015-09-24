
<?php
require_once ("articles.model.php");
global $articles_flag;
$articles_flag = array ( "index"=>"首页", "ding"=>"置顶", "tuijian"=>"推荐" );
class articlesClass 
{
	public static function GetList($data = array()) 
	{
		$_sql = " 1=1 ";
		if (IsExiest ( $data ['user_id'] ) != false) 
		{
			$_sql .= " and p1.user_id = {$data['user_id']}
		";
	}
	if (IsExiest ( $data ['username'] ) != false) 
	{
		$_sql .= " and p2.username like '%{$data['username']}
	%'";
}
if (IsExiest ( $data ['name'] ) != false) 
{
	$_sql .= " and p1.`name` like '%".urldecode ( $data ['name'] ) ."%'";
}
if (IsExiest($data['flag']) != false)
{
	$flags=explode(',',$data['flag']);
	foreach($flags as $vuls)
	{
		$_sql .= " and FIND_IN_SET('{$vuls}
	',p1.flag)";
}
}
if (IsExiest ( $data ['public'] ) != false) 
{
$_sql .= " and p1.public = {$data['public']}
";
}
if (IsExiest ( $data ['type_pid'] ) != false) 
{
$result = M ( 'articles_type')->where ( "pid='{$data['type_pid']}
'")->field ( 'id')->select ();
if ($result != false) 
{
$_sql .= " and (  FIND_IN_SET('{$data['type_pid']}
',p1.type_id) ";
foreach ( $result as $key =>$value ) 
{
$_sql .= "  or FIND_IN_SET('{$value['id']}
',p1.type_id) ";
}
$_sql .= " )";
}
}
if (IsExiest ( $data ['type_nid'] ) != false) 
{
$result = M ( 'articles_type')->where ( "nid='{$data['type_nid']}
'")->field ( 'id')->find ();
if ($result != false) 
{
$_sql .= "  and FIND_IN_SET('{$result['id']}
',p1.type_id) ";
}
}
if (IsExiest ( $data ['type_id'] ) != false) 
{
$_sql .= " and FIND_IN_SET('{$data['type_id']}
',p1.type_id)";
}
if (IsExiest ( $data ['site_id'] ) != false) 
{
$result = M ( 'site')->where ( "id='{$data['site_id']}
'")->field ( '`value`,nid')->find ();
$site_nid = $result ['nid'];
if ($result != false) 
{
$_sql .= " and FIND_IN_SET('{$result['value']}
',p1.type_id)";
}
}
elseif (IsExiest ( $data ['site_nid'] ) != false) 
{
$sql = "select `value`,nid from `{site}` where nid='{$data['site_nid']}
'";
$result = M ( 'site')->where ( "nid='{$data['site_nid']}
'")->field ( '`value`,nid')->find ();
$site_nid = $result ['nid'];
if ($result != false) 
{
$_sql .= " and FIND_IN_SET('{$result['value']}
',p1.type_id)";
}
}
$_order = " p1.order desc,p1.id desc ";
if (IsExiest ( $data ['order'] ) != false) 
{
if ($data ['order'] == "id_desc") 
{
$_order = " p1.id desc ";
}
elseif ($data ['order'] == "id_asc") 
{
$_order = "  p1.id asc ";
}
elseif ($data ['order'] == "order_desc") 
{
$_order = "  p1.`order` desc ,p1.id desc";
}
elseif ($data ['order'] == "order_asc") 
{
$_order = " p1.`order` asc,p1.id desc";
}
}
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$result = M ( 'articles')->alias ( 'p1')->join ( presql ( '{articles_type} as p0 on p1.type_id=p0.id') )->join ( presql ( '{admin} as p2 on p2.id=p1.user_id') )->join ( presql ( '{users_upfiles} as p3 on p1.litpic=p3.id') )->where ( $_sql )->field ( ' p1.*,p0.name as type_name,p2.username,p3.fileurl')->limit ( $_limit )->order($_order)->select ();
if ($site_nid != "") 
{
foreach ( $result as $key =>$value ) 
{
$result [$key] ["site_nid"] = $site_nid;
}
}
return $result;
}
$row = M ( 'articles')->alias ( 'p1')->join ( presql ( '{articles_type} as p0 on p1.type_id=p0.id') )->join ( presql ( '{admin} as p2 on p2.id=p1.user_id') )->join ( presql ( '{users_upfiles} as p3 on p1.litpic=p3.id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'articles')->alias ( 'p1')->join ( presql ( '{articles_type} as p0 on p1.type_id=p0.id') )->join ( presql ( '{admin} as p2 on p1.user_id=p2.id') )->join ( presql ( '{users_upfiles} as p3 on p1.litpic=p3.id') )->where ( $_sql )->field ( ' p1.*,p0.name as type_name,p2.username,p3.fileurl')->page ( $data ['page'] .",{$data ['epage']}
")->order($_order)->select ();
$result = array ( 'list'=>$list ?$list : array (), 'site_nid'=>$site_nid, 'total'=>$total, 'page'=>$show );
return $result;
}
public static function GetTypeList($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['pid'] ) != false) 
{
$_sql .= " and pid = {$data['pid']}
";
}
if (IsExiest ( $data ['type_id'] ) != false) 
{
$_sql .= " and id in({$data['type_id']}
)";
}
$_order = "order desc ,id asc ";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'articles_type')->where ( $_sql )->limit ( $_limit )->select ();
}
$row = M ( 'articles_type')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'articles_type')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function AddType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) return "articls_type_name_empty";
if (!IsExiest ( $data ['nid'] )) return "articls_type_nid_empty";
$result = M ( 'articles_type')->where ( "nid='{$data['nid']}
'")->find ();
if ($result !=null||$result!=false) return "articles_type_nid_exiest";
$id = M ( 'articles_type')->add ( $data );
return $id;
}
public static function GetTypeMenu($data = array()) 
{
$result = self::GetTypeList ( array ( "limit"=>"all" ) );
$_result = array ();
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
foreach ( $result as $key =>$value ) 
{
$site_result [$value ['id']] = $value;
$_res_pid [$value ['pid']] [] = $value ['id'];
}
if (IsExiest ( $data ['lgnore'] ) != false) 
{
unset ( $_res_pid [$data ['lgnore']] );
}
if (count ( $_res_pid ) >0) 
{
foreach ( $_res_pid [0] as $key =>$value ) 
{
$_result [$value] = $site_result [$value];
$_result [$value] ['_name'] = $_result [$value] ['name'];
$_result [$value] ['type_name'] = $_result [$value] ['name'];
$_site_data ['site_result'] = $site_result;
$_site_data ['result'] = $_res_pid;
$_site_data ['_result'] = $_res_pid [$value];
$_site_data ['var'] = $var;
$_site_data ['type_var'] = $type_var;
$_result = $_result +self::_GetTypeMenu ( $_site_data );
}
}
if (IsExiest ( $data ['lgnore'] ) != false) 
{
unset ( $_result [$data ['lgnore']] );
}
return $_result;
}
public static function _GetTypeMenu($_site_data) 
{
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
$_var = $_site_data ["var"];
$_type_var = $_site_data ["type_var"];
$_result = array ();
if (isset ( $_site_data ['_result'] ) &&$_site_data ['_result'] != "") 
{
foreach ( $_site_data ['_result'] as $key =>$value ) 
{
$_result [$value] = $_site_data ["site_result"] [$value];
$_result [$value] ['_name'] = $_var .$_result [$value] ['name'];
$_result [$value] ['type_name'] = $_type_var .$_result [$value] ['name'];
$_site_data ['_result'] = $_site_data ["result"] [$value];
$_site_data ['var'] = $_site_data ['var'] .$var;
$_site_data ['type_var'] = $_site_data ['type_var'] .$type_var;
$_result = $_result +self::_GetTypeMenu ( $_site_data );
}
}
return $_result;
}
public static function GetTypeOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "articls_type_id_empty";
$result = M ( 'articles_type')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "article_type_empty";
return $result;
}
public static function UpdateType($data = array()) 
{
if (!IsExiest ( $data ['name'] )) return "articls_type_name_empty";
if (!IsExiest ( $data ['nid'] )) return "articls_type_nid_empty";
$result = M ( 'articles_type')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != null) return "articles_type_nid_exiest";
M ( 'articles_type')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function DelType($data = array()) 
{
$result = M ( 'articles_type')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "articles_type_not_exiest";
$sql = "select 1 from `{}` where ";
$result = M ( 'articles_type')->where ( "pid={$data['id']}
")->find ();
if ($result != null) return "articles_type_del_pid_exiest";
$result = M ( 'articles')->where ( "FIND_IN_SET('{$data['id']}
',type_id)")->find ();
if ($result != null) return "articles_type_del_article_exiest";
M ( 'articles_type')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
public static function Add($data) 
{
if (IsExiest ( $data ['img_error'] )) return $data ['img_error'];
if (!IsExiest ( $data ['name'] )) return "articles_name_empty";
if (!IsExiest ( $data ['type_id'] )) return "articles_type_id_empty";
if ($data ['public'] == 3 &&!IsExiest ( $data ['password'] )) 
{
return "articles_password_empty";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$data ['update_time'] = time ();
$data ['update_ip'] = get_client_ip ();
$id = M ( 'articles')->add ( $data );
return $id;
}
public static function Update($data) 
{
if (!IsExiest ( $data ['id'] )) return "articles_id_empty";
if (!IsExiest ( $data ['name'] )) return "articles_name_empty";
if (!IsExiest ( $data ['type_id'] )) return "articles_type_id_empty";
if ($data ['public'] == 3 &&!IsExiest ( $data ['password'] )) 
{
return "articles_password_empty";
}
$result = M ( 'articles')->where ( "id={$data['id']}
")->find ();
$user_id = $result ['user_id'];
if ($data ['user_id'] != ""&&$data ['user_id'] != $user_id) 
{
return "articles_error";
}
$data ['update_time'] = time ();
$data ['update_ip'] = get_client_ip ();
M ( 'articles')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function Action($data) 
{
if (count ( $data ['id'] ) <= 0) return 1;
if ($data ['type'] == 'order') 
{
foreach ( $data ['id'] as $key =>$value ) 
{
$sql = "update `{articles}` set `order`='{$data['order'][$key]}
' where id={$value}
";
M ()->execute ( presql ( $sql ) );
}
}
elseif ($data ['type'] == 'del') 
{
if (count ( $data ['aid'] ) >0) 
{
foreach ( $data ['aid'] as $key =>$value ) 
{
M ( 'articles')->where ( " id={$value}
")->delete ();
}
}
}
return 1;
}
public static function GetOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "articles_id_empty";
if ($data ['hits_status'] == 1) 
{
$sql = "update `{articles}` set hits =hits+1 where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
}
$_sql = "p1.id={$data['id']}
";
if ($data ['user_id'] != "") 
{
$_sql .= " and p1.user_id='{$data['user_id']}
'";
}
$result = M ( 'articles')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p2.id=p1.user_id') )->join ( presql ( '`{users_upfiles}` as p3 on p3.id=p1.litpic') )->where ( $_sql )->field ( 'p1.*,p2.username,p3.fileurl')->find ();
if ($result == null) return "articles_not_exiest";
return $result;
}
public static function Delete($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "articles_id_empty";
$id = $data ['id'];
if (!is_array ( $id )) 
{
$id = array ( $id );
}
M ( 'articles')->where ( "id in (".join ( ",",$id ) .")")->delete ();
return $data ['id'];
}
public static function Verify($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "articles_id_empty";
$id = $data ['id'];
$result = M('articles')->where("id={$data['id']}
")->field('user_id,name')->find();
if ($result == null) return "";
$user_id = $result ['user_id'];
if ($result ['status'] == 1) return "articles_verify_yes";
$sql = "update `{articles}` set status='{$data['status']}
',verify_time='".time () ."',verify_remark='{$data['verify_remark']}
',verify_userid='{$data['verify_userid']}
'  where id={$id}
";
M()->execute(presql($sql));
if ($data ['status'] == 1) 
{
$credit_log ['user_id'] = $user_id;
$credit_log ['nid'] = "articles_add";
$credit_log ['code'] = "articles";
$credit_log ['type'] = "add";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $data ['id'];
$credit_log ['remark'] = "发表[{$result['name']}
]成功";
\creditClass::ActionCreditLog ( $credit_log );
$user_log ["user_id"] = $user_id;
$user_log ["code"] = "articles";
$user_log ["type"] = "article";
$user_log ["operating"] = "add";
$user_log ["article_id"] = $data ['id'];
$user_log ["result"] = 1;
$user_log ["content"] = "发表了[{$result['name']}
]";
;
usersClass::AddUsersLog ( $user_log );
}
return $data ['id'];
}
public static function GetArticlesSide($data = array()) 
{
global $mysql;
if ($data ['site_nid'] != "") 
{
$result =M('site')->where("nid='{$data['site_nid']}
'")->find();
if ($result == null) return "";
$data ['type_id'] = $result ['value'];
}
$_result = array ( "nid"=>$data ['site_nid'] );
if ($data ['type_id'] != "") 
{
$result = M('articles')->where(" type_id='{$data['type_id']}
' and id>{$data['id']}
and status='{$data['status']}
' order by id asc")->field('id,name')->find();
$_result ["down_id"] = $result ['id'];
$_result ["down_name"] = $result ['name'];
$result = M('articles')->where("type_id='{$data['type_id']}
' and status='{$data['status']}
' and id<{$data['id']}
order by id desc")->field('id,name ')->find();
$_result ["up_id"] = $result ['id'];
$_result ["up_name"] = $result ['name'];
}
return $_result;
}
public static function AddPage($data) 
{
if (!IsExiest ( $data ['name'] )) return "articles_page_name_empty";
if (!IsExiest ( $data ['nid'] )) return "articles_page_nid_empty";
if ($data ['public'] == 3 &&!IsExiest ( $data ['password'] )) 
{
return "articles_page_password_empty";
}
$sql = "select 1 from `{}` where ";
$result = M ( 'articles_pages')->where ( "nid='{$data['nid']}
'")->find ();
if ($result != null) return "articles_page_nid_exiest";
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$id = M ( 'articles_pages')->add ( $data );
return $id;
}
public static function UpdatePage($data) 
{
if (!IsExiest ( $data ['id'] )) return "articles_page_id_empty";
if (!IsExiest ( $data ['name'] )) return "articles_page_name_empty";
if ($data ['public'] == 3 &&!IsExiest ( $data ['password'] )) 
{
return "articles_page_password_empty";
}
$result = M ( 'articles_pages')->where ( "nid='{$data['nid']}
' and id!={$data['id']}
")->find ();
if ($result != null) return "articles_page_nid_exiest";
M ( 'articles_pages')->where ( "id={$data['id']}
")->save ( $data );
return $data ['id'];
}
public static function GetPageOne($data = array()) 
{
if (!IsExiest ( $data ['id'] )) return "articles_page_id_empty";
$result = M ( 'articles_pages')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p2.id=p1.user_id') )->where ( "p1.id={$data['id']}
")->field ( 'p1.*,p2.username')->find ();
if ($result == null) return "articles_page_not_exiest";
return $result;
}
public static function GetPageList($data = array()) 
{
$_sql = "1=1 ";
$_order = "p1.order desc ,p1.id asc ";
$field = " p1.*,p2.username";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'articles_pages')->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id ') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'articles_pages')->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id ') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'articles_pages')->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id ') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show );
return $result;
}
public static function GetPageMenu($data = array()) 
{
$field = " p1.*,p2.username";
$result = M ( 'articles_pages')->alias ( 'p1')->join ( presql ( '`{admin}` as p2 on p1.user_id=p2.id') )->field ( $field )->select ();
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
foreach ( $result as $key =>$value ) 
{
$_res [$value ['id']] ['pid'] = $value ['pid'];
if ($value ['pid'] == 0) 
{
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $value ['name'];
$_result [$value ['id']] ['type_name'] = $value ['name'];
$_result [$value ['id']] ['var'] = "";
$_result1 = self::_GetPageMenu ( $result,$value ['id'],$var,$type_var );
$_result = array_merge ( $_result,$_result1 );
}
}
return $_result;
}
public static function _GetPageMenu($result,$pid,$var,$type_var) 
{
$_result = array ();
$_var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$_type_var = "—";
foreach ( $result as $key =>$value ) 
{
if ($value ['pid'] == $pid) 
{
if ($opid == "") 
{
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $var .$value ['name'];
$_result [$value ['id']] ['type_name'] = $type_var .$value ['name'];
$_result [$value ['id']] ['var'] = $var .$_var;
$_result1 = self::_GetPageMenu ( $result,$value ['id'],$var .$_var,$type_var .$_type_var );
$_result = array_merge ( $_result,$_result1 );
}
else 
{
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $var .$value ['name'];
$_result [$value ['id']] ['type_name'] = $type_var .$value ['name'];
$_result [$value ['id']] ['var'] = $var .$_var;
$_result1 = self::_GetPageMenu ( $result,$value ['id'],$var .$_var,$type_var .$_type_var );
$_result = array_merge ( $_result,$_result1 );
}
}
}
return $_result;
}
public static function DeletePage($data = array()) 
{
$sql = "select 1 from `{}` where ";
$result = M ( 'articles_pages')->where ( "id={$data['id']}
")->find ();
if ($result == false) return "articles_page_not_exiest";
$result = M ( 'articles_pages')->where ( "pid={$data['id']}
")->find ();
if ($result != false) return "articles_page_del_pid_exiest";
M ( 'articles_pages')->where ( "id={$data['id']}
")->delete ();
return $data ['id'];
}
}
