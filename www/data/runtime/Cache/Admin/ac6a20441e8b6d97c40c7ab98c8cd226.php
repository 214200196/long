<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理系统</title>
<meta http-equiv="expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="stylesheet" type="text/css"
				href="/template/admin/admin.css" />
<script type="text/javascript" src="/statics/js/jquery.js"></script>
<script type="text/javascript" src="/statics/js/layer/layer.min.js"></script>
<script type="text/javascript" src="/statics/js/laydate/laydate.js"></script>
<script src="/plugins/ueditor1.4.3/ueditor.config.js" type="text/javascript"></script>
<script src="/plugins/ueditor1.4.3/ueditor.all.min.js" 	type="text/javascript"></script>

  <script type="text/ecmascript">

function tipsWindown(title,url,w,h){
	var top=$(window.parent.document).scrollTop()+'px';
	 $.layer({
        type: 2,
        title: [title,'background:#ff7978;'],
        maxmin: true,
        shadeClose: true, //开启点击遮罩关闭层
        area : [w , h],
        offset : [top, ''],
        iframe: {src: url}
    });
}
</script>
</head>

<body>
<div class="tt">
<div class="admin_module">

<div class="module_add">
	<div class="module_title">
		<strong>系统信息</strong>
	</div>
	<div class="module_border" style="text-align: center;">
		<br /> <strong><?php echo ($_A["showmsg"]["msg"]); ?></strong> <br />
		<br />

		<div class="module_border" style="text-align: center" id="msg_content">
			<a href="<?php echo ($_A["showmsg"]["url"]); ?>"><?php echo ($_A["showmsg"]["content"]); ?></a><br />
			<br />
		</div>
	</div>
</div>
<script> 
var url = '<?php echo ($_A["showmsg"]["url"]); ?>';
var content = '<?php echo ($_A["showmsg"]["content"]); ?>';

if (url == ""){
	document.getElementById('msg_content').innerHTML = "<a href='javascript:history.go(-1)'>"+content+"</a>";
}else{
	document.getElementById('msg_content').innerHTML = "<a href='"+url+"'>"+content+"</a>";
}
var time = setInterval("testTime()",5000); 
function testTime() { 
		if (url == ""){
			history.go(-1);
		}else{
        location.href = url; //#设定跳转的链接地址
		}
	clearInterval(time);
} 

</script>
</div>
</div>
</body>
</html>