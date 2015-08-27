<?php
namespace Home\Model;
use Think\Model\ViewModel;
class AdminViewModel extends ViewModel {
   public $viewFields = array (
     'admin' => array ( 'id', 'username', 'adminname', 'type_id', 'addtime','addip','update_time','update_ip','login_time','login_ip','_type'=>'LEFT'),
     //'adminlog' => array ( 'category_name', '_on'=>'Books_list.category_id = Books_category.id'),
     'admin_type' => array ('name', '_on' => 'admin.type_id = admin_type.id')
   );
 }

