<?php
namespace Home\Controller;
use Think\Controller;
class BookslistController extends CommonController {
	public function _initialize(){
		// 数据缓存操作
		if (S('topCateCache')) {
			$this->topCate = S('topCateCache');
		} else{
			// 获取首页内容分类菜单pid=0
   			$topCate=M('books_category')->field(array('category_name','id'))->where(array('pid'=>0))->select();
   			$this->topCate=$topCate;
   			// 生成缓存
   			S('topCateCache',$topCate,3600*24);
   			//echo "缓存测试";
		}
		
		// 获取链接过来分类cid
   		isset($_GET['cid']) ? $this->cid = $_GET['cid'] : $this->cid = 1;
   		
   		// 获取子cid
   		$childCate = M("books_category")->where(array('pid'=>intval($this->cid)))->select();
   		// 转换成一维数组(获取第二层子类)
   		$oneCateSecend = foreach_arr($childCate,'id');
   		// 获取第三层子类
   		if (count($oneCateSecend) > 1){
   			$childCateThird = M("books_category")->where(array('pid' => array('IN',$oneCateSecend)))->select();
   			$oneCateThird  = foreach_arr($childCateThird,'id');
   			// 合并第二层子类和第三层子类下的图书
   			$oneCate = array_merge($oneCateSecend, $oneCateThird); 
   		}

   		// 如果不存在子类
   		if ( ! $childCate) {
   			$childCate = M("books_category")->where(array('id'=>intval($_GET['cid'])))->find();
   			$oneCate = array($childCate['id']);
   			// url 输入不存在cid
   			if( ! $childCate) {
   				// ?项目结束是否考虑直接404页面
   				// 默认选择第一个分类
   				$childCate = M("books_category")->where(array('pid'=>1))->select();
   				 // 转换成一维数组
   				$oneCateSecend = foreach_arr($childCate,'id');

   				if (count($oneCateSecend) > 1) {
	   				$childCateThird = M("books_category")->where(array('pid' => array('IN',$oneCateSecend)))->select();
		   			$oneCateThird  = foreach_arr($childCateThird,'id');
		   			// 合并第二层子类和第三层子类下的图书
		   			$oneCate = array_merge($oneCateSecend, $oneCateThird); 
   				}

   			}
   		}
   		//echo count($oneCate);
   		//p($oneCate);
   		// 获取选中分类下的内容数据（即books_list表中cid的父id在$oneCate数组中）
   		$where = array ('category_id' => array ('IN',$oneCate));
   		$booksList = D('BooksView')->where($where)->select();
   		
   		$this->booksList = $booksList;

	}

    public function index(){

    	$this->display();
    }
}