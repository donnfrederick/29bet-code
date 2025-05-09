function Winwheel(t, i) {
    for (var e in defaultOptions = {
            canvasId: "canvas",
            centerX: null,
            centerY: null,
            outerRadius: null,
            innerRadius: 0,
            numSegments: 1,
            drawMode: "code",
            rotationAngle: 0,
            textFontFamily: "Arial",
            textFontSize: 20,
            textFontWeight: "bold",
            textOrientation: "horizontal",
            textAlignment: "center",
            textDirection: "normal",
            textMargin: null,
            textFillStyle: "black",
            textStrokeStyle: null,
            textLineWidth: 1,
            fillStyle: "silver",
            strokeStyle: "black",
            lineWidth: 1,
            clearTheCanvas: !0,
            imageOverlay: !1,
            drawText: !0,
            pointerAngle: 0,
            wheelImage: null,
            imageDirection: "N",
            responsive: !1,
            scaleFactor: 1
        }, defaultOptions) this[e] = null != t && void 0 !== t[e] ? t[e] : defaultOptions[e];
    if (null != t)
        for (var n in t) void 0 === this[n] && (this[n] = t[n]);
    for (this.canvasId && (this.canvas = document.getElementById(this.canvasId)) ? (null == this.centerX && (this.centerX = this.canvas.width / 2), null == this.centerY && (this.centerY = this.canvas.height / 2), null == this.outerRadius && (this.outerRadius = this.canvas.width < this.canvas.height ? this.canvas.width / 2 - this.lineWidth : this.canvas.height / 2 - this.lineWidth), this.ctx = this.canvas.getContext("2d")) : this.ctx = this.canvas = null, this.segments = Array(null), e = 1; e <= this.numSegments; e++) this.segments[e] = null != t && t.segments && void 0 !== t.segments[e - 1] ? new Segment(t.segments[e - 1]) : new Segment;
    if (this.updateSegmentSizes(), null === this.textMargin && (this.textMargin = this.textFontSize / 1.7), this.animation = null != t && t.animation && void 0 !== t.animation ? new Animation(t.animation) : new Animation, null != t && t.pins && void 0 !== t.pins && (this.pins = new Pin(t.pins)), "image" == this.drawMode || "segmentImage" == this.drawMode ? (void 0 === t.fillStyle && (this.fillStyle = null), void 0 === t.strokeStyle && (this.strokeStyle = "red"), void 0 === t.drawText && (this.drawText = !1), void 0 === t.lineWidth && (this.lineWidth = 1), void 0 === i && (i = !1)) : void 0 === i && (i = !0), this.pointerGuide = null != t && t.pointerGuide && void 0 !== t.pointerGuide ? new PointerGuide(t.pointerGuide) : new PointerGuide, this.responsive && ((winwheelToDrawDuringAnimation = this)._originalCanvasWidth = this.canvas.width, this._originalCanvasHeight = this.canvas.height, this._responsiveScaleHeight = this.canvas.dataset.responsivescaleheight, this._responsiveMinWidth = this.canvas.dataset.responsiveminwidth, this._responsiveMinHeight = this.canvas.dataset.responsiveminheight, this._responsiveMargin = this.canvas.dataset.responsivemargin, window.addEventListener("load", winwheelResize), window.addEventListener("resize", winwheelResize)), 1 == i) this.draw(this.clearTheCanvas);
    else if ("segmentImage" == this.drawMode)
        for (winwheelToDrawDuringAnimation = this, winhweelAlreadyDrawn = !1, e = 1; e <= this.numSegments; e++) null !== this.segments[e].image && (this.segments[e].imgData = new Image, this.segments[e].imgData.onload = winwheelLoadedImage, this.segments[e].imgData.src = this.segments[e].image)
}

function Pin(t) {
    var i, e = {
        visible: !0,
        number: 36,
        outerRadius: 3,
        fillStyle: "grey",
        strokeStyle: "black",
        lineWidth: 1,
        margin: 3,
        responsive: !1
    };
    for (i in e) this[i] = null != t && void 0 !== t[i] ? t[i] : e[i];
    if (null != t)
        for (var n in t) void 0 === this[n] && (this[n] = t[n])
}

