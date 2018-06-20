<?php

namespace app\admin\controller;

use app\admin\model\Config;

class ConfigController extends CommonController
{
    public $model = null; //模型实例

    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Config();
        }
    }

    //首页
    public function index()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //调用保存方法
            $rs = $this->model->save_config($data);

            if ($rs) {
                $msg = '成功';
            } else {
                $msg = '失败';
            }
            $this->success('修改' . $msg . '!', url('config/index'));
        }
        //dump(\think\Config::get('web.web_title')); //读取web下的配置文件
        //正常get，post提交显示
        $list = $this->model->html_list(); //按照子分类排序好的数组
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
                $this->success('添加成功', url('admin/config/index'));
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
            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('修改成功', url('admin/config/index'));
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
                $this->redirect('admin/config/index');
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
