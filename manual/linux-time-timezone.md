## Linux时间-时区问题

> ***1.先查看一下当前的时间，下面这个例子中使用 UTC 即世界统一标准时区***
>> ``` [root@vm427138 v2ray] date ```         
>> ``` Mon Jul 25 11:11:32 UTC 2022 ```   
>> - *也可查看当前时间时区为 `UTC`*    
>> 
>> ``` [root@vm427138 v2ray] data -R ```     
>> ``` Mon, 25 Jul 2022 11:11:33 +0000 ```      
> ---       
> ***2.在某些发行版的 Linux 系统（比如 CentOS）中，系统时区是由 `/etc/localtime` 文件控制的，所以可以通过修改 `/etc/localtime` 文件来修改系统时区。***
>> - *a.删除 /etc/localtime 文件*       
>> ``` [root@vm427138 v2ray] rm -rf /etc/localtime ```       
>> - *b.查看亚洲时区文件*       
>> ``` [root@vm427138 v2ray] ls /usr/share/zoneinfo/Asia ```        
>> - *c.一般国内用 `Shanghai` 或者 `Chongqing` 时间*    
> ---     
> ***3.创建一个软连接 `/etc/localtime` ，指向上述 `Asia` 目录中的 `Shanghai` 或者 `Chongqing` 文件***     
>> ``` [root@vm427138 v2ray] ls -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime ```        
> ---
> ***4.再次查看时间***      
>> ``` [root@vm427138 v2ray] data ```  
>> ``` Mon Jul 25 11:11:32 CST 2022  ```  
>         
>> - *也可查看当前时间时区为 `东八区时`*    
>> 
>> ``` [root@vm427138 v2ray] data -R ```     
>> ``` Mon, 25 Jul 2022 11:22:33 +0800 ```



