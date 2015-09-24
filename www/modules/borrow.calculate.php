
<?php
function EqualInterest($data = array()) 
{
	if (IsExiest ( $data ["account"] ) == "") return "equal_account_empty";
	if (IsExiest ( $data ["period"] ) == "") return "equal_period_empty";
	if (IsExiest ( $data ["apr"] ) == "") return "equal_apr_empty";
	if (isset ( $data ['time'] ) &&$data ['time'] >0) 
	{
		$data ['time'] = $data ['time'];
	}
	else 
	{
		$data ['time'] = time ();
	}
	$borrow_style = $data ['style'];
	if ($borrow_style == 0) 
	{
		return EqualMonth ( $data );
	}
	elseif ($borrow_style == 1) 
	{
		return EqualSeason ( $data );
	}
	elseif ($borrow_style == 2) 
	{
		return EqualDayEnd ( $data );
	}
	elseif ($borrow_style == 3) 
	{
		return EqualEndMonth ( $data );
	}
	elseif ($borrow_style == 4) 
	{
		return EqualDeng ( $data );
	}
	elseif ($borrow_style == 5) 
	{
		return EqualTiyan ( $data );
	}
}
function EqualMonth($data = array()) 
{
	$account = $data ['account'];
	$year_apr = $data ['apr'];
	$period = $data ['period'];
	$time = $data ['time'];
	$month_apr = $year_apr / (12 * 100);
	$_li = pow ( (1 +$month_apr),$period );
	if ($account <0) return;
	$repay_account = round ( $account * ($month_apr * $_li) / ($_li -1),2 );
	$_result = array ();
	$_capital_all = 0;
	$_interest_all = 0;
	$_account_all = 0.00;
	for($i = 0;$i <$period;$i ++) 
	{
		if ($i == 0) 
		{
			$interest = round ( $account * $month_apr,2 );
		}
		else 
		{
			$_lu = pow ( (1 +$month_apr),$i );
			$interest = round ( ($account * $month_apr -$repay_account) * $_lu +$repay_account,2 );
		}
		if ($i == $period -1) 
		{
			$capital = $account -$_capital_all;
			$interest = $repay_account -$capital;
		}
		else 
		{
			$capital = $repay_account -$interest;
		}
		$_account_all += $repay_account;
		$_interest_all += $interest;
		$_capital_all += $capital;
		$_result [$i] ['account_all'] = round ( $repay_account,2 );
		$_result [$i] ['account_interest'] = round ( $interest,2 );
		$_result [$i] ['account_capital'] = round ( $capital,2 );
		$_result [$i] ['account_other'] = round ( $repay_account * $period -$repay_account * ($i +1),2 );
		$_result [$i] ['repay_month'] = round ( $repay_account,2 );
		$_result [$i] ['repay_time'] = get_times ( array ( "time"=>$time, "num"=>$i +1 ) );
	}
	if ($data ["type"] == "all") 
	{
		$_result_all ['account_total'] = round ( $_account_all,2 );
		$_result_all ['interest_total'] = round ( $_interest_all,2 );
		$_result_all ['capital_total'] = round ( $_capital_all,2 );
		$_result_all ['repay_month'] = round ( $repay_account,2 );
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	return $_result;
}
function EqualSeason($data = array()) 
{
	if (isset ( $data ['period'] ) &&$data ['period'] >0) 
	{
		$period = $data ['period'];
	}
	if ($period %3 != 0) 
	{
		return false;
	}
	if (isset ( $data ['account'] ) &&$data ['account'] >0) 
	{
		$account = $data ['account'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['apr'] ) &&$data ['apr'] >0) 
	{
		$year_apr = $data ['apr'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['borrow_time'] ) &&$data ['borrow_time'] >0) 
	{
		$borrow_time = $data ['borrow_time'];
	}
	else 
	{
		$borrow_time = time ();
	}
	$month_apr = $year_apr / (12 * 100);
	$_season = $period / 3;
	$_season_money = round ( $account / $_season,2 );
	$_yes_account = 0;
	$repay_account = 0;
	$_capital_all = 0;
	$_interest_all = 0;
	$_account_all = 0.00;
	for($i = 0;$i <$period;$i ++) 
	{
		$repay = $account -$_yes_account;
		$interest = round ( $repay * $month_apr,2 );
		$repay_account = $repay_account +$interest;
		$capital = 0;
		if ($i %3 == 2) 
		{
			$capital = $_season_money;
			$_yes_account = $_yes_account +$capital;
			$repay = $account -$_yes_account;
			$repay_account = $repay_account +$capital;
		}
		$_repay_account = $interest +$capital;
		$_result [$i] ['account_interest'] = round ( $interest,2 );
		$_result [$i] ['account_capital'] = round ( $capital,2 );
		$_result [$i] ['account_all'] = round ( $_repay_account,2 );
		$_account_all += $_repay_account;
		$_interest_all += $interest;
		$_capital_all += $capital;
		$_result [$i] ['account_other'] = round ( $repay,2 );
		$_result [$i] ['repay_month'] = round ( $repay_account,2 );
		$_result [$i] ['repay_time'] = get_times ( array ( "time"=>$time, "num"=>$i +1 ) );
	}
	if ($data ["type"] == "all") 
	{
		$_result_all ['account_total'] = round ( $_account_all,2 );
		$_result_all ['interest_total'] = round ( $_interest_all,2 );
		$_result_all ['capital_total'] = round ( $_capital_all,2 );
		$_result_all ['repay_month'] = "-";
		$_result_all ['repay_season'] = $_season_money;
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	return $_result;
}
function EqualDayEnd($data = array()) 
{
	if (isset ( $data ['period'] ) &&$data ['period'] >0) 
	{
		$period = $data ['period'];
		if ($period == 0.03) 
		{
			$period = 1;
		}
		else if ($period == 0.06) 
		{
			$period = 2;
		}
		else if ($period == 0.10) 
		{
			$period = 3;
		}
		else if ($period == 0.13) 
		{
			$period = 4;
		}
		else if ($period == 0.16) 
		{
			$period = 5;
		}
		else if ($period == 0.20) 
		{
			$period = 6;
		}
		else if ($period == 0.23) 
		{
			$period = 7;
		}
		else if ($period == 0.26) 
		{
			$period = 8;
		}
		else if ($period == 0.30) 
		{
			$period = 9;
		}
		else if ($period == 0.33) 
		{
			$period = 10;
		}
		else if ($period == 0.36) 
		{
			$period = 11;
		}
		else if ($period == 0.40) 
		{
			$period = 12;
		}
		else if ($period == 0.43) 
		{
			$period = 13;
		}
		else if ($period == 0.46) 
		{
			$period = 14;
		}
		else if ($period == 0.50) 
		{
			$period = 15;
		}
		else if ($period == 0.53) 
		{
			$period = 16;
		}
		else if ($period == 0.56) 
		{
			$period = 17;
		}
		else if ($period == 0.60) 
		{
			$period = 18;
		}
		else if ($period == 0.63) 
		{
			$period = 19;
		}
		else if ($period == 0.66) 
		{
			$period = 20;
		}
		else if ($period == 0.70) 
		{
			$period = 21;
		}
		else if ($period == 0.73) 
		{
			$period = 22;
		}
		else if ($period == 0.76) 
		{
			$period = 23;
		}
		else if ($period == 0.80) 
		{
			$period = 24;
		}
		else if ($period == 0.83) 
		{
			$period = 25;
		}
		else if ($period == 0.86) 
		{
			$period = 26;
		}
		else if ($period == 0.90) 
		{
			$period = 27;
		}
		else if ($period == 0.93) 
		{
			$period = 28;
		}
		else if ($period == 0.96) 
		{
			$period = 29;
		}
		else 
		{
			$period = $period * 30;
		}
	}
	if (isset ( $data ['account'] ) &&$data ['account'] >0) 
	{
		$account = $data ['account'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['apr'] ) &&$data ['apr'] >0) 
	{
		$year_apr = $data ['apr'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['time'] ) &&$data ['time'] >0) 
	{
		$borrow_time = $data ['time'];
	}
	else 
	{
		$borrow_time = time ();
	}
	$month_apr = $year_apr / (12 * 100);
	$day_apr = $month_apr / 30;
	$interest = $day_apr * $period * $account;
	if (isset ( $data ['type'] ) &&$data ['type'] == "all") 
	{
		$_result_all ['account_total'] = round ( $account +$interest,2 );
		$_result_all ['interest_total'] = round ( $interest,2 );
		$_result_all ['capital_total'] = round ( $account,2 );
		$_result_all ['repay_month'] = round ( $account +$interest,2 );
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	else 
	{
		$_result [0] ['account_all'] = round ( $interest +$account,2 );
		$_result [0] ['account_interest'] = round ( $interest,2 );
		$_result [0] ['account_capital'] = round ( $account,2 );
		$_result [0] ['account_other'] = round ( $account,2 );
		$_result [0] ['repay_month'] = round ( $interest +$account,2 );
		$_result [0] ['repay_time'] = strtotime ( "+".$period ." day");
		return $_result;
	}
}
function EqualEnd($data = array()) 
{
	if (isset ( $data ['period'] ) &&$data ['period'] >0) 
	{
		$period = $data ['period'];
	}
	if (isset ( $data ['account'] ) &&$data ['account'] >0) 
	{
		$account = $data ['account'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['apr'] ) &&$data ['apr'] >0) 
	{
		$year_apr = $data ['apr'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['time'] ) &&$data ['time'] >0) 
	{
		$borrow_time = $data ['time'];
	}
	else 
	{
		$borrow_time = time ();
	}
	$month_apr = $year_apr / (12 * 100);
	$interest = $month_apr * $period * $account;
	if (isset ( $data ['type'] ) &&$data ['type'] == "all") 
	{
		$_result_all ['account_total'] = round ( $account +$interest,2 );
		$_result_all ['interest_total'] = round ( $interest,2 );
		$_result_all ['capital_total'] = round ( $account,2 );
		$_result_all ['repay_month'] = round ( $account +$interest,2 );
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	else 
	{
		$_result [0] ['account_all'] = round ( $interest +$account,2 );
		$_result [0] ['account_interest'] = round ( $interest,2 );
		$_result [0] ['account_capital'] = round ( $account,2 );
		$_result [0] ['account_other'] = round ( $account,2 );
		$_result [0] ['repay_month'] = round ( $interest +$account,2 );
		$_result [0] ['repay_time'] = get_times ( array ( "time"=>$borrow_time, "num"=>$period ) );
		return $_result;
	}
}
function EqualEndMonth($data = array()) 
{
	if (isset ( $data ['period'] ) &&$data ['period'] >0) 
	{
		$period = $data ['period'];
	}
	if (isset ( $data ['account'] ) &&$data ['account'] >0) 
	{
		$account = $data ['account'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['apr'] ) &&$data ['apr'] >0) 
	{
		$year_apr = $data ['apr'];
	}
	else 
	{
		return "";
	}
	if (isset ( $data ['time'] ) &&$data ['time'] >0) 
	{
		$borrow_time = $data ['time'];
	}
	else 
	{
		$borrow_time = time ();
	}
	$month_apr = $year_apr / (12 * 100);
	$_yes_account = 0;
	$repayment_account = 0;
	$interest = round ( $account * $month_apr,2 );
	for($i = 0;$i <$period;$i ++) 
	{
		$capital = 0;
		if ($i +1 == $period) 
		{
			$capital = $account;
		}
		$_account_all += $_repay_account;
		$_interest_all += $interest;
		$_capital_all += $capital;
		$_result [$i] ['account_all'] = $interest +$capital;
		$_result [$i] ['account_interest'] = $interest;
		$_result [$i] ['account_capital'] = $capital;
		$_result [$i] ['account_other'] = round ( $account +$interest * $period -$interest * $i -$interest,2 );
		$_result [$i] ['repay_year'] = $account;
		$_result [$i] ['repay_time'] = get_times ( array ( "time"=>$borrow_time, "num"=>$i +1 ) );
	}
	if ($data ["type"] == "all") 
	{
		$_result_all ['account_total'] = $account +$interest * $period;
		$_result_all ['interest_total'] = $_interest_all;
		$_result_all ['capital_total'] = $account;
		$_result_all ['repay_month'] = $interest;
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	return $_result;
}
function EqualDeng($data = array()) 
{
	$account = $data ['account'];
	$year_apr = $data ['apr'];
	$period = $data ['period'];
	$time = $data ['time'];
	$month_apr = $year_apr / (12 * 100);
	$_li = pow ( (1 +$month_apr),$period );
	if ($account <0) return;
	$repay_account = round ( $account * ($month_apr * $_li) / ($_li -1),2 );
	$_result = array ();
	$_capital_all = 0;
	$_interest_all = 0;
	$_account_all = 0.00;
	for($i = 0;$i <$period;$i ++) 
	{
		$interest = round ( $account * $month_apr,2 );
		$capital = round ( $account / $period,2 );
		$repay_account = $interest +$capital;
		$_account_all += $repay_account;
		$_interest_all += $interest;
		$_capital_all += $capital;
		$_result [$i] ['account_all'] = $repay_account;
		$_result [$i] ['account_interest'] = $interest;
		$_result [$i] ['account_capital'] = $capital;
		$_result [$i] ['account_other'] = round ( $repay_account * $period -$repay_account * ($i +1),2 );
		$_result [$i] ['repay_month'] = round ( $repay_account,2 );
		$_result [$i] ['repay_time'] = get_times ( array ( "time"=>$time, "num"=>$i +1 ) );
	}
	if ($data ["type"] == "all") 
	{
		$_result_all ['account_total'] = round ( $_account_all,2 );
		$_result_all ['interest_total'] = round ( $_interest_all,2 );
		$_result_all ['capital_total'] = round ( $_capital_all,2 );
		$_result_all ['repay_month'] = round ( $repay_account,2 );
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	return $_result;
}
function EqualTiyan($data = array()) 
{
	$account = 100;
	$year_apr = 20;
	$period = 1;
	$time = $data ['time'];
	$_result = array ();
	$_capital_all = 0;
	$_interest_all = 0;
	$_account_all = 0.00;
	$interest = 2;
	$capital = 100;
	$repay_account = 102;
	$_account_all = $repay_account;
	$_interest_all = $interest;
	$_capital_all = $capital;
	$_result [0] ['account_all'] = $repay_account;
	$_result [0] ['account_interest'] = $interest;
	$_result [0] ['account_capital'] = $capital;
	$_result [0] ['account_other'] = 102;
	$_result [0] ['repay_month'] = 102;
	$_result [0] ['repay_time'] = get_times ( array ( "time"=>$time, "num"=>$i +1 ) );
	if ($data ["type"] == "all") 
	{
		$_result_all ['account_total'] = 102;
		$_result_all ['interest_total'] = 2;
		$_result_all ['capital_total'] = 100;
		$_result_all ['repay_month'] = 102;
		$_result_all ['month_apr'] = round ( $month_apr * 100,2 );
		return $_result_all;
	}
	return $_result;
}
