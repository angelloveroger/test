<?php

class cacheFile {
    /*  生成静态缓存数据类
     * */

    private $_dir;  // 定义静态缓存存放路径
    const EXT = '.txt'; // 定义文件类型常量

    /*
     *    构造方法组装静态缓存存放路径
     * */
    public function __construct() {
        $this->_dir = dirname(__FILE__) . '/cacheFiles/';
    }

    /*  写入/读取/删除缓存
     *  @param string $fileName 缓存文件名（不用后缀）
     *  @param string $value 数据
     *  @param interage $overTime 缓存过期时间
     * */
    public function cacheData($fileName, $value = '', $overTime = 0) {
        $fullName = $this->_dir . $fileName . self::EXT;

        //  如果数据不为空且不为null，则把数据写入缓存；如果为null，则把缓存文件删除
        if ('' !== $value) {
            if (is_null($value)) {
                return @unlink($fullName);
            }
            $dir = dirname($fullName);
            if (!is_dir($dir)) {
                mkdir($dir, 0777);
            }
            // 过期时间不满11位，前面补0
            $overTime = sprintf('%011d', $overTime);

            return file_put_contents($fullName, $overTime . json_encode($value));
        }

        //  如果数据为空,读取缓存数据
        if (!is_file($fullName)) {
            return false;
        }

        //  获取缓存数据
        $contents = file_get_contents($fullName);
        $overTime = intval(substr($contents, 0, 11));
        $value = substr($contents, 11);
        if (0 != $overTime && $overTime + filemtime($fullName) < time()) { // 缓存过期
            unlink($fullName);

            return false;
        } else {
            return json_decode($value, true);
        }
    }
}
/*
 * sprintf(格式化，字符串)     格式化字符串
 * intval(字符串)      字符串转数字
 * substr(字符串，偏移值，【截取长度】)      截取字符串
 * filemtime(文件)        获取文件创建时间
 *
 * */
//$file = new cacheFile();
//$file->cacheData('abc','contents',360);
//$file->cacheData('abc');
