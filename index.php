<?php
echo 1;


// $str = '<p><span style=\"font-size: 14px;\">以上价格为出厂价，最终价格以签署合同为准！</span><br></p><p><span style=\"font-size: 14px;\">详情请电话或发送邮件咨询。</span></p><div><br></div>';
// ehco 1;
// preg_match('[\u4e00-\u9fa5]', $str, $arr)
// echo '<pre>';
// print_r($arr);


exit();

$str = '1,2,3,5,6,87';

//var_dump(trim(str_replace(',,', ',', str_replace('3', '', $str)), ','));
$arr = explode(',', $str);
var_dump(array_diff($arr, [87]));

exit();


/*
$goodsList = [
    ['id' => 1, 'name' => 'roger'],
    ['id' => 2, 'name' => 'angel'],
    ['id' => 3, 'name' => 'venus'],
    ['id' => 4, 'name' => 'albert'],
    ['id' => 5, 'name' => 'elisa'],
];

$insertArr = [
    'id'   => 555,
    'offset' => 3, // 插入的位置
    'name' => 'roger'
];

$tmp1 = array_slice($goodsList, 0, $insertArr['offset'] - 1);

$tmp2 = array_slice($goodsList, $insertArr['offset'] - 1);

array_unshift($tmp2, $insertArr);

$res = array_merge($tmp1, $tmp2);

echo '<pre>';
print_r($res);

// echo json_encode($res);
*/

/* 身份证
$idNumberRule = '/^[1-9]{1}\d{16}[\d|x]$/i';
$idNumber = '12345678912345679X';
var_dump(preg_match($idNumberRule, $idNumber));
*/

/* 邮箱
$emailRule = '/^[\d|a-z|A-Z]+[\d|a-z|A-Z|_|-|.]*@[\d|a-z]+\.[a-z]{2,4}$/i';
$str = 'roger.angel@163.com';
var_dump(preg_match($emailRule, $str));
*/

/* 手机号
$phoneRule = '/^[13|14|15|16|17|18]{2}\d{9}$/';
$str = '186171151502';
var_dump(preg_match($phoneRule, $str));

exit;
*/


