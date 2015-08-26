<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class RemindController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		$lists = \remindClass::GetTypeList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function type_new() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = array ();
			$data ['name'] = I ( 'post.name');
			$data ['nid'] = I ( 'post.nid');
			$data ['order'] = I ( 'post.order');
			if ($_POST ['actions'] != "type_edit") 
			{
				$result = \remindClass::AddType ( $data );
				if ($result == false) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "添加成功" );
				}
			}
			else 
			{
				$data ['id'] = I ( 'post.id');
				$result = \remindClass::UpdateType ( $data );
				if ($result !== true) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "添加成功" );
				}
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "remind";
			$admin_log ["type"] = 'type';
			$admin_log ["operating"] ='type_new';
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$remd = new \remindClass ();
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function type_edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['id'] = I ( 'request.id');
		$_A ['remind_type_result'] = \remindClass::GetTypeOne ( $data );
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function type_del() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$result = \remindClass::DeleteType ( array ( 'id'=>I ( 'request.id') ) );
		if ($result !== true) 
		{
			$msg = array ( $result );
		}
		else 
		{
			$msg = array ( "删除成功" );
		}
		$admin_log ["user_id"] = $_G ['user_id'];
		$admin_log ["code"] = "remind";
		$admin_log ["type"] = 'type';
		$admin_log ["operating"] ='type_del';
		$admin_log ["article_id"] = $result >0 ?$result : 0;
		$admin_log ["result"] = $result >0 ?1 : 0;
		$admin_log ["content"] = $msg [0];
		$admin_log ["data"] = $data;
		\uadminClass::AddAdminLog ( $admin_log );
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			$result = \remindClass::Add ( $data );
			if ($result !== true) 
			{
				$msg = array ( $result );
			}
			else 
			{
				$msg = array ( "操作成功" );
			}
		}
		else 
		{
			$data ['id'] = I ( 'request.id');
			$_A ['remind_type_result'] = \remindClass::GetTypeOne ( $data );
			if (is_array ( $_A ['remind_type_result'] )) 
			{
				$data=array();
				$data ['limit'] = "all";
				$data ['type_id'] = I ( 'request.id');
				$_A ['remind_list'] = \remindClass::GetList ( $data );
			}
			else 
			{
				$msg = array ( $result );
			}
			$pname = empty ( $pname ) ?"跟类型下": $pname;
			$this->assign ( 'pname',$pname );
		}
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function type_action() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['id'] )) 
		{
			$_POST = I ( 'post.');
			$data ['id'] = $_POST ['id'];
			$data ['name'] = $_POST ['name'];
			$data ['nid'] = $_POST ['nid'];
			$data ['order'] = $_POST ['order'];
			$result = \remindClass::ActionType ( $data );
			if ($result !== true) 
			{
				$msg = array ( $result ,U('Remind/lists') );
			}
			else 
			{
				$msg = array ( "操作成功",U('Remind/lists') );
			}
		}
		else 
		{
			if (isset ( $_POST ['name'] )) 
			{
				$_POST = I ( 'post.');
				$data ['type'] = $_POST ['type'];
				$data ['name'] = $_POST ['name'];
				$data ['nid'] = $_POST ['nid'];
				$data ['order'] = $_POST ['order'];
				$result = \remindClass::ActionType ( $data );
				if ($result !== true) 
				{
					$msg = array ( $result );
				}
				else 
				{
					$msg = array ( "操作成功" );
				}
			}
			else 
			{
				$msg = array ( "操作有误" );
			}
		}
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function del() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$id = I ( 'request.id');
		$result = \remindClass::Delete ( array ( "id"=>$id ) );
		if ($result !== true) 
		{
			$msg = array ( $result ,U('Remind/lists') );
		}
		else 
		{
			$msg = array ( "删除成功",U('Remind/lists') );
		}
		$this->display ( $tpldir .'remind.html',$msg );
	}
	public function actions() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['id'] )) 
		{
			$data = I ( 'post.');
			$result = \remindClass::Action ( $data );
			if ($result !== true) 
			{
				$msg = array ( $result ,U('Remind/lists') );
			}
			else 
			{
				$msg = array ( "操作成功",U('Remind/lists') );
			}
		}
		else 
		{
			if (isset ( $_POST ['name'] )) 
			{
				$data = I ( 'post.');
				$data ['type'] = "add";
				$result = \remindClass::Action ( $data );
				if ($result !== true) 
				{
					$msg = array ( $result ,U('Remind/lists') );
				}
				else 
				{
					$msg = array ( "操作成功",U('Remind/lists') );
				}
			}
			else 
			{
				$msg = array ( "操作有误",U('Remind/lists') );
			}
		}
		$this->display ( $tpldir .'remind.html',$msg );
	}
}
