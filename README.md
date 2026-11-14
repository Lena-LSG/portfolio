# lenagibson.eu

Source for [lenagibson.eu](https://lenagibson.eu), the personal site of Lena Gibson: security engineer in
København, builder of small apps, taker of photos in bad weather.

Static, built with [Eleventy](https://www.11ty.dev/). No trackers, no cookies, no contact form, no
third-party requests, no inline code. Danish at `/`, English at `/en/`.

## Build

```sh
npm ci
npm run build        # writes _site/
npm run serve        # local preview with live reload
npm run check        # photo metadata + site rules (needs a build first)
```

## Layout

| Path | What |
|---|---|
| `src/pages/` | One template per page, rendered once per language |
| `src/_data/t.js` | All page text, Danish and English side by side |
| `src/_data/photos.js`, `timeline.js` | Captions and photo series; work history |
| `src/_data/headers.js` | The security headers, rendered to `.htaccess`, `_headers` and an nginx snippet |
| `src/assets/` | CSS, JavaScript, favicon, social preview images |
| `src/photos/` | Scrubbed photos, 800 px and 1600 px |
| `tools/photos/` | `scrub.py` cleans photos, `verify.py` fails on any image metadata, `manifest.py` records sizes |
| `tools/check_site.py` | Fails the build on inline code, external resources, missing meta or a stale `security.txt` |
| `tools/og/make.mjs` | Renders the social preview images |
| `docs/PHOTOS.md` | How photos are added, and why "GPS off" is not enough |

## Security

- **CSP:** `default-src 'none'`, everything else `'self'`, `frame-ancestors 'none'`. No inline scripts or
  styles, so no `'unsafe-inline'`.
- **Headers:** HSTS (1 year, subdomains), `nosniff`, `Referrer-Policy: no-referrer`, a deny-all
  `Permissions-Policy`, COOP/COEP/CORP. One source in `src/_data/headers.js`, whichever host serves it.
- **`/.well-known/security.txt`** (RFC 9116), regenerated on every build with an expiry under a year.
- **Fonts self-hosted**, dependencies pinned exactly, npm install scripts disabled (`.npmrc`).
- **Photos** are rebuilt from pixels; CI fails on any metadata.

Found something? See [`security.txt`](https://lenagibson.eu/.well-known/security.txt) or email lena@lenagibson.eu.

## Checks

Every push runs:

- **Site:** build, then `tools/check_site.py` on the output
- **Photo privacy:** `tools/photos/verify.py`
- **Licensing:** `reuse lint`

## Licence

- **Code** is MIT. See `LICENSE`.
- **Photos and written content** (`src/photos/`, `src/_data/t.js`, `photos.js`, `timeline.js`) are © Lena Gibson,
  all rights reserved.
- **Kanjiskole screenshots** use the same terms as the Kanjiskole repository.
- **Fonts** are SIL OFL 1.1.

Exact terms per file are in `REUSE.toml` and `LICENSES/`. Credits are in `CREDITS.md`.
