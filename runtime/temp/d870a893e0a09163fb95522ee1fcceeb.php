<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"D:\PHP\Work\qigong/application/admin\view\category\index.html";i:1529376451;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>栏目列表</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>栏目列表 </legend> <br>
    <a href="<?php echo url('admin/category/add'); ?>" class="layui-btn" target="">添加栏目</a>
    <a href="<?php echo url('admin/category/index'); ?>" class="layui-btn layui-btn-normal" target="">栏目列表</a>
</fieldset>

<table class="layui-table">
    <colgroup>
        <col width="50">
        <col width="50">
        <col width="200">
        <col width="">
    </colgroup>
    <thead>
    <tr>
        <th>排序</th>
        <th>ID</th>
        <th>栏目名称</th>
        <th>链接地址</th>
        <th>样式</th>
        <!-- <th>banner图</th> -->
        
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
    <tr>
        <td class="tc" width="10px">
            <div class="layui-anim" style="width: 50px;">
                <input type="text" onchange="changeOrder(this, <?php echo $v->id; ?>);" name="ord[]" value="<?php echo $v->sort_order; ?>" class="layui-input">
            </div>
        </td>
        <td class="tc"><?php echo $v->id; ?></td>
        <td>
            <a href="#"><?php echo $v->html; ?><?php echo $v->name; ?></a>
        </td>
        <td><?php echo $v['fore_url']; ?></td>
        <td><?php echo $v['title']; ?></td>
        <!-- <td>
            <?php if(empty($v['img_url'])): ?>
                无
            <?php else: ?>
            <img src="<?php echo $v['img_url']; ?>" width="225px;" height="120px;"/>
            <?php endif; ?>
        </td> -->
        <td>
            <a href="<?php echo url('admin/category/edit', ['id' => $v->id]); ?>" class="layui-btn layui-btn-small layui-btn-normal" title="修改"><i class="layui-icon"></i>修改</a>
            <a class="layui-btn layui-btn-small layui-btn-danger" onclick="deleteAction('<?php echo $v->id; ?>')"><i class="layui-icon"></i>删除</a>
        </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>



<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
<script>
    layui.use(['layer'], function () {

    });
    function changeOrder(obj, id) {
        var order = $(obj).val();
        $.post("<?php echo url('admin/common/change_order'); ?>",{'type':'category','id':id,'order':order,'field':'sort_order'}, function (data) {
            layer.msg(data.msg);
        },'json')
    }

    function deleteAction(id) {
        //询问框
        layer.confirm('您确定要删除这个栏目吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            //发送post请求
            $.post("<?php echo url('admin/category/delete'); ?>", {_method:'DELETE','_token':'csrf_token',id:id}, function (data) {
                if(data.errno) {
                    layer.msg(data.msg, {icon: 2});
                }else {
                    layer.msg('删除成功', {icon: 1});
                    location.href=location.href;
                }
            },'json');
        }, function(){
            layer.msg('11', {icon: 2});
        });
    }
</script>

</body>
</html>