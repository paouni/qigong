<?php

/**
 *  循环删除目录和文件函数
 * @param $dirName // 需要删除的目录
 * @param bool $delDir // 是否删除目录文件夹
 * @return bool
 */
function delDirAndFile($dirName, $delDir = false)
{
    if ($handle = opendir($dirName)) {
        while (false !== ($item = readdir($handle))) {
            if ($item != '.' && $item != '..') {
                if (is_dir($dirName . DS . $item)) {
                    delDirAndFile($dirName . DS . $item);
                } else {
                    if (!unlink($dirName . DS . $item)) {
                        return false;
                    }
                }
            }
        }
        closedir($handle);
        if ($delDir) {
            if (!rmdir($dirName)) {
                return false;
            }
        }
        return true;
    }
}