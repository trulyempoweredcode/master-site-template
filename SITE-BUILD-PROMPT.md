# Client Site Build Prompt

Instructions for building a client website. To start a build, just tell Claude the domain — e.g. "Build a new site for acme.co.uk — read the build prompt and client brief."

**Working directory:** `D:\claude-custom-projects\Ai-Editor`
**Master template:** `D:\claude-custom-projects\Ai-Editor\master-site-template\`
**Client sites:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`
**Brief template:** `D:\claude-custom-projects\Ai-Editor\master-site-template\CLIENT-BRIEF-TEMPLATE.md`

---

## How to start a build

1. Copy `CLIENT-BRIEF-TEMPLATE.md` to `Ai-Editor-Sites/{domain}/client-brief.md` and fill it in
2. Tell Claude: "Build a new site for {domain} — read the build prompt and client brief"
3. Claude reads this file + the client brief and works autonomously

---

## Build Instructions

Read the client brief from `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\client-brief.md` first, then follow the instructions below.

### Instructions

Read the master template files first:
- `master-site-template/css/base.css` — design tokens, grid, buttons
- `master-site-template/css/components.css` — full component library (~50 components)
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

Use the theme selections from the brief. If any are marked "you recommend", choose based on the client's industry, tone, and competitor landscape.

Available options:
- **Palettes:** calm-sage, bold-navy, warm-terracotta, clean-slate, rich-forest, bright-coral, soft-blush, warm-mocha, trusty-blue, fresh-teal, warm-grey, deep-plum, mint-fresh
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
8. Set the favicon. Use the `head.html` favicon block on every page and replace `{{FAVICON_EMOJI}}` with an emoji that fits the business. It's an inline SVG data URI — no external file, and it works on GitHub Pages project subpaths where a root-absolute `/favicon.ico` would 404. If the client has a real logo/icon, instead write a relative-path `favicon.svg` to the site root and reference it as `href="favicon.svg"` (never `/favicon.svg`).

### 2b. Generate images (if requested)

If Photos = `generate all` or `mixed`, use the Gemini image generation tool.

**Tool:** `node tools/generate-image.js` (in project root)