/*
$str= <<<EOF
<div class="para " label-module="para " data-pid="7 " style="font-size: 14 px;overflow-wrap: break-word;color: rgb(51,
51,
51);margin-bottom: 15 px;text-indent: 2 em;line-height: 24 px;zoom: 1;font-family: " helvetica="" neue",
=""helvetica,
=""arial,
="""pingfang="" sc",
="""hiragino="" sans="" gb",
="""microsoft="" yahei",
="""wenquanyi="" micro="" hei",
=""sans-serif;"=""><img src="localwork/uploads/20220308/9 de232b68974ecf3ec30cb44249c3f4e.jpg " style="width: 612 px;" data-filename="filename ">费鲁齐欧·兰博基尼（一作“<a target="_blank " href="https: //baike.baidu.com/item/%E8%B4%B9%E9%B2%81%E5%90%89%E6%AC%A7%C2%B7%E5%85%B0%E5%8D%9A%E5%9F%BA%E5%B0%BC" style="color: rgb(19, 110, 194);">费鲁吉欧·兰博基尼</a>”）曾是一个生活在意大利北部的艾米利亚-罗马涅大区费拉拉省的青年。在二战期间是一名意大利皇家空军的机械师，在那之后他进入一个家基于二战军事设施建造的商业拖拉机厂。在20世纪50年代中期，兰博基尼的<a target="_blank" href="https://baike.baidu.com/item/%E6%8B%96%E6%8B%89%E6%9C%BA/84458" data-lemmaid="84458" style="color: rgb(19, 110, 194);">拖拉机</a>厂，即兰博基尼拖拉机有限公司，已成为全国最大的农业设备制造商之一。同时他还拥有一个成功的<a target="_blank" href="https://baike.baidu.com/item/%E7%87%83%E6%B0%94%E7%83%AD%E6%B0%B4%E5%99%A8/3346070" data-lemmaid="3346070" style="color: rgb(19, 110, 194);">燃气热水器</a>和空调生产商。</div><div class="para" label-module="para" data-pid="8" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"="">1958年，他购买了第一辆<a target="_blank" href="https://baike.baidu.com/item/%E6%B3%95%E6%8B%89%E5%88%A9/159977" data-lemmaid="159977" style="color: rgb(19, 110, 194);">法拉利</a>汽车，一台250GT，之后又买了一些。费鲁齐欧·兰博基尼很喜欢法拉利汽车，但是他认为，对于普通的道路来说，法拉利汽车显得十分粗狂和嘈杂，显然更适合赛道。当费鲁齐欧·兰博基尼的法拉利<a target="_blank" href="https://baike.baidu.com/item/%E6%B1%BD%E8%BD%A6%E7%A6%BB%E5%90%88%E5%99%A8/52860" data-lemmaid="52860" style="color: rgb(19, 110, 194);">汽车离合器</a>出现问题后，他发现法拉利所使用的汽车离合器竟然和兰博基尼拖拉机所使用的离合器一模一样。费鲁齐欧·兰博基尼去找法拉利要求其更换一个质量更好的离合器却遭到了拒绝。法拉利说，费鲁齐欧·兰博基尼只是一个拖拉机制造商，因此对于运动跑车他一无所知。于是兰博基尼决定建立一个汽车制造工厂来实现他对于运动跑车的完美追求。</div><div class="para" label-module="para" data-pid="9" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"="">兰博基尼汽车公司是一家坐落于意大利圣亚加塔·波隆尼的跑车制造商。公司由费鲁吉欧·兰博基尼在1963年创立。创始人费鲁吉欧·兰博基尼年轻时曾是意大利皇家空军的一名机械师，由于工作的原因，费鲁吉欧对机械原理非常熟悉。二战之后，大量的军用物资被遗弃，费鲁吉欧·兰博基尼开始使用这些剩余军用物资制造拖拉机，并成立了最初的兰博基尼公司，主营业务是制造拖拉机、燃油器和空调系统。20世纪50年代中期，由于对机械原理和机械制造的精通，以及极佳的商业头脑，兰博基尼公司成为了当时最大的农用机械制造商。</div><div class="para" label-module="para" data-pid="10" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"="">事业成功的费鲁吉欧·兰博基尼极为喜欢跑车，拥有包括<a target="_blank" href="https://baike.baidu.com/item/%E9%98%BF%E5%B0%94%E6%B3%95%C2%B7%E7%BD%97%E5%AF%86%E6%AC%A7/2009865" data-lemmaid="2009865" style="color: rgb(19, 110, 194);">阿尔法·罗密欧</a>、<a target="_blank" href="https://baike.baidu.com/item/%E8%93%9D%E6%97%97%E4%BA%9A/654584" data-lemmaid="654584" style="color: rgb(19, 110, 194);">蓝旗亚</a>、<a target="_blank" href="https://baike.baidu.com/item/%E7%8E%9B%E8%8E%8E%E6%8B%89%E8%92%82/44776" data-lemmaid="44776" style="color: rgb(19, 110, 194);">玛莎拉蒂</a>、<a target="_blank" href="https://baike.baidu.com/item/%E6%A2%85%E8%B5%9B%E5%BE%B7%E6%96%AF-%E5%A5%94%E9%A9%B0/7833086" data-lemmaid="7833086" style="color: rgb(19, 110, 194);">梅赛德斯-奔驰</a>等多款名车。1958年费鲁吉欧·兰博基尼拥有了自己第一辆法拉利250 GT，而兰博基尼最终转为制造自己的汽车也是源于自己所拥有的250 GT。也体现了兰博基尼的品牌特性。公司的商标省去了公司名，只剩下一头犟牛。</div><div class="para" label-module="para" data-pid="11" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"=""><div class="lemma-picture J-lemma-picture text-pic layout-right" style="border: 1px solid rgb(224, 224, 224); overflow: hidden; margin: 0px 0px 3px 20px; position: relative; float: right; clear: right; width: 220px;"><a class="image-link" nslog-type="9317" href="https://baike.baidu.com/pic/%E5%85%B0%E5%8D%9A%E5%9F%BA%E5%B0%BC/246705/0/8ad4b31c8701a18b646508639c2f07082838fe14?fr=lemma&amp;ct=single" target="_blank" title="费鲁齐欧·兰博基尼" style="color: rgb(19, 110, 194); display: block; width: 220px; height: 136.791px;"><img class="" src="https://bkimg.cdn.bcebos.com/pic/8ad4b31c8701a18b646508639c2f07082838fe14?x-bce-process=image/resize,m_lfit,w_440,limit_1/format,f_auto" alt="费鲁齐欧·兰博基尼" style="display: block; margin: 0px auto; width: 220px; height: 136.791px;"></a><span class="description" style="display: block; color: rgb(85, 85, 85); font-size: 12px; text-indent: 0px; font-family: 宋体; overflow-wrap: break-word; word-break: break-all; line-height: 24px; padding: 8px 7px; min-height: 12px; border-top: 1px solid rgb(224, 224, 224);">费鲁齐欧·兰博基尼</span></div>关于费鲁吉欧·兰博基尼建立公司的原因有多种说法，流传最为广泛的版本是：有一天费鲁吉欧·兰博基尼和恩佐·法拉利（Enzo Ferrari）谈论250 GT的缺点时，恩佐对费鲁吉欧说：“用不着制造农业机械车辆的人，告诉我如何制造跑车。”这句话伤害了费鲁吉欧的自尊心，自此费鲁吉欧开始研究属于自己的跑车。而另一个版本却更具真实性，经由费鲁吉欧·兰博基尼的儿子<a target="_blank" href="https://baike.baidu.com/item/%E4%B8%9C%E5%B0%BC%E8%AF%BA%C2%B7%E5%85%B0%E5%8D%9A%E5%9F%BA%E5%B0%BC" style="color: rgb(19, 110, 194);">东尼诺·兰博基尼</a>口述。驾驶法拉利250 GT的费鲁吉欧，投诉由于法拉利车辆离合器出现问题，导致比赛车辆失控，误伤观赏赛车的民众。然而，恩佐·法拉利非但不理睬，还告诉费鲁吉欧·兰博基尼没能力驾驶法拉利250 GT，只适合驾驶农业机械车辆。后来，费鲁吉欧·兰博基尼在自己公司仓库里，找到一个合适的备用配件安装，解决了法拉利250 GT的问题。此后对跑车极度热衷的费鲁吉欧·兰博基尼开始考虑生产可以满足自己需求的跑车，比法拉利更好的跑车。</div><div class="para" label-module="para" data-pid="12" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"="">现任总裁兼首席执行官<a target="_blank" href="https://baike.baidu.com/item/%E5%8F%B2%E8%92%82%E8%8A%AC%C2%B7%E6%B8%A9%E7%A7%91%E5%B0%94%E6%9B%BC" style="color: rgb(19, 110, 194);">史蒂芬·温科尔曼</a>在追忆兰博基尼的品牌创始人时表示：“费鲁吉欧·兰博基尼曾经说过，生产世界最佳赛车是毫无意义的，因为人们只会记住赛车手。但若你能够生产出世界最佳汽车，人们会永远将它们铭记于心。几十年前，兰博基尼打造了非凡的Miura，它无疑是时年世界上最优秀的汽车之一。如今，兰博基尼仍旧秉持这一一贯的传统，奉献出世界上杰出的高性能超级汽车。”</div><div class="para" label-module="para" data-pid="13" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"=""><div class="lemma-picture J-lemma-picture text-pic layout-right" style="border: 1px solid rgb(224, 224, 224); overflow: hidden; margin: 0px 0px 3px 20px; position: relative; float: right; clear: right; width: 220px;"><a class="image-link" nslog-type="9317" href="https://baike.baidu.com/pic/%E5%85%B0%E5%8D%9A%E5%9F%BA%E5%B0%BC/246705/0/faedab64034f78f0d3707e7278310a55b3191c33?fr=lemma&amp;ct=single" target="_blank" title="兰博基尼Reventon" style="color: rgb(19, 110, 194); display: block; width: 220px; height: 165px;"><img class="" src="https://bkimg.cdn.bcebos.com/pic/faedab64034f78f0d3707e7278310a55b3191c33?x-bce-process=image/resize,m_lfit,w_440,limit_1/format,f_auto" alt="兰博基尼Reventon" style="display: block; margin: 0px auto; width: 220px; height: 165px;"></a><span class="description" style="display: block; color: rgb(85, 85, 85); font-size: 12px; text-indent: 0px; font-family: 宋体; overflow-wrap: break-word; word-break: break-all; line-height: 24px; padding: 8px 7px; min-height: 12px; border-top: 1px solid rgb(224, 224, 224);">兰博基尼Reventon</span></div>在意大利乃至全世界，兰博基尼是诡异的。它神秘地诞生于世，出人意料地推出一款又一款的性能不凡的高性能车，它是恶魔但并非要<a target="_blank" href="https://baike.baidu.com/item/%E8%B9%82%E8%BA%8F" style="color: rgb(19, 110, 194);">蹂躏</a>这个世界，只因其风格的另类。兰博基尼是举世难得的艺术品，意大利最具声望的设计大师甘迪尼为其倾注一生的心血。每一个棱角、每一道线条都是如此激昂，都在默默诠释着兰博基尼那近乎原始的野性之美。公司的标志是一头浑身充满了力气，正准备向对手发动猛烈攻击的犟牛。据说兰博基尼本人就是这种不甘示弱的牛脾气，也体现了兰博基尼公司产品的特点。因为公司生产的汽车都是大功率、高速的运动型汽车。车头和车尾上的商标省去了公司名，只剩下一头犟牛。</div><div class="para" label-module="para" data-pid="14" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"="">1963年，兰博基尼的汽车工厂在<a target="_blank" href="https://baike.baidu.com/item/%E6%84%8F%E5%A4%A7%E5%88%A9/148336" data-lemmaid="148336" style="color: rgb(19, 110, 194);">意大利</a>的Sant'Agata Bolognese正式成立，费鲁吉欧·兰博基尼开始召集属于自己的设计团队。第一个兰博基尼的底盘是由来自法拉利的工程师Gian Paolo Dallara、大学毕业生Paolo Stanzani和Bob Wallance等成员组成的团队打造的，这个底盘的改进版本用于兰博基尼的第一款跑车350 GTV，并于同年10月在都灵车展上正式发布。</div><div class="para" label-module="para" data-pid="14" style="font-size: 14px; overflow-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: " helvetica="" neue",="" helvetica,="" arial,="" "pingfang="" sc",="" "hiragino="" sans="" gb",="" "microsoft="" yahei",="" "wenquanyi="" micro="" hei",="" sans-serif;"=""><img src="/uploads/20220308/60520d4da7ffd8f3018f3d4f025af61d.jpeg" style="width: 640px;" data-filename="filename"><br></div
EOF;


$findStr = '<img src="/uploads';
$strr = '<img src="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/uploads';
$new = str_replace($findStr, $strr, $str);
echo $new;
*/

