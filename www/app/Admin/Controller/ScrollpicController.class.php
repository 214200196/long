<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Admin\Controller;
class ScrollpicController extends AdminController 
{
	public function lists() 
	{
		global $tpldir,$_G,$_A;
		$msg = '';
		if ($_REQUEST ['action'] == 'del') 
		{
			$data ['id'] = I ( 'get.id');
			$result = \scrollpicClass::Delete ( $data );
			if ($result == false) 
			{
				$msg = array ( $result );
			}
			else 
			{
				$msg = array ( "删除成功", U ( 'Scrollpic/lists') );
			}
		}
		else 
		{
			$data ['page'] = I ( 'get.p');
			$lists = \scrollpicClass::GetList ( $data );
			$this->assign ( 'lists',$lists );
		}
		$this->display ( $tpldir .'scrolist.html',$msg );
	}
	public function news() 
	{
		global $tpldir,$_G,$_A;
		$msg = '';
		if (IS_POST) 
		{
			if (!empty ( $_FILES ['pic'] ['name'] )) 
			{
				$data ['name'] = I ( 'post.name');
				$data ['type_id'] = I ( 'post.type_id');
				$data ['status'] = I ( 'post.status');
				$data ['order'] = I ( 'post.order');
				$data ['url'] = I ( 'post.url');
				$data ['summary'] = I ( 'post.summary');
				$info = $this->uploads ( 'pic','flash');
				$data ['pic'] = $info ['savepath'] .$info ['savename'];
				$reulst = \scrollpicClass::Add ( $data );
				if ($reulst) 
				{
					$msg = array ( '上传成功', U ( 'Scrollpic/lists') );
				}
				else 
				{
					$msg = array ( '上传失败' );
				}
			}
			else 
			{
				$msg = array ( '请上传图片' );
			}
		}
		$scrotype = \scrollpicClass::GetTypeList ();
		$this->assign ( 'scrotype',$scrotype );
		$this->display ( $tpldir .'scronew.html',$msg );
	}
	public function edit() 
	{
		global $tpldir,$_G,$_A;
		$msg = '';
		if (isset ( $_GET ['id'] )) 
		{
			$id = I ( 'get.id');
			if (IS_POST) 
			{
				$data ['id'] = $id;
				$data ['name'] = I ( 'post.name');
				$data ['type_id'] = I ( 'post.type_id');
				$data ['status'] = I ( 'post.status');
				$data ['order'] = I ( 'post.order');
				$data ['url'] = I ( 'post.url');
				$data ['summary'] = I ( 'post.summary');
				if (!empty ( $_FILES ['pic'] ['name'] )) 
				{
					$info = $this->uploads ( 'pic','flash');
					$data ['pic'] = $info ['savepath'] .$info ['savename'];
				}
				$result = \scrollpicClass::Update ( $data );
				if ($result == false) 
				{
					$msg = array ( "失败" );
				}
				else 
				{
					$msg = array ( "成功", U ( 'Scrollpic/lists') );
				}
			}
			else 
			{
				$info = \scrollpicClass::GetOne ( array ( 'id'=>$id ) );
				$this->assign ( 'info',$info );
				$scrotype = \scrollpicClass::GetTypeList ();
				$this->assign ( 'scrotype',$scrotype );
			}
		}
		else 
		{
			$msg = array ( '请选择幻灯' );
		}
		$this->display ( $tpldir .'sroedit.html',$msg );
	}
}
