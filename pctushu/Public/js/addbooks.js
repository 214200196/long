$(function(){
	$("#midselect").hide(); // 第二选择框
	$("#botselect").hide(); // 第三选择框
	var booksnames=false;
	var firstselect=false;
	// 顶级选择框选择事件
	$("#topselect").bind('change',function(){
		// 获取事件选中内容值
		var topselect = $(this).val();
		$.post('getcate',{topselect:topselect},function(data){
			if(data!=''){ 
				// 从返回json数据中获取选择框内容
				 var option = '<option>请选择分类</option>'; // 作用默认未触发事件显示该内容 
				 $.each(data, function(i, n){
					option += '<option  value="'+ n.id +'">'+ n.category_name +'</option>';
				});
				 //alert(option);
				 $("#midselect").show();
				 $("#midselect").html(option);
			}else{
				$("#midselect").hide();
				$("#botselect").hide();

			}
		},'json');

		if(isNaN(topselect)){
			$("#selectif").removeClass("glyphicon-ok-sign greencolor");
			$("#selectif").addClass("glyphicon-remove-sign");
		}else{
			$("#selectif").removeClass("glyphicon-remove-sign");
			$("#selectif").addClass("glyphicon-ok-sign greencolor");
			firstselect=true;
		}
	});

	// 第二个选择框选择事件
	$("#midselect").change(function(){
		var midselect = $(this).val();
		$.post('getcate',{topselect:midselect},function(data){
			if(data!=''){
				// 从返回json数据中获取选择框内容
				var option = '<option>请选择分类</option>';
				 $.each(data, function(i, n){
					option += '<option  value="'+ n.id +'">'+ n.category_name +'</option>';
				});
				 $("#botselect").show();
				 $("#botselect").html(option);
			}else{
				$("#botselect").hide();	
			}
		},'json')

		if(isNaN(midselect)){
			$("#selectif").removeClass("glyphicon-ok-sign greencolor");
			$("#selectif").addClass("glyphicon-remove-sign");
		}else{
			$("#selectif").removeClass("glyphicon-remove-sign");
			$("#selectif").addClass("glyphicon-ok-sign greencolor");
		}
	});

	// 第三个选择框选择事件
	$("#botselect").change(function(){
		var botselect = $(this).val();
		if(isNaN(botselect)){
			$("#selectif").removeClass("glyphicon-ok-sign greencolor");
			$("#selectif").addClass("glyphicon-remove-sign");
		}else{
			$("#selectif").removeClass("glyphicon-remove-sign");
			$("#selectif").addClass("glyphicon-ok-sign greencolor");
		}

	});

	$("#booksname").blur(function(){
		var booksname = $(this).val();
		if(booksname == ''){
			$(this).next().addClass("glyphicon-remove-sign");
			return false;
		}
		//var reg = /^[\w\u4e00-\u9fa5]{2,15}$/;
		var reg = /^[\s\S]{2,15}$/;
		if(!reg.test(booksname)){
			$(this).prev().html("必须为2-15位中文或字母或数字或下划线");
			$(this).next().addClass("glyphicon-remove-sign");
			return false;
		}
		$(this).prev().html("图书名称");
		$(this).next().removeClass("glyphicon-remove-sign");
		$(this).next().addClass("glyphicon-ok-sign greencolor");
		booksnames=true;
		return true;

	});


	// 提交表单事件
	$("#submit").click(function(){
		$("#booksname").trigger("blur"); // 自动触发事件
		$("#topselect").trigger("change"); // 自动触发事件
		if(!firstselect) return false;
		if(!booksnames){
			return false;
		}
		return true;
	});
	
});