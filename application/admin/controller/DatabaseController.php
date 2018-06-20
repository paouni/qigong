<?php

namespace app\admin\controller;

use app\admin\model\Category;
use Think\Db;
use think\Exception;

class DatabaseController extends CommonController
{
    public $model = null; //模型实例

    public function __construct()
    {
        parent::__construct();
        if ($this->model == null) {
            $this->model = new Category();
        }
    }

    //首页 -- 展示所有的数据库
    public function index($type = 'index')
    {
        if ($type == 'import') {
            //phpcmstables_20170407_2401_1.sql
            //还原数据库操作  preg_match("/(phpcmstables_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.sql/i",basename($sqlfile),$num)
            //列出备份文件列表
            $path = ROOT_PATH . 'uploads/backup/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $path = realpath($path);
            $flag = \FilesystemIterator::KEY_AS_FILENAME;
            $glob = new \FilesystemIterator($path, $flag);

            $list = array();
            foreach ($glob as $name => $file) {
                if (preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)) {
                    $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                    $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                    $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                    $part = $name[6];

                    if (isset($list["{$date} {$time}"])) {
                        $info = $list["{$date} {$time}"];
                        $info['part'] = max($info['part'], $part);
                        $info['size'] = $info['size'] + $file->getSize();
                    } else {
                        $info['part'] = $part;
                        $info['size'] = $file->getSize();
                    }
                    $extension = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                    $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                    $info['time'] = strtotime("{$date} {$time}");

                    $list["{$date} {$time}"] = $info;
                }
            }
        } else { //备份数据库
            try {
                $db = Db::connect();
                $list = $db->query('SHOW TABLE STATUS FROM `' . config('database.database') . '`');
            } catch (Exception $e) {
                $this->error('something go error');
            } catch (\Exception $exception) {
                $this->error('error has going,please try later!');
            }

            $list = array_map('array_change_key_case', $list);
            //dump($list);
        }
        $this->assign('list', $list);
        return $this->fetch($type);
    }

    /**
     * post 提交数据备份数据库
     * @param array $tables 表名数组
     */
    //明天完成 -- 写入数组 return ['time' => time()]; 时间超过10分钟即可判断任务结束
    public function export($tables)
    {
        if (request()->isPost() && !empty($tables) && is_array($tables)) { //request()->isPost()()
            //初始化
            $path = ROOT_PATH . 'uploads/backup/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            //读取备份配置
            $config = array(
                'path' => realpath($path) . DIRECTORY_SEPARATOR,
                'part' => 20971520,
                'compress' => 1,
                'level' => 9
            );
            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if (is_file($lock)) {
                $this->error('检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                //创建锁文件
                file_put_contents($lock, time());
            }
            //检查备份目录是否可写
            if (!is_writeable($config['path'])) {
                $this->error('备份目录不存在或不可写，请检查后重试！');
            }
            //生成备份文件信息
            $file = array('name' => date('Ymd-His', time()), 'part' => 1);

            //创建备份文件
            $Database = new \com\Database($file, $config);
            if (false !== $Database->create()) {
                $tab = array('id' => 0, 'start' => 0);

                // 开始备份数据操作
                foreach ($tables as $table) {
                    $result = $Database->backup($table, 0);
                    if (false === $result) {
                        $this->error('备份出错！');
                    }
                }
                //备份完成，删除文件
                unlink($path . 'backup.lock');
                $this->success('备份完成！', '', array('tab' => $tab));
            } else {
                $this->error('初始化失败，备份文件创建失败！');
            }
        } else {
            //出错
            $this->error('参数错误！');
        }
    }

    /**
     * 优化表
     * @param array $tables 表名
     * @throws \Exception
     */
    public function optimize($tables = [])
    {
        try {
            if ($tables) {
                $Db = \think\Db::connect();
                if (is_array($tables)) {
                    $tables = implode('`,`', $tables);
                    $list = $Db->query("OPTIMIZE TABLE `{$tables}`");

                    if ($list) {
                        $this->success("数据表优化完成！");
                    } else {
                        $this->error("数据表优化出错请重试！");
                    }
                } else {
                    $this->error("数据选择有误，请稍后重试！");
                }
            } else {
                $this->error("请指定要优化的表！");
            }
            return;
        } catch (Exception $exception) {
            $this->error("优化发生错误，请稍后重试！");
        }

    }

    /**
     * 修复表
     * @param array $tables 表名
     * @throws \Exception
     */
    public function repair($tables = [])
    {
        try {
            if ($tables) {
                $Db = \think\Db::connect();
                if (is_array($tables)) {
                    $tables = implode('`,`', $tables);
                    $list = $Db->query("REPAIR TABLE `{$tables}`");

                    if ($list) {
                        $this->success("数据表修复完成！");
                    } else {
                        $this->error("数据表修复出错请重试！");
                    }
                } else {
                    $this->error("数据选择有误，请稍后重试！");
                }
            } else {
                $this->error("请指定要修复的表！");
            }
            return;
        } catch
        (Exception $exception) {
            $this->error("优化发生错误，请稍后重试！");
        }
    }

    /**
     * 还原数据库
     */
    public function import($time = 0, $part = null, $start = null)
    {
        if (is_numeric($time) && is_null($part) && is_null($start)) {
            //初始化
            //获取备份文件信息
            $name = date('Ymd-His', $time) . '-*.sql*';
            $path = realpath(ROOT_PATH . 'uploads/backup/') . DIRECTORY_SEPARATOR . $name;
            $files = glob($path);
            $list = array();
            foreach ($files as $name) {
                $basename = basename($name);
                $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);
            //检测文件正确性
            $last = end($list);
            if (count($list) === $last[0]) {
                session('backup_list', $list); //缓存备份列表
                $this->success('初始化完成！', '', array('part' => 1, 'start' => 0));
            } else {
                $this->error('备份文件可能已经损坏，请检查！');
            }
        } elseif (is_numeric($part) && is_numeric($start)) {
            $list = session('backup_list');

            $db = new \com\Database($list[$part], array(
                'path' => realpath(ROOT_PATH . 'uploads/backup') . DIRECTORY_SEPARATOR,
                'compress' => $list[$part][2]
            ));

            $start = $db->import($start);

            if (false === $start) {
                return $this->error('还原数据出错！');
            } elseif (0 === $start) {
                //下一卷
                if (isset($list[++$part])) {
                    $data = array('part' => $part, 'start' => 0);
                    return $this->success("正在还原...#{$part}", '', $data);
                } else {
                    session('backup_list', null);
                    return $this->success('还原完成！');
                }
            } else {
                $data = array('part' => $part, 'start' => $start[0]);
                if ($start[1]) {
                    $rate = floor(100 * ($start[0] / $start[1]));
                    return $this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                } else {
                    $data['gz'] = 1;
                    return $this->success("正在还原...#{$part}", '', $data);
                }
            }
        } else {
            return $this->error('参数错误！');
        }
    }

    public function download($time = 0)
    {
        header("Content-type:text/html;charset=utf-8");
        //获取备份文件信息
        //初始化
        //获取备份文件信息
        $name = date('Ymd-His', $time) . '-*.sql*';
        $path = realpath(ROOT_PATH . 'uploads/backup/') . DIRECTORY_SEPARATOR . $name;
        $files = glob($path);
        $list = array();
        foreach ($files as $name) {
            $basename = basename($name);
            $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
            $gz = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
            $list[$match[6]] = array($match[6], $name, $gz);
        }
        ksort($list);
        //检测文件正确性
        $last = end($list);
        if (count($list) === $last[0]) {
            //下载操作
            //打开文件
            $file = fopen($files[0], "r");
            //输入文件标签
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length: " . filesize($files[0]));
            Header("Content-Disposition: attachment; filename=" . basename($files[0]));
            //输出文件内容
            //读取文件内容并直接输出到浏览器
            echo fread($file, filesize($files[0]));
            fclose($file);
            exit ();
        } else {
            $this->error('备份文件可能已经损坏，请检查或重新备份！');
        }

        $name = date('Ymd-His', $time) . '-*.sql*';
        $file_name = realpath(ROOT_PATH . 'uploads/backup/') . DIRECTORY_SEPARATOR . $name;

        //用以解决中文不能显示出来的问题
        //$file_name=iconv("utf-8","gb2312",$file_name);
        /*$file_sub_path = $_SERVER['DOCUMENT_ROOT']. "uploads/backup/";
        $file_path = $file_sub_path.$file_name;*/
        //首先要判断给定的文件存在与否
        if (!file_exists($file_name)) {
            $this->error('没有该文件文件');
            return;
        }
        $fp = fopen($file_name, "r");
        $file_size = filesize($file_name);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:" . $file_size);
        Header("Content-Disposition: attachment; filename=" . $file_name);
        $buffer = 1024;
        $file_count = 0;
        //向浏览器返回数据
        while (!feof($fp) && $file_count < $file_size) {
            $file_con = fread($fp, $buffer);
            $file_count += $buffer;
            echo $file_con;
        }
        fclose($fp);
    }

    /**
     * 删除备份文件
     * @param  Integer $time 备份时间
     */
    public function del($time = 0)
    {
        if ($time) {
            $name = date('Ymd-His', $time) . '-*.sql*';
            $path = realpath(ROOT_PATH . 'uploads/backup/') . DIRECTORY_SEPARATOR . $name;
            array_map("unlink", glob($path));
            if (count(glob($path))) {
                $this->error('备份文件删除失败，请检查权限！');
            } else {
                $this->success('备份文件删除成功！');
            }
        } else {
            $this->error('参数错误！');
        }
        return;
    }
}