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




?>