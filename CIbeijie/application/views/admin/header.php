<!DOCTYPE html>
<html>
 <head>
        <title>创造财富管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        
        <!-- jQuery AND jQueryUI -->
        <script type="text/javascript" src="<?php echo base_url('static');?>/js/libs/jquery/1.6/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('static');?>/js/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
        

        <link rel="stylesheet" href="<?php echo base_url('static');?>/css/min.css" />
        <script type="text/javascript" src="<?php echo base_url('static');?>/js/min.js"></script>
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
                background: url(<?php echo base_url('static');?>/css/img/buttons.png) left -68px;
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
        
        <script type="text/javascript" src="<?php echo base_url('static');?>/content/settings/main.js"></script>
<link rel="stylesheet" href="<?php echo base_url('static');?>/content/settings/style.css" />




      
        <!--              
                HEAD
                        --> 
        <div id="head">
            <a href="#" style="margin-left:15px;"><img src="<?php echo base_url('static');?>/img/icons/top/logo.png" alt="" /></a>
            <div class="left">
                <a href="#" class="button profile" style="top:10px;"><img src="<?php echo base_url('static');?>/img/icons/top/huser.png" alt="" /></a>
                你好, 
                <a href="#"><?php echo $admin_role_data['admin_name'];?>&nbsp;(<?php echo $admin_role_data['role_name'];?>)&nbsp;</a>
                |
                <a href="<?php echo site_url('admin/login/admin_login_out');?>">退出</a>
            </div>
            <div class="right">
                <form action="#" id="search" class="search placeholder">
                    <label> 查找内容</label>
                    <input type="text" value="" name="q" class="text"/>
                    <input type="submit" value="rechercher" class="submit"/>
                </form>
            </div>
        </div>