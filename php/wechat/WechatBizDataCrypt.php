<?php
// namespace clt;
/**
 * 对微信小程序用户加密数据的解密示例代码.
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */
include_once "WechatErrorCode.php";

class WechatBizDataCrypt {

    private $appid;
    private $sessionKey;

    /**
     * 构造函数
     * @param $sessionKey string 用户在小程序登录后获取的会话密钥
     * @param $appid string 小程序的appid
     */
    public function __construct($appid, $sessionKey) {
        $this->sessionKey = $sessionKey;
        $this->appid = $appid;
    }

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param $encryptedData string 加密的用户数据
     * @param $iv string 与用户数据一同返回的初始向量
     * @param $data string 解密后的原文
     *
     * @return int 成功0，失败返回对应的错误码
     */
    public function decryptData($encryptedData, $iv, &$data) {
        if (strlen($this->sessionKey) != 24) {
            return ErrorCode::$IllegalAesKey;
        }
        $aesKey = base64_decode($this->sessionKey);


        if (strlen($iv) != 24) {
            return ErrorCode::$IllegalIv;
        }
        $aesIV = base64_decode($iv);

        $aesCipher = base64_decode($encryptedData);

        $result = openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj = json_decode($result);
        if ($dataObj == NULL) {
            return ErrorCode::$IllegalBuffer;
        }
        if ($dataObj->watermark->appid != $this->appid) {
            return ErrorCode::$IllegalBuffer;
        }
        $data = $result;
        return ErrorCode::$OK;
    }

}

$appid = 'wx69331514b10db570';

$scret = '61ae311cb25ea20f92fd4a8b6add018e';

// error
// $sessionKey = 'BKNyl8n0RO4F+/eQ2jFteQ==';
// $iv = 'L/dnC15w6LQh0lb+jHdLXg==';
// $encryptedData = 'jE4E+Crfc3kfHwyEZXhJIltRwep9R0JyajepvPToU/E2Kd4Zp6zO6kNBCm2IL026OE0isu8PQ9qUfMGWxjIcdymGUMs3Bvl20M3Rt3ZjW5aS3yHSq1gXSVKxjYkLHxMA/+hiYuIHuxlPvbhfagMPwmHWulPyLLCqWhXhrPwt3xB1frOcJyyQr1PYwtZ4l2yN6FD5AltJOdLs+GCzSqD0OO687BlVxsijx7GctMxsjp7EdSYNpnM5y/z4eSImxfmOpVQYF/9gYQlF/vuGCOFARWBlf/2pHv/oSShoOSKoGXiRMmkpN0lwLMyHrCHwcHtC7VGzmt+aCP3n7pMxW78yUxYYEe8K2I/jrYx8uil/uDtMB8GCujPgFrYC7kCgoTGi/EVaXmH14ohSvkhyS67eSOTO1PC/qxrkQ/4O+wM2DSA=';


// success
// $sessionKey = 's56fjZdSj7AqwOCgKLjE8w==';
// $iv = 'xIMcxtEkIwISoXy2BFDgMQ==';
// $encryptedData = 'J5RV6MBL6CU2GaE5VTxIZimQHcFk0kLKz8PBZPQXOX6EOJkxJNMa8rlwT1BlCQyh6GXwX0P5ItuSuvUCQK2bQPg9RCd84YISpjd4QzpTxyq21E2P/H0n7RGJIUiPaaZZ1OByI+jtkw+DuS6mK6uWbDdhHfbHN0+OrxUuWSBwIo/BxsR60uHfByZBE5MPbL4kHdu2PyH4i1nadA9thPzF8V1qV/e8lff/4f8pzd8A5ZKXr6r7z7ddNrwdRIMeq4hKynNF/AcpTXpKAt0KlZKfaEP3LsWwKPBkhsLijuUNtYREF1LOIDcfuatSzwC7XatQ4lYlbSJCrjZB8NeYY6qMdmEUekwNjlYvw3+cmZ3DTYZBU0yRM0fs1nLSXytPc1ZFW6lRa8E75fi4dtv312Vp86njDHOOsVsuZmp86mkhDu8=';

