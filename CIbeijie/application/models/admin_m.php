<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_m extends CI_Model {

	// 获取ci_admin表中的数据
	public function get_admin($admin_id) {
		
		$sql = "SELECT `admin_name`,`realname`,`login_time`,`login_ip`,`login_status`,`last_time`,`last_ip`,`role_id`
				FROM ci_admin
				WHERE `id` = ?";

		$sql_query = $this->db->query($sql,$admin_id);
		// 将资源型结果获取成数组类型
		return $sql_query->row_array();

	}

	// 获取ci_admin 和 ci_admin_role（角色权限表）
	public function get_admin_role($admin_id) {
		
		$sql = "SELECT `admin_name`,`realname`,`login_time`,`login_ip`,`login_status`,`last_time`,`last_ip`,`role_id`,
					   `role_name`,`role_level`,`control`
				FROM ci_admin_role
				INNER JOIN ci_admin
				ON ci_admin_role.id = ci_admin.id
				WHERE ci_admin.id = ?";

		$sql_query = $this->db->query($sql,$admin_id);

		return $sql_query->row_array();
	}


}
