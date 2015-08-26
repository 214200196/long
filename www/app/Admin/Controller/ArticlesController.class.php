<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class ArticlesController extends AdminController 
{
	public function lists() 
	{
		global $articles_flag;
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "articles_list");
		$articles_flag = array ( "index"=>"首页", "ding"=>"置顶", "tuijian"=>"推荐" );
		$_A ['articles_flag'] = $articles_flag;
		if ($_REQUEST ['view'] != "") 
		{
			$data ['id'] = I ( 'request.view');
			$result = \articlesClass::GetOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ['articles_result'] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_POST ['type'] != "") 
		{
			$data ['id'] = I ( 'post.id');
			$data ['aid'] = I ( 'post.aid');
			$data ['order'] = I ( 'post.order');
			$data ['type'] = I ( 'post.type');
			$result = \articlesClass::Action ( $data );
			if ($result >0) 
			{
				$msg = array ( "操作成功", U ( 'Articles/lists?order=id_desc') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "articles";
			$admin_log ["type"] = "article";
			$admin_log ["operating"] = "action";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data = array ( "id"=>I ( 'request.del') );
			$result = \articlesClass::Delete ( $data );
			if ($result >0) 
			{
				$msg = array ( "删除成功", U ( 'Articles/lists') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "articles";
			$admin_log ["type"] = "article";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		elseif ($_REQUEST ['check'] != "") 
		{
			if ($_POST ['status'] != "") 
			{
				$data = array ( "id"=>I ( 'request.check') );
				$data ['status'] = I ( 'post.status');
				$data ['verify_userid'] = $_G ['user_id'];
				$data ['verify_remark'] = I ( 'post.verify_remark');
				$result = \articlesClass::Verify ( $data );
				if ($result >0) 
				{
					$msg = array ( "审核成功", U ( 'Articles/lists') );
				}
				else 
				{
					$msg = array ( $MsgInfo [$result] );
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "articles";
				$admin_log ["type"] = "article";
				$admin_log ["operating"] = "check";
				$admin_log ["article_id"] = $result >0 ?$result : 0;
				$admin_log ["result"] = $result >0 ?1 : 0;
				$admin_log ["content"] = $msg [0];
				$admin_log ["data"] = $data;
				\uadminClass::AddAdminLog ( $admin_log );
			}
		}
		else 
		{
			$result = \articlesClass::GetTypeList ( array ( "limit"=>"all" ) );
			if ($result != null) 
			{
				foreach ( $result as $key =>$value ) 
				{
					$_A ["articles_type_result"] [$value ['id']] = $value ['name'];
				}
			}
			$data = array ();
			$data ['page'] = I ( 'get.p');
			if (isset ( $_REQUEST ['username'] )) $data ['username'] = I ( 'request.username');
			if (isset ( $_REQUEST ['name'] )) $data ['name'] = I ( 'request.name');
			if (isset ( $_REQUEST ['type_id'] )) $data ['type_id'] = I ( 'request.type_id');
			$data ['order'] = "id_desc";
			$lists = \articlesClass::GetList ( $data );
			$this->assign ( $lists );
		}
		if ($_REQUEST ['view'] == '') $this->display ( $tpldir .'articallist.html',$msg );
		else $this->display ( $tpldir .'articalview.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "articles_new");
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			$data ["nid"] = $data ['user_id'] .time ();
			if ($_POST ['type_id'] != "") 
			{
				$data ['type_id'] = join ( ",",I ( 'post.type_id') );
				$_SESSION ['articles_type_id'] = $data ['type_id'];
			}
			if ($_POST ['public'] == 3) 
			{
				$data ['password'] = I ( 'post.password');
			}
			else 
			{
				$data ['password'] = "";
			}
			if ($_POST ['flag'] != "") 
			{
				$data ['flag'] = join ( ",",I ( 'post.flag') );
			}
			if ($_POST ['clearlitpic'] == 1) 
			{
				$data ['litpic'] = "";
			}
			$datapic ['code'] = "articles";
			$datapic ['user_id'] = $data ['user_id'];
			$datapic ['type'] = "article";
			$datapic ['article_id'] = I ( 'post.id');
			$datapic ['isadmin'] = 1;
			$uploadfiles = $this->upfiles ( 'litpic','artical',$datapic );
			if (is_array ( $uploadfiles )) 
			{
				$data ['litpic'] = $uploadfiles ['upfiles_id'];
			}
			if ($_POST ['actions'] != "edit") 
			{
				$data ['user_id'] = $_G ['user_id'];
				$result = \articlesClass::Add ( $data );
			}
			else 
			{
				$data ['id'] = I ( 'post.id');
				if ($data ['litpic'] != ""||$_POST ['clearlitpic'] == 1) 
				{
					if ($_POST ['oldlitpic'] != '') 
					{
						$_data ['user_id'] = $data ["user_id"];
						$_data ['id'] = I ( 'post.oldlitpic');
						$this->updelet ( $_data );
					}
				}
				$result = \articlesClass::Update ( $data );
			}
			if ($result >0) 
			{
				$msg = array ( "操作成功", U ( 'Articles/lists?order=id_desc') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "articles";
			$admin_log ["type"] = "article";
			$admin_log ["operating"] ="news";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		else 
		{
			$_A ['articles_type_id'] = $_SESSION ['articles_type_id'];
			$_A ['article_type_result'] = \articlesClass::GetTypeMenu ();
			if (count ( $_A ['article_type_result'] ) == 0) 
			{
				$msg = array ( $MsgInfo ["articles_add_type_empty"], U ( 'Articles/type') );
			}
		}
		$menus = \articlesClass::GetTypeMenu ( array ( 'limit'=>"all" ) );
		$this->assign ( 'menus',$menus );
		$this->display ( $tpldir .'articalnew.html',$msg );
	}
	public function type() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "articles_type");
		if ($_POST ['name'] != "") 
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
					$data ['id'] = I ( 'post.id');
					$result = \articlesClass::UpdateType ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["articles_type_update_success"], U ( 'Articles/type') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "update";
				}
				else 
				{
					$result = \articlesClass::AddType ( $data );
					if ($result >0) 
					{
						$msg = array ( $MsgInfo ["articles_type_add_success"], U ( 'Articles/type') );
					}
					else 
					{
						$msg = array ( $MsgInfo [$result] );
					}
					$admin_log ["operating"] = "add";
				}
				$admin_log ["user_id"] = $_G ['user_id'];
				$admin_log ["code"] = "borrow";
				$admin_log ["type"] = "type";
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
			$result = \articlesClass::GetTypeOne ( $data );
			if (!is_array ( $result )) 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			else 
			{
				$_A ['article_type_result'] = $result;
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data ['id'] = I ( 'request.del');
			$result = \articlesClass::DelType ( $data );
			if ($result >0) 
			{
				$msg = array ( $MsgInfo ["articles_type_del_success"], U ( 'Articles/type') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "borrow";
			$admin_log ["type"] = "type";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$list = \articlesClass::GetTypeMenu ();
		$this->assign ( 'list',$list );
		$this->display ( $tpldir .'articaltype.html',$msg );
	}
	public function page_list() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "articles_page_list");
		if ($_REQUEST ['view'] != "") 
		{
			$data ['id'] = I ( 'request.view');
			$result = \articlesClass::GetPageOne ( $data );
			if (is_array ( $result )) 
			{
				$_A ['page_result'] = $result;
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
		}
		elseif ($_REQUEST ['del'] != "") 
		{
			$data = array ( "id"=>I ( 'request.del') );
			$result = \articlesClass::DeletePage ( $data );
			if ($result >0) 
			{
				$msg = array ( "删除成功", U ( 'Articles/page_list') );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "articles";
			$admin_log ["type"] = "pages";
			$admin_log ["operating"] = "del";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$list = \articlesClass::GetPageMenu ( array ( 'limit'=>'all' ) );
		$this->assign ( 'list',$list );
		$this->display ( $tpldir .'page_list.html',$msg );
	}
	public function page_edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['id'] = I ( 'request.id');
		$result = \articlesClass::GetPageOne ( $data );
		if (is_array ( $result )) 
		{
			$_A ['page_result'] = $result;
		}
		else 
		{
			$msg = array ( $MsgInfo [$result] );
		}
		$list = \articlesClass::GetPageMenu ( array ( 'limit'=>'all' ) );
		$this->assign ( 'list',$list );
		$this->display ( $tpldir .'page_new.html',$msg );
	}
	public function page_new() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		check_rank ( "articles_page_new");
		if (isset ( $_POST ['name'] )) 
		{
			$data = I ( 'post.');
			if ($_POST ['public'] == 3) 
			{
				$data ['password'] = I ( 'post.password');
			}
			else 
			{
				$data ['password'] = "";
			}
			if ($_POST ['flag'] != "") 
			{
				$data ['flag'] = join ( ",",I ( 'post.flag') );
			}
			if ($_POST ['actions'] != "page_edit") 
			{
				$data ['user_id'] = $_G ['user_id'];
				$result = \articlesClass::AddPage ( $data );
				$admin_log ["operating"] = "new";
			}
			else 
			{
				$data ['id'] = $_POST ['id'];
				$result = \articlesClass::UpdatePage ( $data );
				$admin_log ["operating"] = "edit";
			}
			if ($result >0) 
			{
				$msg = array ( "操作成功", );
			}
			else 
			{
				$msg = array ( $MsgInfo [$result] );
			}
			$admin_log ["user_id"] = $_G ['user_id'];
			$admin_log ["code"] = "articles";
			$admin_log ["type"] = "pages";
			$admin_log ["article_id"] = $result >0 ?$result : 0;
			$admin_log ["result"] = $result >0 ?1 : 0;
			$admin_log ["content"] = $msg [0];
			$admin_log ["data"] = $data;
			\uadminClass::AddAdminLog ( $admin_log );
		}
		$list = \articlesClass::GetPageMenu ( array ( 'limit'=>'all' ) );
		$this->assign ( 'list',$list );
		$this->display ( $tpldir .'page_new.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data ['id'] = $_REQUEST ['id'];
		$result = \articlesClass::GetOne ( $data );
		if (is_array ( $result )) 
		{
			$_A ['articles_result'] = $result;
		}
		else 
		{
			$msg = array ( $MsgInfo [$result] );
		}
		$menus = \articlesClass::GetTypeMenu ( array ( 'limit'=>"all" ) );
		$this->assign ( 'menus',$menus );
		$this->display ( $tpldir .'articalnew.html',$msg );
	}
}
?>