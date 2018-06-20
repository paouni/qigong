<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:60:"D:\PHP\Work\qigong/application/index\view\product\index.html";i:1529460571;s:57:"D:\PHP\Work\qigong\application\index\view\public\nav.html";i:1529399214;s:60:"D:\PHP\Work\qigong\application\index\view\public\footer.html";i:1528961524;}*/ ?>
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

	<section id="banner" class="news-banner"></section>

	<section id="portfolio">
		<div class="container">
			<h2 class="title">产品中心</h2>
			<ul class="portfolio-filter text-center">
				<li><a class="btn btn-default active" href="#" data-filter="*">全部</a></li>
				<?php if(is_array($proCate) || $proCate instanceof \think\Collection || $proCate instanceof \think\Paginator): if( count($proCate)==0 ) : echo "" ;else: foreach($proCate as $key=>$cv): ?>
				<li><a class="btn btn-default" href="#" data-filter=".<?php echo $cv['title']; ?>"><?php echo $cv['name']; ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul><!--/#portfolio-filter-->			
			<div class="portfolio-items clearfix">
				<?php if(is_array($product) || $product instanceof \think\Collection || $product instanceof \think\Paginator): if( count($product)==0 ) : echo "" ;else: foreach($product as $key=>$pv): ?>
				<div class="col-sm-4 portfolio-item <?php echo $pv['title']; ?>">
					<div class="view efffect">
						<div class="portfolio-image">
							<img class="img-responsive" src="<?php echo $pv['img_url']; ?>" alt="">
						</div>	
					   <div class="mask text-center">
							<h3><?php echo $pv['goods_name']; ?></h3>
							<h4><?php echo $pv['brief2']; ?></h4>
							<a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a>
							<a href="<?php echo $pv['img_url']; ?>" data-rel="prettyPhoto"><i class="fa fa-search"></i></a>
						</div>
					</div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>	
		</div>
		<div id="portfolio-single-wrap">
			<div id="portfolio-single">
	    		
	    	</div>
    	</div><!-- /# portfolio-single-wrap -->
    </section>
    <!--/#portfolio-->
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
</body>
</html>