<?php return array (
  'notice' => '模板内容不要太长，内容结尾最好为【网站名称】，可以加快发送短信的发送速度',
  'paramdesc' => '##code##:验证码;##username##:用户名;##money##:借款金额;##title##:借款标题;##url##:借款链接;##date##:年月日;##datetime##:年月日时分秒;##remark##:备注信息;##buyuser##:买方用户;',
  'isauto' => '1',
  'data' => 
  array (
    'mobileauthen' => 
    array (
      'name' => '手机认证模板',
      'content' => '您的手机验证码为:##code##。请不要把验证码泄露给任何人。',
      'isopen' => '0',
    ),
    'newmobile' => 
    array (
      'name' => '修改认证手机',
      'content' => '您正在修改认证手机，验证码为:##code##。请不要把验证码泄露给任何人。',
      'isopen' => '1',
    ),
    'withdraw' => 
    array (
      'name' => '提现申请提醒',
      'content' => '验证码:##code##。您正在进行提现操作，请不要把验证码泄露给任何人。',
      'isopen' => '0',
    ),
  ),
);