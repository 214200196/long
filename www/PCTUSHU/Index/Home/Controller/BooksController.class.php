<?php
namespace Home\Controller;
use Think\Controller;
class BooksController extends CommonController {
    public function index() {
    	$this->getLocation();
    	$this->getBooksInfo();
    	$this->getBooksCate();
    	$this->getContentList();
        // 点击数及阅读数实现
        if (intval($_GET['content_id']) && intval($_GET['bid'])) {
            M('books_content')->where(array('id'=>intval($_GET['content_id'])))->setInc('acticle_click');
            M('books_list')->where(array('id'=>intval($_GET['bid'])))->setInc('books_counts');
            // 阅读百分比
            $booksTotalPage = M('books_content')->where(array('books_id'=>intval($_GET['bid'])))->count();
            $booksFirstPage = M('books_content')->where(array('books_id'=>intval($_GET['bid'])))->order("id ASC")->field('id')->limit(1)->find();
           
            // 当前页-开始页+1/总页数
            $booksPercent = (intval($_GET['content_id']) - $booksFirstPage['id'] + 1)/$booksTotalPage*100;
            $this->booksPercent = round($booksPercent,2);
            
        }

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