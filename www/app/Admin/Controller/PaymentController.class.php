<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class PaymentController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_REQUEST ['id'] ) &&isset ( $_REQUEST ['status'] )) 
		{
			$sql = "update {payment} set status='".I ( 'request.status') ."' where id = ".I ( 'request.id');
			M ()->execute ( presql ( $sql ) );
		}
		$result = \paymentClass::GetList ();
		if (is_array ( $result )) 
		{
			$_A ['payment_list'] = $result;
		}
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function all() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$result = \paymentClass::GetListAll ();
		if (is_array ( $result )) 
		{
			$_A ['payment_list'] = $result;
		}
		else 
		{
			$msg = array ( $result );
		}
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			$config = isset ( $_POST ['config'] ) ?$_POST ['config'] : "";
			$data ['config'] = serialize ( $config );
			$data ['type'] = isset ( $_REQUEST ['actions'] ) ?I ( 'request.actions') : 'news';
			if ($_REQUEST ['actions'] == "edit") 
			{
				$data ['id'] = isset ( $_POST ['id'] ) ?$_POST ['id'] : "";
			}
			$result = \paymentClass::Action ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ['payment_action_success'], U ( 'payment/lists') );
			}
			else 
			{
				$msg = array ( $result );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "payment";
			$admin_log ["type"] = "action";
			$admin_log ["operating"] = 'news';
			$admin_log ["article_id"] = $data ['id'];
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = join ( ",",$data );
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$data ['nid'] = I ( 'request.nid');
			$data ['id'] = isset ( $_REQUEST ['id'] ) ?I ( 'request.id') : "";
			$result = \paymentClass::GetOne ( $data );
			if (is_array ( $result )) 
			{
				$result ['nid'] = $data ['nid'];
				$_A ['payment_result'] = $result;
			}
			else 
			{
				$msg = array ( $result );
			}
		}
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['nid'] = I ( 'request.nid');
		$data ['id'] = isset ( $_REQUEST ['id'] ) ?I ( 'request.id') : "";
		$result = \paymentClass::GetOne ( $data );
		if (is_array ( $result )) 
		{
			$result ['nid'] = $data ['nid'];
			$_A ['payment_result'] = $result;
		}
		else 
		{
			$msg = array ( $result );
		}
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function start() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['nid'] = I ( 'request.nid');
		$data ['id'] = isset ( $_REQUEST ['id'] ) ?I ( 'request.id') : "";
		$result = \paymentClass::GetOne ( $data );
		if (is_array ( $result )) 
		{
			$result ['nid'] = $data ['nid'];
			$_A ['payment_result'] = $result;
		}
		else 
		{
			$msg = array ( $result );
		}
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function action() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$this->display ( $tpldir .'payment.html',$msg );
	}
	public function del() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['id'] = I ( 'request.id');
		$result = \paymentClass::Delete ( $data );
		if ($result >0) 
		{
			$msg = array ( $MsgInfo ['payment_del_success'], "", $_A ['query_url'] );
		}
		else 
		{
			$msg = array ( $MsgInfo [$result] );
		}
		$admin_log ["user_id"] = $_G ['user_id'];
		$admin_log ["code"] = "payment";
		$admin_log ["type"] = "action";
		$admin_log ["operating"] = "del";
		$admin_log ["article_id"] = $data ['id'];
		$admin_log ["result"] = $result >0 ?1 : 0;
		$admin_log ["content"] = $msg [0];
		\uadminClass::AddAdminLog ( $admin_log );
		$this->display ( $tpldir .'payment.html',$msg );
	}
}
