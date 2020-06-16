<?php

namespace app\admin\controller;

use app\common\controller\AuthCheck;
use think\Session;
use think\Db;

class Index extends AuthCheck{

    public function index(){
        $str = '亲爱的'. Session::get('adminInfo.username'). '，当前为：'. date('F d'). '&nbsp;' .date('D').'&nbsp;时间为：'.date('H:i:s');
        return $str;exit;
        return $this->fetch();
        return 'admin/index/index';
    }

    public function user(){
        return 'admin/index/user';
    }
}