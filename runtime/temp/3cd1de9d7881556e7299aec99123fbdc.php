<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\PHP\Work\qigong/application/admin\view\index\index.html";i:1528943363;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <title>首页</title>
    
    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>


<!-- admin -->
<div class="layui-layout layui-layout-admin"> <!-- 添加skin-1类可手动修改主题为纯白，添加skin-2类可手动修改主题为蓝白 -->
    <!-- header -->
    <div class="layui-header my-header">
        <a href="index.html">
            <!--<img class="my-header-logo" src="" alt="logo">-->
            <div class="my-header-logo">后台管理页面</div>
        </a>
        <div class="my-header-btn">
            <button class="layui-btn layui-btn-small btn-nav"><i class="layui-icon">&#xe620;</i></button>
        </div>
        <ul class="layui-nav my-header-user-nav" lay-filter="side-right">
            <li class="layui-nav-item"><a href="/" class="" target="_blank">前台首页</a></li>
            <li class="layui-nav-item">
                <a class="name" href="javascript:;"><i class="layui-icon">&#xe629;</i>主题</a>
                <dl class="layui-nav-child">
                    <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                    <dd data-skin="1"><a href="javascript:;">纯白</a></dd>
                    <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a class="name" href="javascript:;"><img src="/public/admin/image/code.png" alt="logo"> admin </a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" href-url="" onclick="delcache();"><i class="layui-icon">&#xe621;</i>清除缓存</a></dd>
                    <dd><a href="javascript:;" href-url="<?php echo url('admin/index/pass'); ?>"><i class="layui-icon">&#xe621;</i>修改密码</a></dd>
                    <!--<dd><a href="javascript:;" href-url="demo/map.html"><i class="layui-icon">&#xe621;</i>图表</a></dd>-->
                    <dd><a href="<?php echo url('admin/index/logout'); ?>"><i class="layui-icon">&#x1006;</i>退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <!-- side -->
    <div class="layui-side my-side">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree" lay-filter="side">
                <!-- <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;"><i class="layui-icon">&#xe616;</i>订单管理</a>
                    <dl class="layui-nav-child">
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('order/index'); ?>"><i class="layui-icon">&#xe621;</i>订单列表</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('order/refund'); ?>"><i class="layui-icon">&#xe621;</i>退款申请</a></dd>
                    </dl>
                </li> -->
                <li class="layui-nav-item layui-nav-itemed"><!-- 去除 layui-nav-itemed 即可关闭展开 -->
                    <a href="javascript:;"><i class="layui-icon">&#xe614;</i>快捷管理</a>
                    <dl class="layui-nav-child">
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('goods/index'); ?>?is_delete=0"><i class="layui-icon">&#xe61e;</i>产品管理</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('config/index'); ?>"><i class="layui-icon">&#xe621;</i>系统配置</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('nav/index'); ?>"><i class="layui-icon">&#xe621;</i>导航管理</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('category/index'); ?>"><i class="layui-icon">&#xe621;</i>产品栏目管理</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('lunbo/index'); ?>"><i class="layui-icon">&#xe639;</i>PC Banner</a></dd>
                        <!-- <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('lunbo/index',['type'=>1]); ?>"><i class="layui-icon">&#xe628;</i>手机 Banner</a></dd> -->
                        <!-- <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('lunbo/index',['type'=>2]); ?>"><i class="layui-icon">&#xe628;</i>底部轮播</a></dd> -->
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('lunbo/index',['type'=>1]); ?>"><i class="layui-icon">&#xe628;</i>首页轮播</a></dd>
                        <dd class="layui-nav-item"><a href="javascript:;" href-url="<?php echo url('user/index'); ?>"><i class="layui-icon">&#xe61e;</i>用户留言</a></dd>
                        
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- body -->
    <div class="layui-body my-body">
        <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="0"><span>欢迎页</span></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe id="iframe" src="<?php echo url('index/welcome2'); ?>" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="layui-footer my-footer">
        <br>
        <p>2017 © copyright <a href="http://www.js-huachen.com" target="_blank">华宸科技-后台管理系统</a></p>
    </div>
</div>


<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript" src="/public/admin/js/index.js"></script>

</body>
</html>