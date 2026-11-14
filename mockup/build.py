#!/usr/bin/env python3
"""Build the multi-page mock-up from shared templates.

Writes home.html (the artifact's main page: no doctype, the host wraps it), index.html (the same
page as a full document, for local testing) and the sub-pages. A dry run for Eleventy on the real site.
Usage: python3 mockup/build.py
"""
import html
import json
import pathlib

from PIL import Image

ROOT = pathlib.Path(__file__).parent
PH = ROOT / "photos"
FONTS = ('<link rel="preconnect" href="https://fonts.googleapis.com">'
         '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'
         '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght,SOFT@0,9..144,400..700,0..100;1,9..144,400..700,0..100&amp;family=Zen+Kaku+Gothic+New:wght@400;500;700&amp;display=swap">')


def size(name):
    return Image.open(PH / f"{name}.webp").size


# ---------------------------------------------------------------- photos
PHOTOS = {  # name: (Danish caption, English caption, series)
    "storkespringvandet": ("København i sit naturlige element: regn. Storkespringvandet på Strøget.", "Copenhagen in its natural habitat: rain. Storkespringvandet on Strøget.", "kbh"),
    "norreport": ("Nørreport i tusmørke", "Nørreport at dusk", "kbh"),
    "nikolaj": ("Nikolaj Kirke, med Øresundsbroen i baggrunden", "Nikolaj Church, with the Øresund Bridge behind it", "kbh"),
    "designmuseum": ("Designmuseum Danmark. En væg af stole.", "Designmuseum Danmark. A wall of chairs.", "kbh"),
    "pink-room": ("Et lyserødt rum. Jeg havde ikke noget valg.", "A pink room. I had no choice.", "kbh"),
    "embassy-silos": ("Den tyske ambassade, med FN-byen i symmetrien", "The German embassy, with UN City framed in the symmetry", "kbh"),
    "battersea": ("Battersea Power Station i skumringen, London", "Battersea Power Station at dusk, London", "out"),
    "covent-garden": ("Covent Garden, London. En sky med følelser.", "Covent Garden, London. A cloud with feelings.", "out"),
    "arts-et-metiers": ("Musée des Arts et Métiers, Paris. Clément Aders Avion III, et fly formet som en flagermus.", "Musée des Arts et Métiers, Paris. Clément Ader’s Avion III, a plane shaped like a bat.", "out"),
    "notre-dame": ("Notre-Dame de Paris", "Notre-Dame de Paris", "out"),
    "belval": ("Højovnene i Belval, Luxembourg. Industrielle styresystemer: her bliver jeg professionelt nervøs.", "The blast furnaces at Belval, Luxembourg. Industrial control systems: professionally, this is where I get nervous.", "out"),
    "ghost-mural": ("Gadekunst, Luxembourg. Kunstner: kommer snart.", "Street art, Luxembourg. Artist credit: coming soon.", "out"),
    "stephansdom": ("Stephansdom, Wien, set fra tårnet", "Stephansdom, Vienna, seen from the tower", "out"),
    "cormorant": ("En skarv, der tørrer vingerne. Genkendeligt.", "A cormorant drying off. Relatable.", "out"),
}
STRIP = ["storkespringvandet", "covent-garden", "belval", "pink-room", "battersea", "embassy-silos", "cormorant"]


def shot(name, sizes="(max-width: 640px) 50vw, 33vw"):
    da, en, _ = PHOTOS[name]
    w, h = size(f"{name}-800")
    return (f'<figure class="shot"><a class="open" href="photos/{name}.webp" data-full="photos/{name}.webp">'
            f'<img src="photos/{name}-800.webp" srcset="photos/{name}-800.webp 800w, photos/{name}.webp 1600w" sizes="{sizes}" '
            f'width="{w}" height="{h}" loading="lazy" decoding="async" alt="{html.escape(da)}" data-i18n-alt="ph.{name}"></a>'
            f'<figcaption data-i18n="ph.{name}">{html.escape(da)}</figcaption></figure>')


def img(name, alt_da, key, cls="", loading="lazy"):
    w, h = size(name)
    return f'<img src="photos/{name}.webp" width="{w}" height="{h}" alt="{html.escape(alt_da)}" data-i18n-alt="{key}" loading="{loading}" decoding="async"{cls}>'


PHOTO_EN = {f"ph.{k}": v[1] for k, v in PHOTOS.items()}