**Workflow:**
1. Based on Phase 1 analysis, identify all images needed (hero, split sections, service cards, page headers, CTAs)
2. Create a batch file at `{site-dir}/images.json` with prompts tailored to the client's industry and content
3. Use the **image style** from the brief to set the `--style` flag (maps directly: warm, professional, clinical, lifestyle, luxury, rustic, minimal, vibrant)
4. Run: `node tools/generate-image.js --batch {site-dir}/images.json`
5. Verify images generated successfully before proceeding to page builds
6. Delete `images.json` after generation (it's a build artifact, not a site file)

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

If Photos = `mixed`, use client photos for personal/team shots and generate for everything else. Copy client photos into `images/` alongside generated ones.

If Photos = `existing only`, download images from the client's existing site. If Photos = `client supplied`, copy from the content folder. If Photos = `none`, use coloured placeholder divs.

### 2c. Build pages

**Build order — verify before you replicate.** Build the homepage + ONE inner page FIRST, then verify them *visually* (screenshot the rendered page — not just a DOM/`eval` check) to a high quality bar. Only once those genuinely look right should you replicate the scaffold and section patterns across the remaining pages — otherwise a weak layout gets propagated everywhere and has to be redone. **If you cannot render/screenshot the pages in your environment, STOP and ask the user to share a screenshot.** DOM measurements (overflow, byte-identical nav, section order, image 200s) prove the page is *correct*, not that it *looks right* — never sign off on visual quality from measurements alone.

When delegating page builds to subagents, give each a precise per-section component spec (split here, steps here, quals-list here) — left to their own devices they default to flat text blocks.

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
- Favicon via the `head.html` data-URI block with `{{FAVICON_EMOJI}}` replaced — or a relative `favicon.svg` if a real icon was generated. NEVER a root-absolute `/favicon.*` path (it 404s on GitHub Pages project sites)
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

1. Set the form `action` to `https://editmy.site/api/form/{site_id}` — the `{site_id}` is the numeric ID from the `sites` table (assigned when the admin creates the site in the portal)
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

**Important:** The site must be registered in the admin portal first to get its `site_id`. After building the site, tell the user to create the site entry in the admin portal and update the form action with the assigned ID. Form submissions are stored in the database and forwarded via per-site SMTP (configured during admin onboarding).

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

Use these CSS classes from components.css. Do NOT write custom CSS. Everything needed is in the library.

**Page structure:**
- `.section` / `.section--alt` / `.section--dark` — page sections with padding. **Never place two consecutive sections with the same background** — alternate between `.section` and `.section--alt` (or `.section--dark`) so each section is visually distinct.
- `.container` / `.container--narrow` — max-width wrappers
- `.page-header` — inner page hero with label + h1 + subtitle

**Heroes (homepage):**
- `.hero` — classic split (text + image)
- `.hero--fullwidth` — full-width dark gradient overlay, centred text
- `.hero--minimal` — text only, centred, subtle gradient background, no image
- `.hero--half` — 50/50 edge-to-edge split
- `.hero--image` — full-bleed background photo with dark overlay. Set image via `style="background-image: url('images/hero.jpg')"` on the hero element.
- `.hero--banner` — contained shorter image strip with text below. Uses the standard hero__image-wrap for the photo.
- `.hero--slope-dark` — angled slope with dark background
- `.hero--slope-light` — angled slope with light background
- `.hero--image-left` / `.hero--image-right` — position text left or right over image overlay (default is centre)
- `.hero--showcase` — full-vibrancy image with frosted glass floating card. Add `.hero--showcase-dark` or `.hero--showcase-light` for card tone. Add `.hero--showcase-center` or `.hero--showcase-right` for card position (default is left).
- `.hero--reverse` — modifier (add to classic/half variants to flip image/text sides)
- `.hero__ticks` — pill-style badges for hero tick-points. Each `<li>` renders as a rounded pill with optional SVG tick icon. Keep text short (3-5 words per pill).

**Nav overlay (homepage only):**
- `.nav--transparent` — makes nav float over the hero with transparent background, white text. Use ONLY on pages with `hero--image`, `hero--fullwidth`, or `hero--slope-dark`. Inner pages should always use the solid nav.

**Page headers (inner pages):**
- `.page-header` — default light background (bg-alt)
- `.page-header--dark` — primary colour gradient background, white text
- `.page-header--image` — background photo with dark overlay. Set image via `style="background-image: url('images/page-header.jpg')"`.

**Testimonials:**
- `.testimonial-grid` — 2-column grid of testimonial cards
- `.testimonial-carousel` — single featured rotating testimonial with dot navigation. Needs 2+ `.testimonial` children + `.testimonial-carousel__nav` with dot buttons. JS auto-advances every 6 seconds. Add `.testimonial-carousel__icon` SVG for decorative quote mark.

**Content sections:**
- `.split` / `.split--reverse` / `.split--text-wide` / `.split--image-wide` — text + image layouts
- `.split--bleed` / `.split--bleed-reverse` — edge-to-edge full-bleed image on one side (50% viewport), padded text on the other. No container needed — sits outside `.section > .container`. Uses `.split__image` (img tag) + `.split__content`. Wrap in `<section>` (or `<section class="section--alt">` for alt bg).
- `.text-block` / `.text-block--center` — centred prose
- `.two-col-text` — heading + two columns of text
- `.highlight-box` / `.highlight-box--secondary` / `.highlight-box--soft` — callout boxes
- `.blockquote` / `.blockquote--pull` — quotes and pull quotes
- `.checklist` / `.checklist--subtle` / `.checklist-grid` — tick-icon lists

**Cards and grids:**
- `.card--feature` / `.card--service` — icon + heading + text cards
- `.icon-box` / `.icon-box--left` / `.icon-box--card` — icon grid items
- `.steps` / `.steps--connected` / `.step` — numbered process steps (3 items default). Add `.steps--4` for 4-item layouts (4 columns at desktop).
- `.image-card` — photo + title + text card
- `.overlay-card` — image with text overlay
- `.grid--bento` — featured first card spans 2 rows (left), remaining cards fill 2-col grid (right). Use with `.card--feature` children. Add `.card--highlight` to first card for dark background variant. Use `.card__stat` for large metric numbers.
- `.stats` / `.stat--card` — number + label metrics
- `.grid--2` / `.grid--3` / `.grid--4` — responsive column grids

**Narrative & approach:**
- `.story-split` — centred heading above, h3 lead text on left, body paragraphs on right. Uses `--container-wide`. Preferred over steps for therapist journey/story sections.
- `.approach-grid` / `.approach-item` / `.approach-item__number` — numbered philosophy/values grid (2 columns). Use 4 items (2x2) to avoid orphans.
- `.info-band` / `.info-band--primary` — bold stat strip (3 items). Uses `.info-band__item` > `.info-band__icon` + `.info-band__item-text` > `.info-band__title` + `.info-band__text`.

**Social proof:**
- `.testimonial` — quote + author + stars
- `.testimonial--avatar` — centred with avatar
- `.testimonial-grid` — 2-column grid of testimonials
- `.trust-bar` — accreditation/logo bar (flex container, centred)
- `.trust-bar__logos` — inner flex wrapper for logo items (use this inside `.trust-bar` section)
- `.trust-bar__logo-placeholder` — placeholder for accreditation logos
- `.google-reviews` — compact star rating badge
- `.comparison` / `.comparison__card` — "right fit" tick/cross cards

**Team:**
- `.team-grid` / `.team-card` — photo + name + role grid
- `.team-list` / `.team-list__member` — compact horizontal list

**CTAs:**
- `.cta-banner` — full-width coloured CTA section. Use `btn--accent` for the primary CTA. If adding a secondary link, use `btn--secondary` which auto-adapts to white text on dark backgrounds.
- `.cta-inline` — bordered CTA box within content
- `.cta-image` — CTA with background image
- `.announcement-bar` — top-of-page alert strip

**Pricing:**
- `.pricing-card` / `.pricing-card--featured` — pricing plan cards
- `.pricing-grid` / `.pricing-grid--3` — pricing card grid
- `.fee-table` / `.fee-item` — line-item fee list
- `.comparison-table` — feature comparison table
- `.details-table` — key-value detail table

**FAQ:**
- `.accordion` / `.accordion__item` / `.accordion__trigger` / `.accordion__content` — expandable FAQ
- `.accordion-grid` — side-by-side accordions

**Forms:**
- `.form` / `.form__group` / `.form__row` / `.form__input` / `.form__textarea` — form elements
- `.form__label--required` — required field indicator
- `.contact-grid` — contact info + form side-by-side (5:7 ratio, 96px gap on desktop). **Always use this for contact pages**, not `.grid--2`.
- `.contact-info` / `.contact-info__item` — contact details list

**Blog:**
- `.blog-grid` / `.blog-card` — blog listing
- `.blog-post` / `.blog-post__body` / `.blog-post__meta` — article layout

**Utilities:**
- `.section-label` — uppercase category label above headings
- `.section-subtitle` — muted subtitle below headings
- `.breadcrumbs` — page path navigation
- `.alert` / `.alert--info` / `.alert--warning` — notice boxes
- `.badge` — small label tags
- `.back-to-top` — scroll-to-top button
- `.cookie-banner` — GDPR consent bar

**Footer variants:**
- `.footer` — default 4-column footer
- `.footer--simple` — minimal single-row footer
- `.footer--two-col` — brand + links two-column

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

8. **Mandatory elevation + critique pass before delivery.** Once the build renders, run the `impeccable` skill (or an adversarial design-critique subagent) against the homepage and the busiest inner page, asking one blunt question: **"Is this special, or competent-but-safe?"** Hunt specifically for: washed-out / one-note colour, flat text-only sections, repeated components, missing imagery, a default-looking hero. Fix what it finds. **Do not deliver a build whose flaws only a post-complaint redo would have caught.**

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

1. Initialise git repo in the client site directory
2. Create initial commit with all files
3. Add remote for `trulyempoweredcode/{domain}` on GitHub (repo should already exist)
4. Push to `main` branch
5. Remind user to enable GitHub Pages on `main` branch in repo Settings > Pages
6. Report the preview URL: `https://trulyempoweredcode.github.io/{domain}/`

---

## Self-Audit Checklist (complete before delivering)

Before reporting the site as ready, verify every item:

**Visual (LOOK at the rendered pages — not just the DOM):**
- [ ] You have actually viewed the homepage + each page type as a rendered screenshot. If you couldn't, you flagged it to the user instead of signing off blind.
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
- [ ] Favicon present on every page (data-URI emoji or relative favicon.svg — never root-absolute /favicon.* which 404s on GitHub Pages)
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
