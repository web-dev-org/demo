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
<link href="__PUBLIC__/Plugin/style/css/page.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Plugin/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Plugin/umeditor/lang/zh-cn/zh-cn.js"></script>

<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li><a data-toggle="tab" href="#home1">旅行社管理</a></li>
					<li><a data-toggle="tab" href="#home1">添加/修改旅行社</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						
					</div>
					<div id="home2" >
						
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">

	    	function submitPrice(button, page) {

    			actionOne = "__URL__/savePrice/page/" + page;	    			
	    		document.forms.priceform.action=actionOne;

	    		document.priceform.submit();

	    	}
	    	
	    	function changePrice(obj, row, price) {
	    		
	    		var percent = $('input[name="percent_'+row+'"]').val();
	    		var bprice = $('input[name="bprice_'+row+'"]').val();
	    		var vprice = $(obj).parent().next().html();
	    		var checkboxid = "check_" + row;
	    		
	    		if ( !isNaN( percent )) {
		    		percent = parseFloat(percent);
	    		} else {
	    			alert( "地域百分比只能输入数字！" );
	    			return;
	    		}
	    		
	    		if ( !isNaN( bprice )) {
	    			bprice = parseFloat(bprice);
	    		} else {
	    			alert( "基本价格只能输入数字！" );
	    			return;
	    		}
	    		

	    		price = parseFloat(price);
	    		
	    		if ( price != bprice ) {
	    			nprice = bprice + (bprice * percent * 0.01);
	    			nprice = Math.round(nprice*100)/100;
	    			
	    			amt = nprice - vprice;
	    			amt = Math.round(amt*100)/100;
	    			$(obj).parent().next().next().html(nprice);
	    			$(obj).parent().next().next().next().html(amt);
	    			document.getElementById(checkboxid).checked = true;
	    		}
	    		
	    	}
	    	
			function changePercent(obj, row, value) {
	    						
	    		var percent = $('input[name="percent_'+row+'"]').val();
	    		var bprice = $('input[name="bprice_'+row+'"]').val();
	    		var vprice = $(obj).parent().next().next().html();
	    		var checkboxid = "check_" + row;
	    			    		
	    		if ( !isNaN( percent )) {
		    		percent = parseFloat(percent);
	    		} else {
	    			alert( "地域百分比只能输入数字！" );
	    			return;
	    		}
	    		
	    		if ( !isNaN( bprice )) {
	    			bprice = parseFloat(bprice);
	    		} else {
	    			alert( "基本价格只能输入数字！" );
	    			return;
	    		}
	    		
	    		value = parseFloat(value);
	    		if ( value != percent ) {
	    			nprice = bprice + (bprice * percent * 0.01);
	    			nprice = Math.round(nprice*100)/100;
	    			
	    			amt = nprice - vprice;
	    			amt = Math.round(amt*100)/100;
	    			$(obj).parent().next().next().next().html(nprice);
	    			$(obj).parent().next().next().next().next().html(amt);
	    			document.getElementById(checkboxid).checked = true;
	    		}
	    		
	    	}
			
			function selectPrice() {
				var menu = $('select[name="proClass"]').val();
				var city = $('select[name="proCity"]').val();
				
				post("<?php echo U('Admin/Price/index');?>", {menuid:menu,cityid:city});
			}
			
			
			function changePage(dataNum, curPage, goPage) {	
				var datalist = new Array();
				var menu = $('select[name="proClass"]').val();
				var city = $('select[name="proCity"]').val();
				var checkboxid = "";
				var check = "";
				var pagedata = new Array();
				var index = 0;
				for ( i=0; i<dataNum; i++ ) {
					index = i + 1;
					checkboxid = "check_" + index;
					if ( document.getElementById(checkboxid).checked == true) {
						check = "1";
					} else {
						check = "";
					}
					datalist = {
							percent:$('input[name="percent_'+index+'"]').val(),
							price:$('input[name="bprice_'+index+'"]').val(),
							check:check,
							id:$('input[name="unitid_'+index+'"]').val()
					}
					
					pagedata[i] = JSON.stringify(datalist);
				}
				var data = pagedata.join("|");					
				post("<?php echo U('Admin/Price/index');?>", {page:goPage,curPage:curPage,curPageData:data,menuid:menu,cityid:city});
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