<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class MessageController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$data ['type'] = I ( 'request.type');
			$result = \messageClass::DeleteMessage ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/lists') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "message";
			$admin_log ["type"] = $data ['type'];
			$admin_log ["operating"] = "delete";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = (join ( ",",$data ));
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif (isset ( $_POST ['type'] )) 
		{
			if ($_POST ['type'] == "delete") 
			{
				$data ['id'] = I ( 'post.id');
				$result = \messageClass::DeleteMessage ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/lists') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
			}
		}
		elseif ($_REQUEST ['send'] != "") 
		{
			$data ['send_id'] = I ( 'request.send');
			$data ['send_status'] = 1;
			$result = \messageClass::SendMessage ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/lists') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "message";
			$admin_log ["type"] = $data ['type'];
			$admin_log ["operating"] = "delete";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = (join ( ",",$data ));
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			$lists = \messageClass::GetMessageList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'message.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['status'] != "") 
		{
			$data = I ( 'post.');
			$data ['user_id'] = 0;
			$result = \messageClass::AddMessage ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_send_success"], U ( 'Message/news') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "message";
			$admin_log ["type"] = $data ['type'];
			$admin_log ["operating"] = "add";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = (join ( ",",$data ));
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$tlist = \usersClass::GetUsersTypeList ( array ( 'limit'=>'all' ) );
		$alist = \uadminClass::GetAdminTypeList ( array ( 'limit'=>'all' ) );
		$this->assign ( 'tlist',$tlist );
		$this->assign ( 'alist',$alist );
		$this->display ( $tpldir .'message.html',$msg );
	}
	public function receive() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$data ['type'] = I ( 'request.type');
			$result = \messageClass::DeleteMessageReceive ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_receive_delete_success"], U ( 'Message/receive') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "message";
			$admin_log ["type"] = "receive";
			$admin_log ["operating"] = "delete";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = (join ( ",",$data ));
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif (isset ( $_POST ['type'] )) 
		{
			if ($_POST ['type'] == "deled") 
			{
				$data ['id'] = I ( 'post.');
				$result = \messageClass::DeleteMessageReceive ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/receive') );
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
			$lists = \messageClass::GetMessageReceiveList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'message.html',$msg );
	}
}
