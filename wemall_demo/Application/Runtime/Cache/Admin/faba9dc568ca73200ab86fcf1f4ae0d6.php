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
<div class="navbar navbar-default" id="navbar">
	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="#" class="navbar-brand">
				<small>
					旅行社管理系统 V1.0
				</small>
			</a><!-- /.brand -->
		</div><!-- /.navbar-header -->

		<div class="navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<li class="light-blue">
					<div class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>preview</title>
<link rel="stylesheet" href="__PUBLIC__/Plugin/preview/app.css">
</head>
<body>
	<div class="phone-content">
		<div class="phone">
			<iframe src="<?php echo U('App/Index/index',array('uid'=>1));?>" frameborder="0"
				scrolling="yes"></iframe>
		</div>
	</div>
</body>
</html>
					</div>
				</li>
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<span class="user-info">
							<?php echo ($username); ?>
						</span>

						<i class="icon-caret-down"></i>
					</a>

					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo U('Admin/Login/logout');?>">
								<i class="icon-off"></i>
								注销
							</a>
						</li>
					</ul>
				</li>
			</ul><!-- /.ace-nav -->
		</div><!-- /.navbar-header -->
	</div><!-- /.container -->
</div>
<div class="main-container" id="main-container">
	<div class="main-container-inner">
		<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<ul class="nav nav-list">
		<li class="active">
			<a href="">
				<i class="icon-home"></i>
				<span class="menu-text"> 系统首页 </span>
			</a>
		</li>

		<li  onclick="clickset('order')">
			<a href="javascript:void(0)">
				<i class="icon-list"></i>
				<span class="menu-text"> 行程管理 </span>
			</a>
		</li>

		<?php if($city == '1'): ?><li  onclick="clickset('city')">
				<a href="javascript:void(0)">
					<i class="icon-picture"></i>
					<span class="menu-text"> 地域管理 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($order == '1'): ?><li onclick="clickset('menu')">
				<a href="javascript:void(0)">
					<i class="icon-calendar"></i>
					<span class="menu-text"> 酒店管理 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($cityPercent == '1'): ?><li  onclick="clickset('citypercent')">
				<a href="javascript:void(0)">
					<i class="icon-facetime-video"></i>
					<span class="menu-text"> 控房管理 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($salesCode == '1'): ?><li onclick="clickset('salesCode')">
				<a href="javascript:void(0)">
					<i class="icon-pushpin"></i>
					<span class="menu-text"> 酒店预订 </span>
				</a>
			</li><?php endif; ?>
		<?php if($product == '1'): ?><li onclick="clickset('product')">
				<a href="javascript:void(0)">
					<i class="icon-gift"></i>
					<span class="menu-text"> Bus管理 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($active == '1'): ?><li onclick="clickset('active')">
				<a href="javascript:void(0)">
					<i class="icon-info-sign"></i>
					<span class="menu-text"> Bus预定 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($price == '1'): ?><li onclick="clickset('price')">
				<a href="javascript:void(0)">
					<i class="icon-adjust"></i>
					<span class="menu-text"> 景点管理 </span>
				</a>
			</li><?php endif; ?>
		
		<?php if($count == '1'): ?><li onclick="clickset('count')">
				<a href="javascript:void(0)">
					<i class="icon-cloud"></i>
					<span class="menu-text"> 旅行社管理 </span>
				</a>
			</li><?php endif; ?>

		<?php if($member == '1'): ?><li onclick="clickset('user')">
				<a href="javascript:void(0)">
					<i class="icon-group"></i>
					<span class="menu-text"> 账户管理 </span>
				</a>
			</li><?php endif; ?>
	</ul><!-- /.nav-list -->

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>
        <script type="text/javascript" language="javascript"> 
   		function iframeResize(iframe) {
	        iframe.height = $(window).height()-90;
	    }
		</script>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<ul class="breadcrumb">
					<li><i class="icon-home home-icon"></i> <a href="javascript:void(0);">系统主页</a></li>
					<li class="active">系统欢迎页</li>
				</ul>
			</div>
			<div id="content_main">
				<iframe src="<?php echo U('Admin/Index/wellcom');?>" id="main_iframe" name="main_iframe"
					style="width: 100%;" frameborder="0" onload="iframeResize(this);"  scrolling="yes"></iframe>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
		
		function clickset(name) {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			/* 商城设置 */
			if ( name == "set" ){
				$('#breadcrumbs ul li').eq(1).html('商城管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Store/index');?>");	
			}
			/* 分类管理 */
			if ( name == "menu" ){
				$('#breadcrumbs ul li').eq(1).html('酒店管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Menu/index');?>");	
			}
			/* 地域管理 */
			if ( name == "city" ){
				$('#breadcrumbs ul li').eq(1).html('地域管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/City/index');?>");	
			}
			/* 地域百分比管理 */
			if ( name == "citypercent" ){
				$('#breadcrumbs ul li').eq(1).html('控房管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Menu_percent/index');?>");
			}
			/* 商品管理 */
			if ( name == "product" ){
				$('#breadcrumbs ul li').eq(1).html('Bus管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Product/index');?>");
			}
			/* 价格管理 */
			if ( name == "price" ){
				$('#breadcrumbs ul li').eq(1).html('景点管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Price/index');?>");
			}
			/* 发布管理 */
			if ( name == "confirm" ){
				$('#breadcrumbs ul li').eq(1).html('发布管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Price/updatePrice');?>");
			}
			/* 订单管理 */
			if ( name == "order" ){
				$('#breadcrumbs ul li').eq(1).html('行程管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Order/index');?>");
			}
			/* 活动管理 */
			if ( name == "active" ){
				$('#breadcrumbs ul li').eq(1).html('Bus预定');
				$('#main_iframe').attr("src","<?php echo U('Admin/Active/index');?>");
			}
			/* 用户管理 */
			if ( name == "mem" ){
				$('#breadcrumbs ul li').eq(1).html('用户管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Member/index');?>");
			}
			/* 微信管理 */
			if ( name == "weixin" ){
				$('#breadcrumbs ul li').eq(1).html('微信管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Weixin/index');?>");
			}
			/* 账户管理 */
			if ( name == "user" ){
				$('#breadcrumbs ul li').eq(1).html('账户管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/BackUser/index');?>");
			}
			/* 账户管理 */
			if ( name == "salesCode" ){
				$('#breadcrumbs ul li').eq(1).html('酒店预订');
				$('#main_iframe').attr("src","<?php echo U('Admin/SalesCode/index');?>");
			}
			/* 数据统计 */
			if ( name == "count" ){
				$('#breadcrumbs ul li').eq(1).html('旅行社管理');
				$('#main_iframe').attr("src","<?php echo U('Admin/Count/index');?>");
			}
			/* 业务统计 */
			if ( name == "countSales" ){
				$('#breadcrumbs ul li').eq(1).html('业务统计');
				$('#main_iframe').attr("src","<?php echo U('Admin/Count/countSaleCode');?>");
			}
		}
		</script>
</body>
</html>