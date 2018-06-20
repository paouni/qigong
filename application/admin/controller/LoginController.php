<?php

namespace app\admin\controller;

use app\admin\model\Admin;
//use app\org\Code;
use verify\code;
use think\Controller;
use think\Session;
use think\Validate;

class LoginController extends Controller
{
    /**
     * 后台登录首页
     * @return mixed
     */
    public function index()
    {
        $data = input('post.');
        if (isset($data) && !empty($data)) {
            $rules = [
                'username' => 'require|max:30',
                'password' => 'require'
            ];
            $message = [
                'username.require' => '用户名不能为空',
                'username.max' => '用户名不能超过 30 个字符',
                'password.require' => '密码不能为空',
            ];
            //$data = $_POST;
            $validate = new Validate($rules, $message);
            if (!$validate->check($data)) { // 验证不通过
                $this->error($validate->getError()); //return back()->with('errors', $validate->getError());
            }
            //1.检测验证码
            $model = new Admin();
            if (!$model->check_verify($_POST['code'])) {
                $this->error('验证码输入有误');
            }
            //2.检测用户名和密码
            if (!$user = $model->check_user($data['username'], $data['password'])) {
                $this->error('用户名或密码输入有误');
            }
            //3. 验证通过设置session
            Session::set('uid', $user['id']);
            Session::set('username', $user['username']);
            $this->success('登录成功', 'Index/index');
        } else {
            //return $this->fetch();
            return $this->fetch('login');
        }

    }

    /**
     * 验证码显示
     */
    public function verify()
    {
        //$code = new Code();
        $code = new code();
        $code->make();
    }
}
