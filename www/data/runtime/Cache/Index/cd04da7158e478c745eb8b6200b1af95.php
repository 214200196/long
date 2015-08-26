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
<link rel="stylesheet" href="/p2p<?php echo ($tpldir); ?>longbao/style.css" type="text/css" media="screen, projection" />
<link href="/p2p<?php echo ($tpldir); ?>css/common.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/css.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/user.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/new.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/shop.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/tipswindown.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/myinfo.css" rel="stylesheet" type="text/css" />
<link href="/p2p<?php echo ($tpldir); ?>css/css_inpage.css" rel="stylesheet" type="text/css" />
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

<?php if(!empty($_G["user_id"])): $Evar = usersClass::GetEmailActiveOne(array('user_id'=>$_G["user_id"])); ?>
  <?php if($Evar["status"] != 1): ?><script>
	window.onload=function()
	{
	 
      $('#element_to_pop_up').bPopup({
            speed: 650,
            transition: 'slideIn',
	    transitionClose: 'slideBack'
        });   
        
	setTimeout("location.href='/index/users/index.html'",2000);
	}
	</script><?php endif; endif; ?>
<div id="element_to_pop_up"> <span class="b-close">x</span>
  <div class="b_content">您还没有激活邮箱，不能进行投资</div>
  <span class="b_button"><a href="/index/users/index.html">确定</a></span> </div>
