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


?>