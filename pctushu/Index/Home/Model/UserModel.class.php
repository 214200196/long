<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model{

	protected $_map = array(
		'pwd' => 'passworld',
		'username'=>'name'
	); // 映射将pwd 映射为passworld 使之与数据库字段匹配 


   protected $_validate = array(
     array('verify','require','验证码不能为空'), //默认情况下用正则进行验证
     array('email','','帐号邮箱已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
     array('email','email','邮箱格式错误'),
     array('name','require','用户名不能为空'), //默认情况下用正则进行验证
     //array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
     array('pwded','passworld','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
     array('passworld','/^[\w]{6,15}$/','密码格式不正确',0,'regex'), // 自定义函数验证密码格式
   );

    protected $_auto = array ( 
     array('passworld','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
     array('name','getName',3,'callback'), // 对name字段在新增和编辑的时候回调getName方法
     array('add_time','time',2,'function'), // 对update_time字段在更新的时候写入当前时间戳
 	);

}

