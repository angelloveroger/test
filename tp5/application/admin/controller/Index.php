<?php

namespace app\admin\controller;

use app\common\controller\AuthCheck;
use think\Session;
use think\Db;

class Index extends AuthCheck{

    public function index(){

        $businessDbArr = Db::name('business')->whereIn('id',  Session::get('adminInfo.business'))->select();
        $businessStr = implode(',', array_column($businessDbArr, 'name'));
        $businessStr ? $str = '亲爱的'. Session::get('adminInfo.username'). '，您管理的公司有：'. $businessStr : '亲爱的'. Session::get('adminInfo.username') . '，暂无需要管理的公司';
        return $str;exit;
        return $this->fetch();
        return 'admin/index/index';
    }

    public function user(){
        return 'admin/index/user';
    }
}