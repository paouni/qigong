<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class ContactController extends CommonController
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

        $this->assign([
                'nav' => $nav,
                'banner' => $banner,
                'category_id' => $category_id,
            ]);
        return $this->fetch();
    }

     public function map()
    {
        // echo "hello";
        return $this->fetch();
    }
}
