<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php echo ($getContentList["key_word"]); ?>" />
    <meta name="description" content="pc图书网—只为用户提供免费精品图书，计算机（为主）、财经、英语、数学、医学、陆续健全所有体系！感谢大家支持@_@!" />
  <title><?php echo ($booksInfo["books_name"]); ?>-<?php echo ($getContentList["acticle_name"]); ?></title>
  <link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="/pctushu/Public/css/books.css" type="text/css">

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

<div class="book-content-top-box">
  <div class="book-content-top">
    <span><a href="<?php echo U('Bookslist/index');?>">图书库</a><p class="glyphicon glyphicon-menu-right"></p>
    <?php if(is_array($cateResult)): foreach($cateResult as $key=>$v): ?><a href="<?php echo U('Bookslist/index',array('cid'=>$v['id']));?>"><?php echo ($v["category_name"]); ?></a><p class="glyphicon glyphicon-menu-right"></p><?php endforeach; endif; ?>
    <a><?php echo ($booksInfo["books_name"]); ?></a></span>
  </div>
</div>
<div class="book-content-box">
    <div class="book-content-left">
        <h4>目 录</h4>
          <ul>
            <?php if(is_array($getAllContentCateResult)): foreach($getAllContentCateResult as $key=>$v): ?><li <?php if($v['content_id'] == $_GET['content_id']): ?>class="cate-active"<?php endif; ?>><?php if($v['content_id']): ?><a style="color:#337ab7"  href="<?php echo U('index',array('bid' => $booksInfo['id'],'cid'=>$v['id'],'content_id'=>$v['content_id']));?>"><?php endif; ?>
              <?php if($v['level'] == 2): ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; if($v['level'] == 3): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; echo ($v["content_category_name"]); if($v['content_id']): ?></a><?php endif; ?></li><?php endforeach; endif; ?>
          </ul>       
    </div>

    <div class="book-content-center">
      <div class="book-content-center-header">
         <div class="book-content-center-header-left"> 
          <span>
            <?php if($_GET['content_id'] != $getMiniContentId['content_id']): ?><a class="glyphicon glyphicon-circle-arrow-left" href="<?php echo U('index',array('bid'=>$_GET['bid'],'content_id'=>$_GET['content_id']-1));?>" title="上一页"></a><?php endif; ?>
          </span>
          <span><p><?php echo ($getContentList["acticle_name"]); ?></p></span>
          <span style="font-size:15px;font-weight:normal;">阅读: <?php echo ($getContentList["acticle_click"]); ?> </span>
          <span style="font-size:12px;font-weight:normal;margin-left:50px;color:#999;">该图书内容源于网络用户上传，如有侵权请联系我!</span>
         </div>
         <div class="book-content-center-header-right">
          <span>
            <?php if($_GET['content_id'] < $getMaxContentId['content_id']): ?><a class="glyphicon glyphicon-circle-arrow-right" href="<?php echo U('index',array('bid'=>$_GET['bid'],'content_id'=>$_GET['content_id']+1));?>" title="下一页"></a><?php endif; ?>
          </span>
          </div>
      </div>
      <div class="book-content-center-content"><?php echo ($getContentList["acticle_content"]); ?></div>
        <?php if($getContentList['acticle_content']): ?><div class="book-content-center-footer">
              <div class="book-content-center-header-left"> 
              <span><?php if($_GET['content_id'] != $getMiniContentId['content_id']): ?><a class="glyphicon glyphicon-circle-arrow-left" href="<?php echo U('index',array('bid'=>$_GET['bid'],'content_id'=>$_GET['content_id']-1));?>" title="上一页"></a><?php endif; ?></span>
              <span><p><?php echo ($getContentList["acticle_name"]); ?></p></span>
              <span style="font-size:12px;font-weight:normal;margin-left:100px;color:#999;">该图书内容源于网络用户上传，如有侵权请联系我!</span>
             </div>
             <div class="book-content-center-header-right">
              <span><?php if($_GET['content_id'] < $getMaxContentId['content_id']): ?><a class="glyphicon glyphicon-circle-arrow-right" href="<?php echo U('index',array('bid'=>$_GET['bid'],'content_id'=>$_GET['content_id']+1));?>" title="下一页"></a><?php endif; ?></span>
              <span><p><?php echo ($booksPercent); ?>%</p></span>
              </div>
          </div><?php endif; ?> 
    </div>

    <div class="book-content-right">
      <h5>猜你喜欢<p style="color:red;" class="glyphicon glyphicon-heart"></p><a class="glyphicon glyphicon-refresh"></a></h5>
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div  class="thumbnail" >
              <img src="image/apic12099.jpg" alt="...">
              <div class="caption">
                <h3>Thumbnail label</h3>
                <p>...</p>
                <p><a href="#" class="btn btn-primary" role="button">在线阅读</a> <a href="#" class="btn btn-default" role="button">关注<strong style="color:red;" class="glyphicon glyphicon-heart-empty"></strong></a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <div  class="thumbnail" >
              <img src="image/apic12099.jpg" alt="...">
              <div class="caption">
                <h3>Thumbnail label</h3>
                <p>...</p>
                <p><a href="#" class="btn btn-primary" role="button">在线阅读</a> <a href="#" class="btn btn-default" role="button">关注<strong style="color:red;" class="glyphicon glyphicon-heart-empty"></strong></a></p>
              </div>
            </div>
          </div>
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
  <script type="text/javascript">
  $(function(){
    $(".cate-active").children().css('color','red');
  });
  </script>
</body>
</html>