# lenagibson.eu

Source for [lenagibson.eu](https://lenagibson.eu), the personal site of Lena Gibson: security engineer in
København, builder of small apps, taker of photos in bad weather.

The site is static: no trackers, no cookies, no contact form, no third-party scripts.

## Status

`mockup/` holds the signed-off design: home, about, projects (with a Kanjiskole case study) and photos,
in Danish and English, with a day and an evening mode. The next step is the real site in
[Eleventy](https://www.11ty.dev/), with self-hosted fonts, separate `/en/` pages, strict security headers
and `security.txt`. Hosting is still being decided.

## Layout

| Path | What |
|---|---|
| `mockup/build.py` | Generates the mock-up pages from shared templates |
| `mockup/assets/` | Shared CSS and JavaScript |
| `mockup/photos/` | Scrubbed photos, 800 px and 1600 px |
| `tools/photos/` | `scrub.py` cleans photos, `verify.py` fails on any image metadata |
| `docs/PHOTOS.md` | How photos are added, and why "GPS off" is not enough |

## Build the mock-up locally

```sh
pip install -r tools/photos/requirements.txt
python3 mockup/build.py
python3 -m http.server -d mockup 8000   # then open http://localhost:8000
```

## Checks

Every push runs two GitHub Actions workflows:

- **Photo privacy:** `tools/photos/verify.py` fails if any image, file or embedded, carries metadata.
- **Licensing:** `reuse lint` fails if any file lacks copyright and licence information.

## Licence

- **Code** is MIT. See `LICENSE`.
- **Photos and written content** (biography, project texts, captions) are © Lena Gibson, all rights reserved.
- **Kanjiskole screenshots** use the same terms as the Kanjiskole repository.

Exact terms per file are in `REUSE.toml` and `LICENSES/`. Credits are in `CREDITS.md`.

## Security

Found something? Email lena@lenagibson.eu. A `security.txt` arrives with the real site.
