<?php

/*setcookie($name,[$value],[$expire],[$path],[$domain],[$secure],[$httponly])
	$name   	string cookie的名字
	$value  	string cookie的值
	$expire 	int    cookie的有效时间，默认值是0，单位是秒
	$path   	string cookie的有效路径，默认当前目录以及子目录有效；也可以整个根目录/，在整个根目录下有效
	$domain 	string cookie的作用域，默认本域名下有用
	$secure 	bool   cookie是否加密传输，默认false；如果设置成true，即通过HTTPS传输
	$httponly bool   cookie访问方式，默认false；如果设置成true，客户端js不可操作cookie

	&  更新和删除cookie的时候 需要将$path和$domain设置为一样的
*/
	// 设置cookies
setcookie('name','roger');
	// 设置过期时间
setcookie('a',1234,time()+300);//设置过期时间，5分钟有效时间
setcookie('b',1234,strtotime('7 days'));//设置过期时间，1星期有效时间
	// 设置作用域
setcookie('c',1234,time()+3600,'/');//设置cookie作用域，此为根目录
setcookie('d', 'bike', time()+3600, '/', 'local.study');
print_r($_COOKIE);

//========================================================================================================PHP data() 时期日期函数 start->137================================================================================================================================
error_reporting(-1);
    /*   date.timezone 修改php.ini配置，会改变所有脚本的时区
     *   date_default_timezone_set()  动态设置时区，会改变当前脚本时区
     *   date_default_timezone_get()   获取当前时区设置
     *   ini_set()  动态设置时区，会改变当前脚本时区
     * */

    echo '当前时区date_default_timezone_get()是：'.date_default_timezone_get().'<br/>';
    echo '当前时区的时间是：'.date('Y-m-d H:i:s',time()).'<br/>';

    date_default_timezone_set('PRC');

    echo '重新配置date_default_timezone_set("PRC")时区后的时区是：'.date_default_timezone_get().'<br/>';
    echo '当前时区的时间是：'.date('Y-m-d H:i:s',time()).'<br/>';

    echo 'ini_get()获取当前的时区设置：'.ini_get('date.timezone').'<br/>';
    echo 'ini_set()重新设置时区：'.ini_set('date.timezone','Asia/shanghai').'<br/>';
    echo ini_get('date.timezone');



     /*  date() 时间格式化函数
     *  Y  四位数的年份  如 2016
     *  m  两位数的月份  如 01-12
     *  d  两位数的日期  如 01-31
     *  H  两位数的小时  如 01-23
     *  i  两位数的分钟  如 01-59
     *  s  两位是的秒钟  如 01-59
     *  w  一周内的第几天 如 0-6
     *  W  本年第几周 如 01-50
     *  L  判断是否为闰年 返回bool值
     *  z  本年的第几天  如 0-365
     *  t 给定月份有几天 如 27,28,31
     * */

    date_default_timezone_set('PRC');
    echo '当前时间是：'.date('Y-m-d H:i:s',time()).'<br/>';
    echo '今天是这个周的第几天(w)：'.date('w').'<br/>';
    echo '当前是今年的第几周（W）：'.date('W').'<br/>';
    echo '当前是今年的第几天（z）：'.date('z').'<br/>';
    echo '今年是否为闰年（L）：'.date('L').'<br/>';
    echo '这个月有几天（t）：'.date('t');



       /*  time() 获取从1970到当前的秒数
     *  mktime(时，分，秒，月，日，年) 得到指定日期时间戳
     * */
    echo '当前时间秒数是（time()）：'.time().'<br/>';
    echo '一周后的今天是：'.date("Y-m-d H:i:s",time()+7*24*3600).'<br/>';
    echo '八天之前的今天是：'.date('Y-m-d H:i:s',time()-8*24*3600).'<br/>';
    echo '2016-12-25 12：25：45的时间戳是：'.mktime(12,25,45,12,25,2016).'<br/>';

    echo '出生时间mktime(5,25,45,11,27,1988)：'.$bir = mktime(5,25,45,11,27,1988).'<br/>';
    echo '年龄是：'.$age = floor((time()-$bir)/(365*24*3600));


     /*  strtotime() 英文变为时间戳
     *
     * */
    echo '当前时间strtotime("now")：'.strtotime('now').'<br/>';
    echo '两天前date("Y-m-d H:i:s",strtotime("-2 days"))：'.date("Y-m-d H:i:s",strtotime("-2 days")).'<br/>';
    echo '五天前date("Y-m-d H:i:s",strtotime("+5 days"))：'.date("Y-m-d H:i:s",strtotime("+5 days")).'<br/>';
    echo '两月前date("Y-m-d H:i:s",strtotime("-2 months"))：'.date("Y-m-d H:i:s",strtotime("-2 months")).'<br/>';
    echo '五年前date("Y-m-d H:i:s",strtotime("+5 years"))：'.date("Y-m-d H:i:s",strtotime("+5 years")).'<br/>';



    /*  microtime();  微妙（两部分：前面是微妙，后面是时间戳）
     *  常用于计算脚本执行的时间
     * */
    echo microtime().'<br/>';
    echo microtime(true);

    echo '<hr/>';
    $start = microtime(true);
    for($i=0;$i<800000;$i++){
        $arr[] = $i;
    }
    $end = microtime(true);
    echo '开始时间：'.$start;echo '<br/>';
    echo '结束时间：'.$end;echo '<br/>';
    echo '这个循环用时：'.round(($end - $start),5);


    echo '获取当前时间的数组（个体date（））：';print_r(getdate());
    echo '<hr/>';
    echo '检测时间合法性（check date（））：';


    echo '设置时区 <b>date_default_timezone_set("Japan")</b> 为：Japan';date_default_timezone_set('Japan');     // 设置时区 date_default_timezone_set()
    echo '<hr/>';
    echo '获取当前时区 <b>date_default_timezone_get()</b> 为：'.date_default_timezone_get();    // 获取当前时区 date_default_timezone_get()
    echo '<hr/>';
    echo '格式化当前时间 <b>date("Y-m-d H:i:s")</b> 是：'.date('Y-m-d H:i:s');  // date() 格式化时间
    echo '<hr/>';
    echo '当前时间戳 <b>time()</b> 是：'.time();    // 当前时间戳 time()
    echo '<hr/>';
    echo '指定日期 <b>mktime(h,i,s,n,j,y)</b> 时间戳为：'.mktime(3,57,25,11,27,1988);    // 指定日期时间戳 mktime(h,i,s,n,j,y)
    echo '<hr/>';
    echo '将英文时间 <b>strtotime("-2 years  2 months 3 days")</b> 转为时间戳为：'.strtotime('-2 years  2 months 3 days');   // 将英文时间解析成时间戳 strtotime()
    echo '<hr/>';
    echo '当前微妙数 <b>microtime()</b> 为：'.microtime();   // 当前微妙数 microtime()   带参数，即为当前时间戳和微妙数，不带则分为微妙数和时间戳两段
    echo '<hr/>';
    echo '<pre>返回日期有关数组 <b>getdate()</b><br/>  ';print_r(getdate());    // 返回日期有关数组 getdate()
    echo '<hr/>';
    echo '<pre>返回秒有关数组 <b>gettimeofday()</b> <br/>';print_r(gettimeofday());    // 返回秒有关数组
    echo '<hr/>';
    echo '检测日期时间合理性 <b>checkdate()</b> ,返回bool值为：'.checkdate(8,12,2017);
    echo '<hr/>';
    echo '<b>$_POST过来的数组</b><br/>';print_r($_POST);
    echo '<hr/>';
