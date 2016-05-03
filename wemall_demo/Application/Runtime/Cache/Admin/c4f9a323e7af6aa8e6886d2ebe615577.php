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
<script>  

	$(function(){
		$("#fullcuttype1").change(function() {
			var value = $(this).find("option:checked").val();
		
			if (value == "0") {
				document.getElementById("cart").style.display="none";
				document.getElementById("producttype").style.display="none";
				document.getElementById("singleproduct").style.display="none";
			}
			if (value == "4") {
				document.getElementById("cart").style.display="block";
				document.getElementById("producttype").style.display="none";
				document.getElementById("singleproduct").style.display="none";
			}
			if (value == "5") {
				document.getElementById("cart").style.display="none";
				document.getElementById("producttype").style.display="block";
				document.getElementById("singleproduct").style.display="none";
			}
			if (value == "6") {
				document.getElementById("cart").style.display="none";
				document.getElementById("producttype").style.display="none";
				document.getElementById("singleproduct").style.display="block";
			}
		});
	}) 
	
	function activeCtrlCX(){
		//购物车满减
		if(document.myform.money2_0.value.length>0 && document.myform.money2_0.value!='0'){
			document.myform.money1_0.readOnly=true;
		}else{
			document.myform.money1_0.readOnly=false;
		}
		if(document.myform.money1_0.value.length>0 && document.myform.money1_0.value!='0'){
			document.myform.money2_0.readOnly=true;
		}else{
			document.myform.money2_0.readOnly=false;
		}
		
		if ( (document.myform.money2_0.value.length>0 && document.myform.money2_0.value!='0') || 
				(document.myform.money1_0.value.length>0 && document.myform.money1_0.value!='0') ||
				 (document.myform.cartmoney_0.value.length>0 && document.myform.cartmoney_0.value!='0')) {
			document.myform.fullcuttype1.disabled=true;
		} else {
			document.myform.fullcuttype1.disabled=false;
		}
			
	}
	
	function activeCtrlMenu(){
		//产品品类满减
		if(document.myform.typemoney1.value.length>0 && document.myform.typemoney1.value!='0'){
			document.myform.typemoney2.readOnly=true;
		}else{
			document.myform.typemoney2.readOnly=false;
		}
		
		if(document.myform.typemoney2.value.length>0 && document.myform.typemoney2.value!='0'){
			document.myform.typemoney1.readOnly=true;
		}else{
			document.myform.typemoney1.readOnly=false;
		}	
	}
	
	function activeCtrlPro(){
		//商品满减
		if(document.myform.productmoney1.value.length>0 && document.myform.productmoney1.value!='0'){
			document.myform.productmoney2.readOnly=true;
		}else{
			document.myform.productmoney2.readOnly=false;
		}
		
		if(document.myform.productmoney2.value.length>0 && document.myform.productmoney2.value!='0'){
			document.myform.productmoney1.readOnly=true;
		}else{
			document.myform.productmoney1.readOnly=false;
		}	
	}
