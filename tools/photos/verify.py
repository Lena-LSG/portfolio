#!/usr/bin/env python3
"""Fail if any image in the repository carries metadata.

Checks every image file, plus images embedded as data: URIs in HTML/CSS/SVG.
Pure standard library and byte-level parsing, so it runs anywhere (CI included)
without trusting an image library to report what is in the file.

Rejected: EXIF, XMP, IPTC, comments, text chunks, timestamps, Samsung/Apple
trailers, extra embedded images (MPF), C2PA/JUMBF, data after the end of the image,
and formats we do not publish (HEIC, AVIF, TIFF).
Allowed: pixels, colour profile (ICC) and basic rendering hints.

Usage: python3 tools/photos/verify.py [ROOT]   (exit code 1 on any finding)
"""
import base64
import pathlib
import re
import struct
import sys

SKIP_DIRS = {".git", "node_modules", "vendor", "inbox"}
IMAGE_EXT = {".jpg", ".jpeg", ".png", ".webp", ".gif"}
BANNED_EXT = {".heic", ".heif", ".avif", ".tif", ".tiff", ".dng", ".raw"}
TEXT_EXT = {".html", ".htm", ".css", ".svg", ".md"}
DATA_URI = re.compile(rb"data:image/(png|jpe?g|webp|gif);base64,([A-Za-z0-9+/=]+)")
# Byte patterns that must never appear anywhere, whatever the container says.
MARKERS = [b"Exif\x00\x00", b"<x:xmpmeta", b"http://ns.adobe.com/xap/", b"Photoshop 3.0",
           b"SEFH", b"c2pa", b"XMP DataXMP"]


def jpeg(b):
    out, i = [], 2
    if b[:2] != b"\xff\xd8":
        return ["not a JPEG"]
    while i < len(b):
        if b[i] != 0xFF:
            i += 1
            continue
        m = b[i + 1]
        if m == 0xD9:  # end of image
            rest = b[i + 2:]
            if rest.strip(b"\x00"):
                out.append(f"{len(rest)} bytes after end of image (trailer)")
            return out
        if m in (0x01, 0xFF) or 0xD0 <= m <= 0xD7:
            i += 2 if m != 0xFF else 1
            continue
        (n,) = struct.unpack(">H", b[i + 2:i + 4])
        seg = b[i + 4:i + 2 + n]
        if m == 0xE1:
            out.append("APP1 (EXIF/XMP)")
        elif m == 0xE2 and not seg.startswith(b"ICC_PROFILE\x00"):
            out.append("APP2 (MPF/extra images)")
        elif m == 0xED:
            out.append("APP13 (IPTC/Photoshop)")
        elif 0xE3 <= m <= 0xEF and m != 0xEE:
            out.append(f"APP{m - 0xE0} segment")
        elif m == 0xFE:
            out.append("comment")
        i += 2 + n
        if m == 0xDA:  # scan entropy-coded data to the next real marker
            while i < len(b) - 1 and not (b[i] == 0xFF and b[i + 1] not in (0x00, *range(0xD0, 0xD8))):
                i += 1
    out.append("no end-of-image marker")
    return out


def png(b):
    if b[:8] != b"\x89PNG\r\n\x1a\n":
        return ["not a PNG"]
    ok = {b"IHDR", b"PLTE", b"IDAT", b"IEND", b"tRNS", b"gAMA", b"cHRM", b"sRGB", b"iCCP", b"pHYs", b"bKGD", b"sBIT"}
    out, i = [], 8
    while i + 8 <= len(b):
        n, t = struct.unpack(">I4s", b[i:i + 8])
        if t not in ok:
            out.append(f"chunk {t.decode('latin-1')}")
        i += 12 + n
        if t == b"IEND":
            if b[i:].strip(b"\x00"):
                out.append("data after IEND")
            break
    return out


def webp(b):
    if b[:4] != b"RIFF" or b[8:12] != b"WEBP":
        return ["not a WebP"]
    ok = {b"VP8 ", b"VP8L", b"VP8X", b"ALPH", b"ANIM", b"ANMF", b"ICCP"}
    out, i = [], 12
    while i + 8 <= len(b):
        t, n = struct.unpack("<4sI", b[i:i + 8])
        if t not in ok:
            out.append(f"chunk {t.decode('latin-1').strip()}")
        i += 8 + n + (n & 1)
    return out


def gif(b):
    return ["comment extension"] if b"\x21\xfe" in b else []


PARSERS = {"jpeg": jpeg, "jpg": jpeg, "png": png, "webp": webp, "gif": gif}


def check(label, data, kind):
    found = PARSERS[kind](data) + [f"marker {m!r}" for m in MARKERS if m in data]
    return [f"{label}: {f}" for f in found]


def main(root):
    problems = []
    for p in sorted(pathlib.Path(root).rglob("*")):
        if not p.is_file() or SKIP_DIRS & set(p.parts):
            continue
        ext = p.suffix.lower()
        if ext in BANNED_EXT:
            problems.append(f"{p}: {ext} is not allowed, convert it with tools/photos/scrub.py")
        elif ext in IMAGE_EXT:
            problems += check(str(p), p.read_bytes(), ext[1:])
        elif ext in TEXT_EXT:
            for k, m in enumerate(DATA_URI.finditer(p.read_bytes())):
                problems += check(f"{p} (embedded image {k + 1})", base64.b64decode(m.group(2)), m.group(1).decode())
    for line in problems:
        print("FAIL", line)
    print(f"{len(problems)} problem(s)." if problems else "All images are clean.")
    return 1 if problems else 0


if __name__ == "__main__":
    sys.exit(main(sys.argv[1] if len(sys.argv) > 1 else "."))
