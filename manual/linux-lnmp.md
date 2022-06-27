> # LINUX
> ---
> ### 1.linux下，php安装fileinfo扩展`（不安装这个扩展，会导致无法上传图片）`    
>> **A.检查系统是否安装了这个扩展**   
>> 
>>     php -i | grep fileinfo
>> **B.如果没有安装这个扩展，进行如下操作：`（[1]和[2]只需要执行一个即可）`**  
>>> *[1]如果本地没有php安装包*
>>>  
>>>     cd home   
>>>     wget http://cn2.php.net/distributions/php-5.6.36.tar.xz   
>>>     xz -d php-5.6.36.tar.xz  
>>>     tar xvf php-5.6.36.tar  
>>>     cd php-5.6.36/ext/fileinfo  
>>>  *[2]如果本地有php安装包，找到并进入该路径*
>>> 
>>>     find / -name fileinfo
>>>     cd 你的php路径/ext/fileinfo
>>> **在当前目录下执行以下操作：**     
>>>
>>>     /usr/local/php/bin/phpize   
>>>     ./configure --with-php-config=/usr/local/php/bin/php-config
>>>     make  
>>>     make install
>>
>> **C、修改php.ini**  
>>>     vim /usr/local/php/etc/php.ini
>>> **最后面增加** 
>>>     
>>>     extension=“fileinfo.so”
>>
>> **D.重启服务**
>>>     systemctl restart php-fpm
>>>     systemctl restart nginx  
>>> ---
>
> ### 2.linux下，php安装redis扩展     
>> **A.检查是否安装了redis扩展**  
>>  
>>      php -i | grep redis
>> **B.如果没有，获取并安装**
>>> **1.获取php-redis扩展**  
>>>
>>>      cd /root/source
>>>      wget https://github.com/phpredis/phpredis/archive/2.2.8.tar.gz
>>> **2.解压并进入目录**
>>>
>>>      tar -zxvf 2.2.8.tar.gz
>>>      cd phpredis-2.2.8/
>>> **3.找到phpize路径，用phpize生成configure配置文件**
>>>
>>>     whereis phpize
>>>     /usr/bin/phpize
>>> **4.找到php配置文件路径，并配置php-config，再编译安装（安装完成之后会生成安装路径）**
>>>
>>>     find / -name php-config
>>>     ./configure --with-php-config=/usr/local/php/bin/php-config
>>>     make
>>>     make install
>>> **5.配置php.ini支持**
>>>
>>>     vi /usr/local/php/etc/php.ini
>>> `文件中加上开启扩展选项`
>>>
>>>     extension=redis.so
>>
>> **C.重启php和nginx服务**
>>
>>      systemctl restart php-fpm
>>      systemctl restart nginx
