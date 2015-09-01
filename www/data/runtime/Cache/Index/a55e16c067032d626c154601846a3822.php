<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<?php if(empty($_G["user_id"])): ?><script>
	window.onload=function()
	{
	 
      $('#element_to_pop_up').bPopup({
            speed: 650,
            transition: 'slideIn',
	    transitionClose: 'slideBack'
        });   
        
	setTimeout("location.href='<?php echo U('Index/login');?>'",2000);
	}
	</script><?php endif; ?>
<div class="con_box">
  <div>
    <div class="con_bor">
      <div class="pos_bor"> <span><a href="<?php echo U('borrow/index');?>">我要借款</a> > 借款认证</span> </div>
      <div class="con2">
        <div style="width: 897px; margin: 20px auto">
          <div style="margin: 20px 0">
            <div class="m_change">
              <ul>
                <li><a href="<?php echo U('Approve/realname');?>" <?php if((ACTION_NAME) == "realname"): ?>class="onn"<?php endif; ?> >实名认证</a></li>
                <li><a href="<?php echo U('Approve/phone_status');?>"  <?php if((ACTION_NAME) == "phone_status"): ?>class="onn"<?php endif; ?> >手机认证</a></li>
                <li><a href="<?php echo U('Approve/video_status');?>" <?php if((ACTION_NAME) == "video_status"): ?>class="onn"<?php endif; ?> >视频认证</a></li>
              </ul>
            </div>
            <div style="padding: 20px 80px">
 <?php if($_G['user_info']['phone_status'] == 0): if($_REQUEST['phone']!= ''): ?><form action="<?php echo U('approve/phone_status');?>" method="post" name="formx" id="formx">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="jk_tab" id="checksms">
                      <tr>
                        <td width="24%" align="right"><span>*</span>手机号码：</td>
                        <td width="76%" align="left"><span><?php echo ($_REQUEST['phone']); ?></span></td>
                      </tr>
                      <tr>
                        <td width="24%" align="right"><span>*</span>输入短信验证码：</td>
                        <td width="76%" align="left"><input type="text" name="sms_code" style="width: 150px; border: #BFBFBF solid 1px; height: 18px;" />
                          <input name="phone_new" type="hidden" value="<?php echo ($_REQUEST['phone']); ?>"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="提交并继续" class="btn1" /></td>
                      </tr>
                    </table>
                  </form>
                  <script>
function formck(){
	var frm = document.forms['formx'];
	var sms_code = frm.elements['sms_code'].value;
	var errorMsg = '';
	if (sms_code.length == 0 ) {
		errorMsg += '* 验证码不能为空' + '\n';
	}
	if (errorMsg.length > 0){
		alert(errorMsg); return false;
	}else{  
		return true;
	}
}
</script>
  <?php else: ?>
                  <script>
function checksms(){
	
  var newphone=$("#phone").val();
  if (newphone==""){
		alert("请填写手机号码！");
		return false;
	  }
  $.get("<?php echo U('Users/checkphone');?>",{phone:newphone},function(result){
		if (result==true){
			alert("手机号码已存在！");
			return false;
		}else{
		  $.post("<?php echo U('Approve/phone_status');?>",{phone:newphone},function(data){
			  location.href='<?php echo U("Approve/phone_status","","");?>/phone/'+newphone;
		});
		}
	});
}
</script>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0"
								class="jk_tab" id="newphonetable">
                    <tr>
                      <td width="24%" align="right"><span>*</span>手机号码：</td>
                      <td width="76%" align="left"><input type="text"
										name="phone" id="phone"
										style="width: 150px; border: #BFBFBF solid 1px; height: 18px;" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="submit"
										onclick="checksms()" value="获取验证码" class="btn1" /></td>
                    </tr>
                  </table><?php endif; ?>
                <?php elseif($_G['user_info']['phone_status'] == 1): ?>
                <?php if($_REQUEST['new_phone']!= ''): ?><form action="<?php echo U('approve/phone_status');?>" method="post" name="formx" id="formx">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
									class="jk_tab" id="checksms">
                      <tr>
                        <td width="24%" align="right"><span>*</span>旧手机号码：</td>
                        <td width="76%" align="left"><span><?php echo ($_G["user_info"]["phone"]); ?><input name="phone_old" type="hidden" value="<?php echo ($_G["user_info"]["phone"]); ?>"></span></td>
                      </tr>
                      <tr>
                        <td width="24%" align="right"><span>*</span>新手机号码：</td>
                        <td width="76%" align="left"><span><?php echo ($_REQUEST['new_phone']); ?></span></td>
                      </tr>
                      <tr>
                        <td width="24%" align="right"><span>*</span>输入短信验证码：</td>
                        <td width="76%" align="left"><input type="text" name="sms_code" style="width: 150px; border: #BFBFBF solid 1px; height: 18px;" />
                          <input name="phone_new" type="hidden" value="<?php echo ($_REQUEST['new_phone']); ?>"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="提交并继续" class="btn1" /></td>
                      </tr>
                    </table>
                  </form>
                  <script>
function formck(){
	var frm = document.forms['formx'];
	var sms_code = frm.elements['sms_code'].value;
	var errorMsg = '';
	if (sms_code.length == 0 ) {
		errorMsg += '* 验证码不能为空' + '\n';
	}
	if (errorMsg.length > 0){
		alert(errorMsg); return false;
	}else{  
		return true;
	}
}
</script>
                  <?php else: ?>
                  <div class="user_main_title1"> <font color="#FF0000">*</font>您已通过手机认证！<br />
                  </div>
                  <script>
function checksms(){

  var newphone=$("#phone").val();
  if (newphone==""){
		alert("请填写手机号码！");
		return false;
	  }
	 
  $.post("<?php echo U('users/checkphone');?>",{phone:newphone},function(result){
		if (result==true){
			alert("手机号码已存在！");
			return false;
		}else{
		  $.post("<?php echo U('approve/phone_status');?>",{new_phone:newphone},function(data){
		     if (data==1){
			  location.href='<?php echo U("approve/phone_status","","");?>'+'/new_phone/'+newphone;
			  }else{
			  alert(data);
			  return false;
			  }
		  });
		}
	});
}
</script>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0"
								class="jk_tab" id="newphonetable">
                    <tr>
                      <td width="14%" align="right" style="text-align: right;"><span>*</span>新手机号码：</td>
                      <td width="76%" align="left"><input type="text"
										name="phone" id="phone"
										style="width: 150px; border: #BFBFBF solid 1px; height: 18px;" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="submit" name="submit" onclick="checksms()" value="获取验证码" class="btn1" />
                        ，验证码会发至<?php echo ($_G["user_info"]["phone"]); ?></td>
                    </tr>
                  </table><?php endif; ?>
                <elseif condition="$_G['user_info']['phone_status'] eq 2">
                <font color="#FF0000"></font>您未通过手机认证！请与管理员联系<br /><?php endif; ?>
            </div>
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