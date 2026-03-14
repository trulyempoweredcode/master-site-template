# Wireframe Conversion Prompt

Convert a wireframe (unstyled HTML with content/structure but no design) into a fully styled,
production-ready client website using the master site template design system.

**Working directory must be:** `D:\claude-custom-projects\Ai-Editor`
**Master template location:** `D:\claude-custom-projects\Ai-Editor\master-site-template\`
**Client sites location:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`

---

## Prompt (copy everything below this line)

Convert a wireframe into a fully styled client website using the master site template design system.

### Client Brief

```
Business name:
Domain:
Industry/niche:
Content rewrite permission: yes / no / partial (specify)
Theme preference: (palette + fonts, or "you recommend")
Hero style: (or "you recommend")

Notes:
(any specific requests or preferences)
```

**Wireframe files are in:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`
(These are the HTML files to be converted — they contain real content but minimal/no styling)

### Instructions

Read the master template files first:
- `master-site-template/css/base.css` — design tokens, grid, buttons
- `master-site-template/css/components.css` — full component library (~50 components)
- `master-site-template/css/theme.css` — current theme example
- `master-site-template/themes/` — all palettes, fonts, and presets
- `master-site-template/index.html` — homepage structure reference
- `master-site-template/head.html` — SEO head template
- `master-site-template/js/main.js` — JavaScript behaviours
- `master-site-template/cookies-policy.html` — cookie policy template

Then read ALL wireframe HTML files to understand the content and structure.

---

## Phase 1: Analysis

1. **Map wireframe content.** Read every wireframe page. For each page, list:
   - What content exists (headings, text, images, lists, forms)
   - The purpose of each content block
   - The conversion goal of the page

2. **Select theme.** Based on the industry and any client preferences:
   - Pick a colour palette from: calm-sage, bold-navy, warm-terracotta, clean-slate, rich-forest, bright-coral, soft-blush, warm-mocha
   - Pick a font pairing from: classic-elegance, modern-pro, friendly, clean-bold, editorial, minimal, boutique, corporate
   - Pick a hero variant from: default split, fullwidth, minimal, gradient, stacked, half, bold-text

3. **Map content to components.** For each content block in the wireframe, determine which component class from the library best fits. Document the mapping:
   - e.g. "About section with text + image" → `.split` or `.split--reverse`
   - e.g. "3 service boxes" → `.card--service` in `.grid--3`
   - e.g. "FAQ list" → `.accordion`
   - e.g. "Testimonial quotes" → `.testimonial` or `.testimonial-grid`

4. **Identify gaps.** Note anything the wireframe is missing that a production site needs:
   - SEO head tags
   - Mobile nav
   - Footer structure
   - Cookie consent / back-to-top
   - CTAs between sections
   - Trust signals near CTAs

---

## Phase 2: Build

### 2a. Set up site directory

1. Copy CSS files from master template: `css/base.css`, `css/components.css`
2. Generate `css/theme.css` from the selected palette + font JSON files
3. Copy `js/main.js` from master template
4. Create `images/` directory
5. Generate `robots.txt` (allow all, reference sitemap URL)
6. Generate `sitemap.xml` listing all pages with `<lastmod>` dates

### 2b. Convert each wireframe page

For each wireframe HTML file:

1. **Keep all existing content** — headings, text, images, links, lists. Do not remove or invent content.
2. **Restructure the markup** to use the component library classes. Replace generic `<div>`s and unstyled blocks with the correct BEM component markup.
3. **Add the full page shell:**
   - `<a href="#main" class="skip-link">` at the top
   - Sticky nav with mobile hamburger
   - `<main id="main">` wrapping all content
   - Footer (use existing footer content if present, otherwise build from client details)
   - Site credit link after footer section comment (outside section comments — not editable by AI editor)
   - Cookie consent banner (linking to `cookies-policy.html`)
   - Back-to-top button
   - `<script src="js/main.js">` at the end
4. **Add SEO head** from head.html template with unique title, description, OG tags, structured data.
5. **Add section comments** around every content section:
   - `<!-- SECTION: name -->` / `<!-- /SECTION: name -->`
   - Use kebab-case names: `nav`, `hero`, `page-header`, `intro`, `about`, `services`, `pricing`, `faq`, `contact-form`, `testimonials`, `team`, `cta`, `footer`
   - Do NOT wrap scripts, cookie banner, back-to-top, site credit, or skip-to-content link
6. **Ensure nav links** are relative and highlight the active page with `nav__link--active`.

### 2c. Auto-generated pages (no client input needed)

These pages are created automatically for every site:

1. **`cookies-policy.html`** — generate from `master-site-template/cookies-policy.html` template. Replace `{{BUSINESS_NAME}}`, `{{BUSINESS_TAGLINE}}`, `{{CTA_TEXT}}`, `{{DATE}}`, `{{CONTACT_EMAIL}}`, `{{CONTACT_PHONE}}`, and `{{FOOTER}}` with the client's details extracted from the wireframe. This page is `noindex`.

2. **`privacy.html`** — if the wireframe doesn't include one, create a privacy policy page adapted to the client's business.

Both pages must include the same nav, footer, site credit, cookie banner, and back-to-top as all other pages.

### 2d. Footer legal links

Every page's footer must include both links in the `.footer__legal` section:
```html
<a href="privacy.html">Privacy Policy</a>
<a href="cookies-policy.html">Cookie Policy</a>
```

### 2e. Site credit

Every page must include the site credit after `<!-- /SECTION: footer -->` (outside section comments so the AI editor cannot modify it):
```html
<div class="site-credit">
  <p>Website by <a href="https://www.therapywebgenie.com" target="_blank" rel="noopener">Therapy Webgenie</a></p>
