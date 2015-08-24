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


  <div class="settings" id="settings">
        <div class="wrapper">
            <div class="grid3">
                <div class="titre">Backgrounds</div>
                <a href="url(/czcf/Public/css/img/bg.html" class="backgroundChanger active" title="White"></a>
                <a href="url(/czcf/Public/css/img/dark-bg.html" class="backgroundChanger dark" title="Dark"></a>
                <a href="url(/czcf/Public/css/img/wood.html" class="backgroundChanger dark" title="Wood"></a>
                <a href="url(/czcf/Public/css/img/altbg/smoothwall.html" class="backgroundChanger" title="Smoothwall"></a>
                <a href="url(/czcf/Public/css/img/altbg/black_denim.html" class="backgroundChanger dark" title="black_denim"></a>
                <a href="url(/czcf/Public/css/img/altbg/carbon.html" class="backgroundChanger dark" title="Carbon"></a>
                <a href="url(/czcf/Public/css/img/altbg/double_lined.html" class="backgroundChanger" title="Double lined"></a>
                <div class="clear"></div>
            </div>
            <div class="grid3">
                <div class="titre">Bloc style</div>
                <a href="black.html" class="blocChanger" title="Black" style="background:url(/czcf/Public/css/img/bloctitle.png);"></a>
                <a href="white.html" class="blocChanger active" title="White" style="background:url(/czcf/Public/css/img/white-title.png);"></a>
                <a href="wood.html" class="blocChanger" title="Wood" style="background:url(/czcf/Public/css/img/wood-title.jpg);"></a>
                <div class="clear"></div>
            </div>
            <div class="grid3">
                <div class="titre">Sidebar style</div>
                <a href="grey.html" class="sidebarChanger active" title="Grey" style="background:#494949"></a>
                <a href="black.html" class="sidebarChanger" title="Black" style="background:#262626"></a>
                <a href="white.html" class="sidebarChanger" title="White" style="background:#EEEEEE"></a>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <a class="settingbutton" href="#">

        </a>
    </div>        
        <!--              
                HEAD
                        --> 
        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="/czcf/Public/img/icons/top/huser.png" alt="" /></a>
                Hi, 
                <a href="#">admin</a>
                |
                <a href="#">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label>Looking for something ?</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>     
            <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
                <li>
                    <a href="<?php echo U('index');?>">
                        <img src="/czcf/Public/img/icons/menu/inbox.png" alt="" />
                        首 页
                    </a>
                </li>
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/layout.png" alt="" /> 借款管理</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index',array('p'=>'table'));?>">借款信息</a></li>
                                                <li><a href="forms.html?p=forms">Forms</a></li>
                                                <li><a href="table.html?p=table">Table</a></li>
                                                <li><a href="tabs.html?p=tabs">Tabs</a></li>
                                                <li><a href="gallery.html?p=gallery">Gallery</a></li>
                                                <li><a href="notifications.html?p=notif">Notifications</a></li>
                                                <li><a href="charts.html?p=charts">Charts</a></li>
                                                <li><a href="typography.html?p=typo">Typography</a></li>
                                                <li><a href="icons.html?p=icons">Icons</a></li>
                                                <li><a href="calendar.html?p=calendar">Calendar</a></li>
                                            </ul>
                </li>
                <li><a href="#"><img src="/czcf/Public/img/icons/menu/brush.png" alt="" /> Another submenu</a>
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
                <li class="nosubmenu"><a href="modal.html" class="zoombox w450 h700"><img src="/czcf/Public/img/icons/menu/comment.png" alt="" /> Modal box</a></li>
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