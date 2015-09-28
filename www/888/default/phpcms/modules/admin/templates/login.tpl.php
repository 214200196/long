<?php defined('IN_ADMIN') or exit('No permission resources.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>智导互联-网站后台管理系统</title>
<style>
*{ padding:0; margin:0; list-style:none;}
body{ font-family:"宋体"; font-size:14px; background:#bfd2e7; color:#fff;}
.box{ margin:0 auto; width:983px;}

.box_nr{ margin:0 auto; background:url(<?php echo IMG_PATH?>admin_img/xmbt_02.jpg); height:248px; width:983px;}
.box_nr .bdbox{ padding-left:425px; padding-top:90px;}

</style>
<script language="JavaScript">

<!--

	if(top!=self)

	if(self!=top) top.location=self.location;

//-->

</script>
</head>

<body onload="javascript:document.myform.username.focus();">
<div class="box"><img src="<?php echo IMG_PATH?>admin_img/xmbt_01.jpg" width="983" height="264" /></div>
<div class="box_nr">
  <div class="bdbox">
    <form action="index.php?m=admin&c=index&a=login&dosubmit=1" method="post" name="myform">
      <table width="290" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="64" height="35" align="right" valign="middle">用户名：<br />
              <br /></td>
          <td height="35" colspan="2" align="left" valign="top"><label>
            <input type="text" name="username" style="background:url(<?php echo IMG_PATH?>admin_img/xmbt_05.jpg); background-repeat:no-repeat; width:182px; border:#4ab714 solid 1px;height:21px; line-height:21px; padding-left:6px;" />
          </label></td>
        </tr>
        <tr>
          <td height="35" align="right" valign="middle">密码：</td>
          <td height="35" colspan="2" align="left" valign="top"><input type="password" name="password" style="background:url(<?php echo IMG_PATH?>admin_img/xmbt_05.jpg); background-repeat:no-repeat; width:182px; border:#4ab714 solid 1px;height:21px; line-height:21px;  padding-left:6px;"  /></td>
        </tr>
        <tr>
          <td height="35" align="right" valign="middle">验证码：</td>
          <td height="35" align="left" valign="top"><input type="text" name="code"  style="background:url(<?php echo IMG_PATH?>admin_img/xmbt_11.jpg); background-repeat:no-repeat; width:65px; border:#4ab714 solid 1px;height:21px; line-height:21px;  padding-left:6px;" /></td>
          <td height="35" align="left" valign="top"><?php echo form::checkcode('code_img')?></td>
        </tr>
        <tr>
          <td align="right" valign="middle">&nbsp;</td>
          <td width="88" height="45" align="left" valign="bottom"><label>
            <input type="image" name="imageField" src="<?php echo IMG_PATH?>admin_img/log.jpg" />
          </label></td>
          <td width="138" align="right" valign="bottom"><a href="http://www.xmbt21.com" target="_blank"><img src="<?php echo IMG_PATH?>admin_img/xmbt_07.jpg" width="75" height="20" border="0" /></a>&nbsp;<a href="http://wpa.qq.com/msgrd?V=1&amp;Uin=1551543846&amp;Site=在线咨询" target="_blank"><img src="<?php echo IMG_PATH?>admin_img/xmbt_09.jpg" width="50" height="20" border="0" /></a></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<div class="box"><img src="<?php echo IMG_PATH?>admin_img/xmbt_03.jpg" width="983" height="388" /></div>
</body>
</html>