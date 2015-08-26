<?php
if (file_exists ( "data/conf/db.php" )) {
	$db = include "data/conf/db.php";
} else {
	$db = array ();
}

$configs = array (
		'DEFAULT_CHARSET' => 'utf-8',
		'URL_CASE_INSENSITIVE' => true,
		'URL_MODEL'          => '2',
		'SESSION_AUTO_START' => true,
		'SESSION_OPTIONS' => array (
				'use_trans_sid' => 0,
				'use_only_cookies' => 0 ,
		),
		'DB_FIELDS_CACHE' => true,
		'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
		'ERROR_PAGE'=>'./404.html',
		'TMPL_EXCEPTION_FILE'=>'./404.html',
		'AUTHCODE' => 'dsp2pcms20ncfl15',
		'TMPL_PARSE_STRING' => array (
				'__UPLOAD__' => SITE_PATH . 'uploads/',
				'__STATICS__' => SITE_PATH . 'statics/' 
		),
		'URL_ROUTER_ON' => true,
		'URL_ROUTE_RULES' => array (
		)

		 
);
return array_merge ( $configs, $db );