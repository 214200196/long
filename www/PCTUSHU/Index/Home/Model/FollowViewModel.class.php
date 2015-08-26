<?php
namespace Home\Model;
use Think\Model\ViewModel;
class FollowViewModel extends ViewModel {
   public $viewFields = array (
     'Books_list' => array ( 'id', 'books_name', 'books_counts', 'add_time', 'books_face','uid','category_id','_type'=>'INNER'),
     'follow'     => array ('uid','books_id','_on'=>'Books_list.id = follow.books_id')
   );
 }

