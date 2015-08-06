<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style>

  body a{
    color: #444444;
    text-decoration:none;
    cursor: pointer;
  }
  body a:hover{
    text-decoration: none;
  }

	.navbar-default{
		height: 60px;
		margin-bottom: 0px;
		border-radius: 0px;
		border:none;
		background: #101010
	}
	.container-fluid{
		height: 60px;
	}
	.navbar-header{
		padding-top:5px;
		width: 100px;
	}
	.navbar-brand{
		padding-left: 25px;
	}
	.navbar-collapse{
		padding-top:5px; 
	}
   
.register{
  width: 500px;
  margin: 150px auto 300px auto;
}
.input-group, .input-group input{
  height: 50px;
}
.form-control-feedback{
  margin-top: 8px;
}

.btn-success{
  width: 500px;
  height: 50px;
  font-weight: bold;
}


.yanzhengma-list{
  float: left;
  width: 300px;
}
.yanzhengma{
  float: left;
  width: 150px;
  margin-left: 10px;
  border: 1px solid #3C763D;
  border-radius: 5px;
  margin-top: 20px;
  height: 50px;

}

.checkbox label{
  margin-top: 20px;
  height: 50px;
  width: 500px;
}
.checkbox label input{
  margin-top: 0px;
  height: 20px;
  width: 20px;

}






    #footer{
    	width:100%;
    	height: 100px;
    	background: #101010;
    }
    .waper{
    	width:1090px;
    	height: 100px;
    	margin-left: auto;
    	margin-right: auto;
    }
    .footer_link li{
    	float: left;
    	list-style-type: none;
    	margin-right: 20px;
    	padding-top: 20px;
    }
    .copyright{
    	float: left;
    	margin-left: 40px;
    	padding-top: 5px;
    	color: #Fff;
    }
</style>

</head>
<body>

<script type="text/javascript">
  var verifyurl="<?php echo U('verify');?>";
  var asynverify="<?php echo U('asynverify');?>";
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('Index/Index');?>">PC图书</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">图书库<span class="sr-only">(current)</span></a></li>
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

<form action="<?php echo U('CheckLogin');?>" method="POST">
  <div class="register">
        <div class="form-group  has-feedback">
          <label class="control-label" for="inputSuccess2"></label>
            <div class="input-group">
            <span class="input-group-addon">电子邮箱&nbsp<b class="glyphicon glyphicon-envelope"></b></span>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="inputError2Status">
          </div>
          <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
        </div>


        <div class="form-group  has-feedback">
          <label class="control-label" for="inputError2"></label>
            <div class="input-group">
              <span class="input-group-addon">&nbsp密&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp码&nbsp<b class="glyphicon glyphicon-lock"></b></span>
              <input type="password" class="form-control" id="pwd" name="pwd" aria-describedby="inputError2Status">
            </div>
          <span class="glyphicon  form-control-feedback" aria-hidden="true"></span>
        </div>



     <div class="yanzhengma-list">
        <div class="form-group  has-feedback">
          <label class="control-label" for="inputError2"></label>
            <div class="input-group">
              <span class="input-group-addon">&nbsp验&nbsp证&nbsp码&nbsp<b class="glyphicon glyphicon-barcode"></b></span>
              <input type="text" class="form-control" id="verify" name = "verify" aria-describedby="inputError2Status"/>
            </div>
          <span class="glyphicon  form-control-feedback" id="verifyok" aria-hidden="true"></span>
        </div>
    </div>
    <div class="yanzhengma"><img id ="yanzhengmas" src="<?php echo U('Register/verify');?>" style="height:45px;width:145px;border-radius:5px;"></div>

      <div class="checkbox">
        <label>
          <input type="checkbox"/>&nbsp&nbsp下次自动登入
        </label>
      </div>
       
        <button type="submit" id="submit" class="btn btn-success">登&nbsp&nbsp入</button>
  </div>
</form>



<div id="footer" >
    <div class="waper">
        <div class="footerwaper clearfix">
            <div class="followus r">
                <a class="followus-weixin" href="javascript:;"  target="_blank" title="微信">
                    <div class="flw-weixin-box"></div>
                </a>
                <a class="followus-weibo" href="http://weibo.com/u/3306361973"  target="_blank" title="新浪微博"></a>
                <a class="followus-qzone" href="http://user.qzone.qq.com/1059809142/" target="_blank" title="QQ空间"></a>
            </div>
            <div class="footer_intro l">
                <div class="footer_link">
                    <ul>
                        <li><a href="http://www.imooc.com/" target="_blank">网站首页</a></li>
                        <li><a href="/about/job" target="_blank">人才招聘</a></li>
                        <li> <a href="/about/contact" target="_blank">联系我们</a></li>
                        <li><a href="http://daxue.imooc.com/" target="_blank">高校联盟</a></li>
                        <li><a href="/about/us" target="_blank">关于我们</a></li>
                        <li> <a href="/about/recruit" target="_blank">讲师招募</a></li>
                        <li> <a href="/user/feedback" target="_blank">意见反馈</a></li>
                        <li> <a href="/about/friendly" target="_blank">友情链接</a></li>
                    </ul>
                </div>
                <div class ="copyright" ><p>Copyright © 2015 imooc.com All Rights Reserved | 京ICP备 13046642号-2</p></div>
            </div>
        </div>
    </div>
</div>


	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script src="/pctushu/Public/js/login.js"></script>

</body>
</html>