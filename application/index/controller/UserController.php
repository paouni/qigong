<?php

namespace app\index\controller;
// use app\admin\validate;
use app\admin\model\Goods;
//use app\admin\model\Lunbo;
use app\admin\model\Config;
use app\index\model\Nav;
use app\common\model\Category;
//use categoryclass\Categoryclass;
use think\Db;
use think\Validate;

class UserController extends CommonController
{
    
    public function index()
    {
        if(request()->isPost()){
            $data = input('post.');
            $check = $this->validate($data,'User');

            if($check !== true){
                $result = [
                    'state' => 0,
                    'success' => '验证失败',
                    'item' => $check,
                ];
                //以json  数据类型返回
                return json($result);
            }else{
                $data['create_time'] = time();
                $re = Db::name('user')->insert($data);
                if($re){
                    $result = [
                        'state' => 1,
                        'success' => '提交成功',
                        'item' => $re,
                    ];
                    //以json  数据类型返回
                    return json($result);
                }else{
                    $result = [
                        'state' => 2,
                        'success' => '提交失败',
                        'item' => $re,
                    ];
                }
            }
            
        }
    }
    public function mail()
    {
        if(request()->isPost()){
            $data = input('post.');
            $check = $this->validate($data,'User');
            if($check !== true){
                $result = [
                    'state' => 0,
                    'success' => '验证失败',
                    'item' => $check,
                ];
                //以json  数据类型返回
                return json($result);
            }else{
                $data['create_time'] = time();
                $re = Db::name('user')->insert($data);
                if($re){
                    $result = [
                        'state' => 1,
                        'success' => '提交成功',
                        'item' => $re,
                    ];
                    //以json  数据类型返回
                    return json($result);
                }else{
                    $result = [
                        'state' => 2,
                        'success' => '提交失败',
                        'item' => $re,
                    ];
                }
            }
            
        }
    }
    
}
