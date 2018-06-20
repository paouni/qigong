<?php
/**
 * 栏目分类的类库
 */

namespace categoryclass;

class Categoryclass
{
    /**
     * 1.1用于后台栏目的列表展示 ----方法1 递归排序----
     * @param $data                     //数组由 --对象组成--
     * @param string $parent_key_name   //父级字段名称           默认 --    parent_id
     * @param string $primary_key_name  //主键的字段名称              --   id
     * @param int $parent_value         //父级默认的值                --   0
     * @param int $level                //等级，即下面$html 重复等级  --   0
     * @param string $html              //默认输出的样式前缀          --   |--
     * @return array                    返回二维数组，
     */
    public static function catesort($data, $parent_key_name = 'parent_id', $primary_key_name = 'id', $parent_value = 0, $level = 0, $html='|--')
    {
        $arr = [];
        foreach ($data as $v) {
            if($v->$parent_key_name == $parent_value) {
                $v->level = $level + 1;
                $v->html = str_repeat($html, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::catesort($data, $parent_key_name, $primary_key_name, $v->$primary_key_name, $level+1, $html));
            }
        }
        return $arr;
    }

    /**
     * 1.2用于后台栏目的列表展示 ----方法2 遍历排序(只用于两层分类)----
     * @param $data  //数组由 --对象组成--
     * @param string $parent_key_name
     * @param string $primary_key_name
     * @param int $parent_value
     * @param int $level
     * @param string $html
     * @return array  返回二维数组，
     */
    public static function cate_foreach($data, $parent_key_name = 'parent_id', $primary_key_name = 'id', $parent_value = 0, $level = 0, $html='|--')
    {
        $arr = [];
        foreach ($data as $v) {
            if($v->$parent_key_name == $parent_value) {
                $v->level = $level + 1;
                $v->html = str_repeat($html, $level);
                $arr[] = $v;

                foreach ($data as $m=>$n) {
                    if($n->$parent_key_name == $v->$primary_key_name) {
                        $n->level = 2;
                        $n->html = '|-- ';
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * 2.1  用于首页导航二级导航
     * @param $cate                     //数组元素为 ORM 对象组成
     * @param string $name              // 展示子栏目的字段名
     * @param int $parent_id            // 父栏目的值
     * @param string $parent_field      // 父栏目的字段名称
     * @param string $primaryKey        //主键名称
     * @return array
     */
    public static function orm_catesorts($cate, $name='child', $parent_id = 0, $parent_field = 'parent_id', $primaryKey='id')
    {
        $arr = [];
        foreach ($cate as $v) {
            if ($v->$parent_field == $parent_id) {
                $v->$name = self::orm_catesorts($cate, $name, $v->$primaryKey, $parent_field);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 2.2 用于首页导航二级导航
     * 数组元素由 普通数组组成
     * @param $cate     //普通数组组成
     * @param string $name
     * @param int $pid
     * @param string $parent_field
     * @param string $primaryKey
     * @return array 返回一个多维普通数组
     */
    public static function catesorts($cate,$name='child',$pid=0, $parent_field = 'parent_id', $primaryKey='id'){
        $arr = array();
        foreach($cate as $v){
            if($v[$parent_field] == $pid){
                $v[$name] = self::catesorts($cate,$name,$v[$primaryKey]);
                $arr[] = $v;
            }
        }
        return $arr;
    }

    /**
     * 3.1提供子ID返回父级栏目 用于：面包屑导航
     * @param $cate                 //数组由对象组成
     * @param $id                   //栏目id
     * @param string $parent_id     //父栏目字段名称
     * @param string $primaryKey    //主键名称
     * @return array                //对象数组
     */
    public static function orm_getParents($cate, $id, $parent_id = 'parent_id',$primaryKey = 'id'){
        $arr = array();
        foreach($cate as $v){
            if($v->$primaryKey == $id){
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v->$parent_id, $parent_id, $primaryKey), $arr);
            }
        }
        return $arr;
    }

    /**
     * 3.2提供子ID返回父级栏目 用于：面包屑导航
     * @param $cate                 //数组由普通数组组成
     * @param $id                   //栏目id
     * @param string $parent_id     //父栏目字段名称
     * @param string $primaryKey    //主键名称
     * @return array                //普通数组
     */
    public static function getParents($cate, $id, $parent_id = 'pid',$primaryKey = 'id'){
        $arr = array();
        foreach($cate as $v){
            if($v[$primaryKey] == $id){
                $arr[] = $v;
                $arr = array_merge(self::getParents($cate, $v[$parent_id], $parent_id, $primaryKey),$arr);
            }
        }
        return $arr;
    }

    //提供父级ID返回所有子栏目ID
    public static function getSonId($cate,$pid){
        $arr = array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $arr[] = $v['id'];
                $arr = array_merge($arr,self::getSonId($cate,$v['id']));
            }
        }
        return $arr;
    }

    //提供父级ID返回所以子栏目二维数组
    public static function getSon($cate,$pid){
        $arr = array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $arr[] = $v;
                $arr = array_merge($arr,self::getSon($cate,$v['id']));
            }
        }
        return $arr;
    }
    //提供父级ID返回所以子栏目多维数组
    public static function getSons($cate,$name='child',$pid){
        $arr = array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $v[$name] = self::getSons($cate,$name,$v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
}