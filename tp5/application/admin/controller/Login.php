<?php

namespace app\Admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;

class Login extends Controller {

    /** add by roger @2020-05-22
     * @param string $username 用户名
     * @param string $password 密码
     * @return mixed
     */
    public function index() {
        $request = Request ::instance();
        if(!$request -> param()) {
            Session ::clear();
            return $this -> fetch();
        }
        $param = $request -> param();
        if(!$param['username'] || !$param['password']) {
            $this -> error('请正确填写信息！');
        }
        $userDbArr = Db ::name('admin') -> where(['username' => $param['username']]) -> find();
        if(!$userDbArr) {
            $this -> error('用户不存在！');
        }
        if($userDbArr['status'] == 0) {
            $this -> error('用户禁止登陆，请联系管理员！');
        }
        if(!checkUserPwd($param['password'], $userDbArr)) {
            $this -> error('用户密码错误，请返回重新填写！');
        }
        Session ::set('adminInfo', $userDbArr);

        return $this -> success('登陆成功！', 'index/index');

    }
}