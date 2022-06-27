<?php

    /*  方案一 获取接口数据（直接从数据库读取数据生成接口数据）
     *  接口地址 http://local.cms.com/app/getAppData_1.php?page=2&pagesize=5&type=xml
     */
    include_once './returnData.php';
    include_once './cacheFile.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 5;
    if(!is_numeric($page) || !is_numeric($pageSize)){

        return returnData::show(401, '输入参数不合法');
    }
    $offset = ($page-1) * $pageSize;
    $arr = array();
    $cache = new cacheFile();
    if(!$arr = $cache -> cacheData('data_'.$page)) {
        $arr = [
            ['user_name' => 'roger', 'age'=>32],
            ['user_name' => 'angel', 'age'=>18],
            ['user_name' => 'alber', 'age'=>56],
            ['user_name' => 'venus', 'age'=>23],
            ['user_name' => 'tesla', 'age'=>65],
        ];
        $cache->cacheData('data_'.$page, $arr, 360);
    }

    if(count($arr)>0){
        return returnData::show(200, '首页数据获取成功', $arr);
    }else{
        return returnData::show(400, '首页数据获取失败', $arr);
    }