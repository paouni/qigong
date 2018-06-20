<?php

namespace app\index\controller;

use app\admin\model\Goods;
use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\common\model\Category;
use think\Db;

class IndexController extends CommonController
{
    //1.前台首页
    public function index()
    {
        //导航
        $nav = Db::name('Category')->where('parent_id',0)->order('sort_order asc')->select();
        // var_dump($nav);exit;
        // 轮播
      	$lunbo = (new Lunbo())->_list(1);
        //专利产品
        $count = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',1)->where('g.place',1)->count();
        $patent = (new Goods())->cateNum(1,['g.place'=>1]);
        //技术支持
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
        $support = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id','in',$idStr)->where('g.place',1)->order('g.sort_order desc')->limit(6)->select();
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
        $product = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->join('boss_category t','c.category_id=t.id')->field('g.*,t.title')->where('c.category_id','in',$proStr)->where('g.place',1)->order('g.sort_order desc')->limit(8)->select();
        // var_dump($product);exit;
        //企业荣誉
        $gloryP = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',4)->where('g.place',1)->order('g.sort_order desc')->limit(0,4)->select();
        $gloryN = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',4)->where('g.place',1)->order('g.sort_order desc')->limit(4,4)->select();
        //新闻中心
        $news = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',5)->where('g.place',1)->order('g.sort_order desc')->limit(4)->select();
        //视频中心
        $vedioCate= (new Category())->where('parent_id',6)->order('sort_order desc')->select();

        $vedioIds = array();
        foreach($vedioCate as $k=>$v){
            $vedioIds[$k]['id'] = $v['id'];
        }
        $vedioStr = '';
        foreach($vedioIds as $k=>$v){
            $vedioStr.=$v['id'].',';
        }
        $vedioStr = rtrim($vedioStr,',');
        $vedio = (new Goods())->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->join('boss_category t','c.category_id=t.id')->field('g.*,t.title')->where('c.category_id','in',$vedioStr)->where('g.place',1)->order('g.sort_order desc')->limit(4)->select();


        $this->assign([
        	'nav' => $nav,
            'lunbo' => $lunbo,
            'count' => $count,
            'patent' => $patent,
            'support' => $support,
            'proCate' => $proCate,
            'product' => $product,
            'gloryP' => $gloryP,
            'gloryN' => $gloryN,
            'news' => $news,
            'vedio' => $vedio,
        ]);
        return $this->fetch();
    }
   

    
}
