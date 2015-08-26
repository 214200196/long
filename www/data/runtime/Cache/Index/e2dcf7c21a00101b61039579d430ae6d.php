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

<div class="full_banner">
  <div class="bd">
    <ul>  <?php $scrollpic = scrollpicClass::GetList(array('limit'=>'6','status'=>'1','type_id'=>'1')); ?>
      <?php if(is_array($scrollpic)): foreach($scrollpic as $key=>$var): ?><li style="background:url(<?php echo ($var["pic"]); ?>) no-repeat center 0px"> <a href="<?php echo ($var["url"]); ?>" target="_blank"></a> </li><?php endforeach; endif; ?>
     
    </ul>
  </div>
  <div class="hd">
    <ul>
    </ul>
  </div>
</div>
<script type="text/javascript">
                 
                    $(function(){
                        jQuery(".full_banner").slide({
                           titCell:".hd ul", 
                           mainCell:".bd ul", 
                           effect:"fold",  
                           autoPlay:true, 
                           autoPage:true,
                           trigger:"click",
                           interTime:3500
                        }); 
                    });
                </script>
</div>

</div>
<div class="warp">
  <div style="border-bottom:1px solid #e5e5e5">
    <div class="main_top">
      <div  class="main_top_first">
        <div class="main_top_first_left"> <span>创造财富能为您做什么呢？</span> </div>
        <div class="main_top_first_right">
          <div class="more"><a href="<?php echo U('Index/index?site=invest');?>">马上理财</a></div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="main_top_last_left"> <span>创造财富提供安全、有担保、高收益的互联网理财服务。通过创造财富的推荐，您可以将手中的富余资金出借给由小额贷款金融机构担保的、信用良好的小微企业，并获得利息回报。</span> <span><a href="<?php echo U('Index/index?site=gsjj');?>" class="look_more">了解更多&gt;</a></span> </div>
      <div class="main_top_last_right">
        <div class="main_top_last_right_left">
         <?php $uservar = borrowClass::Getuser_zong(); ?>
 <?php $umuns = usersClass::GetUsersList(); ?>
          <dl>
            <dt><span> <?php echo ($umuns["total"]); ?>                                      位</span></dt>
            <dd><span>聪明的投资人已经加入创造财富</span></dd>
          </dl>
        </div>
        <div class="main_top_last_right_right">
          <dl>
            <dt><span><?php echo ($uservar["borrow_all"]); ?>元</span></dt>
            <dd><span>投资已经在创造财富完成</span></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="show_title">
      <dl>
        <dt><a href="<?php echo U('Index/index?site=invest');?>"><img src="<?php echo ($tpldir); ?>images/title_show_r1_c1.jpg"></a></dt>
        <dd>年化收益率12~18%远超银行定期</dd>
      </dl>
      <dl>
        <dt><a href="<?php echo U('Index/index?site=fxgk');?>"><img src="<?php echo ($tpldir); ?>images/title_show_r1_c3.jpg"></a></dt>
        <dd>逾期赔付,笔笔有保障</dd>
      </dl>
      <dl>
        <dt><a href="<?php echo U('Index/index?site=invest');?>"><img src="<?php echo ($tpldir); ?>images/title_show_r1_c5.jpg"></a></dt>
        <dd>100起投提现最快2小时到账</dd>
      </dl>
      <dl>
        <dt><a href="<?php echo U('Index/index?site=gsjj');?>"><img src="<?php echo ($tpldir); ?>images/title_show_r1_c7.jpg"></a></dt>
        <dd>我们是最专业的投资理财金融平台</dd>
      </dl>
      <div class="clear"></div>
    </div>
    <div id="cont_left">
      <div class="ad_box">
     
        <dl>
          <dt>总待回收金额</dt>
          <dd>￥<?php echo ((isset($uservar["borrow_repay_late_not"]) && ($uservar["borrow_repay_late_not"] !== ""))?($uservar["borrow_repay_late_not"]):0); ?>元</dd>
        </dl>
        <dl>
          <dt>累计创造收益</dt>
          <dd>￥<?php echo ($uservar["Total_revenue"]); ?>元</dd>
        </dl>
 
        
      </div>
      <div>
        <div id="tab">
          <div class="tabList">
            <ul>
              <li class="cur">投资列表</li>
            </ul>
          </div>
          <div class="tabCon">
            <div class="" style="display:block;">
              <p  class="ad_gonggao"> <span>抢不到标？建议您设置 <strong><img src="<?php echo ($tpldir); ?>images/zidong.fw.png">自动投标</strong> 增加成功投标概率！</span> </p>
              <table id="tablebox" class="table table-condensed">
                <thead>
                  <tr>
                    <th style="text-align:left;padding-left:15px">项目</th>
                    <th>借款金额</th>
                    <th>年利率</th>
                    <th>期限</th>
                    <th>发布时间</th>
                    <th>进度</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php $blist = borrowClass::GetList(array('order'=>'index','limit'=>'5','is_flow'=>'2','query_type'=>'tender_now')); ?>
      <?php if(is_array($blist)): foreach($blist as $key=>$var): ?><tr>
                    <td class="itemname" style="width:195px;"><a href="<?php echo U('Index/index?site=full_success&nid='.$var['borrow_nid']);?>"><?php echo ($var["name"]); ?></a><?php if(($var["is_jin"] != 1) AND ($var["is_flow"] != 1) AND ($var["is_Seconds"] != 1) AND ($var["vouchstatus"] != 1) AND ($var["fast_status"] != 1) ): ?><img src="<?php echo ($tpldir); ?>images/xin.jpg"   /><?php endif; if(($var["is_jin"]) == "1"): ?><img src="<?php echo ($tpldir); ?>images/jin.gif"   /><?php endif; if(($var["is_flow"]) == "1"): ?><img src="<?php echo ($tpldir); ?>images/flow.gif"   /><?php endif; if(($var["is_Seconds"]) == "1"): ?><img src="<?php echo ($tpldir); ?>images/mb.gif"   /><?php endif; if(($var["isDXB"]) == "1"): ?>&nbsp;<img src="<?php echo ($tpldir); ?>images/lock.gif"   /><?php endif; if(($var["vouchstatus"]) == "1"): ?>&nbsp;<img src="<?php echo ($tpldir); ?>images/ico_dbao.gif"  ><?php endif; if(($var["fast_status"]) == "1"): ?>&nbsp;<img src="<?php echo ($tpldir); ?>images/ico_ks.gif" ><?php endif; if(($var["award_status"]) > "0"): ?>&nbsp;<img src="<?php echo ($tpldir); ?>images/jiangli.gif"   /><?php endif; if(($var["recommend"]) == "1"): ?>&nbsp;<img src="<?php echo ($tpldir); ?>images/tuijian.jpg"   /><?php endif; ?></td>
                    <td style="width:115px">￥<?php echo ($var["account"]); ?></td>
                    <td class="add_lilv" style="width:65px"><?php echo ($var["borrow_apr"]); ?>%</td>
                    <td style="width:70px"> <?php echo (linkages("borrow_period",$var["borrow_period"])); ?> </td>
                    <td style="width:100px"><?php echo (date("Y-m-d",$var["verify_time"])); ?></td>
                    <td class="add_jindu" ><span class="jdt" style="margin-top:10px"> <i  style="width: <?php echo ($var["borrow_account_scale"]); ?>%;"></i></span><span class="progress_text"><?php echo ($var["borrow_account_scale"]); ?>%</span></td>
                    <td> <a href="<?php echo U('Index/index?site=full_success&nid='.$var['borrow_nid']);?>">
                                  <?php if($var["status"] == 1): if(($var["borrow_account_wait"]) == "0"): ?><img src="<?php echo ($tpldir); ?>images/list_094.jpg" />
                                     <?php else: ?>
                                     <img src="<?php echo ($tpldir); ?>images/list_091.jpg" /><?php endif; ?>
                                <?php elseif($var["status"] == 3): ?> 
                                       <?php if(($var["repay_account_wait"]) == "0"): ?><img src="<?php echo ($tpldir); ?>images/list_092.jpg"   />
                                       <?php else: ?>
                                       <img src="<?php echo ($tpldir); ?>images/list_09.jpg" /><?php endif; ?>
                                    <?php else: ?>
                                      <?php if(($var["status"]) == "5"): ?><img src="<?php echo ($tpldir); ?>images/list_095.jpg" />
                                        <?php else: ?>
                                           <img src="<?php echo ($tpldir); ?>images/list_093.jpg" /><?php endif; endif; ?>
                                    </a></td>
                  </tr><?php endforeach; endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="cont_right">
      <div class="com_news">
        <div id="table">
          <div class="tabList">
            <ul>
              <li class="cur">最新公告</li>
              <li class="">行业资讯</li>
            </ul>
          </div>
          <div class="tablecon">
            <div class="" style="display:block;">
              <ul>
               <?php $loop = articlesClass::GetList(array('epage'=>'5','type_id'=>'6')); ?>
          <?php if(is_array($loop["list"])): foreach($loop["list"] as $key=>$var): ?><li><a href="<?php echo U('Index/index?site=notice&id='.$var['id']);?>"><?php echo ($var["name"]); ?></a></li><?php endforeach; endif; ?>
              </ul>
              <span style="text-align:right;line-height:30px;padding-right:15px;font-size:12px;display:block"><a href="<?php echo U('Index/index?site=notice');?>">查看更多...</a></span> </div>
            <div class="" style="display:none;">
              <ul>
             <?php $loop = articlesClass::GetList(array('epage'=>'5','type_id'=>'43')); ?>
          <?php if(is_array($loop["list"])): foreach($loop["list"] as $key=>$var): ?><li><a href="<?php echo U('Index/index?site=hyzx&id='.$var['id']);?>"><?php echo ($var["name"]); ?></a></li><?php endforeach; endif; ?>
              </ul>
              <span style="text-align:right;line-height:30px;padding-right:15px;font-size:12px;display:block"><a href="<?php echo U('Index/index?site=hyzx');?>">查看更多...</a></span> </div>
          </div>
        </div>
      </div>
      <div class="com_news" id="tab_news">
        <div class="active">常见问题</div>
        <ul style="display:block">
         <?php $loop = articlesClass::GetList(array('epage'=>'5','type_id'=>'10')); ?>
        
           <?php if(is_array($loop["list"])): foreach($loop["list"] as $key=>$var): ?><li><a href="<?php echo U('Index/index?site=jrcs&id='.$var['id']);?>"><?php echo ($var["name"]); ?></a></li><?php endforeach; endif; ?>
          <span style="text-align:right;line-height:30px;padding-right:15px;font-size:12px;display:block"><a href="<?php echo U('Index/index?site=jrcs');?>">查看更多...</a></span>
        </ul>
        <div >公司新闻</div>
        <ul style="display:none">
           <?php $loop = articlesClass::GetList(array('epage'=>'5','type_id'=>'42')); ?>
        <?php if(is_array($loop["list"])): foreach($loop["list"] as $key=>$var): ?><li><a href="<?php echo U('Index/index?site=gsxw&id='.$var['id']);?>"><?php echo ($var["name"]); ?></a></li><?php endforeach; endif; ?>
          <span style="text-align:right;line-height:30px;padding-right:15px;font-size:12px;display:block"><a href="<?php echo U('Index/index?site=gsxw');?>">查看更多...</a></span>
        </ul>
      
       
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="main_footer"> <span>友情链接</span>
  <div class="main_footer_tu">
    <ul>
      <?php $loop = linksClass::GetList(array('epage'=>'10','status'=>'1')); ?>
        <?php if(is_array($loop["list"])): foreach($loop["list"] as $key=>$var): ?><li><a href="<?php echo ($var["url"]); ?>"><?php echo ($var["webname"]); ?></a></li><?php endforeach; endif; ?>
    </ul>
  </div>
  <div class="clear"></div>