</script>
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">Bus预定</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					
					
					
					
					
				</div>
			</div>
		</div>
		<script type="text/javascript">
			var flag = true;
			function reSubactive(o){
				var oldPrice = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var activePrice = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var activeType = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var openFlg = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var cityId = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var productId = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var stock = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var lowBuy = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var maxBuy = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var preparFlg = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var preparPay = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var info = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var activeImg = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var id = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var activeName = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var startTime = $(o).parent().prev().prev().prev().html();
				var endTime = $(o).parent().prev().prev().html();
				var productname = $(o).parent().prev().html();
				
				$('input[name="addactiveId"]').val(id);
				$('input[name="activename"]').val(activeName);
				$('select[name="states"]').val(openFlg);
				$('input[name="starttime"]').val(startTime);
				$('input[name="endtime"]').val(endTime);
				$('select[name="cityid"]').val(cityId);
				$('select[name="actiontype"]').val(activeType);
				$('input[name="productid"]').val(productId);
				$('input[name="productname"]').val(productname);
				$('input[name="productprice"]').val(oldPrice);			
				$('input[name="nprice"]').val(activePrice);
				$('input[name="lowbuynum"]').val(lowBuy);
				$('input[name="maxbuynum"]').val(maxBuy);
				$('select[name="paystates"]').val(preparFlg);
				$('input[name="paypercent"]').val(preparPay);
				$('input[name="storenum"]').val(stock); 
				$('#myEditor').html(info);
				
				if (flag) {
					$('input[name="activeimg"]').parent().append('<img src="__PUBLIC__/Uploads/'+activeImg+'" name="saveImg" id="activeimage" style="max-width:650px" class="img-thumbnail">');
					flag = false;
				}else{
					$('#activeimage').attr("src","__PUBLIC__/Uploads/"+activeImg);
				}
				
				if(activeType =="4" || activeType == "5" || activeType == "6" ){
					$('#myTab li').removeClass("active");
					$('#myTab li').eq(1).addClass("active");
					$('#home1').removeClass("active");
					$('#home2').addClass("active");
				}else{
					$('#myTab li').removeClass("active");
					$('#myTab li').eq(2).addClass("active");
					$('#home1').removeClass("active");
					$('#home3').addClass("active");
				}
			}
			
			function reCxactive(o) {
				var activeType = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var openFlg = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var cityId = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();				
				var id = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var activeName = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var startTime = $(o).parent().prev().prev().prev().html();
				var endTime = $(o).parent().prev().prev().html();		
				var num = 0;
				$.ajax({
		        	type:"POST",
		        	url: "<?php echo U('Admin/Active/getActiveData');?>",
		            dataType:"json",
		            data: {
		                activeId:id 
		            },
		            success:function(data){
		                if(data.result == "succ"){
		                	for(n=0;n<data.info.length;n++){
		                		if ( activeType == "4" ) {
		            				$('input[name="cartmoney_0"]').val(data.info[n].fullAmt);
		            				$('input[name="money1_0"]').val(data.info[n].outPercent);
		            				$('input[name="money2_0"]').val(data.info[n].outAmt);
		                		} else if ( activeType == "5" ) {
				    		    	document.getElementById("menuTable").innerHTML+='<tr id="tr_'+n+'"><td align="right"><input type="text" readonly="readonly" style="width:40px;" id="menuId_'+n+'" name="menuId_'+n+'" value="'  + data.info[n].id + ' "><input readonly="readonly" type="text" style="width:115px;" id="menuName_'+n+'" name="menuName_'+n+'" value=" ' + data.info[n].name + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuFull_'+n+'" name="menuFull_'+n+'" value="' + data.info[n].fullAmt + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuPer_'+n+'" name="menuPer_'+n+'" value="' +data.info[n].outPercent+ '"></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuAmt_'+n+'" name="menuAmt_'+n+'" value="' + data.info[n].outAmt + ' "></td><td align="right"><input type="button" value="删除"  onclick="delMenu('+n+')"/></td></tr>';
		                		} else if ( activeType == "6" ) {
				                	document.getElementById("productTable").innerHTML+='<tr id="tr_'+n+'"><td align="right"><input type="text" readonly="readonly" style="width:40px;" id="proId_'+n+'" name="proId_'+n+'" value="'  + data.info[n].id + ' "><input readonly="readonly" type="text" style="width:115px;" id="proName_'+n+'" name="proName_'+n+'" value=" ' + data.info[n].name + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="proFull_'+n+'" name="proFull_'+n+'" value="' + data.info[n].fullAmt + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="proPer_'+n+'" name="proPer_'+n+'" value="' +data.info[n].outPercent+ '"></td><td align="right"><input readonly="readonly" type="text" class="input" id="proAmt_'+n+'" name="proAmt_'+n+'" value="' + data.info[n].outAmt + ' "></td><td align="right"><input type="button" value="删除"  onclick="delPro('+n+')"/></td></tr>';
		                		}
		                		
		                	}
		                	num = data.info.length;
		                	
		                	if ( activeType == "5" ) {
		                		$('input[name="addMenuNum"]').val(num);
		                		i = num;
		        				document.getElementById("cart").style.display="none";
		        				document.getElementById("producttype").style.display="block";
		        				document.getElementById("singleproduct").style.display="none";
		            		} else if ( activeType == "6" ) {
		                		$('input[name="addProNum"]').val(num);
		                		m = num;
		        				document.getElementById("cart").style.display="none";
		        				document.getElementById("producttype").style.display="none";
		        				document.getElementById("singleproduct").style.display="block";
		            		} else if( activeType == "4" ){
		        				document.getElementById("cart").style.display="block";
		        				document.getElementById("producttype").style.display="none";
		        				document.getElementById("singleproduct").style.display="none";	
		            		}
		                			                	
		    				$('input[name="addactiveId1"]').val(id);
		    				$('input[name="activename1"]').val(activeName);
		    				$('select[name="states1"]').val(openFlg);
		    				$('input[name="starttime1"]').val(startTime);
		    				$('input[name="endtime1"]').val(endTime);
		    				$('select[name="cityid1"]').val(cityId);
		    				$('select[name="fullcuttype1"]').val(activeType);

		    				
		    				document.myform.fullcuttype1.disabled=true;

		    				if(activeType == "4" || activeType == "5" || activeType == "6"){
		    					$('#myTab li').removeClass("active");
		    					$('#myTab li').eq(1).addClass("active");
		    					$('#home1').removeClass("active");
		    					$('#home2').addClass("active");
		    				}else{
		    					$('#myTab li').removeClass("active");
		    					$('#myTab li').eq(2).addClass("active");
		    					$('#home1').removeClass("active");
		    					$('#home3').addClass("active");
		    				}
		                	
		                }else{
		                	alert("品类库中无此种品类！");
		                	return;
		                }
		            },
		            error:function(){
		               return alert("追加失败");
		            }
		        });
			}
			
			function cxCheck() {
				var activeName = $('input[name="activename1"]').val();
				var activeStates = $('select[name="states1"]').val();
				var startTime = $('input[name="starttime1"]').val();
				var endTime = $('input[name="endtime1"]').val();
				var city = $('select[name="cityid1"]').val();
				var cxType = $('select[name="fullcuttype1"]').val();
				
				if ( activeName.length == 0 ) {
					alert("活动名称未填写！");
					return false;
				}
				if ( startTime.length == 0 ) {
					alert("开始时间未填写！");
					return false;
				}
				if ( endTime.length == 0 ) {
					alert("结束时间未填写！");
					return false;
				}
				
				var d1 = new Date(startTime.replace(/\-/g, "\/"));  
				var d2 = new Date(endTime.replace(/\-/g, "\/"));
				var myDate = new Date();
				var d3 = myDate.toLocaleDateString(); 
				d3 = new Date(d3.replace(/\-/g, "\/")); 
				
				if ( d1 < d3 ) {
					alert("开始时间不能小于当前时间！");
					return false;
				}
				if ( d2 < d3 ) {
					alert("结束时间不能小于当前时间！");
					return false;
				}
				if ( d1 >= d2 ) {
					alert("开始时间不能大于结束时间！");
					return false;
				}
				
				if ( city == "0" ) {
					alert("请选择准入地域！");
					return false;
				}
				if ( cxType == "0" ) {
					alert("请选择满减类型！");
					return false;
				}
				
				if ( cxType == "4" ) {
					if ( $('input[name="cartmoney_0"]').val() == "" || $('input[name="cartmoney_0"]').val() == "0") {
						alert("购物车满减金额不能为空！");
						return false;
					}
					if ( ($('input[name="money1_0"]').val() == "" || $('input[name="money1_0"]').val() == "0") &&
							($('input[name="money2_0"]').val() == "" || $('input[name="money2_0"]').val() == "0")) {
						alert("优惠百分比与优惠元不能同时为空！");
						return false;
					}
				} else if ( cxType == "5" ) {
					if ( $('input[name="addMenuNum"]').val() == '0' ) {
						alert("请追加信息后，再保存！");
						return false;
					}
				} else if ( cxType == "6" ) {
					if ( $('input[name="addProNum"]').val() == '0' ) {
						alert("请追加信息后，再保存！");
						return false;
					}
				}
				
				document.myform.fullcuttype1.disabled=false;
				return true;
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
		
			//促销分类追加
		    var i = parseInt(document.getElementById("addMenuNum").value);
			function cxAddMenu() {
		    	var textVal = new Array();
				var id = $('input[name="cxMenuId"]').val();
				var fullAmt = $('input[name="producttypemoney"]').val();
				var prepayPer = $('input[name="typemoney1"]').val();
				var prepayAmt = $('input[name="typemoney2"]').val();

		    	var menuId = "menuId_";
		    	var menuName = "menuName_";
			    var menuFull = "menuFull_";
			    var menuPer = "menuPer_";
			    var menuAmt = "menuAmt_";

		    	var menuIdName = "";
		    	var menuNameName = "";
		    	var menuFullName = "";
		    	var menuPerName = "";
		    	var menuAmtName = "";
		    	
				if ( id == "" ) {
					alert("id不能为空！");
					return;
				}
				
				if ( fullAmt == "" ) {
					alert("满减金额不能为空！");
					return;
				}
				if ( prepayPer == "" && prepayAmt == "" ) {
					alert("优惠百分比金额和优惠金额不能都为空！");
					return;
				} 
				
				$.ajax({
		        	type:"POST",
		        	url: "<?php echo U('Admin/Active/findMenuId');?>",
		            dataType:"json",
		            data: {
		                classId:id 
		            },
		            success:function(data){
		                if(data.result == "succ"){
		                	
		                	var sameFlg = false;
		    		    	for ( j=0; j<i; j++ ) {
		    		    		var oneVal = new Array();
		    		    		menuIdName = menuId + j;
		    		    		menuNameName = menuName + j;
		    		    		menuFullName = menuFull + j;
		    		    		menuPerName = menuPer + j;
		    		    		menuAmtName = menuAmt + j;
		    		    		
		    		    		if (document.getElementById(menuIdName).value == data.info.id) {
		    		    			sameFlg = true;
		    		    			break;
		    		    		}
		    		    		
		    		    		oneVal.push(document.getElementById(menuIdName).value);
		    		    		oneVal.push(document.getElementById(menuNameName).value);
		    		    		oneVal.push(document.getElementById(menuFullName).value);
		    		    		oneVal.push(document.getElementById(menuPerName).value);
		    		    		oneVal.push(document.getElementById(menuAmtName).value);
		    		    		textVal.push(oneVal);
		    		    	}
		                			    		    	
		    		    	if (sameFlg) {
		    		    		alert("重复追加相同的品类信息，请重新填写！");
		    		    		return;
		    		    	}
		    		    	document.getElementById("menuTable").innerHTML+='<tr id="tr_'+i+'"><td align="right"><input type="text" readonly="readonly" style="width:40px;" id="menuId_'+i+'" name="menuId_'+i+'" value="'  + data.info.id + ' "><input readonly="readonly" type="text" style="width:115px;" id="menuName_'+i+'" name="menuName_'+i+'" value=" ' + data.info.name + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuFull_'+i+'" name="menuFull_'+i+'" value="' + fullAmt + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuPer_'+i+'" name="menuPer_'+i+'" value="' +prepayPer+ '"></td><td align="right"><input readonly="readonly" type="text" class="input" id="menuAmt_'+i+'" name="menuAmt_'+i+'" value="' + prepayAmt + ' "></td><td align="right"><input type="button" value="删除"  onclick="delMenu('+i+')"/></td></tr>';
		    		    	for ( l=0; l<i; l++ ) {
		    		    		menuIdName = menuId + l;
		    		    		menuNameName = menuName + l;
		    		    		menuFullName = menuFull + l;
		    		    		menuPerName = menuPer + l;
		    		    		menuAmtName = menuAmt + l;
		    		    		document.getElementById(menuIdName).value = textVal[l][0];
		    		    		document.getElementById(menuNameName).value = textVal[l][1];
		    		    		document.getElementById(menuFullName).value = textVal[l][2];
		    		    		document.getElementById(menuPerName).value = textVal[l][3];
		    		    		document.getElementById(menuAmtName).value = textVal[l][4];
		    		    	}

		    		    	i = i + 1;
		    		    	document.getElementById("addMenuNum").value = i;
		    		    	
		    				document.myform.typemoney2.readOnly=false;
		    				document.myform.typemoney1.readOnly=false;
		    				document.myform.fullcuttype1.disabled=true;
		    				
		                }else{
		                	alert("品类库中无此种品类！");
		                	return;
		                }
		            },
		            error:function(){
		               return alert("追加失败");
		            }
		        });
			}
			
	    	function delMenu(o){
	    		var textVal = new Array();
		    	var menuId = "menuId_";
		    	var menuName = "menuName_";
			    var menuFull = "menuFull_";
			    var menuPer = "menuPer_";
			    var menuAmt = "menuAmt_";

		    	var menuIdName = "";
		    	var menuNameName = "";
		    	var menuFullName = "";
		    	var menuPerName = "";
		    	var menuAmtName = "";
		    	
		    	for ( j=0; j<i; j++ ) {
		    		if ( j!=o ) {
		    			var oneVal = new Array();
			    		menuIdName = menuId + j;
			    		menuNameName = menuName + j;
			    		menuFullName = menuFull + j;
			    		menuPerName = menuPer + j;
			    		menuAmtName = menuAmt + j;
			    		
			    		oneVal.push(document.getElementById(menuIdName).value);
			    		oneVal.push(document.getElementById(menuNameName).value);
			    		oneVal.push(document.getElementById(menuFullName).value);
			    		oneVal.push(document.getElementById(menuPerName).value);
			    		oneVal.push(document.getElementById(menuAmtName).value);
			    		textVal.push(oneVal);
		    		}
		    	}
		    	var delIndex = i - 1;
	    		var tr = document.getElementById('tr_'+delIndex);
	    		tr.parentNode.removeChild(tr);
	    		i = i - 1;
	    			    		
	    		for ( l=0; l<i; l++ ) {
		    		menuIdName = menuId + l;
		    		menuNameName = menuName + l;
		    		menuFullName = menuFull + l;
		    		menuPerName = menuPer + l;
		    		menuAmtName = menuAmt + l;
		    		document.getElementById(menuIdName).value = textVal[l][0];
		    		document.getElementById(menuNameName).value = textVal[l][1];
		    		document.getElementById(menuFullName).value = textVal[l][2];
		    		document.getElementById(menuPerName).value = textVal[l][3];
		    		document.getElementById(menuAmtName).value = textVal[l][4];
		    	}
	    		document.getElementById("addMenuNum").value = i;
	    		if (i==0) {
    				document.myform.fullcuttype1.disabled=false;
	    		}
		    }
			
			//促销单品追加
		    var m = parseInt(document.getElementById("addProNum").value);
			function cxAddProduct() {
		    	var textVal = new Array();
				var id = $('input[name="cxProductId"]').val();
				var fullAmt = $('input[name="singleproductmoney"]').val();
				var prepayPer = $('input[name="productmoney1"]').val();
				var prepayAmt = $('input[name="productmoney2"]').val();

		    	var proId = "proId_";
		    	var proName = "proName_";
			    var proFull = "proFull_";
			    var proPer = "proPer_";
			    var proAmt = "proAmt_";

		    	var proIdName = "";
		    	var proNameName = "";
		    	var proFullName = "";
		    	var proPerName = "";
		    	var proAmtName = "";
				
				if ( id == "" ) {
					alert("id不能为空！");
					return;
				}
				if ( fullAmt == "" ) {
					alert("满减金额不能为空！");
					return;
				}
				if ( prepayPer == "" && prepayAmt == "" ) {
					alert("优惠百分比金额和优惠金额不能都为空！");
					return;
				} 
		    	
				$.ajax({
		        	type:"POST",
		        	url: "<?php echo U('Admin/Active/findProductId');?>",
		            dataType:"json",
		            data: {
		                productId:id 
		            },
		            success:function(data){
		                if(data.result == "succ"){
		                	if (data.info.length > 1 ) {
		                		alert("您所追加的商品存在多个，填写ID后再进行追加！");
		                		return;
		                	}
		                	
		                	var sameFlg = false;
		    		    	for ( j=0; j<m; j++ ) {
		    		    		var oneVal = new Array();
		    		    		proIdName = proId + j;
		    		    		proNameName = proName + j;
		    		    		proFullName = proFull + j;
		    		    		proPerName = proPer + j;
		    		    		proAmtName = proAmt + j;
		    		    		
		    		    		if ( document.getElementById(proIdName).value ==  data.info[0].id) {
		    		    			sameFlg = true;
		    		    			break;
		    		    		}
		    		    		
		    		    		oneVal.push(document.getElementById(proIdName).value);
		    		    		oneVal.push(document.getElementById(proNameName).value);
		    		    		oneVal.push(document.getElementById(proFullName).value);
		    		    		oneVal.push(document.getElementById(proPerName).value);
		    		    		oneVal.push(document.getElementById(proAmtName).value);
		    		    		textVal.push(oneVal);
		    		    	}
		                	
		    		    	if (sameFlg) {
		    		    		alert("重复追加相同的商品信息，请重新填写！");
		    		    		return;
		    		    	}
		    		    	
		                	document.getElementById("productTable").innerHTML+='<tr id="tr_'+m+'"><td align="right"><input type="text" readonly="readonly" style="width:40px;" id="proId_'+m+'" name="proId_'+m+'" value="'  + data.info[0].id + ' "><input readonly="readonly" type="text" style="width:115px;" id="proName_'+m+'" name="proName_'+m+'" value=" ' + data.info[0].name + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="proFull_'+m+'" name="proFull_'+m+'" value="' + fullAmt + ' "></td><td align="right"><input readonly="readonly" type="text" class="input" id="proPer_'+m+'" name="proPer_'+m+'" value="' +prepayPer+ '"></td><td align="right"><input readonly="readonly" type="text" class="input" id="proAmt_'+m+'" name="proAmt_'+m+'" value="' + prepayAmt + ' "></td><td align="right"><input type="button" value="删除"  onclick="delPro('+m+')"/></td></tr>';
		    		    	for ( l=0; l<m; l++ ) {
		    		    		proIdName = proId + l;
		    		    		proNameName = proName + l;
		    		    		proFullName = proFull + l;
		    		    		proPerName = proPer + l;
		    		    		proAmtName = proAmt + l;
		    		    		document.getElementById(proIdName).value = textVal[l][0];
		    		    		document.getElementById(proNameName).value = textVal[l][1];
		    		    		document.getElementById(proFullName).value = textVal[l][2];
		    		    		document.getElementById(proPerName).value = textVal[l][3];
		    		    		document.getElementById(proAmtName).value = textVal[l][4];
		    		    	}
		    		    	
		    		    	m = m + 1;
		    		    	document.getElementById("addProNum").value = m;
		    				document.myform.productmoney2.readOnly=false;
		    				document.myform.productmoney1.readOnly=false;
		    				document.myform.fullcuttype1.disabled=true;
		                }else{
		                	alert("商品库中无此种商品！");
		                	return;
		                }
		            },
		            error:function(){
		               return alert("提交失败");
		            }
		        });
			}
			
	    	function delPro(o){
	    		var textVal = new Array();
		    	var proId = "proId_";
		    	var proName = "proName_";
			    var proFull = "proFull_";
			    var proPer = "proPer_";
			    var proAmt = "proAmt_";

		    	var proIdName = "";
		    	var proNameName = "";
		    	var proFullName = "";
		    	var proPerName = "";
		    	var proAmtName = "";
		    	
		    	for ( j=0; j<m; j++ ) {
		    		if ( j!=o ) {
    		    		var oneVal = new Array();
    		    		proIdName = proId + j;
    		    		proNameName = proName + j;
    		    		proFullName = proFull + j;
    		    		proPerName = proPer + j;
    		    		proAmtName = proAmt + j;
    		    		
    		    		oneVal.push(document.getElementById(proIdName).value);
    		    		oneVal.push(document.getElementById(proNameName).value);
    		    		oneVal.push(document.getElementById(proFullName).value);
    		    		oneVal.push(document.getElementById(proPerName).value);
    		    		oneVal.push(document.getElementById(proAmtName).value);
    		    		textVal.push(oneVal);
		    		}
		    	}
		    	
		    	var delIndex = m - 1;
	    		var tr = document.getElementById('tr_'+delIndex);
	    		tr.parentNode.removeChild(tr);
	    		m = m - 1;
	    			    		
		    	for ( l=0; l<m; l++ ) {
		    		proIdName = proId + l;
		    		proNameName = proName + l;
		    		proFullName = proFull + l;
		    		proPerName = proPer + l;
		    		proAmtName = proAmt + l;
		    		document.getElementById(proIdName).value = textVal[l][0];
		    		document.getElementById(proNameName).value = textVal[l][1];
		    		document.getElementById(proFullName).value = textVal[l][2];
		    		document.getElementById(proPerName).value = textVal[l][3];
		    		document.getElementById(proAmtName).value = textVal[l][4];
		    	}
	    		document.getElementById("addProNum").value = m;
	    		if (m==0) {
    				document.myform.fullcuttype1.disabled=false;
	    		}

		    }
			
	    	function findProduct() {
				var id = $('input[name="productInfo"]').val();
				var city = $('select[name="cityid"]').val();
				
				if ( id == "" ) {
					alert("商品信息不能为空！");
					return;
				}
				if ( city == "0" ) {
					alert("请选择准入地域后再进行查询！");
					return;
				}
								
				$.ajax({
		        	type:"POST",
		        	url: "<?php echo U('Admin/Active/findProductId');?>",
		            dataType:"json",
		            data: {
		            	productId:id,
		            	cityId:city 
		            },
		            success:function(data){
		                if(data.result == "succ"){
		                	
		                	$('input[name="productid"]').val(data.info.id);
		                	$('input[name="productname"]').val(data.info.name);
		                	$('input[name="productprice"]').val(data.info.price);
		                }else{
		                	alert(data.reason);
		                	return;
		                }
		            },
		            error:function(){
		               return alert("查询失败");
		            }
		        });
	    		
	    	}
			
			function check() {
				
			    if ( ($('input[name="activename"]').val()).length == 0 ) {
					alert("活动名称未添加！");
					return false;
				}
			    
			    var startTime = $('input[name="starttime"]').val();
			    var endTime = $('input[name="endtime"]').val();

				if ( startTime.length == 0 ) {
					alert("开始时间未添加！");
					return false;
				}
				if ( endTime.length == 0 ) {
					alert("结束时间未添加！");
					return false;
				}
				
				var d1 = new Date(startTime.replace(/\-/g, "\/"));  
				var d2 = new Date(endTime.replace(/\-/g, "\/"));
				var myDate = new Date();
				var d3 = myDate.toLocaleDateString(); 
				d3 = new Date(d3.replace(/\-/g, "\/")); 
				
				if ( d2 < d3 ) {
					alert("结束时间不能小于当前时间！");
					return false;
				}
				if ( d1 >= d2 ) {
					alert("开始时间不能大于结束时间！");
					return false;
				}
				
				if ( $('select[name="cityid"]').val() == "0" ) {
					alert("请选择准入地域！");
					return false;
				}
				if ( $('select[name="actiontype"]').val() == "0" ) {
					alert("请选择活动类型！");
					return false;
				}
				if ( ($('input[name="nprice"]').val()).length == 0 ) {
					alert("活动价格未添加！");
					return false;
				}
				if ( ($('input[name="storenum"]').val()).length == 0 ) {
					alert("总量未添加！");
					return false;
				}
				if ( ($('input[name="lowbuynum"]').val()).length == 0 ) {
					alert("最低起购量未添加！");
					return false;
				}
				if ( ($('input[name="maxbuynum"]').val()).length == 0 ) {
					alert("最高限购量未添加！");
					return false;
				}
				if ( ($('input[name="productid"]').val()).length == 0 ) {
					alert("商品ID未添加！");
					return false;
				} 
				if ( ($('input[name="productname"]').val()).length == 0 ) {
					alert("商品名称未添加！");
					return false;
				}
	            return true;
			}
			
		</script>
		
		<script type="text/javascript">
		    //实例化编辑器
		    var um = UM.getEditor('myEditor');
		    var um = UM.getEditor('myEditor1');
		    um.addListener('blur',function(){
		        $('#focush2').html('编辑器失去焦点了')
		    });
		    um.addListener('focus',function(){
		        $('#focush2').html('')
		    });
		</script>
	</div>
</div>