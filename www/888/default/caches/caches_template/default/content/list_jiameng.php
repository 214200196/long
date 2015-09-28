<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['20']['image'];?>) center no-repeat;"></div>

<div class="sub-top">
	<div class="box"><a href="<?php echo $CATEGORYS['20']['url'];?>" class="cur"><?php echo $CATEGORYS['20']['catname'];?></a></div>
</div>
<div class="box">
	
	<div class="list-case">
    	<ul>
        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e680cce3e8f1840c77a33557443ea9a6&action=lists&catid=%24catid&num=4&order=listorder+DESC&moreinfo=1&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 4;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = pages($content_total, $page, $pagesize, $urlrule);$data = $content_tag->lists(array('catid'=>$catid,'order'=>'listorder DESC','moreinfo'=>'1','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
        	<li>
            	<div class="left-info">
                	<p class="t"><a href="<?php echo $r['url'];?>"><?php echo $r['title'];?></a></p>
                    <p class="time"><img src="images/ico-7.png"> <?php echo date('Y-m-d',$r[inputtime]);?></p>
                    <p class="con"><?php echo $r['description'];?>…</p>
                    <p class="more"><a href="<?php echo $r['url'];?>" class="amore3">查看更多</a></p>
                </div>
                <div class="pic"><a href="<?php echo $r['url'];?>"><img src="<?php echo $r['thumb'];?>"></a></div>
            </li>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
            
        </ul>
    </div>
	<div class="pages"><?php echo $pages;?></div>
</div>
<?php include template("content","footer"); ?>