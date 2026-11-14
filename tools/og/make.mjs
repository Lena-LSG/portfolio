// Render the social preview images (1200x630) for both languages with the site's own fonts and colours.
// Usage: node tools/og/make.mjs   (needs Playwright + Chromium; output goes to src/assets/og-{da,en}.png)
// Playwright is not a project dependency; a globally installed one is found via NODE_PATH.
import { createRequire } from "node:module";
import { pathToFileURL } from "node:url";
import path from "node:path";
import fs from "node:fs";
import os from "node:os";

const { chromium } = createRequire(import.meta.url)("playwright");
const root = path.resolve(import.meta.dirname, "../..");
const f = (p) => pathToFileURL(path.join(root, p)).href;
const TEXT = {
  da: { kicker: "Senior Security Engineer · København", h1: "Hej, jeg er Lena. Jeg <em>passer på</em> ting.", sub: "Incident response, detection engineering og apps bygget med privatliv først." },
  en: { kicker: "Senior Security Engineer · Copenhagen", h1: "Hi, I’m Lena. I <em>look after</em> things.", sub: "Incident response, detection engineering and apps built privacy first." },
};
const html = (t) => `<!doctype html><meta charset="utf-8"><style>
@font-face { font-family: F; src: url("${f("node_modules/@fontsource-variable/fraunces/files/fraunces-latin-full-normal.woff2")}"); }
@font-face { font-family: F; font-style: italic; src: url("${f("node_modules/@fontsource-variable/fraunces/files/fraunces-latin-full-italic.woff2")}"); }
@font-face { font-family: Z; font-weight: 400; src: url("${f("node_modules/@fontsource/zen-kaku-gothic-new/files/zen-kaku-gothic-new-latin-400-normal.woff2")}"); }
@font-face { font-family: Z; font-weight: 700; src: url("${f("node_modules/@fontsource/zen-kaku-gothic-new/files/zen-kaku-gothic-new-latin-700-normal.woff2")}"); }
html, body { margin: 0; width: 1200px; height: 630px; overflow: hidden; }
body { background: #F7F1EC; color: #1E2434; font-family: Z; display: grid; grid-template-columns: 1fr 400px; align-items: center; gap: 40px; padding: 0 70px; box-sizing: border-box; position: relative; }
.k { font-size: 20px; letter-spacing: .14em; text-transform: uppercase; color: #9A5630; font-weight: 700; }
h1 { font-family: F; font-weight: 500; font-variation-settings: "SOFT" 100; font-size: 76px; line-height: .98; letter-spacing: -.012em; margin: 18px 0 22px; }
em { color: #A4546A; }
p { font-size: 25px; color: #61667A; margin: 0; line-height: 1.4; }
.url { position: absolute; left: 70px; bottom: 40px; font-size: 22px; font-weight: 700; color: #27335A; }
.ph { position: relative; height: 500px; }
.ph::before { content: ""; position: absolute; inset: -40px -60px; border-radius: 50%; background: radial-gradient(circle at 50% 45%, rgba(227,165,90,.55), rgba(217,144,158,.16) 50%, transparent 70%); }
.ph img { position: relative; width: 400px; height: 500px; object-fit: cover; border-radius: 999px 999px 28px 28px; }
</style><div><div class="k">${t.kicker}</div><h1>${t.h1}</h1><p>${t.sub}</p></div>
<div class="ph"><img src="${f("src/photos/lena-hero.webp")}"></div><div class="url">lenagibson.eu</div>`;

const browser = await chromium.launch({ args: ["--allow-file-access-from-files"] });
const tmp = fs.mkdtempSync(path.join(os.tmpdir(), "og-"));
for (const lang of ["da", "en"]) {
  const page = await browser.newPage({ viewport: { width: 1200, height: 630 } });
  const file = path.join(tmp, `${lang}.html`);
  fs.writeFileSync(file, html(TEXT[lang]));
  await page.goto(pathToFileURL(file).href, { waitUntil: "load" });
  await page.evaluate(() => document.fonts.ready);
  await page.screenshot({ path: path.join(root, `src/assets/og-${lang}.png`) });
  await page.close();
}
await browser.close();
fs.rmSync(tmp, { recursive: true });
console.log("wrote src/assets/og-da.png, og-en.png");
