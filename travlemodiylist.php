<?php
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body bgcolor="#3299CC"><font color="#fff">
<form>
	  <label style="padding-right:100px;" for="selectall">团号</label>
	  <label style="padding-right:100px;" for="female" name = "version">版本</label>
	  <label style="padding-right:10px;" for="female">行程单状态</label>
	  <label style="padding-right:10px;" for="female">控房外预订状态</label>
	  <label style="padding-right:10px;" for="selectall">控房使用状态</label>
	  <label style="padding-right:10px;" for="female">BUS预订状态</label>
	  <label style="padding-right:10px;" for="female">导游预订状态</label>
	  <label style="padding-right:10px;" for="female">行程进展</label>
	  <?php
	  for( $i = 0;$i<3;$i++)
	  {
	    print "</br>";
		print  "<input type=\"text\" size = \"16\"> ";
		print  "<input type=\"text\" size = \"16\"> ";
	  }
	  ?>

</form>
</form>
</font>
</body>
</html>