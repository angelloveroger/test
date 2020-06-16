<?php


// +----------------------------------------------------------------------
// | sitemap类
// +----------------------------------------------------------------------
namespace app\sitemap\lib;

class Sitemap
{
//类定义开始

    private $config = array(
        'encoding' => 'UTF-8',
        'ver' => '1.0',
    );
    private $content = '';
    // Items部分
    private $items = array();

    public function __get($name)
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }
        return null;
    }

    public function __set($name, $value)
    {
        if (isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    public function __isset($name)
    {
        return isset($this->config[$name]);
    }

    public function content($name)
    {
        if (empty($this->content)) {
            $this->Build();
        }

        $this->content;
    }

    /**
     * 架构函数
     * @access public
     * @param array $config  上传参数
     */
    public function __construct()
    {

    }

    /*     * *********************************************************************** */

    // 函数名: AddItem
    // 功能: 添加一个节点
    //$changefreq | always 经常,hourly 每小时,daily 每天,weekly 每周,monthly 每月,yearly 每年,never 从不
    //$mobile | mobile 跳转适配, htmladapt 代码适应,  pc,mobile 自适应
    /*     * *********************************************************************** */

    public function AddItem($loc, $priority, $changefreq = 'Always', $time = 0, $mobile = "pc,mobile")
    {
        $arr = array(
            '1.0',
            '0.9',
            '0.8',
            '0.7',
            '0.6',
            '0.5',
        );
        $this->items[] = array(
            'loc' => $loc,
            'priority' => $arr[$priority],
            'lastmod' => $time ? (is_numeric($time) ? date('Y-m-d H:i:s', $time) : $time) : date('Y-m-d H:i:s', time()),
            'changefreq' => $changefreq,
            'mobile' => $mobile,
        );
    }

    /*     * *********************************************************************** */

    // 函数名: Build
    // 功能: 生成sitemap xml文件内容
    /*     * *********************************************************************** */
    public function Build()
    {
        $s = "<?xml version='1.0' encoding='{$this->encoding}'?>\r\n";
        /* $s .= "<?xml-stylesheet type='text/xsl' href='sitemap.xsl'?>\r\n";*/
        $s .= "\t<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\r\n";
        // items
        for ($i = 0; $i < count($this->items); $i++) {
            $s .= "\t\t<url>\n";
            $s .= "\t\t\t<loc>{$this->items[$i]['loc']}</loc>\r\n";
            $s .= "\t\t\t<priority>{$this->items[$i]['priority']}</priority>\r\n";
            $s .= "\t\t\t<lastmod>{$this->items[$i]['lastmod']}</lastmod>\r\n";
            $s .= "\t\t\t<changefreq>{$this->items[$i]['changefreq']}</changefreq>\r\n";
            /*$s .= "\t\t\t<mobile:mobile type=\"{$this->items[$i]['mobile']}\"/>\r\n";*/
            $s .= "\t\t</url>\n";
        }
        // close
        $s .= "\t</urlset>";
        $this->content = $s;
    }

    /*     * *********************************************************************** */

    // 函数名: Show
    // 功能: 将产生的sitemap内容直接打印输出
    /*     * *********************************************************************** */
    public function Show()
    {
        if (empty($this->content)) {
            $this->Build();
        }

        header("Content-Type: text/xml; charset=utf-8");
        echo ($this->content);
    }

    /*     * *********************************************************************** */

    // 函数名: SaveToFile
    // 功能: 将产生的sitemap 内容保存到文件
    // 参数: $fname 要保存的文件名
    /*     * *********************************************************************** */
    public function SaveToFile($fname)
    {
        if (empty($this->content)) {
            $this->Build();
        }

        $handle = fopen($fname, 'w+');
        if ($handle === false) {
            return false;
        }

        fwrite($handle, $this->content);
        fclose($handle);
    }

    /*     * *********************************************************************** */

    // 函数名: getFile
    // 功能: 从文件中获取输出
    // 参数: $fname 文件名
    /*     * *********************************************************************** */
    public function getFile($fname)
    {
        $handle = fopen($fname, 'r');
        if ($handle === false) {
            return false;
        }

        while (!feof($handle)) {
            echo fgets($handle);
        }
        fclose($handle);
    }

}
