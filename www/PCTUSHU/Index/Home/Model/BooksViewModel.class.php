<?php
namespace Home\Model;
use Think\Model\ViewModel;
class BooksViewModel extends ViewModel {
   public $viewFields = array (
     'Books_list' => array ( 'id', 'books_name', 'books_counts', 'add_time', 'books_face','uid','category_id','_type'=>'LEFT'),
     'Books_category' => array ( 'category_name', '_on'=>'Books_list.category_id = Books_category.id'),
     'User' => array ('name', '_on' => 'Books_list.uid = User.id')
   );
 }

