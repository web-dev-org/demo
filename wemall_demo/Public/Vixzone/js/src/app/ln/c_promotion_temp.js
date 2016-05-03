/**
 * @fileOverview  vixzone
 * @templatePage：优惠
 * @phpTemplate
 */
define(function(require, exports, module) {
    var $ = require('zepto'),
        cookie = require('cookie'),
        iscroll = require('iscroll'), // 滚动
        isMobile = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1,
        eClick = isMobile ? 'touchstart' : 'click';
    /*****************************
    优惠活动
    *****************************/
    // index
    var IndexShowPromation = {
        indexBtn: $('#cIndexPromation'),
        cxFixed: $('#cx_fixed'),
        showFixed: function() {
            if (this.cxFixed.length == 0) {
                return false;
            }
            this.cxFixed.show();
        },
        hideFixed: function() {
            if (this.cxFixed.length == 0) {
                return false;
            }
            this.cxFixed.hide();
        },
        fnmyScroll: function() {
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
        },
        init: function() {
            var that = this;
            if (this.indexBtn.length > 0) {
                this.indexBtn.on(eClick, function() {
                    that.showFixed();
                    that.fnmyScroll();
                    return false;
                })
            }

            that.cxFixed.on('longTap doubleTap', function() {
                that.hideFixed();
                return false;
            })
        }
    };
    IndexShowPromation.init();

    // one key buy
    var OneKeyBuyShowPromation = {
        btnPromation: $('#cTempPromation'),
        clearCookie: function() {
            cookie.remove('cx12', {
                path: '/',
                expires: -1,
                domain: window.location.hostname
            });
            this.turnIndex();
        },
        isAndroid: function() {
            if (window.location.href.indexOf('/app/') != -1 && window.android) {
                return true;
            } else {
                return false;
            }
        },
        turnIndex: function() {
            if (this.isAndroid()) { // is android
                window.android.android_home();
                window.android.android_reload();
            } else {
                window.location.href = '/home/index';
            }
        },
        init: function() {
            var that = this;
            if (that.btnPromation.length > 0) {
                that.btnPromation.on(eClick, function() {
                    that.clearCookie();
                })
            }
        }
    };
    OneKeyBuyShowPromation.init();

})
