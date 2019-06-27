# 插入数据库 脚本
```
#!/bin/bash 

HOSTNAME="localhost"
USER="root"
PASSWORD="123456"

DATABASE="test"
TABLE="t_final_moisture"

showdatabase="show databases"
mysql -h ${HOSTNAME} -u ${USER} -p${PASSWORD} -e "${showdatabase}"

insertdata="insert into t_final_moisture (prod_id,product_line,medicine_id,final_moisture) values(3,3,2,4.50);"
for ((i=1;i<10;i++))
do
mysql -h ${HOSTNAME} -u ${USER} -p${PASSWORD} -D ${DATABASE} -e "${insertdata}" 2>/dev/null 
done

if [ $? = 0  ];then
	echo "insert success"
fi

```