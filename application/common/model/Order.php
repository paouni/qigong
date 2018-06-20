<?php

namespace app\common\model;

//use app\admin\model\Goods;
use think\Model;

class Order extends Model
{
    protected $orderInfo;       //订单信息模型
    protected $priceArray = []; // 价格数组，成人和学生票价
    protected $price;           // 计算总价
    //自动完成字段
    protected $auto = ['order_sn', 'user_id', 'goods_amount', 'pay_fee', 'order_amount'];

    //开启构造方法导致无法查询,可以使用 initialize() 方法替换
    public function initialize()
    {
        if ($this->orderInfo == null) {
            $this->orderInfo = new OrderInfo();
        }
    }

    //订单号
    public function setOrderSnAttr()
    {
        return order_sn();
    }

    //用户id
    public function setUserIdAttr()
    {
        return decode(cookie('user'));
    }

    //商品价格
    public function setGoodsAmountAttr($value, $data)
    {
        return $this->getPrice(0, $data['goods_id'], $data['trip_time'], $data['trip_number']);
    }

    //需要支付的手续费
    public function setPayFeeAttr($value, $data)
    {
        return 0;
    }

    //需要支付的费用
    public function setOrderAmountAttr($value, $data)
    {
        return $this->data['goods_amount'];//return $this->setGoodsAmountAttr($value, $data);
    }

    /**
     * 后台订单列表
     * @return mixed
     */
    public function _list()
    {
        return $this->order('id desc')->paginate(5);
    }

    /**
     * 分页方法
     * @param int $listRows 每页展示条数
     * @return int|mixed
     */
    public function pageQuery($listRows = 10, $where = [])
    {
        //$key = input('get.key'); //$where = []; //-- 查询条件
        $page = input('get.page') < 1 ? 1 : input('get.page'); //当前页
        $total = $this->where($where)->count();
        $data['results'] = $this->where($where)->limit(($page - 1) * $listRows,
            $listRows + 0)->order('id desc')->select();
        $data['page'] = [
            'total' => $total,         //总记录数
            'pageCount' => ceil($total / $listRows),     //总页数
            'currentPage' => $page,          //当前页
        ];
        return $data;
    }

    /**
     * 模型数据验证 -- 用于 新增和修改
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        $update = (isset($data['id']) && $data['id'] != 0) ? ['id' => $data['id']] : []; //是否更新操作
        //---- 8月10日 ---- 验证当日是否可以购票 start
        if (date('Y-m-d') == $data['trip_time']) { //当日订单
            //1.根据 $data['goods_id'] 查询商品 today_endtime 字段的值是否存在
            $good = Goods::get($data['goods_id']);
            if (empty($good) || empty($good['today_endtime'])) {
                return '入园时间请至少提前一天！';
            } else {
                //判断时间是否超过  today_endtime 字段的值
                if (time() > strtotime(date('Y-m-d') . $good['today_endtime'])) {
                    return '当日入园购票，请在 ' . $good['today_endtime'] . ' 之前购买！';
                }
            }
        }
        //var_dump($data);exit();
        //---- 8月10日 ---- 验证当日是否可以购票 end
        $result = $this->validate(true)->allowField(true)->save($data, $update);
        if (1 !== $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        //合并关联数组数据和价格数据
        $data = array_merge($data, ['order_id' => $this->id], $this->priceArray);

        $result2 = $this->orderInfo->data_verify($data);
        if (true !== $result2) {
            //订单信息表验证失败，删除订单表的数据
            $rs = $this->where(['id' => $this->id])->delete();
            $error = $this->orderInfo->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        return $this->id;
    }

    /**
     * 一对一关联模型  --  关联 order_info 表的数据
     * @return \think\model\relation\HasOne
     */
    public function orderInfo()
    {
        return $this->hasOne('order_info', 'order_id');
    }

    /**
     * 一对一 关联 boss_refund 表的数据
     */
    public function refundInfo()
    {
        return $this->hasOne('refund', 'order_id', 'id');
    }

    public function payLog()
    {
        return $this->hasOne('pay_log', 'order_id', 'id');
    }

