> ## `Linux` 时间-时区相关
>> ***1.先查看一下当前的时间，下面这个例子中使用 UTC 即世界统一标准时区***
>>  ``` 
>>  [root@vm427138 v2ray] date          
>>  Mon Jul 25 11:11:32 UTC 2022 
>>  ```   
>>> - *也可查看当前时间时区为 `UTC`*    
>>>   ``` 
>>>   [root@vm427138 v2ray] date -R     
>>>   Mon, 25 Jul 2022 11:11:33 +0000 
>>>   ```      
>> ---       
>> ***2.在某些发行版的 Linux 系统（比如 CentOS）中，系统时区是由 `/etc/localtime` 文件控制的，所以可以通过修改 `/etc/localtime` 文件来修改系统时区。***
>>> - *a.删除 /etc/localtime 文件*          
>>>   ``` 
>>>   [root@vm427138 v2ray] rm -rf /etc/localtime 
>>>   ```       
>>> - *b.查看亚洲时区文件*       
>>>   ``` 
>>>   [root@vm427138 v2ray] ls /usr/share/zoneinfo/Asia 
>>>   ```           
>>> - *c.创建一个软连接 `/etc/localtime` ，指向上述 `Asia` 目录中的 `Shanghai` 或者 `Chongqing` 文件*     
>>>   ``` 
>>>   [root@vm427138 v2ray] ln -s /usr/share/zoneinfo/Asia/Shanghai /etc/localtime 
>>>   ```        
>> ---
>> ***3.再次查看时间***      
>> ``` 
>> [root@vm427138 v2ray] date  
>> Mon Jul 25 11:11:32 CST 2022  
>> ```         
>>> - *也可查看当前时间时区为 `东八区时`*    
>>>   ``` 
>>>   [root@vm427138 v2ray] date -R     
>>>   Mon, 25 Jul 2022 11:22:33 +0800 
>>>   ```
> ---    

> ## `ipv6` 相关
>>  *1.查看是否启用ipv6*       
>> ``` 
>> [root@vm427138 ~]# ifconfig 
>> ```   
>> ---
>> *2.禁用 `ipv6` 【禁用全部网卡：all；禁用eth0：eth0】*       
>> - *a.临时禁用*            
>>   ``` 
>>   [root@vm427138 ~]# sh -c 'echo 1 > /proc/sys/net/ipv6/conf/all/dis  able_ipv6' 
>>   ```   
>> - *b.永久禁用*          
>>> *1.编辑网卡配置文件*    
>>> ``` 
>>> [root@vm427138 ~]# vim /etc/sysctl.conf 
>>> ```             
>>> *2.在文件中添加以下内容*    
>>> ```
>>> net.ipv6.conf.all.disable_ipv6=1
>>> ````      
>>> *3.然后重启服务以使更改生效*       
>>> ``` 
>>> [root@vm427138 ~]# sysctl -p /etc/sysctl.conf 
>>> ```
> ---


> ## 防火墙相关
>> - *防火墙状态*   
>>   ``` 
>>   [root@vm427138 ~]# firewall-cmd --state  
>>   ```   
>>
>> - *开放端口*  
>>   ``` 
>>   [root@vm427138 ~]# firewall-cmd --list-ports 
>>   ```  
>> 
>> - *添加[移除]端口*   
>>   ``` 
>>   [root@vm427138 ~]# firewall-cmd --permanent --zone=public --add[/remove]-port  rt=443/tcp 
>>   ```   
>>
>> - *检查配置*   
>>   ``` 
>>   [root@vm427138 ~]# firewall-cmd --check-config 
>>   ```   
>>
>> - *重启防火墙*  
>>   ``` 
>>   [root@vm427138 ~]# firewall-cmd --reload 
>>   ```   
>>
>> - *开启/停止/状态/重启*  
>>   ``` 
>>   [root@vm427138 ~]# systemctl start[/stop/status/restart] firewalld 
>>   ```   
> ---


> ## `v2ray` 相关   
>> *需要确保vps和客户端时间差不超过 `90秒`*     
>> 
>> - ### *脚本安装：*   
>>   ```
>>   [root@vm427138 ~]# wget https://install.direct/go.sh   
>>   [root@vm427138 ~]# ./go.sh 
>>   ```  
>>>     
>>> - **安装完成之后**   
>>> - *有一行 `"PORT:40827"` 代表着端口号为 `40827`*     
>>> - *还有一行 `"UUID:505f001d-4aa8-4519-9c54-6b65749ee3fb"` 代表着 id 为505f001d-4aa8-4519-9c54-6b65749ee3fb`*   
>>> - *端口号和id均为随机生成*  
>>> - *启动V2Ray*   
>>> ``` 
>>> [root@vm427138 ~]# systemctl start v2ray
>>> ```   
> --- 


