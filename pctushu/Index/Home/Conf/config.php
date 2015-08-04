<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_GROUP'     =>'Home',//默认分组
	'URL_MODEL'          => '2', //URL模式
	'URL_HTML_SUFFIX'=>'',   //伪静态
    'SESSION_AUTO_START' => true, //是否开启session
    'URL_CASE_INSENSITIVE'=>true,//关闭大小写为true.忽略地址大小写

    'URL_ROUTER_ON'   => true, // 开启路由

    //数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'pcbooks', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'root', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'book_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

);