/*
$arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];

array_splice($arr, 5, 0, 'x');

var_dump($arr);
*/

/*
$data = [
    ['id' => '1', 'name' => '新艇销售'],
    ['id' => '2', 'name' => '二手艇销售'],
    ['id' => '3', 'name' => '游艇驾照培训'],
    ['id' => '4', 'name' => '帆船驾照培训'],
    ['id' => '5', 'name' => '游艇配件'],
    ['id' => '6', 'name' => '周边产品'],
    ['id' => '7', 'name' => '游艇租赁'],
    ['id' => '8', 'name' => '游艇会'],
    ['id' => '9', 'name' => '其他']
];
echo str_replace('name', 'text', str_replace('id',  'value', json_encode($data)));
echo '<pre>';
print_r($data);
*/

/*
$data = [
    ['id' => '1', 'name' => '新艇销售'],
    ['id' => '2', 'name' => '二手艇销售'],
    ['id' => '3', 'name' => '游艇驾照培训'],
    ['id' => '4', 'name' => '帆船驾照培训'],
    ['id' => '5', 'name' => '游艇配件'],
    ['id' => '6', 'name' => '周边产品'],
    ['id' => '7', 'name' => '游艇租赁'],
    ['id' => '8', 'name' => '游艇会'],
    ['id' => '9', 'name' => '其他']
];

foreach($data as $val){
    if($val['id'] == '5'){
        continue;
    }
    echo $val['id'].'======'.$val['name'].'<hr/>';
}
*/

/*
$a = 30;
echo base_convert($a, 10, 16);
echo '<hr />';
echo $a<<1;
echo '<hr />';
echo $a>>1;
*/

ini_set('display_errors', 1);

/*  创建二维码
include './vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

define('BASE_PATH', './');
$data = 'name=roger&sex=men';
$writer = new PngWriter();
$qrCode = QrCode::create($data)
->setEncoding(new Encoding('UTF-8'))
    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
    ->setSize(150)//大小
    ->setMargin(5)//边距
    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->setForegroundColor(new Color(0, 0, 0))
    ->setBackgroundColor(new Color(255, 255, 255));

// 二维码下面的文字
$label = Label::create('扫码购买')
    ->setTextColor(new Color(0, 0, 0));

// 二维码中心图片
$logo = Logo::create(BASE_PATH . '1.jpg')
    ->setResizeToWidth(5);
$result = $writer->write($qrCode, $logo, $label);


$result = $writer->write($qrCode, null, null);

$result->getString();
//二维码文件名称
$qrcode = 5 . '_' . 10 . '_' . time() . '.png';
$result->saveToFile(BASE_PATH . $qrcode);
*/

$arr = [true, false];
$bool = in_array('hello kitty', $arr);
var_dump($bool);

