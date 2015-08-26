<?php
include_once ('../nusoap/nusoap.php');
include_once ('../../includes/data.inc.php');
$server   = "http://update.phpweb.net/remote/webservice/soapserver.php";
$customer = new soapclientx ($server);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
set_magic_quotes_runtime(0);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link  href="images/style.css" type="text/css" rel="stylesheet">
<title>安装向导 - Powered by PHPWEB.NET</title>
<script type="text/javascript" src="../js/base.js"></script>
<script type="text/javascript" src="js/install.js"></script>

</head>
<?php
$step = 3;


if ($_POST['command'] == "gonext") {
	if ($_POST['nextstep'] == 0) {
		$donext = true;
	}
	if ($_POST['nextstep'] == 1) {

			$c_params = array (
				'username' => $_POST['username'], 
				'password' => $_POST['password'],
				'domain' => $_SERVER['HTTP_HOST']
				);
			$ans = $customer -> call ("iChkUser", $c_params);
			if ($err=$customer->getError()) {
				$errinfo=$customer->response;
				$error_msg="<font style=\"color: red;\">无法连接到验证服务器，错误信息：".$errinfo."</font><br /><br />";
				$noinstall="<script>document.all['subm'].disabled = true;</script>";
				$donext=false;
			}elseif($ans==false || $ans==""){
					$error_msg = "<font style=\"color: red;\">无法连接到验证服务器，请检查是否已连接网络，或稍侯再试！</font>";
					$noinstall= "<script>document.all['subm'].disabled = true;</script>";
					$donext= false;
			}elseif($ans=="NOUSER") {
					$error_msg = "<font color='red'>会员登录账号或密码错误，请重新输入正确的登录帐号和密码</font><br /><br />";
					$donext= false;
			}elseif($ans!="OK") {
					$error_msg = "<font color='red'>身份验证未通过：".$ans."</font><br /><br />";
					$donext= false;
			}else{
				$donext=true;
			}
	}
	if ($_POST['nextstep'] == 2) $donext = true;
	if ($_POST['nextstep'] == 3) {
		
		$connect =  @mysql_connect($_POST['dbhost'],$_POST['dbuser'],$_POST['dbpwd']);

		$dbhost=$_POST['dbhost'];
		$dbuser=$_POST['dbuser'];
		$dbpwd=$_POST['dbpwd'];
		$dbname=$_POST['dbname'];
		$tablepre=$_POST['tablepre'];

		if (!$connect) {
			$error_msg = "<font color='red'>数据库服务器连接失败。请检查输入信息是否正确！</font><br /><br />";
			$donext    = false;
		} else {
				$caninstall=1;
				$mysqlvision=substr(mysql_get_server_info(),0,4);
				if($mysqlvision<4.1){
					$error_msg = "<font color='red'>Mysql数据库必须使用4.1以上版本</font><br /><br />";
					$donext    = false;
					$caninstall=0;
				}

				mysql_query("SET character_set_connection='utf8', character_set_results='utf8', character_set_client='utf8'");

		
				//安装数据库
				$table_num=0;
				$dbname=$_POST['dbname'];
				$sql_file="./db/db.sql";

				$view_bookmark = 0;
				if (file_exists($sql_file)) {
					$sql_query = fread(fopen($sql_file, 'r'), filesize($sql_file));
					if (get_magic_quotes_runtime() == 1) {
						$sql_query = stripslashes($sql_query);
					}

				}else{
					$error_msg = "<font color='red'>数据库导入文件/base/install/db/db.sql不存在</font><br /><br />";
					$donext    = false;
					$caninstall=0;
				}

				if($caninstall=="1"){
					$sql_query = trim($sql_query);
					if ($sql_query != '') {
						$sql_query    = remove_remarks($sql_query);
						$pieces       = split_sql_file($sql_query, ';');
						$pieces_count = count($pieces);
						if (mysql_select_db($dbname, $connect)) {
							for ($i = 0; $i < $pieces_count; $i++) {
								$a_sql_query = trim($pieces[$i]);
								if (!empty($a_sql_query) && $a_sql_query[0] != '#') {
									$a_sql_query=str_replace("dev_",$tablepre."_",$a_sql_query);
									$result = mysql_query($a_sql_query);
									if ($result == FALSE) { 
										$error_msg = "<font color='red'>数据导入失败！</font><br /><br />";
										$donext    = false;
									
									}
								}
							} 
						}else{
							$error_msg = "<font color='red'>不可使用数据库，请检查数据库是否存在、用户是否有权访问该数据库！</font><br /><br />";
							$donext    = false;
							$caninstall=0;

						}
					
				} 

				if($caninstall=="1"){
					$result=mysql_list_tables($dbname,$connect);
					
					$i = 0;
					while ($i < mysql_num_rows ($result)) {
						$tb_names[$i] = mysql_tablename ($result, $i);
						$table_name.="导入数据表 ".$tb_names[$i] . "&nbsp;&nbsp; .........OK<br />";
						$i++;
					}

					$table_num=$i;


					//修改配置文件

					$ConFile="../../config.inc.php";
					$SysConfigFile="./inc.php";

					
					$siteurl="http://".$_SERVER["HTTP_HOST"]."/";

					$filestr = fread(fopen($SysConfigFile, 'r'),30000);
					$filestr=str_replace(" ","",$filestr);
					$filestr=str_replace("DefaultDbHost",$dbhost,$filestr);
					$filestr=str_replace("DefaultDbName",$dbname,$filestr);
					$filestr=str_replace("DefaultDbUser",$dbuser,$filestr);
					$filestr=str_replace("DefaultDbPass",$dbpwd,$filestr);
					$filestr=str_replace("DefaultsLan","zh_cn",$filestr);
					$filestr=str_replace("DefaultTablePre",$tablepre,$filestr);
					$filestr=str_replace("DefaultSiteUrl",$siteurl,$filestr);

					fwrite(fopen($ConFile,"w"),$filestr,30000);

					$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\"><input type=\"hidden\" name=\"db_host\" value=\"" . $_POST['dbhost'] . "\"><input type=\"hidden\" name=\"db_name\" value=\"" . $_POST['dbname'] . "\"><input name=\"db_user\" type=\"hidden\" value=\"" . $_POST['dbuser'] . "\"><input name=\"db_pwd\" type=\"hidden\" value=\"" . $_POST['dbpwd'] . "\"><input name=\"tablepre\" type=\"hidden\" value=\"" . $_POST['tablepre'] . "\"><input name=\"siteurl\" type=\"hidden\" value=\"" . $siteurl . "\">";
					$step_content .= "<tr><td style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>5</strong> 步：导入系统初始数据 <br><hr size=\"1\" width=\"98%\" align=\"left\">" . $error_msg . "</td></tr>";
					$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">" . $table_name . "</td></tr>";
					$step_content .= "<tr><td style=\"font-size: 14px; color: #999999; line-height: 150%\">" . $table_num . " 个数据表已导入</td></tr>";
					$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\"><hr size=\"1\" width=\"98%\" align=\"left\"></td></tr>";
					$step_content .= "</table>";
				
					$donext = true;
				}
			}
		}
	}
	if ($_POST['nextstep'] == 4)  $donext = true;
	if ($_POST['nextstep'] == 5) {
		
		//修改管理员密码和用户绑定
		$admin_user=$_POST["admin_user"];
		$admin_pass=$_POST["admin_pass"];
		$dbhost=$_POST["dbhost"];
		$dbuser=$_POST["dbuser"];
		$dbpwd=$_POST["dbpwd"];
		$dbname=$_POST["dbname"];
		$username=$_POST["username"];
		$tablepre=$_POST["tablepre"];
		$siteurl=$_POST['siteurl'];
		

		$mdpass=md5($admin_pass);

		$connect = @mysql_connect($dbhost, $dbuser, $dbpwd); 
		if ($connect) {
			mysql_query("update ".$dbname.".".$tablepre."_base_admin set user='$admin_user',password='$mdpass'", $connect);
			mysql_query("update ".$dbname.".".$tablepre."_base_adminrights set user='$admin_user'", $connect);
			mysql_query("update ".$dbname.".".$tablepre."_base_config set `value`='$username' where `variable`='phpwebUser'", $connect);
			mysql_query("update ".$dbname.".".$tablepre."_base_config set `value`='$siteurl' where `variable`='SiteHttp'", $connect);
		}


		$donext = true;
	}

	if ($_POST['nextstep'] == 6){
		
		echo "<script>window.location.href = '../../admin.php'</script>";
	}
	
	if($donext){
		$step = $_POST['nextstep'] + 1;
		
	}else{
		$step = $_POST['nextstep'];
		
		
	}

}else if ($_POST['command'] == "goprev"){
	$step = $_POST['nextstep'] - 1;
}

