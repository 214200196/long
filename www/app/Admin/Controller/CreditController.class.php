<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class CreditController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \creditClass::GetList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'credit.html',$msg );
	}
	public function log() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "credit_log");
		if ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['credit'] != "") 
			{
				$data = array ();
				$data ['credit'] = I ( 'post.credit');
				$data ['user_id'] = I ( 'post.user_id');
				$data ['id'] = I ( 'request.examine');
				$result = \creditClass::UpdateCredit ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'Credit/log') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "credit";
				$admin_log ["type"] = "credit";
				$admin_log ["operating"] = "update";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
			else 
			{
				$data = array ();
				$data ['id'] = I ( 'request.examine');
				$result = \creditClass::GetLogOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["credit_result"] = $result;
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
			}
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['nid'] )) $data ['nid'] = I ( 'request.nid');
			if (isset ( $_REQUEST ['class_id'] )) $data ['class_id'] = I ( 'request.class_id');
			$lists = \creditClass::GetLogList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'credit.html',$msg );
	}
	public function rank() 
	{
		check_rank ( "credit_rank");
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			if ($_POST ['id'] != "") 
			{
				$result = \creditClass::UpdateRank ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_rank_update_success"], U ( 'Credit/rank') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
			}
			else 
			{
				$result = \creditClass::AddRank ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_rank_add_success"], U ( 'Credit/rank') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "add";
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "rank";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = $_REQUEST ['edit'];
			$result = \creditClass::GetRankOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["credit_rank_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \creditClass::DeleteRank ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["credit_rank_del_success"], U ( 'Credit/rank') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "rank";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$data = array ();
			$data ['limit'] = 'all';
			if (isset ( $_REQUEST ['class_id'] )) $data ['class_id'] = I ( 'request.class_id');
			$list = \creditClass::GetRankList ( $data );
			$this->assign ( 'list',$list );
		}
		$this->display ( $tpldir .'credit.html',$msg );
	}
	public function type() 
	{
		check_rank ( "credit_type");
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			if ($_POST ['id'] != "") 
			{
				$result = \creditClass::UpdateType ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_type_update_success"], U ( 'Credit/type') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
			}
			else 
			{
				$result = \creditClass::AddType ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_type_add_success"], U ( 'Credit/type') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "add";
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "type";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \creditClass::GetTypeOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["credit_type_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \creditClass::DeleteType ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["credit_type_del_success"], U ( 'Credit/type') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "type";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['name'] )) $data ['name'] = I ( 'request.name');
			if (isset ( $_REQUEST ['nid'] )) $data ['nid'] = I ( 'request.nid');
			$lists = \creditClass::GetTypeList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'credit.html',$msg );
	}
	public function classes() 
	{
		check_rank ( "credit_class");
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			if ($_POST ['id'] != "") 
			{
				$result = \creditClass::UpdateClass ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_class_update_success"], U ( 'Credit/classes') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
			}
			else 
			{
				$result = \creditClass::AddClass ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["credit_class_add_success"], U ( 'Credit/classes') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "add";
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "class";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \creditClass::GetClassOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["credit_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \creditClass::DeleteClass ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["credit_class_del_success"], U ( 'Credit/classes') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "credit";
			$admin_log ["type"] = "class";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$list = \creditClass::GetClassList ( array ( 'limit'=>'all' ) );
		$this->assign ( 'list',$list );
		$this->display ( $tpldir .'credit.html',$msg );
	}
}
?>