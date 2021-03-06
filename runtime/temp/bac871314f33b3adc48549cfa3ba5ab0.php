<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\PHP\Work\qigong/application/admin\view\goods\add.html";i:1529380854;s:51:"D:\PHP\Work\qigong\application\admin\view\base.html";i:1527056892;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<title>添加产品</title>
<link rel="stylesheet" href="/public/org/webuploader-0.1.5/xb-webuploader.css">
<script type="text/javascript" src="/public/org/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/public/org//ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/org/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/admin/js/jquery.min.js"></script>
<style>
    .father {margin-bottom: 5px;}
</style>

    <link rel="stylesheet" href="/public/admin/frame/layui/css/layui.css">
    <link rel="stylesheet" href="/public/admin/css/style.css">
    <link rel="icon" href="/public/admin/image/code.png">
    <script type="text/javascript" src="/public/admin/js/jquery.min.js"></script>
</head>
<body>



<fieldset class="layui-elem-field layui-field-title">
    <legend>
        <span class="layui-breadcrumb">
            <a href="<?php echo url('admin/goods/index'); ?>">产品管理</a>
            <a><cite>添加</cite></a>
        </span>
    </legend>
    <br>
    <a href="<?php echo url('admin/goods/add'); ?>" class="layui-btn">添加产品</a>
    <a href="<?php echo url('admin/goods/index'); ?>" class="layui-btn layui-btn-normal" target="">产品列表</a>
</fieldset>

<form class="layui-form layui-form-pane" action="" method="post">
    <table class="layui-table">
        <colayui-inputroup>
            <col width="10%">
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
        <tr align="center">
            <td  align="center" colspan="3" style="height: 40px;"><b>1.产品基本信息管理</b></td>
        </tr>
        
        <tr>
            <th><i class="require">*</i>产品名称：</th>
            <td>
                <div style="float:left; width: 100%">
                    <input type="text" class="layui-input" lay-verify="required" name="goods_name" placeholder="这里输入产品名称" value="">
                </div>
                <div style="float: left;"> &nbsp;&nbsp;</div>
            </td>
            <td></td>
        </tr>
        
        <tr>
            <th height="auto"><i class="require">*</i>产品分类：</th>
            <td>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                <input type="radio" name="category_id[]" id="wc<?php echo $v->id; ?>" value="<?php echo $v->id; ?>";" lay-skin="primary" title="<?php echo $v->html; ?><?php echo $v->name; ?>">
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <!--<select name="category_id" id="">
                    <option value="">请选择分类...</option>
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
                    <option value="<?php echo $v->id; ?>"><?php echo $v->html; ?><?php echo $v->name; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>-->
                
            </td>
            <td>请至少选择一个分类</td>
        </tr>
        <tr>
            <th><i class="require">*</i>产品特色描述：</th>
            <td>
                <div style="float:left; width: 80%">
                    <input type="text" class="layui-input" lay-verify="required" name="brief2" placeholder="这里输入特色描述" value="">
                </div>
                <div style="float: left;"> &nbsp;&nbsp;</div>
            </td>
            <td></td>
        </tr>
        <tr>
            <th><i class="require">*</i>展示位：</th>
            <td>
                <div style="float:left; width: 100%">
                    <input type="radio" name="place" value="0" title="产品页展示"/>
                    <input type="radio" name="place" value="1" title="首页展示"/>
                </div>
                <div style="float: left;"> &nbsp;&nbsp;</div>
            </td>
            <td></td>
        </tr>
        <tr>
            <th><i class="require"></i>是否受欢迎：</th>
            <td>
                <div style="float:left; width: 100%">
                    <input type="radio" name="hot" value="0" title="否"/>
                    <input type="radio" name="hot" value="1" title="是"/>
                </div>
                <div style="float: left;"> &nbsp;&nbsp;</div>
            </td>
            <td></td>
        </tr>
        <tr align="center">
            <td  align="center" colspan="3" style="height: 40px;"><b>2.图片区块管理</b></td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i>产品列表页-缩略图上传：</td>
            <td>
                <div class="site-demo-upload">
                    <img id="LAY_demo_upload" src="" width="200" height="200" alt="点击下面的 上传图片">
                    <div class="site-demo-upbar">
                        <input type="file" name="file" class="layui-upload-file" id="test">
                    </div>
                </div>
                <input id="img_url" class="layui-input" lay-verify="require" type="hidden" name="img_url" value="">
            </td>
            <td></td>
        </tr>
        <tr>
            <td class="tc" width="10px"><i class="require">*</i>图片相册上传：</td>
            <td style="height: 300px;">
                <div id="upload-5916dfdf24663" class="xb-uploader" style="margin-top: 0px;">
                    <div class="queueList">
                        <div class="placeholder">
                            <div class="filePicker"></div>
                            <p>或将照片拖到这里，单次最多可选300张</p>
                        </div>
                    </div>
                    <div class="statusBar" style="display:none;">
                        <div class="progress">
                            <span class="text">0%</span>
                            <span class="percentage"></span>
                        </div>
                        <div class="info"></div>
                        <div class="btns">
                            <div class="webuploader-container filePicker2">
                                <div class="webuploader-pick">继续添加</div>
                                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                                </div>
                            </div>
                            <div class="uploadBtn">开始上传</div>
                        </div>
                    </div>
                </div>
            </td>
            <td>点击 添加图片，再点击 开始上传 按钮</td>
        </tr>

        <tr align="center">
            <td  align="center" colspan="3" style="height: 40px;"><b>3.详细图文内容管理</b></td>
        </tr>
        <tr>
            <th><i class="require">*</i>产品详细图文描述：</th>
            <td>
                <textarea title="产品详细图文描述" id="editor" name="goods_desc" style="width:100%;height:500px;" nullmsg="请输入文章内容"></textarea>
            </td>
            <td></td>
        </tr>

        <tr>
            <td colspan="3">
                <div class="layui-form-item">
                    <button class="layui-btn" lay-submit="" lay-filter="sub">立即提交</button>
                </div>
            </td>
        </tr>

        </tbody>
    </table>
