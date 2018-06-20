<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class ProductController extends CommonController
{
    //1.前台首页
    public function index()
    {
        //导航
        $nav = Db::name('Category')->where('parent_id',0)->order('sort_order asc')->select();
        //banner
        $category_id = input('get.category_id');
        $category = (new Category())->where('id',$category_id)->find();
        $banner = $category['img_url'];
        //产品中心
        $proCate= (new Category())->where('parent_id',3)->order('sort_order desc')->select();

        $proIds = array();
        foreach($proCate as $k=>$v){
            $proIds[$k]['id'] = $v['id'];
        }
        $proStr = '';
        foreach($proIds as $k=>$v){
            $proStr.=$v['id'].',';
        }
        $proStr = rtrim($proStr,',');
        $product = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->join('boss_category t','c.category_id=t.id')->field('g.*,t.title')->where('c.category_id','in',$proStr)->order('g.sort_order desc')->select();

        $this->assign([
        		'nav' => $nav,
                'banner' => $banner,
                'proCate' => $proCate,
                'product' => $product,
        	]);
        return $this->fetch();
    }

     public function detail()
    {
       
        return $this->fetch();
    }
    
}
