<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class LinksController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$lists = \linksClass::GetList ();
		$this->assign ( $lists );
		$this->display ( $tpldir .'links.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_POST ['type_id'] ) &&$_POST ['type_id'] != "") 
		{
			$data = I ( 'post.');
			$datapic ['code'] = "links";
			$datapic ['user_id'] = $_G ['user_id'];
			$datapic ['type'] = "link";
			$datapic ['article_id'] = $_G ["user_id"];
			$pic_result = $this->upfiles ( 'logoimg','links',$datapic );
			;
			if ($pic_result != "") 
			{
				$data ['logoimg'] = $pic_result ['upfiles_id'];
			}
			if ($_REQUEST ['actions'] == "edit") 
			{
				$result = \linksClass::Update ( $data );
			}
			else 
			{
				$result = \linksClass::Add ( $data );
			}
			if ($result == false) 
			{
				$msg = array ( "输入有误，请跟管理员联系" );
			}
			else 
			{
				$msg = array ( "操作成功", U ( 'Links/lists') );
			}
		}
		else 
		{
			$_A ['links_type_list'] = \linksClass::GetTypeList ();
		}
		$this->display ( $tpldir .'links.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$_A ['links_type_list'] = \linksClass::GetTypeList ();
		$_A ['links_result'] = \linksClass::GetOne ( array ( "id"=>I ( 'request.id') ) );
		$this->display ( $tpldir .'links.html',$msg );
	}
	public function type() 
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		if (isset ( $_REQUEST ['del_id'] )) 
		{
			if ($_REQUEST ['del_id'] != 1) 
			{
				M ( 'links_type')->where ( "id=".I ( 'request.del_id') )->delete ();
				$msg = array ( "删除成功", U ( 'links/type') );
			}
			else 
			{
				$msg = array ( "类型ID1为系统类型，不能删除", U ( 'links/type') );
			}
		}
		elseif (!isset ( $_POST ['submit'] )) 
		{
			$_A ['links_type_list'] = \linksClass::GetTypeList ();
		}
		else 
		{
			foreach ( $_POST ['id'] as $key =>$val ) 
			{
				M ()->execute ( presql ( "update {links_type} set typename='".$_POST ['typename'] [$key] ."' where id=".$val ) );
			}
			if ($_POST ['typename1'] != "") 
			{
				$index ['typename'] = I ( 'post.typename1');
				M ( 'links_type')->add ( $index );
			}
			$msg = array ( "类型操作成功", U ( 'links/type') );
		}
		$this->display ( $tpldir .'links.html',$msg );
	}
	public function del()
	{
		global $tpldir,$_G,$_A,$MsgInfo;
		$data['id'] =I('request.id');
		$result = \linksClass::Delete($data);
		if ($result !== true)
		{
			$msg = array($result);
		}
		else
		{
			$msg = array("删除成功",U('links/lists'));
		}
		$this->display ( $tpldir .'links.html',$msg );
	}
}