</form>


<script type="text/javascript" src="/public/admin/frame/layui/layui.js"></script>


<script type="text/javascript" src="/public/org/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
    UE.getEditor('editor');
    //初始化数据
    var $, layer;
    layui.use(['form', 'layedit', 'laydate','element','upload','layer'], function () {
        var form = layui.form(), layer = layui.layer, layedit = layui.layedit
            , laydate = layui.laydate, element = layui.element();

        //自定义验证规则
        form.verify({
            require: function (value) {
                if (value.length < 1) {
                    return '必填项内容不能为空';
                }
            }
            , name: function (value) {
                if (value.length < 2) {
                    return '标题至少得2个字符啊';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , content: function (value) {
                layedit.sync(editIndex);
            }
            , zhe: [/^[1-9]0?(\.\d*)?$/, '请输入正确的折扣，如：8']
        });

        //监听提交
        form.on('submit(sub)', function (data) {
            return true;
        });

        // you code ...
        layui.upload({
            url: '<?php echo url("/admin/common/upload/type/goods"); ?>'
            , elem: '#test' //指定原始元素，默认直接查找class="layui-upload-file"
            , method: 'post' //上传接口的http类型
            , success: function (datap) {
                // var datap = JSON.parse(data); //$.parseJSON(data);
                layer.msg(datap.msg);
                if (datap.errno == 0) {
                    /*$("input[name='img_url']").val(datap.path);
                     $('#img_url_img').attr('src', datap.path);*/
                    LAY_demo_upload.src = datap.path;
                    img_url.value = datap.path;
                }
            }
        });

        //全选触发
        form.on('checkbox(all)', function (data) {
            //console.log(data.value);
            var child = $('.checkbox_all').find('input[type="checkbox"]');
            child.each((function (index, item) {
                item.checked = data.elem.checked;
            }));
            form.render('checkbox');
        });
    });
</script>

<script src="//cdn.staticfile.org/webuploader/0.1.5/webuploader.min.js"></script>
<script>
    jQuery(function() {
        var $ = jQuery,    // just in case. Make sure it's not an other libaray.
            $wrap = $("#upload-5916dfdf24663"),
            // 图片容器
            $queue = $('<ul class="filelist"></ul>')
                .appendTo( $wrap.find('.queueList') ),
            // 状态栏，包括进度和控制按钮
            $statusBar = $wrap.find('.statusBar'),
            // 文件总体选择信息。
            $info = $statusBar.find('.info'),
            // 上传按钮
            $upload = $wrap.find('.uploadBtn'),
            // 没选择文件之前的内容。
            $placeHolder = $wrap.find('.placeholder'),
            // 总体进度条
            $progress = $statusBar.find('.progress').hide(),
            // 添加的文件数量
            fileCount = 0,
            // 添加的文件总大小
            fileSize = 0,
            // 优化retina, 在retina下这个值是2
            ratio = window.devicePixelRatio || 1,
            // 缩略图大小
            thumbnailWidth = 110 * ratio,
            thumbnailHeight = 110 * ratio,
            // 可能有pedding, ready, uploading, confirm, done.
            state = 'pedding',
            // 所有文件的进度信息，key为file id
            percentages = {},
            supportTransition = (function(){
                var s = document.createElement('p').style,
                    r = 'transition' in s ||
                        'WebkitTransition' in s ||
                        'MozTransition' in s ||
                        'msTransition' in s ||
                        'OTransition' in s;
                s = null;
                return r;
            })(),
            thisSuccess,
            // WebUploader实例
            uploader;
        if ( !WebUploader.Uploader.support() ) {
            alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
            throw new Error( 'WebUploader does not support the browser you are using.' );
        }
        // 实例化
        uploader = WebUploader.create({
            pick: {
                id: "#upload-5916dfdf24663 .filePicker",
                label: '点击选择文件',
                multiple : true
            },
            dnd: "#upload-5916dfdf24663 .queueList",
            paste: document.body,
            // accept: {
            //     title: 'Images',
            //     extensions: 'gif,jpg,jpeg,bmp,png',
            //     mimeTypes: 'image/*'
            // },
            // swf文件路径
            swf: BASE_URL + '/Uploader.swf',
            disableGlobalDnd: true,
            chunked: true,
            server: '<?php echo url("/admin/common/upload/type/goods_gallery"); ?>',
            fileNumLimit: 300,
            fileSizeLimit: 200 * 1024 * 1024,    // 200 M
            fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
        });
        // 添加“添加文件”的按钮，
        uploader.addButton({
            id: "#upload-5916dfdf24663 .filePicker2",
            label: '继续添加'
        });
        // 当有文件添加进来时执行，负责view的创建
        function addFile( file ) {
            var $li = $( '<li id="' + file.id + '">' +
                    '<p class="title">' + file.name + '</p>' +
                    '<p class="imgWrap"></p>'+
                    '<p class="progress"><span></span></p>' +
                    '<input class="bjy-filename" type="hidden" name="goods_gallery[]">'+
                    '</li>' ),

                $btns = $('<div class="file-panel">' +
                    '<span class="cancel">删除</span>' +
                    '<span class="rotateRight">向右旋转</span>' +
                    '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
                $prgress = $li.find('p.progress span'),
                $wrap = $li.find( 'p.imgWrap' ),
                $info = $('<p class="error"></p>'),
                showError = function( code ) {
                    switch( code ) {
                        case 'exceed_size':
                            text = '文件大小超出';
                            break;
                        case 'interrupt':
                            text = '上传暂停';
                            break;
                        default:
                            text = '上传失败，请重试';
                            break;
                    }
                    $info.text( text ).appendTo( $li );
                };
            if ( file.getStatus() === 'invalid' ) {
                showError( file.statusText );
            } else {
                // @todo lazyload
                $wrap.text( '预览中' );
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $wrap.text( '不能预览' );
                        return;
                    }
                    var img = $('<img src="'+src+'">');
                    $wrap.empty().append( img );
                }, thumbnailWidth, thumbnailHeight );
                percentages[ file.id ] = [ file.size, 0 ];
                file.rotation = 0;
            }
            file.on('statuschange', function( cur, prev ) {
                if ( prev === 'progress' ) {
                    $prgress.hide().width(0);
                } else if ( prev === 'queued' ) {
                    $li.off( 'mouseenter mouseleave' );
                    $btns.remove();
                }
                // 成功
                if ( cur === 'error' || cur === 'invalid' ) {
                    showError( file.statusText );
                    percentages[ file.id ][ 1 ] = 1;
                } else if ( cur === 'interrupt' ) {
                    showError( 'interrupt' );
                } else if ( cur === 'queued' ) {
                    percentages[ file.id ][ 1 ] = 0;
                } else if ( cur === 'progress' ) {
                    $info.remove();
                    $prgress.css('display', 'block');
                } else if ( cur === 'complete' ) {
                    $li.append( '<span class="success"></span>' );
                }
                $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
            });
            $li.on( 'mouseenter', function() {
                $btns.stop().animate({height: 30});
            });
            $li.on( 'mouseleave', function() {
                $btns.stop().animate({height: 0});
            });
            $btns.on( 'click', 'span', function() {
                var index = $(this).index(),
                    deg;
                switch ( index ) {
                    case 0:
                        uploader.removeFile( file );
                        return;
                    case 1:
                        file.rotation += 90;
                        break;
                    case 2:
                        file.rotation -= 90;
                        break;
                }
                if ( supportTransition ) {
                    deg = 'rotate(' + file.rotation + 'deg)';
                    $wrap.css({
                        '-webkit-transform': deg,
                        '-mos-transform': deg,
                        '-o-transform': deg,
                        'transform': deg
                    });
                } else {
                    $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                }
            });
            $li.appendTo( $queue );
        }
        // 负责view的销毁
        function removeFile( file ) {
            var $li = $('#'+file.id);
            delete percentages[ file.id ];
            updateTotalProgress();
            $li.off().find('.file-panel').off().end().remove();
        }
        function updateTotalProgress() {
            var loaded = 0,
                total = 0,
                spans = $progress.children(),
                percent;
            $.each( percentages, function( k, v ) {
                total += v[ 0 ];
                loaded += v[ 0 ] * v[ 1 ];
            } );
            percent = total ? loaded / total : 0;
            spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
            spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
            updateStatus();
        }
        function updateStatus() {
            var text = '', stats;
            if ( state === 'ready' ) {
                text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
            } else if ( state === 'confirm' ) {
                stats = uploader.getStats();
                if ( stats.uploadFailNum ) {
                    text = '已成功上传' + stats.successNum+ '个文件，'+
                        stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
                }
            } else {
                stats = uploader.getStats();
                text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';
                if ( stats.uploadFailNum ) {
                    text += '，失败' + stats.uploadFailNum + '个';
                }
                if (fileCount==stats.successNum && stats.successNum!=0) {
                    $('#upload-5916dfdf24663 .webuploader-element-invisible').remove();
                }
            }
            $info.html( text );
        }
        uploader.onUploadAccept=function(object ,ret){
            if(ret.error_info){
                fileError=ret.error_info;
                return false;
            }
        }
        uploader.onUploadSuccess=function(file ,response){
            $('#'+file.id +' .bjy-filename').val(response.path)
        }
        uploader.onUploadError=function(file){
            alert(fileError);
        }
        function setState( val ) {
            var file, stats;
            if ( val === state ) {
                return;
            }
            $upload.removeClass( 'state-' + state );
            $upload.addClass( 'state-' + val );
            state = val;
            switch ( state ) {
                case 'pedding':
                    $placeHolder.removeClass( 'element-invisible' );
                    $queue.parent().removeClass('filled');
                    $queue.hide();
                    $statusBar.addClass( 'element-invisible' );
                    uploader.refresh();
                    break;
                case 'ready':
                    $placeHolder.addClass( 'element-invisible' );
                    $( "#upload-5916dfdf24663 .filePicker2" ).removeClass( 'element-invisible');
                    $queue.parent().addClass('filled');
                    $queue.show();
                    $statusBar.removeClass('element-invisible');
                    uploader.refresh();
                    break;
                case 'uploading':
                    $( "#upload-5916dfdf24663 .filePicker2" ).addClass( 'element-invisible' );
                    $progress.show();
                    $upload.text( '暂停上传' );
                    break;
                case 'paused':
                    $progress.show();
                    $upload.text( '继续上传' );
                    break;
                case 'confirm':
                    $progress.hide();
                    $upload.text( '开始上传' ).addClass( 'disabled' );
                    stats = uploader.getStats();
                    if ( stats.successNum && !stats.uploadFailNum ) {
                        setState( 'finish' );
                        return;
                    }
                    break;
                case 'finish':
                    stats = uploader.getStats();
                    if ( stats.successNum ) {

                    } else {
                        // 没有成功的图片，重设
                        state = 'done';
                        location.reload();
                    }
                    break;
            }
            updateStatus();
        }
        uploader.onUploadProgress = function( file, percentage ) {
            var $li = $('#'+file.id),
                $percent = $li.find('.progress span');
            $percent.css( 'width', percentage * 100 + '%' );
            percentages[ file.id ][ 1 ] = percentage;
            updateTotalProgress();
        };
        uploader.onFileQueued = function( file ) {
            fileCount++;
            fileSize += file.size;
            if ( fileCount === 1 ) {
                $placeHolder.addClass( 'element-invisible' );
                $statusBar.show();
            }
            addFile( file );
            setState( 'ready' );
            updateTotalProgress();
        };
        uploader.onFileDequeued = function( file ) {
            fileCount--;
            fileSize -= file.size;
            if ( !fileCount ) {
                setState( 'pedding' );
            }
            removeFile( file );
            updateTotalProgress();
        };

        uploader.on( 'all', function( type ) {
            var stats;
            switch( type ) {
                case 'uploadFinished':
                    setState( 'confirm' );
                    break;
                case 'startUpload':
                    setState( 'uploading' );
                    break;
                case 'stopUpload':
                    setState( 'paused' );
                    break;
            }
        });

        uploader.onError = function( code ) {
            alert( 'Eroor: ' + code );
        };

        $upload.on('click', function() {
            if ( $(this).hasClass( 'disabled' ) ) {
                return false;
            }
            if ( state === 'ready' ) {
                uploader.upload();
            } else if ( state === 'paused' ) {
                uploader.upload();
            } else if ( state === 'uploading' ) {
                uploader.stop();
            }
        });

        $info.on( 'click', '.retry', function() {
            uploader.retry();
        } );

        $info.on( 'click', '.ignore', function() {
            alert( 'todo' );
        } );

        $upload.addClass( 'state-' + state );
        updateTotalProgress();
    });
</script>
<script>
    var BASE_URL = '/public/org/webuploader-0.1.5';
    function del_parent(obj) {
        layer.confirm('您确定要删除这张图片吗？', {
            btn: ['确定','取消'] //按钮
        }, function() {
            layer.msg('删除成功', {icon: 1});
            $(obj).parent().remove();
        }, function(){
            //layer.msg('11', {icon: 2});
        });
    }
</script>
<script>
    function addDiv(obj) {
        var row = '<div class="father">' + $(obj).parent().html() + '</div>';
        //var row = $(obj).parent().parent().html();
        row = row.replace(/(.*)(addDiv)(.*)(\[)(\+)/i, "$1removeDiv$3$4-");
        $('.tf-father').append(row);
    }

    //删除元素
    function removeDiv(obj) {
        var i = $('.tf-father > div').length;
        if (i > 1) {
            $(obj).parent().remove();
        }
    }
</script>

</body>
</html>