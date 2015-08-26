<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统管理</title>
<link rel="stylesheet" type="text/css" href="/template/admin/css/index.css" />
<script type="text/javascript" src="/statics/js/jquery.js"></script>
<script type="text/javascript" src="/statics/js/layer/layer.min.js"></script>
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0"
		cellspacing="0">
  <tr>
    <td colspan="2" height="50" valign="top"><div id="header">
        <div class="logo" style="float: left; width: 150px">
          <div class="png"> <a href="#"><img src="/template/admin/images/logo.png" /></a> </div>
        </div>
        <!--重点导航-->
        <ul class="nav" style="float: left" id="head_menu">
          <li class="home"><a href="<?php echo U('index/index');?>" style="height: 35px; display: block">管理首页</a></li>
          <?php if(is_array($_A["admin_module_top"])): foreach($_A["admin_module_top"] as $key=>$var): if($key != 'userinfo'): ?><li id="<?php echo ($key); ?>"><a style="cursor: pointer" href="#" onClick="return initguide('<?php echo ($key); ?>');" style="height:35px;display:block"><?php echo ($var["name"]); ?></a></li><?php endif; endforeach; endif; ?>
          <li id="other"><a style="cursor: pointer" href="#" onClick="return initguide('other');" style="height:35px;display:block">扩展</a></li>
        
        </ul>
        <!--头部信息导航-->
        <div id="guide"></div>
        <!--头部信息导航结束--> 
      </div></td>
  </tr>
  <tr>
    <td valign="top" id="main-fl"><div id="left" style="overflow: auto"></div>
      </div></td>
    <td valign="top" id="mainright"><iframe frameborder="0" width="100%" frameborder="0" scrolling="yes" style="overflow: visible;" id="main"> </iframe></td>
  </tr>
</table>
<script>
var admin_url = '<?php echo ($_A["admin_url"]); ?>';
var admin_username = '<?php echo ($_A["admin_result"]["adminname"]); ?>';
var admin_typename = '<?php echo ($_A["admin_result"]["name"]); ?>';

var guides = {'common' : {'common' : {
			'common_users_password' : ['密码设置',"<?php echo U('system/password');?>"],
                        'system_users_admin' : ['管理员管理',"<?php echo U('users/admin');?>"],
                        'system_users_admin_add' : ['添加管理员',"<?php echo U('users/addadmin');?>"],
                        'system_users_admin_type' : ['管理员类型',"<?php echo U('users/admintype');?>"],
                        'system_users_admin_log' : ['管理员记录',"<?php echo U('users/adminlog');?>"]
                    
		}}

		<?php echo ($_A["admin_module_left"]); ?>				
		
	,
	'other' : {'other' : {
			
			<?php echo ($_A["admin_module_other"]); ?>
			
			}
		}
}
var titles = {'common' : '首页'
	
	<?php if(is_array($_A["admin_module_all"])): foreach($_A["admin_module_all"] as $key=>$var): ?>,
'<?php echo ($key); ?>' : '<?php echo ($var["name"]); ?>'<?php endforeach; endif; ?>
,'other' : '其他功能'
	
	}
var cate   = 'common';
var type   = '';
function upleft(t){
	$("#"+t).parent().addClass('one');
}
function showleft(id,t,url){
	cate = id;
	var html = '';
	var guide = guides[id];
	url = typeof url != 'undefined' ? url : '';
	type = typeof t != 'undefined' ? t : '';
	for(i in guide){
		var subs = guide[i];
		html += '<h1>' + titles[i] + '</h1><div class="cc"></div><ul>';
		for(j in subs){
			var sub = subs[j];
			html += '<li><a id="'+j+'" href="#" onclick="return initguide(\''+id +'\',\''+j+'\')">'+sub[0]+'</a></li>';
			if(url==''){
				if(type == ''){
					url = sub[1];
					type = j;
				} else if(j == type){
					url = sub[1];
				}
				action = i;
			}
		}
		html += '</ul>';
		$("#left").html(html);
		upleft(type);
	    $("#main").attr("src",url);
		$("#main").load(function(){
var mainheight = $(this).contents().find("body").height()+400;
$(this).height(mainheight);
});
		return false;
	}
}
function showtitle(){
	var html = '';
	
	html += '<ul class="fr"><li class="home">欢迎您：<span style="color:#ec6454">'+admin_username+'('+admin_typename+')</span></li><li><a href="<?php echo U("admin/index/logout");?>'+'">退出</a></li><li><a href="/index.php" target="_blank">网站首页</a></li><li><a href="<?php echo U("system/clearcache");?>" >清空缓存</a></li></ul>';
	
	$("#guide").html(html);
}
 
function initguide(id,t,url){
	
	showleft(id,t,url);
	showtitle();
	return false;
}



initguide(cate,type,"<?php echo U('index/main');?>");
</script>
</body>
</html>