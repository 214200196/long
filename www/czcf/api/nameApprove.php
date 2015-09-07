<!DOCTYPE html>
<html>
<head>
<title>实名认证接口测试</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>
<body>
<form action ="/czcf/home/api/nameApprove/smmkey/3eef0f2cb569f66b61248104de523c101a1e4361" enctype="multipart/form-data" method="POST">
姓名：<input name = "realName" type="text"/><br>
性别：<input type="radio" checked="checked" name="sex" value="男" />男<input type="radio"  name="sex" value="女"/>女 <br>
身份证：<input name = "creditNo" type="text"/><br>
身份证正面上传：<input type="file" name="card_pic1" /><br>
身份证反面上传：<input type="file" name="card_pic2" /><br>
<input type="hidden" name="user_id" value=36 />
<input type="submit" value="提交"/>
</form>
</body>
</html>