# ---------------------------------------------------------------- shared chrome
HEADER = '''<header>
  <div class="wrap">
    <a class="brand" href="index.html">
      <svg viewBox="0 0 34 34" aria-hidden="true"><rect width="34" height="34" rx="10" fill="var(--rose)"/><path id="miniSwirl" fill="none" stroke="#FFF7EE" stroke-width="2.6" stroke-linecap="round"/></svg>
      Lena Gibson
    </a>
    <nav aria-label="Main">
      <div class="links">
        <a href="projects.html" data-page="projects" data-i18n="nav.projects">Projekter</a>
        <a href="about.html" data-page="about" data-i18n="nav.about">Om mig</a>
        <a href="photos.html" data-page="photos" data-i18n="nav.photos">Fotos</a>
        <a href="#contact" data-i18n="nav.contact">Kontakt</a>
      </div>
      <div class="tools">
        <button class="tool" id="modeBtn" type="button" aria-label="Dag/aften · Day/evening">Aften</button>
        <button class="tool" id="langBtn" type="button" aria-label="Sprog · Language">EN</button>
      </div>
    </nav>
  </div>
</header>'''

FOOTER = '''  <section id="contact" class="contact-wrap">
    <div class="wrap">
      <div class="contact">
        <h2 data-i18n="c.h2">Sig hej</h2>
        <p data-i18n="c.p">Der er ingen kontaktformular, så der er intet at spamme eller hacke. Skriv bare en mail.</p>
        <div class="addr"><code id="mail">lena@lenagibson.eu</code><button type="button" id="copyBtn" data-i18n="c.copy">Kopiér</button></div>
      </div>
    </div>
  </section>
</main>

<footer>
  <div class="wrap">
    <span data-i18n="f.a">Ingen cookies, ingen trackere, så heller intet cookiebanner.</span>
    <span><span data-i18n="f.thanks">Tak, fordi du kiggede forbi</span> · <a href="https://github.com/Lena-LSG/portfolio" data-i18n="f.src">Kildekode</a></span>
  </div>
</footer>

<dialog class="lb" id="lb" aria-label="Photo"><div class="inner"><img id="lbImg" alt=""><div class="bar"><p id="lbCap"></p><div class="ctl"><button type="button" id="lbPrev" aria-label="Previous">←</button><button type="button" id="lbNext" aria-label="Next">→</button><button type="button" id="lbClose" data-i18n="lb.close">Luk</button></div></div></div></dialog>
<div class="toast" id="toast" role="status" aria-live="polite"></div>'''


def page(slug, title, body, en, artifact=False):
    head = (f'<title>{title}</title>\n<meta name="claude:viewport-fit-sides" content="cover">\n<meta name="page" content="{slug}">\n'
            f'{FONTS}\n<link rel="stylesheet" href="assets/site.css">\n')
    tail = f'<script>window.PAGE_EN = {json.dumps(en, ensure_ascii=False)};</script>\n<script src="assets/site.js"></script>\n'
    inner = f"{HEADER}\n\n<main>\n{body}\n{FOOTER}\n{tail}"
    if artifact:
        return head + "\n" + inner
    return ('<!doctype html>\n<html lang="da">\n<head>\n<meta charset="utf-8">\n'
            '<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">\n'
            f'{head}</head>\n<body>\n{inner}</body>\n</html>\n')


