<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(empty($$_G["articles"]["name"])): else: echo ($_G["articles"]["name"]); ?>|<?php endif; ?> <?php if(empty($$_G["articles"]["name"])): else: ?> <?php echo ($_G["articles_result"]["name"]); ?> |<?php endif; echo ($_G["system"]["con_webname"]); ?></title>
<meta name="description" content="<?php echo ($_G["system"]["con_description"]); ?>" />
<meta name="keywords" content="<?php if(empty($$_G["articles"]["tags"])): else: ?>
	<?php echo ($_G["articles"]["tags"]); endif; ?>
	<?php if(empty($$_G["site_result"]["keywords"])): else: ?> <?php echo ($_G["site_result"]["keywords"]); endif; ?>
	<?php echo ($_G["system"]["con_keywords"]); ?>" /> <script type="text/javascript"
		src="/statics/js/jquery.js"></script>
	<script type="text/javascript" src="/statics/js/layer/layer.min.js"></script>

	<link href="<?php echo ($tpldir); ?>css/css.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/user.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/new.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/shop.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/myinfo.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/tipswindown.css" rel="stylesheet"
		type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/common.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo ($tpldir); ?>longbao/style.css"
		type="text/css" media="screen, projection" />
	<link href="<?php echo ($tpldir); ?>css/usergetpwd.css" rel="stylesheet"
		type="text/css" />
	<script src="<?php echo ($tpldir); ?>js/user.js" type="text/javascript"></script>
	<script src="<?php echo ($tpldir); ?>js/tb.js" type="text/javascript"></script>
	<script src="<?php echo ($tpldir); ?>js/tipswindown.js" type="text/javascript"></script>
	<script src="<?php echo ($tpldir); ?>js/sub.js" type="text/javascript"></script>
	<script src="<?php echo ($tpldir); ?>js/lhgdialog.min.js" type="text/javascript"></script>
	<script src="<?php echo ($tpldir); ?>js/base.js" type="text/javascript"></script>
	<script type="text/javascript" src="/statics/js/laydate/laydate.js"></script>
	<link href="<?php echo ($tpldir); ?>css/new.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/userreg.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ($tpldir); ?>css/userlogin.css" rel="stylesheet" type="text/css" />
 <script>
function JqueryAjaxs(url){
var api = $.dialog({id:'L360'});

$.ajax({

    url:url,
    success:function(data){
        api.content(data);

    }

});

}
</script>
</head>

