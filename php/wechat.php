<?php
//微信小程序生成太阳码 https://www.cnblogs.com/jiqing9006/p/9117836.html

/*===========================================================================================================================================================================================
	 一。微信公众号自定义菜单创建
		//1.获取token【开发文档 https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140183】
		$url="https://api.weixin.qq.com/cgi-bin/token";
		$data1 = array(
		    'grant_type' => 'client_credential',
		    'appid'	=> 'wx779f35f2feb3d58f',
		    'secret' => '03ec065f47f3eb9ba120280d0b8c1dee'
		);
		$result=curl_post($url, $data1);
		$token = $result['access_token'];
		api_log('a_token.log',array('$request' => $result));

		//2.创建菜单【开发文档 https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141013】
		$url_menu="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
		$data_menu=array( 
			'button' => array( 
				array( 'type' => 'view', 'name' => '对山任性', 'url' => 'https://www.2bulu.com/community/gotohuatinfo.htm?id=162099'),
				array( 'type' => 'view', 'name' => '对海疯狂', 'url' => 'https://www.2bulu.com/community/gotohuatinfo.htm?id=162219'), 
				array( 'type' => 'view', 'name' => '我就是我', 'url' => 'https://user.qzone.qq.com/403361400/infocenter')
			)
		);
		$result=curl_post($url_menu, json_encode($data_menu));
		api_log('a_create_menu.log',array('$request' => $result));

		//[3].查询菜单【开发文档 https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141014】
		//执行链接即可 https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$token

		//4.删除菜单【开发文档 https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141015】
		//执行链接即可 https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=$token
		
	==============================================================================================================================================================================================
	*/


/*===========================================================================================================================================================================================
	 二。微信网页授权【开发文档 https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842】
		//1.通过code换取网页授权access_token
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
		$data = array(
		    'appid'	=> 'wx17468688e6388990',
		    'secret' => '728b13f16e463bc7d0d0bf08a943422a',
		    'code'	=> $_REQUEST['code'],
		    'grant_type' => 'authorization_code'
		);
		$result = curl_post($url, $data);
		echo '2.获取access_token成功';
		api_log('abc.log',array('$result'=>$result));

        //2.刷新access_token（由于access_token有效时间为5min，此时用上步获取的refresh_token重新刷授权，此授权有效期为30天）
        $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token';
        $das = array(
            'appid'	=> 'wx17468688e6388990',
            'grant_type' => 'refresh_token',
            'refresh_token'	=> $result['refresh_token']
        );
        $results = curl_post($url, $das);
        echo '3.刷新授权成功';
        api_log('abc.log',array('$results'=>$results));

        //3.拉取用户信息(需scope为 snsapi_userinfo)
        $url = 'https://api.weixin.qq.com/sns/userinfo';
        $das = array(
            'access_token'  => $results['access_token'],
            'openid'  => $results['openid'],
            'lang'  =>  'zh_CN'
        );
        $resultss = curl_post($url, $das);
        echo '4.获取用户信息成功';
        api_log('abc.log',array('$resultss'=>$resultss));

        //[4]验证授权凭证是否有效
        $url = 'https://api.weixin.qq.com/sns/auth';
        $das = array(
            'access_token'  => $results['access_token'],
            'openid'  => $results['openid']
        );
        $resultsss = curl_post($url, $das);
        if($resultsss['errcode'] == 0){
            echo '5.授权有效';
        }
        api_log('abc.log',array('$resultsss'=>$resultsss));
	==============================================================================================================================================================================================
	*/



/*===========================================================================================================================================================================================
//生成小程序二维码
//add by roger @2020-07-02
function createQrCode() {
    $appId = 'wxc1033c070554bf17';
    $secret = '91e7f0c37f49cb1b9a41fe87a8ffc910';
    //	获取access_token并缓存起来
    if (!S('access_token')) {
        $accesUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appId . '&secret=' . $secret;
        $accessJson = $this->curlRequestResource($accesUrl);
        S('access_token', json_decode($accessJson, true)['access_token'], 7200);
    }
    // 生成二维码 直接输出 或保存起来
    $qrUrl = 'https://api.weixin.qq.com/cgi-bin/wxaapp/createwxaqrcode?access_token=' . S('access_token');
    $qrData['path'] = 'lionfish_comshop/pages/type/index';
    $qrCode = $this->curlRequestResource($qrUrl, $qrData, 2);
    header('Content-Type: image/jpeg');
    echo $qrCode;
    //file_put_contents('./Uploads/image/qrcode/qrcode_1.png', $qrCode);
}


//curl网络请求
//@param string $url 请求url
//@param array $data 请求参数
//@param int $type 请求传参形式 1=array 2=json 3=queryString
//@return array|bool|mixed|string
function curlRequestResource($url, $data = [], $type = 1) {
    !extension_loaded('curl') ? EXIT('CURL NOT EXISTS!') : NULL;
    if (strlen($url) == 0 || !is_string($url)) return false;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    if (count($data))
        curl_setopt($ch, CURLOPT_POST, 1);
    if ($type == 2) $data = json_encode($data);
    if ($type == 3) $data = http_build_query($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $data = curl_exec($ch);;
    curl_close($ch);
    return $data;
}
==============================================================================================================================================================================================
*/




/** 获取小程序太阳码
 *      1.需要小程序已经上线方可生成太阳码 
 *      2.小程序中的每个页面均可生成
 * 
 * @param $config array 
 *      app_id：小程序appId
 *      secret：小程序密钥 
 * 
 * @param $data json
 *      scene：页面参数
 *      [page]：页面路径。根路径前不要填加【/】，不能携带参数    默认跳主页面【pages/index/index】
 *      [check_path]：检查【page】是否存在。为【false】时允许小程序未发布或者【page】不存在    默认为：【true】
 *      [env_version]：要打开的小程序版本。正式版【release】，体验版【trial】，开发版【develop】    默认值为：【release】  
 *      [width]：二维码的宽度，单位【px】，最小【280px】，最大【1280px】；
 * 
 * @param $codePath string
 *      太阳码存放路径
 * 
 * @param $codeName string
 *      太阳码名称
 * 
 * 官方文档：https://developers.weixin.qq.com/miniprogram/dev/api-backend/open-api/qr-code/wxacode.getUnlimited.html
 */
function createQRcode()
{
    $config = [
        'app_id' => 'wx69331514b10db570',
        'secret' => '61ae311cb25ea20f92fd4a8b6add018e'
    ];

    $access_token = json_decode(file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $config['app_id'] . '&secret=' . $config['secret']), true)['access_token'];

    $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=' . $access_token;

    $ch = curl_init();


    $data = json_encode([
        "scene" => "id=855&spm=1.2.855.2.2",
        "page" => "pages/goods/detail",
        "check_path" => true,
        "env_version" => "develop",
        "width" => 280
    ]);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_HEADER, 'image/gif');

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(

        'Content-Type: application/json',

        'Content-Length: ' . strlen($data)

    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    $codePath = './';

    $codeName = time() . '.png';

    file_put_contents($codePath . $codeName, $result);
    
}
//==============================================================================================================================================================================================