# ---------------------------------------------------------------- project cards
PANEL_KS = '<div class="panel ks"><img src="photos/ks-home.webp" alt="" width="416" height="900" loading="lazy"><img src="photos/ks-word.webp" alt="" width="416" height="900" loading="lazy"></div>'
PANEL_DK = '<div class="panel dk"><div class="letters">æ<span>ø</span>å</div><div class="q" data-i18n="p2.q">“Hvornår blev Danmark medlem af EF?”</div></div>'
PANEL_SITE = '<div class="panel site" aria-hidden="true"><code>$ python3 verify.py .<br><b>All images are clean.</b><br><i>0</i> trackers · <i>0</i> cookies</code></div>'
CARDS = f'''<div class="cards">
        <a class="pcard" href="kanjiskole.html">{PANEL_KS}
          <div class="body"><div class="meta">Android · Web · GPL-3.0</div><h3>Kanjiskole</h3>
            <p data-i18n="p1.short">En app, der lærer dig at læse japansk: kanji i rigtige ord, med spaced repetition. Offline, uden konti og uden trackere.</p>
            <span class="go" data-i18n="p1.go">Læs case study →</span></div></a>
        <div class="pcard">{PANEL_DK}
          <div class="body"><div class="meta" data-i18n="p2.meta">Web · redesign på vej</div><h3>DANSK</h3>
            <p data-i18n="p2.short">Træning til indfødsretsprøven, som holdes ajour, når spørgsmålene skifter. Næste skridt: et sprogspor med en/et, på/i og stød.</p></div></div>
        <a class="pcard" href="https://github.com/Lena-LSG/portfolio">{PANEL_SITE}
          <div class="body"><div class="meta" data-i18n="p3.meta">Web · open source</div><h3>lenagibson.eu</h3>
            <p data-i18n="p3.short">Den her side. Statisk og uden trackere, med en pipeline, der fjerner metadata fra hvert foto, og en CI-test, der fejler, hvis noget slipper igennem.</p>
            <span class="go" data-i18n="p3.go">Kildekode →</span></div></a>
      </div>'''
CARDS_EN = {
    "p1.short": "An app that teaches you to read Japanese: kanji in real words, with spaced repetition. Offline, no accounts, no trackers.",
    "p1.go": "Read the case study →",
    "p2.q": "“When did Denmark join the EC?”", "p2.meta": "Web · redesign underway",
    "p2.short": "Practice for the Danish citizenship test, kept current as the questions change. Next: a language track with en/et, på/i and stød.",
    "p3.meta": "Web · open source",
    "p3.short": "This site. Static and tracker-free, with a pipeline that strips metadata from every photo and a CI check that fails if anything slips through.",
    "p3.go": "Source →",
}

# ---------------------------------------------------------------- home
hw, hh = size("lena-hero")
HOME = f'''  <div class="wrap hero">
    <div>
      <div class="kicker" data-i18n="hero.kicker">Senior Security Engineer · København</div>
      <h1 data-i18n-html="hero.h1">Hej, jeg er Lena. Jeg <em>passer på</em> ting.</h1>
      <p class="intro" data-i18n-html="hero.intro">Jeg er senior security engineer i <strong>Novonesis</strong>’ Cyber Defence Centre. Før det lavede jeg incident response hos <strong>Microsoft DART</strong> og detection engineering hos det britiske finanstilsyn. Om aftenen bygger jeg apps, spiller, ser anime og fotograferer København.</p>
      <div class="cta">
        <a class="btn" href="projects.html" data-i18n="hero.cta">Se, hvad jeg bygger</a>
        <a href="about.html" data-i18n="hero.about">Min historie →</a>
      </div>
    </div>
    <div class="portrait">
      <img src="photos/lena-hero.webp" alt="Lena Gibson" width="{hw}" height="{hh}" fetchpriority="high">
      <button class="friend" id="friend" type="button" aria-label="Kanelsnegl. Tryk for at skifte."><svg viewBox="0 0 200 200" id="friendSvg" aria-hidden="true"></svg></button>
    </div>
  </div>

  <section>
    <div class="wrap teaser">
      {img("lena-glyptotek", "Lena på Glyptoteket, foran en egyptisk kolos", "alt.glyptotek")}
      <div>
        <p class="say" data-i18n-html="t.say">Fysiker af uddannelse, <em>incident responder</em> af temperament.</p>
        <p data-i18n="t.p">Opvokset i England, uddannet i fysik fra University of Leicester og flyttet til København i 2025. Taler engelsk, dansk, japansk og fransk, i den rækkefølge og med faldende selvtillid.</p>
        <a class="more" href="about.html" data-i18n="t.more">Læs hele historien →</a>
      </div>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="head row"><h2 data-i18n="proj.h2">Ting, jeg bygger</h2><a class="more" href="projects.html" data-i18n="proj.all">Alle projekter →</a></div>
      {CARDS}
    </div>
  </section>

  <section>
    <div class="wrap"><div class="head row"><h2 data-i18n="ph.h2">Når jeg har fri</h2><a class="more" href="photos.html" data-i18n="ph.all">Alle fotos →</a></div></div>
    <div class="strip-photos">
      {"".join(shot(n, "(max-width: 640px) 70vw, 340px") for n in STRIP)}
    </div>
  </section>
'''
HOME_EN = {
    "hero.kicker": "Senior Security Engineer · Copenhagen",
    "hero.h1": "Hi, I’m Lena. I <em>look after</em> things.",
    "hero.intro": "I’m a senior security engineer in <strong>Novonesis</strong>’ Cyber Defence Centre. Before that I did incident response at <strong>Microsoft DART</strong> and detection engineering at the UK’s Financial Conduct Authority. In the evenings I build apps, play games, watch anime and photograph Copenhagen.",
    "hero.cta": "See what I build", "hero.about": "My story →",
    "alt.glyptotek": "Lena at the Glyptotek, in front of an Egyptian colossus",
    "t.say": "Physicist by training, <em>incident responder</em> by temperament.",
    "t.p": "Grew up in England, studied physics at the University of Leicester and moved to Copenhagen in 2025. Speaks English, Danish, Japanese and French, in that order and with decreasing confidence.",
    "t.more": "Read the whole story →",
    "proj.h2": "Things I build", "proj.all": "All projects →",
    "ph.h2": "Off hours", "ph.all": "All photos →",
    **CARDS_EN, **PHOTO_EN,
}

