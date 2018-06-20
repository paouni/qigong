<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    // 定义时间戳字段名
    protected $autoWriteTimestamp = false;
    //protected $createTime = 'created_at';
    //protected $updateTime = 'updated_at';

    //多对多关联模型
    public function goods()
    {
        return $this->belongsToMany('Goods', 'goods_cate');
    }

    /**
     * sort_order排序后的栏目列表
     * @return mixed
     */
    public function cate_list()
    {
        return $this->order('sort_order asc')->select();
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
                'parent_id' => 'require|number',
                'name' => 'require|max:30',
                'fore_url' => 'require',
            ],
            [
                'parent_id.require' => ' 父级栏目不能为空 ',
                'parent_id.number' => ' 父级栏目必须是数字 ',
                'name.require' => ' 栏目名称不能为空 ',
                'name.max' => ' 栏目名称不能超过30个字符 ',
                'name.require' => ' 链接地址不能为空 ',
            ],
            [
                'add' => ['parent_id', 'name','en_name'],
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