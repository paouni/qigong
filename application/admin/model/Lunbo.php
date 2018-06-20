<?php

namespace app\admin\model;

use think\Model;

class Lunbo extends Model
{
    //关闭时间戳
    protected $autoWriteTimestamp = false;

    /**
     * 显示列表
     * @param null $type
     * @return false|\PDOStatement|string|\think\Collection
     */
    public function _list($type = null)
    {
        $where = isset($type) ? ['type' => $type] : 1;
        return $this->order('sort_order desc')->where($where)->select();
    }

    /**
     * 模型数据验证
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        //$Category = new Category();
        $update = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(
            [
                'img_url' => 'require|max:255',
            ],
            [
                'img_url.require' => '图片地址不能为空',
                'img_url.max' => ' 图片地址长度不能超过255 ',
            ]
        )->allowField(true)->save($data, $update);
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
     * 分页
     */
    public function pageQuery()
    {
        $key = input('get.key');
        $where = [];
        $where['a.dataFlag'] = 1;
        if ($key != '') {
            $where['a.articleTitle'] = ['like', '%' . $key . '%'];
        }
        $page = Db::name('articles')->alias('a')
            ->join('__ARTICLE_CATS__ ac', 'a.catId= ac.catId', 'left')
            ->join('__STAFFS__ s', 'a.staffId= s.staffId', 'left')
            ->where($where)
            ->field('a.id,a.catId,a.articleTitle,a.isShow,a.articleContent,a.articleKey,a.createTime,ac.catName,s.staffName')
            ->order('a.id', 'desc')
            ->paginate(input('post.pagesize/d'))->toArray();
        if (count($page['Rows']) > 0) {
            foreach ($page['Rows'] as $key => $v) {
                $page['Rows'][$key]['articleContent'] = strip_tags(htmlspecialchars_decode($v['articleContent']));
            }
        }
        return $page;
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