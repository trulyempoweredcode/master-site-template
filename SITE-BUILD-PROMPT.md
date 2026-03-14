# Client Site Build Prompt

Paste this prompt at the start of a new Claude Code session to build a client website. Fill in the client brief section, then let Claude work autonomously.

**Working directory must be:** `D:\claude-custom-projects\Ai-Editor`
**Master template location:** `D:\claude-custom-projects\Ai-Editor\master-site-template\`
**Client sites location:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`

---

## Prompt (copy everything below this line)

Build a complete client website using the master site template design system.

### Client Brief

```
Business name:
Contact name:
Domain:
Industry/niche:
Phone:
Email:
Address:
Opening hours:
Social links:

Pages wanted: (or "you decide based on industry")
Content rewrite permission: yes / no / partial (specify)
Theme preference: (palette + fonts, or "you recommend")
Hero style: (or "you recommend")
Blog needed: yes / no
Google Analytics ID: (if known)

Notes from client:
(paste any specific requests, preferences, or instructions here)
```

**Client content is in:** `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\content\`
(Word docs, PDFs, text files, images — whatever they provided)

### Instructions

Read the master template files first:
- `master-site-template/css/base.css` — design tokens, grid, buttons
- `master-site-template/css/components.css` — full component library (~50 components)
- `master-site-template/css/theme.css` — current theme example (Calm Sage)
- `master-site-template/themes/` — all palettes, fonts, and presets
- `master-site-template/index.html` — homepage structure reference
- `master-site-template/head.html` — SEO head template
- `master-site-template/js/main.js` — JavaScript behaviours
Then read ALL files in the client's content folder to understand what they've provided.

---

## Phase 1: Analysis (do not output — use to inform the build)

1. **Read the client's content.** Identify key information, messaging goals, voice/tone, and anything that must be retained verbatim.

2. **Research competitors.** Search the web for 2-3 top-ranking competitors in the client's niche + location. Note structural patterns, content patterns, and trust signals they use. Do NOT add competitor trust signals to the client's site — flag them in the content checklist instead.

3. **Identify missing pages.** Compare the client's content against competitor sites and niche expectations. Common missing pages for service businesses: "What to Expect", "Areas/Conditions I Work With", "My Approach", dedicated booking page. Flag missing pages in the content checklist.

4. **Extract voice and tone.** Identify whether the client's natural voice is warm, clinical, formal, conversational, authoritative, nurturing, or a blend. Maintain this voice consistently across all content.

5. **Select theme.** Based on the client's industry, preferences, and competitor landscape:
   - Pick a colour palette from: calm-sage, bold-navy, warm-terracotta, clean-slate, rich-forest, bright-coral, soft-blush, warm-mocha
   - Pick a font pairing from: classic-elegance, modern-pro, friendly, clean-bold, editorial, minimal, boutique, corporate
   - Pick a hero variant from: default split, fullwidth, minimal, gradient, stacked, half, bold-text
   - If the client specified preferences, use those. Otherwise, choose what fits the industry.

6. **Plan page structure.** For each page, define:
   - The single primary conversion goal (e.g. "get visitor to contact page")
   - Which components from the library to use for each section
   - The emotional journey: empathy/validation → understanding → trust → action
   - Where testimonials and trust signals should be placed

7. **Content gap analysis.** Identify where the client needs to supply additional content (photos, testimonials, statistics, specific details). All gaps go in the content checklist.

8. **Rewrite content** (if permitted). Improve messaging, tighten copy, add persuasive structure. If rewrite is not permitted, use content verbatim but restructure into the component layout.

---

## Phase 2: Build

### 2a. Create site directory and theme

1. Create `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`
2. Copy CSS files from master template: `css/base.css`, `css/components.css`
3. Generate `css/theme.css` from the selected palette + font JSON files
4. Copy `js/main.js` from master template
5. Create `images/` directory
6. Generate `robots.txt` (allow all, reference sitemap URL)
7. Generate `sitemap.xml` listing all pages with `<lastmod>` dates

### 2b. Build pages

For each page, use the master template HTML structure:
- `<a href="#main" class="skip-link">` at the top
- Sticky nav with mobile hamburger
- `<main id="main">` wrapping all content
- Footer with 4-column layout
- Cookie consent banner
- Back-to-top button
- `<script src="js/main.js">` at the end

**Every page must have:**
- Full SEO head (from head.html template) with unique title, description, OG tags, structured data
- Correct nav link highlighting (`nav__link--active`)
- Cookie consent + back-to-top HTML before `</body>`
- Site credit link after footer section comment (outside section comments — not editable by AI editor)

**Every site must include these auto-generated pages (no client input needed):**
- `cookies-policy.html` — generated from `master-site-template/cookies-policy.html` template. Replace `{{BUSINESS_NAME}}`, `{{BUSINESS_TAGLINE}}`, `{{CTA_TEXT}}`, `{{DATE}}`, `{{CONTACT_EMAIL}}`, `{{CONTACT_PHONE}}`, and `{{FOOTER}}` with the client's details. This page is `noindex` — it exists for compliance, not SEO. Add it to the footer legal links alongside Privacy Policy.
- `privacy.html` — privacy policy page (content adapted to the client's business)

### 2c. Contact form setup

Client sites are hosted on GitHub Pages (static — no PHP). Forms POST to a central handler on 20i.

1. Set the form `action` to `https://editmy.site/api/contact.php`
2. Add a hidden field identifying the client: `<input type="hidden" name="site" value="{domain}">`
3. The form must use `method="POST"` and class `form` (main.js handles AJAX submission via `fetch`)

Example form opening:
```html
<form method="POST" action="https://editmy.site/api/contact.php" class="form">
  <input type="hidden" name="site" value="{domain}">
```

**Important:** After building the site, tell the user to add the client to `api/contact.php` on the 20i server. Provide the config block they need to add.

### 2d. robots.txt

Generate a `robots.txt` in the site root:
```
User-agent: *
Allow: /

Sitemap: https://www.{domain}/sitemap.xml
```

### 2e. sitemap.xml

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

### Component Library Reference

Use these CSS classes from components.css. Do NOT write custom CSS. Everything needed is in the library.

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
3. Create GitHub repo under `trulyempoweredcode/{domain}` organisation
4. Push to GitHub
5. The site will be configured for GitHub Pages from the `main` branch
6. Report the preview URL: `https://trulyempoweredcode.github.io/{domain}/`

---

## Self-Audit Checklist (complete before delivering)

Before reporting the site as ready, verify every item:

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
- [ ] Form action is `https://editmy.site/api/contact.php` with hidden `site` field
- [ ] robots.txt exists with sitemap reference
- [ ] sitemap.xml lists all public pages (excludes cookies-policy.html)
- [ ] No console errors

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
6. Contact form config block to add to `api/contact.php` on 20i
7. Any decisions made that need the user's review
