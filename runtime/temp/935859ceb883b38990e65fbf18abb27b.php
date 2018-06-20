<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"D:\PHP\Work\qigong/application/admin\view\nav\add.html";i:1528179338;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>添加导航</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title">
    <legend>
        <span class="layui-breadcrumb">
            <a href="<?php echo url('admin/nav/index'); ?>">导航管理</a>
            <a><cite>添加</cite></a>
        </span>
    </legend>
    <br>
    <a href="<?php echo url('admin/nav/add'); ?>" class="layui-btn" target="">添加导航</a>
    <a href="<?php echo url('admin/nav/index'); ?>" class="layui-btn layui-btn-normal" target="">导航列表</a>
</fieldset>
<!--<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>方框风格的表单集合</legend>
</fieldset>-->

<form class="layui-form layui-form-pane" action="" method="post">
    <table class="layui-table">
        <colayui-inputroup>
            <col width="8%">
            <col width="60%">
            <col width="20%">
        </colayui-inputroup>
        <thead>
        <tr>
            <th class="tc">名称</th>
            <th class="tc">输入内容</th>
            <th class="tc">描述</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i>父级导航：</td>
            <td>
                <select name="parent_id" lay-filter="parent" id="parent_id">
                    <option value="0">==顶级导航==</option>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                    <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i>导航名称：</td>
            <td>
                <input type="text" value="" name="name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </td>
            <td></td>
        </tr>
      
        <tr>
            <td class="tc" width="10px"><i class="require"></i>链接地址：</td>
            <td>
                <input type="text" value="" name="fore_url" lay-verify="" placeholder="请输入链接地址" autocomplete="off" class="layui-input">
            </td>
            <td></td>
        </tr>

        <tr>
            <td class="tc" width="10px">banner图上传：</td>
            <td>
                <div class="site-demo-upload">
                    <img id="LAY_demo_upload" src="" width="255" height="170" alt="点击下面的 上传图片">
                    <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                    </div>
                </div>
                <input id="img_url" class="layui-input" lay-verify="" type="hidden" name="img_url" value="">
            </td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require"></i>标题：</td>
            <td>
                <input type="text" value="" name="title" lay-verify="" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require"></i>描述：</td>
            <td>
                <input type="text" value="" name="content" lay-verify="" placeholder="请输入描述内容" autocomplete="off" class="layui-input">
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i>请选择导航位置：</td>
            <td>
                <select name="type">
                    <option value="0">顶部</option>
                    <option value="1">中部</option>
                    <option value="2">底部</option>
                </select>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <div class="layui-form-item">
        <button class="layui-btn" lay-submit="" lay-filter="sub">立即提交</button>
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
            url: '<?php echo url("/admin/common/upload/type/nav"); ?>'
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