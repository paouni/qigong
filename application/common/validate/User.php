<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'user_name' => 'require|isMobile',
        'password' => 'require|max:30',
        'repassword' => 'require|confirm:password',
        'code' => 'require|isCode',
    ];

    protected $message = [
        'user_name.require' => '手机号码不能为空 ',
        'user_name.isMobile' => '手机号码输入有误',
        'password.require' => '密码不能为空',
        'password.max' => '密码不能超过30个字符',
        'repassword.require' => '确认密码不能为空',
        'repassword.confirm' => '两次密码输入不同',
        'code.require' => '验证码不能为空',
        'code.isCode' => '验证码输入有误',
    ];

    //验证场景
    protected $scene = [
        //'add'   =>  ['zh_name','field_type'],
        //'edit'  =>  ['zh_name', 'field_type'],
    ];

    // 验证规则
    public function isMobile($value)
    {
        return isMobile($value);
    }

    public function isCode($code)
    {
        if (strtoupper($code) == \think\Session::get('code')) {
            return true;
        } else {
            return false;
        }
    }
}