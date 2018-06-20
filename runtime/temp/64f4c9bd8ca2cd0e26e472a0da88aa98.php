<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"D:\PHP\Work\qigong/application/index\view\vedio\index.html";i:1528183841;s:57:"D:\PHP\Work\qigong\application\index\view\public\nav.html";i:1529399214;s:60:"D:\PHP\Work\qigong\application\index\view\public\footer.html";i:1528961524;}*/ ?>
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
    <link rel="stylesheet" href="//at.alicdn.com/t/font_690787_amjvltis7wg66r.css">
    <link href="/public/static/index/css/prettyPhoto.css" rel="stylesheet">
    <link href="/public/static/index/css/animate.css" rel="stylesheet">
    <link href="/public/static/index/css/presets/preset1.css" rel="stylesheet">
    <link href="/public/static/index/css/main.css" rel="stylesheet">
    <link href="/public/static/index/css/responsive.css" rel="stylesheet">
    <link id="preset" rel="stylesheet" type="text/css" href="/public/static/index/css/presets/preset1.css">
    <link rel="stylesheet" type="text/css" href="/public/static/index/css/product.css">
    <link rel="stylesheet" href="/public/static/index/css/style2.css">

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
    <img class="img-responsive" src="/public/static/index/images/videos.png">
</section>

<section id="news">
    <div class="column">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>
                        <a href="index.html">首页</a><i class="fa fa-angle-right"></i>视频中心
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container videos-list">
        <div class="row">
            <div class="ff-container clearfix">
                <input id="select-type-all" name="radio-set-1" type="radio" class="ff-selector-type-all"
                       checked="checked"/>
                <label for="select-type-all" class="ff-label-type-all">所有</label>
                <input id="select-type-1" name="radio-set-1" type="radio" class="ff-selector-type-1"/>
                <label for="select-type-1" class="ff-label-type-1">自动化解决方案</label>
                <input id="select-type-2" name="radio-set-1" type="radio" class="ff-selector-type-2"/>
                <label for="select-type-2" class="ff-label-type-2">自动化解决方案</label>
                <input id="select-type-3" name="radio-set-1" type="radio" class="ff-selector-type-3"/>
                <label for="select-type-3" class="ff-label-type-3">自动化解决方案</label>
                <div class="clr"></div>
                <ul class="ff-items clearfix">
                    <li class="ff-item-type-2 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-3 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-2 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-1 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-3 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-1 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-2 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                    <li class="ff-item-type-1 col-md-6">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="media-object pull-left" src="/public/static/index/images/shipin1.png">
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">测试测试</h3>
                                <p>测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-lg">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
            </ul>
        </nav>
    </div>
    </div>
</section>
<section id="contact-us">
    <div class="contact-bg">
        <h2>联系我们</h2>
        <div class="container">
            <div class="row phone">
                <div class="col-sm-6 phone1">
                    <p><i class="iconfont icon-dianhua"></i><span>电话</span>12345678901</p>
                </div>
                <div class="col-sm-6 phone2">
                    <p><i class="iconfont icon-dianhua"></i><span>电话</span>12345678901</p>
                </div>

            </div>
            <div class="row">
                <ul class="clearfix">
                    <li><a href="<?php echo url('index/index'); ?>">首页</a></li>
                    <?php if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li><a href="/index.php/index/<?php echo $vo['fore_url']; ?>"><?php echo $v['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    
                </ul>
            </div>

            <div class="row contact-bottom">
                <div class="adress col-sm-6">
                    <p class="location"><i class="iconfont icon-dizhi"></i>江苏省苏州市高新区永和路3号</p>
                    <p class="email"><i class="iconfont icon-youxiang1"></i>rock.gao@ind-on.com</p>
                </div>
                <div class="qrcod col-sm-6">
                    <i></i>
                    <i></i>
                </div>
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