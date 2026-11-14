#!/usr/bin/env python3
"""Turn original photos into clean, web-sized WebP files.

The output is rebuilt from pixels only: nothing from the original file (EXIF, GPS,
XMP, maker notes, Samsung/Apple trailers, thumbnails, colour profile) is copied.
Orientation is applied to the pixels first, so the photo still faces the right way.
You choose each output name, because camera filenames leak dates (IMG_20260822_...).

Usage:
  python3 tools/photos/scrub.py --out assets/photos  inbox/IMG_1234.jpg=nyhavn  inbox/x.jpg=bench
  options: --max 1600 (longest edge, px)  --quality 80

Put originals in tools/photos/inbox/ (git-ignored). The script runs verify.py on what it wrote.
Requires Pillow (pinned in tools/photos/requirements.txt).
"""
import argparse
import pathlib
import re
import sys

from PIL import Image, ImageOps

sys.path.insert(0, str(pathlib.Path(__file__).parent))
import verify  # noqa: E402


def scrub(src, dst, max_edge, quality):
    with Image.open(src) as im:
        im = ImageOps.exif_transpose(im)
        has_alpha = im.mode in ("RGBA", "LA") or (im.mode == "P" and "transparency" in im.info)
        im = im.convert("RGBA" if has_alpha else "RGB")
        im.thumbnail((max_edge, max_edge), Image.LANCZOS)
        clean = Image.frombytes(im.mode, im.size, im.tobytes())  # pixels only, empty .info
    clean.save(dst, "WEBP", quality=quality, method=6)


def main():
    ap = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    ap.add_argument("pairs", nargs="+", metavar="SRC=NAME")
    ap.add_argument("--out", required=True)
    ap.add_argument("--max", type=int, default=1600)
    ap.add_argument("--quality", type=int, default=80)
    a = ap.parse_args()
    out = pathlib.Path(a.out)
    out.mkdir(parents=True, exist_ok=True)
    written = []
    for pair in a.pairs:
        src, sep, name = pair.partition("=")
        if not sep or not re.fullmatch(r"[a-z0-9][a-z0-9-]*", name):
            sys.exit(f"Give each photo a name: SRC=name (lowercase letters, digits, hyphens). Got: {pair}")
        dst = out / f"{name}.webp"
        scrub(src, dst, a.max, a.quality)
        written.append(dst)
        print(f"{src} -> {dst}")
    bad = [line for p in written for line in verify.check(str(p), p.read_bytes(), "webp")]
    for line in bad:
        print("FAIL", line)
    sys.exit(1 if bad else 0)


if __name__ == "__main__":
    main()
