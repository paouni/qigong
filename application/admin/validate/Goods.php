<?php

namespace app\admin\validate;

use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'category_id' => 'require',
        'goods_name' => 'require|max:1000',
        'brief2' => 'require|max:1000',
        'img_url' => 'require',
        'goods_gallery' => 'require',
        'goods_desc' => 'require',
    ];

    protected $message = [
        'category_id.require' => '分类不能为空 ',
        'goods_name.require' => '产品名称不能为空 ',
        'goods_name.max' => '名称不能超过1000个字符 ',
        'brief2.require' => '特色描述不能为空 ',
        'brief2.max' => '名称不能超过1000个字符 ',
        'img_url.require' => '缩略图不能为空 ',
        'goods_gallery.require' => '图片相册不能为空',
        'goods_desc.require' => '详细图文内容不能为空 ',
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
}