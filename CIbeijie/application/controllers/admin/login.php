<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
	}

	public function index()	{
		// 获取配置文件base_url
		$base_url = $this->config->item('base_url');
		// 获取验证码
		$get_verify = $this->verify();
		// 传值
		$this->load->view('admin/login',array('base_url'=>$base_url,'get_verify'=>$get_verify));



	}

	// 验证码
	public function verify() {

		$this->load->helper('captcha');
		$vals = array(
		    'word'      => '',
		    'img_path'  => './captcha/',
		    'img_url'   =>  $this->config->item('base_url').'captcha/',
		    'font_path' => './fonts/4.ttf',
		    'img_width' => '100',
		    'img_height'    => 30,
		    'expiration'    => 7200,
		    'word_length'   => 4,
		    'font_size' => 16,
		    'img_id'    => 'Imageid',
		    'pool'      => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		    // White background and border, black text and red grid
		    'colors'    => array(
				'background'	=> array(255,255,255),
				'border'	=> array(153,102,102),
				'text'		=> array(50,205,50),
				'grid'		=> array(255,182,182)
		    )
		);

		$cap = create_captcha($vals);
		echo $cap['image'];
		return $cap;
		//var_dump($cap);
	}



}
