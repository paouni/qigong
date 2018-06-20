<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\PHP\Work\qigong/application/admin\view\user\index.html";i:1527231517;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>用户管理</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>用户管理</legend>
    <br>
    <a href="<?php echo url('admin/user/index'); ?>?is_delete=0" class="layui-btn layui-btn-normal" target="">用户列表</a>
</fieldset>

<form action="" method="post">
    <table class="layui-table">
        <thead>
        <tr>
            <th class="tc">ID</th>
            <th class="tc">姓名</th>
            <th class="tc">邮箱</th>
            <th>主题</th>
            <th>留言</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
        <tr>
            
            <td class="tc"><?php echo $v['id']; ?></td>
            <td class="tc"><?php echo $v['user_name']; ?></td>
            <td class="tc"><?php echo $v['email']; ?></td>
            <td><?php echo $v['title']; ?></td>
            <td>
                <?php echo $v['message']; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</form>



<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


</body>
</html>