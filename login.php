<?php
/*
$useracc = $_POST['useracc']; 
$userpsw = $_POST['userpsw'];                  
if(!empty($userpsw )){                        
    if(($userpsw)=="bbb"){        
        echo $useracc;
    }else{
        echo  "fail";
    }
}else{
    $newpsw = md5($userpsw);
    if($result){
        echo "succeed";
    }else{
        echo "fail";
    }
}*/
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=gb2312' /> 
<title>MAIN </title>
</head>
<body bgcolor="#3299CC"><font color="#fff">
	<form method="post" action="travelbookhistory.php">
	<input type="submit" value="�ѽ����г̲�ѯ" style="width:200px;height:40px;"/>
	</form>
	<form method="post" action="travelbook.php">
	<input type="submit" value="�½��г̵�" style="width:200px;height:40px;" />
	</form>
	<form method="post" action="travelbookmodify.php">
	<input type="submit" value="�г̵�ά��"  style="width:200px;height:40px;"/>
	</form>
	<form method="post" action="hotelbook.php">
	<input type="submit" value="�Ƶ�Ԥ��"  style="width:200px;height:40px;" />
	</form>
	<form method="post" action="libcontrol.php">
	<input type="submit" value="�ڿ����"  style="width:200px;height:40px;"/>
	</form>
</font>
</body>
</html>