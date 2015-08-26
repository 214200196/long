<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class ApproveController extends AdminController 
{
	public function index() 
	{
		$this->display ( $tpldir .'users.admin.html',$msg );
	}
	public function realname() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$msg = '';
		if ($_POST ['type'] == "user_id") 
		{
			$data = I ( 'post.');
			$data ["limit"] = "all";
			$result = \approveClass::GetUserid ( $data );
			if ($result >0) 
			{
				echo "<script>location.href='".U ( 'Approve/realname?user_id='.$result ) ."'</script>";
				exit ();
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'Approve/realname') );
			}
		}
		elseif (isset ( $_POST ['realname'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				$datapic ['file'] = "card_pic1";
				$datapic ['code'] = "approve";
				$datapic ['user_id'] = $data ['user_id'];
				$datapic ['type'] = "realname";
				$datapic ['article_id'] = $data ["user_id"];
				$pic_result = $this->upfiles ( 'card_pic1','approve',$datapic );
				if ($pic_result != false) 
				{
					$data ["card_pic1"] = $pic_result ["upfiles_id"];
				}
				$pic_result = $this->upfiles ( 'card_pic2','approve',$datapic );
				if ($pic_result != false) 
				{
					$data ["card_pic2"] = $pic_result ["upfiles_id"];
				}
				$result = \approveClass::UpdateRealname ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["approve_realname_update_success"], U ( 'Approve/realname') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "realname";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['user_id'] != "") 
		{
			$data ["user_id"] = I ( 'request.user_id');
			$result = \approveClass::GetRealnameOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'Approve/realname') );
			}
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				if (!check_verify ( I ( 'post.valicode') )) 
				{
					$msg = array ( '验证码错误' );
				}
				if ($msg == "") 
				{
					$data = I ( 'post.');
					$data ['user_id'] = I ( 'request.examine');
					$data ['verify_userid'] = $_G ['user_id'];
					$result = \approveClass::CheckRealname ( $data );
					if ($result >0) 
					{
						$msg = array ( "操作成功", U ( 'Approve/realname') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "approve";
					$admin_log ["type"] = "realname";
					$admin_log ["operating"] = "check";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
			else 
			{
				$data ["user_id"] = I ( 'request.examine');
				$result = \approveClass::GetRealnameOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["approve_result"] = $result;
				}
				else 
				{
					$msg = array ( $MsgInfo [$result], U ( 'Approve/realname') );
				}
			}
		}
		elseif ($_REQUEST ['id5'] != "") 
		{
			if ($_POST ['verify_remark'] != "") 
			{
				if (!check_verify ( I ( 'post.valicode') )) 
				{
					$msg = array ( '验证码错误' );
				}
				if ($msg == "") 
				{
					$data ['verify_id5_remark'] = $_POST ['verify_remark'];
					$data ['user_id'] = I ( 'request.id5');
					$data ['verify_id5_userid'] = $_G ['user_id'];
					if ($_G ['system'] ['con_id5_status'] == 0) 
					{
						$result = "approve_realname_id5_close";
					}
					else 
					{
						$result = \approveClass::CheckRealnameId5 ( $data );
					}
					if ($result >0) 
					{
						\usersClass::UpdateUsersInfo ( array ( "user_id"=>$data ['user_id'], "realname_status"=>1 ) );
						$msg = array ( "操作成功", U ( 'Approve/realname') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "approve";
					$admin_log ["type"] = "realname";
					$admin_log ["operating"] = "checkid5";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
		}
		elseif ($_REQUEST ['action'] == 'id5list') 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['realname'] )) $data ['realname'] = I ( 'request.realname');
			if (isset ( $_REQUEST ['card_id'] )) $data ['card_id'] = I ( 'request.card_id');
			$lists = \approveClass::GetId5List ( $data );
			$this->assign ( $lists );
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['realname'] )) $data ['realname'] = I ( 'request.realname');
			if (isset ( $_REQUEST ['card_id'] )) $data ['card_id'] = I ( 'request.card_id');
			$lists = \approveClass::GetRealnameList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'realname.html',$msg );
	}
	public function sms() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['phone'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \approveClass::UpdateSms ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["approve_sms_update_success"], U ( 'approve/sms') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result], "", $_A ['query_url_all'] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \approveClass::AddSms ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["approve_sms_add_success"], U ( 'approve/sms') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result], U ( 'approve/sms') );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "sms";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \approveClass::GetSmsOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data = I ( 'post.');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \approveClass::CheckSms ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["approve_sms_check_success"], U ( 'approve/sms') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "sms";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
			else 
			{
				$data ['id'] = I ( 'request.examine');
				$result = \approveClass::GetSmsOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["approve_result"] = $result;
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
			if (isset ( $_REQUEST ['phone'] )) $data ['phone'] = I ( 'request.phone');
			if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
			$lists = \approveClass::GetSmsList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'approve.html',$msg );
	}
	public function sms_log() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['contents'] != "") 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				$data ['type'] = "system";
				$result = \approveClass::AddSmslogGroup ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["approve_sms_send_group_success"], U ( 'approve/sms_log') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "sms";
				$admin_log ["operating"] = "send_group";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['view'] != "") 
		{
			$data ['id'] = $_REQUEST ['view'];
			$result = \approveClass::GetSmslogOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		else 
		{
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['phone'] )) $data ['phone'] = I ( 'request.phone');
			if (isset ( $_REQUEST ['status'] )) $data ['status'] = I ( 'request.status');
			$lists = \approveClass::GetSmslogList ( $data );
			$this->assign($lists);
		}
		$this->display ( $tpldir .'approve.html',$msg );
	}
	public function sms_set() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['con_sms_status'] )) 
		{
			$data = I ( 'post.');
			$result = \adminClass::UpdateSystem ( $data );
			$msg = array ( $MsgInfo ["admin_info_success"] );
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "system";
			$admin_log ["type"] = "sms";
			$admin_log ["operating"] = "set";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$this->display ( $tpldir .'approve.html',$msg );
	}
	public function video() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['type'] == "user_id") 
		{
			$data = I ( 'post.');
			$data ["limit"] = "all";
			$result = \approveClass::GetUserid ( $data );
			if ($result >0) 
			{
				echo "<script>location.href='".U ( 'approve/video?user_id='.$result ) ."'</script>";
				exit ();
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'approve/video') );
			}
		}
		elseif (isset ( $_POST ['remark'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				$result = \approveClass::UpdateVideo ( $data );
				if ($result >0) 
				{
					$msg = array ( $MsgInfo ["approve_video_update_success"], U ( 'approve/video') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "video";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['user_id'] != "") 
		{
			$data ["user_id"] = I ( 'request.user_id');
			$result = \approveClass::GetVideoOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'approve/video') );
			}
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				if (!check_verify ( I ( 'post.valicode') )) 
				{
					$msg = array ( '验证码错误' );
				}
				if ($msg == "") 
				{
					$data = I ( 'post.');
					$data ['user_id'] = I ( 'request.examine');
					$data ['verify_userid'] = $_G ['user_id'];
					$result = \approveClass::CheckVideo ( $data );
					if ($result >0) 
					{
						$msg = array ( "操作成功", U ( 'approve/video') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "approve";
					$admin_log ["type"] = "video";
					$admin_log ["operating"] = "check";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
			else 
			{
				$data ["user_id"] = I ( 'request.examine');
				$result = \approveClass::GetVideoOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["approve_result"] = $result;
				}
				else 
				{
					$msg = array ( $MsgInfo [$result], U ( 'approve/video') );
				}
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['realname'] )) $data ['realname'] = I ( 'request.realname');
		if (isset ( $_REQUEST ['card_id'] )) $data ['card_id'] = I ( 'request.card_id');
		$lists = \approveClass::GetVideoList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'approve.video.html',$msg );
	}
	public function flow() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['type'] == "user_id") 
		{
			$data = I ( 'post.');
			$data ["limit"] = "all";
			$result = \approveClass::GetUserid ( $data );
			if ($result >0) 
			{
				echo "<script>location.href='".U ( 'approve/flow?user_id='.$result ) ."'</script>";
				exit ();
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'approve/flow') );
			}
		}
		elseif (isset ( $_POST ['remark'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				$result = \approveClass::UpdateFlow ( $data );
				if ($result >0) 
				{
					$msg = array ( "修改成功", U ( 'approve/flow') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "flow";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['user_id'] != "") 
		{
			$data ["user_id"] = I ( 'request.user_id');
			$result = \approveClass::GetFlowOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( "ID错误", U ( 'approve/flow') );
			}
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				if (!check_verify ( I ( 'post.valicode') )) 
				{
					$msg = array ( '验证码错误' );
				}
				if ($msg == "") 
				{
					$data = I ( 'post.');
					$data ['user_id'] = I ( 'request.examine');
					$data ['verify_userid'] = $_G ['user_id'];
					$result = \approveClass::CheckFlow ( $data );
					if ($result >0) 
					{
						$msg = array ( "操作成功", U ( 'approve/flow') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "approve";
					$admin_log ["type"] = "flow";
					$admin_log ["operating"] = "check";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
			else 
			{
				$data ["user_id"] = $_REQUEST ['examine'];
				$result = \approveClass::GetFlowOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["approve_result"] = $result;
				}
				else 
				{
					$msg = array ( $MsgInfo [$result], U ( 'approve/flow') );
				}
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['realname'] )) $data ['realname'] = I ( 'request.realname');
		if (isset ( $_REQUEST ['card_id'] )) $data ['card_id'] = I ( 'request.card_id');
		$lists = \approveClass::GetFlowList ( $data );
		$this->display ( $tpldir .'approve.flow.html',$msg );
	}
	public function invite() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['type'] == "user_id") 
		{
			$data = I ( 'post.');
			$data ["limit"] = "all";
			$result = \approveClass::GetUserid ( $data );
			if ($result >0) 
			{
				echo "<script>location.href='".U ( 'approve/invite?user_id='.$result ) ."'</script>";
				exit ();
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'approve/invite') );
			}
		}
		elseif (isset ( $_POST ['remark'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				$result = \approveClass::UpdateInvite ( $data );
				if ($result >0) 
				{
					$msg = array ( "修改成功", U ( 'approve/invite') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["operating"] = "update";
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "approve";
				$admin_log ["type"] = "invite";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['user_id'] != "") 
		{
			$data ["user_id"] = I ( 'request.user_id');
			$result = \approveClass::GetInviteOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["approve_result"] = $result;
			}
			else 
			{
				$msg = array ( "ID错误", U ( 'approve/invite') );
			}
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				if (!check_verify ( I ( 'post.valicode') )) 
				{
					$msg = array ( '验证码错误' );
				}
				if ($msg == "") 
				{
					$data = I ( 'post.');
					$data ['user_id'] = I ( 'request.examine');
					$data ['verify_userid'] = $_G ['user_id'];
					$result = \approveClass::CheckInvite ( $data );
					$datainfo = array ();
					if ($result >0) 
					{
						$msg = array ( "操作成功", U ( 'approve/invite') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "approve";
					$admin_log ["type"] = "flow";
					$admin_log ["operating"] = "check";
					$admin_log ["article_id"] = $result >0 ?$result : 0;
					$admin_log ["result"] = $result >0 ?1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			}
			else 
			{
				$data ["user_id"] = I ( 'request.examine');
				$result = \approveClass::GetInviteOne ( $data );
				if (is_array ( $result )) 
				{
					$_A ["approve_result"] = $result;
				}
				else 
				{
					$msg = array ( $MsgInfo [$result], U ( 'approve/invite') );
				}
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['realname'] )) $data ['realname'] = I ( 'request.realname');
		if (isset ( $_REQUEST ['card_id'] )) $data ['card_id'] = I ( 'request.card_id');
		$lists = \approveClass::GetInviteList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'approve.invite.html',$msg );
	}
}
?>