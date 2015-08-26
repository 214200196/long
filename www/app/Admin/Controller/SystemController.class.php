<?php

namespace Admin\Controller;

class SystemController extends AdminController {
	public function password() {
		global $tpldir, $_G, $_A, $MsgInfo;
		require_once ROOT_PATH . 'modules/users.model.php';
		$msg = '';
		if (IS_POST) {
			$data ['user_id'] = $_POST ['user_id'];
			
			if ($_POST ['adminpassword'] != "" && $_POST ['adminpassword'] != $_POST ['adminpassword1']) {
				$msg = array (
						$MsgInfo ['users_password_error'] 
				);
			} else {
				if ($_POST ['adminpassword'] != "") {
					$data ['password'] = I ( 'post.adminpassword' );
				}
				$data ['adminname'] = $_POST ['adminname'];
				$data ['qq'] = $_POST ['qq'];
				$data ['province'] = $_POST ['province'];
				$data ['city'] = $_POST ['city'];
				$result = \uadminClass::UpdateUsersAdmin ( $data );
				if ($result > 0) {
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}
			}
			
			if ($msg == "") {
				$msg = array (
						"操作成功" 
				);
			}
		}
		$this->display ( $tpldir . 'password.html', $msg );
	}
	public function info() {
		check_rank ( "system_info" );
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		if (IS_POST) {
			if (isset ( $_REQUEST ['type_id'] )) {
				$pos = I ( 'post.' );
				foreach ( $pos ['name'] as $key => $val ) {
					$data = array ();
					$data ['name'] = $val;
					$data ['value'] = $pos ['value'] [$key];
					M ( 'system' )->where ( "nid='{$key}'" )->setField ( $data );
				}
				if ($msg == '')
					$msg = array (
							'操作成功' 
					);
			} else {
				$pos = I ( 'post.' );
				foreach ( $pos as $key => $val ) {
					if($key=='pic') continue;
					M ( 'system' )->where ( "nid='{$key}'" )->setField ( 'value', $val );
				}
				if (! empty ( $_FILES ['pic'] ['name'] )) {
				$pic_result = $this->uploads('pic', 'logo');
				if (is_array($pic_result)){
					$logo = $pic_result ['savepath'] . $pic_result['savename'];
					M ( 'system' )->where ( "nid='con_logo'" )->setField ( 'value', $logo);
					
				}
				}
				if ($msg == '')
					$msg = array (
							'操作成功' 
					);
			}
		}
		$tlists = \adminClass::GetSystemTypeList ();
		$this->assign ( $tlists );
		$this->display ( $tpldir . 'sysinfo.html', $msg );
	}
	public function infotype() {
		check_rank ( "system_info" );
	}
	public function email() {
		check_rank ( "system_email" );
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		$data ['code'] = "email";
		if (isset ( $_POST ['con_email_host'] )) {
			$data = I ( 'post.' );
			$data ['code'] = "email";
			$result = \adminClass::UpdateSystem ( $data );
			if ($_POST ['con_email_check'] == 1) {
				// 如果注册成功，则发送邮箱进行确认
				$email_info ['email_info'] = $data;
				$email_info ['user_id'] = 0;
				$email_info ['port'] = $data ['con_email_port'];
				$email_info ['send_email'] = $data ['con_email_url'];
				$email_info ['email'] = $data ['con_email_url'];
				$email_info ['title'] = "邮箱设置确认";
				$email_info ['msg'] = "如果你收到了此邮件，说明您的邮箱已经设置成功";
				$email_info ['type'] = "set";
				$result = \usersClass::SendEmail ( $email_info );
			} else {
				$result = true;
			}
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "system";
			$admin_log ["type"] = "email";
			$admin_log ["operating"] = "set";
			$admin_log ["article_id"] = 0;
			$admin_log ["result"] = $result;
			
			if ($result == true) {
				if ($_POST ['con_email_check'] == 1) {
					$msg = array (
							$MsgInfo ["admin_email_success_check"] 
					);
				} else {
					$msg = array (
							$MsgInfo ["admin_email_success"] 
					);
				}
			} else {
				$msg = array (
						$MsgInfo ["admin_email_false"] 
				);
			}
			
			$admin_log ["content"] = $msg [0];
			\uadminClass::AddAdminLog ( $admin_log );
		} else {
			$result = \adminClass::GetSystem ( $data );
			$_A ["system_result"] = $result;
		}
		$this->display ( $tpldir . 'admin_email.html', $msg );
	}
	public function emaillog() {
		check_rank ( "system_email" );
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		if ($_REQUEST ['id'] != "") {
			$result = \usersClass::GetUsersEmailLog ( array (
					"id" => $_REQUEST ['id'] 
			) );
			echo $result ['msg'];
			exit ();
		}
		$data ['page'] = I ( 'get.p' );
		$data ['username'] = I ( 'request.username' );
		$data ['email'] = I ( 'request.email' );
		$lists = \usersClass::GetEmailLogList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'emaillog.html', $msg );
	}
	public function emailactive() {
		check_rank ( "system_email" );
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		$data ['page'] = I ( 'get.p' );
		$data ['username'] = I ( 'request.username' );
		$data ['email'] = I ( 'request.email' );
		$lists = \usersClass::GetEmailActiveList ($data);
		$this->assign($lists);
		$this->display ( $tpldir . 'emailactive.html', $msg );
	}
	public function phone() {
		check_rank ( "system_phone" );
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		if (isset ( $_POST ["con_phone_check"] )) {
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "system";
			$admin_log ["type"] = "phone";
			$admin_log ["operating"] = 'edit';
			
			$data ['con_phone_user'] = I ( 'post.con_phone_user' );
			$data ['con_phone_userpwd'] = I ( 'post.con_phone_userpwd' );
			$data ['code'] = 'phone';
			$result = \adminClass::UpdateSystem ( $data );
			$msg = array (
					$MsgInfo ["admin_info_success"] 
			);
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
			if ($_POST ["con_phone_check"] == 1) {
				$data = array ();
				$data ["user_id"] = 0;
				$data ["phone"] = I ( 'post.con_phone_checkphone' );
				$data ["type"] = "smsset";
				$data ['code'] = '';
				$data ['contents'] = "收到是短信说明网站短信功能已经开通";
				\approveClass::SendSMS ( $data );
			}
		}
		$this->display ( $tpldir . 'phone.html', $msg );
	}
	public function id5() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg = '';
		check_rank ( "system_id5" ); // 检查权限
		if (isset ( $_POST ['con_id5_status'] )) {
			$data ['con_id5_status'] = I ( 'post.con_id5_status' );
			$data ['con_id5_username'] = I ( 'post.con_id5_username' );
			$data ['con_id5_password'] = I ( 'post.con_id5_password' );
			$data ['con_id5_fee'] = I ( 'post.con_id5_fee' );
			$data ['con_id5_realname_status'] = I ( 'post.con_id5_realname_status' );
			$data ['con_id5_realname_fee'] = I ( 'post.con_id5_realname_fee' );
			$data ['con_id5_realname_times'] = I ( 'post.con_id5_realname_times' );
			$data ['con_id5_edu_status'] = I ( 'post.con_id5_edu_status' );
			$data ['con_id5_edu_fee'] = I ( 'post.con_id5_edu_fee' );
			$data ['con_id5_edu_times'] = I ( 'post.con_id5_edu_times' );
			$data ['code'] = "id5";
			$result = \adminClass::UpdateSystem ( $data );
			$msg = array (
					$MsgInfo ["admin_info_success"] 
			);
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "system";
			$admin_log ["type"] = "id5";
			$admin_log ["operating"] = "set";
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$this->display ( $tpldir . 'adminid5.html', $msg );
	}
	public function clearcache() {
		global $tpldir, $_G, $_A, $MsgInfo;
		check_rank ( "system_clearcache" ); // 检查权限
		$dirs = array (
				'./data/runtime/' 
		);
		@mkdir ( 'runtime', 0777, true );
		// 清理缓存
		foreach ( $dirs as $value ) {
			$this->rmdirr ( $value );
		}
		
		$msg = array (
				$MsgInfo ["admin_clearcache_success"] 
		);
		$this->display ( $tpldir . 'adminid5.html', $msg );
	}
	private function rmdirr($dirname) {
		if (! file_exists ( $dirname )) {
			return false;
		}
		if (is_file ( $dirname ) || is_link ( $dirname )) {
			return unlink ( $dirname );
		}
		$dir = dir ( $dirname );
		if ($dir) {
			while ( false !== $entry = $dir->read () ) {
				if ($entry == '.' || $entry == '..') {
					continue;
				}
				// 递归
				$this->rmdirr ( $dirname . DIRECTORY_SEPARATOR . $entry );
			}
		}
		$dir->close ();
		return rmdir ( $dirname );
	}
	public function site() {
		global $tpldir, $_G, $_A, $MsgInfo;
		check_rank ( "site_list" ); // 检查权限
		
		if ($_POST ['id'] != "") {
			$data ['id'] = I ( 'post.id' );
			$data ['order'] = ('post.order');
			
			$result = \adminClass::ActionSite ( $data );
			$msg = array (
					"操作成功" 
			);
		} else {
			$menu = \adminClass::GetSiteMenuList ( array (
					'limit' => 'all' 
			) );
			if (isset ( $_REQUEST ['menu_id'] ))
				$data ['menu_id'] = I ( 'request.menu_id' );
			$data ['limit'] = 'all';
			$list = \adminClass::GetSite ( $data );
			$this->assign ( 'list', $list );
			$this->assign ( 'menu', $menu );
		}
		$this->display ( $tpldir . 'site.html', $msg );
	}
	public function sitenew() {
		global $tpldir, $_G, $_A, $MsgInfo;
		check_rank ( "site_new" ); // 检查权限
		if (isset ( $_POST ['name'] ) && $_POST ['name'] != "") {
			
			$var = array (
					"name",
					"status",
					"nid",
					"pid",
					"remark",
					"value",
					"type",
					"menu_id",
					"order",
					"index_tpl",
					"list_tpl",
					"content_tpl",
					"keywords",
					"description" 
			);
			$data = post_var ( $var );
			if ($_POST ['id'] != "") {
				$data ['id'] = $_POST ['id'];
				$result = \adminClass::UpdateSite ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["admin_site_update_success"],
				
					);
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}
				$admin_log ["operating"] = "update";
			} else {
				$result = \adminClass::AddSite ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["admin_site_add_success"],
							
					);
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}
				$admin_log ["operating"] = "add";
			}
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "admin";
			$admin_log ["type"] = "site";
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		} elseif (isset ( $_REQUEST ['edit'] ) && $_REQUEST ['edit'] != "") {
			$data ['id'] = $_REQUEST ['edit'];
			$result = \adminClass::GetSiteOne ( $data );
			if (! is_array ( $result )) {
				$msg = array (
						$MsgInfo [$result] 
				);
			} else {
				$_A ['site_result'] = $result;
			}
		} elseif (isset ( $_REQUEST ['del'] ) && $_REQUEST ['del'] != "") {
			$data ['id'] = $_REQUEST ['del'];
			$result = \adminClass::DelSite ( $data );
			if ($result > 0) {
				$msg = array (
						$MsgInfo ["admin_site_del_success"] 
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
			
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "admin";
			$admin_log ["type"] = "site";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		
		$Menu = \adminClass::GetSiteMenuList ( array (
				'limit' => 'all' 
		) );
		$PageMenu=\articlesClass::GetPageMenu();
		$this->assign('PageMenu',$PageMenu);
		$TypeMenu = \articlesClass::GetTypeMenu ();
		$this->assign ( 'TypeMenu', $TypeMenu );
		$data = array ();
		if (isset ( $_REQUEST ['menu_id'] ))
			$data ['menu_id'] = I ( 'request.menu_id' );
		if (isset ( $_A ['site_result'] ['id'] ))
			$data ['lgnore'] = $_A ['site_result'] ['id'];
		$sites = \adminClass::GetSite ( $data );
		$this->assign ( 'sites', $sites );
		$this->assign ( 'Menu', $Menu );
		
		$this->display ( $tpldir . 'site.html', $msg );
	}
	public function sitemenu() {
		global $tpldir, $_G, $_A, $MsgInfo;
		check_rank ( "site_menu" ); // 检查权限
		if (isset ( $_POST ['name'] )) {
			if (!check_verify ( I ( 'post.valicode' ) )) {
				$msg=array('验证码错误');
			}
			if ($msg == "") {
				$var = array (
						"name",
						"nid",
						"order",
						"checked",
						"contents" 
				);
				$data = post_var ( $var );
				if ($_POST ['id'] != "") {
					$data ['id'] = $_POST ['id'];
					$result =\adminClass::UpdateSiteMenu ( $data );
					if ($result > 0) {
						$msg = array (
								$MsgInfo ["admin_site_menu_update_success"],
				
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
					$admin_log ["operating"] = "update";
				} else {
					$result = \adminClass::AddSiteMenu ( $data );
					if ($result > 0) {
						$msg = array (
								$MsgInfo ["admin_site_menu_add_success"],
								
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
					$admin_log ["operating"] = "add";
				}
				// 加入管理员操作记录
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "admin";
				$admin_log ["type"] = "site_menu";
				$admin_log ["article_id"] = $result > 0 ? $result : 0;
				$admin_log ["result"] = $result > 0 ? 1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		} elseif ($_REQUEST ['edit'] != "") {
			$data ['id'] = $_REQUEST ['edit'];
			$result = \adminClass::GetSiteMenuOne ( $data );
			if (is_array ( $result )) {
				$_A ["site_menu_result"] = $result;
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
		} elseif ($_REQUEST ['checked'] != "") {
			$data ['id'] = $_REQUEST ['checked'];
			$result = \adminClass::UpdateSiteMenuChecked ( $data );
		} elseif ($_REQUEST ['del'] != "") {
			$data ['id'] = $_REQUEST ['del'];
			$result = \adminClass::DelSiteMenu ( $data );
			if ($result > 0) {
				$msg = array (
						$MsgInfo ["admin_site_menu_del_success"],
						
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
			
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "admin";
			$admin_log ["type"] = "site_menu";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else{
		  $list=\adminClass::GetSiteMenuList(array('limit'=>'all'));
		  $this->assign('list',$list);
		}
		$this->display ( $tpldir . 'site.html', $msg );
	}
}