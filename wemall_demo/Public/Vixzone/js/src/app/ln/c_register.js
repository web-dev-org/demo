/**
 * @fileOverview   vixzone
 * @templatePage：注册
 * @phpTemplate
 */

define(function(require, exports) {
	var $ = require('zepto');
	var showTip = require('./c_tips'); // 提示弹窗
	require('./c_loading'); // 加载提示

	/**
	 * [$sls 页面元素集合]
	 * @type {Object}
	 */
	var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';
	var $sls = {
		phone: $('#cPhone'), // 电话
		oneClick: true, // 防止多次点击
		btnReg: $('#cBtnReg'), // 注册按钮 
		code: $('#cCode'), // 注册按钮 
		authcode: $('#authcode'), // 注册按钮 
		name: $('#cName'), // 店名 
		user: $('#cUser'), // 联系人 
		tel: $('#cTel'), // 电话 
		address: $('#cAddress'), // 地址 
		salescode:$('#cSalesCode'), // 销售邀请码 
		city: $('#cCity'), // 城市 
		area: $('#cArea'), // 地区
	};

	/**
	 * [checkPhone 店名]
	 * @return {[type]} [boolean]
	 */

	function checkName() {
		var flag = false;

		if (!$sls.name.get(0)) {
			return false;
		}

		if ($sls.name.val() == '') {
			showTip('您还未填写：店名')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [checkPhone 联系人]
	 * @return {[type]} [boolean]
	 */

	function checkUser() {
		var flag = false;

		if (!$sls.user.get(0)) {
			return false;
		}

		if ($sls.user.val() == '') {
			showTip('您还未填写：联系人')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [checkPhone 地址]
	 * @return {[type]} [boolean]
	 */

	function checkAddress() {
		var flag = false;

		if (!$sls.address.get(0)) {
			return false;
		}

		if ($sls.address.val() == '') {
			showTip('您还未填写：地址')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [checkCity 城市]
	 * @return {[type]} [boolean]
	 */

	function checkCity() {
		var flag = false;

		if (!$sls.city.get(0)) {
			return false;
		}

		if ($sls.city.val() == '0') {
			showTip('您还未选择：城市')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [checkArea 区域]
	 * @return {[type]} [boolean]
	 */

	function checkArea() {
		var flag = false;

		if (!$sls.area.get(0)) {
			return false;
		}

		if ($sls.area.val() == '0') {
			showTip('您还未选择：区域')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [checkUsername 用户名]
	 * @return {[type]} [boolean]
	 */

	function checkSalescode() {
		var flag = false;

		if (!$sls.salescode.get(0)) {
			return false;
		}

		if ($sls.salescode.val() == '') {
			showTip('您还未填写：邀请码')
		} else {
			flag = true;
		}

		return flag;
	}
	
	/**
	 * [checkPhone 检测手机号码]
	 * @return {[type]} [boolean]
	 */

	function checkPhone() {
		var flag = false;

		if (!$sls.phone.get(0)) {
			return false;
		}

		if ($sls.phone.val() == '') {
			showTip('您还未填写：手机号')
		} else {
			var phrel = /^0?(1)[0-9]{10}$/;
			if (!phrel.test($sls.phone.val())) {
				showTip('请输入正确手机号')
			} else {
				flag = true;
			}
		}

		return flag;
	}

	/**
	 * [checkPhone 检测手机号码]
	 * @return {[type]} [boolean]
	 */

	function checkCode() {
		var flag = false;

		if (!$sls.code.get(0)) {
			return false;
		}

		if ($sls.code.val() == '') {
			showTip('您还未填写：验证码')
		} else {
			flag = true;
		}

		return flag;
	}


	/**
	 * [验证码]
	 * @return {[type]}
	 */
	var defSrc = $sls.authcode.attr('def-src');
	$sls.authcode.on(eClick, function() {
		var $this = $(this);
		$this.attr('src', defSrc + '?' + codeRandom());
	})


	/**
	 * [codeRandom 随机数]
	 * @return {[number]}
	 */

	function codeRandom() {
		var t = 'i' + Math.random();
		t = t.replace(/\./g, function(s) {
			return '';
		});
		return t;
	}

	/**
	 * [点击注册按钮]
	 * @return {[type]} [true 注册成功，false 失败]
	 */
	$sls.btnReg.on(eClick, function() {

		var $this = $(this);
		if ($sls.oneClick == false) {
			return false;
		}
		if (checkName() && checkUser() && checkAddress() && checkPhone() && checkCode() && checkCity() && checkArea() && checkSalescode()) {
			$this.attr('disabled', 'disabled')
			$sls.oneClick = false;

			$.ajax({
				url: 'index.php?g=App&m=Index&a=register',
				type: 'POST',
				dataType: 'json',
				data: {
					contact_name: $sls.user.val(), // 联系人
					authcode: $sls.code.val(), // 验证码
					contact_mobile: $sls.phone.val(), // 手机号
					company_name: $sls.name.val(), // 店名
					company_address: $sls.address.val(), // 地址
					sales_code: $sls.salescode.val(), // 销售邀请码
					city_id : $sls.city.val(), // 城市
					area_id : $sls.area.val() // 区域
				},
				success: function(data) {
					if (data.result == 'succ') { // 成功
						showTip('注册成功，客服会尽快联系您，并为您开通账户:)');
						var t = setTimeout(function(){
							window.location.href = data.url;
							clearTimeout(t);
							t = null;
						}, 2000)
					} else {
						showTip(data.reason);
						$sls.oneClick = true;
						$this.removeAttr('disabled')
						$sls.authcode.trigger(eClick);
					}
				}
			})
		}
		return false;
	});
	
	
	$sls.city.change(function(){
		var index = document.getElementById('cCity').selectedIndex;
		var cityText = document.getElementById('cCity').getElementsByTagName('option')[index].innerHTML;
		var cityid = $sls.city.val();
		
		if ( cityid == "0" ) {
			document.getElementById('sCity').style.color = "#A9A9A9";
		} else {
			document.getElementById('sCity').style.color = "#000000";
		}
		
		$.ajax({
			url: 'index.php?g=App&m=Index&a=getChildCity',
			type: 'POST',
			dataType: 'json',
			data: {
				cityId: cityid // 城市id
			},
			success: function(data) {
				if (data.result == 'succ') { // 成功
					if (data.info == null) {            	
						showTip("该城市没有添加区域，请继续添加详细地址！");
						return false;
		            }
					document.getElementById('sCity').innerText = cityText;
					document.getElementById('sArea').innerText = "";
					$sls.area.empty();
					$sls.area.prepend("<option value='0'>选择区域</option>");
					for ( i=0; i< data.info.length; i++) {
						$sls.area.append("<option value='" + data.info[i].id + "'>" + data.info[i].name + "</option>");
					}
				} else {
					showTip(data.reason);
				}
			}
		})
		return false;
	});
	
	$sls.area.change(function(){
		var index = document.getElementById('cArea').selectedIndex;
		var cityText = document.getElementById('cArea').getElementsByTagName('option')[index].innerHTML;
		var areaid = $sls.area.val();
		
		if ( areaid == "0" ) {
			document.getElementById('sArea').style.color = "#A9A9A9";
		} else {
			document.getElementById('sArea').style.color = "#000000";
		}
		
		document.getElementById('sArea').innerText = cityText;
	});
	
});