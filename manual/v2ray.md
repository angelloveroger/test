# v2ray安装

-  ### 确保vps和客户端时间差不超过 `90秒`
> - *1.查看服务器时间*    
>    
>>  ``` [root@vm427138 ~]# date ```    
>>
>> --- 
>
> - *设置服务器时间（2022-06-23 18:50:50）*      
>> ``` [root@vm427138 ~]# date -s 06/23/2022 ```        
>> ``` [root@vm427138 ~]# date -s 18:50:50 ```  
> ---   
 - ### *安装分为：*  
> *`1.脚本安装`*   
>> ``` [root@vm427138 ~]# wget https://install.direct/go.sh ```   
>> ``` [root@vm427138 ~]# ./go.sh ```  
>     
> - **安装完成之后**   
> - *有一行 `"PORT:40827"` 代表着端口号为 `40827`*     
> - *还有一行 `"UUID:505f001d-4aa8-4519-9c54-6b65749ee3fb"` 代表着 id 为505f001d-4aa8-4519-9c54-6b65749ee3fb`*   
> - *端口号和id均为随机生成*  
> - *启动V2Ray*   
>> ``` [root@vm427138 ~]# systemctl start v2ray```  
>>  
>> ---
> *`2.手动安装`*    
>>
>> ---
>
> *`3.编译安装`*  
>
> --- 
-  ### *启动服务之后  需要关闭 `ipv6` 还需要开放相应的端口（或者关闭防火墙）* 
> *1.查看是否启用ipv6*
>> ``` [root@vm427138 ~]# ifconfig ```   
>> 
>> ---
>>
> *2.禁用 `ipv6` 【禁用全部网卡：all；禁用eth0：eth0】*
>> *a.临时禁用*            
>>> ``` [root@vm427138 ~]# sh -c 'echo 1 > /proc/sys/net/ipv6/conf/all/disable_ipv6' ```   
>>>
>>>  ---
>> *b.永久禁用*          
>> - *1.编辑网卡配置文件*
>>> ``` [root@vm427138 ~]# vim /etc/sysctl.conf ```             
>>
>> - *2.在文件中添加以下内容*    
>>> `net.ipv6.conf.all.disable_ipv6=1`      
>> - *3.然后重启服务以使更改生效*       
>>> ``` [root@vm427138 ~]# sysctl -p /etc/sysctl.conf ```
>>>
>>> ---
> *3.禁用防火墙 【启用/重启/停用/状态】*
>> ``` [root@vm427138 ~]# systemctl start/restart/stop/status firewalld ```    
> ---













