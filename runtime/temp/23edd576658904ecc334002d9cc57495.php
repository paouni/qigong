<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"D:\PHP\Work\qigong/application/index\view\index\index.html";i:1529401751;s:57:"D:\PHP\Work\qigong\application\index\view\public\nav.html";i:1529399214;s:66:"D:\PHP\Work\qigong\application\index\view\public\footer_index.html";i:1528181832;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>启动工业4.0</title>
    <link href="/public/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/static/index/css/font-awesome.min.css" rel="stylesheet">
    <link href="/public/static/index/css/prettyPhoto.css" rel="stylesheet"> 
    <link href="/public/static/index/css/animate.css" rel="stylesheet"> 
	<link href="/public/static/index/css/presets/preset1.css" rel="stylesheet">
	<link href="/public/static/index/css/main.css" rel="stylesheet">
	<link href="/public/static/index/css/responsive.css" rel="stylesheet">
	<link id="preset" rel="stylesheet" type="text/css" href="/public/static/index/css/presets/preset1.css">

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

    <section id="home">	    
		<div id="home-carousel" class="carousel slide" data-interval="false">
		  	<ol class="carousel-indicators">
				<li data-target="#home-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home-carousel" data-slide-to="1"></li>
				<li data-target="#home-carousel" data-slide-to="2"></li>
			</ol>
			<!--/.carousel-indicators-->

		  	<div class="carousel-inner">

				<div class="item active">
					<!-- <video autoplay loop muted>
						<source src="http://demo.themeum.com/html/enter/video/video.webm" type="video/webm">
						<source src="http://demo.themeum.com/html/enter/video/video.mp4" type="video/mp4">
					</video> -->
					<div class="carousel-caption">
						<div>
							<h2 class="heading animated bounceInRight">启动工业</h2>
							<h2 class="heading animated bounceInRight">4.0</h2>
							<a class="btn btn-default btn-transparent animated bounceInUp" href="#">MORE</a>
						</div>
					</div>
			    </div>		  		
				<?php if(is_array($lunbo) || $lunbo instanceof \think\Collection || $lunbo instanceof \think\Paginator): $i = 0; $__LIST__ = $lunbo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lv): $mod = ($i % 2 );++$i;?>
		  		<div class="item" style="background-image: url(<?php echo $lv['img_url']; ?>)">				   
				    <div class="carousel-caption">
					    <div>
							<h2 class="heading animated bounceInRight">启动工业</h2>
							<h2 class="heading animated bounceInRight">4.0</h2>
							<a class="btn btn-default btn-transparent animated bounceInUp" href="#">MORE</a>
					    </div>
				    </div>
			    </div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			    
			</div>
			<!--/.carousel-inner-->

			<a class="carousel-left member-carousel-control hidden-xs" href="#home-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-right member-carousel-control hidden-xs" href="#home-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
    </section>
	<!--/#home-->

	<section id="about-us" class="container-fluid">
		<div class="row">
			<div class="features">
				<div class="col-sm-7">
					<div class="tab-content">
						<div class="tab-pane active" id="creative">
							<div id="community-carousel" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ul class="carousel-indicators">
							  	<?php for($i=0;$i<$count;$i++){?>
								<li data-target="#community-carousel" data-slide-to="<?php echo $i;?>" <?php if($i==0){?>class="active"><?php }?></li>
								<?php }?>
								
							  </ul>

							  <!-- Wrapper for slides -->
								<div class="carousel-inner">
									<?php if(is_array($patent) || $patent instanceof \think\Collection || $patent instanceof \think\Paginator): if( count($patent)==0 ) : echo "" ;else: foreach($patent as $k=>$pv): if($k == 0): ?>
									<div class="item active" style="background-image: url(<?php echo $pv['img_url']; ?>)"></div>
									<?php else: ?>
									<div class="item" style="background-image: url(<?php echo $pv['img_url']; ?>)"></div>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<ul class="nav features-nav">
						<?php if(is_array($patent) || $patent instanceof \think\Collection || $patent instanceof \think\Paginator): if( count($patent)==0 ) : echo "" ;else: foreach($patent as $k=>$pv): ?>						
						<li <?php if($k == 0){?>class="active"<?php }?> data-target="#community-carousel" data-slide-to="<?php echo $k; ?>">
							<div class="vertical-middle">
								<div>
									<div class="media">
										<div class="pull-left">
											<i class="fa media-object"></i>
										</div>							 
										<div class="media-body media-content">
											<h3 class="media-heading"><?php echo $pv['goods_name']; ?></h3>
											<p><?php echo $pv['brief2']; ?></p>
										</div>
									</div>	
								</div>
							</div>				
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					  
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!--/#about-us-->
	
	<section id="services" class="parallax-section">
		<h2 class="title">技术支持</h2>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="service-items">
						<div class="services row">
							<?php if(is_array($support) || $support instanceof \think\Collection || $support instanceof \think\Paginator): if( count($support)==0 ) : echo "" ;else: foreach($support as $key=>$sv): ?>
							<div class="col-sm-6">
								<div class="media service-media">
									<img src="<?php echo $sv['img_url']; ?>" class="pull-left" alt="" />
									<div class="media-body">
										<h3 class="media-heading"><?php echo $sv['goods_name']; ?></h3>
										<p><?php echo $sv['brief2']; ?></p>
									</div>
								</div>	
							</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>

						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
	<!--/#service-->
    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >企业网站模板</a></div>

	<section id="portfolio">
		<div class="container">
			<h2 class="title">产品中心</h2>
			<ul class="portfolio-filter text-center">
				<li><a class="btn btn-default active" href="#" data-filter="*">全部</a></li>
				<?php if(is_array($proCate) || $proCate instanceof \think\Collection || $proCate instanceof \think\Paginator): if( count($proCate)==0 ) : echo "" ;else: foreach($proCate as $key=>$cv): ?>
				<li><a class="btn btn-default" href="#" data-filter=".<?php echo $cv['title']; ?>"><?php echo $cv['name']; ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				<!-- <li><a class="btn btn-default" href="#" data-filter=".web">汽动马达</a></li>
				<li><a class="btn btn-default" href="#" data-filter=".vimeo">电主轴</a></li>
				<li><a class="btn btn-default" href="#" data-filter=".youtube">伺服动力头</a></li>
				<li><a class="btn btn-default" href="#" data-filter=".graphics">打磨工具</a></li> -->
			</ul><!--/#portfolio-filter-->			
			<div class="portfolio-items">
				<?php if(is_array($product) || $product instanceof \think\Collection || $product instanceof \think\Paginator): if( count($product)==0 ) : echo "" ;else: foreach($product as $key=>$pv): ?>
				<div class="col-sm-3 portfolio-item <?php echo $pv['title']; ?>">
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
	
	<section id="promotion" class="parallax-section"></section>
	<!--/#promotion-->
	
	<section id="our-team">
		<div class="container">
			<h2 class="title">企业荣誉</h2>
			<div id="team-member-carousel" class="carousel slide scale" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<?php if(is_array($gloryP) || $gloryP instanceof \think\Collection || $gloryP instanceof \think\Paginator): if( count($gloryP)==0 ) : echo "" ;else: foreach($gloryP as $key=>$gv): ?>
						<div class="col-xs-6 col-sm-3">
							<div class="team-member text-center">
								<img class="img-responsive" src="<?php echo $gv['img_url']; ?>" alt="" />
								<h3><?php echo $gv['goods_name']; ?></h3>

							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
									
					</div>
					<div class="item">
						<?php if(is_array($gloryN) || $gloryN instanceof \think\Collection || $gloryN instanceof \think\Paginator): if( count($gloryN)==0 ) : echo "" ;else: foreach($gloryN as $key=>$gv): ?>
						<div class="col-xs-6 col-sm-3">
							<div class="team-member text-center">
								<img class="img-responsive" src="<?php echo $gv['img_url']; ?>" alt="" />
								<h3><?php echo $gv['goods_name']; ?></h3>

							</div>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
									
					</div>
					
				</div>
			</div>
			<!-- Controls -->
			<a class="carousel-left member-carousel-control hidden-xs" href="#team-member-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-right member-carousel-control hidden-xs" href="#team-member-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
	</section>
	<!--/#our-team-->

  	<section id="testimonial" class="parallax-section">

	</section>
	<!--/#testimonial-->

	<section id="pricing"> 
		<div class="container">
			<div class="row">
				<h2 class="title">新闻中心</h2>
				<?php if(is_array($news) || $news instanceof \think\Collection || $news instanceof \think\Paginator): if( count($news)==0 ) : echo "" ;else: foreach($news as $key=>$nv): ?>
				<div class="col-sm-3">
					<ul class="plan text-center">
						<li class="plan-name"><span><?php echo $nv['goods_name']; ?></span></li>
						<?php 
							$date = date('Y-m-d',strtotime($nv['create_time']));
							$arr=explode('-', $date);
							$year = $arr[0];
							$month = $arr[1];

						?>
						<li class="plan-price"><span><?php echo $year;?></span> <?php echo $month;?>月</li>
						<li class="plan-content"><?php echo $nv['brief2']; ?></li>
						<li class="get-plan"><a href="" class="btn btn-plan">MORE</a></li>
					</ul>
					<?php if($nv['hot']==1): ?>
					<div class="plan-type">
						<h3>Popular</h3>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				
				
			</div>
		</div>
	</section>
	<!--/#pricing-->

	<section id="promotion-two" class="parallax-section">

	</section>
	<!--/#promotion-->

	<section id="blog">
        <div class="container">
            <div class="row">
				<h2 class="title">视频中心</h2>
				<?php if(is_array($vedio) || $vedio instanceof \think\Collection || $vedio instanceof \think\Paginator): if( count($vedio)==0 ) : echo "" ;else: foreach($vedio as $key=>$ev): ?>
				<div class="col-sm-6">
					<div class="media single-blog">
						<div class="pull-left">
							<img class="img-responsive" src="<?php echo $ev['img_url']; ?>" alt="" />
						</div>
						<div class="media-body blog-content">
							<h2><a href="#"><?php echo $ev['goods_name']; ?></a></h2>
							<p><?php echo $ev['brief2']; ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				
				
            </div>
        </div>
    </section>
    <!--/#blog-->

    <section id="contact-area" class="clearfix">
        <div id="contact">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" required placeholder="姓名">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" required placeholder="邮箱">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" class="form-control" required placeholder="标题">
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" required class="form-control" rows="8" placeholder="输入文本内容"></textarea>
                </div>                        
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">发送</button>
                </div>
            </form>
            <div class="social-icons">
                <a href=""><i class="fa fa-qq fa-4x"></i></a>
                <a href=""><i class="fa fa-comment fa-4x"></i></a>
                <a href=""><i class="fa fa-podcast fa-4x"></i></a>

            </div>
        </div>
        <div id="gmap-wrap">
            <iframe style="width: 85%;height: 444px;margin-top: 15%;" src="<?php echo url('contact/map'); ?>" frameborder="0"></iframe>
            <p>地址：江苏省苏州市永和路3号</p>
            <p>邮箱：6534354534534@163.com</p>
            <p>电话：12345678910</p>
        </div>
     </section> 
    <!--/#contact-area-->

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                   <p>Copyright  ©2018<a target="_blank" href="#"></a> </p>
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