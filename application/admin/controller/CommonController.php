<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class CommonController extends Controller
{
    /**
     * 验证是否登陆的公共方法
     */
    public function _initialize()
    {
        $user = \think\Session::get('uid');
        if (empty($user)) {
            $this->redirect('admin/login/index');
        }
    }

    /**
     * 排序的公共方法
     */
    public function change_order()
    {
        $request = Request::instance();//$test = $request->getInput(); //input组成的字符串
        $post_data = $request->post(); //获取所有的post数据

        $type = $post_data['type']; // category
        $field = $post_data['field'];
        $arr = array('category', 'article', 'friend', 'goods', 'user', 'config'); //定义允许的操作
        $data = array('msg' => '排序更新失败，请稍后重试！', 'status' => 1); //提示信息
        if (!in_array($type, $arr)) {
            exit(json_encode($data));
        }

        $class = '\app\admin\model\\' . ucfirst($type); //ucfirst() 函数把字符串中的首字符转换为大写

        $model = new $class;
        $new['id'] = $post_data['id'];
        $new[$field] = $post_data['order'];

        //1.注意：save方法只适合查询出数据，赋值修改$model->isUpdate()->save();
        if ($rs = $model->update($new) !== false) {
            $data = array('msg' => '排序更新成功！', 'status' => 0);
        }
        exit(json_encode($data));
    }

    /**
     * 上传图片公共类
     */
    public function upload()
    {
        //$type = isset($_GET['type']) ? trim($_GET['type']) : 'static';
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        if ($file) {
            $type = request()->route('type');
            $type = isset($type) ? trim($type) : 'static';
            // 移动到框架应用根目录/uploads/public/$type/ 目录下
            $upload_path = 'uploads/' . $type . '/';
            $info = $file->move(ROOT_PATH . $upload_path);
            if ($info) {
                // 成功上传后 获取上传信息
                //echo $info->getExtension();   输出 jpg
                //echo $info->getSaveName();    输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                //echo $info->getFilename();    输出 42a79759f284b767dfcb2a0197904287.jpg
                $name = str_replace("\\", '/', $info->getSaveName());
                $data = array('msg' => '图片上传成功', 'errno' => 0, 'path' => '/' . $upload_path . $name);
            } else {
                // 上传失败获取错误信息 echo $file->getError();
                $data = array('msg' => $file->getError(), 'errno' => 2, 'path' => '');

            }
        } else {
            $data = array('msg' => '上传失败', 'errno' => 1, 'path' => ''); //上传为空
        }
        //return $data;
        exit(json_encode($data));
    }
}
