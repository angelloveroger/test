<?php

header('Content_type:text/html; charset=utf-8;');

class rogerClass
{

    //===================================================================目录 start======================================================================
    /**遍历文件夹 打印全路径
     * @param $path
     */
    public function getfiles($path)
    {
        foreach (scandir($path) as $afile) {
            if ($afile == '.' || $afile == '..') continue;
            if (is_dir($path . '/' . $afile)) {
                getfiles($path . '/' . $afile);
            } else {
                echo $path . '/' . $afile . '<br />';
            }
        }
    }

    /**遍历文件夹,有缩进关系
     * @param string $dir 文件夹路径
     * @return string
     */
    public function getDir($dir = '', &$fileDir = '')
    {
        if (!is_dir($dir)) {
            exit('该路径不存在');
        }
        $mydir = dir($dir);
        $fileDir .= "<ul>";
        while ($file = $mydir->read()) {
            if ($file != '.' && $file != '..') {
                if (is_dir("$dir/$file")) {
                    $fileDir .= "<li><font color='#ff00cc'><b>$file</b></font></li>";
                    getDir("$dir/$file", $fileDir);
                } else {
                    $fileDir .= "<li><font color='#aaa'>$file</font></li>";
                }
            }
        }
        $fileDir .= "</ul>";
        $mydir->close();
        return $fileDir;
    }

    /**遍历文件夹
     */
    public function pathDir($dirPath, $Deep = 0)
    {
        $resDir = opendir($dirPath); //资源类型
        while ($basename = readdir($resDir)) {
            //当前文件路径
            $path = $dirPath . '/' . $basename;
            if (is_dir($path) && $basename != '.' && $basename != '..') {
                //是目录，打印目录名，继续迭代
                echo '<b>' . str_repeat('&nbsp;', $Deep) . $basename . '/</b><br/>';
                $Deep = $Deep + 2; //深度+1
                pathDir($path, $Deep);
            } else if (basename($path) != '.' && basename($path) != '..') {
                //不是文件夹，打印文件名
                echo str_repeat('&nbsp;', $Deep) . basename($path) . '<br/>';
            }
        }
        closedir($resDir);
    }
    //===================================================================目录 end======================================================================


    //====================================================================验证手机和邮箱 start===============================================================
    /**验证邮箱
     * @param $email
     * @return bool
     */
    public function checkEmail($email)
    {
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }

    /**验证手机号
     * @param $mobile
     * @return bool
     */
    public function checkMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^166[\d]{8}$|^15[^4]{1}\d{8}$|^17[0,3,5,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }
    //====================================================================验证手机和邮箱 end===============================================================


    //===================================================================算法 start======================================================================
    /**冒泡排序
     * @param array $arr 排序数组
     * @param int $sort 排序方式(默认升序)
     * return array
     */
    public function bubbleSort($arr, $sort = 1)
    {
        $n = count($arr);
        for ($j = 0; $j < $n - 1; $j++) {
            for ($i = 0; $i < $n - $j - 1; $i++) {
                if ($sort == 1) { // 升序排列，判断数组元素大小，颠倒位置
                    if ($arr[$i] > $arr[$i + 1]) {
                        $empty = $arr[$i + 1];
                        $arr[$i + 1] = $arr[$i];
                        $arr[$i] = $empty;
                    }
                } elseif ($sort == 2) { // 降序排列，判断数组元素大小，颠倒位置
                    if ($arr[$i] < $arr[$i + 1]) {
                        $empty = $arr[$i + 1];
                        $arr[$i + 1] = $arr[$i];
                        $arr[$i] = $empty;
                    }
                }
            }
        }
        return $arr;
    }

    /**who is king
     * @param int $n 人数
     * @param int $m 报数
     * @return array
     */
    public function kingCup($n = 10, $m = 3)
    {
        $arr = range(1, $n);
        $i = 0;
        while (count($arr) > 1) {
            if (($i + 1) % $m == 0) {
                unset($arr[$i]);
            } else {
                array_push($arr, $arr[$i]);
                unset($arr[$i]);
            }
            $i++;
        }
        return $arr;
    }
    //===================================================================算法 end======================================================================


