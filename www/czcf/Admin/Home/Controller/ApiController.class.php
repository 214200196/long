<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    // 检测权限访问
    public function _initialize() {
        header("Content-type: text/html; charset=utf-8");
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
        /*
        if( ! $this->checkPhoneVerify()){
            echo json_encode(array('validate'=>'验证码错误或已失效！请重试','validateStatus'=>0)); die;
        } 
        */

        $data = array(
            'username' => $_POST['phoneNumber'],
            'password' => md5($_POST['password']),
            'reg_ip'   => get_client_ip(),
            'reg_time' => time(),
        );

        $userIsset= M('users')->where(array('username'=>$_POST['phoneNumber']))->field("user_id")->find();
        
        if( !empty($userIsset)) {
            //echo json_encode(array('msg'=>'用户名已存在！','validateStatus'=>0));exit;
        }

        // 验证规则
        $rules = array(
             array('phoneNumber','require','手机号不能为空'), //默认情况下用正则进行验证
             array('phoneNumber','/^[\d]{11}$/','手机格式不正确',0,'regex'), //默认情况下用正则进行验证
             array('password','/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,15}$/','密码格式不正确字母和数字组合长度6~15位',0,'regex'), // 自定义函数验证密码格式
             array('passworded','password','两次密码不一致',0,'confirm') // 验证确认密码是否和密码一致
             //array('email','require','邮箱不能为空'), 
             //array('email','email','邮箱格式错误'),

       );
        // 另一种验证规则 ! $db->validate($rules)->create($data) 
        if ( ! M('users')->validate($rules)->create() ) {
            //echo json_encode(array('validate'=>'注册失败！请重试','validateStatus'=>0));
            $getError = M('users')->getError();
            echo json_encode(array('msg'=>$getError,'validateStatus'=>0)); exit;
        }

        // 昵称验证
        if ( empty($_POST['niname']) ) {
            echo json_encode(array('msg'=>'昵称不能为空','validateStatus'=>0));exit;
        }
        // 昵称规则/i 指的是不忽略大小写 加上s修饰符，.就能匹配任何字符了
        if (! preg_match("/^[\x80-\xff|_a-zA-Z0-9]{2,12}$/",$_POST['niname'])) {
            echo json_encode(array('msg'=>'中文或字母或数字2~12位','validateStatus'=>0));exit;
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
        $update = array( 'phone'=>$_POST['phoneNumber'],
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

    // 手机获取验证码接口(post)
    public function getPhoneVerify() {

        $sendPhone = $_POST['phoneNumber'];
        if(is_numeric($sendPhone) && strlen($sendPhone) == 11) {
            sendPhone($sendPhone);
            echo json_encode(array('phoneNumber'=>$sendPhone,'validate'=>1));
        } else {
            echo json_encode(array('msg'=>'手机格式错误,请输入正确的手机号码！','validateStatus'=>0));
        } 
        
    } 

    // 手机获取验证码接口(get)
    public function gPhoneVerify() {

        $sendPhone = $_GET['phoneNumber'];
        if(is_numeric($sendPhone) && strlen($sendPhone) == 11) {
            sendPhone($sendPhone);
            echo json_encode(array('phoneNumber'=>$sendPhone,'validate'=>1));
        } else {
            echo json_encode(array('msg'=>'手机格式错误,请输入正确的手机号码！','validateStatus'=>0));
        } 
        
    } 

    // 检测手机获取验证码
    public function checkPhoneVerify()  {
        // 该时间差小于5*60
        $timeDiff = time() - $_SESSION['send_time'];
        if ($timeDiff < 300 && $_SESSION['send_code'] == $_POST['verify']) {

            echo json_encode(array('msg'=>'验证码验证正确','validateStatus'=>1));

            $_SESSION['checkStatus'] = 1; // 作用不要再用form进行传递再判断

            return true;
        } else {
            echo json_encode(array('msg'=>'验证码验证不一致，请输入正确的验证码！','validateStatus'=>0));
            $_SESSION['checkStatus'] = 0; // 作用不要再用form进行传递再判断
            return false;
        }
    }

    // 获取用户消息
    public function getUserMsg() {
        if( isset($_GET['user_id']) ) {
            $getUserMsg = M('message_receive')->JOIN('LEFT JOIN yyd_users_info ON yyd_users_info.user_id = yyd_message_receive.send_userid')
                          ->where(array('receive_id'=>$_GET['user_id']))
                          ->field(array('yyd_message_receive.id','send_userid','yyd_users_info.niname','receive_id',
                                        'yyd_message_receive.status','name','contents','yyd_message_receive.addtime'))
                          ->select();
            //echo M('message_receive')->getLastSql();
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$getUserMsg));
        } else {
            echo json_encode(array('msg'=>'请传入用户id来获取该用户消息','validateStatus'=>0));exit;
        }
    }

    // 当前用户消息未读条数接口
    public function getUserMsgCount() {
        if (empty($_GET['user_id'])) {
            echo json_encode(array('msg'=>'请传入用户id来获取该用户消息','validateStatus'=>0));exit;
        }
        $getUserMsgCount = M('message_receive')->where(array('receive_id'=>$_GET['user_id'],'status'=>0),'AND')->count();
        //echo M('message_receive')->getLastSql();
        echo json_encode(array('msg'=>'数据获取成功！','validateStatus'=>1,'msgCount'=>$getUserMsgCount));
    }

    // 删除消息接口
    public function delUserMsg() {
        if ( empty($_GET['del_msgid']) ) {
            echo json_encode(array('msg'=>'请传入要删除信息id','validateStatus'=>0));exit;
        }
        // 判断是否存在该条消息
        $userMsg=M('message_receive')->where(array('id'=>$_GET['del_msgid']))->count();
        if($userMsg) {
            // 删除消息操作
            if( M('message_receive')->where(array('id'=>$_GET['del_msgid']))->delete() ) {
                echo json_encode(array('msg'=>'该条消息删除成功！','validateStatus'=>1));
            }
        } else {
            echo json_encode(array('msg'=>'该消息不存在,或已经删除！','validateStatus'=>0));exit;
        }
    }


    // 获取用户投资列表
    public function getUserInvest() {
        if ( isset($_GET['user_id'])) {
            $getUserInvest = D('BorrowInfoView')->where(array('borrow_tender.user_id'=>intval($_GET['user_id'])))
                                                ->order("borrow_tender.addtime desc")->select();
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$getUserInvest));
        } else {
            echo json_encode(array('msg'=>'请传入用户id来获取该用户消息户id来获取该用户投资列表','validateStatus'=>0));
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


    public function borrowList() {

       $time = time();

       // 分页若传递则按规则分页
       $pagesize = isset($_GET['pagesize']) ? $_GET['pagesize'] : 10;

       // 投资列表筛选条件容器
       $filterWhere = array();

       // 标的类型筛选条件 
       if ( isset($_GET['borrow_type']) )   $filterWhere['borrow_type']  = $_GET['borrow_type'];
       
       // 借款期限筛选条件
       if ( isset($_GET['borrow_period']) )  {
            if( $_GET['borrow_period'] =='lt3' )      $filterWhere['borrow_period'] = array('lt',3);
            if( $_GET['borrow_period'] =='egt3lt6')  $filterWhere['borrow_period'] = array(array('egt',3),array('lt',6),'AND');
            if( $_GET['borrow_period'] =='egt6lt12') $filterWhere['borrow_period'] = array(array('egt',6),array('lt',12),'AND');
            if( $_GET['borrow_period'] =='egt12')     $filterWhere['borrow_period'] = array('egt',12);
       }

       // 借款金额筛选条件
       if ( isset($_GET['account']) ) {
            if( $_GET['account'] =='lt50000' )      $filterWhere['account'] = array('lt',50000);
            if( $_GET['account'] =='egt50000lt100000')  $filterWhere['account'] = array('between',array(50000,100000));
            if( $_GET['account'] =='egt100000lt500000') $filterWhere['account'] = array('between',array(100000,500000));
            if( $_GET['account'] =='egt500000')     $filterWhere['account'] = array('egt',500000);
       }

       // 还款方式筛选条件
       if ( isset($_GET['borrow_style'])) $filterWhere['borrow_style'] = $_GET['borrow_style'];

       //p($filterWhere);

       $count    = M('borrow')->JOIN('yyd_credit ON yyd_credit.user_id = yyd_borrow.user_id')
                              ->where("(`status`=1 AND `borrow_end_time`>{$time}) OR `status`=3")
                              ->where($filterWhere)
                              ->count();
                                 
        $thinkPage  = new \Think\Page($count,$pagesize);                     
        // 获取状态为3成功或初审成功的标1
        $borrowList = M('borrow')->JOIN('yyd_credit ON yyd_credit.user_id = yyd_borrow.user_id')
                                 ->where("(`status`=1 AND `borrow_end_time`>{$time}) OR `status`=3")
                                 ->where($filterWhere)
                                 ->field(array('name','status','account','borrow_nid','borrow_account_yes','borrow_account_wait','borrow_type',
                                   'borrow_style','borrow_period','borrow_apr','borrow_end_time','addtime','award_status','recommend','yyd_credit.credit'))
                                 ->order(" `addtime` desc,`order` desc")
                                 ->limit($thinkPage->firstRow.','.$thinkPage->listRows)
                                 ->select();
        //echo M('borrow')->getLastSql();
        //$borrowList = M('borrow')->where(array('borrow_end_time'=>array('GT',time())))->select();

        // 将已流标的标顺序降到正在进行的标的后面
        /*
        $arr=array();
        foreach ($borrowList as $k => $v) {
            if( $v['borrow_end_time'] < time() && $v['status'] == 1) {
                if($arr[$k]['borrow_end_time'] < $arr[$k-1]['borrow_end_time']){
                    $arr[$k+1] = $v;
                }
            } else {
                if( $arr[$k]['borrow_end_time'] > $arr[$k-1]['borrow_end_time'] ){
                    $arr[$k-1] = $v;
                } else {
                    $arr[] = $v;
                } 
            }

        }
        //p($arr);
        //ksort($arr);
        //p(array_values($arr));
        */
        if( ! empty($borrowList)) {
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$borrowList));     // 投资列表接口(正在进行中的标)
        } else {
            echo json_encode(array('msg'=>'当前投资列表为空！','validateStatus'=>0));
            //echo M('borrow')->getLastSql();
        }
    }

    // 投资详情页（正在进行中的标）
    public function borrowInfo() {

        if( ! empty($_GET['borrow_nid'])) { 
            $borrowInfo = M('borrow')->where(array('borrow_nid'=>$_GET['borrow_nid']))
                                     ->field(array('name','borrow_nid','borrow_apr','borrow_period','borrow_account_wait','borrow_end_time','borrow_object',
                                       'borrow_style','nikename','user_id'))
                                     ->select();
            //$borrowInfo = M('borrow')->where(array('borrow_end_time'=>array('GT',time()),'borrow_nid'=>$_GET['borrow_nid']),'AND')->select();
            if( empty($borrowInfo) ) { 
                echo json_encode(array('msg'=>'该标已过期或不存在该标！','validateStatus'=>0));exit;
            } 
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$borrowInfo));
                
        } else {
            echo json_encode(array('msg'=>'请传入借款id来获取借款详情页','validateStatus'=>0));
        }

    }

    // 推荐投资接口
    public function recommendBorrow() {
        $time = time();
        $recommendBorrow = M('borrow')->JOIN('yyd_credit ON yyd_credit.user_id = yyd_borrow.user_id')
                                      ->where("(`status`=1 AND `borrow_end_time`>{$time} AND `recommend`=1)")
                                      ->field(array('name','status','account','borrow_nid','borrow_account_yes','borrow_account_wait',
                                        'borrow_style','borrow_period','borrow_apr','borrow_end_time','addtime','award_status','recommend','yyd_credit.credit'))
                                      ->order("borrow_apr desc")
                                      ->limit(1)
                                      ->find();
        //echo M('borrow')->getLastSql();
        if( ! empty($recommendBorrow) ) {
            echo json_encode(array_merge(array('msg'=>'数据获取成功','validateStatus'=>1),$recommendBorrow));
        } else {
            // 如果正在进行的标推荐为空 则将最高利率的推荐
            $recommendBorrowElse = M('borrow')->JOIN('yyd_credit ON yyd_credit.user_id = yyd_borrow.user_id')
                                              ->where("(`status`=1 AND `borrow_end_time`>{$time})")
                                              ->field(array('name','status','account','borrow_nid','borrow_account_yes','borrow_account_wait',
                                                'borrow_style','borrow_period','borrow_apr','borrow_end_time','addtime','award_status','recommend','yyd_credit.credit'))
                                              ->order("borrow_apr desc")
                                              ->limit(1)
                                              ->find();
            echo json_encode(array_merge(array('msg'=>'获取数据成功！(当前没有推荐标，默认为最高利率标)','validateStatus'=>1),$recommendBorrowElse));

        }
        //P($recommendBorrow);
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
                return true;
            } else {
                echo json_encode(array('Status'=>false));
                return false;
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

    // 用户提现接口
    public function userWithdraw() {

        if ( empty($_POST['user_id'])) {
            echo json_encode(array('msg'=>'请传入用户id后，再进行操作！','validateStatus'=>0));exit;
        }

        if ($_POST['withdrawMoney'] <= 0 || !is_numeric($_POST['withdrawMoney'])) {
            echo json_encode(array('msg'=>'提现金额必须为正数和必须是数字','validateStatus'=>0));exit;
        }
        // 获取当前用户账户信息
        $userAccount = M('account')->where(array('user_id'=>$_POST['user_id']))->find();

        if ($_POST['withdrawMoney'] > $userAccount['balance']) {
            echo json_encode(array('msg'=>'提现金额大于可用余额！','validateStatus'=>0));exit;
        }

       // 验证支付密码是否输入正确
       if ( ! $this->validatePayPassword()) die;

       /*  ===操作数据===
        *  1. account_cash     （提现表添加记录）
        *  2. account           (账户表增加冻结金额及可用余额减少)
        *  3. account_balance   (账户平衡表添加申请提现记录)
        *  4. account_log       (账户记录表添加申请提现记录)
        *  5. account_users     (账户用户操作记录表添加记录)
        */
       $nid = 'cash_'.$_POST['user_id'].time().rand(100,999);
       $account_cash_data = array(
            'user_id'   => $_POST['user_id'],
            'nid'       => $nid,
            'status'    => 0,
            'account'   => $_POST['withdrawMoney'],
            'bank'      => $_POST['devBank'],
            'bank_id'   => $_POST['bankNumber'],
            'province'  => 0,
            'city'      => 0,
            'total'     => $_POST['withdrawMoney'],
            'credited'  => ($_POST['withdrawMoney'] - $_POST['withdrawMoney']*0.003),  //0.3%
            'fee'       => $_POST['withdrawMoney']*0.003,
            'addtime'   => time(),
            'addip'     => get_client_ip()
        );
       // 获取当前最后一行account_balance数据
       $totalLastLine = M('account_balance')->field(array('total','balance'))->order('id desc')->limit(1)->find();

       $account_balance =array(
            'nid'       => $nid,
            'user_id'   => $_POST['user_id'],
            'type'      => 'cash',
            'money'     => $_POST['withdrawMoney'],
            'total'     => $totalLastLine['total'],
            'balance'   => $totalLastLine['balance'],
            'income'    => 0,
            'expend'    => 0,
            'remark'    => 'app申请提现，冻结提现金额'.$_POST['withdrawMoney'].'元',
            'addtime'   => time(),
            'addip'     => get_client_ip()
        );

       if ( ! M('account_cash')->add($account_cash_data) ) {
           echo json_encode(array('msg'=>'提现申请操作数据生成错误，请重试！','validateStatus'=>0));exit;
       }

       // account表增加冻金额 减少balance 和balance_cash的值
       // $account_data['balance'] -= $_POST['withdrawMoney'];
       // $account_data['balance_cash'] -= $_POST['withdrawMoney'];
       // $account_data['frost']        += $_POST['withdrawMoney'];
       // p($account_data);
       $sql = "UPDATE yyd_account SET `balance`      = `balance` - {$_POST['withdrawMoney']}, 
                                      `balance_cash` = `balance_cash` - {$_POST['withdrawMoney']},
                                      `frost`        = `frost` + {$_POST['withdrawMoney']} 
                                  WHERE `user_id` = {$_POST['user_id']}";
       // M('account')->where(array('user_id'=>$_POST['user_id']))->setDec('balance',$_POST['withdrawMoney'])
       // ->setDec('balance_cash',$_POST['withdrawMoney'])->setInc('frost',$_POST['withdrawMoney']);
       M()->execute($sql);

       if ( ! M('account_balance')->add($account_balance) ) {
            echo json_encode(array('msg'=>'异常错误,请重试','validateStatus'=>0));exit;
       }

       $userAccountInfo = M('account')->where(array('user_id'=>$_POST['user_id']))->find();

       $account_log = array(
            'nid'               => $nid,
            'user_id'           => $_POST['user_id'],
            'type'              => 'cash',
            'total'             => $userAccountInfo['total'],            // 通过用户账户信息获取
            'total_old'         => $userAccountInfo['total'],
            'money'             => $_POST['withdrawMoney'],
            'income'            => $userAccountInfo['income'],
            'income_old'        => $userAccountInfo['income'],
            'income_new'        => 0,
            'expend'            => $userAccountInfo['expend'],
            'expend_old'        => $userAccountInfo['expend'],
            'expend_new'        => 0,
            'balance'           => $userAccountInfo['balance'],
            'balance_old'       => $userAccountInfo['balance'] + $_POST['withdrawMoney'],
            'balance_new'       => - $_POST['withdrawMoney'],
            'balance_cash'      => $userAccountInfo['balance_cash'],
            'balance_cash_old'  => $userAccountInfo['balance_cash'] + $_POST['withdrawMoney'],
            'balance_cash_new'  => - $_POST['withdrawMoney'],
            'balance_frost'     => $userAccountInfo['balance_frost'],
            'balance_frost_old' => $userAccountInfo['balance_frost'],
            'balance_frost_new' => 0,
            'frost'             => $userAccountInfo['frost'],
            'frost_old'         => $userAccountInfo['frost'] - $_POST['withdrawMoney'],
            'frost_new'         => $_POST['withdrawMoney'],
            'await'             => 0,
            'await_old'         => 0,
            'await_new'         => 0,
            'to_userid'         => 0,
            'remark'            => 'app申请提现，冻结提现金额'.$_POST['withdrawMoney'].'元',
            'addtime'           => time(),
            'addip'             => get_client_ip()
        );

        M('account_log')->add($account_log);

        $account_users_info = M('account_users')->field(array('total','balance'))->order('id desc')->limit(1)->find();
        $account_users = array(
            'nid'       => $nid,
            'user_id'   => $_POST['user_id'],
            'type'      => 'cash',
            'money'     => $_POST['withdrawMoney'],
            'total'     => $account_users_info['total'],
            'balance'   => $account_users_info['balance'],
            'income'    => 0,
            'expend'    => 0,
            'frost'     => $_POST['withdrawMoney'],
            'await'     => 0,
            'remark'    => 'app申请提现，冻结提现金额'.$_POST['withdrawMoney'].'元',
            'addtime'   => time(),
            'addip'     => get_client_ip()
        );
        M('account_users')->add($account_users);
        echo json_encode(array('msg'=>'申请提现成功！','validateStatus'=>1));

    }


    // 银行卡绑定接口
    public function bindBank() {
        // 验证输入数据是否合法
        if ( empty($_POST['bank']) || !is_numeric($_POST['bank']) || !is_numeric($_POST['pcity']) || empty($_POST['devBank']) 
            || empty($_POST['bankNumber']) || !is_numeric($_POST['bankNumber']) || empty($_POST['user_id'])) {
            echo json_encode(array('msg'=>'非法数据,请重新输入准确信息!','validateStatus'=>0));exit;
        }
        // 检测是否已经实名认证
        $nameApproveStatus = M('approve_realname')->where(array('user_id'=>intval($_POST['user_id'])))->field('status')->find();
        // 检测是否已经绑定银行卡
        $bindStatus = M('account_users_bank')->where(array('user_id'=>$_POST['user_id']))->field('user_id')->find();
        if( !empty($bindStatus)) {
            echo json_encode(array('msg'=>'非法错误，该用户已绑定银行卡！','validateStatus'=>0));exit;
        }

        if( $nameApproveStatus['status'] ){
            // 通过穿过来的城市id 获取province 和 city
            $getCity = isset($_POST['ccity']) ? $_POST['ccity'] : $_POST['pcity'];
            $city = M('areas')->where(array('id'=>$getCity))->field(array('id','province','city'))->find();
            // 进行银行卡绑定操作
            $data = array(
                    'user_id'   => intval($_POST['user_id']),
                    'account'   => $_POST['bankNumber'],
                    'bank'      => $_POST['bank'],
                    'branch'    => $_POST['devBank'],
                    'province'  => $city['province'],
                    'city'      => $city['city'],
                    'area'      => $city['id'],
                    'addtime'   => time(),
                    'addip'     => get_client_ip()
                    );
            if( M('account_users_bank')->add($data) ) {
                echo json_encode(array('msg'=>'绑定银行卡成功！','validateStatus'=>1));
            }


        } else {

            echo json_encode(array('msg'=>'请实名认证后再进行银行卡绑定操作！','validateStatus'=>0));
        }

    }

    // 获取银行卡信息接口
    public function getBankInfo() {
        if( !empty($_GET['user_id'])) {
            $getBankInfo = M('account_users_bank')->where(array('user_id'=>$_GET['user_id']))->find();
            echo json_encode(array_merge(array('msg'=>'数据获取成功！','validateStatus'=>1),$getBankInfo));
        }   else {
            echo json_encode(array('msg'=>'请传入用户id后，再获取该用户银行卡信息！','validateStatus'=>0));
        }
    }

    // 验证支付密码接口
    public function validatePayPassword() {
        if (empty($_POST['user_id']) || empty($_POST['payPassword'])) {
            echo json_encode(array('msg'=>'请传入用户id和支付密码，再进行操作！','validateStatus'=>0));
            return false;
        }
        // 获取用户支付密码
        $validatePayPassword = M('users')->where(array('user_id'=>intval($_POST['user_id'])))->field('paypassword')->find();
        if(empty($validatePayPassword)) {
            echo json_encode(array('msg'=>'该用户还未设置支付密码！','validateStatus'=>0));
            return false;
        }
        if(md5($_POST['payPassword'])==$validatePayPassword['paypassword']) {
            //echo json_encode(array('msg'=>'验证通过','validateStatus'=>1));
            return true;
        } else {
            echo json_encode(array('msg'=>'支付密码输入不正确','validateStatus'=>0));
            return false;
        }
    }

    // 修改银行卡信息接口
    public function updateBindBank() {
       if ( empty($_POST['user_id'])){
        echo json_encode(array('msg'=>'请传入用户id后，再进行操作！','validateStatus'=>0));
       }
       // 验证支付密码是否输入正确
       if ( ! $this->validatePayPassword()) die;
       
       // 验证输入数据是否合法
       if ( empty($_POST['bank']) || !is_numeric($_POST['bank']) || !is_numeric($_POST['pcity']) || empty($_POST['devBank']) 
            || empty($_POST['bankNumber']) || !is_numeric($_POST['bankNumber']) || empty($_POST['user_id'])) {
            echo json_encode(array('msg'=>'非法数据,请重新输入准确信息!','validateStatus'=>0));exit;
       }

        // 通过穿过来的城市id 获取province 和 city
        $getCity = isset($_POST['ccity']) ? $_POST['ccity'] : $_POST['pcity'];
        $city = M('areas')->where(array('id'=>$getCity))->field(array('id','province','city'))->find();
        // 进行银行卡绑定操作
        $data = array(
                'account'   => $_POST['bankNumber'],
                'bank'      => $_POST['bank'],
                'branch'    => $_POST['devBank'],
                'province'  => $city['province'],
                'city'      => $city['city'],
                'area'      => $city['id'],
                'update_time' => time(),
                'update_ip'   => get_client_ip()
                );
        if( M('account_users_bank')->where(array('user_id'=>$_POST['user_id']))->save($data) ) {
            echo json_encode(array('msg'=>'修改银行卡成功！','validateStatus'=>1));
        } else {
            echo json_encode(array('msg'=>'修改银行卡失败，请重试！','validateStatus'=>0));
        }

    }

    // 删除银行卡接口
    public function delBindBank() {
        if( empty($_GET['user_id'])) {
            echo json_encode(array('msg'=>'请传入用户id后，再进行操作！','validateStatus'=>0));
        }
        if( M('account_users_bank')->where(array('user_id'=>$_GET['user_id']))->delete() ) {
            echo json_encode(array('msg'=>'银行卡解除成功！','validateStatus'=>1));
        }   else {
            echo json_encode(array('msg'=>'删除失败，请重试！','validateStatus'=>0));
        }
    }

    // 开户银行数据列表接口
    public function bankList() {
        if( S('bankList')) {
            $bankList = S('bankList');
        } else {
            $bankList = M('account_bank')->select();
            S('bankList',$bankList);
        }
        echo json_encode($bankList);
    }

    // 地区数据列表接口
    public function areasCity() {
        if ( empty($_GET['city'])) {
            // 顶级地区
            if( S('topCity')) {
                $topCity = S('topCity');
            } else {
                $topCity = M('areas')->where(array('pid'=>0,'province'=>0,'city'=>0),'AND')->field(array('id','name'))->select();
                S('topCity',$topCity);
            }
            //echo M('areas')->getLastSql();
            //p($topCity);
            echo json_encode($topCity);
        } else {
            
            // 顶级分类下的子分类
            $childCity = M('areas')->where(array('province'=>intval($_GET['city'])))->field(array('id','name'))->select();
            //p($childCity);
            echo json_encode($childCity);
        }


    }

    // 用户投资支付接口
    public function userTender() {
        p($_POST);
        if ( empty($_POST['user_id']) ) {
            echo json_encode(array('msg'=>'未获取到用户id','validateStatus'=>0));exit;
        }
        // 判断标号是否合法
        $borrowInfo = M('borrow')->where(array('borrow_end_time'=>array('GT',time()),'borrow_nid'=>$_POST['borrow_nid']),'AND')->count();
        if( empty($borrowInfo) ) {
            echo json_encode(array('msg'=>'该标号不合法！','validateStatus'=>0));die;
        }
        // 检测投资金额
        if ( ! is_numeric($_POST['tenderMoney']) || $_POST['tenderMoney'] <=0 ) {
           echo json_encode(array('msg'=>'投资金额格式错误，请重试！','validateStatus'=>0));die;
        }
        // 要求投资必须大于等于100 且金额为50的倍数
        if ( $_POST['tenderMoney'] < 100 || $_POST['tenderMoney']%50 != 0 ) {
            echo json_encode(array('msg'=>'投资金额必须100以上，且是50的倍数！','validateStatus'=>0));die;
        }
        // 检测投资金额是否大于漫标金额
        if ( $_POST['tenderMoney'] > $_POST['waitFullMoney'] ) {
            echo json_encode(array('msg'=>'投资金额大于满标金额！','validateStatus'=>0));die;
        }
        if ( $_POST['tenderMoney'] > $_POST['canUseMoney'] ) {
            echo json_encode(array('msg'=>'可用余额不足,请充值后操作！','validateStatus'=>0));die;
        }
        // 是否投资自己发布的借款标
        $ifSelfBorrow = M('borrow')->where(array('borrow_nid'=>$_POST['borrow_nid'],'user_id'=>$_POST['user_id']),'AND')->count();
        //echo M('borrow')->getLastSql(); // 该sql无需优化已达到ref引用常量级别
        if ( $ifSelfBorrow ) {
            echo json_encode(array('msg'=>'不能对自己的标进行投资！','validateStatus'=>0));die;
        }
        // 检测支付密码是否正确
        if ( ! $this->validatePayPassword()) die;

        /*  === 购买投资流程 ===
        *   1. account           (对账户冻结资金及资金平衡进行增减投资金额)
        *   2. account_balance   (新增投资资金变化同而导致资金平衡表改变)
        *   3. account_log       (新增投资数据及数据变化)
        *   4. account_users
        *   
        *   5. borrow            (已投资金额增加，等待投资金额减少，投资进度更改)
        *   6. borrow_count      (更改投资金额，投资冻结金额)
        *   7. borrow_count_log  (新增投资日志)
        *   8. borrow_tender     (新增该标投资金额)
        */

        $time = time();

        // 1. account 更新操作
        $sql = "UPDATE yyd_account set `balance`        = `balance` - {$_POST['tenderMoney']},
                                        `balance_frost` = `balance_frost` - {$_POST['tenderMoney']},
                                        `frost`         = `frost` + {$_POST['tenderMoney']} 
                                    where `user_id` = {$_POST['user_id']} ";
        //echo $sql;
        //M()->execute($sql);

        // 2. account_balance 新增操作
        $lastData = M('account_balance')->order('id DESC')->field(array('total','balance'))->limit(1)->find();
        //echo M('account_balance')->getLastSql(); // 该条语句type：index（将索引全遍历） 待优化
        $account_balance = array(
                'nid'       => 'tender_frost_'.$_POST['user_id'].'_'.$time,
                'user_id'   => $_POST['user_id'],
                'type'      => 'tender',
                'money'     => $_POST['tenderMoney'],
                'total'     => $lastData['total'],
                'balance'   => $lastData['balance'],
                'income'    => 0,
                'expend'    => 0,
                'remark'    => 'App 对标'.$_POST['borrow_nid'].'号进行投资，冻结'.$_POST['tenderMoney'].'元',
                'addtime'   => $time,
                'addip'     => get_client_ip()
            );
        //M('account_balance')->add($account_balance);

        // 3. account_log 新增操作
        $userAccountInfo = M('account')->where(array('user_id'=>$_POST['user_id']))->find();
        //p($userAccountInfo);
        $toUserid = M('borrow')->where(array('borrow_nid'=>$_POST['borrow_nid']))->field("user_id")->find();
        //p($toUserid);
        $account_log = array(
                'nid'               => 'tender_frost_'.$_POST['user_id'].'_'.$time,
                'user_id'           => $_POST['user_id'],
                'type'              => 'tender',
                'total'             => $userAccountInfo['total'],
                'total_old'         => $userAccountInfo['total'],
                'money'             => $_POST['tenderMoney'],
                'income'            => $userAccountInfo['income'],
                'income_old'        => $userAccountInfo['income'],
                'income_new'        => 0,
                'expend'            => $userAccountInfo['expend'],
                'expend_old'        => $userAccountInfo['expend'],
                'expend_new'        => 0,
                'balance'           => $userAccountInfo['balance'],
                'balance_old'       => $userAccountInfo['balance'] + $_POST['tenderMoney'],
                'balance_new'       => - $_POST['tenderMoney'],
                'balance_cash'      => $userAccountInfo['balance_cash'],
                'balance_cash_old'  => $userAccountInfo['balance_cash'],
                'balance_cash_new'  => 0,
                'balance_frost'     => $userAccountInfo['balance_frost'],
                'balance_frost_old' => $userAccountInfo['balance_frost'] + $_POST['tenderMoney'],
                'balance_frost_new' => - $_POST['tenderMoney'],
                'frost'             => $userAccountInfo['frost'],
                'frost_old'         => $userAccountInfo['frost'] - $_POST['tenderMoney'],
                'frost_new'         => $_POST['tenderMoney'],
                'await'             => 0,
                'await_old'         => 0,
                'await_new'         => 0,
                'to_userid'         => $toUserid['user_id'],
                'remark'            => 'App 对标'.$_POST['borrow_nid'].'号进行投资，冻结'.$_POST['tenderMoney'].'元',
                'addtime'           => $time,
                'addip'             => get_client_ip()
            );
        //M('account_log')->add($account_log);

        // 4.account_users 新增操作
        $lastAccountUsers = M('account_users')->order('id DESC')->field(array('total','balance'))->limit(1)->find();

        $account_users = array(
                'nid'       => 'tender_frost_'.$_POST['user_id'].'_'.$time,
                'user_id'   => $_POST['user_id'],
                'type'      => 'tender',
                'money'     => $_POST['tenderMoney'],
                'total'     => $lastAccountUsers['total'],
                'balance'   => $lastAccountUsers['balance'],
                'income'    => 0,
                'expend'    => 0,
                'frost'     => $_POST['tenderMoney'],
                'await'     => 0,
                'remark'    => 'App 对标'.$_POST['borrow_nid'].'号进行投资，冻结'.$_POST['tenderMoney'].'元',
                'addtime'   => $time,
                'addip'     => get_client_ip()
            );
        //M('account_users')->add($account_users);


    }


    // 轮番图接口(该位置只是相对地址，使用该地址需加上http://www.bjczcf.com/)
    public function topPhoto() {
        
        if( S('topPhoto') ) {
            $topPhoto = S('topPhoto');
        } else {
            $topPhoto = M('scrollpic')->where(array('status'=>1,'type_id'=>2),'AND')->field('pic')->select();
            $topPhotoArr = array();
            foreach ($topPhoto as $key => $v) {
                $topPhotoArr[] = 'http://bjczcf.com'.$v['pic'];
            }
            //($topPhotoArr);
            S('topPhoto',$topPhotoArr,3600*24*7);
            //echo '缓存测试';
        }
        echo json_encode($topPhoto);
    }
}