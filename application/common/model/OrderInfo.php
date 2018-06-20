<?php

namespace app\common\model;

use think\Model;

class OrderInfo extends Model
{
    //查看器
    public function getTicketTypeNameAttr($value, $data)
    {
        switch ($data['ticket_type']) {
            case 1:
                return '学生票';
            default :
                return '成人票';
        }
    }

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function cate_list()
    {
        return $this->order('id desc')->select();
    }

    //一对一关联模型
    public function goodsName()
    {
        return $this->hasOne('goods', 'id', 'goods_id');
    }

    //关联order表的数据
    public function orderName()
    {
        return $this->hasOne('order_info', 'order_id', 'id');
    }

    /**
     * 模型数据验证 -- 用于 新增和修改
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //$Category = new Category();
        $update = isset($data['id']) ? ['order_id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(true)->allowField(true)->save($data, $update);
        if (false === $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        return true;
    }

    /**
     * 获取指定对象
     */
    public function getById($id)
    {
        return $this->where(['id' => $id])->find();
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
        //$result = Category::get($id);
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