</div>
```

### 2f. Contact form setup

Client sites are hosted on GitHub Pages (static — no PHP). Forms POST to a central handler on 20i.

1. Set the form `action` to `https://editmy.site/api/contact.php`
2. Add a hidden field identifying the client: `<input type="hidden" name="site" value="{domain}">`
3. The form must use `method="POST"` and class `form` (main.js handles AJAX submission via `fetch`)

**Important:** After building the site, tell the user to add the client to `api/contact.php` on the 20i server. Provide the config block they need to add.

### 2g. robots.txt and sitemap.xml

Generate `robots.txt`:
```
User-agent: *
Allow: /

Sitemap: https://www.{domain}/sitemap.xml
```

Generate `sitemap.xml` listing all public pages (exclude `cookies-policy.html`).

### 2h. Content improvements (only if rewrite permission granted)

If the client has given content rewrite permission:
- Tighten copy, improve headings to be benefit-led
- Add CTA sections between content blocks where missing
- Improve scannability (bold lead-ins, shorter paragraphs)
- Do NOT invent factual claims, credentials, testimonials, or trust signals

If no rewrite permission: use all content exactly as provided, only restructure into components.

---

## Component Library Reference

Use these CSS classes from components.css. Do NOT write custom CSS.

**Page structure:**
- `.section` / `.section--alt` / `.section--dark` — page sections with padding
- `.container` / `.container--narrow` — max-width wrappers
- `.page-header` — inner page hero with label + h1 + subtitle

**Heroes (homepage):**
- `.hero` — default split (text + image)
- `.hero--fullwidth` — full-width gradient overlay
- `.hero--minimal` — text only, centred
- `.hero--gradient` — subtle gradient + decorative shape
- `.hero--stacked` — full-width image top, text below
- `.hero--half` — 50/50 edge-to-edge split
- `.hero--bold-text` — typography-led, no image, optional stat bar

**Content sections:**
- `.split` / `.split--reverse` / `.split--text-wide` / `.split--image-wide` — text + image layouts
- `.text-block` / `.text-block--center` — centred prose
- `.two-col-text` — heading + two columns of text
- `.highlight-box` / `.highlight-box--secondary` / `.highlight-box--soft` — callout boxes
- `.blockquote` / `.blockquote--pull` — quotes and pull quotes
- `.checklist` / `.checklist--subtle` / `.checklist-grid` — tick-icon lists

**Cards and grids:**
- `.card--feature` / `.card--service` — icon + heading + text cards
- `.icon-box` / `.icon-box--left` / `.icon-box--card` — icon grid items
- `.steps` / `.steps--connected` / `.step` — numbered process steps
- `.image-card` — photo + title + text card
- `.overlay-card` — image with text overlay
- `.bento` / `.bento__item--wide` / `.bento__item--highlight` — mixed-size grid
- `.stats` / `.stat--card` — number + label metrics
- `.grid--2` / `.grid--3` / `.grid--4` — responsive column grids

