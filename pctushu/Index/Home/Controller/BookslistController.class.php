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

		   isset($_GET['cid']) ? $this->cid = $_GET['cid'] : $this->cid = 1;
         // 判断传过来分类id是否存在
         $ifCate = M('books_category')->where(array('id'=>$this->cid))->select();
         if(empty($ifCate)) $this->cid = 1; 

         $allLikeCate=M('books_category')->where(array('pid_path'=>array('LIKE','%,'.$this->cid.'%')))->select();
         //echo  M('books_category')->getLastSql();
         //dump($allLikeCate);
         if(count($allLikeCate)>1){
            $oneCate = foreach_arr($allLikeCate,'id');
         }else{
            // 合并本身cid
            $oneCate[] = $this->cid;
         }
         //dump($oneCate);

         /*****************************逻辑也有点问题
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
            // 合并本身cid
            $selfCid[]=$this->cid;
            $oneCate = array_merge($oneCateSecend, $oneCateThird, $selfCid); 
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
                  // 合并本身cid
                  $selfCid[]=$this->cid;
                  $oneCate = array_merge($oneCateSecend, $oneCateThird, $selfCid); 
   				}

   			}
   		}
   		//echo count($oneCate);
   		//p($oneCate);
         ********************************************************************************/
   		// 获取选中分类下的内容数据（即books_list表中cid的父id在$oneCate数组中）
   		$where = array ('category_id' => array ('IN',$oneCate));
   		$booksList = D('BooksView')->where($where)->select();
   		
   		$this->booksList = $booksList;
     

	}

    public function index() {


      $db = M('books_category');
      // 获取顶部分类
      $topCate = $db->where(array('pid'=>0))->field(array('id','category_name'))->select();
      $this->topCate = $topCate;

      isset($_GET['cid']) ? $this->cid = $_GET['cid'] : $this->cid = 1;
      // 判断传过来分类id是否存在
      $ifCate = $db->where(array('id'=>$this->cid))->select();
      if(empty($ifCate)) $this->cid = 1; 
      

      $secendCate = $db->where(array('pid'=>$this->cid))->field(array('id','category_name'))->select();
      //echo  M('books_category')->getLastSql();
      // 如果该二级分类下还有三级分类让它还显示二级分类
      $topCateId = foreach_arr($topCate,'id');
      // 判断是否是二级分类
      $ifSecendCate =  $db->where(array('pid'=>$this->cid, array('pid'=>array('IN',$topCateId))),'AND')->field(array('id','category_name'))->select();
      if($ifSecendCate) {
          // 默认初始化显示二级分类
          $this->secendCate = $secendCate;
      }else{
         // 是否有二级分类
         if(!empty($secendCate)) {
               // 否则传过来数据应该三级分类 但也要显示二级分类（点击传过来为二级分类id）
               $elseSecendCate = $db->where(array('id'=>$this->cid))->field(array('id','pid','category_name'))->find();
               // 获取其他同级二级分类 并合并
               $elseSecendCateResult = $db->where(array('pid'=>$elseSecendCate['pid']))->field(array('id','category_name'))->select();
               $this->secendCate = $elseSecendCateResult;

         }

      }
      // 如果还为空(但不能是个别二级分类id)
      $ifClickSecendCate = $db->where(array('id'=>$this->cid, array('pid'=>array('IN',$topCateId))),'AND')->field(array('id','pid','category_name'))->select();
      
      if(empty($elseSecendCateResult) && empty($ifSecendCate) && empty($ifClickSecendCate)) {
          // 点击传过来为三级分类id
          $elseifSecendCate = $db->where(array('id'=>$this->cid))->field(array('id','pid'))->find();
          $elseifSecendCateResult = $db->where(array('id'=>$elseifSecendCate['pid']))->field(array('id','pid'))->find();
          // 获取同级并 合并
          $allElseIfSecendCateResult = $db->where(array('pid'=>$elseifSecendCateResult['pid']))->field(array('id','category_name'))->select();
          $this->secendCate = $allElseIfSecendCateResult;

      }

     //dump($allElseIfSecendCateResult);
      //dump($ifClickSecendCate);




      // 获取一维数组二级分类id
      $secendCateId = foreach_arr($secendCate,'id');
      //dump($secendCateId);

      if(!empty($secendCateId)){
            // 获取第三层分类
            $thirdCate = $db->where(array('pid' => array('IN',$secendCateId)))->field(array('id','category_name'))->select();
           // echo  M('books_category')->getLastSql();
      }else{
            $thirdCate = $db->where(array('id' =>$this->cid))->field(array('id','category_name'))->select();
      }

      // 点击二级分类显示三级分类
      if(empty($thirdCate)) {
         // 传过来id为二级pid 则pid等于传过来id相等则符合条件
         $ifthirdCate = $db->where(array('pid' =>$this->cid))->field(array('id','category_name'))->select();
         $this->thirdCate = $ifthirdCate;
      } else {
          // 显示同级部分且为传过来cid的子id 首先获取该父pid
          $getThirdCatePid = $db->where(array('id'=>$this->cid))->find();
          $getCommonThirdCate = $db->where(array('pid_path'=>array('LIKE',"%,".$getThirdCatePid['pid']."%")))->select();
          // 且点击的不是二级分类
          if(empty($ifClickSecendCate)){  
             $this->thirdCate = $getCommonThirdCate;
          }else{
            $this->thirdCate = $thirdCate;
          }
      }
      // 如果还为空 则默认未加载三级分类
      if( empty($ifthirdCate) && empty($getCommonThirdCate) ){
         $this->thirdCate = $thirdCate;
      }

      //dump($thirdCate);
      //dump($getCommonThirdCate);
      //dump($ifthirdCate);

      /*************逻辑出了问题
      // 获取一维数组顶级分类id
      $topCateId = foreach_arr($topCate,'id');
      p($topCateId);
      // 获取第二层分类 且必须在顶层分类下获取
      isset($_GET['cid']) ? $cid = intval($_GET['cid']) : $cid = 1;
      // $secendCate = M('books_category')->where(array('pid'=>$cid, array('pid'=>array('IN',$topCateId))),'AND')->field(array('id','category_name'))->select();
      $secendCate = M('books_category')->where(array('pid'=>$cid))->field(array('id','category_name'))->select();
      //echo  M('books_category')->getLastSql();
      $this->secendCate = $secendCate;
      // 获取一维数组二级分类id
      $secendCateId = foreach_arr($secendCate,'id');
      dump($secendCateId);

      // 获取第三层分类
      $thirdCate = M('books_category')->where(array('pid' => array('IN',$secendCateId)))->field(array('id','category_name'))->select();
      echo  M('books_category')->getLastSql();
      $this->thirdCate = $thirdCate;
      *****************/

    	$this->display();
    }
}