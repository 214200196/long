$(document).ready(function(){
	$("#sub").click(function(){
		$("form").submit()
	});
	$("#reg").click(function(){window.location.href='/index.php?user&q=reg'});
	$("#valchange").click(function(){$("#valicode").click()});
	$("ul.subnav").parent().append("<span></span>"); 
	$("ul.topnav li.topli").mouseover(function() {
		$(this).find("div").show(); 
		$(this).find("ul").show(); 
		$(this).hover(function() {
			
		}, function(){	
			$(this).find("div").hide();
			$(this).find("ul").hide();
		});		
	}).hover(function() { 
		$(this).addClass("on1"); //On hover over, add class "subhover"
	}, function(){	//On Hover Out
		$(this).removeClass("on1"); //On hover out, remove class "subhover"
	});

	$(".main_menu li").mouseover(function(){
		$(".child_menu div").each(function(){$(this).css("display","none");});			
		var x=$(this).attr("id");
		$("."+x).css("display","block");
	});
	
	$(".mcr_xuanxiangka li").mouseover(function(){
		$(".cont .did").each(function(){$(this).css("display","none");});			
		var x=$(this).attr("id");
		$("."+x).css("display","block");
	}).hover(function() {
		$(".mcr_xuanxiangka li").removeClass("onn");		
		$(this).addClass("onn"); //On hover over, add class "subhover"
	});
	
	if(parseInt($("#borrow_period").val())== 0){
		$("#borrow_style").val(2);
		//$("#borrow_style").attr("disabled","true");
	}
	
	$("#borrow_period").change(function(){
	var s_value = $("#borrow_period").val();
	s_value = parseInt(s_value);	
	if(s_value == 0){
		$("#borrow_style option[value='2']").remove();
		$("#borrow_style").append("<option value='2'>按天到期还本还息</option>");  
		$("#borrow_style").val(2);
		//$("#borrow_style").attr("disabled","true");
		$("#rel_borrow_style").val(2);
	}
	else{
		//$("#borrow_style").attr("disabled",false);
		$("#borrow_style option[value='2']").remove();
		$("#borrow_style").append("<option value='2'>到期还本还息</option>");  
		//$("#borrow_style").val(2);
		$("#rel_borrow_style").val(0);
	}
		
	});
	
	$("#borrow_style").change(function(){
		$("#rel_borrow_style").val($("#borrow_style").val());
		
	});
});

// 兼容IE FF的ByName方法
var getElementsByName = function(tag, name){
    var returns = document.getElementsByName(name);
    if(returns.length > 0) return returns;
    returns = new Array();
    var e = document.getElementsByTagName(tag);
    for(var i = 0; i < e.length; i++){
        if(e[i].getAttribute("name") == name){
            returns[returns.length] = e[i];
        }
    }
    return returns;
}
//alert(getElementsByName("div","odiv").length); // IE:4 FF:4

$(document).ready(function(){
	if(getElementsByName("span","endtime")){
		var objAll=getElementsByName("span","endtime");
		for(var i=0;i<objAll.length;i++){
			RemainTime(i,objAll[i].innerHTML);
		}
	}
	//单行应用@Mr.Think
			var _wrap=$('#ad_title');//定义滚动区域
			var _interval=2000;//定义滚动间隙时间
			var _moving;//需要清除的动画
			_wrap.hover(function(){
			clearInterval(_moving);//当鼠标在滚动区域中时，停止滚动
			},function(){
			_moving=setInterval(function(){
			var _field=_wrap.find('a:first');//此变量不可放置于函数起始处，li:first取值是变化的
			var _h=_field.height();//取得每次滚动高度
			_field.animate({marginTop:-_h+'px'},600,function(){//通过取负margin值，隐藏第一行
			_field.css('marginTop',0).appendTo(_wrap);//隐藏后，将该行的margin值置零，并插入到最后，实现无缝滚动
			})
			},_interval)//滚动间隔时间取决于_interval
			}).trigger('mouseleave');//函数载入时，模拟执行mouseleave，即自动滚动
});
function RemainTime(obj,iTime){
	var iDay,iHour,iMinute,iSecond;
	var sDay="",sTime="";
    if (iTime >= 0){
        iDay = parseInt(iTime/24/3600);
        iHour = parseInt((iTime/3600)%24);
        iMinute = parseInt((iTime/60)%60);
        iSecond = parseInt(iTime%60);

		if (iDay > 0){ 
			sDay = iDay + "天"; 
		}
		sTime =sDay + iHour + "时" + iMinute + "分" + iSecond + "秒";
	  
		if(iTime==0){
			clearTimeout(Account);
			sTime="<span style='color:green'>时间到了！</span>";
		}else{
			sTime=""+sTime;
			Account = setTimeout(function(){ RemainTime(obj,iTime)},1000);
		}
		iTime=iTime-1;
    }else{
		sTime="<span style='color:red'>此标已过期！</span>";
    }
	getElementsByName("span","endtime")[obj].innerHTML = sTime;
}

