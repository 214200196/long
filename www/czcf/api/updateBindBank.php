<!DOCTYPE html>
<html>
<head>
<title>银行卡绑定接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="/czcf/Public/js/jquery-2.1.4.min.js"></script>
</head>
<body>
	<?php
		// 调取用户银行卡信息
		$cardUrl 	= @file_get_contents('http://120.25.122.205/czcf/home/api/getbankinfo/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361/user_id/36');
		$cardResult = json_decode($cardUrl,true);
		var_dump($cardResult);
	?>
	<form action="/czcf/home/api/updateBindBank/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" method="POST">
	真实姓名：<input name="realname" type="text" disabled="disabled" value="龙剑威"/><br><br>
	所属银行：<select name="bank">
				<option>请选择银行</option>
				<?php
					$url 	   = @file_get_contents('http://120.25.122.205/czcf/home/api/bankList/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361');
	  				$urlResult = json_decode($url,true);
					//var_dump($urlResult);
					foreach ($urlResult as $key => $value) {
						echo "<option value=".$value['id'].">".$value['name']."</option>";
					}
				?>
			  </select><br><br>
	&nbsp;所在地：<select name="pcity" id="pcity">
					<option>请选择</option>
					<?php
						$urlAreas  = @file_get_contents('http://120.25.122.205/czcf/home/api/areasCity/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361');
		  				$urlAreasResult = json_decode($urlAreas,true);
						//var_dump($urlAreasResult);die;
						foreach ($urlAreasResult as $key => $value) {
							echo "<option value=".$value['id'].">".$value['name']."</option>";
						}
					?>
				  </select>

				  <select name="ccity" id="ccity">
				  	
				  </select>
				<br><br>
	开户支行名称：<input name="devBank" type="text" /><br><br>
		银行账号：<input name="bankNumber" type="text" /><br><br>
				 <input name="user_id" value=36 type="hidden"/>
		<input type="submit" value="提交" />
	</form>






<script>
	// 默认第二个选择框隐藏
	$('#ccity').hide();
	// 顶级地区选择事件
	$("#pcity").bind('change',function(){
		var pcity = $('#pcity').val();
		$.get('http://120.25.122.205/czcf/home/api/areasCity/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361',{city:pcity},function(data){
			if( data !='' ) {
				// 从返回json数据中获取选择框内容
				 var option = '<option>请选择分类</option>'; // 作用默认未触发事件显示该内容 
				 $.each(data, function(i, n){
					option += '<option  value="'+ n.id +'">'+ n.name +'</option>';
				 });
				
				$('#ccity').html(option);
				$('#ccity').show();

			} else {

				$('#ccity').hide();
			}
		},'json');
	});
</script>

</body>
</html>
