
<?php
if (!defined ( 'ROOT_PATH')) die ( '不能访问');
global $MsgInfo;
require_once (ROOT_PATH ."modules/borrow.model.php");
require_once (ROOT_PATH ."modules/borrow.calculate.php");
class borrowClass extends amountClass 
{
	public static function GetTenderTop($data = array())
	{
		global $_G;
		$_sql = "1=1 ";
		$_sql .= " and p1.status=1";
		if(IsExiest ( $data ['type'] ) != false)
		{
			if($data ['type']=='week')
			{
				$week=date('w');
				if($week!=0)
				{
					$qtime=time()-24*60*60*$week;
					$_sql.=" and p1.`addtime`>$qtime";
				}
				else
				{
					$qtime=time()-24*60*60*7;
					$_sql.=" and p1.`addtime`>$qtime";
				}
			}
			elseif($data ['type']=='moth')
			{
				$qtime=get_mktime(date('Y-m'));
				$_sql.=" and p1.`addtime`>$qtime";
			}
			else
			{
				$qtime=mktime(0,0,0,1,1,date('Y'));
				$_sql.=" and p1.`addtime`>$qtime";
			}
		}
		$field='p1.user_id,p2.username,sum(p1.account_tender) as totel,p3.niname ';
		$_order='totel desc ';
		if (IsExiest ( $data ['limit'] ) != false) 
		{
			if ($data ['limit'] != "all") 
			{
				$_limit =$data ['limit'];
			}
			$reuslt=M('borrow_tender')->alias('p1')->join(presql('`{users}` as p2 on p2.user_id =p1.user_id'))->join(presql('`{users_info}` as p3 on p3.user_id =p1.user_id'))->where($_sql)->field($field)->order($_order)->group('p1.user_id')->limit($_limit)->select();
			return $reuslt;
		}
	}
	public static function Getborrow_count_List($data = array()) 
	{
		global $_G;
		if (isset ( $data ['limit'] ) &&$data ['limit'] >0) 
		{
			$limit = $data ['limit'];
		}
		$_list = M('borrow_count')->alias('p1')->join(presql('`{users}` as p2 on p2.user_id =p1.user_id'))->field('p1.tender_success_account,p2.username')->order('p1.tender_success_account desc')->limit($limit)->select();
		return $_list;
	}
	public static function Getborrow_count_List_interest($data = array()) 
	{
		global $_G;
		if (isset ( $data ['limit'] ) &&$data ['limit'] >0) 
		{
			$limit = "limit ".$data ['limit'];
		}
		$sql = "SELECT (n.tender_interest_yes + ifnull((SELECT sum(money) AS num FROM `{account_log}` WHERE user_id = n.user_id AND `type` = 'tender_award_add'),0)  ) AS tender_interest_yes_g,n.username FROM (SELECT t.tender_interest_yes,t.user_id,u.username FROM `{borrow_count}` t ,`{users}` u where t.user_id=u.user_id) AS n ORDER BY tender_interest_yes_g DESC $limit ";
		$_list = M()->execute(presql($sql));
		return $_list;
	}
	public static function Getuser_zong($data = array()) 
	{
		$result = M ( 'users')->count ();
		$_result ['user_num'] = $result;
		$sql = "select sum(account) as sum from `{borrow}`  where status=3 and is_flow!=1";
		$result = M ( 'borrow')->where ( 'status=3 and is_flow!=1')->field ( 'sum(account) as sum ')->find ();
		$borrow_all = $result ['sum'];
		$sql = "select sum(borrow_account_yes) as sum from `{borrow}`  where is_flow=1";
		$result = M ( 'borrow')->where ( 'is_flow=1')->field ( 'sum(borrow_account_yes) as sum ')->find ();
		$borrow_all += $result ['sum'];
		$_result ['borrow_all'] = number_format ( $borrow_all );
		$_result ['borrow_all_arr'] = str_split ( $_result ['borrow_all'] );
		$latesql = "select sum(p2.late_interest) as all_late_interest from `{borrow_tender}` as p1 , `{borrow_recover}` as p2  where p1.change_status=0 or  p1.change_status=1";
		$late = M ()->table ( presql ( '{borrow_tender}  p1 , {borrow_recover}  p2') )->where ( 'p1.change_status=0 or  p1.change_status=1')->field ( 'sum(p2.late_interest) as all_late_interest')->find ();
		$_result ['all_late_interest'] = $late ['all_late_interest'];
		$result = M ( 'account_log')->where ( "`type` = 'tender_award_add'")->field ( 'sum( money ) AS num')->find ();
		$_result ['award_add'] = $result ['num'];
		$sql = "select sum(repay_account_interest_yes) as sum from `{borrow}` ";
		$result = M ( 'borrow')->field ( 'sum(repay_account_interest_yes) as sum')->find ();
		$_result ['repay_account_interest_yes'] = $result ['sum'];
		$_result ['Total_revenue'] = $_result ['repay_account_interest_yes'] +$_result ['award_add'] +$_result ['all_late_interest'];
		$_result ['Total_revenue'] = number_format ( $_result ['Total_revenue'] );
		$_result ['Total_revenue_arr'] = str_split ( $_result ['Total_revenue'] );
		$sql = "select count(account) as num from `{borrow}` where (status=3 or is_flow=1)";
		$result = M ( 'borrow')->where ( 'status=3 or is_flow=1')->field ( 'count(account) as num')->find ();
		$_result ['borrow_yestimes'] = $result ['num'];
		$_result ['borrow_yestimes_arr'] = str_split ( $_result ['borrow_yestimes'] );
		$sql = "select sum(repay_account_yes) as num from `{borrow}` where 1=1";
		$result = M ( 'borrow')->field ( 'sum(repay_account_yes) as num')->find ();
		$_result ['borrow_repay_account_yes'] = $result ['num'];
		$sql = "select count(*) as num from `{borrow_repay}` where repay_status =0 and repay_time<'".time () ."' group by borrow_nid ";
		$result = M ( 'borrow_repay')->where ( " repay_status =0 and repay_time<'".time () ."'")->group ( 'borrow_nid')->field ( 'count(*) as num')->find ();
		$_result ['borrow_repay_late'] = $result ['num'];
		$beginToday = mktime ( 0,0,0,date ( 'm'),date ( 'd'),date ( 'Y') );
		$endToday = mktime ( 0,0,0,date ( 'm'),date ( 'd') +1,date ( 'Y') ) -1;
		$beginYesterday = mktime ( 0,0,0,date ( 'm'),date ( 'd') -1,date ( 'Y') );
		$endYesterday = mktime ( 0,0,0,date ( 'm'),date ( 'd'),date ( 'Y') ) -1;
		$beginAfterthreeday = mktime ( 0,0,0,date ( 'm'),date ( 'd'),date ( 'Y') );
		$endAfterthreeday = mktime ( 0,0,0,date ( 'm'),date ( 'd') +1,date ( 'Y') ) -1;
		$sql = "select sum(account) as num from `{borrow_tender}` where addtime>=$beginYesterday and  addtime<= $endYesterday";
		$result = M ( 'borrow_tender')->where ( "addtime>=$beginYesterday and  addtime<= $endYesterday")->field ( 'sum(account) as num')->find ();
		$_result ['borrow_Yesterday_num'] = $result ['num'];
		$sql = "select sum(account) as num from `{borrow_tender}` where addtime>=$beginToday and  addtime<= $endToday";
		$result = M ( 'borrow_tender')->where ( "addtime>=$beginToday and  addtime<= $endToday")->field ( 'sum(account) as num')->find ();
		$_result ['borrow_Today_num'] = $result ['num'];
		$sql = "select sum(repay_account-repay_account_yes) as num  from `{borrow_repay}` where repay_status=0 and repay_time>=$beginToday and  repay_time<= $endToday  ";
		$result = M ( 'borrow_repay')->where ( $where )->field ( 'sum(repay_account-repay_account_yes) as num')->find ();
		$_result ['borrow_Today_repay_num'] = $result ['num'];
		$sql = "select sum(repay_account-repay_account_yes) as num  from `{borrow_repay}` where repay_status=0 and repay_time>=$beginAfterthreeday and  repay_time<= $endAfterthreeday  ";
		$result = M ( 'borrow_repay')->where ( "repay_status=0 and repay_time>=$beginAfterthreeday and  repay_time<= $endAfterthreeday")->field ( 'sum(repay_account-repay_account_yes) as num')->find ();
		$_result ['borrow_Today_Afterthree_num'] = $result ['num'];
		$sql = "select count(*) as num from `{borrow}` where 1=1 group by user_id ";
		$result = M ( 'borrow')->field ( 'count(*) as num')->group ( 'user_id')->find ();
		$_result ['borrow_user_num'] = $result ['num'];
		$sql = "select sum(repay_account-repay_account_yes) as num from `{borrow_repay}` where repay_status=0 ";
		$result = M ( 'borrow_repay')->where ( 'repay_status=0')->field ( 'sum(repay_account-repay_account_yes) as num')->find ();
		$_result ['borrow_repay_late_not'] = $result ['num'];
		$sql = "select sum(repay_account) as num from `{borrow_repay}` where repay_status =0 and repay_time<'".time () ."'";
		$result = M ( 'borrow_repay')->where ( " repay_status =0 and repay_time<'".time () ."'")->field ( 'sum(repay_account) as num')->find ();
		$_result ['borrow_repay_account_late'] = $result ['num'];
		$sql = "select sum(money) as num from `{account_web}` where type  ='web_repay' ";
		$result = M ( 'account_web')->where ( "type  ='web_repay'")->field ( 'sum(money) as num')->find ();
		$_result ['borrow_repay_late_web'] = $result ['num'];
		return $_result;
	}
	public static function GetSecond($data = array()) 
	{
		$result = M ( 'borrow_tender')->where ( "user_id={$data['user_id']}
	and borrow_nid='{$data['borrow_nid']}
'")->find ();
if ($result == false ||$result == NULL) return 0;
return 1;
}
public static function Add($data = array()) 
{
global $_G;
if ($data ['is_Seconds'] == 1) 
{
	$account_result = \accountClass::GetAccountUsers ( array ( "user_id"=>$data ['user_id'] ) );
	$moeSeconds = round ( ($data ['account'] / 100 * $data ['borrow_apr']) / 12,2 );
	if ($account_result ['balance'] <$moeSeconds) 
	{
		return "borrow_Seconds_no";
	}
}
$flow_result = self::GetFlowOne_h ( array ( "user_id"=>$data ['user_id'] ) );
if ($flow_result ['status'] != 1 &&$data ['is_flow'] == 1) 
{
	return "borrow_flow_status";
}
if (!IsExiest ( $data ['user_id'] )) 
{
	return "borrow_user_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
	return "borrow_name_empty";
}
if (!IsExiest ( $data ['account'] )) 
{
	return "borrow_account_empty";
}
if ($data ['borrow_type'] == "jin") 
{
	$account_result = \accountClass::GetAccountUsers ( array ( "user_id"=>$data ['user_id'] ) );
	if ($data ['account'] >$account_result ['total']) 
	{
		return "borrow_account_jin_credituse";
	}
}
else 
{
	$result = self::GetAmountUsers ( array ( "user_id"=>$data ["user_id"] ) );
	if ($data ['account'] >$result ['borrow_amount']) 
	{
		return "borrow_account_over_credituse";
	}
}
$result = M ( 'borrow')->where ( "user_id={$data['user_id']}
and status=0")->count ();
if ($result >0) 
{
return "borrow_is_exist";
}
$max = isset ( $_G ['system'] ['con_borrow_maxaccount'] ) ?$_G ['system'] ['con_borrow_maxaccount'] : "2000000";
if ($data ['account'] >$max) 
{
return "borrow_account_over_max";
}
$min = isset ( $_G ['system'] ['con_borrow_minaccount'] ) ?$_G ['system'] ['con_borrow_minaccount'] : "50";
if ($data ['account'] <$min) 
{
return "borrow_account_over_min";
}
if (!IsExiest ( $data ['borrow_apr'] )) 
{
return "borrow_apr_empty";
}
$apr = isset ( $_G ['system'] ['con_borrow_apr_highest'] ) ?$_G ['system'] ['con_borrow_apr_highest'] : "22.18";
if ($data ['borrow_apr'] >$apr) 
{
return "borrow_apr_over_max";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$inid = M ( 'borrow')->add ( $data );
if ($data ['is_Seconds'] == 1) 
{
$log_info ["user_id"] = $data ["user_id"];
$log_info ["nid"] = "borrow_success_manage_".time () ."_".$inid;
$log_info ["money"] = $moeSeconds;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = -$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = $moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "操作秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
return $inid;
}
public static function AddBorrowVouch($data = array()) 
{
global $_G;
if (!IsExiest ( $data ['user_id'] )) 
{
return "borrow_user_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
return "borrow_name_empty";
}
if (!IsExiest ( $data ['account'] )) 
{
return "borrow_account_empty";
}
$data ['vouch_status'] = 1;
$result = self::GetAmountUsers ( array ( "user_id"=>$data ["user_id"] ) );
if ($data ['account'] >$result ['vouch_borrow_use']) 
{
return "borrow_account_over_vouchuse";
}
$result = M ( 'borrow')->where ( "user_id={$data['user_id']}
and status=0")->count ();
if ($result >0) 
{
return "borrow_is_exist";
}
$max = isset ( $_G ['system'] ['con_borrow_maxaccount'] ) ?$_G ['system'] ['con_borrow_maxaccount'] : "50000";
if ($data ['account'] >$max) 
{
return "borrow_account_over_max";
}
$min = isset ( $_G ['system'] ['con_borrow_minaccount'] ) ?$_G ['system'] ['con_borrow_minaccount'] : "500";
if ($data ['account'] <$min) 
{
return "borrow_account_over_min";
}
if (!IsExiest ( $data ['borrow_apr'] )) 
{
return "borrow_apr_empty";
}
$apr = isset ( $_G ['system'] ['con_borrow_apr_highest'] ) ?$_G ['system'] ['con_borrow_apr_highest'] : "22.18";
if ($data ['borrow_apr'] >$apr) 
{
return "borrow_apr_over_max";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'borrow')->add ( $data );
}
public static function GetList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
if (isset ( $data ['is_flow'] ) &&$data ['is_flow'] == 1) 
{
$_sql .= " and p1.`is_flow` = '{$data['is_flow']}
' ";
}
elseif ($data ['is_flow'] != 2) 
{
$_sql .= " and p1.`is_flow` = '0'";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['borrow_name'] ) != false) 
{
$_sql .= " and p1.`name` like '%".urldecode ( $data ['borrow_name'] ) ."%'";
}
if (IsExiest ( $data ['borrow_nid'] ) != false) 
{
$_sql .= " and p1.`borrow_nid` = '{$data['borrow_nid']}
'";
}
if (IsExiest ( $data ['borrow_type'] ) != false) 
{
if ($data ['borrow_type'] == "credit") 
{
$_sql .= " and p1.`vouchstatus`!=1 and `fast_status`!=1 and `is_flow`!=1 and `is_jin`!=1";
}
elseif ($data ['borrow_type'] == "vouch") 
{
$_sql .= " and p1.`vouchstatus`=1";
}
elseif ($data ['borrow_type'] == "fast") 
{
$_sql .= " and p1.`fast_status`=1";
}
elseif ($data ['borrow_type'] == "flow") 
{
$_sql .= " and p1.`is_flow`=1";
}
elseif ($data ['borrow_type'] == "jin") 
{
$_sql .= " and p1.`is_jin`=1";
}
elseif($data ['borrow_type'] == "miao")
{
$_sql .= " and p1.`is_Seconds`=1";
}
}
if (IsExiest ( $data ['query_type'] ) != false) 
{
$type = $data ['query_type'];
if ($type == "wait") 
{
$_sql .= " and p1.status=0";
}
elseif ($type == "success") 
{
$_sql .= " and p1.status=1";
}
elseif ($type == "invest") 
{
$_sql .= " and p1.status=1 and p1.verify_time >".time () ." - p1.borrow_valid_time*60*60*24 and p1.account>p1.borrow_account_yes";
}
elseif ($type == "vouch") 
{
$_sql .= " and p1.vouchstatus=1 and p1.verify_time >".time () ." - p1.borrow_valid_time*60*60*24 and p1.status=1";
}
elseif ($type == "false") 
{
$_sql .= " and p1.status=2";
}
elseif ($type == "full_check") 
{
$_sql .= " and p1.status=1 and p1.account=p1.borrow_account_yes ";
}
elseif ($type == "full_success") 
{
$_sql .= " and  p1.status=3";
}
elseif ($type == "repay_yes") 
{
$_sql .= " and (p1.status=3 or p1.is_flow=1) and p1.repay_account_wait='0.00'";
}
elseif ($type == "repay_no") 
{
$_sql .= " and (p1.status=3 or p1.is_flow=1) and p1.repay_account_wait!='0.00'";
}
elseif ($type == "full_false") 
{
$_sql .= " and p1.status=4";
}
elseif ($type == "flow_stop") 
{
$_sql .= " and p1.status!=5 ";
}
elseif ($type == "tender_now") 
{
$_sql .= " and ((p1.status=3 and p1.repay_account_wait!='0.00') or (p1.status=1 and p1.borrow_valid_time*60*60*24 + p1.verify_time >= ".time () ."))";
}
elseif ($type == "first"&&$data ['is_flow'] != 1) 
{
if (IsExiest ( $data ['status'] ) == "") 
{
$_sql .= " and p1.status = 0 ";
}
elseif ($data ['status'] == 1) 
{
$_sql .= " and p1.status=1 and p1.borrow_account_yes!=p1.account and p1.borrow_valid_time*60*60*24 + p1.verify_time >=".time ();
}
elseif ($data ['status'] == 5) 
{
$_sql .= " and p1.status = 5 ";
}
elseif ($data ['status'] == 6) 
{
$data ['status'] = 1;
$_sql .= " and  p1.borrow_valid_time*60*60*24 + p1.verify_time <".time ();
}
else 
{
$_sql .= " and p1.`status` in (0,1,2) ";
}
}
elseif ($type == "full") 
{
if ($data ['type'] == "repay") 
{
$_sql .= " and p1.status = 3 and repay_account_wait>0";
}
elseif ($data ['type'] == "repayyes") 
{
$_sql .= " and p1.status = 3 and repay_account_wait=0";
}
elseif (IsExiest ( $data ['status'] ) == "") 
{
$_sql .= " and p1.status = 1 and  p1.borrow_account_yes=p1.account ";
}
elseif (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status = {$data['status']}
";
}
}
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
if ($data ['status'] == -1) 
{
$_sql .= " and p1.status = 1 and p1.borrow_valid_time*60*60*24 + p1.verify_time <".time ();
}
else 
{
if ($data ['is_flow'] == 2) 
{
$_sql .= " and (p1.status in ({$data['status']}
) or p1.is_flow=1)";
}
else 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
}
}
if (IsExiest ( $data ['late_display'] ) == 1) 
{
$_sql .= " and p1.verify_time >".time () ." - p1.borrow_valid_time*60*60*24";
}
if (IsExiest ( $data ['vouch_status'] ) != "") 
{
$_sql .= " and p1.vouch_status in ({$data['vouch_status']}
)";
}
if (IsExiest ( $data ['tiyan_status'] ) != "") 
{
$_sql .= " and p1.tiyan_status in ({$data['tiyan_status']}
)";
}
if (IsExiest ( $data ['borrow_period'] ) != "") 
{
if ($data ['borrow_period'] == "1") 
{
$_sql .= " and p1.borrow_period <= 3";
}
elseif ($data ['borrow_period'] == "2") 
{
$_sql .= " and p1.borrow_period >= 3 and p1.borrow_period <= 6";
}
elseif ($data ['borrow_period'] == "3") 
{
$_sql .= " and p1.borrow_period >= 6 and p1.borrow_period <= 12";
}
elseif ($data ['borrow_period'] == "4") 
{
$_sql .= " and p1.borrow_period >= 12 ";
}
}
if (IsExiest ( $data ['flag'] ) != "") 
{
$_sql .= " and p1.flag = {$data['flag']}
";
}
if (IsExiest ( $data ['borrow_use'] ) != "") 
{
$_sql .= " and p1.borrow_use in ('{$data['borrow_use']}
')";
}
if (IsExiest ( $data ['borrow_usertype'] ) != "") 
{
$_sql .= " and p1.borrow_usertype = '{$data['borrow_usertype']}
'";
}
if (IsExiest ( $data ['award_status'] ) != "") 
{
if ($data ['award_status'] == 1) 
{
$_sql .= " and p1.award_status >0";
}
else 
{
$_sql .= " and p1.award_status = 0";
}
}
if (IsExiest ( $data ['borrow_style'] ) &&$data ['borrow_style'] != 'all') 
{
$_sql .= " and p1.borrow_style in ({$data['borrow_style']}
)";
}
if (IsExiest ( $data ['account_status'] != "")) 
{
if ($data ['account_status'] == 1) 
{
$_sql .= " and p1.account < 50000 ";
}
elseif ($data ['account_status'] == 2) 
{
$_sql .= " and p1.account >= 50000 and p1.account <= 100000";
}
elseif ($data ['account_status'] == 3) 
{
$_sql .= " and p1.account >= 100000 and p1.account <= 500000";
}
elseif ($data ['account_status'] == 4) 
{
$_sql .= " and p1.account >= 500000";
}
}
$_order = " p1.`fast_status` desc,p1.`vouchstatus` desc,p1.`id` desc";
if (IsExiest ( $data ['order'] ) != "") 
{
$order = $data ['order'];
if ($order == "account_up") 
{
$_order = "  p1.`account` desc ";
}
else if ($order == "account_down") 
{
$_order = "  p1.`account` asc";
}
if ($order == "credit_up") 
{
$_order = " p3.`credit` desc,p1.id desc ";
}
else if ($order == "credit_down") 
{
$_order = "  p3.`credit` asc,p1.id desc ";
}
if ($order == "apr_up") 
{
$_order = "  p1.`borrow_apr` desc,p1.id desc ";
}
else if ($order == "apr_down") 
{
$_order = "  p1.`borrow_apr` asc,p1.id desc ";
}
if ($order == "jindu_up") 
{
$_order = "  p1.`borrow_account_scale` desc,p1.id desc ";
}
else if ($order == "jindu_down") 
{
$_order = "  p1.`borrow_account_scale` asc,p1.id desc ";
}
if ($order == "period_up") 
{
$_order = "  p1.`borrow_period` desc,p1.id desc ";
}
else if ($order == "period_down") 
{
$_order = "  p1.`borrow_period` asc,p1.id desc ";
}
if ($order == "flag") 
{
$_order = "  p1.vouch_status desc,p1.`flag` desc,p1.id desc ";
}
if ($order == "index") 
{
$_order = "  p1.`borrow_account_scale` asc,p1.`recommend` desc,p1.`flag` desc,p1.id desc ";
}
}
if ($data ['jine'] == 1) 
{
$_order = "  p1.`account` desc";
}
if ($data ['jine'] == 2) 
{
$_order = " p1.`account` asc";
}
if ($data ['jine'] == 3) 
{
$_order = " p3.`credit` asc";
}
if ($data ['jine'] == 4) 
{
$_order = " p3.`credit` desc";
}
if ($data ['jine'] == 5) 
{
$_order = "p1.`borrow_end_time` asc";
}
if ($data ['jine'] == 6) 
{
$_order = "p1.`borrow_end_time` desc";
}
if ($data ['jine'] == 7) 
{
$_order = " p1.`borrow_account_scale` asc";
}
if ($data ['jine'] == 8) 
{
$_order = " p1.`borrow_account_scale` desc";
}
$field = "(100-p1.borrow_account_scale) as borrow_account_scale_sy,(245*p1.borrow_account_scale/100) as borrow_account_scale_width, p1.*,p2.username,p3.credits";
if (IsExiest ( $data ['limit'] ) != false) 
{
$list = M ( 'borrow')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{credit} as p3 on p1.user_id=p3.user_id') )->field ( $field )->where ( $_sql )->limit ( $data ['limit'] )->order ( $_order )->select ();
foreach ( $list as $key =>$value ) 
{
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
}
return $list;
}
$row = M ( 'borrow')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{credit} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->join ( presql ( '{credit} as p3 on p1.user_id=p3.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
;
$result ['borrow_end_status'] = 0;
if ($result ['status'] == 1 &&$result ['borrow_end_time'] <time ()) 
{
$result ['borrow_end_status'] = 1;
}
foreach ( $list as $key =>$value ) 
{
$borrow_end_status = 0;
if ($value ['status'] == 1 &&$value ['borrow_end_time'] <time ()) 
{
$borrow_end_status = 1;
}
if ($value ['status'] == 0) 
{
if ($borrow_end_status == 1) 
{
$borrow_type_nid = "valid_yes";
}
else 
{
$borrow_type_nid = "check_wait";
}
}
elseif ($value ['status'] == 2) 
{
$borrow_type_nid = "verify_false";
}
elseif ($value ['status'] == 3) 
{
if ($value ['repay_account_wait'] == 0) 
{
$borrow_type_nid = "repay_yes";
}
else 
{
$borrow_type_nid = "repay_now";
}
}
elseif ($value ['status'] == 4) 
{
$borrow_type_nid = "reverify_false";
}
elseif ($value ['status'] == 5) 
{
$borrow_type_nid = "cancel";
}
elseif ($value ['status'] == 1) 
{
if ($value ['vouch_status'] == 1 &&$value ['vouch_account_wait'] != 0) 
{
$borrow_type_nid = "vouch_now";
}
else 
{
if ($value ['borrow_account_wait'] == 0) 
{
$borrow_type_nid = "reverify";
}
else 
{
$borrow_type_nid = "tender_now";
}
}
}
$list [$key] ["borrow_type_nid"] = $borrow_type_nid;
$list [$key] ["borrow_end_status"] = $borrow_end_status;
$list [$key] ["borrow_valid_end_time"] = $value ["borrow_valid_time"] * 60 * 60 * 24 +$value ['verify_time'];
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$late = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
")->field ( 'sum(late_interest) as all_interest')->find ();
$list [$key] ['late_interest'] = $late ['all_interest'];
}
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show, 'jine'=>$data ['jine'] );
return $result;
}
public static function GetOne($data = array()) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != "") 
{
$where .= " and  p1.user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['id'] ) != "") 
{
$where .= " and  p1.id = {$data['id']}
";
}
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$where .= " and  p1.borrow_nid = '{$data['borrow_nid']}
' ";
}
$field = "p1.*,p2.username,p3.username as verify_username,(p1.borrow_success_time+(p1.borrow_period*24*60*60*30)) as r_time_h";
$result = M ( 'borrow')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users}` as p3 on p1.verify_userid = p3.user_id') )->field ( $field )->where ( $where )->find ();
if ($result == false ||$result === null) return "borrow_not_exiest";
return $result;
}
public static function GetDetail($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and  p1.user_id = '{$data['user_id']}
' ";
}
if (IsExiest ( $data ['id'] ) != "") 
{
$_sql .= " and  p1.id = '{$data['id']}
' ";
}
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$_sql .= " and  p1.borrow_nid = '{$data['borrow_nid']}
' ";
}
if (IsExiest ( $data ['hits'] ) != "") 
{
$hsql = "update `{borrow}` set hits=hits+1 where borrow_nid='{$data['borrow_nid']}
'";
M ()->execute ( presql ( $hsql ) );
}
$_result = array ();
$result = M ( 'borrow')->alias ( 'p1')->join ( presql ( '{users} as p2 on p1.user_id=p2.user_id') )->where ( $_sql )->field('p1.*,p2.username')->find ();
$result ['borrow_end_status'] = 0;
if ($result ['borrow_end_time'] <time ()) 
{
$result ['borrow_end_status'] = 1;
}
$result ['borrow_other_time'] = $result ['borrow_end_time'] -time ();
$_equal ["account"] = $result ["account"];
$_equal ["period"] = $result ["borrow_period"];
$_equal ["apr"] = $result ["borrow_apr"];
$_equal ["style"] = $result ["borrow_style"];
$_equal ["type"] = "all";
$equal_result = EqualInterest ( $_equal );
$result ["borrow_repay_month_account"] = $equal_result ['repay_month'];
$result ["acount_all"] = $equal_result ['account_total'];
$_equal ["account"] = "100";
$equal_result = EqualInterest ( $_equal );
$result ["borrow_100_interest"] = $equal_result ['interest_total'];
if ($result ['status'] == 0) 
{
if ($result ['borrow_end_status'] == 1) 
{
$borrow_type_nid = "valid_yes";
}
else 
{
$borrow_type_nid = "check_wait";
}
}
elseif ($result ['status'] == 2) 
{
$borrow_type_nid = "verify_false";
}
elseif ($result ['status'] == 3) 
{
if ($result ['repay_account_wait'] == 0.00) 
{
$borrow_type_nid = "repay_yes";
}
else 
{
$borrow_type_nid = "repay_now";
}
}
elseif ($result ['status'] == 4) 
{
$borrow_type_nid = "reverify_false";
}
elseif ($result ['status'] == 5) 
{
$borrow_type_nid = "cancel";
}
elseif ($result ['status'] == 1) 
{
if ($result ['vouch_status'] == 1 &&$result ['vouch_account_wait'] != 0) 
{
$borrow_type_nid = "vouch_now";
}
else 
{
if ($result ['borrow_account_wait'] == 0) 
{
$borrow_type_nid = "reverify";
}
else 
{
$borrow_type_nid = "tender_now";
}
}
}
$result ['borrow_type_nid'] = $borrow_type_nid;
$user_id = $result ['user_id'];
$_result ['borrow'] = $result;
$_result ['user_info'] = M ( 'users_info')->where ( "user_id={$user_id}
")->find ();
$_result ['rating_info'] = M ( 'rating_info')->where ( "user_id={$user_id}
")->find ();
$_result ['borrow_count'] = self::GetBorrowCount ( array ( "user_id"=>$user_id ) );
$_user_id = array ( "user_id"=>$user_id );
$_result ['borrow_credit'] = self::GetBorrowCredit ( $_user_id );
return $_result;
}
public static function Verify($data = array()) 
{
global $MsgInfo,$_G;
$result = M ( 'borrow')->where ( "borrow_nid='{$data['borrow_nid']}
'")->find ();
if ($result == false) 
{
return "borrow_not_exiest";
}
else 
{
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['name']}
</a>";
}
if ($result ['status'] != 0) 
{
return "borrow_verify_error";
}
$inid = self::UpdateBorrowCount ( array ( "user_id"=>$result ['user_id'], "borrow_times"=>1 ) );
if ($data ['status'] == 1) 
{
$status = 1;
$remind ['nid'] = "verify_true";
$remind ['receive_userid'] = $result ['user_id'];
$remind ['title'] = "初审成功";
$remind ['phone_content']="您的借款标{$result['name']}
在".date ( "Y-m-d",time () ) ."初审成功。";
$remind ['content'] = "您的借款标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."初审成功。";
\remindClass::sendRemind ( $remind );
}
else 
{
if ($result ['is_Seconds'] == 1) 
{
$log_info ["user_id"] = $result ['user_id'];
$moeSeconds = round ( ($result ['account'] / 100 * $result ['borrow_apr']) / 12,2 );
$log_info ["nid"] = "borrow_success_manage_".time () ."_".$inid;
$log_info ["money"] = 0;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = +$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "秒标审核失败，返回秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
$status = 2;
$remind ['nid'] = "verify_false";
$remind ['receive_userid'] = $result ['user_id'];
$remind ['title'] = "初审失败";
$remind['phone_content']="您的借款标{$result['name']}
在".date ( "Y-m-d",time () ) ."初审失败。";
$remind ['content'] = "您的借款标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."初审失败。";
\remindClass::sendRemind ( $remind );
}
$borrow_end_time = $result ['borrow_valid_time'] * 60 * 60 * 24 +time ();
$udata = array ();
$udata ['verify_time'] = time ();
$udata ['verify_userid'] = $_G ['user_id'];
$udata ['verify_remark'] = $data ['verify_remark'];
$udata ['recommend'] = $data ['recommend'];
$udata ['borrow_end_time'] = $borrow_end_time;
$udata ['status'] = $status;
$udata ['borrow_status'] = $data ['status'];
M ( 'borrow')->where ( "borrow_nid='{$data['borrow_nid']}
'")->save ( $udata );
if ($data ['status'] == 1) 
{
$user_log ["user_id"] = $_G ['user_id'];
$user_log ["code"] = "borrow";
$user_log ["type"] = "borrow";
$user_log ["operating"] = "verify";
$user_log ["article_id"] = $data ['borrow_nid'];
$user_log ["result"] = $result >0 ?1 : 0;
$user_log ["content"] = str_replace ( array ( '#borrow_url#' ),array ( $borrow_url ),$MsgInfo ["borrow_verify_user_msg"] );
\usersClass::AddUsersLog ( $user_log );
}
$res = \autoClass::AutoTender ( array ( "borrow_nid"=>$result ['borrow_nid'] ) );
if ($res != false &&$result ['is_flow'] != 1 &&($result ['is_Seconds'] != 1 ||$_G ['system'] ['con_is_Seconds_auto'] == 1) &&1 == $_G ['system'] ['con_tender_auto']) 
{
foreach ( $res as $key =>$value ) 
{
$_tender ['borrow_nid'] = $result ['borrow_nid'];
$_tender ['user_id'] = $key;
$_tender ['account'] = $value;
$_tender ['contents'] = "自动投标";
$_tender ['status'] = 0;
$_tender ['auto_status'] = 1;
$_tender ['nid'] = "tender_".$key .time () .rand ( 10,99 );
$_result = self::AddTender ( $_tender );
$idata ['borrow_nid'] = $result ['borrow_nid'];
$idata ['user_id'] = $key;
$idata ['account'] = $value;
$idata ['remark'] = $_result;
$idata ['addtime'] = time ();
$idata ['addip'] = get_client_ip ();
M ( 'borrow_autolog')->add ( $idata );
$user_log ["user_id"] = $_tender ['user_id'];
$user_log ["code"] = "tender";
$user_log ["type"] = "tender";
$user_log ["operating"] = "auto_tender";
$user_log ["article_id"] = $_tender ['user_id'];
$user_log ["result"] = 1;
$user_log ["content"] = date ( "Y-m-d H:i:s") ."自动投标[{$borrow_url}
]成功,金额为{$_tender['account']}
";
\usersClass::AddUsersLog ( $user_log );
}
}
return $data ['borrow_nid'];
}
public static function GetTenderList($data = array()) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['borrow_userid'] ) != false) 
{
$_sql .= " and p3.user_id = {$data['borrow_userid']}
";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p2.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['borrow_status'] ) != false) 
{
$_sql .= " and p3.`status` = '{$data['borrow_status']}
'";
}
if ($data ['change_status'] != "") 
{
$_sql .= " and p1.`change_status` = '{$data['change_status']}
'";
}
if (IsExiest ( $data ['borrow_name'] ) != false) 
{
$_sql .= " and p3.`name` like '%".urldecode ( $data ['borrow_name'] ) ."%'";
}
if (IsExiest ( $data ['borrow_nid'] ) != false) 
{
$_sql .= " and p3.`borrow_nid` = '{$data['borrow_nid']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if (IsExiest ( $data ['vouch_status'] ) != "") 
{
$_sql .= " and p3.vouch_status in ({$data['vouch_status']}
)";
}
if (IsExiest ( $data ['borrow_period'] ) != "") 
{
$_sql .= " and p3.borrow_period = {$data['borrow_period']}
";
}
if (IsExiest ( $data ['flag'] ) != "") 
{
$_sql .= " and p3.flag = {$data['flag']}
";
}
if (IsExiest ( $data ['borrow_use'] ) != "") 
{
$_sql .= " and p3.borrow_use in ({$data['borrow_use']}
)";
}
if (IsExiest ( $data ['borrow_usertype'] ) != "") 
{
$_sql .= " and p3.borrow_usertype = '{$data['borrow_usertype']}
'";
}
if (IsExiest ( $data ['borrow_style'] )) 
{
$_sql .= " and p3.borrow_style in ({$data['borrow_style']}
)";
}
if (IsExiest ( $data ['account1'] ) != "") 
{
$_sql .= " and p1.account >= {$data['account1']}
";
}
if (IsExiest ( $data ['account2'] ) != "") 
{
$_sql .= " and p1.account <= {$data['account2']}
";
}
$field = " p1.*,p2.username,p3.name as borrow_name,p3.nikename,p3.account as borrow_account,p4.username as borrow_username,p3.repay_account_wait as borrow_account_wait_all,p3.repay_last_time,p3.repay_account_interest_wait as borrow_interest_wait_all,p4.user_id as borrow_userid,p3.borrow_apr,p3.borrow_period,p3.borrow_account_scale,p5.credits,p7.niname as tnikename";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p5 on p5.user_id=p3.user_id') )->join ( presql ( '`{borrow_change}` as p6 on p1.id=p6.tender_id') )->join ( presql ( '`{users_info}` as p7 on p1.user_id=p7.user_id') )->field ( $field )->where ( $_sql )->order ( 'p1.id desc')->limit ( $_limit )->select ();
}
$row = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p5 on p5.user_id=p3.user_id') )->join ( presql ( '`{borrow_change}` as p6 on p1.id=p6.tender_id') )->join ( presql ( '`{users_info}` as p7 on p1.user_id=p7.user_id') )->where ( $_sql )->count ();
$account_tender = 0;
$recover_account_interest = 0;
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p5 on p5.user_id=p3.user_id') )->join ( presql ( '`{borrow_change}` as p6 on p1.id=p6.tender_id') )->join ( presql ( '`{users_info}` as p7 on p1.user_id=p7.user_id') )->field ( $field )->where ( $_sql )->order ( 'p1.id desc')->page ( $data ['page'] .",{$data ['epage']}
")->select ();
foreach ( $list as $key =>$value ) 
{
$account_tender = $account_tender +$value ['account_tender'];
$recover_account_interest = $recover_account_interest +$value ['recover_account_interest'];
$repayresult = M ( 'borrow_repay')->where ( 'repay_time<'.time () ." and repay_status=0 and borrow_nid={$value['borrow_nid']}
")->find ();
if ($repayresult !== null) 
{
$list [$key] ['change_no'] = 1;
}
$late = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
")->field ( 'sum(late_interest) as all_interest')->find ();
$list [$key] ['late_interest'] = $late ['all_interest'];
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$recoverresult = M ( 'borrow_repay')->where ( "borrow_nid='{$value['borrow_nid']}
' and (repay_status=1 or repay_web=1)")->count ();
if($value ['borrow_period']<1)
{
$list [$key] ['norepay_num'] = 1 -$recoverresult;
}
else
{
$list [$key] ['norepay_num'] = $value ['borrow_period'] -$recoverresult;
}
$list [$key] ['repay_num'] = $recoverresult;
$chresult = M ( 'borrow_change')->where ( "tender_id={$value['id']}
")->field ( 'status,buy_time')->find ();
if ($chresult ['status'] == 1) 
{
$recresult = M ( 'borrow_recover')->where ( "user_id={$value['user_id']}
and borrow_nid='{$value['borrow_nid']}
' and recover_yestime<{$chresult['buy_time']}
and tender_id={$value['id']}
")->field ( 'count(1) as count_all,sum(recover_account_yes) as recover_account_yes_all,sum(recover_interest_yes) as recover_interest_yes_all')->find ();
$list [$key] ["recover_interest_yes_all"] = $recresult ['recover_interest_yes_all'];
$list [$key] ["recover_account_yes_all"] = $recresult ['recover_account_yes_all'];
$list [$key] ["count_all"] = $recresult ['count_all'];
}
}
$result = array ( 'list'=>$list ?$list : array (), 'recover_account_interest'=>$recover_account_interest, 'account_tender'=>$account_tender, 'page'=>$show );
return $result;
}
public static function GetTenderOne($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['id'] ) != "") 
{
$_sql .= " and  p1.id = '{$data['id']}
' ";
}
if (IsExiest ( $data ['tender_id'] ) != "") 
{
$_sql .= " and  p1.tender_id = '{$data['tender_id']}
' ";
}
$field = "p1.*,p2.username,p3.name as borrow_name,p3.account as borrow_account,p3.borrow_period,p3.borrow_style,p3.borrow_use,p3.borrow_flag,p3.borrow_apr,p3.vouchstatus,p3.is_flow,p3.is_Seconds,p3.is_jin,p3.fast_status";
$result = M('borrow_tender')->alias('p1')->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->join(presql('`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid'))->where($_sql)->field($field)->find();
if ($result == null) return "borrow_tender_not_exiest";
return $result;
}
public static function CancelTender($data = array()) 
{
$result = M('borrow_tender')->where("tender_nid='{$data['tender_nid']}
'")->find();
if ($result == null) return "borrow_tender_not_exiest";
if ($result ['tender_status'] >0) return "borrow_tender_verify_yes";
$sql = "update `{borrow_tender}` set status=0 where tender_nid='{$data['tender_nid']}
'";
M()->execute(presql($sql));
return $data ['tender_nid'];
}
public static function Cancel($data = array()) 
{
global $MsgInfo;
$where = " 1=1 ";
if (IsExiest ( $data ['borrow_nid'] ) != false) 
{
$where .= " and borrow_nid='{$data['borrow_nid']}
'";
}
else 
{
return "borrow_nid_empty";
}
$borrow_nid = $data ['borrow_nid'];
if (IsExiest ( $data ['user_id'] ) != "") 
{
$where .= " and user_id={$data['user_id']}
";
}
$result = M ( 'borrow')->where ( $where )->find ();
$borrow_userid=$result['user_id'];
$borrow_id=$result['id'];
if ($result ["status"] == 5) return "borrow_cancel_has";
if ($result ["status"] != 1 &&$result ["status"] != 0) return "borrow_cancel_error";
if ($result ["tender_times"] >0)
{
if(($result['borrow_valid_time']*60*60*24+$result['verify_time'])>time ()) return "borrow_cancel_yestender";
}
$vouch_status = $result ['vouch_status'];
$remind ['nid'] = "verify_false";
$remind ['receive_userid'] = $result ['user_id'];
$remind ['article_id'] = $result ['borrow_nid'];
$remind ['code'] = "borrow";
$remind ['title'] = "借款撤销";
$remind ['content'] = "您的借款标[<a href={$_G['weburl']}
".U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['name']}
</a>]在".date ( "Y-m-d",time () ) ."撤销。";
\remindClass::sendRemind ( $remind );
if ($data ['cancel_status'] != "") 
{
if ($data ['cancel_status'] == 3) 
{
return "borrow_cancel_verify_true";
}
$udata ['cancel_verify_remark'] = $data ['cancel_verify_remark'];
$udata ['cancel_verify_time'] = time ();
$udata ['cancel_verify_ip'] = get_client_ip ();
$udata ['cancel_status'] = $data ['cancel_status'];
M ( 'borrow')->where ( "borrow_nid = '{$data['id']}
'")->save ( $udata );
return "borrow_cancel_verify_false";
}
if (IsExiest ( $data ['user_id'] ) != "") 
{
if ($result ['is_Seconds'] == 1) 
{
$log_info ["user_id"] = $data ["user_id"];
$moeSeconds = round ( ($result ['account'] / 100 * $result ['borrow_apr']) / 12,2 );
$log_info ["nid"] = "borrow_success_manage_".time () ."_".$result ['id'];
$log_info ["money"] = $moeSeconds;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = +$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "返款操作秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
}
else 
{
if ($result ['is_Seconds'] == 1) 
{
$log_info ["user_id"] = $result ["user_id"];
$moeSeconds = round ( ($result ['account'] / 100 * $result ['borrow_apr']) / 12,2 );
$log_info ["nid"] = "borrow_success_manage_".time () ."_".$result ['id'];
$log_info ["money"] = 0;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = +$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "该标被管理员撤标，返回秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
}
$borrow_url = "<a href={$_G['weburl']}
".U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['name']}
</a>";
$sql = "update  `{borrow}`  set status=5,reverify_time='".time () ."',reverify_remark='用户撤销' $_sql";
$udata = array ();
$udata ['status'] = 5;
$udata ['reverify_time'] = time ();
$udata ['reverify_remark'] = '用户撤销';
$result = M ( 'borrow')->where ( $where )->save ( $udata );
if ($result == false) 
{
return "borrow_cancel_false";
}
if ($vouch_status == 1) 
{
$result = self::GetVouchList ( array ( "limit"=>"all", "borrow_nid"=>$borrow_nid ) );
if ($result != "") 
{
foreach ( $result as $key =>$value ) 
{
$vouch_account = $value ['account'];
$vouch_userid = $value ['user_id'];
$vouch_id = $value ['id'];
$vouch_award = $value ['award_account'];
M ( 'borrow_vouch')->where ( "id ={$vouch_id}
")->setField ( 'status',2 );
$_data ["user_id"] = $vouch_userid;
$_data ["amount_type"] = "vouch_tender";
$_data ["type"] = "borrow_false";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrow_false_vouch_".$vouch_userid ."_".$borrow_nid .$value ["id"];
$_data ["account"] = $vouch_account;
$_data ["remark"] = "担保借款[{$borrow_url}
]审核失败借款担保额度返回";
\borrowClass::AddAmountLog ( $_data );
}
}
}
$result = self::GetTenderList ( array ( "borrow_nid"=>$borrow_nid, "limit"=>"all" ) );
foreach ( $result as $key =>$value ) 
{
if ($value ['status'] == 0) 
{
$tdata=array();
$tdata['status']=3;
$tdata['tender_status']=2;
M ( 'borrow_tender')->where ( "id = {$value['id']}
")->setField ($tdata);
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "tender_user_cancel_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = $value ['account'];
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = $value ['account'];
$log_info ["frost"] = -$value ['account'];
$log_info ["await"] = 0;
$log_info ["type"] = "tender_user_cancel";
$log_info ["to_userid"] =$borrow_userid;
$log_info ["remark"] = str_replace ( "#borrow_url#",$borrow_url,$MsgInfo ["account_tender_user_cancel"] );
$result = \accountClass::AddLog ( $log_info );
$remind ['nid'] = "tender_user_cancel";
$remind ['code'] = "borrow";
$remind ['article_id'] = $borrow_id;
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = str_replace ( "#borrow_name#",$value ['borrow_name'],$MsgInfo ["remind_tender_user_cancel_title"] );
$remind ['content'] = str_replace ( "#borrow_url#",$borrow_url,$MsgInfo ["remind_tender_user_cancel_contents"] );
\remindClass::sendRemind ( $remind );
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_frost_account"=>-$value ['account'] ) );
}
}
return $data ['borrow_nid'];
}
public static function AddTender($data = array()) 
{
global $_G;
if (IsExiest ( $data ['borrow_nid'] ) == "") 
{
return "borrow_nid_empty";
}
$borrow_result = self::GetOne ( array ( "borrow_nid"=>$data ['borrow_nid'] ) );
if (!is_array ( $borrow_result )) 
{
return $borrow_result;
}
if ($borrow_result ["Second_limit_money"] <$data ['account'] &&$borrow_result ["Second_limit_money"] != 0 ) 
{
return "borrow_Second_limit_money";
}
$dataS ['borrow_nid'] = $data ['borrow_nid'];
$dataS ['user_id'] = $data ['user_id'];
$is_Second = self::GetSecond ( $dataS );
if ($_G ['system'] ['con_bid_limit'] == 1 &&time () -$borrow_result ['verify_time'] <= 1800) 
{
return "borrow_Second_er";
}
if ($borrow_result ["is_Seconds"] == 1 &&$is_Second == 1 &&$_G ['system'] ['con_seconds_borrow_limit'] == 1) 
{
return "borrow_Second_er";
}
if ($is_Second == 1 &&$borrow_result ["is_Seconds"] != 1 &&$_G ['system'] ['con_is_Seconds_limit'] == 1) 
{
return "borrow_Second_er";
}
if ($borrow_result ["user_id"] == $data ['user_id']) 
{
return "borrow_tender_user_id_re";
}
if ($borrow_result ['borrow_account_yes'] >= $borrow_result ['account']) 
{
return "tender_full_yes";
}
if ($borrow_result ['verify_time'] == ""||$borrow_result ['status'] != 1) 
{
return "tender_verify_no";
}
if ($borrow_result ['verify_time'] +$borrow_result ['borrow_valid_time'] * 60 * 60 * 24 <time ()) 
{
return "tender_late_yes";
}
if (!is_numeric ( $data ['account'] )) 
{
return "tender_money_error";
}
if ($data ['account'] <$borrow_result ['tender_account_min']) 
{
return "最小的投资金额不能小于{$borrow_result['tender_account_min']}
。";
}
if ($data ['account'] >$borrow_result ['Second_limit_money'] &&$borrow_result ['Second_limit_money'] >0) 
{
return "最大的投资金额不能大于{$borrow_result['Second_limit_money']}
。";
}
if ($borrow_result ['vouch_status'] == 1 &&$borrow_result ['vouch_account'] != $borrow_result ['vouch_account_yes']) 
{
return "tender_vouch_full_no";
}
$tender_account_all = self::GetUserTenderAccount ( array ( "user_id"=>$data ["user_id"], "borrow_nid"=>$data ['borrow_nid'] ) );
if ($tender_account_all +$data ['account'] >$borrow_result ['tender_account_max'] &&$borrow_result ['tender_account_max'] >0) 
{
$tender_account = $borrow_result ['tender_account_max'] -$tender_account_all;
return "您已经投标了{$tender_account_all}
,最大投标总金额不能大于{$borrow_result['tender_account_max']}
，你最多还能投资{$tender_account}
";
}
else 
{
$data ['account_tender'] = $data ['account'];
if ($borrow_result ['borrow_account_wait'] <$data ['account']) 
{
$data ['account'] = $borrow_result ['borrow_account_wait'];
return "tender_money_no_h";
}
$account_result = \accountClass::GetAccountUsers ( array ( "user_id"=>$data ['user_id'] ) );
if ($account_result ['balance'] <$data ['account']) 
{
return "tender_money_no";
}
}
if ($account_result ['await'] <= $_G ['system'] ['con_seconds_await_acc'] &&$_G ['system'] ['con_seconds_await'] == 1 &&$borrow_result ["is_Seconds"] == 1) 
{
return "borrow_Seconds_await_no";
}
if ($borrow_result ['tender_friends'] != "") 
{
$_tender_friends = explode ( "|",$borrow_result ['tender_friends'] );
$result = M ( 'users')->where ( "user_id={$data['user_id']}
")->field ( 'username')->find ();
if (!in_array ( $result ['username'],$_tender_friends )) 
{
return "tender_friends_error";
}
}
if ($_G ['system'] ['con_repay_no'] == 0) 
{
$more = M ( 'borrow')->where ( "user_id={$data['user_id']}
and repay_account_wait!=0")->find ();
if ($more == true) 
{
return "borrow_no_more";
}
}
else 
{
$acc = $data ['account'] * 2;
$more = M ( 'borrow')->where ( "user_id={$data['user_id']}
")->field ( 'sum(repay_account_wait) as account_all')->find ();
if ($more ['account_all'] <$acc &&$more ['account_all'] != 0) 
{
return "borrow_no_more";
}
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
$insert_id = M ( 'borrow_tender')->add ( $data );
if ($insert_id >0) 
{
$sql = "update  `{borrow}`  set borrow_account_yes=borrow_account_yes+{$data['account']}
,borrow_account_wait=borrow_account_wait-{$data['account']}
,borrow_account_scale=(borrow_account_yes/account)*100,tender_times=tender_times+1  where borrow_nid='{$data['borrow_nid']}
'";
M ()->execute ( presql ( $sql ) );
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$data['borrow_nid'])." target=_blank>{$borrow_result['name']}
</a>";
$log_info ["user_id"] = $data ["user_id"];
$log_info ["nid"] = "tender_frost_".$data ['user_id'] ."_".time ();
$log_info ["money"] = $data ['account'];
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = -$data ['account'];
$log_info ["frost"] = $data ['account'];
$log_info ["await"] = 0;
$log_info ["type"] = "tender";
$log_info ["to_userid"] = $borrow_result ['user_id'];
if ($data ['auto_status'] == 1) 
{
$log_info ["remark"] = "自动投标[{$borrow_url}
]所冻结资金";
}
else 
{
$log_info ["remark"] = "投标[{$borrow_url}
]所冻结资金";
}
\accountClass::AddLog ( $log_info );
if ($borrow_result ["is_flow"] != 1) 
{
self::UpdateBorrowCount ( array ( "user_id"=>$data ['user_id'], "tender_times"=>1, "tender_account"=>$data ['account'], "tender_frost_account"=>$data ['account'] ) );
}
}
return $insert_id;
}
public static function AddSpread($data = array())
{
global $_G;
if (IsExiest ( $data ["user_id"] ) == false) return "borrow_nid_empty";
if (IsExiest ( $data ["borrow_nid"] ) == false) return "borrow_nid_empty";
if (IsExiest ( $data ["tender_id"] ) == false) return "borrow_nid_empty";
$sresultd=M('spread')->where("user_id={$data ['user_id']}
and tender_id={$data ["tender_id"]}
and borrow_nid='{$data ["borrow_nid"]}
'")->find();
if($sresultd!=null&&$sresultd!=false) return ;
else
{
$info=M('users_info')->where("user_id={$data ["user_id"]}
")->find();
$fresult=M('users_friends_invite')->where("friends_userid={$data ["user_id"]}
")->find();
if($fresult!=null&&$fresult!=false)
{
$spread_user=M('users_info')->where("user_id={$fresult['user_id']}
")->find();
if($spread_user['invite_status']==1)
{
$idata['user_id']=$data ["user_id"];
$idata['nikename']=$info['niname'];
$idata['spread_userid']=$fresult['user_id'];
$idata['spread_nike']=$spread_user['niname'];
$idata['status']=0;
$idata['borrow_nid']=$data ["borrow_nid"];
$idata['tender_id']=$data ["tender_id"];
$idata['addtime']=time();
$idata['addip']=get_client_ip();
M('spread')->add($idata);
}
}
}
}
public static function Reverify($data = array()) 
{
global $_G;
if (IsExiest ( $data ["borrow_nid"] ) == "") return "borrow_nid_empty";
$borrow_nid = $data ["borrow_nid"];
$borrow_result = M('borrow')->alias('p1')->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->where("p1.borrow_nid='{$data['borrow_nid']}
'")->field('p1.*,p2.username')->find();
$status = $data ['status'];
$borrow_status = $borrow_result ["status"];
$borrow_style = $borrow_result ["borrow_style"];
if ($borrow_status != 1) 
{
return "borrow_fullcheck_error";
}
if ($borrow_result ["is_flow"] == 1) 
{
return "borrow_is_flow_error";
}
if ($borrow_result ['borrow_full_status'] == 1) 
{
return "borrow_fullcheck_yes";
}
if ($borrow_result ['borrow_part_status'] != 1 &&$borrow_result ['borrow_account_yes'] != $borrow_result ['account']) 
{
return "borrow_not_full";
}
$sql = " update `{borrow}` set reverify_userid='{$data['reverify_userid']}
',reverify_remark='{$data['reverify_remark']}
',reverify_time='".time () ."',status='{$data['status']}
' where borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
$borrow_apr = $borrow_result ["borrow_apr"];
$is_Seconds = $borrow_result ["is_Seconds"];
$borrow_userid = $borrow_result ["user_id"];
$borrow_username = $borrow_result ["username"];
$borrow_account = $borrow_result ["account"];
$borrow_period = $borrow_result ["borrow_period"];
$nikename=$borrow_result['nikename'];
$borrow_name = $borrow_result ["name"];
$borrow_cash_status = $borrow_result ["cash_status"];
$borrow_url = html_entity_decode ( "<a href={$_G['system']['con_weburl']}
".U('Index/Index/index?site=full_success&nid='.$data['borrow_nid'])." target=_blank style=color:blue>{$borrow_result['name']}
</a>");
if ($status == 3) 
{
$sql = " update `{borrow}` set borrow_full_status='1' where borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
$_equal ["account"] = $borrow_result ["account"];
$_equal ["period"] = $borrow_result ["borrow_period"];
$_equal ["apr"] = $borrow_result ["borrow_apr"];
$_equal ["style"] = $borrow_result ["borrow_style"];
$equal_result = EqualInterest ( $_equal );
foreach ( $equal_result as $key =>$value ) 
{
$result = M('borrow_repay')->where("user_id={$borrow_userid}
and repay_period='{$key}
' and borrow_nid='{$borrow_nid}
'")->find();
if ($result == null) 
{
$sql = "insert into `{borrow_repay}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id={$borrow_userid}
,status=1,`borrow_nid`='{$borrow_nid}
',`repay_period`='{$key}
',";
$sql .= "`repay_time`='{$value['repay_time']}
',`repay_account`='{$value['account_all']}
',";
$sql .= "`repay_interest`='{$value['account_interest']}
',`repay_capital`='{$value['account_capital']}
'";
M()->execute(presql($sql));
}
else 
{
$sql = "update `{borrow_repay}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id='{$borrow_userid}
',status=1,`borrow_nid`='{$borrow_nid}
',`repay_period`='{$key}
',";
$sql .= "`repay_time`='{$value['repay_time']}
',`repay_account`='{$value['account_all']}
',";
$sql .= "`repay_interest`='{$value['account_interest']}
',`repay_capital`='{$value['account_capital']}
'";
$sql .= " where user_id=$borrow_userid and repay_period='{$key}
' and borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
}
}
$repay_times = count ( $equal_result );
$_equal ["type"] = "all";
$equal_result = EqualInterest ( $_equal );
$repay_all = $equal_result ['account_total'];
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "borrow_success_".$borrow_nid;
$log_info ["money"] = $borrow_account;
$log_info ["income"] = $borrow_account;
$log_info ["expend"] = 0;
if ($borrow_result ["borrow_style"] == 5) 
{
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = $borrow_account;
}
else 
{
$log_info ["balance_cash"] = $borrow_account;
$log_info ["balance_frost"] = 0;
}
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["repay"] = $repay_all;
$log_info ["type"] = "borrow_success";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "通过[{$borrow_url}
]借到的款";
\accountClass::AddLog ( $log_info );
$UsersVip = \usersClass::GetUsersVip ( array ( "user_id"=>$borrow_userid ) );
if ($UsersVip ['status'] == 1) 
{
$borrow_fee = isset ( $_G ['system'] ['con_borrow_success_vip_fee'] ) ?$_G ['system'] ['con_borrow_success_vip_fee'] * 0.01 : 0.02;
}
else 
{
$borrow_fee = isset ( $_G ['system'] ['con_borrow_success_fee'] ) ?$_G ['system'] ['con_borrow_success_fee'] * 0.01 : 0.02;
}
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "borrow_success_manage_".$borrow_nid .$borrow_userid;
$fee_account = round ( $borrow_account * $borrow_fee,2 );
$log_info ["money"] = $fee_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $fee_account;
$log_info ["balance_cash"] = -$fee_account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_success_manage";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "成功借款[{$borrow_url}
]的成交费";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "borrow_success_account_".$borrow_nid .$borrow_userid;
if ($UsersVip ['status'] == 1) 
{
$borrow_manage_fee = isset ( $_G ['system'] ['con_borrow_manage_vip_fee'] ) ?$_G ['system'] ['con_borrow_manage_vip_fee'] * 0.01 : 0.003;
}
else 
{
$borrow_manage_fee = isset ( $_G ['system'] ['con_borrow_manage_fee'] ) ?$_G ['system'] ['con_borrow_manage_fee'] * 0.01 : 0.003;
}
if($borrow_period<1)
{
$borrowqishu=1;
}
else
{
$borrowqishu=$borrow_period;
}
$fee_account = round ( $borrow_account * $borrow_manage_fee * $borrowqishu,2 );
$log_info ["money"] = $fee_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $fee_account;
$log_info ["balance_cash"] = -$fee_account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_success_account";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "成功借款[{$borrow_url}
]的账户管理费";
\accountClass::AddLog ( $log_info );
$result = \creditClass::GetUserRank ( array ( 'user_id'=>$borrow_userid, "nid"=>"credit", "code"=>"approve" ) );
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "fengxianchi_".$borrow_nid .$borrow_userid;
$borrow_fengxian_fee = isset ( $_G ['system'] ['con_borrow_fengxian'] ) ?$_G ['system'] ['con_borrow_fengxian'] * 0.01 : 0;
$fee_account = round($borrow_account*$borrow_fengxian_fee,2);
$log_info ["money"] = $fee_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $fee_account;
$log_info ["balance_cash"] = -$fee_account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "成功借款[{$borrow_url}
]的进入风险池";
\accountClass::AddLog ( $log_info );
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_success_times"=>1, "borrow_repay_times"=>$repay_times, "borrow_repay_wait_times"=>$repay_times, "borrow_account"=>$borrow_result ["account"], "borrow_repay_account"=>$repay_all, "borrow_repay_wait"=>$repay_all, "borrow_repay_interest"=>$equal_result ['interest_total'], "borrow_repay_interest_wait"=>$equal_result ['interest_total'], "borrow_repay_capital"=>$equal_result ['capital_total'], "borrow_repay_capital_wait"=>$equal_result ['capital_total'] ) );
$tender_result = self::GetTenderList ( array ( "borrow_nid"=>$borrow_nid, "limit"=>"all" ) );
foreach ( $tender_result as $_key =>$_value ) 
{
$tender_id = $_value ['id'];
$sql = "update `{borrow_tender}` set status=1 where id={$tender_id}
";
M()->execute(presql($sql));
$_equal ["account"] = $_value ['account'];
$_equal ["period"] = $borrow_result ["borrow_period"];
$_equal ["apr"] = $borrow_result ["borrow_apr"];
$_equal ["style"] = $borrow_result ["borrow_style"];
$_equal ["type"] = "";
$equal_result = EqualInterest ( $_equal );
$tender_userid = $_value ['user_id'];
$tender_account = $_value ['account'];
foreach ( $equal_result as $period_key =>$value ) 
{
$repay_month_account = $value ['account_all'];
$result = M('borrow_recover')->where("user_id='{$tender_userid}
' and borrow_nid='{$borrow_nid}
' and recover_period='{$period_key}
' and tender_id='{$tender_id}
'")->find();
if ($result == false) 
{
$sql = "insert into `{borrow_recover}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id={$tender_userid}
,status=1,`borrow_nid`='{$borrow_nid}
',`borrow_userid`={$borrow_userid}
,`tender_id`='{$tender_id}
',`recover_period`='{$period_key}
',";
$sql .= "`recover_time`='{$value['repay_time']}
',`recover_account`='{$value['account_all']}
',";
$sql .= "`recover_interest`='{$value['account_interest']}
',`recover_capital`='{$value['account_capital']}
'";
M()->execute(presql($sql));
}
else 
{
$sql = "update `{borrow_recover}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id={$tender_userid}
,status=1,`borrow_nid`='{$borrow_nid}
',`borrow_userid`={$borrow_userid}
,`tender_id`='{$tender_id}
',`recover_period`='{$period_key}
',";
$sql .= "`recover_time`='{$value['repay_time']}
',`recover_account`='{$value['account_all']}
',";
$sql .= "`recover_interest`='{$value['account_interest']}
',`recover_capital`='{$value['account_capital']}
'";
$sql .= " where user_id={$tender_userid}
and recover_period='{$period_key}
' and borrow_nid='{$borrow_nid}
' and tender_id='{$tender_id}
'";
M()->execute(presql($sql));
}
}
$recover_times = count ( $equal_result );
$_equal ["type"] = "all";
$equal_result = EqualInterest ( $_equal );
$recover_all = $equal_result ['account_total'];
$recover_interest_all = $equal_result ['interest_total'];
$recover_capital_all = $equal_result ['capital_total'];
$sql = "update `{borrow_tender}` set recover_account_all='{$equal_result['account_total']}
',recover_account_interest='{$equal_result['interest_total']}
',recover_account_wait='{$equal_result['account_total']}
',recover_account_interest_wait='{$equal_result['interest_total']}
',recover_account_capital_wait='{$equal_result['capital_total']}
'  where id={$tender_id}
";
M()->execute(presql($sql));
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_success_".$borrow_nid .$tender_userid .$tender_id .$period_key;
$log_info ["money"] = $tender_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $tender_account;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$tender_account;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_success";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "投标[{$borrow_url}
]成功投资金额扣除";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_success_frost_".$borrow_nid .$tender_userid .$tender_id .$period_key;
$log_info ["money"] = $recover_all;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = $recover_all;
$log_info ["type"] = "tender_success_frost";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "投标[{$borrow_url}
]成功待收金额增加";
\accountClass::AddLog ( $log_info );
$remind ['nid'] = "tender_success";
$remind ['receive_userid'] = $tender_userid;
$remind ['article_id'] = $borrow_nid;
$remind ['code'] = "borrow";
$remind ['title'] = "投资({$nikename}
)的标[{$borrow_name}
]满标审核成功";
$remind ['content'] = "你所投资的标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."已经审核通过";
$remind ['phone_content']="你所投资的标[{$borrow_name}
]在".date ( "Y-m-d",time () ) ."已经审核通过";
\remindClass::sendRemind ( $remind );
$user_log ["user_id"] = $tender_userid;
$user_log ["code"] = "tender";
$user_log ["type"] = "tender_success";
$user_log ["operating"] = "tender";
$user_log ["article_id"] = $tender_userid;
$user_log ["result"] = 1;
$user_log ["content"] = "借款标[{$borrow_url}
]通过了复审,[<a href={$_G['system']['con_weburl']}
".U('Index/Index/index?site=protocol&nid='.$data['borrow_nid'])." target=_blank>点击此处</a>]查看协议书";
\usersClass::AddUsersLog ( $user_log );
$credit_log['user_id'] = $tender_userid;
$credit_log['nid'] = "tender_success";
$credit_log['code'] = "borrow";
$credit_log['type'] = "tender";
$credit_log['addtime'] = time();
$credit_log['article_id'] =$tender_id;
$credit_log['value'] = round($tender_account*0.01);
\creditClass::ActionCreditLog($credit_log);
if($borrow_result['is_Seconds']!=1)
{
$invite_status=0;
$spread_result=M('spread')->where("user_id={$tender_userid}
and borrow_nid='{$borrow_result['borrow_nid']}
' and status=0 and tender_id={$tender_id}
")->find();
if($spread_result!=null&&$spread_result!=false) $invite_status=M('users_info')->where("user_id={$spread_result['spread_userid']}
")->getField('invite_status');
if ($invite_status == 1) 
{
$fee_result = $_G ['system'] ['con_recommed_invest_incent']*0.01;
$tenderusername =M('users_info')->where("user_id={$tender_userid }
")->find();
$log_info ["user_id"] = $spread_result['spread_userid'];
$log_info ["nid"] = "tender_spread_".$borrow_nid .$tender_userid .$spread_result['spread_userid'].$tender_id;
$log_info ["money"] = round ( $tender_account * $fee_result,2 );
$log_info ["income"] = $log_info ["money"];
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $log_info ["money"];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_spread";
$log_info ["to_userid"] =$spread_result['spread_userid'];
$log_info ["remark"] = "投资推广客户[{$tenderusername['niname']}
]投标[{$borrow_url}
]成功所得的推广提成，投资金额{$tender_account}
，提成率{$_G ['system'] ['con_recommed_invest_incent']}
%";
\accountClass::AddLog ( $log_info );
$web ['money'] = $log_info ["money"];
$web ['user_id'] =$spread_result['spread_userid'];
$web ['nid'] = "other_spread_tender_".$spread_result['spread_userid'] ."_".time ();
$web ['type'] = "other_spread_tender";
$web ['remark'] = "推广投资客户[{$tenderusername['niname']}
]获得{$log_info["money"]}
独立投资推广费";
\accountClass::AddAccountWeb ( $web );
M('spread')->where("user_id={$tender_userid}
and borrow_nid='{$borrow_result['borrow_nid']}
' and status=0 and tender_id={$tender_id}
")->setField('status',1);
}
}
self::UpdateBorrowCount ( array ( "user_id"=>$tender_userid, "tender_success_times"=>1, "tender_success_account"=>$tender_account, "tender_frost_account"=>-$tender_account, "tender_recover_account"=>$recover_all, "tender_recover_wait"=>$recover_all, "tender_capital_account"=>$recover_capital_all, "tender_capital_wait"=>$recover_capital_all, "tender_interest_account"=>$recover_interest_all, "tender_interest_wait"=>$recover_interest_all, "tender_recover_times"=>$recover_times, "tender_recover_times_wait"=>$recover_times ) );
}
$nowtime = time ();
$endtime = get_times ( array ( "num"=>$borrow_result ["borrow_period"], "time"=>$nowtime ) );
if ($borrow_result ["borrow_style"] == 1) 
{
$_each_time = "每三个月后".date ( "d",$nowtime ) ."日";
$nexttime = get_times ( array ( "num"=>3, "time"=>$nowtime ) );
}
else 
{
$_each_time = "每月".date ( "d",$nowtime ) ."日";
$nexttime = get_times ( array ( "num"=>1, "time"=>$nowtime ) );
}
$_equal ["account"] = $borrow_result ['account'];
$_equal ["period"] = $borrow_result ["borrow_period"];
$_equal ["apr"] = $borrow_result ["borrow_apr"];
$_equal ["type"] = "all";
$equal_result = EqualInterest ( $_equal );
$sql = "update `{borrow}` set repay_account_all='{$equal_result['account_total']}
',repay_account_interest='{$equal_result['interest_total']}
',repay_account_capital='{$equal_result['capital_total']}
',repay_account_wait='{$equal_result['account_total']}
',repay_account_interest_wait='{$equal_result['interest_total']}
',repay_account_capital_wait='{$equal_result['capital_total']}
',repay_last_time='{$endtime}
',repay_next_time='{$nexttime}
',borrow_success_time='{$nowtime}
',repay_each_time='{$_each_time}
',repay_times='{$repay_times}
'  where borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
if ($borrow_result ["vouch_status"] == 1) 
{
$result = self::GetVouchList ( array ( "limit"=>"all", "borrow_nid"=>$borrow_nid ) );
if ($result != "") 
{
foreach ( $result as $key =>$value ) 
{
$vouch_account = $value ['account'];
$vouch_userid = $value ['user_id'];
$vouch_id = $value ['id'];
$vouch_award = $value ['award_account'];
$sql = "update `{borrow_vouch}` set status=1 where id = {$vouch_id}
";
M()->execute(presql($sql));
if ($borrow_result ["vouch_award_status"] == 1) 
{
$vouch_award_money = $vouch_account * $borrow_result ["vouch_award_scale"] * 0.01;
$log_info ["user_id"] = $vouch_userid;
$log_info ["nid"] = "vouch_success_award_".$vouch_userid ."_".$value ['id'] .$borrow_nid;
$log_info ["money"] = $vouch_award_money;
$log_info ["income"] = $vouch_award_money;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $vouch_award_money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "vouch_success_award";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "担保借款标[{$borrow_url}
]借款成功的担保奖励";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "vouch_success_awardpay_".$borrow_userid ."_".$value ['id'] .$borrow_nid;
$log_info ["money"] = $vouch_award_money;
$log_info ["income"] = 0;
$log_info ["expend"] = $vouch_award_money;
$log_info ["balance_cash"] = -$vouch_award_money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "vouch_success_awardpay";
$log_info ["to_userid"] = $vouch_userid;
$log_info ["remark"] = "担保借款标的[{$borrow_url}
]借款成功的担保奖励支出";
\accountClass::AddLog ( $log_info );
}
$_equal ["account"] = $vouch_account;
$_equal ["period"] = $borrow_result ["borrow_period"];
$_equal ["apr"] = $borrow_result ["borrow_apr"];
$_equal ["type"] = "";
$_equal ["style"] = $borrow_result ["borrow_style"];
$equal_result = EqualInterest ( $_equal );
foreach ( $equal_result as $period_key =>$value ) 
{
$sql = "insert into `{borrow_vouch_recover}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id='{$vouch_userid}
',status=0,vouch_id={$vouch_id}
,`borrow_nid`='{$borrow_nid}
',`borrow_userid`='{$borrow_userid}
',`order`='{$period_key}
',";
$sql .= "`repay_time`='{$value['repay_time']}
',`repay_account`='{$value['account_all']}
',";
$sql .= "`repay_interest`='{$value['account_interest']}
',`repay_capital`='{$value['account_capital']}
'";
M()->execute(presql($sql));
}
}
$_borrow_account = round ( $borrow_account / $borrow_period,2 );
for($i = 0;$i <$borrow_period;$i ++) 
{
if ($i == $borrow_period -1) 
{
$_borrow_account = $borrow_account -$_borrow_account * $i;
}
$repay_time = get_times ( array ( "time"=>time (), "num"=>$i +1 ) );
$sql = "insert into `{borrow_vouch_repay}` set borrow_nid={$borrow_nid}
,`addtime` = '".time () ."',`addip` = '".get_client_ip() ."',user_id=$borrow_userid ,`order` = {$i}
,status=0,repay_account = '{$_borrow_account}
',repay_time='{$repay_time}
'";
M()->execute(presql($sql));
}
}
$_data ["user_id"] = $borrow_userid;
$_data ["amount_type"] = "vouch_borrow";
$_data ["type"] = "borrow_success";
$_data ["oprate"] = "reduce";
$_data ["nid"] = "borrow_success_vouch_".$borrow_userid ."_".$borrow_nid .$value ["id"];
$_data ["account"] = $borrow_account;
$_data ["remark"] = "担保借款[{$borrow_url}
]审核通过扣去借款担保额度";
\borrowClass::AddAmountLog ( $_data );
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_vouch_times"=>1 ) );
}
else 
{
$_data ["user_id"] = $borrow_userid;
$_data ["amount_type"] = "borrow";
$_data ["type"] = "borrow_success";
$_data ["oprate"] = "reduce";
$_data ["nid"] = "borrow_success_credit_".$borrow_userid ."_".$borrow_nid .$value ["id"];
$_data ["account"] = $borrow_account;
$_data ["remark"] = "借款标[{$borrow_url}
]满标审核通过，借款信用额度减少";
\borrowClass::AddAmountLog ( $_data );
}
$remind ['nid'] = "borrow_review_yes";
$remind ['receive_userid'] = $borrow_userid;
$remind ['code'] = "borrow";
$remind ['article_id'] = $borrow_nid;
$remind ['title'] = "招标[{$borrow_name}
]满标审核成功";
$remind ['content'] = "你的借款标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."满标审核成功";
$remind ['phone_content']="你的借款标[{$borrow_name}
]在".date ( "Y-m-d",time () ) ."满标审核成功";
\remindClass::sendRemind ( $remind );
$user_log ["user_id"] = $borrow_userid;
$user_log ["code"] = "borrow";
$user_log ["type"] = "borrow_reverify_success";
$user_log ["operating"] = "success";
$user_log ["article_id"] = $borrow_userid;
$user_log ["result"] = 1;
$user_log ["content"] = "借款标[{$borrow_url}
]通过了复审,[<a href=".$_G['weburl'].U('Index/Index/index?site=protocol&nid='.$data['borrow_nid'])."  target=_blank>点击此处</a>]查看协议书";
\usersClass::AddUsersLog ( $user_log );
$_trend ['user_id'] = $borrow_userid;
$_trend ["type"] = "borrow_reverify_success";
$_trend ['content'] = "借款标[{$borrow_url}
]通过了复审";
if ($is_Seconds == 1) 
{
$list = M('borrow_repay')->where("borrow_nid='{$borrow_nid}
' AND user_id={$borrow_userid}
")->order('repay_time asc')->select();
$list = $list ?$list : array ();
$dataT = array ();
foreach ( $list as $key =>$value ) 
{
$dataT ['borrow_nid'] = $borrow_nid;
$dataT ['id'] = $value ['id'];
$dataT ['user_id'] = $borrow_userid;
$resultT = \borrowClass::BorrowRepay ( $dataT );
}
$log_info ["user_id"] = $borrow_userid;
$moeSeconds = round ( ($borrow_account / 100 * $borrow_apr) / 12,2 );
$log_info ["nid"] = "borrow_success_manage_".time () ."_".M()->getLastInsID();
$log_info ["money"] = $moeSeconds;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = +$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "返款操作秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
}
elseif ($status == 4) 
{
$tender_result = self::GetTenderList ( array ( "borrow_nid"=>$borrow_nid, "limit"=>"all" ) );
foreach ( $tender_result as $key =>$value ) 
{
$tender_userid = $value ['user_id'];
$tender_account = $value ['account'];
$tender_id = $value ['id'];
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_false_".$tender_userid ."_".$tender_id .$borrow_nid;
$log_info ["money"] = $tender_account;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = $tender_account;
$log_info ["frost"] = -$tender_account;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_false";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "招标[{$borrow_url}
]失败返回的投标额";
\accountClass::AddLog ( $log_info );
$remind ['nid'] = "tender_false";
$remind ['code'] = "borrow";
$remind ['article_id'] = $borrow_nid;
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "投资的标[{$borrow_name}
]满标审核失败";
$remind ['content'] = "你所投资的标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."审核失败,失败原因：{$data['reverify_remark']}
";
$remind ['phone_content']="投资的标[{$borrow_name}
]在".date ( "Y-m-d",time () ) ."满标审核失败";
\remindClass::sendRemind ( $remind );
$sql = "update `{borrow_tender}` set status=2 where id={$tender_id}
";
M()->execute(presql($sql));
self::UpdateBorrowCount ( array ( "user_id"=>$tender_userid, "tender_frost_account"=>-$tender_account ) );
if ($borrow_result ["vouch_status"] == 1) 
{
$result = self::GetVouchList ( array ( "limit"=>"all", "borrow_nid"=>$borrow_nid ) );
if ($result != "") 
{
foreach ( $result as $key =>$value ) 
{
$vouch_account = $value ['account'];
$vouch_userid = $value ['user_id'];
$vouch_id = $value ['id'];
$vouch_award = $value ['award_account'];
$sql = "update `{borrow_vouch}` set status=2 where id ={$vouch_id}
";
M()->execute(presql($sql));
$_data ["user_id"] = $vouch_userid;
$_data ["amount_type"] = "vouch_tender";
$_data ["type"] = "borrow_false";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrow_false_vouch_".$vouch_userid ."_".$borrow_nid .$value ["id"];
$_data ["account"] = $vouch_account;
$_data ["remark"] = "担保借款[{$borrow_url}
]审核失败借款担保额度返回";
\borrowClass::AddAmountLog ( $_data );
}
}
}
}
$remind ['nid'] = "borrow_review_no";
$remind ['code'] = "borrow";
$remind ['article_id'] = $borrow_nid;
$remind ['receive_userid'] = $borrow_userid;
$remind ['title'] = "你所申请的标[{$borrow_name}
]满标审核失败";
$remind ['content'] = "你所申请的标[{$borrow_url}
]在".date ( "Y-m-d",time () ) ."审核失败,失败原因：{$data['repayment_remark']}
";
$remind ['phone_content']="你所申请的标[{$borrow_name}
]在".date ( "Y-m-d",time () ) ."审核失败,失败原因：{$data['repayment_remark']}
";
if ($is_Seconds == 1) 
{
$log_info ["user_id"] = $borrow_userid;
$moeSeconds = round ( ($borrow_account / 100 * $borrow_apr) / 12,2 );
$log_info ["nid"] = "borrow_success_manage_".time () ."_".M()->getLastInsID();
$log_info ["money"] = $moeSeconds;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = +$moeSeconds;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$moeSeconds;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_borrow";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "满标审核失败,返回操作秒标时预先垫付利息{$moeSeconds}
元。";
\accountClass::AddLog ( $log_info );
}
\remindClass::sendRemind ( $remind );
}
if ($borrow_result ['award_status'] != 0) 
{
if ($status == 3 ||$borrow_result ['award_false'] == 1) 
{
$tender_result = self::GetTenderList ( array ( "borrow_nid"=>$borrow_nid, "limit"=>"all" ) );
foreach ( $tender_result as $key =>$value ) 
{
if ($borrow_result ['award_status'] == 1) 
{
$money = round ( ($value ['account'] / $borrow_account) * $borrow_result ['award_account'],2 );
}
elseif ($borrow_result ['award_status'] == 2) 
{
$money = round ( (($borrow_result ['award_scale'] / 100) * $value ['account']),2 );
}
$tender_id = $value ['id'];
$tender_userid = $value ['user_id'];
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_award_add_".$tender_userid ."_".$tender_id .$borrow_nid;
$log_info ["money"] = $money;
$log_info ["income"] = $money;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_award_add";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "借款[{$borrow_url}
]的借款奖励";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "borrow_award_lower_".$borrow_userid ."_".$tender_id .$borrow_nid;
$log_info ["money"] = $money;
$log_info ["income"] = 0;
$log_info ["expend"] = $money;
$log_info ["balance_cash"] = -$money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_award_lower";
$log_info ["to_userid"] = $tender_userid;
$log_info ["remark"] = "扣除借款[{$borrow_url}
]的奖励";
\accountClass::AddLog ( $log_info );
}
}
}
return $borrow_nid;
}
public static function GetInvest($data = array()) 
{
global $_G;
$borrow_nid = $data ['id'];
$result_borrow =M('borrow')->where("borrow_nid = '{$borrow_nid}
'")->find();
if ($result_borrow == null) 
{
return "borrow_nid_empty";
}
$user_id = $result_borrow ['user_id'];
$_data ["account"] = 100;
$_data ["period"] = $result_borrow ["borrow_period"];
$_data ["apr"] = $result_borrow ["borrow_apr"];
$_data ["style"] = $result_borrow ["borrow_style"];
$_data ["type"] = "all";
$_result = EqualInterest ( $_data );
$result_borrow ["borrow_interest"] = $_result ["interest_total"];
if (IsExiest ( $data ["hits"] ) == "auto") 
{
$sql = "update `{borrow}` set hits = hits+1 where  borrow_nid = '{$borrow_nid}
'";
M()->execute(presql($sql));
}
$result_borrow ["other_time"] = $result_borrow ["verify_time"] +$result_borrow ["borrow_valid_time"] * 60 * 60 * 24 -time ();
$result ['user'] =M('users')->where("user_id=$user_id")->field('p1.* as credit_pic')->find();
$result ['account'] = M('account')->where("user_id={$user_id}
")->find();
if ($_G ['user_id'] >0) 
{
$result ['user_account'] = M('account')->where("user_id={$_G['user_id']}
")->find();
}
$result ['amount'] = self::GetAmountUsers ( $user_id );
$result ["count"] = self::GetBorrowCount ( array ( "user_id"=>$user_id ) );
$result ['users_vip'] = M('users_vip')->alias('p1')->join(presql('`{admin}` as p2 on p1.kefu_userid = p2.id'))->where("p1.user_id={$user_id}
")->field("p1.*,p2.username as kefu_username")->find();
$result ['users_info'] = M("users_info")->where("user_id={$user_id}
")->find();
$_result = M('borrow_repay')->where("borrow_nid = '{$borrow_nid}
' and user_id='{$user_id}
' and repay_status=0")->find();
$result_borrow ['late_status'] = 0;
if ($_result != null) 
{
foreach ( $_result as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['capital'] ) );
if ($late_result ['late_days'] >0) 
{
$result_borrow ['late_status'] = 1;
}
}
}
$result ['borrow'] = $result_borrow;
return $result;
}
public static function GetTenderBorrowList($data) 
{
global $_G;
$user_id = $data ['user_id'];
$_sql = "1=1";
if (IsExiest ( $data ['type'] ) != "") 
{
if ($data ['type'] == "wait") 
{
$_sql .= " and p1.recover_times<p2.borrow_period and p1.user_id={$user_id}
and p1.change_status!=1";
}
elseif ($data ['type'] == "change") 
{
$_sql .= " and p1.recover_account_all!=p1.recover_account_yes and  p1.change_userid={$user_id}
and p1.change_status=1";
}
elseif ($data ['type'] == "yes") 
{
$_sql .= " and p1.recover_account_yes=p1.recover_account_all and p1.user_id={$user_id}
and p1.change_status=0";
}
}
else 
{
$_sql .= " and p1.user_id={$user_id}
";
}
if (IsExiest ( $data ['dotime1'] ) != "") 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != "") 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['tender_status'] ) != "") 
{
$_sql .= " and p1.status = {$data['tender_status']}
";
}
if (IsExiest ( $data ['keywords'] ) != "") 
{
$_sql .= " and (p2.`name` like '%".urldecode ( $data ['keywords'] ) ."%') ";
}
if (IsExiest ( $data ['borrow_status'] ) != "") 
{
$_sql .= " and (p2.status = {$data['borrow_status']}
or p2.is_flow=1) ";
}
$field = "p2.*,p1.recover_times,p1.account as tender_account,p1.recover_account_wait,p1.recover_account_yes,p1.user_id as tuser,p1.recover_account_all,p1.account_tender,p1.id as tid,p2.account as borrow_account,p2.borrow_account_yes,p3.username as borrow_username,p4.credits,p5.account as change_account,p5.id as change_id,p6.niname as t_nikename";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid=p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p2.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p4 on p2.user_id=p4.user_id') )->join ( presql ( '`{borrow_change}` as p5 on p5.tender_id=p1.id') )->join ( presql ( '`{users_info}` as p6 on p6.user_id=p1.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
}
$row = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid=p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p2.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p4 on p2.user_id=p4.user_id') )->join ( presql ( '`{borrow_change}` as p5 on p5.tender_id=p1.id') )->join ( presql ( '`{users_info}` as p6 on p6.user_id=p1.user_id') )->where ( $_sql )->count ();
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid=p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p2.user_id=p3.user_id') )->join ( presql ( '`{credit}` as p4 on p2.user_id=p4.user_id') )->join ( presql ( '`{borrow_change}` as p5 on p5.tender_id=p1.id') )->join ( presql ( '`{users_info}` as p6 on p6.user_id=p1.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$list = $list ?$list : array ();
foreach ( $list as $key =>$value ) 
{
$recoverresult = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
and (repay_status=1 or repay_web=1)")->field ( 'count(1) as num')->find ();
$list [$key] ['wait_times'] = $value ['borrow_period'] -$recoverresult ['num'];
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$chresult = M ( 'borrow_change')->where ( "tender_id={$value['tid']}
")->field ( 'status,buy_time')->find ();
if ($chresult ['status'] == 1) 
{
$recresult = M ( 'borrow_recover')->where ( "user_id={$value['tuser']}
and borrow_nid={$value['borrow_nid']}
and (recover_yestime>{$chresult['buy_time']}
or recover_yestime is NULL) and tender_id={$value['tid']}
")->field ( 'count(1) as count_all,sum(recover_account_yes) as recover_account_yes_all')->find ();
$list [$key] ["recover_account_yes_all"] = $recresult ['recover_account_yes_all'];
$list [$key] ["count_all"] = $recresult ['count_all'];
}
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function GetRecoverList($data) 
{
global $_G;
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id={$data['user_id']}
";
}
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.status={$data['status']}
";
}
if (IsExiest ( $data ['recover_status'] ) != false) 
{
if ($data ['recover_status'] == 2) 
{
$_sql .= " and p1.recover_status=0";
}
else 
{
$_sql .= " and p1.recover_status={$data['recover_status']}
";
}
}
if (IsExiest ( $data ['borrow_status'] ) != false) 
{
$_sql .= " and (p2.status={$data['borrow_status']}
or p2.is_flow=1)";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p3.username like '%{$data['username']}
%' ";
}
if (IsExiest ( $data ['web'] ) != false) 
{
$_sql .= " and p6.web_status=2 and p6.status=1";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.recover_time > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.recover_time < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['type'] ) != false) 
{
if ($data ['type'] == "yes") 
{
$_sql .= " and (p1.recover_status =1 or p1.recover_web=1) and p5.change_status!=1";
}
elseif ($data ['type'] == "wait") 
{
$_sql .= " and (p1.recover_status !=1 and p1.recover_web!=1) and p5.change_status!=1";
}
elseif ($data ['type'] == "web") 
{
$_sql .= " and p1.recover_web=1";
}
}
if (IsExiest ( $data ['change'] ) != false) 
{
$_sql .= " and p1.recover_status =1 and p5.change_status=1";
}
if (IsExiest ( $data ['keywords'] ) != "") 
{
$_sql .= " and (p2.name like '%".urldecode ( $data ['keywords'] ) ."%') ";
}
$_order = " order by p2.id ";
if (IsExiest ( $data ['order'] ) != "") 
{
if ($data ['order'] == "repay_time") 
{
$_order = " order by p2.id desc,p1.recover_time desc";
}
elseif ($data ['order'] == "order") 
{
$_order = " order by p1.`order` desc,p1.id desc ";
}
elseif ($data ['order'] == "recover_status") 
{
$_order = " order by p1.`recover_status` asc,p1.id desc ";
}
}
$field = 'p1.*,p1.recover_account_yes as recover_recover_account_yes,p2.name as borrow_name,p2.borrow_period,p2.nikename,p2.borrow_apr,p2.borrow_style,p3.username,p4.username as borrow_username,p4.user_id as borrow_userid,p5.*,p5.recover_account_yes as tender_recover_account_yes,p6.buy_time';
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on  p2.borrow_nid = p1.borrow_nid') )->join ( presql ( '`{users}` as p3 on  p3.user_id = p1.user_id') )->join ( presql ( '`{users}` as p4 on  p4.user_id = p2.user_id') )->join ( presql ( '`{borrow_tender}` as p5 on  p1.tender_id = p5.id') )->join ( presql ( '`{borrow_change}` as p6 on  p1.tender_id = p6.tender_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->select ();
foreach ( $list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['recover_time'], "account"=>$value ['recover_capital'] ) );
if ($data ['type'] == "web") 
{
if ($value ['recover_status'] == 0) 
{
$list [$key] ['late_days'] = $late ['late_days'];
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'],2 );
}
}
else 
{
$late = self::LateInterest ( array ( "time"=>$value ['recover_time'], "account"=>$value ['recover_capital'], "yestime"=>$value ['recover_yestime'] ) );
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'],2 );
}
$list [$key] ['late_days'] = $value ['late_days'];
}
}
else 
{
if ($value ['recover_status'] == 0) 
{
$list [$key] ['late_days'] = $late ['late_days'];
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = 0;
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
}
else 
{
$list [$key] ['late_interest'] = $value ['late_interest'];
$list [$key] ['late_days'] = $value ['late_days'];
}
}
$list [$key] ['all_recover'] = $value ['recover_capital'] +$value ['recover_interest'] +$value ['late_interest'];
}
return $list;
}
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$row = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on  p2.borrow_nid = p1.borrow_nid') )->join ( presql ( '`{users}` as p3 on  p3.user_id = p1.user_id') )->join ( presql ( '`{users}` as p4 on  p4.user_id = p2.user_id') )->join ( presql ( '`{borrow_tender}` as p5 on  p1.tender_id = p5.id') )->join ( presql ( '`{borrow_change}` as p6 on  p1.tender_id = p6.tender_id') )->where ( $_sql )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on  p2.borrow_nid = p1.borrow_nid') )->join ( presql ( '`{users}` as p3 on  p3.user_id = p1.user_id') )->join ( presql ( '`{users}` as p4 on  p4.user_id = p2.user_id') )->join ( presql ( '`{borrow_tender}` as p5 on  p1.tender_id = p5.id') )->join ( presql ( '`{borrow_change}` as p6 on  p1.tender_id = p6.tender_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
foreach ( $list as $key =>$value ) 
{
$_equal ["account"] = $value ["recover_capital"];
$_equal ["period"] = $value ["borrow_period"];
$_equal ["apr"] = $value ["borrow_apr"];
$_equal ["style"] = $value ["borrow_style"];
$equal_result = EqualInterest ( $_equal );
$list[$key]['recover_num']=count($equal_result);
$all_capital += $value ['recover_capital'];
$late = self::LateInterest ( array ( "time"=>$value ['recover_time'], "account"=>$value ['recover_capital'] ) );
if ($data ['showtype'] == "web") 
{
if ($value ['recover_status'] == 1) 
{
$list [$key] ['late_days'] = $value ['late_days'];
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $value ['late_days'] / 2,2 );
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $value ['late_days'],2 );
}
}
else 
{
$list [$key] ['late_days'] = $late ['late_days'];
$late = self::LateInterest ( array ( "time"=>$value ['recover_time'], "account"=>$value ['recover_capital'], "yestime"=>$value ['recover_yestime'] ) );
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'],2 );
}
}
}
else 
{
if ($value ['recover_status'] == 1) 
{
$list [$key] ['late_interest'] = $value ['late_interest'];
$list [$key] ['late_days'] = $value ['late_days'];
}
else 
{
$list [$key] ['late_days'] = $late ['late_days'];
if ($late ['late_days'] <30) 
{
$list [$key] ['late_interest'] = 0;
}
else 
{
$list [$key] ['late_interest'] = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
}
}
$list [$key] ['all_recover'] = $value ['recover_capital'] +$value ['recover_interest'] +$value ['late_interest'];
if ($value ['recover_yestime'] <$value ['buy_time']) 
{
$change [$key] ['recover_interest_yes'] = $value ['recover_interest_yes'];
$change [$key] ['borrow_name'] = $value ['borrow_name'];
$change [$key] ['recover_time'] = $value ['recover_time'];
$change [$key] ['borrow_userid'] = $value ['borrow_userid'];
$change [$key] ['borrow_username'] = $value ['borrow_username'];
$change [$key] ['borrow_nid'] = $value ['borrow_nid'];
$change [$key] ['recover_period'] = $value ['recover_period'];
$change [$key] ['borrow_period'] = $value ['borrow_period'];
$change [$key] ['recover_account'] = $value ['recover_account'];
$change [$key] ['recover_capital'] = $value ['recover_capital'];
$change [$key] ['recover_interest'] = $value ['recover_interest'];
$change [$key] ['late_interest'] = $value ['late_interest'];
$change [$key] ['late_days'] = $value ['late_days'];
$change [$key] ['recover_status'] = $value ['recover_status'];
}
if ($value ['recover_yestime'] >$value ['buy_time'] ||$value ['recover_yestime'] == "") 
{
$web [$key] ['recover_interest_yes'] = $value ['recover_interest_yes'];
$web [$key] ['borrow_name'] = $value ['borrow_name'];
$web [$key] ['recover_time'] = $value ['recover_time'];
$web [$key] ['borrow_userid'] = $value ['borrow_userid'];
$web [$key] ['borrow_username'] = $value ['borrow_username'];
$web [$key] ['borrow_nid'] = $value ['borrow_nid'];
$web [$key] ['recover_period'] = $value ['recover_period'];
$web [$key] ['borrow_period'] = $value ['borrow_period'];
$web [$key] ['recover_account'] = $value ['recover_account'];
$web [$key] ['recover_capital'] = $value ['recover_capital'];
$web [$key] ['recover_interest'] = $value ['recover_interest'];
$web [$key] ['late_interest'] = $list [$key] ['late_interest'];
$web [$key] ['late_days'] = $list [$key] ['late_days'];
$web [$key] ['recover_status'] = $value ['recover_status'];
$web [$key] ['recover_web'] = $list [$key] ['recover_web'];
if ($web [$key] ['recover_status'] == 1 ||$web [$key] ['recover_web'] == 1) 
{
$all_recover += $web [$key] ['recover_account'];
}
}
}
if ($data ['style'] == "change") 
{
$total = count ( $change );
$total_page = ceil ( $total / $epage );
$index = $epage * ($page -1);
$limit = " limit {$index}
, {$epage}
";
}
elseif ($data ['style'] == "web") 
{
$total = count ( $web );
$total_page = ceil ( $total / $epage );
$index = $epage * ($page -1);
$limit = " limit {$index}
, {$epage}
";
}
else 
{
$total = $row ['num'];
$total_page = ceil ( $total / $epage );
$index = $epage * ($page -1);
$limit = " limit {$index}
, {$epage}
";
}
return array ( 'list'=>$list, 'change'=>$change, 'all_capital'=>$all_capital, 'all_recover'=>$all_recover, 'web'=>$web, 'page'=>$show ) ;
}
public static function LateInterest($data) 
{
global $_G;
if (IsExiest ( $data ['yestime'] ) != "") 
{
$now_time = get_mktime ( date ( "Y-m-d",$data ['yestime'] ) );
}
else 
{
$now_time = get_mktime ( date ( "Y-m-d",time () ) );
}
$repayment_time = get_mktime ( date ( "Y-m-d",$data ['time'] ) );
$late_days = ($now_time -$repayment_time) / (60 * 60 * 24);
$_late_days = explode ( ,$late_days );
$late_days = ($_late_days [0] <0) ?0 : $_late_days [0];
if ($late_days >0 &&$late_days <= 3) 
{
$late_fee = isset ( $_G ['system'] ['con_borrow_late_fee_3'] ) ?$_G ['system'] ['con_borrow_late_fee_3'] : 0.005;
}
elseif ($late_days >3 &&$late_days <= 30) 
{
$late_fee = isset ( $_G ['system'] ['con_borrow_late_fee_30'] ) ?$_G ['system'] ['con_borrow_late_fee_30'] : 0.007;
}
elseif ($late_days >30 &&$late_days <= 90) 
{
$late_fee = isset ( $_G ['system'] ['con_borrow_late_fee_90'] ) ?$_G ['system'] ['con_borrow_late_fee_90'] : 0.008;
}
elseif ($late_days >90) 
{
$late_fee = isset ( $_G ['system'] ['con_borrow_late_fee_all'] ) ?$_G ['system'] ['con_borrow_late_fee_all'] : 0.01;
}
if ($late_days >4 &&$late_days <= 10) 
{
$manage_fee = isset ( $_G ['system'] ['con_borrow_late_manage_fee_10'] ) ?$_G ['system'] ['con_borrow_late_manage_fee_10'] : 0.002;
}
elseif ($late_days >10 &&$late_days <= 30) 
{
$manage_fee = isset ( $_G ['system'] ['con_borrow_late_manage_fee_30'] ) ?$_G ['system'] ['con_borrow_late_manage_fee_30'] : 0.003;
}
elseif ($late_days >30 &&$late_days <= 90) 
{
$manage_fee = isset ( $_G ['system'] ['con_borrow_late_manage_fee_90'] ) ?$_G ['system'] ['con_borrow_late_manage_fee_90'] : 0.004;
}
elseif ($late_days >90) 
{
$manage_fee = isset ( $_G ['system'] ['con_borrow_late_manage_fee_all'] ) ?$_G ['system'] ['con_borrow_late_manage_fee_all'] : 0.005;
}
$late_interest = round ( $data ['capital'] * $late_fee * $late_days,2 );
$late_manage = round ( $data ['account'] * $manage_fee * $late_days,2 );
return array ( "late_days"=>$late_days, "late_interest"=>$late_interest, "late_reminder"=>$late_manage );
}
public static function AddVouch($data = array()) 
{
global $_G;
if (!isset ( $data ['borrow_nid'] ) ||$data ['borrow_nid'] == "") 
{
return "borrow_nid_empty";
}
if (!isset ( $data ['user_id'] ) ||$data ['user_id'] == "") 
{
return "borrow_user_id_empty";
}
$result_borrow = M('borrow')->where("borrow_nid = '{$data['borrow_nid']}
'")->find();
if ($result_borrow == null) 
{
return "borrow_not_exiest";
}
if ($data ['user_id'] == $result_borrow ['user_id']) 
{
return "borrow_vouch_not_self";
}
$borrow_url = "<a href=".$_G['system']['con_weburl'].U('Index/Index/index?site=full_success&nid='.$result_borrow['borrow_nid'])." target=_blank>{$result_borrow['name']}
</a>";
if ($_G ['user_result'] ['islock'] == 1) 
{
return "user_islock";
}
$data['addtime']=time();
$data['addip']=get_client_ip();
$vouch_id = M('borrow_vouch')->add($data);
if ($vouch_id >0) 
{
$sql = "update  {borrow}  set vouch_account_yes=vouch_account_yes+{$data['account']}
,vouch_account_wait=vouch_account_wait-{$data['account']}
,vouch_times=vouch_times+1,vouch_account_scale = 100*(vouch_account_yes/vouch_account)  where borrow_nid='{$data['borrow_nid']}
'";
M()->execute(presql($sql));
$_data ["user_id"] = $data ['user_id'];
$_data ["amount_type"] = "vouch_tender";
$_data ["type"] = "vouch_tender";
$_data ["oprate"] = "reduce";
$_data ["nid"] = "vouch_tender_".$data ['user_id'] ."_".time ();
$_data ["account"] = $data ['account'];
$_data ["remark"] = "担保借款[{$borrow_url}
]审核通过扣去借款担保额度";
\borrowClass::AddAmountLog ( $_data );
}
return $vouch_id;
}
public static function BorrowRepay($data = array()) 
{
global $_G;
if (IsExiest ( $data ['id'] ) == "") 
{
return "borrow_repay_id_empty";
}
if (IsExiest ( $data ['user_id'] ) == "") 
{
return "borrow_user_id_empty";
}
if (IsExiest ( $data ['borrow_nid'] ) == "") 
{
return "borrow_nid_empty";
}
$result = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{users_info}` as p3 on p1.user_id=p3.user_id') )->where ( "p1.id={$data['id']}
and p1.user_id={$data['user_id']}
and p1.borrow_nid='{$data['borrow_nid']}
'")->field ( 'p1.*,p2.username,p3.niname as nikename')->find ();
if ($result == null) 
{
return "borrow_repay_id_empty";
}
if ($result ["user_id"] != $data ["user_id"]) 
{
return "borrow_user_id_empty";
}
if ($result ["status"] != 1) 
{
return "borrow_repay_error";
}
if ($result ["repay_status"] == 1) 
{
return "borrow_repay_yes";
}
$repay_id = $data ["id"];
$borrow_userid = $data ["user_id"];
$borrow_username = $result ["username"];
$nikename=$result['nikename'];
$borrow_nid = $result ["borrow_nid"];
$repay_web = $result ["repay_web"];
$repay_vouch = $result ["repay_vouch"];
$repay_period = $result ["repay_period"];
$repay_account = $result ["repay_account"];
$repay_capital = $result ["repay_capital"];
$repay_interest = $result ["repay_interest"];
$repay_time = $result ["repay_time"];
if ($repay_period != 0) 
{
$_repay_period = $repay_period -1;
$result = M ( 'borrow_repay')->where ( "`repay_period`=$_repay_period and borrow_nid={$borrow_nid}
")->field ( 'repay_status')->find ();
if ($result != null &&$result ['repay_status'] != 1) 
{
return "borrow_repay_up_notrepay";
}
}
$result = M ( 'borrow')->where ( "borrow_nid = '{$borrow_nid}
'")->find ();
$borrow_forst_account = $result ["borrow_forst_account"];
$borrow_name = $result ['name'];
$vouch_status = $result ["vouch_status"];
$borrow_period = $result ["borrow_period"];
$repay_times = $result ["repay_times"];
$borrow_account = $result ["account"];
$borrow_style = $result ["borrow_style"];
$borrow_url = "<a href=".$_G['system']['con_weburl'].U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['name']}
</a>";
$late = self::LateInterest ( array ( "time"=>$repay_time, "account"=>$repay_account, "capital"=>$repay_capital ) );
$late_days = $late ['late_days'];
$late_interest = round ( $repay_account / 100 * 0.4 * $late_days,2 );
$late_reminder = $late ['late_reminder'];
$late_account = $late_interest;
$account_result = \accountClass::GetAccountUsers ( array ( "user_id"=>$borrow_userid ) );
if ($account_result ['balance'] <$repay_account +$late_account) 
{
return "borrow_repay_account_use_none";
}
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "repay_".$borrow_userid ."_".$borrow_nid .$repay_id;
$log_info ["money"] = $repay_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $repay_account;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = -$repay_account;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_repay";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]借款标第".($repay_period +1) ."期还款";
\accountClass::AddLog ( $log_info );
if ($repay_web == 1) 
{
$log_info ["user_id"] = 0;
$log_info ["nid"] = "repay_web_0_".$borrow_nid .$repay_id;
$log_info ["money"] = $repay_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $repay_account;
$log_info ["balance_cash"] = $repay_account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "web_repay";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]还款，网站垫付后所得收入".$borrow_username;
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = 0;
$log_info ["nid"] = "repay_late_web_0_".$borrow_nid .$repay_id;
$log_info ["money"] = $late_interest;
$log_info ["income"] = 0;
$log_info ["expend"] = $late_interest;
$log_info ["balance_cash"] = $late_interest;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "repay_late_web";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "网站垫付后的还款罚息收入".$borrow_username;
\accountClass::AddLog ( $log_info );
$_recover = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow_tender}` as p2 on p1.tender_id=p2.id') )->where ( "p1.`recover_period` = '{$repay_period}
' and p1.borrow_nid='{$borrow_nid}
'")->field ( 'p1.*,p2.change_status,p2.change_userid')->select ();
foreach ( $_recover as $key =>$value ) 
{
$_sql = "update  `{borrow_recover}` set recover_status=1 where id ={$value['id']}
";
M ()->execute ( presql ( $sql ) );
}
}
$vip_result = self::GetBorrowVip ( array ("user_id"=>$borrow_userid) );
$vip_fee = $vip_result ['fee'];
if ($borrow_style != 5) 
{
if ($vip_result ['vip'] == 0) 
{
$borrow_manage_fee = isset ( $_G ['system'] ["con_borrow_manage_fee"] ) ?$_G ['system'] ["con_borrow_manage_fee"] : 0.5;
}
else 
{
$borrow_manage_fee = (isset ( $_G ['system'] ["con_borrow_manage_vip_fee"] ) ?$_G ['system'] ["con_borrow_manage_vip_fee"] : 0.4) * $vip_fee;
}
$manage_fee = $repay_capital * $borrow_manage_fee * 0.01;
}
if ($late_interest >0) 
{
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "borrow_repay_late_".$borrow_userid ."_".$borrow_nid .$repay_id;
$log_info ["money"] = $late_interest;
$log_info ["income"] = 0;
$log_info ["expend"] = $late_interest;
$log_info ["balance_cash"] = -$late_interest;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_repay_late";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]借款第".($repay_period +1) ."期的逾期金额的扣除";
\accountClass::AddLog ( $log_info );
}
if ($repay_period +1 == $repay_times) 
{
$credit_log ['user_id'] = $borrow_userid;
$credit_log ['nid'] = "borrow_repay_all";
$credit_log ['code'] = "borrow";
$credit_log ['type'] = "repay_all";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $repay_id;
$credit_log ['value'] = round ( $borrow_account / 100 );
$credit_log ['remark'] = "借款[{$borrow_url}
]全部还完所得积分";
\creditClass::ActionCreditLog ( $credit_log );
}
$sql = "update`{borrow_repay}` set late_days = '{$late_days}
',late_interest = '{$late_interest}
',late_reminder = '{$late_reminder}
' where id = {$repay_id}
";
M ()->execute ( presql ( $sql ) );
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_repay_yes_times"=>1, "borrow_repay_wait_times"=>-1, "borrow_repay_yes"=>$repay_account, "borrow_repay_wait"=>-$repay_account, "borrow_repay_interest_yes"=>$repay_interest, "borrow_repay_interest_wait"=>-$repay_interest, "borrow_repay_capital_yes"=>$repay_capital, "borrow_repay_capital_wait"=>-$repay_capital ) );
if ($repay_vouch == 1) 
{
$result = M ( 'borrow_vouch_recover')->where ( "`order` = '{$repay_period}
' and borrow_nid='{$borrow_nid}
'")->select ();
$late_rate = isset ( $_G ['system'] ['con_late_rate'] ) ?$_G ['system'] ['con_late_rate'] : 0.008;
foreach ( $result as $key =>$value ) 
{
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "vouch_tender_repay_yes";
$log ['money'] = $value ['repay_account'];
$log ['total'] = $account_result ['total'] +$log ['money'];
$log ['use_money'] = $account_result ['use_money'] +$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'];
$log ['use_money_yes'] = $account_result ['use_money_yes'] +$log ['money'];
$log ['use_money_no'] = $account_result ['use_money_no'];
$log ['to_user'] = $borrow_userid;
$log ['remark'] = "客户（{$borrow_username}
）对[{$borrow_url}
]借款担保垫付的还款";
\accountClass::AddLog ( $log );
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "tender_interest_fee";
$vip_result = self::GetBorrowVip ( array ( "user_id"=>$value ['user_id'] ) );
$UsersVip = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
if ($UsersVip ['status'] == 1) 
{
$_fee = isset ( $_G ['system'] ['con_borrow_interest_vip_fee'] ) ?$_G ['system'] ['con_borrow_interest_vip_fee'] * 0.01 : 0.1;
}
else 
{
$_fee = isset ( $_G ['system'] ['con_borrow_interest_fee'] ) ?$_G ['system'] ['con_borrow_interest_fee'] * 0.01 : 0.1;
}
if ($_fee >0 &&$_fee != "0") 
{
$log ['money'] = $value ['recover_interest'] * $_fee;
$log ['total'] = $account_result ['total'] -$log ['money'];
$log ['use_money'] = $account_result ['use_money'] -$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'];
$log ['use_money_yes'] = $account_result ['use_money_yes'] -$log ['money'];
$log ['use_money_no'] = $account_result ['use_money_no'];
$log ['to_user'] = 0;
$log ['remark'] = "用户成功还款[$borrow_url]扣除利息的管理费";
\accountClass::AddLog ( $log );
}
$remind ['nid'] = "loan_pay";
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "客户({$nikename}
)对[{$borrow_name}
]借款的还款";
$remind ['content'] = "客户({$nikename}
)在".date ( "Y-m-d H:i:s") ."对[{$borrow_url}
}</a>]借款的还款,还款金额为￥{$value['repay_account']}
";
\remindClass::sendRemind ( $remind );
if ($late_days >30) 
{
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "vouch_repay_late_recover";
$log ['money'] = round ( (($value ['repay_capital'] * $late_rate * $late_days) / 2),2 );
$log ['total'] = $account_result ['total'] +$log ['money'];
$log ['use_money'] = $account_result ['use_money'] +$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'];
$log ['use_money_yes'] = $account_result ['use_money_yes'] +$log ['money'];
$log ['use_money_no'] = $account_result ['use_money_no'];
$log ['to_user'] = $data ['user_id'];
$log ['remark'] = "[{$borrow_url}
]第".($repay_period +1) ."期借款标逾期并少于30天的担保垫付逾期利息收入";
\accountClass::AddLog ( $log );
}
}
}
if ($repay_web != 1 &&$repay_vouch != 1) 
{
$result = M ( 'borrow_recover')->alias('p1')->join ( presql ( '`{borrow_tender}` as p2 on p1.tender_id=p2.id') )->where ( "p1.`recover_period` = '{$repay_period}
' and p1.borrow_nid='{$borrow_nid}
'")->field ( 'p1.*,p2.change_status,p2.change_userid')->select ();
$re_time = (strtotime ( date ( "Y-m-d",$repay_time ) ) -strtotime ( date ( "Y-m-d",time () ) )) / (60 * 60 * 24);
foreach ( $result as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['recover_time'], "capital"=>$value ['recover_capital'] ) );
if ($late ['late_days'] >30) 
{
$late_interest = 0;
$money = round ( $value ['recover_account'] * 0.004 * $late ['late_days'],2 );
}
else 
{
$late_interest = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
$money = round ( $value ['recover_account'] * 0.004 * $late ['late_days'] / 2,2 );
}
$sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = recover_account ,recover_capital_yes = recover_capital ,recover_interest_yes = recover_interest ,status=1,recover_status=1,late_days={$late['late_days']}
,late_interest={$late_interest}
where id = {$value['id']}
";
M ()->execute ( presql ( $sql ) );
if ($late ['late_days'] >0) 
{
$log_info ["user_id"] = 0;
$log_info ["nid"] = "repay_0_".$borrow_nid .$repay_id .$value ['id'];
$log_info ["money"] = $money;
$log_info ["income"] = 0;
$log_info ["expend"] = $money;
$log_info ["balance_cash"] = -$money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "late_repay_web";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]还款，网站逾期罚息收入".$money .$borrow_username;
\accountClass::AddLog ( $log_info );
}
$sql = "update  `{borrow_tender}` set recover_times=recover_times+1,recover_account_yes= recover_account_yes + {$value['recover_account']}
,recover_account_capital_yes = recover_account_capital_yes  + {$value['recover_capital']}
,recover_account_interest_yes = recover_account_interest_yes + {$value['recover_interest']}
,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = {$value['tender_id']}
";
M ()->execute ( presql ( $sql ) );
if ($value ['change_status'] == 1) 
{
$value ['user_id'] = $value ['change_userid'];
if ($value ['change_userid'] == 0 ||$value ['change_userid'] == "") 
{
$value ['user_id'] = 0;
}
}
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "tender_repay_yes_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = $value ['recover_account'];
$log_info ["income"] = $value ['recover_account'];
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $value ['recover_account'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = -$value ['recover_account'];
$log_info ["type"] = "tender_repay_yes";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "客户（{$borrow_username}
）对[{$borrow_url}
]借款标的第".($repay_period +1) ."期还款";
\accountClass::AddLog ( $log_info );
$vip_result = self::GetBorrowVip ( array ( "user_id"=>$value ['user_id'] ) );
$vip_fee = $vip_result ['fee'];
$UsersVip = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
if ($value ['user_id'] != 0) 
{
if ($UsersVip ['status'] == 1) 
{
$t_fee = isset ( $_G ['system'] ['con_borrow_interest_vip_fee'] ) ?$_G ['system'] ['con_borrow_interest_vip_fee'] * 0.01 : 0.1;
}
else 
{
$t_fee = isset ( $_G ['system'] ['con_borrow_interest_fee'] ) ?$_G ['system'] ['con_borrow_interest_fee'] * 0.01 : 0.1;
}
$tender_fee = 0;
$tender_fee = $value['recover_interest']*$t_fee;
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "fengxianchi_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = $tender_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $tender_fee;
$log_info ["balance_cash"] = -$tender_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "用户成功对借款标[$borrow_url]第".($repay_period +1) ."期进行扣除利息的管理费";
\accountClass::AddLog ( $log_info );
}
if ($tender_credit_nid != "") 
{
$credit_blog ['user_id'] = $value ['user_id'];
$credit_blog ['nid'] = $tender_credit_nid;
$credit_blog ['code'] = "borrow";
$credit_blog ['type'] = "tender_repay";
$credit_blog ['addtime'] = time ();
$credit_blog ['article_id'] = $repay_id;
$credit_blog ['remark'] = "用户还款[{$borrow_url}
]第{$repay_period}
期投资积分";
\creditClass::ActionCreditLog ( $credit_blog );
}
if ($value ['repay_period'] +1 == $repay_times) 
{
$credit_blog ['user_id'] = $value ['user_id'];
$credit_blog ['nid'] = "tender_repay_time";
$credit_blog ['code'] = "borrow";
$credit_blog ['type'] = "tender";
$credit_blog ['addtime'] = time ();
$credit_blog ['article_id'] = $repay_id;
$credit_blog ['remark'] = "收到借款[{$borrow_url}
]完整本息还款积分";
\creditClass::ActionCreditLog ( $credit_blog );
}
if ($late_days >0 &&$late_days <31) 
{
if ($value ['user_id'] != 0) 
{
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "tender_late_repay_yes_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = $late_interest;
$log_info ["income"] = $late_interest;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $late_interest;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_late_repay_yes";
$log_info ["to_userid"] = $value ['user_id'];
$log_info ["remark"] = "客户（{$borrow_username}
）对[{$borrow_url}
]借款逾期还款的逾期利息";
\accountClass::AddLog ( $log_info );
}
else 
{
$log_info ["user_id"] = 0;
$log_info ["nid"] = "web_tender_late_repay_yes_0_".$borrow_nid .$value ['id'];
$log_info ["money"] = $late_interest;
$log_info ["income"] = 0;
$log_info ["expend"] = $late_interest;
$log_info ["balance_cash"] = $late_interest;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "web_tender_late_repay_yes";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "借款人对[{$borrow_url}
]借款逾期还款的逾期利息{$borrow_username}
";
\accountClass::AddLog ( $log_info );
}
}
if ($value ['change_status'] != 1) 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_recover_times_yes"=>1, "tender_recover_times_wait"=>-1, "tender_recover_yes"=>$value ['recover_account'], "tender_recover_wait"=>-$value ['recover_account'], "tender_capital_yes"=>$value ['recover_capital'], "tender_capital_wait"=>-$value ['recover_capital'], "tender_interest_yes"=>$value ['recover_interest'], "tender_interest_wait"=>-$value ['recover_interest'], "fee_account"=>$tender_fee, "fee_tender_account"=>$tender_fee ) );
}
else 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_interest_yes"=>$value ['recover_interest'] ) );
}
$remind ['nid'] = "loan_pay";
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "客户（{$nikename}
）对[{$borrow_name}
]借款的还款";
$remind ['content'] = "客户（{$nikename}
）在".date ( "Y-m-d H:i:s") ."对[{$borrow_url}
}</a>]借款的还款,还款金额为￥{$value['recover_account']}
";
\remindClass::sendRemind ( $remind );
}
}
$re_time = (strtotime ( date ( "Y-m-d",$repay_time ) ) -strtotime ( date ( "Y-m-d",time () ) )) / (60 * 60 * 24);
$borrow_credit_nid = "";
$tender_credit_nid = "";
if ($re_time != 0) 
{
if ($re_time <0) 
{
if ($re_time >= -3 &&$re_time <= -1) 
{
$borrow_credit_nid = "borrow_repay_slow";
$tender_credit_nid = "tender_repay_slow";
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_repay_late_one"=>1 ) );
}
elseif ($re_time >= -30 &&$re_time <-3) 
{
$borrow_credit_nid = "borrow_repay_late_common";
$tender_credit_nid = "tender_repay_late_common";
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_repay_late_two"=>1 ) );
}
elseif ($re_time >= -90 &&$re_time <-30) 
{
$borrow_credit_nid = "borrow_repay_late_serious";
$tender_credit_nid = "tender_repay_late_serious";
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_repay_late_three"=>1 ) );
}
elseif ($re_time <-90) 
{
$borrow_credit_nid = "borrow_repay_late_spite";
$tender_credit_nid = "tender_repay_late_spite";
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "borrow_repay_late_four"=>1 ) );
}
}
if ($borrow_credit_nid != "") 
{
$credit_blog ['user_id'] = $borrow_userid;
$credit_blog ['nid'] = $borrow_credit_nid;
$credit_blog ['code'] = "borrow";
$credit_blog ['type'] = "repay";
$credit_blog ['addtime'] = time ();
$credit_blog ['article_id'] = $repay_id;
$credit_blog ['remark'] = "还款[{$borrow_url}
]第{$repay_period}
期积分";
\creditClass::ActionCreditLog ( $credit_blog );
}
}
if ($vouch_status == "1") 
{
$result = M ( 'borrow_vouch_recover')->where ( "borrow_nid='{$borrow_nid}
' and `order`={$repay_period}
")->select ();
if ($result != "") 
{
foreach ( $result as $key =>$value ) 
{
$_data ["user_id"] = $value ['user_id'];
$_data ["amount_type"] = "vouch_tender";
$_data ["type"] = "borrrow_vouch_recover";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrrow_vouch_recover_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$_data ["account"] = $value ['repay_capital'];
$_data ["remark"] = "担保标[{$borrow_url}
]还款成功，投资担保额度返还";
\borrowClass::AddAmountLog ( $_data );
$sql = "update `{borrow_vouch_recover}` set repay_yestime = ".time () .",repay_yesaccount = {$value['repay_account']}
,status=1 where id = {$value['id']}
";
M ()->execute ( presql ( $sql ) );
}
}
$result = M ( 'borrow_vouch_repay')->where ( "borrow_nid='{$borrow_nid}
' and `order`={$repay_period}
")->find ();
if ($result != null) 
{
$_data ["user_id"] = $borrow_userid;
$_data ["amount_type"] = "vouch_borrow";
$_data ["type"] = "borrrow_vouch_repay";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrrow_vouch_repay_".$value ['user_id'] ."_".$borrow_nid .$repay_period;
$_data ["account"] = $value ['repay_capital'];
$_data ["remark"] = "担保[{$borrow_url}
]还款完成，借款担保额度返回";
\borrowClass::AddAmountLog ( $_data );
}
$sql = "update `{borrow_vouch_repay}` set repay_yestime = ".time () .",repay_yesaccount = {$value['repay_account']}
,status=1 where id = {$result['id']}
";
M ()->execute ( presql ( $sql ) );
}
else 
{
$con_borrrow_repay_amount = isset ( $_G ['system'] ['con_borrrow_repay_amount'] ) ?$_G ['system'] ['con_borrrow_repay_amount'] : "0";
if ($con_borrrow_repay_amount >0) 
{
$_data ["user_id"] = $borrow_userid;
$_data ["amount_type"] = "borrow";
$_data ["type"] = "borrrow_repay";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrrow_repay_".$borrow_userid ."_".$borrow_nid .$repay_id;
$_data ["account"] = $repay_capital * $con_borrrow_repay_amount * 0.01;
$_data ["remark"] = "借款标[{$borrow_url}
]成功还款，额度增加";
\borrowClass::AddAmountLog ( $_data );
}
}
$yue_time = $repay_times +(31 * 60 * 60 * 24);
$sql = "update `{borrow}` set repay_next_time={$yue_time}
,repay_account_yes= repay_account_yes + {$repay_account}
,repay_account_capital_yes= repay_account_capital_yes + {$repay_capital}
,repay_account_interest_yes= repay_account_interest_yes + {$repay_interest}
,repay_account_wait= repay_account_wait - {$repay_account}
,repay_account_capital_wait= repay_account_capital_wait - {$repay_capital}
,repay_account_interest_wait= repay_account_interest_wait - {$repay_interest}
where borrow_nid='{$borrow_nid}
'";
$result = M ()->execute ( presql ( $sql ) );
$sql = "update `{borrow_repay}` set repay_status=1,repay_yestime='".time () ."',repay_account_yes=repay_account,repay_interest_yes=repay_interest,repay_capital_yes=repay_capital where id={$repay_id}
";
M ()->execute ( presql ( $sql ) );
return $result;
}
public static function GetVouchList($data = array()) 
{
$user_id = empty ( $data ['user_id'] ) ?"": $data ['user_id'];
$username = empty ( $data ['username'] ) ?"": $data ['username'];
$_sql = " 1=1";
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and p1.user_id = {$data['user_id']}
";
}
if (IsExiest ( $data ['username'] ) != "") 
{
$_sql .= " and p2.username = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$_sql .= " and p1.borrow_nid = '{$data['borrow_nid']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != "") 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != "") 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if (IsExiest ( $data ['borrow_status'] ) != "") 
{
$_sql .= " and p3.status in ({$data['borrow_status']}
)";
}
$field = "p1.*,p2.username,p3.name as borrow_name,p3.borrow_period,p3.account as borrow_account,p4.username as borrow_username";
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
return M ( 'borrow_vouch')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p2.user_id = p1.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid = p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id = p3.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( 'p1.addtime desc')->select ();
}
$row = M ( 'borrow_vouch')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p2.user_id = p1.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid = p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id = p3.user_id') )->where ( $_sql )->order ( 'p1.addtime desc')->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_vouch')->alias ( 'p1')->join ( presql ( '`{users}` as p2 on p2.user_id = p1.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid = p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p4.user_id = p3.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( 'p1.addtime desc')->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetVouchRepayList($data = array()) 
{
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$_sql = "p1.borrow_nid=p2.borrow_nid and p2.user_id=p3.user_id ";
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
if ($data ['borrow_nid'] == "request") 
{
$borrow_nid = I ( 'request.borrow_nid');
$_sql .= " and p1.borrow_nid= '{$borrow_nid}
'";
}
else 
{
$_sql .= " and p1.borrow_nid= '{$data['borrow_nid']}
'";
}
}
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and p2.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['vouch_userid'] ) != "") 
{
$_sql .= " and p2.borrow_nid in (select borrow_nid from `{borrow_vouch}` where user_id={$data['vouch_userid']}
)";
}
if (IsExiest ( $data ['username'] ) != "") 
{
$_sql .= " and p3.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['repay_time'] ) != "") 
{
if ($date ['repay_time'] <= 0) $data ['repay_time'] = time ();
$_repayment_time = get_mktime ( date ( "Y-m-d",$data ['repay_time'] ) );
$_sql .= " and p1.repay_time < '{$_repayment_time}
'";
}
if (IsExiest ( $data ['dotime2'] ) != "") 
{
$dotime2 = ($data ['dotime2'] == "request") ?I ( 'request.dotime2') : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p2.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['dotime1'] ) != "") 
{
$dotime1 = ($data ['dotime1'] == "request") ?I ( 'request.dotime1') : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p2.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if (IsExiest ( $keywords ) != "") 
{
if ($keywords == "request") 
{
if (isset ( $_REQUEST ['keywords'] ) &&$_REQUEST ['keywords'] != "") 
{
$rkeywords = I ( 'request.keywords');
$_sql .= " and p2.name like '%".urldecode ( $rkeywords ) ."%'";
}
}
else 
{
$_sql .= " and p2.name like '%".$keywords ."%'";
}
}
$_order = " order by p1.id desc";
if (isset ( $data ['order'] ) &&$data ['order'] != "") 
{
if ($data ['order'] == "repayment_time") 
{
$_order = " order by p1.repay_time asc ";
}
elseif ($data ['order'] == "order") 
{
$_order = " order by p1.order asc ,p1.id desc";
}
}
$field = " p1.*,p2.name as borrow_name,p2.borrow_period,p3.username as borrow_username";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'borrow_vouch_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
foreach ( $list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['capital'] ) );
if ($value ['status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = $late ['late_interest'];
}
}
return $list;
}
$row = M ( 'borrow_vouch_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_vouch_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$list = $list ?$list : array ();
foreach ( $list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['capital'] ) );
if ($value ['status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = $late ['late_interest'];
}
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function GetVouchRecoverList($data = array()) 
{
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$_sql = "  p1.borrow_nid=p2.borrow_nid and p2.user_id=p3.user_id ";
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
if ($data ['borrow_nid'] == "request") 
{
$borrow_nid = I ( 'request.borrow_nid');
$_sql .= " and p1.borrow_nid= '{$borrow_nid}
'";
}
else 
{
$_sql .= " and p1.borrow_nid= '{$data['borrow_nid']}
'";
}
}
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and p2.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['vouch_userid'] ) != "") 
{
$_sql .= " and p1.user_id = '{$data['vouch_userid']}
'";
}
if (IsExiest ( $data ['username'] ) != "") 
{
$_sql .= " and p3.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['type'] ) == "late") 
{
$_sql .= " and p1.repay_time<".time () ." and p1.status=0";
}
if (IsExiest ( $data ['repay_time'] ) != "") 
{
if ($date ['repay_time'] <= 0) $data ['repay_time'] = time ();
$_repayment_time = get_mktime ( date ( "Y-m-d",$data ['repay_time'] ) );
$_sql .= " and p1.repay_time < '{$_repayment_time}
'";
}
if (IsExiest ( $data ['dotime2'] ) != "") 
{
$dotime2 = ($data ['dotime2'] == "request") ?I ( 'request.dotime2') : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p2.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['dotime1'] ) != "") 
{
$dotime1 = ($data ['dotime1'] == "request") ?I ( 'request.dotime1') : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p2.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if (IsExiest ( $keywords ) != "") 
{
if ($keywords == "request") 
{
if (isset ( $_REQUEST ['keywords'] ) &&$_REQUEST ['keywords'] != "") 
{
$rkeword = I ( 'request.keywords');
$_sql .= " and p2.name like '%".urldecode ( $rkeword ) ."%'";
}
}
else 
{
$_sql .= " and p2.name like '%".$keywords ."%'";
}
}
$_order = " order by p1.id desc";
if (isset ( $data ['order'] ) &&$data ['order'] != "") 
{
if ($data ['order'] == "repayment_time") 
{
$_order = " order by p1.repay_time asc ";
}
elseif ($data ['order'] == "order") 
{
$_order = " order by p1.order asc ,p1.id desc";
}
}
$field = " p1.*,p2.name as borrow_name,p2.borrow_period,p3.username as borrow_username";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'borrow_vouch_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->limit ( $_limit )->order ( $_order )->select ();
foreach ( $list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['reapy_account'] ) );
if ($value ['status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = $late ['late_interest'];
}
}
return $list;
}
$row = M ( 'borrow_vouch_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_vouch_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( $_sql )->field ( $field )->page ( $data ['page'] .",{$data ['epage']}
")->order ( $_order )->select ();
$list = $list ?$list : array ();
foreach ( $list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['capital'] ) );
if ($value ['status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = $late ['late_interest'];
}
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function VouchDianfu($data = array()) 
{
global $_G;
$result = M ( 'borrow_vouch_recover')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->where ( "p1.user_id={$data['user_id']}
and  p1.id={$data['id']}
and p1.repay_time< ".time () )->field ( 'p1.*,p2.name as borrow_name')->find ();
if ($result == false) 
{
return "error";
}
$late = self::LateInterest ( array ( "time"=>$result ['repay_time'], "account"=>$result ['repay_account'] ) );
if ($late ["late_days"] <10) 
{
return "vouch_late_days_30no";
}
$borrow_nid = $result ["borrow_nid"];
$borrow_name = $result ["borrow_name"];
$repay_period = $result ["order"];
$borrow_period = $result ["borrow_period"];
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['borrow_name']}
</a>";
$sql = "update `{borrow_vouch_recover}` set advance_status =1,advance_time='".time () ."' where id={$data['id']}
";
M()->execute(presql($sql));
$result = M('borrow_repay')->where("borrow_nid = '{$borrow_nid}
' and repay_period='{$repay_period}
'")->find();
if ($result ["repay_vouch"] != 1 &&$result ["repay_status"] != 1) 
{
$result =M('borrow_vouch_recover')->where("borrow_nid = '{$borrow_nid}
' and `order`='{$repay_period}
' and advance_status=0")->find();
if ($result == false ||$result == null) 
{
$sql = "update `{borrow_repay}` set repay_vouch=1,repay_vouch_time='".time () ."' where borrow_nid='{$borrow_nid}
' and repay_period='{$repay_period}
'";
M()->execute(presql($sql));
$result = M('borrow_recover')->join(presql('`{users_vip}` as p2 on p1.user_id=p2.user_id'))->where("p1.`recover_period` = '{$repay_period}
' and p1.borrow_nid='{$borrow_nid}
'")->field('p1.*,p2.status as vip_status')->select();
foreach ( $result as $key =>$value ) 
{
$sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = recover_account ,recover_capital_yes = recover_capital ,recover_interest_yes = recover_interest ,status=1,recover_status=1,recover_vouch=1   where id = '{$value['id']}
'";
M()->execute(presql($sql));
$sql = "update  `{borrow_tender}` set recover_times=recover_times+1,recover_account_yes= recover_account_yes + {$value['recover_account']}
,recover_account_capital_yes = recover_account_capital_yes  + {$value['recover_capital']}
,recover_account_interest_yes = recover_account_interest_yes + {$value['recover_interest']}
,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = '{$value['tender_id']}
'";
M()->execute(presql($sql));
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "vouch_recover_yes";
if ($value ['vip_status'] == 1) 
{
$log ['money'] = $value ['recover_account'];
}
else 
{
$log ['money'] = round ( $value ['recover_capital'] / 2,2 );
}
$log ['total'] = $account_result ['total'];
$log ['use_money'] = $account_result ['use_money'] +$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'] -$log ['money'];
$log ['use_money_yes'] = $account_result ['use_money_yes'] +$log ['money'];
$log ['use_money_no'] = $account_result ['use_money_no'];
$log ['to_user'] = $borrow_userid;
$log ['remark'] = "担保者对[{$borrow_url}
]借款的垫付";
$result = \accountClass::AddLog ( $log );
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "tender_interest_fee";
$vip_result = self::GetBorrowVip ( array ( "user_id"=>$value ['user_id'] ) );
$UsersVip = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
if ($UsersVip ['status'] == 1) 
{
$_fee = isset ( $_G ['system'] ['con_borrow_interest_vip_fee'] ) ?$_G ['system'] ['con_borrow_interest_vip_fee'] * 0.01 : 0.1;
}
else 
{
$_fee = isset ( $_G ['system'] ['con_borrow_interest_fee'] ) ?$_G ['system'] ['con_borrow_interest_fee'] * 0.01 : 0.1;
}
if ($_fee >0 &&$_fee != "0") 
{
$log ['money'] = $value ['recover_interest'] * $_fee;
$log ['total'] = $account_result ['total'] -$log ['money'];
$log ['use_money'] = $account_result ['use_money'] -$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'];
$log ['use_money_yes'] = $account_result ['use_money_yes'] -$log ['money'];
$log ['use_money_no'] = $account_result ['use_money_no'];
$log ['to_user'] = 0;
$log ['remark'] = "担保者成功还垫付$borrow_url]扣除利息的管理费";
\accountClass::AddLog ( $log );
}
$remind ['nid'] = "loan_pay";
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "担保者对[{$borrow_name}
]借款的还款";
$remind ['content'] = "担保者在".date ( "Y-m-d H:i:s") ."对[{$borrow_url}
}</a>]借款的还款,还款金额为￥{$value['recover_account']}
";
remindClass::sendRemind($remind);
}
$result =M('borrow_vouch_recover')->where("borrow_nid = '{$borrow_nid}
' and `order`='{$repay_period}
'")->select();
foreach ( $result as $key =>$value ) 
{
$account_result = \accountClass::GetOne ( array ( "user_id"=>$value ['user_id'] ) );
$log ['user_id'] = $value ['user_id'];
$log ['type'] = "vouch_repay_yes";
$log ['money'] = $value ['repay_account'];
$log ['total'] = $account_result ['total'] -$log ['money'];
$log ['use_money'] = $account_result ['use_money'] -$log ['money'];
$log ['no_use_money'] = $account_result ['no_use_money'];
$log ['collection'] = $account_result ['collection'];
$log ['use_money_yes'] = $account_result ['use_money_yes'];
$log ['use_money_no'] = $account_result ['use_money_no'] -$log ['money'];
$log ['to_user'] = $vouch_userid;
$log ['remark'] = "对[{$borrow_url}
]借款的垫付金额的扣除";
\accountClass::AddLog ( $log );
$remind ['nid'] = "loan_pay";
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "担保者对[{$borrow_name}
]借款的垫付金额的扣除";
$remind ['content'] = "担保者在".date ( "Y-m-d H:i:s") ."对[{$borrow_url}
}</a>]借款的还款,垫付金额为￥{$value['repay_account']}
";
remindClass::sendRemind($remind);
}
}
}
return true;
}
public static function BorrowAdvanceRepay($data = array()) 
{
global $_G;
if (IsExiest ( $data ['user_id'] ) == "") 
{
return "borrow_user_id_empty";
}
if (IsExiest ( $data ['borrow_nid'] ) == "") 
{
return "borrow_nid_empty";
}
$result = M ( 'borrow_repay')->where ( "user_id={$data['user_id']}
and borrow_nid='{$data['borrow_nid']}
' and repay_status=0")->field ( 'count(1) as num,sum(repay_account) as all_account,sum(repay_capital) as all_capital,sum(repay_interest) as all_interest,user_id')->find ();
$user_result=\usersClass::GetUsers ( array ( "user_id"=>$data ["user_id"] ) );
$borrow_userid = $data ["user_id"];
$borrow_username = $user_result ["username"];
$borrow_nid = $data ["borrow_nid"];
$repay_period = $result ["num"];
$repay_account = $result ["all_account"];
$repay_capital = $result ["all_capital"];
$repay_interest = $result ["all_interest"];
unset($user_result);
$result = M ( 'borrow')->where ( "borrow_nid = '{$borrow_nid}
'")->find ();
$nikename=$result['nikename'];
$borrow_forst_account = $result ["borrow_forst_account"];
$borrow_name = $result ['name'];
$borrow_period = $result ["borrow_period"];
$repay_times = $result ["repay_times"];
$borrow_account = $result ["account"];
$borrow_style = $result ["borrow_style"];
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$result['borrow_nid'])." target=_blank>{$result['name']}
</a>";
$account_result = \accountClass::GetAccountUsers ( array ( "user_id"=>$borrow_userid ) );
if ($account_result ['balance'] <$repay_account) 
{
return "borrow_repay_account_use_none";
}
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "advance_repay_".$borrow_userid ."_".$borrow_nid;
$log_info ["money"] = $repay_capital;
$log_info ["income"] = 0;
$log_info ["expend"] = $repay_capital;
$log_info ["balance_cash"] = -$repay_capital;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_advance_repay";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]提前全额还款";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $borrow_userid;
$log_info ["nid"] = "advance_interest_repay_".$borrow_userid ."_".$borrow_nid;
$log_info ["money"] = round ( $repay_capital / 100,2 );
$log_info ["income"] = 0;
$log_info ["expend"] = $log_info ["money"];
$log_info ["balance_cash"] = -$log_info ["money"];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_interest_advance_repay";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]提前全额还款,扣除本金1%的违约金";
\accountClass::AddLog ( $log_info );
$vip_result = self::GetBorrowVip ( array ( "user_id"=>$borrow_userid ) );
$vip_fee = $vip_result ['fee'];
if ($borrow_style != 5) 
{
if ($vip_result ['vip'] == 0) 
{
$borrow_manage_fee = isset ( $_G ['system'] ["con_borrow_manage_fee"] ) ?$_G ['system'] ["con_borrow_manage_fee"] : 0.5;
}
else 
{
$borrow_manage_fee = (isset ( $_G ['system'] ["con_borrow_manage_vip_fee"] ) ?$_G ['system'] ["con_borrow_manage_vip_fee"] : 0.4) * $vip_fee;
}
$manage_fee = $repay_capital * $borrow_manage_fee * 0.01;
}
$sql = "update `{borrow_repay}` set late_days = '0',late_interest = '0',late_reminder = '0' where user_id='{$data['user_id']}
' and borrow_nid='{$data['borrow_nid']}
' and repay_status=0";
M ()->execute ( presql ( $sql ) );
$all_account = round ( $repay_capital / 100 +$repay_capital,2 );
self::UpdateBorrowCount ( array ( "user_id"=>$borrow_userid, "advance_repay_times"=>$repay_period, "borrow_repay_wait_times"=>-$repay_period, "borrow_repay_yes"=>$all_account, "borrow_repay_wait"=>-$repay_account, "borrow_repay_interest_yes"=>$repay_interest, "borrow_repay_interest_wait"=>-$repay_interest, "borrow_repay_capital_yes"=>$repay_capital, "borrow_repay_capital_wait"=>-$repay_capital, "borrow_weiyue"=>$log_info ["money"] ) );
$result = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow_tender}` as p2 on p1.tender_id=p2.id ') )->where ( "p1.borrow_nid='{$borrow_nid}
' and p1.recover_status=0")->field ( 'p1.*,p2.change_status,p2.change_userid')->select ();
foreach ( $result as $key =>$value ) 
{
$lixi = round ( $value ['recover_capital'] / 100,2 );
$all = round ( $value ['recover_capital'] / 100 +$value ['recover_capital'],2 );
$sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = {$value['recover_capital']}
,recover_capital_yes = recover_capital ,recover_interest_yes =0 ,status=1,recover_status=1,advance_status=1 where id = '{$value['id']}
'";
M ()->execute ( presql ( $sql ) );
$sql = "update  `{borrow_tender}` set recover_times=recover_times+1,recover_account_yes= recover_account_yes + {$value['recover_capital']}
,recover_account_capital_yes = recover_account_capital_yes  + {$value['recover_capital']}
,recover_account_interest_yes = recover_account_interest_yes,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = {$value['tender_id']}
";
M ()->execute ( presql ( $sql ) );
if ($value ['change_status'] == 1) 
{
$value ['user_id'] = $value ['change_userid'];
if ($value ['change_userid'] == ""||$value ['change_userid'] == 0) 
{
$value ['user_id'] = 0;
}
}
if ($value ['user_id'] != 0) 
{
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "tender_advance_repay_yes_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = $value ['recover_capital'];
$log_info ["income"] = $value ['recover_capital'];
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $value ['recover_capital'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = -$value ['recover_account'];
$log_info ["type"] = "tender_advance_repay_yes";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "借款人对[{$borrow_url}
]借款的提前还款,本金回收";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "tender_advance_repay_interest_".$value ['user_id'] ."_".$borrow_nid .$value ['id'];
$log_info ["money"] = round ( $value ['recover_capital'] / 100,2 );
$log_info ["income"] = $log_info ["money"];
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $log_info ["money"];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_advance_repay_interest";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "[{$borrow_url}
]借款提前还款收取本金1%的违约金。";
\accountClass::AddLog ( $log_info );
if ($value ['change_status'] != 1) 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_recover_times_yes"=>1, "tender_recover_times_wait"=>-1, "tender_recover_yes"=>$all, "tender_recover_wait"=>-$value ['recover_account'], "tender_capital_yes"=>$value ['recover_capital'], "tender_capital_wait"=>-$value ['recover_capital'], "tender_interest_yes"=>0, "tender_interest_wait"=>-$value ['recover_interest'], "weiyue"=>$lixi ) );
}
else 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "weiyue"=>$lixi ) );
}
$remind ['nid'] = "loan_pay";
$remind ['receive_userid'] = $value ['user_id'];
$remind ['title'] = "借款人对[{$borrow_name}
]借款的提前还款";
$remind ['content'] = "客户（{$nikename}
）在".date ( "Y-m-d H:i:s") ."对[{$borrow_url}
}</a>]借款的还款,还款金额为￥{$value['recover_account']}
";
\remindClass::sendRemind ( $remind );
}
else 
{
$log_info ["user_id"] = 0;
$log_info ["nid"] = "advance_repay_0_".$borrow_nid .$value ['id'];
$log_info ["money"] = $lixi;
$log_info ["income"] = 0;
$log_info ["expend"] = $lixi;
$log_info ["balance_cash"] = -$lixi;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "advance_web";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "对[{$borrow_url}
]还款，网站违约金收入".$borrow_username;
\accountClass::AddLog ( $log_info );
}
}
$credit_log ['user_id'] = $borrow_userid;
$credit_log ['nid'] = "borrow_repay_all";
$credit_log ['code'] = "borrow";
$credit_log ['type'] = "repay_all";
$credit_log ['addtime'] = time ();
$credit_log ['article_id'] = $repay_id;
$credit_log ['value'] = round ( $borrow_account / 100 );
$credit_log ['remark'] = "借款[{$borrow_url}
]还款所得积分";
\creditClass::ActionCreditLog ( $credit_log );
$con_borrrow_repay_amount = isset ( $_G ['system'] ['con_borrrow_repay_amount'] ) ?$_G ['system'] ['con_borrrow_repay_amount'] : "0";
if ($con_borrrow_repay_amount >0) 
{
$_data ["user_id"] = $borrow_userid;
$_data ["amount_type"] = "borrow";
$_data ["type"] = "borrrow_repay";
$_data ["oprate"] = "add";
$_data ["nid"] = "borrrow_repay_".$borrow_userid ."_".$borrow_nid .$repay_id;
$_data ["account"] = $repay_capital * $con_borrrow_repay_amount * 0.01;
$_data ["remark"] = "借款标[{$borrow_url}
]成功还款，额度增加";
\borrowClass::AddAmountLog ( $_data );
}
$sql = "update `{borrow}` set repay_account_yes= repay_account_yes + {$all_account}
,repay_account_capital_yes= repay_account_capital_yes + {$repay_capital}
,repay_account_interest_yes= repay_account_interest_yes,repay_account_wait=0,repay_account_capital_wait=0,repay_account_interest_wait=0 where borrow_nid='{$borrow_nid}
'";
$result = M ()->execute ( presql ( $sql ) );
$repayresult = M ( 'borrow_repay')->where ( "user_id={$data['user_id']}
and borrow_nid='{$data['borrow_nid']}
' and repay_status=0")->select ();
foreach ( $repayresult as $key =>$value ) 
{
$lixi = round ( $value ['repay_capital'] / 100,2 );
$all = round ( $value ['repay_capital'] / 100 +$value ['repay_capital'],2 );
$_sql = "update `{borrow_repay}` set repay_status=1,repay_yestime='".time () ."',repay_account_yes={$all}
,repay_interest_yes=0,repay_capital_yes=repay_capital where id={$value['id']}
";
M ()->execute ( presql ( $sql ) );
}
return $result;
}
public static function RepayJoinBad($data) 
{
if ($data ['borrow_nid'] == "") return false;
M ( 'borrow_repay')->where ( "borrow_nid = {$data['borrow_nid']}
")->setField ( 'bad_status',$data ['bad_status'] );
return $data ['borrow_nid'];
}
public static function GetBadBorrowRepay($data = array()) 
{
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$_sql = " p1.borrow_nid=p2.borrow_nid and p2.user_id=p3.user_id ";
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$_sql .= " and p1.borrow_nid= '{$data['borrow_nid']}
'";
}
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['vouch_userid'] ) != "") 
{
$_sql .= " and p2.borrow_nid in (select borrow_nid from `{borrow_vouch}` where user_id={$data['vouch_userid']}
)";
}
if (IsExiest ( $data ['username'] ) != "") 
{
$_sql .= " and p3.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['repay_time'] ) != "") 
{
if ($date ['repay_time'] <= 0) $data ['repay_time'] = time ();
$_repayment_time = get_mktime ( date ( "Y-m-d",$data ['repay_time'] ) );
$_sql .= " and p1.repay_time < '{$_repayment_time}
'";
}
if (IsExiest ( $data ['dotime2'] ) != "") 
{
$dotime2 = $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.repay_time < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['dotime1'] ) != "") 
{
$dotime1 = $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.repay_time > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['status'] ) != "") 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if (IsExiest ( $data ['repay_status'] ) != "") 
{
$_sql .= " and p1.repay_status in ({$data['repay_status']}
)";
}
if (IsExiest ( $data ['borrow_status'] ) != "") 
{
$_sql .= " and (p2.status = {$data['borrow_status']}
or p2.is_flow=1) ";
}
if (IsExiest ( $data ['keywords'] ) != "") 
{
$keywords = $data ['keywords'];
$_sql .= " and p2.name like '%".$keywords ."%'";
}
if (IsExiest ( $data ['lateing'] ) != "") 
{
$_sql .= " and p1.repay_time<".time ();
}
if (IsExiest ( $data ['bad'] ) != "") 
{
$_sql .= " and p1.bad_status=1 and p1.repay_time<".time ();
}
$_order = "p1.repay_time asc";
if (isset ( $data ['order'] ) &&$data ['order'] != "") 
{
if ($data ['order'] == "repay_time") 
{
$_order = " p1.repay_time asc ";
}
elseif ($data ['order'] == "order") 
{
$_order = " p1.repay_period asc ,p1.id desc";
}
elseif ($data ['order'] == "status") 
{
$_order = "p1.repay_status asc ,p1.repay_time asc,p1.id desc";
}
}
$field = " p1.*,p2.name as borrow_name,p2.borrow_period,p2.group_id,p2.account,p2.borrow_apr,p2.borrow_style,p2.vouchstatus,p2.fast_status,p3.username as borrow_username";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->order ( $_order )->field ( $field )->group ( 'p1.borrow_nid')->limit ( $_limit )->select ();
foreach ( $list as $key =>$value ) 
{
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['repay_account'] ) );
if ($value ['repay_status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = round ( $value ['repay_account'] / 100 * 0.4 * $list [$key] ['late_days'],2 );
}
}
return $list;
}
$row = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->group ( 'p1.borrow_nid')->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->order ( $_order )->field ( $field )->group ( 'p1.borrow_nid')->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$list = $list ?$list : array ();
foreach ( $list as $key =>$value ) 
{
$yesre = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
and repay_status=1")->count ();
$nore = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
and repay_status=0")->field ( 'count(1) as num,sum(repay_account) as all_repay_account')->find ();
if ($nore ['num'] <= $yesre) 
{
$list [$key] ['advance_status'] = 1;
}
$list [$key] ['nore'] = $nore ['num'];
$list [$key] ['all_repay_account'] = $nore ['all_repay_account'];
$re_time = (strtotime ( date ( "Y-m-d",$value ['repay_time'] ) ) -strtotime ( date ( "Y-m-d",time () ) )) / (60 * 60 * 24);
$list [$key] ['re_time'] = $re_time;
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['repay_account'] ) );
if ($value ['repay_status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = round ( $value ['repay_account'] / 100 * 0.4 * $list [$key] ['late_days'],2 );
}
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function GetBorrowRepaytt($data = array()) 
{
$result = M ( 'borrow_repay')->where ( "borrow_nid='{$data['borrow_nid']}
' AND user_id={$data['user_id']}
")->find ();
return $result ["id"];
}
public static function GetBorrowRepayList($data = array()) 
{
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$_sql = " p1.borrow_nid=p2.borrow_nid and p2.user_id=p3.user_id ";
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$_sql .= " and p1.borrow_nid= '{$data['borrow_nid']}
'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p1.user_id = '{$data['user_id']}
'";
}
if (IsExiest ( $data ['vouch_userid'] ) != false) 
{
$_sql .= " and p2.borrow_nid in (select borrow_nid from `{borrow_vouch}` where user_id={$data['vouch_userid']}
)";
}
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p3.username like '%{$data['username']}
%'";
}
if (IsExiest ( $data ['repay_time'] ) != false) 
{
if ($date ['repay_time'] <= 0) $data ['repay_time'] = time ();
$_repayment_time = get_mktime ( date ( "Y-m-d",$data ['repay_time'] ) );
$_sql .= " and p1.repay_time < '{$_repayment_time}
'";
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?I ( 'request.dotime2') : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p1.repay_time < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?I ( 'request.dotime1') : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p1.repay_time > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['status'] ) != false) 
{
$_sql .= " and p1.status in ({$data['status']}
)";
}
if ($data ['repay_status']===0||IsExiest ($data ['repay_status'] ) != false) 
{
$_sql .= " and p1.repay_status in ({$data['repay_status']}
)";
}
if (IsExiest ( $data ['borrow_status'] ) != false) 
{
$_sql .= " and (p2.status = {$data['borrow_status']}
or p2.is_flow=1) ";
}
if (IsExiest ( $keywords ) != false) 
{
if ($keywords == "request") 
{
if (isset ( $_REQUEST ['keywords'] ) &&$_REQUEST ['keywords'] != "") 
{
$keywor = I ( 'request.keywords');
$_sql .= " and p2.name like '%".urldecode ( $keywor ) ."%'";
}
}
else 
{
$_sql .= " and p2.name like '%".$keywords ."%'";
}
}
if (IsExiest ( $data ['lateing'] ) != false) 
{
$_sql .= " and p1.repay_time<".time ();
}
if (IsExiest ( $data ['bad'] ) != false) 
{
$_sql .= " and p1.bad_status=1 and p1.repay_time<".time ();
}
$_order = "  p1.repay_time asc";
if (isset ( $data ['order'] ) &&$data ['order'] != "") 
{
if ($data ['order'] == "repay_time") 
{
$_order = "  p1.repay_time asc ";
}
elseif ($data ['order'] == "order") 
{
$_order = "  p1.repay_period asc ,p1.id desc";
}
elseif ($data ['order'] == "status") 
{
$_order = " p1.repay_status asc ,p1.repay_time asc,p1.id desc";
}
}
$field = " p1.*,p2.name as borrow_name,p2.borrow_period,p2.account,p2.is_flow,p2.borrow_apr,p2.borrow_style,p2.vouchstatus,p2.fast_status,p2.nikename,p3.username as borrow_username";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->limit ( $_limit )->field ( $field )->order ( $_order )->select ();
foreach ( $list as $key =>$value ) 
{
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['repay_account'] ) );
if ($value ['repay_status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = round ( $value ['repay_account'] / 100 * 0.4 * $list [$key] ['late_days'],2 );
}
}
return $list;
}
$row = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->count ();
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p3.user_id=p2.user_id') )->where ( presql ( $_sql ) )->page ( $data ['page'] .",{$data ['epage']}
")->field ( $field )->order ( $_order )->select ();
$list = $list ?$list : array ();
foreach ( $list as $key =>$value ) 
{
$yesre = M ( 'borrow_repay')->where ( "borrow_nid='{$value['borrow_nid']}
' and repay_status=1")->count ();
$nore = M ( 'borrow_repay')->where ( "borrow_nid='{$value['borrow_nid']}
' and repay_status=0")->count ();
if ($nore <= $yesre) 
{
$list [$key] ['advance_status'] = 1;
}
$re_time = (strtotime ( date ( "Y-m-d",$value ['repay_time'] ) ) -strtotime ( date ( "Y-m-d",time () ) )) / (60 * 60 * 24);
$list [$key] ['re_time'] = $re_time;
$list [$key] ["credit"] = self::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['repay_account'] ) );
if ($value ['repay_status'] != 1) 
{
$list [$key] ['late_days'] = $late ['late_days'];
$list [$key] ['late_interest'] = round ( $value ['repay_account'] / 100 * 0.4 * $list [$key] ['late_days'],2 );
}
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function GetBorrowComment($data) 
{
}
public static function GetOtherloanList($data = array()) 
{
}
public static function AddOtherloan($data = array()) 
{
}
public static function UpdateOtherloan($data = array()) 
{
}
public static function DelOtherloan($data) 
{
}
public static function GetOtherloanOne($data) 
{
}
public static function GetUserBorrowCount($data) 
{
$nowtime = time () -60 * 60 * 24 * 2;
$week_t = date ( "w",$nowtime );
if ($week_t == 0) $week_t = 7;
$first_time = $nowtime -60 * 60 * 24 * ($week_t +7);
$last_time = $nowtime -60 * 60 * 24 * ($week_t -1);
$result =M('borrow_tender')->join(presql('`{users}` as p2 on p1.user_id=p2.user_id'))->where('p1.status=1')->field('sum(p1.account) as account_all,p1.user_id,p2.username')->order('account_all desc')->group('p1.user_id')->select();
return $result;
}
public static function GetLateList($data = array()) 
{
global $_G;
$page = (!isset ( $data ['page'] ) ||$data ['page'] == "") ?1 : $data ['page'];
$epage = (!isset ( $data ['epage'] ) ||$data ['epage'] == "") ?10 : $data ['epage'];
$_select = 'p1.*,p3.*,p5.card_id,p6.name as job_name,p6.address as job_address,p7.province,p7.city,p8.*';
$_order = " p1.id ";
if (isset ( $data ['late_day'] ) &&$data ['late_day'] != "") 
{
$_repayment_time = time () -60 * 60 * 24 * $data ['late_day'];
}
else 
{
$_repayment_time = time ();
}
$_sql = "  p1.repay_time < '{$_repayment_time}
' and p1.repay_status!=1";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p3.`username`='".urldecode ( $data ['username'] ) ."'";
}
$_list = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid=p2.borrow_nid') )->join ( presql ( '`{users}` as p3 on p2.user_id=p3.user_id') )->join ( presql ( '`{approve_realname}` as p5 on p1.user_id=p5.user_id') )->join ( presql ( '`{rating_job}` as p6 on p1.user_id=p6.user_id') )->join ( presql ( '`{rating_info}` as p7 on p1.user_id=p7.user_id') )->join ( presql ( '`{users_info}` as p8 on p1.user_id=p8.user_id') )->where ( $_sql )->field ( $_select )->order ( $_order )->select ();
foreach ( $_list as $key =>$value ) 
{
$late = self::LateInterest ( array ( "time"=>$value ['repay_time'], "account"=>$value ['capital'] ) );
$list [$value ['user_id']] ['username'] = $value ['username'];
$list [$value ['user_id']] ['realname'] = $value ['realname'];
$list [$value ['user_id']] ['phone'] = $value ['phone'];
$list [$value ['user_id']] ['user_id'] = $value ['user_id'];
$list [$value ['user_id']] ['email'] = $value ['email'];
$list [$value ['user_id']] ['job_name'] = $value ['job_name'];
$list [$value ['user_id']] ['job_address'] = $value ['job_address'];
$list [$value ['user_id']] ['qq'] = $value ['qq'];
$list [$value ['user_id']] ['sex'] = $value ['sex'];
$list [$value ['user_id']] ['card_id'] = $value ['card_id'];
$list [$value ['user_id']] ['province'] = $value ['province'];
$list [$value ['user_id']] ['repay_period'] = $value ['repay_period'] +1;
$list [$value ['user_id']] ['city'] = $value ['city'];
$list [$value ['user_id']] ['late_days'] += $late ['late_days'];
if ($list [$value ['user_id']] ['late_numdays'] <$late ['late_days']) 
{
$list [$value ['user_id']] ['late_numdays'] += $late ['late_days'];
}
$list [$value ['user_id']] ['late_interest'] += round ( $late ['late_interest'] / 2,2 );
$list [$value ['user_id']] ['late_account'] += $value ['repay_account'];
$list [$value ['user_id']] ['late_num'] ++;
if ($value ['repay_web'] == 1) 
{
$list [$value ['user_id']] ['late_webnum'] += 1;
}
}
if (isset ( $data ['limit'] )) 
{
if (count ( $list ) >0) 
{
return array_slice ( $list,0,$data ['limit'] );
}
else 
{
return array ();
}
}
$total = count ( $list );
$Page = new \Think\Page ( $total,$data ['epage'] );
$show = $Page->show ();
$total_page = ceil ( $total / $epage );
$index = $epage * ($page -1);
if (is_array ( $list )) 
{
$list = array_slice ( $list,$index,$epage );
}
return array ( 'list'=>$list, 'page'=>$show ) ;
}
public static function Tongji($data = array()) 
{
global $mysql;
$result = M('borrow')->where('status=3')->field('sum(account) as num')->find();
$_result ['success_num'] = $result ['num'];
$_repayment_time = time ();
$result = M('borrow_repay')->alias('p1')->join(presql('`{borrow}` as p2 on p1.borrow_nid=p2.borrow_nid'))->where("p2.status=3")->field('p1.repay_capital,p1.repay_yestime,p1.status')->select();
foreach ( $result as $key =>$value ) 
{
$_result ['success_sum'] += $value ['repay_capital'];
if ($value ['status'] == 1) 
{
$_result ['success_num1'] += $value ['repay_capital'];
if (date ( "Ymd",$value ['repay_time'] ) <date ( "Ymd",$value ['repay_yestime'] )) 
{
$_result ['success_laterepay'] += $value ['repay_capital'];
}
}
if ($value ['status'] == 0) 
{
$_result ['success_num0'] += $value ['account'];
if (date ( "Ymd",$value ['repay_time'] ) <date ( "Ymd",time () )) 
{
$_result ['false_laterepay'] += $value ['repay_capital'];
}
}
}
$_result ['laterepay'] = $_result ['success_laterepay'] +$_result ['false_laterepay'];
return $_result;
}
public static function LateRepay($data) 
{
global $_G;
$result = M ( 'borrow_repay')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p1.borrow_nid = p2.borrow_nid') )->where ( "p1.id = {$data['id']}
")->field ( 'p1.*,p2.name as borrow_name,p2.vouchstatus,p2.fast_status')->find ();
if ($result ['repay_status'] == 1) 
{
return -1;
}
elseif ($result ['repay_web'] == 1) 
{
return -2;
}
elseif ($result ['repay_status'] == 0) 
{
$late_result = self::LateInterest ( array ( "account"=>$result ['repay_account'], "time"=>$result ['repay_time'] ) );
if ($late_result ['late_days'] <1) 
{
return -3;
}
else 
{
M ( 'borrow_repay')->where ( "id = {$data['id']}
")->setField ( 'repay_web',1 );
$repay_period = $result ['repay_period'];
$borrow_nid = $result ['borrow_nid'];
$borrow_name = $result ['borrow_name'];
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$borrow_nid)." target=_blank>{$borrow_name}
</a>";
$result = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow_tender}` as p2 on p2.id=p1.tender_id') )->where ( "p1.`recover_period` = '{$repay_period}
' and p1.borrow_nid='{$borrow_nid}
'")->field ( 'p1.*,p2.change_status,p2.change_userid')->select ();
foreach ( $result as $key =>$value ) 
{
if ($value ['change_status'] == 1) 
{
if ($value ['change_userid'] == ""||$value ['change_userid'] == 0) 
{
$value ['user_id'] = 0;
}
else 
{
$value ['user_id'] = $value ['change_userid'];
}
}
if ($result ['vouchstatus'] == 1) 
{
$money = $value ['recover_account'];
}
elseif ($result ['fast_status'] == 1) 
{
$money = $value ['recover_account'];
}
else 
{
if ($value ['user_id'] == 0) 
{
$sql = "update  `{borrow_tender}` set recover_times='recover_times'+1,recover_account_yes= recover_account_yes + {$value['recover_capital']}
,recover_account_capital_yes = recover_account_capital_yes  + {$value['recover_capital']}
,recover_account_interest_yes = recover_account_interest_yes + 0,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = '{$value['tender_id']}
'";
M ()->execute ( presql ( $sql ) );
$_sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = recover_account ,recover_capital_yes = recover_capital ,recover_interest_yes = recover_interest,late_days={$late_result['late_days']}
,status=1,recover_web=1   where id = '{$value['id']}
'";
M ()->execute ( presql ( $_sql ) );
$money = $value ['recover_account'];
$more = "金额为本息。";
}
else 
{
$Vip = \usersClass::GetUsersVip ( array ( "user_id"=>$value ['user_id'] ) );
if ($Vip ['status'] == 1) 
{
$sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = recover_account ,recover_capital_yes = recover_capital ,recover_interest_yes = recover_interest,late_days={$late_result['late_days']}
,status=1,recover_web=1   where id = '{$value['id']}
'";
M ()->execute ( presql ( $sql ) );
$sql = "update  `{borrow_tender}` set recover_times='recover_times'+1,recover_account_yes= recover_account_yes + {$value['recover_account']}
,recover_account_capital_yes = recover_account_capital_yes  + {$value['recover_capital']}
,recover_account_interest_yes = recover_account_interest_yes + {$value['recover_interest']}
,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = '{$value['tender_id']}
'";
M ()->execute ( presql ( $sql ) );
$money = $value ['recover_account'];
$more = "金额为本息。";
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_interest_yes"=>$value ['recover_interest'] ) );
}
else 
{
$money = $value ['recover_capital'];
$sql = "update  `{borrow_tender}` set recover_times=`recover_times`+1,recover_account_yes= recover_account_yes + {$money}
,recover_account_capital_yes = recover_account_capital_yes  + {$money}
,recover_account_interest_yes = recover_account_interest_yes + 0,recover_account_wait= recover_account_wait - {$value['recover_account']}
,recover_account_capital_wait = recover_account_capital_wait  - {$value['recover_capital']}
,recover_account_interest_wait = recover_account_interest_wait - {$value['recover_interest']}
 where id = '{$value['tender_id']}
'";
M ()->execute ( presql ( $sql ) );
$sql = "update  `{borrow_recover}` set recover_yestime='".time () ."',recover_account_yes = {$money}
,recover_capital_yes = {$money}
,recover_interest_yes = 0 ,late_days={$late_result['late_days']}
,status=1,recover_web=1   where id = '{$value['id']}
'";
M ()->execute ( presql ( $sql ) );
$more = "金额为本金。";
}
}
}
$log_info ["user_id"] = $value ['user_id'];
$log_info ["nid"] = "system_repayment_".time () ."_".$value ['id'];
$log_info ["money"] = $money;
$log_info ["income"] = $log_info ['money'];
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $log_info ['money'];
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = -$value ['recover_account'];
$log_info ["type"] = "system_repayment";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "客户逾期超过30天，系统自动对[{$borrow_url}
]借款的还款,{$more}
";
\accountClass::AddLog ( $log_info );
$bad = $value ['recover_account'] -$money;
if ($value ['change_status'] != 1) 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "tender_recover_yes"=>$money, "tender_recover_times_yes"=>1, "tender_recover_wait"=>-$value ['recover_account'], "tender_recover_times_wait"=>-1, "bad_account"=>$bad ) );
}
else 
{
self::UpdateBorrowCount ( array ( "user_id"=>$value ['user_id'], "bad_account"=>$bad ) );
}
$web ['money'] = $money;
$web ['user_id'] = $value ['user_id'];
$web ['nid'] = "web_repay_".time ();
$web ['type'] = "web_repay";
$web ['remark'] = "用户投资{$borrow_url}
第".($repay_period +1) ."期逾期收到网站垫付金{$money}
元，{$more}
";
\accountClass::AddAccountWeb ( $web );
$log_info ["user_id"] = 0;
$log_info ["nid"] = "fengxianchi_0_".time () ."_".$value ['id'];
$log_info ["money"] = -$money;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "fengxianchi_dianfu";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "系统账户垫付[{$borrow_url}
]逾期借款金{$money}
元,{$more}
";
\accountClass::AddLog ( $log_info );
}
}
}
return 1;
}
public static function GetUserTenderAccount($data) 
{
$where = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != "") 
{
$where .= " and user_id='{$data['user_id']}
' ";
}
if (IsExiest ( $data ['borrow_nid'] ) != "") 
{
$where .= " and borrow_nid='{$data['borrow_nid']}
' ";
}
$result = M ( 'borrow_tender')->where ( $where )->field ( 'sum(account) as account_all')->find ();
if ($result != null) 
{
return $result ["account_all"];
}
return 0;
}
public static function GetVouchUsersList($data) 
{
$data ['page'] = empty ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = empty ( $data ['epage'] ) ?10 : $data ['epage'];
$_select = " p1.*,p2.credit,p3.tender_vouch";
$sql = "select SELECT from `{users}` as p1 left join `{credit}` as p2 on p1.user_id=p2.user_id left join `{user_amount}` as p3 on p1.user_id=p3.user_id where p1.user_id in (select user_id from `{user_amount}` where tender_vouch >0)  ";
if (isset ( $data ['limit'] )) 
{
$_limit = "";
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'users')->join ( presql ( '`{credit}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{user_amount}` as p3 on p1.user_id=p3.user_id') )->where ( "p1.user_id in (select user_id from `{user_amount}` where tender_vouch >0)")->limit ( $_limit )->select ();
return $list;
}
$row = M ( 'users')->join ( presql ( '`{credit}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{user_amount}` as p3 on p1.user_id=p3.user_id') )->where ( "p1.user_id in (select user_id from `{user_amount}` where tender_vouch >0)")->count ();
$total = $row ['num'];
$total_page = ceil ( $total / $epage );
$index = $epage * ($page -1);
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'users')->join ( presql ( '`{credit}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{user_amount}` as p3 on p1.user_id=p3.user_id') )->where ( "p1.user_id in (select user_id from `{user_amount}` where tender_vouch >0)")->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$list = $list ?$list : array ();
return array ( 'list'=>$list, 'total'=>$total, 'page'=>$show );
}
public static function GetAll($data = array()) 
{
$result = M ( 'borrow')->field ( 'sum(account) as account,count(1) as times')->find ();
$_result ['borrow_times'] = $result ['times'];
$_result ['borrow_account'] = $result ['account'];
$result = M ( 'borrow')->where ( 'status=3')->field ( 'sum(account) as account,count(1) as times')->find ();
if ($result == null) 
{
$_result ['borrow_success_times'] = 0;
$_result ['borrow_success_account'] = 0;
$_result ['borrow_success_scale'] = 0;
}
else 
{
$_result ['borrow_success_times'] = $result ['times'];
$_result ['borrow_success_account'] = $result ['account'];
$_result ['borrow_success_scale'] = round ( $_result ['borrow_success_times'] / $_result ['borrow_times'],2 );
}
return $_result;
}
public static function Delete($data = array()) 
{
$id = $data ['id'];
if (!is_array ( $id )) 
{
$id = array ( $id );
}
if (isset ( $data ['status'] ) &&$data ['status'] != "") 
{
$_sql .= " and status ='".$data ['status'] ."'";
}
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql = " and user_id={$data['user_id']}
";
}
return M ( 'borrow')->where ( "borrow_nid in (".join ( ",",$id ) .") $_sql")->delete ();
}
public static function ActionLiubiao($data) 
{
$status = $data ['status'];
if ($status == 1) 
{
$result = self::Cancel ( $data );
}
elseif ($status == 2) 
{
$valid_time = $data ['days'];
$sql = "update `{borrow}` set borrow_valid_time=borrow_valid_time +{$valid_time}
where borrow_nid={$data['borrow_nid']}
";
M ()->execute ( presql ( $sql ) );
}
return true;
}
public static function GetLiucheng($data) 
{
}
public static function GetOther($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != "") 
{
$_sql .= " and  user_id = '{$data['user_id']}
' ";
}
$result = M ( 'borrow_other')->where ( $_sql )->find ();
return $result;
}
public static function GetBorrowCreditUsers($data) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and type ='{$data['type']}
'";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and nid ='{$data['nid']}
'";
}
$result = M ( 'borrow_credit')->where ( $_sql )->field ( "sum(credit) as num")->find ();
return $result ['num'];
}
public static function GetBorrowTimes($data) 
{
$_sql = " 1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id ='{$data['user_id']}
'";
}
if (IsExiest ( $data ['type'] ) != false) 
{
$_sql .= " and type ='{$data['type']}
'";
}
if (IsExiest ( $data ['nid'] ) != false) 
{
$_sql .= " and nid ='{$data['nid']}
'";
}
$result = M ( 'borrow_credit')->where ( $_sql )->field ( 'count(1) as num')->find ();
if ($result == null) $result ['num'] = 0;
return $result ['num'];
}
public static function GetBorrowVip($data) 
{
global $_G;
if (IsExiest ( $_G ["borrow_vip_result"] ) != false) return $_G ["borrow_vip_result"];
$result = \usersClass::GetUsersVipStatus ( array ( "user_id"=>$data ['user_id'] ) );
$late_repay_times = 0;
$delay_repay_times = 0;
if ($result != 1) return array ( "vip"=>0, "fee"=>0 );
$vip_status = 1;
$vip_fee = isset ( $_G ['system'] ['con_vip1_fee'] ) ?$_G ['system'] ['con_vip1_fee'] : 1;
$_result = self::GetBorrowCredit ( array ( "user_id"=>$data ['user_id'] ) );
$credit = $_result ['credit_total'];
$borrow_credit = $_result ['borrow_credit'];
if ($credit >= 500 +$delay_reapy_times * 300 +$late_reapy_times * 800 &&$borrow_credit >= 300) 
{
$vip_status = 2;
$vip_fee = isset ( $_G ['system'] ['con_vip2_fee'] ) ?$_G ['system'] ['con_vip2_fee'] : 0.95;
}
if ($credit >= 1500 +$delay_reapy_times * 800 +$late_reapy_times * 1500 &&$borrow_credit >= 1200) 
{
$vip_status = 3;
$vip_fee = isset ( $_G ['system'] ['con_vip3_fee'] ) ?$_G ['system'] ['con_vip3_fee'] : 0.9;
}
if ($credit >= 5000 &&$borrow_credit >= 3500 &&dealy_reapy_times == 0 &&$delay_repay_times == 0) 
{
$vip_status = 4;
$vip_fee = isset ( $_G ['system'] ['con_vip4_fee'] ) ?$_G ['system'] ['con_vip4_fee'] : 0.85;
}
if ($credit >= 20000 &&$borrow_credit >= 16000 &&dealy_reapy_times == 0 &&$delay_repay_times == 0) 
{
$vip_status = 5;
$vip_fee = isset ( $_G ['system'] ['con_vip5_fee'] ) ?$_G ['system'] ['con_vip5_fee'] : 0.8;
}
if ($credit >= 100000 &&$borrow_credit >= 60000 &&dealy_reapy_times == 0 &&$delay_repay_times == 0) 
{
$vip_status = 6;
$vip_fee = isset ( $_G ['system'] ['con_vip6_fee'] ) ?$_G ['system'] ['con_vip6_fee'] : 0.75;
}
return array ( "vip"=>$vip_status, "fee"=>$vip_fee );
}
public static function GetBorrowCreditOne($data) 
{
global $_G;
if (IsExiest ( $_G ["borrow_credit_result"] ) != false) return $_G ["borrow_credit_result"];
if (!isset ( $data ['credits'] ) ||$data ['credits'] == "") 
{
if ($data ['user_id'] == "") return "";
$result = \creditClass::GetOne ( array ( "user_id"=>$data ['user_id'] ) );
$data ['credits'] = $result ['credits'];
}
if ($data ['credits'] == false) 
{
return array ( "credit_total"=>0, "approve_credit"=>0, "borrow_credit"=>0, "tender_credit"=>0, "vouch_credit"=>0 );
}
$result = unserialize ( $data ['credits'] );
$_result = array ();
$attcredit = M ( 'attestations')->where ( "user_id={$data['user_id']}
")->field ( 'sum(credit) as num')->find ();
foreach ( $result as $key =>$value ) 
{
$_result [$value ['class_id']] = $value ['num'];
}
$_result [6] = $attcredit ['num'];
$result = array ( "credit_total"=>$_result [2] +$_result [3] +$_result [4] +$_result [5] +$_result [6], "approve_credit"=>$_result [2], "borrow_credit"=>$_result [2] +$_result [3] +$_result [6], "tender_credit"=>$_result [2] +$_result [4], "vouch_credit"=>$_result [2] +$_result [5] );
return $result;
}
public static function GetBorrowCredit($data) 
{
global $_G;
if (IsExiest ( $_G ["borrow_credit_result"] ) != false) return $_G ["borrow_credit_result"];
if ($data ['user_id'] == "") return false;
$_result = array ();
$attcredit = \attestationsClass::GetAttestationsCredit ( array ( "user_id"=>$data ['user_id'] ) );
$credit_log = M ( 'credit_log')->where ( "user_id={$data['user_id']}
and code='borrow'")->field ( 'sum(credit) as creditnum')->find ();
$approve = M ( 'credit_log')->where ( "user_id='{$data['user_id']}
' and code='approve'")->field ( 'sum(credit) as creditnum')->find ();
$_result [1] = $attcredit;
$_result [2] = $credit_log ['creditnum'];
$_result [3] = $approve ['creditnum'];
$result = array ( "credit_total"=>$_result [2] +$_result [1] +$_result [3], "borrow_credit"=>$_result [2], "approve_credit"=>$_result [3] +$_result [1] );
return $result;
}
public static function AccountVip($data = array()) 
{
global $_G;
if (!IsExiest ( $data ['user_id'] )) return "";
$result = \usersClass::GetUsersVip ( array ( "user_id"=>$data ['user_id'] ) );
$account_result = \accountClass::GetAccount ( array ( "user_id"=>$data ['user_id'] ) );
$vip_money = isset ( $_G ['system'] ['con_vip_fee'] ) ?$_G ['system'] ['con_vip_fee'] : 120;
if ($result ['money'] <= 0 &&$account_result ['balance'] >= $vip_money &&$result ['status'] == 1) 
{
$log_info ["user_id"] = $data ['user_id'];
$log_info ["nid"] = "vip_".$data ['user_id'];
$log_info ["money"] = $vip_money;
$log_info ["income"] = 0;
$log_info ["expend"] = $vip_money;
$log_info ["balance_cash"] = -$vip_money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "vip";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "扣除VIP会员费";
\accountClass::AddLog ( $log_info );
\usersClass::UpdateUsersVipMoney ( array ( "user_id"=>$data ['user_id'], "money"=>$vip_money ) );
}
}
public static function GetBorrowCount_xin($data) 
{
if (!IsExiest ( $data ['user_id'] )) return "";
$_result = array ();
$_result = M ( 'borrow_count')->where ( "user_id={$data['user_id']}
")->find ();
$result_tender = M ( 'borrow_tender')->where ( "user_id={$data['user_id']}
")->field ( " count(*) as tender_times,count(*) as tender_success_times,sum(account) as tender_success_account,sum(recover_account_all) as tender_recover_account,sum(recover_account_yes) as tender_recover_yes,sum(recover_account_all) as tender_recover_wait,sum(account) as tender_capital_account ,sum(recover_account_interest) as tender_interest_account ,sum(recover_account_interest) as tender_interest_account ,sum(recover_account_interest) as tender_interest_wait,sum(recover_account_interest_yes) as tender_interest_yes")->find ();
$tender_recover_times_wait = M ( "borrow_tender")->where ( "user_id={$data['user_id']}
and (`recover_account_all`!=`recover_account_yes`) ")->field ( "count(*) as tender_recover_times_wait,sum(recover_account_wait) as tender_recover_wait")->find ();
$tender_recover_times_yes = M ( 'borrow_tender')->where ( "user_id={$data['user_id']}
and `recover_account_all`=`recover_account_yes`")->field ( 'count(*) as tender_recover_times_yes')->find ();
foreach ( $result_tender as $key =>$value ) 
{
$_result [$key] = $value;
}
$_result ['tender_recover_times_wait'] = $tender_recover_times_wait ['tender_recover_times_wait'];
$_result ['tender_recover_wait'] = $tender_recover_times_wait ['tender_recover_wait'];
$_result ['tender_recover_times_yes'] = $tender_recover_times_yes ['tender_recover_times_yes'];
return $_result;
}
public static function GetBorrowCount($data) 
{
$late_nums = M ( 'account_log')->where ( "user_id={$data['user_id']}
and type='borrow_repay_late'")->field ( 'count(1) as late_nums')->find ();
$latemoney = M ( 'account_log')->where ( "user_id={$data['user_id']}
and type='borrow_repay_late'")->field ( 'sum(money) as latemoney')->find ();
$_result = self::GetBorrowCount_xin ( array ( 'user_id'=>$data ['user_id'] ) );
$_result ['interest_scale'] = 0;
if ($_result != false &&$_result ['tender_capital_account'] >0) 
{
$_result ['interest_scale'] = round ( $_result ['tender_interest_account'] / $_result ['tender_capital_account'] * 100,2 );
}
$lxre = M ( 'borrow_repay')->where ( "user_id={$data['user_id']}
")->field ( 'sum(late_interest) as all_lixi')->find ();
$all = $_result ['weiyue'] +$_result ['borrow_repay_interest'] +$lxre ['all_lixi'];
if ($_result != false &&$_result ['borrow_account'] >0) 
{
$_result ['borrow_interest_scale'] = round ( $all / $_result ['borrow_account'] * 100,2 );
}
$result = M ( 'borrow_recover')->where ( "recover_status=0 and user_id='{$data['user_id']}
' and recover_time<".(time () -60 * 60 * 24 * 90) ." and recover_time<".time () )->field ( 'sum(recover_account) as num')->find ();
$_result ['bad_recover_account'] = $result ['num'];
$_result ['late_nums'] = $late_nums ['late_nums'];
$_result ['latemoney'] = $latemoney ['latemoney'];
$result = M ( 'borrow_recover')->where ( "user_id={$data['user_id']}
and recover_status=0")->order ( 'recover_time asc')->field ( 'recover_account,recover_time')->find ();
$_result ["recover_new_account"] = $result ["recover_account"];
$_result ["recover_new_time"] = $result ["recover_time"];
return $_result;
}
public static function UpdateBorrowCount($data = array()) 
{
if ($data ['user_id'] == "") return "";
$user_id = $data ['user_id'];
$result = M ( 'borrow_count')->where ( "user_id={$user_id}
")->find ();
if ($result == false||$result==null) 
{
M ( 'borrow_count')->add ( array ('user_id'=>$user_id) );
$result = M ( 'borrow_count')->where ( "user_id={$user_id}
")->find ();
}
$bdata=array();
foreach ($data as $key=>$vual)
{
if($key=='user_id') continue;
$bdata[$key]=$result[$key]+$vual;
}
M ( 'borrow_count')->where ("user_id={$user_id}
")->save( $bdata );
$data ['addtime'] = time ();
return M ( 'borrow_count_log')->add ( $data );
}
public static function GetUserCount($data) 
{
$result = M ( 'borrow')->where ( "user_id={$data['user_id']}
")->field ( 'count(1) as all_times')->find ();
$late = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow_recover}` as p2 on p1.id=p2.tender_id') )->where ( "(p1.user_id={$data['user_id']}
and p1.change_status=0) or (p1.change_userid={$data['user_id']}
and p1.change_status=1)")->field ( 'sum(p2.late_interest) as all_late_interest')->find ();
$_result = self::GetBorrowCount ( array ( "user_id"=>$data ['user_id'] ) );
$_result ['all_times'] = $result ['all_times'];
$_result ['all_late_interest'] = $late ['all_late_interest'];
$result = M ( 'account_log')->where ( "user_id ={$data['user_id']}
AND `type` = 'tender_award_add'")->field ( 'sum(money ) AS num')->find ();
$_result ['award_add'] = $result ['num'];
$result = M ( 'account_log')->where ( "user_id ={$data['user_id']}
AND `type` = 'borrow_award_lower'")->field ( 'sum( money ) AS num')->find ();
$_result ['award_lower'] = $result ['num'];
return $_result;
}
public static function GetshenqingList($data = array()) 
{
}
public static function update_shenqing($data = array()) 
{
}
public static function update_borrow($data = array()) 
{
if (!IsExiest ( $data ['borrow_nid'] )) 
{
return "borrow_nid_empty";
}
$borrow_nid = $data ['borrow_nid'];
unset ( $data ['borrow_nid'] );
M ( 'borrow')->where ( "borrow_nid='{$borrow_nid}
'")->save ( $data );
return true;
}
public static function GetshenqingOne($data = array()) 
{
}
public static function Add_shenqing($data = array()) 
{
}
public static function stop_flow($data = array()) 
{
$_sql = " where 1=1 ";
if (isset ( $data ['id'] ) &&$data ['id'] != "") 
{
$_sql .= " and id={$data['id']}
";
}
else 
{
return self::ERROR;
}
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and user_id={$data['user_id']}
";
}
$sql = "update  {borrow}  set status=5  $_sql";
M()->execute(presql($sql));
}
public static function open_flow($data = array()) 
{
$_sql = " where 1=1 ";
if (isset ( $data ['id'] ) &&$data ['id'] != "") 
{
$_sql .= " and id={$data['id']}
";
}
else 
{
return self::ERROR;
}
if (isset ( $data ['user_id'] ) &&$data ['user_id'] != "") 
{
$_sql .= " and user_id={$data['user_id']}
";
}
$sql = "update  {borrow}  set status=1  $_sql";
M()->execute(presql($sql));
}
public static function GetFlowOne_h($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) return "用户错误";
$field = " p1.*,p2.username";
$result = M ( 'approve_flow')->alias ( 'p1')->join ( presql ( "`{users}` as p2 on p1.user_id=p2.user_id") )->where ( "p1.user_id={$data['user_id']}
")->field ( $field )->find ();
return $result;
}
public static function GetRechargeCount_log($data = array()) 
{
$_sql = 'status=1';
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and user_id={$data['user_id']}
";
}
$result = M ( 'account_recharge')->where ( $_sql )->field ( "sum(money) as account,count(1) as num,type")->group ( 'type')->select ();
if ($result != false) 
{
foreach ( $result as $key =>$value ) 
{
if ($value ['type'] == 2) 
{
$_result ['recharge_all_down'] += $value ['account'];
}
elseif ($value ['type'] == 1) 
{
$_result ['recharge_all_up'] += $value ['account'];
}
else 
{
$_result ['recharge_all_other'] += $value ['account'];
}
$_result ['recharge_all'] += $value ['account'];
}
}
return $_result;
}
public static function AddTender_flow($result,$borrow_nid,$_tender) 
{
global $_G;
$borrow_result = self::GetOne ( $data = array ( 'borrow_nid'=>$borrow_nid ) );
$sql = "update `{borrow_tender}` set status=1 where id={$result}
";
M()->execute(presql($sql));
$tender_result = M('borrow_tender')->where("id={$result}
")->find();
$tender_userid = $_tender ['user_id'];
$borrow_nid = $_tender ['borrow_nid'];
$tender_id = $result;
$tender_account = $tender_result ['account'];
$flow_count = $_tender ['flow_count'];
$borrow_userid = $borrow_result ['user_id'];
$account = $tender_result ['account'];
$borrow_url = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$borrow_result['borrow_nid'])." target=_blank>{$borrow_result['name']}
</a>";
$_equal ["account"] = $tender_account;
$_equal ["period"] = $borrow_result ["borrow_period"];
$_equal ["apr"] = $borrow_result ["borrow_apr"];
$_equal ["style"] = 2;
$_equal ["type"] = "";
$equal_result = EqualInterest ( $_equal );
foreach ( $equal_result as $period_key =>$value ) 
{
$repay_month_account = $value ['account_all'];
$result = M('borrow_repay')->where("user_id={$borrow_userid}
and repay_period='0' and borrow_nid='{$borrow_nid}
'")->find();
if ($result == null) 
{
$sql = "insert into `{borrow_repay}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip()."',user_id='{$borrow_userid}
',status=1,`borrow_nid`='{$borrow_nid}
',`repay_period`='0',";
$sql .= "`repay_time`='{$value['repay_time']}
',`repay_account`='{$value['account_all']}
',";
$sql .= "`repay_interest`='{$value['account_interest']}
',`repay_capital`='{$value['account_capital']}
'";
M()->execute(presql($sql));
}
else 
{
$sql = "update `{borrow_repay}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id='{$borrow_userid}
',status=1,`borrow_nid`='{$borrow_nid}
',`repay_period`='0',";
$sql .= "`repay_time`='{$value['repay_time']}
',`repay_account`=`repay_account`+'{$value['account_all']}
',";
$sql .= "`repay_interest`=`repay_interest`+'{$value['account_interest']}
',`repay_capital`=`repay_capital`+'{$value['account_capital']}
'";
$sql .= " where user_id='{$borrow_userid}
' and repay_period='0' and borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
}
$result = M('borrow_recover')->where("user_id='{$tender_userid}
' and borrow_nid='{$borrow_nid}
' and recover_period='$period_key' and tender_id='{$tender_id}
'")->find();
if ($result == null) 
{
$sql = "insert into `{borrow_recover}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip()."',user_id='{$tender_userid}
',status=1,`borrow_nid`='{$borrow_nid}
',`borrow_userid`='{$borrow_userid}
',`tender_id`='{$tender_id}
',`recover_period`='{$period_key}
',";
$sql .= "`recover_time`='{$value['repay_time']}
',`recover_account`='{$value['account_all']}
',";
$sql .= "`recover_interest`='{$value['account_interest']}
',`recover_capital`='{$value['account_capital']}
'";
M()->execute(presql($sql));
}
else 
{
$sql = "update `{borrow_recover}` set `addtime` = '".time () ."',";
$sql .= "`addip` = '".get_client_ip() ."',user_id='{$tender_userid}
',status=1,`borrow_nid`='{$borrow_nid}
',`borrow_userid`='{$borrow_userid}
',`tender_id`='{$tender_id}
',`recover_period`='{$period_key}
',";
$sql .= "`recover_time`='{$value['repay_time']}
',`recover_account`='{$value['account_all']}
',";
$sql .= "`recover_interest`='{$value['account_interest']}
',`recover_capital`='{$value['account_capital']}
'";
$sql .= " where user_id='{$tender_userid}
' and recover_period='{$period_key}
' and borrow_nid='{$borrow_nid}
' and tender_id='{$tender_id}
'";
M()->execute(presql($sql));
}
}
$recover_times = count ( $equal_result );
$_equal ["type"] = "all";
$equal_result = EqualInterest ( $_equal );
$recover_all = $equal_result ['account_total'];
$recover_interest_all = $equal_result ['interest_total'];
$recover_capital_all = $equal_result ['capital_total'];
$sql = "update `{borrow_tender}` set recover_account_all='{$equal_result['account_total']}
',recover_account_interest='{$equal_result['interest_total']}
',recover_account_wait='{$equal_result['account_total']}
',recover_account_interest_wait='{$equal_result['interest_total']}
',recover_account_capital_wait='{$equal_result['capital_total']}
'  where id='{$tender_id}
'";
M()->execute(presql($sql));
$sql = "update `{borrow}` set repay_account_all=repay_account_all+'{$equal_result['account_total']}
',repay_account_interest=repay_account_interest+'{$equal_result['interest_total']}
',repay_account_capital=repay_account_capital+'{$equal_result['capital_total']}
',repay_account_wait=repay_account_wait+'{$equal_result['account_total']}
',repay_account_interest_wait=repay_account_interest_wait+'{$equal_result['interest_total']}
',repay_account_capital_wait=repay_account_capital_wait+'{$equal_result['capital_total']}
',flow_money=flow_money+'{$tender_account}
',flow_count=flow_count+'{$flow_count}
' where borrow_nid='{$borrow_nid}
'";
M()->execute(presql($sql));
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_success_".$borrow_nid .$tender_userid .$tender_id .$period_key;
$log_info ["money"] = $tender_account;
$log_info ["income"] = 0;
$log_info ["expend"] = $tender_account;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = -$tender_account;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_success";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "投标[{$borrow_url}
]成功投资金额扣除";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_success_frost_".$borrow_nid .$tender_userid .$tender_id .$period_key;
$log_info ["money"] = $recover_all;
$log_info ["income"] = 0;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = 0;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = $recover_all;
$log_info ["type"] = "tender_success_frost";
$log_info ["to_userid"] = $borrow_userid;
$log_info ["remark"] = "投标[{$borrow_url}
]成功待收金额增加";
\accountClass::AddLog ( $log_info );
$user_log ["user_id"] = $tender_userid;
$user_log ["code"] = "tender";
$user_log ["type"] = "tender_success";
$user_log ["operating"] = "tender";
$user_log ["article_id"] = $tender_userid;
$user_log ["result"] = 1;
$user_log ["content"] = "投资流转标：[{$borrow_url}
]成功";
\usersClass::AddUsersLog ( $user_log );
if ($borrow_result ['award_status'] != 0) 
{
if ($borrow_result ['award_status'] == 1) 
{
$money = round ( ($tender_account / $borrow_result ['account']) * $borrow_result ['award_account'],2 );
}
elseif ($borrow_result ['award_status'] == 2) 
{
$money = round ( (($borrow_result ['award_scale'] / 100) * $tender_account),2 );
}
$log_info ["user_id"] = $tender_userid;
$log_info ["nid"] = "tender_award_add_".$tender_userid ."_".$tender_id .$borrow_nid;
$log_info ["money"] = $money;
$log_info ["income"] = $money;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $money;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "tender_award_add";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "借款[{$borrow_url}
]的借款奖励";
\accountClass::AddLog ( $log_info );
}
self::UpdateBorrowCount ( array ( "user_id"=>$tender_userid, "tender_times"=>1, "tender_account"=>$tender_account, "tender_success_times"=>1, "tender_success_account"=>$tender_account, "tender_recover_account"=>$recover_all, "tender_recover_wait"=>$recover_all, "tender_capital_account"=>$recover_capital_all, "tender_capital_wait"=>$recover_capital_all, "tender_interest_account"=>$recover_interest_all, "tender_interest_wait"=>$recover_interest_all, "tender_recover_times"=>$recover_times, "tender_recover_times_wait"=>$recover_times ) );
}
public static function GetInviteTenderList($data = array()) 
{
$_sql = " p1.user_id=p5.user_id and p1.id=p5.tender_id";
if (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and p7.username  = '{$data['username']}
'";
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$_sql .= " and p1.addtime > ".get_mktime( $data ['dotime1'] ) ;
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$_sql .= " and p1.addtime < ".get_mktime ( $data ['dotime2'] ) ;
}
if (IsExiest ( $data ['keywords'] ) != false) 
{
$_sql .= " and name like '%".$data ['keywords']."%'";
}
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and p5.spread_userid = '".urldecode ( $data ['user_id'] ) ."'";
}
$_select = "p1.user_id as tend_uid,p1.addtime as tend_time,p1.account_tender as tender_account,p2.*,p3.username as borrow_username,p3.user_id,p8.niname as borrow_niname,p4.username as tender_username,p5.nikename as t_nikename,p5.spread_nike as recommon_nike,p5.spread_userid as recommon_id,p5.status as spread,p6.credit,p7.username as recommon_name ";
$_order = " order by tend_time desc";
$row = M("borrow_tender")->alias("p1") ->join(presql("`{borrow}` as p2 on p2.borrow_nid=p1.borrow_nid ")) ->join(presql("`{users}` as p3 on p3.user_id=p2.user_id")) ->join(presql("`{users_info}` as p8 on p8.user_id=p2.user_id")) ->join(presql("`{users}` as p4 on p4.user_id=p1.user_id")) ->join(presql("`{spread}` as p5 on p5.user_id=p1.user_id")) ->join(presql("`{credit}` as p6 on p6.user_id=p3.user_id")) ->join(presql("`{users}` as p7 on p7.user_id=p5.spread_userid")) ->where ( $_sql )->count ();
$total = intval ( $row ['num'] );
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$_limit = " limit ".($data ['epage'] * ($data ['page'] -1)) .", {$data['epage']}
";
$list = M("borrow_tender")->alias("p1") ->join(presql("`{borrow}` as p2 on p2.borrow_nid=p1.borrow_nid ")) ->join(presql("`{users}` as p3 on p3.user_id=p2.user_id")) ->join(presql("`{users_info}` as p8 on p8.user_id=p2.user_id")) ->join(presql("`{users}` as p4 on p4.user_id=p1.user_id")) ->join(presql("`{spread}` as p5 on p5.user_id=p1.user_id")) ->join(presql("`{credit}` as p6 on p6.user_id=p3.user_id")) ->join(presql("`{users}` as p7 on p7.user_id=p5.spread_userid")) ->where ( $_sql )->field ( $_select)->page ( $data ['page'] .",{$data ['epage']}
")->select ();
$result = array ( 'list'=>$list ?$list : array (), 'page'=>$show ) ;
return $result;
}
public static function GetUpfilesList($data = array()) 
{
$where = "1=1 ";
if (IsExiest ( $data ['borrow_info'] ) != false) 
{
$where .= " and p1.`id` in ({$data['borrow_info']}
) ";
}
else 
{
return false;
}
$_limit = '';
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$list = M ( 'users_upfiles')->alias ( 'p1')->where ( $where )->limit ( $_limit )->select ();
return $list;
}
}
public static function UpdateBorrowInfo($data = array()) 
{
if (!IsExiest ( $data ['borrow_nid'] )) 
{
return false;
}
if (!IsExiest ( $data ["borrow_info"] )) 
{
return false;
}
$borrow_nid = $data ['borrow_nid'];
$result = self::GetOne ( $data );
if (is_array ( $result )) 
{
if ($result ['borrow_info'] == '') 
{
$borrow_info = $data ["borrow_info"];
}
else 
{
$borrow_info = $result ['borrow_info'] .','.$data ["borrow_info"];
}
M ( 'borrow')->where ( "`borrow_nid`='{$borrow_nid}
'")->setField ( 'borrow_info',$borrow_info );
return true;
}
else 
{
return false;
}
}
public static function DelBorrowInfo($data = array()) 
{
if (!IsExiest ( $data ['borrow_nid'] )) 
{
return false;
}
if (!IsExiest ( $data ["borrow_info"] )) 
{
return false;
}
$borrow_nid = $data ['borrow_nid'];
$result = self::GetOne ( $data );
if (is_array ( $result )) 
{
$infoarray = explode ( ",",$result ['borrow_info'] );
$borrow = array ();
foreach ( $infoarray as $vual ) 
{
if ($vual == $data ["borrow_info"]) continue;
$borrow [] = $vual;
}
$borrow_info = implode ( ",",$borrow );
$result = M ( 'borrow')->where ( "`borrow_nid`='{$borrow_nid}
'")->setField ( 'borrow_info',$borrow_info );
return true;
}
else 
{
return false;
}
}
public static function AddBorrowTiyan($data = array()) 
{
if (!IsExiest ( $data ['user_id'] )) 
{
return "borrow_user_id_empty";
}
if (!IsExiest ( $data ['name'] )) 
{
return "borrow_name_empty";
}
$data ['account'] = 100;
$data ['borrow_period'] = 1;
$data ['borrow_valid_time'] = 1;
$data ['tiyan_status'] = 1;
$result = M ( 'borrow')->where ( "user_id={$data['user_id']}
")->count ();
if ($result >0) 
{
return "borrow_tiyan_not_public";
}
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
return M ( 'borrow')->add ( $data );
}
}
?>