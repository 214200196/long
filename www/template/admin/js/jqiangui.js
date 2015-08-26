

 function show(getid,getTag,addclass)
		{
		      	var Omenu=document.getElementById(getid);
				var Oli_num=Omenu.getElementsByTagName(getTag);
				//alert(Oli_num.length)
				for(var i=0;i<=Oli_num.length;i++)
				{
					 Oli_num[i].onclick=function(){
					 	for(var i=0;i<=Oli_num.length;i++){
					 		Oli_num[i].className='';
					 		this.className=addclass;
					 	}
						
					}
				}
		 }
		      show("head_menu","li",'active');