<div class="bodyer clearfix">
  <div class="form-container box980 info-list">
    <div class="ui-filter">
      <div class="ui-filter-header clearfix">
        <h4>筛选投资项目</h4>
        <div class="clear"></div>
      </div>
      <script type="text/javascript">
  function seachform_submit(borrowtype,borrowperiod,accountstatus,borrowstyle){
  document.getElementById('borrowtype').value=borrowtype;
  document.getElementById('borrowperiod').value=borrowperiod;
  document.getElementById('accountstatus').value=accountstatus;
   document.getElementById('borrowstyle').value=borrowstyle;
  document.forms.seachform.submit();
  }
  </script>
      <form action="" method="post" name="seachform">
        <input name="borrow_type" id="borrowtype" value="all" type="hidden" />
        <input name="borrow_period" id="borrowperiod" value="all" type="hidden" />
        <input name="account_status" id="accountstatus" value="all" type="hidden" />
        <input name="borrow_style" id="borrowstyle" value="all" type="hidden" />
        <ul>
          <li>
          <ul class="fn-clear">
            <li class="ui-filter-title"> 标的类型 </li>
            <li class="ui-filter-tag <?php if(($_REQUEST['borrow_type']== 'all') OR ($_REQUEST['borrow_type']== '')): ?>active<?php endif; ?>"><span onclick="seachform_submit('all','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">不限</span>
            </li>
            <li class="ui-filter-tag <?php if($_REQUEST['borrow_type']== 'credit'): ?>active<?php endif; ?>
              "> <span onclick="seachform_submit('credit','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">信用标</span> </li>
            <li class="ui-filter-tag <?php if($_REQUEST['borrow_type']== 'fast'): ?>active<?php endif; ?>
              "> <span onclick="seachform_submit('fast','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">抵押标</span> </li>
            <li class="ui-filter-tag <?php if($_REQUEST['borrow_type']== 'vouch'): ?>active<?php endif; ?>
              "> <span onclick="seachform_submit('vouch','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">担保标</span> </li>
            <li class="ui-filter-tag <?php if($_REQUEST['borrow_type']== 'flow'): ?>active<?php endif; ?>
              "> <span onclick="seachform_submit('flow','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">流转标</span> </li>
            <li class="ui-filter-tag <?php if($_REQUEST['borrow_type']== 'jin'): ?>active<?php endif; ?>
              "> <span onclick="seachform_submit('jin','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">净值标</span> </li>
          </ul>
          <div class="clear"></div>
          </li>
          <li>
            <ul class="fn-clear">
              <li class="ui-filter-title"> 借款期限 </li>
             <li class="ui-filter-tag <?php if(($_REQUEST['borrow_period']== 'all') OR ($_REQUEST['borrow_period']== '')): ?>active<?php endif; ?>">
								<span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','all','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">不限</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_period']== '1'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','1','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">3个月以下</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_period']== '2'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','2','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">3-6个月</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_period']== '3'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','3','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">6-12个月</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_period']== '4'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','4','<?php echo ($_REQUEST['account_status']); ?>','<?php echo ($_REQUEST['borrow_style']); ?>');">12个月以上</span></li>
							
            </ul>
            <div class="clear"></div>
          </li>
          <li>
            <ul class="fn-clear" >
              <li class="ui-filter-title"> 借款金额 </li>
             <li class="ui-filter-tag <?php if(($_REQUEST['account_status']== 'all') OR ($_REQUEST['account_status']== '')): ?>active<?php endif; ?>">
								<span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','all','<?php echo ($_REQUEST['borrow_style']); ?>');">不限</span></li>
							
							<li class="ui-filter-tag  <?php if($_REQUEST['account_status']== '1'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','1','<?php echo ($_REQUEST['borrow_style']); ?>');">5万元以下</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['account_status']== '2'): ?>active<?php endif; ?>" > <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','2','<?php echo ($_REQUEST['borrow_style']); ?>');">5-10万元</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['account_status']== '3'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','3','<?php echo ($_REQUEST['borrow_style']); ?>');">10-50万元</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['account_status']== '4'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','4','<?php echo ($_REQUEST['borrow_style']); ?>');">50万元以上</span></li>
							
            </ul>
            <div class="clear"></div>
          </li>
          <li>
            <ul class="fn-clear">
              <li class="ui-filter-title"> 还款方式 </li>
             <li class="ui-filter-tag <?php if(($_REQUEST['borrow_style']== 'all') OR ($_REQUEST['borrow_style']== '')): ?>active<?php endif; ?>"><span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','all');">不限</span></li>
			<li class="ui-filter-tag <?php if($_REQUEST['borrow_style']== '0'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','0');">按月等额</span></li>
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_style']== '1'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','1');">按季还款</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_style']== '2'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','2');">到期还本还息</span></li>
							
							<li class="ui-filter-tag <?php if($_REQUEST['borrow_style']== '3'): ?>active<?php endif; ?>"> <span onclick="seachform_submit('<?php echo ($_REQUEST['borrow_type']); ?>','<?php echo ($_REQUEST['borrow_period']); ?>','<?php echo ($_REQUEST['account_status']); ?>','3');">月还息到期还本</span></li>
							
            </ul>
            <div class="clear"></div>
          </li>
        </ul>
      </form>
    </div>
    <div class="guide-box">
      <h4>新手引导</h4>
      <ul>
       <?php $arlist = articlesClass::GetList(array('limit'=>'5','status'=>'1','type_id'=>'12','flag'=>'index')); ?>

       <?php if(is_array($arlist)): foreach($arlist as $key=>$var): ?><li><a href="<?php echo U('Index/index?site=xssl&id='.$var['id']);?>" target="_blank" title="<?php echo ($var["name"]); ?>"><?php echo ($var["name"]); ?></a></li><?php endforeach; endif; ?>
       
      </ul>
    </div>
  </div>
  <?php if(($_G["site_result"]["nid"]) == "invest"): $blist = borrowClass::GetList(array('is_flow'=>'2','borrow_name'=>isset($_REQUEST['borrow_name'])?$_REQUEST['borrow_name']:'','type'=>isset($_REQUEST['type'])?$_REQUEST['type']:'','flag'=>isset($_REQUEST['flag'])?$_REQUEST['flag']:'','account_status'=>isset($_REQUEST['account_status'])?$_REQUEST['account_status']:'','borrow_period'=>isset($_REQUEST['borrow_period'])?$_REQUEST['borrow_period']:'','award_status'=>isset($_REQUEST['award_status'])?$_REQUEST['award_status']:'','province'=>isset($_REQUEST['province'])?$_REQUEST['province']:'','city'=>isset($_REQUEST['city'])?$_REQUEST['city']:'','borrow_use'=>isset($_REQUEST['borrow_use'])?$_REQUEST['borrow_use']:'','epage'=>'10','order'=>isset($_REQUEST['order'])?$_REQUEST['order']:'','vouchstatus'=>isset($_REQUEST['vouchstatus'])?$_REQUEST['vouchstatus']:'','jine'=>isset($_REQUEST['jine'])?$_REQUEST['jine']:'','borrow_style'=>isset($_REQUEST['borrow_style'])?$_REQUEST['borrow_style']:'','borrow_type'=>isset($_REQUEST['borrow_type'])?$_REQUEST['borrow_type']:'','query_type'=>$_G["site_result"]["nid"])); ?>
 
  <?php else: ?>
   <?php $blist = borrowClass::GetList(array('lis_flow'=>'2','borrow_name'=>isset($_REQUEST['borrow_name'])?$_REQUEST['borrow_name']:'','type'=>isset($_REQUEST['type'])?$_REQUEST['type']:'','flag'=>isset($_REQUEST['flag'])?$_REQUEST['flag']:'','account_status'=>isset($_REQUEST['account_status'])?$_REQUEST['account_status']:'','borrow_period'=>isset($_REQUEST['borrow_period'])?$_REQUEST['borrow_period']:'','award_status'=>isset($_REQUEST['award_status'])?$_REQUEST['award_status']:'','province'=>isset($_REQUEST['province'])?$_REQUEST['province']:'','city'=>isset($_REQUEST['city'])?$_REQUEST['city']:'','borrow_use'=>isset($_REQUEST['borrow_use'])?$_REQUEST['borrow_use']:'','epage'=>'10','order'=>$_REQUEST['order'],'vouchstatus'=>isset($_REQUEST['vouchstatus'])?$_REQUEST['vouchstatus']:'','borrow_style'=>isset($_REQUEST['borrow_style'])?$_REQUEST['borrow_style']:'','jine'=>isset($_REQUEST['jine'])?$_REQUEST['jine']:'','borrow_type'=>isset($_REQUEST['borrow_type'])?$_REQUEST['borrow_type']:'','query_type'=>$_G["site_result"]["nid"])); endif; ?>
  <dl class="index-title">
    <dt class="index-titleBgf active1" ><a href="<?php echo U('Index/index?site=invest');?>" <?php if(($_G["site_result"]["nid"]) == "invest"): ?>class="hover"<?php endif; ?>>进行中的借款</a></dt>
    <dt class="index-titleBgf active2" style="margin-left:20px;"><a href="<?php echo U('Index/index?site=flow');?>"  <?php if(($_G["site_result"]["nid"]) == "flow"): ?>class="hover"<?php endif; ?>>流转借款标</a></dt>
    <dt class="index-titleBgf active3" style="margin-left:20px;"><a href="<?php echo U('Index/index?site=full_check');?>"  <?php if(($_G["site_result"]["nid"]) == "full_check"): ?>class="hover"<?php endif; ?>>复审中借款</a></dt>
    <dt class="index-titleBgf active4" style="margin-left:20px;"><a href="<?php echo U('Index/index?site=full_success');?>"  <?php if(($_G["site_result"]["nid"]) == "full_success"): ?>class="hover"<?php endif; ?>>成功借款</a></dt>
    <dt class="index-titleBgf active4" style="margin-left:20px;"><a href="<?php echo U('Index/index?site=debt');?>" >债权转让</a></dt>
    <?php if(!empty($_G["user_id"])): ?><dt class="index-titleBgf active5" style="margin-left:20px;"><a href="<?php echo U('Index/index?site=watchlist');?>"  <?php if(($_G["site_result"]["nid"]) == "watchlist"): ?>class="hover"<?php endif; ?>>我关注的标</a></dt><?php endif; ?>
  </dl>
  <ul class="invest_title">
    <li style="width:100px;" class="title_line">图片</li>
    <li style="width:210px;" class="title_line">标题/借款者/等级</li>
    <li style="width:160px;" class="title_line">借款金额/年利率</li>
    <li style="width:174px;" class="title_line">进度/剩余时间</li>
    <li style="width:174px;" class="title_line">期限/还款方式</li>
    <li style="width:160px;">状态</li>
  </ul>
  <div class="invest_list"> 
 <?php if(empty($blist["list"])): ?><div style="height:50px; font-size:24px; text-align:center; padding-top:30px;">暂无投资项目</div>
   
    <?php else: ?>
        <ul>
     <?php if(is_array($blist["list"])): foreach($blist["list"] as $key=>$var): ?><li>
        <table width="100%" border="0">
          <tr>
            <td rowspan="3" width="100"><div class="Recommend_mg2"><img src="<?php echo (avatar($var["user_id"])); ?>" width="75" height="75" /></div></td>
            <td colspan="3"><div class="user_title"><a href="<?php echo U('Index/index?site=full_success&nid='.$var['borrow_nid']);?>" title="<?php echo ($var["name"]); ?>" ><?php echo ($var["name"]); ?></a> <?php if(($var["is_jin"] != 1) AND ($var["is_flow"] != 1) AND ($var["is_Seconds"] != 1) AND ($var["vouchstatus"] != 1) AND ($var["fast_status"] != 1)): ?><img src="<?php echo ($tpldir); ?>/images/xin.jpg" /><?php endif; ?>
								<?php if($var["is_jin"] == 1): ?><img src="<?php echo ($tpldir); ?>/images/jin.gif" /><?php endif; ?>
								<?php if($var["is_flow"] == 1): ?><img
									src="<?php echo ($tpldir); ?>/images/flow.gif" /><?php endif; ?>
								<?php if($var["is_Seconds"] == 1): ?><img
									src="<?php echo ($tpldir); ?>/images/mb.gif" /><?php endif; ?>
								<?php if($var["isDXB"] == 1): ?>&nbsp;<img
									src="<?php echo ($tpldir); ?>/images/lock.gif" /><?php endif; ?>
								<?php if($var["vouchstatus"] == 1): ?>&nbsp;<img
									src="<?php echo ($tpldir); ?>/images/ico_dbao.gif"><?php endif; ?>
								<?php if($var["fast_status"] == 1): ?>&nbsp;<img
									src="<?php echo ($tpldir); ?>/images/ico_ks.gif"><?php endif; ?>
								<?php if($var["award_status"] > 0): ?>&nbsp;<img
									src="<?php echo ($tpldir); ?>/images/jiangli.gif" /><?php endif; ?>
								<?php if($var["recommend"] == 1): ?>&nbsp;<img
									src="<?php echo ($tpldir); ?>/images/tuijian.jpg" /><?php endif; ?></div></td>
          </tr>
          <tr>
            <td width="210">发布者：<strong><?php echo ($var["nikename"]); ?></strong></td>
            <td width="180">借款金额：<strong>￥<?php echo ($var["account"]); ?></strong>元</td>
            <td width="180">剩余时间：
             <?php $var_borrow = borrowClass::GetDetail(array('borrow_nid'=>$var["borrow_nid"],'hits'=>'auto')); ?>
           
            <?php if($var_borrow['borrow']['status'] == 0): ?>审核中<?php elseif($var_borrow['borrow']['status'] == 1): ?>
							<span name="endtime"><?php echo ($var_borrow["borrow"]["borrow_other_time"]); ?></span>
							<?php elseif($var_borrow['borrow']['status'] == 2): ?>审核失败<?php elseif(($var_borrow['borrow']['status'] == 3) AND ($var_borrow['borrow']['repay_account_wait'] == 0)): ?>已还完<?php elseif(($var_borrow['borrow']['status'] == 3) AND ($var_borrow['borrow']['repay_account_wait'] != 0)): ?>还款中<?php elseif($var_borrow['borrow']['status'] == 5): ?>流标<?php else: ?>未知状态<?php endif; ?>
             </td>
            <td width="190">借款期限：<?php echo (linkages("borrow_period",$var["borrow_period"])); ?></td>
            <td rowspan="2"><a href="<?php echo U('Index/index?site=full_success&nid='.$var['borrow_nid']);?>">
             <?php if($var["status"] == 1): if(($var["borrow_account_wait"]) == "0"): ?><img
									src="<?php echo ($tpldir); ?>/images/list_094.jpg" /> <?php else: ?> <img
									src="<?php echo ($tpldir); ?>/images/list_091.jpg" /><?php endif; ?> <?php elseif($var["status"] == 3): ?> <?php if(($var["repay_account_wait"]) == "0"): ?><img
									src="<?php echo ($tpldir); ?>/images/list_092.jpg" /> <?php else: ?> <img
									src="<?php echo ($tpldir); ?>/images/list_09.jpg" /><?php endif; ?> <?php else: ?>
								<?php if(($var["status"]) == "5"): ?><img
									src="<?php echo ($tpldir); ?>/images/list_095.jpg" /> <?php else: ?> <img
									src="<?php echo ($tpldir); ?>/images/list_093.jpg" /><?php endif; endif; ?></a></td>
          </tr>
          <tr>
            <td width="200">信用等级：<?php echo (credit("credit",$var["credit"]["approve_credit"])); ?></td>
            <td>年利率：<strong><?php echo ($var["borrow_apr"]); ?>%</strong></td>
            <td><span class="jdt"><i  style="width:<?php echo ($var["borrow_account_scale"]); ?>%;"></i></span> <?php echo ($var["borrow_account_scale"]); ?>%</td>
            <td>赎回方式： <?php echo (linkages("borrow_style",$var["borrow_style"])); ?></td>
          </tr>
          <tr>
            <td></td>
            <td>投标奖励：<?php if($var["award_status"] == 1): echo ($var["award_account"]); elseif($var["award_status"] == 2): echo ($var["award_scale"]); ?>%<?php else: ?>0<?php endif; ?></td>
          </tr>
        </table>
      </li><?php endforeach; endif; ?>
      <div class="page"><?php echo ($page); ?></div>
    </ul><?php endif; ?> </div>
 </div>
<div class="footer">
  <div class="footer_con">
    <div class="footer_top">
    <div style="float: left;width:233px;_display: inline;">
     <div class="footer_logo" style="width:100%;_display: inline;"><img src="/p2p/<?php echo ($tpldir); ?>images/footlogo.png"/></div>
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
      
      <div class="footer_top_kefu1"> <img src="/p2p/<?php echo ($tpldir); ?>longbao/images/weixin.jpg" width="117 "/> </div>
      </div>
      <div class="copyright_main"> <span>地址：<?php echo ($_G["system"]["con_compAddress"]); ?>;<?php echo ($_G["system"]["con_recordInfo"]); ?>;<?php echo ($_G["system"]["con_beian"]); echo (htmlspecialchars_decode($_G["system"]["con_tongji"])); ?></span> </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!--footer部分结束--> 
</body></html>