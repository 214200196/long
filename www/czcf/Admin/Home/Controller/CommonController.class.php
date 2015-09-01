<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    	if(empty($_SESSION['uid'])) $this->error("请登入后再操作",U('Login/index'));
    	// 获取管理员信息
    	$getAdminInfo = $this->admininfo();
    	$this->getAdminInfo = $getAdminInfo;    
    }
    public function admininfo(){
    	$admininfo = D('AdminView')->where(array('id'=>$_SESSION['uid']))->find();
    	return $admininfo;
    }

    
    // 短信添加模块
    public static function AddSms($data = array()) {

        if (!IsExiest ( $data ['phone'] )) return "approve_sms_phone_empty";
        if (!preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{9}$/",$data ['phone'] )) {
            return "approve_sms_phone_error";
        }

        if (IsExiest ( $data ['username'] ) != false) {
            $result = M ( 'users')->where ( "username='{$data['username']}'")->field ( 'user_id')->find ();
            if ($result == null) return "approve_sms_username_not_exiest";
            $data ['user_id'] = $result ['user_id'];
        }

        if (!IsExiest ( $data ['user_id'] )) {
            return "approve_sms_userid_not_exiest";
        }
        $status = 0;
        $result = M ( 'approve_sms')->where ( "user_id={$data['user_id']}")->find ();

        if ($result != null) $status = 1;
        $result = M ( 'approve_sms')->where ( "phone='{$data['phone']}' and status=1")->find ();

        if ($result != null) return "approve_sms_phone_exiest";
        if ($status == 0) {
            $sql = "insert into `{approve_sms}` set `addtime` = '".time () ."',`addip` = '".get_client_ip () ."',user_id='{$data['user_id']}
                    ',status=0,`phone`='{$data['phone']}'";
            M ()->execute ( presql ( $sql ) );
        } else {
            $sql = "update `{approve_sms}` set phone='{$data['phone']}',status=0 where user_id='{$data['user_id']}'";
            M ()->execute ( presql ( $sql ) );
        }
        return $data ['user_id'];
    }  
    // 短信发送模块
    public static function SendSMS($data) {
        global $_G;
        if ($data ['phone'] == ""&&$data ['user_id'] >0) {
            $result = M ( 'users_info')->where ( "user_id={$data['user_id']}")->field ( 'phone,phone_status')->find ();
            if ($result ['phone_status'] == 1) {
                $data ['phone'] = $result ['phone'];
            }
        }
        $data ['contents'] = $data ['contents'];
        $result = self::SendSMSByPost ( $data );
        $adata ['addtime'] = time ();
        $adata ['addip'] = get_client_ip ();
        $adata ['user_id'] = $data ['user_id'];
        $adata ['status'] = $result;
        $adata ['phone'] = $data ['phone'];
        $adata ['type'] = $data ['type'];
        $adata ['code'] = $data ['code'];
        $adata ['contents'] = $data ['contents'];
        M ( 'approve_smslog')->add ( $adata );
        if ($result >0) return array (1,$data,$result);
        return array (2,$http .$data,$result );
    }
}