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

## 常用操作

### 查看mysql状态

* 查看mysql服务是否启动

> ps -ef | grep mysql

or

> systemctl status mysql.service

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

### mysql 数据读取

1. 查看数据库
   > show databases;
2. 选取数据库
   > use database;
3. 查看tables
   > show tables;  

    *Note: show tables 前需要选中数据库*
4. 查询数据

    ```sql
    SELECT column_name, column_name FROM table_bame
    [WHERE Clause]
    [LIMIT N] [OFFSET M]
    ```

* Demo
```sql
mysql> show tables;
ERROR 1046 (3D000): No database selected
mysql> use computer
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
mysql> show tables;
+--------------------+
| Tables_in_computer |
+--------------------+
| runoob_tbl         |
| teset              |
+--------------------+
2 rows in set (0.00 sec)

mysql>
```