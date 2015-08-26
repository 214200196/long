$(document).ready(function(){
	$(".producttwoclass_expand_top").toggle(
	  function () {
		var catid=this.id.substr(12);
		$("ul#twoclass_"+catid).hide();
		$().setBg();
	  },
	  function () {
		var catid=this.id.substr(12);
		$("ul#twoclass_"+catid).show();
		$().setBg();
	  }
	); 
}); 