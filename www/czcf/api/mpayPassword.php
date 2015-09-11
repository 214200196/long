<!DOCTYPE html>
<html>
<head>
<title>支付密码修改测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<form action ="/czcf/home/api/mpayPassword/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
原 密 码：<input name = "oldPayPwd" type="password"/>(若未设置支付密码则输入登入密码验证)<br>

新 密 码：<input name= "newPayPwd"  type="password"/><br>

确认密码：<input name= "newPayPwded"  type="password"/><br>
	  <input name="user_id" value=36  type="hidden" />
<input type="submit" value="提交"/>
</form>
</body>
</html>
