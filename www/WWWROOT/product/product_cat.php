<?php
define("ROOTPATH", "../");
include(ROOTPATH."includes/common.inc.php");
include(ROOTPATH."member/includes/member.inc.php");
include("language/".$sLan.".php");
include("includes/product.inc.php");

SecureMember();

//定义模块名和页面名
PageSet("member","productcat");


//输出
PrintPage();


?>