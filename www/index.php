<?php
// 检测PHP环境
if (version_compare ( PHP_VERSION, '5.3.0', '<' ))
	die ( 'require PHP > 5.3.0 !' );
if (ini_get ( 'magic_quotes_gpc' )) {
	function stripslashesRecursive(array $array) {
		foreach ( $array as $k => $v ) {
			if (is_string ( $v )) {
				$array [$k] = stripslashes ( $v );
			} else if (is_array ( $v )) {
				$array [$k] = stripslashesRecursive ( $v );
			}
		}
		return $array;
	}
	$_GET = stripslashesRecursive ( $_GET );
	$_POST = stripslashesRecursive ( $_POST );
}
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define ( 'APP_DEBUG', true );
define ( 'BUILD_DIR_SECURE', true );
define ( 'ROOT_PATH', dirname ( __FILE__ ) . DIRECTORY_SEPARATOR );
define ( 'SITE_PATH', "./" );
// 定义应用目录
define ( 'APP_PATH', ROOT_PATH . 'app/' );
// 项目资源目录，不可更改
define ( 'DSSTATIC', SITE_PATH . 'statics/' );
// 定义缓存存放路径
define ( "RUNTIME_PATH", ROOT_PATH . "data/runtime/" );

$_G = array ();
$_A = array ();
$_U = array ();
$tpldir = '';
$MsgInfo = array ();
// 引入ThinkPHP入口文件
require ROOT_PATH . 'core/ThinkPHP.php';
