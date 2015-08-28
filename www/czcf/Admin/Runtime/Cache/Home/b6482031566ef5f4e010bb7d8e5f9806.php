<?php if (!defined('THINK_PATH')) exit();?>    <!DOCTYPE html>
<html>
 <head>
        <title><?php echo C('WEB_NAME');?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="/czcf/Public/js/libs/jquery/1.6/jquery.min.js"></script>
        <script type="text/javascript" src="/czcf/Public/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        
        <!-- Compressed Version
        <link type="text/css" rel="stylesheet" href="min/b=CoreAdmin&f=/czcf/Public/css/reset.css,/czcf/Public/css/style.css,/czcf/Public/css/jqueryui/jqueryui.css,/czcf/Public/js/jwysiwyg/jquery.wysiwyg.old-school.css,/czcf/Public/js/zoombox/zoombox.css" />
        <script type="text/javascript" src="min/b=CoreAdmin/js&f=cookie/jquery.cookie.js,jwysiwyg/jquery.wysiwyg.js,tooltipsy.min.js,iphone-style-checkboxes.js,excanvas.js,zoombox/zoombox.js,visualize.jQuery.js,jquery.uniform.min.js,main.js"></script>
        -->
        <link rel="stylesheet" href="/czcf/Public/css/min.css" />
        <script type="text/javascript" src="/czcf/Public/js/min.js"></script>
        
    </head>
    <body>
        
        <script type="text/javascript" src="/czcf/Public/content/settings/main.js"></script>
<link rel="stylesheet" href="/czcf/Public/content/settings/style.css" />




      
        <!--              
                HEAD
                        --> 
        <div id="head">
            <a href="#" style="margin-left:15px;"><img src="/czcf/Public/img/icons/top/logo.png" alt="" /></a>
            <div class="left">
                <a href="#" class="button profile" style="top:10px;"><img src="/czcf/Public/img/icons/top/huser.png" alt="" /></a>
                你好, 
                <a href="#"><?php echo ($getAdminInfo["username"]); ?>&nbsp;(<?php echo ($getAdminInfo["name"]); ?>)&nbsp;</a>
                |
                <a href="<?php echo U('Login/loginOut');?>">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label> 查找内容</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>     
            <!--左侧菜单选中菜单定义20150827-->
        <script type="text/javascript">
        // $(function(){
            // 左侧拦js效果修改20150827
            //$("#sidebar ul:first li:eq(2)").addClass("current");
         //});
                var pli = <?php echo ((isset($_GET['pli']) && ($_GET['pli'] !== ""))?($_GET['pli']):0); ?>;
                var cli = <?php echo ((isset($_GET['cli']) && ($_GET['cli'] !== ""))?($_GET['cli']):0); ?>;
        </script>

        <!--<script type="text/javascript">
            $ (function() {
                $("#sidebar ul:first li:eq(1)").addClass("current");
                $("#sidebar ul:first li:eq(1)").children().find("li:eq(1)").addClass("current");
            });
        </script>-->

        <div id="sidebar">
            <ul>
                <li>
                    <a href="<?php echo U('Index/index');?>">
                        <img src="/czcf/Public/img/icons/menu/home.png" alt="" />
                        首 页
                    </a>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/layout.png" alt="" /> 借款管理</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index',array('pli'=>1,'cli'=>0));?>">借款信息</a></li>

                                            </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/users.png" alt="" /> 会员管理</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index');?>">会员信息</a></li>

                                            </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/money.png" alt="" /> 资金管理</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index');?>">会员信息</a></li>

                                            </ul>
                </li>
                <li ><a href="#"><img src="/czcf/Public/img/icons/menu/page.png" alt="" /> 新闻管理</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index');?>">发布新闻</a></li>

                                            </ul>
                </li>
                 <li><a href="#"><img src="/czcf/Public/img/icons/menu/chart.png" alt="" /> 数据统计</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index');?>">日报表</a></li>
                                            </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/user.png" alt="" /> 管理员信息</a>
                    <ul>
                                                <li><a href="<?php echo U('Admin/index',array('pli'=>6,'cli'=>0));?>"> 管理员列表</a></li>
                                                <li><a href="<?php echo U('Admin/addAdmin',array('pli'=>6,'cli'=>1));?>">添加管理员</a></li>
                                            </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/settings.png" alt="" /> 系统设置</a>
                    <ul>
                                                <li><a href="<?php echo U('Borrow/index');?>"> 数据库备份</a></li>
            
                                            </ul>
                </li>
