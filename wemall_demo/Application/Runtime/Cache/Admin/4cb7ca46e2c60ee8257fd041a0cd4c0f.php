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
					<li class="active"><a data-toggle="tab" href="#home1">地域管理</a></li>
					<li><a data-toggle="tab" href="#home2" >添加/修改地域</a></li>
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
												<th>地域名称</th>
												<th>行政级别</th>
												<th class="hidden-480">操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($city)): $k = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($k % 2 );++$k;?><tr>
												<td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td>
												<td style="display:none"><?php echo ($city["states"]); ?></td>
												<td parent="<?php echo ($city["pid"]); ?>"><?php echo ($city["id"]); ?></td>
												<td class="hidden-480"><?php echo ($city["name"]); ?></td>
												<td class="hidden-480"><?php echo ($city["rule"]); ?></td>
												<td>
													<a href="javascript:void(0);" onclick="addSubcity(this)" class="addsub btn btn-white btn-sm">添加地区</a>
													<a href="javascript:void(0);" onclick="reSubcity(this)" class="btn btn-white btn-sm">修改</a>
													<a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/City/del',array('id'=>$city['id']));?>">删除</a>
												</td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" id="myform" action="<?php echo U('Admin/City/addcity');?>" method="post">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td width="140">上级:</td>
													<td>
														<select name="parent" class="normal_select" onchange="changeInput(this)">
															<option value="0">作为一级分类</option>
															<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$citylist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($citylist["id"]); ?>" id="<?php echo ($citylist["pid"]); ?>"><?php echo ($citylist["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
														</select>
													</td>
												</tr>
												<tr>
													<td>地域名称:</td>
													<td>
														<input type="text" class="input" name="name" value="" style="font-size:13px">
														<input type="hidden" name="addcity" value="0">
													</td>
												</tr>
												<tr>
													<td width="140">地域级别:</td>
													<td>
														<input type="text" class="input"  name="rule" value="" style="font-size:13px">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button class="btn btn-primary btn_submit J_ajax_submit_btn"
									type="submit">提交</button>
								<a class="btn" href="">返回</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			function addSubcity(o) {
				var id = $(o).parent().prev().prev().prev().prev().prev().html();
				var pid = $(o).parent().prev().prev().prev().prev().prev().attr('parent');
								
				$('select[name="parent"]').val(id);
				$('input[name="addcity"]').val('0');
				$('input[name="name"]').val('');
				
				
				$('input[name="tax"]').attr("disabled",false);
				$('input[name="rule"]').attr("disabled",false);
				$('select[name="states"]').attr("disabled",false);
				
				
				$('#myTab li').eq(1).find('a').click();
			}
			function reSubcity(o){
				var id = $(o).parent().prev().prev().prev().prev().prev().html();
				var pid = $(o).parent().prev().prev().prev().prev().prev().attr('parent');
				var name = $(o).parent().prev().prev().prev().prev().html().replace(/&nbsp;/g,'').replace('├─','');
				var tax = $(o).parent().prev().prev().prev().html();
				var rule = $(o).parent().prev().prev().html();
				var states = $(o).parent().prev().prev().prev().prev().prev().prev().html();
				
				$('select[name="parent"]').val(pid);
				$('input[name="addcity"]').val(id);
				$('input[name="rule"]').val(rule);
				$('input[name="name"]').val(name);
				$('input[name="tax"]').val(tax);
				$('select[name="states"]').val(states);
				
				if (pid != "0") {
					$('input[name="tax"]').attr("disabled",false);
					$('input[name="rule"]').attr("disabled",false);
					$('select[name="states"]').attr("disabled",false);
				} 
				
				$('#myTab li').eq(1).find('a').click();
			}
		</script>
	</div>
</div>