<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"D:\PHP\Work\qigong/application/admin\view\index\welcome2.html";i:1526869419;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>欢迎页面</title>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>


<?php
//检测PHP设置参数
function show($varName){
	switch($result = get_cfg_var($varName)){
		case 0:
			return '<font color="red">×</font>';
            break;
        case 1:
            return '<font color="green">√</font>';
            break;
        default:
            return $result;
            break;
    }
}
?>
<div class="layui-collapse" lay-accordion="" lay-filter="collapse">
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">软件信息</h2>
        <div class="layui-colla-content layui-show">
            <table class="layui-table">
                <tr>
                    <td width="40%">软件名称</td>
                    <td width="60%">华宸科技后台管理系统</td>
                </tr>
                <tr>
                    <td>系统版本</td>
                    <td>v1.1.0</td>
                </tr>
                <tr>
                    <td>官网</td>
                    <td><a href="http://www.js-huachen.com" target="_blank">华宸科技</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">服务器信息</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td width="40%">服务器域名</td>
                    <td width="60%"><?php echo $_SERVER['SERVER_NAME'];?>
                        (<?php if('/'==DIRECTORY_SEPARATOR){echo $_SERVER['SERVER_ADDR'];}else{echo @gethostbyname($_SERVER['SERVER_NAME']);} ?>)</td>
                </tr>
                <tr>
                    <td>服务器标识</td>
                    <td colspan="3"><?php echo @php_uname(); ?></td>
                </tr>
                <tr>
                    <td>服务器操作系统</td>
                    <td><?php $os = explode(" ", php_uname()); echo $os[0];?>
                        &nbsp;内核版本：<?php if('/'==DIRECTORY_SEPARATOR){echo $os[2];}else{echo $os[1];} ?></td>
                </tr>
                <tr>
                    <td>服务器解译引擎</td>
                    <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
                </tr>
                <tr>
                    <td>服务器语言</td>
                    <td><?php echo getenv("HTTP_ACCEPT_LANGUAGE");?></td>
                </tr>
                <tr>
                    <td>服务器端口</td>
                    <td><?php echo $_SERVER['SERVER_PORT'];?></td>
                </tr>
                <tr>
                    <td>服务器主机名</td>
                    <td><?php if('/'==DIRECTORY_SEPARATOR ){echo $os[1];}else{echo $os[2];} ?></td>
                </tr>
                <tr>
                    <td>绝对路径</td>
                    <td><?php echo $_SERVER['DOCUMENT_ROOT']?str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']):str_replace('\\','/',dirname(__FILE__));?></td>
                </tr>
            </table>
        </div>
    </div>
    <!--<div class="layui-colla-item">
        <h2 class="layui-colla-title">数据库信息</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td width="40%">数据库版本</td>
                    <td width="60%"></td>
                </tr>
                <tr>
                    <td>数据库名称</td>
                    <td></td>
                </tr>
                <tr>
                    <td>数据库大小</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title">PHP相关参数</h2>
        <div class="layui-colla-content">
            <table class="layui-table">
                <tr>
                    <td>PHP版本</td>
                    <td><?php echo PHP_VERSION;?></td>
                </tr>
                <tr>
                    <td>上传文件最大限制</td>
                    <td><?php echo show("upload_max_filesize");?></td>
                </tr>
                <tr>
                    <td>脚本占用最大内存</td>
                    <td><?php echo show("memory_limit");?></td>
                </tr>
                <tr>
                    <td>POST提交最大限制</td>
                    <td><?php echo show("post_max_size");?></td>
                </tr>
            </table>
        </div>
    </div>-->
</div>



<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript">
    layui.use(['layer','element'], function () {
        var layer = layui.layer, element = layui.element();

        //监听折叠
        element.on('collapse(collapse)', function(data){
            //layer.msg('展开状态：'+ data.show);
        });

        // you code ...


    });
</script>

</body>
</html>