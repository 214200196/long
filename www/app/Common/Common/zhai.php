<?php
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
