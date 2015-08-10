<?php
namespace Home\Controller;
use Think\Controller;
class AddbooksController extends CommonController {
    public function _initialize(){
        if(! $_SESSION['uid']){
            $this->error("请登入后访问该页面！",U('Login/index'));
        }
    }
    public function index(){
    	$cateList= M('books_category')->where(array('pid'=>0))->select();
    	$this->assign('cateList',$cateList);
    	$this->display();
    }

    public function getCate(){
    	if ( ! IS_AJAX) $this->error("页面不存在");
    	$db = M('books_category');
    	$where = array('pid' => intval($_POST['topselect']));
    	$midCate = $db->where($where)->select();
    	echo json_encode($midCate);
    }
    public function addBooks(){
    	if( ! IS_POST) {
            $this->error("页面不存在");
        }
    	if ($_POST['booksname'] == '') {
    		$this->error("请填写图书名称");exit;
    	}
    	if(!is_numeric($_POST['firstcate'])){
    		$this->error("请选择分类1");exit;
    	}
    	if(isset($_POST['secendcate']) && !is_numeric($_POST['secendcate'])){
    		$this->error("请选择分类2");exit;
    	}
    	if(isset($_POST['thirdcate']) && ! is_numeric($_POST['thirdcate'])){
    		$this->error("请选择分类3");exit;
    	}
        if (!isset($_FILES['photo'])) {
            $this->error("请上传图片");exit;
        }
    	// 如果上传了封面
    	if(isset($_FILES['photo'])){
    		$savepath = $this->upload();
            
            //dump($savepath);
            //p($_POST);
            //p($_FILES);

            // 将数据插入数据库
            if ($savepath) {

                $db=M('books_list');
                // 如果该分类含所有子分类只取最后一个分类id
                    if (isset($_POST['firstcate']) && isset($_POST['secendcate']) && isset($_POST['thirdcate'])) {
                        $data = array (
                            'books_name' => htmlspecialchars($_POST['booksname']),
                            'add_time'   => time(),
                            'category_id'=> intval($_POST['thirdcate']),
                            'books_face' => $savepath,
                            'uid'        => $_SESSION['uid']
                        );
                        if ($db->data($data)->add()) {
                            $this->success("发布成功！正在为你跳转.....",U('Member/index'));exit;
                        } else {
                            $this->error("发布失败！请重试");
                        }

                    }

                    if (isset($_POST['firstcate']) && isset($_POST['secendcate'])) {
                        $data = array (
                            'books_name' => htmlspecialchars($_POST['booksname']),
                            'add_time'   => time(),
                            'category_id'=> intval($_POST['secendcate']),
                            'books_face' => $savepath,
                            'uid'        => $_SESSION['uid']
                        );
                        if ($db->data($data)->add()) {
                            $this->success("发布成功！正在为你跳转.....",U('Member/index'));exit;
                        } else {
                            $this->error("发布失败！请重试");
                        }

                    }

                    if (isset($_POST['firstcate'])) {
                        $data = array (
                            'books_name' => htmlspecialchars($_POST['booksname']),
                            'add_time'   => time(),
                            'category_id'=> intval($_POST['firstcate']),
                            'books_face' => $savepath,
                            'uid'        => $_SESSION['uid']
                        );
                        if ($db->data($data)->add()) {
                            $this->success("发布成功！正在为你跳转.....",U('Member/index'));exit;
                        } else {
                            $this->error("发布失败！请重试");
                        }

                    }

            }

        
    	}

    }

    public function upload(){

    	$upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;
        $upload->rootPath = './Uploads/';
        $upload->savePath = '';
        $upload->saveName = array('uniqid','');
        $upload->exts     = array('jpg', 'gif', 'png', 'jpeg');
        $upload->autoSub  = true;
        $upload->subName  = array('date','Ymd');
    	
        // 上传文件 
	    $info   =   $upload->uploadOne($_FILES['photo']);
	    if(!$info) {
	    	// 上传错误提示错误信息
	        $this->error($upload->getError());exit;
	    }else{
	    	// 上传成功
	        //$this->success('上传成功！');
            
            // 上传后路径 
            $file_path = "./Uploads/".$info['savepath'].$info['savename'];
            // 缩略图路径
            $save_path =$info['savename'];
            $image = new \Think\Image(); 
            $image->open($file_path);
            $image->thumb(183, 186,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/mini/".$save_path);

            $image1 = new \Think\Image(); 
            $image1->open($file_path);
            $image1->thumb(220, 123)->save("./Uploads/middle/".$save_path);

            return $save_path;

	    }
	}

  
}