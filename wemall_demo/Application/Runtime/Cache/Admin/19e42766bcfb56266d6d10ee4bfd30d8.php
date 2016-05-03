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
	<script>
	
		function selectAll(checkbox) {
			$('input[type=checkbox]').prop('checked', checkbox); 	
		}
	
	</script>
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">账号管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改账号</a></li>
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
												<th>ID</th>
												<th>账号名</th>
												<th>账号状态</th>
												<th class="hidden-480">操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
												<td class="hidden-480"><?php echo ($vo["id"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["username"]); ?></td>
												<td class="hidden-480"><?php echo ($vo["statesname"]); ?></td>
												<td style="display:none"><?php echo ($vo["password"]); ?></td>
												<td style="display:none"><?php echo ($vo["states"]); ?></td>
												<td style="display:none"><?php echo ($vo["cityid"]); ?></td>
												<td style="display:none"><?php echo ($vo["role"]); ?></td>

												<td><a href="javascript:void(0);" onclick="reSubuser(this)" class="btn btn-white btn-sm">修改</a><a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/BackUser/delUser',array('id'=>$vo['id']));?>">删除</a></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" name="myform" id="myform" action="<?php echo U('Admin/BackUser/addUser');?>" method="post" onsubmit="return check();">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td>账号名称:</td>
													<td><input type="text" class="input"  id="username" name="username"
														value=""><input type="hidden" name="adduser" value="0"></td>
												</tr>
												<tr>
													<td>账号密码:</td>
													<td><input type="text" class="input" id="password" name="password" value=""></td>
												</tr>
												<tr>
													<td>账号状态:</td>
													<td>
														<select id="states" name="states" class="normal_select">
															<option value="0">启用</option>
															<option value="1">关闭</option>
														</select>
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
			function reSubuser(o){
				var role = $(o).parent().prev().html();
				var cityid = $(o).parent().prev().prev().html();
				var states = $(o).parent().prev().prev().prev().html();
				var password = $(o).parent().prev().prev().prev().prev().html();
				var username = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var id = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
				
				var roleList = eval('(' + role + ')');
				
				$('select[name="cityid"]').val(cityid);
				$('input[name="adduser"]').val(id);
				$('input[name="username"]').val(username);
				$('input[name="password"]').val(password);
				$('select[name="states"]').val(states);
				
				if ( roleList.set == "1" ) {
					document.myform.set.checked = true; 
				}
				if ( roleList.menu == "1" ) {
					document.myform.menu.checked = true; 
				}
				if ( roleList.city == "1" ) {
					document.myform.city.checked = true; 
				}
				if ( roleList.cityPercent == "1" ) {
					document.myform.cityPercent.checked = true; 
				}
				if ( roleList.product == "1" ) {
					document.myform.product.checked = true; 
				}
				if ( roleList.price == "1" ) {
					document.myform.price.checked = true; 
				}
				if ( roleList.confirm == "1" ) {
					document.myform.confirm.checked = true; 
				}
				if ( roleList.order == "1" ) {
					document.myform.order.checked = true; 
				}
				if ( roleList.member == "1" ) {
					document.myform.member.checked = true; 
				}
				if ( roleList.weixin == "1" ) {
					document.myform.weixin.checked = true; 
				}
				if ( roleList.user == "1" ) {
					document.myform.user.checked = true; 
				}	
				if ( roleList.active == "1" ) {
					document.myform.active.checked = true; 
				}	
				if ( roleList.salesCode == "1" ) {
					document.myform.salesCode.checked = true; 
				}
				if ( roleList.count == "1" ) {
					document.myform.count.checked = true; 
				}
				if ( roleList.countSale == "1" ) {
					document.myform.countSale.checked = true; 
				}	
				$('#myTab li').eq(1).find('a').click();
			}
			
			function check() {
				if (document.getElementById("username").value == '') {
					alert("用户名不能为空！");
					return false;
				}
				if (document.getElementById("password").value == '') {
					alert("密码不能为空！");
					return false;
				}
				if (document.getElementById("cityid").value == '0' && 
						document.getElementById("role").value == '1') {
					alert("地域管理员不能选择全地域！");
					return false;
				}
				if (document.getElementById("cityid").value != '0' && 
						document.getElementById("role").value == '0') {
					alert("超级管理员默认地域为全地域！");
				}
				
			}
		</script>
	</div>
</div>