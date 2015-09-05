<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	//header("Content-type:text/html;charset=utf-8"); 
    	//$data = array('phone'=>18510095975,'content'=>'你的手机验证码为：356282 请不要把验证码告诉任何人。');                
        //echo sendSMS($data['phone'],$data['content']);die;

        //sendPhone();dump(session());die;

    	//p($_SERVER);
    	$this->php_version = phpversion();
    	mysql_connect('localhost','root','root');
    	$this->myql_version = mysql_get_server_info();
    	//die;
    	//p($this->admininfo());die();
        $this->display();
    }
}