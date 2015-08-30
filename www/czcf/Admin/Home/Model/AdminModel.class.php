<?php
namespace Home\Model;
use Think\Model;
class AdminModel extends Model{

	protected $_map = array(
		'admin' => 'username',
		'pwd'=>'password'
	); // 映射将pwd 映射为passworld 使之与数据库字段匹配 


   protected $_validate = array(
     array('username','require','管理账号不能为空'), //默认情况下用正则进行验证
     array('username','require','管理员账号已存在',0,'unique'),
     array('username','/^[\S]{6,15}$/','账号格式不正确字母或数字长度6~15位',0,'regex'), //默认情况下用正则进行验证
     //array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
     array('password','/^[\w]{6,15}$/','密码格式不正确字母或数字长度6~15位',0,'regex'), // 自定义函数验证密码格式
     array('adminname','require','管理员名称不能为空'), //默认情况下用正则进行验证

   );

    protected $_auto = array ( 
     array('password','md5',3,'function'), // 对password字段在新增和编辑的时候使md5函数处理
     array('addtime','time',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
     array('addip','get_client_ip',3,'function')
 	);

}