//========================================================================================================PHP data() 时期日期函数 end================================================================================================================================


//========================================================================================================PHP 变量的引用与传值 start->152================================================================================================================================
	/*变量的传值与引用  
	不用'&'相当于变量拷贝：'='左边会生成一个与'='右边一模一样的变量，当把左边的变量赋值为0，或者NULL，右边的变量还是之前的值，不会随着变0，或者NULL；
	用'&'相当于引用：'='左边会指向与'='右边一样的存储值，而不是指向'='右边的变量，当把左边的变量赋值为0，或者NULL，右边的变量也会随着变0，或者NULL；
	*/
	/*
	$a = 5;
	$b = &$a;
	echo $a.'<br/>';echo $b.'<hr/>';
	$a = 0;
	echo $a.'<br/>';echo $b;exit;
	*/
//========================================================================================================PHP 变量的引用与传值 end================================================================================================================================


//========================================================================================================PHP 抽奖 start->189================================================================================================================================
/**
	 * @param 	$probability array 	奖品概率的数组
	 * @return 	$int        integer  奖品ID
	 */
	function lottery($probability){
		$winId = 0;
		$sum = array_sum($probability);
		foreach($probability as $k => $v){
			$randId = mt_rand(1, $sum);//echo $k;echo '<br/>';echo $v;echo '<br/>';echo $randId;echo '<br/>';echo $sum;echo '<hr/>';
			if($v >= $randId){
				$winId = $k;
				break;
			}else{
				$sum -= $v;
			}
		}
		return $winId;
	}
	/*测试数据
	$lottery = array(
		array('gift'=>'一等奖', 'probability'=>0),
		array('gift'=>'二等奖', 'probability'=>5),
		array('gift'=>'三等奖', 'probability'=>15),
		array('gift'=>'四等奖', 'probability'=>20),
		array('gift'=>'没有奖', 'probability'=>50),
	);
	$probability = array_column($lottery, 'probability');
   
   
   $winId = lottery($probability);
   echo $winId;
   //file_put_contents('lottery.txt', $winId, FILE_APPEND);
   */
//========================================================================================================PHP 抽奖 end================================================================================================================================






















//========================================================================================================================================================================================================================================
