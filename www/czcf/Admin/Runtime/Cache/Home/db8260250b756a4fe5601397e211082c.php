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
                                                <li><a href="">Forms</a></li>
                                                <li><a href="">Table</a></li>
                                                <li><a href="">Tabs</a></li>
                                                <li><a href="">Gallery</a></li>
                                                <li><a href="">Notifications</a></li>
                                                <li><a href="">Charts</a></li>
                                                <li><a href="">Typography</a></li>
                                                <li><a href="">Icons</a></li>
                                                <li><a href="">Calendar</a></li>
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
            <h1><img src="/czcf/Public/img/icons/posts.png" alt="" /> 添加管理员</h1>

<div class="bloc">
    <div class="title">添加管理员</div>
    <div class="content">
        <div class="input">
            <label for="input1">Text input</label>
            <input type="text" id="input1" />
            Some informations on how to use this field
        </div>
        <div class="input medium error">
            <label for="input2">Medium input with error</label>
            <input type="text" id="input2" />
            <span class="error-message">This field can't be empty !</span>
        </div>
        <div class="input long">
            <label for="input3">Loooooooooong input</label>
            <input type="text" id="input3" />
        </div>
        <div class="input">
            <label for="file">Upload a file</label>
            <input type="file" id="file" />
        </div>

        <div class="input">
            <label class="label">Checkboxes</label>
            <input type="checkbox" id="check1" checked="checked"/><label for="check1" class="inline">This is a checkbox</label> <br/>
            <input type="checkbox" id="check2" /><label for="check2" class="inline">Another one !</label> <br/>
        </div>
        <div class="input">
            <label class="label">Radio</label>
            <input type="radio" id="radio1" name="radiobutton"  checked="checked"/><label for="radio1" class="inline">This is a radio input</label> <br/>
            <input type="radio" id="radio2"  name="radiobutton"/><label for="radio2" class="inline">And this is another radio input</label>
        </div>
        <div class="input">
            <label for="select">This is a "select" input</label>
            <select name="select" id="select">
                <option value="1">First value</option>
                <option value="2">Second value</option>
                <option value="3">Third value</option>
            </select>
            Some informations on how to use this field
        </div>
        <div class="input textarea">
            <label for="textarea1">Textarea</label>
            <textarea name="text" id="textarea1" rows="7" cols="4"></textarea>
        </div>
        <div class="submit">
            <input type="submit" value="Enregistrer" />
            <input type="reset" value="Black button" class="black"/>
            <input type="reset" value="White button" class="white"/>
        </div>
    </div>
</div>

<div class="bloc">
    <div class="title">Advanced inputs</div>
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
        
    </div>
</div>        

<div class="bloc">
    <div class="title">Advanced inputs</div>
    <div class="content">
        <div class="input">
            <label for="input4">Datepicker using jQuery UI</label>
            <input type="text" class="datepicker" id="input4"/>
        </div>
        <div class="input textarea">
            <label for="textarea2">Autogrow WYSIWYG Textarea (<a href="https://github.com/akzhan/jwysiwyg">jwysiwyg</a>)</label>
            <textarea name="text" id="textarea2" rows="7" class="wysiwyg" cols="4">
                Here you <em>can have</em> some <strong>HTML Content</strong>
            </textarea>
        </div>
        <div class="input">
            <label>Range : $<span></span></label>
            <input type="text" class="range min-10 max-60" value="35" />
        </div>
        
        <div class="input">
            <label for="iphonecheck" class="label">Iphone checkbox</label>
            <input type="checkbox" id="iphonecheck" class="iphone"/>
        </div>
        
        
    </div>
</div>        

</div>
        
        
    </body>
</html>