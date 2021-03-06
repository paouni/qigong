<?php

namespace app\index\behavior;

use Storage\Storage;

//use Storage\File;

/**
 * 系统行为扩展：静态缓存读取
 */
class ReadHtmlCacheBehavior
{
    // 行为扩展的执行入口必须是run
    public function run(&$params)
    {
        // 开启静态缓存
        if (request()->isGet() && config('HTML_CACHE_ON')) {
            $cacheTime = $this->requireHtmlCache();
            if (false !== $cacheTime && $this->checkHTMLCache(HTML_FILE_NAME, $cacheTime)) {
                //静态页面有效
                // 读取静态页面输出
                echo (new Storage)->read(HTML_FILE_NAME, 'html');
                exit();
            }
        }
    }

    // 判断是否需要静态缓存
    private static function requireHtmlCache()
    {
        // 分析当前的静态规则
        $htmls = config('HTML_CACHE_RULES'); // 读取静态规则
        if (!empty($htmls)) {
            $htmls = array_change_key_case($htmls);
            // 静态规则文件定义格式 actionName=>array('静态规则','缓存时间','附加规则')
            // 'read'=>array('{id},{name}',60,'md5') 必须保证静态规则的唯一性 和 可判断性
            // 检测静态规则
            $module = request()->module();
            $controllerName = strtolower(request()->controller());
            $actionName = strtolower(request()->action());
            //不缓存后台模型的判断
            if (isset($htmls[$module . '/']) && $htmls[$module . '/'] == false) {
                return false;
            }
            if (isset($htmls[$controllerName . ':' . $actionName])) {
                $html = $htmls[$controllerName . ':' . $actionName]; // 某个控制器的操作的静态规则
            } elseif (isset($htmls[$controllerName . ':'])) {
                // 某个控制器的静态规则
                $html = $htmls[$controllerName . ':'];
            } elseif (isset($htmls[$actionName])) {
                $html = $htmls[$actionName]; // 所有操作的静态规则
            } elseif (isset($htmls['*'])) {
                $html = $htmls['*']; // 全局静态规则
            }
            if (!empty($html)) {
                // 解读静态规则
                $rule = is_array($html) ? $html[0] : $html;
                // 以$_开头的系统变量
                $callback = function ($match) {
                    switch ($match[1]) {
                        case '_GET':
                            $var = $_GET[$match[2]];
                            break;
                        case '_POST':
                            $var = $_POST[$match[2]];
                            break;
                        case '_REQUEST':
                            $var = $_REQUEST[$match[2]];
                            break;
                        case '_SERVER':
                            $var = $_SERVER[$match[2]];
                            break;
                        case '_SESSION':
                            $var = $_SESSION[$match[2]];
                            break;
                        case '_COOKIE':
                            $var = $_COOKIE[$match[2]];
                            break;
                    }
                    return (count($match) == 4) ? $match[3]($var) : $var;
                };
                $rule = preg_replace_callback('/{\$(_\w+)\.(\w+)(?:\|(\w+))?}/', $callback, $rule);
                // {ID|FUN} GET变量的简写
                $rule = preg_replace_callback('/{(\w+)\|(\w+)}/', function ($match) {
                    return $match[2]($_GET[$match[1]]);
                }, $rule);
                $rule = preg_replace_callback('/{(\w+)}/', function ($match) {
                    return $_GET[$match[1]];
                }, $rule);
                // 特殊系统变量
                $rule = str_ireplace(
                    array('{:controller}', '{:action}', '{:module}'),
                    array(request()->controller(), request()->action(), request()->module()),
                    $rule);
                // {|FUN} 单独使用函数
                $rule = preg_replace_callback('/{|(\w+)}/', function ($match) {
                    return $match[1]();
                }, $rule);
                $cacheTime = config('HTML_CACHE_TIME') ?: 60;
                if (is_array($html)) {
                    if (!empty($html[2])) {
                        $rule = $html[2]($rule);
                    }
                    // 应用附加函数
                    $cacheTime = isset($html[1]) ? $html[1] : $cacheTime; // 缓存有效期
                } else {
                    //$cacheTime = $cacheTime;
                }

                // 当前缓存文件
                define('HTML_FILE_NAME',
                    ROOT_PATH . 'runtime/html/' . $rule . config('HTML_FILE_SUFFIX', null, '.html'));
                return $cacheTime;
            }
        }
        // 无需缓存
        return false;
    }

    /**
     * 检查静态HTML文件是否有效
     * 如果无效需要重新更新
     * @access public
     * @param string $cacheFile 静态文件名
     * @param integer $cacheTime 缓存有效期
     * @return boolean
     */
    public static function checkHTMLCache($cacheFile = '', $cacheTime = '')
    {
        if (!is_file($cacheFile)) {
            return false;
        } elseif (!is_numeric($cacheTime) && function_exists($cacheTime)) {
            return $cacheTime($cacheFile);
        } elseif (0 != $cacheTime && $_SERVER['REQUEST_TIME'] > (new Storage())->get($cacheFile, 'mtime',
                'html') + $cacheTime) {
            // 文件是否在有效期
            return false;
        }
        //静态文件有效
        return true;
    }

}
