$(function(){
	$("#yanzhengma").click(function(){
		//alert(verifyurl+'/'+Math.random());
		$( this ).attr("src",verifyurl+'/'+Math.random());
	});
	var msg="";
	var is_email=false;
	var is_pwd=false;
	var is_pwded=false;
	var is_username=false;
	var is_verify=false;

	$("#email").blur(function(){
		var email = $(this).val();
		// 获取父标签的上一个标签
		var label=$(this).parent().prev();
		if(email==''){
			msg="邮箱不能为空";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!reg.test(email)){
			msg="邮箱填写格式错误";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}
		$.post("asynemail",{email:email},function(status){
			if(!status){
				msg="该邮箱已注册";
				label.html(msg);
				label.parent().removeClass("has-success");
				$(this).parent().next().removeClass("glyphicon-ok");
				label.parent().addClass("has-error");
				$(this).parent().next().addClass("glyphicon-remove");
				return false;
			}
		},"json");
		// 初始化之前错误样式
		label.html("");
		label.parent().removeClass("has-error");
		$(this).parent().next().removeClass("glyphicon-remove");
		label.parent().addClass("has-success");
		$(this).parent().next().addClass("glyphicon-ok");
		is_email=true;
	});
	
	$("#pwd").blur(function(){
		var pwd = $(this).val();
		var label=$(this).parent().prev();
		if(pwd==''){
			msg="密码不能为空";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}
		var reg = /^[\w]{6,15}$/;
		if(!reg.test(pwd)){
			msg="密码长度6-15位(A-Za-z0-9)";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}

		label.html("");
		label.parent().removeClass("has-error");
		$(this).parent().next().removeClass("glyphicon-remove");
		label.parent().addClass("has-success");
		$(this).parent().next().addClass("glyphicon-ok");
		is_pwd=true;


	});

	$("#pwded").blur(function(){
		var pwded = $(this).val();
		var label = $(this).parent().prev();
		if(pwded == ''){
			msg="重复密码不能为空";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}
		var pwd = $("#pwd").val();		
		if(pwded != pwd){
			msg="两次密码不一致";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}

		label.html("");
		label.parent().removeClass("has-error");
		$(this).parent().next().removeClass("glyphicon-remove");
		label.parent().addClass("has-success");
		$(this).parent().next().addClass("glyphicon-ok");
		is_pwded=true;
	});


	$("#username").blur(function(){
		var username=$(this).val();
		var label=$(this).parent().prev();
		if(username==''){
			msg="用户名不能为空";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}

		var reg = /^[\w\u4e00-\u9fa5]{2,12}$/;
		if(!reg.test(username)){
			msg="昵称长度2-12位(A-Za-z0-9或下划线或中文)";
			label.html(msg);
			label.parent().addClass("has-error");
			$(this).parent().next().addClass("glyphicon-remove");
			return false;
		}

		label.html("");
		label.parent().removeClass("has-error");
		$(this).parent().next().removeClass("glyphicon-remove");
		label.parent().addClass("has-success");
		$(this).parent().next().addClass("glyphicon-ok");
		is_username=true;

	});


	$("#verify").blur(function(){
		var verify=$(this).val();
		var label=$(this).parent().prev();
		if(verify==''){
				label.parent().addClass("has-error");
				$(this).parent().next().addClass("glyphicon-remove");
				return false;
		}

		label.parent().removeClass("has-error");
		$(this).parent().next().removeClass("glyphicon-remove");

		$.post('asynverify',{verify:verify},function(status){
			if(!status){
				label.parent().addClass("has-error");
				$("#verifyok").addClass("glyphicon-remove");
				$("#yanzhengma").attr("src",verifyurl+'/'+Math.random());
				return false; 
			}else{
				//label.html("");
				label.parent().addClass("has-success");
				$("#verifyok").addClass("glyphicon-ok");
				is_verify=true;
			}
		},"json");

		//alert(a);
		//label.parent().addClass("has-error");
		//$(this).parent().next().addClass("glyphicon-remove");	
	});


	$("#submit").click(function(){
		$("#email").trigger("blur"); // 自动触发事件
		$("#pwd").trigger("blur"); // 自动触发事件
		$("#pwded").trigger("blur"); // 自动触发事件
		$("#username").trigger("blur"); // 自动触发事件
		if($("#verify").val()=='')$("#verify").trigger("blur");
		//$("#verify").trigger("blur"); // 自动触发事件
		if(is_email&&is_username&&is_pwd&&is_pwded&&is_verify){
			return true;
		}else{
			return false;
		}
	});

	
});