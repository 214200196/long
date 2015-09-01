<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <link rel="shortcut icon" href="../favicon.ico" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="pctushu,pc图书,在线图书,在线pdf图书,图书,图书馆,计算机书籍下载,计算机书籍,会计" />
    <meta name="description" content="pc图书网—只为用户提供免费精品图书，计算机（为主）、财经、英语、数学、医学、陆续健全所有体系！感谢大家支持@_@!" />
  <title>pc图书-首页</title>
  <link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="/pctushu/Public/css/index.css" type="text/css">
  <style>
    .books-list-page .current{
      background-color:red;
      color:#fff;
    }
 </style>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header" style="width:120px;">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo U('Index/index');?>" >PC图书&nbsp;<span class="glyphicon glyphicon-book"></span></a>
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
<script type="text/javascript">
  var cid = <?php echo ($cid); ?>;
</script>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="/pctushu/Public/image/banner.jpg" alt="">
      <div class="carousel-caption">
       <!-- <p>有了新一代 802.11ac 技术，MacBook Air 令 Wi-Fi 速度超越极限。</p> -->
      </div>
    </div>
    
    <div class="item">
      <img src="/pctushu/Public/image/apic02.jpg" alt="">
      <div class="carousel-caption">
        <!-- <p>11 英寸 MacBook Air 充电一次可运行长达 9 小时，而 13 英寸机型则可运行长达 12 小时。</p> -->
      </div>
    </div>
        <div class="item">
      <img src="/pctushu/Public/image/apic03.jpg" alt="">
      <div class="carousel-caption">
        <!-- <p>无论是什么任务，配备 Intel HD Graphics 5000 图形处理器的第四代 Intel Core 处理器都能应对自如。</p> -->
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="bookslist">
  <ul class="nav nav-tabs" id="category-select">
    <li role="presentation" class=""><a href="#">猜你喜欢<strong style="color:red;" class="glyphicon glyphicon-heart"></strong></a></li>
    <?php if(is_array($topCate)): foreach($topCate as $key=>$v): ?><li role="presentation" class=""><a href="<?php echo U('index',array('cid'=>$v['id']));?>"><?php echo ($v["category_name"]); ?></a></li><?php endforeach; endif; ?>
  </ul>
  	<div class="bookslist-list">
      <?php if(is_array($booksList)): foreach($booksList as $key=>$v): ?><div class="row">
      		  <div class="col-sm-6 col-md-4">
      		    <div  class="thumbnail" >
      		      <img src="/pctushu/Uploads/mini/<?php echo ($v["books_face"]); ?>" alt="<?php echo ($v["books_name"]); ?>">
      		      <div class="caption">
      		        <h4><?php echo ($v["books_name"]); ?></h4>
      		        <p><a style="color:#2e6da4" href="<?php echo U('Member/visitor',array('uid'=>$v['uid']));?>"><?php echo ($v["name"]); ?></a><span style="color:#888; font-size:10px;float:right;padding-top:3px;"><?php echo (date("Y-m-d",$v["add_time"])); ?></span></p>
                     
                      <?php  $getMiniContentId = M('content_category')->where(array('bid'=>$v['id'],array('content_id'=>array('NEQ',0))),'AND')->order("content_id ASC")->field("content_id")->limit(1)->find(); $this->getMiniContentId = $getMiniContentId; ?>

      		        <p><a href="<?php echo U('Books/index',array('bid'=>$v['id'],'content_id'=>$getMiniContentId['content_id']));?>" class="btn btn-primary" role="button">在线阅读</a> 
                    <?php if(in_array($v['id'],$followStatus)): ?><a class="btn btn-default" style="padding:6px 10px;" role="button">已关注<strong style="color:red;" class="glyphicon glyphicon-heart"></strong></a>
                    <?php else: ?>
                      <a href="<?php echo U('Member/addFollow',array('bid'=>$v['id']));?>" class="btn btn-default" role="button">关注<strong style="color:red;" class="glyphicon glyphicon-heart-empty"></strong></a><?php endif; ?>
                  </p>
      		      </div>
      		    </div>
      		  </div>
      		</div><?php endforeach; endif; ?>
  	</div>
</div>


<nav class="books-list-page">
<div class="books-list-page"><?php echo ($page); ?></div>
</nav>



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
  <script src="/pctushu/Public/js/index.js"></script>
</body>
</html>