# ---------------------------------------------------------------- about
TIMELINE = [  # when_da, when_en, title, org_da, org_en, text_da, text_en, tags, now
    ("okt. 2025 – nu", "Oct 2025 – now", "Senior Security Engineer", "Novonesis · Cyber Defence Centre", "Novonesis · Cyber Defence Centre",
     "Ansvarlig for vores Chronicle SOAR-platform og Azure-sikkerheden. Bygger playbooks og detektioner i Sentinel og Defender XDR, leder DFIR- og insider risk-undersøgelser og præsenterer platform- og CSPM-målinger for CIO og CISO.",
     "Own our Chronicle SOAR platform and Azure cloud security. Build playbooks and detections in Sentinel and Defender XDR, lead DFIR and insider risk investigations, and present platform and CSPM metrics to the CIO and CISO.",
     ["Chronicle SOAR", "Sentinel", "Defender XDR", "Purview", "Volatility"], True),
    ("mar. 2025 – okt. 2025", "Mar 2025 – Oct 2025", "Security Researcher (DART)", "Microsoft", "Microsoft",
     "Incident response under aktive angreb verden over: telemetri, hærdning af identitet og cloud, forensiske artefakter til threat hunters og KQL-detektioner, mens hændelsen stadig stod på. Blandt andet sager med kendte trusselsaktører som Scattered Spider.",
     "Incident response during active attacks around the world: telemetry, identity and cloud hardening, forensic artefacts for threat hunters, and KQL detections while the incident was still live. Including cases involving well-known threat actors such as Scattered Spider.",
     ["Entra ID", "Defender", "Sentinel", "KQL", "PowerShell"], False),
    ("okt. 2022 – feb. 2025", "Oct 2022 – Feb 2025", "Cyber Security Engineer, Threat Detection & Response", "Financial Conduct Authority", "Financial Conduct Authority",
     "Onboardede kritiske logkilder til Sentinel, skrev KQL-detektioner og hunting-forespørgsler, byggede SOAR-automatisering og præsenterede dashboards for ledelsen op til CISO. Tre måneder udstationeret i CSIRT’en.",
     "Onboarded critical log sources into Sentinel, wrote KQL detections and hunting queries, built SOAR automation and presented dashboards to leadership up to CISO. A three-month secondment to the CSIRT.",
     ["Sentinel", "KQL", "SOAR", "Power BI"], False),
    ("aug. 2020 – aug. 2021", "Aug 2020 – Aug 2021", "Level 2 Support, Tools and Workload Manager", "IBM · praktikår", "IBM · placement year",
     "Koordinerede supportsager for et team på over ti ingeniører og reproducerede kundefejl i et RHEL-baseret cloudmiljø.",
     "Coordinated support cases across a team of 10+ engineers and reproduced customer issues in a RHEL-based cloud environment.",
     ["Linux", "Docker", "Kubernetes", "OpenShift"], False),
    ("2017 – 2022", "2017 – 2022", "BSc Physics, First Class Honours", "University of Leicester", "University of Leicester",
     "Medicinsk fysik, anvendt moderne fysik og partikelfysik. Mit afsluttende projekt brugte satellitdata fra ESA og NASA til at undersøge, hvordan klimaforandringer påvirker plantesundheden i Amazonas. Genoplivede universitetets Anime Society efter COVID.",
     "Medical, applied modern and particle physics. My final project used ESA and NASA satellite data to study how climate change affects plant health in the Amazon. Revived the university’s Anime Society after COVID.",
     ["Python", "R"], False),
]


