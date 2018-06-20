<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\Session;
use think\Validate;

class IndexController extends CommonController
{
    //首页
    public function index()
    {
        return $this->fetch();
    }

    //欢迎页面1
    public function welcome()
    {
        return $this->fetch('welcome');
    }

    public function welcome2()
    {
        return $this->fetch();
    }

    /**
     * 默认加载页
     * @return mixed
     */
    public function info()
    {
        return $this->fetch('welcome2');
    }

    /**
     * 修改密码
     * @return mixed
     */
    public function pass()
    {
        if (isset($_POST) && !empty($_POST)) {
            $rules = [
                'old_password' => 'require|max:30',
                'password' => 'require|max:30',
                'repassword' => 'require|confirm:password'
            ];
            $message = [
                'old_password.require' => '旧密码不能为空',
                'old_password.max' => '旧密码不能超过 30 个字符',
                'password.require' => '新密码不能为空',
                'password.max' => '新密码不能超过 30 个字符',
                'repassword.require' => '密码不能为空',
                'repassword.confirm' => '确认密码和新密码不一致',
            ];
            $data = input('post.');
            $validate = new Validate($rules, $message);
            if (!$validate->check($data)) { // 验证不通过
                $this->error($validate->getError());
            }

            $model = new Admin();
            $rs = $model->change_password($data['old_password'], $data['password'], $data['repassword']);
            $this->success($rs, url('admin/index/welcome2'));
        }
        return $this->fetch();
    }

    //退出方法
    public function logout()
    {
        Session::delete('uid');
        Session::delete('username');
        $this->success('退出成功', url('login/index'));
    }

    //删除缓存文件
    public function delCache()
    {
        ;
        if (delDirAndFile($file = ROOT_PATH . 'runtime')) {
            $this->success('缓存清除成功！', url('index/welcome2'));
        } else {
            $this->error('操作失败，请检查目录权限');
        }
    }
}
