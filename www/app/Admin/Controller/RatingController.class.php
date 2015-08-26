<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class RatingController extends AdminController 
{
	public function educations() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \ratingClass::UpdateEducations ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_educations_update_success"], U ( 'Rating/educations') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \ratingClass::AddEducations ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_educations_add_success"], U ( 'Rating/educations') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "educations";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \ratingClass::GetEducationsOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["rating_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \ratingClass::DelEducations ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["rating_educations_del_success"], U ( 'Rating/educations') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "rating";
			$admin_log ["type"] = "educations";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data ['verify_remark'] = I ( 'post.verify_remark');
				$data ['status'] = I ( 'post.status');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \ratingClass::CheckEducations ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'Rating/educations') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "educations";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \ratingClass::GetEducationsList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'educations.html',$msg );
	}
	public function job() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \ratingClass::UpdateJob ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_job_update_success"], U ( 'rating/job') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \ratingClass::AddJob ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_job_add_success"], U ( 'rating/job') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "job";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = $_REQUEST ['edit'];
			$result = \ratingClass::GetJobOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["rating_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = $_REQUEST ['del'];
			$result = \ratingClass::DelJob ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["rating_job_del_success"], U ( 'rating/job') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "rating";
			$admin_log ["type"] = "job";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$var = array ( "verify_remark", "status" );
				$data = I ( 'post.');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \ratingClass::CheckJobOne ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'rating/job') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "job";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \ratingClass::GetJobList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'ratingjob.html',$msg );
	}
	public function house() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \ratingClass::UpdateHouse ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_house_update_success"], U ( 'rating/house') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \ratingClass::AddHouse ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_house_add_success"], U ( 'rating/house') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "house";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \ratingClass::GetHouseOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["rating_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \ratingClass::DelHouse ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["rating_house_del_success"], U ( 'rating/house') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "rating";
			$admin_log ["type"] = "house";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data = I ( 'post.');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \ratingClass::CheckHouseOne ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'rating/house') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "house";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \ratingClass::GetHouseList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'ratinghouse.html',$msg );
	}
	public function company() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['name'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \ratingClass::UpdateCompany ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_company_update_success"], U ( 'rating/company') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \ratingClass::AddCompany ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_company_add_success"], U ( 'rating/company') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "company";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \ratingClass::GetCompanyOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["rating_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \ratingClass::DelCompany ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["rating_company_del_success"], U ( 'rating/company') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "rating";
			$admin_log ["type"] = "company";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data = I ( 'post.');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \ratingClass::CheckCompanyOne ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'rating/company') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "house";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \ratingClass::GetCompanyList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'ratingcompany.html',$msg );
	}
	public function contact() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['linkman2'] )) 
		{
			if (!check_verify ( I ( 'post.valicode') )) 
			{
				$msg = array ( '验证码错误' );
			}
			if ($msg == "") 
			{
				$data = I ( 'post.');
				if ($_POST ['id'] != "") 
				{
					$result = \ratingClass::UpdateContact ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_contact_update_success"], U ( 'rating/contact') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \ratingClass::AddContact ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["rating_contact_add_success"], U ( 'rating/contact') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "company";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		elseif ($_REQUEST ['edit'] != "") 
		{
			$data ['id'] = I ( 'request.edit');
			$result = \ratingClass::GetContactOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ["rating_result"] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \ratingClass::DelContact ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["rating_contact_del_success"], U ( 'rating/contact') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "rating";
			$admin_log ["type"] = "contact";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['examine'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data = I ( 'post.');
				$data ['id'] = I ( 'request.examine');
				$data ['verify_userid'] = $_G ['user_id'];
				$result = \ratingClass::CheckContactOne ( $data );
				if ($result >0) 
				{
					$msg = array ( "操作成功", U ( 'rating/contact') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "rating";
				$admin_log ["type"] = "contact";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		$data = array ();
		$data ['page'] = I ( 'get.p');
		if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
		$lists = \ratingClass::GetContactList ( $data );
		$this->assign ( $lists );
		$this->display ( $tpldir .'ratingcontact.html',$msg );
	}
}
