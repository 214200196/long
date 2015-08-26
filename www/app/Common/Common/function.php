<?php
function sbubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists ( "mb_substr" ))
		$slice = mb_substr ( $str, $start, $length, $charset );
	elseif (function_exists ( 'iconv_substr' )) {
		$slice = iconv_substr ( $str, $start, $length, $charset );
	} else {
		$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all ( $re [$charset], $str, $match );
		$slice = join ( "", array_slice ( $match [0], $start, $length ) );
	}
	return $suffix ? $slice . '***' : $slice;
}
function iparea($string) {
	$qqwry = new QQWry ();
	$qqwry->QQWry ( $string );
	$get_ip = $qqwry->Country;
	return $get_ip;
}
function litpic() {
	if ($url == "")
		return "/statics/images/base/no_pic.gif";
	$_format = explode ( ",", $format );
	$width = (isset ( $_format [0] ) && $_format [0] != "") ? $_format [0] : 100;
	$height = (isset ( $_format [1] ) && $_format [1] != "") ? $_format [1] : 100;
	$data ['new_url'] = substr ( $url, 0, strlen ( $url ) - 4 ) . "_{$width}_{$height}" . substr ( $url, - 4, 4 );
	if (! file_exists ( ROOT_PATH . $data ['new_url'] )) {
	}
	return $data ['new_url'];
}
function idcard() {
	$uid = isset ( $user_id ) ? $user_id : "";
	$size = isset ( $size ) ? $size : "big";
	$type = isset ( $data ['type'] ) ? $data ['type'] : "";
	$istrue = isset ( $data ['istrue'] ) ? $data ['istrue'] : false;
	$size = in_array ( $size, array (
			'big',
			'middle',
			'small' 
	) ) ? $size : 'middle';
	$uid = abs ( intval ( $uid ) );
	$typeadd = $type == 'real' ? '_real' : '';
	$result = "/data/idcard/" . md5 ( $uid . $db_config ['partnerId'] . "catoreasycardid" ) . ".jpg";
	return $result;
}
function show_avatar() {
	global $_G;
	$path = '/plugins/avatar/';
	require_once (ROOT_PATH . 'plugins/avatar/configs.php');
	require_once (ROOT_PATH . 'plugins/avatar/avatar.class.php');
	$objAvatar = new Avatar ();
	echo $objAvatar->uc_avatar ( $_G ['user_id'], 'virtual' );
}
function module($nid) {
	global $_G;
	if ($nid == "")
		return "";
	return $_G ['_module'] [$nid];
}
function get_mktime($mktime) {
	if ($mktime == "")
		return "";
	$dtime = trim ( preg_replace ( "/[ ]{1,}/", " ", $mktime ) );
	$ds = explode ( " ", $dtime );
	$ymd = explode ( "-", $ds [0] );
	if (isset ( $ds [1] ) && $ds [1] != "") {
		$hms = explode ( ":", $ds [1] );
		$mt = mktime ( empty ( $hms [0] ) ? 0 : $hms [0], ! isset ( $hms [1] ) ? 0 : $hms [1], ! isset ( $hms [2] ) ? 0 : $hms [2], ! isset ( $ymd [1] ) ? 0 : $ymd [1], ! isset ( $ymd [2] ) ? 0 : $ymd [2], ! isset ( $ymd [0] ) ? 0 : $ymd [0] );
	} else {
		$mt = mktime ( 0, 0, 0, ! isset ( $ymd [1] ) ? 0 : $ymd [1], ! isset ( $ymd [2] ) ? 0 : $ymd [2], ! isset ( $ymd [0] ) ? 0 : $ymd [0] );
	}
	return $mt;
}
function get_times($data = array()) {
	if (isset ( $data ['time'] ) && $data ['time'] != "") {
		$time = $data ['time'];
	} elseif (isset ( $data ['date'] ) && $data ['date'] != "") {
		$time = strtotime ( $data ['date'] );
	} else {
		$time = time ();
	}
	if (isset ( $data ['type'] ) && $data ['type'] != "") {
		$type = $data ['type'];
	} else {
		$type = "month";
	}
	if (isset ( $data ['num'] ) && $data ['num'] != "") {
		$num = $data ['num'];
	} else {
		$num = 1;
	}
	if ($type == "month") {
		$month = date ( "m", $time );
		$year = date ( "Y", $time );
		$_result = strtotime ( "$num month", $time );
		$_month = ( int ) date ( "m", $_result );
		if ($month + $num > 12) {
			$_num = $month + $num - 12;
			$year = $year + 1;
		} else {
			$_num = $month + $num;
		}
		if ($_num != $_month) {
			$_result = strtotime ( "-1 day", strtotime ( "{$year}-{$_month}-01" ) );
		}
	} else {
		$_result = strtotime ( "$num $type", $time );
	}
	if (isset ( $data ['format'] ) && $data ['format'] != "") {
		return date ( $data ['format'], $_result );
	} else {
		return $_result;
	}
}
function areas($type, $city) {
	global $_G;
	$province_name = $city_name = $area_name = "";
	foreach ( $_G ['areas'] as $key => $value ) {
		$arealist [$value ['id']] = $value;
	}
	if ($city > 0) {
		$area_result = $arealist [$city];
		if ($area_result ['province'] > 0) {
			if ($area_result ['city'] > 0) {
				$province_name = $arealist [$area_result ['province']] ['name'];
				$city_name = $arealist [$area_result ['city']] ['name'];
				$area_name = $area_result ['name'];
			} else {
				$province_name = $arealist [$area_result ['province']] ['name'];
				$city_name = $area_result ['name'];
				$area_name = "";
			}
		} else {
			$province_name = $area_result ['name'];
			$city_name = "";
			$area_name = "";
		}
	} else {
		return '';
	}
	$display = "";
	$_par = explode ( ",", $type );
	if (in_array ( "p", $_par )) {
		$display .= $province_name . " ";
	}
	if (in_array ( "c", $_par )) {
		$display .= $city_name . " ";
	}
	if (in_array ( "a", $_par )) {
		$display .= $area_name . " ";
	}
	if ($parse_var == "") {
		$display = $area_result ['name'];
	}
	return $display;
}
function avatar($user_id) {
	$uid = isset ( $user_id ) ? $user_id : "";
	$size = isset ( $size ) ? $size : "big";
	$type = isset ( $data ['type'] ) ? $data ['type'] : "";
	$istrue = isset ( $data ['istrue'] ) ? $data ['istrue'] : false;
	$size = in_array ( $size, array (
			'big',
			'middle',
			'small' 
	) ) ? $size : 'middle';
	$uid = abs ( intval ( $uid ) );
	$typeadd = $type == 'real' ? '_real' : '';
	if (is_file ( './statics/avatar/' . $uid . $typeadd . "_avatar_$size.jpg" )) {
		if ($istrue)
			return true;
		return '/statics/avatar/' . $uid . $typeadd . "_avatar_$size.jpg";
	} else {
		if ($istrue)
			return false;
		return "/statics/images/avatar/noavatar_{$size}.gif";
	}
}
function xml_to_array($xml) {
	$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
	if (preg_match_all ( $reg, $xml, $matches )) {
		$count = count ( $matches [0] );
		for($i = 0; $i < $count; $i ++) {
			$subxml = $matches [2] [$i];
			$key = $matches [1] [$i];
			if (preg_match ( $reg, $subxml )) {
				$arr [$key] = xml_to_array ( $subxml );
			} else {
				$arr [$key] = $subxml;
			}
		}
	}
	return $arr;
}
function xmltoarray($xml) {
	$arr = xml_to_array ( $xml );
	$key = array_keys ( $arr );
	return $arr [$key [0]];
}
function linkages($a, $find) {
	global $_G;
	return $_G ['linkages'] [$a] [$find];
}
function get_file($dir, $type = 'dir') {
	$result = "";
	if (is_dir ( $dir )) {
		if ($dh = opendir ( $dir )) {
			while ( ($file = readdir ( $dh )) !== false ) {
				$_file = $dir . "/" . $file;
				if ($file != "." && $file != ".." && filetype ( $_file ) == $type) {
					$result [] = $file;
				}
			}
			closedir ( $dh );
		}
	}
	return $result;
}
function read_file($filename) {
	if (file_exists ( $filename ) && is_readable ( $filename ) && ($fd = @fopen ( $filename, 'rb' ))) {
		$contents = '';
		while ( ! feof ( $fd ) ) {
			$contents .= fread ( $fd, 8192 );
		}
		fclose ( $fd );
		return $contents;
	} else {
		return false;
	}
}
function post_var($arr) {
	$return = array ();
	foreach ( $arr as $vual ) {
		$return [$vual] = I ( "post.$vual" );
	}
	return $return;
}
function create_dir($dir, $dir_perms = 0775) {
	if (DIRECTORY_SEPARATOR != '/') {
		$dir = str_replace ( '\\', '/', $dir );
	}
	if (is_dir ( $dir )) {
		return true;
	}
	if (@ mkdir ( $dir, $dir_perms )) {
		return true;
	}
	if (! create_dir ( dirname ( $dir ) )) {
		return false;
	}
	return mkdir ( $dir, $dir_perms );
}
function create_file($dir, $contents = "") {
	$dirs = explode ( '/', $dir );
	if ($dirs [0] == "") {
		$dir = substr ( $dir, 1 );
	}
	create_dir ( dirname ( $dir ) );
	@chmod ( $dir, 0777 );
	if (! ($fd = @fopen ( $dir, 'wb' ))) {
		$_tmp_file = $dir . DIRECTORY_SEPARATOR . uniqid ( 'wrt' );
		if (! ($fd = @fopen ( $_tmp_file, 'wb' ))) {
			trigger_error ( "系统无法写入文件'$_tmp_file'" );
			return false;
		}
	}
	fwrite ( $fd, $contents );
	fclose ( $fd );
	@chmod ( $dir, 0777 );
	return true;
}
function exportData($filename, $title, $data) {
	header ( "Content-type:application/vnd.ms-excel" );
	header ( "Content-disposition: attachment; filename=" . $filename . ".xls" );
	if (is_array ( $title )) {
		foreach ( $title as $key => $value ) {
			echo $value . "\t";
		}
	}
	echo "\n";
	if (is_array ( $data )) {
		foreach ( $data as $key => $value ) {
			foreach ( $value as $_key => $_value ) {
				echo $_value . "\t";
			}
			echo "\n";
		}
	}
}
function br2nl($string) {
	return preg_replace ( '/<br\\s*?\/??>/i', '', $string );
}
function check_rank($purview) {
	global $_G, $_A;
	$admin_purview = explode ( ",", $_A ['admin_result'] ['purview'] );
	if (in_array ( "other_all", $admin_purview ) || $_A ['admin_result'] ['type_id'] == 1) {
		return true;
	} else if (! in_array ( $purview, $admin_purview )) {
		echo "<script>alert('你没有权限');history.go(-1);</script>";
		exit ();
	}
}
function checked($string, $arr = '') {
	if (! isset ( $string ) || ! isset ( $arr )) {
		return "";
	} else {
		if (is_array ( $arr ) && $arr [$string] != "") {
			return "checked";
		} else {
			$_arr = explode ( ",", $arr );
			if (in_array ( $string, $_arr )) {
				return "checked";
			}
			$string = explode ( ",", $string );
			if (in_array ( $arr, $string )) {
				return "checked";
			}
		}
	}
	return "";
}
function check_verify($code, $id = '') {
	$verify = new \Think\Verify ();
	return $verify->check ( $code, $id );
}
function amounttye($a, $find) {
	$ea = explode ( ',', $find );
	if (count ( $ea ) > 1) {
		$dis = '';
		$i = 1;
		foreach ( $ea as $val ) {
			if ($i == 1)
				$dis .= $a [$val];
			else
				$dis = $dis . ',' . $a [$val];
			$i ++;
		}
		return $dis;
	} else
		return $a [$find];
}
function GetEmailCont($data = array()) {
	global $_G;
	$_url = "http://{$_SERVER['HTTP_HOST']}". U ( 'Index/users/getpaypwd?id='.$active_id );
	$user_url = "http://{$_SERVER['HTTP_HOST']}". U ( 'Index/users/index' );
	$send_email_msg = '
	<div style="background: url(http://' . $_SERVER ['HTTP_HOST'] . '/data/images/base/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px;  ">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="' . $_G['system']['con_webname'] . '用户中心" href="' . $user_url  . '" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;height:60px" alt="' . $_G['system']['con_webname']. '用户中心" src="http://' . $_SERVER ['HTTP_HOST']  . $_G ['system'] ['con_logo'] . '" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">用户</span> , 您好！</p>
			<p>'.$data['content'].'</p>
			<p style="text-align: right;"><br>' . $_G['system']['con_webname'] . '用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://' . $_SERVER ['HTTP_HOST'] .U('Index/Index/index?site=contact'). '" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
	return $send_email_msg;
}
function GetPaypwdMsg($data = array()) {
	global $_G;
	$user_id = $data ['user_id'];
	$username = $data ['username'];
	$webname = $data ['webname'];
	$email = $data ['email'];
	$active_id = urlencode ( authcode ( $user_id . "," . time (), "TTWCGY" ) );
	$active_id=str_replace ( "%2F", "ds2XURL",$active_id);
	$_url = "http://{$_SERVER['HTTP_HOST']}". U ( 'users/getpaypwd?id='.$active_id );
	$user_url = "http://{$_SERVER['HTTP_HOST']}". U ( 'users/index' );
	$send_email_msg = '
	<div style="background: url(http://' . $_SERVER ['HTTP_HOST'] . '/data/images/base/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px;">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="' . $webname . '用户中心" href="' . $user_url  . '" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;height:60px" alt="' . $webname . '用户中心" src="http://' . $_SERVER ['HTTP_HOST']  . $_G ['system'] ['con_logo'] . '" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">' . $username . '</span> , 您好！</p>
			<p>请点击下面的链接重新修改交易密码。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击完成注册" href="' . $_url . '" target="_blank" swaped="true">' . $_url . '</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>
			
			<p style="text-align: right;"><br>' . $webname . '用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://' . $_SERVER ['HTTP_HOST'] .U('Index/index?site=contact'). '" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
	return $send_email_msg;
	}
