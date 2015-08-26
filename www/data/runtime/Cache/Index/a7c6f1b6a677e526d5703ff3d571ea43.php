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

<div class="clearfix con_box">
	<div class="mi_content">
		<div class="mi_c_left">
			<dl class="vipcenter_left">
				<dt>
					<a href="#">管理中心</a>
				</dt>
				<dd>
					<a href="<?php echo U('Users/index');?>"<?php if(ACTION_NAME == 'index'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?> >帐号管理</a>
				</dd>
				<dd>
					<a href="<?php echo U('Account/logs');?>"<?php if((ACTION_NAME == 'logs') OR (ACTION_NAME == 'recharge_new') OR (ACTION_NAME == 'cash_new')): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?> >资金情况</a>
				</dd>
				<dd>
					<a href="<?php echo U('approve/myapp');?>"<?php if(ACTION_NAME == 'myapp'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?> >认证中心</a>
				</dd>
				<dd>
					<a href="<?php echo U('Attestations/index');?>">资料审核</a>
				</dd>
				<dd>
					<a href="<?php echo U('approve/recommend');?>"<?php if(ACTION_NAME == 'recommend'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?> >推荐申请</a>
				</dd>
				<dd>
					<a href="<?php echo U('Message/index');?>"<?php if(MODULE_NAME == 'Message'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?> >站内信(<?php echo ((isset($_G["message_result"]["message_no"]) && ($_G["message_result"]["message_no"] !== ""))?($_G["message_result"]["message_no"]):'0'); ?>)</a>
				</dd>
				<dt>
					<a href="#">投资管理</a>
				</dt>
				<dd>
					<a href="<?php echo U('borrow/gettender');?>"<?php if(ACTION_NAME == 'gettender'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>我的投标</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/care');?>"<?php if(ACTION_NAME == 'care'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>我关注的标</a>
				</dd>
				<dd>
					<a href="<?php echo U('account/tender_count');?>"<?php if(ACTION_NAME == 'tender_count'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>投资统计</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/debting');?>"<?php if((ACTION_NAME == 'debting') OR (ACTION_NAME == 'debt_move') OR (ACTION_NAME == 'move_success') OR (ACTION_NAME == 'buy_success')): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>债权转让与购买</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/auto');?>"<?php if(ACTION_NAME == 'auto'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>自动投标</a>
				</dd>
				<dt>
					<a href="#">借款管理</a>
				</dt>
				<dd>
					<a href="<?php echo U('borrow/amount');?>"<?php if((ACTION_NAME == 'amount') OR (ACTION_NAME == 'amount_list') OR (ACTION_NAME == 'amount_log')): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>信用额度</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/publish');?>"<?php if(ACTION_NAME == 'publish'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>发布的借款</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/repayment');?>"<?php if(ACTION_NAME == 'repayment'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>偿还中的借款</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/repaymentyes');?>"<?php if(ACTION_NAME == 'repaymentyes'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>已还清的借款</a>
				</dd>
				<dd>
					<a href="<?php echo U('borrow/repaylog');?>"<?php if(ACTION_NAME == 'repaylog'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>借款统计</a>
				</dd>
				<dt>
					<a href="#">基本信息</a>
				</dt>
				<dd>
					<a href="<?php echo U('rating/basic');?>"<?php if(ACTION_NAME == 'basic'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>资料修改</a>
				</dd>
				<dd>
					<a href="<?php echo U('users/avatar');?>"<?php if(ACTION_NAME == 'avatar'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>更改头像</a>
				</dd>
				<dd>
					<a href="<?php echo U('users/userpwd');?>"<?php if(ACTION_NAME == 'userpwd'): ?>style="color:#e36d55;font-weight:bold"<?php endif; ?>>密码重设</a>
				</dd>
				<dd>
					<a href="<?php echo U('users/reginvite');?>"<?php if(ACTION_NAME == 'reginvite'): ?>{style="color:#e36d55;font-weight:bold"<?php endif; ?>>邀请管理</a>
				</dd>
			</dl>
		</div>
		<div class="user_right"><div>
      <div class="m_change"> 
     
        <ul>
          <li><a href="<?php echo U('Approve/email_status');?>" <?php if(ACTION_NAME == 'email_status'): ?>class="onn"<?php endif; ?>>邮箱认证</a></li>
          <!--流转标 2-->
          <li><a href="<?php echo U('Approve/flow_status');?>"  <?php if(ACTION_NAME == 'flow_status'): ?>class="onn"<?php endif; ?>>流转认证</a></li>
        </ul>
       </div>
      <div class="us_r_bor1"> 
        
        <?php if(ACTION_NAME == 'email_status'): ?><!--邮箱认证 开始--> 
        <?php if(($_G["user_info"]["email_status"]) == "1"): ?><div class="user_main_title1">您的邮箱已经通过认证：<b><?php echo ($_G["user_result"]["email"]); ?></b> </div>
        <div class="user_right_border">
          <div class="c">
            <form action="" method="post" onsubmit="this.elements['submit'].disabled='disabled';return true;">
              重设邮箱：
              <input type="text" name="email" value="<?php echo ($_G["user_result"]["email"]); ?>" />
              <input type="submit" class="xinbuton"  name="submit" value="重新激活"  />
            </form>
          </div>
        </div>
        <?php else: ?>
        <div class="user_main_title1">您的邮箱还没通过认证：<b><?php echo ($_U["user_result"]["email"]); ?></b></div>
        <div class="user_right_border">
          <div class="c">
            <form action="" method="post" onsubmit="this.elements['submit'].disabled='disabled';return true;">
              重设邮箱：
              <input type="text" name="email" value="<?php echo ($_G["user_result"]["email"]); ?>" />
              <input  class="xinbuton"  type="submit" name="submit" value="重新激活"  />
            </form>
          </div>
        </div><?php endif; ?>
        
        <!--邮箱认证 结束--> 
        
      
        <?php elseif(ACTION_NAME == 'flow_status'): ?>
        <!--流转标 2--> 
      
        <!--流转认证 开始--> 
        <?php if(($_U["flow_result"]["status"]) == "1"): ?><div class="user_help">您已经通过了流转认证</div>
        <?php else: ?>
        <div class="user_help"> <?php if($_U['flow_result']['id'] > 0): ?>您的流转认证已经提交，客服人员会及时的跟你联系。</font>。<?php else: ?>欢迎进行流转认证。
          <div class="user_right_border">
            <div class="c">
              <form action="" method="post">
                如果你需要流转认证，请点按钮提交。
                <input type="submit" class="xinbuton" value="提交申请" name="submit" />
              </form>
            </div>
          </div><?php endif; endif; ?></div>
       
        <!--流转认证 结束--><?php endif; ?> </div>
    </div>
 </div>
	</div>
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