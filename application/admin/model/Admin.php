<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
use think\Session;

class Admin extends Model
{
    // 定义时间戳字段名
    //protected $createTime = 'created_time';
    //protected $updateTime = 'updated_time';

    /**
     * 检测验证码是否正确
     * @param string $code 输入的验证码
     * @return bool
     */
    public function check_verify($code)
    {
        if (strtoupper($code) == Session::get('code')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根据用户名密码检测输入是否正确
     * @param string $username
     * @param string $password
     * @return bool|array
     */
    public function check_user($username, $password)
    {
        try {
            //1.根据用户名查询用户信息
            $user_info = $this->where('username', $username)->find();
        } catch (Exception $exception) {
            return false;
        }

        if (!$user_info || $user_info->username != $username || $user_info->password != md5(md5($password) . $user_info->salt)) {
            return false;
        }
        return $user_info;
    }

    /**
     * 修改密码操作
     * @param $old_password
     * @param $password
     * @param $new_password
     * @return string
     */
    public function change_password($old_password, $password, $new_password)
    {
        if (empty($old_password) || empty($password) || empty($new_password)) {
            return '密码不能为空';
        }

        if ($new_password != $password) {
            return '确认密码和新密码不同';
        }

        // 查询旧密码是否匹配
        $uid = Session::get('uid');
        try {
            if (!$user = $this->find($uid)) {
                return '旧密码输入有误';
            }
        } catch (Exception $exception) {
            return false;
        }

        //验证通过，修改密码
        $salt = strss(8); //1.生成秘钥
        $user->salt = $salt;
        $user->password = md5(md5($password) . $salt);
        if ($user->save() === false) {
            return '修改密码失败，请稍后重试';
        }
        return '密码修改成功';
    }
}