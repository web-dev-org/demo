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
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">订单管理</a></li>
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
												订单号：<input type="text" class="input" style="width:150px;"  id="orderid" name="orderid" value="<?php echo ($orderid); ?>">
												联系电话：<input type="text" class="input" style="width:100px;" id="seTel" name="seTel" value="<?php echo ($seTel); ?>">
												下单日期：<input type="date" class="input" style="width:150px;" id="seBuytime" name="seBuytime" value="<?php echo ($seBuytime); ?>">
												订单状态 ：<select class="select_2" id="seStates" name="seStates">
														<option value="4"></option>
														<option value="0" <?php if($seStates == '0'): ?>selected = "selected"<?php endif; ?>>未发货</option>
														<option value="1" <?php if($seStates == '1'): ?>selected = "selected"<?php endif; ?>>已发货</option>
														<option value="2" <?php if($seStates == '2'): ?>selected = "selected"<?php endif; ?>>已收货</option>
												   		<option value="3" <?php if($seStates == '3'): ?>selected = "selected"<?php endif; ?>>冻结</option>
												   		<option value="5" <?php if($seStates == '5'): ?>selected = "selected"<?php endif; ?>>客户取消</option>
												   		</select>
												地域：<select name="seCity" id="seCity" class="normal_select" >
													<?php if($cityid != '0' ): ?><option value="<?php echo ($citylist["id"]); ?>"><?php echo ($citylist["name"]); ?></option>
													<?php else: ?>
														<option value="0">全地域</option>
														<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($searchCity == $city['id']): ?><option value="<?php echo ($city["id"]); ?>"  selected = "selected"><?php echo ($city["name"]); ?></option>
															<?php else: ?>
																<option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
													</select>
												<button class="btn btn-primary" style="height:30px;font-size: 10px;padding: 1px 10px;" onclick="searchOrder()" >查询</button>
												</div>
												<th>订单号</th>
												<th>联系人</th>
												<th>联系电话</th>
												<th>下单日期</th>
												<th>订单状态</th>
												<th>支付状态</th>
												<th>配送时间</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<td><?php echo ($result["orderid"]); ?></td>
												<td><?php echo ($result["memname"]); ?></td>
												<td><?php echo ($result["memtel"]); ?></td>
												<td><?php echo ($result["buytime"]); ?></td>
												<td><?php echo ($result["statesname"]); ?></td>
												<td><?php echo ($result["paystatesname"]); ?></td>
												<td><?php echo ($result["sendtime"]); ?></td>
												<td>
													<a class="btn btn-white btn-sm" href="<?php echo U('Admin/Order/orderDetail',array('id'=>$result['id'],'pageIndex'=>$nowpage,'orderId'=>$orderid,'tel'=>$seTel,'buyTime'=>$seBuytime,'states'=>$seStates,'cityId'=>$searchCity));?>">详情 </a>
													<?php if($result['states'] == '0' or $result['states'] == '3'): if($result['states'] != '3' ): ?><a class="btn btn-white btn-sm" href="<?php echo U('Admin/Order/del',array('id'=>$result['id'],'type'=>'0'));?>">冻结</a>
														<?php else: ?>
															<a class="btn btn-white btn-sm" href="<?php echo U('Admin/Order/del',array('id'=>$result['id'],'type'=>'1'));?>">解冻</a><?php endif; endif; ?>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
									<div class="pagination" style="margin:0px;">
									    <?php echo ($page); ?>
									</div>
								</div>
							</div>
						</div>
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