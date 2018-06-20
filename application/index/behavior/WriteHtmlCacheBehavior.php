<?php

namespace app\index\behavior;

use Storage\Storage;

/**
 * 系统行为扩展：静态缓存写入
 */
class WriteHtmlCacheBehavior
{

    // 行为扩展的执行入口必须是run
    public function run1(&$content)
    {
        //2014-11-28 修改 如果有HTTP 4xx 3xx 5xx 头部，禁止存储
        //2014-12-1 修改 对注入的网址 防止生成，例如 /game/lst/SortType/hot/-e8-90-8c-e5-85-94-e7-88-b1-e6-b6-88-e9-99-a4/-e8-bf-9b-e5-87-bb-e7-9a-84-e9-83-a8-e8-90-bd/-e9-a3-8e-e4-ba-91-e5-a4-a9-e4-b8-8b/index.shtml
        if (config('HTML_CACHE_ON') && defined('HTML_FILE_NAME')
            && !preg_match('/Status.*[345]{1}\d{2}/i', implode(' ', headers_list()))
            && !preg_match('/(-[a-z0-9]{2}){3,}/i', HTML_FILE_NAME)) {

            //静态文件写入
            /*if (!is_dir($dir = dirname(HTML_FILE_NAME))) {
                mkdir($dir, 0777, true);
            }*/
            $content = str_replace("__HTML__", __ROOT__ . '/html', $content);
            $content = str_replace("__ROOT__", __ROOT__, $content);
            $content = str_replace("__ORG__", __ROOT__ . '/public/org', $content);
            if (false === file_put_contents(ROOT_PATH . 'index.html', $content)) {
                return '缓存写入失败，请检查目录权限';
            } else {
                return true;
            }
        }
    }

    // 行为扩展的执行入口必须是run
    public function run(&$content)
    {
        //2014-11-28 修改 如果有HTTP 4xx 3xx 5xx 头部，禁止存储
        //2014-12-1 修改 对注入的网址 防止生成，例如 /game/lst/SortType/hot/-e8-90-8c-e5-85-94-e7-88-b1-e6-b6-88-e9-99-a4/-e8-bf-9b-e5-87-bb-e7-9a-84-e9-83-a8-e8-90-bd/-e9-a3-8e-e4-ba-91-e5-a4-a9-e4-b8-8b/index.shtml
        if (config('HTML_CACHE_ON') && defined('HTML_FILE_NAME')
            && !preg_match('/Status.*[345]{1}\d{2}/i', implode(' ', headers_list()))
            && !preg_match('/(-[a-z0-9]{2}){3,}/i', HTML_FILE_NAME)) {
            //静态文件写入
            (new Storage)->put(HTML_FILE_NAME, $content, 'html');
        }
    }
}