<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>
<div class="sub-banner" style="background:url(<?php echo $CATEGORYS['6']['image'];?>) center no-repeat;"></div>
<div class="sub-top">
	<div class="box">    
	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=eda9221ec64ad4126ca091eb7a2c267a&action=category&catid=6&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'6','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'20',));}?>
    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?><a href="<?php echo $r['url'];?>" <?php if($catid==$r[catid] || $top_parentid==$r[catid]) { ?> class="cur"<?php } ?>><?php echo $r['catname'];?></a><?php $n++;}unset($n); ?><?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?></div>
</div>
<div class="home-maps">
	<div id="map" class="map"></div>
    <div class="foot-map">
    	<div class="home-foot-tel">
        	<div class="tel-box">
            	<div class="tit">联系方式</div>
                <div class="name">北京创造财富科技有限公司</div>
                <span><img src="images/tel-ico-1.png"> 地址：北京市丰台区广安路9号国投财富广场3号楼708</span>
                <span><img src="images/tel-ico-2.png"> 公司总机：8610-6325-9459</span>
                <span><img src="images/tel-ico-3.png"> 客服热线：400-618-6608</span>
                <span><img src="images/tel-ico-4.png"> 微信公众号：chuangzaocf</span>
                <span><img src="images/tel-wx.png" />扫一扫关注官方微信</span>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=700b132845ef5b0b135066dfa0222a37"></script> 

<script>

var map = new BMap.Map("map");

var point = new BMap.Point(116.329835,39.896156);

map.centerAndZoom(point,18);

var  mapStyle = {style:"white"};

map.setMapStyle(mapStyle);


map.addControl(new BMap.NavigationControl());

var pt = new BMap.Point(116.329835,39.896156);


var icon = new BMap.Icon("images/ico-11.png", new BMap.Size(72,81), {'anchor':new BMap.Size(16,81)});

var marker = new BMap.Marker(pt,{icon:icon});
map.addOverlay(marker);
</script> 


<div id="BgBox" style="height: 968px; display: none;"></div>
<?php include template("content","footer"); ?>