if ($step != 0) {
	$prev = "<input id=\"ddd\" type=\"submit\" value=\"上一步\" class='button' onClick=\"command.value='goprev'\">";
	$next = "<input id=\"subm\" type=\"submit\" value=\"下一步\" class='button' onClick=\"command.value='gonext'\">";
}
if ($step == 0) {
	$next    = "<input id=\"subm\" type=\"submit\" class='button' value=\"接受协议\" onClick=\"command.value='gonext'\" ><br>";
	$unagree = "<input type=\"button\" class='button' value=\"不接受协议\" onClick=\"window.location.href='http://www.phpweb.net'\">";

	$step_caption = array (
		"0" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);
	$protocol_con = "PHPWEB分享式智能网站管理系统-是一款具有专业级功能和傻瓜式管理的网站管理软件。全新的可视化插件拖放排版模式，让网站制作如同搭积木般便捷易玩；独立的插件、边框、菜单灵活组合和任意定位，让您摆脱页面框架的束缚，尽享创意的乐趣；无限扩展、共同分享的插件和模版资源让您的网站越来越丰富多彩；专业的网站内容管理功能、灵活的权限配置、强大的会员功能，让您DIY制作的网站绝不逊色于专业开发；模块化的构架，支持今后专业模块的无限扩展，打造多功能门户平台；PHPWEB基础版现已集成了基础模块和单页、文章、图片、下载、点评、会员、广告、素材特效等应用模块，无需购买授权证书，可直接安装并免费应用于非商业用途。PHPWEB是您高效、便捷的网站创建和管理工具。

PHPWEB软件官方网站：<a href='http://www.phpweb.net' target='_blank' >WWW.PHPWEB.NET</a>

软件使用协议：

一、协议许可的权利
1、PHPWEB软件由嘉兴市名典网络技术有限公司开发并拥有著作权，按本协议授权给用户使用
2、用户可以直接安装本软件并应用于非商业用途，无需支付软件授权费用
3、非商业授权用户可以通过帮助文档和互动交流，学习使用本软件或参与资源开发分享
4、商业授权用户可以根据其订购的服务套餐，享有相应的官方支持服务
5、用户拥有使用本软件构建的网站中全部会员资料、内容及相关信息的所有权，并独立承担与网站内容相关的法律义务

二、协议规定的约束和限制
1、未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站）
2、将软件应用于商业用途，必须向PHPWEB开发商或其授权代理商购买商业授权
3、未经书面授权，禁止出售、出租本软件或提供本软件相关的收费服务
4、软件插件、模版的资源分享必须在PHPWEB官方网站进行，未经授权禁止设立提供PHPWEB资源下载或交易的网站
5、未经书面许可，禁止修改软件后台的版权信息和软件标志，非商业用户必须保留网站底部的PHPWEB版权信息和链接
6、禁止在本软件整体或任何部分基础上发展任何派生版本、修改版本或第三方版本用于重新分发
7、如果用户未能遵守本协议的条款，使用权将被终止，所被许可的权利将被收回，并承担相应法律责任

三、免责声明
1、本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的 
2、用户自愿使用本软件，在尚未购买商业授权所配套的技术服务之前，我们不承诺提供任何形式的技术支持和使用保证，不承担任何因使用本软件而产生问题的相关责任
3、我们不对使用本软件构建的网站中的文章、信息等任何内容承担责任，不对使用本软件从事任何商业行为所产生的纠纷承担责任

";
	$protocol_con=str_replace("\n","<br>",$protocol_con);
	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"5\">";
	$step_content .= "<tr><td style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>1</strong> 步：软件介绍和使用协议<br><hr size=\"1\" width=\"98%\" align=\"left\"></td></tr>";
	$step_content .= "<tr><td>" . $protocol_con . "</td></tr>";
	$step_content .= "</table>";
} else if ($step == 1) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);
	
	
	if($_POST['nextstep']!=1){
		$error_msg = "注：请输入您在PHPWEB官方网站的会员登录账号和密码，系统将和您的会员帐户绑定，用于<br />软件升级等远程服务。如果您尚未申请PHPWEB会员帐号，<a href='http://www.phpweb.net/member/reg.php' target='_blank' class='un'>点这里立即申请</a><br /><br />";
	}
	
	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
	$step_content .= "<tr><input type=\"hidden\" name=\"skip\" value=\"" . $skip_step . "\"><td colspan=\"2\" style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>2</strong> 步：用户身份验证<br><hr size=\"1\" width=\"98%\" align=\"left\"></td><tr><td colspan=2 height=36>". $error_msg . "</td></tr>";
	$step_content .= "<tr><td align=\"right\" >登录账号</td><td style=\"font-size: 12px;\"><input type=\"text\" name=\"username\" size=\"20\" value='".$_POST[username]."'></td></tr>";
	$step_content .= "<tr><td align=\"right\" >登录密码</td><td style=\"font-size: 12px;\"><input name=\"password\" type=\"password\" size=\"20\"  value='".$_POST[password]."'></td></tr>";
	$step_content .= "<tr><td colspan=\"2\" height=\"20\"></td></tr>";
	$step_content .= "<tr><td colspan=\"2\" ><hr size=\"1\" width=\"98%\" align=\"left\"></td></tr>";
	$step_content .= "</table>";

} else if ($step == 2) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);
	
	//php版本检测
	$php_version = substr(PHP_VERSION,0,3)+0;
	if ($php_version < 4.2 || $php_version > 5.9){
		$phpmsg="<font color='red'>× (PHP版本不适合安装本软件，必须使用PHP4.2.x-PHP5.x版本)</font>";
		$noinstall="<script>document.all['subm'].disabled = true;</script>";
	}else{
		$phpmsg = "<font color='#666666'>√</font>";
	}
	
	//安全模式检测
	if (get_cfg_var ("safe_mode") == 1) {
		$safe_mode_caption = "ON";
		$safemsg = "<font color='red' >× (本系统在PHP安全模式下不可运行)</font>";
		$noinstall="<script>document.all['subm'].disabled = true;</script>";
	} else {
		$safe_mode_caption = "OFF";
		$safemsg = "<font color=#666666 style='font-size: 14px; '>√</font>";
	}

	

	//config文件权限检测
	if (!is_writable("../../config.inc.php")) {
		$confdir = "不可写";
		$confmsg = "<font color='red' >× (请设置config.inc.php文件为可读写，如666)</font>";
		$noinstall = "<script>document.all['subm'].disabled = true;</script>";

	}else{
		$confdir = "可读写";
		$confmsg = "<font color='#666666' >√</font>";

	}

	//file_uploads检测
	$upload = get_cfg_var ("file_uploads");
	if ($upload != "1") {
		$uploadsay="Off";
		$uploadmsg = "<font color=red style='font-size: 14px; '>× (当前PHP环境关闭了文件上传功能，网站将无法上传图片和文件)</font>";
		$noinstall      = "<script>document.all['subm'].disabled = true;</script>";
	}else{
		$uploadsay="On";
		$uploadmsg = "<font color=#666666 style='font-size: 14px; '>√</font>";
	}


	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
	$step_content .= "<tr><td style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>3</strong> 步：检测服务器环境<br><hr size=\"1\" width=\"98%\" align=\"left\">" . $error_msg . "</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">操作系统：" . PHP_OS . "  ...√</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">服务器软件：" . $_SERVER['SERVER_SOFTWARE'] . "  ...√</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">PHP版本：" . $php_version . "  ...".$phpmsg."</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">安全模式：" . $safe_mode_caption . "  ..." . $safemsg . "</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">CONFIG文件权限： ".$confdir."  ..." . $confmsg. "</td></tr>";
	$step_content .= "<tr><td style=\"font-size: 14px; color: #999999;\">文件上传权限：" . $uploadsay . "  ...".$uploadmsg."</td></tr>";
	$step_content .= "</table>";

} else if ($step == 3) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);

	if($_POST["tablepre"]!=""){
		$tablepre=$_POST["tablepre"];
	}else{
		$tablepre="pwn";
	}
	
	
	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
	$step_content .= "<tr><td colspan=\"2\" style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>4</strong> 步：设置数据库参数<br><hr size=\"1\" width=\"98%\" align=\"left\">" . $error_msg . "</td></tr>";
	$step_content .= "<tr><td align=\"right\" style=\"font-size: 14px; color: #000000;\">数据库服务器</td><td><input name=\"dbhost\" type=\"text\" value=\"localhost\" size=\"20\"> *</td></tr>";
	$step_content .= "<tr><td align=\"right\" style=\"font-size: 14px; color: #000000;\">数据库名称</td><td><input name=\"dbname\" type=\"text\" size=\"20\" value='".$_POST["dbname"]."'> *</td></tr>";
	$step_content .= "<tr><td align=\"right\" style=\"font-size: 14px; color: #000000;\">数据库用户</td><td><input name=\"dbuser\" type=\"text\" size=\"20\" value='".$_POST["dbuser"]."'> *</td></tr>";
	$step_content .= "<tr><td align=\"right\" style=\"font-size: 14px; color: #000000;\">数据库密码</td><td><input name=\"dbpwd\" type=\"text\" size=\"20\" value='".$_POST["dbpwd"]."'> *</td></tr>";
	$step_content .= "<tr><td align=\"right\" style=\"font-size: 14px; color: #000000;\">数据表前缀</td><td><input name=\"tablepre\" type=\"text\" size=\"20\" value='".$tablepre."'> *</td></tr>";
	$step_content .= "<tr><td colspan=\"2\" style=\"font-size: 14px; color: #999999;\"><hr size=\"1\" width=\"98%\" align=\"left\"></td></tr>";
	$step_content .= "</table>";
} else if ($step == 4) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);
} else if ($step == 5) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->"),
		"6" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => "")
	);
	
	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"3\"><input type=\"hidden\" name=\"dbhost\" value=\"" . $_POST['db_host'] . "\"><input type=\"hidden\" name=\"dbname\" value=\"" . $_POST['db_name'] . "\"><input name=\"dbuser\" type=\"hidden\" value=\"" . $_POST['db_user'] . "\"><input name=\"dbpwd\" type=\"hidden\" value=\"" . $_POST['db_pwd'] . "\"><input name=\"tablepre\" type=\"hidden\" value=\"" . $_POST['tablepre'] . "\"><input name=\"siteurl\" type=\"hidden\" value=\"" . $_POST['siteurl'] . "\">";
	$step_content .= "<tr><td colspan=\"2\" style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>6</strong> 步：设置网站管理员密码<br><hr size=\"1\" width=\"98%\" align=\"left\">" . $error_msg . "</td></tr>";
	$step_content .= "<tr><td align=\"right\" >网站管理员用户名</td><td><input type=\"text\" name=\"admin_user\" value=\"admin\"> * </td></tr>";
	$step_content .= "<tr><td align=\"right\" >网站管理员密码</td><td><input type=\"text\" name=\"admin_pass\"> *</td></tr>";
	$step_content .= "<tr><td colspan=\"2\" style=\"font-size: 14px; \"><hr size=\"1\" width=\"98%\" align=\"left\"></td></tr>";
	$step_content .= "</table>";
} else if ($step == 6) {
	$step_caption = array (
		"0" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"1" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"2" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"3" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"4" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"5" => array ("bgcolor" => "#244A6C", "fontcolor" => "#ffffff", "tag" => ""),
		"6" => array ("bgcolor" => "#dddddd", "fontcolor" => "#999999", "tag" => "->")
	);
	$prev ="";
	$next          = "<input id=\"subm\" type=\"button\" value=\"查看网站\" onClick=\"window.location='../../'\">&nbsp;<input id=\"sys\" type=\"button\" value=\"管理登录\" onClick=\"window.open('../../admin.php','_blank')\">";
	$step_content .= "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"4\">";
	$step_content .= "<tr><td style=\"font-size: 16px; color: #003399; font-weight:bold;\">PHPWEB安装向导 - 第 <strong>7</strong> 步：安装完成<br><hr width=\"98%\" size=\"1\" align=\"left\"></td></tr>";
	$step_content .= "<tr><td>系统安装完成！<br><br>请删除 [ install ] 目录<br><br></td></tr>";
	$step_content .= "</table>";
}
?>
<body>
  <table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="229" valign="top" align="center"> 
        <table width="100%"  border="0" cellpadding="5" cellspacing="0">
          <tr> 
            <td align="center"><img src="images/installlogo.gif" width="229" height="95"></td>
          </tr>
          <tr> 
            <td height="90" valign="top" style="font-size:12px;color: #00F">www.phpweb2.com</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[0]["bgcolor"]?>" class="font_13_w" style="border-top: 1 solid #ffffff; border-bottom: 1 solid #ffffff; border-right: 3 solid #ffcc00; color: <?php echo $step_caption[0]["fontcolor"]?>"><?php echo $step_caption[0]["tag"];?>&nbsp;软件介绍和使用协议</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[1]["bgcolor"]?>" class="font_13_w" style="border-right: 3 solid #ffcc00; color: <?php echo $step_caption[1]["fontcolor"]?>"><?php echo $step_caption[1]["tag"];?>&nbsp;用户身份验证</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[2]["bgcolor"]?>" class="font_13_w" style="border-top: 1 solid #ffffff; border-right: 3 solid #ffcc00; color: <?php echo $step_caption[2]["fontcolor"]?>"><?php echo $step_caption[2]["tag"];?>&nbsp;检测服务器环境</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[3]["bgcolor"]?>" class="font_13_w" style="border-top: 1 solid #ffffff; border-right: 3 solid #ffcc00; color: <?php echo $step_caption[3]["fontcolor"]?>"><?php echo $step_caption[3]["tag"];?>&nbsp;设置数据库参数</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[4]["bgcolor"]?>" class="font_13_w" style="border-top: 1 solid #ffffff; border-bottom: 1 solid #ffffff; border-right: 3 solid #ffcc00; color: <?php echo $step_caption[4]["fontcolor"]?>"><?php echo $step_caption[4]["tag"];?>&nbsp;导入系统初始数据</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[5]["bgcolor"]?>" class="font_13_w" style="border-right: 3 solid #ffcc00; color: <?php echo $step_caption[5]["fontcolor"]?>"><?php echo $step_caption[5]["tag"];?>&nbsp;设置网站管理员密码</td>
          </tr>
          <tr> 
            <td align="right" bgcolor="<?php echo $step_caption[6]["bgcolor"]?>" class="font_13_w" style="border-top: 1 solid #ffffff; border-bottom: 1 solid #ffffff; border-right: 3 solid #ffcc00; color: <?php echo $step_caption[6]["fontcolor"]?>"><?php echo $step_caption[6]["tag"];?>&nbsp;安装完成</td>
          </tr>
        </table>
        <br>
        <br>
        <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr> 
            <td align="center"><p style="FONT:bold 12px/20px Verdana, Arial, Helvetica, sans-serif;color:#fff;">Powered By <a href="http://www.phpweb.net" style="color:#fff;">phpweb.net</a></td>
          </tr>
        </table>
      </td>
      <td valign="top" bgcolor="#FFFFFF" style="padding:35px 20px">
	  
	  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
         
      </table>
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
		<form name="form" action="" method="post" onSubmit="return CheckForm (this, '<?php echo $step;?>');">
		  <tr>
            <td style="padding-left: 10px; padding-top: 5px; padding-bottom: 5px;" align="left"><?php echo $step_content;?></td>
          </tr>
          <tr>
            <td style="padding-left: 10px;"><?php echo $prev;?>
              <?php echo $unagree . "&nbsp;" . $next . "&nbsp;" . $download;?>
              <input type="hidden" name="nextstep" value="<?php echo $step;?>">
              <input type="hidden" name="command" value="gonext">
              <input type="hidden" name="alertmsg" value="<?php echo $msg;?>">
			  <?php 
				if($step>1){
				 echo "<input type='hidden' name='username' value='".$_POST["username"]."' />";
				}
			  ?>
             
              </td>
          </tr>
		  </form>
        </table></td>
    </tr>
  </table>
</body>
</html>
<?php
echo $noinstall;
?>