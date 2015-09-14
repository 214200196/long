<!DOCTYPE html>
<html>
<head>
<title>顶级轮播图接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
	<?php
		$url = @file_get_contents('http://120.25.122.205/czcf/home/api/topphoto/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361');
	  	$urlResult = json_decode($url,true);
	  	var_dump($urlResult);
	?>
<img src="<?php echo $urlResult[0];?>"/>
<img src="<?php echo $urlResult[1];?>"/>
</body>
</html>
