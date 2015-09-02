<!DOCTYPE html>
<html>
 <head>
        <title>register接口测试</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
 </head>
 <body>
 	<form action="/czcf/home/api/register/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
 	手机号：<input  name="username" type="text" id="phoneNumber"/><br>
 	邮箱：<input name="email" type="text"/><br>
 	密码：<input name="password" type="password"/><br>
 	昵称：<input name="niname" type="text"/><br>
 	验证码:<input name="verify" type="text"/><a href="javascript:void(0);" id="getVerify">获取验证码</a><br>
 	<input type="submit" value="提交" id="submit"/>	
 	</form>

 	<script>
 		var checkPhone = false;
		$("#getVerify").click(function(){
			var phoneNumber = $("#phoneNumber").val();
			if(phoneNumber == '') {
				alert("请填写手机号码接收验证码！");
				return false;
			}
			if(!isNaN(phoneNumber) && phoneNumber.length == 11){
				// 异步获取验证码
				$.post('/czcf/home/api/getPhoneVerify/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361',{phoneNumber:phoneNumber},function(data){

				},'json');

				checkPhone = true;
			} else {
				alert("请填写正确手机号码！");
				return false;
			}
		});

		$("#submit").click(function(){
			return false;
			if( checkPhone ) {
				return true;
			}
		});
 	</script>

 </body>
 </html>