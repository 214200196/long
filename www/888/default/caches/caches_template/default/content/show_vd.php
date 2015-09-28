<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['27']['image'];?>) center no-repeat;"></div>

<div class="sub-top">
	<div class="box">
    
<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=158336c0af96f4b9be6eeac92ac981ee&action=category&catid=27&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'27','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
		
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="vd-box">
	<div class="vd-player" style="text-align:center;">
<script type="text/javascript" src="CuPlayer/images/swfobject.js"></script>
<div class="video" id="CuPlayer">
<strong>提示：您的Flash Player版本过低，请升级！</strong></div>
<script type="text/javascript">
var so = new SWFObject("CuPlayer/CuPlayerMiniV4.swf","CuPlayerV4","600","410","9","#000000");
so.addParam("allowfullscreen","true");
so.addParam("allowscriptaccess","always");
so.addParam("wmode","opaque");
so.addParam("quality","high");
so.addParam("salign","lt");
so.addVariable("CuPlayerSetFile","CuPlayer/CuPlayerSetFile.php"); //播放器配置文件地址,例SetFile.xml、SetFile.asp、SetFile.php、SetFile.aspx
so.addVariable("CuPlayerFile","http://demo.cuplayer.com/file/test.mp4"); //视频文件地址
so.addVariable("CuPlayerImage","<?php echo $thumb;?>");//视频略缩图,本图片文件必须正确
so.addVariable("CuPlayerWidth","600"); //视频宽度
so.addVariable("CuPlayerHeight","410"); //视频高度
so.addVariable("CuPlayerAutoPlay","yes"); //是否自动播放
so.addVariable("CuPlayerLogo",""); //Logo文件地址
so.addVariable("CuPlayerPosition","bottom-right"); //Logo显示的位置
so.write("CuPlayer");
</script>
    </div>
    <div class="vd-tit"><?php echo $title;?></div>
</div>
<?php include template("content","footer"); ?>