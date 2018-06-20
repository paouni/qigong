<?php
//配置文件
return [
    'URL_HTML_SUFFIX'       =>  '',  // URL伪静态后缀设置
    // 视图输出字符串内容替换
    'view_replace_str'          =>      [
        '__ADMIN_CSS__'     =>      __ROOT__ . '/public/admin/style/css',
        '__ADMIN_JS__'      =>      __ROOT__ . '/public/admin/style/js',
        '__PUBLIC__'        =>      __ROOT__ . '/public',
        '__ORG__'           =>      __ROOT__ . '/public/org',
        '__ADMIN__'         =>      __ROOT__ . '/public/admin',
    ],
];