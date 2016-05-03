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
					<li class="active"><a data-toggle="tab" href="#home1">邀请码管理</a></li>
					<li><a data-toggle="tab" href="#home2" >添加/修改邀请码</a></li>
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
												<th class="center">
													<label> 
														<input type="checkbox" class="ace"> <span class="lbl"></span>
												  	</label>
												</th>
												<th>ID</th>
												<th>业务员名</th>
												<th>地域</th>
												<th>邀请码</th>
												<th>状态</th>
												<th class="hidden-480">操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($code)): $k = 0; $__LIST__ = $code;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
												<td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td>
												<td class="hidden-480"><?php echo ($vo["id"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["staffName"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["cityname"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["salesCode"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["statesname"]); ?></td>
												<td style="display:none;"><?php echo ($vo["cityid"]); ?></td>
												<td style="display:none;"><?php echo ($vo["states"]); ?></td>												
												<td>
													<a href="javascript:void(0);" onclick="reSubcity(this)" class="btn btn-white btn-sm">修改</a>
													<a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/SalesCode/del',array('id'=>$vo['id']));?>">删除</a>
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
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" id="myform" action="<?php echo U('Admin/SalesCode/addCode');?>" method="post">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2"  width="100%">
											<tbody>
												<tr>
													<td>业务员名:</td>
													<td>
														<input type="text" class="input" name="staffName" value="" style="font-size:13px">
														<input type="hidden" name="codeId" value="0">
													</td>
												</tr>
												<tr>
													<td width="140">地域:</td>
													<td>
														<select name="city" class="normal_select">
															<?php if(is_array($cityList)): $i = 0; $__LIST__ = $cityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$citylist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($citylist["id"]); ?>"><?php echo ($citylist["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
														</select>
													</td>
												</tr>
												<tr>
													<td>邀请码:</td>
													<td> 
														<input type="text" class="input" name="salesCode" value="" style="font-size:13px">
														<button type="button" onclick='makeCode()'>生成邀请码</button>
													</td>
												</tr>
												<tr>
													<td width="140">是否启用:</td>
													<td>
														<select name="states" class="normal_select">
															<option value="0"></option>
															<option value="1">启用</option>
															<option value="2">不启用</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button class="btn btn-primary btn_submit J_ajax_submit_btn" type="submit">提交</button>
								<a class="btn" href="">返回</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			function makeCode() {
				$.ajax({
					url: 'index.php?g=Admin&m=SalesCode&a=makeSalesCode',
					type: 'POST',
					dataType: 'json',
					data: {},
					success: function(data) {
						if (data.result == 'succ') {
							$('input[name="salesCode"]').val(data.code);
						}
					}
				});
				
				
			}
			
			
			function reSubcity(o){
				var id = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var staffName = $(o).parent().prev().prev().prev().prev().prev().prev().html();
				var saleCode = $(o).parent().prev().prev().prev().prev().html();
				var states = $(o).parent().prev().html();
				var cityid = $(o).parent().prev().prev().html();
				
				$('select[name="city"]').val(cityid);
				$('input[name="staffName"]').val(staffName);
				$('input[name="codeId"]').val(id);
				$('input[name="salesCode"]').val(saleCode);
				$('select[name="states"]').val(states);
				
				$('#myTab li').eq(1).find('a').click();
			}
		</script>
	</div>
</div>