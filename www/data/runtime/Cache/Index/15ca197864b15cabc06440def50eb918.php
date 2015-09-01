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
		<div class="user_right"><div class="user_right">
	<div>
		<div class="m_change">
			<?php if(in_array((ACTION_NAME), explode(',',"basic,detail,contact,company,finance,assets,job,addpayment,addrevenue"))): ?><ul>
				<li><a href="<?php echo U('Rating/basic');?>"<?php if((ACTION_NAME) == "basic"): ?>class="onn"<?php endif; ?>>个人详细资料</a></li>
				<li><a href="<?php echo U('Rating/job');?>"<?php if((ACTION_NAME) == "job"): ?>class="onn"<?php endif; ?>>工作单位信息</a></li>
				<li><a href="<?php echo U('Rating/company');?>"<?php if((ACTION_NAME) == "company"): ?>class="onn"<?php endif; ?>>私营业主信息</a></li>
				<li><a href="<?php echo U('Rating/finance');?>"<?php if((ACTION_NAME == 'finance') OR (ACTION_NAME == 'addpayment') OR (ACTION_NAME == 'addrevenue')): ?>class="onn"<?php endif; ?>>财务状况</a></li>
				<li><a href="<?php echo U('Rating/contact');?>"<?php if((ACTION_NAME) == "contact"): ?>class="onn"<?php endif; ?>>主要联系人</a></li>
			</ul><?php endif; ?>
		</div>
		<div class="us_r_bor1">
			<?php if(ACTION_NAME == 'basic'): ?><form action="" method="post" onsubmit="return formcheck();"
				name="formx" id="formx">
				<div class="user_main_title1">
					<font color="#ff0000">*</font>为必填资料，所有资料均会严格保密
				</div>
				<div class="user_right_border">
					<div class="l">手机号码：</div>
					<div class="c">
						<input type="text" name="phone_num" id="phone_num" value="<?php echo ($ivar["phone_num"]); ?>" class="person_sty" /> <font
							color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">性别：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_sex']; ?><select name='sex' id=sex><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["sex"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">出生日期：</div>
					<div class="c">
						<input type="text" readonly="readonly" onclick="laydate();"
							name="birthday" id="birthday" value="<?php echo ($ivar["birthday"]); ?>"
							class="person_sty" /> <font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">最高学历：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_education']; ?><select name='edu' id=edu><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["edu"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">入学时间：</div>
					<div class="c">
						<input type="text" readonly="readonly" onclick="laydate();"
							name="school_year" id="school_year" value="<?php echo ($ivar["school_year"]); ?>"
							class="person_sty" /> <font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">毕业院校：</div>
					<div class="c">
						<input type="text" name="school" id="school" value="<?php echo ($ivar["school"]); ?>"
							class="person_sty" /> <font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">婚姻状况：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_marry']; ?><select name='marry' id=marry><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["marry"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">有无子女：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_children']; ?><select name='children' id=children><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["children"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">是否有房：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_house']; ?><select name='house' id=house><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["house"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">是否有车：</div>
					<div class="c">
						<?php $result=$_G ['_linkages']['rating_car']; ?><select name='is_car' id=is_car><?php foreach($result as $key=>$val) { $select=""; if($val["value"]==$ivar["is_car"]) $select="selected='selected'";?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">户口所在地：</div>
					<div class="c">
						<script
							src="<?php echo U('plugins/index/areas?type=p,c&area='.$var['city']);?>"></script>
						<font color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">居住地址：</div>
					<div class="c">
						<input type="text" name="address" id="address"
							value="<?php echo ($ivar["address"]); ?>" class="person_sty" /> <font
							color="#ff0000">*</font>
					</div>
				</div>
				<div class="user_right_border">
					<div class="l">居住电话：</div>
					<div class="c">
						<input type="text" name="phone" id="phone" value="<?php echo ($ivar["phone"]); ?>"
							class="person_sty" />
					</div>
				</div>
				<div class="user_right_border">
					<div class="l"></div>
					<div class="c">
						<input type="hidden" name="submit" value="submit"> <input
							type="submit" name="submit" value="提交" class="xinbuton">
					</div>
				</div>


				<script>
			function formcheck(){
				 var frm = document.forms['formx'];
				 var realname = frm.elements['realname'].value;
				 var card_id = frm.elements['card_id'].value;
				 var phone_num = frm.elements['phone_num'].value;
				 var birthday = frm.elements['birthday'].value;
				 var school_year = frm.elements['school_year'].value;
				 var school = frm.elements['school'].value;
				 var address = frm.elements['address'].value;
				 var errorMsg = '';
	
				  if (phone_num.length == 0 ) {
					errorMsg += '* 手机号码不能为空' + '\n';
				  }
				  if (birthday.length == 0 ) {
					errorMsg += '* 出生日期不能为空' + '\n';
				  }
				  if (school_year.length == 0 ) {
					errorMsg += '* 入学年份不能为空' + '\n';
				  }
				  if (school.length == 0 ) {
					errorMsg += '* 毕业院校不能为空' + '\n';
				  }
				  if (address.length == 0 ) {
					errorMsg += '* 居住地址不能为空' + '\n';
				  }
				  if (errorMsg.length > 0){
					alert(errorMsg); return false;
				  } else{  
					return true;
				  }
			}
			</script>

				<?php elseif(ACTION_NAME == 'job'): ?>
				<form action="" method="post" onsubmit="return formck();"
					name="formx" id="formx">
					<div class="user_main_title1">
						<font color="#ff0000">*</font>为必填资料，所有资料均会严格保密
					</div>

					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>单位名称：
						</div>
						<div class="c">
							<input type="text" name="name" value="<?php echo ($ivar["name"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>性质：
						</div>
						<div class="c">
							<input type="text" name="type" value="<?php echo ($ivar["type"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>行业：
						</div>
						<div class="c">
							<input type="text" name="industry" value="<?php echo ($ivar["industry"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>人员规模：
						</div>
						<div class="c">
							<input type="text" name="peoples" value="<?php echo ($ivar["peoples"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>入职时间：
						</div>
						<div class="c">
							<input type="text" readonly="readonly" onclick="laydate();"
								name="worktime1" value="<?php echo ($ivar["worktime1"]); ?>" class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>职务：
						</div>
						<div class="c">
							<input type="text" name="office" value="<?php echo ($ivar["office"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>单位地址：
						</div>
						<div class="c">
							<input type="text" name="address" value="<?php echo ($ivar["address"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l">
							<font color="#ff0000">*</font>单位电话：
						</div>
						<div class="c">
							<input type="text" name="tel" id="tel" value="<?php echo ($ivar["tel"]); ?>"
								class="person_sty" />
						</div>
					</div>
					<div class="user_right_border">
						<div class="l"></div>
						<div class="c">
							<input type="hidden" name="submit" value="submit"> <input
								type="submit" name="submit" value="提交" class="xinbuton">
						</div>
					</div>


					<script>
			function formck(){
				 var frm = document.forms['formx'];
				 var address = frm.elements['tel'].value;
				 var errorMsg = '';
				  if (tel.length == 0 ) {
					errorMsg += '* 单位电话不能为空' + '\n';
				  }
				  if (address.length == 0 ) {
					errorMsg += '* 单位地址不能为空' + '\n';
				  }
				  if (office.length == 0 ) {
					errorMsg += '* 工作职位不能为空' + '\n';
				  }
				  if (worktime1.length == 0 ) {
					errorMsg += '* 入职时间不能为空' + '\n';
				  }
				  if (peoples.length == 0 ) {
					errorMsg += '* 公司人数不能为空' + '\n';
				  }
				  if (industry.length == 0 ) {
					errorMsg += '* 行业不能为空' + '\n';
				  }
				  if (type.length == 0 ) {
					errorMsg += '* 单位性质不能为空' + '\n';
				  }
				  if (name.length == 0 ) {
					errorMsg += '* 单位名称不能为空' + '\n';
				  }
				  if (errorMsg.length > 0){
					alert(errorMsg); return false;
				  } else{  
					return true;
				  }
			}
			</script>

					<?php elseif(ACTION_NAME == 'contact'): ?>
					<form action="" method="post" onsubmit="return ck();" name="formx"
						id="formx">
						<div class="user_main_title1">
							<font color="#ff0000">*</font>为必填资料，所有资料均会严格保密<br> <font
								color="#ff0000">请注意: 请确保联系人填写准确，如果核实时出现对方不知道的情况，将取消借款资格!</font>
						</div>

						<div class="user_right_border">
							<div class="l">配偶姓名：</div>
							<div class="c">
								<input type="text" name="linkman2" value="<?php echo ($ivar["linkman2"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">配偶电话：</div>
							<div class="c">
								<input type="text" name="phone2" value="<?php echo ($ivar["phone2"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">直系亲属1姓名：</div>
							<div class="c">
								<input type="text" name="linkman3" value="<?php echo ($ivar["linkman3"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">直系亲属1电话：</div>
							<div class="c">
								<input type="text" name="phone3" value="<?php echo ($ivar["phone3"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">直系亲属2姓名：</div>
							<div class="c">
								<input type="text" name="linkman6" value="<?php echo ($ivar["linkman6"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">直系亲属2电话：</div>
							<div class="c">
								<input type="text" name="phone6" value="<?php echo ($ivar["phone6"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同事1姓名：</div>
							<div class="c">
								<input type="text" name="linkman4" value="<?php echo ($ivar["linkman4"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同事1电话：</div>
							<div class="c">
								<input type="text" name="phone4" value="<?php echo ($ivar["phone4"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同事2姓名：</div>
							<div class="c">
								<input type="text" name="linkman7" value="<?php echo ($ivar["linkman7"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同事2电话：</div>
							<div class="c">
								<input type="text" name="phone7" value="<?php echo ($ivar["phone7"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">朋友1姓名：</div>
							<div class="c">
								<input type="text" name="linkman8" value="<?php echo ($ivar["linkman8"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">朋友1电话：</div>
							<div class="c">
								<input type="text" name="phone8" value="<?php echo ($ivar["phone8"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">朋友2姓名：</div>
							<div class="c">
								<input type="text" name="linkman9" value="<?php echo ($ivar["linkman9"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">朋友2电话：</div>
							<div class="c">
								<input type="text" name="phone9" value="<?php echo ($ivar["phone9"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同学1姓名：</div>
							<div class="c">
								<input type="text" name="linkman10" value="<?php echo ($ivar["linkman10"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同学1电话：</div>
							<div class="c">
								<input type="text" name="phone10" value="<?php echo ($ivar["phone10"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同学2姓名：</div>
							<div class="c">
								<input type="text" name="linkman11" value="<?php echo ($ivar["linkman11"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">同学2电话：</div>
							<div class="c">
								<input type="text" name="phone11" value="<?php echo ($ivar["phone11"]); ?>"
									class="person_sty" />
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">紧急联系人姓名：</div>
							<div class="c">
								<input type="text" name="linkman5" value="<?php echo ($ivar["linkman5"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l">紧急联系人电话：</div>
							<div class="c">
								<input type="text" name="phone5" value="<?php echo ($ivar["phone5"]); ?>"
									class="person_sty" /> <font color="#ff0000">*</font>
							</div>
						</div>
						<div class="user_right_border">
							<div class="l"></div>
							<div class="c">
								<input type="hidden" name="submit" value="submit"> <input
									type="submit" name="submit" value="提交" class="xinbuton">
							</div>
						</div>


						<script>
			function ck(){
				 var frm = document.forms['formx'];
				 var linkman2 = frm.elements['linkman2'].value;
				 var linkman3 = frm.elements['linkman3'].value;
				 var linkman3 = frm.elements['linkman4'].value;
				 var linkman3 = frm.elements['linkman5'].value;
				 var phone2 = frm.elements['phone2'].value;
				 var phone3 = frm.elements['phone3'].value;
				 var phone3 = frm.elements['phone4'].value;
				 var phone3 = frm.elements['phone5'].value;
				 var errorMsg = '';
				  if (linkman2.length == 0 ) {
					errorMsg += '* 配偶姓名不能为空' + '\n';
				  }
				  if (linkman3.length == 0 ) {
					errorMsg += '* 直系亲属姓名不能为空' + '\n';
				  }
				  if (linkman4.length == 0 ) {
					errorMsg += '* 同事姓名不能为空' + '\n';
				  }
				  if (linkman5.length == 0 ) {
					errorMsg += '* 紧急联系人姓名不能为空' + '\n';
				  }
				  if (phone2.length == 0 ) {
					errorMsg += '* 配偶电话不能为空' + '\n';
				  }
				  if (phone3.length == 0 ) {
					errorMsg += '* 直系亲属电话不能为空' + '\n';
				  }
				  if (phone4.length == 0 ) {
					errorMsg += '* 同事电话不能为空' + '\n';
				  }
				  if (phone5.length == 0 ) {
					errorMsg += '* 紧急联系人电话不能为空' + '\n';
				  }
				  if (errorMsg.length > 0){
					alert(errorMsg); return false;
				  } else{  
					return true;
				  }
			}
			</script>

						<?php elseif(ACTION_NAME == 'company'): ?>

						<form action="" method="post" name="formx" id="formx"
							onsubmit="return formck();">
							<div class="user_main_title1">
								<font color="#ff0000">*</font>为必填资料，所有资料均会严格保密
							</div>

							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>名称：
								</div>
								<div class="c">
									<input type="text" name="name" value="<?php echo ($ivar["name"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>执照号：
								</div>
								<div class="c">
									<input type="text" name="license_num"
										value="<?php echo ($ivar["license_num"]); ?>" class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>税务号(地税)：
								</div>
								<div class="c">
									<input type="text" name="tax_num_di" value="<?php echo ($ivar["tax_num_di"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">税务号(国税)：：</div>
								<div class="c">
									<input type="text" name="tax_num_guo"
										value="<?php echo ($ivar["tax_num_guo"]); ?>" class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>地址：
								</div>
								<div class="c">
									<input type="text" name="address" value="<?php echo ($ivar["address"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>租期：
								</div>
								<div class="c">
									<input type="text" name="rent_time" value="<?php echo ($ivar["rent_time"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>租金：
								</div>
								<div class="c">
									<input type="text" name="rent_money" value="<?php echo ($ivar["rent_money"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>行业：
								</div>
								<div class="c">
									<input type="text" name="hangye" value="<?php echo ($ivar["hangye"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>人员规模：
								</div>
								<div class="c">
									<input type="text" name="people" value="<?php echo ($ivar["people"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l">
									<font color="#ff0000">*</font>成立时间：
								</div>
								<div class="c">
									<input type="text" name="time" value="<?php echo ($ivar["time"]); ?>"
										class="person_sty" />
								</div>
							</div>
							<div class="user_right_border">
								<div class="l"></div>
								<div class="c">
									<input type="hidden" name="submit" value="submit"> <input
										type="submit" name="submit" value="提交" class="xinbuton">
								</div>
							</div>


							<script>
			function formck(){
				 var frm = document.forms['formx'];
				 var name = frm.elements['name'].value;
				 var license_num = frm.elements['license_num'].value;
				 var tax_num_di = frm.elements['tax_num_di'].value;
				 var address = frm.elements['address'].value;
				 var rent_time = frm.elements['rent_time'].value;
				 var hangye = frm.elements['hangye'].value;
				 var time = frm.elements['time'].value;
				 var people = frm.elements['people'].value;
				 var rent_money = frm.elements['rent_money'].value;
				 var errorMsg = '';
				  if (name.length == 0 ) {
					errorMsg += '* 单位名称不能为空' + '\n';
				  }
				  if (people.length == 0 ) {
					errorMsg += '* 人员规模不能为空' + '\n';
				  }
				  if (time.length == 0 ) {
					errorMsg += '* 成立时间不能为空' + '\n';
				  }
				  if (license_num.length == 0 ) {
					errorMsg += '* 执照号不能为空' + '\n';
				  }
				  if (hangye.length == 0 ) {
					errorMsg += '* 行业不能为空' + '\n';
				  }
				  if (tax_num_di.length == 0 ) {
					errorMsg += '* 地税号不能为空' + '\n';
				  }
				  if (address.length == 0 ) {
					errorMsg += '* 单位地址不能为空' + '\n';
				  }
				  if (rent_time.length == 0 ) {
					errorMsg += '* 租期不能为空' + '\n';
				  }
				  if (rent_money.length == 0 ) {
					errorMsg += '* 租金不能为空' + '\n';
				  }
				  if (errorMsg.length > 0){
					alert(errorMsg); return false;
				  } else{  
					return true;
				  }
			}
			</script>

							<?php elseif(ACTION_NAME == 'assets'): ?>

							<div class="user_main_title1">
								<font color="#ff0000">*</font>为必填资料，所有资料均会严格保密
							</div>
							<div class="t20">
								<table width="100%" border="0" cellspacing="0" cellpadding="0"
									class="tabyel">
									<tr class="ytit">
										<td colspan="5"><a href="<?php echo ($_U["query_url"]); ?>/addassets">添加资产状况</a></td>
									</tr>
									<tr class="ytit1">
										<td>负债类型</td>
										<td>负债名称</td>
										<td>金额</td>
										<td>其他说明</td>
										<td>操作</td>
									</tr>
									{list module="rating" var="loop" function ="GetAssetsList"
									user_id="0"} {foreach from="$loop.list" item="item"}
									<tr>
										<td><?php echo (linkages("rating_assetstype",$item["assetstype"])); ?></td>
										<td><?php echo ($item["name"]); ?></td>
										<td><?php echo ($item["account"]); ?></td>
										<td><?php echo ($item["other"]); ?></td>
										<td><a href="<?php echo ($_U["query_url"]); ?>/addassets&edit=<?php echo ($item["id"]); ?>">编辑</a>/<a
											href="#"
											onClick="javascript:if(confirm('确定要删除吗?删除后将不可恢复')) location.href='<?php echo ($_U["query_url"]); ?>/<?php echo ($_U["query_type"]); ?>&del=<?php echo ($item["id"]); ?>'">删除</a></td>
									</tr>
									{/foreach} {/list}
								</table>
							</div>
							<?php elseif(ACTION_NAME == 'finance'): ?>

							<div class="user_main_title1">
								请如实填写，如发现情况不符而产生的<font color="#ff0000">严重后果</font>全部由个人承担。
							</div>
							<div class="t20">
								<table width="100%" border="0" cellspacing="0" cellpadding="0"
									class="tabyel">
									<tr class="ytit">
										<td colspan="5">您的个人收入一览（<a
											href="<?php echo U('rating/addrevenue');?>">添加收入状况</a>）
										</td>
									</tr>
									<tr class="ytit1">
										<td>收入类型</td>
										<td>收入名称</td>
										<td>金额</td>
										<td>其他说明</td>
										<td>操作</td>
									</tr>

									<?php if(is_array($ilist)): foreach($ilist as $key=>$item): ?><tr>
										<td><?php echo (linkages("rating_revenue",$item["type"])); ?></td>
										<td><?php echo ($item["name"]); ?></td>
										<td><?php echo ($item["account"]); ?></td>
										<td><?php echo ($item["other"]); ?></td>
										<td><a href="<?php echo U('rating/addrevenue?edit='.$item['id']);?>">编辑</a>/<a
											href="#"
											onClick="javascript:if(confirm('确定要删除吗?删除后将不可恢复')) location.href='<?php echo U('rating/finance?del='.$item['id']);?>'">删除</a></td>
									</tr><?php endforeach; endif; ?>

								</table>
								<br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0"
									class="tabyel">
									<tr class="ytit">
										<td colspan="5">您的个人支出一览（<a
											href="<?php echo U('rating/addpayment');?>">添加支出状况</a>）
										</td>
									</tr>
									<tr class="ytit1">
										<td>支出类型</td>
										<td>支出名称</td>
										<td>金额</td>
										<td>其他说明</td>
										<td>操作</td>
									</tr>
									<?php if(is_array($elist)): foreach($elist as $key=>$item): ?><tr>
										<td><?php echo (linkages("rating_payment",$item["type"])); ?></td>
										<td><?php echo ($item["name"]); ?></td>
										<td><?php echo ($item["account"]); ?></td>
										<td><?php echo ($item["other"]); ?></td>
										<td><a href="<?php echo U('rating/addpayment?edit='.$item['id']);?>">编辑</a>/<a
											href="#"
											onClick="javascript:if(confirm('确定要删除吗?删除后将不可恢复')) location.href='<?php echo U('rating/finance?del='.$item['id']);?>'">删除</a></td>
									</tr><?php endforeach; endif; ?>

								</table>
								<br>
							</div>
							<?php elseif(ACTION_NAME == 'addassets'): ?>
							<form action="" method="post">
								<div class="user_right_border">
									<div class="l">负债类别：</div>
									<div class="c">
										<?php $result=$_G ['_linkages']['rating_assetstype']; ?><select name='assetstype' id=assetstype><?php foreach($result as $key=>$val) {?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
										<font color="#ff0000">*</font>
									</div>
								</div>
								<div class="user_right_border">
									<div class="l">负债名称：</div>
									<div class="c">
										<input type="text" name="name"
											value="<?php echo ($_U["rating_result"]["name"]); ?>" id="name"> <font
											color="#ff0000">*</font>
									</div>
								</div>
								<div class="user_right_border">
									<div class="l">金额：</div>
									<div class="c">
										<input type="text" name="account"
											value="<?php echo ($_U["rating_result"]["account"]); ?>" id="account"> <font
											color="#ff0000">*</font>
									</div>
								</div>
								<div class="user_right_border">
									<div class="l">其他：</div>
									<div class="c">
										<textarea cols="30" rows="5" name="other"><?php echo ($_U["rating_result"]["other"]); ?></textarea>
										<font color="#ff0000">*</font>
									</div>
								</div>
								<div class="user_right_border">
									<div class="l"></div>
									<div class="c">
										<input type="hidden" name="submit" value="submit"> <input
											type="submit" name="submit" value="提交" class="xinbuton">
									</div>
								</div>
								<?php elseif(ACTION_NAME == 'addpayment'): ?>

								<div class="user_main_title1">
									添加支出状况,请如实填写，如发现情况不符而产生的<font color="#ff0000">严重后果</font>全部由个人承担。
								</div>
								<br />
								<form action="" method="post">
									<div class="user_right_border">
										<div class="l">支出类别：</div>
										<div class="c">
											<?php $result=$_G ['_linkages']['rating_payment']; ?><select name='type' id=type><?php foreach($result as $key=>$val) {?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
											<font color="#ff0000">*</font>
										</div>
									</div>
									<div class="user_right_border">
										<div class="l">支出名称：</div>
										<div class="c">
											<input type="text" name="name"
												value="<?php echo ($_U["rating_result"]["name"]); ?>" id="name"> <font
												color="#ff0000">*</font>
										</div>
									</div>
									<div class="user_right_border">
										<div class="l">金额：</div>
										<div class="c">
											<input type="text" name="account"
												value="<?php echo ($_U["rating_result"]["account"]); ?>" id="account"> <font
												color="#ff0000">*</font>
										</div>
									</div>
									<div class="user_right_border">
										<div class="l">其他：</div>
										<div class="c">
											<textarea cols="30" rows="5" name="other"><?php echo ($_U["rating_result"]["other"]); ?></textarea>
											<font color="#ff0000">*</font>
										</div>
									</div>
									<div class="user_right_border">
										<div class="l">
											<input type="hidden" name="use_type" value="2" id="use_type">
										</div>
										<div class="c">
											<input type="hidden" name="submit" value="submit"> <input
												type="submit" name="submit" value="提交" class="xinbuton">
										</div>
									</div>
									<?php elseif(ACTION_NAME == 'addrevenue'): ?>

									<div class="user_main_title1">
										添加收入状况,请如实填写，如发现情况不符而产生的<font color="#ff0000">严重后果</font>全部由个人承担。
									</div>
									<br />
									<form action="" method="post">
										<div class="user_right_border">
											<div class="l">收入类别：</div>
											<div class="c">
												<?php $result=$_G ['_linkages']['rating_revenue']; ?><select name='type' id=type><?php foreach($result as $key=>$val) {?><option value='<?php echo $val['value'];?>' <?php echo $select;?>><?php echo $val['name']?></option><?php }?></select>
												<font color="#ff0000">*</font>
											</div>
										</div>
										<div class="user_right_border">
											<div class="l">收入名称：</div>
											<div class="c">
												<input type="text" name="name"
													value="<?php echo ($_U["rating_result"]["name"]); ?>" id="name"> <font
													color="#ff0000">*</font>
											</div>
										</div>
										<div class="user_right_border">
											<div class="l">金额：</div>
											<div class="c">
												<input type="text" name="account"
													value="<?php echo ($_U["rating_result"]["account"]); ?>" id="account"> <font
													color="#ff0000">*</font>
											</div>
										</div>
										<div class="user_right_border">
											<div class="l">其他：</div>
											<div class="c">
												<textarea cols="30" rows="5" name="other"><?php echo ($_U["rating_result"]["other"]); ?></textarea>
												<font color="#ff0000">*</font>
											</div>
										</div>
										<div class="user_right_border">
											<div class="l">
												<input type="hidden" name="use_type" value="1" id="use_type">
											</div>
											<div class="c">
												<input type="hidden" name="submit" value="submit"> <input
													type="submit" name="submit" value="提交" class="xinbuton">
											</div>
										</div><?php endif; ?>
			</form>
		</div>
	</div>
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