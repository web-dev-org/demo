/**
 * @fileOverview  vixzone
 * @templatePage：购物车备注
 * @phpTemplate
 */

define(function(require, exports) {
	var $ = require('zepto');
	var showTip = require('./c_tips'); // 提示
	var $sls = {
		list: $('#cSCList'),// 购物车列表
		uid: $('#uid') // 用户id
	};

	var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';

	$sls.list.on(eClick, '.cBtnRemark', showRemark) // 显示备注
	$sls.list.on(eClick, '.cancel', hideRemark) // 取消备注
	$sls.list.on(eClick, '.confim', fnSendRemark) // 提交备注

	/**
	 * [findEles 当前li下元素集合]
	 * @param  {[Object]} $obj [zepto对象, $(this)]
	 * @return {[type]}      [description]
	 */
	function findEles($obj) {
		var $parent = $obj.parents('li');
		var $cRemarkBuy = $parent.find('.cRemarkBuy'); // 备注输入窗口
		var $textarea = $parent.find('textarea'); // 备注输入窗口
		var $remarkTxt = $parent.find('.cBtnRemark').siblings('span'); // 显示文字
		return {
			parent: $parent, // li
			remarkPop: $cRemarkBuy, // 备注框
			textarea: $textarea, // 备注内容
			remarkTxt: $remarkTxt
		}
	}

	/**
	 * [hideRemark 隐藏备注框]
	 * @return {[type]} [description]
	 */
	function hideRemark() {
		var $this = $(this);
		var $eles = findEles($this);
		$eles.remarkPop.hide();
	}

	/**
	 * [showRemark 显示备注框]
	 * @return {[type]} [description]
	 */
	function showRemark() {
		var $this = $(this);
		var $eles = findEles($this);
		$eles.remarkPop.show();
	}

	/**
	 * [fnSendRemark 向后台发送备注]
	 * @return {[type]} [description]
	 */
	function fnSendRemark() {
		var $this = $(this);
		var $eles= findEles($this); // 获取备注输入框 

		if(!checkRemark($eles.textarea)) { // 如果没有填写备注返回
			return false;
		}
		/**
		 * arg1 : uri,
		 * arg2 : callback,
		 * arg3 : options { type, dataType, data}
		 */
		
		myAjax('index.php?g=App&m=Cart&a=setRemark', function(data) {
			if(data.result == 'succ') {
				showTip('提交成功:)')
				$eles.remarkPop.hide(); // 隐藏输入框
				$eles.remarkTxt.html($eles.remarkTxt.attr('succ')) // 修改文字
			} else {
				$eles.remarkTxt.html($eles.remarkTxt.attr('def')) // 修改文字
				showTip(data.reason) // 错误原因
			}
		}, {
			data: getData($this)
		});
	}


	/**
	 * [getData 提交备注所需参数]
	 * @param  {[Object]} $obj [zepto对象， $(this)]
	 * @return {Object}      [参数集合]
	 */
	function getData($obj) {
		var $eles = findEles($obj);
		var $parent = $eles.parent;
		return {
			id: $parent.attr('cart_id'), // 购物车id
			uid: $sls.uid.val(), // 用户id
			remark: $eles.textarea.val(), // 用户备注
			sku_id: $parent.attr('sku_id') // 单品id
		};
	}

	/**
	 * [checkRemark 检测备注是否为空]
	 * @param  {[Object]} $obj [zepto对象， $(textarea)]
	 * @return {[Boolean]}      [输入是否符合条件]
	 */
	function checkRemark($obj) {
		var flag = false;

		if($obj.length == 0) {
			return false;
		}

		if($.trim($obj.val()) == '') {
			showTip('请填写备注:)')
		} else {
			flag = true;
		}

		return flag;
	}

	/**
	 * [ajax 异步请求]
	 * @param  {[String]}   url      [请求地址]
	 * @param  {Function} callback [成功后回调函数]
	 * @param  {[Object]}   options  [设置默认参数]
	 * @return {[Object]}            [ln_tools]
	 */
	function myAjax(url, callback, options) {
		options = options || {};
		type = options.type || 'POST';
		dataType = options.dataType || 'json';
		data = options.data || {};
		$.ajax({
			url: url,
			type: type,
			dataType: dataType,
			data: data,
			success: function(data) {
				callback && callback(data);
			}
		})
		return this;
	}
})