// success
// $sessionKey = 'yxAZlJsCIsIY8uPSzD8s5g==';
// $iv = 'f1cID2KQ6STmPXIqQ5534w==';
// $encryptedData = 'uFFnX2RUI6wONGk5RQAbPVldj4PLFnsf96boiJawYHiKRadYF3qudM4UW/G6H4hwGwbu4nsUHTL8VFwqJdW/xfBG7C2/pF9Lal9zWthA1tnZlVVn2crtg+xWpO8nP7mY5Sw1TqO4yuYeL64dvPbR1pGTjfQpTLTRPEzcjb9Yvef3YPZ0cOZozFZhCNshH5saW2v8uxp/ImGyIcNiAHxXkDBhhqbRMgY+ay4/X3nEACHdy+A9DSnpHJvdN/NytEkfbO75qxxQtB7aSjuBAZs4+dPEMvol5W5bf/yqVTNwOibCSNu8r4bOn+ed9Gkyp28GzmPjT4LSpSj0sPYJ0BM50SlLNuzots/k7Eg1Y71ISog2SM7ndf53B5yF+XQHuDePGIoWsA5neIrqWe9GLH3TiQ==';

// error
// $sessionKey = 'eMNS0NN0qTRcPcJ25w6EYQ==';
// $iv = 'I4n1kDiFpVILSOQcezeyvQ==';
// $encryptedData = 'xEAGiq6h/Y2SxQjy+7bmaCJ1yw/G+oTEdCwNSzSqO+wkjf2g5R5m0vUS2dm47F3gy7+TkfyCkgNHGBRSKclXR4HtYR0LZdTk7FROq3HIm0OigbpDCaWTFSJCQuwm8mDhzGbOOtx+9WIhyWpPTJ6oMBt/YI1FVBNlb+imUz4XhNj4lqUiN+ACWkz4b1i4AsHkPVEWOWR4otpe/T7Z3Zi5djWlT/tpdrb5d+PKB7D/bQP6D4Fe8qd9U2dY13SQzPIwNzaV2CQnvHYHnK8trM14tCVvMEu+9TMxiim/Kv9R/aMfjX5B4Ohi3j/q19Y9Rlqb3a6lLFWoSzSINiBV1dPDHJUiBtt+XWToUPLdy5131Y2l7BrW/MHayEqy2BtcEBnk9WndmUHd1pIGn9Ig0PGWC1NR/PxF6diIXjxavJMdvkQ=';

// success
$sessionKey = '001OuYD/jd9Tu28BvMdPmA==';
$iv = 'vSOzXCSX2PWBbh2a/jiVtg==';
$encryptedData = 'LoKZO1ipsnOWbN/1nQTyGY/LJfSxkPk3kL434baUpfYjG9aFX4nlF3JyCnfzdxR+sCOth1+aYxx5rOESD0k+s95EVZoiOLyVvaMO2APRi8YSBypuT1dQmh9LGsmmttyiXyIGT1t+gGJDgFjcTmEsfpMbYH99NNdrhR6uNKh0PfgWwWu6ALSYOs20BpKx1xJZNiOQ+bbEu5EPbJS7UzdWT0QYM9nsmb151FGjtJiasmFqMBV52UhJgWkfITb50i+9W9EG/HPODz+ykQvjItE3ziGaCMi5h3hZEDGEuMMtNxGIVmIlnXFJoOnDliRvte8GUPTM3woNu9XJql4a3lCQnzMQZP+OaRrIbPdYOaHWWKgwk4EEedMqx5Ron84ca4maderebl+9y0l2Y4UcrNaNqLkBYSH+a67WTA3Ucx2Zo2o=';

$data = [];

$obj = new WechatBizDataCrypt($appid, $sessionKey);

$obj->decryptData($encryptedData, $iv, $data);

echo '<pre>';
print_r(json_decode($data, true));