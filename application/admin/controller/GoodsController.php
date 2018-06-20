<?php

namespace app\admin\controller;
//use app\common\model\Goods;
use app\admin\model\Goods;
use app\admin\model\Category;
use think\Exception;

class GoodsController extends CommonController
{
    public $model = null; //模型实例

    //构造方法初始化模型
    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Goods();
        }
    }

    //首页
    public function index()
    {
        $where = '';
        if (($del = input('get.is_delete')) !== null) {
            $where = ['is_delete' => $del];
        }
        $list = $this->model->pageQuery(10,$where);
        //var_dump($list);exit();
        //$list = $this->model->art_list(); //按照子分类排序好的数组
        $this->assign([
            'list' => $list['results'],
            'page' => $list['page'],
        ]);
        return $this->fetch();
    }

    // 添加产品
    public function add()
    {
        $this->assign('data', ['image' => []]);
        if (request()->isPost()) {
            $data = input('post.');
            // var_dump($data);exit;
            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('添加成功', url('admin/goods/index'));
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

    // 编辑栏目
    public function edit()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //var_dump($data);exit();

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('修改成功', url('admin/goods/index'));
            } else {
                $this->error($rs);
            }
        } else {
            $id = input('get.id') + 0; //编辑的id号
            if (!$id) {
                $id = request()->route('id');
                if (empty($id)) {
                    $this->redirect('admin/goods/index');
                }
            }
            try {
                //根据id查询数据
                $data = $this->model->get($id);
            } catch (Exception $exception) {
                goto redirect;
            }
            //dump($data);exit;
            //dump($data['goods_gallery']);exit();
            if (empty($data)) {
                redirect:
                $data = [];
                $this->redirect('admin/goods/index');
                end:
            }

            $list = (new Category())->sort_list();
            $this->assign('list', $list);
            $this->assign('data', $data);
        }
        return $this->fetch();
    }

    //上下架产品的操作
    public function down()
    {
        $id = input('post.id/d');
        $del = input('post.is_delete/d');
        $data = ['errno' => 1, 'msg' => '操作失败,请稍后重试'];
        try {
            if ($rs = \think\Db::name('goods')->where(['id' => $id])->update(['is_delete' => $del])) { //成功
                $data = ['errno' => 0, 'msg' => '操作成功'];
            }
        } catch (Exception $e) {
            $data = ['errno' => 1, 'msg' => '操作失败，请稍后重试！'];
        }

        return $data;
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

    public function test()
    {
        $this->assign('data', ['image' => []]);
        if (request()->isPost()) {
            $data = input('post.');
            dump(date('w', strtotime('2017-8-6')));
            dump($data);
            exit();

            $rs = $this->model->data_verify($data);
            if ($rs === true) {
                $this->success('添加成功', url('admin/goods/index'));
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
}
