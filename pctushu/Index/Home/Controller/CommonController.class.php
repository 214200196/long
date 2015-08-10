<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	//echo "longjianwei";
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


}