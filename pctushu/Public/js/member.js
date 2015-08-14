$(function(){
	$(".nav-pills li:eq(0)").addClass("active");

	if(menue){
		$(".nav-pills li:eq(0)").removeClass("active");
		$(".nav-pills li:eq("+menue+")").addClass("active");
		//alert(menue);
	}

});