<!DOCTYPE html>
<html>
<head>
<title>线下充值接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
</head>
<body>
<form action ="/czcf/home/api/lineRecharge/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
	  汇款银行账号信息：<?php 
	  						$url = @file_get_contents('http://120.25.122.205/czcf/home/api/paymentInfo/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361');
	  						$jsonMatches = array();  
    						preg_match('#\{.+?\}#', $url, $jsonMatches);  
	  						$result =  json_decode($jsonMatches[0],True);
	  						print_r($result);
	  						//echo $result['description']; 
	  					?><br>
&nbsp;&nbsp;&nbsp;已汇款金额：<input type="text" name="rechargeMoney" id="rechargeMoney" /><br>
&nbsp;&nbsp;&nbsp;&nbsp;充值奖励：<span id="rward">0</span>元<br>
&nbsp;&nbsp;&nbsp;&nbsp;实际到账：<span id="total">0</span>元<br>
&nbsp;&nbsp;汇款流水单号：<input type="text" name="rechargeCode" /><br>
						  <input type="hidden" name="user_id" value=42 />
<input type="submit" value="提交"/>
</form>
	<script>
		$("#rechargeMoney").keyup(function(){
			var rechargeMoney = $('#rechargeMoney').val();
			if ( rechargeMoney>0 && !isNaN(rechargeMoney) && rechargeMoney < 99999999 ) {
				var rward = Math.round(rechargeMoney*10/1000*3)/10;
				$('#rward').text(rward);
				$('#rward').css({'color':'red','font-weight':'bold'});
				var total = rechargeMoney*1 + rward*1;
				$('#total').text(total);
				$('#total').css('color','blue');
			}
		});

	</script>
</body>
</html>
