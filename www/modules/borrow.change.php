
<?php
global $MsgInfo;
$MsgInfo ["borrow_change_action_error"] = "您的操作有误，请不要乱操作";
$MsgInfo ["borrow_change_account_not_numeric"] = "转让金额必须是数字";
$MsgInfo ["borrow_change_account_most"] = "转让金额不能小于0";
$MsgInfo ["borrow_change_action_success"] = "转让信息发布成功";
$MsgInfo ["borrow_change_status_yes"] = "此信息已经转让，请等待管理员审核";
$MsgInfo ["borrow_change_paypassword_error"] = "支付密码不正确";
$MsgInfo ["borrow_change_wait_account_error"] = "转让金额不能大于待收金额";
$MsgInfo ["borrow_change_cancel_success"] = "债权转让撤销成功";
$MsgInfo ["borrow_change_web_success"] = "债权转让成功，请等待管理员审核";
$MsgInfo ["borrow_change_cancel_error"] = "债权转让撤销失败，请不要乱操作";
$MsgInfo ["borrow_change_not_self"] = "不能购买自己的债权";
$MsgInfo ["borrow_change_account_error"] = "你的可用金额不足";
$MsgInfo ["borrow_change_buy_error"] = "债权购买失败";
$MsgInfo ["borrow_change_buy_success"] = "债权购买成功";
$MsgInfo ["borrow_change_verify_error"] = "债权审核成功";
$MsgInfo ["borrow_change_verify_success"] = "网站审核成功";
class borrowChangeClass 
{
	function GetChangeList($data) 
	{
		$_sql = "1=1";
		if ($data ['user_id'] != "") 
		{
			$_sql .= " and p0.user_id='{$data['user_id']}
		'";
	}
	if ($data ['buy_userid'] != ""||$data ['buy_userid'] == "0") 
	{
		$_sql .= " and p0.buy_userid='{$data['buy_userid']}
	'";
}
if ($data ['id'] != "") 
{
	$_sql .= " and p0.id='{$data['id']}
'";
}
if ($data ['change_status'] != ""||$data ['change_status'] == "0") 
{
$_sql .= " and p1.change_status='{$data['change_status']}
'";
}
if ($data ['status'] != ""||$data ['status'] == "0") 
{
$_sql .= " and p0.status in ({$data['status']}
)";
}
if ($data ['web'] != "") 
{
$_sql .= " and p0.web_status=2";
}
if (IsExiest ( $data ['borrow_type'] ) != false) 
{
if ($data ['borrow_type'] == "credit") 
{
$_sql .= " and p3.`vouchstatus`!=1 and `fast_status`!=1";
}
elseif ($data ['borrow_type'] == "vouch") 
{
$_sql .= " and p3.`vouchstatus`=1";
}
elseif ($data ['borrow_type'] == "fast") 
{
$_sql .= " and p3.`fast_status`=1";
}
}
if (IsExiest ( $data ['dotime1'] ) != false) 
{
$dotime1 = ($data ['dotime1'] == "request") ?$_REQUEST ['dotime1'] : $data ['dotime1'];
if ($dotime1 != "") 
{
$_sql .= " and p0.addtime > ".get_mktime ( $dotime1 );
}
}
if (IsExiest ( $data ['dotime2'] ) != false) 
{
$dotime2 = ($data ['dotime2'] == "request") ?$_REQUEST ['dotime2'] : $data ['dotime2'];
if ($dotime2 != "") 
{
$_sql .= " and p0.addtime < ".get_mktime ( $dotime2 );
}
}
if (IsExiest ( $data ['account_status'] != "")) 
{
if ($data ['account_status'] == 1) 
{
$_sql .= " and p1.recover_account_capital_wait >= 2000 and p1.recover_account_capital_wait <= 5000";
}
elseif ($data ['account_status'] == 2) 
{
$_sql .= " and p1.recover_account_capital_wait >= 5000 and p1.recover_account_capital_wait <= 10000";
}
elseif ($data ['account_status'] == 3) 
{
$_sql .= " and p1.recover_account_capital_wait >= 10000 and p1.recover_account_capital_wait <= 30000";
}
elseif ($data ['account_status'] == 4) 
{
$_sql .= " and p1.recover_account_capital_wait >= 30000 and p1.recover_account_capital_wait <= 50000";
}
elseif ($data ['account_status'] == 5) 
{
$_sql .= " and p1.recover_account_capital_wait >= 50000";
}
}
if (IsExiest ( $data ['borrow_name'] ) != false) 
{
$_sql .= " and p3.`name` like '%".urldecode ( $data ['borrow_name'] ) ."%'";
}
$field = "p0.*,p0.web_account as web_buy,p1.recover_times,p1.id as tid,p1.recover_account_wait,p1.recover_account_capital_wait,p1.user_id as tuser,p1.recover_account_interest_wait,p2.username,p3.name as borrow_name,p3.borrow_period,p3.borrow_apr,p3.borrow_nid,p4.username as buy_username,p5.niname as b_nikename,p6.niname as t_nikename";
$_order = " p0.id desc";
if (IsExiest ( $data ['apr'] ) != "") 
{
if ($data ['apr'] == "apr_up") 
{
$_order .= ",p3.`borrow_apr` desc";
}
elseif ($data ['apr'] == "apr_down") 
{
$_order .= ",p3.`borrow_apr` asc";
}
}
if (IsExiest ( $data ['order'] ) != "") 
{
$order = $data ['order'];
if ($order == "time_up") 
{
$_order = " p0.id asc";
}
if ($order == "status") 
{
$_order = " p0.status desc,p0.id desc";
}
}
if (IsExiest ( $data ['limit'] ) != false) 
{
if ($data ['limit'] != "all") 
{
$_limit = $data ['limit'];
}
$result = M ( 'borrow_change')->alias ( 'p0')->join ( presql ( '`{borrow_tender}` as p1  on p0.tender_id=p1.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p0.buy_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p0.buy_userid=p5.user_id') )->join ( presql ( '`{users_info}` as p6 on p1.user_id=p6.user_id') )->where ( $_sql )->field ( $field )->order ( $_order )->limit ( $_limit )->select ();
foreach ( $result as $key =>$value ) 
{
$result [$key] ['wait_times'] = $value ['borrow_period'] -$value ['recover_times'];
$list [$key] ['web_account'] = round ( $value ['recover_account_wait'] * 0.7,2 );
}
return $result;
}
$row = M ( 'borrow_change')->alias ( 'p0')->join ( presql ( '`{borrow_tender}` as p1  on p0.tender_id=p1.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p0.buy_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p0.buy_userid=p5.user_id') )->join ( presql ( '`{users_info}` as p6 on p1.user_id=p6.user_id') )->where ( $_sql )->count ();
$data ['page'] = !IsExiest ( $data ['page'] ) ?1 : $data ['page'];
$data ['epage'] = !IsExiest ( $data ['epage'] ) ?10 : $data ['epage'];
$Page = new \Think\Page ( $row,$data ['epage'] );
$show = $Page->show ();
$list = M ( 'borrow_change')->alias ( 'p0')->join ( presql ( '`{borrow_tender}` as p1  on p0.tender_id=p1.id') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid') )->join ( presql ( '`{users}` as p4 on p0.buy_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p0.buy_userid=p5.user_id') )->join ( presql ( '`{users_info}` as p6 on p1.user_id=p6.user_id') )->where ( $_sql )->field ( $field )->order ( $_order )->page ( $data ['page'] .",{$data ['epage']}
")->select ();
foreach ( $list as $key =>$value ) 
{
$list [$key] ["credit"] = \borrowClass::GetBorrowCredit ( array ( "user_id"=>$value ['user_id'] ) );
$recoverresult = M ( 'borrow_repay')->where ( "borrow_nid={$value['borrow_nid']}
and (repay_status=1 or repay_web=1)")->field ( 'count(1) as num')->find ();
if($value ['borrow_period']<1)
{
$list [$key] ['wait_times'] = 1 -$recoverresult ['num'];
}
else
{
$list [$key] ['wait_times'] = $value ['borrow_period'] -$recoverresult ['num'];
}
$list [$key] ['web_account'] = round ( $value ['recover_account_wait'] * 0.7,2 );
$list [$key] ['buyaccount'] = round ( $value ['account'] * 2,2 );
$chresult = M ( 'borrow_change')->where ( "tender_id={$value['tid']}
")->field ( 'status,buy_time,web_time')->find ();
if ($chresult ['status'] == 1) 
{
$recresult = M ( 'borrow_recover')->where ( "user_id={$value['tuser']}
and borrow_nid='{$value['borrow_nid']}
' and (recover_yestime>{$chresult['buy_time']}
or recover_yestime is NULL) and tender_id={$value['tid']}
")->field ( 'count(1) as count_all,sum(recover_account_yes) as recover_account_yes_all,sum(recover_account) as recover_account_all')->find ();
$list [$key] ["recover_account_waits"] = $recresult ['recover_account_all'] -$recresult ['recover_account_yes_all'];
$list [$key] ["recover_account_all"] = $recresult ['recover_account_all'];
$list [$key] ["recover_account_yes"] = $recresult ['recover_account_yes_all'];
$list [$key] ["count_all"] = $recresult ['count_all'];
}
$recre = M ( 'borrow_recover')->alias ( 'p1')->join ( presql ( '`{borrow_tender}` as p2 on p1.tender_id=p2.id') )->where ( "p1.borrow_nid='{$value['borrow_nid']}
' and p2.change_status=1 and p2.change_userid=0 and p1.recover_web=1")->field ( 'sum(p1.recover_account) as all_account')->find ();
if ($chresult ['buy_time'] != "") 
{
$list [$key] ["recover_web_account"] = $recre ['all_account'];
$capital = M ( 'borrow_recover')->where ( "tender_id={$value['tender_id']}
and recover_yestime>{$chresult['buy_time']}
and advance_status=1")->field ( 'sum(recover_capital) as capital_yes')->find ();
$list [$key] ["capital_no"] = $capital ['capital_yes'] / 100;
$interest = M ( 'borrow_recover')->where ( "tender_id={$value['tender_id']}
and recover_yestime>{$chresult['buy_time']}
and advance_status=1")->field ( 'sum(recover_interest) as interest_yes')->find ();
$list [$key] ["interest_no"] = $interest ['interest_yes'];
$_recresult = M ( 'borrow_recover')->where ( "user_id={$value['tuser']}
and (recover_yestime>{$chresult['buy_time']}
or recover_yestime is NULL) and tender_id={$value['tid']}
and (recover_status=1 or recover_web=1)")->field ( 'count(1) as num')->find ();
$list [$key] ["yes_times"] = $_recresult ['num'];
}
}
foreach ( $list as $key =>$value ) 
{
$all += $value ['recover_account_all'];
$repay += $value ['recover_account_yes'];
$wait += $value ['recover_account_wait'];
$wait_times += $value ['wait_times'];
$yes_times += $value ['yes_times'];
$count_all += $value ['count_all'];
$recover_account_capital_wait += $value ['recover_account_capital_wait'];
$recover_account_interest_wait += $value ['recover_account_interest_wait'];
if ($value ['web_status'] == 2) 
{
$account += $value ['web_buy'];
$list [$key] ["jingzhuan"] = round ( $list [$key] ["recover_account_all"] -$value ['web_buy'] -$list [$key] ["interest_no"],2 );
}
else 
{
$account += $value ['account'];
$list [$key] ["jingzhuan"] = $list [$key] ["recover_account_all"] -$value ['account'];
}
$shouyi += $list [$key] ["jingzhuan"];
if ($value ['status'] == 1 &&$value ['web_status'] == 2) 
{
$change_account += $value ['web_buy'];
}
elseif ($value ['status'] == 1 &&$value ['web_status'] != 2) 
{
$change_account += $value ['account'];
}
elseif ($value ['status'] == 4) 
{
$change_account += $value ['web_account'];
}
}
$lost = round ( $account -$recover_account_capital_wait -$recover_account_interest_wait,2 );
$jingzhuan = round ( $all -$account,2 );
$result = array ( 'list'=>$list ?$list : array (), 'total'=>$total, 'type_name'=>$type_name, 'page'=>$show, 'recover_account_capital_wait'=>$recover_account_capital_wait, 'recover_account_interest_wait'=>$recover_account_interest_wait, 'account'=>$account, 'lost'=>$lost, 'jingzhuan'=>$jingzhuan, 'all'=>$all, 'count_all'=>$count_all, 'wait'=>$wait, 'repay'=>$repay, 'shouyi'=>$shouyi, 'wait_times'=>$wait_times, 'yes_times'=>$yes_times, 'change_account'=>$change_account );
return $result;
}
public static function ActionChange($data) 
{
$result = M ( 'borrow_tender')->where ( "user_id={$data['user_id']}
and id={$data['id']}
")->find ();
if ($result == null) return "borrow_change_action_error";
if (!is_numeric ( $data ['account'] )) return "borrow_change_account_not_numeric";
if ($result ['recover_account_wait'] <$data ['account']) return "borrow_change_wait_account_error";
if ($data ['account'] <= 0) return "borrow_change_account_most";
if ($result ['change_status'] == 1) return "borrow_change_status_yes";
$result = M ( 'users')->where ( "user_id={$data['user_id']}
and paypassword='".md5 ( $data ['paypassword'] ) ."'")->find ();
if ($result == null) return "borrow_change_paypassword_error";
$sql = "update `{borrow_tender}` set change_status=2 where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$idata ['user_id'] = $data ['user_id'];
$idata ['tender_id'] = $data ['id'];
$idata ['status'] = 2;
$idata ['account'] = $data ['account'];
$idata ['remark'] = $data ['remark'];
$idata ['valid_day'] = $data ['valid_day'];
$idata ['addtime'] = time ();
$idata ['addip'] = get_client_ip ();
return M ( 'borrow_change')->add ( $idata );
}
public static function CancelChange($data) 
{
$result = M ( 'borrow_change')->where ( "user_id={$data['user_id']}
and id={$data['id']}
")->find ();
if ($result == null) return "borrow_change_cancel_error";
if ($result ['status'] != 2) return "borrow_change_cancel_error";
$_result = M ( 'users')->where ( "user_id={$data['user_id']}
and paypassword='".md5 ( $data ['paypassword'] ) ."'")->find ();
if ($_result == false) return "borrow_change_paypassword_error";
$sql = "update `{borrow_tender}` set change_status=5 where id={$result['tender_id']}
";
M ()->execute ( presql ( $sql ) );
$sql = "update `{borrow_change}` set status=5,cancel_status=1,cancel_remark='{$data['cancel_remark']}
',cancel_time='".time () ."' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function WebChange($data) 
{
$result = M ( 'borrow_change')->where ( "user_id={$data['user_id']}
and id={$data['id']}
")->find ();
if ($result == null) return "borrow_change_cancel_error";
if ($result ['status'] != 2) return "borrow_change_cancel_error";
$_result = M ( 'users')->where ( "user_id={$data['user_id']}
and paypassword='".md5 ( $data ['paypassword'] ) ."'")->find ();
if ($_result == null) return "borrow_change_paypassword_error";
$sql = "update `{borrow_tender}` set change_status=4 where id={$result['tender_id']}
";
M ()->execute ( presql ( $sql ) );
$sql = "update `{borrow_change}` set status=4,web_status=2,web_time='".time () ."' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
return $data ['id'];
}
public static function BuyChange($data) 
{
$result = M ( 'borrow_change')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "borrow_change_buy_error";
if ($result ['status'] != 2) return "borrow_change_buy_error";
if ($result ['user_id'] == $data ['user_id']) return "borrow_change_not_self";
$tender_result = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p2.borrow_nid=p1.borrow_nid') )->where ( "p1.id={$result['tender_id']}
")->field ( 'p1.*,p2.name,p2.user_id as borrowuser')->find ();
$repay_result = M ( 'borrow_repay')->where ( "borrow_nid={$tender_result['borrow_nid']}
and repay_status=0")->field ( 'count(1) as no_repay_times')->find ();
$change_fee = round ( $tender_result ['recover_account_interest_wait'] * 0.05,2 );
$result ['borrow_name'] = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$tender_result['borrow_nid']).">{$tender_result['name']}
</a>";
$_result = M ( 'users')->where ( "user_id='{$data['user_id']}
' and paypassword='".md5 ( $data ['paypassword'] ) ."'")->find ();
if ($_result == null) return "borrow_change_paypassword_error";
$account_result = M ( 'account')->where ( "user_id={$data['user_id']}
")->find ();
if ($account_result ['balance'] <$result ['account'] +$change_fee) return "borrow_change_account_error";
$sql = "update `{borrow_tender}` set change_status=1,change_userid='{$data['user_id']}
' where id={$result['tender_id']}
";
M ()->execute ( presql ( $sql ) );
$nid = M ( 'borrow_change')->field ( 'max(change_nid) as maxnid')->find ();
if ($nid ['maxnid'] == "") 
{
$today = date ( "Ym");
$data ["change_nid"] = $today ."00001";
}
else 
{
$today = date ( "Ym");
$pid = str_replace ( $today,'',$nid ['maxnid'] );
if (strlen ( $pid ) == strlen ( $nid ['maxnid'] )) 
{
$data ["change_nid"] = $today ."00001";
}
else 
{
$pid = $today .str_pad ( $pid,5,"0",STR_PAD_LEFT );
$data ["change_nid"] = $pid +1;
}
}
$sql = "update `{borrow_change}` set status=1,buy_userid='{$data['user_id']}
',change_nid='{$data['change_nid']}
',buy_time='".time () ."' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$borrowuser = self::GetUsers ( array ( "user_id"=>$tender_result ['borrowuser'] ) );
$selluser = self::GetUsers ( array ( "user_id"=>$result ['user_id'] ) );
$selluserinfo=\usersClass::GetUsersInfo ( array ( "user_id"=>$result ['user_id'] ) );
$buyuser = self::GetUsers ( array ( "user_id"=>$data ['user_id'] ) );
$buyuserinfo=\usersClass::GetUsersInfo ( array ( "user_id"=>$data ['user_id'] ) );
$remind ['nid'] = "borrow_change_yes";
$remind ['receive_userid'] = $tender_result ['borrowuser'];
$remind ['code'] = "borrow";
$remind ['article_id'] = $tender_result ['borrow_nid'];
$remind ['title'] = "{$tender_result['name']}
债权人转移";
$remind ['content'] = "在您的借款标[{$result['borrow_name']}
]中{$selluserinfo['niname']}
所持有的债权已在".date ( "Y-m-d",time () ) ."转让给{$buyuserinfo['niname']}
";
\remindClass::sendRemind ( $remind );
$account = $result ['account'];
$log_info ["user_id"] = $result ['user_id'];
$log_info ["nid"] = "borrow_change_sell_".$result ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $account;
$log_info ["income"] = $account;
$log_info ["expend"] = 0;
$log_info ["balance_cash"] = $account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = -$tender_result ['recover_account_wait'];
$log_info ["type"] = "borrow_change_sell";
$log_info ["to_userid"] = $data ['user_id'];
$log_info ["remark"] = "成功出售[{$result['borrow_name']}
]债权的金额";
\accountClass::AddLog ( $log_info );
\borrowClass::UpdateBorrowCount ( array ( "user_id"=>$result ['user_id'], "tender_recover_times_wait"=>-$repay_result ['no_repay_times'], "tender_recover_wait"=>-$tender_result ['recover_account_wait'] ) );
$user_log ["user_id"] = $result ['user_id'];
$user_log ["code"] = "borrow";
$user_log ["type"] = "borrow_change";
$user_log ["operating"] = "borrow";
$user_log ["article_id"] = $result ['user_id'];
$user_log ["result"] = 1;
$user_log ["content"] = "成功出售[{$result['borrow_name']}
]债权的金额,[<a href=".$_G['weburl'].U('Index/Index/index?site=debt_protocol&nid='.$data['id'])." target=_blank>点击此处</a>]查看协议书";
self::AddUsersLog ( $user_log );
$log_info ["user_id"] = $data ['user_id'];
$log_info ["nid"] = "borrow_change_buy_".$data ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $account;
$log_info ["income"] = 0;
$log_info ["expend"] = $account;
$log_info ["balance_cash"] = -$account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = $tender_result ['recover_account_wait'];
$log_info ["type"] = "borrow_change_buy";
$log_info ["to_userid"] = $result ['user_id'];
$log_info ["remark"] = "成功购买[{$result['borrow_name']}
]债权的所付出金额";
\accountClass::AddLog ( $log_info );
$user_log ["user_id"] = $data ['user_id'];
$user_log ["code"] = "borrow";
$user_log ["type"] = "borrow_change";
$user_log ["operating"] = "borrow";
$user_log ["article_id"] = $data ['user_id'];
$user_log ["result"] = 1;
$user_log ["content"] = "成功购买[{$result['borrow_name']}
]债权的金额,[<a href=".$_G['weburl'].U('Index/Index/index?site=debt_protocol&nid='.$data['id'])." target=_blank>点击此处</a>]查看协议书";
self::AddUsersLog ( $user_log );
$log_info ["user_id"] = $data ['user_id'];
$log_info ["nid"] = "borrow_change_buy_fee_".$data ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $change_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $change_fee;
$log_info ["balance_cash"] = -$change_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_change_buy_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "扣除购买[{$result['borrow_name']}
]债权的手续费";
\accountClass::AddLog ( $log_info );
$log_info ["user_id"] = $result ['user_id'];
$log_info ["nid"] = "borrow_change_sell_fee_".$result ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $change_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $change_fee;
$log_info ["balance_cash"] = -$change_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_change_sell_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "扣除出售[{$result['borrow_name']}
]债权的手续费";
\accountClass::AddLog ( $log_info );
return $data ['id'];
}
public static function GetChangeOne($data) 
{
$_sql = "1=1";
if ($data ['user_id'] != "") 
{
$_sql .= " and p0.user_id='{$data['user_id']}
'";
}
if ($data ['buy_userid'] != ""||$data ['buy_userid'] == "0") 
{
$_sql .= " and p0.buy_userid='{$data['buy_userid']}
'";
}
if ($data ['change_status'] != ""||$data ['change_status'] == "0") 
{
$_sql .= " and p1.change_status='{$data['change_status']}
'";
}
if ($data ['id'] != "") 
{
$_sql .= " and p0.id='{$data['id']}
'";
}
if ($data ['status'] != ""||$data ['status'] == "0") 
{
$_sql .= " and p0.status in ({$data['status']}
)";
}
if (IsExiest ( $data ['borrow_type'] ) != false) 
{
if ($data ['borrow_type'] == "credit") 
{
$_sql .= " and p3.`vouchstatus`!=1 and `fast_status`!=1";
}
elseif ($data ['borrow_type'] == "vouch") 
{
$_sql .= " and p3.`vouchstatus`=1";
}
elseif ($data ['borrow_type'] == "fast") 
{
$_sql .= " and p3.`fast_status`=1";
}
}
if (IsExiest ( $data ['account_status'] != "")) 
{
if ($data ['account_status'] == 1) 
{
$_sql .= " and p1.recover_account_capital_wait >= 2000 and p1.recover_account_capital_wait <= 5000";
}
elseif ($data ['account_status'] == 2) 
{
$_sql .= " and p1.recover_account_capital_wait >= 5000 and p1.recover_account_capital_wait <= 10000";
}
elseif ($data ['account_status'] == 3) 
{
$_sql .= " and p1.recover_account_capital_wait >= 10000 and p1.recover_account_capital_wait <= 30000";
}
elseif ($data ['account_status'] == 4) 
{
$_sql .= " and p1.recover_account_capital_wait >= 30000 and p1.recover_account_capital_wait <= 50000";
}
elseif ($data ['account_status'] == 5) 
{
$_sql .= " and p1.recover_account_capital_wait >= 50000";
}
}
if (IsExiest ( $data ['borrow_name'] ) != false) 
{
$_sql .= " and p3.`name` like '%".urldecode ( $data ['borrow_name'] ) ."%'";
}
$field = "p0.*,p1.recover_times,p1.recover_account_wait,p1.recover_account_capital_wait,p1.recover_account_interest_wait,p2.username,p3.name as borrow_name,p3.borrow_period,p3.borrow_apr,p3.borrow_nid,p3.nikename,p4.username as change_username,p5.niname as t_nikename,p6.niname as c_nikename";
$_order = " p1.id desc";
if (IsExiest ( $data ['order'] ) != "") 
{
$order = $data ['order'];
if ($order == "time_up") 
{
$_order = "order by p1.id asc";
}
}
if (IsExiest ( $data ['apr'] ) != "") 
{
if ($data ['apr'] == "apr_up") 
{
$_order .= ",p3.`borrow_apr` desc";
}
elseif ($data ['apr'] == "apr_down") 
{
$_order .= ",p3.`borrow_apr` asc";
}
}
$result = M ( 'borrow_change')->alias ( 'p0')->join ( presql ( '`{borrow_tender}` as p1  on p0.tender_id=p1.id ') )->join ( presql ( '`{users}` as p2 on p1.user_id=p2.user_id') )->join ( presql ( '`{borrow}` as p3 on p1.borrow_nid=p3.borrow_nid ') )->join ( presql ( '`{users}` as p4 on p1.change_userid=p4.user_id') )->join ( presql ( '`{users_info}` as p5 on p5.user_id=p1.user_id') )->join ( presql ( '`{users_info}` as p6 on p1.change_userid=p6.user_id') )->where ( $_sql )->field ( $field )->order ( $_order )->find ();
return $result;
}
public static function UpdateBorrowCount($data = array()) 
{
if ($data ['user_id'] == "") return "";
$user_id = $data ['user_id'];
$result = M ( 'borrow_count')->where ( "user_id={$data['user_id']}
")->find ();
if ($result == null) 
{
$sql = "insert into `{borrow_count}` set user_id={$data['user_id']}
";
M ()->execute ( presql ( $sql ) );
}
unset ( $data ['user_id'] );
M ( 'borrow_count')->where ( "user_id={$user_id}
")->save ( $data );
return "";
}
public static function AddUsersLog($data) 
{
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'users_log')->add ( $data );
}
public static function GetUsers($data = array()) 
{
$_sql = "1=1 ";
if (IsExiest ( $data ['user_id'] ) != false) 
{
$_sql .= " and `user_id`  = '{$data['user_id']}
'";
}
elseif (IsExiest ( $data ['username'] ) != false) 
{
$_sql .= " and `username` like '%{$data['username']}
%'";
}
elseif (IsExiest ( $data ['email'] ) != false) 
{
$_sql .= " and `email` like '%{$data['email']}
%'";
}
return M ( 'users')->where ( $_sql )->find ();
}
public static function WebVerifyChange($data) 
{
$result = M ( 'borrow_change')->where ( "id={$data['id']}
")->find ();
if ($result == null) return "borrow_change_verify_error";
if ($result ['status'] != 4) return "borrow_change_verify_error";
$tender_result = M ( 'borrow_tender')->alias ( 'p1')->join ( presql ( '`{borrow}` as p2 on p2.borrow_nid=p1.borrow_nid') )->where ( "p1.id={$result['tender_id']}
")->field ( 'p1.*,p2.name,p2.user_id as borrowuser')->find ();
$repay_result = M ( 'borrow_repay')->where ( "borrow_nid={$tender_result['borrow_nid']}
and repay_status=0")->field ( 'count(1) as no_repay_times')->find ();
$change_fee = round ( $tender_result ['recover_account_interest_wait'] * 0.05,2 );
$result ['borrow_name'] = "<a href=".$_G['weburl'].U('Index/Index/index?site=full_success&nid='.$tender_result['borrow_nid']).">{$tender_result['name']}
</a>";
if ($data ['status'] == 1) 
{
$status = 1;
}
else 
{
$status = 6;
}
$sql = "update `{borrow_tender}` set change_status={$status}
,change_userid='{$data['user_id']}
' where id={$result['tender_id']}
";
M ()->execute ( presql ( $sql ) );
$sql = "update `{borrow_change}` set status={$status}
,buy_userid='{$data['user_id']}
',buy_time='".time () ."' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
if ($status == 1) 
{
$nidsql = "select  from `{}`";
$nid = M ( 'borrow_change')->field ( 'max(change_nid) as maxnid')->find ();
if ($nid ['maxnid'] == "") 
{
$today = date ( "Ym");
$data ["change_nid"] = $today ."00001";
}
else 
{
$today = date ( "Ym");
$pid = str_replace ( $today,'',$nid ['maxnid'] );
if (strlen ( $pid ) == strlen ( $nid ['maxnid'] )) 
{
$data ["change_nid"] = $today ."00001";
}
else 
{
$pid = $today .str_pad ( $pid,5,"0",STR_PAD_LEFT );
$data ["change_nid"] = $pid +1;
}
}
$account = round ( $tender_result ['recover_account_wait'] * 0.7,2 );
$log_info ["user_id"] = $result ['user_id'];
$log_info ["nid"] = "borrow_change_sell_".$result ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $account;
$log_info ["income"] = $account;
$log_info ["expend"] = 0;
$log_info ["balance"] = $account;
$log_info ["balance_cash"] = $account;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = -$tender_result ['recover_account_wait'];
$log_info ["type"] = "borrow_change_sell";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "成功出售[{$result['borrow_name']}
]债权的金额";
\accountClass::AddLog ( $log_info );
self::UpdateBorrowCount ( array ( "user_id"=>$result ['user_id'], "tender_recover_times_wait"=>-$repay_result ['no_repay_times'], "tender_recover_wait"=>-$tender_result ['recover_account_wait'] ) );
$sql = "update `{borrow_change}` set web_account={$account}
,change_nid='{$data['change_nid']}
' where id={$data['id']}
";
M ()->execute ( presql ( $sql ) );
$log_info ["user_id"] = $result ['user_id'];
$log_info ["nid"] = "borrow_change_sell_fee_".$result ['user_id'] ."_".$result ['tender_id'];
$log_info ["money"] = $change_fee;
$log_info ["income"] = 0;
$log_info ["expend"] = $change_fee;
$log_info ["balance"] = -$change_fee;
$log_info ["balance_cash"] = -$change_fee;
$log_info ["balance_frost"] = 0;
$log_info ["frost"] = 0;
$log_info ["await"] = 0;
$log_info ["type"] = "borrow_change_sell_fee";
$log_info ["to_userid"] = 0;
$log_info ["remark"] = "扣除出售[{$result['borrow_name']}
]债权的手续费";
\accountClass::AddLog ( $log_info );
$user_log ["user_id"] = $result ['user_id'];
$user_log ["code"] = "borrow";
$user_log ["type"] = "borrow_change";
$user_log ["operating"] = "borrow";
$user_log ["article_id"] = $result ['user_id'];
$user_log ["result"] = 1;
$user_log ["content"] = "成功出售[{$result['borrow_name']}
]债权的金额,[<a href=".$_G['weburl'].U('Index/index?site=debt_protocol&nid='.$data['id'])." target=_blank>点击此处</a>]查看协议书";
self::AddUsersLog ( $user_log );
$borrowuser = self::GetUsers ( array ( "user_id"=>$tender_result ['borrowuser'] ) );
$selluser = self::GetUsers ( array ( "user_id"=>$result ['user_id'] ) );
$selluserinfo=\usersClass::GetUsersInfo ( array ( "user_id"=>$result ['user_id'] ) );
$remind ['nid'] = "borrow_change_yes";
$remind ['receive_userid'] = $tender_result ['borrowuser'];
$remind ['code'] = "borrow";
$remind ['article_id'] = $tender_result ['borrow_nid'];
$remind ['title'] = "{$tender_result['name']}
债权人转移";
$remind ['content'] = "在您的借款标[{$result['borrow_name']}
]中{$selluserinfo['niname']}
所持有的债权已在".date ( "Y-m-d",time () ) ."转让给网站";
\remindClass::sendRemind ( $remind );
}
return $data ['id'];
}
public static function AddAdminLog($data) 
{
$data ["data"] = serialize ( $data ["data"] );
$data ['addtime'] = time ();
$data ['addip'] = get_client_ip ();
M ( 'users_adminlog')->add ( $data );
}
}
