<!doctype html>
<html>
<head>
<title>用户购买标接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
</head>
<body>
		<?php
			// 获取投资标信息
			$tenderUrl 	 	= @file_get_contents("http://120.25.122.205/czcf/home/api/borrowinfo/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361/borrow_nid/421443088692");
			$tenderResult	= json_decode($tenderUrl,true);
			// var_dump($tenderUrl);
			// 获取当前可用余额
			$moneyUrl 	 	= @file_get_contents("http://120.25.122.205/czcf/home/api/accountInfo/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361/user_id/36");
			$moneyUrlResult = json_decode($moneyUrl,true);
			//var_dump($moneyUrlResult);
		?>
	<form action="/czcf/home/api/userTender/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
		标 名 称：<?php echo $tenderResult[0]['name']; ?><br><br>
		标 号 id：<?php echo $tenderResult[0]['borrow_nid']; ?><br><br>
				  <input type="hidden" name="borrow_nid" value="<?php echo $tenderResult[0]['borrow_nid'];?>" >
		漫标还差：<?php echo $tenderResult[0]['borrow_account_wait']; ?><br><br>
				  <input type="hidden" name="waitFullMoney" value="<?php echo $tenderResult[0]['borrow_account_wait'];?>">
		可用余额：<span style="color:red;"><?php echo $moneyUrlResult['balance'];?></span><br><br>
				  <input type="hidden" name="canUseMoney" value="<?php echo $moneyUrlResult['balance'];?>">
		投资金额：<input type="text" name="tenderMoney"><br><br>
		支付密码：<input type="password" name="payPassword"><br><br>
				  <input type="hidden" name="user_id" value=36 >
		<input type="submit" value="提交">
	<form>
</body>
</html>