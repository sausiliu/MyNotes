
<?php
#$dbhost = '10.110.181.138:3306';  // mysql服务器主机地址
$dbhost = '10.110.181.138';  // mysql服务器主机地址
$dbuser = 'richard';            // mysql用户名
$dbpass = '1';          // mysql用户名密码
$dbname = 'medicine_alert';          // database name 
$dbport = '3306';          // port
#$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
#
#if(! $conn )
#{
#	die('连接失败: ' . mysqli_error($conn));
#}

echo '连接成功<br />';
// 设置编码，防止中文乱码
#mysqli_query($conn , "set names utf8");

$sqli = new mysqli ( $dbhost, $dbuser, $dbpass, $dbname, $dbport);

function rand_str($randLength = 6, $addtime = 1, $includenumber = 0)
{
	if ($includenumber) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
	} else {
		$chars = 'abcdefghijklmnopqrstuvwxyz';
	}
	$len = strlen($chars);
	$randStr = '';
	for ($i = 0; $i < $randLength; $i++) {
		$randStr .= $chars[mt_rand(0, $len - 1)];
	}
	$tokenvalue = $randStr;
	if ($addtime) {
		$tokenvalue = $randStr . time();
	}
	return $tokenvalue;
}

#mysqli_select_db( $conn, 'medicine_alert' );

$sqli->query( 'start transaction' );
for( $i=0;$i<=200;$i++ ){

	$department_name = rand_str(5, 0, 0);
	$department_desc = rand_str(10, 1, 0);

	$sql = "INSERT INTO department" .
		   "(name, description, parent) ".
		   "VALUE ".
		   "('$department_name', '$department_desc', 1)";

	echo $i.'=>'.$sql.'<br/>';

	$sqli->query( $sql );

	if($i%50==0) {
		$sqli->query('commit transaction');
		$sqli->query('begin');
	}
}

$sqli->query('commit transaction');

echo "数据插入成功\n";
#mysqli_close($conn);
?>

