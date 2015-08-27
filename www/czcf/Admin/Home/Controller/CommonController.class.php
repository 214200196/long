<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	if(empty($_SESSION['uid'])) $this->error("请登入后再操作",U('Login/index'));
    	// 获取管理员信息
    	$getAdminInfo = $this->admininfo();
    	$this->getAdminInfo = $getAdminInfo;    
    }
    public function admininfo(){
    	$admininfo = D('AdminView')->where(array('id'=>$_SESSION['uid']))->find();
    	return $admininfo;
    }
}