<?php

namespace app\admin\model;

use think\Model;

class Goods extends Model
{
    // 关闭自动写入时间戳
    //protected $autoWriteTimestamp = false;

    //数据完成
    protected $auto = ['special_field', 'goods_gallery', 'goods_rule'];
    //protected $insert = ['create_time'];
    //protected $update = [];



    //获取器 -- 商品相册
    public function getGoodsGalleryAttr($value)
    {
        return unserialize($value);
    }

    public function getGoodsRuleAttr($value)
    {
        return unserialize($value);
    }

   
    //商品相册
    public function setGoodsGalleryAttr($value, $data)
    {
        //$arr = $data['goods_gallery'];
        return is_array($value) ? serialize($value) : $value;
    }

    public function setCategoryIdAttr($value)
    {
        return '';
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
        // 关联插入中间表操作
        return $this->relationAction($this->id, $data['category_id']);
        //return true;
    }

    /**
     * 多对多关联插入中间表 -- 先删除中间表
     * @param int $vvs_id 商品id,如 2
     * @param array $category_ids 栏目id数组，如[1,3]
     * @return bool
     */
    public function relationAction($vvs_id, $category_ids)
    {
        if ($vvs_id <= 0 || floor($vvs_id) != $vvs_id || !is_array($category_ids)) {
            return false;
        }
        // 多对多模型新增或修改操作  -- 中间表 boss_goods_cate 表的修改
        $vvs = $this->find($vvs_id);
        if (empty($vvs)) {
            return false;
        }
        //1. 先删除中间表
        $vvs->cate()->detach();
        //2. 插入中间表
        $vvs->cate()->attach($category_ids);
        return true;
    }

    /**
     * 分页
     */
    /*public function pageQuery($where = 1)
    {
        $page = $this->where($where)->order('id', 'desc')->paginate('100'); //input('post.pagesize/d')
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
        $data['results'] = $this->alias('g')->join('boss_goods_cate c','g.id=c.goods_id')->join('boss_category b','c.category_id=b.id')->field('g.id,g.goods_name,g.img_url,g.brief2,g.sort_order,g.is_delete,g.place,g.create_time,b.name category_name')->where($where)->limit(($page - 1) * $listRows,
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

    //多对多关联模型
    public function cate()
    {
        return $this->belongsToMany('category', 'goods_cate');
    }

    /**
     * 根据id获取产品信息
     * @param $id
     * @param $field
     * @return array|false|\PDOStatement|string|Model
     */
    public function getById($id, $field = '*')
    {
        return $this->where(['id' => $id, 'is_delete' => '0'])->field($field)->find();
    }

    /**
     * 获取指定栏目数据
     */
    public function getByCateId($category_id)
    {
        $where = ($category_id <= 0 || $category_id != floor($category_id)) ? 1 : ['id' => $category_id];
        // 1.关联多对多查询前面的列表，需要循环调用多对多模型
        $cate = (new Category())->where($where)->order('sort_order desc')->select();
        return $cate;
    }

    /**
     * 获取栏目下的所有商品列表
     */
    public function getListById($cid = 0)
    {
        // 所有产品列表
        if ($cid == 0) {

            $cate= (new Category())->where('parent_id',15)->order('sort_order desc')->select();
            $idArr = array();
            foreach($cate as $k=>$v){
                $idArr[$k]['id'] = $v['id'];
            }
            $idStr = '';
            foreach($idArr as $k=>$v){
                $idStr.=$v['id'].',';
            }
            $idStr = rtrim($idStr,',');

            $list = $this->alias('g')->where(['g.is_delete' => 0])->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id','neq','14')->where('c.category_id','neq','15')->where('c.category_id','not in',$idStr)->where('g.lang_type',0)->order('g.sort_order desc')->select();
            $str = '';
            foreach ($list as $k => $v) {
                $url = __ROOT__ . '/index/product/details?goods_id=' . $v['id'] . '.html'; //伪静态产品页面地址
                /*$str .= '<div class="col-md-6 col-sm-6 col-xs-12"><a href="' . $url . '" target="_blank"><img src="' . $v['img_url'] . '"alt=""><div class="carousel-caption"><p class="topc"><a href="' . $url . '">' . $v['goods_name'] . '</a></p></div></a></div>';*/
                $str .= '<li>
                            <a href="' . $url . '" class="Button Block">
                                <img src="'.$v['img_url'].'">
                            </a>
                        </li>';
            }
            return $str;
        }
        //具体某个栏目下的产品
        $cate_list = $this->getByCateId($cid);
        $str = '';
        foreach ($cate_list as $k => $v) {
            // 1.1 根据前面的多对多列表，循环获取对象数据
            foreach ($v->goods as $vv) {
                if ($vv['is_delete']) {
                    continue;
                }
                if ($vv['lang_type']) {
                    continue;
                }
                $url = __ROOT__ . '/index/product/details?goods_id=' . $vv['id'] . '.html'; //伪静态产品页面地址
                /*$str .= '<div class="col-md-6 col-sm-6 col-xs-12"><a href="' . $url . '" target="_blank"><img src="' . $vv['img_url'] . '"alt=""><div class="carousel-caption"><p class="topc"><a href="' . $url . '">' . $vv['goods_name'] . '</a></p></div></a></div>';*/
                $str .= '<li>
                            <a href="' . $url . '" class="Button Block">
                                <img src="'.$v['img_url'].'">
                            </a>
                        </li>';
            }
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


    
    //指定栏目的产品
    public function cateNum($num,$where=[]){
        //4. 取出中文所有的产品 除我们的技能、视频中心以外
        $pro = $this->alias('g')->where(['g.is_delete' => 0])->where($where)->join('boss_goods_cate c','g.id = c.goods_id')->where('c.category_id',$num)->order('g.sort_order desc')->select();
        return $pro;
    }

    


}