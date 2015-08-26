<?php

namespace Index\Controller;

class BorrowController extends HomeController {
	public function index() {
		global $_G, $tpldir, $_U;
		$this->display ( $tpldir . 'borrow.html' );
	}
	public function borrow_list() {
		global $_G, $tpldir, $_U;
		$ldata ['late_day'] = 30;
		$ldata ['username'] = $_G ['user_result'] ['username'];
		$llist = \borrowClass::GetLateList ( $ldata );
		$this->assign ( 'llist', $llist );
		$adata ['user_id'] = $_G ['user_id'];
		$user_att = \attestationsClass::GetAttestationsUserCredit ( $adata );
		$this->assign ( 'user_att', $user_att );
		
		$user_amount = \borrowClass::GetAmountUsers ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$this->assign ( 'user_amount', $user_amount );
		
		$Cvar = \borrowClass::GetBorrowCredit ( array (
				'user_id' => $_G ['user_id'] 
		) );
		
		$Vvar = \usersClass::GetUsersVip ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$Uvar = \usersClass::GetUsers ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$jinMoney = \accountClass::GetOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$rCompany = \ratingClass::GetCompanyOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$rInfo = \ratingClass::GetInfoOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$this->assign ( 'rInfo', $rInfo );
		$this->assign ( 'rCompany', $rCompany );
		$this->assign ( 'Vvar', $Vvar );
		$this->assign ( 'Cvar', $Cvar );
		$this->assign ( 'Uvar', $Uvar );
		$this->assign ( 'jinMoney', $jinMoney );
		$this->display ( $tpldir . 'borrow_list.html' );
	}
	public function add_care(){
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data['user_id'] = $_G['user_id'];
		$data["article_id"] =I('request.article_id');
		$data["code"] = I('request.code');
		$result = \usersClass::AddCare($data);
		if ($result == -2){
			$msg = array("你已经关注了此标，不能重复操作");
		}elseif ($result==-1){
			$msg = array("你的操作有误，请不要乱操作");
		}else{
			$msg = array("加入关注成功");
		
		}
		$this->display ( $tpldir . 'borrow_list.html', $msg );
	}
	public function borrowadd() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		if (IS_POST) {
			if (check_verify ( I ( 'post.valicode' ) )) {
				if (! isset ( $_POST ['name'] )) {
					$msg = array (
							$MsgInfo ["borrow_name_empty"] 
					);
				} elseif (! isset ( $_POST ['borrow_apr'] ) && intval ( $_POST ['borrow_apr'] ) == 0) {
					$msg = array (
							'借款利率必须大于0' 
					);
				} elseif ($_POST ['borrow_style'] == 1 && $_POST ['borrow_period'] % 3 != 0) {
					$msg = array (
							$MsgInfo ["borrow_period_season_error"] 
					);
				} elseif ($_POST ['borrow_type'] == 4 && $_POST ['borrow_style'] != 2) {
					$msg = array (
							"流转标的还款方式必须到期还本还息" 
					);
				} elseif ($_POST ['borrow_period'] < 1 && $_POST ['borrow_style'] != 2) {
					$msg = array (
							"天标的还款方式必须到期还本还息" 
					);
				} elseif ($_POST ['borrow_period'] > 1 && $_POST ['borrow_style'] == 2) {
					$msg = array (
							"除天标外其它标种不允许到期还本还息" 
					);
				} elseif ($_POST ['borrow_type'] == 4 && $_POST ['is_Seconds'] == 1) {
					$msg = array (
							"流转标不能是秒标" 
					);
				} elseif ($_POST ['isDXB'] == 1 && $_POST ['pwd'] == '') {
					$msg = array (
							"你选择了定向标，请填写定向标密码！" 
					);
				} else {
					$data ['user_id'] = $_G ['user_id'];
					$data ['name'] = I ( 'post.name' );
					$data ['borrow_use'] = I ( 'post.borrow_use' );
					$data ['borrow_use'] = I ( 'post.borrow_use' );
					$data ['borrow_period'] = I ( 'post.borrow_period' );
					$data ['borrow_style'] = I ( 'post.borrow_style' );
					$data ['account'] = I ( 'post.account' );
					$data ['borrow_apr'] = I ( 'post.borrow_apr' );
					$data ['borrow_contents'] = I ( 'post.borrow_contents' );
					$data ['is_Seconds'] = I ( 'post.is_Seconds' );
					$data ['Second_limit_money'] = I ( 'post.second_limit_money' );
					$data ['isDXB'] = I ( 'post.isDXB' );
					$data ['pwd'] = I ( 'post.pwd' );
					$data ['borrow_valid_time'] = I ( 'post.borrow_valid_time' );
					$data ['award_status'] = I ( 'post.award_status' );
					$data ['award_scale'] = I ( 'post.award_scale' );
					$data ['award_account'] = I ( 'post.award_account' );
					$data ['borrow_account_wait'] = $data ['account'];
					$data ['vouch_account'] = $data ['account'];
					$data ['vouch_account_wait'] = $data ['account'];
					if ($data ['isDXB'] == '') {
						$data ['isDXB'] = 0;
					}
					$data ["borrow_nid"] = $_G ['user_id'] . time ();
					$data ['status'] = 0;
					if ($_POST ['borrow_type'] == 2) {
						$data ['borrow_type'] = "vouch";
						$data ['vouchstatus'] = 1;
					} elseif ($_POST ['borrow_type'] == 3) {
						$data ['borrow_type'] = "fast";
						$data ['fast_status'] = 1;
					} elseif ($_POST ['borrow_type'] == 4) {
						$data ['borrow_type'] = "flow";
						$data ['is_flow'] = 1;
					} elseif ($_POST ['borrow_type'] == 5) {
						$data ['borrow_type'] = "jin";
						$data ['is_jin'] = 1;
					} else {
						$data ['borrow_type'] = "credit";
					}
					if ($data ['is_flow'] == '') {
						$data ['is_flow'] = 0;
					}
					
					if ($data ["award_status"] == 0) {
						$data ["award_false"] = 0;
					}
					$data['nikename']=$_G['user_info']['niname'];
					if (isset ( $_POST ['type'] ) && $_POST ['type'] == "tiyan") {
						$data ['borrow_style'] = 5;
						$data ['borrow_apr'] = 20;
						$result = \borrowClass::AddBorrowTiyan ( $data );
					} elseif (isset ( $_POST ['type'] ) && $_POST ['type'] == "vouch") {
						$result = \borrowClass::AddBorrowVouch ( $data );
					} else {
						
						$result = \borrowClass::Add ( $data );
					}
					if ($result > 0) {
						$msg = array (
								$MsgInfo ["borrow_success_msg"] 
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
				}
			} else {
				$msg = array (
						'验证码错误' 
				);
			}
		}
		$this->display ( $tpldir . 'borrow_list.html', $msg );
	}
	public function amount() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		$_amount = \borrowClass::GetAmountUsers ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$var = \borrowClass::GetAmountApplyOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		if (IS_POST) {
			if ($_POST ['amount_account'] > 0) {
				$data ['user_id'] = $_G ['user_id'];
				$data ['amount_account'] = I ( 'post.amount_account' );
				$data ['content'] = I ( 'post.content' );
				$data ['amount_type'] = I ( 'post.amount_type' );
				$data ['remark'] = I ( 'post.remark' );
				$result = \borrowClass::GetAmountApplyOne ( $data );
				if ($result != false && $result ['addtime'] + 60 * 60 * 24 * 30 > time () && $result ['status'] == 0) {
					$msg = array (
							"您已经提交了申请，请等待审核" 
					);
				} elseif ($result != false && $result ['verify_time'] + 60 * 60 * 24 * 30 > time ()) {
					$msg = array (
							"请一个月后再申请" 
					);
				} else {
					$data ['status'] = 0;
					$data ['oprate'] = "add";
					$result = \borrowClass::AddAmountApply ( $data );
					if ($result > 0) {
						$msg = array (
								"申请成功，请等待管理员审核" 
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
				}
			} else {
				$msg = array (
						'请输入正确金额' 
				);
			}
		} else {
			define ( 'THEME_PATH', $tpldir );
			layout ( 'user_main' );
			$this->assign ( '_amount', $_amount );
			$this->assign ( 'svar', $var );
		}
		$this->display ( $tpldir . 'amount.html', $msg, 'user_header.html' );
	}
	public function amountlist() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		$data ['user_id'] = $_G ['user_id'];
		$data ['page'] = I ( 'get.p' );
		$lists = \borrowClass::GetAmountApplyList ( $data );
		$this->assign ( $lists );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'amountlist.html', $msg, 'user_header.html' );
	}
	public function amountlog() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		$data ['user_id'] = $_G ['user_id'];
		$data ['page'] = I ( 'get.p' );
		$_amount = \borrowClass::GetAmountUsers ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$lists = \borrowClass::GetAmountLogList ( $data );
		$this->assign ( $lists );
		$this->assign ( '_amount', $_amount );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'amountlog.html', $msg, 'user_header.html' );
	}
	public function gettender() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['tender_status'] = 0;
		$data ['borrow_status'] = 1;
		$lists = \borrowClass::GetTenderBorrowList ( $data );
		$this->assign ( $lists );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'gettender.html', $msg, 'user_header.html' );
	}
	public function success() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$msg = '';
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['tender_status'] = 1;
		$lists = \borrowClass::GetTenderBorrowList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'success.html', $msg, 'user_header.html' );
	}
	public function gathering() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['borrow_status'] = 3;
		$data ['order'] = 'repay_time';
		$lists = \borrowClass::GetRecoverList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'gathering.html', $msg, 'user_header.html' );
	}
	public function before() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['borrow_status'] = 3;
		$data ['change'] = 1;
		$data ['style'] = 'change';
		$lists = \borrowClass::GetRecoverList ( $data );
		
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'before.html', $msg, 'user_header.html' );
	}
	public function lenddetail() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['status'] = 1;
		$lists = \borrowClass::GetTenderList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'lenddetail.html', $msg, 'user_header.html' );
	}
	public function care() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		$lists = \usersClass::GetCareList ( $data );
		$this->assign ( $lists );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'care.html', $msg, 'user_header.html' );
	}
	public function debting() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['status'] = 1;
		$data ['change_status'] = 0;
		$lists = \borrowClass::GetTenderList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'debting.html', $msg, 'user_header.html' );
	}
	public function debt_move() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		$data ['status'] = '0,2,3,4';
		$lists = \borrowClass::GetChangeList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'debt_move.html', $msg, 'user_header.html' );
	}
	public function move_success() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		$data ['status'] = 1;
		$lists = \borrowClass::GetChangeList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'move_success.html', $msg, 'user_header.html' );
	}
	public function auto() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data ['limit'] = 'all';
		$data ['user_id'] = $_G ['user_id'];
		$list = \borrowClass::GetAutoList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( 'list', $list );
		$this->display ( $tpldir . 'auto.html', $msg, 'user_header.html' );
	}
	public function auto_new() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		if ($_REQUEST ['id'] != "") {
			$data ['user_id'] = $_G ['user_id'];
			$data ['id'] = I ( 'request.id' );
			$_U ['auto_result'] = \borrowClass::GetAutoOne ( $data );
		} else {
			$Vvar = \usersClass::GetUsersVip ( array (
					'user_id' => $_G [user_id] 
			) );
			$this->assign ( 'Vvar', $Vvar );
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'auto_new.html', $msg, 'user_header.html' );
	}
	public function auto_add() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$var = array (
				"status",
				"tender_type",
				"tender_account",
				"tender_scale",
				"order",
				"account_min",
				"first_date",
				"last_date",
				"account_min_status",
				"date_status",
				"account_use_status",
				"account_use",
				"video_status",
				"realname_status",
				"phone_status",
				"my_friend",
				"not_black",
				"late_status",
				"late_times",
				"dianfu_status",
				"dianfu_times",
				"black_status",
				"black_user",
				"black_times",
				"not_late_black",
				"borrow_credit_status",
				"borrow_credit_first",
				"borrow_credit_last",
				"tender_credit_status",
				"tender_credit_first",
				"tender_credit_last",
				"user_rank",
				"first_credit",
				"last_credit",
				"webpay_statis",
				"webpay_times",
				"borrow_style",
				"timelimit_status",
				"timelimit_month_first",
				"timelimit_month_last",
				"timelimit_day_first",
				"timelimit_day_last",
				"apr_status",
				"apr_first",
				"apr_last",
				"award_status",
				"award_first",
				"award_last",
				"vouch_status",
				"tuijian_status" 
		);
		$data = post_var ( $var );
		$data ['user_id'] = $_G ['user_id'];
		if ($data ['tender_type'] == 2 && ($data ['tender_scale'] < 1 || $data ['tender_scale'] > 20)) {
			$msg = array (
					"按比例投标比例不能小于1%大于20%" 
			);
		} elseif ($data ['tender_account'] % 100 != 0) {
			$msg = array (
					"投标金额必须是100的倍数！" 
			);
		} else {
			if (IsExiest ( $_POST ['id'] != "" )) {
				$data ['id'] = $_POST ['id'];
				$result = \borrowClass::UpdateAuto ( $data );
				$msg = array (
						"自动投标信息修改成功",
						U ( 'borrow/auto' ) 
				);
			} else {
				$result = \autoClass::AddAuto ( $data );
				if ($result == - 2) {
					$msg = array (
							"你最多只能发布三个自动投标信息" 
					);
				} elseif ($result == - 1) {
					$msg = array (
							"你的操作有误，请不要乱操作" 
					);
				} else {
					$msg = array (
							"自动投标信息添加成功",
							U ( 'borrow/auto' ) 
					);
				}
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'auto_new.html', $msg, 'user_header.html' );
	}
	public function auto_del() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data ['user_id'] = $_G ['user_id'];
		$data ["id"] = $_REQUEST ['id'];
		$result = \borrowClass::DelAuto ( $data );
		if ($result != 1) {
			$msg = array (
					"你的操作有误，请不要乱操作" 
			);
		} else {
			$msg = array (
					"自动投标信息删除成功",
					U ( 'borrow/auto' ) 
			);
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'auto_new.html', $msg, 'user_header.html' );
	}
	public function buy_success() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['buy_userid'] = $_G ['user_id'];
		$data ['status'] = 1;
		$lists = \borrowClass::GetChangeList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'buy_success.html', $msg, 'user_header.html' );
	}
	public function publish() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['is_flow'] = 2;
		$data ['status'] = "0,1,2,4,5,6";
		$lists = \borrowClass::GetList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'publish.html', $msg, 'user_header.html' );
	}
	public function repayment() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['is_flow'] = 2;
		$data ['query_type'] = 'repay_no';
		$data ['status'] = 3;
		$lists = \borrowClass::GetList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'repayment.html', $msg, 'user_header.html' );
	}
	public function repaymentyes() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['is_flow'] = 2;
		$data ['query_type'] = 'repay_yes';
		$data ['status'] = 3;
		$lists = \borrowClass::GetList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'repayment.html', $msg, 'user_header.html' );
	}
	public function repay() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		if ($_REQUEST ['id'] != "") {
			
			$data ['borrow_nid'] = I ( 'request.borrow_nid' );
			$data ['id'] = I ( 'request.id' );
			$data ['user_id'] = $_G ['user_id'];
			$result = \borrowClass::BorrowRepay ( $data );
			if ($result > 0) {
				$msg = array (
						"还款成功",
						U ( 'borrow/repayment_view?borrow_nid=' . I ( 'request.borrow_nid' ) ) 
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
		} else {
			$data ['borrow_nid'] = $_REQUEST ['borrow_nid'];
			$data ['user_id'] = $_G ['user_id'];
			$result = \borrowClass::BorrowAdvanceRepay ( $data );
			if ($result > 0) {
				$msg = array (
						"还款成功",
						U ( 'borrow/repayment_view?borrow_nid=' . I ( 'request.borrow_nid' ) ) 
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'repayment.html', $msg, 'user_header.html' );
	}
	public function repaymentplan() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		$data ['order'] = 'repay_time';
		$data ['repay_status'] = 0;
		$Vvar = \usersClass::GetUsersVip ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$lists = \borrowClass::GetBorrowRepayList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( 'Vvar', $Vvar );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'repaymentplan.html', $msg, 'user_header.html' );
	}
	public function loandetail() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['borrow_userid'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['username'] ))
			$data ['username'] = I ( 'request.username' );
		$data ['borrow_status'] = 3;
		$lists = \borrowClass::GetTenderList ( $data );
		
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( 'Vvar', $Vvar );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'loandetail.html', $msg, 'user_header.html' );
	}
	public function repaylog() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$account = \borrowClass::GetUserCount ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$this->assign ( 'item', $account );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'repaylog.html', $msg, 'user_header.html' );
	}
	public function repayment_view() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data ['borrow_nid'] = I ( 'request.borrow_nid' );
		if ($data ['borrow_nid'] == "") {
			$msg = array (
					"您的输入有误" 
			);
		}
		$data ['user_id'] = $_G ['user_id'];
		$result = \borrowClass::GetOne ( $data );
		if ($result == false) {
			$msg = array (
					"您的操作有误" 
			);
		} else {
			$_U ['borrow_result'] = $result;
		}
		$data = array ();
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['borrow_nid'] ))
			$data ['borrow_nid'] = I ( 'request.borrow_nid' );
		$data ['order'] = 'order';
		$data ['borrow_status'] = 3;
		$data ['limit'] = 'all';
		$Vvar = \usersClass::GetUsersVip ( array (
				'user_id' => $_G ['user_id'] 
		) );
		$list = \borrowClass::GetBorrowRepayList ( $data );
		$this->assign ( 'list', $list );
		$this->assign ( 'Vvar', $Vvar );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'repayment_view.html', $msg, 'user_header.html' );
	}
	public function cancel() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data ['borrow_nid'] = I ( 'request.borrow_nid' );
		$data ['user_id'] = $_G ['user_id'];
		$result = \borrowClass::GetOne ( $data ); // 获取借款标的单独信息
		                                          
		// 如果借款进度大于70
		if ($result ['borrow_account_scale'] == 100) {
			$msg = array (
					$MsgInfo ["borrow_scale100_not_cancel"] 
			);
		} else {
			$result = \borrowClass::Cancel ( $data );
			if ($result > 0) {
				$msg = array (
						$MsgInfo ["borrow_cancel_success"],
						U ( 'borrow/publish' ) 
				);
			} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
				$msg = array (
						$MsgInfo [$result] 
				);
			} else {
				$msg = array (
						"撤销失败，请跟管理员联系" 
				);
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'publish.html', $msg, 'user_header.html' );
	}
	public function wait() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['user_id'] = $_G ['user_id'];
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['tender_status'] = 1;
		$lists = \borrowClass::GetTenderBorrowList ( $data );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'wait.html', $msg, 'user_header.html' );
	}
	public function change() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		if ($_REQUEST ['id'] != "") {
			if ($_POST ['account'] != "") {
				$data ['user_id'] = $_G ['user_id'];
				$data ['id'] = $_REQUEST ['id'];
				$data ['account'] = $_POST ['account'];
				$data ['valid_time'] = 7;
				$data ['remark'] = $_POST ['remark'];
				$data ['paypassword'] = $_POST ['paypassword'];
				$result = \borrowClass::ActionChange ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["borrow_change_action_success"] 
					);
				} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
					$msg = array (
							$MsgInfo [$result] 
					);
				} else {
					$msg = array (
							"操作失败，请跟管理员联系" 
					);
				}
			}
		} elseif ($_REQUEST ['cancel_id'] != "") {
			if ($_POST ['cancel_remark'] != "") {
				$data ['user_id'] = $_G ['user_id'];
				$data ['id'] = $_REQUEST ['cancel_id'];
				$data ['cancel_remark'] = $_POST ['cancel_remark'];
				$data ['paypassword'] = $_POST ['paypassword'];
				$result = \borrowClass::CancelChange ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["borrow_change_cancel_success"] 
					);
				} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
					$msg = array (
							$MsgInfo [$result] 
					);
				} else {
					$msg = array (
							"操作失败，请跟管理员联系" 
					);
				}
			}
		} 

		elseif ($_REQUEST ['web_id'] != "") {
			if ($_POST ['paypassword'] != "") {
				$data ['user_id'] = $_G ['user_id'];
				$data ['id'] = $_REQUEST ['web_id'];
				$data ['paypassword'] = $_POST ['paypassword'];
				$result = \borrowClass::WebChange ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["borrow_change_web_success"] 
					);
				} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
					$msg = array (
							$MsgInfo [$result] 
					);
				} else {
					$msg = array (
							"操作失败，请跟管理员联系" 
					);
				}
			}
		} elseif ($_REQUEST ['buy_id'] != "") {
			if ($_POST ['paypassword'] != "") {
				$data ['user_id'] = $_G ['user_id'];
				$data ['id'] = $_REQUEST ['buy_id'];
				$data ['paypassword'] = $_POST ['paypassword'];
				$result = \borrowClass::BuyChange ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["borrow_change_buy_success"] 
					);
				} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
					$msg = array (
							$MsgInfo [$result] 
					);
				} else {
					$msg = array (
							"操作失败，请跟管理员联系" 
					);
				}
			}
		}
		
		$this->display ( $tpldir . 'user_borrow_change.html', $msg );
	}
	public function tender() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if($_G ['user_id']==''||!isset($_G ['user_id'])){
			redirect ( U ( 'index/login' ), 0, '请登录' );
			exit ();
		}
		if (! check_verify ( I ( 'post.valicode' ) )) {
			$msg = array (
					"验证码不正确" 
			);
		} else {
			
			$borrow_result = \borrowClass::GetOne ( array (
					"borrow_nid" => $_POST ['borrow_nid'] 
			) );
			
			if ($_G ['user_result'] ['islock'] == 1) {
				$msg = array (
						"您账号已经被锁定，不能进行投标，请跟管理员联系" 
				);
			} elseif (md5 ( $_POST ['paypassword'] ) != $_G ['user_result'] ['paypassword']) {
				$msg = array (
						"支付交易密码不正确" 
				);
			} elseif ($_POST ['dxbPWD'] != $borrow_result ['pwd'] && $borrow_result ['isDXB'] == 1) {
				$msg = array (
						"定向标密码不正确" 
				);
			} elseif (!is_int($_POST ['money']+0)||$_POST ['money'] % 50 != 0 || $_POST ['money'] == 0 || $_POST ['money'] == '') {
				$msg = array (
						"投资金额必须是50的倍数！" 
				);
			} elseif ($_POST ['Second_limit_money'] < $_POST ['money'] && $_POST ['Second_limit_money'] != 0 && time () - $borrow_result ['verify_time'] <= 1800) { // && $_POST['is_Seconds']==1
				$msg = array (
						"你投资金额大于了秒标最大额度！" 
				);
			}elseif($_POST ['money']<$_G['system']['con_investment_account']){
				$msg = array (
						"起头金额为".$_G['system']['con_investment_account']
				);
			} 
			 
			else {
				// 将借款标添加进去
				$_tender ['borrow_nid'] = $_POST ['borrow_nid'];
				$_tender ['user_id'] = $_G ['user_id'];
				$_tender ['account'] = $_POST ['money'];
				$_tender ['contents'] = $_POST ['contents'];
				
				if ($borrow_result ['is_flow'] == 1) {
					$_tender ['flow_count'] = $_POST ['flow_count'];
				}
				
				$_tender ['status'] = 0;
				$_tender ['nid'] = "tender_" . $data ['user_id'] . time () . rand ( 10, 99 ); // 订单号
				$result = \borrowClass::AddTender ( $_tender );
				
				if ($borrow_result ['is_flow'] == 1 && $result > 0) {
					$sql = "update `{borrow_tender}` set status=1 where id={$result}";
					M ()->execute ( presql ( $sql ) );
					$tender_result = M ( 'borrow_tender' )->where ( "id={$result}" )->find ();
					$tender_userid = $_tender ['user_id'];
					$borrow_nid = $_tender ['borrow_nid'];
					$tender_id = $result;
					$tender_account = $tender_result ['account'];
					$flow_count = $_tender ['flow_count'];
					$borrow_userid = $borrow_result ['user_id'];
					$account = $tender_result ['account'];
					$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$borrow_result['borrow_nid'])." target=_blank>{$borrow_result['name']}</a>";
					
					// 添加投资的收款纪录
					$_equal ["account"] = $tender_account;
					$_equal ["period"] = $borrow_result ["borrow_period"];
					$_equal ["apr"] = $borrow_result ["borrow_apr"];
					$_equal ["style"] = 2;
					$_equal ["type"] = "";
					$equal_result = EqualInterest ( $_equal );
					
					foreach ( $equal_result as $period_key => $value ) {
						$repay_month_account = $value ['account_all'];
						
						$result = M ( 'borrow_repay' )->where ( "user_id={$borrow_userid} and repay_period='0' and borrow_nid='{$borrow_nid}'" )->find ();
						
						if ($result == null) {
							$sql = "insert into `{borrow_repay}` set `addtime` = '" . time () . "',";
							$sql .= "`addip` = '" . get_client_ip () . "',user_id={$borrow_userid},status=1,`borrow_nid`='{$borrow_nid}',`repay_period`='0',";
							$sql .= "`repay_time`='{$value['repay_time']}',`repay_account`='{$value['account_all']}',";
							$sql .= "`repay_interest`='{$value['account_interest']}',`repay_capital`='{$value['account_capital']}'";
							M ()->execute ( presql ( $sql ) );
						} else {
							$sql = "update `{borrow_repay}` set `addtime` = '" . time () . "',";
							$sql .= "`addip` = '" . get_client_ip () . "',user_id={$borrow_userid},status=1,`borrow_nid`='{$borrow_nid}',`repay_period`='0',";
							$sql .= "`repay_time`='{$value['repay_time']}',`repay_account`=`repay_account`+'{$value['account_all']}',";
							$sql .= "`repay_interest`=`repay_interest`+'{$value['account_interest']}',`repay_capital`=`repay_capital`+'{$value['account_capital']}'";
							$sql .= " where user_id={$borrow_userid} and repay_period='0' and borrow_nid='{$borrow_nid}'";
							M ()->execute ( presql ( $sql ) );
						}
						
						// 防止重复添加还款信息
						
						$result = M ( 'borrow_recover' )->where ( "user_id={$tender_userid} and borrow_nid='{$borrow_nid}' and recover_period=$period_key and tender_id={$tender_id}" )->find ();
						if ($result == null) {
							
							$sql = "insert into `{borrow_recover}` set `addtime` = '" . time () . "',";
							$sql .= "`addip` = '" . get_client_ip () . "',user_id={$tender_userid},status=1,`borrow_nid`='{$borrow_nid}',`borrow_userid`={$borrow_userid},`tender_id`={$tender_id},`recover_period`={$period_key},";
							$sql .= "`recover_time`='{$value['repay_time']}',`recover_account`='{$value['account_all']}',";
							$sql .= "`recover_interest`='{$value['account_interest']}',`recover_capital`='{$value['account_capital']}'";
							M ()->execute ( presql ( $sql ) );
						} else {
							$sql = "update `{borrow_recover}` set `addtime` = '" . time () . "',";
							$sql .= "`addip` = '" . get_client_ip () . "',user_id={$tender_userid},status=1,`borrow_nid`='{$borrow_nid}',`borrow_userid`={$borrow_userid},`tender_id`={$tender_id},`recover_period`={$period_key},";
							$sql .= "`recover_time`='{$value['repay_time']}',`recover_account`='{$value['account_all']}',";
							$sql .= "`recover_interest`='{$value['account_interest']}',`recover_capital`='{$value['account_capital']}'";
							$sql .= " where user_id={$tender_userid} and recover_period={$period_key} and borrow_nid='{$borrow_nid}' and tender_id={$tender_id}";
							M ()->execute ( presql ( $sql ) );
						}
					}
					
					$recover_times = count ( $equal_result );
					// 第五步,更新投资标的信息
					$_equal ["type"] = "all";
					$equal_result = EqualInterest ( $_equal );
					$recover_all = $equal_result ['account_total'];
					$recover_interest_all = $equal_result ['interest_total'];
					$recover_capital_all = $equal_result ['capital_total'];
					$sql = "update `{borrow_tender}` set recover_account_all='{$equal_result['account_total']}',recover_account_interest='{$equal_result['interest_total']}',recover_account_wait='{$equal_result['account_total']}',recover_account_interest_wait='{$equal_result['interest_total']}',recover_account_capital_wait='{$equal_result['capital_total']}'  where id={$tender_id}";
					M ()->execute ( presql ( $sql ) );
					
					$sql = "update `{borrow}` set repay_account_all=repay_account_all+'{$equal_result['account_total']}',repay_account_interest=repay_account_interest+'{$equal_result['interest_total']}',repay_account_capital=repay_account_capital+'{$equal_result['capital_total']}',repay_account_wait=repay_account_wait+'{$equal_result['account_total']}',repay_account_interest_wait=repay_account_interest_wait+'{$equal_result['interest_total']}',repay_account_capital_wait=repay_account_capital_wait+'{$equal_result['capital_total']}',flow_money=flow_money+'{$tender_account}',flow_count=flow_count+'{$flow_count}' where borrow_nid='{$borrow_nid}'";
					M ()->execute ( presql ( $sql ) );
					
					// 第六步,扣除投资人的资金
					$log_info ["user_id"] = $tender_userid; // 操作用户id
					$log_info ["nid"] = "tender_success_" . $borrow_nid . $tender_userid . $tender_id . $period_key; // 订单号
					$log_info ["money"] = $tender_account; // 操作金额
					$log_info ["income"] = 0; // 收入
					$log_info ["expend"] = $tender_account; // 支出
					$log_info ["balance_cash"] = 0; // 可提现金额
					$log_info ["balance_frost"] = 0; // 不可提现金额
					$log_info ["frost"] = - $tender_account; // 冻结金额
					$log_info ["await"] = 0; // 待收金额
					$log_info ["type"] = "tender_success"; // 类型
					$log_info ["to_userid"] = $borrow_userid; // 付给谁
					$log_info ["remark"] = "投标[{$borrow_url}]成功投资金额扣除";
					\accountClass::AddLog ( $log_info );
					
					// 第七步,添加待收的金额
					$log_info ["user_id"] = $tender_userid; // 操作用户id
					$log_info ["nid"] = "tender_success_frost_" . $borrow_nid . $tender_userid . $tender_id . $period_key; // 订单号
					$log_info ["money"] = $recover_all; // 操作金额
					$log_info ["income"] = 0; // 收入
					$log_info ["expend"] = 0; // 支出
					$log_info ["balance_cash"] = 0; // 可提现金额
					$log_info ["balance_frost"] = 0; // 不可提现金额
					$log_info ["frost"] = 0; // 冻结金额
					$log_info ["await"] = $recover_all; // 待收金额
					$log_info ["type"] = "tender_success_frost"; // 类型
					$log_info ["to_userid"] = $borrow_userid; // 付给谁
					$log_info ["remark"] = "投标[{$borrow_url}]成功待收金额增加";
					accountClass::AddLog ( $log_info );
					
					// 加入用户操作记录
					$user_log ["user_id"] = $tender_userid;
					$user_log ["code"] = "tender";
					$user_log ["type"] = "tender_success";
					$user_log ["operating"] = "tender";
					$user_log ["article_id"] = $tender_userid;
					$user_log ["result"] = 1;
					$user_log ["content"] = "投资流转标：[{$borrow_url}]成功";
					\usersClass::AddUsersLog ( $user_log );
					
					// 如果有设置奖励并且招标成功，或者失败也奖励
					if ($borrow_result ['award_status'] != 0) {
						// 投标奖励扣除和增加。
						if ($borrow_result ['award_status'] == 1) {
							$money = round ( ($tender_account / $borrow_result ['account']) * $borrow_result ['award_account'], 2 );
						} elseif ($borrow_result ['award_status'] == 2) {
							$money = round ( (($borrow_result ['award_scale'] / 100) * $tender_account), 2 );
						}
						
						$log_info ["user_id"] = $tender_userid; // 操作用户id
						$log_info ["nid"] = "tender_award_add_" . $tender_userid . "_" . $tender_id . $borrow_nid; // 订单号
						$log_info ["money"] = $money; // 操作金额
						$log_info ["income"] = $money; // 收入
						$log_info ["expend"] = 0; // 支出
						$log_info ["balance_cash"] = $money; // 可提现金额
						$log_info ["balance_frost"] = 0; // 不可提现金额
						$log_info ["frost"] = 0; // 冻结金额
						$log_info ["await"] = 0; // 待收金额
						$log_info ["type"] = "tender_award_add"; // 类型
						$log_info ["to_userid"] = 0; // 付给谁
						$log_info ["remark"] = "借款[{$borrow_url}]的借款奖励";
						\accountClass::AddLog ( $log_info );
					}
					
					// 更新统计信息
					\borrowClass::UpdateBorrowCount ( array (
							"user_id" => $tender_userid,
							"tender_times" => 1,
							"tender_account" => $tender_account,
							"tender_success_times" => 1,
							"tender_success_account" => $tender_account,
							"tender_recover_account" => $recover_all,
							"tender_recover_wait" => $recover_all,
							"tender_capital_account" => $recover_capital_all,
							"tender_capital_wait" => $recover_capital_all,
							"tender_interest_account" => $recover_interest_all,
							"tender_interest_wait" => $recover_interest_all,
							"tender_recover_times" => $recover_times,
							"tender_recover_times_wait" => $recover_times 
					) );
				}
				if ($result > 0) {
					$sdata['tender_id']=$result;
					$sdata['user_id']=$_G ['user_id'];
					$sdata['borrow_nid']=$borrow_result['borrow_nid'];
					\borrowClass::AddSpread($sdata);
					$msg = array ("投标成功" );
				} elseif (IsExiest ( $MsgInfo [$result] ) != "") {
					$msg = array ($MsgInfo [$result] );
				} else {$msg = array ($result );
				}
			}
		}
		$this->display ( $tpldir . 'tender_content.html', $msg );
	}
}