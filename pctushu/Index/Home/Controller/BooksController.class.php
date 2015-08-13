<?php
namespace Home\Controller;
use Think\Controller;
class BooksController extends CommonController {
    public function index() {
    	$this->getLocation();
    	$this->getBooksInfo();
    	$this->getBooksCate();
    	$this->getContentList();
    	$this->display();
    }
    // 获取目录
    public function getBooksCate() {
    	$getAllContentCate = M('content_category')->where(array('bid'=>intval($_GET['bid'])))->order("id ASC")->select();
    	$getAllContentCateResult = booksCateArr($getAllContentCate);
    	$this->getAllContentCateResult = $getAllContentCateResult;
    }
    // 获取内容
    public function getContentList() {
    	if ($_GET['content_id']) {
    		$db = D('BookscontentView');
    		$contentList = $db->where(array('content_id'=>$_GET['content_id'],array('books_id'=>$_GET['bid'])),'AND')->find();
    		//echo $db->getLastSql();
            $this->getContentList = $contentList;
    	}
    }




}