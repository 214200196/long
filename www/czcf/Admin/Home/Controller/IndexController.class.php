<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	//p($_SERVER);
    	$this->php_version = phpversion();
    	mysql_connect('localhost','root','root');
    	$this->myql_version = mysql_get_server_info();
    	//die;
    	//p($this->admininfo());die();
        $this->display();
    }
}