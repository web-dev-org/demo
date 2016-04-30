<?php
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>行程制定</title>
</head>
<body bgcolor="#3299CC"><font color="#fff">
	<form method="post" action="search.php">
		<font size="4" color="White">
			<center>团号</center>
		</font>
		<br />
		<label for="travlebegindate">行程开始日</label>
		<input type="text" name="travleBeginDate" />
		<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;</span>
		
		<label for="travlebegindate">行程结束日</label>
		<input type="text" name="travleEndDate" />
		<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;</span>
		
		<label for="travlebegindate">人数</label>
		<input type="text" name="Count" />
		<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;</span>
		
		<label for="travlebegindate">接机牌</label>
		<input type="text" name="placard" />
		<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;</span>
		<br />
		
		<label for="travlebegindate">对方旅行社</label>
		<input type="text" name="partner_company" />
		<span style="font-size:12px;">&nbsp;&nbsp;&nbsp;</span>
		
		<label for="travlebegindate">对方担当者</label>
		<input type="text" name="partner_person" />
		<span style="font-size:60px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<input type="submit" value="生成列表" />
	</form>
<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="80%" color=#987cb9 SIZE=3>

<form>
	  <label style="padding-right:10px;" for="selectall">日期（星期）</label>
	  <label style="padding-right:10px;" for="female">都道府県</label>
	  <label style="padding-right:10px;" for="female">景点</label>
	  <label style="padding-right:400px;" for="female">景点说明</label>
	  <label style="padding-right:10px;" for="selectall">星级</label>
	  <label style="padding-right:10px;" for="female">酒店S,T,D</label>
	  <label style="padding-right:10px;" for="female">附带早午晚餐</label>
</form>
</div>
	<span style="position:absolute; right:700px; bottom:45px;">
		<input  type="button" value="保存">
	</span>
	<span style="position:absolute; right:500px; bottom:45px;">
		<input  type="button" value="印刷">
	</span>
	<span style="position:absolute; right:300px; bottom:45px;">
		<input  type="button" value="FIX">
	</span>
	<span style="position:absolute; right:100px; bottom:45px;">
		<input  type="button" value="取消">
	</span>
</div>
</font>
</body>
</html>