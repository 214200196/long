<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>图书库</title>
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





/* v2 */
.container {
  width: 1200px;
}

.course-content {
  float: none;

}
.course-nav-hd {
  position: relative;
  height: 50px;
  line-height: 50px;
  border-bottom: 1px solid #d0d6d9;
  font-size: 16px;
  font-weight: bold;
  color: #14191e;
}
.course-nav-row { 
  border-bottom: 1px solid #edf1f2;

}
.course-nav-row .hd {
    width: 56px;
    height: 30px;
    line-height: 30px;
    font-size: 12px;
    color: #787d82;
    text-align: right;
    padding-top: 7.5px;

}

.l {
    float: left;
}

.course-nav-item {
  display: inline-block;
  *display: inline;
  *zoom: 1;
  padding: 7.5px 10px 0px 5px;


}
.course-nav-item a {
  display: block;
  height: 30px;
  line-height: 30px;
  padding: 0 6px;
  font-size: 12px;
}
.course-nav-item.on a {
  background: #f01400;
  color: #fff;
}






  body{
    font-size: 15px;
    background: #fff;
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


    .thumbnail{
      width:191px;
      padding-top: 8px;
      margin-left: 4px;
      margin-right: 4px;
      border-radius:0px; 
      border: 0px;
    }
    .row{
      float:left;
    }
    .nav-tabs{
      width:1200px;
    }
    .bookslist{
      width: 1200px;
      margin-left: auto;
      margin-right: auto;
      margin-top: 5px;
    }
    .bookslist-list{
      border: 1px solid #ccc;
      border-top:0px;
      width:1200px;
      height:auto;
      min-height:700px; 
    }
    .books-list-page{
      width: 1200px;
      margin-left: auto;
      margin-right: auto;
    }
    .pagination{
      margin-left: 460px;
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
<script type="text/javascript">
  var cid = <?php echo ($cid); ?>;
</script>

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

    <div class="container">
        <div class="course-content">
            <div class="course-nav-box">
                <div class="course-nav-hd">
                    <span>全部图书</span>
                </div>
                <div class="course-nav-row clearfix">
                    <span class="hd l">专业：</span>
                    <div class="bd">
                        <ul class="">
                            <li class="course-nav-item on">
                                <a href="/course/list">全部</a>
                            </li>
                             <li class="course-nav-item">
                                    <a href="" data-ct="fe">计算机</a>
                                </li>
                               <li class="course-nav-item">
                                    <a href="" data-ct="be">经济</a>
                                </li>
                               <li class="course-nav-item">
                                    <a href="" data-ct="mobile">外语</a>
                                </li>
                                 <li class="course-nav-item">
                                 <a href="" data-ct="data">医学</a>
                                </li>
                                  <li class="course-nav-item">
                                    <a href="" data-ct="photo">文学</a>
                                </li>
                          </ul>
                    </div>
                </div>
                <div class="course-nav-row clearfix">
                    <span class="hd l">方向：</span>
                    <div class="bd">
                        <ul class="">
                            <li class="course-nav-item on">
                                <a href="/course/list">全部</a>
                            </li>
                             <li class="course-nav-item">
                                    <a href="" data-ct="fe">前端开发</a>
                                </li>
                               <li class="course-nav-item">
                                    <a href="" data-ct="be">后端开发</a>
                                </li>
                               <li class="course-nav-item">
                                    <a href="" data-ct="mobile">移动开发</a>
                                </li>
                                 <li class="course-nav-item">
                                 <a href="" data-ct="data">数据处理</a>
                                </li>
                                  <li class="course-nav-item">
                                    <a href="" data-ct="photo">图像处理</a>
                                </li>
                          </ul>
                    </div>
                </div>
            </div>
                <div class="course-nav-row clearfix">
                    <span class="hd l">分类：</span>
                    <div class="bd">
                        <ul class="">
                             <li class="course-nav-item on">
                                <a href="">全部</a>
                            </li>
                               <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>      <li class="course-nav-item ">
                                   <a href="" data-id=7 data-ct=fe>HTML/CSS</a>
                              </li>
                        </ul>
                    </div>
                </div>
                <div class="course-nav-row clearfix">
                    <span class="hd l">难度：</span>
                    <div class="bd">
                        <ul class="">
                             <li class="course-nav-item  on">
                                <a href="">全部</a>
                            </li>
                            <li class="course-nav-item ">
                                <a href="">初级</a>
                            </li>
                             <li class="course-nav-item ">
                                <a href="">中级</a>
                            </li>
                             <li class="course-nav-item ">
                                <a href="">高级</a>
                            </li>
                        </ul>
                    </div>
                </div>
         </div>
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
                  <p><a style="color:#2e6da4" href="<?php echo U('Member/index',array('uid'=>$v['uid']));?>"><?php echo ($v["name"]); ?></a><span style="color:#888; font-size:10px;float:right;padding-top:3px;"><?php echo (date("Y-m-d",$v["add_time"])); ?></span></p>
                  <p><a href="<?php echo U('Books/index',array('bid'=>$v['id']));?>" class="btn btn-primary" role="button">在线阅读</a> <a href="#" class="btn btn-default" role="button">关注<strong style="color:red;" class="glyphicon glyphicon-heart-empty"></strong></a></p>
                </div>
              </div>
            </div>
          </div><?php endforeach; endif; ?>
    </div>
</div>


<nav class="books-list-page">
  <ul class="pagination">
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    <li class=""><a href="#">2<span class="sr-only">(current)</span></a></li>
    <li class=""><a href="#">3<span class="sr-only">(current)</span></a></li>
    <li class=""><a href="#">4<span class="sr-only">(current)</span></a></li>
    <li class=""><a href="#">...<span class="sr-only">(current)</span></a></li>
    <li class=""><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
  </ul>
</nav>


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
    <script src="/pctushu/Public/js/index.js"></script>
</body>
</html>