    /**
     * 获取指定对象
     */
    public function getById($id)
    {
        $user = cookie('user');

        if (empty($user)) {
            return false;
        }
        $user_id = decode($user);
        if ($id <= 0 || floor($id) != $id) {
            return false;
        }
        $item = $this->where(['id' => $id])->find();

        // 增加后台管理员不用验证权限
        return (\think\Session::get('uid') > 0) ? $item : ($item['user_id'] == $user_id) ? $item : false;
    }

    /**
     * 根据 用户id 和 状态 获取订单列表
     * @param $user_id
     * @param $status
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function getByUserId($user_id, $status)
    {
        if (empty($user_id)) {
            return false;
        }
        $where = ['user_id' => $user_id];
        if (isset($status) && $status !== '') {
            if ($status == 4) {
                $where['pay_status'] = [['=', '3'], ['=', '4'], 'or'];
            } else {
                if ($status == 2) {
                    $where['pay_status'] = [['=', '2'], ['=', '5'], 'or'];
                } else {
                    $where['pay_status'] = $status;
                }
            }
        }
        return $this->where($where)->order('id desc')->select();
    }

    /**
     *  根据 手机号 查询订单列表
     */
    public function getByPhone($phone = '')
    {
        if (empty($phone)) {
            return false;
        }
        $ids = $this->orderInfo->where(['phone' => $phone])->column('order_id');
        return $this->where('id', 'IN', $ids)->order('id desc')->select();
    }

    /**
     * 根据 日期搜索订单数据
     */
    public function getBySearch($user_id, $start_date, $end_date)
    {
        if (empty($user_id) || empty($start_date) || empty($end_date)) {
            return false;
        }
        $ids = $this->orderInfo->where(['trip_time' => [['>=', $start_date], ['<=', $end_date]]])->column('order_id');
        rsort($ids);
        return $this->where('id', 'IN', $ids)->where(['user_id' => $user_id])->order('id desc')->select();
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
     * 获取价格数组                  如： ['adult_price' => '300', 'child_price' => '100']
     * @param $goods_id //产品id
     * @param $date //日期    如：2017-06-30
     * @return array|bool
     */
    public function getPriceArray($goods_id, $date)
    {
        if ($this->priceArray == null) {
            $this->priceArray = (new Goods())->getAdultChildArray($goods_id, $date);
        }
        return $this->priceArray;
    }

    /**
     * 计算票价
     * @param $type //类型  0成人票，1学生票。
     * @param $goods_id //产品id
     * @param $date //日期    如：2017-06-30
     * @param $number //人数    如：1
     * @return bool|mixed|string
     */
    public function getPrice($type, $goods_id, $date, $number)
    {
        if ($this->price == null) {
            $priceArray = $this->getPriceArray($goods_id, $date);
            $this->price = (1 == $type) ? $priceArray['child_price'] * $number : $priceArray['adult_price'] * $number;
        }
        return $this->price;
    }

    /**
     * 判断订单是否有效
     * @param $goods_id
     * @param $order_id
     * @return array|bool|false|\PDOStatement|string|Model
     */
    public function orderInfoTrue($goods_id, $order_id)
    {
        if ($goods_id <= 0 || floor($goods_id) != $goods_id || $order_id <= 0 || floor($order_id) != $order_id) {
            return false;
        }
        $order_info = $this->orderInfo->where(['order_id' => $order_id])->find();
        if (empty($order_info)) {
            return false;
        }

        if ($order_info['goods_id'] != $goods_id) {
            return false;
        }
        $order_info['order'] = $this->where(['id' => $order_id])->find();
        //判断订单是否1.已经支付或者2.过期
        if ($order_info['order']['pay_status'] == 2 || $order_info['order']['order_status'] >= 1) {
            return false;
        }
        if (strtotime($order_info['trip_time']) < strtotime(date('Y-m-d')) + 3600 * 24) {
            //修改订单状态 order_status 为 2 已取消
            \think\Db::name('order')->where(['id' => $order_id])->update(['order_status' => 2]);
            return false;
        }
        return $order_info;
    }
}