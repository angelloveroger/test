<?php


class Amap
{

    protected static $keyName;
    protected static $keyValue;
    // 地址转坐标
    protected static $geo;
    // 坐标转地址
    protected static $regeo;


    public function __construct()
    {
        self::$keyName = 'toLocation';
        self::$keyValue = 'a6c9a2319c2b9405ffa81b1ede5c90c4';
        self::$geo = 'http://restapi.amap.com/v3/geocode/geo?';
        self::$regeo = 'http://restapi.amap.com/v3/geocode/regeo?';
    }

    /**地址转换为坐标
     * 
     */
    public function addressToLocation()
    {
        $address = ['key' => self::$keyValue, 'address' => '广东省深圳市南山区常兴路73号'];
        return $this->curlGet(self::$geo, $address);
    }

    /**坐标转换为地址
     * 
     */
    public function locationToAddress()
    {
        $location = '113.920711,22.528874';
        return $this->curlGet(self::$regeo, $location);
    }




    /**curl GET请求
     * 
     */
    private function curlGet($url, $params)
    {

        $params ? $url = $this->buildQuery($url, $params) : null;
        $ch = curl_init(); //初始化cURL
        curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串并输出到屏幕上
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        $output = curl_exec($ch); //执行并获得HTML内容
        curl_close($ch); //释放cURL句柄
        return $output;
    }

    /**请求字符串拼接
     * @params string $url 
     * @params array $params
     * @return string
     */
    private function buildQuery($url, $params)
    {
        if ($params) {

            if (strpos($url, '?')) {

                $url .= "&" . http_build_query($params);
            } else {

                $url .= "?" . http_build_query($params);
            }
        }
        return $url;
    }
}

$obj = new Amap();
echo '<pre>';

$result = $obj->addressToLocation();







function addJson($data)
{
    $arr = json_decode($data, true);
    if ($arr['status'] != 1) {
        return '数据失败';
    } else {
        return $arr['geocodes'];
    }
}



// $url = 'http://restapi.amap.com/v3/geocode/geo?key=a6c9a2319c2b9405ffa81b1ede5c90c4&address=广东省深圳市南山区常兴路73号';
// $url = 'http://www.baidu.com';
// $ch = curl_init(); //初始化cURL
// curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串并输出到屏幕上
// curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
// $output = curl_exec($ch); //执行并获得HTML内容
// curl_close($ch); //释放cURL句柄
// var_dump(json_decode($output, true));


// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $requesturl);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $info = curl_exec($ch);
// curl_close($ch);
// echo json_decode($info, true);
