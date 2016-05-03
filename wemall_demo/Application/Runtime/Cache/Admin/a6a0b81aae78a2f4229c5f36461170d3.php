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
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">商品管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改商品</a></li>
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
												<th class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></th>
												<th>ID</th>
												<th>商品名称</th>
												<th>商品分类</th>
												<th>商品单位</th>
												<th>所属地域</th>
												<th>基本价格</th>
												<th>当前状态</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td>
												<td><?php echo ($result["id"]); ?></td>
												<td><?php echo ($result["productname"]); ?></td>
												<td><?php echo ($result["menu"]); ?></td>
												<td><?php echo ($result["name"]); ?></td>
												<td><?php echo ($result["cityname"]); ?></td>
												<td><?php echo ($result["bprice"]); ?></td>
												<td><?php echo ($result["statesname"]); ?></td>
												<td style="display:none" ><?php echo ($result["feibiao"]); ?></td>
												<td style="display:none" ><?php echo ($result["tuijian"]); ?></td>
												<td style="display:none" ><?php echo ($result["lownum"]); ?></td>
												<td style="display:none" ><?php echo ($result["info"]); ?></td>
												<td style="display:none" ><?php echo ($result["states"]); ?></td>
												<td style="display:none" ><?php echo ($result["num"]); ?></td>
												<td style="display:none" ><?php echo ($result["img"]); ?></td>
												<td style="display:none" ><?php echo ($result["productid"]); ?></td>
												<td style="display:none" ><?php echo ($result["menuid"]); ?></td>
												<td style="display:none" ><?php echo ($result["cityid"]); ?></td>
												<td><a href="javascript:void(0);" onclick="reProduct(this);" class="btn btn-white btn-sm">修改</a><a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/Product/delproduct',array('unitid'=>$result['id'],'productid'=>$result['productid'],'cityid'=>$result['cityid']));?>">删除</a></td>
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
						<form class="form-horizontal J_ajaxForm" enctype="multipart/form-data" id="myform" action="<?php echo U('Admin/Product/addProduct');?>" method="post">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table width="100%">
											<tbody>
												<tr>
													<td>商品分类:</td>
													<td><select class="select_2" name="addmenuid">
															<?php if(is_array($addmenu)): $i = 0; $__LIST__ = $addmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addmenu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($addmenu["id"]); ?>"><?php echo ($addmenu["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select></td>
												</tr>
												<tr>
													<td>商品名称:</td>
													<td><input type="text" class="input col-sm-6" name="addname" value=""></td>
													<td style="display:none"><input type="text" name="unitid" value=""></td>
													<td style="display:none"><input type="text" name="productid" value=""></td>
													<td style="display:none"><input type="text" name="cityid" value=""></td>
												</tr>
												<tr>
													<td>商品图片:</td>
													<td><input multiple="multiple" type="file" name="addimage">
													<p class="help-block">允许的附件文件类型: jpg,gif,png,jpeg并且图片大小小于200k.</p></td>
												</tr>
												<tr>
													<td>商品状态:</td>
													<td><select name="addstatus"><option value="1">出售</option>
														<option value="0">下架</option></select></td>
												</tr>
												<tr>
													<td>非标标志:</td>
													<td><select name="addfeibiao"><option value="1">否</option>
														<option value="0">是</option></select></td>
												</tr>
												<tr>
													<td>商品推荐:</td>
													<td><select name="addtuijian"><option value="1">正常</option>
														<option value="0">推荐</option></select></td>
												</tr>
												<tr>
													<td>商品属性:</td>
													<td>
														<table id='unittable' width="60%" >
															<tr>										
																<td align="right">单位：</td>
																<td align="right"><input type="text" class="tdInput" id="addunit_0" name="addunit_0" value=""></td>
																<td align="right">默认订购量：</td>
																<td align="right"><input type="text" class="tdInput" id="addnum_0" name="addnum_0" value=""></td>
																<td align="right">最低订购量：</td>
																<td align="right"><input type="text" class="tdInput" id="lownum_0" name="lownum_0" value=""></td>
																<td><button onclick='addUnit()'>添加单位</button></td>	
																<td style="display:none"><input type="text" id="addunitNum" name="addunitNum" value="1"></td>
															</tr>
														</table>
													</td>											
												</tr>
												<tr>
													<td>商品详情:</td>
													<td><!--style给定宽度可以影响编辑器的最终宽度-->
														<div type="text/plain" id="myEditor" style="width:660px;height:240px;">
														</div>
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
			var flag = true;
			function reProduct(o) {
				var unitid = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var productname = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var unitname = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var cityid = $(o).parent().prev().html();
				var menuid = $(o).parent().prev().prev().html();
				var productid = $(o).parent().prev().prev().prev().html();
				var img = $(o).parent().prev().prev().prev().prev().html();
				var num = $(o).parent().prev().prev().prev().prev().prev().html();
				var states = $(o).parent().prev().prev().prev().prev().prev().prev().html();
				var info = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var lownum = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var tuijian = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var feibiao = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
								
				$('select[name="addmenuid"]').val(menuid);
				$('input[name="addname"]').val(productname);
				$('input[name="unitid"]').val(unitid);
				$('input[name="productid"]').val(productid);
				$('input[name="cityid"]').val(cityid);
				$('input[name="addunit_0"]').val(unitname);
				$('input[name="addnum_0"]').val(num);
				$('input[name="lownum_0"]').val(lownum);
				$('select[name="addstatus"]').val(states);
				$('select[name="addtuijian"]').val(tuijian);
				$('select[name="addfeibiao"]').val(feibiao);
				$('#myEditor').html(info);
				
				if (flag) {
					$('input[name="addimage"]').parent().append('<img src="__PUBLIC__/Uploads/'+img+'" id="goodimage" style="max-width:650px" class="img-thumbnail">');
					flag = false;
				}else{
					$('#goodimage').attr("src","__PUBLIC__/Uploads/"+img);
				}

				$('#myTab li').removeClass("active");
				$('#myTab li').eq(1).addClass("active");
				$('#home1').removeClass("active");
				$('#home2').addClass("active");
			}
			
			
		    var i = parseInt(document.getElementById("addunitNum").value);
		    function addUnit() {
		    	var textVal = new Array();
		    	var unit = "addunit_";
		    	var num = "addnum_";
			    var lownum = "lownum_";

		    	var unitname = "";
		    	var numname = "";
		    	var lowname = "";
		    	
		    	for ( j=0; j<i; j++ ) {
		    		var oneVal = new Array();
		    		unitname = unit + j;
		    		numname = num + j;
		    		lowname = lownum + j;
		    		oneVal.push(document.getElementById(unitname).value);
		    		oneVal.push(document.getElementById(numname).value);
		    		oneVal.push(document.getElementById(lowname).value);
		    		textVal.push(oneVal);
		    	}
		    	
		    	document.getElementById("unittable").innerHTML+='<tr id="tr_'+i+'"><td colspan="2" align="right"><input type="text" class="tdInput" id="addunit_'+i+'" name="addunit_'+i+'" value=""></td><td colspan="2" align="right"><input type="text" class="tdInput" id="addnum_'+i+'" name="addnum_'+i+'" value=""></td><td colspan="2" align="right"><input type="text" class="tdInput" id="lownum_'+i+'" name="lownum_'+i+'" value=""></td><td><input type="button" value="删除"  onclick="delUnit('+i+')"/></td></tr>';

		    	for ( l=0; l<i; l++ ) {
		    		var oneVal = new Array();
		    		unitname = unit + l;
		    		numname = num + l;
		    		lowname = lownum + l;
		    		document.getElementById(unitname).value = textVal[l][0];
		    		document.getElementById(numname).value = textVal[l][1];
		    		document.getElementById(lowname).value = textVal[l][2];
		    	}
		    	
		    	i = i + 1;
		    	document.getElementById("addunitNum").value = i;
		    }
		    
	    	function delUnit(o){
	    		var tr = document.getElementById('tr_'+o);
	    		tr.parentNode.removeChild(tr);
	    		i = i - 1;
	    		document.getElementById("addunitNum").value = i;
		    }
		    
		</script>
		<script type="text/javascript">
	    //实例化编辑器
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