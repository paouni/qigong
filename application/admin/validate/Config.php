<?php

namespace app\admin\validate;

use think\Validate;

class Config extends Validate
{
    protected $rule = [
        'zh_name' => 'require|max:50',
        'en_name' => 'require|max:50',
        'field_type' => 'require|max:30',
    ];

    protected $message = [
        'zh_name.require' => ' 中文名称不能为空 ',
        'zh_name.max' => ' 中文名称不能超过50个字符 ',
        'en_name.require' => ' 英文名称不能为空 ',
        'en_name.max' => ' 英文名称不能超过50个字符 ',
        'field_type.require' => ' 类型不能为空 ',
        'field_type.max' => ' 类型不能超过30个字符 ',
    ];

    //验证场景
    protected $scene = [
        //'add'   =>  ['zh_name','field_type'],
        'edit' => ['zh_name', 'field_type'],
    ];

    // 自定义 notPrice 验证规则，正确的价格
    public function notPrice($value)
    {
        return 1 === preg_match('/^\d+(\.\d+)?$/', (string)$value);
    }
}