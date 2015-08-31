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
            <h1><img src="/czcf/Public/img/icons/posts.png" alt="" /> 编辑管理员资料</h1>

<div class="bloc">
    <div class="title">管理员资料</div>
    <div class="content">
    <form action = "<?php echo U('updateModify');?>" method="POST">
        <div class="input">
            <label >登入账号</label>
            <label><?php echo ($modifyInfo["username"]); ?></label>
        </div>
        <div class="input">
            <label >修改登入密码</label>
            <input type="text" name="pwd"/>
            长度6以上位字母或数字组合 (若不修改请保留空)
        </div>
        <div class="input">
            <label >管理员名称</label>
            <input type="text" name="adminname" value="<?php echo ($modifyInfo["adminname"]); ?>"/>
        </div>

        <div class="input">
            <label for="select">管理员类型</label>
            <select name ='type_id'>
                <?php if(is_array($getAdminName)): foreach($getAdminName as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
            </select>

        </div>
        <div class="input">
            <label >QQ</label>
            <input type="text" name="qq" value="<?php echo ($modifyInfo["qq"]); ?>"/>
        </div>
                <div class="input">
            <label >手机号</label>
            <input type="text" name="phone" value="<?php echo ($modifyInfo["phone"]); ?>"/>
        </div>

            <input type="hidden" name="id" value="<?php echo ($modifyInfo["id"]); ?>">

        <div class="submit">
            <?php if($getAdminInfo["type_id"] == 1): ?><input type="submit" value="提交" /><?php else: ?><p style="color:red;">超级管理员才能操作管理员</p><?php endif; ?>
        </div>
    </form>
    </div>
</div>



        
        
    </body>
</html>