$(function(){

	$("#yanzhengmas").click(function(){
		//alert(verifyurl+'/'+Math.random());
		$( this ).attr("src",verifyurl+'/'+Math.random());
	});


	var msg="";
	var is_email=false;
	var is_pwd=false;
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
				$("#yanzhengmas").attr("src",verifyurl+'/'+Math.random());
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
		if($("#verify").val()=='')$("#verify").trigger("blur");
		if(is_email&&is_pwd&&is_verify){
			return true;
		}else{
			return false;
		}
	});

	
});