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
        <!--分页选中样式控制-->
        <style>
            .pagination .current{
                display: inline-block;
                height: 20px;
                width: 20px;
                line-height: 20px;
                margin: 0 1px 0 0;
                border-radius: 3px 3px 3px 3px;
                text-align: center;
                background: url(/czcf/Public/css/img/buttons.png) left -68px;
                border: 1px solid #3580A9;
                /*+text-shadow:0px -1px 0px #2C6AA3;*/
                -moz-text-shadow: 0px -1px 0px #2C6AA3;
                -webkit-text-shadow: 0px -1px 0px #2C6AA3;
                -o-text-shadow: 0px -1px 0px #2C6AA3;
                text-shadow: 0px -1px 0px #2C6AA3;
                color: #D4E6EF;
                font-weight: bold;
            }
        </style>
        
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
                                                <li><a href="<?php echo U('Member/index',array('pli'=>2,'cli'=>0));?>">会员信息</a></li>

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
                                                <li><a href="<?php echo U('Admin/modifyAdmin',array('pli'=>6,'cli'=>2));?>">修改个人资料</a></li>
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
            <h1><img src="/czcf/Public/img/icons/posts.png" alt="" />会员信息列表</h1>
<div class="bloc">
    <div class="title">
        会员列表
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th><input type="checkbox" class="checkall"/></th>
                    <th>ID&nbsp;&nbsp;</th>
                    <th>账号</th>
                    <th>邮箱</th>
                    <th>昵称</th>
                    <th>登入次数</th>
                    <th>注册IP</th>
                    <th>注册时间</th>
                    <th>最后登入IP</th>
                    <th>最后登入时间</th>
                    <!-- <th><img src="/czcf/Public/img/th-comment.png" alt="" /></th> -->
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($members)): foreach($members as $key=>$v): ?><tr>
                    <td><input type="checkbox" /></td>
                    <td><?php echo ($v["user_id"]); ?></td>
                    <td><?php echo ($v["username"]); ?></td>
                    <td><?php echo ($v["email"]); ?></td>
                    <td><?php echo ($v["niname"]); ?></td>
                    <td><?php echo ($v["logintime"]); ?></td>
                    <td><?php echo ($v["reg_ip"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$v["reg_time"])); ?></td>
                    <td><?php echo ($v["last_ip"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$v["last_time"])); ?></td>
                    
                    <td class="actions"><a href="">详情</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a>修改</a></td>
                </tr><?php endforeach; endif; ?>
                                
                            </tbody>
        </table>
        <div class="left input" style="margin-top:5px;">
            <input name="memberSearch" placeholder="输入ID或用户名或邮箱查找"/>
        </div>
        <div class="pagination">
            <?php echo ($show); ?>
        </div>
    </div>
</div>






<!-- <div class="bloc">
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
</div>   -->      </div>
        
        
    </body>
</html>