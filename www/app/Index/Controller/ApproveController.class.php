<?php

namespace Index\Controller;

class ApproveController extends HomeController {
	public function realname() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		$msg = '';
		if (isset ( $_POST ['realname'] )) {
			$Info = \usersClass::GetUsersInfo ( array (
					"user_id" => $_G ['user_id'] 
			) );
			$account = \accountClass::GetOne ( array (
					"user_id" => $_G ['user_id'] 
			) );
			
			$type = array (
					"image/jpeg",
					"image/gif",
					"image/pjpeg" 
			);
			$type1 = $_FILES ["card_pic1"] ["type"];
			$type2 = $_FILES ["card_pic2"] ["type"];
			$fee = isset ( $_G ['system'] ['con_id5_realname_fee'] ) ? $_G ['system'] ['con_id5_realname_fee'] : 0;
			$times = isset ( $_G ['system'] ['con_id5_realname_times'] ) ? $_G ['system'] ['con_id5_realname_times'] : 0;
			if ($account ['balance'] < $fee && $Info ['realname_times'] > $times && $fee != 0) {
				$msg = array (
						"您的余额不足" . $fee . "元，请先进行充值。" 
				);
			} elseif ((! in_array ( $type1, $type ) && $type1 != '') || (! in_array ( $type2, $type ) && $type2 != '')) {
				$msg = array (
						"上传图片的格式应为jpg.gif" 
				);
			} elseif ($_FILES ["card_pic1"] ["size"] > 62491456 || $_FILES ["card_pic2"] ["size"] > 524288) {
				$msg = array (
						"图片大小不能超过6M" 
				);
			} else {
				$data = I ( 'post.' );
				$data ['user_id'] = $_G ['user_id'];
				$data ['status'] = 0;
				$datapic ['file'] = "card_pic1";
				$datapic ['code'] = "approve";
				$datapic ['user_id'] = $_G ["user_id"];
				$datapic ['type'] = "realname";
				$datapic ['article_id'] = $_G ["user_id"];
				$pic_result = $this->upfiles ( 'card_pic1', 'approve', $datapic );
				if ($pic_result != false) {
					$data ["card_pic1"] = $pic_result ["upfiles_id"];
				}
				
				$datapic ['file'] = "card_pic2";
				$pic_result = $this->upfiles ( 'card_pic2', 'approve', $datapic );
				if ($pic_result != false) {
					$data ["card_pic2"] = $pic_result ["upfiles_id"];
				}
				if ($msg == "") {
					$result = \approveClass::UpdateRealname ( $data );
					if ($result > 0) {
						if ($Info ['realname_times'] > $times && $fee != 0) {
							$log_info ["user_id"] = $data ['user_id']; // 操作用户id
							$log_info ["nid"] = "realname_fee_" . $data ['user_id'] . time (); // 订单号
							$log_info ["money"] = $fee; // 操作金额
							$log_info ["income"] = 0; // 收入
							$log_info ["expend"] = $log_info ["money"]; // 支出
							$log_info ["balance_cash"] = - $log_info ["money"]; // 可提现金额
							$log_info ["balance_frost"] = 0; // 不可提现金额
							$log_info ["frost"] = 0; // 冻结金额
							$log_info ["await"] = 0; // 待收金额
							$log_info ["type"] = "realname_fee"; // 类型
							$log_info ["to_userid"] = $data ['user_id']; // 付给谁
							$log_info ["remark"] = "实名认证超过{$times}次，收费{$fee}元";
							$result = \accountClass::AddLog ( $log_info );
						}
						\usersClass::UpdateUsersInfo ( array (
								"user_id" => $data ['user_id'],
								"realname_times" => $Info ['realname_times'] + 1 
						) );
						$msg = array (
								"姓名认证添加成功，请等待管理员审核",
								U ( 'Users/index' ) 
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
				}
			}
		} else {
			$Rvar = \approveClass::GetRealnameOne ( array (
					'user_id' => $_G ['user_id'] 
			) );
			$account = \accountClass::GetOne ( array (
					'user_id' => $_G ['user_id'] 
			) );
			$this->assign ( 'Rvar', $Rvar );
			$this->assign ( 'account', $account );
		}
		
		$this->display ( $tpldir . 'realname.html', $msg );
	}
	public function phone_status() {
		global $_G, $tpldir, $_U, $MsgInfo;
		$smst = include ROOT_PATH . "modules/sms.tempatle.php";
		if (isset ( $_POST ['sms_code'] )) {
			$data ['code'] = I ( 'post.sms_code' );
			if(isset($_REQUEST['phone_old']))
				$data['phone_old']= I( 'post.phone_old' );
			$data ['phone'] = I ( 'post.phone_new' );
			$data ['type'] = "smscode";
			$data ['user_id'] = $_G ['user_id'];
			$result = \approveClass::CheckSmsCode ( $data );
			if (IS_AJAX) {
				if ($_POST ['realname']) {
					if ($result > 0) {
						M ( 'users_info' )->where ( "`user_id` = {$data['user_id']}" )->setField ( 'tender_status', 1 );
						$msg = array (
								"认证成功",
								U ( 'Users/index' ) 
						);
						return $_G ['real_name'] = $realname;
					} elseif ($MsgInfo [$result] != "") {
						$msg = array (
								$MsgInfo [$result] 
						)
						;
					} else {
						$msg = array (
								"验证码错误" 
						)
						;
					}
				} else {
					if ($result > 0) {
						M ( 'users_info' )->where ( "`user_id` = {$data['user_id']}" )->setField ( 'tender_status', 1 );
						$msg = array (
								"认证成功" 
						)
						;
					} elseif ($MsgInfo [$result] != "") {
						$msg = array (
								$MsgInfo [$result] 
						)
						;
					} else {
						$msg = array (
								"验证码错误" 
						)
						;
					}
				}
				echo $msg [0];
				exit ();
			} else {
				
				if ($_POST ['realname']) {
					if ($result > 0) {
						M ( 'users_info' )->where ( "`user_id` = {$data['user_id']}" )->setField ( 'tender_status', 1 );
						
						$msg = array (
								"认证成功" 
						)
						;
					} elseif ($MsgInfo [$result] != "") {
						$msg = array (
								$MsgInfo [$result] 
						)
						;
					} else {
						$msg = array (
								"验证码错误" 
						)
						;
					}
				} else {
					if ($result > 0) {
						M ( 'users_info' )->where ( "`user_id` = {$data['user_id']}" )->setField ( 'tender_status', 1 );
						
						$msg = array (
								"认证成功",
								U ( 'Users/index' )
						);
					} elseif ($MsgInfo [$result] != "") {
						$msg = array (
								$MsgInfo [$result] 
						)
						;
					} else {
						$msg = array (
								"验证码错误" 
						);
					}
				}
			}
		} elseif (isset ( $_REQUEST ['phone'] )) {
			
			if ($_SESSION ['smscode_time'] + 60 > time () && $_SESSION ['smscode_phone'] == $_POST ['phone']) {
				$msg = array (
						"请过1分钟后再申请" 
				);
			} else {
				if(isset($_POST ['phone'])&&$_POST ['phone']!=''){
				$data ['phone'] = I ( 'request.phone' );
				$data ['user_id'] = $_G ['user_id'];
				$result = \approveClass::AddSms ( $data );
				if ($result > 0) {
					if ($smst ['isauto'] == 1) {
						$content = $smst ['data'] ['mobileauthen'] ['content'] . $_G ['system.'] ['con_webname'];
					} else {
						$content = $smst ['data'] ['mobileauthen'] ['content'];
					}
					$data ['user_id'] = $_G ['user_id'];
					$data ['type'] = "smscode";
					$data ['code'] = rand ( 100000, 999999 );
					$data ['contents'] = str_replace ( '##code##', $data ['code'], $content );
					
					$result = \approveClass::SendSMS ( $data );
					$_SESSION ['smscode_time'] = time ();
					$_SESSION ['smscode_othertime'] = $_SESSION ['smscode_time'] - time ();
					$_SESSION ['smscode_phone'] = $data ['phone'];
					if ($_REQUEST ['style'] == "ajax") {
						$msg = array (
								1 
						);
					}
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}}
			}
			if ($_REQUEST ['style'] == "ajax") {
				echo $msg [0];
				exit ();
			}
		} elseif ( IS_AJAX) {
			if(isset ( $_REQUEST ['new_phone'])){
			if ($_SESSION ['smscode_time'] + 60 > time () && $_SESSION ['smscode_phone'] == $_G ['user_info'] ['phone']) {
				$msg = array (
						"请过1分钟后再申请" 
				);
			} else {
				$data ['phone'] = I ( 'request.new_phone' );
				$data ['user_id'] = $_G ['user_id'];
				$result = \approveClass::AddSms ( $data );
				if ($result > 0) {
					if ($smst ['isauto'] == 1) {
						$content = $smst ['data'] ['newmobile'] ['content'] . $_G ['system.'] ['con_webname'];
					} else {
						$content = $smst ['data'] ['newmobile'] ['content'];
					}
					
					$data ['user_id'] = $_G ['user_id'];
					$data ['type'] = "smscode";
					$data ['code'] = rand ( 100000, 999999 );
					$data ['contents'] = str_replace ( '##code##', $data ['code'], $content );
					$data ['phone'] = $_G ['user_info'] ['phone'];
					$result = \approveClass::SendSMS ( $data );
					$_SESSION ['smscode_time'] = time ();
					$_SESSION ['smscode_othertime'] = $_SESSION ['smscode_time'] - time ();
					$_SESSION ['smscode_phone'] = $data ['phone'];
					$msg = array (1);
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}
			}
			
			echo $msg [0];
			exit ();
			}
		} elseif ($_REQUEST ['style'] == "cancel") {
			if ($_SESSION ['smscancel_time'] + 60 * 2 > time ()) {
			} else {
				if ($smst ['isauto'] == 1) {
					$content = $smst ['data'] ['mobileauthen'] ['content'] . $_G ['system.'] ['con_webname'];
				} else {
					$content = $smst ['data'] ['mobileauthen'] ['content'];
				}
				$data ['user_id'] = $_G ['user_id'];
				$data ['type'] = "smscancel";
				$data ['code'] = rand ( 100000, 999999 );
				$data ['contents'] = str_replace ( '##code##', $data ['code'], $content );
				$result = \approveClass::SendSMS ( $data );
				$_SESSION ['smscancel_time'] = time ();
			}
		} else {
			$data ['user_id'] = $_G ['user_id'];
			$_U ['phone_result'] = \approveClass::GetSmsOne ( $data );
		}
		$this->display ( $tpldir . 'phone_status.html', $msg );
	}
	public function phone_yz(){
		global $_G, $tpldir, $_U, $MsgInfo;
		$smst = include ROOT_PATH . "modules/sms.tempatle.php";
		if ($_SESSION['smscode_time']+60>time() && $_SESSION['smscode_phone']==$_POST['phone'])
		{
			$msg = array("请过1分钟后再申请");
		}else{
			if($smst['isauto']==1){
				$content=$smst['data']['withdraw']['content'].$_G['system.']['con_webname'];
			}
			else {
				$content=$smst['data']['withdraw']['content'];
			}
		
			$data['user_id'] = $_G['user_id'];
			if(isset($_REQUEST['type']))
			$data['type'] = I('request.type');
			$data['code'] = rand(100000,999999);
			$data['contents'] =str_replace('##code##',$data['code'],$content);
			$result = \approveClass::SendSMS($data);
			$_SESSION['smscode_time'] = time();
			$_SESSION['smscode_othertime'] = $_SESSION['smscode_time']-time();
			$_SESSION['smscode_phone'] =$_POST['phone'];
			if ($result>0){
				$msg = array(1);
			}else{
				$msg = array('验证短信发送失败，请联系客服！');
			}
				
		}
		if ($_REQUEST['style']=="ajax"){
			echo $msg[0];
			exit;
		}
	}
	public function video_status() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		if(isset($_POST['submit'])){
			$data['status'] = 0;
			$data['user_id'] = $_G['user_id'];
			$result = \approveClass::UpdateVideo($data);
			if ($result==true){
				$msg = array("提交申请成功");
			}else{
				$msg = array($reuslt);
			}
		}else{
			$data['user_id'] = $_G['user_id'];
			$_U['video_result'] = \approveClass::GetVideoOne($data);
		}
		$this->display ( $tpldir . 'video.html', $msg );
	}
	public function flow_status() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		if (isset($_POST['submit']) && $_POST['submit']!="" ){
				
			$data['user_id'] = $_G['user_id'];
			$data['status'] = 0;
				
			$result = \approveClass::UpdateFlow($data);
			if ($result == false){
				$msg = array($result);
			}else{
				$msg = array("申请流转认证操作成功，请等待客服人员与你联系");
			}
		}else{
			$data['user_id'] = $_G['user_id'];
			$_U['flow_result'] = \approveClass::GetFlowOne($data);
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_approve.html', $msg ,'user_header.html' );
	}
	public function email_status() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		$_U['site_name'] = "邮箱认证";
		if (isset($_POST['email']) && $_POST['email']!="" ){
			$data['user_id'] = $_G['user_id'];
			$data['email'] = I('post.email');
		
			$result = \usersClass::CheckEmail($data);
		
			if ($result==false){
		        if($_POST['email']==$_G ["user_result"]["email"])
		        {
		        	$result = M ( 'users_email_active' )->where ( "user_id={$data['user_id']} and email='{$data['email']}'" )->find ();
		           if($result['status']==0||$result==NULL) $result=1;
		        }
		        else{
				$result = \usersClass::UpdateEmail($data);
		        }
					
				if ($result != 1){
					$msg = array($MsgInfo[$result]);
				}else{
					$data['username'] = $_G['user_result']['username'];
					$data['webname'] = $_G['system']['con_webname'];
					$data['title'] = "注册邮件确认";
					$data['msg'] = RegEmailMsg($data);
					$data['type'] = "reg";
					if (isset($_SESSION['sendemail_time']) && $_SESSION['sendemail_time']+60*2>time()){
						$msg = array("请2分钟后再次请求。");
					}else{
						$result = \usersClass::SendEmail($data);
						if ($result==true) {
							$_SESSION['sendemail_time'] = time();
							$msg = array("激活信息已经发送到您的邮箱，请注意查收。");
						}
						else{
							$msg = array("发送失败，请跟管理员联系。");
						}
					}
				}
			}else{
				$msg = array("你重新填写的邮箱已经存在");
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_approve.html', $msg ,'user_header.html' );
	}
	public function recommend() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		if (IS_POST) {
			$datainfo = array ();
			$datainfo ['invite_status'] = 2;
			$datainfo ['user_id'] = $_G ['user_id'];
			\usersClass::UpdateUsersInfo ( $datainfo );
			$data = array ();
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 0;
			
			$result = \approveClass::UpdateInvite ( $data );
			if ($result == false) {
				$msg = array (
						$result 
				);
			} else {
				$msg = array (
						"推荐资格申请操作成功，请等待客服人员审核",
						U ( 'approve/recommend' ) 
				);
			}
		} else {
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'recommend.html', $msg, 'user_header.html' );
	}
	public function myapp() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_G ['user_id'] == ''||$_G ['user_id'] ==null) {
			if (ACTION_NAME != 'verify' && ACTION_NAME != 'login') {
				redirect ( U ( 'index/login' ), 0, '请登录' );
				exit ();
			}
		}
		$amount = \borrowClass::GetAmountUsers ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$credit = \creditClass::GetCreditCount ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$attestations = \attestationsClass::GetAttestationsUserCredit ( array (
				'user_id' => $_G ['user_id'] 
		) );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( 'amount', $amount );
		$this->assign ( 'credit', $credit );
		$this->assign ( 'attestations', $attestations );
		$this->display ( $tpldir . 'approve_myapp.html', $msg, 'user_header.html' );
	}
}