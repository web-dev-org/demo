/**
 * @fileOverview  vixzone
 * @templatePage：首页
 * @phpTemplate
 */

define(function(require, exports) {
    var $ = require('zepto'),
        cookie = require('cookie'), // cookie
        showTip = require('./c_tips'); // 提示弹窗
    require('./c_picker'); // 模拟下拉picker
    require('./c_lazy'); // 延时加载
    require('./c_loading'); // 加载提示
    require('./c_goods_remark'); // 添加备注
    var MyMenu = require('./c_menu_right'); // 添加新品

    /**
     * [$sls description]
     * @type {Object}
     */
    var eClick = window.navigator.userAgent.toLowerCase().indexOf('mobile') != -1 ? 'tap' : 'click';
    var $sls = {
        cSCList: $('#cSCList'), // 列表
        addType: $('#cAddType'), // 增加品类按钮
        menu: $('#cFixedMenu'), // 我的菜单内容
        menuBox: $('#cFixedMenuBox'), // 我的菜单内容
        menuClosed: $('#cFixedClosed'), // 关闭我的菜单右侧
        del: $('.cDel'), // 删除购物车中的物品
        del1: $('.cDel1'), // 删除增加品类
        id: $('#id').val(), // 购物车id
        uid: $('#uid').val(), // 用户id
        states: $('#memberStates').val(), // 用户状态
        diffStates: $('#diffStates').val(), // 用户状态
        price: $('#cPriceTotal'), // 页面fixed内容区域总价
        clearAll: $('#clearAll'), // 清空购物车
        price1: $('#cPriceTotal1'), // 弹窗内总价
        btnConif: $('#cBtnConif'), // 页面fixed内容区确认下单
        cFixedPop: $('#cFixedPop'), // 订单弹窗
        cFixedClosed1: $('#cFixedClosed1'), // 关闭订单弹窗
        sendData: $('#cSendData'), // 配送日期
        sendTime: $('#cSendTime'), // 配送时间 
        btnOrder: $('#cBtnOrder'), // 确认下单
        cart_id: $('#cart_id'), // 购物车id
        cBtnMS: $('#cBtnMS'), // 商品描述提交按钮
        cMS: $('#cMS'), // 商品描述
        cPM: $('#cPM'), // 商品名
        cSL: $('#cSL'), // 商数量
        cGG: $('#cGG'), // 商品规格
        tips: $('#cTips'), // 低于100元加收30运费提示
        limit: $('#limit'), // 钱数限制
        cTotalS: $('#cTotalS') // 商品数量
    };


    // 增加新品
    MyMenu.btnMenu = '#cAddType';
    MyMenu.conMenu = $sls.menu;
    MyMenu.wrapper = $sls.menuBox;
    MyMenu.init();

    // app 右上角的清空事件
    window.android_onclick = fnClearAll;

    /**
     * [删除购物车中的物品]
     * @return {[type]} [null]
     */

    $sls.del.on(eClick, delGoods)
    $sls.del.siblings('.pic').on(eClick, delGoods)

    function delGoods() {
        var $this = $(this);
        var $parent = $this.parents('li');
        var sku_id = $parent.attr('sku_id');
        var id = $parent.attr('cart_id');
        delParent($this) // 删除选中物品
        $.ajax({
            url: 'index.php?g=App&m=Cart&a=delCart',
            type: 'POST',
            dataType: 'json',
            data: {
                uid: $sls.uid, // 商品名称
                sku_id: sku_id, //
                id: id //
            },
            success: function(data) {
                if (data.result == 'succ') {
                    $sls.cTotalS.html(data.info.num);
                    $sls.price.html('￥' + data.info.price);
                    $sls.price1.html('￥' + data.info.price);
                    if (data.info.price > $sls.limit.val()) {
                        $sls.tips.hide();
                    } else {
                        $sls.tips.show();
                    }
                    if (window.android) {
                        window.android.android_reload();
                    }
                    setTimeout(function() {
                        noGoodsTip($sls.cSCList);
                    }, 400)
                } else {
                    showTip(data.reason);
                }
            }
        })
    }

    /**
     * [删除意向商品]
     * @return {[type]} [null]
     */
    $sls.del1.on(eClick, delYXGoods)
    $sls.del1.siblings('.pic').on(eClick, delYXGoods)

    function delYXGoods() {
        var $this = $(this);
        var $parent = $this.parents('li');
        var sku_id = $parent.attr('sku_id');
        $.ajax({
            url: '/api/goods/delete_intention',
            type: 'POST',
            dataType: 'json',
            data: {
                uid: $sls.uid, // 商品名称
                sku_id: sku_id
            },
            success: function(data) {
                if (data.result == 'succ') {
                    delParent($this) // 删除选中物品
                } else {
                    showTip(data.reason);
                }
            }
        })
    }

    /**
     * [delParent 删除父元素]
     * @param  {[type]} $obj [zepto对象]
     * @return {[type]}      [传入的对象]
     */

    function delParent($obj) {
            if (!$obj) {
                return false;
            }
            $obj.parents('li').animate({
                opacity: 0,
                scaleX: 0,
                scaleY: 0
            }, function() {
                $(this).remove();
            });
            return $obj;
        }
        /**
         * [isLogin 根据uid来判断用户是否登录]
         * @return {Boolean} [是否登录]
         */
    function isLogin() {
            if ($.trim($sls.uid) == 0) {
                return false;
            } else {
                return true;
            }
        }
        /**
         * [hasLogin 用户已经登录]
         * @param  {[function]}  callBack [callback]
         * @return {Boolean}          [是否登录]
         */
    function hasLogin(callBack) {
        if (isLogin()) {
            callBack && callBack();
            return true;
        } else {
            return false;
        }
    }

    /**
     * [noLogin 用户未登录]
     * @param  {[function]} callBack [callback]
     * @return {[Boolean]}          [是否登录]
     */
    function noLogin(callBack) {
        if (!isLogin()) {
            callBack && callBack();
            return true;
        } else {
            return false;
        }
    }

    /**
     * [确认下单弹空]
     * @return {[type]}
     */
    $sls.btnConif.on(eClick, function() {
        /*if(!isLogin()) {
            noLogin(function(){
                var $href = window.location.href;
                showTip('您还未登录，请先登录或注册:)');
                var t = setTimeout(function(){
                    if(/app/.test($href)){
                        window.location.href = '/app/passport/login';
                    } else {
                        window.location.href = '/passport/login'
                    }
                    clearTimeout(t);
                }, 1000)
            })
            return false;
        }*/
        if ($sls.cSCList.find('.cDel').length == 0) { // 如果没有购买商品
            if ($sls.cSCList.find('.cDel1').length > 0) { // 如果有意向商品
                showTip('抱歉意向商品不能生成订单，我们会尽快处理:)');
            } else { // 没有意向商品
                showTip('您还没有选购商品:)');
            }
            return false;
        }
        $sls.cFixedPop.show();
    });


    /**
     * [关闭下单弹窗]
     * @return {[type]}
     */
    $sls.cFixedPop.on(eClick, function(e) {
        var $target = $(e.target);
        if ($target.hasClass('cRegConif') || $target.hasClass('cjs') || ($target.parents('.cjs').length > 0)) {} else {
            $sls.cFixedPop.hide();
        }
    })

    /**
     * [派送日期改变时调接口]
     * @return {[type]}
     */
    $sls.sendData.on('change', function() {
        var $this = $(this);
        $.ajax({
            url: '/api/order/pici_list',
            type: 'POST',
            dataType: 'json',
            data: {
                pici_date: $this.val() // 商品名称
            },
            success: function(data) {
                if (data.result == 'succ') {
                    $sls.sendTime.find('option').remove();
                    $.each(data.info, function(i, o) {
                        $sls.sendTime.append("<option value='" + o.pici_id + "'>" + o.name + "</option>");
                    })
                } else {
                    showTip(data.reason);
                }
            }
        })
    })

    /**
     * [下单]
     * @return {[type]}
     */
    $sls.btnOrder.on(eClick, function() {
        var $this = $(this);
        if ($this.prop('disabled')) {
            return false;
        }
        
        if ( $sls.states != "1" ){
        	showTip("您的帐户还没有开启，不能进行交易！", 2000);
        	return false;
        }
        
        if ( $sls.diffStates == "0" ){
        	showTip("往来结算差额超限，请联系客服人员进行处理！", 2000);
        	return false;
        }
        
        $this.attr('disabled', 'disabled');
        $this.val('订单处理中...');
        $.ajax({
            url: 'index.php?g=App&m=Cart&a=creatOrder',
            type: 'POST',
            dataType: 'json',
            data: {},
            success: function(data) {
                if (data.result == 'succ') {
                    if (window.android) {
                        window.android.android_reload();
                    }
                    var myurl = window.location.href;
                    
                    if (/app/.test(myurl)) {
                        lnreturnurl(lnurl + '/app' + data.url, '订单详情', '')
                        return false;
                    }
                    window.location.href = data.url; // 跳转
                } else {
                    $this.val('确定');
                    $this.removeAttr('disabled');
                    $this.val('确定');
                    $this.removeAttr('disabled');
                    showTip(data.reason, 3000);

                    // 如果未登录
                    if (isNaN($sls.uid * 1)) {
                        setTimeout(function() {
                            cookie.set('btn_order', '1', {
                                path: '/'
                            });
                            if (window.android) {
                                window.android.android_reload();
                                window.android.android_home(); // 跳转到首页
                                return false;
                            }
                            window.location.href = '/passport/login';
                        }, 1000);
                    }
                }

            }
        })
    })


    /**
     * [checkPM 检测商品名称]
     * @return {[boolean]}
     */

    function checkPM() {
        var flag = false;

        if (!$sls.cPM.get(0)) {
            return false;
        }

        if ($sls.cPM.val() == '') {
            animateinput($sls.cPM);
            showTip('请填写商品名称');
        } else {
            flag = true;
        }

        return flag;
    }

    /**
     * [checkPM 检测商品数量]
     * @return {[boolean]}
     */

    function checkSL() {
        var flag = false;

        if (!$sls.cSL.get(0)) {
            return false;
        }

        if ($sls.cSL.val() == '') {
            animateinput($sls.cSL);
            showTip('请填写商品数量');

        } else {
            if (isNaN($sls.cSL.val())) {
                animateinput($sls.cSL);
                showTip('请填写数字');
            } else {
                flag = true;
            }
        }

        return flag;
    }

    /**
     * [checkPM 检测商品规格]
     * @return {[boolean]}
     */

    function checkGG() {
        var flag = false;

        if (!$sls.cGG.get(0)) {
            return false;
        }

        if ($sls.cGG.val() == '') {
            animateinput($sls.cGG);
            showTip('请填写商品规格');
        } else {
            flag = true;
        }

        return flag;
    }

    /**
     * [checkMS 检测商品描述]
     * @return {[boolean]}
     */

    function checkMS() {
        var flag = false;

        if (!$sls.cMS.get(0)) {
            return false;
        }

        if ($sls.cMS.val() == '') {
            animateinput($sls.cMS);
            showTip('请填写商品描述');
        } else {
            flag = true;
        }



        return flag;
    }

    /**
     * [animateinput 错误动画提示]
     * @param  {[type]} $obj [zepto对象]
     * @return {[type]}      [description]
     */
    function animateinput($obj) {
        var defBg = $obj.css('background-color');
        $obj.animate({
            backgroundColor: '#f3706e'
        }, function() {
            var t = setTimeout(function() {
                $obj.animate({
                    backgroundColor: defBg
                });
                t = null;
            }, 500)
        })
    }

    /**
     * [新增商品]
     * @return {[type]}
     */
    $sls.cBtnMS.on(eClick, function() {
        if (checkPM() && checkGG() && checkSL()) {
            $.ajax({
                url: '/api/goods/add',
                type: 'POST',
                dataType: 'json',
                data: {
                    uid: $sls.uid, // 商品名称
                    goods_name: $sls.cPM.val(), // 新增名称
                    goods_num: $sls.cSL.val(), // 数量
                    goods_unit: $sls.cGG.val(), // 规格
                    desc: $sls.cMS.val() // 描述
                },
                success: function(data) {
                    if (data.result == 'succ') {
                        showTip('添加成功，我们会尽快与您取得联系:)');
                        var t = setTimeout(function() {
                            closedMenu();
                            window.location.reload();
                            t = null;
                        }, 2000)
                    } else {
                        showTip(data.reason);
                    }
                }
            })
        }
    })

    $sls.clearAll.on(eClick, fnClearAll);
    /**
     * [fnClearAll 清空购物车]
     * @return {[type]} [description]
     */

    var isClearCar = {
        eclick: eClick,
        confirmPop: $('#cFixedConfirm'),
        clearCar: $('#cClearCar'),
        isClear: false,
        showPop: function() {
            if (this.confirmPop.length) {
                this.confirmPop.show();
            }
        },
        hidePop: function() {
            if (this.confirmPop.length) {
                this.confirmPop.hide();
            }
        },
        init: function(callback) {
            var $this = this,
                eclick = $this.eclick;
            $this.showPop();
            $this.clearCar.on(eclick, '.cBtnRedMod', function() {
                $this.isClear = true;
                $this.hidePop();
                callback && callback($this.isClear);
                return false;
            });

            $this.clearCar.on(eclick, '.cBtnGrayMod', function() {
                $this.isClear = false;
                $this.hidePop();
                callback && callback($this.isClear);
                return false;
            });
        }
    };

    function fnClearAll() {
        if ($sls.cSCList.find('li').length == 0) {
            showTip('购物车为空:)');
            return false;
        }
        isClearCar.init(function(isClear) {
            if (isClear) { 
                $.ajax({
                    url: 'index.php?g=App&m=Cart&a=cleanCart',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        uid: $sls.uid
                    },
                    success: function(data) {
                        if (data.result == 'succ') {
                            $sls.price.html('￥0');
                            $sls.cSCList.html('');
                            if (window.android) {
                                window.android.android_reload();
                                // showTip(data.reason);
                            }
                            noGoodsTip($sls.cSCList);
                        } else {
                            showTip(data.reason);
                        }
                    }
                })
            }
        }); //
    }

    noGoodsTip($sls.cSCList);

    /**
     * [noGoodsTip 购物车为空提示]
     * @param  {[Object]} $list [zepto对象]
     * @return {[type]}       [description]
     */
    function noGoodsTip($list) {
        if ($list.find('li').length == 0) {
            showTextTips('空')
        } else {
            var $body = $('body');
            $body.removeClass('cGrayBg')
            $sls.cSCList.removeClass('cGrayBg')
            $('#showTextTips').remove();
        }
    }

    /**
     * [showTextTips 显示文字]
     * @param  {[String]} text [弹出字体]
     * @return {[type]}      [description]
     */
    function showTextTips(text) {
        var $div = $('<div id="showTextTips">' + text + '</div>');
        $div.css({
            'position': 'absolute',
            'left': '50%',
            'top': '50%',
            'font-style': 'bold',
            'font-size': '3em',
            'color': '#eee',
            'text-shadow': '-1px -1px 0 #deeeee, 1px 1px 0 #deeeee'
        })
        $div.animate({
            'translate': '-50%, -50%'
        });
        var $body = $('body');
        $body.addClass('cGrayBg')
        $body.append($div);
        $sls.cSCList.addClass('cGrayBg')
    }



    function sendReMark() {
        var $parent = $picker.temp.parents('li');
        $.ajax({
            url: 'index.php?g=App&m=Cart&a=setRemark',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $parent.attr('cart_id'),
                uid: $picker.uid,
                num: $picker.temp.val(),
                sku_id: $parent.attr('sku_id')
            },
            success: function(data) {
                if (data.result == 'succ') {} else {
                    showTip(data.reason);
                }
            }
        })
    }

})