function Animation(t) {
    var i, e = {
        type: "spinOngoing",
        direction: "clockwise",
        propertyName: null,
        propertyValue: null,
        duration: 10,
        yoyo: !1,
        repeat: null,
        easing: null,
        stopAngle: null,
        spins: null,
        clearTheCanvas: null,
        callbackFinished: null,
        callbackBefore: null,
        callbackAfter: null,
        callbackSound: null,
        soundTrigger: "segment"
    };
    for (i in e) this[i] = null != t && void 0 !== t[i] ? t[i] : e[i];
    if (null != t)
        for (var n in t) void 0 === this[n] && (this[n] = t[n])
}

function Segment(t) {
    var i, e = {
        size: null,
        text: "",
        fillStyle: null,
        strokeStyle: null,
        lineWidth: null,
        textFontFamily: null,
        textFontSize: null,
        textFontWeight: null,
        textOrientation: null,
        textAlignment: null,
        textDirection: null,
        textMargin: null,
        textFillStyle: null,
        textStrokeStyle: null,
        textLineWidth: null,
        image: null,
        imageDirection: null,
        imgData: null
    };
    for (i in e) this[i] = null != t && void 0 !== t[i] ? t[i] : e[i];
    if (null != t)
        for (var n in t) void 0 === this[n] && (this[n] = t[n]);
    this.endAngle = this.startAngle = 0
}

function PointerGuide(t) {
    var i, e = {
        display: !1,
        strokeStyle: "red",
        lineWidth: 3
    };
    for (i in e) this[i] = null != t && void 0 !== t[i] ? t[i] : e[i]
}

function winwheelPercentToDegrees(t) {
    var i = 0;
    return 0 < t && t <= 100 && (i = t / 100 * 360), i
}

function winwheelAnimationLoop() {
    if (winwheelToDrawDuringAnimation) {
        0 != winwheelToDrawDuringAnimation.animation.clearTheCanvas && winwheelToDrawDuringAnimation.ctx.clearRect(0, 0, winwheelToDrawDuringAnimation.canvas.width, winwheelToDrawDuringAnimation.canvas.height);
        var a = winwheelToDrawDuringAnimation.animation.callbackBefore,
            c = winwheelToDrawDuringAnimation.animation.callbackAfter;
        null != a && ("function" == typeof a ? a() : eval(a)), winwheelToDrawDuringAnimation.draw(!1), null != c && ("function" == typeof c ? c() : eval(c)), winwheelToDrawDuringAnimation.animation.callbackSound && winwheelTriggerSound()
    }
}

