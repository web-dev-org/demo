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
	<input type="submit" value="已结束行程查询" style="width:200px;height:40px;"/>
	</form>
	<form method="post" action="travelbook.php">
	<input type="submit" value="新建行程单" style="width:200px;height:40px;" />
	</form>
	<form method="post" action="travelbookmodify.php">
	<input type="submit" value="行程单维护"  style="width:200px;height:40px;"/>
	</form>
	<form method="post" action="hotelbook.php">
	<input type="submit" value="酒店预订"  style="width:200px;height:40px;" />
	</form>
	<form method="post" action="libcontrol.php">
	<input type="submit" value="在库管理"  style="width:200px;height:40px;"/>
	</form>
</font>
</body>
</html>