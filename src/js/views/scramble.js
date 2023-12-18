!(function (D, u) {
  typeof exports === 'object' && typeof module !== 'undefined' ? u(exports) : typeof define === 'function' && define.amd ? define(['exports'], u) : u((D = D || self).window = D.window || {})
}(this, function (D) {
  'use strict'
  const r = /(?:^\s+|\s+$)/g
  const o = /([\uD800-\uDBFF][\uDC00-\uDFFF](?:[\u200D\uFE0F][\uD800-\uDBFF][\uDC00-\uDFFF]){2,}|\uD83D\uDC69(?:\u200D(?:(?:\uD83D\uDC69\u200D)?\uD83D\uDC67|(?:\uD83D\uDC69\u200D)?\uD83D\uDC66)|\uD83C[\uDFFB-\uDFFF])|\uD83D\uDC69\u200D(?:\uD83D\uDC69\u200D)?\uD83D\uDC66\u200D\uD83D\uDC66|\uD83D\uDC69\u200D(?:\uD83D\uDC69\u200D)?\uD83D\uDC67\u200D(?:\uD83D[\uDC66\uDC67])|\uD83C\uDFF3\uFE0F\u200D\uD83C\uDF08|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3D\uDD3E\uDDD6-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2640\u2642]\uFE0F|\uD83D\uDC69(?:\uD83C[\uDFFB-\uDFFF])\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92])|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC6F\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3C-\uDD3E\uDDD6-\uDDDF])\u200D[\u2640\u2642]\uFE0F|\uD83C\uDDFD\uD83C\uDDF0|\uD83C\uDDF6\uD83C\uDDE6|\uD83C\uDDF4\uD83C\uDDF2|\uD83C\uDDE9(?:\uD83C[\uDDEA\uDDEC\uDDEF\uDDF0\uDDF2\uDDF4\uDDFF])|\uD83C\uDDF7(?:\uD83C[\uDDEA\uDDF4\uDDF8\uDDFA\uDDFC])|\uD83C\uDDE8(?:\uD83C[\uDDE6\uDDE8\uDDE9\uDDEB-\uDDEE\uDDF0-\uDDF5\uDDF7\uDDFA-\uDDFF])|(?:\u26F9|\uD83C[\uDFCB\uDFCC]|\uD83D\uDD75)(?:\uFE0F\u200D[\u2640\u2642]|(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2640\u2642])\uFE0F|(?:\uD83D\uDC41\uFE0F\u200D\uD83D\uDDE8|\uD83D\uDC69(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2695\u2696\u2708]|\uD83D\uDC69\u200D[\u2695\u2696\u2708]|\uD83D\uDC68(?:(?:\uD83C[\uDFFB-\uDFFF])\u200D[\u2695\u2696\u2708]|\u200D[\u2695\u2696\u2708]))\uFE0F|\uD83C\uDDF2(?:\uD83C[\uDDE6\uDDE8-\uDDED\uDDF0-\uDDFF])|\uD83D\uDC69\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92]|\u2764\uFE0F\u200D(?:\uD83D\uDC8B\u200D(?:\uD83D[\uDC68\uDC69])|\uD83D[\uDC68\uDC69]))|\uD83C\uDDF1(?:\uD83C[\uDDE6-\uDDE8\uDDEE\uDDF0\uDDF7-\uDDFB\uDDFE])|\uD83C\uDDEF(?:\uD83C[\uDDEA\uDDF2\uDDF4\uDDF5])|\uD83C\uDDED(?:\uD83C[\uDDF0\uDDF2\uDDF3\uDDF7\uDDF9\uDDFA])|\uD83C\uDDEB(?:\uD83C[\uDDEE-\uDDF0\uDDF2\uDDF4\uDDF7])|[#\*0-9]\uFE0F\u20E3|\uD83C\uDDE7(?:\uD83C[\uDDE6\uDDE7\uDDE9-\uDDEF\uDDF1-\uDDF4\uDDF6-\uDDF9\uDDFB\uDDFC\uDDFE\uDDFF])|\uD83C\uDDE6(?:\uD83C[\uDDE8-\uDDEC\uDDEE\uDDF1\uDDF2\uDDF4\uDDF6-\uDDFA\uDDFC\uDDFD\uDDFF])|\uD83C\uDDFF(?:\uD83C[\uDDE6\uDDF2\uDDFC])|\uD83C\uDDF5(?:\uD83C[\uDDE6\uDDEA-\uDDED\uDDF0-\uDDF3\uDDF7-\uDDF9\uDDFC\uDDFE])|\uD83C\uDDFB(?:\uD83C[\uDDE6\uDDE8\uDDEA\uDDEC\uDDEE\uDDF3\uDDFA])|\uD83C\uDDF3(?:\uD83C[\uDDE6\uDDE8\uDDEA-\uDDEC\uDDEE\uDDF1\uDDF4\uDDF5\uDDF7\uDDFA\uDDFF])|\uD83C\uDFF4\uDB40\uDC67\uDB40\uDC62(?:\uDB40\uDC77\uDB40\uDC6C\uDB40\uDC73|\uDB40\uDC73\uDB40\uDC63\uDB40\uDC74|\uDB40\uDC65\uDB40\uDC6E\uDB40\uDC67)\uDB40\uDC7F|\uD83D\uDC68(?:\u200D(?:\u2764\uFE0F\u200D(?:\uD83D\uDC8B\u200D)?\uD83D\uDC68|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC66\u200D\uD83D\uDC66|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC67\u200D(?:\uD83D[\uDC66\uDC67])|\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92])|(?:\uD83C[\uDFFB-\uDFFF])\u200D(?:\uD83C[\uDF3E\uDF73\uDF93\uDFA4\uDFA8\uDFEB\uDFED]|\uD83D[\uDCBB\uDCBC\uDD27\uDD2C\uDE80\uDE92]))|\uD83C\uDDF8(?:\uD83C[\uDDE6-\uDDEA\uDDEC-\uDDF4\uDDF7-\uDDF9\uDDFB\uDDFD-\uDDFF])|\uD83C\uDDF0(?:\uD83C[\uDDEA\uDDEC-\uDDEE\uDDF2\uDDF3\uDDF5\uDDF7\uDDFC\uDDFE\uDDFF])|\uD83C\uDDFE(?:\uD83C[\uDDEA\uDDF9])|\uD83C\uDDEE(?:\uD83C[\uDDE8-\uDDEA\uDDF1-\uDDF4\uDDF6-\uDDF9])|\uD83C\uDDF9(?:\uD83C[\uDDE6\uDDE8\uDDE9\uDDEB-\uDDED\uDDEF-\uDDF4\uDDF7\uDDF9\uDDFB\uDDFC\uDDFF])|\uD83C\uDDEC(?:\uD83C[\uDDE6\uDDE7\uDDE9-\uDDEE\uDDF1-\uDDF3\uDDF5-\uDDFA\uDDFC\uDDFE])|\uD83C\uDDFA(?:\uD83C[\uDDE6\uDDEC\uDDF2\uDDF3\uDDF8\uDDFE\uDDFF])|\uD83C\uDDEA(?:\uD83C[\uDDE6\uDDE8\uDDEA\uDDEC\uDDED\uDDF7-\uDDFA])|\uD83C\uDDFC(?:\uD83C[\uDDEB\uDDF8])|(?:\u26F9|\uD83C[\uDFCB\uDFCC]|\uD83D\uDD75)(?:\uD83C[\uDFFB-\uDFFF])|(?:\uD83C[\uDFC3\uDFC4\uDFCA]|\uD83D[\uDC6E\uDC71\uDC73\uDC77\uDC81\uDC82\uDC86\uDC87\uDE45-\uDE47\uDE4B\uDE4D\uDE4E\uDEA3\uDEB4-\uDEB6]|\uD83E[\uDD26\uDD37-\uDD39\uDD3D\uDD3E\uDDD6-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])|(?:[\u261D\u270A-\u270D]|\uD83C[\uDF85\uDFC2\uDFC7]|\uD83D[\uDC42\uDC43\uDC46-\uDC50\uDC66\uDC67\uDC70\uDC72\uDC74-\uDC76\uDC78\uDC7C\uDC83\uDC85\uDCAA\uDD74\uDD7A\uDD90\uDD95\uDD96\uDE4C\uDE4F\uDEC0\uDECC]|\uD83E[\uDD18-\uDD1C\uDD1E\uDD1F\uDD30-\uDD36\uDDD1-\uDDD5])(?:\uD83C[\uDFFB-\uDFFF])|\uD83D\uDC68(?:\u200D(?:(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC67|(?:(?:\uD83D[\uDC68\uDC69])\u200D)?\uD83D\uDC66)|\uD83C[\uDFFB-\uDFFF])|(?:[\u261D\u26F9\u270A-\u270D]|\uD83C[\uDF85\uDFC2-\uDFC4\uDFC7\uDFCA-\uDFCC]|\uD83D[\uDC42\uDC43\uDC46-\uDC50\uDC66-\uDC69\uDC6E\uDC70-\uDC78\uDC7C\uDC81-\uDC83\uDC85-\uDC87\uDCAA\uDD74\uDD75\uDD7A\uDD90\uDD95\uDD96\uDE45-\uDE47\uDE4B-\uDE4F\uDEA3\uDEB4-\uDEB6\uDEC0\uDECC]|\uD83E[\uDD18-\uDD1C\uDD1E\uDD1F\uDD26\uDD30-\uDD39\uDD3D\uDD3E\uDDD1-\uDDDD])(?:\uD83C[\uDFFB-\uDFFF])?|(?:[\u231A\u231B\u23E9-\u23EC\u23F0\u23F3\u25FD\u25FE\u2614\u2615\u2648-\u2653\u267F\u2693\u26A1\u26AA\u26AB\u26BD\u26BE\u26C4\u26C5\u26CE\u26D4\u26EA\u26F2\u26F3\u26F5\u26FA\u26FD\u2705\u270A\u270B\u2728\u274C\u274E\u2753-\u2755\u2757\u2795-\u2797\u27B0\u27BF\u2B1B\u2B1C\u2B50\u2B55]|\uD83C[\uDC04\uDCCF\uDD8E\uDD91-\uDD9A\uDDE6-\uDDFF\uDE01\uDE1A\uDE2F\uDE32-\uDE36\uDE38-\uDE3A\uDE50\uDE51\uDF00-\uDF20\uDF2D-\uDF35\uDF37-\uDF7C\uDF7E-\uDF93\uDFA0-\uDFCA\uDFCF-\uDFD3\uDFE0-\uDFF0\uDFF4\uDFF8-\uDFFF]|\uD83D[\uDC00-\uDC3E\uDC40\uDC42-\uDCFC\uDCFF-\uDD3D\uDD4B-\uDD4E\uDD50-\uDD67\uDD7A\uDD95\uDD96\uDDA4\uDDFB-\uDE4F\uDE80-\uDEC5\uDECC\uDED0-\uDED2\uDEEB\uDEEC\uDEF4-\uDEF8]|\uD83E[\uDD10-\uDD3A\uDD3C-\uDD3E\uDD40-\uDD45\uDD47-\uDD4C\uDD50-\uDD6B\uDD80-\uDD97\uDDC0\uDDD0-\uDDE6])|(?:[#\*0-9\xA9\xAE\u203C\u2049\u2122\u2139\u2194-\u2199\u21A9\u21AA\u231A\u231B\u2328\u23CF\u23E9-\u23F3\u23F8-\u23FA\u24C2\u25AA\u25AB\u25B6\u25C0\u25FB-\u25FE\u2600-\u2604\u260E\u2611\u2614\u2615\u2618\u261D\u2620\u2622\u2623\u2626\u262A\u262E\u262F\u2638-\u263A\u2640\u2642\u2648-\u2653\u2660\u2663\u2665\u2666\u2668\u267B\u267F\u2692-\u2697\u2699\u269B\u269C\u26A0\u26A1\u26AA\u26AB\u26B0\u26B1\u26BD\u26BE\u26C4\u26C5\u26C8\u26CE\u26CF\u26D1\u26D3\u26D4\u26E9\u26EA\u26F0-\u26F5\u26F7-\u26FA\u26FD\u2702\u2705\u2708-\u270D\u270F\u2712\u2714\u2716\u271D\u2721\u2728\u2733\u2734\u2744\u2747\u274C\u274E\u2753-\u2755\u2757\u2763\u2764\u2795-\u2797\u27A1\u27B0\u27BF\u2934\u2935\u2B05-\u2B07\u2B1B\u2B1C\u2B50\u2B55\u3030\u303D\u3297\u3299]|\uD83C[\uDC04\uDCCF\uDD70\uDD71\uDD7E\uDD7F\uDD8E\uDD91-\uDD9A\uDDE6-\uDDFF\uDE01\uDE02\uDE1A\uDE2F\uDE32-\uDE3A\uDE50\uDE51\uDF00-\uDF21\uDF24-\uDF93\uDF96\uDF97\uDF99-\uDF9B\uDF9E-\uDFF0\uDFF3-\uDFF5\uDFF7-\uDFFF]|\uD83D[\uDC00-\uDCFD\uDCFF-\uDD3D\uDD49-\uDD4E\uDD50-\uDD67\uDD6F\uDD70\uDD73-\uDD7A\uDD87\uDD8A-\uDD8D\uDD90\uDD95\uDD96\uDDA4\uDDA5\uDDA8\uDDB1\uDDB2\uDDBC\uDDC2-\uDDC4\uDDD1-\uDDD3\uDDDC-\uDDDE\uDDE1\uDDE3\uDDE8\uDDEF\uDDF3\uDDFA-\uDE4F\uDE80-\uDEC5\uDECB-\uDED2\uDEE0-\uDEE5\uDEE9\uDEEB\uDEEC\uDEF0\uDEF3-\uDEF8]|\uD83E[\uDD10-\uDD3A\uDD3C-\uDD3E\uDD40-\uDD45\uDD47-\uDD4C\uDD50-\uDD6B\uDD80-\uDD97\uDDC0\uDDD0-\uDDE6])\uFE0F)/
  function getText (D) {
    const u = D.nodeType
    let F = ''
    if (u === 1 || u === 9 || u === 11) {
      if (typeof D.textContent === 'string') { return D.textContent }
      for (D = D.firstChild; D; D = D.nextSibling) { F += getText(D) }
    } else if (u === 3 || u === 4) { return D.nodeValue }
    return F
  }
  function emojiSafeSplit (D, u, F, C) {
    if (D += '',
    F && (D = D.trim ? D.trim() : D.replace(r, '')),
    u && u !== '') { return D.replace(/>/g, '&gt;').replace(/</g, '&lt;').split(u) }
    for (var e, E, t = [], n = D.length, i = 0; i < n; i++) {
      ((E = D.charAt(i)).charCodeAt(0) >= 55296 && E.charCodeAt(0) <= 56319 || D.charCodeAt(i + 1) >= 65024 && D.charCodeAt(i + 1) <= 65039) && (e = ((D.substr(i, 12).split(o) || [])[1] || '').length || 2,
      E = D.substr(i, e),
      i += e - (t.emoji = 1)),
      t.push(E === '>' ? '&gt;' : E === '<' ? '&lt;' : !C || E !== ' ' || D.charAt(i - 1) !== ' ' && D.charAt(i + 1) !== ' ' ? E : '&nbsp;')
    }
    return t
  }
  const a = (CharSet.prototype.grow = function grow (D) {
    for (let u = 0; u < 20; u++) { this.sets[u] += F(D - this.length, this.chars) }
    this.length = D
  }
  ,
  CharSet)
  function CharSet (D) {
    this.chars = emojiSafeSplit(D),
    this.sets = [],
    this.length = 50
    for (let u = 0; u < 20; u++) { this.sets[u] = F(80, this.chars) }
  }
  function i () {
    return E 
  }
  function l () {
    return String.fromCharCode.apply(null, arguments)
  }
  function v () {
    s = E = i()
  }
  let E; let s; const t = 'ScrambleTextPlugin'; const n = l(103, 114, 101, 101, 110, 115, 111, 99, 107, 46, 99, 111, 109); const B = l(103, 115, 97, 112, 46, 99, 111, 109); const A = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}:?\d*$/; const h = (function (D) {
    const u = typeof window !== 'undefined'
    const F = (u ? window.location.href : '').indexOf(l(102, 105, 108, 101, 58, 47, 47)) === 0 || D.indexOf(l(108, 111, 99, 97, 108, 104, 111, 115, 116)) !== -1 || A.test(D)
    const C = [n, B, l(99, 111, 100, 101, 112, 101, 110, 46, 105, 111), l(99, 111, 100, 101, 112, 101, 110, 46, 112, 108, 117, 109, 98, 105, 110, 103), l(99, 111, 100, 101, 112, 101, 110, 46, 100, 101, 118), l(99, 111, 100, 101, 112, 101, 110, 46, 97, 112, 112), l(99, 111, 100, 101, 112, 101, 110, 46, 119, 101, 98, 115, 105, 116, 101), l(112, 101, 110, 115, 46, 99, 108, 111, 117, 100), l(99, 115, 115, 45, 116, 114, 105, 99, 107, 115, 46, 99, 111, 109), l(99, 100, 112, 110, 46, 105, 111), l(112, 101, 110, 115, 46, 105, 111), l(103, 97, 110, 110, 111, 110, 46, 116, 118), l(99, 111, 100, 101, 99, 97, 110, 121, 111, 110, 46, 110, 101, 116), l(116, 104, 101, 109, 101, 102, 111, 114, 101, 115, 116, 46, 110, 101, 116), l(99, 101, 114, 101, 98, 114, 97, 120, 46, 99, 111, 46, 117, 107), l(116, 121, 109, 112, 97, 110, 117, 115, 46, 110, 101, 116), l(116, 119, 101, 101, 110, 109, 97, 120, 46, 99, 111, 109), l(112, 108, 110, 107, 114, 46, 99, 111), l(104, 111, 116, 106, 97, 114, 46, 99, 111, 109), l(119, 101, 98, 112, 97, 99, 107, 98, 105, 110, 46, 99, 111, 109), l(97, 114, 99, 104, 105, 118, 101, 46, 111, 114, 103), l(99, 111, 100, 101, 115, 97, 110, 100, 98, 111, 120, 46, 105, 111), l(99, 115, 98, 46, 97, 112, 112), l(115, 116, 97, 99, 107, 98, 108, 105, 116, 122, 46, 99, 111, 109), l(115, 116, 97, 99, 107, 98, 108, 105, 116, 122, 46, 105, 111), l(99, 111, 100, 105, 101, 114, 46, 105, 111), l(109, 111, 116, 105, 111, 110, 116, 114, 105, 99, 107, 115, 46, 99, 111, 109), l(115, 116, 97, 99, 107, 111, 118, 101, 114, 102, 108, 111, 119, 46, 99, 111, 109), l(115, 116, 97, 99, 107, 101, 120, 99, 104, 97, 110, 103, 101, 46, 99, 111, 109), l(115, 116, 117, 100, 105, 111, 102, 114, 101, 105, 103, 104, 116, 46, 99, 111, 109), l(119, 101, 98, 99, 111, 110, 116, 97, 105, 110, 101, 114, 46, 105, 111), l(106, 115, 102, 105, 100, 100, 108, 101, 46, 110, 101, 116)]
    let e = C.length
    return F
  }); const c = /\s+/g; var F = function _scrambleText (D, u) {
    for (var F = u.length, C = ''; --D > -1;) { C += u[~~(Math.random() * F)] }
    return C
  }; const u = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; const C = u.toLowerCase(); const f = {
    upperCase: new a(u),
    lowerCase: new a(C),
    upperAndLowerCase: new a(u + C)
  }; const e = {
    version: '3.12.3',
    name: 'scrambleText',
    register: function register (D) {
      E = D,
      v()
    },
    init: function init (D, u, F) {
      if (s || v(),
      this.prop = 'innerHTML' in D ? 'innerHTML' : 'textContent' in D ? 'textContent' : 0,
      this.prop) {
        this.target = D,
        typeof u !== 'object' && (u = {
          text: u
        })
        let C; let e; let E; let t; let n = u.text || u.value || ''; const i = !1 !== u.trim; const r = this
        return r.delimiter = C = u.delimiter || '',
        r.original = emojiSafeSplit(getText(D).replace(c, ' ').split('&nbsp;').join(''), C, i),
        n !== '{original}' && !0 !== n && n != null || (n = r.original.join(C)),
        r.text = emojiSafeSplit((n || '').replace(c, ' '), C, i),
        r.hasClass = !(!u.newClass && !u.oldClass),
        r.newClass = u.newClass,
        r.oldClass = u.oldClass,
        t = C === '',
        r.textHasEmoji = t && !!r.text.emoji,
        r.charsHaveEmoji = !!u.chars && !!emojiSafeSplit(u.chars).emoji,
        r.length = t ? r.original.length : r.original.join(C).length,
        r.lengthDif = (t ? r.text.length : r.text.join(C).length) - r.length,
        r.fillChar = u.fillChar || u.chars && ~u.chars.indexOf(' ') ? '&nbsp;' : '',
        r.charSet = E = f[u.chars || 'upperCase'] || new a(u.chars),
        r.speed = 0.05 / (u.speed || 1),
        r.prevScrambleTime = 0,
        r.setIndex = 20 * Math.random() | 0,
        (e = r.length + Math.max(r.lengthDif, 0)) > E.length && E.grow(e),
        r.chars = E.sets[r.setIndex],
        r.revealDelay = u.revealDelay || 0,
        r.tweenLength = !1 !== u.tweenLength,
        r.tween = F,
        r.rightToLeft = !!u.rightToLeft,
        r._props.push('scrambleText', 'text'),
        h
      }
    },
    render: function render (D, u) {
      let F; let C; let e; let E; let t; let n; let i; let r; let l; let o; let a; const s = u.target; const B = u.prop; const A = u.text; const h = u.delimiter; const c = u.tween; const f = u.prevScrambleTime; const d = u.revealDelay; let p = u.setIndex; const g = u.chars; const m = u.charSet; const w = u.length; const x = u.textHasEmoji; const S = u.charsHaveEmoji; const j = u.lengthDif; const v = u.tweenLength; const b = u.oldClass; const T = u.newClass; const y = u.rightToLeft; const _ = u.fillChar; const L = u.speed; const M = u.original; const H = u.hasClass; const O = A.length; let W = c._time; const P = W - f
      d && (c._from && (W = c._dur - W),
      D = W === 0 ? 0 : W < d ? 1e-6 : W === c._dur ? 1 : c._ease((W - d) / (c._dur - d))),
      D < 0 ? D = 0 : D > 1 && (D = 1),
      y && (D = 1 - D),
      F = ~~(D * O + 0.5),
      E = D
        ? ((L < P || P < -L) && (u.setIndex = p = (p + (19 * Math.random() | 0)) % 20,
          u.chars = m.sets[p],
          u.prevScrambleTime += P),
          g)
        : M.join(h),
      a = c._from ? D : 1 - D,
      o = w + (v ? c._from ? a * a * a : 1 - a * a * a : 1) * j,
      E = y
        ? D !== 1 || !c._from && c.data !== 'isFromStart'
          ? (i = A.slice(F).join(h),
            e = S ? emojiSafeSplit(E).slice(0, o - (x ? emojiSafeSplit(i) : i).length + 0.5 | 0).join('') : E.substr(0, o - (x ? emojiSafeSplit(i) : i).length + 0.5 | 0),
            i)
          : (e = '',
            M.join(h))
        : (e = A.slice(0, F).join(h),
          C = (x ? emojiSafeSplit(e) : e).length,
          S ? emojiSafeSplit(E).slice(C, o + 0.5 | 0).join('') : E.substr(C, o - C + 0.5 | 0)),
      i = H ? ((t = (r = y ? b : T) && F != 0) ? "<span class='" + r + "'>" : '') + e + (t ? '</span>' : '') + ((n = (l = y ? T : b) && F !== O) ? "<span class='" + l + "'>" : '') + h + E + (n ? '</span>' : '') : e + h + E,
      s[B] = _ === '&nbsp;' && ~i.indexOf('  ') ? i.split('  ').join('&nbsp;&nbsp;') : i
    }
  }
  e.emojiSafeSplit = emojiSafeSplit,
  e.getText = getText,
  i() && E.registerPlugin(e),
  D.ScrambleTextPlugin = e,
  D.default = e

    delete D.default
  
}))
