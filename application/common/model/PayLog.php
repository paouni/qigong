<?php

namespace app\common\model;

use think\Model;

class PayLog extends Model
{
    protected $order;       //订单信息模型
    //自动完成字段
    //protected $auto = ['order_sn'];

    //开启构造方法导致无法查询
    public function initialize()
    {
        if ($this->order == null) {
            $this->order = new Order();
        }
    }

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function _list()
    {
        return $this->order('id desc')->select();
    }

    //一对一关联模型  --  关联 order 表的数据
    public function orderName()
    {
        return $this->hasOne('order', 'id', 'order_id');
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