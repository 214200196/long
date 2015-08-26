<?php

namespace Common\Controller;

use Think\Controller;

class BaseController extends Controller {
	public function _initialize() {
		//echo 123;
		header ( "Content-Type: text/html; charset=utf-8" );
		global $_G;
		$system = array ();
		$system_name = array ();
		$_system = M ( "system" )->select ();
		foreach ( $_system as $key => $value ) {
			$system [$value ['nid']] = $value ['value'];
			$system_name [$value ['nid']] = $value ['name'];
		}
		
		$_G ['system'] = $system;
		$_G ['_system'] = $_system;
		$_G ["user_id"] = GetCookies ( array (
				"cookie_status" => $_G ['system'] ['con_cookie_status'] 
		) );
		$_G['weburl']=$_G['system']['con_weburl'];
		if ($_G ["user_id"] != "") {
			$_G ["user_result"] = \usersClass::GetUsers ( array (
					"user_id" => $_G ["user_id"] 
			) );
			
			$_G ["user_info"] = \usersClass::GetUsersInfo ( array (
					"user_id" => $_G ["user_id"] 
			) );
			// 短消息
			$_G ['message_result'] = \messageClass::GetUsersMessage ( array (
					"user_id" => $_G ["user_id"] 
			) );
		    
			// 积分
			$_G ['user_credit'] = \creditClass::GetUserCredit ( array (
					"user_id" => $_G ["user_id"] 
			) );
		}
		$_G ['credit'] ['class'] = \creditClass::GetClassList ( array (
				"limit" => "all" 
		) );
		foreach ( $_G ['credit'] ['class'] as $key => $value ) {
			$_G ['credit'] ['_class'] [$value ['id']] = $value ['name'];
		}
		$_G ['credit'] ['rank'] = \creditClass::GetRankList ( array (
				"limit" => "all" 
		) );
		// 联动模块
		$result = \linkagesClass::GetList ( array (
				"limit" => "all" 
		) );
		foreach ( $result as $key => $value ) {
			$_G ['linkages'] [$value ['type_nid']] [$value ['value']] = $value ['name'];
			$_G ['linkages'] [$value ['id']] = $value ['name'];
			if ($value ['type_nid'] != "") {
				$_G ['_linkages'] [$value ['type_nid']] [$value ['id']] = array (
						"name" => $value ['name'],
						"id" => $value ['id'],
						"value" => $value ['value'] 
				);
			}
		}
		$_G ['areas'] = \areasClass::GetAreas ( array (
				"limit" => "all" 
		) );
		$_G ['areas_city'] = \areasClass::GetCityAll ( array (
				"areas" => $_G ['areas'] 
		) );
		
		$result_zj = M('borrow_tender')->alias('p1')->join(presql('`{borrow}` as p2 on p2.borrow_nid =  p1.borrow_nid'))->where("p1.status=1 and p1.flow_status=0 and p1.flow_count >0 and p2.is_flow =1")->field('p1.*,p2.borrow_period,p2.user_id as b_user_id,p2.name as borrow_name')->select();
		foreach ( $result_zj as $key => $value ) {
			$nowtime = $value ["addtime"];
			$endtime = get_times_jh ( array (
					"num" => $value ["borrow_period"],
					"time" => $nowtime
			) );
			$borrow_nid = $value ["borrow_nid"];
			$tender_id = $value ["id"];
			$borrow_userid = $value ["b_user_id"];
			$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$value['borrow_nid'])." target=_blank>{$value['borrow_name']}</a>"; // 借款的地址
			$borrow_name = $value ['borrow_name'];
			if ($endtime <= time ()) {
				$result_recover = M('borrow_recover')->where("borrow_nid='{$borrow_nid}' and tender_id='{$tender_id}' and recover_status=0 ")->select();
				foreach ( $result_recover as $key_recover => $value_recover ) {
						
					$sql = "update  `{borrow_recover}` set recover_yestime='" . time () . "',recover_account_yes = recover_account ,recover_capital_yes = recover_capital ,recover_interest_yes = recover_interest ,status=1,recover_status=1 where id ={$value_recover['id']}";
					M()->execute(presql($sql));
						
					// 用户对借款标的还款
					$log_info ["user_id"] = $value_recover ['user_id']; // 操作用户id
					$log_info ["nid"] = "tender_repay_yes_" . $value_recover ['user_id'] . "_" . $borrow_nid . $value_recover ['id']; // 订单号
					$log_info ["money"] = $value_recover ['recover_account']; // 操作金额
					$log_info ["income"] = $value_recover ['recover_account']; // 收入
					$log_info ["expend"] = 0; // 支出
					$log_info ["balance_cash"] = $value_recover ['recover_account']; // 可提现金额
					$log_info ["balance_frost"] = 0; // 不可提现金额
					$log_info ["frost"] = 0; // 冻结金额
					$log_info ["await"] = - $value_recover ['recover_account']; // 待收金额
					$log_info ["type"] = "tender_repay_yes"; // 类型
					$log_info ["to_userid"] = $borrow_userid; // 付给谁
					$log_info ["remark"] = "[{$borrow_url}]流转借款标自动进行到期还款";
					zidong_AddLog ( $log_info );
						
					// 更新投资的信息
					$sql = "update  `{borrow_tender}` set recover_times=recover_times+1,recover_account_yes= recover_account_yes + {$value_recover['recover_account']},recover_account_capital_yes = recover_account_capital_yes  + {$value_recover['recover_capital']} ,recover_account_interest_yes = recover_account_interest_yes + {$value_recover['recover_interest']},recover_account_wait= recover_account_wait - {$value_recover['recover_account']},recover_account_capital_wait = recover_account_capital_wait  - {$value_recover['recover_capital']} ,recover_account_interest_wait = recover_account_interest_wait - {$value_recover['recover_interest']},flow_status=1  where id ={$value_recover['tender_id']}";
					M()->execute(presql($sql));
					
					$tender_fee = 0;
					UpdateBorrowCount_zidong ( array (
					"user_id" => $value_recover ['user_id'],
					"tender_recover_times_yes" => 1,
					"tender_recover_times_wait" => - 1,
					"tender_recover_yes" => $value_recover ['recover_account'],
					"tender_recover_wait" => - $value_recover ['recover_account'],
					"tender_capital_yes" => $value_recover ['recover_capital'],
					"tender_capital_wait" => - $value_recover ['recover_capital'],
					"tender_interest_yes" => $value_recover ['recover_interest'],
					"tender_interest_wait" => - $value_recover ['recover_interest'],
					"fee_account" => $tender_fee,
					"fee_tender_account" => $tender_fee
					) );
						
					$repay_account = $value_recover ['recover_account'];
					$repay_capital = $value_recover ['recover_capital'];
					$repay_interest = $value_recover ['recover_interest'];
					// 添加最后的还款金额
					$sql = "update `{borrow}` set repay_account_yes= repay_account_yes + {$repay_account},repay_account_capital_yes= repay_account_capital_yes + {$repay_capital},repay_account_interest_yes= repay_account_interest_yes + {$repay_interest},repay_account_wait= repay_account_wait - {$repay_account},repay_account_capital_wait= repay_account_capital_wait - {$repay_capital},repay_account_interest_wait= repay_account_interest_wait - {$repay_interest} where borrow_nid='{$borrow_nid}'";
					M()->execute(presql($sql));
						
					$credit_blog ['user_id'] = $value_recover ['user_id'];
					$credit_blog ['nid'] = "tender_repay_time";
					$credit_blog ['code'] = "borrow";
					$credit_blog ['type'] = "tender";
					$credit_blog ['addtime'] = time ();
					$credit_blog ['article_id'] = $value_recover ['id'];
					$credit_blog ['remark'] = "收到借款[{$borrow_url}]完整本息还款积分";
					zidong_ActionCreditLog ( $credit_blog );
						
					$sql = "update `{borrow_repay}` set repay_status=0,repay_yestime='" . time () . "',repay_account_yes=repay_account_yes+{$repay_account},repay_interest_yes=repay_interest_yes+{$repay_interest},repay_capital_yes=repay_capital_yes+{$repay_capital} where repay_period ='{$value_recover['recover_period']}' and borrow_nid='{$borrow_nid}' ";
					M()->execute(presql($sql));
				}
			}
		}
		
