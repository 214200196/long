<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){

    	$this->uid = $_SESSION['uid'];
        $this->username = $_SESSION['username'];
        
    }
    // 获取图书位置
    public function getLocation() {
    	//p($_GET);
    	// 获取该图书cid
    	$booksCid = M('books_list')->where(array('id'=>intval($_GET['bid'])))->find();

    	empty($booksCid['category_id']) ? $cid = 1 : $cid = $booksCid['category_id'];

    	// 换一种方法实现添加数据库父id路径pid_path
    	$selectBooksCatePath = M('books_category')->where(array('id'=>$cid))->getField('pid_path');
    	$explodeCate = explode(',', $selectBooksCatePath);
    	//dump($selectBooksCatePath);
    	//p($explodeCate);
    	$cateResult = M('books_category')->where(array('id' => array('IN',$explodeCate)))->field(array('id','category_name'))->select();
    	$this->cateResult = $cateResult;
    	//dump($cateResult);

    	// -----------------上面方法更高效
    	// 获取图书所有分类
    	//$allBooksCate = M('books_category')->select();
    	// 递归方法
    	//$selectByBooksCate = regetArray($allBooksCate,$cid);
    	//dump($selectByBooksCate);
    }

    //获取图书名称
    public function getBooksInfo() {
        if(empty($_GET['bid'])) $_GET['bid'] = 1;
        $booksInfo = M('books_list')->where(array('id'=>intval($_GET['bid'])))->find();

        $getMiniContentId = M('content_category')->where(array('bid'=>$booksInfo['id'],array('content_id'=>array('NEQ',0))),'AND')->order("content_id ASC")->field("content_id")->limit(1)->find();
        $this->getMiniContentId = $getMiniContentId;

        $getMaxContentId = M('content_category')->where(array('bid'=>$booksInfo['id'],array('content_id'=>array('NEQ',0))),'AND')->order("content_id DESC")->field("content_id")->limit(1)->find();
        $this->getMaxContentId = $getMaxContentId;

        //echo M('content_category')->getLastSql();
        //dump($getMaxContentId);
        $this->booksInfo = $booksInfo;
    }


}