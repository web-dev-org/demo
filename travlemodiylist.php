<?php
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body bgcolor="#3299CC"><font color="#fff">
<form>
	  <label style="padding-right:100px;" for="selectall">�ź�</label>
	  <label style="padding-right:100px;" for="female" name = "version">�汾</label>
	  <label style="padding-right:10px;" for="female">�г̵�״̬</label>
	  <label style="padding-right:10px;" for="female">�ط���Ԥ��״̬</label>
	  <label style="padding-right:10px;" for="selectall">�ط�ʹ��״̬</label>
	  <label style="padding-right:10px;" for="female">BUSԤ��״̬</label>
	  <label style="padding-right:10px;" for="female">����Ԥ��״̬</label>
	  <label style="padding-right:10px;" for="female">�г̽�չ</label>
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