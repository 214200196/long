<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","header"); ?>

<div class="banner-box">

	<div class="bd">

        <ul>      

        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"slider\" data=\"op=slider&tag_md5=b683cc62776609bdbdf0e81709418ee8&action=lists&postion=53&siteid=%24siteid&order=desc&num=3\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$slider_tag = pc_base::load_app_class("slider_tag", "slider");if (method_exists($slider_tag, 'lists')) {$data = $slider_tag->lists(array('postion'=>'53','siteid'=>$siteid,'order'=>'desc','limit'=>'3',));}?>

            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>    	    

            <li style="background:url(<?php echo $r['image'];?>) center no-repeat;"><a href="<?php echo $r['url'];?>"></a></li>

            <?php $n++;}unset($n); ?>

			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

            

        </ul>

    </div>

    <div class="banner-btn">

        <a class="prev" href="javascript:void(0);"></a>

        <a class="next" href="javascript:void(0);"></a>

        <div class="hd"><ul></ul></div>

    </div>

    

</div>

<script type="text/javascript">

$(document).ready(function(){



	$(".prev,.next").hover(function(){

		$(this).stop(true,false).fadeTo("show",1);

	},function(){

		$(this).stop(true,false).fadeTo("show",1);

	});

	

	$(".banner-box").slide({

		titCell:".hd ul",

		mainCell:".bd ul",

		effect:"fold",

		interTime:5000,

		delayTime:500,

		autoPlay:true,

		autoPage:true, 

		trigger:"click" 

	});



});

</script>



<div class="cl"></div>

<div class="box">

	<div class="home-tit mt50"><img src="images/t-1.png"></div>

    <div class="home-yw-list mt40">

    	<ul>

        	<li>            	

            	<div class="yw-con trans">
					<a href="<?php echo $CATEGORYS['16']['url'];?>">
                	<div class="pic"><img src="images/yw-ico-1.png"></div>

                    <div class="tit">金融品牌加盟<p>线上加盟、线下加盟</p></div>
					</a>
                </div>

                <div class="more trans"><a href="<?php echo $CATEGORYS['16']['url'];?>">业务详情</a></div>                

            </li>

            <li>            	

            	<div class="yw-con trans">
					<a href="<?php echo $CATEGORYS['17']['url'];?>">
                	<div class="pic"><img src="images/yw-ico-2.png"></div>

                    <div class="tit">P2P平台建设<p>P2P网贷系统</p></div>
					</a>
                </div>

                <div class="more trans"><a href="<?php echo $CATEGORYS['17']['url'];?>">业务详情</a></div>                

            </li>

            <li>            	

            	<div class="yw-con trans">
					<a href="<?php echo $CATEGORYS['18']['url'];?>">
                	<div class="pic"><img src="images/yw-ico-3.png"></div>

                    <div class="tit">APP定制开发<p>android系统、ios系统</p></div>
					</a>
                </div>

                <div class="more trans"><a href="<?php echo $CATEGORYS['18']['url'];?>">业务详情</a></div>                

            </li>

            <li>            	

            	<div class="yw-con trans">
					<a href="<?php echo $CATEGORYS['19']['url'];?>">
                	<div class="pic"><img src="images/yw-ico-4.png"></div>

                    <div class="tit">企业推广营销<p>全方位企业营销解决方案</p></div>
					</a>
                </div>

                <div class="more trans"><a href="<?php echo $CATEGORYS['19']['url'];?>">业务详情</a></div>                

            </li>

        </ul>

    </div>

</div>

<div class="cl"></div>