def timeline():
    out, en = [], {}
    for i, (wd, we, title, od, oe, td, te, tags, now) in enumerate(TIMELINE):
        en.update({f"tl{i}.when": we, f"tl{i}.org": oe, f"tl{i}.p": te})
        out.append(f'''<li{' class="now"' if now else ''}><span class="when" data-i18n="tl{i}.when">{wd}</span><div>
            <h3>{title}</h3><div class="org" data-i18n="tl{i}.org">{od}</div><p data-i18n="tl{i}.p">{td}</p>
            <div class="tags">{"".join(f'<span class="tag">{t}</span>' for t in tags)}</div></div></li>''')
    return "\n          ".join(out), en


TL_HTML, TL_EN = timeline()
LENA = [("lena-graduation", "Dimission foran fysikbygningen i Leicester", "Første klasse, fysik, Leicester", "Graduating outside the physics building in Leicester", "First class, physics, Leicester", ' style="object-position: 72% 50%"'),
        ("lena-glyptotek", "Lena på Glyptoteket, foran en egyptisk kolos", "Glyptoteket. Jeg er den yngste på billedet.", "Lena at the Glyptotek, in front of an Egyptian colossus", "The Glyptotek. I’m the youngest one in the photo.", ""),
        ("lena-pride", "Lena med regnbuer malet på kinderne", "Pride. Med regnbuer, selvfølgelig.", "Lena with rainbows painted on her cheeks", "Pride. Rainbows, obviously.", ""),
        ("lena-lakes", "Lena på de tilfrosne søer i København", "Søerne frøs til, og hele København gik en tur på dem.", "Lena on Copenhagen’s frozen Lakes", "The Lakes froze, and all of Copenhagen went for a walk on them.", "")]
LENA_HTML = "\n        ".join(
    f'<figure>{img(n, ad, "alt." + n).replace(" loading", f"{st} loading")}<figcaption data-i18n="cap.{n}">{cd}</figcaption></figure>' for n, ad, cd, ae, ce, st in LENA)
LENA_EN = {**{f"alt.{n}": ae for n, ad, cd, ae, ce, st in LENA}, **{f"cap.{n}": ce for n, ad, cd, ae, ce, st in LENA}}

