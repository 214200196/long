<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class InvestController extends HomeController 
{
	public function index() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_G ['user_id'] != '') 
		{
			$data ['user_id'] = $_G ['user_id'];
			$emaiac = \usersClass::GetEmailActiveOne ( $data );
			$this->assign ( 'emaiac',$emaiac );
		}
		$adata ['limit'] = 5;
		$adata ['type_id'] = 16;
		$adata ['flag'] = 'index';
		$arlist = \articlesClass::GetList ( $adata );
		$this->assign ( 'arlist',$arlist );
		$bdata ['is_flow'] = ($_REQUEST ['nid'] == 'flow') ?1 : 2;
		if (isset ( $_REQUEST ['account_status'] )) $bdata ['account_status'] = I ( 'request.account_status');
		if (isset ( $_REQUEST ['borrow_period'] )) $bdata ['borrow_period'] = I ( 'request.borrow_period');
		if (isset ( $_REQUEST ['award_status'] )) $bdata ['award_status'] = I ( 'request.award_status');
		if (isset ( $_REQUEST ['borrow_use'] )) $bdata ['borrow_use'] = I ( 'request.borrow_use');
		if (isset ( $_REQUEST ['vouchstatus'] )) $bdata ['vouchstatus'] = I ( 'request.vouchstatus');
		if (isset ( $_REQUEST ['jine'] )) $bdata ['jine'] = I ( 'request.jine');
		if (isset ( $_REQUEST ['borrow_style'] )) $bdata ['borrow_style'] = I ( 'request.borrow_style');
		if (isset ( $_REQUEST ['borrow_type'] )) $bdata ['borrow_type'] = I ( 'request.borrow_type');
		if (isset ( $_REQUEST ['nid'] )) $bdata ['query_type'] = I ( 'request.nid');
		if (isset ( $_REQUEST ['type'] )) $bdata ['type'] = I ( 'request.type');
		if (isset ( $_REQUEST ['flag'] )) $bdata ['flag'] = I ( 'request.flag');
		if (isset ( $_REQUEST ['account_status'] )) $bdata ['account_status'] = I ( 'request.account_status');
		$blist = \borrowClass::GetList ( $bdata );
		$this->assign ( 'blist',$blist );
		$this->display ( $tpldir .'tender.html');
	}
}
?>