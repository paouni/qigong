<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"D:\PHP\Work\qigong/application/admin\view\category\edit.html";i:1529376227;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>编辑栏目</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title">
    <legend>
        <span class="layui-breadcrumb">
            <a href="<?php echo url('admin/category/index'); ?>">栏目管理</a>
            <a><cite>修改</cite></a>
        </span>
    </legend>
    <br>
    <a href="<?php echo url('admin/category/add'); ?>" class="layui-btn" target="">添加栏目</a>
    <a href="<?php echo url('admin/category/index'); ?>" class="layui-btn layui-btn-normal" target="">栏目列表</a>
</fieldset>
<!--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>方框风格的表单集合</legend>
</fieldset>-->

<form class="layui-form layui-form-pane" action="" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">父级栏目</label>

        <div class="layui-input-block">
            <select name="parent_id" lay-filter="parent" id="parent_id">
                <option value="0">==顶级栏目==</option>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                <option value="<?php echo $v->id; ?>" <?php if($v->id == $data->parent_id): ?>selected<?php endif; ?>><?php echo $v->name; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><i class="require">*</i>栏目名称</label>

        <div class="layui-input-block">
            <input type="text" value="<?php echo $data->name; ?>" name="name" lay-verify="name" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    
    <div class="layui-form-item">
        <label class="layui-form-label" style="height:208px;"><i class="require"></i>图片轮播</label>

        <div class="layui-input-block">
            <div class="site-demo-upload">
                    <img id="LAY_demo_upload" src="<?php echo $data->img_url; ?>" width="255" height="170" alt="点击下面的 上传图片">
                    <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                    </div>
                </div>
                <input id="img_url" class="layui-input" lay-verify="" type="hidden" name="img_url" value="<?php echo $data->img_url; ?>">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><i class="require">*</i>链接地址</label>
    
        <div class="layui-input-block">
            <input type="text" value="<?php echo $data->fore_url; ?>" name="fore_url" lay-verify="require" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"><i class="require"></i>样式</label>

        <div class="layui-input-block">
            <input type="text" value="<?php echo $data->title; ?>" name="title" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <button class="layui-btn" lay-submit="" lay-filter="sub">提交</button>
    </div>
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
            url: '<?php echo url("/admin/common/upload/type/category"); ?>'
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