<body>

	<div class="container">

	<div class="header clearfix">
  <div class="top" style="height:35px;">
    <div class="box980">
      <div style="left:370px;position:relative;">
        <dl id="qh_box" >
        <dt>在线客服</dt>
        <?php $kefu=explode("|",$_G['system']['con_qqkf']); ?>
        <?php if(is_array($kefu)): foreach($kefu as $key=>$var): ?><dd> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($var); ?>&site=qq&menu=yes"> <img border="0" src="<?php echo ($tpldir); ?>/images/qq_log_list.jpg?p=2:<?php echo ($var); ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息" /> </a> </dd><?php endforeach; endif; ?>
      </dl>
        <dl id="qh_box1" style="margin-left:100px">
        <dt>官方群号</dt>
        <?php $qqun=explode("|",$_G['system']['con_qqgroup']); ?>
        <?php if(is_array($qqun)): foreach($qqun as $key=>$var): ?><dd><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=<?php echo ($var); ?>"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" ></a></dd><?php endforeach; endif; ?>
      </dl>
      </div>
      <a href="<?php echo U('Index/index?site=toollixi');?>"><img src="<?php echo ($tpldir); ?>/longbao/images/jsq.jpg" width="8" height="11" /> 利息计算器</a>
         <?php if($_G["user_id"] == ''): ?><a href="<?php echo U('index/reg');?>">注册</a> <a href="<?php echo U('index/login');?>">登录</a> 
        <?php else: ?>
        <a href="<?php echo U('index/logout');?>">退出</a> <a href="<?php echo U('Message/index');?>">站内信(<?php echo ((isset($_G["message_result"]["message_no"]) && ($_G["message_result"]["message_no"] !== ""))?($_G["message_result"]["message_no"]):0); ?>)</a> <a href="<?php echo U('users/index');?>">您好，<?php echo ($_G["user_result"]["username"]); ?></a><?php endif; ?><span class="tel">客服热线：<strong><?php echo ($_G["system"]["con_contact"]); ?> </strong></span>
      <div class="look_us" style="color: #fff;height:35px; left: 175px; line-height: 35px; position: relative; top: -35px;width: 200px;">关注我们： <a href="<?php echo ($_G["system"]["con_weibourl"]); ?>" target="_blank" id="wei_bo" > 微博</a> <a href="javascript:();" id="weix">微信</a> <img src="/statics/images/erweima.png" style=" margin-left:40px;*margin-left:-30px !important;position: absolute;top: 40px;z-index: 9999;display:none;width:130px;height:130px" id="erweima"/> </div>
    </div>
  </div>
  <div class="head">
    <div class="box980">
      <div class="logo" style="margin-top:20px"><a href="/"><img src="<?php echo ($_G["system"]["con_weburl"]); echo ($_G["system"]["con_logo"]); ?>" class="logo_pic" alt="<?php echo ($_G["system"]["con_webname"]); ?>" /></a></div>
      <div class="nav">
        <ul>
          <li id="cm1"><a href="/"  <?php if(($_G.site_result.pid == 1) OR ($_G['site_result']['id'] == 1)): ?>class="on"<?php endif; ?>>首页</a></li>
          <li id="cm2"><a href="<?php echo U('Index/index?site=invest');?>" <?php if(($_G.site_result.pid == 12) OR ($_G['site_result']['id'] == 12)): ?>class="on"<?php endif; ?>>我要投资</a></li>
          <li  id="cm3"><a href="<?php echo U('Index/index?site=borrow');?>" <?php if(($_G.site_result.pid == 20) OR ($_G['site_result']['id'] == 20)): ?>class="on"<?php endif; ?>>我要借款</a></li>
          <li id="cm4"><a href="<?php echo U('Users/index');?>" <?php if(CONTROLLER_NAME == 'Users'): ?>class="on"<?php endif; ?>>我的账户</a></li>
         
          <li id="cm5"><a href="<?php echo U('Index/index?site=help');?>">帮助中心</a></li>
         
          
        </ul>
      </div>
    </div>
   
    <script type="text/javascript">
                                $(document).ready(function () {
                                    $(".nav li").mouseover(function () {
                                        $(".nav-list div").css("display", "none");
                                        var x = $(this).attr("id");
                                        $("." + x).css("display", "block");
                                    });

                                    var _curclassname = "cm1";
                                    $(".nav-list div").each(function () {
                                        if ($(this).css("display") == "block") {
                                            _curclassname = $(this).attr("class");
                                        }
                                    });


                                });
								 
									 
										function kefu(id)
										{
											var Oqh_box=document.getElementById(id);

											Oqh_box.onmouseover=function()
											{
												Oqh_box.style.height='auto';
											}
											Oqh_box.onmouseout=function()
											{
												Oqh_box.style.height='30px';
											}
										}
										kefu('qh_box');
										kefu('qh_box1');
										
										var weixin=document.getElementById('weix');
										var erweima=document.getElementById('erweima');
										weixin.onmouseover=function()
										{
											erweima.style.display='block';
										}
										weixin.onmouseout=function()
										{
											erweima.style.display='none';
										}
									 	
                            </script>
  </div>
</div>

<div class="bodyer clearfix">
	<?php if($_REQUEST['type']== 'email'): ?><div class="regist clearfix  box1000">

		<dl class="reg">
			<dt>
				<img src="<?php echo ($tpldir); ?>new/images/login_04.jpg"
					style="margin-left: 40px" />
			</dt>
			<dt>
				<div
					style="padding: 40px; padding-bottom: 0px; margin-left: 6px; padding-left: 0px; padding-top: 0px;">
					<div
						style="line-height: 40px; padding: 25px; padding-bottom: 20px; padding-left: 0px; width: 964px;">
						<div style="width: 675px; margin: 20px auto;">
							<div style="color: #ff7978; line-height: 28px; font-size: 14px"><?php echo ($_G["user_result"]["email"]); ?>将收到一封认证邮件，登录您的邮箱查收，并点击邮件中的链接，完成激活。激活成功后，
								可以使用站内所有功能，再次感谢你的加入。【<?php echo ($_G["system"]["con_webname"]); ?>系统】</div>
							<div style="text-align: center; margin-top: 15px;">
								<a href="<?php echo ($_U["emailurl"]); ?>" target="_blank" style="background: #fb776e; color: #fff; display: block; height: 30px; line-height: 30px; margin: 0 auto; width: 120px;">登录邮箱激活</a>
							</div>

							<div style="margin-top: 25px; font-size: 14px">
								如果20分钟内没有收到激活邮件，请查看你信箱的垃圾邮箱，依然没有收到请重新发送。【<?php echo ($_G["system"]["con_webname"]); ?>系统】<br />
								<input type="text" name="email" id="email"
									value="<?php echo ($_G["user_result"]["email"]); ?>" readonly="readonly"
									style="width: 250px; border: #BFBFBF solid 1px; height: 30px; background: none; text-indent: 10px" />
								<input type="button" name="submit" value="重新发送"
									onClick="sendemail()" class="xinbuton"
									style="background: #2cace7; border: none; color: #fff; font-family: '微乳雅黑'; font-size: 12px; height: 30px; width: 70px;" />


								<script>

