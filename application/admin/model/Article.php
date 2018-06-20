<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    // 关闭自动写入时间戳
    //protected $autoWriteTimestamp = false;
    // 定义时间戳字段名
    //protected $createTime = 'create_time';
    //protected $updateTime = 'update_time';

    //数据完成
    protected $auto = ['update_time'];
    protected $insert = ['create_time'];
    protected $update = [];

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
        $result = $this->validate(
            [
                'category_id' => 'require|number',
                'title' => 'require|max:30',
                'thumb_url' => 'require',
                'content' => 'require',
            ],
            [
                'category_id.require' => ' 文章分类不能为空 ',
                'category_id.number' => '文章分类选择有误',
                'title.require' => ' 文章标题不能为空 ',
                'title.max' => ' 文章标题不能超过30个字符 ',
                'thumb_url.require' => ' 文章缩略图不能为空 ',
                'content.require' => ' 文章内容不能为空 ',
            ]
        )->allowField(true)->save($data, $isUpdate);
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
        $page = $this->order('id', 'desc')->paginate('10'); //input('post.pagesize/d')
        return $page;
    }

    //一对一关联模型
    public function categoryName()
    {
        return $this->hasOne('category', 'category_id');
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
     * 新增
     */
    public function add()
    {
        $data = input('post.');
        WSTUnset($data, 'id,dataFlag');
        $data["staffId"] = (int)session('WST_STAFF.staffId');
        $data['createTime'] = date('Y-m-d H:i:s');
        $result = $this->validate('Articles.add')->allowField(true)->save($data);
        if (false !== $result) {
            return WSTReturn("新增成功", 1);
        } else {
            return WSTReturn($this->getError(), -1);
        }
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $id = input('post.id/d');
        $data = input('post.');
        WSTUnset($data, 'id,dataFlag,createTime');
        $data["staffId"] = (int)session('WST_STAFF.staffId');
        $result = $this->validate('Articles.edit')->allowField(true)->save($data, ['id' => $id]);
        if (false !== $result) {
            return WSTReturn("修改成功", 1);
        } else {
            return WSTReturn($this->getError(), -1);
        }
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

    /**
     * 批量删除
     */
    public function delByBatch()
    {
        $ids = input('post.ids');
        $data = [];
        $data['dataFlag'] = -1;
        $result = $this->where(['id' => ['in', $ids]])->update($data);
        if (false !== $result) {
            return WSTReturn("删除成功", 1);
        } else {
            return WSTReturn($this->getError(), -1);
        }
    }
}