function winwheelTriggerSound() {
    0 == winwheelToDrawDuringAnimation.hasOwnProperty("_lastSoundTriggerNumber") && (winwheelToDrawDuringAnimation._lastSoundTriggerNumber = 0);
    var a = winwheelToDrawDuringAnimation.animation.callbackSound,
        c = "pin" == winwheelToDrawDuringAnimation.animation.soundTrigger ? winwheelToDrawDuringAnimation.getCurrentPinNumber() : winwheelToDrawDuringAnimation.getIndicatedSegmentNumber();
    c != winwheelToDrawDuringAnimation._lastSoundTriggerNumber && ("function" == typeof a ? a() : eval(a), winwheelToDrawDuringAnimation._lastSoundTriggerNumber = c)
}
Winwheel.prototype.updateSegmentSizes = function() {
    if (this.segments) {
        for (var t = 0, i = 0, e = 1; e <= this.numSegments; e++) null !== this.segments[e].size && (t += this.segments[e].size, i++);
        for (e = 360 - t, (t = 0) < e && (t = e / (this.numSegments - i)), i = 0, e = 1; e <= this.numSegments; e++) this.segments[e].startAngle = i, i = this.segments[e].size ? i + this.segments[e].size : i + t, this.segments[e].endAngle = i
    }
}, Winwheel.prototype.clearCanvas = function() {
    this.ctx && this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)
}, Winwheel.prototype.draw = function(t) {
    this.ctx && (void 0 !== t ? 1 == t && this.clearCanvas() : this.clearCanvas(), "image" == this.drawMode ? (this.drawWheelImage(), 1 == this.drawText && this.drawSegmentText(), 1 == this.imageOverlay && this.drawSegments()) : "segmentImage" == this.drawMode ? (this.drawSegmentImages(), 1 == this.drawText && this.drawSegmentText(), 1 == this.imageOverlay && this.drawSegments()) : (this.drawSegments(), 1 == this.drawText && this.drawSegmentText()), void 0 !== this.pins && 1 == this.pins.visible && this.drawPins(), 1 == this.pointerGuide.display && this.drawPointerGuide())
}, Winwheel.prototype.drawPins = function() {
    if (this.pins && this.pins.number) {
        var t = this.centerX * this.scaleFactor,
            i = this.centerY * this.scaleFactor,
            e = this.outerRadius * this.scaleFactor,
            n = this.pins.outerRadius,
            s = this.pins.margin;
        this.pins.responsive && (n = this.pins.outerRadius * this.scaleFactor, s = this.pins.margin * this.scaleFactor);
        for (var a = 360 / this.pins.number, o = 1; o <= this.pins.number; o++) this.ctx.save(), this.ctx.strokeStyle = this.pins.strokeStyle, this.ctx.lineWidth = this.pins.lineWidth, this.ctx.fillStyle = this.pins.fillStyle, this.ctx.translate(t, i), this.ctx.rotate(this.degToRad(o * a + this.rotationAngle)), this.ctx.translate(-t, -i), this.ctx.beginPath(), this.ctx.arc(t, i - e + n + s, n, 0, 2 * Math.PI), this.pins.fillStyle && this.ctx.fill(), this.pins.strokeStyle && this.ctx.stroke(), this.ctx.restore()
    }
}, Winwheel.prototype.drawPointerGuide = function() {
    if (this.ctx) {
        var t = this.centerX * this.scaleFactor,
            i = this.centerY * this.scaleFactor,
            e = this.outerRadius * this.scaleFactor;
        this.ctx.save(), this.ctx.translate(t, i), this.ctx.rotate(this.degToRad(this.pointerAngle)), this.ctx.translate(-t, -i), this.ctx.strokeStyle = this.pointerGuide.strokeStyle, this.ctx.lineWidth = this.pointerGuide.lineWidth, this.ctx.beginPath(), this.ctx.moveTo(t, i), this.ctx.lineTo(t, -e / 4), this.ctx.stroke(), this.ctx.restore()
    }
}, Winwheel.prototype.drawWheelImage = function() {
    if (null != this.wheelImage) {
        var t = this.centerX * this.scaleFactor,
            i = this.centerY * this.scaleFactor,
            e = this.wheelImage.width * this.scaleFactor,
            n = this.wheelImage.height * this.scaleFactor,
            s = t - e / 2,
            a = i - n / 2;
        this.ctx.save(), this.ctx.translate(t, i), this.ctx.rotate(this.degToRad(this.rotationAngle)), this.ctx.translate(-t, -i), this.ctx.drawImage(this.wheelImage, s, a, e, n), this.ctx.restore()
    }
}, Winwheel.prototype.drawSegmentImages = function() {
    if (this.ctx) {
        var t = this.centerX * this.scaleFactor,
            i = this.centerY * this.scaleFactor;
        if (this.segments)
            for (var e = 1; e <= this.numSegments; e++) {
                var n = this.segments[e];
                if (n.imgData.height) {
                    var s = n.imgData.width * this.scaleFactor,
                        a = n.imgData.height * this.scaleFactor,
                        o = null !== n.imageDirection ? n.imageDirection : this.imageDirection;
                    if ("S" == o) {
                        o = t - s / 2;
                        var r = i,
                            l = n.startAngle + 180 + (n.endAngle - n.startAngle) / 2
                    } else l = "E" == o ? (o = t, r = i - a / 2, n.startAngle + 270 + (n.endAngle - n.startAngle) / 2) : "W" == o ? (o = t - s, r = i - a / 2, n.startAngle + 90 + (n.endAngle - n.startAngle) / 2) : (o = t - s / 2, r = i - a, n.startAngle + (n.endAngle - n.startAngle) / 2);
                    this.ctx.save(), this.ctx.translate(t, i), this.ctx.rotate(this.degToRad(this.rotationAngle + l)), this.ctx.translate(-t, -i), this.ctx.drawImage(n.imgData, o, r, s, a), this.ctx.restore()
                } else console.log("Segment " + e + " imgData is not loaded")
            }
    }
}, Winwheel.prototype.drawSegments = function() {
    if (this.ctx && this.segments)
        for (var t = this.centerX * this.scaleFactor, i = this.centerY * this.scaleFactor, e = this.innerRadius * this.scaleFactor, n = this.outerRadius * this.scaleFactor, s = 1; s <= this.numSegments; s++) {
            var a = this.segments[s],
                o = null !== a.fillStyle ? a.fillStyle : this.fillStyle;
            this.ctx.fillStyle = o;
            var r = null !== a.lineWidth ? a.lineWidth : this.lineWidth;
            this.ctx.lineWidth = r;
            var l = null !== a.strokeStyle ? a.strokeStyle : this.strokeStyle;
            if ((this.ctx.strokeStyle = l) || o) {
                if (this.ctx.beginPath(), this.innerRadius) {
                    var h = Math.cos(this.degToRad(a.startAngle + this.rotationAngle - 90)) * (e - r / 2);
                    r = Math.sin(this.degToRad(a.startAngle + this.rotationAngle - 90)) * (e - r / 2), this.ctx.moveTo(t + h, i + r)
                } else this.ctx.moveTo(t, i);
                this.ctx.arc(t, i, n, this.degToRad(a.startAngle + this.rotationAngle - 90), this.degToRad(a.endAngle + this.rotationAngle - 90), !1), this.innerRadius ? this.ctx.arc(t, i, e, this.degToRad(a.endAngle + this.rotationAngle - 90), this.degToRad(a.startAngle + this.rotationAngle - 90), !0) : this.ctx.lineTo(t, i), o && this.ctx.fill(), l && this.ctx.stroke()
            }
        }
}, Winwheel.prototype.drawSegmentText = function() {
    if (this.ctx)
        for (var t, i, e, n, s, a, o, r, l, h, g = this.centerX * this.scaleFactor, c = this.centerY * this.scaleFactor, m = this.outerRadius * this.scaleFactor, u = this.innerRadius * this.scaleFactor, d = 1; d <= this.numSegments; d++) {
            this.ctx.save();
            var w = this.segments[d];
            if (w.text) {
                t = null !== w.textFontFamily ? w.textFontFamily : this.textFontFamily, i = null !== w.textFontSize ? w.textFontSize : this.textFontSize, e = null !== w.textFontWeight ? w.textFontWeight : this.textFontWeight, n = null !== w.textOrientation ? w.textOrientation : this.textOrientation, s = null !== w.textAlignment ? w.textAlignment : this.textAlignment, a = null !== w.textDirection ? w.textDirection : this.textDirection, o = null !== w.textMargin ? w.textMargin : this.textMargin, r = null !== w.textFillStyle ? w.textFillStyle : this.textFillStyle, l = null !== w.textStrokeStyle ? w.textStrokeStyle : this.textStrokeStyle, h = null !== w.textLineWidth ? w.textLineWidth : this.textLineWidth, i *= this.scaleFactor, o *= this.scaleFactor;
                var x = "";
                for (null != e && (x += e + " "), null != i && (x += i + "px "), null != t && (x += t), this.ctx.font = x, this.ctx.fillStyle = "#FFFFFF", this.ctx.lineWidth = h, e = -(t = w.text.split("\n")).length / 2 * i + i / 2, "curved" != n || "inner" != s && "outer" != s || (e = 0), h = 0; h < t.length; h++) {
                    if ("reversed" == a) {
                        if ("horizontal" == n) this.ctx.textAlign = "inner" == s ? "right" : "outer" == s ? "left" : "center", this.ctx.textBaseline = "middle", x = this.degToRad(w.endAngle - (w.endAngle - w.startAngle) / 2 + this.rotationAngle - 90 - 180), this.ctx.save(), this.ctx.translate(g, c), this.ctx.rotate(x), this.ctx.translate(-g, -c), "inner" == s ? (r && this.ctx.fillText(t[h], g - u - o, c + e), l && this.ctx.strokeText(t[h], g - u - o, c + e)) : "outer" == s ? (r && this.ctx.fillText(t[h], g - m + o, c + e), l && this.ctx.strokeText(t[h], g - m + o, c + e)) : (r && this.ctx.fillText(t[h], g - u - (m - u) / 2 - o, c + e), l && this.ctx.strokeText(t[h], g - u - (m - u) / 2 - o, c + e)), this.ctx.restore();
                        else if ("vertical" == n) {
                            this.ctx.textAlign = "center", this.ctx.textBaseline = "inner" == s ? "top" : "outer" == s ? "bottom" : "middle", x = w.endAngle - (w.endAngle - w.startAngle) / 2 - 180, x += this.rotationAngle, this.ctx.save(), this.ctx.translate(g, c), this.ctx.rotate(this.degToRad(x)), this.ctx.translate(-g, -c);
                            var p = 0;
                            if ("outer" == s ? p = c + m - o : "inner" == s && (p = c + u + o), x = i - i / 9, "outer" == s)
                                for (var A = t[h].length - 1; 0 <= A; A--) {
                                    var v = t[h].charAt(A);
                                    r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p -= x
                                } else if ("inner" == s)
                                    for (A = 0; A < t[h].length; A++) v = t[h].charAt(A), r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p += x;
                                else if ("center" == s)
                                for (p = 0, 1 < t[h].length && (p = x * (t[h].length - 1) / 2), p = c + u + (m - u) / 2 + p + o, A = t[h].length - 1; 0 <= A; A--) v = t[h].charAt(A), r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p -= x;
                            this.ctx.restore()
                        } else if ("curved" == n)
                            for (x = 0, "inner" == s ? (x = u + o, this.ctx.textBaseline = "top") : "outer" == s ? (x = m - o, this.ctx.textBaseline = "bottom", x -= i * (t.length - 1)) : "center" == s && (x = u + o + (m - u) / 2, this.ctx.textBaseline = "middle"), p = 0, 1 < t[h].length ? (this.ctx.textAlign = "left", p = i / 10 * 4, p *= 100 / x, A = w.startAngle + ((w.endAngle - w.startAngle) / 2 - p * t[h].length / 2)) : (A = w.startAngle + (w.endAngle - w.startAngle) / 2, this.ctx.textAlign = "center"), A += this.rotationAngle, A -= 180, v = t[h].length; 0 <= v; v--) {
                                this.ctx.save();
                                var f = t[h].charAt(v);
                                this.ctx.translate(g, c), this.ctx.rotate(this.degToRad(A)), this.ctx.translate(-g, -c), l && this.ctx.strokeText(f, g, c + x + e), r && this.ctx.fillText(f, g, c + x + e), A += p, this.ctx.restore()
                            }
                    } else if ("horizontal" == n) this.ctx.textAlign = "inner" == s ? "left" : "outer" == s ? "right" : "center", this.ctx.textBaseline = "middle", x = this.degToRad(w.endAngle - (w.endAngle - w.startAngle) / 2 + this.rotationAngle - 90), this.ctx.save(), this.ctx.translate(g, c), this.ctx.rotate(x), this.ctx.translate(-g, -c), "inner" == s ? (r && this.ctx.fillText(t[h], g + u + o, c + e), l && this.ctx.strokeText(t[h], g + u + o, c + e)) : "outer" == s ? (r && this.ctx.fillText(t[h], g + m - o, c + e), l && this.ctx.strokeText(t[h], g + m - o, c + e)) : (r && this.ctx.fillText(t[h], g + u + (m - u) / 2 + o, c + e), l && this.ctx.strokeText(t[h], g + u + (m - u) / 2 + o, c + e)), this.ctx.restore();
                    else if ("vertical" == n) {
                        if (this.ctx.textAlign = "center", this.ctx.textBaseline = "inner" == s ? "bottom" : "outer" == s ? "top" : "middle", x = w.endAngle - (w.endAngle - w.startAngle) / 2, x += this.rotationAngle, this.ctx.save(), this.ctx.translate(g, c), this.ctx.rotate(this.degToRad(x)), this.ctx.translate(-g, -c), p = 0, "outer" == s ? p = c - m + o : "inner" == s && (p = c - u - o), x = i - i / 9, "outer" == s)
                            for (A = 0; A < t[h].length; A++) v = t[h].charAt(A), r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p += x;
                        else if ("inner" == s)
                            for (A = t[h].length - 1; 0 <= A; A--) v = t[h].charAt(A), r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p -= x;
                        else if ("center" == s)
                            for (p = 0, 1 < t[h].length && (p = x * (t[h].length - 1) / 2), p = c - u - (m - u) / 2 - p - o, A = 0; A < t[h].length; A++) v = t[h].charAt(A), r && this.ctx.fillText(v, g + e, p), l && this.ctx.strokeText(v, g + e, p), p += x;
                        this.ctx.restore()
                    } else if ("curved" == n)
                        for (x = 0, "inner" == s ? (x = u + o, this.ctx.textBaseline = "bottom", x += i * (t.length - 1)) : "outer" == s ? (x = m - o, this.ctx.textBaseline = "top") : "center" == s && (x = u + o + (m - u) / 2, this.ctx.textBaseline = "middle"), p = 0, 1 < t[h].length ? (this.ctx.textAlign = "left", p = i / 10 * 4, p *= 100 / x, A = w.startAngle + ((w.endAngle - w.startAngle) / 2 - p * t[h].length / 2)) : (A = w.startAngle + (w.endAngle - w.startAngle) / 2, this.ctx.textAlign = "center"), A += this.rotationAngle, v = 0; v < t[h].length; v++) this.ctx.save(), f = t[h].charAt(v), this.ctx.translate(g, c), this.ctx.rotate(this.degToRad(A)), this.ctx.translate(-g, -c), l && this.ctx.strokeText(f, g, c - x + e), r && this.ctx.fillText(f, g, c - x + e), A += p, this.ctx.restore();
                    e += i
                }
            }
            this.ctx.restore()
        }
}, Winwheel.prototype.degToRad = function(t) {
    return .017453292519943295 * t
}, Winwheel.prototype.setCenter = function(t, i) {
    this.centerX = t, this.centerY = i
}, Winwheel.prototype.addSegment = function(t, i) {
    var e = new Segment(t);
    if (this.numSegments++, void 0 !== i) {
        for (var n = this.numSegments; i < n; n--) this.segments[n] = this.segments[n - 1];
        this.segments[i] = e, e = i
    } else this.segments[this.numSegments] = e, e = this.numSegments;
    return this.updateSegmentSizes(), this.segments[e]
}, Winwheel.prototype.setCanvasId = function(t) {
    t ? (this.canvasId = t, (this.canvas = document.getElementById(this.canvasId)) && (this.ctx = this.canvas.getContext("2d"))) : this.canvas = this.ctx = this.canvasId = null
}, Winwheel.prototype.deleteSegment = function(t) {
    if (1 < this.numSegments) {
        if (void 0 !== t)
            for (; t < this.numSegments; t++) this.segments[t] = this.segments[t + 1];
        this.segments[this.numSegments] = void 0, this.numSegments--, this.updateSegmentSizes()
    }
}, Winwheel.prototype.windowToCanvas = function(t, i) {
    var e = this.canvas.getBoundingClientRect();
    return {
        x: Math.floor(t - this.canvas.width / e.width * e.left),
        y: Math.floor(i - this.canvas.height / e.height * e.top)
    }
}, Winwheel.prototype.getSegmentAt = function(t, i) {
    var e = null,
        n = this.getSegmentNumberAt(t, i);
    return null !== n && (e = this.segments[n]), e
}, Winwheel.prototype.getSegmentNumberAt = function(t, i) {
    var e = this.windowToCanvas(t, i),
        n = this.centerX * this.scaleFactor,
        s = this.centerY * this.scaleFactor,
        a = this.outerRadius * this.scaleFactor,
        o = this.innerRadius * this.scaleFactor;
    if (e.x > n) {
        var r = e.x - n;
        n = "R"
    } else r = n - e.x, n = "L";
    if (e.y > s) {
        var l = e.y - s;
        s = "B"
    } else l = s - e.y, s = "T";
    var h = 180 * Math.atan(l / r) / Math.PI;
    for (e = 0, r = Math.sqrt(l * l + r * r), "T" == s && "R" == n ? e = Math.round(90 - h) : "B" == s && "R" == n ? e = Math.round(90 + h) : "B" == s && "L" == n ? e = Math.round(90 - h + 180) : "T" == s && "L" == n && (e = Math.round(270 + h)), 0 != this.rotationAngle && ((e -= n = this.getRotationPosition()) < 0 && (e = 360 - Math.abs(e))), n = null, s = 1; s <= this.numSegments; s++)
        if (e >= this.segments[s].startAngle && e <= this.segments[s].endAngle && o <= r && r <= a) {
            n = s;
            break
        } return n
}, Winwheel.prototype.getIndicatedSegment = function() {
    var t = this.getIndicatedSegmentNumber();
    return this.segments[t]
}, Winwheel.prototype.getIndicatedSegmentNumber = function() {
    var t = 0,
        i = this.getRotationPosition();
    (i = Math.floor(this.pointerAngle - i)) < 0 && (i = 360 - Math.abs(i));
    for (var e = 1; e < this.segments.length; e++)
        if (i >= this.segments[e].startAngle && i <= this.segments[e].endAngle) {
            t = e;
            break
        } return t
}, Winwheel.prototype.getCurrentPinNumber = function() {
    var t = 0;
    if (this.pins) {
        var i = this.getRotationPosition();
        (i = Math.floor(this.pointerAngle - i)) < 0 && (i = 360 - Math.abs(i));
        for (var e = 360 / this.pins.number, n = 0, s = 0; s < this.pins.number; s++) {
            if (n <= i && i <= n + e) {
                t = s;
                break
            }
            n += e
        }
        "clockwise" == this.animation.direction && (++t > this.pins.number && (t = 0))
    }
    return t
}, Winwheel.prototype.getRotationPosition = function() {
    var t = this.rotationAngle;
    return 0 <= t ? 360 < t && (t -= 360 * Math.floor(t / 360)) : (t < -360 && (t -= 360 * Math.ceil(t / 360)), t = 360 + t), t
}, Winwheel.prototype.sAn = function(prb) {
    this.animation.propertyValue = 3630;
    if (this.animation) {
        this.computeAnimation(), winwheelToDrawDuringAnimation = this;
        var t = Array(null);
        this.animation.propertyValue = this.gNVFs(prb);
        t[this.animation.propertyName] = this.animation.propertyValue, t.yoyo = this.animation.yoyo, t.repeat = this.animation.repeat, t.ease = this.animation.easing, t.onUpdate = winwheelAnimationLoop, t.onComplete = winwheelStopAnimation, this.tween = TweenMax.to(this, this.animation.duration, t)
    }
}, Winwheel.prototype.stAn = function(t) {
    winwheelToDrawDuringAnimation && (winwheelToDrawDuringAnimation.tween && winwheelToDrawDuringAnimation.tween.kill(), winwheelStopAnimation(t)), winwheelToDrawDuringAnimation = this
}, Winwheel.prototype.pauseAnimation = function() {
    this.tween && this.tween.pause()
}, Winwheel.prototype.resumeAnimation = function() {
    this.tween && this.tween.play()
}, Winwheel.prototype.computeAnimation = function() {
    this.animation && ("spinOngoing" == this.animation.type ? (this.animation.propertyName = "rotationAngle", null == this.animation.spins && (this.animation.spins = 5), null == this.animation.repeat && (this.animation.repeat = -1), null == this.animation.easing && (this.animation.easing = "Linear.easeNone"), null == this.animation.yoyo && (this.animation.yoyo = !1), this.animation.propertyValue = 360 * this.animation.spins, "anti-clockwise" == this.animation.direction && (this.animation.propertyValue = 0 - this.animation.propertyValue)) : "spinToStop" == this.animation.type ? (this.animation.propertyName = "rotationAngle", null == this.animation.spins && (this.animation.spins = 5), null == this.animation.repeat && (this.animation.repeat = 0), null == this.animation.easing && (this.animation.easing = "Power3.easeOut"), this.animation._stopAngle = null == this.animation.stopAngle ? Math.floor(359 * Math.random()) : 360 - this.animation.stopAngle + this.pointerAngle, null == this.animation.yoyo && (this.animation.yoyo = !1), this.animation.propertyValue = 360 * this.animation.spins, "anti-clockwise" == this.animation.direction ? (this.animation.propertyValue = 0 - this.animation.propertyValue, this.animation.propertyValue -= 360 - this.animation._stopAngle) : this.animation.propertyValue += this.animation._stopAngle) : "spinAndBack" == this.animation.type && (this.animation.propertyName = "rotationAngle", null == this.animation.spins && (this.animation.spins = 5), null == this.animation.repeat && (this.animation.repeat = 1), null == this.animation.easing && (this.animation.easing = "Power2.easeInOut"), null == this.animation.yoyo && (this.animation.yoyo = !0), this.animation._stopAngle = null == this.animation.stopAngle ? 0 : 360 - this.animation.stopAngle, this.animation.propertyValue = 360 * this.animation.spins, "anti-clockwise" == this.animation.direction ? (this.animation.propertyValue = 0 - this.animation.propertyValue, this.animation.propertyValue -= 360 - this.animation._stopAngle) : this.animation.propertyValue += this.animation._stopAngle))
}, Winwheel.prototype.getRandomForSegment = function(t) {
    var i = 0;
    if (t)
        if (void 0 !== this.segments[t]) {
            var e = this.segments[t].startAngle;
            0 < (t = this.segments[t].endAngle - e - 2) ? i = e + 1 + Math.floor(Math.random() * t) : console.log("Segment size is too small to safely get random angle inside it")
        } else console.log("Segment " + t + " undefined");
    else console.log("Segment number not specified");
    return i
}, Winwheel.prototype.gNVFs = function(prb) {
    const nms = [
        "235995136;237830144",
        "237895680;239796224",
        "239861760;241762304",
        "241827840;243728384",
        "243793920;245694464",
        "245760000;247660544",
        "247726080;249626624",
        "249692160;251592704",
        "251658240;253558784",
        "253624320;255524864",
        "255590400;257490944",
        "257556480;259457024"
    ];

    const nnms = nms[this.fIqR(prb)].split(';');
    return this.mkRdI(this.gHNd(nnms[0]), this.gHNd(nnms[1]));
}, Winwheel.prototype.gHNd = function(inNum) {
    return (((0x0000FFFF & inNum) << 16) + ((0xFFFF0000 & inNum) >> 16));
}, Winwheel.prototype.mkRdI = function(mn, mx) {
    mn = Math.ceil(mn);
    mx = Math.floor(mx);
    return Math.floor(Math.random() * (mx - mn + 1)) + mn;
}, Winwheel.prototype.fIqR = function(prb) {
    // 393216;65536;720896;65536;1048576;1048576;262144;1376256;196608;720896;65536;1376256
    let dts = [];
    for (let i = 1;i <= 12;i++) {
        for (let j = 1;j <= this.gHNd(prb.split(';')[i - 1]) - 1;j++) {
            dts.push(i - 1);
        }
    }

    return this.sfAr(dts)[this.mkRdI(0, dts.length)];
}, Winwheel.prototype.sfAr = function(r) {
    for (let i = r.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [r[i], r[j]] = [r[j], r[i]];
    }
    return r;
}, Segment.prototype.changeImage = function(t, i) {
    this.image = t, this.imgData = null, i && (this.imageDirection = i), winhweelAlreadyDrawn = !1, this.imgData = new Image, this.imgData.onload = winwheelLoadedImage, this.imgData.src = this.image
};
var winwheelToDrawDuringAnimation = null;

