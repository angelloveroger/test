<?php


/**
 * Class Aes AES算法类
 * openssl_get_cipher_methods() 获取可用加密算法(aes-128-cbc/aes-128-ecb/aes-192-cbc/aes-256-cbc....)
 * openssl_cipher_iv_length(str $method) 获取密码初始化向量(iv)长度
 * openssl_random_pseudo_bytes(int $length) 生成一个伪随机字节串
 * openssl_encrypt ( string $data , string $method , string $key [, int $options = 0 [, string $iv = "" [, string &$tag = NULL [, string $aad = "" [, int $tag_length = 16 ]]]]] ) : string
 */

class Aes {

    private $method = null;  // 加密算法
    private $option = null; // 填充方式
    private $optionArr = [0, 1, 2, OPENSSL_RAW_DATA, OPENSSL_ZERO_PADDING];
    private $key = null; // 加密密钥
    private $iv = null; // 初始化向量

    /**
     * Aes constructor.
     * @param mix $key  加密密钥可以传入自己生成的【字符串】，也可以【数组】形式传入，然后这边生成。形式为[data(string/int), method(md5/sha1)]，即返回数组第一个元素用第二个元素指定的hash算法的值
     * @param string $iv 初始化向量可以直接传入，若不传入，即用【$key】根据加密算法截取相应长度
     * @param string $method 加密算法
     * @param int $option 填充方式
     */
    public function __construct($key=[], $iv='', $method='aes-128-cbc', $option=0) {
        if(!extension_loaded('openssl')){
            $this -> _error('please open the openssl extension first');
        }
        $this->method = $method;
        $this->option = $option;
        $this->key = (is_string($key) || is_integer($key)) && !empty($key) ? $key : ($this->_getKey($key) ? $this->_getKey($key) : $this->_error('server error'));
        $this->iv = $iv && is_string($iv) ? ( strlen($iv) == openssl_cipher_iv_length($this->method) ? $iv : substr(MD5($iv), 0, openssl_cipher_iv_length($this->method)) ) : ( strlen($this->key) >= openssl_cipher_iv_length($this->method) ? substr($this->key, 0, openssl_cipher_iv_length($this->method)) : substr(MD5($this->key), 0, openssl_cipher_iv_length($this->method)));
        if(!in_array($this->method, openssl_get_cipher_methods())){
            $this -> _error('please check your method');
        }
        if(!in_array($this->option, $this->optionArr)){
            $this -> _error('please check your option');
        }
    }

    /**
     * @param mix $data 加密/解密数据
     * @param int $type 0加密 other解密
     * @return string
     */
    public function run($data, $type=0){
        return $type ? $this->_decrypt($data) : $this->_encrypt($data);
    }

    /**
     * 加密
     * @param $data 加密数据
     * @return string
     */
    private function _encrypt($data){
        return openssl_encrypt($data, $this->method, $this->key, $this->option, $this->iv);
    }

    /**
     * 解密
     * @param $data 解密数据
     * @return string
     */
    private function _decrypt($data){
        return openssl_decrypt($data, $this->method, $this->key, $this->option, $this->iv);
    }

    /**
     * 获取key
     * @param $data
     * @return string
     */
    private function _getKey($data){
        if(!is_array($data) || empty($data)){
            $this -> _error('please check your key');
        }
        if(count($data)>1 && strtolower($data[1]) == 'sha1'){
            $res = SHA1($data[0]);
        }else{
            $res = MD5($data[0]);
        }
        return $res;
    }

    /**
     * 自定义错误输出
     * @param $message
     */
    private function _error($message){
        exit($message);
    }
}

$str = 'hello world';
$obj = new Aes();
$scr = $obj -> run($str);
echo $obj -> run($scr, 1);