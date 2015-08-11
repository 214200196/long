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



?>