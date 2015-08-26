<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class AttestationsController extends AdminController {
public function lists() {
global $tpldir,$_G,$_A,$MsgInfo;
if (isset ( $_POST ['name'] )) {
$data = I ( 'post.');
if ($_POST ['id'] != "") {
$data ['id'] = $_POST ['id'];
$result = \attestationsClass::UpdateAttestationsType ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_type_update_success"],
U ( 'Attestations/lists') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["operating"] = "update";
}else {
$result = \attestationsClass::AddAttestationsType ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_type_add_success"],
U ( 'Attestations/lists') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["operating"] = "add";
}
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "type";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}elseif ($_REQUEST ['edit'] != "") {
$data ['id'] = $_REQUEST ['edit'];
$result = \attestationsClass::GetAttestationsTypeOne ( $data );
if (is_array ( $result )) {
$_A ["attestations_type_result"] = $result;
}else {
$msg = array (
$MsgInfo [$result] 
);
}
}elseif ($_REQUEST ['del'] != "") {
$data ['id'] = $_REQUEST ['del'];
$result = \attestationsClass::DelAttestationsType ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_type_del_success"],
U ( 'Attestations/lists') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "type";
$admin_log ["operating"] = "del";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}else {
$data = array ();
$data ['page'] = I ( 'get.p');
if (isset ( $_REQUEST ['username'] ))
$data ['username'] = I ( 'request.username');
$lists = \attestationsClass::GetAttestationsTypeList ( $data );
$this->assign ( $lists );
}
$this->display ( $tpldir .'attestations.html',$msg );
}
public function upload() {
global $tpldir,$_G,$_A,$MsgInfo;
$_A ["attestations_result"] = "";
if ($_POST ['type'] == "user_id") {
$data = I ( 'post.');
$data ["limit"] = "all";
$result = \attestationsClass::GetAttestationsUserid ( $data );
if ($result >0) {
echo "<script>location.href='".U ( 'attestations/upload?user_id='.$result ) ."'</script>";
exit ();
}else {
$msg = array (
$MsgInfo [$result],
U ( 'attestations/upload') 
);
}
}
elseif ($_REQUEST ['check'] != "") {
if ($_POST ['id'] != "") {
$data ['id'] = I ( 'post.id');
$data ['credit'] = I ( 'post.credit');
$data ['status'] = I ( 'post.status');
$data ['type_id'] = I ( 'post.type_id');
$data ['verify_remark'] = I ( 'request.verify_remark');
$data ['verify_userid'] = $_G ['user_id'];
$result = \attestationsClass::CheckCreditAttestations ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_upfiles_check_success"] 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$_data ['user_id'] = I ( 'post.user_id');
$_data ['type_id'] = $data ['type_id'];
$_data ['status'] = I ( 'post.type_status');
$_data ['credit'] = array_sum ( $data ['credit'] );
\attestationsClass::ActionAttestationsUser ( $_data );
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "upfiles";
$admin_log ["operating"] = "check";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}else {
$_A ['attestations_credit_all'] = \attestationsClass::GetAttestationsCredit ( array (
"user_id"=>$_REQUEST ['user_id'],
"type_id"=>$_REQUEST ['check'] 
) );
$_A ['attestations_type_result'] = \attestationsClass::GetAttestationsTypeOne ( array (
"id"=>$_REQUEST ['check'] 
) );
$data = array ();
$data ['page'] = I ( 'get.p');
if (isset ( $_REQUEST ['username'] ))
$data ['username'] = I ( 'request.username');
if (isset ( $_REQUEST ['type_id'] ))
$data ['type_id'] = I ( 'request.type_id');
$data ['limit'] = 'all';
$lists = \attestationsClass::GetAttestationsList ( $data );
$this->assign ( 'list',$lists );
}
}elseif ($_REQUEST ['edit'] != "") {
if ($_POST ['id'] == "") {
$data ['id'] = $_REQUEST ['edit'];
$result = \attestationsClass::GetAttestationsOne ( $data );
if (is_array ( $result )) {
$_A ["attestations_result"] = $result;
}else {
$msg = array (
$MsgInfo [$result] 
);
}
}else {
$data = I ( 'post.');
$result = \attestationsClass::UpdateAttestations ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_upfiles_update_success"] 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "upfiles";
$admin_log ["operating"] = "update";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}
}elseif ($_POST ['user_id'] != "") {
$data = I ( 'post.');
$data ["order"] = 10;
$_G ['upimg'] ['file'] = "pic";
$_G ['upimg'] ['code'] = "";
$_G ['upimg'] ['type'] = "";
$_G ['upimg'] ['user_id'] = $data ["user_id"];
$_G ['upimg'] ['article_id'] = $data ["attestations_id"];
$datapic ['file'] = "pic";
$datapic ['code'] = "attestations";
$datapic ['user_id'] = $data ["user_id"];
$datapic ['type'] = "album";
$datapic ['article_id'] = $data ["attestations_id"];
$data ["pic_result"] = $this->upfiles ( 'pic','attestations',$datapic );
;
$result = \attestationsClass::AddAttestations ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_upfiles_add_success"],
U ( 'attestations/upload') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "upfiles";
$admin_log ["operating"] = "add";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}
elseif ($_REQUEST ['del'] != "") {
$data ['id'] = $_REQUEST ['del'];
$data ['user_id'] = $_REQUEST ['user_id'];
$result = \attestationsClass::DelAttestations ( $data );
if ($result >0) {
$msg = array (
$MsgInfo ["attestations_upfiles_delete_success"],
U ( 'attestations/upload') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
}
elseif ($_REQUEST ['examine'] != "") {
if ($_POST ['status'] != "") {
$data = I ( 'post,');
$data ['id'] = $_REQUEST ['examine'];
$data ['verify_userid'] = $_G ['user_id'];
$result = \attestationsClass::CheckAttestations ( $data );
if ($result >0) {
$msg = array (
"操作成功",
U ( 'attestations/upload') 
);
}else {
$msg = array (
$MsgInfo [$result] 
);
}
$admin_log ["user_id"] = $_G ['user_id'];
$admin_log ["code"] = "attestations";
$admin_log ["type"] = "attestation";
$admin_log ["operating"] = "check";
$admin_log ["article_id"] = $result >0 ?$result : 0;
$admin_log ["result"] = $result >0 ?1 : 0;
$admin_log ["content"] = $msg [0];
$admin_log ["data"] = $data;
\uadminClass::AddAdminLog ( $admin_log );
}
}else {
$data = array ();
$data ['page'] = I ( 'get.p');
if (isset ( $_REQUEST ['username'] ))
$data ['username'] = I ( 'request.username');
if (isset ( $_REQUEST ['user_id'] ))
$data ['user_id'] = I ( 'request.user_id');
$lists = \attestationsClass::GetAttestationsList ( $data );
$this->assign ( $lists );
}
$this->display ( $tpldir .'attestations.html',$msg );
}
public function uploadw() {
global $tpldir,$_G,$_A,$MsgInfo;
if ($_POST ['type'] == "user_id") {
$data = I ( 'post.');
$result = \attestationsClass::GetAttestationsUserid ( $data );
if ($result >0) {
echo "<script>location.href='".U ( 'attestations/uploadw?user_id='.$result ) ."'</script>";
exit ();
}else {
$msg = array (
$MsgInfo [$result],
U ( 'attestations/uploadw') 
);
}
}elseif ($_REQUEST ['user_id'] != "") {
$data ['user_id'] = $_REQUEST ['user_id'];
$_A ['user_result'] = \usersClass::GetUsers ( $data );
if ($_A ['user_result'] == false) {
$msg = array (
$MsgInfo ["attestations_uploads_user_not_exiest"],
U ( 'attestations/uploadw') 
);
}
}
$this->display ( $tpldir .'attestations.html',$msg );
}
public function swfcofig() {
global $tpldir,$_G,$_A,$MsgInfo;
$op = empty ( $_GET ['op'] ) ?'': $_GET ['op'];
$isupload = empty ( $_GET ['cam'] ) &&empty ( $_GET ['doodle'] ) ?true : false;
$iscamera = isset ( $_GET ['cam'] ) ?true : false;
$isdoodle = isset ( $_GET ['doodle'] ) ?true : false;
if ($_FILES &&$_POST) {
if ($_FILES ["Filedata"] ['error']) {
$_G ['uploadfiles'] = "图片过大";
$_P ['proid'] = $_POST ['proid'];
$_P ['uploadResponse'] = true;
$_P ['albumid'] = 0;
if ($uploadfiles &&is_array ( $uploadfiles )) {
$_P ['status'] = "success";
$_P ['albumid'] = $uploadfiles ['albumid'];
}else {
$_P ['status'] = "failure";
}
$_P ['msg'] = 'erro';
}else {
$catid = $_POST ['catid'] ?intval ( $_POST ['catid'] ) : 0;
$uid = $_POST ['uid'] ?intval ( $_POST ['uid'] ) : 0;
$_POST ['albumid'] = $_POST ['albumid'];
if ($_POST ['albumid'] == 0) {
$_P ['status'] = "category";
$_P ['uploadfiles'] = "图片过大";
$_P ['msg'] = 'erro';
}else {
$_G ['upimg'] ['file'] = "Filedata";
$_G ['upimg'] ['code'] = "attestations";
$_G ['upimg'] ['filesize'] = "2048";
$_G ['upimg'] ['type'] = "attestation";
$_G ['upimg'] ['user_id'] = $uid;
$_G ['upimg'] ['article_id'] = $_POST ['albumid'];
$_G ['upimg'] ['name'] = addslashes ( urldecode ( $_POST ['title'] ) );
$upload->setData ( array (
'file_size'=>100 
) );
$uploadfiles = $upload->UpfileSwfupload ( $_G ['upimg'] );
$_P ['msg'] = $uploadfiles;
$_P ['proid'] = $_POST ['proid'];
$_P ['uploadResponse'] = true;
$_P ['albumid'] = $_POST ['albumid'];
if ($uploadfiles &&is_array ( $uploadfiles )) {
require_once ("attestations.class.php");
$data ["user_id"] = $_REQUEST ['user_id'];
$data ["type_id"] = $_POST ['albumid'];
$data ["order"] = 10;
$data ["pic_result"] [] = $uploadfiles;
$result = attestationsClass::Addattestations ( $data );
$_data ['user_id'] = $data ['user_id'];
$_data ['type_id'] = $_POST ['albumid'];
$_data ['status'] = 0;
attestationsClass::ActionAttestationsUser ( $_data );
$_P ['status'] = "success";
$_P ['msg'] = 'ok';
}else {
$_P ['status'] = "failure";
}
}
}
}else {
$_P ['user_id'] = $_REQUEST ['user_id'];
$list = \attestationsClass::GetAttestationsTypeList ( array (
'limit'=>'all'
) );
$this->assign ( 'list',$list );
}
$this->assign ( '_P',$_P );
$content = $this->fetch ( $tpldir .'attestations.upload.html');
$this->show ( "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".$content );
}
}
