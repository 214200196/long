<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登陆</title>
<link href="/template/admin/css/css.css" rel="stylesheet"
	type="text/css" />
</head>

<body>
	<div class="top">
		<div class="top_logo">
			<div class="logo"></div>
		</div>
	</div>
	<div class="menu">
		<div class="login">
			<div class="txt">
				<form id="form1" name="form1" method="post"
					action="<?php echo U('admin/index/login');?>" onsubmit="return check_login();">

					<div>
						<label>用户名：</label> <input class="userStyle" name="username" type="text" size="20" maxlength="20" tabindex="1" />
					</div>
					<div>
						<label>密 &nbsp;&nbsp;码：</label> <input name="password" type="password" size="21" maxlength="20" tabindex="2"
							class="userStyle" />
					</div>
					<div class="box_yanz">
						<label>验证码：</label> <input class="userStyle" name="valicode" type="text" size="11" maxlength="4" tabindex="3" /> &nbsp;<img src="<?php echo U('admin/index/verify');?>" alt="点击刷新" onClick="this.src='<?php echo U('Index/verify','','');?>/'+ Math.random()" id="valicode" align="absmiddle" style="cursor: pointer" />
					</div>
					<div>
						<a class="mar_top" href="#"> <input type="image"
							src="/template/admin/images/anniu.gif"></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>