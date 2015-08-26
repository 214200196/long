<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
use Common\Controller\BaseController;
class HomeController extends BaseController 
{
	public function _initialize() 
	{
		parent::_initialize ();
		global $tpldir,$_G;
		$site_nid = I ( 'request.site');
		$_G ['site'] = \adminClass::GetSiteList ( array ( "limit"=>"all" ) );
		$site_result = \adminClass::GetSiteOnes ( array ( "nid"=>$site_nid ) );
		$_G['site_result']=$site_result;
		if ($_G ['site_result'] ['type'] == "page") 
		{
			$_G ['page_result'] = \articlesClass::GetPageOne ( array ( "id"=>$_G ['site_result'] ['value'] ) );
		}
		foreach ( $_G ['site'] as $key =>$value ) 
		{
			if ($value ['pid'] == $site_result ['id']) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_sub_list'] [] = $value;
				}
			}
			if ($value ['pid'] == 1) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_sub_list_1'] [] = $value;
				}
			}
			if ($value ['pid'] == 9) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_sub_list_9'] [] = $value;
				}
			}
			if ($value ['id'] == $site_result ['pid']) 
			{
				$_G ['site_presult'] = $value;
			}
			if ($value ['pid'] == $site_result['pid']) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_brother_list'] [] = $value;
				}
			}
			if ($value ['pid'] == 10) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_sub_list_10'] [] = $value;
				}
			}
			if ($value ['pid'] == 7) 
			{
				if ($value ['status'] == 1) 
				{
					$_G ['site_sub_list_7'] [] = $value;
				}
			}
		}
		$tpldir = ROOT_PATH .'template/rongzi/';
	}
	public function display($tpl,$msg = '',$header = 'header.html',$foot = 'footer.html') 
	{
		global $_G,$_U,$tpldir;
		$_U ['showmsg'] ['msg'] = $msg [0];
		$_U ['showmsg'] ['url'] = $msg [1];
		$_U ['showmsg'] ['content'] = isset ( $msg [2] ) ?$msg [2] : '返回上一页';
		$ldata ['type_id'] = 44;
		$ldata ['limit'] = 20;
		$links = \linksClass::GetList ( $ldata );
		$this->assign ( 'links',$links );
		$this->assign ( '_G',$_G );
		$this->assign ( '_U',$_U );
		$this->assign ( "header",$tpldir .$header );
		$this->assign ( "footer",$tpldir .$foot );
		$this->assign ( "tpldir",'/template/rongzi/');
		if ($msg == '') 
		{
			parent::display ( $tpl );
		}
		else 
		{
			layout ( false );
			$this->assign ( "header",$tpldir .'header.html');
			parent::display ( $tpldir .'umsg.html');
		}
	}
}
?>