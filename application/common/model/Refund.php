<?php

namespace app\common\model;

use think\Model;

class Refund extends Model
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

    /**
     * 模型数据验证 -- 用于 新增和修改
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //是否更新操作
        if (isset($data['id']) && $data['id'] > 0) {
            $update = ['id' => $data['id']];
            //分类1.退款申请中，更新订单表的 pay_status 字段为3，  2.审核通过为4,    3.审核不通过为5；
            if (!empty($data['is_pass']) && $data['is_pass'] == 1) {
                $order_update = ['order_status' => 4, 'pay_status' => 4]; //审核通过
                //------------------------- 调用退款接口 start ----------------------------------------
                //1. 查询支付日志 pay_log 表的数据
                $pay_log = \think\Db::name('pay_log')->where(['order_id' => $data['order_id'], 'is_paid' => 1])->find();
                if (empty($pay_log)) {
                    return '订单支付信息不存在';
                }

                $refund_account = config('refund_account') ?: 'REFUND_UNSETTLED';//
                //退款数据
                $reundData = [
                    'trade_no' => $pay_log['trade_no'],         //支付宝的订单号，优先使用
                    'out_trade_no' => $pay_log['order_sn'],         //商户系统内部的订单号
                    'transaction_id' => $pay_log['trade_no'],         //微信第三方的订单号，优先使用
                    'total_fee' => $data['order_amount'],        // 微信退款字段
                    'refund_fee' => $data['order_amount'],        //退款总金额，订单总金额，只能为整数
                    'reason' => $data['reason'],                  //退款的原因说明
                    'refund_no' => 'T' . order_sn(),//商户系统内部的退款单号，商户系统内部唯一，同一退款单号多次请求只退一笔(3～24位)
                    'refund_account' => $refund_account,// REFUND_RECHARGE:可用余额退款  REFUND_UNSETTLED:未结算资金退款（默认）
                ];
                $pay_type = ($pay_log['pay_type'] == 0) ? 'alipay' : 'wechat';
                $res = $this->refund($reundData, $pay_type);
                //------------------------- 调用退款接口 end   ----------------------------------------
                $res = ($res === false) ? '退款操作失败，请稍后重试' : $res;
                if (is_string($res)) {
                    return $res;
                } //'退款申请失败，请稍后重试'
            } else {
                $order_update = ['order_status' => 5, 'pay_status' => 5]; // 审核不通过
            }
            $rule = 'refund.edit'; //验证场景
        } else {
            $update = [];       //退款申请中,这个状态
            $rule = 'refund.add'; //验证场景
            $order_update = ['pay_status' => 3];
        }
        $result = $this->validate($rule)->allowField(true)->save($data, $update);
        if (1 !== $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        \think\Db::name('order')->where(['id' => $data['order_id']])->update($order_update);
        //$this->order->save(['refund' => 1], ['id' => $data['order_id']]); //模型中有自动完成字段
        return true;
    }

    /**
     * 获取指定对象
     */
    public function getById($id)
    {
        if ($id <= 0 || floor($id) != $id) {
            return false;
        }
        return $this->where(['id' => $id])->find();
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

    /**
     * 退款统一处理方法
     * @param array $reundData = [
     * 'trade_no'      =>  '2017070621001004510217048342',         //支付宝的订单号，优先使用
     * 'out_trade_no'  =>  '20170706175534545397',                 //商户系统内部的订单号
     * 'refund_fee'    =>  '0.1',                                 //退款总金额，订单总金额，只能为整数
     * 'reason'        =>  '测试退款1',                            //退款的原因说明
     * 'refund_no'     =>
     * ];
     * @param string $refund_name 默认  'alipay' |  'wechat'  只有这两种方式。
     * @return bool|string|int         true | 失败原因
     */
    public function refund($reundData = [], $refund_name = 'alipay')
    {
        switch ($refund_name) {
            case 'alipay':
                $config = config('aliconfig');// 支付宝的配置信息
                $refund_name = 'ali_refund';
                break;
            case 'wechat':
                $config = config('wechat');
                $refund_name = 'wx_refund';
                break;
            default:
                return false;
        }
        try {
            $ret = \Payment\Client\Refund::run($refund_name, $config, $reundData);
            if (isset($ret['is_success']) && $ret['is_success'] == 'T') {
                //start --- 插入退款订单号
                $flag = \think\Db::name('pay_log')->where(['order_sn' => $ret['response']['order_no']])->update([
                    'refund_no' => $ret['response']['refund_no'],
                    'is_refund' => 1
                ]);
                //end  --- 插入退款订单号

                if ($flag !== false) {
                    try {
                        //---------------17年7月20日添加 start 调用智游宝 退单接口 ---------------------
                        if (true !== \app\index\model\Api::cancelOrder($reundData['out_trade_no'])) {
                        }
                        //---------------17年7月20日添加 end   调用智游宝 退单接口 ---------------------
                    } catch (\think\Exception $exception) {
                        return '智游宝接口数据错误';
                    }
                    return true;
                } else {
                    return '退款订单写入失败';
                }
            }
            return false;
        } catch (\Payment\Common\PayException $e) {
            return $e->errorMessage(); //错误原因
        }
    }
}