/**
 * @fileOverview  Vixzone
 * @date 2015-07-15
 * @templatePage：首页
 * @phpTemplate
 */

define(function(require, exports) {
	var $ = require('zepto');
	var showTip = require('./c_tips'); // 提示弹窗
	require('./c_loading'); // 加载提示
    
    var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';

    var $sls = {
            cQucickBuy: $('#cQquickBuy'), // 快速购买
            cFlg: $('#cFlg') // 快速购买flg
        };
    
    // app 右上角的清空事件
    window.android_onclick = fnClearAll;
        
    
    $('#cQquickBuy').click(function(){
    	alert("11111");
    	var flg = $sls.cFlg.val();
    	if ( flg == "1" ) {
            window.location.href = '{:U("App/Cart/quickBuyCart")}';
    	} else {
			showTip("暂无推荐商品.");
    	}
		
	})
   
    
})