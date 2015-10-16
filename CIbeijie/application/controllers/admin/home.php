<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		// 加载模型文件
		$this->load->model('admin_m'); 
	}

	public function index() {
		// 获取ci_admin表中数据
		$admin_data 	 = $this->admin_m->get_admin( $_SESSION['admin_id'] );
		$admin_role_data = $this->admin_m->get_admin_role( $_SESSION['admin_id'] );

		$this->load->view('admin/home',array('admin_data'=>$admin_data,'admin_role_data'=>$admin_role_data));
	}
}
