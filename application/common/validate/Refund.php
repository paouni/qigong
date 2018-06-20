<?php

namespace app\common\validate;

use think\Validate;

class Refund extends Validate
{
    protected $rule = [
        'order_id' => 'require|number',
        'reason' => 'require|max:200',
        'refund_amount' => 'require|isAmount',
    ];

    protected $message = [
        'order_id.require' => '数据有误请稍后重试',
        'order_id.number' => '数据有误请稍后重试',
        'reason.require' => '请输入退款原因',
        'reason.max' => '退款原因不能超过200个字符',
        'refund_amount.require' => '请输入退款金额',
        'refund_amount.isAmount' => '退款金额输入有误',
    ];

    //验证场景
    protected $scene = [
        'add' => ['order_id', 'reason', 'refund_amount'],
        'edit' => ['order_id', 'is_pass'],
    ];

    // 自定义 notPrice 验证规则，正确的价格
    public function isAmount($value, $data)
    {
        return 1 === preg_match('/^\d+(\.\d+)?$/', (string)$value);
    }
}