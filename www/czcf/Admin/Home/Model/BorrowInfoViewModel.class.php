<?php
namespace Home\Model;
use Think\Model\ViewModel;
class BorrowInfoViewModel extends ViewModel {
   public $viewFields = array (
     'borrow_tender' => array ( 'status', 'borrow_nid', 'account_tender', 'account','recover_account_all',
     							'recover_account_interest','recover_account_yes','recover_account_interest_yes',
     							'recover_account_capital_yes','addtime','_type'=>'LEFT'),
     'borrow' 		 => array ( 'user_id','name','status'=>'borrowStatus','account'=>'borrowAccount',
     							'borrow_account_yes','borrow_account_wait','borrow_account_scale','borrow_period',
     				    	    'borrow_apr','nikename','_on' => 'borrow_tender.borrow_nid = borrow.borrow_nid'),
     'credit'        => array ( 'credit','_on'=>'borrow.user_id = credit.user_id')
   );

 }

