<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    // 更新自动完成列表
    //protected $auto = ['password'];

    public function setPasswordAttr($value, $data)
    {
        return md5(md5($data['repassword']) . $data['salt']);
    }

    /**
     * 列表
     * @return mixed
     */
    public function _list()
    {
        return $this->order('id desc')->select();
    }

    /**
     * 注册用户时，先判断用户注册信息
     * @param $data
     * @return bool|string
     */
    public function bindUser($data)
    {
        $user_id = decode(cookie('user')); //用户的id号
        $data['id'] = $user_id;
        $data['salt'] = strss();

        //1.先查询数据库中是否已经存在该手机号
        $user_info = $this->where(['user_name' => $data['user_name']])->find();
        if ($user_info) {
            return '手机号码已经注册，请直接登录';
        }
        //2. 根据主键id查询本机cookie是否已经绑定手机号提醒
        $user = $this->where(['id' => $user_id])->column('user_name');

        if (!isset($user[0])) {
            // 1.直接注册的用户
            unset($data['id']);
        } else {
            if (!isMobile($phone = $this->where(['id' => $user_id])->column('user_name')[0])) {
                //return '本机已经保存手机号：'.$phone.',如需注册用户，请换用其它浏览器';
                $data['id'] = $user_id; // 本地cookie还未绑定手机号
            }
        }

        return $this->data_verify($data);
    }

    /**
     * 模型数据验证 -- 用于 新增和修改
     * @param $data
     * @return bool|string
     */
    public function data_verify($data)
    {
        $isUpdate = isset($data['id']) ? ['id' => $data['id']] : []; //是否更新操作
        $result = $this->validate(true)->allowField(true)->save($data, $isUpdate);
        if (false === $result) {
            //  验证失败 输出错误信息
            $error = $this->getError();
            if (is_array($error)) {
                return $error[key($error)];
            } else {
                return $error;
            }
        }
        cookie('user', encode($this->id), 3600 * 24 * 90);
        cookie('phone', encode($this->user_name), 3600 * 24 * 90);
        return true;
    }

    /**
     * 登录用户的操作
     */
    public function check_verify($code)
    {
        if (strtoupper($code) == \think\Session::get('code')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根据用户名密码检测输入是否正确
     * @param $username
     * @param $password
     * @return bool|array
     */
    public function check_user($username, $password)
    {
        //1.根据用户名查询用户信息
        $user_info = $this->where('user_name', $username)->find();

        if (!$user_info || $user_info['user_name'] != $username || $user_info['password'] != md5(md5($password) . $user_info['salt'])) {
            return false;
        }
        return $user_info;
    }

    /**
     * 获取指定对象
     */
    public function getById($id, $field = '*')
    {
        return $this->where(['id' => $id])->field($field)->find();
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
}