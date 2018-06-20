<?php

namespace app\index\model;

use think\Model;

class Goods extends Model
{
    
    public function pageQuery($listRows = 10, $where = [])
    {
        //$key = input('get.key'); //$where = []; //-- 查询条件
        
        $page = input('get.page') < 1 ? 1 : input('get.page'); //当前页
        $total = $this->alias('g')->join('boss_goods_cate c','g.id=c.goods_id')->where($where)->count();
        $data['results'] = $this->alias('g')->join('boss_goods_cate c','g.id=c.goods_id')->where($where)->limit(($page - 1) * $listRows,
            $listRows + 0)->order('id desc')->select();
        $data['page'] = [
            'total' => $total,         //总记录数
            'pageCount' => ceil($total / $listRows),     //总页数
            'currentPage' => $page,          //当前页
        ];
        return $data;
    }

       
 
}