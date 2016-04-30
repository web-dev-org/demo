<?php
$mysql_server_name='localhost';
$mysql_username='root';
$mysql_password='';
$mysql_database='mycounter';

if($conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password))
{
	echo  "connect to mysql success";
}
else{
	echo "connect to mysql fail";	
}
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312' /> 
<title>MAIN </title>
</head>
<body  bgcolor="#3299CC"><font color="#fff">
<form method="post" action="login.php">
	<input type="text" name="useracc" />
	<input type="password" name="userpsw" />
	<input type="submit" value="login" />
</form>
</font>
</body>
</html>