**Social proof:**
- `.testimonial` — quote + author + stars
- `.testimonial--avatar` — centred with avatar
- `.testimonial-grid` — 2-column grid of testimonials
- `.trust-bar` / `.trust-bar__logo-placeholder` — accreditation/logo bar
- `.google-reviews` — compact star rating badge
- `.comparison` / `.comparison__card` — "right fit" tick/cross cards

**Team:**
- `.team-grid` / `.team-card` — photo + name + role grid
- `.team-list` / `.team-list__member` — compact horizontal list

**CTAs:**
- `.cta-banner` — full-width coloured CTA section
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
- `.contact-grid` — contact info + form side-by-side
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

## Content Integrity Rules (MANDATORY)

1. **Never invent factual claims.** Every credential, qualification, trust signal, and testimonial must come from the wireframe content. Zero exceptions.
2. **Trust bars** may only contain credentials present in the wireframe.
3. **Testimonials** must be direct quotes from the wireframe content.
4. **If content rewrite is permitted**, you may restructure and tighten copy but not introduce new factual claims.
5. **If in doubt** about whether something is in the wireframe: leave it out and flag it in the content checklist.

---

## Phase 3: Content Checklist

Create a `content-checklist.html` page listing:

1. **Content gaps** — missing images, placeholder text that needs replacing, sections that would benefit from more content
2. **Recommendations** — CTA sections added, structural improvements made, components chosen and why
3. **Missing elements** — anything the wireframe didn't include that was added (footer details, meta tags, etc.)
4. **Image requirements** — every placeholder with dimensions and alt text description

Address the client in second person. Never reference AI or automation.

---

## Phase 4: Section Comments & Editor Compatibility

Ensure every content section has been wrapped with:
- `<!-- SECTION: name -->` / `<!-- /SECTION: name -->`

Do NOT wrap: `<script>` tags, cookie consent, back-to-top, skip-to-content link.

---

## Phase 5: Git Setup and Deploy

1. Initialise git repo in the client site directory
2. Create initial commit with all files
3. Create GitHub repo under `trulyempoweredcode/{domain}` organisation
4. Push to GitHub
5. Report the preview URL: `https://trulyempoweredcode.github.io/{domain}/`

---

## Self-Audit Checklist

Before reporting the site as ready, verify:

**Content integrity:**
- [ ] All content from the wireframe is present — nothing removed
- [ ] No credentials, testimonials, or trust signals invented
- [ ] Content checklist flags all gaps and recommendations

**Component mapping:**
- [ ] Every wireframe content block maps to an appropriate component class
- [ ] No custom CSS written — everything uses the library
- [ ] Component choices suit the content type (not forced)

**Technical:**
- [ ] All inter-page links use correct relative filenames
- [ ] Every page has unique meta title (<60 chars) and description (<155 chars)
- [ ] Structured data (LocalBusiness JSON-LD) on homepage
- [ ] Mobile nav works (hamburger toggle)
- [ ] Cookie consent banner on every page (links to cookies-policy.html)
- [ ] cookies-policy.html exists with correct business details
- [ ] Footer legal links include both Privacy Policy and Cookie Policy
- [ ] Site credit link present on every page (outside section comments)
- [ ] Form action is `https://editmy.site/api/contact.php` with hidden `site` field
- [ ] robots.txt exists with sitemap reference
- [ ] sitemap.xml lists all public pages (excludes cookies-policy.html)
- [ ] Back-to-top button on every page
- [ ] Skip-to-content link on every page
- [ ] Section comments on every content section
- [ ] No console errors

**Design:**
- [ ] Theme applied consistently (palette + fonts) across all pages
- [ ] Section alternation (`.section` / `.section--alt`) creates visual rhythm
- [ ] Hero variant suits the content and industry
- [ ] Footer populated with available client details

---

## Delivery

When complete, report:
1. All pages converted with component mapping summary
2. Theme selected (palette + fonts + hero variant) with rationale
3. Content checklist summary (gaps found, recommendations made)
4. GitHub repo URL
5. Preview URL
6. Contact form config block to add to `api/contact.php` on 20i
7. Any decisions made that need review
