<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 
namespace Admin\Controller;
class AreasController extends AdminController
{
	public function lists()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data=array();
		if(isset($_REQUEST['id'])) $data['id']=I('request.id');
		if(isset($_REQUEST['p'])) $data['page']=I('request.p');
		$lists=\areasClass::GetList($data);
		$this->assign($lists);
		$this->display ( $tpldir .'areas.html',$msg );
	}
	public function province()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST['action'] == "edit"||$_REQUEST['action'] == "new")
		{
			check_rank("areas_list");
			if (isset($_POST['name']) &&$_POST['name']!="")
			{
				$var = array("name","pid","nid","order","province","city","status","letter");
				$data = post_var($var);
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('post.id');
					$result = \areasClass::Update($data);
				}
				else
				{
					$result = \areasClass::Add($data);
				}
				if ($result >0)
				{
					if ($_REQUEST['action'] == "edit")
					{
						$msg = array($MsgInfo["areas_update_success"]);
					}
					else
					{
						$msg = array($MsgInfo["areas_add_success"]);
					}
				}
				else
				{
					$msg = array($MsgInfo[$result]);
				}
				$admin_log["user_id"] = $_G['user_id'];
				$admin_log["code"] = "areas";
				$admin_log["type"] = 'province';
				$admin_log["operating"] = $_REQUEST['action'];
				$admin_log["article_id"] = $result>0?$result:0;
				$admin_log["result"] = $result>0?1:0;
				$admin_log["content"] = $msg[0];
				$admin_log["data"] = join(",",$data);
				\uadminClass::AddAdminLog($admin_log);
			}
			else
			{
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('request.edit_id');
					$_A['area_result'] = \areasClass::GetOne($data);
				}
				elseif ($_REQUEST['action'] == "new")
				{
					$data['id'] = I('request.new_id');
					$_A['area_results'] = \areasClass::GetOne($data);
				}
			}
		}
		elseif ($_REQUEST['action'] == "del")
		{
			check_rank("areas_list");
			$data['id'] = $_REQUEST['del_id'];
			$result = \areasClass::Delete($data);
			if ($result >0)
			{
				$msg = array($MsgInfo["areas_del_success"]);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "areas";
			$admin_log["type"] = 'province';
			$admin_log["operating"] = 'del';
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = join(",",$data);
			\uadminClass::AddAdminLog($admin_log);
		}
		$data=array();
		if(isset($_REQUEST['id'])) $data['id']=I('request.id');
		if(isset($_REQUEST['p'])) $data['page']=I('request.p');
		$data['type']='province';
		$lists=\areasClass::GetList($data);
		$this->assign($lists);
		$this->display ( $tpldir .'areas.html',$msg );
	}
	public function city()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST['action'] == "edit"||$_REQUEST['action'] == "new")
		{
			check_rank("areas_list");
			if (isset($_POST['name']) &&$_POST['name']!="")
			{
				$var = array("name","pid","nid","order","province","city","status","letter");
				$data = post_var($var);
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('post.id');
					$result = \areasClass::Update($data);
				}
				else
				{
					$result = \areasClass::Add($data);
				}
				if ($result >0)
				{
					if ($_REQUEST['action'] == "edit")
					{
						$msg = array($MsgInfo["areas_update_success"]);
					}
					else
					{
						$msg = array($MsgInfo["areas_add_success"]);
					}
				}
				else
				{
					$msg = array($MsgInfo[$result]);
				}
				$admin_log["user_id"] = $_G['user_id'];
				$admin_log["code"] = "areas";
				$admin_log["type"] ='city';
				$admin_log["operating"] = $_REQUEST['action'];
				$admin_log["article_id"] = $result>0?$result:0;
				$admin_log["result"] = $result>0?1:0;
				$admin_log["content"] = $msg[0];
				$admin_log["data"] = join(",",$data);
				\uadminClass::AddAdminLog($admin_log);
			}
			else
			{
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('request.edit_id');
					$_A['area_result'] = \areasClass::GetOne($data);
				}
				elseif ($_REQUEST['action'] == "new")
				{
					$data['id'] = I('request.new_id');
					$_A['area_results'] = \areasClass::GetOne($data);
				}
			}
		}
		elseif ($_REQUEST['action'] == "del")
		{
			check_rank("areas_list");
			$data['id'] = $_REQUEST['del_id'];
			$result = \areasClass::Delete($data);
			if ($result >0)
			{
				$msg = array($MsgInfo["areas_del_success"]);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "areas";
			$admin_log["type"] = 'city';
			$admin_log["operating"] = 'del';
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = join(",",$data);
			\uadminClass::AddAdminLog($admin_log);
		}
		$data=array();
		if(isset($_REQUEST['id'])) $data['id']=I('request.id');
		if(isset($_REQUEST['p'])) $data['page']=I('request.p');
		$data['type']='city';
		$lists=\areasClass::GetList($data);
		$this->assign($lists);
		$this->display ( $tpldir .'areas.html',$msg );
	}
	public function area()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if ($_REQUEST['action'] == "edit"||$_REQUEST['action'] == "new")
		{
			check_rank("areas_list");
			if (isset($_POST['name']) &&$_POST['name']!="")
			{
				$var = array("name","pid","nid","order","province","city","status","letter");
				$data = post_var($var);
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('post.id');
					$result = \areasClass::Update($data);
				}
				else
				{
					$result = \areasClass::Add($data);
				}
				if ($result >0)
				{
					if ($_REQUEST['action'] == "edit")
					{
						$msg = array($MsgInfo["areas_update_success"]);
					}
					else
					{
						$msg = array($MsgInfo["areas_add_success"]);
					}
				}
				else
				{
					$msg = array($MsgInfo[$result]);
				}
				$admin_log["user_id"] = $_G['user_id'];
				$admin_log["code"] = "areas";
				$admin_log["type"] = 'area';
				$admin_log["operating"] = $_REQUEST['action'];
				$admin_log["article_id"] = $result>0?$result:0;
				$admin_log["result"] = $result>0?1:0;
				$admin_log["content"] = $msg[0];
				$admin_log["data"] = join(",",$data);
				\uadminClass::AddAdminLog($admin_log);
			}
			else
			{
				if ($_REQUEST['action'] == "edit")
				{
					$data['id'] = I('request.edit_id');
					$_A['area_result'] = \areasClass::GetOne($data);
				}
				elseif ($_REQUEST['action'] == "new")
				{
					$data['id'] = I('request.new_id');
					$_A['area_results'] = \areasClass::GetOne($data);
				}
			}
		}
		elseif ($_REQUEST['action'] == "del")
		{
			check_rank("areas_list");
			$data['id'] = $_REQUEST['del_id'];
			$result = \areasClass::Delete($data);
			if ($result >0)
			{
				$msg = array($MsgInfo["areas_del_success"]);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "areas";
			$admin_log["type"] = 'area';
			$admin_log["operating"] = 'del';
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = join(",",$data);
			\uadminClass::AddAdminLog($admin_log);
		}
		$data=array();
		if(isset($_REQUEST['id'])) $data['id']=I('request.id');
		if(isset($_REQUEST['p'])) $data['page']=I('request.p');
		$data['type']='area';
		$lists=\areasClass::GetList($data);
		$this->assign($lists);
		$this->display ( $tpldir .'areas.html',$msg );
	}
	public function action()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank("areas_list");
		$data = array("id"=>I('post.id'),"order"=>$_POST['order']);
		$result = \areasClass::Action($data);
		if ($result >0)
		{
			$msg = array($MsgInfo["areas_action_success"]);
		}
		else
		{
			$msg = array($MsgInfo[$result]);
		}
		$admin_log["user_id"] = $_G['user_id'];
		$admin_log["code"] = "areas";
		$admin_log["type"] = $_POST['query_type'];
		$admin_log["operating"] = 'action';
		$admin_log["article_id"] = $result>0?$result:0;
		$admin_log["result"] = $result>0?1:0;
		$admin_log["content"] = $msg[0];
		$admin_log["data"] = join(",",$data);
		\uadminClass::AddAdminLog($admin_log);
		$this->display ( $tpldir .'areas.html',$msg );
	}
}
?>