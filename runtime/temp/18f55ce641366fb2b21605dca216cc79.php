<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:43:"D:\PHP\Work\qigong\public\dispatch_jump.tpl";i:1526869212;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/><title>跳转提示 - bjyadmin</title>
    <link rel="stylesheet" href="/public/org/css/base.css" />
    <link rel="stylesheet" href="/public/org/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/public/org/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="/public/org/font-awesome-4.4.0/css/font-awesome.min.css" />
</head>
<body>
<div class="xb-h-100"></div>
<div class="xb-out">
    <ul class="bjy-public-jump">
        <li class="bjy-pj-word"> <b><?php echo $msg; ?></b></li>
        <li class="bjy-pj-word"> 页面将在<b id="wait"><?php echo $wait; ?></b>秒后<a id="href" href="<?php echo $url; ?>">跳转</a></li>
    </ul>
</div>
<script src="/public/org/js/jquery-1.10.2.min.js"></script>
<script src="/public/org/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="/public/org/js/base.js"></script>
<script type="text/javascript">
(function(){
    var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
            location.href = href;
            clearInterval(interval);
        };
    }, 1000);
})();
</script>
</body>
</html>