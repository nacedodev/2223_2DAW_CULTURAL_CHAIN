!(function (t, e) {
  typeof exports === 'object' && typeof module !== 'undefined' ? e(exports) : typeof define === 'function' && define.amd ? define(['exports'], e) : e((t = t || self).window = t.window || {})
}(this, function (t) {
  'use strict'
  function m (t) {
    return typeof t === 'string'
  }
  const T = /[achlmqstvz]|(-?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi
  const S = /(?:(-)?\d*\.?\d*(?:e[\-+]?\d+)?)[0-9]/gi
  const b = /[\+\-]?\d*\.?\d+e[\+\-]?\d+/gi
  const r = /(^[#\.][a-z]|[a-y][a-z])/i
  const E = Math.PI / 180
  const H = Math.sin
  const B = Math.cos
  const D = Math.abs
  const Q = Math.sqrt
  const s = function _isNumber (t) {
    return typeof t === 'number'
  }
  const h = function _round (t) {
    return Math.round(1e5 * t) / 1e5 || 0
  }
  function reverseSegment (t) {
    let e; let n = 0
    for (t.reverse(); n < t.length; n += 2) {
      e = t[n],
      t[n] = t[n + 1],
      t[n + 1] = e
    }
    t.reversed = !t.reversed
  }
  const N = {
    rect: 'rx,ry,x,y,width,height',
    circle: 'r,cx,cy',
    ellipse: 'rx,ry,cx,cy',
    line: 'x1,x2,y1,y2'
  }
  function convertToPath (t, e) {
    let n; let r; let o; let a; let i; let s; let h; let l; let c; let g; let p; let f; let u; let d; let P; let m; let _; let v; let w; let y; let x; let M; const T = t.tagName.toLowerCase(); const b = 0.552284749831
    return T !== 'path' && t.getBBox
      ? (s = (function _createPath (t, e) {
          let n; const r = document.createElementNS('http://www.w3.org/2000/svg', 'path'); const o = [].slice.call(t.attributes); let a = o.length
          for (e = ',' + e + ','; --a > -1;) {
            n = o[a].nodeName.toLowerCase(),
            e.indexOf(',' + n + ',') < 0 && r.setAttributeNS(null, n, o[a].nodeValue)
          }
          return r
        }(t, 'x,y,width,height,cx,cy,rx,ry,r,x1,x2,y1,y2,points')),
        M = (function _attrToObj (t, e) {
          for (var n = e ? e.split(',') : [], r = {}, o = n.length; --o > -1;) { r[n[o]] = +t.getAttribute(n[o]) || 0 }
          return r
        }(t, N[T])),
        T === 'rect'
          ? (a = M.rx,
            i = M.ry || a,
            r = M.x,
            o = M.y,
            g = M.width - 2 * a,
            p = M.height - 2 * i,
            n = a || i ? 'M' + (m = (d = (u = r + a) + g) + a) + ',' + (v = o + i) + ' V' + (w = v + p) + ' C' + [m, y = w + i * b, P = d + a * b, x = w + i, d, x, d - (d - u) / 3, x, u + (d - u) / 3, x, u, x, f = r + a * (1 - b), x, r, y, r, w, r, w - (w - v) / 3, r, v + (w - v) / 3, r, v, r, _ = o + i * (1 - b), f, o, u, o, u + (d - u) / 3, o, d - (d - u) / 3, o, d, o, P, o, m, _, m, v].join(',') + 'z' : 'M' + (r + g) + ',' + o + ' v' + p + ' h' + -g + ' v' + -p + ' h' + g + 'z')
          : T === 'circle' || T === 'ellipse'
            ? (l = T === 'circle'
                ? (a = i = M.r) * b
                : (a = M.rx,
                  (i = M.ry) * b),
              n = 'M' + ((r = M.cx) + a) + ',' + (o = M.cy) + ' C' + [r + a, o + l, r + (h = a * b), o + i, r, o + i, r - h, o + i, r - a, o + l, r - a, o, r - a, o - l, r - h, o - i, r, o - i, r + h, o - i, r + a, o - l, r + a, o].join(',') + 'z')
            : T === 'line'
              ? n = 'M' + M.x1 + ',' + M.y1 + ' L' + M.x2 + ',' + M.y2
              : T !== 'polyline' && T !== 'polygon' || (n = 'M' + (r = (c = (t.getAttribute('points') + '').match(S) || []).shift()) + ',' + (o = c.shift()) + ' L' + c.join(','),
              T === 'polygon' && (n += ',' + r + ',' + o + 'z')),
        s.setAttribute('d', rawPathToString(s._gsRawPath = stringToRawPath(n))),
        e && t.parentNode && (t.parentNode.insertBefore(s, t),
        t.parentNode.removeChild(t)),
        s)
      : t
  }
  function arcToSegment (t, e, n, r, o, a, i, s, h) {
    if (t !== s || e !== h) {
      n = D(n),
      r = D(r)
      const l = o % 360 * E
      const c = B(l)
      const g = H(l)
      const p = Math.PI
      const f = 2 * p
      const u = (t - s) / 2
      const d = (e - h) / 2
      let P = c * u + g * d
      let m = -g * u + c * d
      const _ = P * P
      const v = m * m
      const w = _ / (n * n) + v / (r * r)
      w > 1 && (n = Q(w) * n,
      r = Q(w) * r)
      const y = n * n
      const x = r * r
      let M = (y * x - y * v - x * _) / (y * v + x * _)
      M < 0 && (M = 0)
      const T = (a === i ? -1 : 1) * Q(M)
      const b = n * m / r * T
      const S = -r * P / n * T
      const N = c * b - g * S + (t + s) / 2
      const z = g * b + c * S + (e + h) / 2
      let A = (P - b) / n
      let R = (m - S) / r
      const V = (-P - b) / n
      const O = (-m - S) / r
      const C = A * A + R * R
      let j = (R < 0 ? -1 : 1) * Math.acos(A / Q(C))
      let Y = (A * O - R * V < 0 ? -1 : 1) * Math.acos((A * V + R * O) / Q(C * (V * V + O * O)))
      isNaN(Y) && (Y = p),
      !i && Y > 0 ? Y -= f : i && Y < 0 && (Y += f),
      j %= f,
      Y %= f
      let I; const L = Math.ceil(D(Y) / (f / 4)); const W = []; const F = Y / L; const X = 4 / 3 * H(F / 2) / (1 + B(F / 2)); const G = c * n; const U = g * n; const k = g * -r; const q = c * r
      for (I = 0; I < L; I++) {
        P = B(o = j + I * F),
        m = H(o),
        A = B(o += F),
        R = H(o),
        W.push(P - X * m, m + X * P, A + X * R, R - X * A, A, R)
      }
      for (I = 0; I < W.length; I += 2) {
        P = W[I],
        m = W[I + 1],
        W[I] = P * G + m * k + N,
        W[I + 1] = P * U + m * q + z
      }
      return W[I - 2] = s,
      W[I - 1] = h,
      W
    }
  }
  function stringToRawPath (t) {
    function Ac (t, e, n, r) {
      c = (n - t) / 3,
      g = (r - e) / 3,
      s.push(t + c, e + g, n - c, r - g, n, r)
    }
    let e; let n; let r; let o; let a; let i; let s; let h; let l; let c; let g; let p; let f; let u; let d; const P = (t + '').replace(b, function (t) {
      const e = +t
      return e < 1e-4 && e > -1e-4 ? 0 : e
    }).match(T) || []; const m = []; let _ = 0; let v = 0; const w = P.length; let y = 0; const x = 'ERROR: malformed path: ' + t
    if (!t || !isNaN(P[0]) || isNaN(P[1])) {
      return console.log(x),
      m
    }
    for (e = 0; e < w; e++) {
      if (f = a,
      isNaN(P[e]) ? i = (a = P[e].toUpperCase()) !== P[e] : e--,
      r = +P[e + 1],
      o = +P[e + 2],
      i && (r += _,
      o += v),
      e || (h = r,
      l = o),
      a === 'M') {
        s && (s.length < 8 ? --m.length : y += s.length),
        _ = h = r,
        v = l = o,
        s = [r, o],
        m.push(s),
        e += 2,
        a = 'L'
      } else if (a === 'C') {
        i || (_ = v = 0),
        (s = s || [0, 0]).push(r, o, _ + 1 * P[e + 3], v + 1 * P[e + 4], _ += 1 * P[e + 5], v += 1 * P[e + 6]),
        e += 6
      } else if (a === 'S') {
        c = _,
        g = v,
        f !== 'C' && f !== 'S' || (c += _ - s[s.length - 4],
        g += v - s[s.length - 3]),
        i || (_ = v = 0),
        s.push(c, g, r, o, _ += 1 * P[e + 3], v += 1 * P[e + 4]),
        e += 4
      } else if (a === 'Q') {
        c = _ + 2 / 3 * (r - _),
        g = v + 2 / 3 * (o - v),
        i || (_ = v = 0),
        _ += 1 * P[e + 3],
        v += 1 * P[e + 4],
        s.push(c, g, _ + 2 / 3 * (r - _), v + 2 / 3 * (o - v), _, v),
        e += 4
      } else if (a === 'T') {
        c = _ - s[s.length - 4],
        g = v - s[s.length - 3],
        s.push(_ + c, v + g, r + 2 / 3 * (_ + 1.5 * c - r), o + 2 / 3 * (v + 1.5 * g - o), _ = r, v = o),
        e += 2
      } else if (a === 'H') {
        Ac(_, v, _ = r, v),
        e += 1
      } else if (a === 'V') {
        Ac(_, v, _, v = r + (i ? v - _ : 0)),
        e += 1
      } else if (a === 'L' || a === 'Z') {
        a === 'Z' && (r = h,
        o = l,
        s.closed = !0),
        (a === 'L' || D(_ - r) > 0.5 || D(v - o) > 0.5) && (Ac(_, v, r, o),
        a === 'L' && (e += 2)),
        _ = r,
        v = o
      } else if (a === 'A') {
        if (u = P[e + 4],
        d = P[e + 5],
        c = P[e + 6],
        g = P[e + 7],
        n = 7,
        u.length > 1 && (u.length < 3
          ? (g = c,
            c = d,
            n--)
          : (g = d,
            c = u.substr(2),
            n -= 2),
        d = u.charAt(1),
        u = u.charAt(0)),
        p = arcToSegment(_, v, +P[e + 1], +P[e + 2], +P[e + 3], +u, +d, (i ? _ : 0) + 1 * c, (i ? v : 0) + 1 * g),
        e += n,
        p) {
          for (n = 0; n < p.length; n++) { s.push(p[n]) }
        }
        _ = s[s.length - 2],
        v = s[s.length - 1]
      } else { console.log(x) }
    }
    return (e = s.length) < 6
      ? (m.pop(),
        e = 0)
      : s[0] === s[e - 2] && s[1] === s[e - 1] && (s.closed = !0),
    m.totalPoints = y + e,
    m
  }
  function rawPathToString (t) {
    s(t[0]) && (t = [t])
    let e; let n; let r; let o; let a = ''; const i = t.length
    for (n = 0; n < i; n++) {
      for (o = t[n],
      a += 'M' + h(o[0]) + ',' + h(o[1]) + ' C',
      e = o.length,
      r = 2; r < e; r++) { a += h(o[r++]) + ',' + h(o[r++]) + ' ' + h(o[r++]) + ',' + h(o[r++]) + ' ' + h(o[r++]) + ',' + h(o[r]) + ' ' }
      o.closed && (a += 'z')
    }
    return a
  }
  function y () {
    return a 
  }
  function z (t) {
    return typeof t === 'function'
  }
  function M (t) {
    return console && console.warn(t)
  }
  function P () {
    return String.fromCharCode.apply(null, arguments)
  }
  function U (t) {
    let e; const n = t.length; let r = 0; let o = 0
    for (e = 0; e < n; e++) {
      r += t[e++],
      o += t[e]
    }
    return [r / (n / 2), o / (n / 2)]
  }
  function V (t) {
    let e; let n; let r; const o = t.length; let a = t[0]; let i = a; let s = t[1]; let h = s
    for (r = 6; r < o; r += 6) {
      a < (e = t[r]) ? a = e : e < i && (i = e),
      s < (n = t[r + 1]) ? s = n : n < h && (h = n)
    }
    return t.centerX = (a + i) / 2,
    t.centerY = (s + h) / 2,
    t.size = (a - i) * (s - h)
  }
  function W (t, e) {
    void 0 === e && (e = 3)
    for (var n, r, o, a, i, s, h, l, c, g, p, f, u, d, P, m, _ = t.length, v = t[0][0], w = v, y = t[0][1], x = y, M = 1 / e; --_ > -1;) {
      for (n = (i = t[_]).length,
      a = 6; a < n; a += 6) {
        for (c = i[a],
        g = i[a + 1],
        p = i[a + 2] - c,
        d = i[a + 3] - g,
        f = i[a + 4] - c,
        P = i[a + 5] - g,
        u = i[a + 6] - c,
        m = i[a + 7] - g,
        s = e; --s > -1;) {
          v < (r = ((h = M * s) * h * u + 3 * (l = 1 - h) * (h * f + l * p)) * h + c) ? v = r : r < w && (w = r),
          y < (o = (h * h * m + 3 * l * (h * P + l * d)) * h + g) ? y = o : o < x && (x = o)
        }
      }
    }
    return t.centerX = (v + w) / 2,
    t.centerY = (y + x) / 2,
    t.left = w,
    t.width = v - w,
    t.top = x,
    t.height = y - x,
    t.size = (v - w) * (y - x)
  }
  function X (t, e) {
    return e.length - t.length
  }
  function Y (t, e) {
    const n = t.size || V(t)
    const r = e.size || V(e)
    return Math.abs(r - n) < (n + r) / 20 ? e.centerX - t.centerX || e.centerY - t.centerY : r - n
  }
  function Z (t, e) {
    let n; let r; const o = t.slice(0); const a = t.length; const i = a - 2
    for (e |= 0,
    n = 0; n < a; n++) {
      r = (n + e) % i,
      t[n++] = o[r],
      t[n] = o[1 + r]
    }
  }
  function $ (t, e, n, r, o) {
    let a; let i; let s; let h; const l = t.length; let c = 0; const g = l - 2
    for (n *= 6,
    i = 0; i < l; i += 6) {
      h = t[a = (i + n) % g] - (e[i] - r),
      s = t[1 + a] - (e[i + 1] - o),
      c += v(s * s + h * h)
    }
    return c
  }
  function _ (t, e, n) {
    let r; let o; let a; const i = t.length; const s = U(t); const h = U(e); const l = h[0] - s[0]; const c = h[1] - s[1]; let g = $(t, e, 0, l, c); let p = 0
    for (a = 6; a < i; a += 6) {
      (o = $(t, e, a / 6, l, c)) < g && (g = o,
      p = a)
    }
    if (n) {
      for (reverseSegment(r = t.slice(0)),
      a = 6; a < i; a += 6) {
        (o = $(r, e, a / 6, l, c)) < g && (g = o,
        p = -a)
      }
    }
    return p / 6
  }
  function aa (t, e, n) {
    for (var r, o, a, i, s, h, l = t.length, c = 1e20, g = 0, p = 0; --l > -1;) {
      for (h = (r = t[l]).length,
      s = 0; s < h; s += 6) {
        o = r[s] - e,
        a = r[s + 1] - n,
        (i = v(o * o + a * a)) < c && (c = i,
        g = r[s],
        p = r[s + 1])
      }
    }
    return [g, p]
  }
  function ba (t, e, n, r, o, a) {
    let i; let s; let h; let l; const c = e.length; let g = 0; const p = Math.min(t.size || V(t), e[n].size || V(e[n])) * r; let f = 1e20; const u = t.centerX + o; const d = t.centerY + a
    for (i = n; i < c && !((e[i].size || V(e[i])) < p); i++) {
      s = e[i].centerX - u,
      h = e[i].centerY - d,
      (l = v(s * s + h * h)) < f && (g = i,
      f = l)
    }
    return l = e[g],
    e.splice(g, 1),
    l
  }
  function ca (t, e) {
    let n; let r; let o; let a; let i; let s; let h; let l; let c; let g; let p; let f; let u; let d; let P = 0; let m = t.length; const _ = e / ((m - 2) / 6)
    for (u = 2; u < m; u += 6) {
      for (P += _; P > 0.999999;) {
        n = t[u - 2],
        r = t[u - 1],
        o = t[u],
        a = t[u + 1],
        i = t[u + 2],
        s = t[u + 3],
        h = t[u + 4],
        l = t[u + 5],
        c = n + (o - n) * (d = 1 / ((Math.floor(P) || 1) + 1)),
        c += ((p = o + (i - o) * d) - c) * d,
        p += (i + (h - i) * d - p) * d,
        g = r + (a - r) * d,
        g += ((f = a + (s - a) * d) - g) * d,
        f += (s + (l - s) * d - f) * d,
        t.splice(u, 4, n + (o - n) * d, r + (a - r) * d, c, g, c + (p - c) * d, g + (f - g) * d, p, f, i + (h - i) * d, s + (l - s) * d),
        u += 6,
        m += 6,
        P--
      }
    }
    return t
  }
  function da (t, e, n, r, o) {
    let a; let i; let s; let h; let l; let c; let g; let p = e.length - t.length; const f = p > 0 ? e : t; const u = p > 0 ? t : e; let d = 0; const P = r === 'complexity' ? X : Y; const m = r === 'position' ? 0 : typeof r === 'number' ? r : 0.8; let v = u.length; const w = typeof n === 'object' && n.push ? n.slice(0) : [n]; let y = w[0] === 'reverse' || w[0] < 0; const x = n === 'log'
    if (u[0]) {
      if (f.length > 1 && (t.sort(P),
      e.sort(P),
      f.size || W(f),
      u.size || W(u),
      c = f.centerX - u.centerX,
      g = f.centerY - u.centerY,
      P === Y)) {
        for (v = 0; v < u.length; v++) { f.splice(v, 0, ba(u[v], f, v, m, c, g)) }
      }
      if (p) {
        for (p < 0 && (p = -p),
        f[0].length > u[0].length && ca(u[0], (f[0].length - u[0].length) / 6 | 0),
        v = u.length; d < p;) {
          f[v].size || V(f[v]),
          h = (s = aa(u, f[v].centerX, f[v].centerY))[0],
          l = s[1],
          u[v++] = [h, l, h, l, h, l, h, l],
          u.totalPoints += 8,
          d++
        }
      }
      for (v = 0; v < t.length; v++) {
        a = e[v],
        i = t[v],
        (p = a.length - i.length) < 0 ? ca(a, -p / 6 | 0) : p > 0 && ca(i, p / 6 | 0),
        y && !1 !== o && !i.reversed && reverseSegment(i),
        (n = w[v] || w[v] === 0 ? w[v] : 'auto') && (i.closed || Math.abs(i[0] - i[i.length - 2]) < 0.5 && Math.abs(i[1] - i[i.length - 1]) < 0.5
          ? n === 'auto' || n === 'log'
            ? (w[v] = n = _(i, a, !v || !1 === o),
              n < 0 && (y = !0,
              reverseSegment(i),
              n = -n),
              Z(i, 6 * n))
            : n !== 'reverse' && (v && n < 0 && reverseSegment(i),
            Z(i, 6 * (n < 0 ? -n : n)))
          : !y && (n === 'auto' && Math.abs(a[0] - i[0]) + Math.abs(a[1] - i[1]) + Math.abs(a[a.length - 2] - i[i.length - 2]) + Math.abs(a[a.length - 1] - i[i.length - 1]) > Math.abs(a[0] - i[i.length - 2]) + Math.abs(a[1] - i[i.length - 1]) + Math.abs(a[a.length - 2] - i[0]) + Math.abs(a[a.length - 1] - i[1]) || n % 2)
              ? (reverseSegment(i),
                w[v] = -1,
                y = !0)
              : n === 'auto' ? w[v] = 0 : n === 'reverse' && (w[v] = -1),
        i.closed !== a.closed && (i.closed = a.closed = !1))
      }
      return x && M('shapeIndex:[' + w.join(',') + ']'),
      t.shapeIndex = w
    }
  }
  function ea (t, e, n, r, o) {
    const a = stringToRawPath(t[0])
    const i = stringToRawPath(t[1])
    da(a, i, e || e === 0 ? e : 'auto', n, o) && (t[0] = rawPathToString(a),
    t[1] = rawPathToString(i),
    r !== 'log' && !0 !== r || M('precompile:["' + t[0] + '","' + t[1] + '"]'))
  }
  function ga (t, e) {
    let n; let r; let o; let a; let i; let s; let h; let l = 0; let c = parseFloat(t[0]); let g = parseFloat(t[1]); let p = c + ',' + g + ' '
    for (n = 0.5 * e / (0.5 * (o = t.length) - 1),
    r = 0; r < o - 2; r += 2) {
      if (l += n,
      s = parseFloat(t[r + 2]),
      h = parseFloat(t[r + 3]),
      l > 0.999999) {
        for (i = 1 / (Math.floor(l) + 1),
        a = 1; l > 0.999999;) {
          p += (c + (s - c) * i * a).toFixed(2) + ',' + (g + (h - g) * i * a).toFixed(2) + ' ',
          l--,
          a++
        }
      }
      p += s + ',' + h + ' ',
      c = s,
      g = h
    }
    return p
  }
  function ha (t) {
    const e = t[0].match(L) || []
    const n = t[1].match(L) || []
    const r = n.length - e.length
    r > 0 ? t[0] = ga(e, r) : t[1] = ga(n, -r)
  }
  function ia (e) {
    return isNaN(e)
      ? ha
      : function (t) {
        ha(t),
        t[1] = (function _offsetPoints (t, e) {
          if (!e) { return t }
          let n; let r; let o; const a = t.match(L) || []; const i = a.length; let s = ''
          for (n = e === 'reverse'
            ? (r = i - 1,
              -2)
            : (r = (2 * (parseInt(e, 10) || 0) + 1 + 100 * i) % i,
              2),
          o = 0; o < i; o += 2) {
            s += a[r - 1] + ',' + a[r] + ' ',
            r = (r + n) % i
          }
          return s
        }(t[1], parseInt(e, 10)))
      }
  }
  function ka (t, e) {
    for (var n, r, o, a, i, s, h, l, c, g, p, f, u = t.length, d = 0.2 * (e || 1); --u > -1;) {
      for (p = (r = t[u]).isSmooth = r.isSmooth || [0, 0, 0, 0],
      f = r.smoothData = r.smoothData || [0, 0, 0, 0],
      p.length = 4,
      l = r.length - 2,
      h = 6; h < l; h += 6) {
        o = r[h] - r[h - 2],
        a = r[h + 1] - r[h - 1],
        i = r[h + 2] - r[h],
        s = r[h + 3] - r[h + 1],
        c = w(a, o),
        g = w(s, i),
        (n = Math.abs(c - g) < d) && (f[h - 2] = c,
        f[h + 2] = g,
        f[h - 1] = v(o * o + a * a),
        f[h + 3] = v(i * i + s * s)),
        p.push(n, n, 0, 0, n, n)
      }
      r[l] === r[0] && r[1 + l] === r[1] && (o = r[0] - r[l - 2],
      a = r[1] - r[l - 1],
      i = r[2] - r[0],
      s = r[3] - r[1],
      c = w(a, o),
      g = w(s, i),
      Math.abs(c - g) < d && (f[l - 2] = c,
      f[2] = g,
      f[l - 1] = v(o * o + a * a),
      f[3] = v(i * i + s * s),
      p[l - 2] = p[l - 1] = !0))
    }
    return t
  }
  function la (t) {
    const e = t.trim().split(' ')
    return {
      x: (~t.indexOf('left') ? 0 : ~t.indexOf('right') ? 100 : isNaN(parseFloat(e[0])) ? 50 : parseFloat(e[0])) / 100,
      y: (~t.indexOf('top') ? 0 : ~t.indexOf('bottom') ? 100 : isNaN(parseFloat(e[1])) ? 50 : parseFloat(e[1])) / 100
    }
  }
  function oa (t, e, n, r) {
    let o; let a; const i = this._origin; const s = this._eOrigin; let h = t[n] - i.x; let l = t[n + 1] - i.y; const c = v(h * h + l * l); const g = w(l, h)
    return h = e[n] - s.x,
    l = e[n + 1] - s.y,
    a = (function _shortAngle (t) {
      return t !== t % p ? t + (t < 0 ? f : -f) : t
    }(o = w(l, h) - g)),
    !r && j && Math.abs(a + j.ca) < u && (r = j),
    this._anchorPT = j = {
      _next: this._anchorPT,
      t,
      sa: g,
      ca: r && a * r.ca < 0 && Math.abs(a) > d ? o : a,
      sl: c,
      cl: v(h * h + l * l) - c,
      i: n
    }
  }
  function pa (t) {
    a = y(),
    n = n || a && a.plugins.morphSVG,
    a && n
      ? (C = a.utils.toArray,
        n.prototype._tweenRotation = oa,
        I = 1)
      : t && M('Please gsap.registerPlugin(MorphSVGPlugin)')
  }
  let a; let C; let j; let I; let n; var w = Math.atan2; const x = Math.cos; const A = Math.sin; var v = Math.sqrt; var p = Math.PI; var f = 2 * p; var u = 0.3 * p; var d = 0.7 * p; var L = /[-+=\.]*\d+[\.e\-\+]*\d*[e\-\+]*\d*/gi; const F = /(^[#\.][a-z]|[a-y][a-z])/i; const G = /[achlmqstvz]/i; const i = 'MorphSVGPlugin'; const l = P(103, 114, 101, 101, 110, 115, 111, 99, 107, 46, 99, 111, 109); const c = P(103, 115, 97, 112, 46, 99, 111, 109); const g = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}:?\d*$/; const k = (function (t) {
    const e = typeof window !== 'undefined'
    const n = (e ? window.location.href : '').indexOf(P(102, 105, 108, 101, 58, 47, 47)) === 0 || t.indexOf(P(108, 111, 99, 97, 108, 104, 111, 115, 116)) !== -1 || g.test(t)
    const r = [l, c, P(99, 111, 100, 101, 112, 101, 110, 46, 105, 111), P(99, 111, 100, 101, 112, 101, 110, 46, 112, 108, 117, 109, 98, 105, 110, 103), P(99, 111, 100, 101, 112, 101, 110, 46, 100, 101, 118), P(99, 111, 100, 101, 112, 101, 110, 46, 97, 112, 112), P(99, 111, 100, 101, 112, 101, 110, 46, 119, 101, 98, 115, 105, 116, 101), P(112, 101, 110, 115, 46, 99, 108, 111, 117, 100), P(99, 115, 115, 45, 116, 114, 105, 99, 107, 115, 46, 99, 111, 109), P(99, 100, 112, 110, 46, 105, 111), P(112, 101, 110, 115, 46, 105, 111), P(103, 97, 110, 110, 111, 110, 46, 116, 118), P(99, 111, 100, 101, 99, 97, 110, 121, 111, 110, 46, 110, 101, 116), P(116, 104, 101, 109, 101, 102, 111, 114, 101, 115, 116, 46, 110, 101, 116), P(99, 101, 114, 101, 98, 114, 97, 120, 46, 99, 111, 46, 117, 107), P(116, 121, 109, 112, 97, 110, 117, 115, 46, 110, 101, 116), P(116, 119, 101, 101, 110, 109, 97, 120, 46, 99, 111, 109), P(112, 108, 110, 107, 114, 46, 99, 111), P(104, 111, 116, 106, 97, 114, 46, 99, 111, 109), P(119, 101, 98, 112, 97, 99, 107, 98, 105, 110, 46, 99, 111, 109), P(97, 114, 99, 104, 105, 118, 101, 46, 111, 114, 103), P(99, 111, 100, 101, 115, 97, 110, 100, 98, 111, 120, 46, 105, 111), P(99, 115, 98, 46, 97, 112, 112), P(115, 116, 97, 99, 107, 98, 108, 105, 116, 122, 46, 99, 111, 109), P(115, 116, 97, 99, 107, 98, 108, 105, 116, 122, 46, 105, 111), P(99, 111, 100, 105, 101, 114, 46, 105, 111), P(109, 111, 116, 105, 111, 110, 116, 114, 105, 99, 107, 115, 46, 99, 111, 109), P(115, 116, 97, 99, 107, 111, 118, 101, 114, 102, 108, 111, 119, 46, 99, 111, 109), P(115, 116, 97, 99, 107, 101, 120, 99, 104, 97, 110, 103, 101, 46, 99, 111, 109), P(115, 116, 117, 100, 105, 111, 102, 114, 101, 105, 103, 104, 116, 46, 99, 111, 109), P(119, 101, 98, 99, 111, 110, 116, 97, 105, 110, 101, 114, 46, 105, 111), P(106, 115, 102, 105, 100, 100, 108, 101, 46, 110, 101, 116)]
    const o = r.length
    return n 
  }); const q = 'Use MorphSVGPlugin.convertToPath() to convert to a path before morphing.'; var J = {
    version: '3.12.3',
    name: 'morphSVG',
    rawVars: 1,
    register: function register (t, e) {
      a = t,
      n = e,
      pa()
    },
    init: function init (t, e, n, r, o) {
      if (I || pa(1),
      !e) {
        return M('invalid shape'),
        !1
      }
      let a, i, s, h, l, c, g, p, f, u, d, P, m, _, v, w, y, x, T, b, S, N
      if (z(e) && (e = e.call(n, r, t, o)),
      typeof e === 'string' || e.getBBox || e[0]) {
        e = {
          shape: e
        }
      } else if (typeof e === 'object') {
        for (i in a = {},
        e) { a[i] = z(e[i]) && i !== 'render' ? e[i].call(n, r, t, o) : e[i] }
        e = a
      }
      const A = t.nodeType ? window.getComputedStyle(t) : {}
      const R = A.fill + ''
      const V = !(R === 'none' || (R.match(L) || [])[3] === '0' || A.fillRule === 'evenodd')
      const O = (e.origin || '50 50').split(',')
      if (l = (a = (t.nodeName + '').toUpperCase()) === 'POLYLINE' || a === 'POLYGON',
      a !== 'PATH' && !l && !e.prop) {
        return M('Cannot morph a <' + a + '> element. ' + q),
        !1
      }
      if (i = a === 'PATH' ? 'd' : 'points',
      !e.prop && !z(t.setAttribute)) { return !1 }
      if (h = (function _parseShape (t, e, n) {
        let r, o
        return (!(typeof t === 'string') || F.test(t) || (t.match(L) || []).length < 3) && ((r = C(t)[0])
          ? (o = (r.nodeName + '').toUpperCase(),
            e && o !== 'PATH' && (r = convertToPath(r, !1),
            o = 'PATH'),
            t = r.getAttribute(o === 'PATH' ? 'd' : 'points') || '',
            r === n && (t = r.getAttributeNS(null, 'data-original') || t))
          : (M('WARNING: invalid morph to: ' + t),
            t = !1)),
        t
      }(e.shape || e.d || e.points || '', i === 'd', t)),
      l && G.test(h)) {
        return M('A <' + a + '> cannot accept path data. ' + q),
        !1
      }
      if (c = e.shapeIndex || e.shapeIndex === 0 ? e.shapeIndex : 'auto',
      g = e.map || J.defaultMap,
      this._prop = e.prop,
      this._render = e.render || J.defaultRender,
      this._apply = 'updateTarget' in e ? e.updateTarget : J.defaultUpdateTarget,
      this._rnd = Math.pow(10, isNaN(e.precision) ? 2 : +e.precision),
      this._tween = n,
      h) {
        if (this._target = t,
        y = typeof e.precompile === 'object',
        u = this._prop ? t[this._prop] : t.getAttribute(i),
        this._prop || t.getAttributeNS(null, 'data-original') || t.setAttributeNS(null, 'data-original', u),
        i === 'd' || this._prop) {
          if (u = stringToRawPath(y ? e.precompile[0] : u),
          d = stringToRawPath(y ? e.precompile[1] : h),
          !y && !da(u, d, c, g, V)) { return !1 }
          for (e.precompile !== 'log' && !0 !== e.precompile || M('precompile:["' + rawPathToString(u) + '","' + rawPathToString(d) + '"]'),
          (S = (e.type || J.defaultType) !== 'linear') && (u = ka(u, e.smoothTolerance),
          d = ka(d, e.smoothTolerance),
          u.size || W(u),
          d.size || W(d),
          b = la(O[0]),
          this._origin = u.origin = {
            x: u.left + b.x * u.width,
            y: u.top + b.y * u.height
          },
          O[1] && (b = la(O[1])),
          this._eOrigin = {
            x: d.left + b.x * d.width,
            y: d.top + b.y * d.height
          }),
          this._rawPath = t._gsRawPath = u,
          m = u.length; --m > -1;) {
            for (v = u[m],
            w = d[m],
            p = v.isSmooth || [],
            f = w.isSmooth || [],
            _ = v.length,
            P = j = 0; P < _; P += 2) {
              w[P] === v[P] && w[P + 1] === v[P + 1] || (S
                ? p[P] && f[P]
                  ? (x = v.smoothData,
                    T = w.smoothData,
                    N = P + (P === _ - 4 ? 7 - _ : 5),
                    this._controlPT = {
                      _next: this._controlPT,
                      i: P,
                      j: m,
                      l1s: x[P + 1],
                      l1c: T[P + 1] - x[P + 1],
                      l2s: x[N],
                      l2c: T[N] - x[N]
                    },
                    s = this._tweenRotation(v, w, P + 2),
                    this._tweenRotation(v, w, P, s),
                    this._tweenRotation(v, w, N - 1, s),
                    P += 4)
                  : this._tweenRotation(v, w, P)
                : (s = this.add(v, P, v[P], w[P], 0, 0, 0, 0, 0, 1),
                  s = this.add(v, P + 1, v[P + 1], w[P + 1], 0, 0, 0, 0, 0, 1) || s))
            }
          }
        } else { s = this.add(t, 'setAttribute', t.getAttribute(i) + '', h + '', r, o, 0, ia(c), i) }
        S && (this.add(this._origin, 'x', this._origin.x, this._eOrigin.x, 0, 0, 0, 0, 0, 1),
        s = this.add(this._origin, 'y', this._origin.y, this._eOrigin.y, 0, 0, 0, 0, 0, 1)),
        s && (this._props.push('morphSVG'),
        s.end = h,
        s.endProp = i)
      }
      return k
    },
    render: function render (t, e) {
      for (var n, r, o, a, i, s, h, l, c, g, p, f, u = e._rawPath, d = e._controlPT, P = e._anchorPT, m = e._rnd, _ = e._target, v = e._pt; v;) {
        v.r(t, v.d),
        v = v._next
      }
      if (t === 1 && e._apply) {
        for (v = e._pt; v;) {
          v.end && (e._prop ? _[e._prop] = v.end : _.setAttribute(v.endProp, v.end)),
          v = v._next
        }
      } else if (u) {
        for (; P;) {
          i = P.sa + t * P.ca,
          a = P.sl + t * P.cl,
          P.t[P.i] = e._origin.x + x(i) * a,
          P.t[P.i + 1] = e._origin.y + A(i) * a,
          P = P._next
        }
        for (r = t < 0.5 ? 2 * t * t : (4 - 2 * t) * t - 1; d;) {
          f = (s = d.i) + (s === (o = u[d.j]).length - 4 ? 7 - o.length : 5),
          i = w(o[f] - o[s + 1], o[f - 1] - o[s]),
          g = A(i),
          p = x(i),
          l = o[s + 2],
          c = o[s + 3],
          a = d.l1s + r * d.l1c,
          o[s] = l - p * a,
          o[s + 1] = c - g * a,
          a = d.l2s + r * d.l2c,
          o[f - 1] = l + p * a,
          o[f] = c + g * a,
          d = d._next
        }
        if (_._gsRawPath = u,
        e._apply) {
          for (n = '',
          h = 0; h < u.length; h++) {
            for (a = (o = u[h]).length,
            n += 'M' + (o[0] * m | 0) / m + ' ' + (o[1] * m | 0) / m + ' C',
            s = 2; s < a; s++) { n += (o[s] * m | 0) / m + ' ' }
          }
          e._prop ? _[e._prop] = n : _.setAttribute('d', n)
        }
      }
      e._render && u && e._render.call(e._tween, u, _)
    },
    kill: function kill () {
      this._pt = this._rawPath = 0
    },
    getRawPath: function getRawPath (t) {
      let e; const n = (t = m(t) && r.test(t) && document.querySelector(t) || t).getAttribute ? t : 0
      return n && (t = t.getAttribute('d'))
        ? (n._gsPath || (n._gsPath = {}),
          (e = n._gsPath[t]) && !e._dirty ? e : n._gsPath[t] = stringToRawPath(t))
        : t ? m(t) ? stringToRawPath(t) : s(t[0]) ? [t] : t : console.warn('Expecting a <path> element or an SVG path data string')
    },
    stringToRawPath,
    rawPathToString,
    normalizeStrings: function normalizeStrings (t, e, n) {
      const r = n.shapeIndex
      const o = n.map
      const a = [t, e]
      return ea(a, r, o),
      a
    },
    pathFilter: ea,
    pointsFilter: ha,
    getTotalSize: W,
    equalizeSegmentQuantity: da,
    convertToPath: function convertToPath$1 (t, e) {
      return C(t).map(function (t) {
        return convertToPath(t, !1 !== e)
      })
    },
    defaultType: 'linear',
    defaultUpdateTarget: !0,
    defaultMap: 'size'
  }
  y() && a.registerPlugin(J),
  t.MorphSVGPlugin = J,
  t.default = J

    delete t.default
}))
