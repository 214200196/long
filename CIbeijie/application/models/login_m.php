<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_m extends CI_Model {

	// 获取验证码
	public function verify() {

		$this->load->helper('captcha');
		$vals = array(
		    'word'      => '',
		    'img_path'  => './captcha/',
		    'img_url'   =>  $this->config->item('base_url').'captcha/',
		    'font_path' => './fonts/4.ttf',
		    'img_width' => '100',
		    'img_height'    => 35,
		    'expiration'    => 600,
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

		// 检测session是否开启
		if ( !isset($_SESSION)) {
			session_start();
		}
		// 将验证码存入session并转换成大写
		$_SESSION['verify'] = strtoupper($cap['word']);
		return $cap;

	}

	 
	/*========用户登入检测===========
	* @ auth longjianwei
	*   	 2015-10-15
	* @ param admin_name 登入用户名  
	*        password   登入密码
	* @ return array
	*===============================*/
	public function check_admin_login($admin_name,$password) {
		
		$pwd=md5($password);
		
		$sql = "SELECT `id`,`admin_name`,`realname`,`login_time`,`login_ip`,`login_status`,`last_time`,`last_ip`,`role_id` 
			    FROM ci_admin 
			    where `admin_name`= ? AND `password`= ? ";
		// 执行数据库查询操作（返回值为资源类型）
		$sql_query = $this->db->query($sql,array($admin_name,$pwd));
		// 将资源型数据获取并返回数组类型
		return $sql_query->row_array();

	}

	/*========用户登入检测===========
	* @ auth longjianwei
	*   	 2015-10-15
	* @ param $id 管理员id 
	*		  $last_time 最后登入时间	 
	*		  $last_ip 最后登入ip
	* @ return array
	*===============================*/
	public function update_admin_login($id,$last_time,$last_ip) {
		
		$data = array(
					'login_time'  	=> time(), 
					'login_ip' 		=> $this->input->ip_address(), 
					'login_status' 	=> 1,
					'last_time'		=> $last_time,
					'last_ip'		=> $last_ip
					);

		$where = "id={$id}";

		//$str = $this->db->update_string('ci_admin', $data, $where);
		//echo $str;
		//echo $this->db->last_query(); // 查看最后执行那天sql语句
		return $this->db->update('ci_admin', $data, $where);

	}



}