ABOUT = f'''  <div class="wrap page-head">
    <h1 data-i18n-html="a.h1">Om <em>mig</em></h1>
    <p data-i18n="a.lede">Den lange version. Den er stadig ret kort.</p>
  </div>

  <section>
    <div class="wrap story">
      <div class="prose">
        <p data-i18n="a.p1">Jeg hedder Lena. Jeg voksede op i England, læste fysik på University of Leicester og endte i sikkerhed, fordi jeg altid har været typen, der vil vide, hvordan ting går i stykker.</p>
        <p data-i18n="a.p2">Under studiet var jeg et år i praktik hos IBM. Efter eksamen startede jeg hos Financial Conduct Authority, Storbritanniens finanstilsyn, hvor jeg byggede detektioner og automatisering. Så kom Microsoft DART og incident response: det opkald, der kommer, når en organisations værste uge lige er begyndt.</p>
        <p data-i18n="a.p3">I 2025 flyttede jeg til København. Storbritannien var blevet et fjendtligt sted for transkønnede, og Danmark har vist sig at være et sted, hvor jeg føler mig tryg og velkommen. Målt som et incident er det et af de bedre udfald. I dag er jeg senior security engineer i Novonesis’ Cyber Defence Centre.</p>
        <p data-i18n="a.p4">Når jeg har fri, bygger jeg apps, tager billeder, spiller for meget og ser anime med undertekster, som jeg prøver ikke at læse. Jeg kæmper stadig med stødet og har meninger om kanelsnegle.</p>
      </div>
      <figure>{img("lena-zurich", "Lena på en færge på Zürichsøen", "alt.zurich")}<figcaption data-i18n="cap.zurich">Zürichsøen. Den ene gang, jeg så ud, som om jeg havde styr på det hele.</figcaption></figure>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="head"><h2 data-i18n="a.exp">Erfaring og uddannelse</h2></div>
      <ol class="timeline">
          {TL_HTML}
      </ol>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="head"><h2 data-i18n="a.proof">Bevis på, at jeg findes</h2></div>
      <div class="lena">
        {LENA_HTML}
      </div>
    </div>
  </section>

  <section>
    <div class="wrap">
      <div class="head"><h2 data-i18n="a.facts">Kort fortalt</h2></div>
      <div class="facts">
        <div class="fact"><h3 data-i18n="f1.h">Sprog</h3><ul>
          <li><b data-i18n="f1.en">Engelsk</b><span data-i18n="f1.en.v">modersmål</span></li>
          <li><b data-i18n="f1.da">Dansk</b><span data-i18n="f1.da.v">næsten flydende</span></li>
          <li><b data-i18n="f1.ja">Japansk</b><span>B2</span></li>
          <li><b data-i18n="f1.fr">Fransk</b><span>B1/B2</span></li></ul></div>
        <div class="fact"><h3 data-i18n="f2.h">Værktøjskassen</h3><p>Sentinel, Defender XDR, Chronicle SOAR, Entra ID, Purview, KQL, Python, PowerShell, KAPE, Volatility. <span data-i18n="f2.cert">Certificeret:</span> SC-200.</p></div>
        <div class="fact"><h3 data-i18n="f3.h">Lige nu</h3><ul>
          <li><b data-i18n="f3.b">Bygger</b><span data-i18n="f3.bv">den her side, så DANSK</span></li>
          <li><b data-i18n="f3.p">Spiller</b><span data-i18n="f3.todo">[udfyld]</span></li>
          <li><b data-i18n="f3.w">Ser</b><span data-i18n="f3.todo">[udfyld]</span></li></ul></div>
        <div class="fact"><h3 data-i18n="f4.h">Fritid</h3><p data-i18n="f4.p">Spil, anime, fotografi og et løbende feltstudie i Københavns kanelsnegle. Resultaterne er fortrolige.</p></div>
      </div>
      <p class="stamp" data-i18n="a.stamp">Opdateret november 2026.</p>
    </div>
  </section>
'''
ABOUT_EN = {
    "a.h1": "About <em>me</em>", "a.lede": "The long version. It’s still fairly short.",
    "a.p1": "I’m Lena. I grew up in England, studied physics at the University of Leicester, and ended up in security because I’ve always been the person who wants to know how things break.",
    "a.p2": "During my degree I spent a placement year at IBM. After graduating I joined the Financial Conduct Authority, the UK’s financial regulator, building detections and automation. Then came Microsoft DART and incident response: the call that comes in when an organisation’s worst week has just started.",
    "a.p3": "In 2025 I moved to Copenhagen. The UK had become a hostile place for trans people, and Denmark has turned out to be somewhere I feel safe and welcome. As incident outcomes go, it’s one of the better ones. Today I’m a senior security engineer in Novonesis’ Cyber Defence Centre.",
    "a.p4": "Off hours I build apps, take photos, play too many games and watch anime with subtitles I try not to read. I still fight with Danish stød and have opinions about cinnamon buns.",
    "alt.zurich": "Lena on a ferry on Lake Zürich", "cap.zurich": "Lake Zürich. The one time I looked like I had it all together.",
    "a.exp": "Experience and education", "a.proof": "Proof that I exist", "a.facts": "In short",
    "f1.h": "Languages", "f1.en": "English", "f1.en.v": "native", "f1.da": "Danish", "f1.da.v": "near-native", "f1.ja": "Japanese", "f1.fr": "French",
    "f2.h": "Toolbox", "f2.cert": "Certified:",
    "f3.h": "Right now", "f3.b": "Building", "f3.bv": "this site, then DANSK", "f3.p": "Playing", "f3.w": "Watching", "f3.todo": "[fill in]",
    "f4.h": "Off hours", "f4.p": "Games, anime, photography and an ongoing field study of Copenhagen’s cinnamon buns. The findings are classified.",
    "a.stamp": "Updated November 2026.",
    **TL_EN, **LENA_EN,
}

