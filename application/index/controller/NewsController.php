<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class NewsController extends CommonController
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
        $where = ['g.is_delete'=>0,'c.category_id'=>5];
        // $total = (new Goods())->alias('g')->join('boss_goods_cate c','g.id=c.goods_id')->where($where)->count();
        $list = (new Goods())->alias('g')->join('boss_goods_cate c','g.id=c.goods_id')->where($where)->order('id desc')->paginate();
        $page = $list->render();
        $this->assign([
        		'nav' => $nav,
                'banner' => $banner,
                'news' => $list,
                'page' => $page,
        	]);
        return $this->fetch();
    }

     public function detail()
    {
       //导航
        $nav = Db::name('Category')->where('parent_id',0)->order('sort_order asc')->select();
        $news_id = input('get.news_id');
        $detail = (new Goods())->where('id',$news_id)->find();

        $this->assign([
                'nav' => $nav,
                'detail' => $detail,
            ]);
        return $this->fetch();
    }
    
}
