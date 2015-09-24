<?php
	/**
	 * APP消息推送类
	 * 默认为极光推送
	 * @update	支持同时向多个app推送	sugang	2014-7-19
	 **/
	class AppPush {
		
		private $appKey;		// App Key
		private $secretKey;		// Secret Key
		private $initParams;	// 其它参数
		
		private $pushApps;				// 推送多个app的标识
		private $pushNumTotal	= 0;	// 推送多个app时的推送总次数
		private $pushNum		= 0;	// 推送多个app时的当前推送
		
		private $pushPlatUse	= 'jpush';	// 当前使用的api平台
		private $productCode	= 'yl1001';	// 当前使用的产品
		private $pushPlatArr	= array('jpush','baidu','yl1001');	// 使用的平台
		
		// 不同平台，使用不同的字符集
		private $pushCharset	= array(
			'jpush'		=> 'utf-8',
			'baidu'		=> 'utf-8',
			'yl1001'	=> 'gbk',
		);
		
		// 不同平台，不同产品的key
		private $keyArr			= array(
			'jpush'	=> array(
				'yl1001'	=> array(
					array(
						'app_key'	=> '',
						'secret_key'=> '',
					),
					array(	// 只推送给ios
						'app_key'	=> '',
						'secret_key'=> '',
					),
				),
				'moyuan'	=> array(
					'app_key'	=> '',
					'secret_key'=> '',
				),
			),
			'baidu'	=> array(
				'yl1001'	=> array(
					'app_key'	=> '',
					'secret_key'=> '',
				),
			),
		);
	
		/**
		 * 构造函数
		 * @param String $pushPlatUse
		 * @param String $appKey
		 * @param String $secretKey
		 * @param Array	 $initParams
		 */
		public function __construct($initParams = array()) {
			// 参数设置
			if ( $initParams['pushPlatUse'] ) {
				$this->pushPlatUse	= $initParams['pushPlatUse'];
			}
			if ( $initParams['productCode'] ) {
				$this->productCode	= $initParams['productCode'];
			}
			if ( $initParams['appKey'] ) {
				$this->appKey		= $initParams['appKey'];
			}
			if ( $initParams['secretKey'] ) {
				$this->secretKey	= $initParams['secretKey'];
			}
			unset($initParams['pushPlatUse']);
			unset($initParams['productCode']);
			unset($initParams['appKey']);
			unset($initParams['secretKey']);
			
			if ( $initParams ) {
				$this->initParams	= $initParams;
			}
			// 初始化key
			$this->initPushKey();
			// 初始化推送类
			$this->initPushClass();
		}
		
		/**
		 * 检查平台是否合法
		 * @param string	$pushPlat
		 **/
		public function checkPushPlat() {
			if ( !array_key_exists($this->pushPlatUse, $this->pushPlatArr) ) {
				return false;
			}
			return true;
		}
		
		/**
		 * 初始化key
		 **/
		public function initPushKey() {
			if ( $this->pushPlatUse && $this->productCode ) {
				if ( array_key_exists($this->pushPlatUse, $this->keyArr) ) {
					if ( array_key_exists($this->productCode, $this->keyArr[$this->pushPlatUse]) ) {
						$keyArr	= $this->keyArr[$this->pushPlatUse][$this->productCode];
						if ( !$keyArr['app_key'] && is_array($keyArr[$this->pushNum]) ) {	// 多个app推送
							$this->pushApps		= true;
							$this->pushNumTotal	= count($keyArr);
							$this->appKey	= $keyArr[$this->pushNum]['app_key'];
							$this->secretKey= $keyArr[$this->pushNum]['secret_key'];
						} else {
							$this->appKey	= $keyArr['app_key'];
							$this->secretKey= $keyArr['secret_key'];
						}
					}
				}
			}
		}
		
		/**
		 * 加载不同平台需要的类
		 **/
		public function initPushClass() {
			switch( $this->pushPlatUse ) {
				case 'jpush':
					// 极光推送
					include_once dirname( __FILE__) . '/lib/jpush/JPushClient.php';
					break;
				case 'baidu':
					// 百度云推送
					include_once dirname( __FILE__) . '/lib/baidu/Channel.class.php';
					break;
			}
		}
		
		/**
		 * 初始化推送对象
		 **/
		public function initPushObject() {
			switch( $this->pushPlatUse ) {
				case 'jpush':
					if ( !isset($this->initParams['time_to_live']) ) {
						$this->initParams['time_to_live']	= 86400; // 离线时长：1天
					}
					if ( !isset($this->initParams['platform']) ) {
						$this->initParams['platform']		= '';	// android,ios
					}
					if ( !isset($this->initParams['apns_production']) ) {
						$this->initParams['apns_production']= false;	// APNS 通知发送环境 false开发环境 true生产环境
					}
					$pushObj	= new JPushClient($this->appKey,$this->secretKey, $this->initParams['time_to_live'], $this->initParams['platform'], $this->initParams['apns_production']);
					break;
				case 'baidu':
					if ( !isset($this->initParams['arr_curlOpts']) ) {
						$this->initParams['arr_curlOpts']	= array();
					}
					$pushObj	= new Channel($this->appKey, $this->secretKey, $this->initParams['arr_curlOpts']);
					break;
			}
			return $pushObj;
		}
		
		/**
		 * 初始化默认参数
		 * 默认为广播
		 * @params	array	用户参数参数
		 * @extras	array	扩展参数列表
		 **/
		public function initPushParam(&$params, &$extras) {
			$default_params	= array();
			$default_extras	= array();
			$params			= is_array($params)	? $params	: array();
			$extras			= is_array($extras)	? $extras	: array();
			switch( $this->pushPlatUse ) {
				case 'jpush':
					// 极光推送
					$default_params['receiver_type']	= 4; 	// 接收者类型：4广播
					$default_params['receiver_value']	= ' '; 	// 广播不用填写
					$default_params['sendno']			= time();	// 发送编号（最大支持32位正整数(即 4294967295 )）
					$default_params['send_description']= '';	// 描述此次发送调用
					$default_params['override_msg_id']	= '';	// 覆盖的上一条消息的 ID
					if( $this->initParams['platform']=='' || strpos($this->initParams['platform'], 'ios')!==false ){
						// ios处理
						$default_extras['ios']['badge']	= 1;
						$default_extras['ios']['sound']	= 'default';
					}
					break;
				case 'baidu':
					// 百度云推送
					
					break;
			}
			$params	= $params + $default_params;
			$extras	= $extras + $default_extras;
		}
		
		/**
		 * 推送通知
		 * @param $title 推送通知的标题（客户端接收的内容）
		 * @param $content 推送通知的内容（客户端接收的内容）
		 * @param $params 推送的配置参数
		 * @param $extras 推送的扩展内容（客户端接收的内容）
		 **/
		public function sendNotice($title, $content, $params, $extras = array()) {
			/// 用于多次推送
			$_title		= $title;
			$_content	= $content;
			$_params	= $params;
			$_extras	= $extras;
			/////////////////////
			// 判断内容是否需要转码
			if( $this->pushCharset[$this->pushPlatUse] == 'utf-8' ){
			// 将内容转成utf-8编码
				if( $title!='' ){
					$title		= iconv('gbk', 'utf-8', $title);
				}
				if( $content!='' ){
					$content	= iconv('gbk', 'utf-8', $content);
				}
			}
			
			$pushObj	= $this->initPushObject();
			$this->initPushParam($params, $extras);
			switch( $this->pushPlatUse ) {
				case 'jpush':
					$title	= $this->filterSpecialChar($title);	// 过滤特殊字符
					$content= $this->filterSpecialChar($content);// 过滤特殊字符
					$content= $this->getAppropriateLen($title, $content, $params, $extras, '1');// 获取合适长度的内容
					
					if( $params['receiver_type'] == '4' ){
						$result_tmp	= $pushObj->sendNotification($title, $content, $params, $extras);// 推送通知
						$result		= $this->formatResult($result_tmp);
					} else {
						if( $params['receiver_type']=='2' ){
						// 标签tag，一次支持10个标签
							$len	= 10;
						} else if( $params['receiver_type']=='3' || $params['receiver_type']=='5' ){
						// 别名alias和RegistrationID，一次支持1000个
							$len	= 1000;
						}
						$value_str	= $params['receiver_value'];
						$value_arr	= $this->getAliasStringByStr($value_str, $len);
						$result		= array(
							'status'		=> 'FAIL',
							'code'			=> 0,
							'status_desc'	=> '',
							'info'			=> '',
						);
						foreach( $value_arr as $val ){
							$params['receiver_value']	= $val;
							$result_tmp	= $pushObj->sendNotification($title, $content, $params, $extras);// 推送通知
							$result_tmp	= $this->formatResult($result_tmp);
							
							if( $result_tmp['status']=='OK' && $result['status']=='FAIL' ){
								$result['status']	= 'OK';
								$result['code']		= 200;
							}
							$result['info'][]		= $result_tmp;
						}
					}
					break;
				case 'baidu':
					// 推送类型，取值范围为：1～3 1：单个人 2：一群人 3：所有人
					$push_type	= 3;
					
					// 设备类型，取值范围为：1～5  1：浏览器设备；2：PC设备；3：Andriod设备；4：iOS设备；5：Windows Phone设备； 
					$optional[Channel::DEVICE_TYPE]	= 3;	
					
					// 消息类型0：消息 1：通知
					$optional[Channel::MESSAGE_TYPE]= 1;
					
					//通知类型的内容必须按指定内容发送，示例如下：
					$message	= '{ 
							"title": "test_push",
							"description": "open url",
							"notification_basic_style":7,
							"open_type":1,
							"url":"http://www.baidu.com"
						}';
					
					// 消息标识
					$message_key= time();
					$result		= $pushObj->pushMessage( $push_type, $message, $message_key, $optional );
					$result		= $this->formatResult($result);
					break;
				case 'yl1001':
					$title		= $this->filterSpecialChar($title);	// 过滤特殊字符
					$content	= $this->filterSpecialChar($content);// 过滤特殊字符
					// $result_tmp	= $pushObj->send_note_by_user_id($title, $content, $params, $extras);
					$result_tmp	= $pushObj->send_note_by_device_token($title, $content, $params, $extras);
					$result		= array(
							'status'		=> 'FAIL',
							'code'			=> 0,
							'status_desc'	=> '',
							'info'			=> '',
						);
					foreach($result_tmp as $result_device){
						foreach($result_device as $val){
							$re_tmp				= $this->formatResult($val);
							$result['info'][]	= $re_tmp;
							if( $re_tmp['status']=='OK' ){
								$result['status']	= 'OK';
								$result['code']		= 200;
							}
						}
					}
					break;
			}
			if ( $this->pushApps ) {
				$this->pushNum++;
				if ( $this->pushNum < $this->pushNumTotal ) {
					$this->initPushKey();	// 重新初始化key
					$this->sendNotice($_title, $_content, $_params, $_extras);
				}
			}
			return $result;
		}
		
		/**
		 * 推送消息(仅Android设备支持)
		 * @param $title 推送通知的标题（客户端接收的内容）
		 * @param $content 推送通知的内容（客户端接收的内容）
		 * @param $params 推送的配置参数
		 * @param $extras 推送的扩展内容（客户端接收的内容）
		 **/
		public function sendMessage($title, $content, $params, $extras = array()) {
			////// 多次推送通知后，消息只推送一个
			$this->pushNum	= 0;
			$this->initPushKey();
			//////
			// 判断内容是否需要转码
			if( $this->pushCharset[$this->pushPlatUse] == 'utf-8' ){
			// 将内容转成utf-8编码
				if( $title!='' ){
					$title		= iconv('gbk', 'utf-8', $title);
				}
				if( $content!='' ){
					$content	= iconv('gbk', 'utf-8', $content);
				}
			}
			
			$pushObj	= $this->initPushObject();
			$this->initPushParam($params, $extras);
			switch( $this->pushPlatUse ) {
				case 'jpush':
					$title	= $this->filterSpecialChar($title);	// 过滤特殊字符
					$content= $this->filterSpecialChar($content);// 过滤特殊字符
					
					if( $params['receiver_type'] == '4' ){
						$result_tmp	= $pushObj->sendCustomMessage($title, $content, $params, $extras);
						$result		= $this->formatResult($result_tmp);
					} else {
						if( $params['receiver_type']=='2' ){
						// 标签tag，一次支持10个标签
							$len	= 10;
						} else if( $params['receiver_type']=='3' || $params['receiver_type']=='5' ){
						// 别名alias和RegistrationID，一次支持1000个
							$len	= 1000;
						}
						$value_str	= $params['receiver_value'];
						$value_arr	= $this->getAliasStringByStr($value_str, $len);
						$result		= array(
							'status'		=> 'FAIL',
							'code'			=> 0,
							'status_desc'	=> '',
							'info'			=> '',
						);
						foreach( $value_arr as $val ){
							$params['receiver_value']	= $val;
							$result_tmp	= $pushObj->sendCustomMessage($title, $content, $params, $extras);// 推送通知
							$result_tmp	= $this->formatResult($result_tmp);
							if( $result_tmp['status']=='OK' && $result['status']=='FAIL' ){
								$result['status']	= 'OK';
								$result['code']		= 200;
							}
							$result['info'][]		= $result_tmp;
						}
					}
					break;
				case 'baidu':
					
					break;
			}
			return $result;
		}
		
		/**
		 * 统一处理返回值
		 **/
		public function formatResult($result) {
			switch( $this->pushPlatUse ) {
				case 'jpush':
					$status			= 'FAIL';
					$code			= $result->getCode();
					$status_desc	= $result->getMessage();
					if ($code == 0) { // 正确
						$status	= 'OK';
						$code	= 200;
					}
					$info			= array(
						'msgId'				=> $result->getMesId(),
						'sendno'			=> $result->getSendno(),
						'code'				=> $result->getCode(),
						'message'			=> $result->getMessage(),
						'responseContent'	=> $result->getResponseContent(),
					);
					break;
				case 'baidu':
					$status			= 'FAIL';
					$status_desc	= '';
					if ( $result['request_id'] ) {
						$status	= 'OK';
						$code	= 200;
					}
					$info	= $result;
					break;
				case 'yl1001':
					$status			= 'FAIL';
					$status_desc	= '';
					$code			= 0;
					$info			= array();
					if( $result==1 ){
						$status	= 'OK';
						$code	= 200;
					}
					break;
			}
			$result	= array(
				'status'		=> $status,
				'code'			=> $code,
				'status_desc'	=> $status_desc,
				'info'			=> $info,
			);
			return $result;
		}
		
		/**
		 * 过滤特殊字符
		 * 如发现其他不允许的字符再行添加
		 * @param $str 要过滤的字符串
		 * @param $excludeArr 在过滤字符串的过程中不过滤的字符串
		 **/
		public function filterSpecialChar($str, $excludeArr = '') {
			if( $str == '' ){
				return $str;
			}
			// 非必须去除的特殊字符
			$search_char	= array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…' );  
			$replace_char	= array (' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…');
			$exclude_char	= explode(',', $excludeArr);

			if( $exclude_char ){
				foreach( $exclude_char as $val ){
					$search_key	= array_search($val, $search_char);
					if( $search_key !== false ){
						unset( $search_char[$search_key] );
						unset( $replace_char[$search_key] );
					}
				}
			}
			$str			= str_replace($search_char, $replace_char, $str);
			// 必须去除的特殊字符
			$search_char	= array("\r", "\n", "\r\n", ';', '&');
			$replace_char	= array('', '', '', "；", '');
			$str			= str_replace($search_char, $replace_char, $str);
			return $str;
		}

		/**
		 * 获取合适长度的内容
		 **/
		public function getAppropriateLen($title, $content, $params, $extras, $type){
			switch( $this->pushPlatUse ) {
				case 'jpush':
					if( $type == '1' ){
					// 通知类型, 长度不超过220字节
						// 计算长度
						$content_len	= strlen($content);// 内容的长度
						$extras_len		= strlen(json_encode($extras));// 扩展内容的长度
						$cut_len		= $extras_len + $content_len - 220; // 要剪切的字节长度
						if( $cut_len > 0 ){
						// 如果cut_len值大于0，则表示内容需要截取
							$str	= mb_strcut($content, 0, $content_len-$cut_len, 'utf-8');
						} else {
							$str	= $content;
						}
					} else {
					// 消息类型，
						
					}
					break;
				case 'baidu':
					
					break;
			}
			return $str;
		}
		
		/**
		 * 截取extras和content
		 **/
		public function getAppropriateExtras($title, &$content, $params, &$extras, $type, $cut_arr){
			switch( $this->pushPlatUse ) {
				case 'jpush':
					if( $this->initParams['platform']=='' || strpos($this->initParams['platform'], 'ios')!==false ){
						// ios处理
						$extras['ios'] = array(
							'badge' => 1,
							'sound' => 'default'
						);
					}
					if( $this->pushCharset['jpush']=='utf-8' ){
						if( !$this->checkStringIsUtf8($content) ){
							$content        = iconv('gbk', 'utf-8', $content);
							$content_to_gbk = true;
						}
						foreach ($extras as $key => $value) {
							if( !$this->checkStringIsUtf8($value) ){
								$extras[$key]  = iconv('gbk', 'utf-8', $value);
								$extras_to_gbk = true;
							}
						}
					}
					if( $type == '1' ){
					// 通知类型, 长度不超过220字节
						// 计算长度
						$content_len	= strlen($content);// 内容的长度
						$extras_len		= strlen(json_encode($extras));// 扩展内容的长度
						$cut_len		= $extras_len + $content_len - 220; // 要剪切的字节长度
						if( $cut_len > 0 ){
						// 如果cut_len值大于0，则表示内容需要截取
							if( !empty($cut_arr) ){
								$cut_arr_count = count($cut_arr);
								$e_val_len_c   = ceil( $cut_len/$cut_arr_count ); // 如果传入多个可截取值，则平均截取
								// $e_val_len_c   = $cut_arr_count==1 ? ceil( $cut_len/5*4 ) : $e_val_len_c;
								foreach ($cut_arr as $key => $value) {
									if( $cut_len<=0 ){
										break;
									}
									$e_val_len = strlen($extras[$value]);
									$extras[$value] = mb_strcut($extras[$value], 0, abs($e_val_len-$e_val_len_c)-1, 'utf-8').'...';
									$cut_len -= $e_val_len_c;// 剩余要截取的长度
								}
							}
						}
					} else {
					// 消息类型，
						
					}
					if( $this->pushCharset['jpush']=='utf-8' ){
						if( $this->checkStringIsUtf8($content) && $content_to_gbk==true ){
							$content = iconv('utf-8', 'gbk', $content);
						}
						foreach ($extras as $key => $value) {
							if( $this->checkStringIsUtf8($value) && $extras_to_gbk==true){
								$extras[$key] = iconv('utf-8', 'gbk', $value);
							}
						}
					}
					unset($extras['ios']);
					break;
				case 'baidu':
					
					break;
			}
		}

		/**
		 * 剪切alias数组长度，默认1000个alias为一个长度。
		 * 返回字符串，以|分隔
		 */
		public function getAliasStringByArray($items, $len=1000, $key=''){
			$alias_str	= '';
			$arr_len	= count( $items );
			if( $arr_len > $len ){
			// 数组大于1000就要切割
				$items_prev		= array_slice($items, 0 ,$len);
				$alias_str		= $this->getAliasStringByArray($items_prev, $len, $key);
				
				$items_next		= array_slice($items, $len);
				$alias_str		.= $this->getAliasStringByArray($items_next, $len, $key);
			} else {
				if( $key ){
					foreach($items as $val){
						$alias_str	.= $val[$key].',';
					}
				} else {
					foreach($items as $val){
						$alias_str	.= $val.',';
					}
				}
				$alias_str	= trim($alias_str, ',').'|';
			}
			return $alias_str;
		}
		
		/**
		 * 剪切alias数组长度，默认1000个alias为一个长度。
		 * 返回字符串，以|分隔
		 */
		public function getAliasStringByStr($item, $len=1000){
			$alias_arr	= array();
			$item		= trim($item, ',');
			$doc_pos	= substr_count($item, ',');// 计算,出现的次数
			if( $doc_pos > $len - 1 ){
			// 字符串需要切割
				$item_arr	= explode(',', $item);
				$result		= $this->getAliasStringByArray($item_arr, $len);
				$alias_arr	= explode('|', trim($result, '|'));
			} else {
				$alias_arr[]	= $item;
			}
			return $alias_arr;
		}

		/**
		 * 判断字符串是否是utf-8编码
		 * @param string 判断字符串
		 * @return boolean
		 * @Data 2013-12-12
		 * @Auothor 056
		 **/
		public function checkStringIsUtf8($str){
			$len = strlen($str);
			for($i = 0; $i < $len; $i++){
				$c = ord($str[$i]);
				if ($c > 128) {
					if (($c > 247)){
						return false;
					}
					elseif ($c > 239){
						$bytes = 4;
					}
					elseif ($c > 223){
						$bytes = 3;
					}
					elseif ($c > 191){
						$bytes = 2;
					}
					else{
						return false;
					}
					
					if (($i + $bytes) > $len){
						return false;
					}
					while ($bytes > 1) {
						$i++;
						$b = ord($str[$i]);
						if ($b < 128 || $b > 191) return false;
						$bytes--;
					}
				}
			}
			return true;  
		}
		
	}
