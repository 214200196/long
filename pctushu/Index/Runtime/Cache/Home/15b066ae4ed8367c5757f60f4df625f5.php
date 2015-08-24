<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>会员中心-<?php echo ($_SESSION['username']); ?></title>
	<link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="/pctushu/Public/css/member.css" type="text/css">
  <style>
    .books-list-page{
      width: 880px;
      margin: 0 auto;
      text-align: center;
    }
    .books-list-page .current{
      background-color:red;
      color:#fff;
    }
 </style>

</head>

<body>
<script type="text/javascript">
  var menue = <?php echo ($_GET['menue']); ?>;
</script>


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

<div id="main">
<!-- ===================会员左侧菜单===================== -->
  <div class="main-body container clearfix">
  <div class="l">
                  <div class="sider">
    <div class="user-info">
        <span class="user-pic">
            <img src="http://img.mukewang.com/5528887b0001db3e01000100-100-100.jpg" title=""/>
        </span>
        <ul class="user-lay">
            <li class="mynick-name">
                <span class="user-name"><?php echo ($username); ?></span>
            </li>
            <li>
                <span class="user-site"> <?php echo ($_SESSION['username']); ?> </span>
            </li>
            <li><a href="" class="user-setup">设置</a></li>
       </ul>
    </div>
    <div class="user-desc">
        <div class="sign-wrap">
                        <p id="signed" class="signed">
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;本网站暂时只支持图书发布, 及图书关注和阅读, 对该网站建议或发布图书时遇到问题请联系QQ:214200196</strong>
                <em class="publish-sign" id="publishsign"></em>
            </p>
            <textarea class="sign-editor" id="js-sign-editor">这位童鞋很懒，什么也没有留下～～！</textarea>
            <p id="rlf-tip-wrap" class="rlf-tip-wrap"></p>
                    </div>
    </div>
<!--     <ul class="mp clearfix">
        <li class="l mp-item">
          <span class="mp-atag">
            <p class="mp-num">231小时32分</p>
            <p class="mp-title">学习</p>
          </span>
        </li>
        <li class="mp-item">
          <a class="mp-atag" href="/space/experience">
                        <span class="mp-num mp-hover">
                11797 </span>
                        <span class="mp-title mp-hover">经验</span>
          </a>
        </li>
    </ul> -->
    <ul class="nav nav-pills">
        <li role="presentation" class="">
            <a  href="<?php echo U('index',array('menue'=>0));?>"><i class="glyphicon glyphicon-book" style="margin-right:10px;"></i>我发布的图书</a>
         <li role="presentation" class="">
            <a  href="<?php echo U('follow',array('menue'=>1));?>"><i class="glyphicon glyphicon-heart" style="margin-right:10px;"></i>我关注的图书</a>
        </li>
    </ul>
        <div class="recent-visitors">

        <ul class="mp clearfix" style="margin-bottom:10px;">
            <li class="l mp-item">
              <span class="mp-atag">
                <b class="mp-title">今日访问<span>0</span></b>
              </span>
            </li>
            <li class="l mp-item">
              <span class="mp-atag">
                <b class="mp-title">总访问<span>0</span></b>
              </span>
            </li>
        </ul>

        <h4>最近访客</h4>
        <div class="visitors-box clearfix">
            <a href="" class="visitor-pic" target="_blank">
                <img src="http://img.mukewang.com/5528887b0001db3e01000100-100-100.jpg" title="" />
            </a>
        </div>
    </div>
    </div><!--sider end-->
  </div>
  <div class="r space-main">
    
    <div class="family">
        <h1 class="family-hd">我关注的图书</h1>
    </div>
    <div class="course-tool-bar clearfix">
        <div class="tool-left l">
            <a href="" class="sort-item active"><span class="glyphicon glyphicon-heart" style="color:red;"></span>&nbsp关注的图书</a>
        </div>
        <div class="tool-right r">
            <span class="tool-item total-num">共<b></b>个课程</span>
            <span class="tool-item tool-pager">
                <span class="pager-num"><b class="pager-cur"><?php echo ((isset($_GET['p']) && ($_GET['p'] !== ""))?($_GET['p']):1); ?></b>/<em class="pager-total">4</em>&nbsp;&nbsp;</span>
                <a href="<?php echo U('index',array('p'=>$_GET['p']-1));?>" class="glyphicon glyphicon-arrow-left"></a>&nbsp;&nbsp;
                <a href="<?php echo U('index',array('p'=>$_GET['p']+1));?>" class="glyphicon glyphicon-arrow-right"></a>
            </span>
        </div>
    </div>

      <ul class="follow-list">
        <?php if(is_array($booksinfo)): foreach($booksinfo as $key=>$v): ?><li data-id="<?php echo ($v["id"]); ?>" >
                  <div class="box-left l">
                    <a href="<?php echo U('Books/index',array('id'=>$v['id']));?>" title="<?php echo ($v["books_name"]); ?>" target="_blank">
                      <div class="course-list-img">
                        <img src="/pctushu/Uploads/middle/<?php echo ($v["books_face"]); ?>" width="220" height="123" alt="<?php echo ($v["books_name"]); ?>">
                        <div class="pro-bg"></div>
                        <em class="dot-progress">10%</em>
                        <div class="progress-bar">
                        <i class="studyrate bar" value="10" data-finishval="10" style="width: 10%"></i>
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="box-right">
                      <h3 class="box-hd">
                        <span><?php echo ($v["books_name"]); ?></span>
                        <span class="span-new ">阅读: <?php echo ($v["books_counts"]); ?></span>
                        <span class="span-new ">发布: <?php echo (date("Y-m-d H:i:s",$v["add_time"])); ?></span>
                      </h3>
                      <div class="study-points">
                        <!-- <span class="span-left span-common">已学习至：1-1 MySQL&#20248;&#21270;&#31616;&#20171;</span>
                        <span class="span-mid span-common">学习耗时： 7分</span>
                        <span class="span-right span-common">最后学习：2015-05-04</span> -->
                      </div>
                      <div class="study-btm">
                      <?php  $getMiniContentId = M('content_category')->where(array('bid'=>$v['id'],array('content_id'=>array('NEQ',0))),'AND')->order("content_id ASC")->field("content_id")->limit(1)->find(); $this->getMiniContentId = $getMiniContentId; ?>
                          <a href="<?php echo U('Books/index',array('bid'=>$v['id'],'content_id'=>$getMiniContentId['content_id']));?>" class="beginstudy" data-title="1-1 内容简介" target="_blank">查看</a>
                          <a href="<?php echo U('Editorbooks/index',array('bid'=>$v['id']));?>" class="beginstudy" data-title="1-1 内容简介" target="_blank">编辑</a>
                          <!-- <a href="" class="beginstudy" data-title="1-1 内容简介">删除</a> -->
                      </div>
                  </div>
              </li><?php endforeach; endif; ?>
      </ul>
       <div class="books-list-page"><?php echo ($page); ?></div>
  </div>
</div>

</div>



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
  <script src="/pctushu/Public/js/member.js"></script>
</body>
</html>