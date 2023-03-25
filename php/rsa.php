<?php


/**
 * Class Rsa RSA算法类
 * 签名及密文编码：base64字符串/十六进制字符串/二进制字符串流
 * 填充方式: PKCS1Padding（加解密）/NOPadding（解密）
 * 如密钥长度为1024 bit，则加密时数据需小于128字节，加上PKCS1Padding本身的11字节信息，所以明文需小于117字节
 */


class Rsa {

    private $priKey = null;//私钥
    private $pubKey = null;//公钥
    private $opensslPath = null;//openssl.cnf路径
    private $privateKeyBits = null;//密钥长度（512/1024/2048/4096）
    private $privateKeyType = OPENSSL_KEYTYPE_RSA;//加密类型（rsa）
    private $code = null; //密文编码（base64/hex/bin）
    private $padding = null;//填充类型 加密支持 PKCS1_PADDING； 解密支持 PKCS1_PADDING，NO_PADDING
    private $signType = null; //签名算法 (OPENSSL_ALGO_MD5/OPENSSL_ALGO_SHA1/OPENSSL_ALGO_SHA256/OPENSSL_ALGO_512....)


    /**
     * Rsa constructor.
     * @param string $opensslPath openssl.cnf路径
     * @param int $privateKeyBits 密钥长度
     * @param int $padding 填充类型
     * @param string $code 密文编码
     * @param int $signType 签名算法
     */
    public function __construct($opensslPath = 'E:/runApp/xampp/apache/conf/openssl.cnf', $privateKeyBits = 1024, $padding = OPENSSL_PKCS1_PADDING, $code = 'base64', $signType = OPENSSL_ALGO_MD5) {
        if (!extension_loaded('openssl')) {
            $this->_error('please open the openssl extension first');
        }
        $this->opensslPath = $opensslPath;
        $this->privateKeyBits = $privateKeyBits;
        $this->padding = $padding;
        $this->code = $code;
        $this->signType = $signType;
    }

    /**
     * 初始化公钥，私钥
     * @param string $pubPath 公钥路径
     * @param string $priPath 私钥路径
     */
    public function init($pubPath = '', $priPath = '') {
        if ($pubPath) {
            $this->_getPublicKey($pubPath);
        }
        if ($priPath) {
            $this->_getPrivateKey($priPath);
        }
    }

    /**
     * 获取公钥并设置
     * @param string $pubPath 公钥路径
     */
    private function _getPublicKey($pubPath = '') {
        $content = $this->_readFile($pubPath);
        if ($content) {
            $this->pubKey = openssl_get_publickey($content);
        }
    }

    /**
     * 获取私钥并设置
     * @param string $priPath 私钥路径
     */
    private function _getPrivateKey($priPath = '') {
        $content = $this->_readFile($priPath);
        if ($content) {
            $this->priKey = openssl_get_privatekey($content);
        }
    }

    /**
     * 读取文件
     * @param string $path 文件路径
     * @return bool|string
     */
    private function _readFile($path = '') {
        $res = false;
        if (file_exists($path)) {
            $res = file_get_contents($path);
        }
        return $res;
    }

    /**
     * 生成密钥对
     * @param string $pubPath 指定的公钥路径文件名
     * @param string $priPath 指定私钥路径文件名
     * @return array
     */
    public function generate($pubPath = __DIR__ . '/cert/pubKey.pem', $priPath = __DIR__ . '/cert/priKey.pem') {
        if (!file_exists($pubPath) || !file_exists($priPath)) {
            $rsa = ['private_key' => '', 'public_key' => ''];
            $config = ["digest_alg" => "sha512", "private_key_bits" => $this->privateKeyBits, "private_key_type" => $this->privateKeyType, 'config' => $this->opensslPath];
            $res = openssl_pkey_new($config); //创建私钥
            openssl_pkey_export($res, $rsa['private_key'], null, $config); //获取私钥
            $rsa['public_key'] = openssl_pkey_get_details($res)["key"]; //获取公钥
            $path = str_replace('\\', '/', substr($pubPath, 0, stripos($pubPath, 'pubKey')));
            if (!is_dir($path)) {
                mkdir($path, 0777);
                chmod($path, 0777);
            }
            file_put_contents($pubPath, $rsa['public_key'], LOCK_EX);
            file_put_contents($priPath, $rsa['private_key'], LOCK_EX);
        } else {
            $rsa['private_key'] = file_get_contents($pubPath);
            $rsa['public_key'] = file_get_contents($priPath);
        }
        return $rsa;
    }

    /**
     * 自定义错误信息返回
     * @param string $msg 错误信息
     */
    private function _error($msg = '') {
        exit($msg);
    }

