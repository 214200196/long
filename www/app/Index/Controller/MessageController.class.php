<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class MessageController extends HomeController 
{
	public function index() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$data ['user_id'] = $_G ['user_id'];
			$result = \messageClass::DeleteMessageReceive ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/index') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif (isset ( $_POST ['type'] )) 
		{
			if ($_POST ['type'] == "delete") 
			{
				$data ['id'] = I ( 'post.id');
				$data ['user_id'] = $_G ['user_id'];
				$result = \messageClass::DeleteMessageReceive ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["message_delete_success"], U ( 'Message/index') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
			}
			elseif ($_POST ['type'] == "yes"||$_POST ['type'] == "no") 
			{
				$data ['id'] = $_POST ['id'];
				$data ['user_id'] = $_G ['user_id'];
				$data ['status'] = ($_POST ['type'] == "yes") ?1 : 0;
				$result = \messageClass::ActionMessageReceive ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["message_action_success"], U ( 'Message/index') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
			}
		}
		$lists = \messageClass::GetMessageReceiveList ( array ( 'username'=>$_G ['user_result'] ['username'] ) );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
	}
	public function sented() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if ($_POST ['type'] == "deled") 
		{
			$data ['id'] = I ( 'post.id');
			$data ['user_id'] = $_G ['user_id'];
			$result = \messageClass::DeleteMessage ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_delete_success"], U ( 'message/sented') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		$lists = \messageClass::GetMessageList ( array ( 'username'=>$_G ['user_result'] ['username'], ' status'=>1 ) );
		define ( 'THEME_PATH',$tpldir );
		layout ( 'user_main');
		$this->assign ( $lists );
		$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
	}
	public function sent() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		if (isset ( $_POST ['contents'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data ['receive_user'] = I ( 'post.receive_user');
				$info=M('users_info')->alias('p1')->join(presql('`{users}` as p2 on p2.user_id=p1.user_id'))->where("p1.niname='{$data ['receive_user']}
			'")->field('p1.*,p2.username')->find();
			$data ['receive_user']=$info['username'];
			$data ['contents'] = I ( 'post.contents');
			$data ['name'] = I ( 'post.name');
			$data ['status'] = I ( 'post.status');
			$data ['user_id'] = $_G ['user_id'];
			$data ['type'] = "user";
			$result = \messageClass::AddMessage ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["message_send_success"], U ( 'message/sent') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
	}
	define ( 'THEME_PATH',$tpldir );
	layout ( 'user_main');
	$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
}
public function view() 
{
	global $_G,$tpldir,$_U,$MsgInfo;
	$data ['user_id'] = $_G ['user_id'];
	$data ['id'] = I ( 'request.id');
	$data ['status'] = 1;
	$result = \messageClass::GetMessageReceiveOne ( $data );
	if (is_array ( $result )) 
	{
		$_U ['message_result'] = $result;
	}
	else 
	{
		$msg = array ( $MsgInfo [$result], U ( 'message/view') );
	}
	define ( 'THEME_PATH',$tpldir );
	layout ( 'user_main');
	$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
}
public function viewed() 
{
	global $_G,$tpldir,$_U,$MsgInfo;
	$data ['user_id'] = $_G ['user_id'];
	$data ['id'] = I ( 'request.id');
	$result = \messageClass::GetMessageOne ( $data );
	if (is_array ( $result )) 
	{
		$_U ['message_result'] = $result;
	}
	else 
	{
		$msg = array ( $MsgInfo [$result], U ( 'message/viewed') );
	}
	define ( 'THEME_PATH',$tpldir );
	layout ( 'user_main');
	$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
}
public function deled() 
{
	global $_G,$tpldir,$_U,$MsgInfo;
	if (isset ( $_REQUEST ['id'] )) 
	{
		$data ['id'] = I ( 'request.id');
		$data ['user_id'] = $_G ['user_id'];
		$result = \messageClass::DeleteMessage ( $data );
		if ($result >0) 
		{
			$msg = array ( $MsgInfo ["message_action_success"], U ( 'message/index') );
		}
		else 
		{
			$msg = array ( $MsgInfo [$result] );
		}
	}
	else 
	{
		$msg = array ( "请选中再进行操作" );
	}
	define ( 'THEME_PATH',$tpldir );
	layout ( 'user_main');
	$this->display ( $tpldir .'user_message.html',$msg,'user_header.html');
}
}
?>