function winwheelStopAnimation(a) {
    0 != a && (a = winwheelToDrawDuringAnimation.animation.callbackFinished, null != a && ("function" == typeof a ? a(winwheelToDrawDuringAnimation.getIndicatedSegment()) : eval(a)))
}
var winhweelAlreadyDrawn = !1;

function winwheelLoadedImage() {
    if (0 == winhweelAlreadyDrawn) {
        for (var t = 0, i = 1; i <= winwheelToDrawDuringAnimation.numSegments; i++) null != winwheelToDrawDuringAnimation.segments[i].imgData && winwheelToDrawDuringAnimation.segments[i].imgData.height && t++;
        t == winwheelToDrawDuringAnimation.numSegments && (winhweelAlreadyDrawn = !0, winwheelToDrawDuringAnimation.draw())
    }
}

function winwheelResize() {
    var t = 40;
    void 0 !== winwheelToDrawDuringAnimation._responsiveMargin && (t = winwheelToDrawDuringAnimation._responsiveMargin);
    var i = window.innerWidth - t,
        e = winwheelToDrawDuringAnimation._responsiveMinWidth;
    t = winwheelToDrawDuringAnimation._responsiveMinHeight, i < e ? i = e : i > winwheelToDrawDuringAnimation._originalCanvasWidth && (i = winwheelToDrawDuringAnimation._originalCanvasWidth), i /= winwheelToDrawDuringAnimation._originalCanvasWidth, winwheelToDrawDuringAnimation.canvas.width = winwheelToDrawDuringAnimation._originalCanvasWidth * i, winwheelToDrawDuringAnimation._responsiveScaleHeight && ((e = winwheelToDrawDuringAnimation._originalCanvasHeight * i) < t ? e = t : e > winwheelToDrawDuringAnimation._originalCanvasHeight && (e = winwheelToDrawDuringAnimation._originalCanvasHeight), winwheelToDrawDuringAnimation.canvas.height = e), winwheelToDrawDuringAnimation.scaleFactor = i, winwheelToDrawDuringAnimation.draw()
}