    /**
     * 检测填充类型
     * 加密支持 PKCS1_PADDING
     * 解密支持 PKCS1_PADDING，NO_PADDING
     * @param string $type 填充模式
     * @return bool
     */
    private function _checkPadding($type = 'en') {
        if ($type == 'en') {
            switch ($this->padding) {
                case OPENSSL_PKCS1_PADDING:
                    $res = true;
                    break;
                default:
                    $res = false;
            }
        } else {
            switch ($this->padding) {
                case OPENSSL_PKCS1_PADDING:
                case OPENSSL_NO_PADDING:
                    $res = true;
                    break;
                default :
                    $res = false;
            }
        }
        return $res;
    }

    /**
     * 密文编码（base64/hex/bin）
     * @param string $data 秘闻字符串（包含乱码）
     * @return string
     */
    private function _encode($data) {
        switch (strtolower($this->code)) {
            case 'base64' :
                $data = base64_encode($data . '');
                break;
            case 'hex' :
                $data = bin2hex($data);
                break;
            case 'bin' :
            default :
        }
        return $data;
    }

    /**
     * 密文解码（base64/hex/bin）
     * @param string $data 密文字符串
     * @return string
     */
    private function _decode($data) {
        switch (strtolower($this->code)) {
            case 'base64':
                $data = base64_decode($data);
                break;
            case 'hex':
                $data = $this->_hex2bin($data);
                break;
            case 'bin':
            default:
        }
        return $data;
    }

    /**
     * hex编码
     * @param bool $hex
     * @return bool|string
     */
    private function _hex2bin($hex = false) {
        $res = $hex !== false && preg_match('/^[0-9a-fA-F]+$/i', $hex) ? pack("H*", $hex) : false;
        return $res;
    }

    /**
     * 加密
     * @param mix $data 加密数据
     * @return bool|string
     */
    public function encrypt($data) {
        $res = false;
        if (!$this->_checkPadding()) {
            $this->_error('padding error');
        }
        if (openssl_public_encrypt($data, $result, $this->pubKey, $this->padding)) {
            $res = $this->_encode($result);
        }
        return $res;
    }

    /**
     * 解密
     * @param string $data 密文
     * @param bool $rev 是否需要反转
     * @return bool|string
     */
    public function decrypt($data, $rev = false){
        $res = false;
        $data = $this -> _decode($data, $this->code);
        if(!$this -> _checkpadding('de')){
            $this->_error('padding error');
        }
        if($data !== false){
            if(openssl_private_decrypt($data, $result, $this->priKey, $this->padding)){
                $res = $rev ? rtrim(strrev($result), '\0') : $result . '';
            }
        }
        return $res;
    }

    /**
     * 签名
     * @param string $data 数据
     * @return bool|string
     */
    public function sign($data){
        $res = false;
        if(openssl_sign($data, $sign, $this->priKey)){
            $res = $this -> _encode($sign);
        }
        return $res;
    }

    /**
     * 验签
     * @param string $data 数据
     * @param string $sign 数字签名
     * @return bool
     */
    public function verify($data, $sign){
        $res = false;
        $sign = $this -> _decode($sign);//echo ($this->_encode($sign));exit;
        if($sign !== false){
            switch(openssl_verify($data, $sign, $this->pubKey)){
                case 1: $res = true; break;
                case 0:
                case -1:
                default :
                    $res = false;
            }
        }
        return $res;
    }
}


$obj = new Rsa();
$pubPath = '/home/wwwroot/after/public/cert/pubKey.pem';
$priPath = '/home/wwwroot/after/public/cert/priKey.pem';
if (file_exists($pubPath) && file_exists($priPath)) {
    $obj->init($pubPath, $priPath);
} else {
    $obj->generate($pubPath, $priPath);
    $obj->init($pubPath, $priPath);
}

// 加密  解密
$str = [[],['name'=>'roger', 'age'=>31]];
$scr = $obj -> encrypt(json_encode($str));
echo $obj -> decrypt($scr);


/** 签名 验签
 * $str = 'hello world';
 * $src = $obj -> sign($str);
 * $obj -> verify($str, 'cqT/Ee2x3Mc5w4eXuMzaC19ReVzZteEtCfqFioXQbVYi4bf0MTD7zxz4ejyERqeeILDrsBdDxbuzIHkp1jAyem2Ha+Ww64dRQA0TdO+wnuBVMPotpCQmQrB6y+3SHYsJ8mxyPqOYQSChc7vi4J80a6ZdsePzG2dXXzAryZxcpbY=');
 */

