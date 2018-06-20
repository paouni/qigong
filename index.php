<?php
//header('X-Frame-Options: deny');
$host = 'buy.tongli.net';
if ($_SERVER['HTTP_HOST'] != $host) {
    /*header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After:1200'); //通知搜索引擎改日再来
    header('X-Powered-By:IIS');//构建假的服务器版本信息也可以设置为X-Powered-By: ASP.NET*/
    //header('HTTP/1.1 301 Moved Permanently');//发出301头部
    //header('Location: http://'.$host);exit();
}
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.4.0','<'))  die('PHP必须选择5.4.0以上版本，请升级PHP !');

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');

//session_start();
// 定义__ROOT__
if (!defined('__ROOT__')) {
    $_root = rtrim(dirname(rtrim($_SERVER['SCRIPT_NAME'], '/')), '/');
    define('__ROOT__', (('/' == $_root || '\\' == $_root) ? '' : $_root));
}

// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';
