<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class SupportController extends CommonController
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
        //产品分类
        $cate= (new Category())->where('parent_id',2)->order('sort_order desc')->select();
        $idArr = array();
        foreach($cate as $k=>$v){
            $idArr[$k]['id'] = $v['id'];
        }
        $idStr = '';
        foreach($idArr as $k=>$v){
            $idStr.=$v['id'].',';
        }
        $idStr = rtrim($idStr,',');
        $support = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->join('boss_category t','c.category_id=t.id')->field('g.*,t.title')->where('c.category_id','in',$idStr)->order('g.sort_order desc')->select();

        $this->assign([
        		'nav' => $nav,
                'banner' => $banner,
                'cate' => $cate,
                'support' => $support,
        	]);
        return $this->fetch();
    }

   
    
}
