<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['6']['image'];?>) center no-repeat;"></div>
<div class="sub-top">
	<div class="box">
    
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eda9221ec64ad4126ca091eb7a2c267a&action=category&catid=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
		
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="box">
	<div class="about-img"><img src="<?php echo $CATEGORYS['7']['image'];?>" width="488"></div>
    <div class="about-rinfo">
    	<div class="tit"><?php if($catid==6) { ?><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=b4812563cb2c833173ea63276af77408&sql=SELECT+%2A+FROM+v9_page+where+catid%3D7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid=7 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                  <?php $n=1;if(is_array($data)) foreach($data AS $val) { ?>
                  <?php echo $val['title'];?>
                 <?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?><?php } else { ?><?php echo $title;?><?php } ?></div>
        <div class="entit">Pioneering innovation, integrity and pragmatic, fine service</div>
        <div class="con">
        <?php if($catid==6) { ?>
        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=b4812563cb2c833173ea63276af77408&sql=SELECT+%2A+FROM+v9_page+where+catid%3D7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid=7 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>
                  <?php $n=1;if(is_array($data)) foreach($data AS $val) { ?>
                  <?php echo $val['content'];?>
                 <?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
        	 <?php } else { ?><?php echo $content;?><?php } ?>

        </div>
    </div>
</div>
<?php include template("content","footer"); ?>