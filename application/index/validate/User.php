<?php

namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name' => 'require',
        'email' => 'email',
        'message' => 'require|min:10',
    ];

    protected $message = [
        'user_name.require' => '姓名不能为空 ',
        'email' => '邮箱格式错误',
        'message.require' => '请留言',
        'message.min' => '留言内容不能少于10个字符',
    ];

    //验证场景
    protected $scene = [
        //'add'   =>  ['zh_name','field_type'],
        //'edit'  =>  ['zh_name', 'field_type'],
    ];
}