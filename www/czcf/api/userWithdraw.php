<!DOCTYPE html>
<html>
<head>
<title>用户提现接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
</head>
<body>
	<?php

		// 调用接口获取支行名称及银行和银行卡号
		$userbankinfo = @file_get_contents("http://120.25.122.205/czcf/home/api/getbankinfo/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361/user_id/36");
		$userbankinfoResult = json_decode($userbankinfo,true);
		//var_dump($userbankinfoResult);
		echo "<br>";
		// 调用接口获取银行列表
		$bankinfo = @file_get_contents("http://120.25.122.205/czcf/home/api/bankList/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361");
		$bankinfoResult = json_decode($bankinfo,true);
		//var_dump($bankinfoResult);

		// 通过该用户银行id获得该银行名称
		$bankid = $userbankinfoResult['bank'] - 1;
		//echo $bankid;
		$bankName = $bankinfoResult[$bankid]['name'];
		//echo $bankName;

	?>
	<form action="/czcf/home/api/userWithdraw/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
		&nbsp;可用余额：<br><br>
		&nbsp;提现金额：<input name="withdrawMoney" type="text">（提现手续费0.3% 100元上限）<br><br>
	  持卡人姓名：<input name="realname" type="text" disabled="disabled" value="123"><br><br>
	  开户支行名：<input type="text" disabled="disabled" value="<?php echo $bankName.$userbankinfoResult['branch'];?>"><br><br>
	  			  <input name="devBank" type="hidden" value="<?php echo $bankName.$userbankinfoResult['branch'];?>">
  &nbsp;银行卡号：<input type="text" disabled="disabled" value="<?php echo $userbankinfoResult['account'];?>"><br><br>
	  			  <input name="bankNumber" type="hidden" value="<?php echo $userbankinfoResult['account'];?>">
	  			  <input name="user_id" type="hidden" value=36 >
	  <hr>
	  &nbsp;支付密码：<input name="payPassword" type="password"><br><br>
	  <input type="submit" value="提交">
	</form>




</body>
</html>
