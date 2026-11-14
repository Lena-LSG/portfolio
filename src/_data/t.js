// All page text, Danish and English side by side. Strings with HTML are marked _html.
export default {
  // ---- shared chrome
  skip: { da: "Gå til indhold", en: "Skip to content" },
  nav: {
    projects: { da: "Projekter", en: "Projects" },
    about: { da: "Om mig", en: "About" },
    photos: { da: "Fotos", en: "Photos" },
    contact: { da: "Kontakt", en: "Contact" },
  },
  otherLang: { da: "English", en: "Dansk" },
  otherLangShort: { da: "EN", en: "DA" },
  modeBtn: { da: "Aften", en: "Evening" },
  modeLabel: { da: "Skift mellem dag og aften", en: "Switch between day and evening" },
  contact: {
    h2: { da: "Sig hej", en: "Say hello" },
    p: { da: "Der er ingen kontaktformular, så der er intet at spamme eller hacke. Skriv bare en mail.", en: "There’s no contact form, so there’s nothing to spam or hack. Just send an email." },
    copy: { da: "Kopiér", en: "Copy" },
  },
  footer: {
    a: { da: "Ingen cookies, ingen trackere, så heller intet cookiebanner.", en: "No cookies, no trackers, so no cookie banner either." },
    thanks: { da: "Tak, fordi du kiggede forbi", en: "Thanks for stopping by" },
    src: { da: "Kildekode", en: "Source" },
    sec: { da: "Sikkerhed", en: "Security" },
  },
  lb: { close: { da: "Luk", en: "Close" }, prev: { da: "Forrige", en: "Previous" }, next: { da: "Næste", en: "Next" }, label: { da: "Foto", en: "Photo" } },
  friendLabel: { da: "Kanelsnegl. Tryk for at skifte.", en: "Cinnamon bun. Tap to switch." },

  // ---- page titles and descriptions
  meta: {
    home: { title: { da: "Lena Gibson · Security engineer i København", en: "Lena Gibson · Security engineer in Copenhagen" },
            desc: { da: "Lena Gibson er senior security engineer i København. Incident response, detection engineering og apps bygget med privatliv først.", en: "Lena Gibson is a senior security engineer in Copenhagen. Incident response, detection engineering and apps built privacy first." } },
    about: { title: { da: "Om mig · Lena Gibson", en: "About · Lena Gibson" },
             desc: { da: "Fra fysik i Leicester over Microsoft DART til København: Lena Gibsons historie, erfaring og sprog.", en: "From physics in Leicester via Microsoft DART to Copenhagen: Lena Gibson’s story, experience and languages." } },
    projects: { title: { da: "Projekter · Lena Gibson", en: "Projects · Lena Gibson" },
                desc: { da: "Fritidsprojekter med samme standard som på arbejdet: trusselsmodel først, ingen trackere og åben kildekode.", en: "Side projects held to the same standard as work: threat model first, no trackers and open source." } },
    kanjiskole: { title: { da: "Kanjiskole · Lena Gibson", en: "Kanjiskole · Lena Gibson" },
                  desc: { da: "Kanjiskole lærer dig at læse japansk med kanji i rigtige ord og spaced repetition. Offline, uden konti og uden trackere.", en: "Kanjiskole teaches you to read Japanese with kanji in real words and spaced repetition. Offline, no accounts, no trackers." } },
    photos: { title: { da: "Fotos · Lena Gibson", en: "Photos · Lena Gibson" },
              desc: { da: "København, mest i dårligt vejr. Og hvor toget ellers kører hen.", en: "Copenhagen, mostly in bad weather. And wherever the train goes." } },
    notFound: { title: { da: "Siden findes ikke · Lena Gibson", en: "Page not found · Lena Gibson" }, desc: { da: "Siden findes ikke.", en: "Page not found." } },
  },

  // ---- home
  home: {
    kicker: { da: "Senior Security Engineer · København", en: "Senior Security Engineer · Copenhagen" },
    h1_html: { da: "Hej, jeg er Lena. Jeg <em>passer på</em> ting.", en: "Hi, I’m Lena. I <em>look after</em> things." },
    intro_html: { da: "Jeg er senior security engineer i <strong>Novonesis</strong>’ Cyber Defence Centre. Før det lavede jeg incident response hos <strong>Microsoft DART</strong> og detection engineering hos det britiske finanstilsyn. Om aftenen bygger jeg apps, spiller, ser anime og fotograferer København.",
                  en: "I’m a senior security engineer in <strong>Novonesis</strong>’ Cyber Defence Centre. Before that I did incident response at <strong>Microsoft DART</strong> and detection engineering at the UK’s Financial Conduct Authority. In the evenings I build apps, play games, watch anime and photograph Copenhagen." },
    cta: { da: "Se, hvad jeg bygger", en: "See what I build" },
    story: { da: "Min historie →", en: "My story →" },
    teaserAlt: { da: "Lena på Glyptoteket, foran en egyptisk kolos", en: "Lena at the Glyptotek, in front of an Egyptian colossus" },
    say_html: { da: "Fysiker af uddannelse, <em>incident responder</em> af temperament.", en: "Physicist by training, <em>incident responder</em> by temperament." },
    teaser: { da: "Opvokset i England, uddannet i fysik fra University of Leicester og flyttet til København i 2025. Taler engelsk, dansk, japansk og fransk, i den rækkefølge og med faldende selvtillid.",
              en: "Grew up in England, studied physics at the University of Leicester and moved to Copenhagen in 2025. Speaks English, Danish, Japanese and French, in that order and with decreasing confidence." },
    more: { da: "Læs hele historien →", en: "Read the whole story →" },
    projH2: { da: "Ting, jeg bygger", en: "Things I build" },
    projAll: { da: "Alle projekter →", en: "All projects →" },
    phH2: { da: "Når jeg har fri", en: "Off hours" },
    phAll: { da: "Alle fotos →", en: "All photos →" },
  },

  // ---- project cards
  cards: {
    ksShort: { da: "En app, der lærer dig at læse japansk: kanji i rigtige ord, med spaced repetition. Offline, uden konti og uden trackere.", en: "An app that teaches you to read Japanese: kanji in real words, with spaced repetition. Offline, no accounts, no trackers." },
    ksGo: { da: "Læs case study →", en: "Read the case study →" },
    dkQ: { da: "“Hvornår blev Danmark medlem af EF?”", en: "“When did Denmark join the EC?”" },
    dkMeta: { da: "Web · redesign på vej", en: "Web · redesign underway" },
    dkShort: { da: "Træning til indfødsretsprøven, som holdes ajour, når spørgsmålene skifter. Næste skridt: et sprogspor med en/et, på/i og stød.", en: "Practice for the Danish citizenship test, kept current as the questions change. Next: a language track with en/et, på/i and stød." },
    siteMeta: { da: "Web · open source", en: "Web · open source" },
    siteShort: { da: "Den her side. Statisk og uden trackere, med en pipeline, der fjerner metadata fra hvert foto, og en CI-test, der fejler, hvis noget slipper igennem.", en: "This site. Static and tracker-free, with a pipeline that strips metadata from every photo and a CI check that fails if anything slips through." },
    siteGo: { da: "Kildekode →", en: "Source →" },
  },

  // ---- projects page
  projects: {
    h1_html: { da: "Ting, jeg <em>bygger</em>", en: "Things I <em>build</em>" },
    lede: { da: "Fritidsprojekter med samme standard som på arbejdet: trusselsmodel først, ingen trackere og åben kildekode.", en: "Side projects held to the same standard as work: threat model first, no trackers and open source." },
  },

  // ---- kanjiskole
  ks: {
    lede: { da: "En app, der lærer dig at læse japansk. Et fritidsprojekt, bygget efter de samme krav, som jeg stiller på arbejdet.", en: "An app that teaches you to read Japanese. A side project, built to the same standards I hold at work." },
    shots: [
      { name: "ks-home", alt: { da: "Forsiden", en: "The home screen" } },
      { name: "ks-word", alt: { da: "Et kanji med eksempelord", en: "A kanji with example words" } },
      { name: "ks-session", alt: { da: "En øvelse", en: "A practice session" } },
      { name: "ks-stats", alt: { da: "Statistik", en: "Statistics" } },
    ],
    h1: { da: "Problemet", en: "The problem" },
    p1: { da: "De fleste kanji-apps lærer dig tegnene ét ad gangen, uden sammenhæng. Men man læser ikke tegn, man læser ord. Og mange apps vil have en konto, sender analytics hjem og holder dine data som gidsel.", en: "Most kanji apps teach characters one at a time, out of context. But you don’t read characters, you read words. And many apps want an account, send analytics home and hold your data hostage." },
    h2: { da: "Tilgangen", en: "The approach" },
    approach: [
      { da: "Kanji i rigtige ord, plus kana og ordforråd", en: "Kanji in real words, plus kana and vocabulary" },
      { da: "Spaced repetition med FSRS, så gennemgangen kommer, lige før du glemmer", en: "Spaced repetition with FSRS, so reviews arrive just before you forget" },
      { da: "Alt virker offline, og dine data bliver på telefonen", en: "Everything works offline, and your data stays on the phone" },
      { da: "Et mørkt, roligt design med en stor glyf i baggrunden", en: "A dark, calm design with a large glyph in the background" },
    ],
    h3: { da: "Sikkerhed og privatliv", en: "Security and privacy" },
    p3: { da: "Jeg behandlede appen som et rigtigt produkt: trusselsmodel og sikkerhedsgennemgang før v1.0, ingen konti og ingen analytics. Afhængigheder er låst til præcise versioner, og alle ordbogskilder er krediteret og licenseret korrekt, så projektet er REUSE-compliant.", en: "I treated the app like a real product: threat model and security review before v1.0, no accounts and no analytics. Dependencies are pinned to exact versions, and every dictionary source is credited and correctly licensed, so the project is REUSE-compliant." },
    h4: { da: "Hvad jeg lærte", en: "What I learned" },
    learned_html: [
      { da: "Native moduler skal matche Expo SDK’ens versionstabel præcist. Nu tjekker et script det: <code>npm run check:native</code>.", en: "Native modules have to match the Expo SDK’s version table exactly. Now a script checks it: <code>npm run check:native</code>." },
      { da: "Efter ét forkert gæt om et crash: hent logcat. Ikke et gæt mere.", en: "After one wrong guess about a crash: get logcat. No more guessing." },
    ],
    h5: { da: "Hvad nu", en: "What’s next" },
    p5: { da: "Synkronisering, flere stemmer til ord uden lydfil og håndskriftsøvelser med stregrækkefølge.", en: "Sync, more voices for words without audio, and handwriting drills with stroke order." },
    platforms: { da: "Platforme", en: "Platforms" }, licence: { da: "Licens", en: "Licence" }, stack: { da: "Stak", en: "Stack" }, rep: { da: "Repetition", en: "Repetition" },
    src: { da: "Kildekode på GitHub", en: "Source on GitHub" }, apk: { da: "Hent APK’en →", en: "Get the APK →" },
    shotsLabel: { da: "Skærmbilleder", en: "Screenshots" },
  },

  // ---- about
  about: {
    h1_html: { da: "Om <em>mig</em>", en: "About <em>me</em>" },
    lede: { da: "Den lange version. Den er stadig ret kort.", en: "The long version. It’s still fairly short." },
    story: [
      { da: "Jeg hedder Lena. Jeg voksede op i England, læste fysik på University of Leicester og endte i sikkerhed, fordi jeg altid har været typen, der vil vide, hvordan ting går i stykker.",
        en: "I’m Lena. I grew up in England, studied physics at the University of Leicester, and ended up in security because I’ve always been the person who wants to know how things break." },
      { da: "Under studiet var jeg et år i praktik hos IBM. Efter eksamen startede jeg hos Financial Conduct Authority, Storbritanniens finanstilsyn, hvor jeg byggede detektioner og automatisering. Så kom Microsoft DART og incident response: det opkald, der kommer, når en organisations værste uge lige er begyndt.",
        en: "During my degree I spent a placement year at IBM. After graduating I joined the Financial Conduct Authority, the UK’s financial regulator, building detections and automation. Then came Microsoft DART and incident response: the call that comes in when an organisation’s worst week has just started." },
      { da: "I 2025 flyttede jeg til København. Storbritannien var blevet et fjendtligt sted for transkønnede, og Danmark har vist sig at være et sted, hvor jeg føler mig tryg og velkommen. Målt som et incident er det et af de bedre udfald. I dag er jeg senior security engineer i Novonesis’ Cyber Defence Centre.",
        en: "In 2025 I moved to Copenhagen. The UK had become a hostile place for trans people, and Denmark has turned out to be somewhere I feel safe and welcome. As incident outcomes go, it’s one of the better ones. Today I’m a senior security engineer in Novonesis’ Cyber Defence Centre." },
      { da: "Når jeg har fri, bygger jeg apps, tager billeder, spiller for meget og ser anime med undertekster, som jeg prøver ikke at læse. Jeg kæmper stadig med stødet og har meninger om kanelsnegle.",
        en: "Off hours I build apps, take photos, play too many games and watch anime with subtitles I try not to read. I still fight with Danish stød and have opinions about cinnamon buns." },
    ],
    zurichAlt: { da: "Lena på en færge på Zürichsøen", en: "Lena on a ferry on Lake Zürich" },
    zurichCap: { da: "Zürichsøen. Den ene gang, jeg så ud, som om jeg havde styr på det hele.", en: "Lake Zürich. The one time I looked like I had it all together." },
    exp: { da: "Erfaring og uddannelse", en: "Experience and education" },
    proof: { da: "Bevis på, at jeg findes", en: "Proof that I exist" },
    facts: { da: "Kort fortalt", en: "In short" },
    langs: { da: "Sprog", en: "Languages" },
    langList: [
      { name: { da: "Engelsk", en: "English" }, level: { da: "modersmål", en: "native" } },
      { name: { da: "Dansk", en: "Danish" }, level: { da: "næsten flydende", en: "near-native" } },
      { name: { da: "Japansk", en: "Japanese" }, level: { da: "B2", en: "B2" } },
      { name: { da: "Fransk", en: "French" }, level: { da: "B1/B2", en: "B1/B2" } },
    ],
    tools: { da: "Værktøjskassen", en: "Toolbox" },
    toolsText: { da: "Sentinel, Defender XDR, Chronicle SOAR, Entra ID, Purview, KQL, Python, PowerShell, KAPE, Volatility. Certificeret: SC-200.", en: "Sentinel, Defender XDR, Chronicle SOAR, Entra ID, Purview, KQL, Python, PowerShell, KAPE, Volatility. Certified: SC-200." },
    now: { da: "Lige nu", en: "Right now" },
    nowList: [
      { k: { da: "Bygger", en: "Building" }, v: { da: "den her side, så DANSK", en: "this site, then DANSK" } },
      { k: { da: "Spiller", en: "Playing" }, v: { da: "[udfyld]", en: "[fill in]" } },
      { k: { da: "Ser", en: "Watching" }, v: { da: "[udfyld]", en: "[fill in]" } },
    ],
    off: { da: "Fritid", en: "Off hours" },
    offText: { da: "Spil, anime, fotografi og et løbende feltstudie i Københavns kanelsnegle. Resultaterne er fortrolige.", en: "Games, anime, photography and an ongoing field study of Copenhagen’s cinnamon buns. The findings are classified." },
    stamp: { da: "Opdateret", en: "Updated" },
  },

  // ---- photos
  photosPage: {
    lede: { da: "København, mest i dårligt vejr. Og hvor toget ellers kører hen. Tryk på et billede for at se det stort.", en: "Copenhagen, mostly in bad weather. And wherever the train goes. Tap a photo to see it large." },
    count: { da: "billeder", en: "photos" },
  },

  // ---- 404
  notFound: {
    h1_html: { da: "Den side <em>findes ikke</em>", en: "That page <em>doesn’t exist</em>" },
    p: { da: "Enten er linket forkert, eller også har jeg flyttet noget. Root cause: sandsynligvis mig.", en: "Either the link is wrong or I’ve moved something. Root cause: probably me." },
    home: { da: "Til forsiden", en: "Go to the home page" },
  },
};