    //===================================================================日志时间格式化 start======================================================================
    /**获取日期，星期 （格式如‘2016年12月12日 星期五’）
     * @param string $data1 年月日连接符
     * @param string $data2 年月日连接符
     * @param string $data3 年月日连接符
     * return string
     */
    public function getData($data1 = '年', $data2 = '月', $data3 = '日')
    {
        $dataArr = array('日', '一', '二', '三', '四', '五', '六');
        $week = date('w');
        return date("Y{$data1}m{$data2}d{$data3} 星期") . $dataArr[$week];
    }
    //===================================================================日志时间格式化 end======================================================================


    //===================================================================记录日志 start======================================================================
    /**写日志用的
     * @param $file_name  日志名字
     * @param $data       记录数据
     */
    public function _log($file_name, $data)
    {
        $path = './Logs/' . date('Y-m') . '/' . date('d') . '/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            @chmod($path, 0777);
        }
        $real_name = $path . $file_name;
        file_put_contents($real_name, "===============【" . date('Y-m-d H:i:s') . "】===============\r\n" . var_export($data, TRUE) . "\r\n=============== 【end】 ===============\r\n\r\n\r\n\r\n", FILE_APPEND);
    }
    //===================================================================记录日志 end======================================================================


    //===================================================================获取文件后缀名的N+1种方法 start======================================================================
    /**
     * strripos/strrpos(string,find [,start])  函数查找字符串在另一字符串中最后一次出现的位置,函数对大小写不敏感/函数对大小写敏感，返回字符串在另一字符串中最后一次出现的位置，如果没有找到字符串则返回 FALSE。
     * string 被搜索字符串   find 查找字符串  start 开始搜索的位置
     * stripos/strpos(string,find [,start])  函数查找字符串在另一字符串中第一次出现的位置,函数对大小写不敏感/函数对大小写敏感，返回字符串在另一字符串中第一次出现的位置，如果没有找到字符串则返回 FALSE。
     * string 被搜索字符串   find 查找字符串  start 开始搜索的位置
     * explode(separator,string [,limit]) 函数把字符串string以分隔符separator打散为指定长度limit个数组，返回字符串的数组
     * separator 分隔符   string 需要分割的字符串     limit 返回字符串长度
     * end(array) 函数将数组内部指针指向最后一个元素，并返回该元素的值（如果成功）
     * array 数组
     * array_pop(array)    函数删除数组中的最后一个元素，并返回被删除的值，原始数组改变。如果数组是空的，或者非数组，将返回 NULL
     * array 数组
     * pathinfo(path [,options]) 函数以数组的形式返回文件路径的信息,pathinfo数组中包含【dirname,basename,extension,filename】
     * path 文件名        options 【PATHINFO_DIRNAME - 只返回dirname ；    PATHINFO_BASENAME - 只返回basename；    PATHINFO_EXTENSION - 只返回extension】
     * strrchr(string,char) 函数查找字符串在另一个字符串中最后一次出现的位置，返回字符串在另一个字符串中最后一次出现的位置到主字符串结尾的所有字符。如果未找到此字符，则返回 FALSE
     * string 被搜索字符串   char 查找字符串
     * strchr[strstr](string,search [,before_search]) 函数搜索字符串在另一字符串中的第一次出现,返回字符串的其余部分（从匹配点）。如果未找到所搜索的字符串，则返回 FALSE
     * string 字符串  search 查找字符串    fefore_search 可选bool值，默认false，选true是返回查找字符串的前面部分【strstr区分大小写， stristr不区分大小写】
     * substr(string,start [,length]) 返回字符串的提取部分，若失败则返回 FALSE，或者返回一个空字符串
     * string 字符串  start 开始截取的位置   length 截取长度，未指定则截取到字符串末尾位置
     * strrev(string) 函数反转字符串，返回已反转的字符串
     * string 字符串
     */

    /**获取文件路径，文件名，文件后缀名
     * @param $file 路径
     * @return array
     */
    public function getPathInfo($file)
    {
        $pathinfo = array('dirname' => pathinfo($file, PATHINFO_DIRNAME), 'basename' => pathinfo($file, PATHINFO_BASENAME), 'extension' => pathinfo($file, PATHINFO_EXTENSION),);
        return $pathinfo;
    }

    /**
     * @param $string
     * @return string
     */
    public function getExt1($string)
    {
        $pos = strripos($string, '.');
        $ext = substr($string, $pos + 1);
        return $ext;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function getExt2($string)
    {
        $stringrr = explode('.', $string);
        $ext = end($stringrr);
        return $ext;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function getExt3($string)
    {
        $stringrr = explode('.', $string);
        $ext = array_pop($stringrr);
        return $ext;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function getExt4($string)
    {
        $arr = pathinfo($string);
        $ext = $arr['extension'];
        return $ext;
    }

    /**
     * @param $string
     * @return mixed
     */
    public function getExt5($string)
    {
        $ext = pathinfo($string, PATHINFO_EXTENSION);
        return $ext;
    }

    /**
     * @param $string
     * @return string
     */
    public function getExt6($string)
    {
        $string = strrchr($string, '.');
        $ext = substr($string, 1);
        return $ext;
    }

    /**
     * @param $string
     * @return string
     */
    public function getExt7($string)
    {
        $str = strrev($string);
        $str = strstr($str, '.', true);
        $ext = strrev($str);
        return $ext;
    }

    /**
     * @param $string
     * @return string
     */
    public function getExt8($string)
    {
        $str = strrev($string);
        $str = explode('.', $str)[0];
        $ext = strrev($str);
        return $ext;
    }
    //===================================================================获取文件后缀名的N+1种方法 start======================================================================


    //===================================================================生成随机字符串 start======================================================================
    /**生成默认【4位】随机字符串
     * @param int $len 长度
     * @param int $min 开始点
     * @param int $max 结束点
     * @return string
     */
    public function randStr($len = 4, $min = 0, $max = 9)
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $min > strlen($str) - 1 ? $min = 0 : NULL;
        $max > strlen($str) - 1 ? $max = strlen($str) - 1 : NULL;
        if ($min >= $max) {
            $min = 0;
            $max = strlen($str) - 1;
        }
        $randStr = '';
        for ($i = 0; $i < $len; $i++) {
            $randStr .= $str[rand($min, $max)];
        }
        return $randStr;
    }

    /**生成唯一字符串
     */
    public function uniqidStr($strLen = 12)
    {
        if ($strLen == 12) {
            return substr(md5(microtime(true)), rand(0, 25), 6) . substr(sha1(microtime(true)), rand(0, 33), 6);
        } elseif ($strLen == 18) {
            return substr(md5(microtime(true)), rand(0, 25), 6) . substr(sha1(microtime(true)), rand(0, 33), 6) . substr(md5(time()), rand(0, 25), 6);
        } elseif ($strLen == 24) {
            return substr(md5(microtime(true)), rand(0, 25), 6) . substr(sha1(microtime(true)), rand(0, 33), 6) . substr(md5(time()), rand(0, 25), 6) . substr(sha1(time()), rand(0, 33), 6);
        } elseif ($strLen == 32) {
            return md5(uniqid(microtime(true), true));
        } elseif ($strLen == 40) {
            return sha1(uniqid(microtime(true), true));
        }
    }

    /**生成随机名字
     * @return string
     */
    function returnName()
    {
        $familyName = '赵钱孙李周吴郑王冯陈褚卫蒋沈韩杨朱秦尤许何吕施张孔曹严华金魏陶姜戚谢邹喻柏水窦章云苏潘葛奚范彭郎鲁韦昌马苗凤花方俞任袁柳酆鲍史唐费廉岑薛雷贺倪汤滕殷罗毕郝邬安常乐于时傅皮卞齐康伍余元卜顾孟平黄和穆萧尹姚邵湛汪祁毛禹狄米贝明臧计伏成戴谈宋茅庞熊纪舒屈项祝董粱杜阮蓝闵席季麻强贾路娄危江童颜郭梅盛林刁钟徐邱骆高夏蔡田樊胡凌霍虞万支柯昝管卢莫经房裘缪干解应宗丁宣贲邓郁单杭洪包诸左石崔吉钮龚程嵇邢滑裴陆荣翁荀羊於惠甄麴家封芮羿储靳汲邴糜松井段富巫乌焦巴弓牧隗山谷车侯宓蓬全郗班仰秋仲伊宫宁仇栾暴甘钭厉戎祖武符刘景詹束龙叶幸司韶郜黎蓟薄印宿白怀蒲邰从鄂索咸籍赖卓蔺屠蒙池乔阴欎胥能苍双闻莘党翟谭贡劳逄姬申扶堵冉宰郦雍舄璩桑桂濮牛寿通边扈燕冀郏浦尚农温别庄晏柴瞿阎充慕连茹习宦艾鱼容向古易慎戈廖庾终暨居衡步都耿满弘匡国文寇广禄阙东殴殳沃利蔚越夔隆师巩厍聂晁勾敖融冷訾辛阚那简饶空曾毋沙乜养鞠须丰巢关蒯相查後荆红游竺权逯盖益桓公万俟司马上官欧阳夏侯诸葛闻人东方赫连皇甫尉迟公羊澹台公冶宗政濮阳淳于单于太叔申屠公孙仲孙轩辕令狐钟离宇文长孙慕容鲜于闾丘司徒司空亓官司寇仉督子车颛孙端木巫马公西漆雕乐正壤驷公良拓跋夹谷宰父谷梁晋楚闫法汝鄢涂钦段干百里东郭南门呼延归海羊舌微生岳帅缑亢况后有琴梁丘左丘东门西门商牟佘佴伯赏南宫墨哈谯笪年爱阳佟';
        $secondName = ['澄邈', '德泽', '海超', '海阳', '海荣', '海逸', '海昌', '瀚钰', '瀚文', '涵亮', '涵煦', '明宇', '涵衍', '浩皛', '浩波', '浩博', '浩初', '浩宕', '浩歌', '浩广', '浩邈', '浩气', '浩思', '浩言', '鸿宝', '鸿波', '鸿博', '鸿才', '鸿畅', '鸿畴', '鸿达', '鸿德', '鸿飞', '鸿风', '鸿福', '鸿光', '鸿晖', '鸿朗', '鸿文', '鸿轩', '鸿煊', '鸿骞', '鸿远', '鸿云', '鸿哲', '鸿祯', '鸿志', '鸿卓', '嘉澍', '光济', '澎湃', '彭泽', '鹏池', '鹏海', '浦和', '浦泽', '瑞渊', '越泽', '博耘', '德运', '辰宇', '辰皓', '辰钊', '辰铭', '辰锟', '辰阳', '辰韦', '辰良', '辰沛', '晨轩', '晨涛', '晨濡', '晨潍', '鸿振', '吉星', '铭晨', '起运', '运凡', '运凯', '运鹏', '运浩', '运诚', '运良', '运鸿', '运锋', '运盛', '运升', '运杰', '运珧', '运骏', '运凯', '运乾', '维运', '运晟', '运莱', '运华', '耘豪', '星爵', '星腾', '星睿', '星泽', '星鹏', '星然', '震轩', '震博', '康震', '震博', '振强', '振博', '振华', '振锐', '振凯', '振海', '振国', '振平', '昂然', '昂雄', '昂杰', '昂熙', '昌勋', '昌盛', '昌淼', '昌茂', '昌黎', '昌燎', '昌翰', '晨朗', '德明', '德昌', '德曜', '范明', '飞昂', '高旻', '晗日', '昊然', '昊天', '昊苍', '昊英', '昊宇', '昊嘉', '昊明', '昊伟', '昊硕', '昊磊', '昊东', '鸿晖', '鸿朗', '华晖', '金鹏', '晋鹏', '敬曦', '景明', '景天', '景浩', '俊晖', '君昊', '昆琦', '昆鹏', '昆纬', '昆宇', '昆锐', '昆卉', '昆峰', '昆颉', '昆谊', '昆皓', '昆鹏', '昆明', '昆杰', '昆雄', '昆纶', '鹏涛', '鹏煊', '曦晨', '曦之', '新曦', '旭彬', '旭尧', '旭鹏', '旭东', '旭炎', '炫明', '宣朗', '学智', '轩昂', '彦昌', '曜坤', '曜栋', '曜文', '曜曦', '曜灿', '曜瑞', '智伟', '智杰', '智刚', '智阳', '昌勋', '昌盛', '昌茂', '昌黎', '昌燎', '昌翰', '晨朗', '昂然', '昂雄', '昂杰', '昂熙', '范明', '飞昂', '高朗', '高旻', '德明', '德昌', '德曜', '智伟', '智杰', '智刚', '智阳', '瀚彭', '旭炎', '宣朗', '学智', '昊然', '昊天', '昊苍', '昊英', '昊宇', '昊嘉', '昊明', '昊伟', '鸿朗', '华晖', '金鹏', '晋鹏', '敬曦', '景明', '景天', '景浩', '景行', '景中', '景逸', '景彰', '昆鹏', '昆明', '昆杰', '昆雄', '昆纶', '鹏涛', '鹏煊', '景平', '俊晖', '君昊', '昆琦', '昆鹏', '昆纬', '昆宇', '昆锐', '昆卉', '昆峰', '昆颉', '昆谊', '轩昂', '彦昌', '曜坤', '曜文', '曜曦', '曜灿', '曜瑞', '曦晨', '曦之', '新曦', '鑫鹏', '旭彬', '旭尧', '旭鹏', '旭东', '浩轩', '浩瀚', '浩慨', '浩阔', '鸿熙', '鸿羲', '鸿禧', '鸿信', '泽洋', '泽雨', '哲瀚', '胤运', '佑运', '允晨', '运恒', '运发', '云天', '耘志', '耘涛', '振荣', '振翱', '中震', '子辰', '晗昱', '瀚玥', '瀚昂', '瀚彭', '景行', '景中', '景逸', '景彰', '绍晖', '文景', '曦哲', '永昌', '子昂', '智宇', '智晖', '晗日', '晗昱', '瀚昂', '昊硕', '昊磊', '昊东', '鸿晖', '绍晖', '文昂', '文景', '曦哲', '永昌', '子昂', '智宇', '智晖', '浩然', '鸿运', '辰龙', '运珹', '振宇', '高朗', '景平', '鑫鹏', '昌淼', '炫明', '昆皓', '曜栋', '文昂', '恨桃', '依秋', '依波', '香巧', '紫萱', '涵易', '忆之', '幻巧', '美倩', '安寒', '白亦', '惜玉', '碧春', '怜雪', '听南', '念蕾', '紫夏', '凌旋', '芷梦', '凌寒', '梦竹', '千凡', '丹蓉', '慧贞', '思菱', '平卉', '笑柳', '雪卉', '南蓉', '谷梦', '巧兰', '绿蝶', '飞荷', '佳蕊', '芷荷', '怀瑶', '慕易', '若芹', '紫安', '曼冬', '寻巧', '雅昕', '尔槐', '以旋', '初夏', '依丝', '怜南', '傲菡', '谷蕊', '笑槐', '飞兰', '笑卉', '迎荷', '佳音', '梦君', '妙绿', '觅雪', '寒安', '沛凝', '白容', '乐蓉', '映安', '依云', '映冬', '凡雁', '梦秋', '梦凡', '秋巧', '若云', '元容', '怀蕾', '灵寒', '天薇', '翠安', '乐琴', '宛南', '怀蕊', '白风', '访波', '亦凝', '易绿', '夜南', '曼凡', '亦巧', '青易', '冰真', '白萱', '友安', '海之', '小蕊', '又琴', '天风', '若松', '盼菡', '秋荷', '香彤', '语梦', '惜蕊', '迎彤', '沛白', '雁彬', '易蓉', '雪晴', '诗珊', '春冬', '晴钰', '冰绿', '半梅', '笑容', '沛凝', '映秋', '盼烟', '晓凡', '涵雁', '问凝', '冬萱', '晓山', '雁蓉', '梦蕊', '山菡', '南莲', '飞双', '凝丝', '思萱', '怀梦', '雨梅', '冷霜', '向松', '迎丝', '迎梅', '雅彤', '香薇', '以山', '碧萱', '寒云', '向南', '书雁', '怀薇', '思菱', '忆文', '翠巧', '书文', '若山', '向秋', '凡白', '绮烟', '从蕾', '天曼', '又亦', '从语', '绮彤', '之玉', '凡梅', '依琴', '沛槐', '又槐', '元绿', '安珊', '夏之', '易槐', '宛亦', '白翠', '丹云', '问寒', '易文', '傲易', '青旋', '思真', '雨珍', '幻丝', '代梅', '盼曼', '妙之', '半双', '若翠', '初兰', '惜萍', '初之', '宛丝', '寄南', '小萍', '静珊', '千风', '天蓉', '雅青', '寄文', '涵菱', '香波', '青亦', '元菱', '翠彤', '春海', '惜珊', '向薇', '冬灵', '惜芹', '凌青', '谷芹', '雁桃', '映雁', '书兰', '盼香', '梅致', '寄风', '芳荷', '绮晴', '映之', '醉波', '幻莲', '晓昕', '傲柔', '寄容', '以珊', '紫雪', '芷容', '书琴', '美伊', '涵阳', '怀寒', '易云', '代秋', '惜梦', '宇涵', '谷槐', '怀莲', '英莲', '芷卉', '向彤', '新巧', '语海', '灵珊', '凝丹', '小蕾', '迎夏', '慕卉', '飞珍', '冰夏', '亦竹', '飞莲', '秋月', '元蝶', '春蕾', '怀绿', '尔容', '小玉', '幼南', '凡梦', '碧菡', '初晴', '宛秋', '傲旋', '新之', '凡儿', '夏真', '静枫', '芝萱', '恨蕊', '乐双', '念薇', '靖雁', '菊颂', '丹蝶', '元瑶', '冰蝶', '念波', '迎翠', '海瑶', '乐萱', '凌兰', '曼岚', '若枫', '傲薇', '雅芝', '乐蕊', '秋灵', '凤娇', '觅云', '依伊', '恨山', '从寒', '忆香', '香菱', '静曼', '青寒', '笑天', '涵蕾', '元柏', '代萱', '紫真', '千青', '雪珍', '寄琴', '绿蕊', '荷柳', '诗翠', '念瑶', '兰楠', '曼彤', '怀曼', '香巧', '采蓝', '芷天', '尔曼', '巧蕊'];
        $family = mb_substr($familyName, rand(0, mb_strlen($familyName) - 1), 1);
        $second = $secondName[rand(0, count($secondName))];
        return $family . $second;
    }
    //===================================================================生成随机字符串 end======================================================================


    //===================================================================文件上传 start======================================================================
    /**单文件上传
     * @param $fileInfo         上传文件数组
     * @param array $allowExt 允许上传的文件类型,默认（jpg,png,jpeg,gif）
     * @param int $maxSize 允许上传文件大小，默认2M
     * @param bool $flag 检测是否为真是的图片，默认检测
     * @param string $path 存储路径，默认当前脚本uploads文件见
     * @return string
     */
    public function uploadOne($fileInfo, $allowExt = array('jpg', 'png', 'jpeg', 'gif'), $maxSize = 2097152, $flag = true, $path = 'uploads/')
    {
        if ($fileInfo['error'] != 0) {
            switch ($fileInfo['error']) {
                case 1:
                    exit('上传文件超过了upload_max_filesize选项的值');
                    break;
                case 2:
                    exit('上传文件超过了max_file_size选项的值');
                    break;
                case 3:
                    exit('上传文件仅有部分上传');
                    break;
                case 4:
                    exit('没有选择要上传的文件');
                    break;
                case 6:
                    exit('临时目录不存在');
                    break;
                case 7:
                    exit('系统错误');
                    break;
                case 8:
                    exit('系统错误');
                    break;
            }
        }
        // 上传文件类型
        $ext = $this->getExt($fileInfo['name']);
        // 检测上传文件类型
        if (!in_array($ext, $allowExt)) {
            exit('非法上传文件类型！');
        }
        // 检测上传文件大小
        if ($fileInfo['size'] > $maxSize) {
            exit('上传文件过大！');
        }
        // 检测文件是否通过HTTP POST方式上传
        if (!is_uploaded_file($fileInfo['tmp_name'])) {
            exit('文件不是通过HTTP POST上传！');
        }
        // 检测是否是真实的图片
        if ($flag) {
            if (!getimagesize($fileInfo['tmp_name'])) {
                exit('不是真是的图片！');
            }
        }
        // 文件上传
        $path = $path . date('Ymd');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }
        $name = md5(uniqid(microtime(true), true)) . $ext;
        $newPath = $path . '/' . $name;
        if (!@move_uploaded_file($fileInfo['tmp_name'], $newPath)) {
            exit('文件上传失败！');
        }
        return $newPath;
    }

    /**构建上传文件数组
     * @param $files 上传文件
     * @return bool
     */
    public function getFile($files)
    {
        if (!$files) {
            return false;
        }
        $i = 0;
        foreach ($files as $file) {
            if (is_string($file['name'])) {
                $uploadFiles[$i] = $file;
                $i++;
            } elseif (is_array($file['name'])) {
                foreach ($file['name'] as $k => $v) {
                    $uploadFiles[$i]['name'] = $file['name'][$k];
                    $uploadFiles[$i]['type'] = $file['type'][$k];
                    $uploadFiles[$i]['tmp_name'] = $file['tmp_name'][$k];
                    $uploadFiles[$i]['error'] = $file['error'][$k];
                    $uploadFiles[$i]['size'] = $file['size'][$k];
                    $i++;
                }
            }
        }
        return $uploadFiles;
    }

    /**单文件，多个单文件，单个多文件，多个多文件上传
     * @param $fileInfo         上传文件数据
     * @param int $maxSize 允许上传文件的大小
     * @param array $allowExt 允许上传文件类型数组
     */
    public function uploadFiles($fileInfo, $maxSize = 1111, $allowExt = array('jpg', 'png', 'gif'))
    {
        if ($fileInfo['error'] != UPLOAD_ERR_OK) {
            switch ($fileInfo['error']) {
                case 1:
                    exit('上传文件超过了upload_max_filesize选项的值');
                    break;
                case 2:
                    exit('上传文件超过了max_file_size选项的值');
                    break;
                case 3:
                    exit('上传文件仅有部分上传');
                    break;
                case 4:
                    exit('没有选择要上传的文件');
                    break;
                case 6:
                    exit('临时目录不存在');
                    break;
                case 7:
                    exit('系统错误');
                    break;
                case 8:
                    exit('系统错误');
                    break;
            }
        }
        //  检测上传文件大小
        if ($fileInfo['size'] > $maxSize) {
            $res['msg'] = '上传文件过大！';
        }
        //  检测上传文件的类型
        $ext = $this->getExt($fileInfo['name']);
        if (!in_array($ext, $allowExt)) {
            $res['msg'] = '上传文件类型不符合规范！';
        }
        //  检测是否是HTTP POST方式上传
        if (!is_uploaded_file()) {
        }
    }
    //===================================================================文件上传 end======================================================================


    //===================================================================curl start======================================================================
    /**curl网络请求
     * @param string $url 请求url
     * @param array $data 请求参数
     * @param int $type 请求传参形式 1=array 2=json 3=queryString
     * @return array|bool|mixed|string
     */
    public function curlRequestResource($url, $data = [], $type = 1)
    {
        !extension_loaded('curl') ? exit('CURL NOT EXISTS!') : NULL;
        if (strlen($url) == 0 || !is_string($url)) return false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        if (count($data))
            curl_setopt($ch, CURLOPT_POST, 1);
        if ($type == 2) $data = json_encode($data);
        if ($type == 3) $data = http_build_query($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);;
        curl_close($ch);
        return $data;
    }
    //===================================================================curl end======================================================================


    //===================================================================格式化输出 start======================================================================
    /**格式化输出数组
     * @param $data
     */
    public function pt($data)
    {
        if (!is_array($data)) return false;
        echo '<pre>';
        print_r($data);
    }
    //===================================================================格式化输出 end======================================================================


    /**curl请求
     * 
     */
    function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
        exit();
    }




    /**将图片流输出到页面
     * 
     */
    function printImage($result)
    {
        $data = 'data:image/jpeg;base64,' . base64_encode($result); //补全base64加密字符串头
        $html = "<!DOCTYPE html>
                        <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <title>二维码</title>
                            </head>
                            <body>
                                <img src='$data'>
                            </body>
                    </html>";
        echo $html;
        exit;
    }


    /**
     * 根据经纬度和半径计算出范围
     * @param string $lat 纬度
     * @param String $lng 经度
     * @param float $radius 半径 单位：m
     * @return Array 范围数组
     */
    function CalcScope($lat, $lng, $radius)
    {
        $degree = (24901 * 1609) / 360.0;
        $dpmLat = 1 / $degree;

        $radiusLat = $dpmLat * $radius;
        $minLat = $lat - $radiusLat;    // 最小纬度
        $maxLat = $lat + $radiusLat;    // 最大纬度

        $mpdLng = $degree * cos($lat * (pi() / 180));
        $dpmLng = 1 / $mpdLng;
        $radiusLng = $dpmLng * $radius;
        $minLng = $lng - $radiusLng;   // 最小经度
        $maxLng = $lng + $radiusLng;   // 最大经度

        /** 返回范围数组 */
        $scope = array(
            'minLat'  => $minLat,
            'maxLat'  => $maxLat,
            'minLng'  => $minLng,
            'maxLng'  => $maxLng
        );
        return $scope;
    }
}

