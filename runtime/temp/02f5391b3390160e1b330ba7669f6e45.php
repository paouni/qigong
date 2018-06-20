<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\PHP\Work\qigong/application/admin\view\goods\index.html";i:1529380956;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>产品管理</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>产品管理</legend>
    <br>
    <a href="<?php echo url('admin/goods/add'); ?>" class="layui-btn">添加产品</a>
    <a href="<?php echo url('admin/goods/index'); ?>?is_delete=0" class="layui-btn layui-btn-normal" target="">产品列表</a>
    <a href="<?php echo url('admin/goods/index'); ?>?is_delete=1" class="layui-btn layui-btn-normal" target="">下架产品列表</a>
</fieldset>

<form action="" method="post">
    <table class="layui-table">
        <thead>
        <tr>
            <th class="tc">排序</th>
            <th class="tc">ID</th>
            <th class="tc">产品名称</th>            
            <th>产品特色</th>
            <th>产品分类</th>
            <th>展示位</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
        <tr>
            <td class="tc">
                <div class="layui-anim" style="width: 50px;">
                    <input type="text" onchange="changeOrder(this, <?php echo $v['id']; ?>);" name="ord[]" value="<?php echo $v['sort_order']; ?>" class="layui-input">
                </div>
            </td>
            <td class="tc"><?php echo $v['id']; ?></td>
            <td class="tc"><?php echo $v['goods_name']; ?></td>
            <td class="tc"><?php echo $v['brief2']; ?></td>
            <td class="tc"><?php echo $v['category_name']; ?></td>
            <td class="tc">
                <?php switch($v['place']): case "0": ?>产品页展示<?php break; case "1": ?>首页展示<?php break; default: ?>产品页展示
                <?php endswitch; ?>
            </td>
            <td>
                <a class="layui-btn <?php if($v['is_delete'] == 0): ?>layui-btn-warm<?php endif; ?> layui-btn-small" onclick="downAction('<?php echo $v['id']; ?>','<?php echo $v['is_delete']; ?>')"><?php if($v['is_delete']): ?>上架<?php else: ?>下架<?php endif; ?></a>

                <a href="<?php echo url('/admin/goods/edit', ['id' => $v['id']]); ?>"
                   class="layui-btn layui-btn-small layui-btn-normal" title="修改"><i class="layui-icon"></i>修改</a>
                <a class="layui-btn layui-btn-small layui-btn-danger" onclick="deleteAction('<?php echo $v['id']; ?>')"><i
                        class="layui-icon"></i>删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td colspan="7">
                <div id="pages"></div>
            </td>
        </tr>
        </tbody>
    </table>
</form>



<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
<script>
   layui.use(['form', 'layedit', 'laydate','element','laypage'], function () {
        var form = layui.form(), $ = layui.jquery,laypage = layui.laypage;
        laypage({
            cont: 'pages'
            ,curr: '<?php echo $page['currentPage']; ?>'  //当前页
            ,pages: '<?php echo $page['pageCount']; ?>'  //总页数
            ,skip: true
            ,jump: function(obj, first){
            if(!first){
                //layer.msg('第 '+ obj.curr +' 页');
                location.href="<?php echo url('goods/index'); ?>?page="+obj.curr;
            }
        }
        });
        //监听提交
        form.on('submit(sub)', function (data) {
            return true;
        });

    });
    function changeOrder(obj, id) {
        var order = $(obj).val();
        $.post("<?php echo url('admin/common/change_order'); ?>", {
            'type': 'category',
            'id': id,
            'order': order,
            'field': 'sort_order'
        }, function (data) {
            layer.msg(data.msg);
        }, 'json')
    }
    function downAction(id, $is_delete) {
        if ($is_delete === '1') {
            var msg = '上'; var del = 0;
        }else {
            var msg = '下'; var del = 1;
        }
        layer.confirm('您确定要'+msg+'架这个产品吗？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            //发送post请求
            $.post("<?php echo url('admin/goods/down'); ?>", {
                _method: 'DELETE',
                '_token': 'csrf_token',
                id: id,
                is_delete: del
            }, function (data) {
                if (data.errno) {
                    layer.msg(data.msg, {icon: 2});
                } else {
                    layer.msg(msg + '架成功', {icon: 1});
                    location.href = location.href;
                }
            }, 'json');
        }, function () {
            //layer.msg('11', {icon: 2});
        });
    }

    function deleteAction(id) {
        //询问框
        layer.confirm('您确定要删除这个产品吗？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            //发送post请求
            $.post("<?php echo url('admin/goods/delete'); ?>", {
                _method: 'DELETE',
                '_token': 'csrf_token',
                id: id
            }, function (data) {
                if (data.errno) {
                    layer.msg(data.msg, {icon: 2});
                } else {
                    layer.msg('删除成功', {icon: 1});
                    location.href = location.href;
                }
            }, 'json');
        }, function () {
            //layer.msg('11', {icon: 2});
        });
    }
</script>

</body>
</html>