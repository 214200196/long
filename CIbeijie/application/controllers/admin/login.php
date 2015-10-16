<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// 加载模型文件
		$this->load->model('login_m'); 
	}
	// 登入页面显示页
	public function index()	{
		// 获取配置文件base_url
		$base_url = $this->config->item('base_url');
		// 获取验证码
		$get_verify = $this->login_m->verify();   // 使用模型文件里的方法
		// 传值
		$this->load->view('admin/login',array('base_url'=>$base_url,'get_verify'=>$get_verify));

	}
	// 登入检测
	public function check_login() {
		// 验证码检测
		if ( strtoupper($_POST['verify']) != $_SESSION['verify'] ) {
			echo my_error_msg('验证码错误！,请重试....',site_url('admin/login'),5);exit;
		}
		// 用户名和密码检测
		if ( empty($_POST['adminname']) || empty($_POST['pwd']) ) {
			echo my_error_msg('用户名或密码不能为空！',site_url('admin/login'),5);exit;
		}
		// 对比数据库
		$admin_info = $this->login_m->check_admin_login($_POST['adminname'],$_POST['pwd']);
		if( empty($admin_info) ) {
			echo my_error_msg('登入用户名错误，或密码错误！',site_url('admin/login'),5);exit;
		} else {
			// 更新登入时间及ip
			$updata_login = $this->login_m->update_admin_login($admin_info['id'],$admin_info['login_time'],$admin_info['login_ip']);
			
			// 将数据写入Session
			$add_session_data 	= array(
				'admin_id'		=> $admin_info['id'],
				'admin_name'	=> $admin_info['admin_name']
				);
			// 通过ci session类添加数据
			$this->session->set_userdata( $add_session_data );

			// 设置session有效时间 
			$this->session->mark_as_temp(array('admin_id','admin_name'),1800);
			
			echo my_success_msg('登入成功！正在为你跳转....',site_url('admin/home'),2);exit;

		}
		
	}

	// 显示验证码
	public function get_verify() {

		$this->login_m->verify();
	}

	// 退出操作
	public function admin_login_out() {
		// 删除需要删除的session
		//$this->session->unset_userdata(array('admin_id','admin_name','__ci_vars'));
		// 销毁session
		$this->session->sess_destroy();
		echo my_success_msg('退出成功！正在为你跳转....',site_url('admin/login'),2);exit;
		//p($_SESSION);
	}




}
