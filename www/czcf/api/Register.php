<!DOCTYPE html>
<html>
 <head>
        <title>register接口测试</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 </head>
 <body>
 	<form action="/czcf/home/api/register/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
 	手机号：<input name="username" type="text"/><br>
 	邮箱：<input name="email" type="text"/><br>
 	密码：<input name="password" type="password"/><br>
 	昵称：<input name="niname" type="text"/><br>
 	验证码:<input name="verify" type="text"/><a href="/czcf/api/register.php">获取验证码</a><br>
 	<input type="submit" value="提交"/>	
 	</form>
 </body>
 </html>