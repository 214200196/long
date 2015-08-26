
//读取参数列

(function($){
	$.fn.getPropList = function(){
	
		$("div#proplist").empty();
		
		var catid=$("#selcatid")[0].value;
		var nowid=$("#nowid")[0].value;
		
		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=proplist&catid="+catid+"&nowid="+nowid,
			success: function(msg){
				$("div#proplist").append(msg);
				$().setBg();
			}
		});
	};
})(jQuery);


//选择分类时更新属性列
$(document).ready(function() {
		
		$("#selcatid").change(function(){
			$().getPropList();
		});


});

//图片预览
$(document).ready(function(){

	$('.preview').click(function(id){

		var src=$("input#previewsrc_"+this.id.substr(8))[0].value;
		if(src==""){
			return false;
		}

		$("body").append("<img id='pre' src='"+src+"'>");
		var w=$("#pre")[0].offsetWidth;
		var h=$("#pre")[0].offsetHeight;
		
		$.blockUI({  
            message: "<img  src='"+src+"' class='closeit'>",  
            css: {  
                top:  ($(window).height() - h) /2 + 'px', 
                left: ($(window).width() - w/2) /2 + 'px', 
                width: $("#pre")[0].offsetWidth + 'px',
				backgroundColor: '#fff',
				borderWidth:'3px',
				borderColor:'#fff'
            }  
        }); 

		$("#pre").remove();
        
		$(".closeit").click(function(){
			$.unblockUI(); 
		}); 

        setTimeout($.unblockUI, 2000); 

	}); 
}); 



//图片发布表单提交
$(document).ready(function(){
	$('#photofabu').submit(function(){ 
		SelectAll('spe_selec[]', 'select[]');
		$('#photofabu').ajaxSubmit({
			target: 'div#notice',
			url: 'post.php',
			success: function(msg) {
				if(msg=="OK"){
					$('div#notice').hide();
					$().alertwindow("图片发布成功","photo_gl.php");
				}else{
					$('div#notice')[0].className='noticediv';
					$('div#notice').show();
					$().setBg();
				}
			}
		}); 
       return false; 

   }); 
});




//图片修改表单提交
$(document).ready(function(){
	
	$('#photoModify').submit(function(){ 

		if($("#photopagesid")[0].value=="0"){
			
			//正常提交修改
			$("#act")[0].value="photomodify";
			SelectAll('spe_selec[]', 'select[]');

			$('#photoModify').ajaxSubmit({
				target: 'div#notice',
				url: 'post.php',
				success: function(msg) {
					if(msg=="OK"){
						$('div#notice').hide();
						$().alertwindow("图片修改成功","photo_gl.php");
						
					}else{
						$('div#notice')[0].className='noticediv';
						$('div#notice').show();
						$().setBg();
					}
				}
			}); 
		
		}else{
			
			//组图更新
			$("#act")[0].value="contentmodify";

			$('#photoModify').ajaxSubmit({
				target: 'div#notice',
				url: 'post.php',
				success: function(msg) {
					if(msg=="OK"){
						$('div#notice').hide();
						var nowpagesid=$("input#photopagesid")[0].value;
						$().getContent(nowpagesid);
					}else{
						$('div#notice').hide();
						$().alertwindow(msg,"");
					}
				}
			}); 
		
		}
		

       return false; 

   }); 
});




