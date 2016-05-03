/**
 * @fileOverview  Vixzone
 * @templatePage：登录页
 * @phpTemplate
 */

define(function(require, exports) {
    var $ = require('zepto');
    require('./c_promotion.js'); // 促销
    // require('./c_tuijian.js'); // 推荐
    require('./c_loading'); // 加载提示
    var cookie = require('cookie'); // cookie
    var showTip = require('./c_tips'); // 提示弹窗

    /**
     * [$sls 页面元素集合]
     * @type {Object}
     */
    var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';
    var $sls = {
        user: $('#cUser'), // 用户名
        pass: $('#cPass'), // 用户名
        login: $('#cBtnLogin'), // 用户名
        isRemember: $('#isRemember'), // 是否记住密码
        loginOneClick: true // 防止连续点击
    };

    /**
     * [checkPhone 检测用户名]
     * @return {[type]} [boolean]
     */

    function checkUser() {
        var flag = false;
        if (!$sls.user.get(0)) {
            return false;
        }
        if ($sls.user.val() == '') {
            showTip('您还未填写：用户名')
        } else {
            flag = true;
        }
        return flag;
    }

    /**
     * [checkPassWord 检测密码框]
     * @return {[type]} [boolean]
     */

    function checkPassWord() {
        var flag = false;
        if (!$sls.pass.get(0)) {
            return false;
        }
        if ($sls.pass.val() == '') {
            showTip('您还未填写：密码');
        } else {
            flag = true;
        }
        return flag;
    }

    /**
     * [点击登录按钮]
     * @return {[type]} [true 跳转地址，false失败]
     */
    $sls.loginOneClick = true;
    $sls.login.on(eClick, function() {
        if ($sls.loginOneClick == false) {
            return false;
        }

        if (checkUser() && checkPassWord()) {
            $sls.loginOneClick = false;
            $.ajax({
                url: 'index.php?g=App&m=Index&a=login',
                type: 'POST',
                dataType: 'json',
                data: {
                    user_name: $sls.user.val(),
                    password: $sls.pass.val(),
                    is_remember: $sls.isRemember.prop('checked')
                },
                success: function(data) {
                    if (data.result == 'succ') {
                        var href = window.location.href;
                        if (/app/.test(href)) {
                            window.location.href = '/app' + data.url; // 跳转地址
                            return false;
                        }
                        window.location.href = data.url; // 跳转地址
                    } else {
                        showTip(data.reason);
                        $sls.loginOneClick = true;
                    }
                }
            })
        }
        return false;
    });


    // 清除常购cookie
    (function() {
        if (cookie.get('m2')) {
            cookie.remove('m2', {
                path: '/'
            });
        }
    })();
});
