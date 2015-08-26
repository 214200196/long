<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>图书编辑</title>
  <link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="/pctushu/Public/css/editorbooks.css" type="text/css">
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
<div class="content-main">

    <div class="edit-left">
      <form action="<?php echo U('addContentCate',array('bid' => $booksInfo['id']));?>" method="POST">
        <div class="col-lg-6">
        <div class="select-cate-top">
             <select class="selectpicker" name="addActicleCateName">
              <optgroup label="顶级目录">
              <option>顶级</option>
              <optgroup label="点击下面一级目录添加二级目录">
              <?php if(is_array($getTopContentCate)): foreach($getTopContentCate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["content_category_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
          <div class="input-group">

            <input type="text" class="form-control" name="addContentCate" placeholder="请添加目录名称"/>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit">增加目录</button>
            </span>
          </div>
        </div>
      </form>
      <div class="content-Cate">
        <ul>
          <?php if(is_array($getAllContentCateResult)): foreach($getAllContentCateResult as $key=>$v): ?><li><a <?php if($v['content_id']): ?>style="color:blue"<?php endif; ?> href="<?php echo U('index',array('bid' => $booksInfo['id'],'cid'=>$v['id'],'content_id'=>$v['content_id']));?>">
          <?php if($v['level'] == 2): ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; if($v['level'] == 3): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; echo ($v["content_category_name"]); ?></a></li><?php endforeach; endif; ?>
        </ul>       
      </div>
  </div>
  <?php if($_GET['content_id']): ?><form action="<?php echo U('modifyContentList',array('bid' => $booksInfo['id']));?>" method="POST">
      <div class="edit-main">
        <label>绑定目录</label>
        <div class="select-box"> 
        <select class="selectpicker" name="acticleCateName">
            <option>请选择目录</option>
            <?php if(is_array($getContentCate)): foreach($getContentCate as $key=>$v): ?><option <?php if($v['id'] == $getContentList['pid']): ?>selected = "selected"<?php endif; ?> value="<?php echo ($v["id"]); ?>">
              <?php if($v['level'] == 2): ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
               <?php echo ($v["content_category_name"]); ?>
              </option><?php endforeach; endif; ?>
        </select>
        </div>

        <div class="edit-main-title">
          <label>标题 </label>
          <input type="text" class="form-control" name="acticleName" value="<?php echo ($getContentList["acticle_name"]); ?>" placeholder="请输入文章标题">
        </div>

          <div class="edit-main-title">
          <label>设置关键字（以逗号，分格多个关键字） </label>
          <input type="text" class="form-control" name="keyword" value="<?php echo ($getContentList["key_word"]); ?>" placeholder="请输入关键字">
        </div>
         
          <textarea class="form-control" rows="26" id="editor_id" name="content" ><?php echo ($getContentList["acticle_content"]); ?></textarea>
          <input type="hidden" name = "cid" value="<?php echo ($_GET['cid']); ?>"/>
          <input type="hidden" name = "content_id" value="<?php echo ($_GET['content_id']); ?>"/>
          <button type="submit" class="btn btn-success">修 改 文 章</button>
      </div>
      </form>


  <?php else: ?>
      <form action="<?php echo U('addContentList',array('bid' => $booksInfo['id']));?>" method="POST">
      <div class="edit-main">
        <label>绑定目录</label>
        <div class="select-box"> 
        <select class="selectpicker" name="acticleCateName">
            <option>请选择目录</option>
            <?php if(is_array($getContentCate)): foreach($getContentCate as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php if($v['level'] == 2): ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
               <?php echo ($v["content_category_name"]); ?>
              </option><?php endforeach; endif; ?>
        </select>
        </div>

        <div class="edit-main-title">
          <label>标题 </label>
          <input type="text" class="form-control" name="acticleName" placeholder="请输入文章标题">
        </div>

          <div class="edit-main-title">
          <label>设置关键字 </label>
          <input type="text" class="form-control" name="keyword" placeholder="请输入关键字">
        </div>
         
          <textarea class="form-control" rows="26" id="editor_id" name="content" ></textarea>

          <button type="submit" class="btn btn-success">上 传 文 章</button>
      </div>
      </form><?php endif; ?>

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

  <script type="text/javascript" src="/pctushu/editor/kindeditor.js"></script>
  <script type="text/javascript" src="/pctushu/editor/lang/zh-CN.js"></script>
 
  <script type="text/javascript">
      KindEditor.ready(function(k){
        window.editor=k.create('#editor_id');
      });
  </script>

</body>
</html>