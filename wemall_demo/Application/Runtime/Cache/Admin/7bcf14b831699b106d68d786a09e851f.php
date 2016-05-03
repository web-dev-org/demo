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
<style>
	.setting_rows p{margin-top:10px;}
	.setting_rows span{width:100px;display:inline-block;_display:inline;text-align:right;}
	.setting_rows input{width:250px;}
	.setting_rows .change_wx_pay{width:150px;}
</style>
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab2">
					<li class="active"><a data-toggle="tab" href="#home1">商城设置</a></li>
					<li><a data-toggle="tab" href="#home2">支付设置</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<form class="form-horizontal" role="form" action="<?php echo U('Admin/Store/setting');?>" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"
											for="form-field-1"> 商城名称： </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"
												value="<?php echo ($info["name"]); ?>" name="name" class="col-xs-10 col-sm-6">
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"
											for="form-field-2"> 商城公告： </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-2"
												value="<?php echo ($info["notification"]); ?>" name="notification" class="col-xs-10 col-sm-6">
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i> 提交
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i> 取消
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					<div id="home2" class="tab-pane in">
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<form class="form-horizontal"  id="payform" enctype="multipart/form-data" action="<?php echo U('Admin/Store/setalipay');?>" method="post">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"
											for="form-field-1"> 微信支付： </label>

										<div>
											<input type="radio" name="weixin" id="open_weixin_yes" value="1" <?php if($config["weixin"] == 1): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_weixin_yes">开启</label>
											<input type="radio" name="weixin" id="open_weixin_no" value="0" <?php if($config["weixin"] == 0): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_weixin_no">关闭</label>
											<a href="###" onclick="showSetting()" class="addsub btn btn-white btn-sm">配置信息</a>
										</div>
									</div>
									
									<div style="background:#CCC;display:none;" id="weixin_setting">
										<div class="setting_rows">
												<div id="new_wxpay_box" >
													<input type="text" name="alipayid" value="<?php echo ($id); ?>" style="display:none"/>
													<p><span>Appid：</span><input type="text" name="appid" value="<?php echo ($config["appid"]); ?>" class="input"/>&nbsp;&nbsp;公众账号ID</p>
													<p><span>Mchid：</span><input type="text" name="mchid" value="<?php echo ($config["mchid"]); ?>" class="input" />&nbsp;&nbsp;微信支付商户号</p>
													<p><span>Key：</span><input type="text" name="key" value="<?php echo ($config["key"]); ?>" class="input" />&nbsp;&nbsp;商户支付密钥Key</p>
													<p><span>Appsecret：</span><input type="text" name="appsecret" value="<?php echo ($config["appsecret"]); ?>" class="input" />&nbsp;&nbsp;JSAPI接口中获取openid</p>
												</div>	
										
										</div>
									</div>
									

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"
											for="form-field-1"> 货到付款： </label>
										<div>
											<input type="radio" name="daofu" id="open_daofu_yes" value="1" <?php if($config["daofu"] == 1): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_daofu_yes">开启</label>
											<input type="radio" name="daofu" id="open_daofu_no" value="0" <?php if($config["daofu"] == 0): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_daofu_no">关闭</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right"
											for="form-field-1"> 平台付款（账户扣款）： </label>
										<div>
											<input type="radio" name="zhanghu" id="open_zhanghu_yes" value="1" <?php if($config["zhanghu"] == 1): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_zhanghu_yes">开启</label>
											<input type="radio" name="zhanghu" id="open_zhanghu_no" value="0" <?php if($config["zhanghu"] == 0): ?>checked="checked"<?php endif; ?>/>&nbsp;<label for="open_zhanghu_no">关闭</label>
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="icon-ok bigger-110"></i> 提交
											</button>
											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i> 取消
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript"> 
   		var dialog;
   		function showSetting(module,text){
   			dialog = $.dialog({
   				title:'微信支付配置：',
   				content:document.getElementById('weixin_setting'),
   				lock:true,
   				ok:function(){
   					dialog.close();
   					document.forms.payform.submit();
   				}
   			});
   		}
	</script>
</div>