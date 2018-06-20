<?php

namespace app\index\controller;

use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;

class VedioController extends CommonController
{
    //1.前台首页
    public function index()
    {
        //导航
        $nav = Db::name('Category')->where('parent_id',0)->order('sort_order asc')->select();
        $this->assign([
        		'nav' => $nav,
        	]);
        return $this->fetch();
    }

    
}
