# Client Site Build Prompt

Instructions for building a client website. To start a build, just tell Claude the domain — e.g. "Build a new site for acme.co.uk — read the build prompt and client brief."

**Working directory:** `D:\claude-custom-projects\Ai-Editor`
**Master template:** `D:\claude-custom-projects\Ai-Editor\master-site-template\`
**Client sites:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`
**Brief template:** `D:\claude-custom-projects\Ai-Editor\master-site-template\CLIENT-BRIEF-TEMPLATE.md`
**Method:** `D:\claude-custom-projects\Ai-Editor\GAUNTLET-PROMPT.md`

---

## How to start a build

1. Copy `CLIENT-BRIEF-TEMPLATE.md` to `Ai-Editor-Sites/{domain}/client-brief.md` and fill it in
2. Tell Claude: "Build a new site for {domain} — read the build prompt and client brief"
3. Claude reads this file + the client brief and works autonomously

---

## What this file is, and is not

It is the **build procedure** for the flat platform. The build *shape* — why the slice comes
first, what a blind critic is for, the cross-page critic, why each gate exists and what a stop
is — lives once in `GAUNTLET-PROMPT.md`. **Read that first**, and do not expect it repeated
here. What follows is the flat-specific half: which two pages to build first, which scripts gate
them, and the component, layout, copy and QC rules for a static HTML site.

## Session start — check the library before you build against it

Run this from the repo root, **before anything is laid out**, every session:

```
python scripts/validate_library.py          # exit 0 required; --json for machine output
```

It validates the **library itself** — the palettes and font pairings in
`master-site-template/themes/`, the style rows in `demo-design-tokens.md`, and every component
`COMPONENTS.md` claims exists — not a built site. It prints `  ERROR  <msg>` / `  warn   <msg>`
lines then a total; exit 1 on any ERROR.

Run it first because building against a broken library is the expensive failure, not the loud
one. A palette or pairing named in the docs but missing from `themes/` is a **library bug and a
stop**: Forest & Cream had no entry on either platform, so a build shipped a mustard accent
against the demo's warm tan and nothing failed until the client looked at it.

Then prove the capture route, before you rely on a single screenshot:

```
python scripts/shots.py --selftest
```

`--selftest` captures one known-good PUBLIC url (example.com, deliberately not one of ours, so a
failure means the ROUTE is broken rather than our site being down) and exits non-zero if the
route is broken. It takes no base URL — the site does not exist yet at this point. **If it
fails, fix the route.** It never degrades to a DOM measurement, a `javascript_tool` query,
curl+grep, or a subagent's "screenshot reviewed" — those prove the markup is *correct*, never
that the page *looks right*. A broken capture route is a gate failure, not one of the two
conditional stops below: repair it and carry on, don't ask.

## Slice first — build two pages, not twelve

**The slice is `index.html` plus the single most-repeated inner archetype.** Pick the archetype
by how much approving it settles: group the pages in the planned nav by shape and take the
largest group. On a flat site that is usually the standard content page — `page-header` +
alternating content sections + CTA — so `services.html` or `about.html`. Where the site has
several sibling per-service, per-treatment or per-location pages, that group wins outright,
because its shape is the one the fan-out copies most. A one-off shape (contact, pricing, the
blog listing, the legal pages) is never the slice: approving it settles only itself.

Build those two to the full Polish Standard, gate them, blind-critique them against the demo,
fix, re-critique — **and only then fan out**. A weak slice replicated across nine pages costs
nine times what it costs to fix once.

**This is enforced, not requested.** `build-spec.json` carries `slice_approved`, and while it
is `null` `verify_spec.py` errors on any page on disk other than `index.html` and one page of
the `repeating_archetype`, naming every file that ran ahead. Absent, `null` and blank all mean
NOT approved, so forgetting the key fails closed. Once the user has approved the slice at Stop
1, stamp it with the time they did — `"2026-08-08T14:20:00Z"` — and the whole site comes into
scope. A word (`yes`, `true`, `approved`) **exits 2**: the field is the audit record of when a
human signed off, and a gate that takes any truthy string is one anyone can talk past.

Everything downstream inherits the slice: the fan-out copies its chrome, section rhythm and
component choices rather than re-deciding them. On flat, the single owner of a shared visual
property is the framework CSS (`css/base.css` + `css/components.css`) — so when the cross-page
critic finds two pages disagreeing, **strip the override out of `theme.css`**, never set the two
pages to matching values.

## The stops — two planned, two conditional

`GAUNTLET-PROMPT.md` carries the reasoning for this shape. What follows is the flat checklist.
**Anything not on this list is a decision you make, record, and carry on from** — not a question
to hold the build open for. Never stop to generate an image, choose a component, write copy the
client already supplied, or push to the GitHub Pages preview.

**Planned — both happen on every build:**

1. [ ] **After the slice, before any fan-out.** `index.html` and the chosen archetype built,
       `python scripts/validate_site.py <site-dir>` exit 0, `python scripts/verify_spec.py
       <site-dir> <spec-path>` exit 0, and a blind critic clean against the demo's reference
       screenshots side by side. Then show the user **4 images** — both pages, desktop and
       ~375px, captured with `scripts/shots.py` — plus **one contact sheet of every image
       generated for the whole site**. Expect up to two rounds here; that is normal, and it is
       far cheaper than repeating a fault across twelve pages. **When they approve, stamp
       `slice_approved` in `build-spec.json` with the time they did** — until you do,
       `verify_spec.py` reds every page the fan-out builds.
2. [ ] **Before delivery.** Every gate in the Self-Audit Checklist exits 0, **and** every page
       has been rendered desktop and ~375px, looked at, and what was seen has been fixed. Hand
       over one contact sheet (desktop and mobile) plus the written checklist of what is still
       missing from the client.

**Conditional — stop only if it fires:**

3. [ ] **The brief's style number and the demo URL the client pasted contradict each other.**
       Do not guess which one they meant — report both and ask. (A client picked "Style 9" at
       random because the form's link was broken, then pasted the demo she actually wanted in
       the same answer.)
4. [ ] **The library has no answer.** A component, palette, font pairing or preset the content
       genuinely needs and the library lacks. Say plainly what the content needs and what the
       library lacks. It goes into the **shared library first** and is used from there — never
       built inside one client's `theme.css`, never approximated with the nearest thing.

Missing client inputs — a testimonial, a headshot, an address, an accreditation — are **not** a
stop. They go in the content checklist (Phase 3) and are handed over at Stop 2.

---

## Build Instructions

Read the client brief from `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\client-brief.md` first, then follow the instructions below.

### Instructions

Read the master template files first:
- `master-site-template/css/base.css` — design tokens, grid, buttons
- `master-site-template/css/components.css` — the component library itself (the readable index of it is `COMPONENTS.md`; read that to choose, this to check exact markup)
- `master-site-template/css/theme.css` — current theme example (Calm Sage)
- `master-site-template/themes/` — all palettes, fonts, and presets
- `master-site-template/index.html` — homepage structure reference
- `master-site-template/head.html` — SEO head template
- `master-site-template/js/main.js` — JavaScript behaviours

Then extract content according to the scenario (see Phase 1).

---

## Phase 1: Content Extraction & Analysis

### 1a. Extract content (scenario-specific)

**Scenario 1 — Pull from existing site:**
1. Fetch the client's existing website URL and every linked page
2. Extract all text content: headings, paragraphs, lists, testimonials, team bios, service descriptions, pricing, FAQs, contact details, opening hours, social links
3. **Enumerate ALL the client's real image assets BEFORE generating anything.** `WebFetch` strips `<img>`/background URLs, so pull the raw HTML and grep for image refs, and probe the common asset folders directly — e.g. `/siteimages/banner1.jpg…bannerN.jpg`, `/userfiles/images/`, `/images/`. Download the real hero/banner, logo, headshots, accreditation badges and section photos. **ALWAYS prefer a real client photo over a generated one** — only generate (Phase 2b) for genuine gaps. (A real clifftop banner was once missed and an AI "desert" hero shipped over it — don't repeat that.)
4. Note the site's current structure, pages, and navigation hierarchy
5. Identify the client's natural voice and tone from their existing copy