function sendemail(){
  var newemail=$("#email").val();
  $.get("<?php echo U('index/reg?type=sendemail');?>",{checkemail:newemail},function(result){
		alert(result);
  });
}
</script>

							</div>

							<div style="margin-top: 15px; font-size: 14px">
								等待激活时间，您还可以去这里看看：<a href="<?php echo U('invest/index?nid=invest');?>"
									style="color: #025ED0; font-size: 14px; text-decoration: underline"
									target="_blank">我要投资</a> <a href="<?php echo U('borrow/index');?>"
									style="color: #025ED0; font-size: 14px; text-decoration: underline"
									target="_blank">我要借款</a> <a href="<?php echo U('users/index');?>"
									style="color: #025ED0; font-size: 14px; text-decoration: underline"
									target="_blank">用户中心</a>
							</div>
						</div>
					</div>

				</div>
			</dt>
		</dl>

	</div>
	<?php else: ?>
	<form action="" method="post" id="reg_form_h" name="reg_form_h"
		onsubmit="return check_reg();">


		<div class="reg_box">
			<div id="reg_title"></div>
			<p class="go-login">
				已有账号？<a href="<?php echo U('Index/login');?>" style="color: #058bcb">立即登录</a>
			</p>
			<div class="control_group mb10">
				<label class="control_label"> <em>*</em>邮箱账号
				</label>
				<div class="controls">
					<input type="text" placeholder="请输入邮箱"
						onblur="checkEmail(this.value,'<?php echo U('index/reg');?>');" name="email"
						id="email" class="inputBox" value=""> <span class="wrong"><em
						id="email_notice">邮件地址不能为空</em></span>
				</div>
			</div>
			<div class="control_group mb10">
				<label class="control_label"> <em>*</em>用户账号
				</label>
				<div class="controls">
					<input type="text" id="username" name="username"
						onblur="checkUsername(this.value,'<?php echo U('index/reg');?>');" placeholder="请输入用户名" value="" class="inputBox"> <span class="wrong"><em id="username_notice">请输入3-15位字符</em></span>
				</div>
			</div>
             <div class="control_group mb10">
				<label class="control_label"><em>*</em>用户昵称</label>
				<div class="controls">
				 <input type="text" id="niname" name="niname"  onblur="checkNiname(this.value,'<?php echo U('index/reg');?>');" placeholder="请输入昵称" value="" class="inputBox">
								  <span class="wrong"><em id="niname_notice">请输入1-15位字符</em></span>
								</div>
							</div>
			<div class="control_group mb10">
				<label class="control_label"> <em>*</em>登录密码
				</label>
				<div class="controls">
					<input type="password" placeholder="请输入密码" code="ie_psw1" name="password" onblur="checkPassword(this.value);" class="password_first inputBox password_new" id="password">
					<span class="wrong"><em id="password_notice">密码不能少于6个由数字与字母组成的字符</em></span>

				</div>
			</div>
			<div class="control_group mb10">
				<label class="control_label"> <em>*</em>重复密码
				</label>
				<div class="controls">
					<input type="password" placeholder="确认密码" code="ie_psw1" class="password_again inputBox password_new" name='confirm_password' id='conform_password' onblur="checkConformPassword(this.value);"> <span class="wrong"><em id="conform_password_notice">密码不能少于6个由数字与字母组成的字符</em></span>
				</div>
			</div>
			<div class="control_group mb10 yanzhen">
				<label class="control_label"> <em></em>推荐码
				</label>
				<div class="controls">
					&nbsp;<input type="text" class="inputBox" style="padding-left: 10px;" name='invite_usercode' id='invite_usercode' value="<?php echo ($_REQUEST['reginvite_code']); ?>">

				</div>
			</div>
			<div class="control_group mb10 yanzhen">

				<label class="control_label"> <em>*</em>验证码 </label>

				<div class="controls">
					<input type="text" placeholder="请输入验证码" class="inputBox mini" name="valicode"> &nbsp; &nbsp;<em class=user_action_error><img src="<?php echo U('index/verify');?>" id="valicode" alt="点击刷新" onClick="this.src='<?php echo U('index/verify','','');?>/'+ Math.random();" align="absmiddle" style="cursor: pointer; width: 100px; height: 40px;" />点击验证码刷新</em>
				</div>

			</div>
			<div class="control_group mb10 xieyi">
				<label class="control_label"></label>
				<div class="controls">
					<input name="tiaoli" checked="checked" type="checkbox">
					我已阅读并同意 <a href="<?php echo U('Index/index?site=hetong&id=5');?>"
						class="registerArticle">《隐私条款》</a>

				</div>
			</div>
			<div class="control_group mb10">
				<label class="control_label"></label>
				<div class="controls">
					<button class="btn_large btn" id="submit" type="submit">立即注册</button>
					<input name="invite_user_id" type="hidden"
						value="<?php echo ($reginvite_user_id); ?>" />
				</div>
			</div>
		</div>


	</form>

	 <script>

