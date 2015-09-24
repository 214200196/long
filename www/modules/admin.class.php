
<?php
if (!defined ( 'ROOT_PATH')) {
echo "<script>window.location.href='/404.htm';</script>";
exit ();
}
global $MsgInfo;
require_once ("admin.model.php");
require_once ("admin.module.php");
class adminClass extends moduleClass {
public static function UpdateSystem($data = array()) {
$code = $data ['code'];
unset ( $data ['code'] );
foreach ( $data as $key =>$value ) {
$udata ['value'] = $value;
$udata ['code'] = $code;
M ( 'system')->where ( "nid='$key'")->setField ( $udata );
}
return true;
}
public static function GetSystem($data = array()) {
$sql = "1=1 ";
if (IsExiest ( $data ["code"] ) != false) {
$sql .= " and `code` = '{$data['code']}'";
}
if (IsExiest ( $data ["status"] ) != false) {
$sql .= " and `status` = '{$data['status']}'";
}
$result = M ( 'system')->where ( $sql )->select ();
if ($result != false) {
foreach ( $result as $key =>$value ) {
$_result [$value ['nid']] = $value ['value'];
}
}
return $_result;
}
function GetSystemTables($data = array()) {}
public static function ActionSystem($data = array()) {
global $mysql;
$class = $data ["class"];
$style = $data ["style"];
if ($class == "list") {
return M ( 'system')->where ( "`style` = '$style'")->order ( 'id asc')->select ();
}
elseif ($class == "view") {
$id = $data ["id"];
return M ( 'system')->where ( "style` = '$style' and `id` = '$id'")->order ( 'id asc')->select ();
}
elseif ($class == "add") {
unset ( $data ['class'] );
if (!ereg ( "^con_",$data ['nid'] )) {
return "admin_system_not_con";
}
$_sql = "";
$result = M ( 'system')->where ( "nid ='{$data ['nid']}'")->find ();
if ($result != false)
return "admin_system_nid_exiest";
foreach ( $data as $key =>$value ) {
$udata [$key] = $value;
}
return M ( 'system')->add ( $udata );
}
elseif ($class == "update") {
unset ( $data ['class'] );
if (!ereg ( "^con_",$data ['nid'] )) {
return self::SYSTEM_ADD_NO_CON;
}
$sql = "select * from {system} where nid = '".$data ['nid'] ."' and id !=".$data ['id'];
$result = M ( 'system')->where ( "nid ='{$data ['nid']}' and id !=$data ['id']")->find ();
if ($result != false)
return self::SYSTEM_NID_IS_EXIST;
$_sql = "";
$sql = "update `{system}` set ";
$udata = array ();
foreach ( $data as $key =>$value ) {
$udata [$key] = $value;
}
$result = M ( 'system')->where ( "id =$data ['id']")->save ( $udata );
if ($result == false)
return self::ERROR;
else
return true;
}
elseif ($class == "action") {
foreach ( $data ['value'] as $key =>$val ) {
$val = nl2br ( $val );
$udata ['value'] = $val;
$udata ['name'] = $data ['name'] [$key];
M ( 'system')->where ( "`nid` = '$key'")->setField ( $udata );
}
return 1;
}
elseif ($class == "del") {
$_sql = "";
if (IsExiest ( $data ['type_id'] ) != false) {
$_sql = " and type_id='{$data['type_id']}'";
}
$result = M ( 'system')->where ( "`id` = '{$data['id']}' ".$_sql )->find ();
if ($result == false)
return "admin_system_del_error";
if ($result ['status'] == 0)
return "admin_system_not_del";
$sql = "delete from `{system}` where `id` = '{$data['id']}' $_sql";
$result = M ( 'system')->where ( "`id` = '{$data['id']}' $_sql")->delete ();
if ($result == false)
return "admin_system_del_error";
return $data ['id'];
}
}
public static function SaveModulesTable($data = array()) {
if (!IsExiest ( $data ['table'] ))
return "";
$filedir = "data/".(!IsExiest ( $data ['table'] )) ?"": $data ['table'];
}
public static function BackupTables($data = array()) {
}
public static function RevertTables($data = array()) {
$tables = $data ['table'];
$nameid = $data ['nameid'];
if (isset ( $tables [$nameid] ) &&$tables [$nameid] != "") {
$value = $tables [$nameid];
if ($value != "show_table.sql") {
$sql = file_get_contents ( $data ['filedir'] ."/".$value );
$_sql = explode ( "\r\n",$sql );
foreach ( $_sql as $val ) {
if ($val != "") {
M ()->execute ( presql ( $val ) );
}
}
}
return $value;
}else {
return "";
}
}
public static function AddSiteMenu($data = array()) {
if (!IsExiest ( $data ['name'] )) {
return "admin_site_menu_name_empty";
}
if (!IsExiest ( $data ['nid'] )) {
return "admin_site_menu_nid_empty";
}
$result = M ( 'site_menu')->where ( "checked=1")->find ();
if ($result == null) {
$data ["checked"] = 1;
}
$sql = "select 1 from `{}` where ";
$result = M ( 'site_menu')->where ( "nid='{$data['nid']}'")->find ();
if ($result != null)
return "admin_site_menu_nid_exiest";
if ($data ['checked'] == 1) {
$sql = "update `{site_menu}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
}
return M ( 'site_menu')->add ( $data );
}
public static function UpdateSiteMenu($data = array()) {
if (!IsExiest ( $data ['id'] )) {
return "admin_site_menu_id_empty";
}
if (!IsExiest ( $data ['name'] )) {
return "admin_site_menu_name_empty";
}
if (!IsExiest ( $data ['nid'] )) {
return "admin_site_menu_nid_empty";
}
$result = M ( 'site_menu')->where ( "nid='{$data['nid']}' and id!={$data['id']}")->find ();
if ($result != null)
return "admin_site_menu_nid_exiest";
if ($data ['checked'] == 1) {
$sql = "update `{site_menu}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
}
M ( 'site_menu')->where ( "id={$data['id']}")->save ( $data );
return $data ['id'];
}
public static function UpdateSiteMenuChecked($data = array()) {
if (!IsExiest ( $data ['id'] )) {
return "admin_site_menu_id_empty";
}
$sql = "update `{site_menu}` set `checked`=0 ";
M ()->execute ( presql ( $sql ) );
$sql = "update `{site_menu}` set `checked`=1 where id={$data['id']}";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function GetSiteMenuList($data = array()) {
$_sql = "1=1 ";
if (IsExiest ( $data ['nid'] ) != false) {
$_sql .= " and nid ='{$data['nid']}'";
}
if (IsExiest ( $data ['name'] ) != false) {
$_sql .= " and name like '%{$data['name']}%'";
}
$_order = "checked desc,id desc,`order` desc";
if (IsExiest ( $data ['limit'] ) != false) {
if ($data ['limit'] != "all") {
$_limit = $data ['limit'];
}
return M ( 'site_menu')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'site_menu')->where ( $_sql )->count ();
;
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'site_menu')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}")->order ( $_order )->select ();
$result = array (
'list'=>$list ?$list : array (),
'page'=>$show 
)
;
return $result;
}
public static function GetSiteMenuOne($data = array()) {
if (!IsExiest ( $data ['id'] ))
return "admin_site_menu_id_empty";
$result = M ( 'site_menu')->where ( "id={$data['id']}")->find ();
if ($result == null)
return "admin_site_menu_empty";
return $result;
}
function DelSiteMenu($data = array()) {
if (!IsExiest ( $data ['id'] ))
return "admin_site_menu_id_empty";
$sql = "select  from `{}`";
$result = M ( 'site_menu')->field ( 'count(1) as num')->find ();
if ($result ['num'] == 1)
return "admin_site_menu_only_one";
$result = M ( 'site')->where ( "menu_id={$data['id']}")->find ();
if ($result != null)
return "admin_site_menu_site_exiest";
if ($result ['checked'] == 1) {
$sql = "update  `{site_menu}` set checked=1 limit 1";
M ()->execute ( presql ( $sql ) );
}
M ( 'site_menu')->where ( "id={$data['id']}")->delete ();
return $data ['id'];
}
function GetSiteList($data = array()) {
$_sql = "1=1 ";
if ($data ['pid'] != "") {
$_sql .= " and pid={$data['pid']}";
}
if ($data ['status'] != "") {
$_sql .= " and status='{$data['status']}'";
}
$_order = " `order` desc ,id asc ";
$_limit = "";
if (IsExiest ( $data ['limit'] ) != false) {
if ($data ['limit'] != "all") {
$_limit = $data ['limit'];
}
return M ( 'site')->where ( $_sql )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'site')->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'site')->where ( $_sql )->page ( $data ['page'] .",{$data ['epage']}")->order ( $_order )->select ();
$result = array (
'list'=>$list ?$list : array (),
'page'=>$show 
)
;
return $result;
}
function AddSite($data = array()) {
if (!IsExiest ( $data ['name'] ))
return "admin_site_name_empty";
if (!IsExiest ( $data ['nid'] ))
return "admin_site_nid_empty";
$result = M ( 'site')->where ( "nid='{$data['nid']}'")->find ();
if ($result != null)
return "admin_site_nid_exiest";
$id = M ( 'site')->add ( $data );
return $id;
}
function GetSite($data = array()) {
global $_G;
if (isset ( $_G ["site"] )) {
$result = $_G ['site'];
}else {
$result = self::GetSiteList ( array (
"limit"=>"all"
) );
}
if (!IsExiest ( $data ['menu_id'] )) {
if (isset ( $_G ["site_menu_id"] )) {
$data ['menu_id'] = $_G ['site_menu_id'];
}else {
$_result = M ( 'site_menu')->where ( "checked=1")->find ();
$data ['menu_id'] = $_result ['id'];
}
}
$_result = array ();
$_res_pid = array ();
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
foreach ( $result as $key =>$value ) {
if ($value ['menu_id'] == $data ['menu_id']) {
$site_result [$value ['id']] = $value;
$_res_pid [$value ['pid']] [] = $value ['id'];
}
}
if (IsExiest ( $data ['lgnore'] ) != false) {
unset ( $_res_pid [$data ['lgnore']] );
}
if (count ( $_res_pid ) >0) {
foreach ( $_res_pid [0] as $key =>$value ) {
$_result [$value] = $site_result [$value];
$_result [$value] ['_name'] = $_result [$value] ['name'];
$_result [$value] ['type_name'] = $_result [$value] ['name'];
$_site_data ['site_result'] = $site_result;
$_site_data ['result'] = $_res_pid;
$_site_data ['_result'] = $_res_pid [$value];
$_site_data ['var'] = $var;
$_site_data ['type_var'] = $type_var;
$_result = $_result +self::_GetSite ( $_site_data );
}
}
if (IsExiest ( $data ['lgnore'] ) != false) {
unset ( $_result [$data ['lgnore']] );
}
return $_result;
}
function _GetSite($_site_data) {
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
$_var = $_site_data ["var"];
$_type_var = $_site_data ["type_var"];
$_result = array ();
if (isset ( $_site_data ['_result'] ) &&$_site_data ['_result'] != "") {
foreach ( $_site_data ['_result'] as $key =>$value ) {
$_result [$value] = $_site_data ["site_result"] [$value];
$_result [$value] ['_name'] = $_var .$_result [$value] ['name'];
$_result [$value] ['type_name'] = $_type_var .$_result [$value] ['name'];
$_site_data ["result"] [$value] = isset ( $_site_data ["result"] [$value] ) ?$_site_data ["result"] [$value] : "";
$_site_data ['_result'] = $_site_data ["result"] [$value];
$_site_data ['var'] = $_site_data ['var'] .$var;
$_site_data ['type_var'] = $_site_data ['type_var'] .$type_var;
$_result = $_result +self::_GetSite ( $_site_data );
}
}
return $_result;
}
function GetSites($data = array()) {
global $_G;
if (isset ( $_G ["site"] )) {
$result = $_G ['site'];
}else {
$result = self::GetSiteList ( array (
"limit"=>"all"
) );
}
$data ['menu_id'] = isset ( $data ['menu_id'] ) ?$data ['menu_id'] : "";
if (!IsExiest ( $data ['menu_id'] )) {
if (isset ( $_G ["site_menu_id"] )) {
$data ['menu_id'] = $_G ['site_menu_id'];
}else {
$_result = M ( 'site_menu')->where ( "checked=1")->find ();
$data ['menu_id'] = $_result ['id'];
}
}
$_result = array ();
$var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$type_var = "—";
if (IsExiest ( $data ['menu_id'] ) != false) {
foreach ( $result as $key =>$value ) {
$_res [$value ['id']] ['pid'] = $value ['pid'];
if ($value ['pid'] == 0 &&$value ['menu_id'] == $data ['menu_id']) {
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $value ['name'];
$_result [$value ['id']] ['type_name'] = $value ['name'];
$_result [$value ['id']] ['var'] = "";
if ($value ['nid'] == "index") {
$_result [$value ['id']] ['url'] = "/";
}elseif ($value ['type'] == "url") {
$_result [$value ['id']] ['url'] = $value ['value'];
}else {
$_result [$value ['id']] ['url'] = U('Index/Index/index?site='.$value['nid']);
}
$_result [$value ['id']] ['list_result'] = self::_GetSites ( $result,$value ['id'],$var,$type_var );
}
}
}else {
foreach ( $result as $key =>$value ) {
$_res [$value ['id']] ['pid'] = $value ['pid'];
if ($value ['pid'] == 0) {
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $value ['name'];
$_result [$value ['id']] ['type_name'] = $value ['name'];
$_result [$value ['id']] ['var'] = "";
if ($value ['type'] == "url") {
$_result [$value ['id']] ['url'] = $value ['value'];
}
elseif($value ['nid'] == "index"){
$_result [$value ['id']] ['url'] = "/";
}
else {
$_result [$value ['id']] ['url'] = U('Index/Index/index?site='.$value['nid']);
}
$_result [$value ['id']] ['list_result'] = self::_GetSites ( $result,$value ['id'],$var,$type_var );
}
}
}
return $_result;
}
function _GetSites($result,$pid,$var,$type_var) {
$_result = array ();
$_var = "&nbsp;&nbsp;&nbsp;&nbsp;";
$_type_var = "—";
$opid = "";
foreach ( $result as $key =>$value ) {
if ($value ['pid'] == $pid) {
if ($opid == "") {
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $var .$value ['name'];
$_result [$value ['id']] ['type_name'] = $type_var .$value ['name'];
$_result [$value ['id']] ['var'] = $var .$_var;
if ($value ['type'] == "url") {
$_result [$value ['id']] ['url'] = $value ['value'];
}else {
$_result [$value ['id']] ['url'] = U('Index/Index/index?site='.$value['nid']);
}
$_result [$value ['id']] ['list_result'] = self::_GetSites ( $result,$value ['id'],$var .$_var,$type_var .$_type_var );
}else {
$_result [$value ['id']] = $value;
$_result [$value ['id']] ['_name'] = $var .$value ['name'];
$_result [$value ['id']] ['type_name'] = $type_var .$value ['name'];
$_result [$value ['id']] ['var'] = $var .$_var;
if ($value ['type'] == "url") {
$_result [$value ['id']] ['url'] = $value ['value'];
}else {
$_result [$value ['id']] ['url'] =  U('Index/Index/index?site='.$value['nid']);
}
$_result [$value ['id']] ['list_result'] = self::_GetSites ( $result,$value ['id'],$var .$_var,$type_var .$_type_var );
}
}
}
return $_result;
}
public static function GetSiteOne($data = array()) {
if (!IsExiest ( $data ['id'] ))
return "admin_site_id_empty";
$result = M ( 'site')->where ( "id={$data['id']}")->find ();
if ($result == null)
return "admin_site_empty";
return $result;
}
function UpdateSite($data = array()) {
if (!IsExiest ( $data ['name'] ))
return "admin_site_name_empty";
if (!IsExiest ( $data ['nid'] ))
return "admin_site_nid_empty";
$result = M ( 'site')->where ( "nid='{$data['nid']}' and id!={$data['id']}")->find ();
if ($result != null)
return "admin_site_nid_exiest";
M ( 'site')->where ( "id={$data['id']}")->save ( $data );
return $data ['id'];
}
function DelSite($data = array()) {
$result = M ( 'site')->where ( "id={$data['id']}")->find ();
if ($result == null)
return "admin_site_not_exiest";
$result = M ( 'site')->where ( "pid={$data['id']}")->find ();
if ($result != null)
return "admin_site_pid_exiest";
M ( 'site')->where ( "id={$data['id']}")->delete ();
return $data ['id'];
}
public static function GetSiteOnes($data = array()) {
global $_G;
if (isset ( $_G ["site"] )) {
$result = $_G ['site'];
}else {
$result = self::GetSiteList ( array (
"limit"=>"all"
) );
}
$_result = false;
foreach ( $result as $key =>$value ) {
if ($value ["nid"] == $data ['nid']) {
$_result = $value;
}
}
return $_result;
}
function ActionSite($data) {
if ($data ['id'] != "") {
foreach ( $data ['id'] as $key =>$value ) {
$sql = "update `{site}` set `order` = '{$data['order'][$key]}' where id={$value}";
M ()->execute ( presql ( $sql ) );
}
}
}
public static function GetSystemTypeOne($data = array()) {
if (!IsExiest ( $data ['id'] ))
return "admin_system_type_id_empty";
$result = M ( 'system_type')->where ( "id={$data['id']}")->find ();
if ($result == null)
return "admin_system_type_empty";
return $result;
}
function UpdateSystemType($data = array()) {
if (!IsExiest ( $data ['name'] ))
return "admin_system_type_name_empty";
if (!IsExiest ( $data ['nid'] ))
return "admin_system_type_nid_empty";
$result = M ( 'system_type')->where ( "nid='{$data['nid']}' and id!={$data['id']}")->find ();
if ($result != null)
return "admin_system_type_nid_exiest";
M ( 'system_type')->where ( "id={$data['id']}")->save ( $data );
return $data ['id'];
}
function AddSystemType($data = array()) {
if (!IsExiest ( $data ['name'] ))
return "admin_system_type_name_empty";
if (!IsExiest ( $data ['nid'] ))
return "admin_system_type_nid_empty";
$result = M ( 'system_type')->where ( "nid='{$data['nid']}'")->find ();
if ($result != null)
return "admin_system_type_nid_exiest";
return M ( 'system_type')->add ( $data );
}
function DeleteSystemType($data = array()) {
$result = M ( 'system_type')->where ( "id={$data['id']}")->find ();
if ($result == null)
return "admin_system_type_empty";
$result = M ( 'system')->where ( "code='{$result['nid']}'")->find ();
if ($result != null)
return "admin_system_type_code_exiest";
M ( 'system_type')->where ( "id={$data['id']}")->delete ();
return $data ['id'];
}
public static function GetSystemTypeList($data = array()) {
$_sql = "  1=1 ";
if (IsExiest ( $data ['status'] ) != false ||$data ['status'] == "0") {
$_sql .= " and p1.status = '{$data['status']}'";
}
$_select = " p1.*,p2.name as module_name ";
$_order = "p1.id desc";
$sql = "select SELECT from `{system_type}` as p1 left join `{modules}` as p2 on p1.code=p2.nid SQL ORDER LIMIT ";
if (IsExiest ( $data ['limit'] ) != false) {
if ($data ['limit'] != "all") {
$_limit = $data ['limit'];
}
return M ( 'system_type')->alias ( 'p1')->join ( presql ( '`{modules}` as p2 on p1.code=p2.nid') )->where ( $_sql )->field ( $_select )->limit ( $_limit )->order ( $_order )->select ();
}
$row = M ( 'system_type')->alias ( 'p1')->join ( presql ( '`{modules}` as p2 on p1.code=p2.nid') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'system_type')->alias ( 'p1')->join ( presql ( '`{modules}` as p2 on p1.code=p2.nid') )->where ( $_sql )->field ( $_select )->page ( $data ['page'] .",{$data ['epage']}")->order ( $_order )->select ();
$result = array (
'list'=>$list ?$list : array (),
'page'=>$show 
);
return $result;
}
function GetUpfiles($data = array()) {
global $_G;
$_sql = "1=1 ";
if (isset ( $data ['username'] ) &&$data ['username'] != "") {
$_sql .= " and p2.username like '%{$data['username']}%'";
}
if (isset ( $data ['quer'] ) &&$data ['quer'] != "") {
$_sql .= " and p1.query like '%{$data['quer']}%'";
}
$page = empty ( $data ['page'] ) ?1 : $data ['page'];
$epage = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$field = "p1.*,p2.username";
$_order = "p1.id desc";
$row = M ( 'users_upfiles')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users_upfiles')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}")->order ( $_order )->select ();
$result = array (
'list'=>$list ?$list : array (),
'page'=>$show 
)
;
return $result;
}
function UpdateUpfiles($data = array()) {
global $mysql;
if (count ( $data ['id'] >0 )) {
foreach ( $data ['id'] as $key =>$value ) {
$contents = iconv ( 'UTF-8','GB2312',$data ['contents'] [$key] );
$sql = "update `{users_upfiles}` set contents='$contents' where id={$value}";
M ()->execute ( presql ( $sql ) );
}
}
return "";
}
}
