<?php
    // 加载公共视图页面
    //var_dump($admin_role_data);exit;
    include('header.php');
    include('left.php');

?>        
  
  
<!--   <div class="settings" id="settings">
        <div class="wrapper">
            <div class="grid3">
                <div class="titre">Backgrounds</div>
                <a href="url(<?php echo base_url('static');?>/css/img/bg.html" class="backgroundChanger active" title="White"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/dark-bg.html" class="backgroundChanger dark" title="Dark"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/wood.html" class="backgroundChanger dark" title="Wood"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/altbg/smoothwall.html" class="backgroundChanger" title="Smoothwall"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/altbg/black_denim.html" class="backgroundChanger dark" title="black_denim"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/altbg/carbon.html" class="backgroundChanger dark" title="Carbon"></a>
                <a href="url(<?php echo base_url('static');?>/css/img/altbg/double_lined.html" class="backgroundChanger" title="Double lined"></a>
                <div class="clear"></div>
            </div>
            <div class="grid3">
                <div class="titre">Bloc style</div>
                <a href="black.html" class="blocChanger" title="Black" style="background:url(<?php echo base_url('static');?>/css/img/bloctitle.png);"></a>
                <a href="white.html" class="blocChanger active" title="White" style="background:url(<?php echo base_url('static');?>/css/img/white-title.png);"></a>
                <a href="wood.html" class="blocChanger" title="Wood" style="background:url(<?php echo base_url('static');?>/css/img/wood-title.jpg);"></a>
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
    </div>   -->
                
                
        <!--            
              CONTENT 
                        --> 
        <div id="content" class="white">
            <h1><img src="<?php echo base_url('static');?>/img/icons/dashboard.png" alt="" /> 首页
</h1>
                
<div class="bloc left">
    <div class="title">
        常访问模块
    </div>
    <div class="content dashboard">
        <div class="center">
            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/page.png" alt="" width="48" height="48"/>
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/picture.png" alt="" width="48" height="48" />
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/contact.png" alt="" width="48" height="48" />
                Manage contacts
            </a>
            <a href="#" class="shortcut last">
                <img src="<?php echo base_url('static');?>/img/event.png" alt="" width="48" height="48" />
                Manage events
            </a>            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/page.png" alt="" width="48" height="48"/>
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/picture.png" alt="" width="48" height="48" />
                Write an Article
            </a>
            <a href="#" class="shortcut">
                <img src="<?php echo base_url('static');?>/img/contact.png" alt="" width="48" height="48" />
                Manage contacts
            </a>
            <a href="#" class="shortcut last">
                <img src="<?php echo base_url('static');?>/img/event.png" alt="" width="48" height="48" />
                Manage events
            </a>
            <div class="cb"></div>
        </div>
       
    </div>
</div>


                
<div class="bloc right">
    <div class="title">
        今日概要统计
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
        待审核及认证工作
    </div>
    <div class="content">
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/font.png" alt="" />
            借款初审
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/window.png" alt=""  width="32" height="32"/>
            借款复审
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/window.png" alt=""  width="32" height="32"/>
            借款资料审核
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/warning.png" alt=""  width="32" height="32"/>
            借款额度申请审核
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/calendar.png" alt=""  width="32" height="32"/>
            提现审核
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/posts.png" alt=""  width="32" height="32"/>
            会员实名认证
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/chart.png" alt=""  width="32" height="32"/>
            会员VIP认证
        </a>
        <a href="#" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/calendar.png" alt=""  width="32" height="32"/>
            债权转让审核
        </a>

        <div class="cb"></div>
    </div>
</div> 

