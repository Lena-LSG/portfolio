# Photos on this site

The repository is public, so every photo in it is public, including its history. Two rules:

1. **Only `scrub.py` output gets committed.** Originals go in `tools/photos/inbox/` (git-ignored).
2. **CI fails on any metadata.** `.github/workflows/photo-privacy.yml` runs `tools/photos/verify.py` on every push
   and pull request, over all image files and every `data:image` URI in HTML/CSS/SVG/Markdown.

## Adding photos

```sh
pip install -r tools/photos/requirements.txt
python3 tools/photos/scrub.py --out src/photos tools/photos/inbox/IMG_1234.jpg=nyhavn
python3 tools/photos/scrub.py --out src/photos --max 800 --quality 74 tools/photos/inbox/IMG_1234.jpg=nyhavn-800
python3 tools/photos/manifest.py      # updates src/_data/photoSizes.json
python3 tools/photos/verify.py .
```

Then add the caption (Danish and English) and the series to `src/_data/photos.js`.

`scrub.py` applies the orientation, resizes (longest edge 1600 px by default) and rebuilds the image from pixels
only, so nothing from the original file survives. You name each output yourself, because camera filenames contain
dates.

## Why "GPS off" is not enough

A Samsung selfie from this repo's first batch, with location switched off in the camera, still contained:

| Where | What |
|---|---|
| EXIF | phone model, exact date and time |
| Samsung trailer (68 KB after the end of the JPEG) | `MCC_Data` = **238** (mobile country code: Denmark), `Image_UTC_Data` (timestamp in ms), front-camera selfie flag |
| MPF | two extra embedded images (HDR gain map and preview) |
| XMP | HDR container description |

Photos sent through WhatsApp or Instagram had already been stripped, but that depends on the app. Do not rely on it.

## Look at the picture too

Metadata is the easy part. Before adding a photo, check what's *in* it:

- house numbers, street signs or shop names near home, work or a regular routine
- badges, lanyards, boarding passes, tickets, screens, documents, mail
- reflections in windows, glasses and screens
- other people's faces (ask them, or crop them out)
- a series of photos that together give away a routine (same café, same time)
