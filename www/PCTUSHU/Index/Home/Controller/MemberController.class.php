<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
	 public function _initialize(){
        if ($_SESSION['uid']) {
            $visitor = M('user')->where(array('id'=>$_SESSION['uid']))->find();
            $this->visitor = $visitor;
            
            // 每天24点删除所有用户今日访问 (到时得记得加定时器)
            $hours  = intval(date('H'));
            $mutine = intval(date('i')); 

            if($hours==23 && $mutine >58) {
                M('user')->data(array('today_visitor'=>0))->save();
            }

        }
        // 获取今天访问和 总访问 到期清除本日访问

	// 	if(empty($_SESSION['uid'])){
	// 		redirect(U('Login/index'), 3,'please login to visitor!');
	// 	}
	 }
    public function index(){
        //p($_SESSION);
        $db = M('books_list');                                                              // 实例化User对象
        $count      = $db->where(array('uid' => intval($_SESSION['uid'])))->count();        // 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);                                            // 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();                                                        // 分页显示输出
        // 传递总页数
        $this->totalPage = ceil($count/5);
        $booksinfo = $db->where(array('uid' => intval($_SESSION['uid'])))->order("add_time DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->booksinfo = $booksinfo;
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }


    // 访问个人主页
    public function visitor() {
        if(isset($_GET['uid'])) {
            // 获取用户信息
            $user = M('user')->where(array('id'=>intval($_GET['uid'])))->find();
            $this->user = $user;

            // 添加今天访问 和总访问
            M('user')->where(array('id'=>intval($_GET['uid'])))->setInc('today_visitor');
            M('user')->where(array('id'=>intval($_GET['uid'])))->setInc('count_visitor');

            $db = M('books_list');                                                              // 实例化User对象
            $count      = $db->where(array('uid' => intval($_GET['uid'])))->count();        // 查询满足要求的总记录数
            $Page       = new \Think\Page($count,5);                                            // 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();                                                        // 分页显示输出
            // 传递总页数
            $this->totalPage = ceil($count/5);
            $booksinfo = $db->where(array('uid' => intval($_GET['uid'])))->order("add_time DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->booksinfo = $booksinfo;
            $this->assign('page',$show);// 赋值分页输出

            $this->followStatus();
            $this->display('visitor');
        }
    }
    public function visitorFollow() {
        if(isset($_GET['uid'])) { 
            // 获取用户信息
            $user = M('user')->where(array('id'=>intval($_GET['uid'])))->find();
            $this->user = $user;

            $followdb = D('FollowView');
            $count = $followdb->where(array('follow.uid'=>$_GET['uid']))->count();
            $Page       = new \Think\Page($count,5);                                            // 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();
            $this->totalPage = ceil($count/5);  

            $followResult = $followdb->where(array('follow.uid'=>$_GET['uid']))->order("add_time DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$show);// 赋值分页输出
            $this->followResult = $followResult;
        }
        $this->followStatus();
        $this->display('visitorfollow');
    }


    public function addFollow() {
        if(empty($_SESSION['uid'])) $this->error("请登入后关注吧！",U('Login/index'));
        // 检测是否存在
        $followCount=M('follow')->where(array('uid'=>$_SESSION['uid'],'books_id'=>intval($_GET['bid'])),'AND')->count();
        
        if(empty($followCount)) {
            
            if(M('follow')->data(array('uid'=>$_SESSION['uid'],'books_id'=>intval($_GET['bid'])))->add()){
                    $this->success("关注成功!");
            }

        } else {
            $this->error("已关注,请勿重复关注！");
        }
    }    
                   
    

    public function follow() {
        if($_SESSION['uid']) { 
            $followdb = D('FollowView');
            $count = $followdb->where(array('follow.uid'=>$_SESSION['uid']))->count();
            $Page       = new \Think\Page($count,5);                                            // 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();
            $this->totalPage = ceil($count/5);  

            $followResult = $followdb->where(array('follow.uid'=>$_SESSION['uid']))->order("add_time DESC")->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('page',$show);// 赋值分页输出
            $this->followResult = $followResult;
        }
        //echo $followdb->getLastSql();
        //dump($followResult);
        $this->display('follow');
    }
    // 取消关注处理
    public function delFollow() {
        //dump($_GET);
        if(M('follow')->where(array('uid'=>$_SESSION['uid'],'books_id'=>$_GET['bid']),'AND')->delete()) {
            $this->success('取消关注成功！');
        }

    }
  
}