<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
 <head>
        <title><?php echo C('WEB_NAME');?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" href="/czcf/Public/css/min.css" />
        <!--后台登入js特效-->
        <SCRIPT src="/czcf/Public/js/jquery-1.9.1.min.js" type="text/javascript"></SCRIPT>

        <STYLE>
            body{

                font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
                color: #222;
                font-size: 12px;
            }
            *{padding: 0px;margin: 0px;}
            .top_div{

                width: 100%;
                height: 400px;
            }
            .ipt{
                border: 1px solid #d3d3d3;
                padding: 10px 10px;
                margin-top: 20px;
                width: 290px;
                border-radius: 4px;
                padding-left: 35px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
            }
            .ipt:focus{
                border-color: #66afe9;
                outline: 0;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
            }
            .u_logo{
                background: url("/czcf/Public/images/username.png") no-repeat;
                padding: 10px 10px;
                position: absolute;
                margin-top: 20px;
                top: 43px;
                left: 40px;

            }
            .p_logo{
                background: url("/czcf/Public/images/password.png") no-repeat;
                padding: 10px 10px;
                margin-top: 20px;
                position: absolute;
                top: 12px;
                left: 40px;
            }
            a{
                text-decoration: none;
            }
            .tou{
                background: url("/czcf/Public/images/tou.png") no-repeat;
                width: 97px;
                height: 92px;
                position: absolute;
                top: -87px;
                left: 140px;
            }
            .left_hand{
                background: url("/czcf/Public/images/left_hand.png") no-repeat;
                width: 32px;
                height: 37px;
                position: absolute;
                top: -38px;
                left: 150px;
            }
            .right_hand{
                background: url("/czcf/Public/images/right_hand.png") no-repeat;
                width: 32px;
                height: 37px;
                position: absolute;
                top: -38px;
                right: -64px;
            }
            .initial_left_hand{
                background: url("/czcf/Public/images/hand.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -12px;
                left: 100px;
            }
            .initial_right_hand{
                background: url("/czcf/Public/images/hand.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -12px;
                right: -112px;
            }
            .left_handing{
                background: url("/czcf/Public/images/left-handing.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -24px;
                left: 139px;
            }
            .right_handinging{
                background: url("/czcf/Public/images/right_handing.png") no-repeat;
                width: 30px;
                height: 20px;
                position: absolute;
                top: -21px;
                left: 210px;
            }

            </STYLE>
                 
            <SCRIPT type="text/javascript">
            $(function(){
                //得到焦点
                $("#password").focus(function(){
                    $("#left_hand").animate({
                        left: "150",
                        top: " -38"
                    },{step: function(){
                        if(parseInt($("#left_hand").css("left"))>140){
                            $("#left_hand").attr("class","left_hand");
                        }
                    }}, 2000);
                    $("#right_hand").animate({
                        right: "-64",
                        top: "-38px"
                    },{step: function(){
                        if(parseInt($("#right_hand").css("right"))> -70){
                            $("#right_hand").attr("class","right_hand");
                        }
                    }}, 2000);
                });
                //失去焦点
                $("#password").blur(function(){
                    $("#left_hand").attr("class","initial_left_hand");
                    $("#left_hand").attr("style","left:100px;top:-12px;");
                    $("#right_hand").attr("class","initial_right_hand");
                    $("#right_hand").attr("style","right:-112px;top:-12px");
                });
            });
            </SCRIPT>

</head>
    <body>
        
        <script type="text/javascript" src="/czcf/Public/content/settings/main.js"></script>
<link rel="stylesheet" href="/czcf/Public/content/settings/style.css" />


      
        <!--              
                HEAD
                        --> 
        <div id="head" style="height:120px;">
            <a href="#" style="margin-left:15px;"><img src="/czcf/Public/img/icons/top/logo.png" alt="" style="margin-top:30px;"/></a>
        </div> 
        <div class="top_div"></div>
            <div style="background: rgb(255, 255, 255); margin: -100px auto auto; border: 1px solid rgb(231, 231, 231); border-image: none; width: 400px; height: 250px; text-align: center;">
            <div style="width: 165px; height: 96px; position: absolute;">
            <div class="tou"></div>
            <div class="initial_left_hand" id="left_hand"></div>
            <div class="initial_right_hand" id="right_hand"></div></div>
            <form action="<?php echo U('checkLogin');?>" method="POST">
                <P style="padding: 30px 0px 10px; position: relative;"><span  class="u_logo"></span>         
                    <input class="ipt" type="text" placeholder="请输入用户名或邮箱" name="adminname" value=""> 
                </P>
                <P style="position: relative;"><span class="p_logo"></span>         
                    <input class="ipt" id="password" type="password" placeholder="请输入密码" name="pwd" value="">   
                </P>
                <div style="height: 50px; line-height: 50px; margin-top: 30px; border-top-color: rgb(231, 231, 231); border-top-width: 1px; border-top-style: solid;">
                    <span style="">
                        <button  type="submit" style="background:#303030; padding: 7px 15px; border-radius:4px; border: 1px solid rgb(26, 117, 152); border-image: none; color: rgb(255, 255, 255); font-weight: bold;" href="#">登&nbsp;&nbsp;录</button> 
                    </span>      
                </div>
            </form>   
        </div>  




        
        
    </body>
</html>