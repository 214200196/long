<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(empty($_G["articles"]["name"])): else: echo ($_G["articles_result"]["name"]); ?>|<?php endif; if(empty($_G["articles_result"]["name"])): else: echo ($_G["articles_result"]["name"]); ?> |<?php endif; echo ($_G["system"]["con_webname"]); ?></title>
<meta name="description" content="<?php echo ($_G["system"]["con_description"]); ?>" />
<meta name="keywords" content="<?php if(empty($_G["articles_result"]["tags"])): else: echo ($_G["articles_result"]["tags"]); endif; if(empty($_G["site_result"]["keywords"])): else: echo ($_G["site_result"]["keywords"]); endif; ?>
<?php echo ($_G["system"]["con_keywords"]); ?>" />
<script type="text/javascript" src="/statics/js/jquery.js"></script>
<script type="text/javascript" src="/statics/js/layer/layer.min.js"></script>
<script type="text/javascript" src="/statics/js/laydate/laydate.js"></script>
<link rel="stylesheet" href="<?php echo ($tpldir); ?>longbao/style.css" type="text/css" media="screen, projection" />
<link href="<?php echo ($tpldir); ?>css/common.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/user.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/new.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/shop.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/tipswindown.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/myinfo.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ($tpldir); ?>css/css_inpage.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ($tpldir); ?>js/sub.js" type="text/javascript" ></script>
<script src="<?php echo ($tpldir); ?>js/tb.js" type="text/javascript" ></script>
<script src="<?php echo ($tpldir); ?>js/tipswindown.js" type="text/javascript"></script>
<script src="<?php echo ($tpldir); ?>js/lhgdialog.min.js" type="text/javascript"></script>
<script src="<?php echo ($tpldir); ?>js/base.js" type="text/javascript"></script>
<script src="<?php echo ($tpldir); ?>js/bpopup.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo ($tpldir); ?>js/jquery.SuperSlide.2.1.1.js"></script>


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
<div class="header clearfix">
  <div class="top" style="height:35px;">
    <div class="box980" style="position:relative">
      <div style="left:370px;position:absolute;">
        <dl id="qh_box" >
        <dt>在线客服</dt>
        <?php $kefu=explode("|",$_G['system']['con_qqkf']); ?>
        <?php if(is_array($kefu)): foreach($kefu as $key=>$var): ?><dd style='background:none;height: auto;'> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo ($var); ?>&site=qq&menu=yes"> <img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($var); ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息" /> </a> </dd><?php endforeach; endif; ?>
      </dl>
        <dl id="qh_box1" style="margin-left:100px">
        <dt>官方群号</dt>
        <?php $qqun=explode("|",$_G['system']['con_qqgroup']); ?>
         <?php if(is_array($qqun)): foreach($qqun as $key=>$var): ?><dd style='background:none'><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=<?php echo (htmlspecialchars_decode($var)); ?>"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" ></a></dd><?php endforeach; endif; ?>
      </dl>
      </div>
      <a href="<?php echo U('Index/index?site=toollixi');?>"><img src="<?php echo ($tpldir); ?>/longbao/images/jsq.jpg" width="8" height="11" /> 利息计算器</a>
         <?php if($_G["user_id"] == ''): ?><a href="<?php echo U('index/reg');?>">注册</a> <a href="<?php echo U('index/login');?>">登录</a> 
        <?php else: ?>
        <a href="<?php echo U('index/logout');?>">退出</a> <a href="<?php echo U('Message/index');?>">站内信(<?php echo ((isset($_G["message_result"]["message_no"]) && ($_G["message_result"]["message_no"] !== ""))?($_G["message_result"]["message_no"]):0); ?>)</a> <a href="<?php echo U('users/index');?>">您好，<?php echo ($_G["user_result"]["username"]); ?></a><?php endif; ?><span class="tel">客服热线：<strong><?php echo ($_G["system"]["con_contact"]); ?> </strong></span>
      <div class="look_us" style="color: #fff;height:35px; left:170px; line-height: 35px; position:absolute; top:0px;width: 200px;">关注我们： <a href="<?php echo ($_G["system"]["con_weibourl"]); ?>" target="_blank" id="wei_bo" > 微博</a> <a href="javascript:();" id="weix">微信</a> <img src="/statics/images/erweima.png" style=" margin-left:40px;*margin-left:-30px !important;position: absolute;top: 40px;z-index: 9999;display:none;width:130px;height:130px" id="erweima"/> </div>
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

<div class="con_box">
	<div
		style="border: 1px solid #CCCCCC; width: 980px; margin: 0px 10px; height: 150px; margin: 0 auto; background-color: #fff;">
		<div
			style="background-color: #E8E8E8; margin: 1px; height: 25px; line-height: 25px; padding-left: 10px; font-size: 13px;">
			<strong>系统信息</strong>
		</div>
		<div
			style="text-align: center; font-size: 12px; background-color: #fff;">
			<br /> &nbsp;&nbsp;<?php echo ($_U["showmsg"]["msg"]); ?> <br /> <br />
			<div id="msg_content">
				<a href="<?php echo ($_U["showmsg"]["url"]); ?>"><?php echo ($_U["showmsg"]["content"]); ?></a>
			</div>
			<br />
		</div>
	</div>
</div>
<script> 
		var url = '<?php echo ($_U["showmsg"]["url"]); ?>';
		var content = '<?php echo ($_U["showmsg"]["content"]); ?>';
		
		if (url == ""){
			document.getElementById('msg_content').innerHTML = "<a href='javascript:history.go(-1)'>"+content+"</a>";
		}else{
			document.getElementById('msg_content').innerHTML = "<a href='"+url+"'>"+content+"</a>";
		}
		setInterval("testTime()",3000); 
		function testTime() { 
			if (url == ""){
				history.go(-1);
			}else{
				location.href = url; //#设定跳转的链接地址
			}
		}
    </script>
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