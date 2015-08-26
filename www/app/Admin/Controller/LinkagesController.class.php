<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class LinkagesController extends AdminController 
{
	public function lists()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data=array();
		if(isset($_REQUEST['username'])) $data['username']=I('request.username');
		if(isset($_REQUEST['email'])) $data['email']=I('request.email');
		if(isset($_REQUEST['code']))
		{
			$data['code']=I('request.code');
			$data['limit']='all';
		}
		else
		{
			if(isset($_REQUEST['p'])) $data['page']=I('request.p');
		}
		if(isset($_REQUEST['code']))
		{
			$list=\linkagesClass::GetTypeList($data);
			$this->assign('list',$list);
		}
		else
		{
			$lists=\linkagesClass::GetTypeList($data);
			$this->assign($lists);
		}
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function type_action()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset($_POST['id']))
		{
			$data['id'] = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['nid'] = isset($_POST['nid'])?$_POST['nid']:"";
			$data['order'] = $_POST['order'];
			$result = \linkagesClass::ActionType($data);
			if ($result !== true)
			{
				$msg = array($MsgInfo[$result]);
			}
			else
			{
				$msg = array($MsgInfo["linkages_type_update_success"]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "linkages";
			$admin_log["type"] = "action";
			$admin_log["operating"] = "type_action";
			$admin_log["article_id"] = 0;
			$admin_log["result"] = 1;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = $data;
			\uadminClass::AddAdminLog($admin_log);
		}
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function type_del()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data['id'] = I('request.id');
		$result = \linkagesClass::DelType($data);
		if ($result >0)
		{
			$msg = array($MsgInfo['linkages_type_del_success']);
		}
		else
		{
			$msg = array($MsgInfo[$result]);
		}
		$admin_log["user_id"] = $_G['user_id'];
		$admin_log["code"] = "linkages";
		$admin_log["type"] = "action";
		$admin_log["operating"] = "type_del";
		$admin_log["article_id"] = $_REQUEST['id'];
		$admin_log["result"] = $result>0?1:0;
		$admin_log["content"] = $msg[0];
		$admin_log["data"] = $data;
		\uadminClass::AddAdminLog($admin_log);
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function type_new()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset($_POST['name']))
		{
			$var = array("name","nid","order","code");
			$data = post_var($var);
			$result = \linkagesClass::AddType($data);
			if ($result>0)
			{
				$msg = array($MsgInfo['linkages_type_add_success']);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "linkages";
			$admin_log["type"] = "action";
			$admin_log["operating"] = "type_new";
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = $data;
			\uadminClass::AddAdminLog($admin_log);
		}
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function type_edit()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset($_POST['name']))
		{
			$var = array("name","nid","order","code");
			$data = post_var($var);
			$data['id'] = $_POST['id'];
			$result = \linkagesClass::UpdateType($data);
			if ($result >0)
			{
				$msg = array($MsgInfo['linkages_type_update_success']);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "linkages";
			$admin_log["type"] = "action";
			$admin_log["operating"] ='type_edit';
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = $data;
			\uadminClass::AddAdminLog($admin_log);
		}
		$data['id'] = $_REQUEST['id'];
		$_A['linkage_type_result'] = \linkagesClass::GetType($data);
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function news()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset($_POST['name']))
		{
			$var = array("name","value","type_id","order");
			$data = post_var($var);
			if($data['value']=="")
			{
				$data['value'] = $data['name'];
			}
			$result = \linkagesClass::Add($data);
			if ($result>0)
			{
				$msg = array($MsgInfo["linkages_add_success"]);
			}
			else
			{
				$msg = array($MsgInfo[$result]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "linkages";
			$admin_log["type"] = "action";
			$admin_log["operating"] = "add";
			$admin_log["article_id"] = $result>0?$result:0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = $data;
			\uadminClass::AddAdminLog($admin_log);
		}
		else
		{
			$data['limit'] = "all";
			$data['id'] =I('request.id');
			$_A['linkage_type_result'] =\linkagesClass::GetType($data);
			if (is_array($_A['linkage_type_result']))
			{
				$data['type_id'] = I('request.id');
				$_A['linkage_list'] = \linkagesClass::GetList($data);
			}
			else
			{
				$msg = array($result);
			}
		}
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function edit()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function actions()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset($_POST['id']))
		{
			$data['id'] = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['value'] = $_POST['value'];
			$data['order'] = $_POST['order'];
			$result = \linkagesClass::Action($data);
			if ($result !== true)
			{
				$msg = array($MsgInfo[$result]);
			}
			else
			{
				$msg = array($MsgInfo["linkages_action_success"]);
			}
			$admin_log["user_id"] = $_G['user_id'];
			$admin_log["code"] = "linkages";
			$admin_log["type"] = "action";
			$admin_log["operating"] = "updates";
			$admin_log["article_id"] = 0;
			$admin_log["result"] = $result>0?1:0;
			$admin_log["content"] = $msg[0];
			$admin_log["data"] = $data;
			\uadminClass::AddAdminLog($admin_log);
		}
		else
		{
			if (isset($_POST['name']))
			{
				$data['type'] = "add";
				$data['name'] = $_POST['name'];
				$data['type_id'] = $_POST['type_id'];
				$data['value'] = $_POST['value'];
				$data['order'] = $_POST['order'];
				$result = \linkagesClass::Action($data);
				if ($result !== true)
				{
					$msg = array($MsgInfo[$result]);
				}
				else
				{
					$msg = array($MsgInfo["linkages_action_success"]);
				}
				$admin_log["user_id"] = $_G['user_id'];
				$admin_log["code"] = "linkages";
				$admin_log["type"] = "action";
				$admin_log["operating"] = "adds";
				$admin_log["article_id"] = 0;
				$admin_log["result"] = $result>0?1:0;
				$admin_log["content"] = $msg[0];
				$admin_log["data"] = $data;
				\uadminClass::AddAdminLog($admin_log);
			}
		}
		$this->display ( $tpldir .'linkages.html',$msg );
	}
	public function del()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$id = $_REQUEST['id'];
		$type_id = $_REQUEST['type_id'];
		$data = array("id"=>$id);
		$result = \linkagesClass::Delete($data);
		if ($result >0)
		{
			$msg = array($MsgInfo["linkages_del_success"]);
		}
		else
		{
			$msg = array($MsgInfo[$result]);
		}
		$admin_log["user_id"] = $_G['user_id'];
		$admin_log["code"] = "linkages";
		$admin_log["type"] = "action";
		$admin_log["operating"] = "del";
		$admin_log["article_id"] = $result>0?$result:0;
		$admin_log["result"] = $result>0?1:0;
		$admin_log["content"] = $msg[0];
		$admin_log["data"] = $data;
		\uadminClass::AddAdminLog($admin_log);
		$this->display ( $tpldir .'linkages.html',$msg );
	}
}
