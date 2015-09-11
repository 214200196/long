<!DOCTYPE html>
<html>
<head>
<title>忘记密码找回接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
</head>
<body>

手 机 号：<input name= "phone"  type="text" id="phoneNumber" />
<button id = "getVerify" >获取</button><span id= "status"></span><br>
验 证 码：<input name= "verify"  type="text" id="blurVerify" /><span id="vStatus"></span><br>

<hr>
<br>


<form action ="/czcf/home/api/getPassword/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">

新 密 码：<input name= "newPwd"  type="password"/><br>
确认密码：<input name= "newPwded"  type="password"/><br>
	  <input name="user_id" value=36  type="hidden" />
<input type="submit" value="提交"/>
</form>




<script>

		
		
		// 获取验证码事件
		$("#getVerify").click(function(){
			
			var phoneNumber =$("#phoneNumber").val();
			
			 if(!isNaN(phoneNumber) && phoneNumber.length == 11){
				// 异步获取验证码
				$.post('/czcf/home/api/getPhoneVerify/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361',{phoneNumber:phoneNumber},function(data){
					$("#status").html("<i style='color:green;font-weight:bold;'>发送成功！</i>");	
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


		// 输入验证码检测事件
		$("#blurVerify").blur(function(){
			var verify = $("#blurVerify").val();
			$.post('/czcf/home/api/checkPhoneVerify/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361',{verify:verify},function(data){
				if(data['validateStatus'] == 0 ) {
					$('#vStatus').html('<i style="color:red;font-weight:blod;"> ×  验证错误 </i>');

				} else {
					$('#vStatus').html('<i style="color:green;font-weight:blod;"> √  验证正确 </i>');
				}
			},'json');
		});

 	</script>

</body>
</html>
