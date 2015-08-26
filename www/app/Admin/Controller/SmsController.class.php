<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class SmsController extends AdminController {
public function set() {
global $tpldir,$_G,$_A,$MsgInfo;
$data = array ();
$data ['page'] = I ( 'get.p');
if (isset ( $_REQUEST ['username'] ))
$data ['username'] = I ( 'request.username');
if (isset ( $_REQUEST ['phone'] ))
$data ['phone'] = I ( 'request.phone');
if (isset ( $_REQUEST ['nstatus'] ))
$data ['nstatus'] = I ( 'request.nstatus');
if (isset ( $_REQUEST ['status'] ))
$data ['status'] = I ( 'request.status');
if (isset ( $_REQUEST ['sms_type'] ))
$data ['sms_type'] = I ( 'request.sms_type');
$data ['sms_sendcode'] = 'sms';
$lists = \smsClass::getSmslogList ( $data );
$this->assign ( $lists );
$this->display ( $tpldir .'sms.html',$msg );
}
public function settemplate() {
global $tpldir,$_G,$_A,$MsgInfo;
$msg = '';
if (isset ( $_POST ["info"] )) {
$filename = ROOT_PATH ."/modules/sms.tempatle.php";
$data = array ();
$data = $_POST ["info"];
file_exists ( $filename ) or touch ( $filename );
file_put_contents ( $filename,'<?php return '.var_export ( $data,TRUE ) .';
');
$msg = array (
"设置成功"
);
}else {
if (file_exists ( ROOT_PATH ."/modules/sms.tempatle.php")) {
$tempatledata = include ROOT_PATH ."/modules/sms.tempatle.php";
}else {
$msg = array (
"模板不存在"
);
}
$this->assign ( "tempaledata",$tempatledata );
}
$this->display ( $tpldir .'sms.html',$msg );
}
}
