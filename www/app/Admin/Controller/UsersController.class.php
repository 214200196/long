<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class UsersController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['email'] )) $data ['email'] = I ( 'request.email');
		if (isset ( $_REQUEST ['order'] )) $data ['order'] = I ( 'request.order');
		$lists = \usersClass::GetUsersList ( $data );
		$this->assign ( $lists );
		$this->assign ( 'MsgInfo',$MsgInfo );
		$this->display ( $tpldir .'userlists.html',$msg );
	}
	public function type() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data ['name'] = I ( 'post.name');
				$data ['nid'] = I ( 'post.nid');
				$data ['remark'] = I ( 'post.remark');
				$data ['order'] = I ( 'post.order');
				$data ['checked'] = I ( 'post.checked');
				if ($_POST ['id'] != "") 
				{
					$data ['id'] = I ( 'post.id');
					$result = \usersClass::UpdateUsersType ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["users_type_update_success"], U ( 'Users/type') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \usersClass::AddUsersType ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["users_type_add_success"], U ( 'Users/type') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "users";
				$admin_log ["type"] = "type";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['checked'] != "") 
		{
			$data ['id'] = I ( 'request.checked');
			$result = \usersClass::UpdateUsersTypeChecked ( $data );
			$msg = array ( '操作成功', U ( 'Users/type') );
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
			$admin_log ["type"] = "type";
			$admin_log ["operating"] = "checked";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = $_REQUEST ['edit'];
			$result = \usersClass::GetUsersTypeOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["users_type_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = $_REQUEST ['del'];
			$result = \usersClass::DelUsersType ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["users_type_del_success"], U ( 'Users/type') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
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
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			$lists = \usersClass::GetUsersTypeList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir .'usertype.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['user_id'] != "") 
		{
			$data ['user_id'] = I ( 'post.user_id');
			$msg = "";
			if ($_POST ['password'] != "") 
			{
				if ($_POST ['password'] != $_POST ['password1']) 
				{
					$msg = array ( $MsgInfo ['users_password_error'] );
				}
				else 
				{
					$data ['password'] = I ( 'post.password');
					$result = \usersClass::UpdatePassword ( $data );
					if ($result >0) 
					{
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
				}
			}
			if ($msg == ""&&$_POST ['paypassword'] != "") 
			{
				if ($_POST ['paypassword'] != $_POST ['paypassword1']) 
				{
					$msg = array ( $MsgInfo ['users_password_error'] );
				}
				else 
				{
					$data ['paypassword'] = I ( 'post.paypassword');
					$result = \usersClass::UpdatePayPassword ( $data );
					if ($result >0) 
					{
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
				}
			}
			$msg = array ( "操作成功" );
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
			$admin_log ["type"] = "edit";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$_A ['users_result'] = \usersClass::GetUsers ( array ( "user_id"=>I ( 'request.user_id') ) );
		}
		$this->display ( $tpldir .'userlists.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$msg = '';
		if ($_POST ['username'] != "") 
		{
			if ($_POST ['password'] != $_POST ['password1']) 
			{
				$msg = array ( '输入密码不一致' );
			}
			elseif ($_POST ['paypassword'] != $_POST ['paypassword1']) 
			{
				$msg = array ( '输入支付密码不一致' );
			}
			else 
			{
				$data = array ();
				$data ['username'] = I ( 'post.username');
				$data ['email'] = I ( 'post.email');
				$data ['password'] = I ( 'post.password');
				$data ['paypassword'] = I ( 'post.paypassword');
				$result = \usersClass::AddUsers ( $data );
				if ($result >0) 
				{
					$admin_log ["article_id"] = $result;
					$admin_log ["result"] = 1;
					$admin_log ["content"] = str_replace ( array ( '#username#' ),array ( $data ['username'] ),$MsgInfo ["users_add_success_msg"] );
					$msg = array ( $MsgInfo ["users_add_success"] );
				}
				else 
				{
					$admin_log ["article_id"] = 0;
					$admin_log ["result"] = 0;
					$admin_log ["content"] = str_replace ( array ( '#username#' ),array ( $data ['username'] ),$MsgInfo ["users_add_error_msg"] ) ."(".$MsgInfo [$result] .")";
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "users";
				$admin_log ["type"] = "action";
				$admin_log ["operating"] = "add";
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$this->display ( $tpldir .'userlists.html',$msg );
	}
	public function info() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['email'] )) $data ['email'] = I ( 'request.email');
		$lists = \usersClass::GetUsersInfoList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'userinfo.html',$msg );
	}
	public function info_edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_POST ['user_id'] != "") 
		{
			if($_POST['invite_name']!=NULL&&$_POST['invite_name']!='')
			{
				$invite=\usersClass::GetUsers(array('username'=>I ( 'post.invite_name')));
				$inviteinfo=\usersClass::GetUsersInfo(array('user_id'=>$invite['user_id']));
				if($inviteinfo['invite_status']==1)
				{
					$data_info ['invite_userid']=$invite['user_id'];
					$ininfo='';
					$data ['invite_userid'] = $invite['user_id'];
				}
				else
				{
					$ininfo=",推荐人未开启推荐状态添加失败";
				}
			}
			$data ['user_id'] = I ( 'post.user_id');
			$data ['niname'] = I ( 'post.niname');
			$data ['sex'] = I ( 'post.sex');
			$data ['birthday'] = I ( 'post.birthday');
			$data ['status'] = I ( 'post.status');
			$data ['province'] = I ( 'post.province');
			$data ['city'] = I ( 'post.city');
			$data ['area'] = I ( 'post.area');
			$data ['question'] = I ( 'post.question');
			$data ['answer'] = I ( 'post.answer');
			$result = \usersClass::UpdateUsersInfo ( $data );
			if ($data_info ['invite_userid'] != ""&&$data_info ['invite_userid']!=NULL) 
			{
				$frend=M('users_friends_invite')->where("friends_userid=".I ( 'post.user_id'))->find();
				if($frend==NULL)
				{
					$indata ['user_id'] = $data_info ['invite_userid'];
					$indata ['friends_userid'] =I ( 'post.user_id');
					$indata ['addtime'] = time ();
					$indata ['addip'] = get_client_ip ();
					$indata ['status'] = 1;
					$indata ['type'] = 1;
					M ( 'users_friends_invite')->add ( $indata );
				}
				else
				{
					$indata ['user_id'] = $data_info ['invite_userid'];
					$indata ['friends_userid'] =I ( 'post.user_id');
					$indata ['addtime'] = time ();
					$indata ['addip'] = get_client_ip ();
					$indata ['status'] = 1;
					$indata ['type'] = 1;
					M ( 'users_friends_invite')->where("id={$frend['id']}
				")->save ( $indata );
			}
		}
		$admin_log ["user_id"] = $_G ['user_id'];
		$admin_log ["code"] = "users";
		$admin_log ["type"] = "info";
		$admin_log ["article_id"] = $result >0 ?$result : 0;
		$admin_log ["result"] = $result >0 ?1 : 0;
		$admin_log ["content"] = "用户修改成功".$ininfo;
		$admin_log ["data"] = $data;
		\uadminClass::AddAdminLog ( $admin_log );
		$msg = array ( "修改成功".$ininfo );
	}
	else 
	{
		$_A ['_user_result'] = \usersClass::GetUsersInfo ( array ( "user_id"=>$_REQUEST ['user_id'] ) );
	}
	$this->display ( $tpldir .'info_edit.html',$msg );
}
public function vip() 
{
	global $tpldir,$_G,$_A,$MsgInfo;
	check_rank ( "users_vip");
	if ($_REQUEST ['action'] == "view") 
	{
		if (isset ( $_POST ['status'] )) 
		{
			$data ['status'] = I ( 'post.status');
			$data ['verify_remark'] = I ( 'post.verify_remark');
			$data ['user_id'] = I ( 'post.user_id');
			$data ['kefu_userid'] = I ( 'post.kefu_userid');
			$data ['years'] = I ( 'post.years');
			$data ['verify_time'] = time ();
			$data ['user_id'] = I ( 'request.user_id');
			$data ['verify_userid'] = $_G ['user_id'];
			$user_id = I ( 'request.user_id');
			$_result = \usersvipClass::GetUsersVip ( array ( "user_id"=>$data ["user_id"] ) );
			if ($_result ['status'] == 1) 
			{
				$result = \usersvipClass::UpdateUsersVipKefu ( array ( "user_id"=>$data ["user_id"], "kefu_userid"=>$data ['kefu_userid'] ) );
				$msg = array ( "客服修改成功" );
				$admin_log ["operating"] = "update";
			}
			else 
			{
				$result = \usersvipClass::CheckUsersVip ( $data );
				$admin_log ["operating"] = "check";
				if ($data ['status'] == 1) 
				{
					if ($_G ['system'] ['con_vipfee_now'] == 1) 
					{
						$vip ["user_id"] = $data ['user_id'];
						$vip ["nid"] = "vip_success_".$data ['user_id'];
						if ($_result ['vip_type'] == 1) 
						{
							$vip ["money"] = $_G ['system'] ['con_vip_fee'];
						}
						elseif ($_result ['vip_type'] == 2) 
						{
							$vip ["money"] = $_G ['system'] ['con_vip_gao'];
						}
						$vip ["income"] = 0;
						$vip ["expend"] = $vip ["money"];
						$vip ["balance"] = -$vip ["money"];
						$vip ["balance_cash"] = -$vip ["money"];
						$vip ["balance_frost"] = 0;
						$vip ["frost"] = 0;
						$vip ["await"] = 0;
						$vip ["type"] = "vip_success";
						$vip ["to_userid"] = 0;
						$vip ["remark"] = "通过Vip审核";
						\accountClass::AddLog ( $vip );
						\usersvipClass::UpdateUsersVipMoney (array('money'=>$vip ["money"]));
					}
				}
				$msg = array ( "VIP用户审核成功", );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
			$admin_log ["type"] = "vip";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$result = \usersvipClass::GetUsersVip ( array ( "user_id"=>I ( 'request.user_id') ) );
			$_A ['vip_result'] = $result;
			$alist = \uadminClass::GetUsersAdminList ( array ( 'limit'=>'all' ) );
			$this->assign ( 'alist',$alist );
		}
	}
	else 
	{
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		if (isset ( $_REQUEST ['vip_type'] )) $data ['vip_type'] = I ( 'request.vip_type');
		if (isset ( $_REQUEST ['dotime1'] )) $data ['dotime1'] = I ( 'request.dotime1');
		if (isset ( $_REQUEST ['dotime2'] )) $data ['dotime2'] = I ( 'request.dotime2');
		$data ['status'] = 1;
		$lists = \usersClass::GetUsersVipList ( $data );
		$this->assign ( $lists );
	}
	$this->display ( $tpldir .'users.vip.html',$msg );
}
public function examine() 
{
	global $tpldir,$_G,$_A,$MsgInfo;
	$data = array ();
	$data ['page'] = I ( 'get.p');
	if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
	$lists = \usersClass::GetExamineList ( $data );
	$this->assign ( $lists );
	$this->display ( $tpldir .'examine.html',$msg );
}
public function views() 
{
	global $tpldir,$_G,$_A,$MsgInfo;
	$data ['user_id'] = I ( 'request.user_id');
	$_A ['user_result'] = \usersClass::GetUsersview ( $data );
	$this->display ( $tpldir .'userviews.html',$msg );
}
public function viewinfo() 
{
	global $tpldir,$_G,$_A,$MsgInfo;
	$msg = '';
	$data ['user_id'] = I ( 'request.user_id');
	if ($_REQUEST ['type'] == '') 
	{
		$var = \ratingClass::GetInfoOne ( $data );
	}
	elseif ($_REQUEST ['type'] == '1') 
	{
		$var = \ratingClass::GetJobOne ( $data );
	}
	elseif ($_REQUEST ['type'] == '2') 
	{
		$var = \ratingClass::GetCompanyOne ( $data );
	}
	elseif ($_REQUEST ['type'] == '3') 
	{
		$var = \ratingClass::GetContactOne ( $data );
	}
	elseif ($_REQUEST ['type'] == '4') 
	{
		$lists = \ratingClass::GetFinanceList ( $data );
		$this->assign ( $lists );
	}
	if (!is_array ( $var )) $var = array ();
	$this->assign ( 'var',$var );
	$this->display ( $tpldir .'viewinfo.html',$msg );
}
public function admin() 
{
	check_rank ( "system_users_admin");
	global $tpldir,$_G,$_A,$MsgInfo;
	$msg = '';
	if (!empty ( $_REQUEST ['user_id'] )) 
	{
		if ($_POST ['action'] == 'update') 
		{
			if (!empty ( $_POST ['password'] )) $data ['password'] = I ( 'post.password');
			$data ['user_id'] = I ( 'request.user_id');
			$data ['adminname'] = I ( 'post.adminname');
			$data ['qq'] = I ( 'post.qq');
			$data ['phone'] = I ( 'post.phone');
			$data ['province'] = I ( 'post.province');
			$data ['type_id'] = I ( 'post.type_id');
			$data ['city'] = I ( 'post.city');
			$data ['remark'] = I ( 'post.remark');
			$result = \uadminClass::UpdateUsersAdmin ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["users_admin_update_success"], U ( 'Users/admin') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result], U ( 'Users/admin') );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
			$admin_log ["type"] = "admin";
			$admin_log ["operating"] = "update";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_GET ['action'] == 'del') 
		{
			$data ['user_id'] = I ( 'request.user_id');
			$result = \uadminClass::DeleteUsersAdmin ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["users_admin_del_success"], U ( 'Users/admin') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "users";
			$admin_log ["type"] = " admin";
			$admin_log ["operating"] = 'del';
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$info = '';
			$udata = array ();
			$udata ['user_id'] = I ( 'request.user_id');
			$info = \uadminClass::GetUsersAdminOne ( $udata );
			$this->assign ( 'info',$info );
		}
	}
	if ($msg === '') 
	{
		$data ['page'] = I ( 'get.p');
		$lists = \uadminClass::GetUsersAdminList ( $data );
		$this->assign ( "lists",$lists );
		$Page = new \Think\Page ( $lists ['total'],$lists ['epage'] );
		$show = $Page->show ();
		$this->assign ( 'page',$show );
	}
	$this->display ( $tpldir .'users.admin.html',$msg );
}
public function addadmin() 
{
	check_rank ( "system_users_admin_add");
	global $tpldir,$_G,$_A,$MsgInfo;
	$msg = '';
	if ($_POST ['action'] == 'add_admin') 
	{
		if (empty ( $_POST ['password'] )) 
		{
			$msg = array ( '密码不能为空' );
		}
		else 
		{
			$data ['username'] = I ( 'post.username');
			$data ['adminname'] = I ( 'post.adminname');
			$data ['password'] = I ( 'post.password');
			$data ['qq'] = I ( 'post.qq');
			$data ['phone'] = I ( 'post.phone');
			$data ['type_id'] = I ( 'post.type_id');
			$data ['province'] = I ( 'post.province');
			$data ['city'] = I ( 'post.city');
			$result = \uadminClass::AddAdmin ( $data );
			$msg = array ( $MsgInfo [$result] );
		}
	}
	$this->display ( $tpldir .'addadmin.html',$msg );
}
public function admintype() 
{
	check_rank ( "system_users_admin_type");
	global $tpldir,$_G,$_A,$MsgInfo;
	$msg = '';
	if ($_REQUEST ['action'] == 'edit') 
	{
		$data ['id'] = I ( 'request.id');
		if (IS_POST) 
		{
			$data ['name'] = I ( 'post.name');
			$data ['nid'] = I ( 'post.nid');
			$data ['remark'] = I ( 'post.remark');
			$data ['order'] = I ( 'post.order');
			$data ['module'] = I ( 'post.module');
			$data ['purview'] = I ( 'post.purview');
			$result = \uadminClass::UpdateAdminType ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["users_admin_type_update_success"], );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		else 
		{
			$result = \uadminClass::GetAdminTypeOne ( $data );
			$purview = \adminClass::GetModulePurview ();
			if (is_array ( $result )) 
			{
				$_A ["admin_type_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$this->assign ( 'purview',$purview );
		}
		$this->display ( $tpldir .'edittype.html',$msg );
	}
	elseif ($_REQUEST ['action'] == 'del') 
	{
		$this->display ( $tpldir .'admintype.html',$msg );
	}
	elseif ($_REQUEST ['action'] == 'new') 
	{
		if (IS_POST) 
		{
			$data ['name'] = I ( 'post.name');
			$data ['nid'] = I ( 'post.nid');
			$data ['remark'] = I ( 'post.remark');
			$data ['order'] = I ( 'post.order');
			$data ['module'] = I ( 'post.module');
			$data ['purview'] = I ( 'post.purview');
			$result = \uadminClass::AddAdminType ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["users_admin_type_add_success"], );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		$purview = \adminClass::GetModulePurview ();
		$this->assign ( 'purview',$purview );
		$this->display ( $tpldir .'addtype.html',$msg );
	}
	else 
	{
		$data ['page'] = I ( 'get.p');
		$list = \uadminClass::GetAdminTypeList ( $data );
		$this->assign ( 'list',$list );
		$Page = new \Think\Page ( $list ['total'],$list ['epage'] );
		$show = $Page->show ();
		$this->assign ( 'page',$show );
		$this->display ( $tpldir .'admintype.html',$msg );
	}
}
public function adminlog() 
{
	global $tpldir,$_G,$_A;
	$msg = '';
	$data ['page'] = I ( 'get.p');
	$list = \uadminClass::GetAdminlogList ( $data );
	$this->assign ( 'list',$list );
	$this->display ( $tpldir .'adminlog.html',$msg );
}
}