**Scenario 2 — Supplied content:**
1. Read ALL files in the content folder (Word docs, PDFs, text files, images)
2. Extract and organise content by page/topic
3. Identify the client's natural voice and tone from their supplied copy
4. Copy any client-supplied images into the site's `images/` directory

**Scenario 3 — Convert existing site to current template:**
1. Read ALL HTML files in the existing repo
2. Extract all content, images, and page structure
3. Note existing section comments and PROFILE markers (may need updating)
4. Preserve all content exactly — this is a design refresh, not a rewrite
5. Content rewrite setting still applies (client may want copy improvements during conversion)

### 1b. Research & analysis (scenarios 1 and 2 only)

1. **Research competitors.** Search the web for 2-3 top-ranking competitors in the client's niche + location. Note structural patterns, content patterns, and trust signals they use. Do NOT add competitor trust signals to the client's site — flag them in the content checklist instead.

2. **Identify missing pages.** Compare the client's content against competitor sites and niche expectations. Common missing pages for service businesses: "What to Expect", "Areas/Conditions I Work With", "My Approach", dedicated booking page. Flag missing pages in the content checklist.

3. **Extract voice and tone.** Identify whether the client's natural voice is warm, clinical, formal, conversational, authoritative, nurturing, or a blend. Maintain this voice consistently across all content.

### 1c. Theme selection

**Demo-led or bespoke — settle this before anything else.** If the client picked a demo (a style
number on the form, or better, a demo URL they pasted), **the demo is the spec**. Resolve the
style number to a demo with `master-site-template/demo-design-tokens.md` (styles 1-9), then read
that demo's real HTML in `Ai-Editor-Sites/demo-{name}/`, run
`grep -oE '<!-- SECTION: [^>]*-->'` over each page for its section plan, capture it as the
reference bar into `{client-dir}/reference-demo/`, and mirror it section for section —
substituting only copy, imagery and tokens. The selections below should already agree with it;
where a set value contradicts the demo, say so rather than silently picking one. A style number
that contradicts a pasted demo URL is conditional stop 3.

**A bespoke build still gets a base demo.** "No reference" must never mean "no bar" — a critic
with no reference produces flattery, and "looks good" is exactly the standard that failed. Read
the client properly first (their copy, existing site, documents, photos, who they serve, their
price point, how formal their own writing is), then choose one of the nine style demos in
`demo-design-tokens.md` as the base bar. (`demo-shop` is a feature demo, not a style bar — it is
not one of the nine.) Pick on **register** — formality and warmth — not on sector, because all
nine sit in the therapy/wellness register. **Write the reasoning BEFORE building**, into
`build-spec.json` and the Delivery summary; written afterwards it is decoration and the critic
ends up grading against the builder's own taste. Send the user the direction plus a client-ready
version of the rationale and **start building immediately — this is not a stop.** Everything
downstream is then identical to a client-picked demo. If nothing fits at all, that is a library
gap (conditional stop 4), not a licence to stretch a demo out of shape.

If the demo's palette or font pairing has no named entry in `master-site-template/themes/`, that
is a **library bug**: it goes into the shared library first and is used from there. Never
approximate with the nearest palette, and never build a bespoke one inside a client's
`theme.css`.

The design selections come from the developer's **Site Build Configuration** form in the portal (admin Custom Details), merged into the brief alongside the client's own Design Form answers. Treat each one as an **optional override, not a required input**:

- A **set value** (a specific palette / font / hero / nav / image style) = follow it exactly.
- **Blank, "Auto — designer's choice", or "you recommend"** = YOU decide it, grounded in the client's brand colour and real assets, their sector and audience, any reference sites they admire, their existing site, and the tone of their content. A site left entirely on Auto must still come out cohesive, distinctive and on-brand — never a flat default (see the Polish Standard).
- The free-text **Style direction** field (if filled) is a plain-English steer on the overall look and feel — e.g. "clean and airy, lots of whitespace, calming, like example.com". Let it inform every choice, *especially* the Auto ones, and treat it as overriding a generic default where they conflict. It augments the dropdowns; it does not replace a value that was explicitly set.

In the Delivery summary, always state which design choices were specified by the developer and which you decided (and why), so they can be reviewed.

Available options:
- **Palettes:** calm-sage, bold-navy, warm-terracotta, clean-slate, rich-forest, bright-coral, soft-blush, warm-mocha, trusty-blue, fresh-teal, warm-grey, deep-plum, mint-fresh, playful-sky
- **Font pairings:** classic-elegance, modern-pro, friendly, clean-bold, editorial, minimal, boutique, corporate, playful
- **Hero variants (16 total):** Classic group: split (classic two-column), fullwidth (dark overlay centred text), minimal (text only), half (50/50 edge-to-edge). Slope group: slope-dark (angled dark), slope-light (angled light), banner (contained image strip). Image Overlay group: image-left, image-center, image-right (full-bleed photo with dark overlay, text positioned left/centre/right). Image Frost group: frost-dark-left/center/right (frosted glass card over full-vibrancy image, dark tone), frost-light-left/center/right (frosted glass card, light tone). Classic/half can add `hero--reverse` to flip sides.
- **Nav styles:** default (single-tier), two-tier (brand bar + nav bar with contact info)
- **Aesthetic presets (5):** the global look-and-feel dial (corner radius, card shadow, border weight) — independent of palette and fonts. Loaded from `master-site-template/themes/aesthetics/{name}.json`, which sets `--aesthetic-radius`, `--aesthetic-shadow-card`, and `--aesthetic-border-width` in `:root`. Cards, buttons, form inputs, and pills all honour these (pills stay pill-shaped via the fixed `--aesthetic-radius-pill` — never override that). Options:
  - `soft` (default) — 14px corners, layered soft shadow, 1px borders. Friendly/modern. Every existing client site uses this.
  - `editorial` — 6px corners, near-flat shadow, 1px borders. Magazine/longform/restrained. Good for consultants, writers, content-led brands.
  - `sharp` — 0 radius, hard offset shadows, 1px borders. Architectural/corporate/B2B.
  - `luxe` — 20px corners, deep soft shadows, 1px borders. Premium hospitality/wellness/boutique.
  - `brutalist` — 0 radius, no shadows, heavy 3px borders. High-contrast, indie/contemporary, bold creative brands.

  Pick the one that matches the brand tone + industry (same signal you use for palette/font). If the brief says "you recommend" or omits it, default to `soft` — it never makes a site look wrong. Fold the chosen preset's three token values into `:root` in `theme.css` (see Phase 2a, step 3).

For `hero--image`, `hero--fullwidth`, or `hero--slope-dark` heroes, add `nav--transparent` to the nav for an overlay effect (homepage only). Inner pages always use solid nav.

### 1d. Plan page structure

For each page, define:
- The single primary conversion goal (e.g. "get visitor to contact page")
- Which components from the library to use for each section
- The emotional journey: empathy/validation → understanding → trust → action
- Where testimonials and trust signals should be placed

### 1e. Content gap analysis

Identify where the client needs to supply additional content (photos, testimonials, statistics, specific details). All gaps go in the content checklist.

### 1f. Rewrite content (if permitted)

- **Full rewrite:** Improve messaging, tighten copy, add persuasive structure. Maintain the client's voice. Do not introduce new factual claims.
- **Light rewrite:** Fix grammar, improve flow and readability, tighten wordy sentences. Keep the client's original structure and meaning.
- **No rewrite:** Use content verbatim. Only restructure into the component layout.

### 1g. Spec-lock — emit `build-spec.json`

Before a single page is written, emit **`{client-dir}/build-spec.json`** — the pages, the
archetypes, the component list per page, the theme tokens and the image slots. It is what 1c and
1d already decided, written down in a form a script can check.

**The schema is `scripts/build_spec_schema.md` — read it before writing the file.** A spec the
checker cannot parse is a gate that passes vacuously, which is worse than no gate. If the spec
cannot be written because a decision is still open, the decision is not made: go back to 1c/1d
rather than building around it.

**Then prove it exists, before Phase 2 lays out a single page:**

