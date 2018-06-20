<?php
// 应用行为扩展定义文件
return [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => [],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [
        //'app\\index\\behavior\\ReadHtmlCacheBehavior',//可自行修改文件位置
    ],
    // 视图内容过滤
    'view_filter'  => [
        //'app\\index\\behavior\\WriteHtmlCacheBehavior',
    ],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
];
