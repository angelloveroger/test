<?php

// +----------------------------------------------------------------------
// | 插件模型
// +----------------------------------------------------------------------
namespace app\addons\model;

use think\Model;

class Addons extends Model
{
    protected $insert = ['create_time'];
    protected function setCreateTimeAttr($value)
    {
        return time();
    }
}