		$sql = "update `{borrow_repay}` set repay_status=1 where repay_account=repay_account_yes and repay_account > 0 ";
		M()->execute(presql($sql));
		function zidong_ActionCreditLog($data) {
			$_nid = explode ( ",", $data ['nid'] );
		
			// 第一步先删除没有的积分记录
			$_sql = "delete from `{credit_log}` where code='{$data['code']}'  and type='{$data['type']}' and article_id='{$data['article_id']}' and nid not in ('{$data['nid']}')";
			M()->execute(presql($sql));
		
			// 第二步加入资金记录
			if (count ( $_nid ) > 0) {
				foreach ( $_nid as $key => $nid ) {
					if ($nid != "") {
						if (isset ( $data ['value'] ) && $data ['value'] != "") {
							$_value = $data ['value'];
						} else {
							$result =M('credit_type')->where("nid='{$nid}'")->field('value')->find();
							$_value = $result ['value'];
						}
		
						$sql = "insert into `{credit_log}` set code='{$data['code']}',user_id={$data['user_id']},`value`='{$_value}',`credit`='{$_value}',type='{$data['type']}',article_id='{$data['article_id']}',nid='{$nid}',addtime='{$data['addtime']}',remark='{$data['remark']}'";
						M()->execute(presql($sql));
					}
				}
				zidong_ActionCredit ( array (
				"user_id" => $data ['user_id']
				) );
			}
		}
		function zidong_ActionCredit($data) {
			$result = M('credit_log')->join(presql('`{credit_type}` as p2 on p1.nid=p2.nid'))->where("p1.user_id={$data['user_id']}")->field('sum(p1.credit) as num,p2.class_id')->order('p2.class_id desc')->group('p2.class_id')->select();
			$credits = serialize ( $result );
			$result = M('credit')->where("user_id={$data['user_id']}")->find();
			if ($result == null) {
				$sql = "insert into `{credit}` set user_id={$data['user_id']},`credits`='{$credits}'";
			} else {
				$sql = "update `{credit}` set `credits`='{$credits}' where user_id={$data['user_id']}";
			}
			M()->execute(presql($sql));
			zidong_CountCredit ( array (
			"user_id" => $data ['user_id'],
			"type" => "catoreasy"
					) );
		}
		function zidong_CountCredit($data) {
			if ($data ['type'] == "catoreasy") {
				$result = zidong_GetBorrowCredit ( array (
						"user_id" => $data ['user_id']
				) );
				$sql = "update `{credit}` set credit='{$result['credit_total']}' where user_id={$data['user_id']}";
				M()->execute(presql($sql));
			}
		}
		function zidong_GetBorrowCredit($data) {
			global  $_G;
		
			if (IsExiest ( $_G ["borrow_credit_result"] ) != false)
				return $_G ["borrow_credit_result"]; // 防止重复读取\
		
			if ($data ['user_id'] == "")
				return false;
		
			$_result = array ();
			
			$attcredit = \attestationsClass::GetAttestationsCredit ( array (
					"user_id" => $data ['user_id']
			) );
		
			
			$credit_log = M('credit_log')->where("user_id={$data['user_id']} and code='borrow'")->field('sum(credit) as creditnum')->find();
			$approve = M('credit_log')->where("user_id={$data['user_id']} and code='approve'")->field('sum(credit) as creditnum')->find();
			$_result [1] = $attcredit;
			$_result [2] = $credit_log ['creditnum'];
			$_result [3] = $approve ['creditnum'];
		
			$result = array (
					"credit_total" => $_result [2] + $_result [1] + $_result [3],
					"borrow_credit" => $_result [2],
					"approve_credit" => $_result [3] + $_result [1]
			);
		
			return $result;
		}
		function zidong_AddLog($data = array()) {
			
			// 第一步，查询是否有资金记录
			$result = M('account_log')->where("`nid` = '{$data['nid']}'")->find();
			if ($result  != null)
				return "account_log_nid_exiest";
		
			// 第二步，查询原来的总资金
			$result = M('account')->where("user_id={$data['user_id']}")->find();
			if ($result == null) {
				$sql = "insert into `{account}` set user_id={$data['user_id']},total=0";
				M()->execute(presql($sql));
				$result =  M('account')->where("user_id={$data['user_id']}")->find();
			}
		
			// 第三步，加入用户的财务记录
			$sql = "insert into `{account_log}` set ";
		
			$sql .= "nid='{$data['nid']}',";
			$sql .= "user_id='{$data['user_id']}',";
			$sql .= "type='{$data['type']}',";
			$sql .= "money='{$data['money']}',";
			$sql .= "remark='{$data['remark']}',";
			$sql .= "to_userid='{$data['to_userid']}',";
		
			$sql .= "balance_cash_new='{$data['balance_cash']}',";
			$sql .= "balance_cash_old='{$result['balance_cash']}',";
			$sql .= "balance_cash=balance_cash_new+balance_cash_old,";
		
			$sql .= "balance_frost_new='{$data['balance_frost']}',";
			$sql .= "balance_frost_old='{$result['balance_frost']}',";
			$sql .= "balance_frost=balance_frost_new+balance_frost_old,";
		
			$sql .= "balance_new=balance_cash_new+balance_frost_new,";
			$sql .= "balance_old='{$result['balance']}',";
			$sql .= "balance=balance_new+balance_old,";
		
			$sql .= "income_new='{$data['income']}',";
			$sql .= "income_old='{$result['income']}',";
			$sql .= "income=income_new+income_old,";
		
			$sql .= "expend_new='{$data['expend']}',";
			$sql .= "expend_old='{$result['expend']}',";
			$sql .= "expend=expend_new+expend_old,";
		
			$sql .= "frost_new='{$data['frost']}',";
			$sql .= "frost_old='{$result['frost']}',";
			$sql .= "frost=frost_new+frost_old,";
		
			$sql .= "await_new='{$data['await']}',";
			$sql .= "await_old='{$result['await']}',";
			$sql .= "await=await_new+await_old,";
		
			$sql .= "total_old='{$result['total']}',";
			$sql .= "total=balance+frost+await,";
			$sql .= " `addtime` = '" . time () . "',`addip` = '" . get_client_ip() . "'";
			M()->execute(presql($sql));
			$id = M()->getLastInsID();
			$result = M('account_log')->where("user_id={$data['user_id']} and id={$id}")->find();
		
			// 第四步，更新用户表
			$sql = "update `{account}` set income={$result['income']},expend='{$result['expend']}',";
			$sql .= "balance_cash={$result['balance_cash']},balance_frost={$result['balance_frost']},";
			$sql .= "frost={$result['frost']},";
			$sql .= "await={$result['await']},";
			$sql .= "balance={$result['balance']},";
			$sql .= "total={$result['total']}";
			$sql .= " where user_id='{$data['user_id']}'";
			M()->execute(presql($sql));
		
			// 第三步，加入网站的总费用
			$result = M('account_balance')->where("`nid` = '{$data['nid']}'")->find();
			if ($result == null) {
				// 加入网站的财务表
				$result = M('account_balance')->order('id desc')->find();
				if ($result == null) {
					$result ['total'] = 0;
					$result ['balance'] = 0;
				}
				$total = $result ['total'] + $data ['income'] + $data ['expend'];
				$sql = "insert into `{account_balance}` set total='{$total}',balance={$result['balance']}+" . $data ['income'] . "-" . $data ['expend'] . ",income='{$data['income']}',expend='{$data['expend']}',type='{$data['type']}',`money`='{$data['money']}',user_id={$data['user_id']},nid='{$data['nid']}',remark='{$data['remark']}', `addtime` = '" . time () . "',`addip` = '" . get_client_ip() . "'";
				M()->execute(presql($sql));
			}
		
			// 第三步，加入用户的总费用
			
			$result = M('account_users')->where("`nid` = '{$data['nid']}'")->find();
			if ($result == null) {
				// 加入用户的财务表
				$result = M('account_users')->where("user_id={$data['user_id']}")->order('id desc')->find();
				if ($result == false) {
					$result ['total'] = 0;
					$result ['balance'] = 0;
				}
				$total = $result ['total'] + $data ['income'] + $data ['expend'];
				$sql = "insert into `{account_users}` set total='{$total}',balance={$result['balance']}+" . $data ['income'] . "-" . $data ['expend'] . ",income='{$data['income']}',expend='{$data['expend']}',type='{$data['type']}',`money`='{$data['money']}',user_id={$data['user_id']},nid='{$data['nid']}',remark='{$data['remark']}', `addtime` = '" . time () . "',`addip` = '" . get_client_ip() . "',await='{$data['await']}',frost='{$data['frost']}'";
				M()->execute(presql($sql));
			}
		
			return $data ['nid'];
		}
		
