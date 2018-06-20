<?php

namespace app\common\model;

use think\Model;

class Goods extends Model
{
    // 关闭自动写入时间戳
    //protected $autoWriteTimestamp = false;

    //数据完成
    protected $auto = ['special_field', 'goods_gallery'];
    //protected $insert = ['create_time'];
    //protected $update = [];

    //获取器 -- 商品相册
    public function getGoodsGalleryAttr($value)
    {
        return unserialize($value);
    }

    //获取器 -- 产品特色标签
    public function getTrustIndexAttr($value, $data)
    {
        return explode(' ', $data['trust']);
    }

    //商品相册
    public function setGoodsGalleryAttr($value, $data)
    {
        //$arr = $data['goods_gallery'];
        return is_array($value) ? serialize($value) : $value;
    }

    /**
     * art_order排序后的栏目列表
     * @return mixed
     */
    public function art_list()
    {
        return $this->order('id desc')->select();
    }

    /**
     * 模型数据验证
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        $isUpdate = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(true)->allowField(true)->save($data, $isUpdate);
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
     * 分页
     */
   /* public function pageQuery()
    {
        $page = $this->order('id', 'desc')->paginate('10'); //input('post.pagesize/d')
        return $page;
    }*/


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
    
    //一对一关联模型
    public function categoryName()
    {
        return $this->hasOne('category', 'category_id');
    }

    /**
     * 根据id获取产品信息
     * @param $id
     * @param $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getById($id, $field = '*')
    {
        return $this->where(['id' => $id])->field($field)->find();
    }

    /**
     * 获取指定栏目数据
     */
    public function getByCateId($category_id)
    {
        $where = ($category_id == 0) ? 1 : ['category_id' => $category_id];
        return $this->where($where)->order('sort_order desc')->limit(6)->select();
    }

    public function getListById($cid)
    {
        $list = $this->getByCateId($cid);
        $str = '';
        foreach ($list as $k => $v) {
            $url = __ROOT__ . '/tour/' . $v['id'] . '.html'; //伪静态产品页面地址
            $str .= '<div class="col-md-6 col-sm-6 col-xs-12"><a href="' . $url . '"><img src="' . $v['img_url'] . '"alt=""><div class="carousel-caption"><p class="topc"><a href="' . $url . '">' . $v['goods_name'] . '</a><span class="pull-right">￥' . $v['adult_price'] . '</span></p></div></a></div>';
        }
        return $str;
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
        //$result = Article::get($id);
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
     * 根据 商品$id, 日期$date  返回成人和儿童票价数组
     * @param $id
     * @param $date
     * @return bool|array
     */
    public function getAdultChildArray($id, $date)
    {
        //1.参数过滤
        if ($id <= 0 || floor($id) != $id || empty($date) || 2 !== substr_count($date, '-')) {
            return false;
        }
        //2.根据id查询相应的产品详细信息
        $item = $this->getById($id, 'adult_price,child_price,special_field');
        if (empty($item)) {
            return false;
        }

        //2.1 默认价格
        $data = [
            'adult_price' => $item['adult_price'],
            'child_price' => $item['child_price']
        ];
        //2.2 判断循环的日期是否存在于 特殊价格里面
        foreach ($item['special_field']['start_date'] as $k => $v) {
            //$v = '2017-07-01', $date  = '2017-7-1'
            if (strtotime($v) <= strtotime($date) && strtotime($date) <= strtotime($item['special_field']['end_date'][$k])) {
                $data = [
                    'adult_price' => $item['special_field']['price1'][$k],
                    'child_price' => $item['special_field']['price2'][$k],
                ];
            }
        }
        return $data;
    }

    /**
     *  根据商品$id ,$adult,$child.$date  计算当天票价价格
     * @param $id 1.商品表的主键id
     * @param $adult 2.成人人数
     * @param $child 3.儿童人数
     * @param $date 4.日期 如：'2017-06-28'
     * @return string|bool
     */
    public function getPriceById($id, $adult, $child, $date)
    {
        //1.参数过滤
        if ($id <= 0 || floor($id) != $id || $adult <= 0 || floor($adult) != $adult || $child < 0 || empty($date) || 2 !== substr_count($date,
                '-')) {
            return false;
        }
        //2.获取成人儿童价数组
        $item = $this->getAdultChildArray($id, $date);
        $price = $adult * $item['adult_price'] + $child * $item['child_price'];

        return $price;
    }
}