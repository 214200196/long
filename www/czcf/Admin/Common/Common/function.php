<?php

function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

// 将数组指定字段转换为一维数组
function foreach_arr($arr,$fleid) {
	$myarr = array();
	foreach ($arr as $value) {
		$myarr[]=$value[$fleid];
	}
	return $myarr;
}
// php 5.5以上 array_column（$arr,$fleid,$key）;能完成上面自定义函数功能

    // 递归重新组合数组结果集
    /* @ $arr 递归数组
     * @ $cid  目标组合条件即列（传过来cid等于父id 如果父id还有父id为条件）
     */
function regetArray ($arr, $cid) {
	$myArr = array();
	foreach ($arr as $value) {
		// 如果传过来图书分类cid等于结果集中父id则组合数组
		if ($value['id'] == $cid ) {
			$myArr[] = $value;
			// 合并数据并且从拿到符合条件父id从结果集继续递归
			$myArr = array_merge( $myArr, regetArray( $arr, $value['pid']));
		}
	}
	return $myArr;

}

// 重组数组 获取树形结构
function booksCateArr($array,$pid=0){
   $tree = array();
	    foreach($array as  $v){
	    	if($v['pid']==$pid){
	    		$tree[] = $v;
	    		$tree = array_merge($tree,booksCateArr($array,$v['id']));
	    	}
	    }
    return $tree;
 }

// ip地址位置获取函数
 function GetIp(){  
    $realip = '';  
    $unknown = 'unknown';  
    if (isset($_SERVER)){  
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
            foreach($arr as $ip){  
                $ip = trim($ip);  
                if ($ip != 'unknown'){  
                    $realip = $ip;  
                    break;  
                }  
            }  
        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
            $realip = $_SERVER['HTTP_CLIENT_IP'];  
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
            $realip = $_SERVER['REMOTE_ADDR'];  
        }else{  
            $realip = $unknown;  
        }  
    }else{  
        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
            $realip = getenv("HTTP_X_FORWARDED_FOR");  
        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
            $realip = getenv("HTTP_CLIENT_IP");  
        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
            $realip = getenv("REMOTE_ADDR");  
        }else{  
            $realip = $unknown;  
        }  
    }  
    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;  
    return $realip;  
}  
  
 // 调用此方法可以直接获取到ip地理位置结果集 
function GetIpLookup($ip = ''){  
    if(empty($ip)){  
        $ip = GetIp();  
    }  
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
    if(empty($res)){ return false; }  
    $jsonMatches = array();  
    preg_match('#\{.+?\}#', $res, $jsonMatches);  
    if(!isset($jsonMatches[0])){ return false; }  
    $json = json_decode($jsonMatches[0], true);  
    if(isset($json['ret']) && $json['ret'] == 1){  
        $json['ip'] = $ip;  
        unset($json['ret']);  
    }else{  
        return false;  
    }  
    return $json;  
}

// 处理后短信发送函数(验证码发送)
function sendPhone($phone) {
    $code = rand(100000,999999);
    $_SESSION['send_time'] = time();
    $_SESSION['send_code'] = $code;
    
    $content = "你的手机验证码为：".$code." 请不要把验证码告诉任何人。";
    
    sendSMS($phone,$content);

}


function sendSMS($mobile,$content,$time='',$mid='')
{
    $http = 'http://api.sms.cn/mtutf8/ ';
    $uid  = 'bjczcf';
    $pwd  = 'bjczcf';
    $mobileids='';

    $data = array
        (
        'uid'=>$uid,                    //用户账号
        'pwd'=>md5($pwd.$uid),          //MD5位32密码,密码和用户名拼接字符
        'mobile'=>$mobile,              //号码
        'content'=>$content,            //内容
        'mobileids'=>$mobileids,
        'time'=>$time,                  //定时发送
        );
        $re= postSMS($http,$data);          //POST方式提交
    return $re;
}

function postSMS($url,$data='')
{
    error_reporting(0);
    $port="";
    $post="";
    $row = parse_url($url);
    $host = $row['host'];
    $port = $row['port'] ? $row['port']:80;
    $file = $row['path'];
    while (list($k,$v) = each($data))
    {
        $post .= rawurlencode($k)."=".rawurlencode($v)."&"; //转URL标准码
    }
    $post = substr( $post , 0 , -1 );
    $len = strlen($post);
    $fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
    if (!$fp) {
        return "$errstr ($errno)\n";
    } else {
        $receive = '';
        $out = "POST $file HTTP/1.1\r\n";
        $out .= "Host: $host\r\n";
        $out .= "Content-type: application/x-www-form-urlencoded\r\n";
        $out .= "Connection: Close\r\n";
        $out .= "Content-Length: $len\r\n\r\n";
        $out .= $post;
        fwrite($fp, $out);
        while (!feof($fp)) {
            $receive .= fgets($fp, 128);
        }
        fclose($fp);
        $receive = explode("\r\n\r\n",$receive);
        unset($receive[0]);
        return implode("",$receive);
    }
}




