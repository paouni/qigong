<?php

namespace app\admin\controller;

use app\admin\model\Article;
use app\admin\model\Category;

class ArticleController extends CommonController
{
    public $model = null; //模型实例

    //构造方法初始化模型
    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Article();
        }
    }

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $list = $this->model->pageQuery();
        //var_dump($list);exit();
        //$list = $this->model->art_list(); //按照子分类排序好的数组
        $this->assign('list', $list);
        return $this->fetch();
    }

    /**
     * 添加文章
     * @return mixed
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('添加成功', url('admin/article/index'));
            } else {
                $this->error($rs);
            }
        } else {
            //1.取出所有的排好序的栏目
            //$list = Category::where('parent_id', '0')->order('art_order desc')->select();
            $list = (new Category())->sort_list();
            $this->assign('list', $list);
        }
        return $this->fetch();
    }

    /**
     * 编辑栏目
     * @return mixed
     */
    public function edit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //var_dump($data);exit();

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('修改成功', url('admin/article/index'));
            } else {
                $this->error($rs);
            }
        } else {
            $id = input('get.id') + 0; //编辑的id号
            if (!$id) {
                $id = request()->route('id');
                if (empty($id)) {
                    $this->redirect('admin/article/index');
                }
            }
            //根据id查询数据
            $data = $this->model->get($id);
            if (empty($data)) {
                $this->redirect('admin/article/index');
            }
            $list = (new Category())->sort_list();
            $this->assign('list', $list);
            $this->assign('data', $data);
        }
        return $this->fetch();
    }

    /**
     * 删除栏目
     * @return array
     */
    public function delete()
    {
        $id = input('post.id/d');
        $data = ['errno' => 1, 'msg' => '删除失败'];
        if ($this->model->del($id)) { //删除成功
            $data = ['errno' => 0, 'msg' => '删除成功'];
        }
        return $data;
    }

}
