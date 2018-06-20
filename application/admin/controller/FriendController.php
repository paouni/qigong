<?php

namespace app\admin\controller;

use app\admin\model\Friend;
use think\Exception;

//use think\Request;
//use think\Validate;

class FriendController extends CommonController
{
    public $model = null; //模型实例

    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Friend();
        }
    }

    //首页
    public function index()
    {
        $list = $this->model->all_list(); //按照子分类排序好的数组
        $this->assign('list', $list);
        return $this->fetch();
    }

    // 添加栏目
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('添加成功', url('admin/friend/index'));
            } else {
                $this->error($rs);
            }
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
                $this->success('修改成功', url('admin/friend/index'));
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
            try {
                //根据id查询数据
                $data = $this->model->get($id);
            } catch (Exception $exception) {
                goto redirect;
            }

            //dump($data['goods_gallery']);exit();
            if (empty($data)) {
                redirect:
                $data = [];
                $this->redirect('admin/goods/index');
                end:
            }
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