> ## [trojan-go](https://github.com/p4gefau1t/trojan-go) 安装
>> - *1.克隆[源码](https://github.com/p4gefau1t/trojan-go.git)*
>>   ```
>>   git clone https://github.com/p4gefau1t/trojan-go.git
>>   ```
>> - *2.进入目录*
>>   ```
>>   cd trojan-go
>>   ```
>> - *3.编辑 & 安装* 
>>   ```
>>   make & make install
>>   ``` 
>>> - **`trojan-go ` 安装运行的条件：**      
>>> *1.安装需要 `Golang` 语言*      
>>> *2.运行依赖 `Nginx`*        
>>> *3.启动需要配置 `SSL` 证书  否则会启动失败*
> ---


> ## [Golang](https://go.dev/doc/install) 安装 
>> - *1.下载安装包*     
>>   ```
>>   [root@racknerd-ba7b10 ~]# wget https://go.dev/dl/go1.19.2.linux-amd64.tar.gz
>>   ```
>> - *2.删除残留并解压到  `/usr/local` 下*	    
>>   ```
>>   [root@racknerd-ba7b10 ~]# rm -rf /usr/local/go && tar -C /usr/local -xzf go1.19.2.linux-amd64.tar.gz
>>   ```  
>> - *3.编辑 `/etc/profile` 添加环境变量 添加内容如下：*
>>   ```
>> 	 # Golang path
>> 	 export GOROOT=/usr/local/go
>> 	 export PATH=$PATH:$GOROOT/bin
>> 	 export GOPATH=$HOME/goproject
>>   ```    
>> - *4.重载环境变量配置*
>>  ```
>> 	[root@racknerd-ba7b10 ~]# source /etc/profile
>>  ```
> ---


> ## `NGINX` 相关  
>> - *彻底移除nginx*   
>>> *1.是否正在运行*          
>>> ``` 
>>> [root@vm427138 ~]# ps -ef | grep nginx 
>>> ```          
>>> *2.停止nginx服务*       
>>> ``` 
>>> [root@vm427138 ~]# systemctl stop nginx 
>>> ```        
>>> *3.查找nginx相关文件*       
>>> ``` 
>>> [root@vm427138 ~]# whereis nginx
>>> [root@vm427138 ~]# ps -ef | grep nginx
>>> ```     
>>> *4.移除相关文件和文件夹*    
>>> ``` 
>>> [root@vm427138 ~]# rm -rf [file/path]
>>> ```    
>>> *5.移除安装*        
>>> ``` 
>>> [root@vm427138 ~]# yum remove nginx 
>>> ```     
>> ---      
>> - *官方安装*        
>>> *1.安装先决条件*        
>>> ```
>>> [root@vm427138 ~]# yum install yum-utils 
>>> ``` 
>>> *2.要设置 yum 存储库，请使用以下内容创建名为 `/etc/yum.repos.d/nginx.repo` 的文件*      
>>> ```
>>> [root@vm427138 ~]# vim /etc/yum.repos.d/nginx.repo 
>>> ```
>>>> - #源配置文件如下           
>>> ``` 
>>> [nginx-stable]         
>>> name=nginx stable repo         
>>> baseurl=http://nginx.org/packages/centos/$releasever/$bach/        
>>> gpgcheck=1          
>>> enabled=1       
>>> gpgkey=https://nginx.org/keys/nginx_signing.key         
>>> module_hotfixes=true        
>>>         
>>> [nginx-mainline]        
>>> name=nginx mainline repo        
>>> baseurl=http://nginx.org/packages/mainline/centos/$releasever/$bach/        
>>> gpgcheck=1          
>>> enabled=0       
>>> gpgkey=https://nginx.org/keys/nginx_signing.key         
>>> module_hotfixes=true        
>>> ```
>>> *3.默认情况下，使用稳定 nginx 包的存储库。 如果您想使用主线 nginx 包，请运行以下命令*        
>>> ``` 
>>> [root@vm427138 ~]# yum-config-manager --enable nginx-mainline 
>>> ```
>>> *4.要安装 nginx，请运行以下命令*    
>>> ``` 
>>> [root@vm427138 ~]# yum install nginx 
>>> ```       
> ---

> ## `SSL` 证书相关
>> ***linux下运行 `acme.sh` 脚本签发 `ssl` 证书 证书发放机构 `let's encrypt`***        
>> - *1.安装 `acme.sh` 脚本*       
>>      ``` 
>>      [root@racknerd-ba7b10 ~]# curl  https://get.acme.sh | sh -s >> email=my@angelloveroger@gmail.com 
>>      ```   
>> - *2.创建一个 bash 的 alias 方便直接使用 `acme.sh` 命令*     
>>      ``` 
>>      [root@racknerd-ba7b10 ~]# alias acme.sh=~/.acme.sh/acme.sh 
>>      ```       
>> - *3.重新载入 .bashrc 配置 以使 `acme.sh` 命令生效*      
>>      ``` 
>>      [root@racknerd-ba7b10 ~]# source ~/.bashrc 
>>      ```   
>> - *4.设置签发 ssl 证书的默认 CA 机构为 `let's encrypt`*      
>>      ``` 
>>      [root@racknerd-ba7b10 ~]# acme.sh --set-default-ca --server letsencrypt 
>>      ```  
>> - *5.如果站点用 `nginx` 做web服务器  请添加 nginx 服务器 `vhost`配置（务必在linux服务器上创建 `/home/ssl` 目录 ） 配置如下：*   
>>   ```  
>>   server
>>       {
>>           listen 80;
>>           server_name go.loveangel.top;
>>   
>>           location / {
>>               root /home/wwwroot/index/;
>>                   index index.html index.php default.html default.php;
>>           }
>>   
>>           location /.well-known/acme-challenge/ {
>>               root /home/ssl;  # ssl签发机构会验证该目录
>>               log_not_found off;
>>           }
>>   }
>>   ```
>> - *6.证书签发采用 `nginx webroot` 模式*        
>>      ``` 
>>      [root@racknerd-ba7b10 ~]# acme.sh --issue -d go.loveangel.top --nginx  
>>      ```    
>> - *7.运行 `acme.sh` 脚本安装证书* 
>>   ```  
>>   [root@racknerd-ba7b10 ~]# acme.sh --installcert -d go.loveangel.top \
>>   --key-file /home/ssl/go.loveangel.top.key \
>>   --fullchain-file /home/ssl/go.loveangel.top.fullchain.cer \
>>   --reloadcmd  "service nginx force-reload"
>>   ```    
>> - *8.待证书安装成功之后 重新配置 `nginx` 配置如下：* 
>>   ```
>>   server {
>>     # 当 http 协议被请求时，统一转发到 https 协议上
>>     listen 80;
>>     listen [::]:80; # IPV6 协议
>>     server_name go.loveangel.top;
>>     rewrite ^(.*)$ https://$host$1 permanent;
>>   }
>>   
>>   server {
>>     listen 443 ssl;
>>     listen [::]:443 ssl;
>>     ssl_certificate /home/ssl/go.loveangel.top.fullchain.cer;
>>     ssl_certificate_key /home/ssl/go.loveangel.top.key;
>>   
>>     server_name go.loveangel.top;
>>   
>>     location / {
>>       root /home/wwwroot/index;
>>       index index.html;
>>     }
>>   
>>     location /.well-known/acme-challenge/ {
>>       root /www/ssl/;
>>       log_not_found off;
>>     }
>>   }
>>   ```
>> - *9.`nginx` 配置完成 重启`nignx`以使配置生效* 
>>   ```
>>   [root@racknerd-ba7b10 ~]# systemctl restart nginx
>>   ```
>> - ## `10.大功告成`
> ---

> # 常用的nginx `vhost` 配置
> ---
>### *1.`acme.sh` 签发 `ssl` 证书时，需要用到的 nginx `vhost` 配置 （即按照这个配置好nginx之后，再申请证书）*     
>> ```
>> server
>> {
>>     listen 80;
>>     server_name go.loveangel.top;
>> 
>>     location / {
>>         root /home/wwwroot/index/;
>>             index index.html index.htm index.php default.html default.htm default.php;
>>     }
>> 
>>     location /.well-known/acme-challenge/ {
>>         root /home/ssl;
>>         log_not_found off;
>>     }
>> }
>> ```
>> ***注意 `root` 目录 `/home/ssl` 是CA证书颁发机构在验证服务器时需要访问的目录，需要手动创建，并保证当前用户具有 `读写` 权限***
> ---
> ---
>### *2.`acme.sh` 安装 `ssl` 安全证书之后，需要用到的 nginx `vhost` 配置（即脚本安装证书完成之后，站点正常运行需要用到的配置）*   
>> ``` 
>> server {
>>   # 当 http 协议被请求时，统一转发到 https 协议上
>>   listen 80;
>>   listen [::]:80; # IPV6 协议
>>   server_name go.loveangel.top;
>>   rewrite ^(.*)$ https://$host$1 permanent;
>> }
>> 
>> server {
>>   listen 443 ssl;
>>   listen [::]:443 ssl;
>>   ssl_certificate /home/ssl/go.loveangel.top.fullchain.cer;
>>   ssl_certificate_key /home/ssl/go.loveangel.top.key;
>> 
>>   server_name go.loveangel.top;
>> 
>>   location / {
>>     root /home/wwwroot/index;
>>     index index.html;
>>   }
>> 
>>   location /.well-known/acme-challenge/ {
>>     root /home/ssl/;
>>     log_not_found off;
>>   }
>> }
>> ```
> ---
> ---
>### *3.对应 `2` 中 `trojan-go` 的 `vhost` 配置*
>> ```
>> server {
>>   # 当 http 协议被请求时，统一转发到 https 协议上
>>   listen 80;
>>   listen [::]:80; # IPV6 协议
>>   server_name go.loveangel.top;
>> 
>>   location / {
>>     root /home/wwwroot/index;
>>     index index.html;
>>   }
>> 
>>   location /.well-known/acme-challenge/ {
>>     root /home/ssl/;
>>     log_not_found off;
>>   }
>> }
>> ```
> ---
> ---
>### *4.非 `acme.sh` 安装证书可能用到的nginx `vhost` 配置（同 `2` 中的配置，只是该处为手动配置，重定向了更多的静态资源）*
>> ```
>>server
>>    {
>>        listen 80;
>>        listen [::]:80;
>>        listen 443 ssl;
>>        ssl_certificate /root/.acme.sh/trojan.angellove.top/fullchain.cer;
>>        ssl_certificate_key /root/.acme.sh/trojan.angellove.top/trojan.angellove.top.key;
>>        ssl_session_timeout 5m;
>>        ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE:ECDH:AES:HIGH:!NULL:!aNULL:!MD5:!ADH:!RC4;
>>        ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
>>        ssl_prefer_server_ciphers on;
>>
>>        server_name trojan.angellove.top ;
>>        index index.html index.htm index.php default.html default.htm default.php;
>>        root  /home/wwwroot/;
>>
>>        #include rewrite/other.conf;
>>        #error_page   404   /404.html;
>>
>>        # Deny access to PHP files in specific directory
>>        #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }
>>        #include enable-php-pathinfo.conf;
>>            # location /api/core/api/validate_still
>>        # {
>>        #     proxy_pass https://api.szca.com/core/api/validate_still;
>>        # }
>>
>>        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
>>        {
>>            expires      30d;
>>        }
>>
>>        location ~ .*\.(js|css)?$
>>        {
>>            expires      12h;
>>        }
>>
>>        location ~ /.well-known {
>>            allow all;
>>        }
>>
>>        location ~ /\.
>>        {
>>            deny all;
>>        }
>>
>>        access_log  /home/wwwlogs/trojan.angellove.top.log;
>>    }
>> ```
> ---
> ---
>### *5.对应 `4` 中 `trojan-go` 的 `vhost` 配置*
>> ```
>> server
>>     {
>>         listen 80;
>>         listen [::]:80;
>> 
>>         server_name go.angellove.top ;
>>         index index.html index.htm index.php default.html default.htm default.php;
>>         root  /home/wwwroot/index/;
>>
>>         if (!-e $request_filename) {
>>                 rewrite ^/(.*)$ /index.html redirect;
>>         }
>> 
>>         location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
>>         {
>>             expires      30d;
>>         }
>> 
>>         location ~ .*\.(js|css)?$
>>         {
>>             expires      12h;
>>         }
>> 
>>         location ~ /.well-known {
>>             allow all;
>>         }
>> 
>>         location ~ /\.
>>         {
>>             deny all;
>>         }
>> 
>>         access_log  /home/wwwlogs/go.angellove.top.log;
>>     }
>> ```
> ---
> ---
>### *6.`trojan-go` 服务端配置*
>> ```
>> {
>>     "run_type": "server",
>>     "local_addr": "0.0.0.0",
>>     "local_port": 443,
>>     "remote_addr": "127.0.0.1",
>>     "remote_port": 80,
>>     "log_level": 1,
>>     "log_file": "",
>>     "password": [
>>         "5cfcedb8c6b8e97af9bbdc016d8ba019"
>>     ],
>>     "ssl": {
>>         "cert": "/root/.acme.sh/go.angellove.top/go.angellove.top.cer",
>>         "key": "/root/.acme.sh/go.angellove.top/go.angellove.top.key",
>>         "sni": "go.angellove.top",
>>         "fallback_addr": "go.angellove.top",
>>         "fallback_port": 80
>>     },
>>     "router": {
>>         "enabled": true,
>>         "block": [
>>             "geoip:private"
>>         ],
>>         "geoip": "/usr/share/trojan-go/geoip.dat",
>>         "geosite": "/usr/share/trojan-go/geosite.dat"
>>     }
>> }
>> ```
> ---
> ---
>### *7.`v2ray` 服务端配置*
>> ```
>> {
>>   "log": {
>>     "access": "",
>>     "error": "",
>>     "loglevel": "warning"
>>   },
>>   "inbounds": [
>>     {
>>       "port": 13120,
>>       "protocol": "vmess",
>>       "settings": {
>>         "udp": false,
>>         "clients": [
>>           {
>>             "id": "4f24626e-2d77-4af9-b6e5-0a07f993c52f",
>>             "alterId": 0,
>>             "email": "t@t.tt"
>>           }
>>         ],
>>         "allowTransparent": false
>>       },
>>       "streamSettings": {
>>         "network": "tcp"
>>       }
>>     }
>>   ],
>>   "outbounds": [
>>     {
>>       "protocol": "freedom"
>>     },
>>     {
>>       "tag": "block",
>>       "protocol": "blackhole",
>>       "settings": {}
>>     }
>>   ],
>>   "routing": {
>>     "domainStrategy": "IPIfNonMatch",
>>     "rules": []
>>   }
>> }
>> ```