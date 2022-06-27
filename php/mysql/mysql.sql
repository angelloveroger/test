-- mysql 当天0点时间戳
select UNIX_TIMESTAMP(CAST(SYSDATE() AS DATE));

-- mysql 当天24点时间戳
select UNIX_TIMESTAMP(CAST(SYSDATE() AS DATE) + INTERVAL 1 DAY);

-- 1.查询m表存在而mi表不存在的数据
select * from member m where not exists (select 1 from member_info mi where m.id=mi.uid);

-- 2.添加表备注c
ALTER TABLE table_name COMMENT '新的表备注';

-- 3.添加字段
ALTER TABLE table_name ADD column_name INT(11);

-- 4.删除字段
ALTER TABLE table_name DROP column_name;

-- 5.修改字段名称
ALTER TABLE table_name CHANGE old_column_name new_column_name INT(11) NOT NULL DEFAULT ‘123’;

-- 6.修改字段中备注
ALTER TABLE table_name MODIFY COLUMN column_name tinyint(3) COMMENT '新的字段备注';

-- 7.修改字段属性
ALTER TABLE table_name MODIFY column_name INT(11) NOT NULL DEFAULT ‘123’;

-- 8.添加默认值
ALTER TABLE table_name ALTER column_name SET DEFAULT ‘添加默认值’；

-- 9.删除默认值
ALTER TABLE table_name column_name DROP DEFAULT;

-- 10.添加主键
ALTER TABLE table_name ADD PRIMARY KEY(id);

-- mysql数据库中IP存储 int(10) unsigned not null (MYSQL中ip转INT：INET_ATON(ip); INT转ip：INET_NTOA(ip)   PHP中ip转INT：ip2long(ip); INT转ip：long2ip(ip)) 

-- 11.利用to_days()函数获取今天的数据（date_column为格式化时间）
SELECT * FROM table_name WHERE TO_DAYS(date_columu) = TO_DAYS(now());

-- 12.利用to_days()函数获取前一天的数据（date_column为格式化时间）
SELECT * FROM table_name WHERE TO_DAYS(now()) - TO_DAYS(date_columu) = 1;

-- 13.获取近7天的数据（date_column为格式化时间）
SELECT * FROM table_name WHERE DATE(date_column) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY);

-- 14.获取当前月的数据
SELECT * FROM table_name WHERE FROM_UNIXTIME(date_column, '%Y%m') = FROM_UNIXTIME(UNIX_TIMESTAMP(), '%Y%m'); -- date_column为时间戳
SELECT * FROM table_name WHERE DATE_FORMAT(date_column, '%Y%m') = DATE_FORMAT(NOW(), '%Y%m');   -- date_column为格式化时间

-- 15.获取上月数据
SELECT * FROM table_name WHERE PERIOD_DIFF(DATE_FORMAT(UNIX_TIMESTAMP(), '%Y%m'), DATE_FROMAT(date_column, '%Y'm)) = 1; -- date_column为时间戳
SELECT * FROM table_name WHERE PERIOD_DIFF(DATE_fORMAT(NOW(), '%Y%m'), DATE_FORMAT(date_column, '%Y%m')) = 1;   -- date_column为格式化时间


-- ------------------------------------------------------------------存储过程------------------------------------------------------------------------------------------------------------------------------------------------------------
-- 创建IN类型存储过程
DELIMITER //
CREATE PROCEDURE delById (IN orderId INT UNSIGNED)
BEGIN
 DELETE FROM yang_orders WHERE orders_id = orderId;
END // 
DELIMITER ;
-- 调用IN类型存储过程
CALL delById (5);

-- 创建IN OUT类型存储过程
DELIMITER //
CREATE PROCEDURE delAndSelCount (
 IN orderId INT UNSIGNED,
 OUT count INT UNSIGNED
)
BEGIN
 DELETE FROM yang_orders WHERE orders_id = orderId;
 SELECT count(*) FROM yang_orders INTO count;
END // 
DELIMITER ;
-- 调用IN OUT类型存储过程
CALL delAndSelCount (6, @count);

-- 删除存储过程
DROP PROCEDURE delById;

-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



