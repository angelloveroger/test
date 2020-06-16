<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**add by roger @2020-05-23
 * 验证用户登陆密码
 * @param $pwd
 * @param $userInfo
 * @return bool
 */
function checkUserPwd($pwd, $userInfo) {
    if(!$pwd || !$userInfo || !is_array($userInfo)) {
        return false;
    }
    if(MD5($pwd.$userInfo['salt']) != $userInfo['password']) {
        return false;
    }
    return true;
}

/**add by roger @2020-05-23
 * 检验密码位数[6到18位数字字母组合]
 * @param $pwd
 * @return bool|int
 */
function checkPwdDigit($pwd) {
    if(!$pwd) {
        return false;
    }
    return preg_match('/^[0-9a-zA-Z]{6,18}$/', $pwd);
}

/**
 * 验证邮箱
 * @param $email
 * @return bool
 */
function checkEmail($email) {
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if(!preg_match($pattern, $email)) {
        return false;
    }
    return true;
}

/**add by roger @2020-05-23
 * 验证手机号支持以下号段
 * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
 * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
 * 电信：133、153、180、181、189 、177(4G)；
 * 卫星通信：1349
 * 虚拟运营商：170
 * @param $mobile
 * @return bool
 */
function checkMobile($mobile) {
    if(!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^166[\d]{8}$|^15[^4]{1}\d{8}$|^17[0,3,5,6,7,8]{1}\d{8}$|^18[\d]{9}$|^19[8,9]{1}\d{8}$#', $mobile) ? true : false;

    //return preg_match( '#^1[\d]{10}$#', $mobile ) ? true : false;
}

/**add by roger @2020-05-23
 * 生成随机字符串
 * @param int $lenght 字符串长度长度
 * @param int $min 开始位移
 * @param int $max 结束位移
 * @return string 随机字符串
 */
function randomStr($lenght = 4, $min = 0, $max = 35) {
    $str = "0123456789abcdefghijklmnopqrstuvwxyz";
    $key = "";
    for($i = 0; $i < $lenght; $i++) {
        $key .= $str{mt_rand($min, $max)};
    }
    return $key;
}

/**add by roger @2020-05-23
 * 写日志用的
 * @param $file_name  日志名字
 * @param $data       记录数据
 */
function api_log($file_name, $data) {
    $path = defined('LOG_PATH') ? LOG_PATH : './Logs/'.date('Y-m').'/'.date('d').'/';
    if(!is_dir($path)) {
        mkdir($path, 0777, true);
        @chmod($path, 0777);
    }
    $real_name = $path.$file_name;
    file_put_contents($real_name, "\r\n=========".date("Y-m-d H:i:s")."======================="."\r\n"."logs=".var_export($data, TRUE)."\r\n\r\n\r\n", FILE_APPEND);
}