<div class="home-about mt50" style="background:url(images/home-about-bg.jpg) top center no-repeat #F5F5F5">

	<div class="box">

    	<div class="home-tit mt50"><img src="images/t-2.png"></div>

        <div class="home-about-pic mt40 fl">

        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3f426ff9c983d6fa35556582a3bb75ec&action=position&posid=5&num=1&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'5','order'=>'listorder DESC','limit'=>'1',));}?>

            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

        <img src="<?php echo $r['thumb'];?>" width="550" height="422"><p><a href="<?php echo $r['url'];?>"></a></p>

         <?php $n++;}unset($n); ?>

            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

        <span></span></div>

        <div class="home-about-con mt40 fr">

        	<div class="tit"><?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=b4812563cb2c833173ea63276af77408&sql=SELECT+%2A+FROM+v9_page+where+catid%3D7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid=7 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>

                  <?php $n=1;if(is_array($data)) foreach($data AS $val) { ?>

                  <?php echo $val['title'];?>

                 <?php $n++;}unset($n); ?>

				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?><p>Professional and reliable</p></div>

            <div class="con" style="height:150px;">

            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"get\" data=\"op=get&tag_md5=b4812563cb2c833173ea63276af77408&sql=SELECT+%2A+FROM+v9_page+where+catid%3D7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}pc_base::load_sys_class("get_model", "model", 0);$get_db = new get_model();$r = $get_db->sql_query("SELECT * FROM v9_page where catid=7 LIMIT 20");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$data = $a;unset($a);?>

                  <?php $n=1;if(is_array($data)) foreach($data AS $val) { ?>

                  <?php echo $val['content'];?>。。。

                 <?php $n++;}unset($n); ?>

				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

            ...

            </div>

            <div class="more"><a href="<?php echo $CATEGORYS['7']['url'];?>" class= "amore2 fl" >查看详情</a></div>

        </div>

    </div>

    <div class="cl"></div>

    <div class="box">

        <div class="home-tit mt40"><img src="images/t-3.png"><a href="<?php echo $CATEGORYS['21']['url'];?>" class="amore4 fr">查看更多</a></div>

        <div class="home-case-list mt40">

            <ul>

            	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=586daf59b2965d3d67a3d42c20c8f5fd&action=lists&catid=21&num=3&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'21','order'=>'listorder DESC','limit'=>'3',));}?>



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

    </div>

    <div class="cl"></div>

</div>

<div class="box">

		

    	<div class="home-tit mt50"><img src="images/t-4.png"></div>
		<div class="picScroll-left">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3bc1b6b8f342ae3be7f571e2a147f380&action=lists&catid=20&num=5&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'20','order'=>'listorder DESC','limit'=>'5',));}?>



        				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                        <li>
                        	<div class="home-about-pic mt40 fr"><img src="<?php echo $r['thumb'];?>" width="550" height="422"></div>

                                <div class="home-about-con mt40 fl bg-gray">
                        
                                    <div class="tit"><?php echo $r['title'];?><p><?php echo date('Y / m / d',$r[inputtime]);?></p></div>
                        
                                    <div class="con">
                        
                                    <?php echo str_cut($r[description],220);?>...
                        
                                    </div>
              
                                    <div class="more"><a href="<?php echo $r['url'];?>" class="amore2 fl" style="margin-right:10px;">查看详情</a> 
						      <a href="<?php echo $CATEGORYS[20][url];?>" class="amore2 fl">更多加盟商</a></div>
                        
                                </div>
                        </li>
                        <?php $n++;}unset($n); ?>

						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                    </ul>
                </div>
            </div>
        	 <script type="text/javascript">
            jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:1,trigger:"click"});
            </script>

        

        

	<div class="home-tit mt40"><img src="images/t-5.png"><a href="<?php echo $CATEGORYS['23']['url'];?>" class="amore4 fr">查看更多</a></div>

    <div class="home-news-box mt40">

    	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b39fa68586a9e12c5b2f085446577fea&action=lists&catid=23&num=2&order=listorder+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'23','order'=>'listorder DESC','limit'=>'2',));}?>



        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

    	<div class="newsdiv">

        	<div class="pic"><img src="<?php echo $r['thumb'];?>" width="275" height="198"></div>

            <div class="rinfo">

            	<p class="time"><?php echo date('Y/m/d',$r[inputtime]);?></p>

                <p class="tit"><a href="<?php echo $r['url'];?>"><?php echo str_cut($r[title],40);?></a></p>

                <p class="con"><?php echo str_cut($r[description],120);?></p>

                <p class="more"><a href="<?php echo $r['url'];?>" class="amore2">查看详情</a></p>

            </div>

        </div>

        <?php $n++;}unset($n); ?>

		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

        

    </div>

    

</div>

<div class="cl"></div>

<div class="line"></div>

<div class="box">

	<div class="link-tit"><img src="images/t-6.png"></div>

    <div class="link-list">

    	<ul>

        	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=322361c7aaf162a3b4755fdf5bc8600b&action=lists&catid=26&num=7&order=listorder+DESC&moreinfo=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$data = $content_tag->lists(array('catid'=>'26','order'=>'listorder DESC','moreinfo'=>'1','limit'=>'7',));}?>



        	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>

        	<li><a href="<?php echo $r['weburl'];?>" target="_blank"><?php echo $r['title'];?></a></li>

            <?php $n++;}unset($n); ?>

			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

            

        </ul>

    </div>

</div>



<?php include template("content","footer"); ?>