# ---------------------------------------------------------------- projects
PROJECTS = f'''  <div class="wrap page-head">
    <h1 data-i18n-html="pr.h1">Ting, jeg <em>bygger</em></h1>
    <p data-i18n="pr.lede">Fritidsprojekter med samme standard som på arbejdet: trusselsmodel først, ingen trackere og åben kildekode.</p>
  </div>
  <section style="border-top: 0; padding-top: 0">
    <div class="wrap">
      {CARDS}
    </div>
  </section>
'''
PROJECTS_EN = {"pr.h1": "Things I <em>build</em>", "pr.lede": "Side projects held to the same standard as work: threat model first, no trackers and open source.", **CARDS_EN}

# ---------------------------------------------------------------- kanjiskole case study
KS = '''  <div class="wrap page-head">
    <div class="crumbs"><a href="projects.html" data-i18n="ks.crumb">Projekter</a> / Kanjiskole</div>
    <h1>Kanjiskole</h1>
    <p data-i18n="ks.lede">En app, der lærer dig at læse japansk. Et fritidsprojekt, bygget efter de samme krav, som jeg stiller på arbejdet.</p>
  </div>
  <section style="border-top: 0; padding-top: 0">
    <div class="wrap">
      <div class="phones" aria-label="Screenshots">
        <img src="photos/ks-home.webp" width="416" height="900" alt="Forsiden" data-i18n-alt="ks.s1">
        <img src="photos/ks-word.webp" width="416" height="900" alt="Et kanji med eksempelord" data-i18n-alt="ks.s2">
        <img src="photos/ks-session.webp" width="416" height="900" alt="En øvelse" data-i18n-alt="ks.s3">
        <img src="photos/ks-stats.webp" width="416" height="900" alt="Statistik" data-i18n-alt="ks.s4">
      </div>
      <div class="case">
        <div class="prose">
          <h2 data-i18n="ks.h1">Problemet</h2>
          <p data-i18n="ks.p1">De fleste kanji-apps lærer dig tegnene ét ad gangen, uden sammenhæng. Men man læser ikke tegn, man læser ord. Og mange apps vil have en konto, sender analytics hjem og holder dine data som gidsel.</p>
          <h2 data-i18n="ks.h2">Tilgangen</h2>
          <ul>
            <li data-i18n="ks.l1">Kanji i rigtige ord, plus kana og ordforråd</li>
            <li data-i18n="ks.l2">Spaced repetition med FSRS, så gennemgangen kommer, lige før du glemmer</li>
            <li data-i18n="ks.l3">Alt virker offline, og dine data bliver på telefonen</li>
            <li data-i18n="ks.l4">Et mørkt, roligt design med en stor glyf i baggrunden</li>
          </ul>
          <h2 data-i18n="ks.h3">Sikkerhed og privatliv</h2>
          <p data-i18n="ks.p3">Jeg behandlede appen som et rigtigt produkt: trusselsmodel og sikkerhedsgennemgang før v1.0, ingen konti og ingen analytics. Afhængigheder er låst til præcise versioner, og alle ordbogskilder er krediteret og licenseret korrekt, så projektet er REUSE-compliant.</p>
          <h2 data-i18n="ks.h4">Hvad jeg lærte</h2>
          <ul>
            <li data-i18n-html="ks.w1">Native moduler skal matche Expo SDK’ens versionstabel præcist. Nu tjekker et script det: <code>npm run check:native</code>.</li>
            <li data-i18n="ks.w2">Efter ét forkert gæt om et crash: hent logcat. Ikke et gæt mere.</li>
          </ul>
          <h2 data-i18n="ks.h5">Hvad nu</h2>
          <p data-i18n="ks.p5">Synkronisering, flere stemmer til ord uden lydfil og håndskriftsøvelser med stregrækkefølge.</p>
        </div>
        <aside>
          <div class="fact"><ul>
            <li><b>Status</b><span>v1.0.0</span></li>
            <li><b data-i18n="ks.a.pl">Platforme</b><span>Android, web</span></li>
            <li><b data-i18n="ks.a.li">Licens</b><span>GPL-3.0</span></li>
            <li><b data-i18n="ks.a.st">Stak</b><span>React Native, Expo, TypeScript</span></li>
            <li><b data-i18n="ks.a.re">Repetition</b><span>FSRS</span></li></ul></div>
          <a class="btn" href="https://github.com/Lena-LSG/Kanjiskole" data-i18n="ks.a.src">Kildekode på GitHub</a>
          <a class="more" href="https://github.com/Lena-LSG/Kanjiskole/releases" data-i18n="ks.a.apk">Hent APK’en →</a>
        </aside>
      </div>
    </div>
  </section>
'''
KS_EN = {
    "ks.crumb": "Projects", "ks.lede": "An app that teaches you to read Japanese. A side project, built to the same standards I hold at work.",
    "ks.s1": "The home screen", "ks.s2": "A kanji with example words", "ks.s3": "A practice session", "ks.s4": "Statistics",
    "ks.h1": "The problem", "ks.p1": "Most kanji apps teach characters one at a time, out of context. But you don’t read characters, you read words. And many apps want an account, send analytics home and hold your data hostage.",
    "ks.h2": "The approach", "ks.l1": "Kanji in real words, plus kana and vocabulary", "ks.l2": "Spaced repetition with FSRS, so reviews arrive just before you forget",
    "ks.l3": "Everything works offline, and your data stays on the phone", "ks.l4": "A dark, calm design with a large glyph in the background",
    "ks.h3": "Security and privacy", "ks.p3": "I treated the app like a real product: threat model and security review before v1.0, no accounts and no analytics. Dependencies are pinned to exact versions, and every dictionary source is credited and correctly licensed, so the project is REUSE-compliant.",
    "ks.h4": "What I learned", "ks.w1": "Native modules have to match the Expo SDK’s version table exactly. Now a script checks it: <code>npm run check:native</code>.",
    "ks.w2": "After one wrong guess about a crash: get logcat. No more guessing.",
    "ks.h5": "What’s next", "ks.p5": "Sync, more voices for words without audio, and handwriting drills with stroke order.",
    "ks.a.pl": "Platforms", "ks.a.li": "Licence", "ks.a.st": "Stack", "ks.a.re": "Repetition", "ks.a.src": "Source on GitHub", "ks.a.apk": "Get the APK →",
}

