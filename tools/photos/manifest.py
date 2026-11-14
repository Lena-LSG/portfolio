#!/usr/bin/env python3
"""Write src/_data/photoSizes.json (width/height of every photo) so templates can set width/height."""
import json
import pathlib

from PIL import Image

root = pathlib.Path(__file__).resolve().parents[2]
sizes = {p.stem: list(Image.open(p).size) for p in sorted((root / "src/photos").glob("*.webp"))}
(root / "src/_data/photoSizes.json").write_text(json.dumps(sizes, indent=1) + "\n")
print(f"{len(sizes)} photos")
