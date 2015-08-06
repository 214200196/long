<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title>会员中心</title>
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
   

@charset "UTF-8";
/* CSS reset */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,button,textarea,p,blockquote,th,td{ margin: 0; padding: 0; }
fieldset,img{ border: 0; }
:focus{ outline: 0; }
address,caption,cite,code,dfn,em,strong,th,var,optgroup{ font-style: normal; font-weight: normal; }
h1,h2,h3,h4,h5,h6{ font-size: 100%; font-weight: normal; font-family: "Microsoft YaHei"; }
abbr,acronym{ border: 0; font-variant: normal; }
code,kbd,samp,tt{ font-size: 100%; }
input,button,textarea,select{ *font-size: 100%; border:none;}
body{ background:#fff; color:#5e5e5e; font: 14px/2em Microsoft YaHei,SimSun,Arial;}
ol,ul{ list-style: none; }
table{ border-collapse: collapse; border-spacing: 0; }
caption,th{ text-align: left; }
sup,sub{ font-size: 100%; vertical-align: baseline; }
:link, :visited, ins{ text-decoration: none; }
blockquote,q{ quotes: none; }
blockquote:before, blockquote:after, q:before, q:after{ content: ''; content: none; }
a:hover { color:#c9394a;}
a:active { color: #666;}
.clearfix:after{content:'\0020';display:block;height:0;clear:both;visibility:hidden; }
.clearfix{*zoom:1;}
.l{float:left;}
.r{float:right;}
.clear{ height:0; overflow:hidden; clear:both}
.hide{display:none;}
.btn.hide{display:none;}
a.hidefocus { outline: none; }
button.hidefocus::-moz-focus-inner { border:none; }
a:focus {outline:none;-moz-outline:none;}
input,textarea {outline:none;}
h2 { font-size: 20px; }
h3 { font-size: 16px; line-height: 32px; }
h5 { font-size: 14px; line-height: 28px; }
/*border && padding*/
.img_border { border: 4px solid #fff; border-radius: 1px;}
.bb { border-bottom: 1px solid #d2d2d2 }
.bt { border-top: 1px solid #d2d2d2 }
.pt15 { padding-top: 15px; }
.pb15 { padding-bottom: 15px; }
.p15{ padding:0 15px}
/*颜色定义*/
.color-gray,a.color-gray:link,a.color-gray:visited{color:#b7bcc0;}html,
body {
  font: 14px/1.5 "Microsoft Yahei", "Hiragino Sans GB", Helvetica, "Helvetica Neue", "微软雅黑", Tahoma, Arial, sans-serif;
  color: #14191e;
}
body {
  overflow-y: scroll;
}
body {
  min-width: 1200px;
  background-color: #edeff0;
}

a:hover,
a:active {
  color: #cc0000;
}
.clearfix:after {
  content: '\0020';
  display: block;
  height: 0;
  clear: both;
  visibility: hidden;
}
.clearfix {
  *zoom: 1;
}

.hide {
  display: none;
}
.hide-text {
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
}
.newcontainer,
.page-container {
  margin: 0 auto;
  width: 1200px;
}
.container {
  margin: 0 auto;
}
.container {
  width: 1200px;
}
#main {
  min-height: 850px;
  padding: 20px 0;
}
.waper {
  width: 1200px;
  margin: 0 auto;
}


/*翻页*/
.page {
  margin: 25px 0 auto;
  overflow: hidden;
  clear: both;
  text-align: center;
}
.page-inner {
  padding: 0 20px;
}
.page a {
  display: inline-block;
  margin: 0 5px;
  padding: 0 5px;
  min-width: 20px;
  height: 29px;
  line-height: 30px;
  font-size: 14px;
  color: #787d82;
  text-align: center;
  border-bottom: 1px solid transparent;
  -webkit-transition: border-color 0.2s;
  -moz-transition: border-color 0.2s;
  transition: border-color 0.2s;
}
.page a:hover {
  border-color: #cc0000;
  color: #cc0000;
  text-decoration: none;
}
.page a.active {
  background: #cc0000;
  color: #ffffff;
  border-color: transparent;
}
.page span,
.page-disabled {
  display: inline-block;
  padding: 0 5px;
  min-width: 20px;
  height: 39px;
  line-height: 39px;
  font-size: 14px;
  color: #c8cdd2;
  text-align: center;
}
.page-first,
.page-last {
  width: 50px;
}
.page-prev,
.page-next {
  width: 70px;
}
.page .notmargin {
  margin-right: 0;
}


body {
  background: #edeff0;
}
.container {
  width: 1200px;
  color: #656e73;
}
.fixed {
  position: fixed !important;
  top: 0;
  z-index: 9;
}
.btn-green {
  padding: 0 50px;
  height: 38px;
  line-height: 38px;
  background: #39b94e;
  border-bottom: 2px solid #33a646;
  color: #fff;
  text-align: center;
  cursor: pointer;
  display: inline-block;
  font-size: 14px;
  font-family: Microsoft YaHei;
  transition: 0.3s;
  -moz-transition: 0.3s;
  -webkit-transition: 0.3s;
  -o-transition: 0.3s;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
}
a.btn-green:hover {
  opacity: 0.8;
  filter: alpha(opacity=80);
}
a.btn-green:hover,
a.btn-green:link,
a.btn-green:visited {
  color: #fff;
}


.space-main {
  width: 880px;
}
.main-bd {
  margin-top: 10px;
}

/*个人信息*/


.family {
  margin: 15px 0 17px;
}
.family .family-hd {
  font-size: 18px;
  color: #000;
}
.course-tool-bar {
  position: relative;
  margin-top: -1px;
  padding-right: 15px;
  height: 40px;
  background-color: #f9f9f9;
  border-top: 1px solid #d0d6d9;
  font-size: 12px;
}
.course-tool-bar .tool-left > a {
  margin: 0 20px;
  line-height: 40px;
  color: #787d82;
  position: relative;
}
.course-tool-bar .tool-left > a:hover {
  color: #14191e;
}
.course-tool-bar .tool-left > a.active {
  color: #14191e;
}
.course-tool-bar .tool-left .badge {
  position: absolute;
  right: -18px;
  top: -6px;
  display: inline-block;
  width: 12px;
  height: 16px;
  padding: 0 2px;
  margin-left: 10px;
  border-radius: 8px;
  background-color: #e71f19;
  text-align: center;
  color: white;
  font-size: 12px;
  line-height: 18px;
}
.course-tool-bar .tool-right {
  color: #787d82;
}
.course-tool-bar .tool-right a {
  color: #787d82;
}
.course-tool-bar .tool-right b {
  font-weight: normal;
}
.course-tool-bar .tool-item {
  display: inline-block;
  line-height: 40px;
  margin: 0 8px;
  vertical-align: middle;
}
.course-tool-bar .all-statu {
  margin: 0 8px 0 20px;
}
.course-tool-bar .total-num {
  display: none;
  color: #b4b9be;
}
.course-tool-bar .tool-remove {
  cursor: pointer;
  vertical-align: middle;
}
.course-tool-bar .tool-remove:hover {
  color: #14191e;
}
.course-tool-bar .tool-remove .icon {
  margin-right: 5px;
}
.course-tool-bar .tool-all {
  display: inline-block;
  cursor: pointer;
  position: relative;
}
.course-tool-bar .tool-all .icon {
  vertical-align: 0;
}
.course-tool-bar .tool-chk:hover {
  color: #f01400;
}
.course-tool-bar .all-cont {
  display: none;
  width: auto;
  background-color: #fff;
  text-align: center;
  position: absolute;
  left: 50%;
  max-height: 240px;
  overflow-x: hidden;
  overflow-y: scroll;
  z-index: 1000;
  text-align: left;
  box-shadow: 0 2px 8px #bbb;
}
.course-tool-bar .all-cont li {
  height: 40px;
}
.course-tool-bar .all-cont a {
  padding: 0 15px;
  white-space: nowrap;
  font-size: 14px;
  color: #787d82;
  display: block;
  height: 40px;
  line-height: 40px;
}
.course-tool-bar .all-cont a:hover {
  background-color: #edf1f2;
  color: #14191e;
}
.course-tool-bar .tool-pager {
  position: relative;
}

.pager-action {
  display: inline-block;
  vertical-align: -5px;
  margin-left: 1px;
  width: 18px;
  height: 18px;
  border-color: #c8cdd2;
  border: 1px solid #c8cdd2;

}
.pager-action:hover {
  border-color: #14191e;
}
.pager-action.disabled {
  border-color: #c8cdd2;
  opacity: .6;
  filter: alpha(opacity=60);
  cursor: default;
}
.pager-prev {
  background-position: 6px 4px;
}
.pager-prev:hover {
  background-position: -12px 4px;
}
.pager-next {
  background-position: 6px -14px;
}
.pager-next:hover {
  background-position: -12px -14px;
}
.pager-cur {
  color: #f01400;
}

/*index less*/
.follow-list li {
  position: relative;
  border-bottom: 1px #edf0f2 solid;
  height: 152px;
  margin: 30px auto 0;
}
.follow-list li:hover .box-left img {
  /*transform: scale(1.1);
        -webkit-transform: scale(1.1);*/
}
.follow-list .change-infos {
  position: absolute;
  top: 10px;
  right: 0;
  color: #fff;
  background-color: #f01400;
  font-size: 12px;
  height: 22px;
  line-height: 22px;
  padding: 0 10px;
  border-radius: 15px;
}
.follow-list .box-left {
  width: 220px;
  margin-right: 30px;
  height: 123px;
  position: relative;
  overflow: hidden;
}
.follow-list .box-left a {
  overflow: hidden;
}
.follow-list .box-left .dot-progress {
  color: #ffffff;
  font-size: 20px;
  background: none;
  position: absolute;
  top: 89px;
  text-align: left;
  width: auto;
  height: 30px;
  line-height: 30px;
  left: 10px;
}
.follow-list .box-left img {
  -o-transition: 0.4s;
  -webkit-transition: 0.4s;
  -moz-transition: 0.4s;
  transition: 0.4s;
}
.follow-list .box-left .course-list-img {
  position: relative;
  height: 123px;
}
.follow-list .box-left .pro-bg {
  position: absolute;
  background: #000000;
  left: 0;
  top: 89px;
  width: 220px;
  height: 30px;
  opacity: 0.4;
  filter: alpha(opacity=40);
}
.follow-list .box-left .progress-bar {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 4px;
  background-color: #656e73;
}
.follow-list .box-left .bar {
  display: block;
  height: 4px;
  background-color: #00b33b;
  z-index: 1;
}
.follow-list .box-hd {
  font-size: 14px;
  color: #14191e;
  font-weight: bold;
}
.follow-list .box-hd .span-new {
  color: #787d82;
  padding-left: 20px;
  font-weight: normal;
  font-size: 12px;
}
.follow-list .box-hd .open-later-tip {
  color: #00b33b;
}
.follow-list .study-points {
  margin: 5px 0 26px;
}
.follow-list .span-common {
  font-size: 12px;
  color: #b5b9bc;
  padding-right: 10px;
}
.follow-list .span-left {
  padding-right: 40px;
}
.follow-list .box-right {
  float: left;
  overflow: hidden;
}
.follow-list .box-right .span-mid {
  padding: 0 30px 0 0;
}
.follow-list .study-btm a {
  display: inline-block;
  color: #787d82;
}
.follow-list .study-btm .study-note:hover,
.follow-list .study-btm .study-code:hover {
  color: #f01400;
}
.follow-list .study-btm .study-note:hover:hover .icon,
.follow-list .study-btm .study-code:hover:hover .icon {
  color: #f01400;
}
.follow-list .study-btm .icon {
  color: #c9ccce;
  padding: 0 5px 0 20px;
}
.follow-list .study-btm .icon-code {
  vertical-align: -2px;
}
.follow-list .beginstudy {
  height: 30px;
  width: 100px;
  margin-right: 5px;
  font-size: 12px;
  background: #00b33b;
  text-align: center;
  line-height: 31px;
  -o-transition: 0.4s;
  -webkit-transition: 0.4s;
  -moz-transition: 0.4s;
  transition: 0.4s;
}
.follow-list .beginstudy:link {
  color: #ffffff;
}
.follow-list .beginstudy:hover {
  opacity: 0.8;
  filter: alpha(opacity=80);
}
.follow-list .beginstudy:visited {
  color: #ffffff;
}
.follow-list .beginstudy.disabled {
  background-color: #b5b9bc;
  cursor: default;
}

.progress {
  background: #656e73;
  position: absolute;
  left: 0;
  top: 114px;
  z-index: 2;
  height: 6px;
  width: 220px;
  color: #00b33b;
}


body {
  background-color: #fff!important;
}
.sider {
  float: left;
  width: 240px;
  overflow: auto;
  margin-top: 20px;
  padding-bottom: 100px;
}
.user-info {
  padding-left: 100px;
  position: relative;
  min-height: 80px;
  text-align: left;
  overflow: hidden;
}
.user-info .user-pic {
  position: absolute;
  width: 80px;
  height: 80px;
  left: 0;
  top: 0;
  border-radius: 40px;
  overflow: hidden;
}
.user-info img {
  display: block;
  width: 100%;
  height: 100%;
}
.user-info .user-lay {
  overflow: hidden;
  text-overflow: ellipsis;
}
.user-info .user-lay .user-name {
  font-size: 18px;
  font-weight: bold;
  color: #14191e;
  line-height: 24px;
  display: block;
  word-break: normal;
  word-wrap: break-word;
}
.user-info .user-lay .user-site {
  margin: 2px 0 10px;
  color: #787d82;
  display: inline-block;
  font-size: 12px;
}
.user-info .user-lay .iron {
  width: 12px;
  height: 12px;
  display: inline-block;
  margin-right: 4px;
}
.user-info .user-lay .iron-drhd {
  background: url(/static/img/sitehd.png) 0 0 no-repeat;
}
.user-info .user-lay .iron-mxhd {
  background: url(/static/img/sitehd.png) 0 -12px no-repeat;
}
.user-info .user-lay .user-setup {
  color: #b5b9bc;
  font-size: 12px;
}
.user-info .user-lay .user-setup:hover {
  color: #f01400;
}
.user-info .actions a {
  display: inline-block;
  *display: inline;
  *zoom: 1;
  height: 20px;
  line-height: 20px;
  width: 60px;
  background-color: #00b33b;
  color: white;
  font-size: 12px;
  text-align: center;
}
.user-info .actions a:hover {
  background-color: #00a135;
}
.user-info .actions a.btn-send-msg {
  background-color: #0088cc;
}
.user-info .actions a.btn-send-msg:hover {
  background-color: #007ab7;
}
.user-desc {
  margin: 20px 0 17px;
  font-size: 12px;
  color: #14191e;
  line-height: 20px;
  position: relative;
}
.user-desc .sign-wrap {
  position: relative;
}
.user-desc .signed {
  word-wrap: break-word;
  word-break: break-all;
  line-height: 20px;
  font-size: 12px;
  color: #787d82;
  visibility: visible;
}

.user-desc .publish-sign:hover {
  background-position: 5px -130px;
}
.user-desc .sign-editor {
  word-wrap: break-word;
  word-break: break-all;
  line-height: 20px;
  font-size: 12px;
  color: #99a1a6;
  visibility: visible;
  position: absolute;
  top: 0;
  left: 0;
  width: 238px;
  resize: none;
  display: none;
  margin: 0;
  height: 20px;
  border: solid 1px #e6e8e9;
}
.user-desc .sign-editor.sign_block {
  display: block;
}
.user-desc .rlf-tip-wrap {
  color: red;
  margin-top: 10px;
}
.user-desc .more-info {
  margin-left: 2px;
  color: #b5b9bc;
  display: inline-block;
}
.user-desc .more-info:hover {
  color: #f01400;
}
.mp .mp-item {
  width: 50%;
  float: left;
}
.mp .mp-atag {
  float: left;
}
.mp .mp-atag:hover .mp-hover {
  color: #f01400;
}
.mp .mp-atag span {
  display: block;
  text-align: left;
}
.mp .mp-title {
  color: #787d82;
  font-size: 12px;
}
.mp .mp-num {
  font-size: 14px;
  font-weight: bolder;
  color: #14191e;
  margin-bottom: 4px;
}

.recent-visitors {
  width: 100%;
  overflow: hidden;
  margin-top: 60px;
}
.recent-visitors h4 {
  line-height: 20px;
  font-size: 16px;
  font-weight: 600;
  color: #14191e;
  text-align: left;
  padding-bottom: 18px;
  border-bottom: 1px solid #edf1f2;
}
.recent-visitors .visitors-box {
  width: 300px;
  padding-top: 5px;
}
.recent-visitors a.visitor-pic {
  float: left;
  margin-right: 26px;
  width: 40px;
  height: 40px;
  border-radius: 20px;
  overflow: hidden;
  margin-top: 20px;
}
.recent-visitors img {
  display: block;
  width: 100%;
  height: 100%;
}
.program-medias .tags {
  line-height: 100%;
}


.nav-pills li{
	width: 220px;
	background-color: #F9F9F9;
}
.nav-pills li.active a{
	  background-color: #777777;
}
.nav-pills li.active a:hover{
	  background-color: #777777;
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

<div id="main">

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
                <span class="user-site"> 未填写 </span>
            </li>
                        <li><a href="/user/userinfo" class="user-setup">设置</a></li>
                                </ul>
    </div>
    <div class="user-desc">
        <div class="sign-wrap">
                        <p id="signed" class="signed">
                <strong>这位童鞋很懒，什么也没有留下～～！</strong>
                <em class="publish-sign" id="publishsign"></em>
            </p>
            <textarea class="sign-editor" id="js-sign-editor">这位童鞋很懒，什么也没有留下～～！</textarea>
            <p id="rlf-tip-wrap" class="rlf-tip-wrap"></p>
                    </div>
    </div>
    <ul class="mp clearfix">
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
    </ul>
    <ul class="nav nav-pills">
        <li role="presentation" class="">
            <a  href=""><i class="icon-nav icon-tick"></i>我的图书<span class="badge">42</span></a>
        </li>
         <li role="presentation" class="active">
            <a  href=""><i class="icon-nav icon-tick"></i>我的图书<span class="badge">42</span></a>
        </li>
         <li role="presentation" class="">
            <a  href=""><i class="icon-nav icon-tick"></i>我的图书<span class="badge">42</span></a>
        </li>
            <li role="presentation" class="">
            <a  href=""><i class="icon-nav icon-tick"></i>我的图书<span class="badge">42</span></a>
        </li>
        <li role="presentation" class="">
            <a  href=""><i class="icon-nav icon-tick"></i>我的图书<span class="badge">42</span></a>
        </li>
            </ul>
        <div class="recent-visitors">
        <h4>最近访客</h4>
        <div class="visitors-box clearfix">
            <a href="/space/u/uid/2100338" class="visitor-pic" target="_blank">
                <img src="http://img.mukewang.com/5458622b000117dd02200220-80-80.jpg" title="zhangxh135" />
            </a>
           <a href="/space/u/uid/1948527" class="visitor-pic" target="_blank">
                <img src="http://img.mukewang.com/5458632800010f8802200220-80-80.jpg" title="qingshimoon2" />
            </a>
        </div>
    </div>
    </div><!--sider end-->
  </div>
  <div class="r space-main">
    
    <div class="family">
        <h1 class="family-hd">我发布的图书</h1>
    </div>
    <div class="course-tool-bar clearfix">
        <div class="tool-left l">
            <a href="<?php echo U('Addbooks/index');?>" class="sort-item active"><span class="glyphicon glyphicon-plus"></span>&nbsp发布图书</a>
            <a href="/space/course/t/0" class="sort-item ">更新中</a>
            <a href="/space/course/t/2" class="sort-item ">已完成</a>
        </div>
        <div class="tool-right r">
            <span class="tool-item total-num">
                共<b></b>个课程
            </span>
            <span class="tool-item tool-pager">
                <span class="pager-num">
                    <b class="pager-cur">1</b>/<em class="pager-total">4</em>&nbsp;&nbsp;
                </span>
                                <a href="javascript:void(0)" class="glyphicon glyphicon-arrow-left"></a>&nbsp;&nbsp;
                
                                <a href="/space/index/page/2" class="glyphicon glyphicon-arrow-right"></a>
                            </span>
        </div>
    </div>

    <ul class="follow-list">
                                  <li data-id="194" >
          <a class="btn-del js-btn-del"></a>
                    <div class="box-left l">
            <a href="/learn/194" title="性能优化之MySQL优化" target="_blank">
              <div class="course-list-img">
                <img src="image/apic12099.jpg" width="220" height="123" alt="性能优化之MySQL优化">
                                <div class="pro-bg"></div>
                <em class="dot-progress">0%</em>
                <div class="progress-bar">
                <i class="studyrate bar" value="0" data-finishval="0" style="width: 0%"></i>
                </div>
                              </div>
            </a>
          </div>
          <div class="box-right">
            <h3 class="box-hd">
              <span>性能优化之MySQL优化</span>
              <span class="span-new ">29分钟前更新至6-1</span>
            </h3>
            <div class="study-points">
              <span class="span-left span-common">
                            已学习至：1-1 MySQL&#20248;&#21270;&#31616;&#20171;</span>
                            <span class="span-mid span-common">学习耗时： 7分</span>
              <span class="span-right span-common">最后学习：2015-05-04</span>
            </div>
            <div class="study-btm">
                            <a href="/video/3688" class="beginstudy" data-title="1-1 内容简介" target="_blank">查看</a>
                            <a href="/video/7553" class="beginstudy" data-title="1-1 内容简介" target="_blank">编辑</a>
                            <a href="/video/7553" class="beginstudy" data-title="1-1 内容简介" target="_blank">删除</a>
              
            </div>

          </div>

        </li>
        <li data-id="382" >
          <a class="btn-del js-btn-del"></a>
           <div class="box-left l">
            <a href="/learn/382" title="C++远征之封装篇（上）" target="_blank">
              <div class="course-list-img">
                <img src="image/apic12099.jpg" width="220" height="123" alt="C++远征之封装篇（上）">
                                <div class="pro-bg"></div>
                <em class="dot-progress">12%</em>
                <div class="progress-bar">
                <i class="studyrate bar" value="12" data-finishval="12" style="width: 12%"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="box-right">
            <h3 class="box-hd">
              <span>C++远征之封装篇（上）</span>
              <span class="span-new ">1小时前更新至7-2</span>
            </h3>
            <div class="study-points">
              <span class="span-left span-common">
                            已学习至：2-3 &#32451;&#20064;</span>
                            <span class="span-mid span-common">学习耗时：21分</span>
              <span class="span-right span-common">最后学习：2015-06-25</span>
            </div>
            <div class="study-btm">
                            <a href="/video/3688" class="beginstudy" data-title="1-1 内容简介" target="_blank">查看</a>
                            <a href="/video/7553" class="beginstudy" data-title="1-1 内容简介" target="_blank">编辑</a>
                            <a href="/video/7553" class="beginstudy" data-title="1-1 内容简介" target="_blank">删除</a>
              
            </div>

          </div>
        </li>

              </ul>
          <div class="page"><span class="disabled_page">首页</span><span class="disabled_page">上一页</span><a href="javascript:void(0)" class="active">1</a><a href="/space/index/sid/0/page/2">2</a><a href="/space/index/sid/0/page/3">3</a><a href="/space/index/sid/0/page/4">4</a><a href="/space/index/sid/0/page/2">下一页</a><a href="/space/index/sid/0/page/4">尾页</a></div>
        
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
	<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>