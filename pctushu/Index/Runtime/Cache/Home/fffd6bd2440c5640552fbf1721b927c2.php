<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>pc图书-会员注册</title>
  <link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="/pctushu/Public/css/register.css" type="text/css">

</head>
<body>

<script type="text/javascript">
  var verifyurl="<?php echo U('verify');?>";
  var asynemail="<?php echo U('asynemail');?>";
  var asynverify="<?php echo U('asynverify');?>";
</script>
<!-- <?php echo (dump($Verifys)); ?> -->
<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('Index/index');?>">PC图书</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo U('Bookslist/index');?>">图书库<span class="sr-only">(current)</span></a></li>
        <li class=""><a href="#">计 划<span class="sr-only">(current)</span></a></li>
        <li class=""><a href="#">社 区<span class="sr-only">(current)</span></a></li>
        <li><a href="#">手 册</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">图书导航<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="书籍名称">
        </div>
        <button type="submit" class="btn btn-default">搜 索</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
          <?php if($_SESSION['uid']): ?><li><a href="<?php echo U('Member/index');?>">个人中心</a></li>
            <li><a href="<?php echo U('Login/loginOut');?>">退出</a></li>
          <?php else: ?>
            <li><a href="<?php echo U('Register/Index');?>">注册</a></li>
            <li><a href="<?php echo U('Login/Index');?>">登入</a></li><?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<div class="register">
<form action="<?php echo U('CheckRegister');?>" method="POST">
    <div class="form-group  has-feedback">
      <label class="control-label" for="inputError2"></label>
        <div class="input-group">
          <span class="input-group-addon">电子邮箱&nbsp<b class="glyphicon glyphicon-envelope"></b></span>
          <input type="text" class="form-control" id="email" aria-describedby="inputError2Status" name="email">
        </div>
      <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    </div>

    <div class="form-group  has-feedback">
      <label class="control-label" for="inputError2"></label>
        <div class="input-group">
            <span class="input-group-addon">密&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码&nbsp<b class="glyphicon glyphicon-lock"></b></span>
            <input type="password" class="form-control" id="pwd" aria-describedby="inputError2Status" name="pwd">
        </div>
      <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
    </div>

    <div class="form-group  has-feedback">
      <label class="control-label" for="inputError2"></label>
        <div class="input-group">
          <span class="input-group-addon">重复密码&nbsp<b class="glyphicon glyphicon-lock"></b></span>
          <input type="password" class="form-control" id="pwded" aria-describedby="inputError2Status" name="pwded">
        </div>
      <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
    </div>

    <div class="form-group  has-feedback">
      <label class="control-label" for="inputSuccess2"></label>
        <div class="input-group">
          <span class="input-group-addon">用户昵称&nbsp<b class="glyphicon glyphicon-user"></b></span>
          <input type="text" class="form-control" id="username" aria-describedby="inputError2Status" name="username">
        </div>
      <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
    </div>

     <div class="yanzhengma-list">
        <div class="form-group  has-feedback">
          <label class="control-label" for="inputError2"></label>
            <div class="input-group">
              <span class="input-group-addon">&nbsp验&nbsp证&nbsp码&nbsp<b class="glyphicon glyphicon-barcode"></b></span>
              <input type="text" class="form-control" id="verify" aria-describedby="inputError2Status" name="verify"/>
            </div>
          <span class="glyphicon  form-control-feedback" id="verifyok" aria-hidden="true"></span>
        </div>
    </div>
    <div class="yanzhengma"><img id ="yanzhengma" src="<?php echo U('Register/verify');?>" style="height:45px;width:145px;border-radius:5px;"></div>

    <input type="submit" id="submit" class="btn btn-success" value="提交注册"/>
</div>
</form>


<div id="footer" >
    <div class="waper">
        <div class="footerwaper clearfix">
            <div class="followus r">
                <a class="followus-weixin" href="javascript:;"  target="_blank" title="微信">
                    <div class="flw-weixin-box"></div>
                </a>
                <a class="followus-weibo" href=""  target="_blank" title="新浪微博"></a>
                <a class="followus-qzone" href="" target="_blank" title="QQ空间"></a>
            </div>
            <div class="footer_intro l">
                <div class="footer_link">
                    <ul>
                        <li><a href="" >网站首页</a></li>
                        <li> <a href="" >联系我们</a></li>
                        <li><a href="" >关于我们</a></li>
                        <li> <a href="" >意见反馈</a></li>
                        <li> <a href="" >友情链接</a></li>
                    </ul>
                </div>
                <div class ="copyright" ><p>Copyright © 2015.08 ~ 2015 www.pctushu.com All Rights Reserved   &nbsp; &nbsp;
                  &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
                </p></div>
            </div>
        </div>
    </div>
</div>


  <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
  <script src="/pctushu/Public/js/jquery-2.1.4.min.js"></script>
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="/pctushu/Public/js/bootstrap.min.js"></script>

  <script src="/pctushu/Public/js/validata.js"></script>

</body>
</html>