</div>

<script>
window.onload = function() {
    var oDiv = document.getElementById("tab");
    var oDiv1 = document.getElementById("table");
    function showtab(addId)
    {

	    var oLi = addId.getElementsByTagName("div")[0].getElementsByTagName("li");
	    var aCon = addId.getElementsByTagName("div")[1].getElementsByTagName("div");
	    var timer = null;
	    for (var i = 0; i < oLi.length; i++) {
	        oLi[i].index = i;
	        
	        oLi[i].onclick = function() {
	            show(this.index);
	        }
	    }
	    function show(a) {
	        index = a;
	        var alpha = 0;
	        for (var j = 0; j < oLi.length; j++) {
	            oLi[j].className = "";
	            aCon[j].className = "";
	            aCon[j].style.display = 'none';
	        
	        }
	        oLi[index].className = "cur";
	        clearInterval(timer);
	        timer = setInterval(function() {
	       
	            aCon[index].style.display ='block';
	        
	        },
	        5)
	    }
    }
    showtab(oDiv);
    showtab(oDiv1);

	
		var odiv=document.getElementById('tab_news');   
		var obtn=odiv.getElementsByTagName('div');     
		var div_list=odiv.getElementsByTagName('ul');   
			
			function tabList(Obtn,currtClass,OdivList){
				
				for(var i=0;i<Obtn.length;i++){                     
				
					Obtn[i].index=i;                                 
					
					Obtn[i].onclick=function(){                        
						
						for(var i=0;i<Obtn.length;i++){                 
							
							Obtn[i].className='';                     
							
							OdivList[i].style.display='none';           
						} 
						
					    this.className=currtClass;
					    
						OdivList[this.index].style.display='block';
					}	
				}
			}
	
	    
			
			tabList(obtn,'active',div_list); 

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