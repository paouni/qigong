<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class PatentController extends CommonController
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
        //
        $patentCount = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',1)->count();
        $patent = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',1)->order('g.sort_order desc')->limit(3)->select();;

        $this->assign([
        		'nav' => $nav,
                'banner' => $banner,
                'patentCount' => 3,
                'patent' => $patent,
        	]);
        return $this->fetch();
    }

   
    
}
