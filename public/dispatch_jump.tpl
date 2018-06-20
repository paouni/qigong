<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/><title>跳转提示 - bjyadmin</title>
    <link rel="stylesheet" href="__ORG__/css/base.css" />
    <link rel="stylesheet" href="__ORG__/bootstrap-3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="__ORG__/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="__ORG__/font-awesome-4.4.0/css/font-awesome.min.css" />
</head>
<body>
<div class="xb-h-100"></div>
<div class="xb-out">
    <ul class="bjy-public-jump">
        <li class="bjy-pj-word"> <b>{$msg}</b></li>
        <li class="bjy-pj-word"> 页面将在<b id="wait">{$wait}</b>秒后<a id="href" href="{$url}">跳转</a></li>
    </ul>
</div>
<script src="__ORG__/js/jquery-1.10.2.min.js"></script>
<script src="__ORG__/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="__ORG__/js/base.js"></script>
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