<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>首页</title>
  <link rel="stylesheet" href="/pctushu/Public/css/bootstrap.css" type="text/css">
	<style>

	.navbar-default{
		height: 60px;
		margin-bottom: 0px;
		border-radius: 0px;
		border:none;
		background: #101010;
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
    margin-left: 5px;
  }
  .book-content-top span a{
    color:#ccc;
  }
  .book-content-top span a:hover{
    color:#fff;
  }
  .glyphicon-menu-right{
    color:#ccc;
  }

  .book-content-box{
    width: 1200px;
    min-width: 950px;
    height: auto;
    margin-right: auto;
    margin-left: auto;
  }
  .book-content-left{
    float: left;
    min-height: 950px;
    height: auto;
    width: 170px;
    background: #EDE8D5;
  }
  .book-content-left h4{
    font-weight: bold;
  /*  text-align: center;*/
  }
  .book-content-right h5{
    padding-left: 8px;
    font-weight: bold;
    margin-bottom: 15px;
  }
  .book-content-right h3{
    font-size: 10px;
  }
  .book-content-right h5 a{
    float: right;
    font-weight: bold;
    color: #337AB7;
  }
  .book-content-right h5 a:hover{
    color: #777;
  }
  .btn-primary{
    font-size: 10px;
  }

  body{
    font-size: 15px;
    background: #EDE8D5;
  }
  body a{
    color: #444444;
    text-decoration:none;
    cursor: pointer;
  }
  body a:hover{
    text-decoration: none;
  }
  body label{
    color: #444444;
    font-weight:normal;
  }
.book-content-left{
  width: 175px;
}
.book-content-left ul{
  width: 175px;
  margin-left: -40px;
}
.book-content-left ul li{
  width: 175px;
  list-style-type: none;
}

  .book-content-center{
    float: left;
    min-height: 950px;
    height: auto;
    width: 835px;
    background: #FAF7ED;

}
.book-content-center-header{
  height: 55px;
  width: 750px;
  margin:0 auto 20px auto;
  border-bottom:1px solid #E6E4D5;
}
.book-content-center-footer{
  height: 55px;
  width: 750px;
  margin:20px auto 0 auto;
  border-top: 1px solid #E6E4D5;
}

.book-content-center-header-left span{
  float: left;
  margin-right: 10px;
  font-size: 18px;
  font-weight: bold;
  line-height: 55px;
}

.book-content-center-content{
  width: 750px;
  margin:0px auto;
}

.glyphicon-circle-arrow-left{
  line-height: 55px;
  font-size: 25px;
  color: #63A742;
}
.book-content-center-header-right span{
  float: right;
  line-height: 55px;
}
.glyphicon-circle-arrow-right{
  margin-left: 10px;
  line-height: 55px;
  font-size: 25px;
  color: #63A742;
}

 .book-content-right{
    float: left;
    min-height: 950px;
    height: auto;
    width: 175px;

  }

  .thumbnail{
    width:175px;
    margin-left: 5px;
    border-radius:0px; 
    border: 0px;
    background: #FAF7ED;
  }
  .row{
    float:left;
    margin-top:-15px;
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
    <span><a href="<?php echo U('Bookslist/index');?>">图书库</a><p class="glyphicon glyphicon-menu-right"></p>
    <?php if(is_array($cateResult)): foreach($cateResult as $key=>$v): ?><a href="<?php echo U('Bookslist/index',array('cid'=>$v['id']));?>"><?php echo ($v["category_name"]); ?></a><p class="glyphicon glyphicon-menu-right"></p><?php endforeach; endif; ?>
    <a><?php echo ($booksInfo["books_name"]); ?></a></span>
  </div>
</div>
<div class="book-content-box">
    <div class="book-content-left">
        <h4>目 录</h4>
          <ul>
            <?php if(is_array($getAllContentCateResult)): foreach($getAllContentCateResult as $key=>$v): ?><li><a <?php if($v['content_id']): ?>style="color:blue"<?php endif; ?> href="<?php echo U('index',array('bid' => $booksInfo['id'],'cid'=>$v['id'],'content_id'=>$v['content_id']));?>">
              <?php if($v['level'] == 2): ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; if($v['level'] == 3): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; echo ($v["content_category_name"]); ?></a></li><?php endforeach; endif; ?>
          </ul>       
    </div>

    <div class="book-content-center">
      <div class="book-content-center-header">
         <div class="book-content-center-header-left"> 
          <span><a class="glyphicon glyphicon-circle-arrow-left"></a></span>
          <span><p><?php echo ($getContentList["acticle_name"]); ?></p></span>
          <span style="font-size:15px;font-weight:normal;">阅读: 15887 </span>
         </div>
         <div class="book-content-center-header-right">
          <span><a class="glyphicon glyphicon-circle-arrow-right"></a></span>
          <span><p>98.07%</p></span>
          </div>
      </div>
      <div class="book-content-center-content"><?php echo ($getContentList["acticle_content"]); ?></div>
        <?php if($getContentList['acticle_content']): ?><div class="book-content-center-footer">
              <div class="book-content-center-header-left"> 
              <span><a class="glyphicon glyphicon-circle-arrow-left"></a></span>
              <span><p><?php echo ($getContentList["acticle_name"]); ?></p></span>
             </div>
             <div class="book-content-center-header-right">
              <span><a class="glyphicon glyphicon-circle-arrow-right"></a></span>
              <span><p>98.07%</p></span>
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
  <script src="/pctushu/Public/js/jquery-2.1.4.min.js"></script>
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="/pctushu/Public/js/bootstrap.min.js"></script>
</body>
</html>