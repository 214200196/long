<!DOCTYPE html>
<html>
 <head>
        <title>register接口测试</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
 </head>
 <body>
 	<form action="/czcf/home/api/register/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
 	手 机 号：<input  name="phoneNumber" type="text" id="phoneNumber"/><br>
 	密&nbsp;&nbsp;码：<input name="password" type="password"/><br>
 	确认密码：<input name="passworded" type="password"/><br>
 	昵&nbsp;&nbsp;称：<input name="niname" type="text"/><br>
 	验 证 码：<input name="verify" type="text"/><strong id="getVerifyok"></strong><a href="javascript:void(0);" id="getVerify">获取验证码</a><br>
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
			 	checkPhone = true;
				// 异步获取验证码
				$.post('/czcf/home/api/getPhoneVerify/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361',{phoneNumber:phoneNumber},function(data){
					$("#getVerifyok").html("<i style='color:green;font-weight:bold;'>发送成功！</i>");	
				},'json');
		
			} else {
				alert("请填写正确手机号码！");
				return false;
			}

			// 设置定时器
			var count = 60;
			var myCountDown;
			myCountDown = setInterval(countDown,1000);
			//alert($(this).html());exit;
			function countDown(){
				// 去掉链接和点击事件
				//$("#getVerify").removeAttr('href');
				//$('#getVerify').removeAttr('click');
				$("#getVerify").attr({ "disabled": "disabled" });
				$("#getVerify").text("请稍等 "+ count +" 秒！");
				count--;
				if(count==0){
					$("#getVerify").removeAttr("disabled");
					$("#getVerify").text("重新获取验证码");
			       clearInterval(myCountDown);
			       count = 60;

				}
			}


		});




		$("#submit").click(function(){
			// if ( ! checkPhone) {
			// 	return false;
			// } 
		});
 	</script>

 </body>
 </html>