<div class="bloc left">
    <div class="title">
        管理员信息
    </div>
    <div class="content dashboard">
            <table class="noalt">
                
                    <tr>
                        <td style="color:#4F94CD;">&nbsp;&nbsp;&nbsp;&nbsp;管理员名称:</td><td><?php echo $admin_data['admin_name'];?></td>
                    </tr>
                    <tr>
                        <td style="color:#4F94CD;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;所属部门:</td><td><?php echo $admin_role_data['role_name'];?></td>
                    </tr>                    
                    <tr>
                        <td style="color:#4F94CD;">本次登入时间:</td><td><?php echo date('Y-m-d H:m',$admin_data['login_time']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="color:#4F94CD;">&nbsp;&nbsp;&nbsp;&nbsp;本次登入IP:</td><td>
                        <?php
                            if( $admin_data['last_ip'] != $admin_data['login_ip'] ) {
                                echo $admin_data['login_ip'].'&nbsp;&nbsp;( <a style="color:red;">上次非本台电脑登入!</a> )'; 
                            } else{
                                echo $admin_data['login_ip'];
                            }
                        ?>
                        </td>
                    </tr>                    
                    <tr>
                        <td style="color:#4F94CD;">上次登入时间:</td><td><?php echo date('Y-m-d H:m',$admin_data['last_time']);?></td>
                    </tr>
                    <tr>
                        <td style="color:#4F94CD;">&nbsp;&nbsp;&nbsp;&nbsp;上次登入IP:</td><td>
                        <?php echo $admin_data['last_ip'];?>
                        </td>
                    </tr>
                
            </table>
                 
            
            <div class="cb"></div>
        </div>
        
</div>           

<div class="bloc right">
    <div class="title">
        系统信息
    </div>
    <div class="content dashboard">
            <table class="noalt">
                
                    <tr>
                        <td class="good">&nbsp&nbsp&nbsp操作系统:</td><td><?php echo $_SERVER['SYSTEMROOT']; ?></td>
                    </tr>
                    <tr>
                        <td class="good">服务器名称:</td><td><?php echo $_SERVER['SERVER_NAME'];?></td>
                    </tr>                    
                    <tr>
                        <td class="good">服务器协议:</td><td><?php echo $_SERVER['SERVER_PROTOCOL'];?></td>
                    </tr>
                    <tr>
                        <td class="good">服务器软件:</td><td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                    </tr>                    
                    <tr>
                        <td class="good">&nbsp&nbsp&nbspPHP版本:</td><td><?php echo PHP_VERSION;?></td>
                    </tr>
                    <tr>
                        <td class="good">MySql版本:</td><td>
                        <?php @mysql_connect('localhost','root','root');
                              echo mysql_get_server_info(); 
                        ?></td>
                    </tr>
                
            </table>
                 
            
            <div class="cb"></div>
        </div>
        
</div> 

<div class="cb"></div>
<div class="bloc">
    <div class="title">
        Shortcuts
    </div>
    <div class="content">
        <a href="typography.html?p=typo" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/font.png" alt="" />
            Typography
        </a>
        <a href="table.html?p=table" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/window.png" alt=""  width="32" height="32"/>
            Table
        </a>
        <a href="notifications.html?p=notif" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/warning.png" alt=""  width="32" height="32"/>
            Notifications
        </a>
        <a href="forms.html?p=forms" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/posts.png" alt=""  width="32" height="32"/>
            Forms
        </a>
        <a href="charts.html?p=charts" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/chart.png" alt=""  width="32" height="32"/>
            Charts
        </a>
        <a href="calendar.html?p=calendar" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/calendar.png" alt=""  width="32" height="32"/>
            Calendar
        </a>
                <a href="typography.html?p=typo" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/font.png" alt="" />
            Typography
        </a>
        <a href="table.html?p=table" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/window.png" alt=""  width="32" height="32"/>
            Table
        </a>
        <a href="notifications.html?p=notif" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/warning.png" alt=""  width="32" height="32"/>
            Notifications
        </a>
        <a href="forms.html?p=forms" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/posts.png" alt=""  width="32" height="32"/>
            Forms
        </a>
        <a href="charts.html?p=charts" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/chart.png" alt=""  width="32" height="32"/>
            Charts
        </a>
        <a href="calendar.html?p=calendar" class="shortcut">
            <img src="<?php echo base_url('static');?>/img/icons/calendar.png" alt=""  width="32" height="32"/>
            Calendar
        </a>
        <div class="cb"></div>
    </div>
</div>  




</div>


        
        
    </body>
</html>