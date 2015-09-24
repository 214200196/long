<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>

<html lang="zh-cn">

<head>

<meta charset="UTF-8">

<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">

<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,user-scalable=yes">

<meta name="format-detection" content="telephone=no" />

<meta name="apple-mobile-web-app-capable" content="yes"/>

<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?><?php echo $SEO['site_title'];?></title>

<meta name="keywords" content="<?php echo $SEO['keyword'];?>">

<meta name="description" content="<?php echo $SEO['description'];?>">

<link href="css/style.css" type="text/css" rel="stylesheet" />



<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script><!--俱乐部动向JS-->

<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>

<!--[if lt IE 9]>

<script src="js/html5shiv.js"></script>

<![endif]-->

<script language="JavaScript" type="text/JavaScript">

<!--

function showdiv(targetid,objN){

   

      var target=document.getElementById(targetid);

      var clicktext=document.getElementById(objN)



            if (target.style.display=="block"){

                target.style.display="none";

                clicktext.innerText="";

  



            } else {

                target.style.display="block";

                clicktext.innerText='';

            }

   

}

-->

</script>

</head>



<body>

<?php if(!$CATEGORYS) $CATEGORYS = getcache('category_content_'.$siteid,'commons');//var_dump($CATEGORYS[7]);?>

<div class="header">

	

    	<div class="logo"><a href="http://bjczcf888.com/index.php"><img src="images/logo.png"></a></div>

        

        <ul id="nav">

            <li class="top home"><a href="http://bjczcf888.com/index.php" class="top_link"><span>首页</span></a></li>

            <li class="top"><a href="<?php echo $CATEGORYS['7']['url'];?>" class="top_link"><span <?php if($catid==7 || $catid==8 || $catid==9 || $catid==11 || $catid==12 || $catid==13 || $catid==14) { ?>class="down"<?php } ?>>关于我们</span></a>

                <ul class="sub">

                    <li class="left-nav">

                    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=22c4af3b4773e0cb53565daaf0a5009b&action=category&catid=6&siteid=%24siteid&order=listorder+ASC&return=dataa\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$dataa = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>

    					<?php $n=1;if(is_array($dataa)) foreach($dataa AS $r) { ?>

                    	<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>

                    	<?php $n++;}unset($n); ?>

                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['6']['navpic'];?>" width="210"></li>

                </ul>

            </li>

            

            <li class="top"><a href="<?php echo $CATEGORYS['16']['url'];?>" class="top_link"><span <?php if($catid==16 || $catid==17 || $catid==18 || $catid==19) { ?>class="down"<?php } ?>>业务领域</span></a>

            	<ul class="sub">

                    <li class="left-nav">

                    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=42e0eece9c352fcb8f87ad7e82c4bbe9&action=category&catid=15&siteid=%24siteid&order=listorder+ASC&return=dataa\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$dataa = $content_tag->category(array('catid'=>'15','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>

    					<?php $n=1;if(is_array($dataa)) foreach($dataa AS $r) { ?>

                    	<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>

                    	<?php $n++;}unset($n); ?>

                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['15']['navpic'];?>" width="210" height="148"></li>

                </ul>

            </li>

            <li class="top"><a href="<?php echo $CATEGORYS['20']['url'];?>" class="top_link"><span <?php if($catid==20) { ?>class="down"<?php } ?>>加盟风采</span></a>
            	<ul class="sub">

                    <li class="left-nav">

                    	

                    	<a href="<?php echo $CATEGORYS['20']['url'];?>">加盟风采</a>

                    	

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['20']['navpic'];?>" width="210" height="148"></li>

                </ul>
            </li>

            <li class="top"><a href="<?php echo $CATEGORYS['21']['url'];?>" class="top_link"><span <?php if($catid==21) { ?>class="down"<?php } ?>>成功案例</span></a>
            	<ul class="sub">

                    <li class="left-nav">

                    	

                    	<a href="<?php echo $CATEGORYS['21']['url'];?>">成功案例</a>

                    	

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['21']['navpic'];?>" width="210" height="148"></li>

                </ul>
            </li>

            <li class="top"><a href="<?php echo $CATEGORYS['28']['url'];?>" class="top_link"><span <?php if($catid==27 || $catid==28 || $catid==29) { ?>class="down"<?php } ?>>精彩视频</span></a>
            	<ul class="sub">

                    <li class="left-nav">

                    	

                    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8e5436b25a7ea52fc280042eef76cb91&action=category&catid=27&siteid=%24siteid&order=listorder+ASC&return=dataa\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$dataa = $content_tag->category(array('catid'=>'27','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>

    					<?php $n=1;if(is_array($dataa)) foreach($dataa AS $r) { ?>

                    	<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>

                    	<?php $n++;}unset($n); ?>

                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

                    	

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['27']['navpic'];?>" width="210" height="148"></li>

                </ul>
            </li>

            <li class="top"><a href="<?php echo $CATEGORYS['23']['url'];?>" class="top_link"><span <?php if($catid==23 || $catid==24 || $catid==25) { ?>class="down"<?php } ?>>资讯中心</span></a>

            	<ul class="sub">

                    <li class="left-nav">

                    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d19f7c5b59decad384108a93733c85b5&action=category&catid=22&siteid=%24siteid&order=listorder+ASC&return=dataa\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$dataa = $content_tag->category(array('catid'=>'22','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>

    					<?php $n=1;if(is_array($dataa)) foreach($dataa AS $r) { ?>

                    	<a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>

                    	<?php $n++;}unset($n); ?>

                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

                        

                    </li>                

                    <li class="rpic"><img src="<?php echo $CATEGORYS['22']['navpic'];?>" width="210" height="148"></li>

                </ul>

            </li>            

            <!--li class="top"><a href="<?php echo $CATEGORYS['30']['url'];?>" class="top_link"><span>财富论坛</span></a></li-->        

        </ul>

        <div class="top-r">

        	<div class="tel"><p class="trans">咨询热线：<br><b>400-618-6608</b></p></div>

        	<div class="kefu"><a href="tencent://message/?uin=2877810775&Menu=yes"></a></div>

            

        	<div class="sear">

            	<a id="showtext" onClick="showdiv('contentid','showtext')"></a>

                <div id="contentid" class="none">

                <form action="<?php echo APP_PATH;?>index.php" method="get" target="_blank">

				<input type="hidden" name="m" value="search"/>

				<input type="hidden" name="c" value="index"/>

				<input type="hidden" name="a" value="init"/>

				<input type="hidden" name="typeid" value="<?php echo $typeid;?>" id="typeid"/>

				<input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid"/>

                <input name="" type="submit" class="sear-tj" value=""><input name="q" id="q" type="text" class="sear-ipt" placeholder="请输入关键词" required></form></div>

            </div>

        </div>

    

</div>

<div class="cl"></div>

