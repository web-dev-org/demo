/**
 * @fileOverview  vixzone
 * @templatePage：弹窗提示
 * @phpTemplate
 */
define(function(require, exports, module) {
    var $ = require('zepto');
    /**
     * [showTip 提示弹窗]
     * @param  {[String]} txt [弹窗里面的文字]
     * @return {[type]}     [description]
     */

    function showTip(txt, time) {
        time = time || 1000;
        var message = $('<p style="background: rgba(0,0,0,0.5); position: fixed; z-index: 9999999; width: 75%; left: 50%; top: 50%; text-align: center;border-radius: 10px;padding: 10px; color: #fff" id="tips">' + txt + '</p>');

        $('body').append(message);

        message.css({
            'margin-left': -message.width() / 2,
            'margin-top': -message.height() / 2
        });

        window.setTimeout(function() {
            message.remove();
        }, time);
    }
    module.exports = showTip;
})
