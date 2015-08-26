<?php
class ecpssPayment {
	var $name = '汇潮支付'; // 网银在线
	var $logo = 'ecpss';
	var $version = 4.0;
	var $description = "汇潮支付";
	var $type = 1; // 1->只能启动，2->可以添加
	var $charset = 'utf-8';
	var $orderby = 3;
	function ToSubmit($data) {
		global $_G;
		$MerNo = $data ["MerchantID"]; // 商户号，这里为测试商户号1001，替换为自己的商户号(老版商户号为4位或5位,新版为8位)即可
		$MD5key = $data ["VerficationCode"];
		$orderTime = date ( "YmdHis", time () );
		
		$BillNo = $data ["trade_no"];
		$Remark = '';
		
		$Amount = $data ["money"];
		
		$ReturnURL = $_G ['system'] ['con_weburl'] .U('index/index/payResult');
		$AdviceURL = $_G ['system'] ['con_weburl'] . U('index/index/payResult');
		
		$md5src = $MerNo ."&". $BillNo."&". $Amount ."&". $ReturnURL ."&". $MD5key; // 校验源字符串
		$MD5info = strtoupper ( md5 ( $md5src ) ); // MD5检验结果
		$defaultBankNumber = "";
		$products = "recharge {$data['trade_no']}";
		$url = "https://pay.ecpss.com/sslpayment?";
		$url .= "MerNo={$MerNo}";
		$url .= "&BillNo={$BillNo}";
		$url .= "&Amount={$Amount}";
		$url .= "&ReturnURL={$ReturnURL}";
		$url .= "&AdviceURL={$AdviceURL}";
		$url .= "&orderTime={$orderTime}";
		$url .= "&defaultBankNumber={$defaultBankNumber}";
		$url .= "&SignInfo={$MD5info}";
		$url .= "&Remark={$Remark}";
		$url .= "&products={$products}";
		return $url;
	}
	function GetFields() {
		return array (
				'MerchantID' => array (
						'label' => '商户号',
						'type' => 'string' 
				),
				'VerficationCode' => array (
						'label' => '密钥',
						'type' => 'string' 
				) 
		);
	}
}
