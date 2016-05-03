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
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">Bus管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改Bus</a></li>
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
									
										</thead>

										<tbody>
										
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