/**
 * @fileOverview  vixzone
 * @templatePage：促销
 * @phpTemplate
 */

define(function(require, exports) {
    var $ = require('zepto');
    var iscroll = require('iscroll'); // 滚动
    var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';
    var $sls = {
        typeBuy: $('#cTypeBuy'),
        categoryList: $('#categoryList'),
        categoryTit: $('#categoryTit'),
        btnEnter: $('#cx_btn_enter'), // 关闭促销按钮
        fixed: $('#cx_fixed') // 促销弹层
    };

    // 促销
    $sls.btnEnter.on(eClick, function() {
        fnClosed();
        triggerClickMenu();
    });

    function triggerClickMenu() {
        $sls.categoryTit.find('span').show();
        $sls.typeBuy.parent('li').addClass('cur').siblings().removeClass('cur');
        $('#categoryList').removeClass('categoryListHide');
        $sls.categoryList.find('a[cat_id="45"], a[cat_id="65"]').trigger(eClick); // 触发优惠分类
    }

    function fnClosed() {
        $sls.fixed.hide();
        // $sls.fixed.animate({opacity: 0}, 400, function(){
        //  $(this).hide();
        // }); // 关闭促销
        $.ajax({
            url: '/home/promotion',
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
            }
        });
        return false;
    }

    setTimeout(function() {
        if ($sls.fixed.length) {
            fnClosed();
        }
    }, 15000);

    (function init() {
        if (document.getElementById('cx_scrollWrap')) {
            var myscroll = new iscroll('cx_scrollWrap', {
                hScroll: false,
                hScrollbar: false,
                vScrollbar: false,
                onScrollMove: function(e) {
                    e.preventDefault();
                }
            });
            $(window).on('resize', function() {
                var t = setTimeout(function() {
                    myscroll.refresh();
                    clearTimeout(t);
                    t = null;
                }, 0)
            });
        }
    })();
})
