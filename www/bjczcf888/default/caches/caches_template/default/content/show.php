<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['22']['image'];?>) center no-repeat;"></div>

<div class="sub-top">
	<div class="box"><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e7080aae27e99e309cf7633a4dc6fad5&action=category&catid=22&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'22','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="box">
	<h1 class="show-tit mt50"><?php echo $title;?></h1>
    <h2 class="show-bot"><img src="images/ico-5.png"> 财富发表 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/ico-6.png"> <?php echo $inputtime;?></h2>
    <div class="content">
    <?php echo $content;?>

    </div>
    <div class="show-fx">
    	<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>

    </div>
    <div class="show-pages">
    	<a href="<?php echo $previous_page['url'];?>">上一个：<?php echo $previous_page['title'];?></a><br>
        <a href="<?php echo $next_page['url'];?>">下一个：<?php echo $next_page['title'];?></a>
        <div class="back"><a href="<?php echo $CATEGORYS[$catid]['url'];?>"><img src="images/back.png"></a></div>
    </div>
</div>
<?php include template("content","footer"); ?>