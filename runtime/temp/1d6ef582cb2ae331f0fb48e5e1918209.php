<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\PHP\Work\qigong/application/admin\view\lunbo\add.html";i:1528944669;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>添加<?php echo $name; ?>轮播</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title">
    <legend>
        <span class="layui-breadcrumb">
            <a href="<?php echo url('admin/lunbo/index'); ?>"><?php echo $name; ?>轮播管理</a>
            <a><cite>添加</cite></a>
        </span>
    </legend>
    <br>
    <a href="<?php echo url('admin/lunbo/add', ['type' => request()->route('type')]); ?>" class="layui-btn">添加<?php echo $name; ?>轮播</a>
    <a href="<?php echo url('admin/lunbo/index', ['type' => request()->route('type')]); ?>" class="layui-btn layui-btn-normal" target=""><?php echo $name; ?>轮播列表</a>
</fieldset>
<!--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>方框风格的表单集合</legend>
</fieldset>-->

<form class="layui-form layui-form-pane" action="" method="post">
    <table class="layui-table">
        <colayui-inputroup>
            <col width="10%">
            <col width="80%">
        </colayui-inputroup>
        <thead>
        <tr>
            <th class="tc">名称</th>
            <th class="tc">值</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i><?php echo $name; ?>轮播图上传：</td>
            <td>
                <div class="site-demo-upload">
                    <img id="LAY_demo_upload" src="" width="255" height="170" alt="点击下面的 上传图片">
                    <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                    </div>
                </div>
                <input id="img_url" class="layui-input" lay-verify="require" type="hidden" name="img_url" value="">
            </td>
        </tr>
        <tr>
            <th><i class="require"></i><?php echo $name; ?>轮播图链接地址：</th>
            <td>
                <div style="float:left; width: 30%">
                    <input type="text" class="layui-input" lay-verify="" name="href" placeholder="如：www.baidu.com" value="">
                </div>
                <div style="float: left;"> &nbsp;&nbsp;</div>
            </td>
        </tr>

        <tr>
            <th><i class="require"></i><?php echo $name; ?>轮播描述：</th>
            <td>
                <input type="text" class="layui-input" lay-verify="" name="tips" placeholder="这里输入描述" value="">
                <span></span>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="layui-form-item">
                    <button class="layui-btn" lay-submit="" lay-filter="sub">立即提交</button>
                </div>
            </td>
        </tr>

        </tbody>
    </table>
</form>


<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript">
    layui.use(['form', 'layedit', 'laydate','element','upload','layer'], function () {
        var form = layui.form(), layer = layui.layer, layedit = layui.layedit
            ,laydate = layui.laydate, element = layui.element();

        //创建一个编辑器
        var editIndex = layedit.build('LAY_demo_editor');

        //自定义验证规则
        form.verify({
            require: function (value) {
                if (value.length < 1){
                    return '必填项内容不能为空';
                }
            }
            ,name: function (value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , content: function (value) {
                layedit.sync(editIndex);
            }
        });

        //监听提交
        form.on('submit(sub)', function (data) {
            /*layer.alert(JSON.stringify(data.field), {
             title: '最终的提交信息'
             });*/
            return true;
        });

        // you code ...
        layui.upload({
            url: '<?php echo url("/admin/common/upload/type/lunbo"); ?>'
            ,elem: '#test' //指定原始元素，默认直接查找class="layui-upload-file"
            ,method: 'post' //上传接口的http类型
            ,success: function(datap){
                //var datap = JSON.parse(data); //$.parseJSON(data);
                layer.msg(datap.msg);
                if(datap.errno == 0) {
                    /*$("input[name='img_url']").val(datap.path);
                     $('#img_url_img').attr('src', datap.path);*/
                    LAY_demo_upload.src = datap.path;
                    img_url.value = datap.path;
                }
            }
        });
    });
</script>

</body>
</html>