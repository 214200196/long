<?php

namespace Index\Controller;

class RatingController extends HomeController {
	public function basic() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"sex",
					"marry",
					"children",
					"income",
					"birthday",
					"edu",
					"is_car",
					"address",
					"school_year",
					"school",
					"house",
					"phone",
					"province",
					"city",
					"area",
					"realname",
					"card_id",
					"phone_num" 
			);
			$data = post_var ( $var );
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 1;
			$result = \ratingClass::GetInfoOne ( $data );
			if (is_array ( $result )) {
				$_result = \ratingClass::UpdateInfo ( $data );
			} else {
				$_result = \ratingClass::AddInfo ( $data );
			}
			if ($_result > 0) {
				$cre_result = M ( 'credit_log' )->where ( "user_id={$data['user_id']} and type='info_credit'" )->find ();
				if ($cre_result == null) {
					$credit_log ['user_id'] = $data ['user_id'];
					$credit_log ['nid'] = "info_credit";
					$credit_log ['code'] = "approve";
					$credit_log ['type'] = "info_credit";
					$credit_log ['addtime'] = time ();
					$credit_log ['article_id'] = $data ['user_id'];
					$credit_log ['remark'] = "填写个人详情获得的积分";
					\creditClass::ActionCreditLog ( $credit_log );
				}
				
					
					$msg = array (
							"提交成功" 
					)
					;
				
			} else {
				$msg = array (
						"提交失败" 
				);
			}
		} else {
			$data ['user_id'] = $_G ['user_id'];
			$result = \ratingClass::GetInfoOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			}
		}
		$var = \ratingClass::GetInfoOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		if (is_array ( $var ))
			$this->assign ( 'ivar', $var );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function job() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"name",
					"type",
					"industry",
					"peoples",
					"worktime1",
					"office",
					"address",
					"tel" 
			);
			$data = post_var ( $var );
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 1;
			$result = \ratingClass::GetJobOne ( $data );
			if (is_array ( $result )) {
				$_result = \ratingClass::UpdateJob ( $data );
			} else {
				$_result = \ratingClass::AddJob ( $data );
				$sql = "select * from `{}` where ";
				$cre_result = M ( 'credit_log' )->where ( "user_id={$data['user_id']} and type='work_credit'" )->find ();
				if ($cre_result == null) {
					$credit_log ['user_id'] = $data ['user_id'];
					$credit_log ['nid'] = "work_credit";
					$credit_log ['code'] = "approve";
					$credit_log ['type'] = "work_credit";
					$credit_log ['addtime'] = time ();
					$credit_log ['article_id'] = $data ['user_id'];
					$credit_log ['remark'] = "填写工作信息获得的积分";
					\creditClass::ActionCreditLog ( $credit_log );
				}
			}
			if ($_result > 0) {
				if ($_POST ['web'] == "amount") {
					echo "<script>location.href='/amount_finance/index.html'</script>";
				} elseif ($_POST ['web'] == "borrow") {
					echo "<script>location.href='/borrow_finance/index.html'</script>";
				} else {
					$msg = array (
							"提交成功" 
					);
				}
			} else {
				$msg = array (
						"提交失败" 
				);
			}
		} else {
			$data ['user_id'] = $_G ['user_id'];
			$result = \ratingClass::GetJobOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			}
		}
		$var = \ratingClass::GetJobOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		if (is_array ( $var ))
			$this->assign ( 'ivar', $var );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function company() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"name",
					"license_num",
					"tax_num_di",
					"tax_num_guo",
					"address",
					"rent_time",
					"rent_money",
					"hangye",
					"people",
					"time" 
			);
			$data = post_var ( $var );
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 1;
			$result = \ratingClass::GetCompanyOne ( $data );
			if (is_array ( $result )) {
				$_result = \ratingClass::UpdateCompany ( $data );
			} else {
				$_result = \ratingClass::AddCompany ( $data );
				$sql = "select * from `{}` where ";
				$cre_result = M ( 'credit_log' )->where ( "user_id={$data['user_id']} and type='work_credit'" )->find ();
				if ($cre_result == null) {
					$credit_log ['user_id'] = $data ['user_id'];
					$credit_log ['nid'] = "work_credit";
					$credit_log ['code'] = "approve";
					$credit_log ['type'] = "work_credit";
					$credit_log ['addtime'] = time ();
					$credit_log ['article_id'] = $data ['user_id'];
					$credit_log ['remark'] = "填写工作信息获得的积分";
					\creditClass::ActionCreditLog ( $credit_log );
				}
			}
			if ($_result > 0) {
				if ($_POST ['web'] == "amount") {
					echo "<script>location.href='/amount_finance/index.html'</script>";
				} elseif ($_POST ['web'] == "borrow") {
					echo "<script>location.href='/borrow_finance/index.html'</script>";
				} else {
					$msg = array (
							"提交成功" 
					);
				}
			} else {
				$msg = array (
						"提交失败" 
				);
			}
		} else {
			$data ['user_id'] = $_G ['user_id'];
			$result = \ratingClass::GetCompanyOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			}
		}
		$var = \ratingClass::GetCompanyOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		if (is_array ( $var ))
			$this->assign ( 'ivar', $var );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function finance() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if ($_REQUEST ['del'] != "") {
			$data ['id'] =I('request.del');
			$data ['user_id'] = $_G ['user_id'];
			$result = \ratingClass::DelFinance ( $data );
			if ($result > 0) {
				if ($_REQUEST ['type'] == "amount") {
					$msg = array (
							"删除成功" 
					);
				} elseif ($_REQUEST ['type'] == "borrow") {
					$msg = array (
							"删除成功" 
					);
				} else {
					$msg = array (
							"删除成功" 
					);
				}
			} else {
				$msg = array (
						"删除失败" 
				);
			}
		}
		$ilist = \ratingClass::GetFinanceList ( array (
				'user_id' => $_G ['user_id'],
				'use_type' => 1,
				'limit' => 'all' 
		) );
		$elist = \ratingClass::GetFinanceList ( array (
				'user_id' => $_G ['user_id'],
				'use_type' => 2,
				'limit' => 'all' 
		) );
		$this->assign ( 'ilist', $ilist );
		$this->assign ( 'elist', $elist );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function contact() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"linkman2",
					"linkman3",
					"linkman4",
					"linkman5",
					"linkman6",
					"linkman8",
					"phone2",
					"phone3",
					"phone4",
					"phone5",
					"phone6",
					"phone8" 
			);
			$data = post_var ( $var );
			$array = $data;
			unset ( $array ['phone5'] );
			unset ( $array ['linkman5'] );
			foreach ( $array as $key => $value ) {
				if ($value == "") {
					unset ( $array [$key] );
				}
			}
			if (count ( $array ) != count ( array_unique ( $array ) )) {
				if ($_POST ['web'] == "amount") {
					$msg = array (
							"除紧急联系人，不能有重复值" 
					);
				} elseif ($_POST ['web'] == "borrow") {
					$msg = array (
							"除紧急联系人，不能有重复值" 
					);
				} else {
					$msg = array (
							"除紧急联系人，不能有重复值" 
					);
				}
			} else {
				$data ['user_id'] = $_G ['user_id'];
				$data ['status'] = 1;
				$result = \ratingClass::GetContactOne ( $data );
				
				if (is_array ( $result )) {
					$_result = \ratingClass::UpdateContact ( $data );
				} else {
					$_result = \ratingClass::AddContact ( $data );
				}
				if ($_result > 0) {
					
					$cre_result = M ( 'credit_log' )->where ( "user_id={$data['user_id']} and type='contact_credit'" )->find ();
					if ($cre_result == null) {
						$credit_log ['user_id'] = $data ['user_id'];
						$credit_log ['nid'] = "contact_credit";
						$credit_log ['code'] = "approve";
						$credit_log ['type'] = "contact_credit";
						$credit_log ['addtime'] = time ();
						$credit_log ['article_id'] = $data ['user_id'];
						$credit_log ['remark'] = "填写主要联系人获得的积分";
						\creditClass::ActionCreditLog ( $credit_log );
					}
					if ($_POST ['web'] == "amount") {
						echo "<script>location.href='/amount_contact/index.html'</script>";
					} elseif ($_POST ['web'] == "borrow") {
						echo "<script>location.href='/borrow_contact/index.html'</script>";
					} else {
						$msg = array (
								"提交成功",
								
						);
					}
				} else {
					$msg = array (
							"提交失败",
					
					);
				}
			}
		} else {
			$data ['user_id'] = $_G ['user_id'];
			$result = \ratingClass::GetContactOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			}
		}
		$var = \ratingClass::GetContactOne ( array (
				'user_id' => $_G ['user_id'] 
		) );
		if (is_array ( $var ))
			$this->assign ( 'ivar', $var );
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function addrevenue() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"type",
					"use_type",
					"name",
					"account",
					"other" 
			);
			$data = post_var ( $var );
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 1;
			if (isset ( $_REQUEST ['edit'] )) {
				$data ['id'] = $_REQUEST ['edit'];
				$_result = \ratingClass::UpdateFinance ( $data );
			} else {
				$_result = \ratingClass::AddFinance ( $data );
			}
			if ($_result > 0) {
				if ($_POST ['web'] == "amount") {
					echo "<script>location.href='/amount_finance/index.html'</script>";
				} elseif ($_POST ['web'] == "borrow") {
					echo "<script>location.href='/borrow_finance/index.html'</script>";
				} else {
					
					$msg = array (
							"提交成功" 
					);
				}
			} else {
				$msg = array (
						"提交失败" 
				);
			}
		} elseif (isset ( $_REQUEST ['edit'] )) {
			$data ['id'] = $_REQUEST ['edit'];
			$result = \ratingClass::GetFinanceOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			} else {
				if ($_REQUEST ['type'] == "amount") {
					$msg = array (
							"读取失败" 
					);
				} else {
					$msg = array (
							"读取失败" 
					);
				}
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
	public function addpayment() {
		global $_G, $tpldir, $_U, $MsgInfo;
		if (isset ( $_POST ['submit'] )) {
			$var = array (
					"type",
					"use_type",
					"name",
					"account",
					"other" 
			);
			$data = post_var ( $var );
			$data ['user_id'] = $_G ['user_id'];
			$data ['status'] = 1;
			if (isset ( $_REQUEST ['edit'] )) {
				$data ['id'] = $_REQUEST ['edit'];
				$_result = \ratingClass::UpdateFinance ( $data );
			} else {
				$_result = \ratingClass::AddFinance ( $data );
			}
			if ($_result > 0) {
				if ($_POST ['web'] == "amount") {
					echo "<script>location.href='/amount_finance/index.html'</script>";
				} elseif ($_POST ['web'] == "borrow") {
					echo "<script>location.href='/borrow_finance/index.html'</script>";
				} else {
					
					$msg = array (
							"提交成功" 
					);
				}
			} else {
				$msg = array (
						"提交失败" 
				);
			}
		} elseif (isset ( $_REQUEST ['edit'] )) {
			$data ['id'] = $_REQUEST ['edit'];
			$result = \ratingClass::GetFinanceOne ( $data );
			if (is_array ( $result )) {
				$_U ["rating_result"] = $result;
			} else {
				if ($_REQUEST ['type'] == "amount") {
					$msg = array (
							"读取失败" 
					);
				} else {
					$msg = array (
							"读取失败" 
					);
				}
			}
		}
		define ( 'THEME_PATH', $tpldir );
		layout ( 'user_main' );
		$this->display ( $tpldir . 'user_rating.html', $msg, 'user_header.html' );
	}
}