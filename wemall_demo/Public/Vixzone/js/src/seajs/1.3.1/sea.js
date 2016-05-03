this.seajs = {
    _seajs: this.seajs
}, seajs.version = "%VERSION%", seajs._util = {}, seajs._config = {
    debug: "%DEBUG%",
    preload: []
},
function(e) {
    var t = Object.prototype.toString,
        n = Array.prototype;
    e.isString = function(e) {
        return t.call(e) === "[object String]"
    }, e.isFunction = function(e) {
        return t.call(e) === "[object Function]"
    }, e.isRegExp = function(e) {
        return t.call(e) === "[object RegExp]"
    }, e.isObject = function(e) {
        return e === Object(e)
    }, e.isArray = Array.isArray || function(e) {
        return t.call(e) === "[object Array]"
    }, e.indexOf = n.indexOf ? function(e, t) {
        return e.indexOf(t)
    } : function(e, t) {
        for (var n = 0; n < e.length; n++)
            if (e[n] === t)
                return n;
        return -1
    };
    var r = e.forEach = n.forEach ? function(e, t) {
        e.forEach(t)
    } : function(e, t) {
        for (var n = 0; n < e.length; n++)
            t(e[n], n, e)
    };
    e.map = n.map ? function(e, t) {
        return e.map(t)
    } : function(e, t) {
        var n = [];
        return r(e, function(e, r, i) {
            n.push(t(e, r, i))
        }), n
    }, e.filter = n.filter ? function(e, t) {
        return e.filter(t)
    } : function(e, t) {
        var n = [];
        return r(e, function(e, r, i) {
            t(e, r, i) && n.push(e)
        }), n
    };
    var i = e.keys = Object.keys || function(e) {
        var t = [];
        for (var n in e)
            e.hasOwnProperty(n) && t.push(n);
        return t
    };
    e.unique = function(e) {
        var t = {};
        return r(e, function(e) {
            t[e] = 1
        }), i(t)
    }, e.now = Date.now || function() {
        return (new Date).getTime()
    }
}(seajs._util),
function(e) {
    e.log = function() {
        if (typeof console == "undefined")
            return;
        var e = Array.prototype.slice.call(arguments),
            t = "log",
            n = e[e.length - 1];
        console[n] && (t = e.pop());
        if (t === "log" && !seajs.debug)
            return;
        if (console[t].apply) {
            console[t].apply(console, e);
            return
        }
        var r = e.length;
        r === 1 ? console[t](e[0]) : r === 2 ? console[t](e[0], e[1]) : r === 3 ? console[t](e[0], e[1], e[2]) : console[t](e.join(" "))
    }
}(seajs._util),
function(e, t, n) {
    function u(e) {
        var t = e.match(r);
        return (t ? t[0] : ".") + "/"
    }

    function a(e) {
        i.lastIndex = 0, i.test(e) && (e = e.replace(i, "$1/"));
        if (e.indexOf(".") === -1)
            return e;
        var t = e.split("/"),
            n = [],
            r;
        for (var s = 0; s < t.length; s++) {
            r = t[s];
            if (r === "..") {
                if (n.length === 0)
                    throw new Error("The path is invalid: " + e);
                n.pop()
            } else
                r !== "." && n.push(r)
        }
        return n.join("/")
    }

    function f(e) {
        e = a(e);
        var t = e.charAt(e.length - 1);
        return t === "/" ? e : (t === "#" ? e = e.slice(0, -1) : e.indexOf("?") === -1 && !s.test(e) && (e += ".js"), e.indexOf(":80/") > 0 && (e = e.replace(":80/", "/")), e)
    }

    function l(e) {
        if (e.charAt(0) === "#")
            return e.substring(1);
        var n = t.alias;
        if (n && y(e)) {
            var r = e.split("/"),
                i = r[0];
            n.hasOwnProperty(i) && (r[0] = n[i], e = r.join("/"))
        }
        return e
    }

    function h(n) {
        var r = t.map || [];
        if (!r.length)
            return n;
        var i = n;
        for (var s = 0; s < r.length; s++) {
            var o = r[s];
            if (e.isArray(o) && o.length === 2) {
                var f = o[0];
                if (e.isString(f) && i.indexOf(f) > -1 || e.isRegExp(f) && f.test(i))
                    i = i.replace(f, o[1])
            } else
                e.isFunction(o) && (i = o(i))
        }
        return v(i) || (i = a(u(E) + i)), i !== n && (c[i] = n), i
    }

    function p(e) {
        return c[e] || e
    }

    function d(e, n) {
        if (!e)
            return "";
        e = l(e), n || (n = E);
        var r;
        return v(e) ? r = e : m(e) ? (e.indexOf("./") === 0 && (e = e.substring(2)), r = u(n) + e) : g(e) ? r = n.match(o)[1] + e : r = t.base + "/" + e, f(r)
    }

    function v(e) {
        return e.indexOf("://") > 0 || e.indexOf("//") === 0
    }

    function m(e) {
        return e.indexOf("./") === 0 || e.indexOf("../") === 0
    }

    function g(e) {
        return e.charAt(0) === "/" && e.charAt(1) !== "/"
    }

    function y(e) {
        var t = e.charAt(0);
        return e.indexOf("://") === -1 && t !== "." && t !== "/"
    }

    function b(e) {
        return e.charAt(0) !== "/" && (e = "/" + e), e
    }
    var r = /.*(?=\/.*$)/,
        i = /([^:\/])\/\/+/g,
        s = /\.(?:css|js)$/,
        o = /^(.*?\w)(?:\/|$)/,
        c = {},
        w = n.location,
        E = w.protocol + "//" + w.host + b(w.pathname);
    E.indexOf("\\") > 0 && (E = E.replace(/\\/g, "/")), e.dirname = u, e.realpath = a, e.normalize = f, e.parseAlias = l, e.parseMap = h, e.unParseMap = p, e.id2Uri = d, e.isAbsolute = v, e.isRoot = g, e.isTopLevel = y, e.pageUri = E
}(seajs._util, seajs._config, this),
function(e, t) {
    function f(e, t) {
        e.nodeName === "SCRIPT" ? l(e, t) : c(e, t)
    }

    function l(e, n) {
        e.onload = e.onerror = e.onreadystatechange = function() {
            o.test(e.readyState) && (e.onload = e.onerror = e.onreadystatechange = null, e.parentNode && !t.debug && r.removeChild(e), e = undefined, n())
        }
    }

    function c(t, n) {
        v || m ? (e.log("Start poll to fetch css"), setTimeout(function() {
            h(t, n)
        }, 1)) : t.onload = t.onerror = function() {
            t.onload = t.onerror = null, t = undefined, n()
        }
    }

    function h(e, t) {
        var n;
        if (v)
            e.sheet && (n = !0);
        else if (e.sheet)
            try {
                e.sheet.cssRules && (n = !0)
            } catch (r) {
                r.name === "NS_ERROR_DOM_SECURITY_ERR" && (n = !0)
            }
        setTimeout(function() {
            n ? t() : h(e, t)
        }, 1)
    }

    function p() {}
    var n = document,
        r = n.head || n.getElementsByTagName("head")[0] || n.documentElement,
        i = r.getElementsByTagName("base")[0],
        s = /\.css(?:\?|$)/i,
        o = /loaded|complete|undefined/,
        u, a;
    e.fetch = function(t, n, o) {
        var a = s.test(t),
            l = document.createElement(a ? "link" : "script");
        if (o) {
            var c = e.isFunction(o) ? o(t) : o;
            c && (l.charset = c)
        }
        f(l, n || p), a ? (l.rel = "stylesheet", l.href = t) : (l.async = "async", l.src = t), u = l, i ? r.insertBefore(l, i) : r.appendChild(l), u = null
    }, e.getCurrentScript = function() {
        if (u)
            return u;
        if (a && a.readyState === "interactive")
            return a;
        var e = r.getElementsByTagName("script");
        for (var t = 0; t < e.length; t++) {
            var n = e[t];
            if (n.readyState === "interactive")
                return a = n, n
        }
    }, e.getScriptAbsoluteSrc = function(e) {
        return e.hasAttribute ? e.src : e.getAttribute("src", 4)
    }, e.importStyle = function(e, t) {
        if (t && n.getElementById(t))
            return;
        var i = n.createElement("style");
        t && (i.id = t), r.appendChild(i), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(n.createTextNode(e))
    };
    var d = navigator.userAgent,
        v = Number(d.replace(/.*AppleWebKit\/(\d+)\..*/, "$1")) < 536,
        m = d.indexOf("Firefox") > 0 && !("onload" in document.createElement("link"))
}(seajs._util, seajs._config, this),
function(e) {
    function n(e) {
        return e.replace(/^\s*\/\*[\s\S]*?\*\/\s*$/mg, "").replace(/^\s*\/\/.*$/mg, "")
    }
    var t = /(?:^|[^.$])\brequire\s*\(\s*(["'])([^"'\s\)]+)\1\s*\)/g;
    e.parseDependencies = function(r) {
        var i = [],
            s;
        r = n(r), t.lastIndex = 0;
        while (s = t.exec(r))
            s[2] && i.push(s[2]);
        return e.unique(i)
    }
}(seajs._util),
function(e, t, n) {
    function u(e, t) {
        this.uri = e, this.status = t || 0
    }

    function d(e, n) {
        return t.isString(e) ? u._resolve(e, n) : t.map(e, function(e) {
            return d(e, n)
        })
    }

    function v(e, i) {
        var s = t.parseMap(e);
        if (f[s]) {
            i();
            return
        }
        if (a[s]) {
            l[s].push(i);
            return
        }
        a[s] = !0, l[s] = [i], u._fetch(s, function() {
            f[s] = !0;
            var n = r[e];
            n.status === o.FETCHING && (n.status = o.FETCHED), c && (u._save(e, c), c = null), h && n.status === o.FETCHED && (r[e] = h, h.realUri = e), h = null, a[s] && delete a[s];
            var i = l[s];
            i && (delete l[s], t.forEach(i, function(e) {
                e()
            }))
        }, n.charset)
    }

    function m(e, n) {
        var i = r[e] || (r[e] = new u(e));
        return i.status < o.SAVED && (i.id = n.id || e, i.dependencies = d(t.filter(n.dependencies || [], function(e) {
            return !!e
        }), e), i.factory = n.factory, i.status = o.SAVED), i
    }

    function g(e, t) {
        var n = e(t.require, t.exports, t);
        n !== undefined && (t.exports = n)
    }

    function y(e) {
        return !!i[e.realUri || e.uri]
    }

    function b(e) {
        var n = e.realUri || e.uri,
            r = i[n];
        r && (t.forEach(r, function(t) {
            g(t, e)
        }), delete i[n])
    }

    function w(e) {
        var n = e.uri;
        return t.filter(e.dependencies, function(e) {
            p = [n];
            var t = E(r[e]);
            return t && (p.push(n), S(p)), !t
        })
    }

    function E(e) {
        if (!e || e.status !== o.SAVED)
            return !1;
        p.push(e.uri);
        var t = e.dependencies;
        if (t.length) {
            if (x(t, p))
                return !0;
            for (var n = 0; n < t.length; n++)
                if (E(r[t[n]]))
                    return !0
        }
        return p.pop(), !1
    }

    function S(e, n) {
        t.log("Found circular dependencies:", e.join(" --> "), n)
    }

    function x(e, n) {
        var r = e.concat(n);
        return r.length > t.unique(r).length
    }

    function T(e) {
        var t = n.preload.slice();
        n.preload = [], t.length ? N._use(t, e) : e()
    }
    var r = {},
        i = {},
        s = [],
        o = {
            FETCHING: 1,
            FETCHED: 2,
            SAVED: 3,
            READY: 4,
            COMPILING: 5,
            COMPILED: 6
        };
    u.prototype._use = function(e, n) {
        t.isString(e) && (e = [e]);
        var i = d(e, this.uri);
        this._load(i, function() {
            T(function() {
                var e = t.map(i, function(e) {
                    return e ? r[e]._compile() : null
                });
                n && n.apply(null, e)
            })
        })
    }, u.prototype._load = function(e, n) {
        function l(e) {
            (e || {}).status < o.READY && (e.status = o.READY), --a === 0 && n()
        }
        var i = t.filter(e, function(e) {
                return e && (!r[e] || r[e].status < o.READY)
            }),
            s = i.length;
        if (s === 0) {
            n();
            return
        }
        var a = s;
        for (var f = 0; f < s; f++)
            (function(e) {
                function n() {
                    t = r[e];
                    if (t.status >= o.SAVED) {
                        var n = w(t);
                        n.length ? u.prototype._load(n, function() {
                            l(t)
                        }) : l(t)
                    } else
                        l()
                }
                var t = r[e] || (r[e] = new u(e, o.FETCHING));
                t.status >= o.FETCHED ? n() : v(e, n)
            })(i[f])
    }, u.prototype._compile = function() {
        function n(t) {
            var n = d(t, e.uri),
                i = r[n];
            return i ? i.status === o.COMPILING ? i.exports : (i.parent = e, i._compile()) : null
        }
        var e = this;
        if (e.status === o.COMPILED)
            return e.exports;
        if (e.status < o.SAVED && !y(e))
            return null;
        e.status = o.COMPILING, n.async = function(t, n) {
            e._use(t, n)
        }, n.resolve = function(t) {
            return d(t, e.uri)
        }, n.cache = r, e.require = n, e.exports = {};
        var i = e.factory;
        return t.isFunction(i) ? (s.push(e), g(i, e), s.pop()) : i !== undefined && (e.exports = i), e.status = o.COMPILED, b(e), e.exports
    }, u._define = function(e, n, i) {
        var s = arguments.length;
        s === 1 ? (i = e, e = undefined) : s === 2 && (i = n, n = undefined, t.isArray(e) && (n = e, e = undefined)), !t.isArray(n) && t.isFunction(i) && (n = t.parseDependencies(i.toString()));
        var a = {
                id: e,
                dependencies: n,
                factory: i
            },
            f;
        if (document.attachEvent) {
            var l = t.getCurrentScript();
            l && (f = t.unParseMap(t.getScriptAbsoluteSrc(l))), f || t.log("Failed to derive URI from interactive script for:", i.toString(), "warn")
        }
        var p = e ? d(e) : f;
        if (p) {
            if (p === f) {
                var v = r[f];
                v && v.realUri && v.status === o.SAVED && (r[f] = null)
            }
            var m = u._save(p, a);
            f ? (r[f] || {}).status === o.FETCHING && (r[f] = m, m.realUri = f) : h || (h = m)
        } else
            c = a
    }, u._getCompilingModule = function() {
        return s[s.length - 1]
    }, u._find = function(e) {
        var n = [];
        return t.forEach(t.keys(r), function(i) {
            if (t.isString(e) && i.indexOf(e) > -1 || t.isRegExp(e) && e.test(i)) {
                var s = r[i];
                s.exports && n.push(s.exports)
            }
        }), n
    }, u._modify = function(t, n) {
        var s = d(t),
            u = r[s];
        return u && u.status === o.COMPILED ? g(n, u) : (i[s] || (i[s] = []), i[s].push(n)), e
    }, u.STATUS = o, u._resolve = t.id2Uri, u._fetch = t.fetch, u._save = m;
    var a = {},
        f = {},
        l = {},
        c = null,
        h = null,
        p = [],
        N = new u(t.pageUri, o.COMPILED);
    e.use = function(t, n) {
        return T(function() {
            N._use(t, n)
        }), e
    }, e.define = u._define, e.cache = u.cache = r, e.find = u._find, e.modify = u._modify, u.fetchedList = f, e.pluginSDK = {
        Module: u,
        util: t,
        config: n
    }
}(seajs, seajs._util, seajs._config),
function(e, t, n) {
    function l() {
        e.debug = !!n.debug
    }

    function c(e) {
        if (e.indexOf("??") === -1)
            return e;
        var n = e.split("??"),
            r = n[0],
            i = t.filter(n[1].split(","), function(e) {
                return e.indexOf("sea.js") !== -1
            });
        return r + i[0]
    }

    function h(e, n, r) {
        e && e !== n && t.log("The alias config is conflicted:", "key =", '"' + r + '"', "previous =", '"' + e + '"', "current =", '"' + n + '"', "warn")
    }
    var r = "seajs-ts=",
        i = r + t.now(),
        s = document.getElementById("seajsnode");
    if (!s) {
        var o = document.getElementsByTagName("script");
        s = o[o.length - 1]
    }
    var u = s && t.getScriptAbsoluteSrc(s) || t.pageUri,
        a = t.dirname(c(u));
    t.loaderDir = a;
    var f = a.match(/^(.+\/)seajs\/[\.\d]+(?:-dev)?\/$/);
    f && (a = f[1]), n.base = a, n.main = s && s.getAttribute("data-main"), n.charset = "utf-8", e.config = function(s) {
        for (var o in s) {
            if (!s.hasOwnProperty(o))
                continue;
            var u = n[o],
                a = s[o];
            if (u && o === "alias") {
                for (var f in a)
                    if (a.hasOwnProperty(f)) {
                        var c = u[f],
                            p = a[f];
                        /^\d+\.\d+\.\d+$/.test(p) && (p = f + "/" + p + "/" + f), h(c, p, f), u[f] = p
                    }
            } else !u || o !== "map" && o !== "preload" ? n[o] = a : (t.isString(a) && (a = [a]), t.forEach(a, function(e) {
                e && u.push(e)
            }))
        }
        var d = n.base;
        return d && !t.isAbsolute(d) && (n.base = t.id2Uri((t.isRoot(d) ? "" : "./") + d + "/")), n.debug === 2 && (n.debug = 1, e.config({
            map: [
                [/^.*$/,
                    function(e) {
                        return e.indexOf(r) === -1 && (e += (e.indexOf("?") === -1 ? "?" : "&") + i), e
                    }
                ]
            ]
        })), l(), this
    }, l()
}(seajs, seajs._util, seajs._config),
function(e, t, n) {
    function r() {
        var e = [],
            r = n.location.search;
        return r = r.replace(/(seajs-\w+)(&|$)/g, "$1=1$2"), r += " " + document.cookie, r.replace(/seajs-(\w+)=[1-9]/g, function(t, n) {
            e.push(n)
        }), t.unique(e)
    }
    e.log = t.log, e.importStyle = t.importStyle, e.config({
        alias: {
            seajs: t.loaderDir
        }
    }), t.forEach(r(), function(t) {
        e.use("seajs/plugin-" + t), t === "debug" && (e._use = e.use, e._useArgs = [], e.use = function() {
            return e._useArgs.push(arguments), e
        })
    })
}(seajs, seajs._util, this),
function(e, t, n) {
    var r = e._seajs;
    if (r && !r.args) {
        n.seajs = e._seajs;
        return
    }
    n.define = e.define, t.main && e.use(t.main),
    function(t) {
        if (t) {
            var n = {
                0: "config",
                1: "use",
                2: "define"
            };
            for (var r = 0; r < t.length; r += 2)
                e[n[t[r]]].apply(e, t[r + 1])
        }
    }((r || 0).args), n.define.cmd = {}, delete e.define, delete e._util, delete e._config, delete e._seajs
}(seajs, seajs._config, this);

seajs.config({
    alias: {
        "zepto": "gallery/zepto/1.1.3/zepto",
        "mustache": "gallery/mustache/0.7.0/mustache",
        "jquery": "gallery/jquery/1.8.2/jquery",
        "$": "gallery/jquery/1.8.2/jquery",
        "cookie": "gallery/cookie/1.0.2/cookie",
        'validator': 'arale/validator/0.9.2/validator',
        'widget': 'arale/widget/1.0.3/widget',
        "css3-m": "mobile/utils/smallCss3/css3",
        /*webSQL相关*/
        "webSQL": "mobile/utils/webSQL/webSQL",
        /*touch*/
        "touch": "mobile/styles/touch/touch",
        /*weixinApi*/
        "weixinApi": "mobile/utils/weixinApi/2.8/weixinApi",
        

        /*显示更多*/
        "showMore-m":"mobile/styles/show_more/show_more",
        /*返回顶部*/
        "goTop-m": "mobile/styles/goTop/goTop",
        /*切签*/
        "goodTab-m": "mobile/styles/goodTab/goodTab",
        /*根据限高判断“显示更多”*/
        "showMoreByHeight": "mobile/styles/showMoreByHeight/showMoreByHeight",
        /*提示浮层*/
        "tips": "mobile/styles/tips/tips",
        /*输入辅助提示*/
        "suggest-m": "mobile/styles/suggest/suggest",
        /*滚动底层库*/
        "iscroll": "mobile/styles/iscroll/iscroll",
        /*滚动底层库5.1.3*/
        "iscroll5": "gallery/iscroll/5.1.3/iscroll",
        /*滚动底层库，推荐*/
        "slider": "mobile/styles/slider/slider",

        /*滑动*/
        "swiper": "mobile/styles/swiper/swiper",

        /*移动版图片放大*/
        "largeImgViewer": "mobile/styles/largeImgViewer/largeImgViewer.js",
        /*弹窗*/
        "dialog": "styles/component/dialog/dialog",
        /*下拉框*/
        "selectForm": "styles/selectForm/selectForm",
        /*字符串  md5 & sha1*/
        "crypto": "mobile/utils/crypto/crypto",
        /*H5压缩图片*/
        "compressImg": "mobile/utils/compressImg/compressImg",
        "megapix-image": "mobile/utils/compressImg/megapix-image.js",
        /*跨域post*/
        "crossDomainPost": "mobile/utils/crossDomainPost/crossDomainPost.js",
        /*表情*/
        "simpleFace": "mobile/styles/face/simpleFace.js",

        /*刮奖*/
        "scratchCard": "mobile/utils/paint/scratchCard",
        /*canvas动画*/
        "cellBrush": "mobile/utils/cellBrush/cellBrush",
        /*下拉刷新，上拉加载更多*/
        "pullToRefresh": "mobile/utils/pullToRefresh/pullToRefresh",
        /*展开更多，收起*/
        "showHide": "mobile/styles/showHide/showHide",
        
        'utilitiesBook': 'app/weixinV2.1/book/utilities.js',
        'globalBook': 'app/weixinV2.1/book/global.js',
        'languageBook': 'app/weixinV2.1/book/language.js',
        'validatorBook': 'app/weixinV2.1/book/validator.js',
        
        /*移动端验证*/
        "mValidate": "mobile/utils/mValidate/mValidate",
        /*房贷计算器*/
        "creditCalculator": "styles/component/calculator/src/creditCalculator",
        /*税费计算器*/
        "taxCalculator": "styles/component/calculator/src/taxCalculator",
        /*房贷税率*/
        "creditRate": "styles/component/calculator/src/creditRate"
    },
    map: [
        [/((\w\/)*\.(?:css|js))(?:.*)/i, '$1?v=1.3.7']
    ],
    debug: 0
});