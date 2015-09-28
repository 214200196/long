<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['22']['image'];?>) center no-repeat;"></div>

<div class="sub-top">
	<div class="box"><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e7080aae27e99e309cf7633a4dc6fad5&action=category&catid=22&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'22','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="box">
	
	<div class="home-case-list mt40">
            <ul>
            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=f79a9140b5927bbf23ca00678ac8bb47&action=lists&catid=%24catid&num=6&order=listorder+DESC&moreinfo=1&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 6;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <li class="trans">
                    <div class="pic"><img src="<?php echo $r['thumb'];?>" width="324" height="234"><p class="trans"><a href="<?php echo $r['url'];?>"></a></p></div>
                    <div class="tit trans"><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></div>
                    <div class="titbg trans"></div>
                </li>
                <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                
            </ul>
        </div>
	<div class="pages"><?php echo $pages;?></div>
</div>
<?php include template("content","footer"); ?>