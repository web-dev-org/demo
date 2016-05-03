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
<script type="text/javascript">
var UEURL = '__ROOT__/Public/Plugin/umeditor/';
</script>
<link href="__PUBLIC__/Plugin/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/lang/zh-cn/zh-cn.js"></script>

<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<form class="form-horizontal J_ajaxForm" enctype="multipart/form-data" id="priceform" method="post">
			   		商品分类：<select class="select_2" id="proClass" name="proClass" onchange="selectPrice()">
								<option value="0">全分类</option>
								<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addmenu): $mod = ($i % 2 );++$i; if($menuid == $addmenu["id"] ): ?><option value="<?php echo ($addmenu["id"]); ?>"  selected = "selected"><?php echo ($addmenu["name"]); ?></option>
									<?php else: ?>
										<option value="<?php echo ($addmenu["id"]); ?>" ><?php echo ($addmenu["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						   </select>					
					地域：<select class="select_2" id="proCity" name="proCity" onchange="selectPrice()">
							<?php if($userCityid != '0' ): ?><option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></option>
							<?php else: ?>
								<option value="0">全地域</option>
								<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($cityid == $vo['id']): ?><option value="<?php echo ($vo["id"]); ?>"  selected = "selected"><?php echo ($vo["name"]); ?></option>
									<?php else: ?>
										<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
						</select>
						<div style="font-weight:blod;color:red">以下为本次发布产品，如有行显示红色则调整价小于基本价，请注意检查！！</div>
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<div class="table-responsive">
									<table id="sample-table-1"
										class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th>商品名称</th>
												<th>单位</th>
												<th>地域</th>
												<th>基准价</th>
												<th>当前价</th>
												<th>调整价</th>
												<th>差额</th>
												<th>修改用户</th>
											</tr>
										</thead>
	
										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i; if($result['bprice'] > $result['nprice'] ): ?><tr style="color:red">
										<?php else: ?>
											<tr><?php endif; ?>
												<td><?php echo ($result["productname"]); ?></td>
												<td><?php echo ($result["name"]); ?></td>
												<td><?php echo ($result["cityname"]); ?></td>
												<td><?php echo ($result["bprice"]); ?></td>
												<td><?php echo ($result["vprice"]); ?></td>
												<td><?php echo ($result["nprice"]); ?></td>
												<td><?php echo ($result["amt"]); ?></td>
												<td><?php echo ($result["username"]); ?></td>
												<td style="display:none" ><?php echo ($result["id"]); ?></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button class="btn btn-primary btn_submit J_ajax_submit_btn" onclick="submitPrice('1')">确认发布</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
	    	function submitPrice(button) {
	    		if ( button == "1" ) {
		    		document.forms.priceform.action="<?php echo U('Admin/Price/confirmPrice');?>";
	    		}
	    		document.priceform.submit();
	    	}
	    	
			function selectPrice() {
				var menu = $('select[name="proClass"]').val();
				var city = $('select[name="proCity"]').val();
				
				post("<?php echo U('Admin/Price/updatePrice');?>", {menuid:menu,cityid:city});
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
		<script type="text/javascript">
	    var um = UM.getEditor('myEditor');
	    um.addListener('blur',function(){
	        $('#focush2').html('编辑器失去焦点了')
	    });
	    um.addListener('focus',function(){
	        $('#focush2').html('')
	    });
	</script>
	</div>
</div>