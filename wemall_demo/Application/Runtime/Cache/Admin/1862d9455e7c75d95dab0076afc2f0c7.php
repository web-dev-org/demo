<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>旅行社管理系统</title>

		<!-- basic styles -->

		<link href="__PUBLIC__/Plugin/style/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/font-awesome.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/Plugin/style/css/ace-skins.min.css" />


		<script src="__PUBLIC__/Plugin/style/js/ace-extra.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='__PUBLIC__/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='__PUBLIC__/Plugin/style/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="__PUBLIC__/Plugin/style/js/bootstrap.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/typeahead-bs2.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.ui.touch-punch.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.slimscroll.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.easy-pie-chart.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.sparkline.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.pie.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/flot/jquery.flot.resize.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/ace-elements.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/ace.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="__PUBLIC__/Plugin/style/js/jquery.artDialog.js?skin=default"></script>

	</head>
	<body>
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">行程管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改行程</a></li>
				</ul>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<div class="table-responsive">
									<table id="sample-table-1"
										class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<div style="margin-bottom:10px">
												行程开始日：<input type="date" class="input" style="width:150px;" id="seBuytime" name="seBuytime" value="<?php echo ($seBuytime); ?>">
												行程结束日：<input type="date" class="input" style="width:150px;" id="seBuytime" name="seBuytime" value="<?php echo ($seBuytime); ?>">
												对方旅行社：<input type="text" class="input" style="width:150px;"  id="orderid" name="orderid" value="<?php echo ($orderid); ?>">
												旅行社担当：<input type="text" class="input" style="width:100px;" id="seTel" name="seTel" value="<?php echo ($seTel); ?>">
												</div>
												<div style="margin-bottom:10px">
												团号：<input type="text" class="input" style="width:100px;" id="seTel" name="seTel" value="<?php echo ($seTel); ?>">
												Bus状态 ：<select class="select_2" id="seStates" name="seStates">
														<option value="4"></option>
														<option value="0" >未预定</option>
														<option value="1" >预定中</option>
														<option value="2" >预定完了</option>
												   		</select>
												酒店状态 ：<select class="select_2" id="seStates" name="seStates">
														<option value="4"></option>
														<option value="0" >未预定</option>
														<option value="1" >预定中</option>
														<option value="2" >预定完了</option>
												   		</select>
												导游状态 ：<select class="select_2" id="seStates" name="seStates">
														<option value="4"></option>
														<option value="0" >未预定</option>
														<option value="1" >预定中</option>
														<option value="2" >预定完了</option>
												   		</select>
												<button class="btn btn-primary" style="height:30px;font-size: 10px;padding: 1px 10px;" onclick="searchOrder()" >查询</button>
												</div>
												<th>团号</th>
												<th>版本</th>
												<th>行程单状态</th>
												<th>控房外酒店预订</th>
												<th>控房使用</th>
												<th>Bus预定</th>
												<th>导游预定</th>
												<th>行程状态</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>

											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
									<div class="pagination" style="margin:0px;">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="home2" class="tab-pane in">

					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		
			function searchOrder() {
				var orderid = $('input[name="orderid"]').val();
				var tel = $('input[name="seTel"]').val();
				var buytime = $('input[name="seBuytime"]').val();
				var states = $('select[name="seStates"]').val();
				var city = $('select[name="seCity"]').val();

				
				post("<?php echo U('Admin/Order/index');?>", {orderid:orderid,seTel:tel,seBuytime:buytime,seStates:states,seCity:city});
			}
			
			
			function post(URL, PARAMS) {        
			    var temp = document.createElement("form");        
			    temp.action = URL;        
			    temp.method = "post";        
			    temp.style.display = "none";        
			    for (var x in PARAMS) {        
			        var opt = document.createElement("textarea");        
			        opt.name = x;        
			        opt.value = PARAMS[x];            
			        temp.appendChild(opt);        
			    }        
			    document.body.appendChild(temp);        
			    temp.submit();        
			    return temp;        
			} 
		</script>
	</div>
</div>