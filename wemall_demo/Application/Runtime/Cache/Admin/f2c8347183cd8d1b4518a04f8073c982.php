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
					<li class="active"><a data-toggle="tab" href="#home1">用户管理</a></li>
					<li><a data-toggle="tab" href="#home2">详情</a></li>
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
												<div style="margin-bottom:10px">
												地域：<select name="rule" class="normal_select" >
													<?php if($cityid != '0' ): ?><option value="<?php echo ($citylist["id"]); ?>"><?php echo ($citylist["name"]); ?></option>
													<?php else: ?>
														<option value="0">全地域</option>
														<?php if(is_array($citylist)): $i = 0; $__LIST__ = $citylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$city): $mod = ($i % 2 );++$i; if($searchCity == $city['id']): ?><option value="<?php echo ($city["id"]); ?>"  selected = "selected"><?php echo ($city["name"]); ?></option>
															<?php else: ?>
																<option value="<?php echo ($city["id"]); ?>"><?php echo ($city["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
													</select>
												联系电话：<input type="text" class="input" style="width:100px;" id="seTel" name="seTel" value="<?php echo ($tel); ?>">
												邀请码：<input type="text" class="input" style="width:100px;" id="seTel" name="seSalesCode" value="<?php echo ($salesCode); ?>">
												<button class="btn btn-primary" style="height:30px;font-size: 10px;padding: 1px 10px;" onclick="search()">查询</button>
												</div>
												<th>店名</th>
												<th>联系人</th>
												<th>联系电话</th>
												<th>配送地址</th>
												<th>账户金额</th>
												<th>差额支付额度</th>
												<th>会员状态</th>
												<th>邀请码</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<td style="display:none"><?php echo ($result["states"]); ?></td>
												<td style="display:none"><?php echo ($result["memlevel"]); ?></td>
												<td style="display:none"><?php echo ($result["level"]); ?></td>
												<td style="display:none"><?php echo ($result["id"]); ?></td>
												<td><?php echo ($result["storename"]); ?></td>
												<td><?php echo ($result["name"]); ?></td>
												<td><?php echo ($result["tel"]); ?></td>
												<td><?php echo ($result["address"]); ?></td>
												<td><?php echo ($result["amt"]); ?></td>
												<td><?php echo ($result["diffstandard"]); ?></td>
												<td><?php echo ($result["statesName"]); ?></td>
												<td><?php echo ($result["salescode"]); ?></td>
												<td>
													<a href="javascript:void(0);" onclick="reInfo(this)" class="btn btn-white btn-sm">详情 </a>
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
						<form class="form-horizontal J_ajaxForm" id="myform" action="<?php echo U('Admin/Member/updateMemInfo');?>" method="post"  onsubmit="return check();">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td width=50%>　店名：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="userName" value=""></td>
													<td>　　会员级别:<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="memL" value=""></td>
												</tr>
												<tr>
													<td>　联系人：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="contacts" value=""></td>
													<td>　　　　电话：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="tel" value=""></td>
												</tr>
												<tr>
													<td>　　地址：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="address" value=""></td>
												</tr>
												<tr>
													<td>账户金额：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="memAmt" value=""></td>
													<td>差额受限额度：<input onfocus=this.blur() type="text" class="input"  style="border:0px; color:#000; font-size:12px;" name="diff" value=""></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
							<div class="form-actions">
								<table cellpadding="2" cellspacing="2" width="100%">
									<tbody>
										<tr>
											<td>
												<input type="hidden" name="userid" value="">
											</td>
											<td width=100>会员级别：</td>
											<td>
												<select name="memLevel" class="normal_select">
													<option value="1">1级会员</option>
													<option value="2">2级会员</option>
													<option value="3">3级会员</option>
													<option value="4">4级会员</option>
													<option value="5">5级会员</option>
												</select>
											</td>
											<td width=100>差额受限额度：</td>
											<td>
												<input type="text" class="input" name="diffNum" value="">
											</td>
											<td width=100>会员状态：</td>
											<td>
												<select name="memStates" class="normal_select">
													<option value="0">无效</option>
													<option value="1">有效</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<button class="btn btn-primary btn_submit J_ajax_submit_btn" type="submit">保存</button>
							<a class="btn" href="">返回</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">

			function reInfo(o){
				var levelid = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var level = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var id =    $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var username = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().html();
				var name = $(o).parent().prev().prev().prev().prev().prev().prev().prev().html();
				var tel = $(o).parent().prev().prev().prev().prev().prev().prev().html();
				var addr = $(o).parent().prev().prev().prev().prev().prev().html();
				var amt = $(o).parent().prev().prev().prev().prev().html();
				var diff = $(o).parent().prev().prev().prev().html();
				var states = $(o).parent().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().prev().html();
				
				$('input[name="userName"]').val(username);
				$('input[name="memL"]').val(level);
				$('input[name="contacts"]').val(name);
				$('input[name="tel"]').val(tel);
				$('input[name="address"]').val(addr);
				$('input[name="memAmt"]').val(amt);
				$('input[name="diff"]').val(diff);
				$('input[name="userid"]').val(id);
				$('input[name="diffNum"]').val(diff);
				$('select[name="memLevel"]').val(levelid);
				$('select[name="memStates"]').val(states);
				


				$('#myTab li').eq(1).find('a').click();
			}
			function check(){
			}
			
			function search() {
				var cityid = $('select[name="rule"]').val();
				var tel = $('input[name="seTel"]').val();
				var code = $('input[name="seSalesCode"]').val();
								
				post("<?php echo U('Admin/Member/index');?>", {cityid:cityid,tel:tel,seSalesCode:code});
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