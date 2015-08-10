<?php
namespace Home\Controller;
use Think\Controller;
class BooksController extends CommonController {
    public function index(){
    	$this->getLocation();
    	$this->display();
    }
}