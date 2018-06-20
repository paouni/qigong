<?php

namespace app\admin\controller;

use app\admin\model\Nav;

class NavController extends CommonController
{
    public $model = null; //模型实例

    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Nav();
        }
    }

    //首页
    public function index()
    {
        $list = $this->model->sort_list(); //按照子分类排序好的数组
        // var_dump($list);exit;
        $this->assign('list', $list);
        return $this->fetch();
    }

    // 添加栏目
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            /*$result = $this->validate($data,'Category');
            if(true !== $result){
                //  验证失败 输出错误信息
                dump($result);
            }*/

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('添加成功', url('admin/nav/index'));
            } else {
                $this->error($rs);
            }
        } else {
            //1.取出所有的顶级栏目
            $list = Nav::where('parent_id', '0')->where('type', '0')->order('sort_order desc')->select();
            $this->assign('list', $list);
        }
        return $this->fetch();
    }

    // 编辑栏目
    public function edit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //var_dump($data);exit();

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('修改成功', url('admin/nav/index'));
            } else {
                $this->error($rs);
            }
        } else {
            $id = input('get.id') + 0; //编辑的id号
            if (!$id) {
                $id = request()->route('id');
                if (empty($id)) {
                    $this->redirect('admin/nav/index');
                }
            }
            //根据id查询数据
            $data = $this->model->get($id);
            if (empty($data)) {
                $this->redirect('admin/nav/index');
            }
            $list = $this->model->sort_list(); //按照子分类排序好的数组
            $this->assign('list', $list);
            $this->assign('data', $data);
        }
        return $this->fetch();
    }

    // 删除栏目
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
