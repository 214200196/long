<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
	// 检测权限访问
	public function _initialize() {
		if ($_GET['smmkey'] != Sha1(md5(md5('北京创造财富科技有限公司888')))) {
			//echo Sha1(md5(md5('北京创造财富科技有限公司888'))); // 3eef0f2cb569f66b61248104de523c101a1e4361
			$this->error("非法操作！");
		}
	}
	// 管理员列表
    public function adminList() {
    	isset( $_GET['id'] ) ? $admininfo = D('AdminView')->where(array('id'=>$_GET['id']))->find() : $admininfo = D('AdminView')->select();   	
    	echo json_encode($admininfo);
    	return json_encode($admininfo);
    }
    // 用户列表
    public function userList() {
    	//$userinfo = 
    }
}