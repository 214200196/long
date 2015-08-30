<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends CommonController {
    // 存储管理员列表信息变量
    //private $adminListInfo;

    public function index() {
    	// 获取管理员列表
    	$getAdminList = D('AdminView')->select();
    	//$ipinfo = GetIpLookup('111.202.8.133');
    	//p($ipinfo);
    	//p($getAdminList);exit;
    	$getAdminListResult = array();
    	foreach ($getAdminList as $key => $v) {
    			$getAdminListResult[] = $v;
    			// 获取ip地址
    			$location = GetIpLookup($v['login_ip']);
    			if(empty($location)) $location['city'] = "未知地址";
    			// 添加位置 
    			$getAdminListResult[$key]['location'] = $location['city'];  
    	}
    	//p($getAdminListResult);die;
    	$this->getAdminList = $getAdminListResult;
        $this->display();
    }

    // 获取管理员类型列表
    public function getAdminName() {
        // 数据缓存操作
        if (S('getAdminName')) {
            $this->getAdminName = S('getAdminName');
        } else{
            $getAdminName = D('admin_type')->field(array('id','name'))->where(array('id'=>array('neq',1)))->select();
            $this->getAdminName = $getAdminName;
            // 生成缓存
            S('getAdminName',$getAdminName,3600*24);
            //echo "缓存测试";
        }
    }

    public function addAdmin() {

        $this->getAdminName();
    	$this->display('addAdmin');
    }
    // 检测传递过来添加管理员数据
    public function checkAdmin() {
        if ( ! IS_POST) $this->error("非法操作");
        //p($_POST);die;
        $db = D('admin');
        
        if ( ! $db->create()) {
            exit($db->getError());
        }

        if ( $db->add() ) {
            $this->success("添加管理员成功!",U('index',array('pli'=>6,'cli'=>0)));
        } else {
            $this->error("添加失败请重试！");
        }
    }

    public function modifyAdmin() {
        $this->getAdminName();
        $this->display();
    }
    public function updateModify() {
        if ( ! IS_POST) $this->error('非法操作');
        p($_POST);
        if (isset($_POST['pwd'])) {
            $data = array(
                'password'  => md5($_POST['pwd']),
                'adminname' => $_POST['adminname'],
                'qq'        => $_POST['qq'],
                'phone'     => $_POST['phone']
            );
        } else {
            $data = array(
                'adminname' => $_POST['adminname'],
                'qq'        => $_POST['qq'],
                'phone'     => $_POST['phone']
            );
        }

        if (M('admin')->where(array('id'=>$_POST['id']))->save($data)) {
            $this->success("修改成功！");
        } else {
            $this->error("修改失败，请重试！");
        }
    }

}