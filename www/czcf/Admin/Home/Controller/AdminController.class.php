<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function index() {
    	// 获取管理员列表
    	$getAdminList = D('AdminView')->select();
    	//$ipinfo = GetIpLookup('111.202.8.133');
    	//p($ipinfo);
    	//p($getAdminList);exit;
    	$getAdminListResult = array();
    	foreach ($getAdminList as $key => $v) {
    			$getAdminListResult[] = $v;
    			// 获取ip地址
    			$location = GetIpLookup($v['login_ip']);
    			if(empty($location)) $location['city'] = "未知地址";
    			// 添加位置 
    			$getAdminListResult[$key]['location'] = $location['city'];  
    	}
    	//p($getAdminListResult);die;
    	$this->getAdminList = $getAdminListResult;

        $this->display();
    }
    public function addAdmin() {
    	$this->display('addAdmin');
    }

}