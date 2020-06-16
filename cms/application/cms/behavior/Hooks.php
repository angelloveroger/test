<?php

// +----------------------------------------------------------------------
// | 短信息钩子
// +----------------------------------------------------------------------
namespace app\cms\behavior;

use sys\Hooks as _Hooks;

class Hooks extends _Hooks
{

    //或者run方法
    public function userSidenavAfter($content)
    {
        return $this->fetch('userSidenavAfter');
    }

    public function appInit()
    {
        //此函数需要全局调用
        if (is_file(APP_PATH . 'cms' . DS . 'function.php')) {
            include_once APP_PATH . 'cms' . DS . 'function.php';
        }
    }

}
