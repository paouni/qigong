<?php

namespace app\common\validate;

use think\Validate;

class OrderInfo extends Validate
{
    protected $rule = [
        'phone' => 'require|isMobile',
        'name' => 'require|max:50',
        'cert_type' => 'in:0,1,2,3,4,5',
        'cert_number' => 'isCodeNo',
        'trip_time' => 'isTrip',
        'trip_number' => 'number',
        'ticket_type' => 'in:0,1,2,3',
    ];

    protected $message = [
        'phone.require' => '手机号码不能为空 ',
        'phone.isMobile' => '手机号码格式输入有误',
        'name.require' => '用户姓名不能为空',
        'cert_type.in' => '证件类型选择有误',
        'cert_number.isCodeNo' => '证件号码输入有误',
        'trip_time.isTrip' => '入园时间请至少提前一天！',
        'trip_number.number' => '出行人数输入有误',
        'ticket_type.in' => '票种选择有误',
    ];

    //验证场景
    protected $scene = [
        //'add'   =>  ['zh_name','field_type'],
        //'edit'  =>  ['zh_name', 'field_type'],
    ];

    // 自定义 notPrice 验证规则，正确的价格
    public function notPrice($value)
    {
        return 1 === preg_match('/^\d+(\.\d+)?$/', (string)$value);
    }

    //是否手机号
    public function isMobile($value)
    {
        return isMobile($value);
    }

    //是否身份证号
    public function isCodeNo($value)
    {
        return isCreditNo($value);
    }

    public function isTrip($value)
    {
        if (strtotime($value) < strtotime(date('Y-m-d')) + 3600 * 24) {
            return false;
        }
        return true;
    }
}