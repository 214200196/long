<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 后台公共基类
class Admin_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//p($_SESSION);die;
		$admin_id  = $this->session->userdata('admin_id');
		$admin_name= $this->session->userdata('admin_name');

		// 检测用户登入session是否存在
		if( ! isset($admin_id) || ! isset($admin_name) ) {
			echo my_error_msg('请登入后再操作！',site_url('admin/login'),5);exit;
		}

	}

}

// 前台公共基类
class Home_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

}
