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
					<li class="active"><a data-toggle="tab" href="#home1">地域百分比管理</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<form class="form-horizontal J_ajaxForm" id="myform" action="<?php echo U('Admin/Menu_percent/saveMenuPercent',array('page'=>$page));?>" method="post">
							<div class="row">
								<div class="col-xs-12 no-padding-right">
									<div class="table-responsive">
										<div style="margin-bottom:10px" >
									   		商品分类：<select class="select_2" id="proClass" name="proClass" onchange="selectMenu()">
														<option value="0">全分类</option>
														<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addmenu): $mod = ($i % 2 );++$i; if($menuid == $addmenu["id"] ): ?><option value="<?php echo ($addmenu["id"]); ?>"  selected = "selected"><?php echo ($addmenu["name"]); ?></option>
															<?php else: ?>
																<option value="<?php echo ($addmenu["id"]); ?>" ><?php echo ($addmenu["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
												   </select>		
											
											地域：<select class="select_2" id="proCity" name="proCity" onchange="selectMenu()">
													<?php if($usercity != '0' ): ?><option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></option>
													<?php else: ?>
														<option value="0">全地域</option>
														<?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($cityid == $city['id']): ?><option value="<?php echo ($city["id"]); ?>"  selected = "selected"><?php echo ($city["name"]); ?></option>
															<?php else: ?>
																<option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
												</select>
										</div>	
										<table id="sample-table-1"
											class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th class="center"><label> <input
															type="checkbox" name="row_title" class="ace"> <span class="lbl"></span>
													</label></th>
													<th>序号</th>
													<th>地域</th>
													<th>分类</th>
													<th>地域百分比</th>
													<td style="display:none"><input type="text" name="dataNum" id="dataNum" value="<?php echo ($dataNum); ?>"></td>
												</tr>
											</thead>
	
											<tbody>
											<?php if(is_array($menupercent)): $k = 0; $__LIST__ = $menupercent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
													<td class="center">
														<?php if($vo['check'] == '1' ): ?><input type="checkbox" class="ace" id="check_<?php echo ($k); ?>" checked="true" name="check_<?php echo ($k); ?>" value="1"> <span class="lbl"></span>
														<?php else: ?>
															<input type="checkbox" class="ace" id="check_<?php echo ($k); ?>" name="check_<?php echo ($k); ?>" value="1"> <span class="lbl"></span><?php endif; ?>
													</td>
													<td><?php echo ($k); ?></td>
													<td><?php echo ($vo["cityname"]); ?></td>
													<td><?php echo ($vo["menuname"]); ?></td>
													<td><input type="text" name="percent_<?php echo ($k); ?>" id="percent_<?php echo ($k); ?>" value="<?php echo ($vo["percent"]); ?>" onblur="changePercent(this, <?php echo ($k); ?>, <?php echo ($vo["percent"]); ?>)"></td>
													<td style="display:none"><input type="text" name="cityid_<?php echo ($k); ?>" id="cityid_<?php echo ($k); ?>" value="<?php echo ($vo["cityid"]); ?>"></td>
													<td style="display:none"><input type="text" name="menuid_<?php echo ($k); ?>" id="menuid_<?php echo ($k); ?>" value="<?php echo ($vo["menuid"]); ?>"></td>
													<td style="display:none"><input type="text" name="id_<?php echo ($k); ?>" id="id_<?php echo ($k); ?>" value="<?php echo ($vo["id"]); ?>"></td>
												</tr><?php endforeach; endif; else: echo "" ;endif; ?>
											</tbody>
										</table>
										<?php if($totalPage > 1) { ?>
											<div class="page_lcb">
												<?php if($page == 1): ?><div class="page_up_lcb"><a href="javascript:void(0);">上一页<i><em></em></i></a></div>
												<?php else: ?>
													<div class="page_up_lcb"><a href="javascript:void(0);" onclick="changePage(<?php echo ($dataNum); ?>, <?php echo ($page); ?>, <?php echo ($page - 1); ?>);">上一页<i><em></em></i></a></div><?php endif; ?>
												<?php if($page == $totalPage): ?><div class="page_dr_lcb"><a href="javascript:void(0);">下一页<i><em></em></i></a></div>
												<?php else: ?>
													<div class="page_dr_lcb"><a href="javascript:void(0);" onclick="changePage(<?php echo ($dataNum); ?>, <?php echo ($page); ?>, <?php echo ($page + 1); ?>);">下一页<i><em></em></i></a></div><?php endif; ?>
												<div class="page_dr_lcb">
									             	<select id="pageL" name="pageL" onchange="changePage(<?php echo ($dataNum); ?>, <?php echo ($page); ?>, this.value);">
									             		<?php if(is_array($pageList)): $i = 0; $__LIST__ = $pageList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voFee): $mod = ($i % 2 );++$i;?><option value='<?php echo ($voFee["page"]); ?>' <?php if($voFee["page"] == $page): ?>selected<?php endif; ?>><?php echo ($voFee["page"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									             	</select>
												</div>
											</div>
										<?php }else{} ?> 
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
			function addSubmenu(o) {
				var subid = $(o).parent().prev().prev().html();
				$('select[name="parent"]').val(subid);
				$('input[name="addmenu"]').val('0');
				$('input[name="name"]').val('');
				
				$('#myTab li').eq(1).find('a').click();
			}
			function reSubmenu(o){
				var name = $(o).parent().prev().html().replace(/&nbsp;/g,'').replace('├─','');
				var pid = $(o).parent().prev().prev().attr('parent');
				var subid = $(o).parent().prev().prev().html();
				$('select[name="parent"]').val(pid);
				$('input[name="name"]').val(name);
				$('input[name="addmenu"]').val(subid);
				$('#myTab li').eq(1).find('a').click();
			}
			
			function selectMenu() {
				var menu = $('select[name="proClass"]').val();
				var city = $('select[name="proCity"]').val();

				post("<?php echo U('Admin/Menu_percent/index');?>", {menuid:menu,cityid:city});
			}
			
			function changePercent(obj, row, value) {
				
	    		var percent = $('input[name="percent_'+row+'"]').val();
	    		var checkboxid = "check_" + row;
	    			    		
	    		if ( !isNaN( percent )) {
		    		percent = parseFloat(percent);
	    		} else {
	    			alert( "地域百分比只能输入数字！" );
	    			return;
	    		}
	    		
	    		value = parseFloat(value);
	    		if ( value != percent ) {
	    			document.getElementById(checkboxid).checked = true;
	    		}
	    		
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
							cityid:$('input[name="cityid_'+index+'"]').val(),
							menuid:$('input[name="menuid_'+index+'"]').val(),
							check:check,
							id:$('input[name="id_'+index+'"]').val()
					}
					
					pagedata[i] = JSON.stringify(datalist);
				}
				var data = pagedata.join("|");					
				post("<?php echo U('Admin/Menu_percent/index');?>", {page:goPage,curPage:curPage,curPageData:data,menuid:menu,cityid:city});
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