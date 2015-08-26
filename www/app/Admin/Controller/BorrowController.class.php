<?php

namespace Admin\Controller;

class BorrowController extends AdminController {
	public function lists() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if (IsExiest ( $_GET ['username'] ))
			$data ['username'] = I ( 'get.username' );
		if (IsExiest ( $_GET ['borrow_name'] ))
			$data ['borrow_name'] = I ( 'get.borrow_name' );
		if (IsExiest ( $_GET ['borrow_nid'] ))
			$data ['borrow_nid'] = I ( 'get.borrow_nid' );
		if (IsExiest ( $_GET ['status'] ))
			$data ['status'] = I ( 'get.status' );
		if (IsExiest ( $_GET ['borrow_type'] ))
			$data ['borrow_type'] = I ( 'get.borrow_type' );
		$data ['page'] = I ( 'get.p' );
		$lits = \borrowClass::GetList ( $data );
		$this->assign ( $lits );
		$this->display ( $tpldir . 'borrowlist.html', $msg );
	}
	public function views() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$data ['borrow_nid'] = I ( 'request.nid' );
		$result = \borrowClass::GetOne ( $data );
		if (! is_array ( $result )) {
			$msg = array (
					$MsgInfo [$result] 
			);
		} else {
			$_A ['borrow_result'] = $result;
			$data ['borrow_nid'] = $result ['borrow_nid'];
			$data ['limit'] = "all";
			$tlist = \borrowClass::GetTenderList ( $data );
			$this->assign ( 'tlist', $tlist );
			$flists = \borrowClass::GetUpfilesList ( array (
					'borrow_info' => $result ['borrow_info'],
					'limit' => 'all' 
			) );
			$this->assign ( 'flists', $flists );
			$vdata ['limit'] = 'all';
			$vdata ['borrow_nid'] = $_A ['borrow_result'] ['borrow_nid'];
			$vlists = \borrowClass::GetVouchList ( $vdata );
			$this->assign ( 'vlists', $vlists );
		}
		
		$this->display ( $tpldir . 'borrowviews.html', $msg );
	}
	public function wind() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['view'] != "") {
			$data ['borrow_nid'] = I ( 'request.view' );
			$data ['wind_control'] = I ( 'post.wind_control' );
			$result = \borrowClass::update_borrow ( $data );
			if ($result != true) {
				$msg = array (
						$MsgInfo [$result] 
				);
			} else {
				$msg = array (
						$MsgInfo ['right'],
						U ( 'Borrow/views?nid=' . $data ['borrow_nid'] ) 
				);
			}
		}
		$this->display ( $tpldir . 'borrowviews.html', $msg );
	}
	public function borrow_info_del() {
		if ($_REQUEST ['view'] != "") {
			$data ["borrow_nid"] = I ( 'request.view' );
			$data ["borrow_info"] = I ( 'request.borrow_info_id' );
			$result = \borrowClass::DelBorrowInfo ( $data );
			if ($result) {
				
				$rdata ['status'] = 2;
				$this->ajaxReturn ( $rdata );
			}
		} else {
			$rdata ['status'] = 1;
			$this->ajaxReturn ( $rdata );
		}
	}
	public function borrow_info() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['view'] != "") {
			$data ['borrow_nid'] = I ( 'request.view' );
			if (! empty ( $_FILES ['borrow_info'] ['name'] )) {
				$datapic ['file'] = "borrow_info";
				$datapic ['code'] = "borrow_info";
				$datapic ['user_id'] = $_G ['user_id'];
				$datapic ['type'] = "new";
				$datapic ['article_id'] = $data ['borrow_nid'];
				$info = $this->upfiles ( 'borrow_info', 'borrow', $datapic );
			}
			if ($info != "") {
				$data ['borrow_info'] = $info ['upfiles_id'];
				$result = \borrowClass::UpdateBorrowInfo ( $data );
				if ($result) {
					$msg = array (
							"添加成功",
							U ( 'Borrow/views?nid=' . $data ['borrow_nid'] ) 
					);
				}
			} else {
				$msg = array (
						"错误",
						U ( 'Borrow/views?nid=' . $data ['borrow_nid'] ) 
				);
			}
		} else {
			$msg = array (
					"错误",
					U ( 'Borrow/views?nid=' . $data ['borrow_nid'] ) 
			);
		}
		$this->display ( $tpldir . 'borrowviews.html', $msg );
	}
	public function first() {
		check_rank ( "borrow_first" );
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['check'] != "") {
			if (isset ( $_POST ['borrow_nid'] ) && $_POST ['borrow_nid'] != "") {
				$data ['borrow_nid'] = I ( 'post.borrow_nid' );
				$data ['status'] = I ( 'post.status' );
				$data ['verify_remark'] = I ( 'post.verify_remark' );
				$data ['recommend'] = I ( 'post.recommend' );
				
				$result = \borrowClass::Verify ( $data );
				if ($result > 0) {
					$msg = array (
							$MsgInfo ["borrow_verify_success"],
							U ( 'borrow/first' ) 
					);
				} else {
					$msg = array (
							$MsgInfo [$result] 
					);
				}
				
				// 加入管理员操作记录
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "borrow";
				$admin_log ["type"] = "borrow";
				$admin_log ["operating"] = "verify";
				$admin_log ["article_id"] = $result > 0 ? $result : 0;
				$admin_log ["result"] = $result > 0 ? 1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			} else {
				$data = array ();
				$data ['borrow_nid'] = I ( 'request.check' );
				$result = \borrowClass::GetOne ( $data );
				if (! is_array ( $result )) {
					$msg = array (
							$MsgInfo [$result] 
					);
				} elseif ($result ['status'] != 0) {
					$msg = array (
							$MsgInfo ["borrow_not_exiest"] 
					);
				} else {
					$_A ['borrow_result'] = $result;
				}
			}
		} elseif ($_REQUEST ['cancel'] != "") {
			$data ['borrow_nid'] = I ( 'request.cancel' );
			$result = \borrowClass::Cancel ( $data );
			
			if ($result > 0) {
				$msg = array (
						"撤回成功",
						U ( 'borrow/first' ) 
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
			
			// 加入管理员操作记录
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "borrow";
			$admin_log ["type"] = "borrow";
			$admin_log ["operating"] = "cancel";
			$admin_log ["article_id"] = $result > 0 ? $result : 0;
			$admin_log ["result"] = $result > 0 ? 1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		} else {
			$data = array ();
			$data ['page'] = I ( 'get.p' );
			if (isset ( $_REQUEST ['borrow_name'] ))
				$data ['borrow_name'] = I ( 'request.borrow_name' );
			if (isset ( $_REQUEST ['is_flow'] ))
				$data ['is_flow'] = I ( 'request.is_flow' );
			if (isset ( $_REQUEST ['is_Seconds'] ))
				$data ['is_Seconds'] = I ( 'request.is_Seconds' );
			if (isset ( $_REQUEST ['borrow_nid'] ))
				$data ['borrow_nid'] = I ( 'request.borrow_nid' );
			if (isset ( $_REQUEST ['username'] ))
				$data ['username'] = I ( 'request.username' );
			if (isset ( $_REQUEST ['query_type'] ))
				$data ['query_type'] = I ( 'request.query_type' );
			else
				$data ['query_type'] = 'first';
			if (isset ( $_REQUEST ['status'] ))
				$data ['status'] = I ( 'request.status' );
			if (isset ( $_REQUEST ['borrow_type'] ))
				$data ['borrow_type'] = I ( 'request.borrow_type' );
			if (isset ( $_REQUEST ['dotime1'] ))
				$data ['dotime1'] = I ( 'request.dotime1' );
			if (isset ( $_REQUEST ['dotime2'] ))
				$data ['dotime2'] = I ( 'request.dotime2' );
			$lists = \borrowClass::GetList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir . 'borrowfirst.html', $msg );
	}
	public function borrow_repay() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$data = array ();
			$data ['page'] = I ( 'get.p' );
			if (isset ( $_REQUEST ['borrow_nid'] ))
				$data ['borrow_nid'] = I ( 'request.borrow_nid' );
			if (isset ( $_REQUEST ['username'] ))
				$data ['username'] = I ( 'request.username' );
			if (isset ( $_REQUEST ['borrow_name'] ))
				$data ['borrow_name'] = I ( 'request.borrow_name' );
			$lists=\borrowClass::GetTenderList($data);
			$this->assign($lists);
		$this->display ( $tpldir . 'borrow_repay.html', $msg );
	}
	public function full() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['fullcheck'] != "") {
			
			if (isset ( $_POST ['borrow_nid'] ) && $_POST ['borrow_nid'] != "") {
				if (! check_verify ( I ( 'post.valicode' ) )) {
					$msg = array (
							'验证码错误' 
					);
				}
				
				if ($msg == "") {
					$var = array (
							"borrow_nid",
							"status",
							"reverify_remark" 
					);
					$data = post_var ( $var );
					$result = \borrowClass::Reverify ( $data );
					
					if ($result > 0) {
						
						$msg = array (
								$MsgInfo ["borrow_reverify_success"] 
						)
						;
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
					
					// 加入管理员操作记录
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "borrow";
					$admin_log ["type"] = "borrow";
					$admin_log ["operating"] = "verify";
					$admin_log ["article_id"] = $result > 0 ? $result : 0;
					$admin_log ["result"] = $result > 0 ? 1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\uadminClass::AddAdminLog ( $admin_log );
				}
			} else {
				
				$data ['borrow_nid'] = $_REQUEST ['fullcheck'];
				$result = \borrowClass::GetOne ( $data );
				if (! is_array ( $result )) {
					$msg = array (
							$MsgInfo [$result] 
					);
				} elseif ($result ['status'] != 1) {
					$msg = array (
							$MsgInfo ["borrow_fullcheck_error"] 
					);
				} else {
					$_A ['borrow_result'] = $result;
				}
			}
		} else {
			$data = array ();
			$data ['page'] = I ( 'get.p' );
			if (isset ( $_REQUEST ['borrow_name'] ))
				$data ['borrow_name'] = I ( 'request.borrow_name' );
			if (isset ( $_REQUEST ['type'] ))
				$data ['type'] = I ( 'request.type' );
			if (isset ( $_REQUEST ['borrow_nid'] ))
				$data ['borrow_nid'] = I ( 'request.borrow_nid' );
			if (isset ( $_REQUEST ['username'] ))
				$data ['username'] = I ( 'request.username' );
			if (isset ( $_REQUEST ['query_type'] ))
				$data ['query_type'] = I ( 'request.query_type' );
			else
				$data ['query_type'] = 'full';
			if (isset ( $_REQUEST ['status'] ))
				$data ['status'] = I ( 'request.status' );
			if (isset ( $_REQUEST ['dotime1'] ))
				$data ['dotime1'] = I ( 'request.dotime1' );
			if (isset ( $_REQUEST ['dotime2'] ))
				$data ['dotime2'] = I ( 'request.dotime2' );
			if (isset ( $_REQUEST ['borrow_type'] ))
				$data ['borrow_type'] = I ( 'request.borrow_type' );
			$lists = \borrowClass::GetList ( $data );
			$this->assign ( $lists );
		}
		$this->display ( $tpldir . 'full.html', $msg );
	}
	public function joinbad() {
		if ($_REQUEST ['borrow_nid'] != "") {
			$data ['borrow_nid'] = $_REQUEST ['borrow_nid'];
			$data ['bad_status'] = 1;
			$result = \borrowClass::RepayJoinBad ( $data );
			if ($result > 0) {
				$msg = array (
						"加入坏账池成功。"
				);
			} else {
				$msg = array (
						"该还款不存在！"
				);
			}
		}
		$this->display ( $tpldir . 'repay.html', $msg );
	}
	public function repay() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['id'] != "") {
			$data ['id'] = I ( 'request.id' );
			$result = \borrowClass::LateRepay ( $data );
			if ($result > 0) {
				$msg = array (
						$MsgInfo ["web_late_repay"],
				);
			} else {
				$msg = array (
						$MsgInfo [$result] 
				);
			}
		} else {
			$data = array ();
			$data ['page'] = I ( 'get.p' );
			if (isset ( $_REQUEST ['borrow_name'] ))
				$data ['borrow_name'] = I ( 'request.borrow_name' );
			$data ['repay_status'] = 0;
			$data ['lateing'] = 1;
			$lists = \borrowClass::GetBorrowRepayList ( $data );
			$this->assign ( $lists );
			$fdata ['type'] = 2;
			if (isset ( $_REQUEST ['borrow_type'] ))
				$fdata ['nid'] = I ( 'request.nid' );
			if (isset ( $_REQUEST ['username'] ))
				$fdata ['username'] = I ( 'request.username' );
			if (isset ( $_REQUEST ['dotime2'] ))
				$fdata ['dotime2'] = I ( 'request.dotime2' );
			if (isset ( $_REQUEST ['dotime1'] ))
				$fdata ['dotime1'] = I ( 'request.dotime1' );
			$fdata ['style'] = "fxc";
			$floop = \accountClass::GetLogList ( $fdata );
			$this->assign('floop',$floop);
		}
		$this->display ( $tpldir . 'repay.html', $msg );
	}
	public function bad_account() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		if (isset ( $_REQUEST ['borrow_name'] ))
			$data ['borrow_name'] = I ( 'request.borrow_name' );
		if (isset ( $_REQUEST ['username'] ))
			$data ['username'] = I ( 'request.username' );
		if (isset ( $_REQUEST ['vouch_status'] ))
			$data ['vouch_status'] = I ( 'request.vouch_status' );
		if (isset ( $_REQUEST ['borrow_nid'] ))
			$data ['borrow_nid'] = I ( 'request.borrow_nid' );
		$data ['bad'] = 1;
		$data ['repay_status'] = 0;
		$lists = \borrowClass::GetBadBorrowRepay ( $data );
		$this->assign($lists);
		$this->display ( $tpldir . 'repay.html', $msg );
	}
	public function recommon_tender() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		if (isset ( $_REQUEST ['username'] ))
			$data ['username'] = I ( 'request.username' );
		if (isset ( $_REQUEST ['keywords'] ))
			$data ['keywords'] = I ( 'request.keywords' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['borrow_type'] ))
			$data ['borrow_type'] = I ( 'request.borrow_type' );
		if (isset ( $_REQUEST ['type'] ))
			$data ['type'] = I ( 'request.type' );
		$data ['tender_status'] = 0;
		$data ['borrow_status'] = 1;
		$lists = \borrowClass::GetInviteTenderList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'recommon_tender.html', $msg );
	}
	public function change() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['change_check'] != "") {
			if (isset ( $_POST ['remark'] ) && $_POST ['remark'] != "") {
				$msg = check_valicode ();
				if ($msg == "") {
					$var = array (
							"status",
							"remark"
					);
					$data = post_var ( $var );
					$data ['id'] = $_REQUEST ['change_check'];
					$result = \borrowChangeClass::WebVerifyChange ( $data );
					if ($result > 0) {
						$msg = array (
								$MsgInfo ["borrow_change_verify_success"],
						);
					} else {
						$msg = array (
								$MsgInfo [$result]
						);
					}
						
					// 加入管理员操作记录
					$admin_log ["user_id"] = $_G ['user_id'];
					$admin_log ["code"] = "borrow";
					$admin_log ["type"] = "change";
					$admin_log ["operating"] = "verify";
					$admin_log ["article_id"] = $result > 0 ? $result : 0;
					$admin_log ["result"] = $result > 0 ? 1 : 0;
					$admin_log ["content"] = $msg [0];
					$admin_log ["data"] = $data;
					\borrowChangeClass::AddAdminLog ( $admin_log );
				}
			}
		}
		else{
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		if (isset ( $_REQUEST ['status'] ))
			$data ['status'] = I ( 'request.status' );
		if (isset ( $_REQUEST ['web'] ))
			$data ['web'] = I ( 'request.web' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		$data ['order'] = status;
		$lists = \borrowClass::GetChangeList ( $data );
		$this->assign ( $lists );}
		$this->display ( $tpldir . 'change.html', $msg );
	}
	public function fengxianchi() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$data = array ();
		$data ['page'] = I ( 'get.p' );
		$data ['type'] = 2;
		if (isset ( $_REQUEST ['nid'] ))
			$data ['nid'] = I ( 'request.nid' );
		if (isset ( $_REQUEST ['username'] ))
			$data ['username'] = I ( 'request.username' );
		if (isset ( $_REQUEST ['dotime2'] ))
			$data ['dotime2'] = I ( 'request.dotime2' );
		if (isset ( $_REQUEST ['dotime1'] ))
			$data ['dotime1'] = I ( 'request.dotime1' );
		$data ['style'] = 'fxc';
		$lists = \accountClass::GetLogList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir . 'fengxianchi.html', $msg );
	}
	public function addfengxian() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if(IsExiest ($_POST['money']) != false){
			if(is_numeric($_POST['money'])){
				$log_info ["user_id"] = 0; // 操作用户id
				$log_info ["nid"] = "fengxianchi_0_" . time (); // 订单号
				$log_info ["money"] =$_POST['money']; // 操作金额
				$log_info ["income"] = 0; // 收入
				$log_info ["expend"] = 0; // 支出
				$log_info ["balance_cash"] = 0; // 可提现金额
				$log_info ["balance_frost"] = 0; // 不可提现金额
				$log_info ["frost"] = 0; // 冻结金额
				$log_info ["await"] = 0; // 待收金额
				$log_info ["type"] = "fengxianchi_webadd"; // 类型
				$log_info ["to_userid"] = 0; // 付给谁
				$log_info ["remark"] = "系统账户注入风险金{$_POST['money']}元";
				$reslts=\accountClass::AddLog ( $log_info );
				$msg=array('操作成功');
			}
			else{
				$msg=array('输入不正确');
			}
		}
		$this->display ( $tpldir . 'fengxianchi.html', $msg );
	}
	public function tool() {
		global $tpldir, $_G, $_A, $MsgInfo;
		if ($_REQUEST ['key'] != "") {
			$data ['key'] = $_REQUEST ['key'];
			$result = \borrowtoolClass::Check ( $data );
			echo json_encode ( $result );
			exit ();
		}
		$this->display ( $tpldir . 'tool.html', $msg );
	}
	public function amount() {
		global $tpldir, $_G, $_A;
		$borrow_amount_type = array (
				"borrow" => "借款额度",
				"vouch_borrow" => "担保借款额度",
				"vouch_tender" => "担保投资额度" 
		);
		$data ['page'] = I ( 'get.p' );
		$lists = \borrowClass::GetAmountList ( $data );
		$this->assign ( $lists );
		$this->assign ( 'borrow_amount_type', $borrow_amount_type );
		$this->display ( $tpldir . 'amount.html' );
	}
	public function amountapply() {
		global $tpldir, $_G, $_A, $MsgInfo;
		$msg == "";
		$borrow_amount_type = array (
				"borrow" => "借款额度",
				"vouch_borrow" => "担保借款额度",
				"vouch_tender" => "担保投资额度" 
		);
		if ($_REQUEST ['examine'] != "") {
			if (IS_POST) {
				if (check_verify ( I ( 'post.valicode' ) )) {
					$data ['verify_userid'] = $_G ['user_id'];
					$data ['verify_remark'] = I ( 'post.verify_remark' );
					$data ['status'] = I ( 'post.status' );
					$data ['account'] = I ( 'post.account' );
					$data ['user_id'] = I ( 'post.user_id' );
					$data ['id'] = I ( 'post.id' );
					$data ['nid'] = I ( 'post.nid' );
					$result = \borrowClass::CheckAmountApply ( $data );
					
					if ($result > 0) {
						$msg = array (
								"操作成功",
								U ( 'Borrow/amountapply' ) 
						);
					} else {
						$msg = array (
								$MsgInfo [$result] 
						);
					}
				} else {
					$msg = array (
							'验证码错误' 
					);
				}
			} else {
				$data ["id"] = I ( 'request.examine' );
				$result = \borrowClass::GetAmountApplyOne ( $data );
				if (is_array ( $result )) {
					$_A ["amount_apply_result"] = $result;
				} else {
					$msg = array (
							$MsgInfo [$result],
							U ( 'Borrow/amountapply' ) 
					);
				}
			}
		} else {
			if (isset ( $_GET ['username'] ))
				$data ['username'] = I ( 'get.username' );
			$data ['page'] = I ( 'get.p' );
			$lists = \borrowClass::GetAmountApplyList ( $data );
			$this->assign ( $lists );
			$this->assign ( 'borrow_amount_type', $borrow_amount_type );
		}
		$this->display ( $tpldir . 'amountapply.html', $msg );
	}
	public function amountlog() {
		global $tpldir, $_G, $_A;
		$borrow_amount_type = array (
				"borrow" => "借款额度",
				"vouch_borrow" => "担保借款额度"
		);
		$data=array();
		if(isset($_REQUEST['user_id']))
			$data['user_id']=I('request.user_id');
		if(isset($_REQUEST['username']))
			$data['username']=I('request.username');
		if(isset($_REQUEST['amount_type']))
			$data['amount_type']=I('request.amount_type');
		$lists=\borrowClass::GetAmountLogList($data);
		$this->assign($lists);
		$this->assign ( 'borrow_amount_type', $borrow_amount_type );
		$this->display ( $tpldir . 'amountlog.html' );
	}
	public function limit_money(){
		global $tpldir, $_G, $_A,$MsgInfo;
		if ($_REQUEST ['view'] != "") {
			$data ['borrow_nid'] = I('request.view');
			$data ['Second_limit_money'] = I('post.Second_limit_money');
			$result = \borrowClass::update_borrow ( $data );
			if ($result != true) {
				$msg = array (
						$MsgInfo [$result]
				);
			} else {
				$msg = array (
						$MsgInfo ['right'],
				);
			}
		}else{$msg=array('操作有误');}
		$this->display ( $tpldir . 'amountapply.html', $msg );
	}
	public function tender(){
		global $tpldir, $_G, $_A,$MsgInfo;
		if ($_REQUEST ['id'] != "") {
			$_A ['borrow_tender_result'] = \borrowClass::GetTenderOne (array ("id" => $_REQUEST ['id']) );
			$data=array();
			if($_REQUEST['borrow_name']!='')
				$data['borrow_name']=I('request.borrow_name');
			if($_REQUEST['username']!='')
				$data['username']=I('request.username');
			$data['limit']='all';
			$data['borrow_nid']=$_A ['borrow_tender_result']['borrow_nid'];
			$list=\borrowClass::GetTenderList($data);
			$this->assign('list',$list);
		}
		else{
			$data=array();
			if($_REQUEST['borrow_name']!='')
				$data['borrow_name']=I('request.borrow_name');
			if($_REQUEST['borrow_nid']!='')
				$data['borrow_nid']=I('request.borrow_nid');
			if($_REQUEST['username']!='')
				$data['username']=I('request.username');
			$data['query_type']='tender';
			$lists=\borrowClass::GetTenderList($data);
			$this->assign($lists);
		}
		$this->display ( $tpldir . 'borrow.tender.html', $msg );
		
	}
	public function open_flow(){
		global $tpldir, $_G, $_A,$MsgInfo;
		check_rank ( "borrow_cancel" ); // 检查权限
		$data ['id'] = $_REQUEST ['id'];
		$result = \borrowClass::GetOne ( $data );
		if ($result ['status'] == 5) {
			\borrowClass::open_flow ( $data );
			$msg = array (
					"开启流转成功"	
			);
		} else {$msg = array ("此标不是停止投标，不能开启");
		}
		$this->display ( $tpldir . 'borrow.tender.html', $msg );
	}
	public function stop_flow(){
		global $tpldir, $_G, $_A, $MsgInfo;
		check_rank ( "borrow_cancel" ); // 检查权限
		$data ['id'] =I('request.id');
		$result = \borrowClass::GetOne ( $data );
		if ($result ['status'] == 0 || $result ['status'] == 1 || $result ['status'] == 3) {
			\borrowClass::stop_flow ( $data );
			$msg = array ("停止流转成功");
		} else {
		$msg = array ("不能停止");
		}
		$this->display ( $tpldir . 'borrow.tender.html', $msg );
	}
	public function web_repay_no(){
		global $tpldir, $_G, $_A, $MsgInfo;
		$data=array();
		if($_REQUEST['keywords']!='')
			$data['keywords']=I('request.keywords');
		if($_REQUEST['dotime1']!='')
			$data['dotime1']=I('request.dotime1');
		if($_REQUEST['dotime2']!='')
			$data['dotime2']=I('request.dotime2');
		if($_REQUEST['dotime2']!='')
			$data['dotime2']=I('request.dotime2');
		if($_REQUEST['recover_status']!='')
			$data['recover_status']=I('request.recover_status');
		$data['borrow_status']=3;
		$data['order']='recover_status';
		$data['showtype']='web';
		$data['web']=1;
		$data['style']='web';
		$lists=\borrowClass::GetRecoverList($data);
		$this->display ( $tpldir . 'web_repay_no.html', $msg );
		
	}
	
}