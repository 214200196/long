<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    // 检测权限访问
    public function _initialize() {
        if ($_GET['smmkey'] != Sha1(md5(md5('北京创造财富科技有限公司888')))) {
            //echo Sha1(md5(md5('北京创造财富科技有限公司888'))); // 3eef0f2cb569f66b61248104de523c101a1e4361
            $this->error("非法操作！");
        }
    }


    // 登入接口
    public function Login() {

        $username = $_POST['username'];
        $password = $_POST['password'];
        if ( ! empty($username) && ! empty($password)) {
            $userInfo = D('userView')->where(array('username'=>$username,'password'=>md5($password)))->find();
            if ( $userInfo ) {

               echo json_encode(array_merge(array('validate'=>'登入成功！','validateStatus'=>1),$userInfo));
               //echo json_encode($userInfo);
               // 更新登入时间及登入次数待完成
               // 上次时间等于最后时间  最后时间等于当前时间
               $data = array(
                    'logintime' => ( $userInfo['logintime'] + 1 ),
                    'up_ip'     => $userInfo['last_ip'],
                    'up_time'   => $userInfo['last_time'],
                    'last_ip'   => get_client_ip(),
                    'last_time' => time() 
                );

               M('users')->where(array('user_id'=>$userInfo['user_id']))->save($data);

            } else {
               echo json_encode(array('validate'=>'账号或密码错误！','validateStatus'=>0)); 
            }
        }
    }

    // 注册接口
    public function register () {
        // 手机验证码检测
        if( ! $this->checkPhoneVerify()){
            echo json_encode(array('validate'=>'验证码错误或已失效！请重试','validateStatus'=>0)); die;
        } 

        $data = array(
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'reg_ip'   => get_client_ip(),
            'reg_time' => time(),
        );

        // 验证规则
        $rules = array(
             array('username','require','账号不能为空'), //默认情况下用正则进行验证
             array('username','require','账号已存在',0,'unique'),
             array('username','/^[\d]{11}$/','手机格式不正确',0,'regex'), //默认情况下用正则进行验证
             array('password','/^[\S]{6,15}$/','密码格式不正确字母或数字长度6~15位',0,'regex'), // 自定义函数验证密码格式
             array('passworded','password','两次密码不一致',0,'confirm'), // 验证确认密码是否和密码一致
             //array('email','require','邮箱不能为空'), 
             //array('email','email','邮箱格式错误'),

       );
        // 另一种验证规则 ! $db->validate($rules)->create($data) 
        if ( ! M('users')->validate($rules)->create() ) {
            echo json_encode(array('validate'=>'注册失败！','validateStatus'=>0));
            echo json_encode( M('users')->getError()); exit;
        }

        $usersDb = M('users')->add($data);

        if( $usersDb ) {
            M('users_info')->add(array('user_id'=>$usersDb,'niname'=>$_POST['niname'],'type_id'=>1,'status'=>1));
            // echo json_encode(array('validate'=>'注册成功！','validateStatus'=>1));
            // 注册完成后获取该用户信息
            $memberInfo = D('UserView')->where(array('user_id'=>$usersDb))->find();
            echo json_encode(array_merge(array('validate'=>'注册成功！','validateStatus'=>1),$memberInfo));
        }
        // 因该接口已采用手机验证来注册则需添加手机认证已默认通过
        $update = array( 'phone'=>$_POST['username'],
                         'phone_status'=>1 
                       );
        M('users_info')->where(array('user_id'=>$usersDb))->save($update);
        
        // 注册赠送vip
        $vipDate = array(
                        'status'    => 1,
                        'vip_type'  => 1,
                        'years'     => 3,
                        'remark'    => '新注册赠送vip',
                        'first_date'=> time(),
                        'end_date'  => strtotime('+3 month'),
                        'addtime'   => time(),
                        'addip'     => get_client_ip()
                        );
        // 更新vip数据
        M('users_vip')->where(array('user_id'=>$usersDb))->save($vipDate);


    }

    // 手机获取验证码接口
    public function getPhoneVerify() {

        $sendPhone = $_POST['phoneNumber'];
        if(is_numeric($sendPhone) && strlen($sendPhone) == 11) {
            sendPhone($sendPhone);
        } else {
            echo json_encode(array('msg'=>'手机格式错误,请输入正确的手机号码！','validateStatus'=>0));
        } 
        
    } 

    // 检测手机获取验证码
    public function checkPhoneVerify()  {
        // 该时间差小于5*60
        $timeDiff = time() - $_SESSION['send_time'];
        if ($timeDiff < 300 && $_SESSION['send_code'] == $_POST['verify']) {

            echo json_encode(array('validateStatus'=>1));

            $_SESSION['checkStatus'] = 1; // 作用不要再用form进行传递再判断

            return true;
        } else {
            echo json_encode(array('validateStatus'=>0));
            $_SESSION['checkStatus'] = 0; // 作用不要再用form进行传递再判断
            return false;
        }
    }

    // 获取用户消息
    public function getUserMsg() {
        if( isset($_GET['user_id']) ) {
            $where['receive_value'] = intval($_GET['user_id']);
            $where['type']    = 'all';
            $where['_logic']  = 'OR';
            $getUserMsg = M('message')->where($where)->select();
            //$getUserMsg = M('message')->where(array('user_id'=>intval($_GET['user_id']),'type'=>'all'),'OR')->select();
            //echo M('message')->getLastSql();
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$getUserMsg));
        } else {
            echo json_encode(array('msg'=>'请传入用户id来获取该用户消息','validateStatus'=>0));
        }
    }


    // 获取用户投资列表
    public function getUserInvest() {
        if ( isset($_GET['user_id'])) {
            $getUserInvest = D('BorrowInfoView')->where(array('borrow_tender.user_id'=>intval($_GET['user_id'])))->select();
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$getUserInvest));
        } else {
            echo json_encode(array('msg'=>'请传入用户id来获取该用户投资列表','validateStatus'=>0));
        }
    }

    // 账号金额接口
    public function accountInfo() { 
        if( ! empty($_GET['user_id'])) {
            $accountInfo = M('account')->where(array('user_id'=>intval($_GET['user_id'])))->find();
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$accountInfo));
        } else {
            echo json_encode(array('msg'=>'账号不存在','validateStatus'=>0));
        }
    }
    // 投资列表接口(正在进行中的标)
    public function borrowList() {
        $borrowList = M('borrow')->where(array('borrow_end_time'=>array('GT',time())))->select();
        if( ! empty($borrowList)) {
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$borrowList));
        } else {
            echo json_encode(array('msg'=>'当前投资列表为空！','validateStatus'=>0));
            //echo M('borrow')->getLastSql();
        }
    }

    // 投资详情页（正在进行中的标）
    public function borrowInfo() {
        if( ! empty($_GET['borrow_nid'])) { 
            $borrowInfo = M('borrow')->where(array('borrow_end_time'=>array('GT',time()),'borrow_nid'=>$_GET['borrow_nid']),'AND')->select();
            if( empty($borrowInfo) ) { 
                echo json_encode(array('msg'=>'该标已过期或不存在该标！','validateStatus'=>0));
                return;
            } 
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$borrowInfo));
                
        } else {
            echo json_encode(array('msg'=>'请传入借款id来获取借款详情页','validateStatus'=>0));
        }
    }

    // 实名认证接口
    public function nameApprove() {
        if( ! empty($_POST['user_id'])) {
            $nameApprove = M('approve_realname')->where(array('user_id'=>$_POST['user_id']))->field('status')->find(); 
            // 当$nameApprove 为空或 status为0 代表未进行上传或还在等待审核中 
             //dump($nameApprove);
            if( intval($nameApprove['status']) != 1) {
                    //p($_POST);

                if(empty($_POST['realName'])) {
                    echo json_encode(array('msg'=>'姓名不能为空！','validateStatus'=>0)); die;
                }

                if(empty($_POST['creditNo'])) {
                    echo json_encode(array('msg'=>'身份证号不能为空！','validateStatus'=>0)); die;
                }
                // 调用公共函数 isCreditNo 进行验证
                if( ! isCreditNo($_POST['creditNo'])) {
                    echo json_encode(array('msg'=>'请填写正确的身份证号码','validateStatus'=>0)); die;
                }


                // 进行文件上传
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     2097152 ;// 设置附件上传大小2m
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath  =     '../../p2p/Uploads/approve/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录


                // 上传文件 
                $info   =   $upload->upload();
                if(!$info) {// 上传错误提示错误信息
                    //$this->error($upload->getError());
                    echo json_encode($upload->getError());
                }else{// 上传成功
                    
                    // 将上传数据写入数据库
                    //dump($info);
                    if( ! empty($info['card_pic1']) && ! empty($info['card_pic2'])) {
                        // 身份证正面信息
                        $data1 = array(
                                'name'       => $info['card_pic1']['name'],
                                'code'       => 'approve',
                                'type'       => 'realname',
                                'article_id' => $_POST['user_id'],
                                'user_id'    => $_POST['user_id'],
                                'filetype'   => $info['card_pic1']['ext'],
                                'filename'   => $info['card_pic1']['savename'],
                                'filesize'   => $info['card_pic1']['size'],
                                'fileurl'    => '/uploads/approve/'.$info['card_pic1']['savepath'].$info['card_pic1']['savename'],
                                'addtime'    => time(),
                                'addip'      => get_client_ip(),
                                'updatetime' => time(),
                                'updateip'   => get_client_ip()
                            );
                        // 身份证反面信息
                        $data2 = array(
                                'name'       => $info['card_pic2']['name'],
                                'code'       => 'approve',
                                'type'       => 'realname',
                                'article_id' => $_POST['user_id'],
                                'user_id'    => $_POST['user_id'],
                                'filetype'   => $info['card_pic2']['ext'],
                                'filename'   => $info['card_pic2']['savename'],
                                'filesize'   => $info['card_pic2']['size'],
                                'fileurl'    => '/uploads/approve/'.$info['card_pic2']['savepath'].$info['card_pic2']['savename'],
                                'addtime'    => time(),
                                'addip'      => get_client_ip(),
                                'updatetime' => time(),
                                'updateip'   => get_client_ip()
                            );

                        $pic_id1 = M('users_upfiles')->add($data1); // 添加card_pic1信息
                        $pic_id2 = M('users_upfiles')->add($data2); // 添加card_pic2信息

                        // 更新实名认证表中数据
                        $realNameData = array(
                                'realname'  => $_POST['realName'],
                                'card_id'   => $_POST['creditNo'],
                                'card_pic1' => $pic_id1,
                                'card_pic2' => $pic_id2,
                                'sex'       => $_POST['sex'],
                                'addtime'   => time(),
                                'addip'     => get_client_ip()
                            );
                        M('approve_realname')->where(array('user_id'=>$_POST['user_id']))->save($realNameData);

                        
                    } else {

                        echo json_encode(array('msg'=>'身份证正面或反面都不能为空','validateStatus'=>0));exit;
                    
                    }

                        echo json_encode(array('validate'=>'身份证上传成功！','validateStatus'=>1));
                }
            } 

        } else {
                
            echo json_encode(array('msg'=>'未获取到用户id','validateStatus'=>0));
            
        }
        
    }

    // 实名认证状态接口（判断是否已实名认证）
    public function nameApproveStatus() {
        if( ! empty($_GET['user_id'])) {
            $nameApproveStatus = M('approve_realname')->where(array('user_id'=>$_GET['user_id']))->field('status')->find();
            if($nameApproveStatus['status']) {
                echo json_encode(array('Status'=>true));
            } else {
                echo json_encode(array('Status'=>false));
            }
        } else {
            echo json_encode(array('msg'=>'请传入用户id再进行获取该用户状态','validateStatus'=>0));
        }
    }

    // 登入密码修改接口
    public function mloginPassword() {

        if( empty($_POST['oldpwd']) || empty($_POST['newpwd']) || empty($_POST['newpwded']) || empty($_POST['user_id']) ) {
            echo json_encode(array('msg'=>'提交数据不能为空','validateStatus'=>0));
        } else {
            // 判断两次密码是否输入正确
            if($_POST['newpwded'] == $_POST['newpwd']) {
                // 判断密码长度是否符合要求
                if(strlen($_POST['newpwd']) >= 6 && strlen($_POST['newpwd']) <= 15 ) {
                    // 判断原密码是否输入正确
                    $userOldPwd = M('users')->where(array('user_id'=>$_POST['user_id']))->field('password')->find();
                    if($userOldPwd['password'] != md5($_POST['oldpwd'])) { echo json_encode(array('msg'=>'原始密码输入错误','validateStatus'=>0)); die; }
                        // 进行数据修改操作
                        if( M('users')->where(array('user_id'=>$_POST['user_id']))->save(array('password'=>md5($_POST['newpwd']))) ) {
                            echo json_encode(array('option'=>'密码修改成功','validateStatus'=>1));
                        }
                } else {
                   echo json_encode(array('msg'=>'密码必须6位以上','validateStatus'=>0)); 
                }

            } else {
                echo json_encode(array('msg'=>'两次密码输入不一致','validateStatus'=>0));
            }
        }
           
    }

    // 交易密码修改或设置接口
    public function mpayPassword() {
        if( empty($_POST['oldPayPwd']) || empty($_POST['newPayPwd']) || empty($_POST['newPayPwded']) || empty($_POST['user_id']) ) {
            echo json_encode(array('msg'=>'提交数据不能为空','validateStatus'=>0)); die;
        } 
        // 两次密码是否输入一致
        if ( $_POST['newPayPwd'] == $_POST['newPayPwded'] ) {
            
            if( strlen($_POST['newPayPwd']) >= 6 && strlen($_POST['newPayPwd']) <= 15 ) {
                // 获取支付密码（支付密码未设置则验证登入密码）
                $userPwd = M('users')->where(array('user_id'=>$_POST['user_id']))->field(array('password','paypassword'))->find();
                // 验证对象
                $pwdObject = empty($userPwd['paypassword']) ? $userPwd['password'] : $userPwd['paypassword'];
                if ( $pwdObject == md5($_POST['oldPayPwd']) ) {
                    // 进行数据修改操作
                    if ( M('users')->where(array('user_id'=>$_POST['user_id']))->save(array('paypassword'=>md5($_POST['newPayPwd']))) ) {
                        echo json_encode(array('option'=>'支付密码修改成功','validateStatus'=>1));
                    }

                } else {
                    echo json_encode(array('msg'=>'原支付密码输入错误！如果之前未设置支付密码请输入登入密码','validateStatus'=>0));
                }
            } else {
                echo json_encode(array('msg'=>'密码必须6位以上','validateStatus'=>0));
            }

        } else {
            echo json_encode(array('msg'=>'两次密码输入不一致','validateStatus'=>0));
        }
       
    }

    // 手机验证密码找回接口
    public function getPassword() {
        //p($_POST);
        if( empty($_POST['newPwd']) || empty($_POST['newPwded']) || empty($_POST['user_id']) ) {
            echo json_encode(array('msg'=>'提交数据不能为空','validateStatus'=>0)); die;
        } 
        // $_SESSION['checkStatus'] 该值在检测手机验证码接口checkPhoneVerify()中 声明
        if( $_SESSION['checkStatus'] ) {
            if ( isset($_POST['user_id']) ) {

                if ( strlen($_POST['newPwd']) < 6 && strlen($_POST['newPwd']) >= 15 ) { 
                    echo json_encode(array('msg'=>'密码必须6位以上','validateStatus'=>0)); die; 
                }

                if ( $_POST['newPwd'] == $_POST['newPwded'] ) {
                    // 修改登入密码操作
                    M('users')->where(array('user_id'=>$_POST['user_id']))->save(array('password'=>md5($_POST['newPwd'])));

                    echo json_encode(array('option'=>'登入密码修改成功','validateStatus'=>1));
                } else {
                    echo json_encode(array('msg'=>'两次密码输入不一致','validateStatus'=>0));
                }
            }

        } else {
            echo json_encode(array('msg'=>'输入验证码错误，请重试!','validateStatus'=>0));
        }
    }

    // 会员资料修改接口
    public function modifyInfo() {
       p($_POST); 
    }

    // 线下充值支付方式（银行卡信息）
    public function paymentInfo() {
        if( S('paymentInfo') ) {
            $paymentInfo = S('paymentInfo');
        } else {
            $paymentInfo = M('payment')->where(array('nid'=>'offline'))->find();
            S('paymentInfo', $paymentInfo, 3600*24*7);
        }
        echo json_encode($paymentInfo);
    }

    // 线下充值接口
    public function lineRecharge() {
        if ( empty($_POST['user_id']) ) { 
            echo json_encode(array('msg'=>'请传入用户id再进行充值操作','validateStatus'=>0));exit;
        }
        if ( empty($_POST['rechargeMoney']) || empty($_POST['rechargeCode']) ) { 
            echo json_encode(array('msg'=>'汇款金额和汇款订单号不能为空！','validateStatus'=>0));exit;
        }
        if( ! is_numeric($_POST['rechargeMoney'])) {
            echo json_encode(array('msg'=>'充值金额不合法，必须是数字！','validateStatus'=>0)); exit;
        }
        if( $_POST['rechargeMoney'] > 99999999 ||  $_POST['rechargeMoney'] < 50 ) {
            echo json_encode(array('msg'=>'输入金额不是50~99999999之间，请重试！','validateStatus'=>0));exit;
        }

        $data = array(
            'nid'       => time().intval($_POST['user_id']).rand(1000,9999),
            'user_id'   => intval($_POST['user_id']),
            'status'    => 0,
            'money'     => $_POST['rechargeMoney'],
            'fee'       => round( $_POST['rechargeMoney']/1000*3, 2),
            'balance'   => round( ($_POST['rechargeMoney'] + $_POST['rechargeMoney']/1000*3), 2 ),
            'payment'   => 26,
            'type'      => 2,
            'addtime'   => time(),
            'addip'     => get_client_ip()
            );

        if( M('account_recharge')->add($data) ) echo json_encode(array('msg'=>'充值成功！','validateStatus'=>1));
        //p($data);

    }

    // 轮番图接口(该位置只是相对地址，使用该地址需加上http://www.bjczcf.com/)
    public function topPhoto() {
        
        if( S('topPhoto') ) {
            $topPhoto = S('topPhoto');
        } else {
            $topPhoto = M('scrollpic')->where(array('status'=>1,'type_id'=>2),'AND')->field('pic')->select();
            S('topPhoto',$topPhoto,3600*24*7);
            //echo '缓存测试';
        }
        echo json_encode($topPhoto);
    }
}