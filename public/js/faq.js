! function(e) {
    var t = {};

    function r(o) {
        if (t[o]) return t[o].exports;
        var n = t[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return e[o].call(n.exports, n, n.exports, r), n.l = !0, n.exports
    }
    r.m = e, r.c = t, r.d = function(e, t, o) {
        r.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: o
        })
    }, r.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, r.t = function(e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var o = Object.create(null);
        if (r.r(o), Object.defineProperty(o, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var n in e) r.d(o, n, function(t) {
                return e[t]
            }.bind(null, n));
        return o
    }, r.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return r.d(t, "a", t), t
    }, r.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, r.p = "/", r(r.s = 16)
}({
    16: function(e, t, r) {
        e.exports = r("y64Q")
    },
    y64Q: function(e, t) {
        $.on("/faq", function() {

            $("#accordion").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion2").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion3").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion4").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion5").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion6").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion7").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion8").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion9").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

            $("#accordion10").accordion({
                heightStyle: "content",
                collapsible: !0,
                animate: 250,
                active: !1,
                beforeActivate: function(e, t) {
                    t.newHeader.animate({
                        "border-bottom-width": 0,
                        "border-bottom-right-radius": 0,
                        "border-bottom-left-radius": 0
                    }, 0), t.newHeader.addClass("active")
                },
                activate: function(e, t) {
                    t.oldHeader.animate({
                        "border-bottom-width": 1,
                        "border-bottom-right-radius": 4,
                        "border-bottom-left-radius": 4
                    }, 0), t.oldHeader.removeClass("active")
                }
            })

        })
    }
});
