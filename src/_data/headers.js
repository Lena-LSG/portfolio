// One source of truth for the HTTP security headers. Rendered to Apache (.htaccess),
// Netlify (_headers) and an nginx snippet for Plesk, so the choice of host doesn't change the policy.
const csp = [
  "default-src 'none'",
  "script-src 'self'",
  "style-src 'self'",
  "img-src 'self'",
  "font-src 'self'",
  "connect-src 'none'",
  "manifest-src 'self'",
  "base-uri 'none'",
  "form-action 'none'",
  "frame-ancestors 'none'",
  "upgrade-insecure-requests",
].join("; ");

export default {
  csp,
  // frame-ancestors and upgrade-insecure-requests are ignored in <meta>, so leave them out there.
  cspMeta: csp.split("; ").filter((d) => !d.startsWith("frame-ancestors") && d !== "upgrade-insecure-requests").join("; "),
  list: [
    ["Content-Security-Policy", csp],
    // One year, all subdomains. Add "preload" only once every subdomain (mail included) is HTTPS-only for good.
    ["Strict-Transport-Security", "max-age=31536000; includeSubDomains"],
    ["X-Content-Type-Options", "nosniff"],
    ["X-Frame-Options", "DENY"],
    ["Referrer-Policy", "no-referrer"],
    ["Permissions-Policy", "accelerometer=(), autoplay=(), camera=(), display-capture=(), encrypted-media=(), fullscreen=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), midi=(), payment=(), picture-in-picture=(), publickey-credentials-get=(), screen-wake-lock=(), serial=(), usb=(), xr-spatial-tracking=()"],
    ["Cross-Origin-Opener-Policy", "same-origin"],
    ["Cross-Origin-Embedder-Policy", "require-corp"],
    ["Cross-Origin-Resource-Policy", "same-origin"],
    ["X-Permitted-Cross-Domain-Policies", "none"],
  ],
  // Long cache for files whose content only changes with their name; short for everything else.
  immutable: ["/assets/fonts/", "/photos/"],
};
