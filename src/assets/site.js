// Progressive enhancement only: the site works without this file.
// Day/evening mode, the hero friend, the photo lightbox, the copy button and one easter egg.
(() => {
  const $ = (s) => document.querySelector(s);
  const root = document.documentElement;
  const da = root.lang === "da";
  const store = {
    get(k) { try { return localStorage.getItem(k); } catch { return null; } },
    set(k, v) { try { localStorage.setItem(k, v); } catch { /* storage blocked */ } },
  };

  // ---------- day / evening (follows the clock unless the visitor picks one) ----------
  let mode = ["day", "evening"].includes(store.get("mode")) ? store.get("mode") : "auto";
  const isEvening = () => { const h = new Date().getHours(); return h >= 18 || h < 7; };
  const modeBtn = $("#modeBtn");
  function applyMode() {
    const evening = mode === "evening" || (mode === "auto" && isEvening());
    root.dataset.mode = evening ? "evening" : "day";
    if (modeBtn) modeBtn.textContent = evening ? (da ? "Dag" : "Day") : (da ? "Aften" : "Evening");
  }
  if (modeBtn) {
    modeBtn.hidden = false;
    modeBtn.addEventListener("click", () => { mode = root.dataset.mode === "evening" ? "day" : "evening"; store.set("mode", mode); applyMode(); });
  }
  applyMode();
  setInterval(() => { if (mode === "auto") applyMode(); }, 60000);

  // ---------- hero friend: cinnamon bun, cat, shark ----------
  const NS = "http://www.w3.org/2000/svg";
  function el(tag, attrs) { const e = document.createElementNS(NS, tag); for (const k in attrs) e.setAttribute(k, attrs[k]); return e; }
  function spiral(cx, cy, turns, rMax, start = 2) {
    const steps = Math.round(turns * 48); let d = "";
    for (let i = 0; i <= steps; i++) {
      const t = i / steps, a = t * turns * Math.PI * 2, r = start + (rMax - start) * t;
      d += (i ? "L" : "M") + (cx + r * Math.cos(a)).toFixed(1) + " " + (cy + r * Math.sin(a)).toFixed(1);
    }
    return d;
  }
  // Shapes as [tag, attrs]; colours are classes styled in site.css (no inline styles under the CSP).
  const face = (y, gap = 16) => [
    ["circle", { cx: 100 - gap, cy: y, r: 5, class: "f-face" }], ["circle", { cx: 100 + gap, cy: y, r: 5, class: "f-face" }],
    ["circle", { cx: 101.5 - gap, cy: y - 1.6, r: 1.6, class: "f-white" }], ["circle", { cx: 101.5 + gap, cy: y - 1.6, r: 1.6, class: "f-white" }],
    ["ellipse", { cx: 100 - gap - 15, cy: y + 12, rx: 9, ry: 5, class: "f-blush" }], ["ellipse", { cx: 100 + gap + 15, cy: y + 12, rx: 9, ry: 5, class: "f-blush" }],
  ];
  const FRIENDS = [
    { da: "Kanelsnegl", en: "Cinnamon bun", shapes: () => [
      ["ellipse", { cx: 100, cy: 176, rx: 58, ry: 8, class: "f-shadow" }],
      ["circle", { cx: 100, cy: 102, r: 72, class: "f-bun" }],
      ["path", { d: spiral(100, 102, 3.1, 62, 4), class: "f-swirl" }],
      ["path", { d: "M58 70 q14 -14 30 -6 M112 54 q16 -2 26 10 M136 128 q-6 14 -20 18", class: "f-icing" }],
      ["circle", { cx: 100, cy: 112, r: 34, class: "f-bun" }],
      ...face(108),
      ["path", { d: "M93 121 q7 7 14 0", class: "f-line" }]] },
    { da: "Kat", en: "Cat", shapes: () => [
      ["ellipse", { cx: 100, cy: 178, rx: 56, ry: 8, class: "f-shadow" }],
      ["path", { d: "M44 92 L54 38 L90 66 Z M156 92 L146 38 L110 66 Z", class: "f-cat f-round12" }],
      ["path", { d: "M56 78 L60 52 L80 68 Z M144 78 L140 52 L120 68 Z", class: "f-ear" }],
      ["ellipse", { cx: 100, cy: 112, rx: 66, ry: 58, class: "f-cat" }],
      ...face(106, 20),
      ["path", { d: "M100 118 l-4 -4 h8 z", class: "f-nose" }],
      ["path", { d: "M92 124 q4 5 8 0 q4 5 8 0", class: "f-line" }],
      ["path", { d: "M40 112 h24 M42 124 l22 -4 M160 112 h-24 M158 124 l-22 -4", class: "f-whisker" }]] },
    { da: "Haj", en: "Shark", shapes: () => [
      ["ellipse", { cx: 104, cy: 176, rx: 64, ry: 8, class: "f-shadow" }],
      ["path", { d: "M96 66 Q104 26 128 30 Q118 50 122 70 Z", class: "f-shark f-round8" }],
      ["path", { d: "M40 112 Q20 84 14 70 Q30 76 44 98 Q32 120 16 146 Q30 140 42 124 Z", class: "f-shark f-round8" }],
      ["path", { d: "M36 112 C44 70 130 52 176 98 C184 108 182 118 172 126 C130 160 52 156 36 112 Z", class: "f-shark" }],
      ["path", { d: "M70 132 C100 150 146 146 172 126 C150 124 110 124 70 132 Z", class: "f-belly" }],
      ["path", { d: "M96 140 Q112 158 124 138", class: "f-shark" }],
      ["circle", { cx: 136, cy: 100, r: 5, class: "f-face" }], ["circle", { cx: 137.5, cy: 98.4, r: 1.6, class: "f-white" }],
      ["ellipse", { cx: 150, cy: 112, rx: 8, ry: 4.5, class: "f-blush" }],
      ["path", { d: "M150 122 q7 5 13 -1", class: "f-line" }]] },
  ];
  const friend = $("#friend"), svg = $("#friendSvg");
  let fi = 0;
  function drawFriend() {
    const f = FRIENDS[fi];
    svg.replaceChildren(...f.shapes().map(([tag, a]) => el(tag, a)));
    friend.setAttribute("aria-label", `${da ? f.da : f.en}. ${da ? "Tryk for at skifte." : "Tap to switch."}`);
  }
  if (friend && svg) {
    friend.hidden = false;
    drawFriend();
    friend.addEventListener("click", () => {
      friend.classList.add("swap");
      setTimeout(() => { fi = (fi + 1) % FRIENDS.length; drawFriend(); friend.classList.remove("swap"); }, 380);
    });
  }

  // ---------- lightbox (without JS the links simply open the full image) ----------
  const lb = $("#lb");
  const shots = [...document.querySelectorAll(".shot .open")];
  if (lb && shots.length) {
    let cur = 0;
    const show = (i) => {
      cur = (i + shots.length) % shots.length;
      const b = shots[cur];
      $("#lbImg").src = b.dataset.full;
      $("#lbImg").alt = b.querySelector("img").alt;
      $("#lbCap").textContent = b.parentElement.querySelector("figcaption")?.textContent || "";
    };
    shots.forEach((b, i) => b.addEventListener("click", (e) => { e.preventDefault(); show(i); lb.showModal(); }));
    $("#lbPrev").addEventListener("click", () => show(cur - 1));
    $("#lbNext").addEventListener("click", () => show(cur + 1));
    $("#lbClose").addEventListener("click", () => lb.close());
    lb.addEventListener("click", (e) => { if (e.target === lb || e.target.classList.contains("inner")) lb.close(); });
    lb.addEventListener("keydown", (e) => { if (e.key === "ArrowLeft") show(cur - 1); if (e.key === "ArrowRight") show(cur + 1); });
    let sx = 0;
    lb.addEventListener("touchstart", (e) => { sx = e.touches[0].clientX; }, { passive: true });
    lb.addEventListener("touchend", (e) => { const dx = e.changedTouches[0].clientX - sx; if (Math.abs(dx) > 50) show(cur + (dx < 0 ? 1 : -1)); });
  }

  // ---------- toast, copy button, easter egg ----------
  let tt;
  const toast = (msg) => { const t = $("#toast"); t.textContent = msg; t.classList.add("on"); clearTimeout(tt); tt = setTimeout(() => t.classList.remove("on"), 2600); };
  const copyBtn = $("#copyBtn"), mail = $("#mail");
  if (copyBtn && mail && navigator.clipboard) {
    copyBtn.hidden = false;
    copyBtn.addEventListener("click", () => {
      navigator.clipboard.writeText(mail.textContent).then(
        () => toast(da ? "Adressen er kopieret." : "Address copied."),
        () => { const r = document.createRange(); r.selectNodeContents(mail); const s = getSelection(); s.removeAllRanges(); s.addRange(r); },
      );
    });
  }
  let buf = "";
  addEventListener("keydown", (e) => {
    if (e.key.length !== 1) return;
    buf = (buf + e.key.toLowerCase()).slice(-5);
    if (buf === "robot") toast(da ? "Bip bop. Robotten hilser." : "Beep boop. The robot says hi.");
  });
  console.log("%cHej.%c Looking for vulnerabilities? See /.well-known/security.txt", "font-size:20px;color:#A4546A", "font-size:13px");
})();
