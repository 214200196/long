<?php
namespace Home\Model;
use Think\Model\ViewModel;
class BookscontentViewModel extends ViewModel {
   public $viewFields = array (
     'Books_content' => array ( 'id', 'acticle_name', 'key_word', 'acticle_content', 'add_time','_type'=>'LEFT'),
     'content_category' => array ( 'id'=>'content_cate_id', 'bid','_on'=>'Books_content.id = content_category.content_id')
   );
 }
