/*! Project: https://github.com/wmlgl/cropperjs-gif, license: MIT */ ! function(t, e) {
	for (var r in e) t[r] = e[r]
}(window, function(t) {
	var e = {};

	function r(n) {
		if (e[n]) return e[n].exports;
		var i = e[n] = {
			i: n,
			l: !1,
			exports: {}
		};
		return t[n].call(i.exports, i, i.exports, r), i.l = !0, i.exports
	}
	return r.m = t, r.c = e, r.d = function(t, e, n) {
		r.o(t, e) || Object.defineProperty(t, e, {
			enumerable: !0,
			get: n
		})
	}, r.r = function(t) {
		"undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
			value: "Module"
		}), Object.defineProperty(t, "__esModule", {
			value: !0
		})
	}, r.t = function(t, e) {
		if (1 & e && (t = r(t)), 8 & e) return t;
		if (4 & e && "object" == typeof t && t && t.__esModule) return t;
		var n = Object.create(null);
		if (r.r(n), Object.defineProperty(n, "default", {
				enumerable: !0,
				value: t
			}), 2 & e && "string" != typeof t)
			for (var i in t) r.d(n, i, function(e) {
				return t[e]
			}.bind(null, i));
		return n
	}, r.n = function(t) {
		var e = t && t.__esModule ? function() {
			return t.default
		} : function() {
			return t
		};
		return r.d(e, "a", e), e
	}, r.o = function(t, e) {
		return Object.prototype.hasOwnProperty.call(t, e)
	}, r.p = "/dist/", r(r.s = 4)
}([function(t, e, r) {
	var n;
	t.exports = function t(e, r, i) {
		function s(o, h) {
			if (!r[o]) {
				if (!e[o]) {
					var l = "function" == typeof n && n;
					if (!h && l) return n(o, !0);
					if (a) return a(o, !0);
					var p = new Error("Cannot find module '" + o + "'");
					throw p.code = "MODULE_NOT_FOUND", p
				}
				var c = r[o] = {
					exports: {}
				};
				e[o][0].call(c.exports, function(t) {
					var r = e[o][1][t];
					return s(r || t)
				}, c, c.exports, t, e, r, i)
			}
			return r[o].exports
		}
		for (var a = "function" == typeof n && n, o = 0; o < i.length; o++) s(i[o]);
		return s
	}({
		1: [function(t, e, r) {
			function n() {
				this._events = this._events || {}, this._maxListeners = this._maxListeners || void 0
			}

			function i(t) {
				return "function" == typeof t
			}

			function s(t) {
				return "object" == typeof t && null !== t
			}

			function a(t) {
				return void 0 === t
			}
			e.exports = n, n.EventEmitter = n, n.prototype._events = void 0, n.prototype._maxListeners = void 0, n.defaultMaxListeners = 10, n.prototype.setMaxListeners = function(t) {
				if ("number" != typeof t || t < 0 || isNaN(t)) throw TypeError("n must be a positive number");
				return this._maxListeners = t, this
			}, n.prototype.emit = function(t) {
				var e, r, n, o, h, l;
				if (this._events || (this._events = {}), "error" === t && (!this._events.error || s(this._events.error) && !this._events.error.length)) {
					if ((e = arguments[1]) instanceof Error) throw e;
					var p = new Error('Uncaught, unspecified "error" event. (' + e + ")");
					throw p.context = e, p
				}
				if (a(r = this._events[t])) return !1;
				if (i(r)) switch (arguments.length) {
					case 1:
						r.call(this);
						break;
					case 2:
						r.call(this, arguments[1]);
						break;
					case 3:
						r.call(this, arguments[1], arguments[2]);
						break;
					default:
						o = Array.prototype.slice.call(arguments, 1), r.apply(this, o)
				} else if (s(r))
					for (o = Array.prototype.slice.call(arguments, 1), l = r.slice(), n = l.length, h = 0; h < n; h++) l[h].apply(this, o);
				return !0
			}, n.prototype.addListener = function(t, e) {
				var r;
				if (!i(e)) throw TypeError("listener must be a function");
				return this._events || (this._events = {}), this._events.newListener && this.emit("newListener", t, i(e.listener) ? e.listener : e), this._events[t] ? s(this._events[t]) ? this._events[t].push(e) : this._events[t] = [this._events[t], e] : this._events[t] = e, s(this._events[t]) && !this._events[t].warned && (r = a(this._maxListeners) ? n.defaultMaxListeners : this._maxListeners) && r > 0 && this._events[t].length > r && (this._events[t].warned = !0, console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.", this._events[t].length), "function" == typeof console.trace && console.trace()), this
			}, n.prototype.on = n.prototype.addListener, n.prototype.once = function(t, e) {
				if (!i(e)) throw TypeError("listener must be a function");
				var r = !1;

				function n() {
					this.removeListener(t, n), r || (r = !0, e.apply(this, arguments))
				}
				return n.listener = e, this.on(t, n), this
			}, n.prototype.removeListener = function(t, e) {
				var r, n, a, o;
				if (!i(e)) throw TypeError("listener must be a function");
				if (!this._events || !this._events[t]) return this;
				if (r = this._events[t], a = r.length, n = -1, r === e || i(r.listener) && r.listener === e) delete this._events[t], this._events.removeListener && this.emit("removeListener", t, e);
				else if (s(r)) {
					for (o = a; o-- > 0;)
						if (r[o] === e || r[o].listener && r[o].listener === e) {
							n = o;
							break
						} if (n < 0) return this;
					1 === r.length ? (r.length = 0, delete this._events[t]) : r.splice(n, 1), this._events.removeListener && this.emit("removeListener", t, e)
				}
				return this
			}, n.prototype.removeAllListeners = function(t) {
				var e, r;
				if (!this._events) return this;
				if (!this._events.removeListener) return 0 === arguments.length ? this._events = {} : this._events[t] && delete this._events[t], this;
				if (0 === arguments.length) {
					for (e in this._events) "removeListener" !== e && this.removeAllListeners(e);
					return this.removeAllListeners("removeListener"), this._events = {}, this
				}
				if (i(r = this._events[t])) this.removeListener(t, r);
				else if (r)
					for (; r.length;) this.removeListener(t, r[r.length - 1]);
				return delete this._events[t], this
			}, n.prototype.listeners = function(t) {
				return this._events && this._events[t] ? i(this._events[t]) ? [this._events[t]] : this._events[t].slice() : []
			}, n.prototype.listenerCount = function(t) {
				if (this._events) {
					var e = this._events[t];
					if (i(e)) return 1;
					if (e) return e.length
				}
				return 0
			}, n.listenerCount = function(t, e) {
				return t.listenerCount(e)
			}
		}, {}],
		2: [function(t, e, r) {
			var n, i, s, a, o;
			o = navigator.userAgent.toLowerCase(), a = navigator.platform.toLowerCase(), n = o.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/) || [null, "unknown", 0], s = "ie" === n[1] && document.documentMode, (i = {
				name: "version" === n[1] ? n[3] : n[1],
				version: s || parseFloat("opera" === n[1] && n[4] ? n[4] : n[2]),
				platform: {
					name: o.match(/ip(?:ad|od|hone)/) ? "ios" : (o.match(/(?:webos|android)/) || a.match(/mac|win|linux/) || ["other"])[0]
				}
			})[i.name] = !0, i[i.name + parseInt(i.version, 10)] = !0, i.platform[i.platform.name] = !0, e.exports = i
		}, {}],
		3: [function(t, e, r) {
			var n, i, s, a = {}.hasOwnProperty,
				o = [].indexOf || function(t) {
					for (var e = 0, r = this.length; e < r; e++)
						if (e in this && this[e] === t) return e;
					return -1
				},
				h = [].slice;
			n = t("events").EventEmitter, s = t("./browser.coffee"), i = function(t) {
				var e, r;

				function n(t) {
					var r, n, i;
					for (n in this.running = !1, this.options = {}, this.frames = [], this.freeWorkers = [], this.activeWorkers = [], this.setOptions(t), e) i = e[n], null == (r = this.options)[n] && (r[n] = i)
				}
				return function(t, e) {
					for (var r in e) a.call(e, r) && (t[r] = e[r]);

					function n() {
						this.constructor = t
					}
					n.prototype = e.prototype, t.prototype = new n, t.__super__ = e.prototype
				}(n, t), e = {
					workerScript: "gif.worker.js",
					workers: 2,
					repeat: 0,
					background: "#fff",
					quality: 10,
					width: null,
					height: null,
					transparent: null,
					debug: !1,
					dither: !1
				}, r = {
					delay: 500,
					copy: !1
				}, n.prototype.setOption = function(t, e) {
					if (this.options[t] = e, null != this._canvas && ("width" === t || "height" === t)) return this._canvas[t] = e
				}, n.prototype.setOptions = function(t) {
					var e, r, n;
					for (e in r = [], t) a.call(t, e) && (n = t[e], r.push(this.setOption(e, n)));
					return r
				}, n.prototype.addFrame = function(t, e) {
					var n, i;
					for (i in null == e && (e = {}), (n = {}).transparent = this.options.transparent, r) n[i] = e[i] || r[i];
					if (null == this.options.width && this.setOption("width", t.width), null == this.options.height && this.setOption("height", t.height), "undefined" != typeof ImageData && null !== ImageData && t instanceof ImageData) n.data = t.data;
					else if ("undefined" != typeof CanvasRenderingContext2D && null !== CanvasRenderingContext2D && t instanceof CanvasRenderingContext2D || "undefined" != typeof WebGLRenderingContext && null !== WebGLRenderingContext && t instanceof WebGLRenderingContext) e.copy ? n.data = this.getContextData(t) : n.context = t;
					else {
						if (null == t.childNodes) throw new Error("Invalid image");
						e.copy ? n.data = this.getImageData(t) : n.image = t
					}
					return this.frames.push(n)
				}, n.prototype.render = function() {
					var t, e, r;
					if (this.running) throw new Error("Already running");
					if (null == this.options.width || null == this.options.height) throw new Error("Width and height must be set prior to rendering");
					if (this.running = !0, this.nextFrame = 0, this.finishedFrames = 0, this.imageParts = function() {
							var t, e, r;
							for (r = [], t = 0, e = this.frames.length; 0 <= e ? t < e : t > e; 0 <= e ? ++t : --t) r.push(null);
							return r
						}.call(this), e = this.spawnWorkers(), !0 === this.options.globalPalette) this.renderNextFrame();
					else
						for (t = 0, r = e; 0 <= r ? t < r : t > r; 0 <= r ? ++t : --t) this.renderNextFrame();
					return this.emit("start"), this.emit("progress", 0)
				}, n.prototype.abort = function() {
					for (var t; null != (t = this.activeWorkers.shift());) this.log("killing active worker"), t.terminate();
					return this.running = !1, this.emit("abort")
				}, n.prototype.spawnWorkers = function() {
					var t, e, r, n;
					return t = Math.min(this.options.workers, this.frames.length),
						function() {
							r = [];
							for (var n = e = this.freeWorkers.length; e <= t ? n < t : n > t; e <= t ? n++ : n--) r.push(n);
							return r
						}.apply(this).forEach((n = this, function(t) {
							var e;
							return n.log("spawning worker " + t), (e = new Worker(n.options.workerScript)).onmessage = function(t) {
								return n.activeWorkers.splice(n.activeWorkers.indexOf(e), 1), n.freeWorkers.push(e), n.frameFinished(t.data)
							}, n.freeWorkers.push(e)
						})), t
				}, n.prototype.frameFinished = function(t) {
					var e, r;
					if (this.log("frame " + t.index + " finished - " + this.activeWorkers.length + " active"), this.finishedFrames++, this.emit("progress", this.finishedFrames / this.frames.length), this.imageParts[t.index] = t, !0 === this.options.globalPalette && (this.options.globalPalette = t.globalPalette, this.log("global palette analyzed"), this.frames.length > 2))
						for (e = 1, r = this.freeWorkers.length; 1 <= r ? e < r : e > r; 1 <= r ? ++e : --e) this.renderNextFrame();
					return o.call(this.imageParts, null) >= 0 ? this.renderNextFrame() : this.finishRendering()
				}, n.prototype.finishRendering = function() {
					var t, e, r, n, i, s, a, o, h, l, p, c, u, f, d, g;
					for (o = 0, f = this.imageParts, i = 0, h = f.length; i < h; i++) e = f[i], o += (e.data.length - 1) * e.pageSize + e.cursor;
					for (o += e.pageSize - e.cursor, this.log("rendering finished - filesize " + Math.round(o / 1e3) + "kb"), t = new Uint8Array(o), c = 0, d = this.imageParts, s = 0, l = d.length; s < l; s++)
						for (e = d[s], g = e.data, r = a = 0, p = g.length; a < p; r = ++a) u = g[r], t.set(u, c), r === e.data.length - 1 ? c += e.cursor : c += e.pageSize;
					return n = new Blob([t], {
						type: "image/gif"
					}), this.emit("finished", n, t)
				}, n.prototype.renderNextFrame = function() {
					var t, e, r;
					if (0 === this.freeWorkers.length) throw new Error("No free workers");
					if (!(this.nextFrame >= this.frames.length)) return t = this.frames[this.nextFrame++], r = this.freeWorkers.shift(), e = this.getTask(t), this.log("starting frame " + (e.index + 1) + " of " + this.frames.length), this.activeWorkers.push(r), r.postMessage(e)
				}, n.prototype.getContextData = function(t) {
					return t.getImageData(0, 0, this.options.width, this.options.height).data
				}, n.prototype.getImageData = function(t) {
					var e;
					return null == this._canvas && (this._canvas = document.createElement("canvas"), this._canvas.width = this.options.width, this._canvas.height = this.options.height), (e = this._canvas.getContext("2d")).setFill = this.options.background, e.fillRect(0, 0, this.options.width, this.options.height), e.drawImage(t, 0, 0), this.getContextData(e)
				}, n.prototype.getTask = function(t) {
					var e, r;
					if (e = this.frames.indexOf(t), r = {
							index: e,
							last: e === this.frames.length - 1,
							delay: t.delay,
							transparent: t.transparent,
							width: this.options.width,
							height: this.options.height,
							quality: this.options.quality,
							dither: this.options.dither,
							globalPalette: this.options.globalPalette,
							repeat: this.options.repeat,
							canTransfer: "chrome" === s.name
						}, null != t.data) r.data = t.data;
					else if (null != t.context) r.data = this.getContextData(t.context);
					else {
						if (null == t.image) throw new Error("Invalid frame");
						r.data = this.getImageData(t.image)
					}
					return r
				}, n.prototype.log = function() {
					var t;
					if (t = 1 <= arguments.length ? h.call(arguments, 0) : [], this.options.debug) return console.log.apply(console, t)
				}, n
			}(n), e.exports = i
		}, {
			"./browser.coffee": 2,
			events: 1
		}]
	}, {}, [3])(3)
}, function(t, e, r) {
	var n;
	! function t(e, r, i) {
		function s(o, h) {
			if (!r[o]) {
				if (!e[o]) {
					if (!h && ("function" == typeof n && n)) return n(o, !0);
					if (a) return a(o, !0);
					var l = new Error("Cannot find module '" + o + "'");
					throw l.code = "MODULE_NOT_FOUND", l
				}
				var p = r[o] = {
					exports: {}
				};
				e[o][0].call(p.exports, function(t) {
					var r = e[o][1][t];
					return s(r || t)
				}, p, p.exports, t, e, r, i)
			}
			return r[o].exports
		}
		for (var a = "function" == typeof n && n, o = 0; o < i.length; o++) s(i[o]);
		return s
	}({
		1: [function(t, e, r) {
			function n(t) {
				this.data = t, this.pos = 0
			}
			n.prototype.readByte = function() {
				return this.data[this.pos++]
			}, n.prototype.peekByte = function() {
				return this.data[this.pos]
			}, n.prototype.readBytes = function(t) {
				for (var e = new Array(t), r = 0; r < t; r++) e[r] = this.readByte();
				return e
			}, n.prototype.peekBytes = function(t) {
				for (var e = new Array(t), r = 0; r < t; r++) e[r] = this.data[this.pos + r];
				return e
			}, n.prototype.readString = function(t) {
				for (var e = "", r = 0; r < t; r++) e += String.fromCharCode(this.readByte());
				return e
			}, n.prototype.readBitArray = function() {
				for (var t = [], e = this.readByte(), r = 7; r >= 0; r--) t.push(!!(e & 1 << r));
				return t
			}, n.prototype.readUnsigned = function(t) {
				var e = this.readBytes(2);
				return t ? (e[1] << 8) + e[0] : (e[0] << 8) + e[1]
			}, e.exports = n
		}, {}],
		2: [function(t, e, r) {
			var n = t("./bytestream");

			function i(t) {
				this.stream = new n(t), this.output = {}
			}
			i.prototype.parse = function(t) {
				return this.parseParts(this.output, t), this.output
			}, i.prototype.parseParts = function(t, e) {
				for (var r = 0; r < e.length; r++) {
					var n = e[r];
					this.parsePart(t, n)
				}
			}, i.prototype.parsePart = function(t, e) {
				var r, n = e.label;
				if (!e.requires || e.requires(this.stream, this.output, t))
					if (e.loop) {
						for (var i = []; e.loop(this.stream);) {
							var s = {};
							this.parseParts(s, e.parts), i.push(s)
						}
						t[n] = i
					} else e.parts ? (r = {}, this.parseParts(r, e.parts), t[n] = r) : e.parser ? (r = e.parser(this.stream, this.output, t), e.skip || (t[n] = r)) : e.bits && (t[n] = this.parseBits(e.bits))
			}, i.prototype.parseBits = function(t) {
				var e = {},
					r = this.stream.readBitArray();
				for (var n in t) {
					var i = t[n];
					i.length ? e[n] = r.slice(i.index, i.index + i.length).reduce(function(t, e) {
						return 2 * t + e
					}, 0) : e[n] = r[i.index]
				}
				return e
			}, e.exports = i
		}, {
			"./bytestream": 1
		}],
		3: [function(t, e, r) {
			var n = {
				readByte: function() {
					return function(t) {
						return t.readByte()
					}
				},
				readBytes: function(t) {
					return function(e) {
						return e.readBytes(t)
					}
				},
				readString: function(t) {
					return function(e) {
						return e.readString(t)
					}
				},
				readUnsigned: function(t) {
					return function(e) {
						return e.readUnsigned(t)
					}
				},
				readArray: function(t, e) {
					return function(r, n, i) {
						for (var s = e(r, n, i), a = new Array(s), o = 0; o < s; o++) a[o] = r.readBytes(t);
						return a
					}
				}
			};
			e.exports = n
		}, {}],
		4: [function(t, e, r) {
			var n = window.GIF;
			n = t("./gif"), window.GIF = n
		}, {
			"./gif": 5
		}],
		5: [function(t, e, r) {
			var n = t("../bower_components/js-binary-schema-parser/src/dataparser"),
				i = t("./schema");

			function s(t) {
				var e = new Uint8Array(t),
					r = new n(e);
				this.raw = r.parse(i), this.raw.hasImages = !1;
				for (var s = 0; s < this.raw.frames.length; s++)
					if (this.raw.frames[s].image) {
						this.raw.hasImages = !0;
						break
					}
			}
			s.prototype.decompressFrame = function(t, e) {
				if (t >= this.raw.frames.length) return null;
				var r = this.raw.frames[t];
				if (r.image) {
					var n = r.image.descriptor.width * r.image.descriptor.height,
						i = function(t, e, r) {
							var n, i, s, a, o, h, l, p, c, u, f, d, g, v, m, y, w = r,
								b = new Array(r),
								x = new Array(4096),
								C = new Array(4096),
								_ = new Array(4097);
							for (o = 1 + (i = 1 << (d = t)), n = i + 2, l = -1, s = (1 << (a = d + 1)) - 1, c = 0; c < i; c++) x[c] = 0, C[c] = c;
							for (f = p = count = g = v = y = m = 0, u = 0; u < w;) {
								if (0 === v) {
									if (p < a) {
										f += e[m] << p, p += 8, m++;
										continue
									}
									if (c = f & s, f >>= a, p -= a, c > n || c == o) break;
									if (c == i) {
										s = (1 << (a = d + 1)) - 1, n = i + 2, l = -1;
										continue
									}
									if (-1 == l) {
										_[v++] = C[c], l = c, g = c;
										continue
									}
									for (h = c, c == n && (_[v++] = g, c = l); c > i;) _[v++] = C[c], c = x[c];
									g = 255 & C[c], _[v++] = g, n < 4096 && (x[n] = l, C[n] = g, 0 == (++n & s) && n < 4096 && (a++, s += n)), l = h
								}
								v--, b[y++] = _[v], u++
							}
							for (u = y; u < w; u++) b[u] = 0;
							return b
						}(r.image.data.minCodeSize, r.image.data.blocks, n);
					r.image.descriptor.lct.interlaced && (i = function(t, e) {
						for (var r = new Array(t.length), n = t.length / e, i = function(n, i) {
								var s = t.slice(i * e, (i + 1) * e);
								r.splice.apply(r, [n * e, e].concat(s))
							}, s = [0, 4, 2, 1], a = [8, 8, 4, 2], o = 0, h = 0; h < 4; h++)
							for (var l = s[h]; l < n; l += a[h]) i(l, o), o++;
						return r
					}(i, r.image.descriptor.width));
					var s = {
						pixels: i,
						dims: {
							top: r.image.descriptor.top,
							left: r.image.descriptor.left,
							width: r.image.descriptor.width,
							height: r.image.descriptor.height
						}
					};
					return r.image.descriptor.lct && r.image.descriptor.lct.exists ? s.colorTable = r.image.lct : s.colorTable = this.raw.gct, r.gce && (s.delay = 10 * (r.gce.delay || 10), s.disposalType = r.gce.extras.disposal, r.gce.extras.transparentColorGiven && (s.transparentIndex = r.gce.transparentColorIndex)), e && (s.patch = function(t) {
						for (var e = t.pixels.length, r = new Uint8ClampedArray(4 * e), n = 0; n < e; n++) {
							var i = 4 * n,
								s = t.pixels[n],
								a = t.colorTable[s];
							r[i] = a[0], r[i + 1] = a[1], r[i + 2] = a[2], r[i + 3] = s !== t.transparentIndex ? 255 : 0
						}
						return r
					}(s)), s
				}
				return null
			}, s.prototype.decompressFrames = function(t) {
				for (var e = [], r = 0; r < this.raw.frames.length; r++) {
					this.raw.frames[r].image && e.push(this.decompressFrame(r, t))
				}
				return e
			}, e.exports = s
		}, {
			"../bower_components/js-binary-schema-parser/src/dataparser": 2,
			"./schema": 6
		}],
		6: [function(t, e, r) {
			var n = t("../bower_components/js-binary-schema-parser/src/parsers"),
				i = {
					label: "blocks",
					parser: function(t) {
						for (var e = [], r = t.readByte(); 0 !== r; r = t.readByte()) e = e.concat(t.readBytes(r));
						return e
					}
				},
				s = {
					label: "gce",
					requires: function(t) {
						var e = t.peekBytes(2);
						return 33 === e[0] && 249 === e[1]
					},
					parts: [{
						label: "codes",
						parser: n.readBytes(2),
						skip: !0
					}, {
						label: "byteSize",
						parser: n.readByte()
					}, {
						label: "extras",
						bits: {
							future: {
								index: 0,
								length: 3
							},
							disposal: {
								index: 3,
								length: 3
							},
							userInput: {
								index: 6
							},
							transparentColorGiven: {
								index: 7
							}
						}
					}, {
						label: "delay",
						parser: n.readUnsigned(!0)
					}, {
						label: "transparentColorIndex",
						parser: n.readByte()
					}, {
						label: "terminator",
						parser: n.readByte(),
						skip: !0
					}]
				},
				a = {
					label: "image",
					requires: function(t) {
						return 44 === t.peekByte()
					},
					parts: [{
						label: "code",
						parser: n.readByte(),
						skip: !0
					}, {
						label: "descriptor",
						parts: [{
							label: "left",
							parser: n.readUnsigned(!0)
						}, {
							label: "top",
							parser: n.readUnsigned(!0)
						}, {
							label: "width",
							parser: n.readUnsigned(!0)
						}, {
							label: "height",
							parser: n.readUnsigned(!0)
						}, {
							label: "lct",
							bits: {
								exists: {
									index: 0
								},
								interlaced: {
									index: 1
								},
								sort: {
									index: 2
								},
								future: {
									index: 3,
									length: 2
								},
								size: {
									index: 5,
									length: 3
								}
							}
						}]
					}, {
						label: "lct",
						requires: function(t, e, r) {
							return r.descriptor.lct.exists
						},
						parser: n.readArray(3, function(t, e, r) {
							return Math.pow(2, r.descriptor.lct.size + 1)
						})
					}, {
						label: "data",
						parts: [{
							label: "minCodeSize",
							parser: n.readByte()
						}, i]
					}]
				},
				o = {
					label: "text",
					requires: function(t) {
						var e = t.peekBytes(2);
						return 33 === e[0] && 1 === e[1]
					},
					parts: [{
						label: "codes",
						parser: n.readBytes(2),
						skip: !0
					}, {
						label: "blockSize",
						parser: n.readByte()
					}, {
						label: "preData",
						parser: function(t, e, r) {
							return t.readBytes(r.text.blockSize)
						}
					}, i]
				},
				h = {
					label: "frames",
					parts: [s, {
						label: "application",
						requires: function(t, e, r) {
							var n = t.peekBytes(2);
							return 33 === n[0] && 255 === n[1]
						},
						parts: [{
							label: "codes",
							parser: n.readBytes(2),
							skip: !0
						}, {
							label: "blockSize",
							parser: n.readByte()
						}, {
							label: "id",
							parser: function(t, e, r) {
								return t.readString(r.blockSize)
							}
						}, i]
					}, {
						label: "comment",
						requires: function(t, e, r) {
							var n = t.peekBytes(2);
							return 33 === n[0] && 254 === n[1]
						},
						parts: [{
							label: "codes",
							parser: n.readBytes(2),
							skip: !0
						}, i]
					}, a, o],
					loop: function(t) {
						var e = t.peekByte();
						return 33 === e || 44 === e
					}
				},
				l = [{
					label: "header",
					parts: [{
						label: "signature",
						parser: n.readString(3)
					}, {
						label: "version",
						parser: n.readString(3)
					}]
				}, {
					label: "lsd",
					parts: [{
						label: "width",
						parser: n.readUnsigned(!0)
					}, {
						label: "height",
						parser: n.readUnsigned(!0)
					}, {
						label: "gct",
						bits: {
							exists: {
								index: 0
							},
							resolution: {
								index: 1,
								length: 3
							},
							sort: {
								index: 4
							},
							size: {
								index: 5,
								length: 3
							}
						}
					}, {
						label: "backgroundColorIndex",
						parser: n.readByte()
					}, {
						label: "pixelAspectRatio",
						parser: n.readByte()
					}]
				}, {
					label: "gct",
					requires: function(t, e) {
						return e.lsd.gct.exists
					},
					parser: n.readArray(3, function(t, e) {
						return Math.pow(2, e.lsd.gct.size + 1)
					})
				}, h];
			e.exports = l
		}, {
			"../bower_components/js-binary-schema-parser/src/parsers": 3
		}]
	}, {}, [4]), e.GIFuctJS = GIF
}, function(t, e, r) {
	"use strict";

	function n(t) {
		t.background = t.background || "#fff", this.options = t, this.containerCanvas = document.createElement("canvas"), this.containerCtx = this.containerCanvas.getContext("2d"), this.convertorCanvas = document.createElement("canvas"), this.convertorCtx = this.convertorCanvas.getContext("2d"), this.containerCenterX = null, this.containerCenterY = null, this.image = null, this.height = null, this.width = null, t.debug && (s = function(t) {
			setTimeout(t, 500)
		}, this.containerCanvas.style.width = "200px", this.convertorCanvas.style.width = "200px", document.body.insertBefore(this.containerCanvas, document.body.firstChild), document.body.insertBefore(this.convertorCanvas, document.body.firstChild))
	}
	r.r(e), r.d(e, "CropperjsGif", function() {
		return a
	});
	var i = {
		IMAGE_LOAD_ERROR: "IMAGE_LOAD_ERROR",
		IMAGE_READ_ERROR: "IMAGE_READ_ERROR",
		DECODE_ERROR: "DECODE_ERROR",
		ENCODE_ERROR: "ENCODE_ERROR"
	};
	n.prototype.ERROR = i, n.prototype.crop = function(t, e) {
		var r = t.getData(),
			n = this,
			i = this.calcLimitRatio(r),
			s = {
				x: Math.round(r.x * i),
				y: Math.round(r.y * i),
				width: Math.round(r.width * i),
				height: Math.round(r.height * i),
				scaleX: r.scaleX * i,
				scaleY: r.scaleY * i,
				rotate: r.rotate
			};
		this.readAndDecodeGif(function() {
			n.setupCanvas(s, i), n.cropFrame(0, s, [], function(t) {
				n.saveGif(s, t, function(t) {
					e && e(t)
				})
			})
		})
	}, n.prototype.calcLimitRatio = function(t) {
		var e = this.options.maxWidth / t.width,
			r = this.options.maxHeight / t.height;
		return e < 1 || r < 1 ? Math.min(e, r) : 1
	}, n.prototype.readAndDecodeGif = function(t) {
		var e = this;
		this.image = new Image, this.image.onload = function() {
			e.width = this.naturalWidth || this.width, e.height = this.naturalHeight || this.height;
			var r = new XMLHttpRequest;
			r.responseType = "arraybuffer", r.onreadystatechange = function() {
				4 == r.readyState && (200 == r.status ? e.decode(r.response, t) : e.errorHandler(i.IMAGE_READ_ERROR, new Error(r.statusText)))
			}, r.open("GET", e.options.src), r.send(null)
		}, this.image.onerror = function() {
			e.errorHandler(i.IMAGE_LOAD_ERROR)
		}, this.image.src = this.options.src
	}, n.prototype.decode = function(t, e) {
		try {
			var r = EasyGif.decoder(t);
			this.frames = r.decompressFrames(), e && e()
		} catch (t) {
			this.errorHandler(i.DECODE_ERROR, t)
		}
	}, n.prototype.setupCanvas = function(t, e) {
		var r = Math.PI / 180 * t.rotate,
			n = (this.width * Math.cos(r) + this.height * Math.sin(r)) * e,
			i = (this.height * Math.cos(r) + this.width * Math.sin(r)) * e;
		this.offsetX = -Math.min(t.x, 0), this.offsetY = -Math.min(t.y, 0), this.containerCenterX = this.offsetX + n / 2, this.containerCenterY = this.offsetY + i / 2, this.containerCanvas.width = Math.max(this.offsetX + n, this.offsetX + t.width, t.x + t.width), this.containerCanvas.height = Math.max(this.offsetY + i, this.offsetY + t.height, t.y + t.height), this.containerCtx.clearRect(0, 0, this.containerCanvas.width, this.containerCanvas.height), this.convertorCanvas.width = this.width, this.convertorCanvas.height = this.height
	}, n.prototype.cropFrame = function(t, e, r, n) {
		var i, a = this.frames[t],
			o = EasyGif.frameToImageData(this.containerCtx, a),
			h = this;
		this.containerCtx.save(), this.containerCtx.translate(this.containerCenterX, this.containerCenterY), this.containerCtx.rotate(e.rotate * Math.PI / 180), this.containerCtx.scale(e.scaleX, e.scaleY), this.containerCtx.drawImage(this.drawImgDataToCanvas(a, o), -this.convertorCanvas.width / 2, -this.convertorCanvas.height / 2), this.containerCtx.restore(), 0 == t && this.containerCtx.globalCompositeOperation && (this.containerCtx.fillStyle = this.options.background, this.containerCtx.globalCompositeOperation = "destination-over", this.containerCtx.fillRect(0, 0, this.containerCanvas.width, this.containerCanvas.height), this.containerCtx.globalCompositeOperation = "source-over"), i = this.containerCtx.getImageData(e.x + this.offsetX, e.y + this.offsetY, e.width, e.height), r.push(i), ++t < this.frames.length ? s(function() {
			h.cropFrame(t, e, r, n)
		}) : n && n(r)
	}, n.prototype.drawImgDataToCanvas = function(t, e) {
		return this.convertorCtx.clearRect(0, 0, this.width, this.height), this.convertorCtx.putImageData(e, t.dims.left, t.dims.top), this.convertorCanvas
	}, n.prototype.saveGif = function(t, e, r) {
		var n = this.options.encoder || {};
		n.width = t.width, n.height = t.height;
		try {
			for (var s = EasyGif.encoder(n), a = 0; a < e.length; a++) s.addFrame(e[a], {
				delay: this.frames[a].delay
			});
			s.on("finished", function(t) {
				r && r(t), s.abort();
				for (var e = s.freeWorkers, n = 0; n < e.length; n++) {
					e[n].terminate()
				}
			}), s.render()
		} catch (t) {
			this.errorHandler(i.DECODE_ERROR, t)
		}
	}, n.prototype.errorHandler = function(t, e) {
		this.options.onerror && this.options.onerror(t, e)
	};
	var s = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.setTimeout,
		a = {
			crop: function(t, e, r) {
				return new n(t).crop(e, r)
			}
		}
}, function(t, e, r) {
	"use strict";
	r.r(e);
	var n = {
			createBlob: function(t, e) {
				var r;
				try {
					r = new Blob(t, e)
				} catch (i) {
					if (window.BlobBuilder = window.BlobBuilder || window.WebKitBlobBuilder || window.MozBlobBuilder || window.MSBlobBuilder, "TypeError" == i.name && window.BlobBuilder) {
						var n = new BlobBuilder;
						n.append(t[0].buffer), r = n.getBlob(e.type || "image/png")
					} else {
						if ("InvalidStateError" != i.name) throw Error("Not Supported Blob Constructor!");
						r = new Blob([t[0].buffer], e)
					}
				}
				return r
			}
		},
		i = r(0),
		s = r.n(i),
		a = r(1);
	r.d(e, "EasyGif", function() {
		return o
	});
	var o = {
		fixCompatibility: function() {
			s.a.prototype.getContextData = function(t) {
				var e = t.getImageData(0, 0, this.options.width, this.options.height).data;
				return /CanvasPixelArray/.test(Object.prototype.toString.call(e)) && (e = o.toUint8Array(e)), e
			};
			var t = s.a.prototype.addFrame;
			s.a.prototype.addFrame = function() {
				var e = t.apply(this, arguments),
					r = this.frames[this.frames.length - 1];
				return r && r.data && /CanvasPixelArray/.test(Object.prototype.toString.call(r.data)) && (r.data = o.toUint8Array(r.data)), e
			};
			var e = s.a.prototype.finishRendering.toString();
			e = e.replace("new Blob", "createBlob"), s.a.prototype.finishRendering = new Function("createBlob", "return (" + e + ")")(n.createBlob)
		},
		toUint8Array: function(t) {
			return new Uint8Array(t)
		},
		frameToImageData: function(t, e) {
			for (var r = e.pixels.length, n = t.createImageData(e.dims.width, e.dims.height), i = n.data, s = 0; s < r; s++) {
				var a = 4 * s,
					o = e.pixels[s],
					h = e.colorTable[o];
				i[a] = h[0], i[a + 1] = h[1], i[a + 2] = h[2], i[a + 3] = o !== e.transparentIndex ? 255 : 0
			}
			return n
		},
		decoder: function(t) {
			return new a.GIFuctJS(t)
		},
		encoder: function(t) {
			return new s.a(t)
		}
	};
	o.fixCompatibility()
}, function(t, e, r) {
	"use strict";
	r.r(e);
	var n = r(3);
	r.d(e, "EasyGif", function() {
		return n.EasyGif
	});
	var i = r(2);
	r.d(e, "CropperjsGif", function() {
		return i.CropperjsGif
	})
}]));
//# sourceMappingURL=cropperjs-gif-all.js.map