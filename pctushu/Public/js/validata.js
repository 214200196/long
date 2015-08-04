$(function(){
	$("#yanzhengma").click(function(){
		//alert(verifyurl+'/'+Math.random());
		$( this ).attr("src",verifyurl+'/'+Math.random());
	});
	var msg="";
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
	});

	
});