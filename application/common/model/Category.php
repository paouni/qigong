<?php

namespace app\common\model;

use think\Model;

class Category extends Model
{
    // 定义时间戳字段名
    //protected $createTime = 'created_at';
    //protected $updateTime = 'updated_at';

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function cate_list()
    {
        return $this->order('sort_order desc')->select();
    }

    /**
     * 显示已经排序的栏目列表
     * @return array
     */
    public function sort_list()
    {
        $list = $this->cate_list(); //所有的栏目
        $arr = [];
        foreach ($list as $k => $v) {
            if ($v->parent_id == 0) {
                $v->html = '';
                $arr[] = $v;

                foreach ($list as $kk => $vv) {
                    if ($vv['parent_id'] == $v->id) {
                        $vv->html = '|--';
                        $arr[] = $vv;
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * 模型数据验证 -- 用于 新增和修改
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //$Category = new Category();
        $update = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(
            [
                'parent_id' => 'require|number',
                'name' => 'require|max:30',
            ],
            [
                'parent_id.require' => ' 父级栏目不能为空 ',
                'parent_id.number' => ' 父级栏目必须是数字 ',
                'name.require' => ' 栏目名称不能为空 ',
                'name.max' => ' 栏目名称不能超过30个字符 ',
            ],
            [
                'add' => ['parent_id', 'name'],
            ]
        )->save($data, $update);
        if (false === $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        return true;
    }

    /**
     * 获取指定对象
     */
    public function getById($id)
    {
        $single = $this->where(['id' => $id, 'dataFlag' => 1])->find();
        $singlec = Db::name('article_cats')->where([
            'catId' => $single['catId'],
            'dataFlag' => 1
        ])->field('catName')->find();
        $single['catName'] = $singlec['catName'];
        $single['articleContent'] = htmlspecialchars_decode($single['articleContent']);
        return $single;
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
        //$result = Category::get($id);
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
}