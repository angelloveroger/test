> ---
> ### 一.备份主服务器数据到从服务器（`主从服务器同步前数据要一致`）
>> ---
>> ***1.如果在设置主从同步前，主服务器已有大量数据，可以使用 `mysqldump` 进行数据的备份并还原到从服务器以实现数据的复制***
>>> *1.1.在主服务器上进行备份，执行命令：*        
>>>>
>>>>     mysql> mysqldump -uroot -p123456789qq --all-databases --lock-all-tables > ~/database.sql
>>> 
>>> *1.2.在从服务器上进行数据的还原，以保证从服务器与主服务器数据一致，执行命令：*
>>>>
>>>>     mysql> mysql -uroot -p123456 < ~/database.sql
>> ---      
>> ***2.配置master主服务器***       
>>>
>>> *2.1.修改mysqld的配置文件，一般配置文件位于 `/etc/my.cnf` 或者 `/etc/mysql/my.cnf`：*
>>>>
>>>>     vim /etc/my.cnf
>>>> - 修改 `log_bin` 和 `server-id` 的值，具体配置如下：
>>>>  
>>>>     `server-id = 1`        
>>>>     `log_bin=/usr/local/mariadb/var/mysql-bin.log`     
>>>> - 尽量保证 `log_bin` 保存的路径和 `error_log` 路径相同，方便查找 
>>>
>>> *2.2.重启 master 主数据库mysql：*
>>>>
>>>>     systemctl restart mysql
>>>> 或者   
>>>>
>>>>     systemctl restart mariadb    
>>> *2.3.登录 master 主服务器mysql：*  
>>>> 
>>>>     mysql -uroot -p 123456789qq  
>>>> - 进入mysql，添加用户（用于 slave 从服务器同步数据使用的账号）：
>>>>     
>>>>       mysql> grant replication slave on *.* to 'slave'@'192.168.159.131' identified by '123456';     
>>>> - 上面执行的命令中，`ip`填写从服务器ip，`slave`是创建的mysql用户名   
>>>> - 如果命令报错，请检查 `grant_priv` 和 `super_priv` 权限：    
>>>>  
>>>>       mysql> select user,host,grant_priv, super_priv from user;
>>>> - 如果 `grant_priv` 或者 `super_priv` 为 `N`，则赋予 `root` 相应权限：
>>>>
>>>>       mysql> update set user grant_priv='1', super_priv='1' where user='root';
>>>> - 赋权完成之后，然后刷新权限：
>>>> 
>>>>       mysql> LUSH PRIVILEGES;
>>>> - 完成权限刷新之后，`重启mysql` ，再执行添加用户的操作并刷新权限   
>>>>
>>> *2.4.查看 master 主数据库状态，这些数据用于 slave 设置：* 
>>>> 
>>>>      mysql> show master status;
>>>>  File 为使用的日志文件名字，Position 为使用的文件位置，这两个参数须记下，配置从服务器时会用到  
>> ---
>> ***3.配置 slave 服务器***
>>> *3.1.登录 slave从服务器，修改mysqld的配置文件，一般配置文件位于 `/etc/my.cnf` 或者 `/etc/mysql/my.cnf`：*
>>>>
>>>>     vim /etc/my.cnf
>>>> - 修改 `server-id` 的值，具体配置如下：
>>>>  
>>>>       `server-id = 2`    
>>>> - 保证 slave 从服务器的 `server-id` 不与 master主服务器中的相同  
>>>>        
>>> *3.2.重启从服务器 slave 的MySQL服务：*
>>>>
>>>>     systemctl restart mysql
>>>> 或者
>>>>
>>>>     systemctl restart mariadb
>>> *3.3.配置 slave 从服务器关联 master 主服务器*   
>>>>> *3.3.1.进入 slave 从服务器MySQL：*
>>>>>
>>>>>     mysql -uroot -p123456
>>>> *3.3.2.配置关联到 master 主服务器选择项：*
>>>>>
>>>>>     mysql> change master to master_host='8.129.27.31', master_user='slave', master_password='123456', master_log_file='mysql-bin.000023 ', master_log_pos=48458;
>>>>> - `master_log_file` 和 `master_log_pos` 可以通过在 master 主服务器查看：
>>>>>
>>>>>       mysql> show master status;  
>>>>> - 完成 slave 从服务器与 master 主服务器的关联之后，启动 slave 从服务器：
>>>>>
>>>>>       mysql> slave start;
>>>> *3.3.3.然后查看 slave 从服务器状态：*
>>>>>
>>>>>     mysql> show slave status \G;
>>>>> - 需要关注两项参数，分别为：`slave_io_running` 和 `slave_sql_running`
>>>>>
>>>>>       Slave_IO_Running: Yes
>>>>>       Slave_SQL_Running: Yes
>>>>> - *如果有其中一项为 `No`，需要重新更新 slave 从服务器与 master 主服务器的关联：*   
>>>>>         
>>>>>> 1.重启 master 主服务器 mysql 服务：
>>>>>>    
>>>>>>     systemctl restart mysql
>>>>>>  或者
>>>>>>
>>>>>>     systemctl restart mariadb
>>>>>  2.查看二进制日志文件和ID
>>>>>>
>>>>>>     mysql -uroot -p123456789qq
>>>>>>     mysql> show master status;
>>>>>    3.然后在 slave 从服务器停掉同步，并更新关联配置，然后开启同步：
>>>>>>
>>>>>>     mysql> slave stop;
>>>>>>     mysql> change master to master_log_file='mysql-bin.000031', master_log_pos=4532;
>>>>>>     mysql> start slave;
>>>>>    4.再查看同步情况：
>>>>>>
>>>>>>     mysql> show slave status \G;
> ---
> ***配置主从数据库***
>
> ---
>|命令|作用|操作对象|路径|
>|:-:|:-:|:-:|:-:|
>|mysql> `mysqldump -uroot -p123456789qq --all-databases --lock-all-tables > ~/db.sql;`|数据导出|master|MySQL|
>|mysql> `mysql -uroot -p123456 < ~/db.sql;`|将master导出来的数据导入|slave|MySQL|
>|`vim /etc/my.cnf` \| `vim /etc/mysql/my.cnf`|mysql配置|master|`/etc/my.cnf` \| `/etc/>mysql/my.cnf`|
>|`server-id=1` && `log-bin=log_error_path/mysql-bin.log`|开启二进制日志|master|`my.cnf`|
>|`systemctl restar mysql` \| `systemctl restart mariadb`|重启MySQL服务|master|linux|
>|`mysql -uroot -p123456789qq`|登入MySQL|master|linux|
>|mysql> `grant replication salve on *.* 'slave'@'47.113.194.202' identified by '123456';`|添加slave访问master用户 `ip` 是slave ip，`slave`为用户名|master|MySQL|
>|mysql> `FLUSH PRIVILEGES;`|刷新权限|master|MySQL|
>|mysql> `show master status;`|二进制日志信息，需要记下 `File` 和 `Position`，配置slave需要用到|master|MySQL|
>|`vim /etc/my.cnf` \| `vim /etc/mysql/my.cnf`|设置`server-id`，不能与 master ID重合|slave|`/etc/my.cnf` \| `/etc/mysql/my.cnf`|
>|`server-id=1`|配置服务唯一ID|slave|linux|
>|`systemctl restart mysql` \| `systemctl restart mariadb`|重启MySQL服务|slave|linux|
>|`mysql -uroot -p123456`|登入MySQL服务|slave|linux|
>|mysql> `slave stop`|停掉从服务|slave|MySQL|
>|mysql> `change master to master_host='8.129.27.31',master_user='slave', >master_password='123456',master_log_file='mysql-bin.0000345', master_log_pos=789`|连接到master，后两项参考master>mysql> `show master status;`|slave|MySQL|
>|mysql> `slave start;`|开启从服务|slave|MySQL|
>|mysql> `show slave status \G;`|查看从服务状态|slave|MySQL|
>|`Slave_IO_Running: Yes` \| `Slave_SQL_Running: Yes`|如果输出不是 `Yes`，需要重新链接到master|slave|MySQL|
> ---