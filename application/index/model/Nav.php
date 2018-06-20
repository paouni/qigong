<?php

namespace app\index\model;

use think\Model;

class Nav extends Model
{
    /**
     * 处理数据 --------  nav导航展示到前端对应 上中下 三部分
     * @param null|int $type
     * @return mixed
     */
    public function diffType($type = null)
    {
        $where = isset($type) ? ['type' => $type] : 0;
        $list = $this->where($where)->order('sort_order desc')->select();

        $data = [];
        foreach ($list as $k => $v) {
            //1.顶部导航栏
            if (0 == $v['type']) {
                $data['top'][] = $v;
            }
            //2.尾部导航栏目
            if (2 == $v['type']) {
                $data['foot'][] = $v;
            }
            //3. 中部 导航单独处理为， 父导航+子导航的 数组
            if (1 == $v['type']) {
                if ($v->parent_id == 0) {
                    $v->html = '';
                    $data['middle'][$k][] = $v;

                    foreach ($list as $kk => $vv) {
                        if ($vv['parent_id'] == $v->id) {
                            //$vv->html = '|--';
                            $data['middle'][$k][] = $vv;
                        }
                    }
                }
            }

        }

        return $data;
    }
}