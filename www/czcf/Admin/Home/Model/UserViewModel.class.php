<?php
namespace Home\Model;
use Think\Model\ViewModel;
class UserViewModel extends ViewModel {
   public $viewFields = array (
     'users' => array ( 'user_id', 'username', 'email', 'logintime','reg_ip','reg_time','last_ip','last_time','_type'=>'LEFT'),
     'users_info' => array ('niname','type_id','status','realname','realname_status','phone','phone_status', '_on' => 'users.user_id = users_info.user_id')
   );

 }

