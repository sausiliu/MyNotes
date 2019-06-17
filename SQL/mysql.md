# mysql

## 介绍

mysql 应用很广的一种关系型数据库。其中的关系体现在“表格”的关系。

![avater](./src/img/mysql-1.jpg)

## 环境搭建

### php 脚本运行环境

* ubuntu

```s
sudo apt-get install php7.0 php7.0-mysql
```

## 数据类型

* 数字类型
* 日期和时间
* 字符串类型

## 常用操作

### 查看mysql状态

* 查看mysql服务是否启动 (linux)

    > ps -ef | grep mysql

    or

    > systemctl status mysql.service

### mysql用户登陆

* 登陆

    > mysql -h ip -u name -p

* 指定数据库登陆

    > mysql -h ip -u name -D databasename -p

-D : 数据库名字
-h : 该命令用于指定客户端所要登录的MySQL主机名, 登录当前机器该参数可以省略;
-u : 所要登录的用户名;
-p : 告诉服务器将会使用一个密码来登录, 如果所要登录的用户名密码为空, 可以忽略此选项。

### mysql用户管理

#### 添加用户

* create user

  ```sql
  mysql> create user 'testuser'@'%' identified by '111111';
  Query OK, 0 rows affected (0.00 sec)
  
  mysql>
  ```

  其中 ‘testuser’@'%' 中%表示允许所有的IP地址访问，如果需要指定可以修改此位置。

  1. localhost
  2. xxx.xxx.xxx.xxx 指定ip地址
  3. % 允许任何ip地址访问

* 刷新授权

  ```sql
  mysql> flush privileges;
  Query OK, 0 rows affected (0.00 sec)
  
  mysql>
  ```

#### 用户授权

添加完用户，需要设置用户对某个数据库的操作权限。基本语法如下：  

```sql
GRANT privileges ON databasename.tablename TO 'username'@'host'
```

其中 privileges可以如下：

* SELECT, INSERT ...
* ALL ON *.*
* ALL ON MAINDATAPLUS.*

#### 撤销授权

```sql
REVOKE privileges ON databasename.tablename TO 'username'@'host'
```

### mysql 创建数据库

1. 进入命令端创建

    ```sql
    CREATE DATABASE dname;
    ```

2. 登陆时写入命令

    ```sql
    mysqladmin -u root -p create dname;
    ```

### mysql 删除数据库 

1. drop 命令

    ```sql
    drop database dname;
    ```

2. mysqladmin 命令

    ```sql
    mysqladmin drop database dname;
    ```

### mysql 数据读(无条件)

1. 查看数据库
   > show databases;
2. 选取数据库
   > use database;
3. 查看tables
   > show tables;  

    *Note: show tables 前需要选中数据库*
4. 查询数据

   语法

    ```sql
    SELECT column_name, column_name FROM table_bame
    [WHERE Clause]
    [LIMIT N] [OFFSET M]
    ```

   例子1

    ```sql
    mysql> SELECT * from runoob_tbl;
    +-----------+---------------+---------------+-----------------+
    | runoob_id | runoob_title  | runoob_author | submission_date |
    +-----------+---------------+---------------+-----------------+
    |         1 | 学习 Python   | RUNOOB.COM    | 2016-03-06       |
    +-----------+---------------+---------------+-----------------+
    1 row in set (0.00 sec)
    ```

   例子2

   ```sql
   mysql> SELECT runoob_title from runoob_tbl
    -> ;
    +--------------------+
    | runoob_title       |
    +--------------------+
    | 学习 Python         |
    | mysql 数据插入      |
    +--------------------+
    2 rows in set (0.00 sec)
   ```

* Demo

```sql
Database changed
mysql> show tables;
+------------------+
| Tables_in_RUNOOB |
+------------------+
| runoob_tbl       |
+------------------+
1 row in set (0.00 sec)

mysql> SELECT * from RUNOOB;
ERROR 1146 (42S02): Table 'RUNOOB.RUNOOB' doesn't exist
mysql> SELECT * from runoob_tbl;
Empty set (0.00 sec)

mysql> desc runoob_tbl;
+-----------------+--------------+------+-----+---------+----------------+
| Field           | Type         | Null | Key | Default | Extra          |
+-----------------+--------------+------+-----+---------+----------------+
| runoob_id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| runoob_title    | varchar(100) | NO   |     | NULL    |                |
| runoob_author   | varchar(40)  | NO   |     | NULL    |                |
| submission_date | date         | YES  |     | NULL    |                |
+-----------------+--------------+------+-----+---------+----------------+
4 rows in set (0.00 sec)

mysql>
```

### mysql 数据读(带条件)

   语法

   ```sql
   SELECT field1, field2,...fieldN
   FROM   table_name1, table_name2...
   [WHERE condition1 [AND [OR]] condition2.....
   ```


### mysql 插入数据

```sql
INSERT INTO table_name 
(field1, field2, filed3, ...fieldN)
VALUES
(value1, value2, value3, ...valueN)
```

