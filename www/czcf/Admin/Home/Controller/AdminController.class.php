<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function index(){
    	// 获取管理员列表

        $this->display();
    }
}