-- mysql优化相关
-- 是否记录没有使用索引的sql
show variables like 'log_queries_not_using_indexes%';
-- 慢查询时间设置
show variables like 'long_query_time%';
-- 是否开启慢查询日志
show variables like 'slow_query_log';
-- 设置慢查询日志保存位置
set global slow_query_log_file='/home/mysql/sql_log/mysql_slow.log';
-- 是否将没有使用索引的sql记录下来
set global log_queries_not_using_indexes=on;	
-- 将查询时间超过1秒的sql记录下来
set global long_query_time=1;	
-- 开启慢查询
set global slow_query_log=on;


--  -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- 修改字段属性。修改时如果不带完整性约束条件，原有的约束条件将丢失；如果需要保留原有的条件，则需要在修改时带上完整性约束条件【ALTER TABLE 表名 MODIFY 字段名  字段属性[完整性约束条件]】
    -- 例：将email字段 VARCHAR(50)修改成VARCHAR(200)
    ALTER TABLE user10 MODIFY email VARCHAR(200) NOT NULL DEFAULT 'a@a.com';

    -- 例：将card移到test后面
    ALTER TABLE user10 MODIFY card CHAR(10) AFTER test;

    -- 例：将test放到第一个，保留原完整性约束条件
    ALTER TABLE user10 MODIFY test CHAR(32) NOT NULL DEFAULT '123' FIRST;

 -- 修改字段名称和属性【ALTER TABLE 表名 CHANGE 原字段名 新字段名 字段类型 约束条件】
    --例：将test字段改为test1
    ALTER TABLE user10 CHANGE test test1 CHAR(32) NOT NULL DEFAULT '123';

 -- 添加删除字段【ALTER TABLE 表名 ADD/DROP 字段[完整性约束]】
    -- 例：添加email字段
    ALTER TABLE user11 ADD email VARCHAR(50);
    -- 删除email字段
    ALTER TABLE user11 DROP email;

-- 添加删除默认值【ALTER TABLE user11 ALTER 字段名 SET/DROP DEFAULT [默认值]】
    -- 例：添加age字段默认值
    ALTER TABLE user ALTER age SET DEFAULT 18;
    -- 删除age字段默认值
    ALTER TABLE user ALTER age DROP DEFAULT;

-- 添加删除主键【ALTER TABLE 表名 ADD/DROP PRIMARY KEY(字段)】
    -- 例：添加主键
    ALTER TABLE user ADD PRIMARY KEY(id[,name]);
    -- 删除主键【直接删除主键会报错，需要先删除主键自增属性】
    ALTER TABLE user MODIFY id INT UNSIGNED;
    ALTER TABLE user DROP PRIMARY KEY;

-- 添加/删除索引
    --【添加普通索引】
      -- ALTER TABLE 表名 ADD INDEX [index_name] (column_list) 【 添加普通索引，column_list可以是单列，也可以是多列，列之间可以用逗号分开，索引名可选，不填写的时候会用第一列的值代替】
      -- CREATE INDEX [index_name] ON 表名 (column_list)
    --【添加唯一索引】
      -- ALTER TABLE 表名 ADD UNIQUE (column_list)
      -- CREATE UNIQUE INDEX index_name ON 表名 (column_list);
    -- 【删除索引】
      -- ALTER TABLE 表名 DROP INDEX index_name
      -- DROP INDEX index_name ON 表名

-- 修改表存储引擎
    -- ALTER TABLE 表名 ENGINE=InnoDB/MyISAM

-- 修改表自增值
    -- ALTER TABLE 表名 AUT0_INCREMENT=50

-- 查看SQL执行性能
    -- EXPLAIN sql语句

-- 清空表（自增值归零）
    -- TRUNCATE TABLE table_name

-- 商品表，分类ID以,分割（1，2，5，8）
    -- SELECT goods.*, GROUP_CONCAT(category.name) FROM goods,category WHERE FIND_IN_SET(category.id, goods.cate_ids) GROUP BY goods.id

-- 1对1连表更新
    -- UPDATE tableA INNER JOIN tableB SET tableA.column = tableB.column WHERE tableA.columnA = tableB.columnA AND tableA.columnB = xxx 













