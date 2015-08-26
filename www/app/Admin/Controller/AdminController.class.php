<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
use Common\Controller\BaseController;
class AdminController extends BaseController 
{
	public function _initialize() 
	{
		parent::_initialize ();
		global $tpldir,$_A,$_G;
		if(ADMINS!=1)
		{
			redirect('/index.html');
		}
		$tpldir = ROOT_PATH .'template/admin/';
		$_A ["admin_url"] = '/admin';
		$_G ['module'] = \adminClass::GetModuleList ( array ( "limit"=>"all", "type"=>"all" ) );
		foreach ( $_G ['module'] as $key =>$value ) 
		{
			$_G ['_module'] [$value ['nid']] = $value ['name'];
		}
		$_G ['_module'] ['reg'] = '用户注册';
		$_G ["user_id"] = GetCookies ( array ( 'session_id'=>'ds_code_userid' ) );
		if ($_G ["user_id"] != "") 
		{
			$_A ["admin_result"] = \uadminClass::GetUsersAdminOne ( array ( "user_id"=>$_G ["user_id"] ) );
			if ($_A ["admin_result"] ["type_id"] == 1) 
			{
				$_A ["admin_module"] = array ( "system", "approve", "borrow", "users", "account", "articles" );
			}
			else 
			{
				$_A ["admin_module"] = explode ( ",",$_A ["admin_result"] ['module'] );
			}
			$_A ["admin_module_purview"] = \adminClass::GetModuleAdmin ( array ( "user_id"=>$_G ["user_id"] ) );
			$display = "";
			foreach ( $_A ["admin_module_purview"] ['all'] as $key =>$value ) 
			{
				$display .= ",'{$key}
			' : {'{$key}
		' : {";
		$_display = array ();
		if ($value ['result'] != false) 
		{
			foreach ( $value ['result'] as $_key =>$_value ) 
			{
				if ($_A ["admin_module_purview"] ["purview"] == "") 
				{
					$_display [] = "'{$_key}
				' : ['{$_value['name']}
			','".U ( $_value ['url'] ) ."']";
		}
		else 
		{
			if (in_array ( $_key,$_A ["admin_module_purview"] ["purview"] )) 
			{
				$_display [] = "'{$_key}
			' : ['{$_value['name']}
		','".U ( $_value ['url'] ) ."']";
	}
}
}
$display .= join ( ",",$_display );
}
$display .= "}}\n\n";
}
$_A ["admin_module_left"] = $display;
$display = array ();
if ($_A ["admin_module_purview"] ['other'] != "") 
{
foreach ( $_A ["admin_module_purview"] ['other'] as $key =>$value ) 
{
$aresutl = $value ['result'];
$aurl = current ( $aresutl );
$display [] .= "'{$key}
' : ['{$value['name']}
','".U ( $aurl ['url'] ) ."']";
}
}
$_A ["admin_module_other"] = join ( ",",$display );
$_A ["admin_module_top"] = $_A ["admin_module_purview"] ["top"];
$_A ["admin_module_all"] = $_A ["admin_module_purview"] ["all"];
}
else 
{
if (ACTION_NAME != 'verify'&&ACTION_NAME != 'login') 
{
redirect ( U ( 'admin/index/login'),0,'页面跳转中...');
exit ();
}
}
}
public function display($tpl,$msg = '') 
{
global $_G,$_A,$tpldir,$MsgInfo;
$_A ['showmsg'] ['msg'] = $msg [0];
$_A ['showmsg'] ['url'] = $msg [1];
$_A ['tpldir'] = '/template/admin';
$_A ['showmsg'] ['content'] = isset ( $msg [2] ) ?$msg [2] : '返回上一页';
$this->assign ( '_G',$_G );
$this->assign ( '_A',$_A );
$this->assign ( "header",$tpldir .'header.html');
$this->assign ( "footer",$tpldir .'footer.html');
$this->assign ( 'MsgInfo',$MsgInfo );
if ($msg == '') 
{
$this->assign ( 'tpldir','/template/admin');
parent::display ( $tpl );
}
else 
{
$this->assign ( 'tpldir','/template/admin');
parent::display ( $tpldir .'msg.html');
}
}
}
