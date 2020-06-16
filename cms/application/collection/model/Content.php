<?php


// +----------------------------------------------------------------------
// | 采集模型
// +----------------------------------------------------------------------
namespace app\collection\model;

use \think\Model;

class Content extends Model
{
    protected $name = 'collection_content';
    protected $insert = ['status' => 1];

}
