<?php
namespace Home\Model;
use Think\Model\ViewModel;
class BorrowInfoViewModel extends ViewModel {
   public $viewFields = array (
     'borrow_tender' => array ( 'recover_account_interest_wait','account_tender','addtime','_type'=>'LEFT'),
     'borrow' 		 => array ( 'name','status'=>'borrowStatus','borrow_period','repay_next_time',
     							'_on' => 'borrow_tender.borrow_nid = borrow.borrow_nid'),
     'credit'        => array ( 'credit','_on'=>'borrow.user_id = credit.user_id')
   );

 }

