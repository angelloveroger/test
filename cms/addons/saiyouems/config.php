<?php

// +----------------------------------------------------------------------
// | 插件配置
// +----------------------------------------------------------------------
return [
    'from' => [ //配置在表单中的键名 ,这个会是config[title]
        'title' => '发件人地址', //表单的文字
        'type' => 'text', //表单的类型：text、textarea、checkbox、radio、select等
        'value' => '', //表单的默认值
        'style' => "width:200px;", //表单样式
    ],
    'appid' => [
        'title' => 'APPID名称',
        'type' => 'text',
        'value' => '',
        'style' => "width:200px;",
    ],
    'appkey' => [
        'title' => 'APPKEY秘钥',
        'type' => 'text',
        'value' => '',
        'style' => "width:200px;",
    ],
];
