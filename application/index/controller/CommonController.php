<?php

namespace app\index\controller;

use app\admin\model\Friend;
use app\admin\model\Goods;
use app\index\model\Nav;
use think\Controller;
use think\Db;

class CommonController extends Controller
{
    protected $category = null;

    public function _initialize()
    {
        parent::_initialize();

        // 判断缓存是否失效
        if (config('HTML_CACHE_ON') && file_exists($file = ROOT_PATH . 'index.html')) {   //缓存失效
            if (time() > filemtime($file) + config('HTML_CACHE_TIME')) {
                @unlink($file);
            }
        }

        //1.取出配置项内容  -- 在extra/web.php中
        $config = config('web');

        //2.导航栏
        $nav = (new Nav())->diffType();

        //5. 友情链接
        //$friend = (new Friend())->all_list();

        $this->assign([
            'config' => $config,
            'nav' => $nav,
            //'friend'        =>  $friend
        ]);
    }

    /**
     *  公共方法 ： 取出block 表的 序列号数据
     * @param string $type
     * @return mixed
     */
    public function index_block($type = '')
    {
        if (empty($type)) {
            return '';
        }
        //获取区块内容
        $content = \think\Db::name('block')->field('content')->where('type', $type)->find();
        //反序列化 数据
        return unserialize($content['content']);
    }

    /**
     * 根据 商品$id, 日期$date  返回成人和儿童票价数组
     * @param $id
     * @param $date
     * @return bool|array
     */
    public function getAdultChildArray($id, $date)
    {
        //2.根据id查询相应的产品详细信息
        return (new Goods())->getGoodsArray($id, $date);
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
        return (new Goods())->getPriceById($id, $adult, $child, $date);
    }
}
