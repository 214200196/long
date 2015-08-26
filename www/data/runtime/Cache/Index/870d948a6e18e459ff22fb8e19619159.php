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
		<?php if((ACTION_NAME == 'recharge') OR (ACTION_NAME == 'cash') OR (ACTION_NAME == 'recharge_new')): ?><ul>
			<li><a href="<?php echo U('account/logs');?>" <?php if(ACTION_NAME == 'logs'): ?>class="onn"<?php endif; ?> >资金明细</a></li>
			<li><a href="<?php echo U('account/recharge');?>" <?php if(ACTION_NAME == 'recharge'): ?>class="onn"<?php endif; ?> >充值记录</a></li>
			<li><a href="<?php echo U('account/cash');?>" <?php if(ACTION_NAME == 'cash'): ?>class="onn"<?php endif; ?> >提现记录</a></li>
		</ul>
		<?php elseif((ACTION_NAME == 'logs') OR (ACTION_NAME == 'cash_new') OR (ACTION_NAME == 'tender_count') OR (ACTION_NAME == 'banks')): ?>
		<ul>
			<li><a href="<?php echo U('account/tender_count');?>" <?php if(ACTION_NAME == 'tender_count'): ?>class="onn"<?php endif; ?> >投资统计</a></li>
			<li><a href="<?php echo U('account/recharge_new');?>" <?php if(ACTION_NAME == 'recharge_new'): ?>class="onn"<?php endif; ?> >充值</a></li>
			<li><a href="<?php echo U('account/cash_new');?>" <?php if(ACTION_NAME == 'cash_new'): ?>class="onn"<?php endif; ?> >提现</a></li>
			<li><a href="<?php echo U('account/banks');?>" <?php if(ACTION_NAME == 'banks'): ?>class="onn"<?php endif; ?> >银行账号</a></li>
			<li><a href="<?php echo U('account/logs');?>" <?php if(ACTION_NAME == 'logs'): ?>class="onn"<?php endif; ?> >资金记录</a></li>
		</ul><?php endif; ?>
	</div>
	<div class="us_r_bor1">
		<?php if(ACTION_NAME == 'logs'): ?><div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit1">
					<td>资产总额</td>
					<td>可用余额</td>
					<td>冻结资金</td>
					<td>待收金额</td>
				</tr>
				<tr>
					<td>￥<?php echo ((isset($accout["total"]) && ($accout["total"] !== ""))?($accout["total"]):0.00); ?></td>
					<td>￥<?php echo ((isset($accout["balance"]) && ($accout["balance"] !== ""))?($accout["balance"]):0.00); ?></td>
					<td>￥<?php echo ((isset($accout["frost"]) && ($accout["frost"] !== ""))?($accout["frost"]):0.00); ?></td>
					<td>￥<?php echo ((isset($accout["await"]) && ($accout["await"] !== ""))?($accout["await"]):0.00); ?></td>
					</td>
				</tr>
			</table>
		</div>
		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td>资金记录查询</td>
				</tr>
				<tr>
					<td style="padding: 10px 0">记录时间： <input type="text" name="dotime1" id="dotime1"
						value="<?php echo ($_REQUEST['dotime1']); ?>" size="15" onclick="laydate();"/> 到 <input type="text" name="dotime2" value="<?php echo ($_REQUEST['dotime2']); ?>" id="dotime2" size="15" onclick="laydate();"/> 
						<?php $result=$_G ['_linkages']['account_type']; ?><select name='type' id=type><option value=''>全部</option><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$_REQUEST['type']) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select> <input value="搜索" class="xinbuton" type="submit" onclick="sousuo('<?php echo U('Account/logs','','');?>')" /></td>
				</tr>
			</table>
		</div>
		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel" id='acclog'>

				<form action="" method="post">
					<tr class="ytit">
						<td colspan="9">资金历史记录</td>
					</tr>
					<tr class="ytit1">
						<td>类型</td>
						<td>存入</td>
						<td>支出</td>
						<td>冻结</td>
						<td>待收金额</td>
						<td>可用金额</td>
						<td>记录时间</td>
						<td width="100">备注信息</td>
					</tr>

					<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
						<td><?php echo (linkages("account_type",$item["type"])); ?></td>
						<?php if(($item["type"] == 'recharge') OR ($item["type"] == 'rrow_success') OR ($item["type"] == 'borrow_change_sell') OR ($item["type"] == 'tender_late_repay_yes') OR ($item["type"] == 'tender_false') OR ($item["type"] == 'system_repayment') OR ($item["type"] == 'tender_advance_repay_interest') OR ($item["type"] == 'tender_advance_repay_yes') OR ($item["type"] == 'cash_false') OR ($item["type"] == 'tender_user_cancel') OR ($item["type"] == 'borrow_spread_add') OR ($item["type"] == 'tender_spread_add') OR ($item["type"] == 'borrow_spread') OR ($item["type"] == 'tender_spread') OR ($item["type"] == 'online_recharge') OR ($item["type"] == 'recharge_jiangli') OR ($item["type"] == 'tender_award_add') OR ($item["type"] == 'change_add')): ?><td>￥<?php echo ($item["money"]); ?></td>
						<td></td>
						<td></td>
						<td>￥<?php echo ($item["await"]); ?></td>
						<?php elseif($item["type"] == 'tender_repay_yes'): ?>
						<td>￥<?php echo ($item["money"]); ?></td>
						<td></td>
						<td></td>
						<td>￥<?php echo ($item["await"]); ?></td>
						<?php elseif(($item["type"] == 'cash_frost') OR ($item["type"] == 'tender') OR ($item["type"] == 'cash')): ?>

						<td></td>
						<td></td>
						<td>￥<?php echo ($item["money"]); ?></td>
						<td>￥<?php echo ($item["await"]); ?></td>
						<?php elseif($item["type"] == 'tender_success_frost'): ?>

						<td></td>
						<td></td>
						<td></td>
						<td>￥<?php echo ($item["await"]); ?></td>
						<?php else: ?>
						<td></td>
						<td>￥<?php echo ($item["money"]); ?></td>
						<td></td>
						<td>￥<?php echo ($item["await"]); ?></td><?php endif; ?>
						<td>￥<?php echo ($item["balance"]); ?></td>
						<td><?php echo (date("Y-m-d H:i:s",$item["addtime"])); ?></td>
						<td width="130"><?php echo ($item["remark"]); ?></td>
					</tr><?php endforeach; endif; ?>
				</form>
			</table>
		</div>
		<div style="padding: 10px 0; text-align: center" class="page"><?php echo ($page); ?></div>

		<!--资金使用记录列表 结束--> <!--充值记录列表 开始--> <?php elseif(ACTION_NAME == 'recharge'): ?>
		<div class="user_main_title1">
			<div>
				<span class="daochu"></span>成功充值<?php echo ((isset($_U["recharge"]["all"]) && ($_U["recharge"]["all"] !== ""))?($_U["recharge"]["all"]):0.00); ?>元，线上成功充值<?php echo ((isset($_U["recharge"]["online"]) && ($_U["recharge"]["online"] !== ""))?($_U["recharge"]["online"]):0.00); ?>元，线下成功充值<?php echo ((isset($_U["recharge"]["downline"]) && ($_U["recharge"]["downline"] !== ""))?($_U["recharge"]["downline"]):0.00); ?>元。
			</div>
		</div>
		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td colspan="7">充值记录</td>
				</tr>
				<form action="" method="post">
					<tr class="ytit1">
						<td>类型</td>
						<td>支付方式</td>
						<td>充值金额</td>
						<td>充值时间</td>
						<td>备注</td>
						<td>状态</td>
						<td>管理备注</td>
					</tr>

					<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
						<td><?php if(($item["type"]) == "1"): ?>网上充值<?php else: ?>线下充值<?php endif; ?></td>
						<td><?php echo ((isset($item["payment_name"]) && ($item["payment_name"] !== ""))?($item["payment_name"]):"手动充值"); ?></td>
						<td><font color="#FF0000">￥<?php echo ($item["money"]); ?></font></td>
						<td><?php echo (date("Y-m-d H:i",$item["addtime"])); ?></td>
						<td><?php echo ($item["remark"]); ?></td>
						<td><?php if($item["status"] == 0): ?>审核中<?php elseif($item["status"] == 1): ?> 充值成功<?php elseif($item["status"] == 2): ?> 充值失败<?php endif; ?></td>
						<td><?php echo ((isset($item["verify_remark"]) && ($item["verify_remark"] !== ""))?($item["verify_remark"]):"-"); ?></td>
					</tr><?php endforeach; endif; ?>
				</form>
			</table>
		</div>
		<div style="padding: 10px 0; text-align: center"><?php echo ($page); ?></div>

		<?php elseif(ACTION_NAME == 'tender_count'): ?>

		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td colspan="2">回报统计</td>
				</tr>
				<tr>
					<td width="50%">已赚利息</td>
					<td width="50%"><?php echo ((isset($borrow["tender_interest_yes"]) && ($borrow["tender_interest_yes"] !== ""))?($borrow["tender_interest_yes"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td width="50%">已赚奖励</td>
					<td width="50%"><?php echo ((isset($borrow["award_add"]) && ($borrow["award_add"] !== ""))?($borrow["award_add"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td>已赚罚息</td>
					<td><?php echo ((isset($borrow["all_late_interest"]) && ($borrow["all_late_interest"] !== ""))?($borrow["all_late_interest"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td>已赚违约金</td>
					<td><?php echo ((isset($borrow["weiyue"]) && ($borrow["weiyue"] !== ""))?($borrow["weiyue"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td>坏账总额</td>
					<td><?php echo ((isset($borrow["bad_account"]) && ($borrow["bad_account"] !== ""))?($borrow["bad_account"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td>加权平均收益率</td>
					<td><?php echo ((isset($borrow["interest_scale"]) && ($borrow["interest_scale"] !== ""))?($borrow["interest_scale"]):0.00); ?>%</td>
				</tr>
			</table>
		</div>
		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td colspan="4">投标统计</td>
				</tr>
				<tr>
					<td width="25%">总借出金额</td>
					<td width="25%"><?php echo ((isset($borrow["tender_success_account"]) && ($borrow["tender_success_account"] !== ""))?($borrow["tender_success_account"]):0.00); ?>元</td>
					<td width="25%">&nbsp;</td>
					<td width="25%">&nbsp;</td>
				</tr>
				<tr>
					<td>已回收本息</td>
					<td><?php echo ((isset($borrow["tender_recover_yes"]) && ($borrow["tender_recover_yes"] !== ""))?($borrow["tender_recover_yes"]):0.00); ?>元</td>
					<td>已回收期数</td>
					<td><?php echo ((isset($borrow["tender_recover_times_yes"]) && ($borrow["tender_recover_times_yes"] !== ""))?($borrow["tender_recover_times_yes"]):0); ?>期</td>
				</tr>
				<tr>
					<td>待回收本息</td>
					<td><?php echo ((isset($borrow["tender_recover_wait"]) && ($borrow["tender_recover_wait"] !== ""))?($borrow["tender_recover_wait"]):0.00); ?>元</td>
					<td>待回收期数</td>
					<td><?php echo ((isset($borrow["tender_recover_times_wait"]) && ($borrow["tender_recover_times_wait"] !== ""))?($borrow["tender_recover_times_wait"]):0); ?>期</td>
				</tr>
			</table>
		</div>


		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td colspan="4">债权购买统计</td>
				</tr>
				<tr>
					<td width="25%">购买债权投资额</td>
					<td width="25%"><?php echo ((isset($bchange["account"]) && ($bchange["account"] !== ""))?($bchange["account"]):0.00); ?>元</td>
					<td width="25%">预计到期收益</td>
					<td width="25%"><?php echo ((isset($bchange["jingzhuan"]) && ($bchange["jingzhuan"] !== ""))?($bchange["jingzhuan"]):0.00); ?>元</td>
				</tr>
				<tr>
					<td>已回收本息</td>
					<td><?php echo ((isset($bchange["repay"]) && ($bchange["repay"] !== ""))?($bchange["repay"]):0.00); ?>元</td>
					<td>已回收期数</td>
					<td><?php echo ((isset($bchange["yes_times"]) && ($bchange["yes_times"] !== ""))?($bchange["yes_times"]):0); ?>期</td>
				</tr>
				<tr>
					<td>待回收本息</td>
					<td><?php echo ((isset($bchange["wait"]) && ($bchange["wait"] !== ""))?($bchange["wait"]):0.00); ?>元</td>
					<td>待回收期数</td>
					<td><?php echo ((isset($bchange["wait_times"]) && ($bchange["wait_times"] !== ""))?($bchange["wait_times"]):0); ?>期</td>
				</tr>
			</table>
		</div>



		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<tr class="ytit">
					<td colspan="4">债权转让统计</td>
				</tr>
				<tr>
					<td width="25%">转让价格</td>
					<td width="25%">所转让的本息</td>
					<td width="25%">所转让的期数</td>
					<td width="25%">损失金额</td>
				</tr>
				<tr>
					<td width="25%"><?php echo ((isset($lists["account"]) && ($lists["account"] !== ""))?($lists["account"]):0.00); ?>元</td>
					<td width="25%"><?php echo ((isset($lists["all"]) && ($lists["all"] !== ""))?($lists["all"]):0.00); ?>元</td>
					<td width="25%"><?php echo ((isset($lists["count_all"]) && ($lists["count_all"] !== ""))?($lists["count_all"]):0); ?>期</td>
					<td width="25%"><?php echo ((isset($lists["jingzhuan"]) && ($lists["jingzhuan"] !== ""))?($lists["jingzhuan"]):0.00); ?>元</td>
				</tr>
			</table>
		</div>

		<!--提现记录列表 开始--> <?php elseif(ACTION_NAME == 'cash'): ?>
		<div class="user_main_title1">
			<div>成功提现<?php echo ((isset($_U["cash"]["all"]) && ($_U["cash"]["all"] !== ""))?($_U["cash"]["all"]):0.00); ?>元，提现到账<?php echo ((isset($_U["cash"]["credited_all"]) && ($_U["cash"]["credited_all"] !== ""))?($_U["cash"]["credited_all"]):0.00); ?>元，手续费<?php echo ((isset($_U["cash"]["fee_all"]) && ($_U["cash"]["fee_all"] !== ""))?($_U["cash"]["fee_all"]):0.00); ?>元
			</div>
		</div>
		<div class="t10">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="tabyel">
				<form action="" method="post">
					<tr class="ytit">
						<td colspan="8">提现记录</td>
					</tr>
					<tr class="head">
						<td>提现银行</td>
						<td>提现账号</td>
						<td>提现总额</td>
						<td>到账金额</td>
						<td>手续费</td>
						<td>提现时间</td>
						<td>状态</td>
						<td>操作</td>
					</tr>

					<?php if(is_array($list)): foreach($list as $key=>$item): ?><tr>
						<td><?php echo ($item["bank_name"]); ?></td>
						<td><?php echo ($item["account"]); ?></td>
						<td>￥<?php echo ((isset($item["total"]) && ($item["total"] !== ""))?($item["total"]):0.00); ?></td>
						<td>￥<?php echo ((isset($item["credited"]) && ($item["credited"] !== ""))?($item["credited"]):0.00); ?></td>
						<td>￥<?php echo ((isset($item["fee"]) && ($item["fee"] !== ""))?($item["fee"]):0.00); ?></td>
						<td><?php echo (date("Y-m-d H:i",$item["addtime"])); ?></td>
						<td><?php if($item["status"] == 0): ?>审核中<?php elseif($item["status"] == 1): ?>提现成功<?php elseif($item["status"] == 2): ?> 提现失败<?php elseif($item["status"] == 3): ?>用户取消<?php endif; ?></td>
						<td><?php echo ($item["verify_remark"]); ?></td>
					</tr><?php endforeach; endif; ?>
				</form>
			</table>
		</div>
		<div style="padding: 10px 0; text-align: center"><?php echo ($page); ?></div>

		<!--提现记录列表 结束--> <!--账号充值 开始--> <?php elseif(ACTION_NAME == 'recharge_new'): ?>
		<div class="user_main_title1"><?php echo ($_G["system"]["con_webname"]); ?>禁止信用卡套现、虚假交易等行为,一经发现将予以处罚,包括但不限于：限制收款、冻结账户、永久停止服务,并有可能影响相关信用记录。
		</div>
		<form action="" method="post" name="form1">
			<div class="t10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0"
					class="tabyel">
					<tr class="ytit">
						<td colspan="4">充值类型</td>
					</tr>
					<tr>
						<td align="left" colspan="4" style="padding: 10px 0px;"><?php if(is_array($_U["account_payment_list"])): foreach($_U["account_payment_list"] as $key=>$var): if(($var["nid"]) != "offline"): ?><input type="radio"
								checked="checked" name="payment1" value="<?php echo ($var["id"]); ?>" /> <img
								src="/statics/images/payment/<?php echo ($var["nid"]); ?>.gif" align="absmiddle">&nbsp;&nbsp;<?php endif; endforeach; endif; ?> <input type="radio" name="payment1" value="999"> <img
							src="/statics/images/payment/pay_offline.gif" align="absmiddle"></td>
					</tr>
				</table>
			</div>
			<div class="t10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0"
					class="tabyel">
					<tr class="ytit">
						<td>充值金额</td>
					</tr>
					<tr>
						<td style="padding: 10px;"><div class="user_right_border">
								<div class="l">充值金额：</div>
								<div class="c">
									<input type="text" name="money" id="chongzhi_money"
										class="input_border" value="" size="10"
										onkeyup="commit(this);" onblur="commit(this);" maxlength="9"
										tabindex="2" /> 元
								</div>
							</div>
							<div class="user_right_border">
								<div class="l" id="text_jiangli">充值费用：</div>
								<div class="c">
									<font color="#FF0000" id="real_money">0</font> 元
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">实际到账金额：</div>
								<div class="c">
									<font color="#FF0000" id="r_money">0</font> 元
								</div>
							</div>
							<div id="paybycard" class="dishide" style="display: none">
								<div class="user_right_border">
									<div class="l">充值银行：</div>
									<div class="c">
										<?php if(is_array($_U["account_payment_list"])): foreach($_U["account_payment_list"] as $key=>$var): if(($var["nid"]) == "offline"): ?><input type="radio"
											name="payment2" checked="checked" class="input_border"
											value="<?php echo ($var["id"]); ?>" /> <?php echo ($var["name"]); ?>&nbsp;&nbsp;<font
											color="#FF0000"><?php echo (htmlspecialchars_decode($var["description"])); ?></font><?php endif; endforeach; endif; ?>
									</div>
								</div>
								<div class="user_right_border">
									<div class="l">账单流水号：</div>
									<div class="c">
										<input type="text" name="remark" class="input_border" value=""
											size="30" />
									</div>
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">验证码：</div>
								<div class="c">
									<input name="valicode" type="text" size="11" maxlength="4"
										tabindex="5" /> &nbsp;<img src="<?php echo U('index/verify');?>"
										alt="点击刷新"
										onClick="this.src='<?php echo U('Index/verify','','');?>/' + Math.random();"
										align="absmiddle" style="cursor: pointer" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l"></div>
								<div class="c">
									<input type="hidden" name="type" id="recharge_type" value="1" />
									<input type="image" src="<?php echo ($tpldir); ?>/images/chongzhi.png"
										name="name" value="充值" size="30" tabindex="6" />
								</div>
							</div></td>
					</tr>
				</table>
			</div>
		</form>

		<div class="user_right_foot" style="color: red;">*
			温馨提示：网上银行充值过程中请耐心等待,充值成功后，请不要关闭浏览器,充值成功后返回<?php echo ($_G["system"]["con_webname"]); ?>,充值金额才能打入您的帐号。如有问题,请与我们联系
		</div>
		<div class="user_right_foot" style="color: red; display: none;">
			*温馨提示：线下充值客户请在转账备注添加平台用户名，及时向在线客服或拨打<?php echo ($_G["system"]["con_contact"]); ?>提交银行给您的交易号码或网上充值的流水单号，经核实后我们会将您汇款或转帐的金额充值到您的会员帐户内！
		</div>
		<script>
			
			$(document).ready(function(){
				$("[name=payment1]").change(function(){
					var val = $("[name=payment1]:checked").val();
					if(val=="999"){
						$("#payonline").css("display","none");
						$("#paybycard").css("display","");
						$("#recharge_type").val("2");
						$("#chongzhi_money").blur();
						$("#text_jiangli").html("充值奖励：");
						$(".user_right_foot:eq(0)").css("display","none");
						$(".user_right_foot:eq(1)").css("display","");
					}
					else{
						$("#payonline").css("display","");
						$("#paybycard").css("display","none");	
						$("#recharge_type").val("1");
						$("#chongzhi_money").blur();
						$("#text_jiangli").html("充值费用：");
						$(".user_right_foot:eq(0)").css("display","");
						$(".user_right_foot:eq(1)").css("display","none");
					}
					
						
				});
			});
			
			<?php if(($uvip["status"]) == "1"): ?>var recharge_fee = <?php echo ($_G["system"]["con_account_recharge_vip_fee"]); ?>/100;
			<?php else: ?>
				var recharge_fee = <?php echo ($_G["system"]["con_account_recharge_fee"]); ?>/100;<?php endif; ?>
		
			
			var recharge_jiangli = <?php echo ($_G["system"]["con_account_recharge_jiangli"]); ?>/100;
			
			var payment1_id = $('input[name=payment1][checked]:first').val();
			var id = "#paymentnid"+payment1_id;
			if ($(id).val()=="gopay"){
				$("#B2C_Banks").show();
			}
			function change_type(type){
				if (type==2){
					$("#type_net").addClass("dishide");
					$("#type_now").removeClass();
					$("#realacc").hide();
					$("#type_now").show();
					$("#type_net").hide();
				}else{
					$("#type_now").addClass("dishide");
					$("#type_net").removeClass();
					$("#type_now").hide();
					$("#type_net").show();
					$("#realacc").show();
				}
			}
			function change_type1(type){
				if (type=='gopay'){
					$("#B2C_Banks").show();
				}else{
					$("#B2C_Banks").hide();
				}
			}

			function payment (){
	 			var type = GetRadioValue("type");
				if (type==1){
					$("#returnpay").html("<font color='red'>请到打开的新页面充值</font>");
				}
			}
			function ctype(){
				var resualt=false;
				for(var i=0;i<document.form1.payment2.length;i++){
					if(document.form1.payment2[i].checked){
					  resualt=true;
					}
				}
				return resualt;
			}
        	function commit(obj) {
				if (parseFloat(obj.value) > 0 ){
	// 
					var realMoney=parseFloat(obj.value);
					if($("#recharge_type").val()==2){
					document.getElementById("real_money").innerHTML = realMoney*recharge_jiangli;
					document.getElementById("r_money").innerHTML = realMoney+realMoney*recharge_jiangli;
					}else{
					document.getElementById("real_money").innerHTML = realMoney*recharge_fee;
					document.getElementById("r_money").innerHTML = realMoney-realMoney*recharge_fee;
					}
				}else{
					 var realMoney=parseFloat(obj.value);
					 document.getElementById("real_money").innerHTML =0;
					 document.getElementById("r_money").innerHTML =0;
				}
        	}
    	</script> <?php elseif(ACTION_NAME == 'banks'): ?> <?php if(($_G["user_info"]["realname_status"]) != "1"): ?><script>alert("你还没实名认证，请先进行实名认证");location.href="<?php echo U('Approve/realname');?>";</script><?php endif; ?>
		<div class="user_main_title1"><?php echo ($_G["system"]["con_webname"]); ?>禁止信用卡套现、虚假交易等行为,一经发现将予以处罚,包括但不限于：限制收款、冻结账户、永久停止服务,并有可能影响相关信用记录。
		</div>
		<div class="user_right_border">
			<font color="#FF0000" size="+1">* 注意银行账号填写后不允许用户自行修改，请认真填写账号！</font>
		</div>
		<div class="user_right_border">
			<div class="l">真实姓名：</div>
			<div class="c"><?php echo ($_G["user_info"]["realname"]); ?></div>
		</div>
		<form action="" method="post">
			<div class="user_right_border">
				<div class="l">所属银行：</div>
				
				<div class="c">
					<?php $odata=M("account_bank")->getField("id,name") ?><select name='bank' id='bank'><option >请选择</option><?php foreach($odata as $key=>$val){ if(is_array($val)) { if($val["id"]==$_U['account_bank_result']['bank']){?><option selected="selected" value="<?php echo $val["id"] ?>"><?php echo $val["name"] ?></option><?php }else {?><option value="<?php echo $val["id"] ?>"><?php echo $val["name"] ?></option><?php } }else{ if($key==$_U['account_bank_result']['bank']){?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else {?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } }?></select>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">所在地：</div>
				<div class="c">
					<script src="<?php echo U('plugins/index/areas?type=p,c&area='.$_U['account_bank_result']['city']);?>"></script>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">开户行支行名称：</div>
				<div class="c">
					<input type="text" name="branch" value="<?php echo ($_U["account_bank_result"]["branch"]); ?>"
					<?php if(!empty($_U["account_bank_result"]["account"])): ?>readonly="readonly"<?php endif; ?>/> <br /> <span>**分行**支行**分理处或营业部(如：上海分行杨浦支行控江路分理处),如果您无法确定,建议您致电您的开户银行客服进行询问。
					</span>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">银行账号：</div>
				<div class="c">
					<input type="text" name="account"
						value="<?php echo ($_U["account_bank_result"]["account"]); ?>" style="width: 150px;"
					<?php if(!empty($_U["account_bank_result"]["account"])): ?>readonly="readonly"<?php endif; ?>
					/> <br /> <span>特别提醒：上述银行卡号的开户人姓名必须为"<?php echo ($_U["account_bank_result"]["realname"]); ?>",
						个人银行账号必须填写正确,否则你的提现资金将存在风险。 如果要修改的话必须要联系客服人员修改银行账号，所以请认真填写银行账号。</span>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l"></div>
				<div class="c">
					<input type="hidden" name="user_id" value="<?php echo ($_G["user_id"]); ?>" />
					<?php if(empty($_U["account_bank_result"]["account"])): ?><input
						type="submit" name="name" value="确认提交" class="xinbuton" size="30" /><?php endif; ?>
				</div>
			</div>
		</form>
		<div class="user_right_foot">* 温馨提示：禁止信用卡套现</div>
		<!--银行账号 结束--> <!--提现 开始--> <?php elseif(ACTION_NAME == 'cash_new'): ?>
		<div class="user_main_title1">* 温馨提示：禁止信用卡套现</div>
		<form action="" method="post" onsubmit="return check_form()"
			name="form1">

			<div class="user_right_border">
				<div class="l">可用余额：</div>
				<div class="c"><?php echo ((isset($account["balance"]) && ($account["balance"] !== ""))?($account["balance"]):0.00); ?>元</div>
			</div>
			<?php if(($_U["result_jin"]) > "0"): ?><div class="user_right_border">
				<div class="l">净值标总额：</div>
				<div class="c"><?php echo ((isset($_U["result_jin"]) && ($_U["result_jin"] !== ""))?($_U["result_jin"]):0); ?>元</div>
			</div><?php endif; ?>
			<div class="user_right_border">
				<div class="l">提现手续费为：</div>
				<div class="c">
					<font color="#FF0000">提现金额的<?php echo ($_G["system"]["con_account_cash_1"]); ?>%<?php if(($_G["system"]["con_account_cash_fee"]) > "0"): ?>，提现最高手续费<?php echo ($_G["system"]["con_account_cash_fee"]); endif; ?></font>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">
					<font color="#FF0000">*</font>交易密码：
				</div>
				<div class="c">
					<?php if(empty($_G["user_result"]["paypassword"])): ?><a href="<?php echo U('Users/paypwd');?>"><font color="#0000ff">请先设置一个支付密码</font></a>
					<?php else: ?> <input type="password" name="paypassword" tabindex="1" /><?php endif; ?>
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">
					<font color="#FF0000">*</font>提现金额：
				</div>
				<div class="c">
					<input type="text" name="money" tabindex="2"
						onkeyup="commit(this);" />
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">开户名：</div>
				<div class="c">
					<?php if(empty($_G["user_info"]["realname"])): if($real["status"] == 0): ?>实名认证审核中 <a
						href="<?php echo U('approve/realname');?>" style="color: #0000ff">点此进行查看</a> <else<if condition="$real.status eq ''" /> 未提交实名认证 <a
						href="<?php echo U('approve/realname');?>" style="color: #0000ff">点此进行实名认证</a><?php endif; ?> <?php else: ?> <?php echo ($_G["user_info"]["realname"]); endif; ?>
				</div>
			</div>

			<?php if(($bank["id"] > 0) AND ($bank["account"] != '')): ?><div class="user_right_border">
				<div class="l">
					<font color="#FF0000">*</font>开户行支行名称：
				</div>
				<div class="c">
					<input type="text" name="bank"
						value="<?php echo ($bank["bank_name"]); echo ($bank["branch"]); ?>" readonly="readonly"
						style="width: 200px;" />
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">
					<font color="#FF0000">*</font>银行卡号：
				</div>
				<div class="c">
					<input type="text" name="bank_id" id="bank_id"
						value="<?php echo ($bank["account"]); ?>" readonly="readonly" size="20"
						style="width: 150px;" />
				</div>
			</div>
			<div class="user_right_border" style="display: none">
				<div class="l">
					<font color="#FF0000">*</font>再次填写银行卡号：
				</div>
				<div class="c">
					<input type="text" name="bank_id1" id="bank_id1"
						value="<?php echo ($bank["account"]); ?>" />
				</div>
			</div>
			<div class="user_right_border">
				<div class="l">
					<font color="#FF0000">*</font>验证码：
				</div>
				<div class="c">
					<input name="valicode" type="text" size="11" maxlength="4"
						tabindex="3" /> &nbsp;<img src="<?php echo U('index/verify');?>"
						alt="点击刷新"
						onClick="this.src='<?php echo U('Index/verify','','');?>/' + Math.random();"
						align="absmiddle" style="cursor: pointer" />
				</div>
			</div>
			<?php if(($issms) == "1"): ?><script>
		var phone_status = <?php echo ((isset($_G["user_info"]["phone_status"]) && ($_G["user_info"]["phone_status"] !== ""))?($_G["user_info"]["phone_status"]):0); ?>;
		var newphone = <?php echo ((isset($_G["user_info"]["phone"]) && ($_G["user_info"]["phone"] !== ""))?($_G["user_info"]["phone"]):0); ?>;

	 var i_yz=300;
		
            if(phone_status != '1'){
                  alert('您未进行手机认证，请先进行手机认证');
                          location.href='<?php echo U("approve/phone_status");?>';
              }
            function yz_change()
               {
              i_yz--;
            document.getElementById('yz_but').value="重新发送("+i_yz+")"

            if(i_yz==0)
           { document.getElementById('yz_but').disabled=false}
           else
             setTimeout("yz_change()",1000)

               }
function checksms(){
  $.post("<?php echo U('approve/phone_yz?style=ajax&type=smstixian');?>",{phone:newphone},function(data){
			
				if (data!=1){
		  			alert(data);
				}
				else{
					alert("短信发送成功，请注意查收");
					
				}	
				
});
}

</script>
			<div class="user_right_border">
				<div class="l">手机验证码：</div>
				<div class="c">
					<input type="text" name="code_yz" size="5" /> <input value="发送短信"
						type=button id="yz_but" name=yz_but
						onclick="this.disabled=true;yz_change();checksms();">
				</div>
			</div><?php endif; ?>
			<div class="user_right_border">
				<div class="l"></div>
				<div class="c">
					<input type="hidden" name="user_id" value="<?php echo ($_G["user_id"]); ?>" />
					<?php if(empty($_G["user_result"]["paypassword"])): ?>请设置交易密码后再申请提现 <?php else: ?>
					<input type="submit" name="name" value="确认提交" class="xinbuton"
						size="30" /><?php endif; ?>
				</div>
			</div>
			<?php else: ?>
			<div class="user_right_border">
				<div class="l"></div>
				<div class="c">
					<font color="#FF0000">*请先填写您的银行账户后再申请提现！&nbsp;<a
						href="<?php echo U('account/banks');?>" style="color: #0000FF">立即设置银行账号</a></font>
				</div>
			</div><?php endif; ?>

		</form>

		<script>
		var cashfee = <?php echo ($_G["system"]["con_account_cash_1"]); ?>
		
		 function commit(obj) {
            if (parseFloat(obj.value) > 0 ) 
            {
//                
                var realMoney=parseFloat(obj.value);
                if(realMoney<=50000 &&realMoney>=100)
                {
                    document.getElementById("real_money").innerText =cashfee;
                }
            }else{
				 var realMoney=parseFloat(obj.value);
                 document.getElementById("real_money").innerText = 0 ;
			}
        }
    </script> <!-- 
  <script>
{articles module="account" function="GetOne" var="var" user_id="$_G.user_id"}
var use_money = '<?php echo ((isset($var["balance"]) && ($var["balance"] !== ""))?($var["balance"]):0.00); ?>';
var use_await = '<?php echo ((isset($var["await"]) && ($var["await"] !== ""))?($var["await"]):0.00); ?>';
{/articles}

var result_jin='<?php echo ((isset($_U["result_jin"]) && ($_U["result_jin"] !== ""))?($_U["result_jin"]):0); ?>';
var cashfee = '<?php echo ((isset($_G["system"]["con_account_cash_1"]) && ($_G["system"]["con_account_cash_1"] !== ""))?($_G["system"]["con_account_cash_1"]):0); ?>';
var realname_status = '<?php echo ((isset($_G["user_info"]["realname_status"]) && ($_G["user_info"]["realname_status"] !== ""))?($_G["user_info"]["realname_status"]):0); ?>';
 var maxmoney=<?php echo ($_G["system"]["con_tixian_max"]); ?>;

function check_form(){
	;
	 var frm = document.forms['form1'];
	 var paypassword = frm.elements['paypassword'].value;
	 var money = frm.elements['money'].value;
	 var bank = frm.elements['bank'].value;
	 var bank_id = frm.elements['bank_id'].value;
	 var bank_id1 = frm.elements['bank_id1'].value;
	 var errorMsg = '';
	 var all_acc=use_money+cashfee;
	  if (realname_status==0) {
		errorMsg += '未通过实名认证，无法提现。' + '\n';
	  }
	  if (paypassword.length == 0 ) {
		errorMsg += '请输入您的交易密码' + '\n';
	  }
	  if (money.length == 0 ) {
		errorMsg += '请输入你的提现金额' + '\n';
	  }
	  if (bank.length == 0 ) {
		errorMsg += '请输入你的支行名称' + '\n';
	  }
	  if (bank_id.length == 0 ) {
		errorMsg += '请输入你的提现银行卡号' + '\n';
	  }
	  if (bank_id1.length == 0 ) {
		errorMsg += '请再次输入你的提现银行卡号' + '\n';
	  }
	  if (bank_id!=bank_id1) {
		errorMsg += '两次输入的银行卡号不同，请仔细检查后再次输入' + '\n';
	  }
	 if (money <100 || money > 50000) {
		errorMsg += '提现金额要大于100元小于'+maxmoney+'元\n';
	  }
      if(parseInt(all_acc)+parseInt(use_await)-parseInt(result_jin)<parseInt(money) && result_jin>0){
	  errorMsg += '您发布了净值标，提现金额大于了总资产' + '\n';
	  }
	 if (parseInt(money) >parseInt(all_acc)) {
		errorMsg += '您的提现金额加手续费大于现有的可用余额' + '\n';
	  }
	  if (errorMsg.length > 0){
		alert(errorMsg); return false;
	  } else{  
		return true;
	  }
}
</script>
    --> <?php else: ?> <script>window.location.href='/404.htm';</script><?php endif; ?>
	</div>
</div>
<script>
function sousuo(url){
	var _url = "";
	var dotime1 = $("#dotime1").val();
	var keywords = $("#keywords").val();
	var username = $("#username").val();
	var dotime2 = $("#dotime2").val();
	var type = $("#type").val();
	if (username!=''&&username!=null){
		 _url += "/username/"+username;
	}
	if (keywords!=null&&keywords!=''){
		 _url += "/keywords/"+keywords;
	}
	if (dotime1!=''&&dotime1!=null){
		 _url += "/dotime1/"+dotime1;
		
	}
	if (dotime2!=''&&dotime2!=null){
		 _url += "/dotime2/"+dotime2;
	}
	if (type!=''&&type!=null){
		 _url += "/type/"+type;
	}
	location.href=url+_url;
}

</script>
<div class="cle"></div>
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