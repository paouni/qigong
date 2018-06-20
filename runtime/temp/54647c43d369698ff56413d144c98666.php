<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"D:\PHP\Work\qigong/application/index\view\contact\index.html";i:1529483743;s:57:"D:\PHP\Work\qigong\application\index\view\public\nav.html";i:1529399214;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="/public/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/static/index/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/static/index/css/iconfont.css">
    <link href="/public/static/index/css/prettyPhoto.css" rel="stylesheet">
    <link href="/public/static/index/css/animate.css" rel="stylesheet">
    <link href="/public/static/index/css/presets/preset1.css" rel="stylesheet">
    <link href="/public/static/index/css/main.css" rel="stylesheet">
    <link href="/public/static/index/css/responsive.css" rel="stylesheet">
    <link id="preset" rel="stylesheet" type="text/css" href="/public/static/index/css/presets/preset1.css">
    <link rel="stylesheet" type="text/css" href="/public/static/index/css/product.css">

    <!--[if lt IE 9]>
    <script src="/public/static/index/js/html5shiv.js"></script>
    <script src="/public/static/index/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/public/static/index/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/public/static/index/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/public/static/index/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/public/static/index/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/public/static/index/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>

<div class="preloader">
    <div class="preloder-wrap">
        <div class="preloder-inner">
        </div>
    </div>
</div>
<!--/.preloader-->

﻿<header id="header">      
        <div class="navbar navbar-inverse navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="index.html">
                        <h1><img src="/public/static/index/images/presets/preset1/logo1.png" alt="logo"></h1>
                    </a>
                    
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li class="scroll active"><a href="<?php echo url('index/index'); ?>">首页</a></li>
                        <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <li class="scroll"><a href="/index.php/index/<?php echo $v['fore_url']; ?>/category_id/<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?> -->
                        <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): if( count($nav)==0 ) : echo "" ;else: foreach($nav as $key=>$v): if($v['fore_url']!= null): 
                                    $carr = explode('/',$v['fore_url']);
                                    $c = ucfirst($carr[0]);
                                    $ac = request()->controller();
                                if($ac == $c): ?>
                                <li class="scroll active"><a href="/index.php/index/<?php echo $v['fore_url']; ?>?category_id=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
                                <?php else: ?>
                                <li class="scroll"><a href="/index.php/index/<?php echo $v['fore_url']; ?>?category_id=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
                                <?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
<!--/#header-->

<section id="banner">
    <img class="img-responsive" src="<?php echo $banner; ?>">
</section>
<section id="contacts">
    <div class="container">
        <h2 class="title">
            CONTACT US
        </h2>
        <h3>联系我们</h3>
        <div id="contact-us">
            <div class="row">
                <div class="col-md-6">
                    <iframe style="width: 100%;height: 444px;" src="map.html" frameborder="0"></iframe>
                </div>
                <div class="col-md-6">
                    <div class="phone row">
                        <div class="phone1 col-sm-6">
                            <p><i class="iconfont icon-dianhua"></i><span>电话</span>12345678901</p>
                        </div>
                        <div class="phone2 col-sm-6">
                            <p><i class="iconfont icon-dianhua"></i><span>电话</span>12345678901</p>
                        </div>
                    </div>
                    <div class="adress">
                        <p class="location"><i class="iconfont icon-dizhi"></i>江苏省苏州市高新区永和路3号</p>
                    </div>
                    <div class="qrcod">
                        <i></i>
                        <i></i>
                    </div>
                </div>
            </div>
            <div class="row contact-form1">
                <form id="mailform">
                <div class="col-sm-4">
                    <input class="form-control input-lg" type="text" name="user_name" value="姓名">
                </div>
                <div class="col-sm-8">
                    <input class="form-control input-lg" type="email" name="email" value="邮箱">
                </div>
                <div class="col-sm-12">
                    <input class="form-control input-lg" type="text" name="title" value="标题">
                </div>
                <div class="col-sm-12">
                    <textarea class="form-control input-lg" rows="5" name="message">正文内容...</textarea>
                </div>
                <input class="btn btn-default center-block" type="submit" onclick="mailCheck();" value="发送">
                </form>
            </div>
            <script>
                 function mailCheck(){
                    var mailData = $("#mailform").serialize();
                    $.ajax({
                        type:"post",
                        url:"<?php echo url('index/user/mail'); ?>",
                        data:mailData,
                        
                        success:function(data){
                            /*if(data.state==0){
                                alert(data.item);
                            }else{
                                alert(data.msg);
                                console.log(data.item);
                            }*/
                            console.log(data);
                        }
                    })
                 }
                </script>
            <div class="row">
                <ul class="clearfix">
                    <li><a href="#">首页</a></li>
                    <li><a href="#">专利产品</a></li>
                    <li><a href="#">技术支持</a></li>
                    <li><a href="#">产品中心</a></li>
                    <li><a href="#">公司荣誉</a></li>
                    <li><a href="#">新闻中心</a></li>
                    <li><a href="#">视频中心</a></li>
                    <li><a href="#">联系我们</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <p>Copyright ©2018<a target="_blank" href="#"></a></p>
            </div>
            <div class="col-sm-6">
                <p class="pull-right"> 技术支持<a target="_blank" href="#">huachen</a></p>
            </div>
        </div>
    </div>
</footer>
<!--/#footer-->


<script type="text/javascript" src="/public/static/index/js/jquery.js"></script>
<script type="text/javascript" src="/public/static/index/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public/static/index/js/smoothscroll.js"></script>
<script type="text/javascript" src="/public/static/index/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="/public/static/index/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/public/static/index/js/jquery.parallax.js"></script>
<script type="text/javascript" src="/public/static/index/js/jquery.ba-dotimeout.js"></script>
<script type="text/javascript" src="/public/static/index/js/main.js"></script>
<script type="text/javascript" src="/public/static/index/js/zoomImg.js"></script>
</body>
</html>