<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>

<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['6']['image'];?>) center no-repeat;"></div>

<div class="sub-top">

	<div class="box">    

	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eda9221ec64ad4126ca091eb7a2c267a&action=category&catid=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>

    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>

</div>

<div class="box">

	<div class="team-top"><?php echo $CATEGORYS['6']['description'];?></div>

	<div class="list-team">

    	<ul>

        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=adcf9fcddba77bae6364552df5b04375&action=lists&catid=%24catid&num=20&order=listorder+DESC&moreinfo=1&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 20;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>

            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

        	<li>

            	<div class="left-info">

                	<div class="tit"><?php echo $r['title'];?></div>

                    <div class="entit"><?php echo $r['entit'];?></div>

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