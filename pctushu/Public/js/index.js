$(function(){
	// 设置默认选择分类
	$("#category-select li:eq(1)").addClass("active");
	if(cid){
		$("#category-select li:eq(1)").removeClass("active");
		$("#category-select li:eq("+cid+")").addClass("active");
	}

	// 选择分类点击事件
	//$("#category-select li").click(function(){
		//$("#category-select li:eq(1)").removeClass("active");
		//$( this ).addClass("active");
		//alert(cid);
		// 获取页面刷新后刚才点击的li索引
		//var indexCate = $( this ).index();
		//alert(getlisturl);
		//alert("getlisturl/cid/"+indexCate+'"');
		// 异步点击li索引
		// $.post ("getlisturl",{indexCate:indexCate},function(data){

		// },'json');

		//$( "#category-select li:eq(" + index + ")").addClass("active");
		//alert($( "#category-select li:eq("+index+")").index());
	//});


});