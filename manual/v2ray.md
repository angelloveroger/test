> ### v2ray安装
>> - ### 确保vps和客户端时间差不超过 `90秒`
>> - *查看服务器时间*    
>>>  ``` [root@vm427138 ~]# date ```    
>>>
>>
>> - *设置服务器时间（2022-06-23 18:50:50）*      
>>> ``` [root@vm427138 ~]# date -s 06/23/2022 ```        
>>> ``` [root@vm427138 ~]# date -s 18:50:50 ```  
>> ---   
>> - ### *安装分为：*  
>> - *`1.脚本安装`*   
>>> ``` [root@vm427138 ~]# wget https://install.direct/go.sh ```   
>>> ``` [root@vm427138 ~]# ./go.sh ```  
>>>     
>>> - **安装完成之后**   
>>> - *有一行 `"PORT:40827"` 代表着端口号为 `40827`*     
>>> - *还有一行 `"UUID:505f001d-4aa8-4519-9c54-6b65749ee3fb"` 代表着 id 为505f001d-4aa8-4519-9c54-6b65749ee3fb`*   
>>> - *端口号和id均为随机生成*  
>>> - *启动V2Ray*   
>>>> ``` [root@vm427138 ~]# systemctl start v2ray```  
>>  
>> ---
>> *`2.手动安装`*    
>>
>> ---
>> 
>>  *`3.编译安装`*  
>> 
>>  --- 
>> - ### *启动服务之后  需要关闭 `ipv6` 还需要开放相应的端口（或者关闭防火墙）* 
>>  *1.查看是否启用ipv6*       
>>> ``` [root@vm427138 ~]# ifconfig ```   
>> 
>> *2.禁用 `ipv6` 【禁用全部网卡：all；禁用eth0：eth0】*       
>> - *a.临时禁用*            
>>> ``` [root@vm427138 ~]# sh -c 'echo 1 > /proc/sys/net/ipv6/conf/all/disable_ipv6' ```   
>>>
>> - *b.永久禁用*          
>>> *1.编辑网卡配置文件*
>>> ``` [root@vm427138 ~]# vim /etc/sysctl.conf ```             
>>>
>>> - *2.在文件中添加以下内容*    
>>>> `net.ipv6.conf.all.disable_ipv6=1`      
>>> - *3.然后重启服务以使更改生效*       
>>>> ``` [root@vm427138 ~]# sysctl -p /etc/sysctl.conf ```
>>>
>> *3.禁用防火墙 【启用/重启/停用/状态】*       
>>> ``` [root@vm427138 ~]# systemctl start/restart/stop/status firewalld ```    
> ---


> ### trojan安装 
>> - *trojan一键安装脚本*       
>>> ``` [root@vm427138 ~]#  wget -N --no-check-certificate -q -O trojan_install.sh "https://raw.githubusercontent.com/V2RaySSR/Trojan/master/trojan_install.sh" && chmod +x trojan_install.sh && bash trojan_install.sh ```         
>>
>> - *trojan官方安装*       
>>> ``` [root@vm427138 ~]#  sudo bash -c "$(curl -fsSL https://raw.githubusercontent.com/trojan-gfw/trojan-quickstart/master/trojan-quickstart.sh)" ```         
> ---


> ### 防火墙相关
>> - *防火墙状态*   
>>> ``` [root@vm427138 ~]# firewall-cmd --state  ```   
>>
>> - *开放端口*  
>>> ``` [root@vm427138 ~]# firewall-cmd --list-ports ```  
>> 
>> - *添加[移除]端口*   
>>> ``` [root@vm427138 ~]# firewall-cmd --permanent --zone=public --add[/remove]-port=443/tcp ```   
>>
>> - *检查配置*   
>>> ``` [root@vm427138 ~]# firewall-cmd --check-config ```   
>>
>> - *重启防火墙*  
>>> ``` [root@vm427138 ~]# firewall-cmd --reload ```   
>>
>> - *开启/停止/状态/重启*  
>>> ``` [root@vm427138 ~]# systemctl start[/stop/status/restart] firewalld ```   
> ---

> ### NGINX相关  
>> - *彻底移除nginx*   
>>> *1.是否正在运行*   
>>>> ``` [root@vm427138 ~]# ps -ef | grep nginx ```    
>>>             
>>> *2.停止nginx服务*       
>>>> ``` [root@vm427138 ~]# systemctl stop nginx ```
>>>     
>>> *3.查找nginx相关文件*       
>>>> ``` [root@vm427138 ~]# whereis nginx ```      
>>>> ``` [root@vm427138 ~]# ps -ef | grep nginx```
>>>     
>>> *4.移除相关文件和文件夹*    
>>>> ``` [root@vm427138 ~]# rm -rf [file/path]```    
>>>     
>>> *5.移除安装*        
>>>> ``` [root@vm427138 ~]# yum remove nginx ```     
>> ---      
>> - *官方安装*        
>>> *1.安装先决条件*        
>>>> ``` [root@vm427138 ~]# yum install yum-utils ``` 
>>>     
>>> *2.要设置 yum 存储库，请使用以下内容创建名为 `/etc/yum.repos.d/nginx.repo` 的文件*      
>>>> ``` [root@vm427138 ~]# vim /etc/yum.repos.d/nginx.repo ```
>>>
>>>> - #源配置文件如下           
>>>> ``` [nginx-stable] ```         
>>>> ``` name=nginx stable repo ```         
>>>> ``` baseurl=http://nginx.org/packages/centos/$releasever/$basearch/ ```        
>>>> ``` gpgcheck=1 ```         
>>>> ``` enabled=1 ```      
>>>> ``` gpgkey=https://nginx.org/keys/nginx_signing.key ```        
>>>> ``` module_hotfixes=true ```       
>>>> ```  ```       
>>>> ``` [nginx-mainline] ```       
>>>> ``` name=nginx mainline repo ```       
>>>> ``` baseurl=http://nginx.org/packages/mainline/centos/$releasever/$basearch/ ```       
>>>> ``` gpgcheck=1 ```         
>>>> ``` enabled=0 ```      
>>>> ``` gpgkey=https://nginx.org/keys/nginx_signing.key ```        
>>>> ``` module_hotfixes=true ```       
>>>
>>> *3.默认情况下，使用稳定 nginx 包的存储库。 如果您想使用主线 nginx 包，请运行以下命令*        
>>>> ``` [root@vm427138 ~]# yum-config-manager --enable nginx-mainline ```
>>>
>>> *4.要安装 nginx，请运行以下命令*    
>>>> ``` [root@vm427138 ~]# yum install nginx ```       
> ---