<!--                 <li><a href="#"><img src="/czcf/Public/img/icons/menu/brush.png" alt="" /> Another submenu</a>
                    <ul>
                        <li><a href="#">Fake menu #1</a></li>
                        <li><a href="#">Fake menu #2</a></li>
                        <li><a href="#">Fake menu #3</a></li>
                    </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/brush.png" alt="" /> Infinite sublevel</a>
                    <ul>
                        <li><a href="#">Fake menu #1</a></li>
                        <li><a href="#">Fake menu #2</a></li>
                        <li><a href="#">Fake menu #3</a>
                        <ul>
                            <li><a href="#">Fake menu #1</a></li>
                            <li><a href="#">Fake menu #2</a></li>
                            <li><a href="#">Fake menu #3</a>
                                <ul>
                                    <li><a href="#">Fake menu #1</a></li>
                                    <li><a href="#">Fake menu #2</a></li>
                                    <li><a href="#">Fake menu #3</a></li>
                                </ul>
                            </li>
                        </ul>
                        </li>
                    </ul>
                </li>
                <li class="nosubmenu"><a href="#"><img src="/czcf/Public/img/icons/menu/lab.png" alt="" /> This button is useless</a></li>
                <li class="nosubmenu"><a href="modal.html" class="zoombox w450 h700"><img src="/czcf/Public/img/icons/menu/comment.png" alt="" /> Modal box</a></li> -->
            </ul>


        </div>



                   
                
                
                
                
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="/czcf/Public/img/icons/posts.png" alt="" /> Table</h1>
<div class="bloc">
    <div class="title">
        Table Content
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"/></th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Catégories</th>
                    <th>Tags</th>
                    <th><img src="/czcf/Public/img/th-comment.png" alt="" /></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td><input type="checkbox" /></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><a href="#">Grafikart</a></td>
                    <td><a href="#">Dolor</a> , <a href="#">Amet</a></td>
                    <td><a href="#">Consecte</a> , <a href="#">Adipiscin</a>, <a href="#">Elit</a></td>
                    <td>35</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                            </tbody>
        </table>
        <div class="left input">
            <select name="action" id="tableaction">
                <option value="">Action</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="pagination">
            <a href="#" class="prev">«</a>
            <a href="#">1</a>
            <a href="#" class="current">2</a>
            ...
            <a href="#">21</a>
            <a href="#">22</a>
            <a href="#" class="next">»</a>
        </div>
    </div>
</div>



<div class="bloc">
    <div class="title">
        Table Content with pictures
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                                <tr>
                    <td class="picture" style="width:140px;"><a href="../../../lorempixum.com/800/600/food/0/index25b2.html?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/0" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td><script type="text/javascript"><!--
google_ad_client = "ca-pub-3413404722490728";
/* postscript728+90postscript.html */
google_ad_slot = "9238639693";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:140px;"><a href="../../../lorempixum.com/800/600/food/1/index25b2.html?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/1" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td>http://lorempixum.com/800/600/food/1</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:140px;"><a href="../../../lorempixum.com/800/600/food/2/index25b2.html?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/2" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td>http://lorempixum.com/800/600/food/2</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:140px;"><a href="../../../lorempixum.com/800/600/food/3/index25b2.html?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/3" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td>http://lorempixum.com/800/600/food/3</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:140px;"><a href="../../../lorempixum.com/800/600/food/4/index25b2.html?.jpg" class="zoombox"><img src="http://lorempixum.com/100/100/food/4" alt="" /></a></td>
                    <td><a href="#">Lorem ipsum</a></td>
                    <td>http://lorempixum.com/800/600/food/4</td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                            </tbody>
        </table>
    </div>
</div>



<div class="bloc">
    <div class="title">
        Last comments
    </div>
    <div class="content">
        <table class="noalt">
            <tbody>
                                <tr>
                    <td class="picture" style="width:80px;"><img src="/czcf/Public/img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:80px;"><img src="/czcf/Public/img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:80px;"><img src="/czcf/Public/img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:80px;"><img src="/czcf/Public/img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                                <tr>
                    <td class="picture" style="width:80px;"><img src="/czcf/Public/img/anonymous.png" alt="" /></td>
                    <td>
                        <p>
                            <strong><a href="#">John Doe</a></strong><br/>
                            <em>December 24, at 22:13 - <a href="#">Reply</a></em><br/>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nulla sapien, quis luctus felis. Fusce sodales tempus tincidunt.
                        </p>
                    </td>
                    <td class="actions"><a href="#" title="Edit this content"><img src="/czcf/Public/img/icons/actions/edit.png" alt="" /></a><a href="#" title="Delete this content"><img src="/czcf/Public/img/icons/actions/delete.png" alt="" /></a></td>
                </tr>
                            </tbody>
        </table>
    </div>
</div>        </div>
        
        
    </body>
</html>