```
python scripts/verify_spec.py <site-dir> --preflight        # exit 0 required
```

This is the **spec-presence precondition**. Nothing used to force `build-spec.json` to exist,
so a build that simply never wrote one failed silently — no spec, no comparison, green build.
Preflight reads the spec and stops: exit 2 if it is missing, does not parse, is missing a
required key, carries a blank `reference.why`, or holds a malformed `slice_approved`; exit 0
when it is sound. The site directory is still empty at this point, and that is the state it
expects.

**Create `{client-dir}` here, not in Phase 2a.** The spec has to live somewhere and preflight
reads a directory, so step 1 of 2a (`mkdir Ai-Editor-Sites/{domain}`) happens now — everything
else in 2a still waits. Point preflight at a directory that does not exist yet and it exits 2
with `not a directory`, which reads like a broken tool rather than an ordering mistake.

**Set `slice_approved` to `null`.** It stays null until the user has approved the slice at
Stop 1. See "Slice first" above for what that buys you.

The client never reads it. It exists so that

```
python scripts/verify_spec.py <site-dir> <spec-path>
```

can fail the build when the built site deviates from its own declared plan — a page that quietly
lost a component, an archetype sibling that grew an extra band, a token that stopped matching.
Run it **after the slice**, where it must exit 0 before Stop 1, and **again after the fan-out**,
where it must exit 0 before Stop 2.

Emit it BEFORE building, never after. A spec written from the finished site records what was
built rather than what was chosen, and can never catch drift. Keep the file in the client
directory afterwards — unlike `images.json` it is not a build artifact to delete, it is the ship
gate's input.

---

## Phase 2: Build

### 2a. Create site directory and theme