//===================================================================测试文件上传 start======================================================================
$obj = new rogerClass();
//echo '<pre>';print_r($_FILES);exit;
$file = $_FILES;
$obj->getFiles($file);
/*  文件上传需要配置form表单的提交方式为  method=‘post’
 *  还要配置 enctype='multipart/form-data'
 *
 *  文件上传变量数组
 *      上传文件名     [name] => abc.jpg
 *      上传文件类型     [type] => image/jpeg
 *      上传临时文件名     [tmp_name] => E:\xampp\tmp\php39.tmp
 *      上传错误信息     [error] => 0
 *      上传文件大小    [size] => 0
 *
 *  move_uploaded_file(临时文件，路径+文件名) 将服务器上的临时文件移动到指定目录下，返回bool值
 *  copy(临时文件，路径+文件名) 将服务器上的临时文件拷贝到指定目录下，返回bool值
 * */


/*  php.ini关于文件上传到配置选项
 *  file_uploads = on       支持http上传
 *  upload_tmp_dir =        临时文件存储位置
 *  post_max_size = 8M      POST方式发送数据的最大值(默认8M)
 *  upload_max_filesize = 2M  允许上传文件的最大值(默认2M)
 *  max_file_uploads = 20   允许一次上传文件数的最大值(默认20)
 * */
//===================================================================测试文件上传 end======================================================================