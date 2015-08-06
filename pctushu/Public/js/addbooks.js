$(function(){
	$("#topselect").bind('change',function(){
		var topselect = $(this).val();
		$.post('getcate',{topselect:topselect},function(){},'json');
	});
	
});