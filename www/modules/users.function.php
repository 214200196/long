<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

if (!defined ( 'ROOT_PATH')) 
{
	echo "<script>window.location.href='/404.htm';</script>";
	exit ();
}
function GetPaypwdMsg($data = array()) 
{
	global $_G;
	$user_id = $data ['user_id'];
	$username = $data ['username'];
	$webname = $data ['webname'];
	$email = $data ['email'];
	$active_id = urlencode ( authcode ( $user_id .",".time (),"TTWCGY") );
	$active_id=str_replace ( "/","ds2XURL",$active_id);
	$_url = "http://{$_SERVER['HTTP_HOST']}
".U ( 'Index/users/getpaypwd?id='.$active_id );
$user_url = "http://{$_SERVER['HTTP_HOST']}
".U ( 'Index/users/index');
$send_email_msg = '
	<div style="background: url(http://'.$_SERVER ['HTTP_HOST'] .'/data/images/base/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px; ">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="'.$webname .'用户中心" href="'.$user_url .'" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;height:60px" alt="'.$webname .'用户中心" src="http://'.$_SERVER ['HTTP_HOST'] .$_G ['system'] ['con_logo'] .'" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">'.$username .'</span> , 您好！</p>
			<p>请点击下面的链接重新修改交易密码。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击完成注册" href="'.$_url .'" target="_blank" swaped="true">'.$_url .'</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>
			
			<p style="text-align: right;"><br>'.$webname .'用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://'.$_SERVER ['HTTP_HOST'] .U('Index/Index/index?site=contact').'" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
return $send_email_msg;
}
function RegEmailMsg($data = array()) 
{
$user_id = $data ['user_id'];
$username = $data ['username'];
$webname = $data ['webname'];
$email = $data ['email'];
$active_id = urlencode ( authcode ( $user_id .",".time (),"TTWCGY") );
$query_url = isset ( $data ['query_url'] ) ?$data ['query_url'] : str_replace ( "/","ds2XURL",U ( 'Index/users/active?id='.$active_id ));
$_url = "http://{$_SERVER['HTTP_HOST']}
{$query_url}
";
$user_url = "http://{$_SERVER['HTTP_HOST']}
".U ( 'Index/users/index');
$send_email_msg = '
	<div style="background: url(http://'.$_SERVER ['HTTP_HOST'] .'/statics/images/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px;>
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="'.$webname .'用户中心" href="'.$user_url .'" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;" alt="'.$webname .'用户中心" src="http://'.$_SERVER ['HTTP_HOST'] .$_G['system']['con_logo'] .'" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">'.$username .'</span> , 您好！</p>
			<p>感谢您注册'.$webname .'，您登录的邮箱帐号为 <strong style="font-size: 16px;">'.$email .'</strong></p>
			<p>请点击下面的链接即可完成激活。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击完成注册" href="'.$_url .'" target="_blank" swaped="true">'.$_url .'</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>

			<p>感谢您光临'.$webname .'用户中心，我们的宗旨：为您提供优秀的产品和优质的服务！ <br>现在就登录吧!
			<a title="点击登录'.$webname .'用户中心" style="color: rgb(15, 136, 221);" href="'.$user_url .'" target="_blank" swaped="true">'.$user_url .'</a>
			</p>
			<p style="text-align: right;"><br>'.$webname .'用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://'.$_SERVER ['HTTP_HOST'] .U('Index/Index/index?site=contact').'" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
return $send_email_msg;
}
function GetpwdMsg($data = array()) 
{
global $mysql,$_G;
$user_id = $data ['user_id'];
$username = $data ['username'];
$webname = $data ['webname'];
$email = $data ['email'];
$active_id = urlencode ( authcode ( $user_id .",".time (),"TTWCGY") );
$active_id=str_replace ( "/","ds2XURL",$active_id);
$_url = "http://{$_SERVER['HTTP_HOST']}
".U('Index/index/updatepwd?id='.$active_id);
$user_url = "http://{$_SERVER['HTTP_HOST']}
".U('Index/Users/index');
$send_email_msg = '
	<div style="background: url(http://'.$_SERVER ['HTTP_HOST'] .'/data/images/base/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px; ">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="'.$webname .'用户中心" href="http://'.$_SERVER ['HTTP_HOST'] .U('Index/Users/index').'" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;height:60px" alt="'.$webname .'用户中心" src="http://'.$_SERVER ['HTTP_HOST'] .$_G ['system'] ['con_logo'] .'" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">'.$username .'</span> , 您好！</p>
			<p>请点击下面的链接重新修改密码。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击重新修改密码" href="'.$_url .'" target="_blank" swaped="true">'.$_url .'</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>
			
			<p style="text-align: right;"><br>'.$webname .'用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://'.$_SERVER ['HTTP_HOST'] .U('Index/Index/index?site=contact').'" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
return $send_email_msg;
}
