<?php
/**PHP路径函数
 * dirname(path(string)) 函数返回路径中的目录部分。
 */
// $path = 'F:/other/test/test.php';
// echo dirname($path);     //F:/other/test

/**PHP路径函数
 * getcwd() 获取当前工作目录
 * chdir(directory(string)) 函数改变当前的目录
 */
// echo getcwd();  //F:/other/test
// chdir('test');
// echo getcwd();  //F:\other\test\test

/**PHP路径函数
 * realpath(linkpath(string)) 函数返回绝对路径。
 */
//echo realpath('test.php');  //F:\other\test\test.php


/**
 * 变量            返回值(isset(), empty(), is_null())
 * null                     0       1         1
 * 0                        1       1         0
 * 0.00                     1       1         0
 * ''                       1       1         0
 * '0'                      1       1         0
 * '0.00'                   1       0         0
 * false                    1       1         0
 * true                     1       0         0
 * array()                  1       1         0
 * array(array())           1       0         0
 *
 * isset(mix)  变量存在且值不为【null】时返回【true】，否则返回为【false】；函数仅适用于变量的判断，常量和字符串，数字。。。会解析错误；变量不存在或不赋值时返回【false】
 * empty(mix)  变量不存在或不赋值或值为【null,0,0.00,'','0',array(),false】时返回【true】，否则返回【false】；变量不存在或不赋值时返回【true】
 * is_null(mix) 变量存在且不为【null】时返回【true】，否则返回【false】；变量不存在或不赋值时返回【notice】
 */

$v = 0;
var_dump(isset($v));
echo '<hr/>';
var_dump(empty($v));
echo '<hr />';
var_dump(is_null($v));


/**1.包含条件不同：
 *  include() 满足条件才会包含；
 *  require() 无条件包含；
 *
 * 2.包含方式不同：
 *  include() 一般放在脚本流程控制处理部分，代码执行到include时才将文件包含进来；
 *  require() 一般放在脚本最上面，执行脚本之前就会将文件包含进来，使之成为脚本的一部分；
 *
 * 3.包含失败处理方式不同：
 *  include() 包含文件不存在时，会产生警告，脚本会继续执行；
 *  require() 包含文件不存在时，会产生致命错误，脚本停止继续执行；
 *
 * require() include()  和 require_once() include_once()不同在于
 *  多次包含：前者会反复包含；后者如果已经包含进来，就不会再反复包含
 */