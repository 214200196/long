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

    .book-content-top-box{
    width: 100%;
    background: #1F1E1E;
  }
  .book-content-top{
    width: 1200px;
    height: 30px;
    margin-right: auto;
    margin-left: auto;
  }
  .book-content-top span{
    font-size: 15px;
    height: 30px;
    line-height: 30px;
  }
  .book-content-top span p{
    font-size: 10px;
    margin: 0px 5px 0px 5px;
  }
  .book-content-top span a{
    color:#777;
  }
  .book-content-top span a:hover{
    color:#ccc;
  }

.content-main{
  width: 1200px;
  margin: 0px auto;
}

.edit-left{
  float: left;
  width: 280px;
  min-height: 600px;
  height: auto;
  background: #EDE8D5;
  margin-right: 20px;
  border-radius: 5px;
}

.col-lg-6{
  width: 280px;
  margin: 20px auto;
}

.edit-main{
  float: left;
  width: 900px;
  margin:20px auto; 
}

.edit-main-title{
  margin: 20px auto;
}

.edit-main-title input{
  width: 600px;
  margin-bottom:25px; 
}

.select-box{
  margin-bottom: 20px;
}

.select-box select{
  height: 30px;
  width: 150px;
  margin-right: 10px;
  border-radius: 5px;
}



.btn-success{
  font-weight: bold;
  margin-top: 20px;
}





    #footer{
      clear: both;
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
      var options ={
        cssPath: '/css/index.css',
        filterMode: true
      };
      var editor = k.create('textarea[name="content"]',options);
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
<div class="book-content-top-box">
  <div class="book-content-top">
    <span><a>图书库<a><p class="glyphicon glyphicon-menu-right"></p><a>计算机<a><p class="glyphicon glyphicon-menu-right"></p><a>后台编程<a><p class="glyphicon glyphicon-menu-right"></p><a>PHP高级编程与设计<a></span>
  </div>
</div>
<div class="content-main">

    <div class="edit-left">
      
        <div class="col-lg-6">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="请添加目录名称">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button">增加目录</button>
            </span>
          </div>
        </div>
  </div>


    <div class="edit-main">
      <label>选择目录</label>
      <div class="select-box"> 
        <select class="selectpicker">
        <optgroup label="Picnic">
          <option>Mustard</option>
          <option>Ketchup</option>
          <option>Relish</option>
        </optgroup>
        <optgroup label="Camping">
          <option>Tent</option>
          <option>Flashlight</option>
          <option>Toilet Paper</option>
        </optgroup>
      </select>
      </div>

      <div class="edit-main-title">
        <label>标题 </label>
        <input type="text" class="form-control" placeholder="请输入文章标题">
      </div>

        <div class="edit-main-title">
        <label>设置关键字 </label>
        <input type="text" class="form-control" placeholder="请输入关键字">
      </div>
       
        <textarea class="form-control" rows="16" id="editor_id" name="content" ></textarea>

        <button type="button" class="btn btn-success">上 传 文 章</button>
    </div>

</div>

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

  <script type="text/javascript" src="/pctushu/editor/kindeditor.js"></script>
  <script type="text/javascript" src="/pctushu/editor/lang/zh-CN.js"></script>
 
  <script type="text/javascript">
      KindEditor.ready(function(k){
        window.editor=k.create('#editor_id');
      });
  </script>

</body>
</html>