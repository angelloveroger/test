<?php

namespace app\index\controller;

use think\Log;

use think\queue\Job;
use think\Queue;


class QueueList
{
    /** 1.在项目目录安装类库 执行命令如下：
     * [root@oceanwayhn ~]# composer require topthink/think-queue
     */


    /** 2.配置队列驱动类型 可支持sync（默认） database(数据库) redis(推荐)
     *  return [
     *
     * // redis 驱动配置
     *      'connector'  => 'Redis',         // Redis 驱动
     *      'expire'     => 60,              // 任务的过期时间，默认为60秒; 若要禁用，则设置为 null
     *      'default'    => 'default',       // 默认的队列名称
     *      'host'       => '127.0.0.1',     // redis 主机ip
     *      'port'       => 6379,            // redis 端口
     *      'password'   => '',              // redis 密码
     *      'select'     => 0,               // 使用哪一个 db，默认为 db0
     *      'timeout'    => 0,               // redis连接的超时时间
     *      'persistent' => false,           // 是否是长连接
     *
     * //database 驱动配置 （如果选择database驱动 建表sql见下面）
     *      //    'connector' => 'Database',   // 数据库驱动
     *      //    'expire'    => 60,           // 任务的过期时间，默认为60秒; 若要禁用，则设置为 null
     *      //    'default'   => 'default',    // 默认的队列名称
     *      //    'table'     => 'jobs',       // 存储消息的表名，不带前缀
     *      //    'dsn'       => [],
     *
     * // ThinkPHP内部的队列通知服务平台 ，本文不作介绍
     *      //    'connector'   => 'Topthink',
     *      //    'token'       => '',
     *      //    'project_id'  => '',
     *      //    'protocol'    => 'https',
     *      //    'host'        => 'qns.topthink.com',
     *      //    'port'        => 443,
     *      //    'api_version' => 1,
     *      //    'max_retries' => 3,
     *      //    'default'     => 'default',
     *      //    'connector'   => 'Sync',       // Sync 驱动，该驱动的实际作用是取消消息队列，还原为同步执行
     * ];

     * // 如果选择database驱动 建表sql
     * CREATE TABLE `prefix_jobs` (
     *      `id` int(11) NOT NULL AUTO_INCREMENT,
     *      `queue` varchar(255) NOT NULL,
     *      `payload` longtext NOT NULL,
     *      `attempts` tinyint(3) unsigned NOT NULL,
     *      `reserved` tinyint(3) unsigned NOT NULL,
     *      `reserved_at` int(10) unsigned DEFAULT NULL,
     *      `available_at` int(10) unsigned NOT NULL,
     *      `created_at` int(10) unsigned NOT NULL,
     *      PRIMARY KEY (`id`)
     * ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     */


    /** 3.将要执行的任务放入队列中
     * @return string
     */
    public function pushJob()
    {
        // 1.当前任务将由哪个类/方法来负责处理
        $jobHandlerClassName = 'app\index\controller\QueueList@fireJob';
        /**
         * 如果需要使用默认的方法处理 只需指定控制器即可（这里就会执行 QueueList 下的 fire 方法）
         * $jobHandlerClassName = 'app\index\controller\QueueList';
         * */

        // 2.当前任务归属的队列名称，如果为新队列，会自动创建
        $jobQueueName = "JobQueue";

        // 3.当前任务所需的业务数据 . 不能为 resource 类型，其他类型最终将转化为json形式的字符串
        $jobData = ['type' => 1, 'data_id' => 12, 'ts' => time()];

        // 4.将该任务推送到消息队列，等待对应的消费者去执行（立即执行 在redis中存储为list类型 key为：queues:JobQueue）
        $isPushed = Queue::push($jobHandlerClassName, $jobData, $jobQueueName);
        /**
         * 这里调用 Queue::later 方法会延后执行（延后60秒执行 在redis中存储为zset类型 key为：queues:JobQueue:delayed）
         * $isPushed = Queue::later('60', $jobHandlerClassName, $laterData, $jobQueueName);
         */

        if ($isPushed !== false) {
            return '消息已发出';
        } else {
            return '消息发送出错';
        }
    }


    /**4.fire方法是消息队列默认调用的方法
     * @param Job $job 当前的任务对象
     * @param $data 发布任务时自定义的数据
     * @return int
     */
    public function fireJob(Job $job, $data)
    {
        // 这里$data定义格式为：$data = [ 'type'=>1, 'data_id' => 123,'ts' => time()]
        if (empty($data)) {
            return 0;
        }
        // 有些消息在到达消费者时,可能已经不再需要执行了
        /*$isJobStillNeedToBeDone = $this->checkDatabaseToSeeIfJobNeedToBeDone($data);
        if(!$isJobStillNeedToBeDone){
            $job->delete();
            return 0;
        }*/

        if (is_array($data) && isset($data['type'])) {
            $type = $data['type'];
            if ($type == 1) {
                $result = Log::write('fireJob:1', 'custom');
            } else if ($type == 2) {
                $result = Log::write('fireJob:2', 'custom');
            } else if ($type == 3) {
                $result = Log::write('fireJob:3', 'custom');
            } else {
                return 0;
            }
        } else {
            return 0;
        }
        if ($result) {
            // 如果任务执行成功，删除任务
            $job->delete();
        } else {
            if ($job->attempts() > 3) {
                //通过这个方法可以检查这个任务已经重试了几次了
                $job->delete();
                // 也可以重新发布这个任务
                //$job->release(2); //$delay为延迟时间，表示该任务延迟2秒后再执行
            }
        }
    }


    /**5.在系统中监听队列 JobQueue（须在框架 think 所在目前执行 比如thinkphp框架就需要在根目录执行）
     * 手动消费队列
     *      [root@oceanwayhn ~]# php think queue:work --queue JobQueue
     * 监听队列（不能关闭窗口）
     *      [root@oceanwayhn ~]# php think queue:listen --queue JobQueue
     * linux后台监听
     *      [root@oceanwayhn ~]# php think queue:listen --queue JobQueue &
     *
     */
}