<?php

namespace app\admin\controller;

use app\admin\model\Lunbo;

class LunboController extends CommonController
{
    public $model = null; //模型实例

    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Lunbo();
        }
    }

    //首页
    public function index($type = 1)
    {
        if (!in_array($type, ['0', '1', '2', '3'])) {
            $type = 0;
        }
        $list = $this->model->_list($type); //查询列表

        $this->assign('list', $list);
        $this->assign('name', $this->typeToName($type));
        return $this->fetch();
    }

    // 添加轮播图
    public function add($type = 1)
    {
        if (request()->isPost()) {
            $data = input('post.');
            $data['type'] = $type;
            $rs = $this->model->data_verify($data);
            
            if ($rs === true) {
                $this->success('添加成功', url('admin/lunbo/index'));
            } else {
                $this->error($rs);
            }
        }
        $this->assign('name', $this->typeToName($type));
        return $this->fetch();
    }

    // 编辑轮播图
    public function edit($type = 1)
    {
        if (request()->isPost()) {
            $data = input('post.');
            //var_dump($data);exit();

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $url = url('admin/lunbo/index', ['type' => $data['type']]);
                $this->success('修改成功', url('admin/lunbo/index', ['type' => $data['type']]));
            } else {
                $this->error($rs);
            }
        } else {
            $id = input('get.id') + 0; //编辑的id号
            if (!$id) {
                $id = request()->route('id');
                if (empty($id)) {
                    $this->redirect('admin/lunbo/index');
                }
            }
            //根据id查询数据
            $data = $this->model->get($id);
            if (empty($data)) {
                $this->redirect('admin/lunbo/index');
            }
            $this->assign('data', $data);
        }
        $this->assign('name', $this->typeToName($type));
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

    /**
     * 根据类型转换对应的名称
     * @param int $type
     * @return string
     */
    public function typeToName($type = 0)
    {
        switch ($type) {
            case 1:
                $name = '首页';
                break;
            case 2:
                $name = '底部';
                break;
            case 3:
                $name = '中部';
                break;
            default:
                $name = 'PC';
        }
        return $name;
    }

}
