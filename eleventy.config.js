// Eleventy config for lenagibson.eu. Every page is generated once per language:
// Danish at /, English at /en/.
const FONTS = {
  "node_modules/@fontsource-variable/fraunces/files/fraunces-latin-full-normal.woff2": "assets/fonts/fraunces-latin-full-normal.woff2",
  "node_modules/@fontsource-variable/fraunces/files/fraunces-latin-full-italic.woff2": "assets/fonts/fraunces-latin-full-italic.woff2",
  "node_modules/@fontsource/zen-kaku-gothic-new/files/zen-kaku-gothic-new-latin-400-normal.woff2": "assets/fonts/zen-kaku-gothic-new-latin-400-normal.woff2",
  "node_modules/@fontsource/zen-kaku-gothic-new/files/zen-kaku-gothic-new-latin-500-normal.woff2": "assets/fonts/zen-kaku-gothic-new-latin-500-normal.woff2",
  "node_modules/@fontsource/zen-kaku-gothic-new/files/zen-kaku-gothic-new-latin-700-normal.woff2": "assets/fonts/zen-kaku-gothic-new-latin-700-normal.woff2",
};

// Archimedean spiral as an SVG path (the logo), so it renders without JavaScript.
function spiral(cx, cy, turns, rMax, start = 2) {
  const steps = Math.round(turns * 48);
  let d = "";
  for (let i = 0; i <= steps; i++) {
    const t = i / steps, a = t * turns * Math.PI * 2, r = start + (rMax - start) * t;
    d += (i ? "L" : "M") + (cx + r * Math.cos(a)).toFixed(1) + " " + (cy + r * Math.sin(a)).toFixed(1);
  }
  return d;
}

export default function (cfg) {
  cfg.addPassthroughCopy({ "src/assets": "assets", "src/photos": "photos", ...FONTS });
  cfg.addPassthroughCopy({ "src/static": "/" });
  cfg.addGlobalData("logoPath", spiral(17, 17, 2.4, 10, 1));

  // URL of the same page in a language: "/about/" -> "/en/about/".
  cfg.addFilter("inLang", (path, lang) => (lang === "en" ? "/en" + path : path));
  // Pick the string for the current language from a {da, en} object.
  cfg.addFilter("tr", (obj, lang) => {
    if (obj == null || obj[lang] == null) throw new Error(`Missing translation (${lang}): ${JSON.stringify(obj)}`);
    return obj[lang];
  });
  cfg.addFilter("isoDate", (d) => d.toISOString());
  cfg.addFilter("toDate", (ms) => new Date(ms));

  return {
    dir: { input: "src", includes: "_includes", data: "_data", output: "_site" },
    templateFormats: ["njk"],
    htmlTemplateEngine: "njk",
  };
}
