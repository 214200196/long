<?php
//加密方式：php源码混淆类加密。免费版地址:http://www.zhaoyuanma.com/phpjm.html 免费版不能解密,可以使用VIP版本。
//此程序由【找源码】http://Www.ZhaoYuanMa.Com (免费版）在线逆向还原，QQ：7530782 

namespace Index\Controller;
class AttestationsController extends HomeController 
{
	public function index() 
	{
		
		global $_G,$tpldir,$_U,$MsgInfo;
		$msg = '';
		$attestations = \attestationsClass::GetAttestationsUserCredit ( array ( 'user_id'=>$_G ['user_id'] ) );
		$account = \accountClass::GetOne ( array ( 'user_id'=>$_G ['user_id'] ) );
		$this->assign ( 'account',$account );
		$this->assign ( 'user_att',$attestations );
		$this->display ( $tpldir .'Attestations_index.html',$msg );
	}
	public function addatt() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		$msg = '';
		$tlist = \attestationsClass::GetAttestationsTypeList ( array ( 'limit'=>'all' ) );
		$this->assign ( 'tlist',$tlist );
		$this->display ( $tpldir .'addatt.html',$msg );
	}
	public function one() 
	{
		global $_G,$tpldir,$_U,$MsgInfo;
		$msg = '';
		if (isset ( $_POST ['name'] )) 
		{
			$data ['name'] = I ( 'post.name');
			$data ['type_id'] = I ( 'post.type_id');
			$data ['user_id'] = $_G ['user_id'];
			$datapic ['file'] = "pic";
			$datapic ['code'] = "attestations";
			$datapic ['user_id'] = $data ["user_id"];
			$datapic ['type'] = "album";
			$datapic ['article_id'] = $data ['type_id'];
			$data ["pic_result"] = $this->upfiles ( 'pic','attestations',$datapic );
			$result = \attestationsClass::AddAttestations ( $data );
			if ($result >0) 
			{
				if ($_POST ['web'] == "amount") 
				{
					if ($data ['type_id'] != 5 &&$data ['type_id'] != 2 &&$data ['type_id'] != 3 &&$data ['type_id'] != 17 &&$data ['type_id'] != 18 &&$data ['type_id'] != 4) 
					{
						echo "<script>location.href='".U ( 'Attestations/index') ."';</script>";
						exit ();
					}
					else 
					{
						$msg = array ( "操作成功" );
					}
				}
				else 
				{
					$msg = array ( "操作成功" );
				}
			}
			else 
			{
				$msg = array ( $reuslt );
			}
		}
		$this->display ( $tpldir .'addatt.html',$msg );
	}
}
?>