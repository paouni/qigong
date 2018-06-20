<?php
namespace Storage;
// 分布式文件存储类
class Storage
{

    /**
     * 操作句柄
     * @var string
     * @access protected
     */
    protected static $handler;

    protected $contents = [];

    /**
     * 连接分布式文件系统
     * @access public
     * @param string $type 文件类型
     * @param array $options  配置数组
     * @return void
     */
    public static function connect($type = 'File', $options = array())
    {
        $class         = 'Storage\\' . ucwords($type);
        self::$handler = new $class($options);
    }

    public static function __callstatic($method, $args)
    {
        //调用缓存驱动的方法
        if (method_exists(self::$handler, $method)) {
            return call_user_func_array(array(self::$handler, $method), $args);
        }
    }
    /**
     * 文件内容读取
     * @access public
     * @param string $filename  文件名
     * @return string
     */
    public function read($filename, $type = '')
    {
        return $this->get($filename, 'content', $type);
    }

    /**
     * 读取文件信息
     * @access public
     * @param string $filename  文件名
     * @param string $name  信息名 mtime或者content
     * @return boolean
     */
    public function get($filename, $name, $type = '')
    {
        if (!isset($this->contents[$filename])) {
            if (!is_file($filename)) {
                return false;
            }

            $this->contents[$filename] = file_get_contents($filename);
        }
        $content = $this->contents[$filename];
        $info    = array(
            'mtime'   => filemtime($filename),
            'content' => $content,
        );
        return $info[$name];
    }

    /**
     * 文件写入
     * @access public
     * @param string $filename  文件名
     * @param string $content  文件内容
     * @return boolean
     */
    public function put($filename, $content, $type = '')
    {
        $dir = dirname($filename);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $content = str_replace("__HTML__", __ROOT__ . '/html', $content);
        $content = str_replace("__ROOT__", __ROOT__, $content);
        $content = str_replace("__ORG__", __ROOT__.'/public/org', $content);
        if (false === file_put_contents($filename, $content)) {
            return '静态文件写入失败:' . $filename;
        } else {
            $this->contents[$filename] = $content;
            return true;
        }
    }
}