		function UpdateBorrowCount_zidong($data = array()) {
			if ($data ['user_id'] == "")
				return "";
			$user_id = $data ['user_id'];
			$result=M('borrow_count')->where("user_id={$data['user_id']}")->find();
			if ($result == null) {
				$sql = "insert into `{borrow_count}` set user_id={$data['user_id']}";
				M()->execute(presql($sql));
			}
			M('borrow_count')->where("user_id={$user_id}")->save($data);
			
			return "";
		}
		
	}
	protected function uploads($file, $dir) {
		$upload = new \Think\Upload (); // 实例化上传类
		$upload->maxSize = 3145728; // 设置附件上传大小
		$upload->exts = array (
				'jpg',
				'gif',
				'png',
				'jpeg' 
		); // 设置附件上传类型
		$upload->rootPath = './';
		$upload->savePath = "/uploads/$dir/"; // 设置附件上传目录 // 上传单个文件
		$info = $upload->uploadOne ( $_FILES [$file] );
		if (! $info) { // 上传错误提示错误信息
			$this->error ( $upload->getError () );
		} else { // 上传成功 获取上传文件信息
			return $info;
		}
	}
	public function verify() {
		$Verify = new \Think\Verify ();
		$Verify->fontSize = 14;
		$Verify->useCurve = false;
		
		$Verify->length = 4;
		$Verify->useNoise = false;
		$Verify->entry ();
	}
	protected function upfiles($file, $dir, $data = array()) {
		if (empty ( $_FILES [$file] ['name'] )) {
			return '';
		}
		$info = $this->uploads ( $file, $dir );
		$data ['name'] = $info ['name'];
		$data ['filesize'] = $info ['size'];
		$data ['filetype'] = $info ['ext'];
		$data ['fileurl'] = $info ['savepath'] . $info ['savename'];
		$data ['filename'] = $info ['savename'];
		$data ['addtime'] = time ();
		$data ['updatetime'] = time ();
		$data ['addip'] = get_client_ip ();
		$data ['updateip'] = get_client_ip ();
		$upfiles_id = M ( 'users_upfiles' )->add ( $data );
		$result ['upfiles_id'] = $upfiles_id;
		$result ['filename'] = $data ['fileurl'];
		return $result;
	}
	protected function updelet($data) {
		$_sql = "id={$data['id']} ";
		if (isset ( $data ['user_id'] ) && $data ['user_id'] != "") {
			$_sql .= " and user_id={$data['user_id']}";
		}
		$result = M ( 'users_upfiles' )->where ( $_sql )->find ();
		if ($result != null) {
			$_dir = explode ( $result ['filename'], $result ['fileurl'] );
			$this->delPic ( $_dir [0], $result ['filename'] );
			M ( 'users_upfiles' )->where ( $_sql )->delete ();
		}
	}
	protected function delPic($dir, $filename) {
		$_filename = substr ( $filename, 0, strlen ( $filename ) - 4 );
		if (is_dir ( $dir )) {
			$dh = opendir ( $dir );
			while ( false !== ($file = readdir ( $dh )) ) {
				if ($file != "." && $file != "..") {
					$fullpath = $dir . "/" . $file;
					$_url = explode ( $_filename, $file );
					if (! is_dir ( $fullpath ) && isset ( $_url [0] ) && $_url [0] == "") {
						unlink ( $fullpath );
					}
				}
			}
			closedir ( $dh );
		}
	}
}