function RegEmailMsg($data = array()) {
	global $_G;
	$user_id = $data ['user_id'];
	$username = $data ['username'];
	$webname = $data ['webname'];
	$email = $data ['email'];
	$active_id = urlencode ( authcode ( $user_id . "," . time (), "TTWCGY" ) );
	$query_url = isset ( $data ['query_url'] ) ? $data ['query_url'] : str_replace ( "%2F", "ds2XURL",U ( 'users/active?id=' . $active_id ));
	$_url = "http://{$_SERVER['HTTP_HOST']}{$query_url}";
	$user_url = "http://{$_SERVER['HTTP_HOST']}" . U ( 'users/index' );
	$send_email_msg = '
	<div style="background: url(http://' . $_SERVER ['HTTP_HOST'] . '/statics/images/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px;">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="' . $webname . '用户中心" href="' . $user_url . '" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;" alt="' . $webname . '用户中心" src="http://' . $_SERVER ['HTTP_HOST'] .$_G['system']['con_logo'] .'" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">' . $username . '</span> , 您好！</p>
			<p>感谢您注册' . $webname . '，您的邮箱为 <strong style="font-size: 16px;">' . $email . '</strong></p>
			<p>请点击下面的链接即可完成激活。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击完成注册" href="' . $_url . '" target="_blank" swaped="true">' . $_url . '</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>

			<p>感谢您光临' . $webname . '用户中心，我们的宗旨：为您提供优秀的产品和优质的服务！ <br>现在就登录吧!
			<a title="点击登录' . $webname . '用户中心" style="color: rgb(15, 136, 221);" href="' . $user_url . '" target="_blank" swaped="true">' . $user_url . '</a>
			</p>
			<p style="text-align: right;"><br>' . $webname . '用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://' . $_SERVER ['HTTP_HOST'] . U('Index/index?site=contact').'" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
	return $send_email_msg;
}
function GetpwdMsg($data = array()) {
	global  $_G;
	$user_id = $data ['user_id'];
	$username = $data ['username'];
	$webname = $data ['webname'];
	$email = $data ['email'];
	$active_id = urlencode ( authcode ( $user_id . "," . time (), "TTWCGY" ) );
	$active_id=str_replace ( "%2F", "ds2XURL",$active_id);
	$_url = "http://{$_SERVER['HTTP_HOST']}".U('index/updatepwd?id='.$active_id);
	$user_url = "http://{$_SERVER['HTTP_HOST']}".U('Users/index');
	$send_email_msg = '
	<div style="background: url(http://' . $_SERVER ['HTTP_HOST'] . '/data/images/base/email_bg.png) no-repeat left bottom; font-size:14px; width: 588px; ">
	<div style="padding: 10px 0px; ">
		<h1 style="padding: 0px 15px; margin: 0px; overflow: hidden; height: 100px;">
			<a title="' . $webname . '用户中心" href="http://' . $_SERVER ['HTTP_HOST'] .U('Users/index'). '" target="_blank" swaped="true">
			<img style="border-width: 0px; padding: 0px; margin: 0px;height:60px" alt="' . $webname . '用户中心" src="http://' . $_SERVER ['HTTP_HOST'] . $_G ['system'] ['con_logo'] . '" >		</a>
		</h1>
		<div style="padding: 0px 20px; overflow: hidden; line-height: 40px; height: 50px; text-align: right;"> </div>
		<div style="padding: 2px 20px 30px;">
			<p>亲爱的 <span style="color: rgb(196, 0, 0);">' . $username . '</span> , 您好！</p>
			<p>请点击下面的链接重新修改密码。</p>
			<p style="overflow: hidden; width: 100%; word-wrap: break-word;"><a title="点击重新修改密码" href="' . $_url . '" target="_blank" swaped="true">' . $_url . '</a>
			<br><span style="color: rgb(153, 153, 153);">(如果链接无法点击，请将它拷贝到浏览器的地址栏中)</span></p>
			
			<p style="text-align: right;"><br>' . $webname . '用户中心 敬启</p>
			<p><br>此为自动发送邮件，请勿直接回复！如您有任何疑问，请点击<a title="点击联系我们" style="color: rgb(15, 136, 221);" href="http://' . $_SERVER ['HTTP_HOST'] .U('Index/index?site=contact'). '" target="_blank" >联系我们&gt;&gt;</a></p>
		</div>
	</div>
</div>
		';
	return $send_email_msg;
	}
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5 ( $key ? $key : C ( 'AUTHCODE' ) );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );
	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );
	$result = '';
	$box = range ( 0, 255 );
	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
	}
	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
	}
	if ($operation == 'DECODE') {
		if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
			return substr ( $result, 26 );
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}
function SetCookies($data = array()) {
	$_session_id = ! IsExiest ( $data ['session_id'] ) ? md5 ( "dscms_userid" ) : md5 ( $data ['session_id'] );
	$_time = ! IsExiest ( $data ['time'] ) ? 60 * 60 : $data ['time'];
	if (IsExiest ( $data ['cookie_status'] ) != false && $data ['cookie_status'] == 1) {
		setcookie ( $_session_id, authcode ( $data ['user_id'] . "," . time (), "ENCODE" ), time () + $_time );
	} else {
		session ( $_session_id, authcode ( $data ['user_id'] . "," . time (), "ENCODE" ) );
		session ( 'login_endtime', time () + 60 * 60 );
	}
}
function GetCookies($data = array()) {
	$_session_id = ! IsExiest ( $data ['session_id'] ) ? md5 ( "dscms_userid" ) : md5 ( $data ['session_id'] );
	$_time = ! IsExiest ( $data ['time'] ) ? 60 * 60 : $data ['time'];
	$_user_id = array (
			0 
	);
	if (IsExiest ( $data ['cookie_status'] ) != false && $data ['cookie_status'] == 1) {
		$_user_id = explode ( ",", authcode ( isset ( $_COOKIE [$_session_id] ) ? $_COOKIE [$_session_id] : "", "DECODE" ) );
	} else {
		$seson = session ( $_session_id );
		$_user_id = explode ( ",", authcode ( isset ( $seson ) ? $seson : "", "DECODE" ) );
	}
	return $_user_id [0];
}
function DelCookies($data = array()) {
	$_session_id = ! IsExiest ( $data ['session_id'] ) ? md5 ( "dscms_userid" ) : md5 ( $data ['session_id'] );
	if (IsExiest ( $data ['cookie_status'] ) != false && $data ['cookie_status'] == 1) {
		setcookie ( $_session_id, "", time () );
	} else {
		session ( $_session_id, null );
		session ( 'login_endtime', null );
	}
}
function IsExiest($val) {
	if (isset ( $val ) && ($val != "" || $val == 0)) {
		return $val;
	} else {
		return false;
	}
}
function presql($sql) {
	while ( preg_match ( '/{([a-zA-Z0-9_-]+)}/', $sql, $regs ) ) {
		$found = $regs [1];
		$sql = preg_replace ( "/\{" . $found . "\}/", C ( 'DB_PREFIX' ) . $found, $sql );
	}
	return $sql;
}
function getapr($str) {
	if ($str == 0.03)
		$str = '1天';
	elseif ($str == 0.06)
		$str = '2天';
	elseif ($str == 0.10)
		$str = '3天';
	elseif ($str == 0.13)
		$str = '4天';
	elseif ($str == 0.16)
		$str = '5天';
	elseif ($str == 0.20)
		$str = '6天';
	elseif ($str == 0.23)
		$str = '7天';
	elseif ($str == 0.26)
		$str = '8天';
	elseif ($str == 0.30)
		$str = '9天';
	elseif ($str == 0.33)
		$str = '10天';
	elseif ($str == 0.36)
		$str = '11天';
	elseif ($str == 0.40)
		$str = '12天';
	elseif ($str == 0.43)
		$str = '13天';
	elseif ($str == 0.46)
		$str = '14天';
	elseif ($str == 0.50)
		$str = '15天';
	elseif ($str == 0.53)
		$str = '16天';
	elseif ($str == 0.56)
		$str = '17天';
	elseif ($str == 0.60)
		$str = '18天';
	elseif ($str == 0.63)
		$str = '19天';
	elseif ($str == 0.66)
		$str = '20天';
	elseif ($str == 0.70)
		$str = '21天';
	elseif ($str == 0.73)
		$str = '22天';
	elseif ($str == 0.76)
		$str = '23天';
	elseif ($str == 0.80)
		$str = '24天';
	elseif ($str == 0.83)
		$str = '25天';
	elseif ($str == 0.86)
		$str = '26天';
	elseif ($str == 0.90)
		$str = '27天';
	elseif ($str == 0.93)
		$str = '28天';
	elseif ($str == 0.96)
		$str = '29天';
	elseif ($str >= 1 && $str < 10)
		$str .= '个月';
	else
		$str .= '个月';
	return $str;
}
function credit($parse_var, $integral) {
	global $_G;
	if ($integral == "" && $integral != "0")
		return "";
	if ($_G ['credit'] ['rank'] == "")
		return "";
	$_result = array ();
	foreach ( $_G ['credit'] ['rank'] as $key => $value ) {
		$_result [$value ['class_nid']] [] = $value;
	}
	if ($parse_var == "") {
		$result = $_result [0];
	} else {
		$result = $_result [$parse_var];
	}
	
	if (count ( $result ) > 0) {
		
		foreach ( $result as $key => $value ) {
			
			if ($value ['point1'] <= $integral && $value ['point2'] >= $integral) {
				return "<img src='/statics/images/credit/" . $value ['pic'] . "' title='{$integral}分'>";
			} elseif ($integral <= 0 && $value ['point2'] <= 0) {
				return "<img src='/statics/images/credit/" . $value ['pic'] . "' title='{$integral}分'>";
			}
		}
	}
}
function credit_class($class_id) {
	global $_G;
	if ($class_id == "")
		return "";
	$class_result = $_G ['credit'] ['_class'];
	$var = explode ( ",", $class_id );
	$result = array ();
	foreach ( $var as $key => $val ) {
		$result [] = $class_result [$val];
	}
	return join ( ",", $result );
}
