# mysql 操作

login 
```
mysql -h "ip"-u "用户" -p "密码" -P "端口号 一般为3306" 
```

show 数据库
```
show databases;
```
show 表
```
show tables;
```
查看 表内字段信息
```
describe "tablename";
```
查看表内属性及具体value
```
select * from "tablename"; (*可替换为具体字段)
```
创建一个数据库 
```
create database "name";
```

创建表
```
CREATE TABLE 表名 (
    属性名 数据类型 [完整约束条件],
    属性名 数据类型 [完整约束条件],
    ...
    ...
    属性名 数据类型 [完整约束条件]
);
```
## 表的修改 删除 添加
增加字段

```
alter table "tablename" add "属性名" 数据类型 约束条件；
```
删除字段
```
alter table "tablename" drop "属性名" ；
```
修改字段
```
alter table "tablename" modify "属性名" 旧属性名 新属性名 新属性；
```
## 数据修改

```
UPDATE 表名 SET 字段名=值,字段名=值... WHERE 条件
```
删除
```
DELETE FROM 表名[WHERE <condition>];
```
## 添加主键

初始化表中有两种形式
```
mysql>  CREATE TABLE student1 (
    -> id int PRIMARY KEY,
    -> name varchar(20)
    -> );
```

```
mysql> CREATE TABLE student2 (
    -> id int,
    -> stu_id int,
    -> name varchar(20),
    -> PRIMARY KEY(id,stu_id)
    -> );
```
也可以通过修改字段 添加主键属性
### 主键的作用
```
主要的作用主要确定该数据的唯一性。比如说ID=1,NAME=张三。我们要在数据库中，找到这条数据可以使用select * from 表 where id=1 这样就可以把张三查找出来了。而这个张三，也可以出现同名，所有用ID来做主键。
```
删除主键
```
alter table 表名 drop primary key;
```
添加主键
```
alter table 表名 add constraint 主键（形如：PK_表名） primary key 表名(主键字段);
例如：
alter table students add constraint PK_stu primary key students(name);
```
## attention
```
主键不可为空，且具体内容不可重复
```

## 外键约束

用来在两个表的数据之间建立链接，它可以是一列或者多列。一个表可以有一个或多个外键。子表的外键可以为空值，若不为空值，则每一个外键的值必须等于父表中主键的某个值。

### 声明形式
父表
```
mysql> CREATE TABLE tb_dept1
    -> (
    -> id INT(11) PRIMARY KEY,
    -> name VARCHAR(22) NOT NULL,
    -> location VARCHAR(50)
    -> );
```
子表
```
mysql> CREATE TABLE tb_emp6
    -> (
    -> id INT(11) PRIMARY KEY,
    -> name VARCHAR(25),
    -> deptId INT(11),
    -> salary FLOAT,
    -> CONSTRAINT fk_emp_dept1
    -> FOREIGN KEY(deptId) REFERENCES tb_dept1(id)
    -> );
```
### 添加外键

```
alter table 从表 add constraint 外键（形如：FK_从表_主表） foreign key 从表(外键字段) references 主表(主键字段);
```
### 删除外键
```
alter table “tablename” drop foreign key 外键（形如：FK_从表_主表）;
```
### 数据内容去重

 DISTINCT 关键字指示 MySQL 消除重复的记录值
 ```
 SELECT DISTINCT <字段名> FROM <表名>;
 ```

### 别名

当表名很长或者执行一些特殊查询的时候，为了方便操作或者需要多次使用相同的表时，可以为表指定别名，用这个别名代替表原来的名称。
```
<表名> [AS] <别名>
mysql> SELECT stu.name,stu.height
    -> FROM tb_students_info AS stu;
    +--------+--------+
| name   | height |
+--------+--------+
| Dany   |    160 |
| Green  |    158 |
| Henry  |    185 |
| Jane   |    162 |
| Jim    |    175 |
| John   |    172 |
| Lily   |    165 |
| Susan  |    170 |
| Thomas |    178 |
| Tom    |    165 |
+--------+--------+
10 rows in set (0.04 sec)
```
### 查询结果排序

```
ORDER BY {<列名> | <表达式> | <位置>} [ASC|DESC]
```
默认为ASC 升序
实例
```
查询 tb_students_info 表中的 name 和 height 字段，先按 height 排序，再按 name 排序，输入的 SQL 语句和执行结果如下所示。
mysql> SELECT name,height
    -> FROM tb_students_info
    -> ORDER BY height,name;
+--------+--------+
| name   | height |
+--------+--------+
| Green  |    158 |
| Dany   |    160 |
| Jane   |    162 |
| Lily   |    165 |
| Tom    |    165 |
| Susan  |    170 |
| John   |    172 |
| Jim    |    175 |
| Thomas |    178 |
| Henry  |    185 |
+--------+--------+
```