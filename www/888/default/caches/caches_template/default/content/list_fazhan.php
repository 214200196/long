<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['6']['image'];?>) center no-repeat;"></div>

<script type="text/javascript" src="js/jquery.timelinr-0.9.53.js"></script>
<script type="text/javascript">
$(function(){
    $().timelinr({
		autoPlay: 'false',
		autoPlayDirection: 'forward',
		startAt: 1
	})
});
</script>

<div class="sub-top">
	<div class="box">    
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eda9221ec64ad4126ca091eb7a2c267a&action=category&catid=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="box">
	<div class="fz-tit">发展<p>中国最专业的金融品牌与科技服务商</p></div>
	<div id="timeline">
           		<ul id="dates">
                	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=266aebf9c2153e5f774233c0f0c41003&action=lists&catid=%24catid&num=200&order=listorder+asc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder asc','limit'=>'200',));}?>
           	 		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
               		<li><a href="#<?php echo $r['title'];?>"><?php echo $r['title'];?></a></li>
                    <?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </ul>
               <ul id="issues">
               		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eab1ec424ae02b3e79bada1cf7c0a980&action=lists&catid=%24catid&num=200&order=listorder+asc&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder asc','moreinfo'=>'1','limit'=>'200',));}?>
           	 		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                  	<li id="<?php echo $r['title'];?>">
                  		<div class="pic"><img src="<?php echo $r['thumb'];?>"></div>
                  		<div class="con">
                        <?php echo $r['content'];?>                    
                        </div>
                   </li>
                   <?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
               </ul>
            </div>
</div>
<?php include template("content","footer"); ?>