1. Create `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`
2. Copy CSS files from master template: `css/base.css`, `css/components.css`
3. Generate `css/theme.css` from the selected palette + font JSON files. If the font JSON has a `sizes` object, include those as CSS custom property overrides in `:root` (e.g. `--text-h1-desktop: 2.5rem;`). These override the base heading sizes for fonts that render visually larger (sans-serifs). **If an aesthetic preset other than `soft` was chosen (see 1c),** also emit its three tokens into `:root` from `themes/aesthetics/{name}.json` — e.g. for `luxe`: `--aesthetic-radius: 20px; --aesthetic-shadow-card: 0 8px 32px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04); --aesthetic-border-width: 1px;`. Do NOT emit `--aesthetic-radius-pill` (pills must stay pill-shaped). If the preset is `soft`, emit nothing — base.css already defaults to it.
4. Copy `js/main.js` from master template
5. Create `images/` directory
6. Generate `robots.txt` (allow all, reference sitemap URL)
7. Generate `sitemap.xml` listing all pages with `<lastmod>` dates
8. Generate the favicon — a REAL image file, never a data: URI (Googlebot-Image can't crawl data URIs, so the site gets the generic globe icon in search results). From the client logo (square-padded on white or transparent), create `images/favicon.png` at 96×96 (Google requires a square multiple of 48px) and `images/apple-touch-icon.png` at 180×180. Reference them on EVERY page with relative paths (never a leading slash — root-absolute `/favicon.*` 404s on GitHub Pages project subpaths; pages inside `blog/` use `../images/…`):
   `<link rel="icon" href="images/favicon.png" type="image/png" sizes="96x96">`
   `<link rel="apple-touch-icon" href="images/apple-touch-icon.png">`
9. Google search-result thumbnail: for person-led businesses, save a SQUARE headshot of the practitioner (≥600×600) to `images/`, use it as `og:image`/`twitter:image` on the homepage + about page, keep `<meta name="robots" content="max-image-preview:large">` on every indexable page (already in the head template), and add a `WebPage` JSON-LD block with `primaryImageOfPage` (ImageObject → the headshot) and `mainEntity` (Person → name, jobTitle, image, worksFor) AFTER the `<!-- /PROFILE:schema -->` marker — never inside the PROFILE markers, because Business Details saves regenerate that block with the logo as `image`. Google does NOT index CSS background images, so a headshot that only appears via `background-image` is invisible to it.

### 2b. Images — never ship an empty slot

**This runs on every build, whatever the brief's Photos value says.** A grey placeholder, an empty image slot, a stock-photo look, or an image visibly softer than the slot it sits in is a build failure. The order is always: use a REAL client asset first, and generate only for genuine gaps.

1. **Enumerate what already exists before generating anything.** Scenario 1: the raw-HTML asset sweep in Phase 1a (WebFetch strips `<img>` and background URLs — pull raw HTML, grep for image refs, probe the common asset folders). Scenario 2: everything in the content folder. Download them, **open and look at them**, and identify the practitioner headshot, premises, signage/logo and their real work. A real client photo beats a generated one every time.
2. **Generate the remaining gaps** with the Gemini image tool — do not ask permission first, just do it.

**Tool:** `node tools/generate-image.js` (in project root). Key `GEMINI_API_KEY` in `Ai-Editor/.env`, read at use time and never pasted anywhere.

**Model choice is not optional.** The tool defaults to `flash` (`gemini-2.5-flash-image`), which is **hard-capped at 1344×768 no matter what `--size` says — the size flag is inert on that model**. That cap is why a chunk of the existing fleet has soft heroes.
- **Heroes, page headers, full-width bands, CTA backgrounds → `-m pro`** (`gemini-3-pro-image-preview`, up to 5504×3072).
- Cards, thumbnails and small splits → `flash` is fine.

**Always downscale the pro output before it ships.** It returns ~5500px on the long edge at 7-10 MB; that must never reach a client repo. Cover-crop to the slot's aspect, resize to roughly 2× the rendered slot width, save JPEG q82-84 (heroes 82, portraits/cards 84). Target under ~440 KB per file. `wordpress-master/scripts/post-process-media.py` is the worked example of this pass (its target table is WP-specific, but the crop-then-resize-then-compress logic is what to copy).

**THE ONE EXCEPTION — never generate over, or AI-upscale, a documentary or archival photograph.** Real people, real artworks, real events, real premises, medical or legal records. Generative models invent detail, and inventing detail inside a record of something real fabricates evidence. Ship those at native size, build the slot resolution-agnostic (`background-size: cover`, no fixed pixel assumptions), keep the original filename as the swap key, and flag it in the content checklist.

**Workflow:**
1. From Phase 1 analysis, list every image the build needs (hero, split sections, service cards, page headers, CTAs) and mark each one *real asset* or *gap*.
2. Write a batch file at `{site-dir}/images.json` with prompts tailored to the client's industry and content, for the gaps only.
3. Set `--style` from the brief's **Image style** (warm, professional, clinical, lifestyle, luxury, rustic, minimal, vibrant).
4. Run `node tools/generate-image.js --batch {site-dir}/images.json`, adding `-m pro` on the hero/full-width entries.
5. Downscale the pro outputs, then **look at every generated image** before it goes in a page.
6. Delete `images.json` after generation (build artifact, not a site file).

**Prompt writing tips:**
- Be specific about the setting, not generic ("warm physiotherapy treatment room with massage table" not "healthcare image")
- Match the client's actual business — if they're a bakery, describe their type of baked goods
- For page headers, keep images atmospheric and not too busy (text overlays on top)
- For CTA backgrounds, darker/moodier images work better under text
- Never include people's faces in prompts for service businesses — use hands, backs, silhouettes, or empty spaces
- Always specify the environment: indoor/outdoor, lighting, colour temperature

**Aspect ratios by usage:**
- Hero backgrounds, page headers, CTA banners: `16:9`
- About/split sections, service features: `3:2` or `4:3`
- Team/headshots, card thumbnails: `1:1`
- Mobile hero variants: `9:16`

**Style options:** `--style warm | clinical | luxury | lifestyle | minimal | professional | friendly | rustic | vibrant`

**Reading the brief's Photos field.** It says where the REAL assets come from, never whether images are optional:
- `existing only` — download from the client's existing site; generate anything that site doesn't cover.
- `client supplied` — copy from the content folder; generate anything it doesn't cover.
- `mixed` — client photos for personal/team shots, generated for everything else.
- `generate all` — no usable client assets; generate the lot.
- `none` — treat as `generate all`. **Never ship coloured placeholder divs or empty slots.** If a slot genuinely cannot be filled (an archival photo the client hasn't sent, per the exception above), design the section so it doesn't need one and put the ask in the content checklist.

Copy client photos into `images/` alongside generated ones.

### 2c. Build pages

**Build order — the slice, then the fan-out.** Build `index.html` + the most-repeated inner archetype FIRST (see "Slice first" above for how to choose it), then verify them *visually* — capture the rendered pages with `python scripts/shots.py <base-url> --out <dir> --pages home:/index.html <archetype>:/<archetype>.html`, which captures desktop AND ~375px in one run, and `Read` the images yourself. That, plus `validate_site.py` and `verify_spec.py` both at exit 0 and a clean blind critic, is **Stop 1**. Only once the slice has passed do you replicate the scaffold and section patterns across the remaining pages — otherwise a weak layout gets propagated everywhere and has to be redone.

DOM measurements (overflow, byte-identical nav, section order, image 200s) prove the page is *correct*, not that it *looks right* — never sign off on visual quality from measurements alone. **If the capture route is broken, fix the capture route** (`shots.py --selftest` is how you find out). Do not substitute a weaker check and carry on, and do not treat it as a reason to interrupt the build. Only if the route genuinely cannot be repaired do you say so and ask the user to share a screenshot.

When delegating page builds to subagents, give each a precise per-section component spec (split here, steps here, quals-list here) — left to their own devices they default to flat text blocks. That spec already exists: hand them their page's component list from `build-spec.json`, not a paraphrase of it. Each fan-out page gets its own blind critic, and the fan-out as a whole gets one cross-page critic over all sibling pages together — see `GAUNTLET-PROMPT.md`.

For each page, use the master template HTML structure:
- `<a href="#main" class="skip-link">` at the top
- Nav using the **master template nav component** (see below)
- `<main id="main">` wrapping all content
- Footer with 4-column layout
- Cookie consent banner
- Back-to-top button
- `<script src="js/main.js">` at the end

**CRITICAL — Nav structure must use the master template pattern:**
The portal's nav rewrite system requires this exact structure. Copy the nav from `master-site-template/index.html` and adapt it. The nav must:
- Be wrapped in `<!-- SECTION: nav -->` / `<!-- /SECTION: nav -->` comments
- Use `<nav class="nav">` as the root element (not `<header>`, not a custom class)
- Use `<span class="nav__name">` for the brand name
- Use `<span class="nav__title">` for the optional tagline
- Use `nav__link` class for nav links and `nav__link--active` for the current page
- Use `btn btn--primary nav__cta` class for the CTA button
- Include both desktop (`nav__links`) and mobile (`nav__mobile`) nav sections

**Two-tier nav (`nav--two-tier`):**
When using the two-tier nav variant (brand bar + nav bar):
- Use `<nav class="nav nav--two-tier">` as the root
- Structure: `nav__top` (brand + contact info) then `nav__bottom` (nav links + toggle)
- The `nav__toggle` (hamburger) goes inside `nav__bottom` — CSS auto-positions it top-right on mobile
- Contact items in `nav__top` use `nav__contact` > `nav__contact-item`

**Nav dropdowns:**
For grouping pages under a parent (e.g. "Treatments" with child pages):
- Wrap in `<div class="nav__dropdown">`
- Trigger button: `<button class="nav__link nav__dropdown-trigger">` with `nav__chevron` SVG
- Menu: `<div class="nav__dropdown-menu">` containing `<a class="nav__link nav__link--child">` links
- Mobile: use `nav__mobile-group` > `nav__mobile-parent` + `nav__mobile-expand` + `nav__mobile-children[hidden]`

**Hero padding — solid vs transparent nav:**
- When using `nav--transparent` (nav overlays the hero), the hero needs extra top padding to account for the nav sitting on top of it. The hero's existing padding handles this.
- When using a solid nav (no `nav--transparent`), the nav sits above the hero in normal document flow. Do NOT add extra top padding to the hero — the standard section padding is sufficient. If the hero looks like it has too much space above the heading, reduce or remove any extra `padding-top` on the hero element.
- Inner pages always use solid nav, so `page-header` sections should never have extra top padding for a transparent nav overlay.

**CSS load order (CRITICAL — theme overrides will NOT work if wrong):**
```html
<link rel="stylesheet" href="css/base.css">
<link rel="stylesheet" href="css/components.css">
<link rel="stylesheet" href="css/theme.css">
```
base.css MUST load first, then components.css, then theme.css LAST so client-specific overrides in theme.css take priority over component defaults.

**Every page must have:**
- Full SEO head (from head.html template) with unique title, description, OG tags, structured data
- CSS in correct order: base → components → theme (see above)
- Favicon as a real file: `images/favicon.png` (96×96, generated from the client logo) + `images/apple-touch-icon.png` (180×180), linked with relative paths. NEVER a data: URI (Google can't crawl it → generic globe in search results) and NEVER a root-absolute `/favicon.*` path (404s on GitHub Pages project sites)
- `loading="lazy"` on every content `<img>` EXCEPT an above-the-fold hero/LCP image (which stays eager so it isn't deferred), plus descriptive `alt` on all of them
- Correct nav link highlighting (`nav__link--active`)
- Cookie consent + back-to-top HTML before `</body>`
- Site credit link after footer section comment (outside section comments — not editable by AI editor)
- **PROFILE comment markers** for portal auto-injection (see section 2h below)
- Logo in nav via `<img>` tag with `class="nav__logo"` — do NOT use inline width/height styles, let CSS handle sizing
- If using `nav__brand--inline` (logo beside title), wrap name + title spans in `<div class="nav__brand-text">`
- Scroll nav HTML nesting: `nav-scroll__inner` must contain BOTH `nav-scroll__brand` AND `nav-scroll__right` as siblings — verify no extra `</div>` tags break the flex layout
- Checkbox form groups: use `class="form__group form__group--checkbox"` for proper inline alignment
- Hero h1 MUST have `class="hero__heading"` — without this class, hero-specific colour/size overrides won't apply
- Background images on any banner/hero/page-header MUST use `background-size: cover` and `background-position: center center` — never leave these unset or images will clip/tile unpredictably
- Testimonial quotes use `font-family: var(--font-body)` (serif), author names and details use `font-family: var(--font-heading)` (sans-serif) — this contrast separates the quote voice from attribution
- Transparent nav has two variants: `nav--transparent nav--transparent-dark` for dark/image heroes, `nav--transparent nav--transparent-light` for light overlay heroes. Supports custom background via `--nav-transparent-bg` CSS variable. Only apply transparent nav on the homepage with image/dark heroes — inner pages always use solid nav.
- Inner page headers: use `page-header--image` for sites with dark/image homepage heroes, use default `page-header` for light homepage heroes. Only use `page-header--image` if the client has page-specific imagery.

**Every site must include these auto-generated pages (no client input needed):**
- `cookies-policy.html` — generated from `master-site-template/cookies-policy.html` template. Replace `{{BUSINESS_NAME}}`, `{{BUSINESS_TAGLINE}}`, `{{CTA_TEXT}}`, `{{DATE}}`, `{{CONTACT_EMAIL}}`, `{{CONTACT_PHONE}}`, and `{{FOOTER}}` with the client's details. This page is `noindex` — it exists for compliance, not SEO. Add it to the footer legal links alongside Privacy Policy.
- `privacy.html` — generated from `master-site-template/privacy.html` template. Replace `{{BUSINESS_NAME}}`, `{{BUSINESS_TAGLINE}}`, `{{CTA_TEXT}}`, `{{DATE}}`, `{{CONTACT_EMAIL}}`, `{{CONTACT_PHONE}}`, `{{CONTACT_ADDRESS}}`, and `{{FOOTER}}` with the client's details. Adapt industry-specific language if needed. This page is `noindex`.

### 2d. Contact form setup

Client sites are hosted on GitHub Pages (static — no PHP). Forms POST to the AI Site Editor API.

1. Set the form `action` to `https://editmy.site/api/form/{site_id}` — use the **exact literal token `{site_id}`** (lowercase, in braces). Do NOT substitute `SITE_ID`, a placeholder of your own, or anything else: the CMS auto-connect (`SiteController::fixFormPlaceholdersInRepo`) matches ONLY the literal needle `editmy.site/api/form/{site_id}` and rewrites it to the real numeric ID when the admin registers the site (or clicks "fix form"). Any other placeholder will silently fail to match — the form stays unconnected and drops submissions.
2. The form must use `method="POST"` and class `form` (main.js handles AJAX submission via `fetch`)
3. **MANDATORY hidden fields** — the server silently drops submissions without these. They must appear inside every `<form>` that posts to editmy.site:

```html
<form class="form" action="https://editmy.site/api/form/{site_id}" method="POST">
  <!-- ... your visible fields ... -->

  <!-- Anti-spam — DO NOT REMOVE. Server rejects submissions silently if these are missing. -->
  <div style="display:none"><input type="text" name="_hp" tabindex="-1" autocomplete="off"></div>
  <input type="hidden" name="_t" value="">
  <input type="hidden" name="_page" value="">

  <button type="submit" class="btn btn--primary form__submit">Send</button>
</form>
```

`_hp` is a honeypot (hidden bots fill it). `_t` is a JS-set timestamp (main.js populates it on page load). `_page` is the current pathname (main.js populates it) so server error alerts can identify which page hosted the broken form. **Even if you forget these, GithubController will auto-inject them on commit** — but build them in correctly so the source matches the live site. See `master-site-template/contact.html` for the canonical form.

**Important:** Leave the form action as the literal `{site_id}` token in the source — do NOT hand-edit it to a number. The CMS connects it automatically: when the admin registers the site in the portal (or clicks the per-site "fix form" button), `fixFormPlaceholdersInRepo` rewrites the token to the assigned numeric ID and commits it back to the repo. Form submissions are then stored in the database and forwarded via per-site SMTP (configured during admin onboarding).

### 2e. robots.txt

Generate a `robots.txt` in the site root:
```
User-agent: *
Allow: /

Sitemap: https://www.{domain}/sitemap.xml
```

### 2f. sitemap.xml

Generate a `sitemap.xml` listing all public pages (exclude `cookies-policy.html`):
```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://www.{domain}/</loc>
    <lastmod>{YYYY-MM-DD}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://www.{domain}/about.html</loc>
    <lastmod>{YYYY-MM-DD}</lastmod>
    <priority>0.8</priority>
  </url>
  <!-- ... all other public pages -->
</urlset>
```

### 2g. PROFILE comment markers

Add these markers to every page so the portal's Settings panel can auto-inject business info:

- **Granular PROFILE markers** — use inline markers wrapping ONLY the data content (not surrounding icons, wrapper divs, or CSS classes). The CMS replaces only what's between these markers:
  ```html
  <!-- Nav brand -->
  <!-- PROFILE:logo --><!-- /PROFILE:logo -->
  <span class="nav__name"><!-- PROFILE:site_title -->Business Name<!-- /PROFILE:site_title --></span>
  <span class="nav__title"><!-- PROFILE:site_slogan -->Tagline<!-- /PROFILE:site_slogan --></span>

  <!-- Footer contact — markers go INSIDE each contact item -->
  <!-- PROFILE:phone_landline --><span>0117 496 0123</span><!-- /PROFILE:phone_landline -->
  <!-- PROFILE:email --><a href="mailto:hello@example.com">hello@example.com</a><!-- /PROFILE:email -->
  <!-- PROFILE:address --><span>City, Postcode</span><!-- /PROFILE:address -->

  <!-- Social links — each link individually marked -->
  <!-- PROFILE:social_facebook --><a href="...">Facebook</a><!-- /PROFILE:social_facebook -->
  <!-- PROFILE:social_instagram --><a href="...">Instagram</a><!-- /PROFILE:social_instagram -->
  ```
- **Schema JSON-LD** — add in the `<head>` of every page:
  ```html
  <!-- PROFILE:schema -->
  <!-- /PROFILE:schema -->
  ```

The portal replaces content between these markers when the client saves Settings. Markers must be inline (same line). Surrounding HTML (SVGs, wrapper divs) stays outside markers so the design is preserved.

### 2h. Section comments

Wrap every distinct content section with section comments for the AI editor:
- Opening: `<!-- SECTION: name -->`
- Closing: `<!-- /SECTION: name -->`
- Use lowercase kebab-case names: `nav`, `hero`, `page-header`, `intro`, `about`, `services`, `pricing`, `faq`, `contact-form`, `testimonials`, `team`, `cta`, `footer`
- If a page has multiple sections of the same type, append a qualifier: `cta-mid`, `cta-bottom`, `testimonials-home`
- Do NOT wrap: `<script>` tags, cookie consent banner, back-to-top button, skip-to-content link, site credit

### 2i. Blog setup (if requested)

If the client brief says "Blog needed: yes":

1. Create `blog.html` — a listing page using the `.blog-grid` / `.blog-card` components. Include category filter buttons if multiple categories are expected. This page is managed by the BlogController in the portal — clients add/edit/delete posts via the Blog panel in the editor toolbar.
2. Create `blog/` directory — individual blog post files will be auto-generated here by the portal when clients create posts via the Blog panel (e.g. `blog/my-first-post.html`).
3. Add "Blog" to the site navigation.
4. Blog posts use `../` prefixed paths for CSS, JS, images, and nav links (since they live in a subdirectory).
5. Use `master-site-template/blog.html` and `master-site-template/blog-post.html` as structural references.

If blog is not needed, skip this section entirely — do not create `blog.html`.

### Component Library Reference

**The canonical index is `master-site-template/COMPONENTS.md`.** Read it when planning each
page's sections — it is the only complete list, it carries the sub-structure each component
requires, and it holds the portal `Hero style` → class map. There is deliberately no second
catalogue in this file: the duplicate that used to sit here drifted out of date and went six
hero variants short, which is how a build can end up unable to find `hero--showcase-dark`.

Only use classes that exist in `components.css`. **Do NOT write custom CSS.** If nothing in the
library fits, FLAG it before building — a new component goes in the shared library or nowhere,
never in one client's `theme.css`. That flag is **conditional stop 4**: it is one of only two
things that interrupt a build.

**Build-time usage rules the catalogue doesn't carry:**

1. `nav--transparent` is **homepage only**, and only over `hero--image`, `hero--fullwidth` or
   `hero--slope-dark`. Inner pages always use the solid nav. Pick the tone variant to match:
   `nav--transparent-dark` over dark/image heroes, `nav--transparent-light` over light ones.
2. Hero and page-header background photos are set inline on the element —
   `style="background-image: url('images/hero.jpg')"` — and MUST carry `background-size: cover`
   and `background-position: center center`, or they clip and tile unpredictably.
3. `page-header--image` only when the client actually has page-specific imagery. Use it on sites
   whose homepage hero is dark/image; use the default `page-header` where the homepage hero is
   light.
4. `hero__ticks` pills take 3-5 words each. Longer text breaks the pill row.
5. `cta-banner`: the primary action is `btn--accent`. A secondary link uses `btn--secondary`,
   which auto-adapts to white on dark backgrounds.
6. `split--bleed` sits directly inside the `<section>` with no `.container` wrapper — the
   container is what stops the image bleeding.
7. Contact pages use `.contact-grid` (5:7 ratio), never `.grid--2`, and `.contact-info__item`
   for the details list, never `.card--feature`.
8. The team card child class is `.team-member`. `.team-card` has no styling at all.

Component-to-section fit (wide rows full width, callout backgrounds, icon'd lists, heading
hierarchy) is covered by the Design Rules immediately below — those are mandatory, not advisory.

---

## Design Rules (MANDATORY)

These rules apply to every page on every build. They prevent common visual issues.

1. **Never use the same background for consecutive sections.** Alternate between `.section` and `.section--alt` (or `.section--dark`) so each section boundary is clearly visible. Two same-background sections create a dead zone where the gap between them looks like wasted space.
   - **This counts the hero too.** `.hero` (transparent, inherits body `--color-bg`) followed by a plain `.section` = same bg = violation. The first section after a light hero MUST be `.section--alt`.
   - **This counts the page-header too.** `.page-header` (default `--color-bg-alt`) followed by `.section--alt` = violation. The first section after a default page-header MUST be plain `.section`, not `--alt`.
   - **Verify at build time** with: `Array.from(document.querySelectorAll('main > *')).map(s => ({ cls: s.className, bg: getComputedStyle(s).backgroundColor }))`. Any two adjacent rows with the same `bg` = bug.
   - **Safety net:** components.css contains a CSS rule that force-alternates consecutive plain sections and consecutive --alt sections. Do NOT remove this rule.

2. **Icon containers must always be circular.** Use `border-radius: 50%` on all icon containers (`.card__icon`, `.icon-box__icon`, `.contact-info__icon`, `.service-detail__icon`). Never use `border-radius: var(--radius-md)` or `var(--radius-lg)` for icons.

3. **Icon backgrounds must contrast with their section.** When placing icons inside `section--alt` (which uses `var(--color-bg-alt)`), the icon background must be `var(--color-surface)` (white), not `var(--color-bg-alt)`. The CSS handles this automatically via the `.section--alt .card__icon` override in base.css — but if creating custom icon containers, follow the same pattern.

4. **Footer social links work without a class.** The CSS targets `.footer__social a` — do not rely on adding `.footer__social-link` class to social anchor tags. Bare `<a>` tags inside `.footer__social` are styled automatically.

5. **Hero padding depends on nav style.**
   - Transparent nav (`nav--transparent`): hero needs extra top padding because the nav overlays it.
   - Solid nav (no `nav--transparent`): hero should NOT have extra top padding — the nav sits above in normal flow. Standard section padding is sufficient.
   - Inner pages always use solid nav.

6. **Headings must have margin-bottom.** The global reset strips margins. Base.css restores `margin-bottom` on h1-h6 — but if creating any custom heading containers, ensure there is always visible space between a heading and the text below it.

7. **Two-tier nav vertical padding.** `.nav--two-tier` has `padding: 20px 0`. `.nav__top` has `padding-top: 20px` and `.nav__bottom` has `padding-bottom: 20px`. Do not add horizontal padding to `.nav--two-tier` — the `.container` inside handles horizontal spacing.

8. **Checkbox groups must set `flex-direction: row`.** The `.form__group` base class sets `flex-direction: column`. When using `.form__group--checkbox`, the CSS overrides this to `row` — but if creating any custom checkbox/inline form layouts, always explicitly set `flex-direction: row` to prevent the checkbox stacking above its label.

9. **Contact info uses icon-left layout.** On contact pages, use `.contact-info` > `.contact-info__item` (icon beside title), not `.card--feature` (icon above title). The `.contact-info__label` is bold at `text-base` size; `.contact-info__text` is smaller at `text-sm`. This creates clear visual hierarchy between titles and body text.

10. **Match a component to its section background.** A component whose heading uses `var(--color-bg-alt)` — notably `highlight-box--soft` — visually disappears when placed on a `.section--alt` (same grey): the heading merges into the section and the white content looks like a detached, floating card. **Rule:** use `--soft` callouts only on WHITE (`.section`) backgrounds; on `.section--alt` use the default `highlight-box` (primary-colour heading, which contrasts on any background). Always confirm a component's heading/background colour differs from the section it sits on. (Same principle as rule 3 for icons.)

11. **Match a component to its content length.** Row-based components like `.fee-table` / `.fee-item` (name → dotted leader → price on one line) need horizontal room. Cram them into a narrow `grid--3` column and the detail text wraps, ballooning rows to 150–200px of ragged content. **Stack wide-row components full-width inside `.container--narrow`;** reserve multi-column grids for short, uniform cards (`card--service`, `icon-box`).

12. **No wall-of-text sections.** Every content section must use a varied visual component — `.split` (+ image), `.steps`, an `.icon-box`/`.card` grid, `.quals-list`, `.story-split`, `.blockquote--pull`, `.info-band`, etc. Never stack bare `<p>` paragraphs as a whole section, and aim for **≥4 distinct visual patterns** on any multi-section page. Bulleted lists must use the real list component WITH icons (`.quals-list`, or `.checklist` with inline `<svg>` ticks) — **never plain `<li>` with no marker** (renders as iconless text). Apply this from the first build, not after feedback.

13. **Nav CTA discipline.** Use plain `nav__link`s for menu items. Only add a `btn ... nav__cta` button for a single, strong, *distinct* primary action (e.g. "Book a Home Visit", "Book Online"). Never label the CTA the same as an existing menu item — a "Contact" button sitting next to/over a "Contact" link looks broken. If there is no distinct primary action, make every nav item a plain link.

14. **Section-label eyebrows must not duplicate their heading.** The small `section-label` above a heading (in `page-header` or any section) is a short *category*; the heading is a *distinct, descriptive* title. Never make the pair the same word or synonyms — e.g. eyebrow "About" + H1 "About", eyebrow "Fees" + H1 "Fees", or eyebrow "Get in Touch" + H1 "Contact" all read as a broken echo. Give the H1 a descriptive form (e.g. "Meet [Practitioner]", "Clear, transparent pricing", "Contact [Practitioner]") so the pair reads as label → title — or drop the eyebrow entirely.

15. **Keep heading hierarchy unbroken through components.** Reinforcing the copywriting rule (never skip H1 → H2 → H3): a component's own title must not create a skip. Notably `.fee-table` defaults its title to `<h3>` — dropped directly under a page `<h1>` it jumps H1 → H3. Use `<h2>` for box/section titles (size them down in `theme.css` if the default H2 is too large for a card), or add a section `<h2>` above the boxes. Verify every page reads H1 → H2 → H3 with no gaps.

16. **Row-list components: full width, restrained price, correct reveal timing.** Wide row components (`.fee-table` / `.fee-item` — name → dotted leader → price on one line) must stack **full width** (e.g. inside `.container--narrow`), never crammed into narrow `grid--3` columns where long detail text wraps into tall, ragged rows. Keep the price (`.fee-item__price`) no larger than the box title. And when a list/grid sits **far below its section heading** (e.g. a `.quals-list` under a heading + intro + paragraph), put `reveal reveal-trigger` on the *list's wrapper* so the scroll cascade fires on the list's own entry — otherwise the section-level `.reveal` fires the cascade while the items are still below the fold and the animation finishes off-screen.

---

## Polish Standard (MANDATORY — every build, any style)

"Technically correct" is not the bar. **A standard / "ok"-looking site is a FAIL.** Every site must look bespoke and premium *for its own aesthetic*. The specific look varies by client; the quality bar does not. Apply all of this on the FIRST pass, not after the client asks for it.

1. **Distinctive, layered palette — never a washed-out default.** Build at least a tri-tone system, not "one colour + one accent": an anchor + a co-accent **pulled from the client's real brand assets and photography** + deliberately-tinted neutrals (never flat `#FFF` or generic cool grey) + a fine-detail accent (a metallic or deep tone). One hue washed across everything is the #1 tell of a cheap, AI-made site. The palette must echo something real about the client (their photos, products, room, materials).

2. **Reach for the RICH components, not the flat ones.** Open `theme-preview.html` and pick the strongest fit BEFORE building each section. Default builds over-use flat checklists, icon-cards and identical CTA banners. Prefer, where they fit: `overlay-card` (photo + hover-zoom), `blockquote--pull`, `info-band`, `split--bleed`, `grid--bento`, `approach-grid`, `cta-image`, `hero--showcase`. Deliberately vary the hero/section treatment from the last client you built so sites don't converge on one look.

3. **A decorative layer is required, not optional.** Add tasteful intricacy in the site's `theme.css`: a barely-visible brand-mark watermark bleeding off a section edge; soft radial "glow" ambience tied to something in the client's imagery; hairline/flourish accents under eyebrows; italic-serif (or equivalent) emphasis on key words; tinted, layered shadows. Small touches, big premium signal.

4. **Photography leads.** Surface the client's real photos prominently, and treat generated/stock images (duotone/tint) so they match the palette instead of fighting it. Never ship a page that is all text + icons when imagery is available.

5. **Motion reads as quality.** Scroll-reveal cascades, hover lifts, image zoom, directional reveals — present and tasteful (transform/opacity, ease-out, honour `prefers-reduced-motion`).

6. **Kill sameness.** No two adjacent sections share a component OR a background; no two CTAs identical on a page; every page earns one bold "hero moment"; ≥4 distinct visual patterns per multi-section page.

7. **Tune the aesthetic dials per client.** Use `--aesthetic-radius` / `--aesthetic-shadow-card` / `--aesthetic-border-width` + the font pairing + the palette to make each site's polish feel native to its niche (luxe spa ≠ sharp B2B ≠ warm therapist). The standard is constant; the expression is bespoke.

8. **Mandatory elevation + critique pass — at the slice, not just before delivery.** Once the two slice pages render, run the `impeccable` skill (or an adversarial design-critique subagent) against them, asking one blunt question: **"Is this special, or competent-but-safe?"** Hunt specifically for: washed-out / one-note colour, flat text-only sections, repeated components, missing imagery, a default-looking hero. Fix what it finds, then re-critique. Run it again over the fan-out before delivery. It happens at Stop 1 because that is when the answer is still cheap to act on — a "competent-but-safe" verdict on a finished twelve-page site is twelve pages of rework. **Do not deliver a build whose flaws only a post-complaint redo would have caught.**

---

## Content Integrity Rules (MANDATORY)

These rules override all other instructions:

1. **Never invent factual claims.** Every credential, qualification, trust signal, and testimonial must come directly from the client's source content. Zero exceptions.

2. **Trust bars** may only contain credentials explicitly stated in the client's documents. Do not add credentials the client hasn't claimed, even if competitors display them.

3. **Testimonials** must be direct quotes from the client's content. Do not paraphrase, combine, or embellish them.

4. **Tick-points and hero statements** must be derived from facts stated in the client's content. Do not infer or assume qualifications.

5. **If competitor research reveals trust signals the client hasn't provided**, add them to the content checklist as recommendations with a "To Query" flag. Never put them on the site pages.

6. **When rewriting copy** (if permitted), you may restructure and tighten the client's words, but you may not introduce new factual claims.

7. **If in doubt** about whether something is in the client's content: leave it out and add it to the content checklist.

---

## Copywriting Rules (apply to all content)

**Headings:**
- All H2/H3 headings must be benefit-led or emotion-led, not label-led
- H2 headings on service pages should include search-friendly keywords where natural
- Never skip heading levels (H1 → H2 → H3)

**Opening sentences:**
- First sentence of every section speaks to the visitor's experience, not the service
- "You may have noticed..." is visitor-first. "We offer..." is provider-first. Lead with the visitor.

**Paragraphs:**
- One idea per paragraph. Front-load the key point. Max 4 sentences per paragraph.

**Scannability:**
- Reading only H1, H2s, bold text, and CTA buttons should convey the full message
- Use bold lead-in sentences to surface key points for scanners

**CTA consistency:**
- All primary CTAs use the same wording across the site
- No more than 2 distinct CTA phrasings (primary + secondary)
- CTA banner headlines should be tailored to each page's context — never identical on more than two pages

**CTA frequency:**
- Pages longer than 3 sections: at least 2 CTA opportunities
- Pages with 5+ sections: at least 3 CTA opportunities
- About page: mid-page CTA, not just at the bottom

---

## Conversion Rules (MANDATORY)

**Homepage hero:** Headline + supporting sentence + three tick-points (audience, credibility, differentiator from client's content) + CTA button.

**Social proof near every CTA:** Every page with a CTA must have at least one testimonial or trust signal visible nearby. Never place a CTA in isolation.

**Trust bar placement:** Homepage, services/pricing page, about page, and contact page must each have a trust bar (only client-provided credentials).

**Testimonial distribution:** Spread testimonials across pages (homepage, services, pricing, contact). Match each testimonial's content to the page context. Re-use the same testimonial on multiple pages if the client has limited social proof.

**Pricing anchors:** Services page must include a pricing reference with link to pricing page (if pricing exists).

**Contact page:** Must include at least one testimonial near the form. This is the highest-intent page — social proof here reduces last-second hesitation.

**FAQ conversion:** If there's a "how do I get started?" question, extract it from the accordion and present it as a standalone highlighted block with its own CTA.

**Emotional journey:** Each page should flow: empathy/validation → understanding → trust → action. Open with the visitor's problem/feeling, not the provider's credentials.

**Internal linking:** Homepage → services. Services → pricing. About → contact. Pricing → contact. Every page should have at least one contextual in-body link to another page.

---

## Accessibility Rules (MANDATORY)

Target WCAG 2.1 AA. base.css and components.css cover most of this — verify on the rendered page, don't assume.

1. **Keyboard:** every interactive element (nav links, mobile toggle, accordion triggers, carousel dots, form fields, buttons) must be reachable and operable by keyboard alone in a logical tab order. The skip-to-content link must be the first focusable element.
2. **Visible focus:** every focusable element must show a clear focus ring — never `outline: none` without a visible replacement. Confirm focus styles live in base.css and aren't overridden in theme.css.
3. **Contrast:** body text ≥ 4.5:1 against its background; large text and meaningful UI borders ≥ 3:1. Re-check AFTER the palette is applied — light accent colours on white frequently fail. Fix by adjusting the palette token, not the component.
4. **Alt text & labels:** every `<img>` has meaningful `alt` (or `alt=""` if purely decorative). Icon-only controls (mobile nav toggle, social icons) need an `aria-label`.
5. **Semantics:** exactly one `<h1>` per page, no skipped heading levels, `<nav>`/`<main>`/`<footer>` landmarks present, real lists for lists. Accordion triggers must be `<button>`s with `aria-expanded`.
6. **Forms:** every input has an associated `<label>` (placeholder text is not a label). Validation/error states must be conveyed by more than colour alone.
7. **Reduced motion:** scroll-reveal and the testimonial carousel must respect `prefers-reduced-motion`; content must remain fully visible if animation is disabled.

---

## Phase 3: Content Checklist

Create a `content-checklist.html` page that consolidates every content gap identified across the site:

1. **Competitors analysed** — list each competitor reviewed with name, URL, and one line on what they do well
2. **Gaps by page** — group by page, describe what's needed, why it matters
3. **Recommendations requiring confirmation** — flag with "To Query" badge
4. **Missing pages** — recommended pages the client should consider adding
5. **Image requirements** — list every placeholder with exact dimensions and alt text description

Address the client directly in second person ("you", "your", "please confirm"). Use "we" (the agency) when describing recommendations. Never reference AI or automation.

---

## Phase 4: Git Setup and Deploy

Creating the GitHub repo and turning on Pages is part of the build — do NOT ask the user to pre-create the repo.

1. Initialise git repo in the client site directory
2. Create initial commit with all files
3. Create the repo under the org and push in one step:
   `gh repo create trulyempoweredcode/{domain} --public --source=. --remote=origin --push`
   (Repos are PUBLIC — GitHub Pages project sites on the org's github.io require it. If the repo already exists, instead: `git remote add origin git@github.com:trulyempoweredcode/{domain}.git` then `git push -u origin main`.)
4. Enable GitHub Pages on the `main` branch (root) via the API:
   `echo '{"source":{"branch":"main","path":"/"}}' | gh api -X POST repos/trulyempoweredcode/{domain}/pages --input -`
   A `409` means Pages is already on — ignore it. (UI equivalent: repo Settings → Pages → Branch `main`, folder `/root`.)
5. Report the preview URL: `https://trulyempoweredcode.github.io/{domain}/` (the first Pages build takes ~1 minute to go live).

---

## Self-Audit Checklist (complete before delivering)

**Mechanical gates first, eyes second — never the other way round. All four exit 0 before Stop 2.**
(`verify_spec.py <site-dir> --preflight` has already run back in Phase 1g, before any page was
laid out — if you cannot point at that run, the spec-lock never had a precondition.)

1. `python scripts/validate_site.py D:/claude-custom-projects/Ai-Editor-Sites/{domain}` (from the Ai-Editor repo root). It mechanically checks CSS order, heading hierarchy, section alternation, SECTION comments, PROFILE markers, form anti-spam fields, lazy loading, alt text, favicon paths, pricing-grid card counts, nav duplicates, titles/descriptions, robots.txt and sitemap coverage, **and layout variety** (a page of 3+ content bands that never once selects a library component is an ERROR; a single text container holding 400+ words is an ERROR — 900+ on a blog post is a warning, since clients author their own posts). **Fix every ERROR before continuing** — exit code must be 0. Warnings are judgment calls: resolve or consciously accept each one.
2. `python scripts/verify_spec.py D:/claude-custom-projects/Ai-Editor-Sites/{domain} D:/claude-custom-projects/Ai-Editor-Sites/{domain}/build-spec.json` — the built site against the plan declared in Phase 1g. A page that quietly lost a component, a sibling that grew an extra band, or a token that stopped matching fails here. It also holds slice-first: if `slice_approved` is still `null` every page past the slice is an ERROR, so by delivery it must carry the timestamp of the user's Stop 1 approval.
3. `python scripts/check_defect_ledger.py` — **every fault reported during this build has a row in `DEFECT-LEDGER.md`, written before its fix.** No row, no fix. The checker fails a gate cell naming a file that does not exist, a blank required cell, or a commit hash resolving in neither repo. If a script could have caught the fault and none does, the row says `OPEN:` plus what would catch it.
4. `python scripts/shots.py <preview-url> --out <dir> --pages home:/index.html about:/about.html … --contact-sheet <file.png>` — every page, desktop and ~375px. **Name every page in `--pages`, separated by SPACES**: with no `--pages` the run captures `/` alone and reports success, and a comma-joined list is read as ONE made-up URL. **Do not add `--mobile`** — both viewports are captured by default and `--mobile` RESTRICTS the run to mobile, so the desktop pass never happens. Run `--selftest` first; if it fails, fix the route rather than falling back to a weaker check. Then `Read` the contact sheet yourself: a capture nobody looked at is not a check.

Then verify the remaining manual items:

**Visual (LOOK at the rendered pages — not just the DOM):**
- [ ] You have actually viewed EVERY page as a rendered screenshot, desktop and ~375px, via `scripts/shots.py`, and fixed what you saw. If the capture route was broken you repaired it — you did not substitute a DOM check, and you did not sign off blind.
- [ ] No section is a plain wall of `<p>` text — every content section uses a varied component (split + image, steps, icon-box grid, quals-list, story-split, pull-quote…)
- [ ] Every callout/box (e.g. `highlight-box`) reads as ONE cohesive element on its section background (heading background ≠ section background)
- [ ] Lists use the real list component WITH icons (`quals-list`, or `checklist` with svgs) — never bare `<li>`
- [ ] Pricing/fee components are not cramped — wide-row components (`fee-table`) sit full-width, not in narrow columns
- [ ] The hero (and section images) use the client's REAL banner/photos where they exist — generated images only fill genuine gaps

**Content integrity:**
- [ ] Every credential in every trust bar appears in the client's source content
- [ ] Every testimonial is a direct quote from the client's content
- [ ] Every hero tick-point is traceable to a specific fact in the client's content
- [ ] No trust signals added from competitor research or assumptions
- [ ] No scarcity signals added unless client explicitly mentions limited availability
- [ ] Content checklist clearly labels all "To Query" recommendations

**Copywriting:**
- [ ] Every H2 is benefit-led or emotion-led, not a plain label
- [ ] First sentence of every section addresses the visitor
- [ ] No paragraph exceeds 4 sentences
- [ ] Pages are scannable from headings + bold text + CTAs alone
- [ ] Heading hierarchy correct on every page (H1 → H2 → H3)
- [ ] CTA banner headlines tailored per page

**Conversion:**
- [ ] Homepage hero has headline + subtitle + tick-points + CTA
- [ ] Every CTA has nearby social proof
- [ ] Trust bar on homepage, services, about, pricing, contact
- [ ] Testimonials distributed across pages, contextually matched
- [ ] About page has mid-page CTA
- [ ] Contact page has testimonial near form
- [ ] Internal cross-links on every page

**Technical:**
- [ ] All inter-page links use correct filenames
- [ ] Every page has unique meta title (<60 chars) and description (<155 chars)
- [ ] Structured data (LocalBusiness JSON-LD) on homepage
- [ ] OG and Twitter meta tags on every page
- [ ] Mobile nav works (hamburger toggle)
- [ ] Cookie consent banner present on every page (links to cookies-policy.html)
- [ ] cookies-policy.html exists with correct business details
- [ ] Footer legal links include both Privacy Policy and Cookie Policy on every page
- [ ] Site credit link present on every page (outside section comments)
- [ ] Back-to-top button present on every page
- [ ] Skip-to-content link present on every page
- [ ] Section comments on every content section
- [ ] Form action is `https://editmy.site/api/form/{site_id}` with correct site ID
- [ ] Granular PROFILE markers on every page: `PROFILE:site_title`, `PROFILE:site_slogan`, `PROFILE:logo`, `PROFILE:phone_*`, `PROFILE:email`, `PROFILE:address`, `PROFILE:schema`
- [ ] robots.txt exists with sitemap reference
- [ ] sitemap.xml lists all public pages (excludes cookies-policy.html)
- [ ] CSS link order is base → components → theme on every page (theme LAST, or overrides break)
- [ ] Favicon is a real file on every page: images/favicon.png 96×96 from the client logo (never a data: URI — Google can't crawl it; never root-absolute /favicon.* — 404s on GitHub Pages)
- [ ] og:image on every indexable page; homepage + about use a square practitioner headshot (≥600×600) when the business is person-led, with a Person/primaryImageOfPage JSON-LD block outside the PROFILE markers
- [ ] Every non-hero <img> has loading="lazy" (the hero/LCP image stays eager)
- [ ] No console errors
- [ ] No two consecutive sections share the same background colour on any page

**Accessibility (WCAG AA):**
- [ ] Every interactive element is keyboard-reachable and shows a visible focus ring
- [ ] Body text contrast ≥ 4.5:1 against its background (re-checked after the palette was applied)
- [ ] Every <img> has meaningful alt (or alt="" if decorative); icon-only controls have aria-label
- [ ] One <h1> per page, no skipped heading levels, nav/main/footer landmarks present
- [ ] Every form input has a real <label>; reveal/carousel respect prefers-reduced-motion

**Images (if generated):**
- [ ] All images generated and saved to `images/` directory
- [ ] Hero image matches the industry and tone
- [ ] Page header images are atmospheric enough for text overlay
- [ ] No AI artifacts or text in generated images
- [ ] `images.json` batch file deleted after generation
- [ ] Client-provided photos used where specified

**Voice and tone:**
- [ ] Client's natural voice maintained throughout
- [ ] No section reads in a noticeably different tone
- [ ] First-person vs third-person usage is consistent

**Emotional journey:**
- [ ] Empathy before credentials on key pages
- [ ] Homepage opens with visitor's problem, not provider's credentials
- [ ] Contact page reduces anxiety about reaching out

---

## Delivery

When complete, report to the user:
1. All pages built with section-by-section summary
2. Theme selected (palette + fonts + hero variant) with rationale
3. Content checklist summary (number of gaps, key recommendations)
4. GitHub repo URL
5. Preview URL
6. Site ID needed for form action (from admin portal) and SMTP setup instructions
7. Any decisions made that need the user's review
8. **Design system advisory** (optional) — If during the build you created any custom layout, section pattern, hero variant, or component that doesn't exist in the master template's component library, note it here. Suggest whether it would be useful to add back to the master template for future client builds. Format: component name, what it does, which client needed it, and why it could be reusable.
9. **Gate evidence** — the exit-0 lines from `validate_library.py`, `verify_spec.py --preflight` (from before the first page was laid out), `verify_spec.py`, `validate_site.py` and `check_defect_ledger.py`, the `verify-live.py` result on the plain URL, and confirmation that you rendered and looked at every page at desktop and ~375px. A build reported done without these is reported done on trust.
