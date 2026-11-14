#!/usr/bin/env python3
"""Fail if the built site breaks its own security and quality rules.

Checks every HTML page in the build output for:
- no inline scripts, inline event handlers, style attributes or <style> blocks (the CSP forbids them)
- no scripts, styles, images or fonts from other origins
- lang, title, description, canonical + hreflang pairs, og:image that exists
- internal links and image sources that resolve to a file in the build
And checks the generated files: security.txt (expiry), header configs contain the CSP and HSTS.

Usage: python3 tools/check_site.py _site
"""
import datetime
import html.parser
import pathlib
import re
import sys
import urllib.parse

SITE_URL = "https://lenagibson.eu"


class Page(html.parser.HTMLParser):
    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.tags = []  # (tag, attrs dict)
        self.inline_script = False
        self._in_script = False

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        self.tags.append((tag, a))
        if tag == "script":
            self._in_script = "src" not in a
            if a.get("type") == "application/ld+json":
                self._in_script = False

    def handle_endtag(self, tag):
        if tag == "script":
            self._in_script = False

    def handle_data(self, data):
        if self._in_script and data.strip():
            self.inline_script = True


def resolve(root, page_path, url):
    """Map a same-site URL to a file in the build, or None if it is external/anchor-only."""
    u = urllib.parse.urlparse(url)
    if u.scheme in ("mailto", "tel") or (u.scheme and not url.startswith(SITE_URL)) or (not u.path and u.fragment):
        return None
    path = u.path if not url.startswith(SITE_URL) else u.path or "/"
    target = (root / path.lstrip("/")) if path.startswith("/") else (page_path.parent / path)
    if path.endswith("/") or target.is_dir():
        target = target / "index.html"
    return target


def check_page(root, p):
    errs = []
    rel = p.relative_to(root)
    doc = p.read_text()
    parser = Page()
    parser.feed(doc)
    tags = parser.tags
    if parser.inline_script:
        errs.append("inline <script>")
    if re.search(r"<style[\s>]", doc):
        errs.append("<style> block")
    for tag, a in tags:
        for k in a:
            if k.startswith("on"):
                errs.append(f"inline event handler {k}= on <{tag}>")
            if k == "style":
                errs.append(f"style attribute on <{tag}>")
        for attr in ("src", "srcset", "href"):
            v = a.get(attr)
            if not v:
                continue
            external = re.match(r"https?://", v) and not v.startswith(SITE_URL)
            if external and (tag in ("script", "img", "source", "iframe") or (tag == "link" and a.get("rel") not in ("canonical", "alternate"))):
                errs.append(f"external resource on <{tag} {attr}>: {v}")
            if tag in ("a", "img", "link", "script") and attr != "srcset" and not external and not v.startswith("#"):
                if tag == "link" and a.get("rel") in ("canonical", "alternate") or tag == "a" and a.get("href", "").startswith("mailto:"):
                    target = resolve(root, p, v) if v.startswith(SITE_URL) else None
                else:
                    target = resolve(root, p, v)
                if target is not None and not target.exists():
                    errs.append(f"broken link on <{tag} {attr}>: {v}")
    html_tag = next((a for t, a in tags if t == "html"), {})
    if html_tag.get("lang") not in ("da", "en"):
        errs.append("missing or wrong <html lang>")
    if not any(t == "title" for t, a in tags):
        errs.append("missing <title>")
    meta = {a.get("name") or a.get("property"): a.get("content") for t, a in tags if t == "meta"}
    if not meta.get("description"):
        errs.append("missing meta description")
    if "Content-Security-Policy" not in {a.get("http-equiv") for t, a in tags if t == "meta"}:
        errs.append("missing CSP meta")
    og = meta.get("og:image", "")
    if not og.startswith(SITE_URL) or not (root / og[len(SITE_URL):].lstrip("/")).exists():
        errs.append(f"og:image missing or not in build: {og}")
    if meta.get("robots") != "noindex":
        links = [(a.get("rel"), a.get("hreflang")) for t, a in tags if t == "link"]
        for need in [("canonical", None), ("alternate", "da"), ("alternate", "en"), ("alternate", "x-default")]:
            if need not in links:
                errs.append(f"missing <link rel={need[0]} hreflang={need[1]}>")
    return [f"{rel}: {e}" for e in errs]


def main(root):
    root = pathlib.Path(root)
    errs = []
    pages = sorted(root.rglob("*.html"))
    if not pages:
        errs.append("no HTML pages found")
    for p in pages:
        errs += check_page(root, p)

    st = root / ".well-known/security.txt"
    if not st.exists():
        errs.append("security.txt missing")
    else:
        m = re.search(r"^Expires: (\S+)", st.read_text(), re.M)
        if not m:
            errs.append("security.txt has no Expires")
        else:
            exp = datetime.datetime.fromisoformat(m.group(1).replace("Z", "+00:00"))
            left = (exp - datetime.datetime.now(datetime.timezone.utc)).days
            if not 30 <= left <= 366:
                errs.append(f"security.txt Expires is {left} days away (must be 30-366): rebuild and redeploy")
        if "Contact: mailto:" not in st.read_text():
            errs.append("security.txt has no Contact")

    for f in (".htaccess", "_headers", ".nginx-headers.conf"):
        text = (root / f).read_text() if (root / f).exists() else ""
        for need in ("Content-Security-Policy", "default-src 'none'", "frame-ancestors 'none'", "Strict-Transport-Security"):
            if need not in text:
                errs.append(f"{f}: missing {need}")

    for e in errs:
        print("FAIL", e)
    print(f"{len(errs)} problem(s) in {len(pages)} pages." if errs else f"All {len(pages)} pages pass.")
    return 1 if errs else 0


if __name__ == "__main__":
    sys.exit(main(sys.argv[1] if len(sys.argv) > 1 else "_site"))
