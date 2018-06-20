<?php

namespace app\admin\controller;

use think\Db;

class UserController extends CommonController
{
    //首页
    public function index()
    {
        $list = Db::name('user')->select();
        $this->assign('list', $list);
        return $this->fetch();
    }
    

}
