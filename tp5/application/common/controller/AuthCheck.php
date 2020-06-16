<?php
/*
namespace app\admin\controller;

use think\Controller;

class CheckUser {

    public function _initialize(){
        parent::_initialize();
        return 'success';
    }
}*/


namespace app\common\controller;

use think\Controller;
use think\Session;
use think\Request;
use auth\Auth;


class AuthCheck extends Controller {

    /**add by roger @2020-05-23
     * 用户权限认证
     * admin模块下所有控制器都必须继承该控制器
     * 用以当前登陆管理员权限判断
     */
    public function _initialize() {
        parent ::_initialize();
        $request = Request ::instance();
        if(!Session ::has('adminInfo.id')) {
            $this -> error('请登录！', 'admin/login/index');
        }
        if(Session ::get('adminInfo.status') == 0) {
            $this -> error('用户禁止登陆，请联系管理员');
        }
        $auth = new Auth();
        $rule = $request -> controller().'/'.$request -> action();
        $auth -> getGroups(Session ::get('adminInfo.id'));
        if(!$auth -> check($rule, Session ::get('adminInfo.id'))) {
            $this -> error('暂无权限，请联系管理员！', 'admin/login/index');
        }
    }

}