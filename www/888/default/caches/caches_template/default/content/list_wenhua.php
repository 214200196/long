<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['6']['image'];?>) center no-repeat;"></div>

<div class="sub-top">
	<div class="box">
    
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eda9221ec64ad4126ca091eb7a2c267a&action=category&catid=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
		
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="box">
	
	<div class="list-wenhua">
    	<ul>
        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=56aec7b19d28fd3d14930eaeff9cc5b1&action=lists&catid=%24catid&num=25&order=id+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>$catid,'order'=>'id DESC','moreinfo'=>'1','limit'=>'25',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        	<li>
            	<div class="left-info">
                	
                    <div class="con">
                    	<?php echo $r['content'];?>
                    	
                    </div>
                    
                </div>
                <div class="pic"><img src="<?php echo $r['thumb'];?>"></div>
            </li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            
        </ul>
    </div>
</div>
<?php include template("content","footer"); ?>