//读取内容翻页码
(function($){
	$.fn.getPhotoPages = function(p){
		
		$("div#photopages").empty();
		
		var nowid=$("#nowid")[0].value;

		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=photopageslist&nowid="+nowid+"&pageinit="+p,
			success: function(msg){
				$("div#photopages").append(msg);
				
				var nowpagesid=$("input#photopagesid")[0].value;
				$("li#p_"+nowpagesid)[0].className='now';

				var getObj = $('li.pages');
				getObj.each(function(id) {
					var obj = this.id;
					
					$("li#"+obj).click(function() {
						
						var clickid=obj.substr(2);
						
						if(clickid==0){
							$(".photomodizone").show();
							$(".savebutton").hide();
							$().getContent(0);
							$().getPhotoPages(0);
						}else{
							$(".photomodizone").hide();
							$(".savebutton").show();
							$().getContent(clickid);
							$().getPhotoPages(clickid);
						}
					});
				});

				//返回正常模式
				$("li#backtomodi").click(function() {

					$(".photomodizone").show();
					$(".savebutton").hide();
					$().getContent(0);
					$().getPhotoPages(0);

				});
				
				//添加分页
				$("li#addpage").click(function(){

					$.ajax({
						type: "POST",
						url:"post.php",
						data: "act=addpage&nowid="+nowid,
						success: function(msg){
							if(msg=="OK"){
								$().getPhotoPages('new');
								$(".photomodizone").hide();
								$(".savebutton").show();
								$().getContent(-1);
							}else{
								$().alertwindow(msg,"");
							}
						}
					});
				});

				//删除当前页
				$("li#pagedelete").click(function(){


					var delpagesid=$("input#photopagesid")[0].value;
					
					$.ajax({
						type: "POST",
						url:"post.php",
						data: "act=pagedelete&nowid="+nowid+"&delpagesid="+delpagesid,
						success: function(msg){
							if(msg=="NORIGHTS"){
								$().alertwindow("无权操作","");
							}else if(msg=="0"){
								//分页全部删除时返回正常模式
								$(".photomodizone").show();
								$(".savebutton").hide();
								$().getContent(0);
								$().getPhotoPages(0);
							}else{
								$(".photomodizone").hide();
								$(".savebutton").show();
								$().getContent(msg);
								$().getPhotoPages(msg);
							}
							
						}
					});
				});
			}
		});
	};

	
	

})(jQuery);




//读取组图
(function($){
	$.fn.getContent = function(photopageid){
		
		var nowid=$("#nowid")[0].value;
		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=getimg&photopageid="+photopageid+"&nowid="+nowid,
			success: function(msg){
				
				if(msg!=""){
					$("#picpriview").hide();
					$("#picpriview")[0].src="../../"+msg;
					$("#picpriview")[0].style.width="";
					$("#picpriview").load(function(){
						$("#picpriview").show();
						if($("#picpriview")[0].offsetWidth>500){
							$("#picpriview")[0].style.width="500px";
						}
						$().setBg();
					});
					
					
				}else{
					$("#picpriview").hide();
					$().setBg();
				}
			}
		});
	};
})(jQuery);


//添加分类
$(document).ready(function(){

	$('#addphotocat').click(function(){ 
		var newcat=$("#newcat")[0].value;
		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=addcat&newcat="+newcat,
			success: function(msg){

				if(msg=="0"){
					$().alertwindow("您的会员帐号没有自定义分类的权限","");
				}else{
					$("#photomycat").append(msg);
					$().setBg();
				}				


				$('.cat_modify').click(function(){ 
					var catid=this.id.substr(5);
					var cat=$("#cat_"+catid)[0].value;
					var xuhao=$("#catxuhao_"+catid)[0].value;
					$.ajax({
						type: "POST",
						url:"post.php",
						data: "act=modicat&catid="+catid+"&cat="+cat+"&xuhao="+xuhao,
						success: function(msg){
							if(msg=="OK"){
								self.location.reload();
							}else{
								alert(msg);
							}
						}
					});
			   }); 

				$('.cat_del').click(function(){ 
					var catid=this.id.substr(5);
					$.ajax({
						type: "POST",
						url:"post.php",
						data: "act=delcat&catid="+catid,
						success: function(msg){
							if(msg=="OK"){
								$("#tr_"+catid).remove();
								$().setBg();
							}else{
								alert(msg);
							}
						}
					});
			   }); 


			}
		});
   }); 

});


//修改分类
$(document).ready(function(){

	$('.cat_modify').click(function(){ 
		var catid=this.id.substr(5);
		var cat=$("#cat_"+catid)[0].value;
		var xuhao=$("#catxuhao_"+catid)[0].value;
		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=modicat&catid="+catid+"&cat="+cat+"&xuhao="+xuhao,
			success: function(msg){
				if(msg=="OK"){
					self.location.reload();
				}else{
					alert(msg);
				}
			}
		});
   }); 

});


//删除分类
$(document).ready(function(){

	$('.cat_del').click(function(){ 
		var catid=this.id.substr(5);
		$.ajax({
			type: "POST",
			url:"post.php",
			data: "act=delcat&catid="+catid,
			success: function(msg){
				if(msg=="OK"){
					$("#tr_"+catid).remove();
					$().setBg();
				}else{
					alert(msg);
				}
			}
		});
   }); 

});