# ---------------------------------------------------------------- photos
SERIES = [("kbh", "København", "Copenhagen"), ("out", "Udenbys", "Out of town")]


def series():
    nav = " ".join(f'<a href="#s-{k}" data-i18n="s.{k}">{da}</a>' for k, da, en in SERIES)
    blocks = []
    for k, da, en in SERIES:
        names = [n for n, v in PHOTOS.items() if v[2] == k]
        blocks.append(f'''<div class="series" id="s-{k}"><div class="head"><h2 data-i18n="s.{k}">{da}</h2><span class="count" data-i18n="s.{k}.n">{len(names)} billeder</span></div>
        <div class="masonry">{"".join(shot(n) for n in names)}</div></div>''')
    en_map = {**{f"s.{k}": en for k, da, en in SERIES}, **{f"s.{k}.n": f"{sum(1 for v in PHOTOS.values() if v[2] == k)} photos" for k, da, en in SERIES}}
    return nav, "\n      ".join(blocks), en_map


S_NAV, S_HTML, S_EN = series()
PHOTOS_PAGE = f'''  <div class="wrap page-head">
    <h1 data-i18n="pp.h1">Fotos</h1>
    <p data-i18n="pp.lede">København, mest i dårligt vejr. Og hvor toget ellers kører hen. Tryk på et billede for at se det stort.</p>
    <div class="series-nav">{S_NAV}</div>
  </div>
  <section style="border-top: 0; padding-top: 0">
    <div class="gallery">
      {S_HTML}
    </div>
  </section>
'''
PHOTOS_EN = {"pp.h1": "Photos", "pp.lede": "Copenhagen, mostly in bad weather. And wherever the train goes. Tap a photo to see it large.", **S_EN, **PHOTO_EN}

# ---------------------------------------------------------------- write
OUT = {
    "home.html": page("home", "lenagibson.eu mock-up", HOME, HOME_EN, artifact=True),
    "index.html": page("home", "Lena Gibson", HOME, HOME_EN),
    "about.html": page("about", "Om mig · Lena Gibson", ABOUT, ABOUT_EN),
    "projects.html": page("projects", "Projekter · Lena Gibson", PROJECTS, PROJECTS_EN),
    "kanjiskole.html": page("projects", "Kanjiskole · Lena Gibson", KS, KS_EN),
    "photos.html": page("photos", "Fotos · Lena Gibson", PHOTOS_PAGE, PHOTOS_EN),
}
for name, text in OUT.items():
    (ROOT / name).write_text(text)
    print("wrote", name)
