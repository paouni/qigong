<?php

namespace app\admin\model;

use think\Model;

class Friend extends Model
{
    // 是否需要自动写入时间戳 如果设置为字符串 则表示时间字段的类型
    protected $autoWriteTimestamp = false;

    protected $auto = ['link'];

    //自动完成
    protected function setLinkAttr($value)
    {
        if (false === stripos($value, 'http://') && false === stripos($value, 'https://')) {
            return 'http://' . $value;
        }
        return $value;
    }

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function all_list()
    {
        return $this->order('sort_order desc')->select();
    }

    /**
     * 模型数据验证
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //$Friend = new Friend();
        $update = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(
            [
                'name' => 'require|max:30',
                'link' => 'require|max:30',
            ],
            [
                'name.require' => ' 名称不能为空 ',
                'name.max' => ' 名称不能超过30个字符 ',
                'link.require' => ' 地址不能为空 ',
                'link.max' => ' 地址不能超过30个字符 ',
            ]
        )->allowField(true)->save($data, $update);
        if (false === $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
            //var_dump($error);exit();
        }
        return true;
    }

    /**
     * 删除
     */
    public function del($id)
    {
        if (!$id || !is_int($id)) {
            return false;
        }
        $result = $this->get($id);
        //$result = Friend::get($id);
        if (false !== $result) {
            if ($result->delete()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}