function check_reg(obj){
var reg_err=userReg();
if(reg_err==true){
	 var frm = document.forms['reg_form_h'];
     var valicode = frm.elements['valicode'].value;
	 if (valicode.length == 4 ) {
	 return true;
	 }else{
		  alert("请输入4位数验证码!");
		   return false;
	 }
 }else{
	 alert("请输入正确的信息进行注册!");
	return false;
	 
 }
}
</script> <?php endif; ?>
</div>
<div class="footer">
  <div class="footer_con">
    <div class="footer_top">
    <div style="float: left;width:233px;_display: inline;">
     <div class="footer_logo" style="width:100%;_display: inline;"><img src="<?php echo ($tpldir); ?>images/footlogo.png"/></div>
     <div class="footer_top_kefu" style="width:233px;_display: inline;margin-right:0px">
        <ul>
          <li>客服电话 (服务时间 9:00-21:00)</li>
          <li><strong><?php echo ($_G["system"]["con_contact"]); ?></strong></li>
        </ul>
      </div>
    </div>

    <div style="float: left;width:760px;_display: inline;">
      <div class="footer_top_dl">
       
						<dl>
							<dt><a href="javascript:()">关于我们</a></dt>
							<dd><a href="<?php echo U('Index/index?site=gsjj');?>">公司介绍</a></dd>
					        <dd><a href="<?php echo U('Index/index?site=zxns');?>">公司执照</a></dd>
							<dd><a href="<?php echo U('Index/index?site=contact');?>">联系我们</a></dd>
						</dl>
       <dl>
							<dt><a href="javascript:()">新手上路</a></dt>
							<dd><a href="<?php echo U('Index/index?site=invest');?>">如何投资</a></dd>
							<dd><a href="<?php echo U('account/recharge_new');?>">充值问题</a></dd>
							<dd><a href="<?php echo U('account/logs');?>">资金管理</a></dd>
						</dl>
       <dl>
							<dt><a href="javascript:()">安全保障</a></dt>
							<dd><a href="<?php echo U('Index/index?site=fxgk');?>">风险管控</a></dd>
							<dd><a href="<?php echo U('Index/index?site=hetong&id=4');?>">服务协议</a></dd>
							<dd><a href="<?php echo U('Index/index?site=hetong&id=5');?>">隐私条款</a></dd>
						</dl>
        <dl>
          <dt><a href="javascript:()">金融服务</a></dt>
         <dd><a href="<?php echo U('account/tender_count');?>">投资统计</a></dd>
							<dd><a href="<?php echo U('approve/myapp');?>">认证管理</a></dd>
							<dd><a href="<?php echo U('Index/index?site=fees');?>">资费说明</a></dd>
        </dl>
      </div>
      
      <div class="footer_top_kefu1"> <img src="<?php echo ($tpldir); ?>longbao/images/weixin.jpg" width="117 "/> </div>
      </div>
      <div class="copyright_main"> <span>地址：<?php echo ($_G["system"]["con_compAddress"]); ?>;<?php echo ($_G["system"]["con_recordInfo"]); ?>;<?php echo ($_G["system"]["con_beian"]); echo (htmlspecialchars_decode($_G["system"]["con_tongji"])); ?></span> </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--footer部分结束--> 
</body></html>