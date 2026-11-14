(() => {
  const $ = (s) => document.querySelector(s);
  const root = document.documentElement;
  const store = {
    get(k) { try { return localStorage.getItem(k); } catch { return null; } },
    set(k, v) { try { localStorage.setItem(k, v); } catch { /* private mode */ } },
  };

  // ---------- i18n: Danish is in the HTML, English comes from COMMON + the page's own strings ----------
  const COMMON = {
    "nav.projects": "Projects", "nav.about": "About", "nav.photos": "Photos", "nav.contact": "Contact",
    "c.h2": "Say hello", "c.p": "There’s no contact form, so there’s nothing to spam or hack. Just send an email.", "c.copy": "Copy",
    "f.a": "No cookies, no trackers, so no cookie banner either.", "f.thanks": "Thanks for stopping by", "f.src": "Source",
    "lb.close": "Close",
  };
  const EN = Object.assign({}, COMMON, window.PAGE_EN || {});
  const DA = {};
  document.querySelectorAll("[data-i18n]").forEach(el => { DA[el.dataset.i18n] ??= el.textContent; });
  document.querySelectorAll("[data-i18n-html]").forEach(el => { DA[el.dataset.i18nHtml] ??= el.innerHTML; });
  document.querySelectorAll("[data-i18n-alt]").forEach(el => { DA["alt:" + el.dataset.i18nAlt] ??= el.alt; });
  const T = { da: DA, en: EN };

  let lang = store.get("lang") === "en" ? "en" : "da";
  let mode = ["day", "evening"].includes(store.get("mode")) ? store.get("mode") : "auto";

  const isEvening = () => { const h = new Date().getHours(); return h >= 18 || h < 7; };
  function applyMode() {
    const evening = mode === "evening" || (mode === "auto" && isEvening());
    root.dataset.mode = evening ? "evening" : "day";
    const b = $("#modeBtn");
    if (b) b.textContent = evening ? (lang === "da" ? "Dag" : "Day") : (lang === "da" ? "Aften" : "Evening");
  }
  function applyLang() {
    root.lang = lang;
    const t = T[lang];
    document.querySelectorAll("[data-i18n]").forEach(el => { const v = t[el.dataset.i18n]; if (v != null) el.textContent = v; });
    document.querySelectorAll("[data-i18n-html]").forEach(el => { const v = t[el.dataset.i18nHtml]; if (v != null) el.innerHTML = v; });
    document.querySelectorAll("[data-i18n-alt]").forEach(el => {
      const v = lang === "da" ? DA["alt:" + el.dataset.i18nAlt] : EN[el.dataset.i18nAlt];
      if (v != null) el.alt = v;
    });
    const lb = $("#langBtn"); if (lb) lb.textContent = lang === "da" ? "EN" : "DA";
    applyMode();
    drawFriend();
  }
  $("#modeBtn")?.addEventListener("click", () => { mode = root.dataset.mode === "evening" ? "day" : "evening"; store.set("mode", mode); applyMode(); });
  $("#langBtn")?.addEventListener("click", () => { lang = lang === "da" ? "en" : "da"; store.set("lang", lang); applyLang(); });

  // ---------- active nav ----------
  const page = document.querySelector('meta[name="page"]')?.content;
  document.querySelectorAll(".links a").forEach(a => { if (a.dataset.page === page) a.setAttribute("aria-current", "page"); });

  // ---------- logo spiral + hero friend ----------
  function spiral(cx, cy, turns, rMax, start = 2) {
    const steps = Math.round(turns * 48); let d = "";
    for (let i = 0; i <= steps; i++) {
      const t = i / steps, a = t * turns * Math.PI * 2, r = start + (rMax - start) * t;
      d += (i ? "L" : "M") + (cx + r * Math.cos(a)).toFixed(1) + " " + (cy + r * Math.sin(a)).toFixed(1);
    }
    return d;
  }
  $("#miniSwirl")?.setAttribute("d", spiral(17, 17, 2.4, 10, 1));

  const face = (y, gap = 16) => `
    <circle cx="${100 - gap}" cy="${y}" r="5" fill="var(--face)"/><circle cx="${100 + gap}" cy="${y}" r="5" fill="var(--face)"/>
    <circle cx="${101.5 - gap}" cy="${y - 1.6}" r="1.6" fill="#fff"/><circle cx="${101.5 + gap}" cy="${y - 1.6}" r="1.6" fill="#fff"/>
    <ellipse cx="${100 - gap - 15}" cy="${y + 12}" rx="9" ry="5" fill="var(--rose)" opacity=".75"/>
    <ellipse cx="${100 + gap + 15}" cy="${y + 12}" rx="9" ry="5" fill="var(--rose)" opacity=".75"/>`;
  const FRIENDS = [
    { da: "Kanelsnegl", en: "Cinnamon bun", svg: () => `
      <ellipse cx="100" cy="176" rx="58" ry="8" fill="var(--face)" opacity=".08"/>
      <circle cx="100" cy="102" r="72" fill="var(--bun)"/>
      <path d="${spiral(100, 102, 3.1, 62, 4)}" fill="none" stroke="var(--swirl)" stroke-width="7" stroke-linecap="round" opacity=".55"/>
      <path d="M58 70 q14 -14 30 -6 M112 54 q16 -2 26 10 M136 128 q-6 14 -20 18" fill="none" stroke="var(--icing)" stroke-width="7" stroke-linecap="round"/>
      <circle cx="100" cy="112" r="34" fill="var(--bun)"/>
      ${face(108)}
      <path d="M93 121 q7 7 14 0" fill="none" stroke="var(--face)" stroke-width="3.4" stroke-linecap="round"/>` },
    { da: "Kat", en: "Cat", svg: () => `
      <ellipse cx="100" cy="178" rx="56" ry="8" fill="var(--face)" opacity=".08"/>
      <path d="M44 92 L54 38 L90 66 Z M156 92 L146 38 L110 66 Z" fill="var(--cat)" stroke="var(--cat)" stroke-width="12" stroke-linejoin="round"/>
      <path d="M56 78 L60 52 L80 68 Z M144 78 L140 52 L120 68 Z" fill="var(--cat-ear)" stroke="var(--cat-ear)" stroke-width="5" stroke-linejoin="round"/>
      <ellipse cx="100" cy="112" rx="66" ry="58" fill="var(--cat)"/>
      ${face(106, 20)}
      <path d="M100 118 l-4 -4 h8 z" fill="var(--rose)" stroke="var(--rose)" stroke-width="2" stroke-linejoin="round"/>
      <path d="M92 124 q4 5 8 0 q4 5 8 0" fill="none" stroke="var(--face)" stroke-width="3" stroke-linecap="round"/>
      <path d="M40 112 h24 M42 124 l22 -4 M160 112 h-24 M158 124 l-22 -4" stroke="var(--face)" stroke-width="2.4" stroke-linecap="round" opacity=".5"/>` },
    { da: "Haj", en: "Shark", svg: () => `
      <ellipse cx="104" cy="176" rx="64" ry="8" fill="var(--face)" opacity=".08"/>
      <path d="M96 66 Q104 26 128 30 Q118 50 122 70 Z" fill="var(--shark)" stroke="var(--shark)" stroke-width="8" stroke-linejoin="round"/>
      <path d="M40 112 Q20 84 14 70 Q30 76 44 98 Q32 120 16 146 Q30 140 42 124 Z" fill="var(--shark)" stroke="var(--shark)" stroke-width="8" stroke-linejoin="round"/>
      <path d="M36 112 C44 70 130 52 176 98 C184 108 182 118 172 126 C130 160 52 156 36 112 Z" fill="var(--shark)"/>
      <path d="M70 132 C100 150 146 146 172 126 C150 124 110 124 70 132 Z" fill="var(--belly)"/>
      <path d="M96 140 Q112 158 124 138" fill="var(--shark)"/>
      <circle cx="136" cy="100" r="5" fill="var(--face)"/><circle cx="137.5" cy="98.4" r="1.6" fill="#fff"/>
      <ellipse cx="150" cy="112" rx="8" ry="4.5" fill="var(--rose)" opacity=".75"/>
      <path d="M150 122 q7 5 13 -1" fill="none" stroke="var(--face)" stroke-width="3" stroke-linecap="round"/>` },
  ];
  let fi = 0;
  function drawFriend() {
    const svg = $("#friendSvg"); if (!svg) return;
    const f = FRIENDS[fi];
    svg.innerHTML = f.svg();
    $("#friend").setAttribute("aria-label", `${lang === "da" ? f.da : f.en}. ${lang === "da" ? "Tryk for at skifte." : "Tap to switch."}`);
  }
  $("#friend")?.addEventListener("click", () => {
    const b = $("#friend"); b.classList.add("swap");
    setTimeout(() => { fi = (fi + 1) % FRIENDS.length; drawFriend(); b.classList.remove("swap"); }, 380);
  });

  // ---------- lightbox (works per page; links still open the image without JS) ----------
  const lb = $("#lb");
  if (lb) {
    const shots = [...document.querySelectorAll(".shot .open")];
    let cur = 0;
    const show = (i) => {
      cur = (i + shots.length) % shots.length;
      const b = shots[cur];
      $("#lbImg").src = b.dataset.full; $("#lbImg").alt = b.querySelector("img").alt;
      $("#lbCap").textContent = b.parentElement.querySelector("figcaption")?.textContent || "";
    };
    shots.forEach((b, i) => b.addEventListener("click", e => { e.preventDefault(); show(i); lb.showModal(); }));
    $("#lbPrev").addEventListener("click", () => show(cur - 1));
    $("#lbNext").addEventListener("click", () => show(cur + 1));
    $("#lbClose").addEventListener("click", () => lb.close());
    lb.addEventListener("click", e => { if (e.target === lb || e.target.classList.contains("inner")) lb.close(); });
    lb.addEventListener("keydown", e => { if (e.key === "ArrowLeft") show(cur - 1); if (e.key === "ArrowRight") show(cur + 1); });
    let sx = 0;
    lb.addEventListener("touchstart", e => { sx = e.touches[0].clientX; }, { passive: true });
    lb.addEventListener("touchend", e => { const dx = e.changedTouches[0].clientX - sx; if (Math.abs(dx) > 50) show(cur + (dx < 0 ? 1 : -1)); });
  }

  // ---------- toast, copy, easter egg ----------
  let tt;
  const toast = (m) => { const el = $("#toast"); if (!el) return; el.textContent = m; el.classList.add("on"); clearTimeout(tt); tt = setTimeout(() => el.classList.remove("on"), 2600); };
  $("#copyBtn")?.addEventListener("click", () => {
    const ok = () => toast(lang === "da" ? "Adressen er kopieret." : "Address copied.");
    const sel = () => { const r = document.createRange(); r.selectNodeContents($("#mail")); const s = getSelection(); s.removeAllRanges(); s.addRange(r); };
    try { navigator.clipboard.writeText($("#mail").textContent).then(ok, sel); } catch { sel(); }
  });
  let buf = "";
  addEventListener("keydown", e => {
    if (e.key.length !== 1) return;
    buf = (buf + e.key.toLowerCase()).slice(-5);
    if (buf === "robot") toast(lang === "da" ? "Bip bop. Robotten hilser." : "Beep boop. The robot says hi.");
  });
  console.log("%cHej.%c Leder du efter sårbarheder? Se /.well-known/security.txt.", "font-size:20px;color:#A4546A", "font-size:13px");

  applyLang();
  setInterval(() => { if (mode === "auto") applyMode(); }, 60000);
})();
