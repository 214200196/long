<?php
namespace Home\Model;
use Think\Model\ViewModel;
class UserViewModel extends ViewModel {
   public $viewFields = array (
     'users' => array ( 'user_id', 'username', 'email', 'password','reg_ip','reg_time','_type'=>'LEFT'),
     'users_info' => array ('niname', '_on' => 'users.user_id = users_info.user_id')
   );

 }

