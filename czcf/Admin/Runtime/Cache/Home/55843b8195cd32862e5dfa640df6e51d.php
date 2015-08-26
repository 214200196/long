<?php if (!defined('THINK_PATH')) exit();?>
    <!DOCTYPE html>
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
            <a href="#" style="margin-left:15px;"><img src="/czcf/Public/img/icons/top/logo.png" alt="" /></a>
            <div class="left">
                <a href="#" class="button profile" style="top:10px;"><img src="/czcf/Public/img/icons/top/huser.png" alt="" /></a>
                Hi, 
                <a href="#">admin</a>
                |
                <a href="#">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label> 查找内容</label>
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
                    <a href="<?php echo U('Index/index');?>">
                        <img src="/czcf/Public/img/icons/menu/home.png" alt="" />
                        首 页
                    </a>
                </li>
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/layout.png" alt="" /> 借款管理</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>">借款信息</a></li>
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
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/user.png" alt="" /> 会员管理</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>">会员信息</a></li>
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
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/money.png" alt="" /> 资金管理</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>">会员信息</a></li>
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
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/page.png" alt="" /> 新闻管理</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>">发布新闻</a></li>
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
                 <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/chart.png" alt="" /> 数据统计</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>">日报表</a></li>
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
                <li class="current"><a href="#"><img src="/czcf/Public/img/icons/menu/settings.png" alt="" /> 系统设置s</a>
                    <ul>
                                                <li class="current"><a href="<?php echo U('Borrow/index');?>"> 数据库备份</a></li>
                                                <li><a href="forms.html?p=forms">清除缓存</a></li>
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
            <h1><img src="/czcf/Public/img/icons/dashboard.png" alt="" /> Dashboard
</h1>
                
<div class="bloc left">
    <div class="title">
        Dashboard
    </div>
    <div class="content dashboard">
        <div class="center">
            <a href="#" class="shortcut">
                <img src="/czcf/Public/img/page.png" alt="" width="48" height="48"/>
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="/czcf/Public/img/picture.png" alt="" width="48" height="48" />
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="/czcf/Public/img/contact.png" alt="" width="48" height="48" />
                Manage contacts
            </a>
            <a href="#" class="shortcut last">
                <img src="/czcf/Public/img/event.png" alt="" width="48" height="48" />
                Manage events
            </a>
            <div class="cb"></div>
        </div>
        <p>Icons by <a href="http://icondrawer.com/">icondrawer.com</a></p>
    </div>
</div>


                
<div class="bloc right">
    <div class="title">
        Today
    </div>
    <div class="content">
        <div class="left">
            <table class="noalt">
                <thead>
                    <tr>
                        <th colspan="2"><em>Content</em></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h4>460</h4></td>
                        <td>Posts</td>
                    </tr>
                    <tr>
                        <td><h4>12</h4></td>
                        <td>Pages</td>
                    </tr>
                    <tr>
                        <td><h4>5</h4></td>
                        <td>Categories</td>
                    </tr>
                    <tr>
                        <td><h4>20 000</h4></td>
                        <td>Contacts</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="right">
            <table class="noalt">
                <thead>
                    <tr>
                        <th colspan="2"><em>Comments</em></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h4>46 000</h4></td>
                        <td class="good">Comments</td>
                    </tr>
                    <tr>
                        <td><h4>5</h4></td>
                        <td class="neutral">Waiting for validation</td>
                    </tr>
                    <tr>
                        <td><h4>0</h4></td>
                        <td class="bad">Spams</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="cb"></div>
    </div>
</div>


<div class="cb"></div>


           
<div class="bloc">
    <div class="title">
        Shortcuts
    </div>
    <div class="content">
        <script type="text/javascript"><!--
google_ad_client = "ca-pub-3413404722490728";
/* postscript728+90postscript.html */
google_ad_slot = "9238639693";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
        <div class="cb"></div>
    </div>
</div>   

<div class="bloc">
    <div class="title">
        Shortcuts
    </div>
    <div class="content">
        <a href="typography.html?p=typo" class="shortcut">
            <img src="/czcf/Public/img/icons/font.png" alt="" />
            Typography
        </a>
        <a href="table.html?p=table" class="shortcut">
            <img src="/czcf/Public/img/icons/window.png" alt=""  width="32" height="32"/>
            Table
        </a>
        <a href="notifications.html?p=notif" class="shortcut">
            <img src="/czcf/Public/img/icons/warning.png" alt=""  width="32" height="32"/>
            Notifications
        </a>
        <a href="forms.html?p=forms" class="shortcut">
            <img src="/czcf/Public/img/icons/posts.png" alt=""  width="32" height="32"/>
            Forms
        </a>
        <a href="charts.html?p=charts" class="shortcut">
            <img src="/czcf/Public/img/icons/chart.png" alt=""  width="32" height="32"/>
            Charts
        </a>
        <a href="calendar.html?p=calendar" class="shortcut">
            <img src="/czcf/Public/img/icons/calendar.png" alt=""  width="32" height="32"/>
            Calendar
        </a>
        <div class="cb"></div>
    </div>
</div>        

</div>
        
        
    </body>
</html>