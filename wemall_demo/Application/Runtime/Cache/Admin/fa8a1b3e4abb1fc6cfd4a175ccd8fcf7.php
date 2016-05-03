<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>生鲜电商下单系统</title>

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
<style media="print" type="text/css">
     .Noprint
     {
         display: none;
     }
 </style>
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">订单数据统计</a></li>
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
												期间开始日：<input type="date" class="input" style="width:150px;" id="startTime" name="startTime" value="<?php echo ($startTime); ?>">
												期间结束日：<input type="date" class="input" style="width:150px;" id="endTime" name="endTime" value="<?php echo ($endTime); ?>">
												订单状态 ：<select class="select_2" id="seStates" name="seStates">
														<option value="4"></option>
														<option value="0" <?php if($seStates == '0'): ?>selected = "selected"<?php endif; ?>>未发货</option>
														<option value="1" <?php if($seStates == '1'): ?>selected = "selected"<?php endif; ?>>已发货</option>
														<option value="2" <?php if($seStates == '2'): ?>selected = "selected"<?php endif; ?>>已收货</option>
												   		<option value="3" <?php if($seStates == '3'): ?>selected = "selected"<?php endif; ?>>冻结</option>
												   		<option value="5" <?php if($seStates == '5'): ?>selected = "selected"<?php endif; ?>>客户取消</option>
												   		</select>
													</select>
												<button class="btn btn-primary" style="height:30px;font-size: 10px;padding: 1px 10px;" onclick="searchOrder()" >统计</button>
												<button class="btn btn-primary" style="height:30px;font-size: 10px;padding: 1px 10px;" onclick="outExcel()" >文件下载</button>
												</div>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
												<td style="font-weight:bolder">分类:<?php echo ($vo["menuName"]); ?></td>
											</tr>
											<th>商品ID</th>
											<th>商品名</th>
											<th>商品单位</th>
											<th>商品单价</th>
											<th>商品售出数</th>
											<?php if(is_array($vo["product"])): $i = 0; $__LIST__ = $vo["product"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><tr>
													<td><?php echo ($pro["productId"]); ?></td>
													<td><?php echo ($pro["productName"]); ?></td>
													<td><?php echo ($pro["unitName"]); ?></td>
													<td><?php echo ($pro["price"]); ?></td>
													<td><?php echo ($pro["num"]); ?></td>
												</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		
			function searchOrder() {
				var startTime = $('input[name="startTime"]').val();
				var endTime = $('input[name="endTime"]').val();
				var states = $('select[name="seStates"]').val();
				
				if ( states == "4" ) {
					alert("请选择订单状态！");
					return;
				}
				
				if ( startTime.length == 0 ) {
					alert("开始时间未填写！");
					return;
				}
				if ( endTime.length == 0 ) {
					alert("结束时间未填写！");
					return;
				}
				
				var d1 = new Date(startTime.replace(/\-/g, "\/"));  
				var d2 = new Date(endTime.replace(/\-/g, "\/"));
				
				if ( d1 >= d2 ) {
					alert("开始时间不能大于结束时间！");
					return;
				}

/* 				var days = GetDateDiff(startTime,endTime);
				
				if ( days > 5 ) {
					alert("你所统计的时间超过5天！");
					return;
				} */
				
				post("<?php echo U('Admin/Count/index');?>", {orderStates:states,startTime:startTime,endTime:endTime});
			}
			
			function outExcel(){
				var startTime = $('input[name="startTime"]').val();
				var endTime = $('input[name="endTime"]').val();
				var states = $('select[name="seStates"]').val();
				
				if ( states == "4" ) {
					alert("请选择订单状态！");
					return;
				}
				
				if ( startTime.length == 0 ) {
					alert("开始时间未填写！");
					return;
				}
				if ( endTime.length == 0 ) {
					alert("结束时间未填写！");
					return;
				}
				
				var d1 = new Date(startTime.replace(/\-/g, "\/"));  
				var d2 = new Date(endTime.replace(/\-/g, "\/"));
				
				if ( d1 >= d2 ) {
					alert("开始时间不能大于结束时间！");
					return;
				}

				var days = GetDateDiff(startTime,endTime);
				
				if ( days > 5 ) {
					alert("你所统计的时间超过5天！");
					return;
				}
				
				post("<?php echo U('Admin/Count/outExcel');?>", {orderStates:states,startTime:startTime,endTime:endTime});
				
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
			
			function GetDateDiff(startDate,endDate) 
			{ 
				var startTime = new Date(Date.parse(startDate.replace(/-/g, "/"))).getTime(); 
				var endTime = new Date(Date.parse(endDate.replace(/-/g, "/"))).getTime(); 
				var dates = Math.abs((startTime - endTime))/(1000*60*60*24); 
				return dates; 
			}
		</script>
	</div>
</div>