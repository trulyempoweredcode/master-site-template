# Component Library Index

Source of truth: `master-site-template/css/components.css`. Demos at `theme-preview.html`.

**Use this doc to pick a component before designing a section. Don't improvise — if nothing here fits, flag it before building.**

> **For client briefs and live theming** — open `master-site-template/theme-preview.html`. It's the single demo page: palette generator + theme switcher at the top, live-updating component preview, then a sticky-tab catalogue of every component organised by category. (The old `showcase.html` redirects here — kept for old bookmarks.)

Every component is token-driven (uses `var(--color-*)`, `var(--space-*)`, `var(--radius-*)`, `var(--font-*)`). Modifiers follow BEM (`__child`, `--variant`).

---

## Site chrome

- **`.nav`** — top navigation. Variants: `--two-tier` (brand bar + nav bar with contact info), `--branded`, `--transparent`, `--transparent-dark`, `--transparent-light`. Hierarchical config via DB `nav_config_json`.
- **`.nav-scroll`** — sticky condensed nav that slides in on scroll. Use `--visible` to toggle.
- **`.nav-scroll--branded`** (**v1.7.27**) - the scroll bar in the brand colour with the logo on the left: put `<img class="nav-scroll__logo">` (the light logo) in `.nav-scroll__brand`. Tokens `--nav-scroll-bg` (primary), `--nav-scroll-text` (`--nav-bar-text`, then white), `--nav-scroll-height` (64px), `--nav-scroll-logo-height` (52px). counsellingwithyuzi.com, 11-11-2026.
- **Photos of people** (**v1.7.27**) - `.intro__image-wrap` is a 3:4 portrait like `.intro__image`, and every person photo (intro, about-hero, about-split-third, team, avatars, `.card--portrait` cards from v1.7.28) is cropped 20% from the top so no head is cut. Never set an inline crop on them; move one photo with inline `--photo-focus`.
- **`.nav--sticky`** (**v1.7.27**) - add to `.nav` to keep the full header at the top while the page scrolls; anchor links land below it. Use instead of `.nav-scroll`, not with it.
- **`.announcement-bar`** — slim full-width promo strip above nav. Variants: `--secondary`, `--subtle`, `--accent`. Supports rich layout: `__inner` + `__msg` + `__pill` + `__link` for promo + CTA. Or use plain centred text + `<a>`.
- **`.skip-link`** — accessibility skip-to-content.
- **`.breadcrumbs`** — page trail. `__item`, `__separator`, `__item--active`.
- **`.page-header`** — title block at top of inner pages. Variants: `--dark`, `--image`. Use `.page-header__meta` utility for readable text on dark/image variants. **v1.7.12 `.page-header__actions`** - a centred button row under the header text with the gap owned by the slot (`margin-top: var(--space-lg)`); `.page-header p` carries `margin: 0 auto`, so a bare `.btn` after it sits flush on the paragraph. Use it whenever a page-header (including one used as a mid-page full-width image band) ends in a button.
- **`.page-header--rule`** (**v1.7.25**) - a short primary-colour line under the page title (`section.page-header.page-header--rule`), the divider many Elementor page titles carry.
- **`.footer`** — site footer (multi-column). Variant: `--simple` for a single-line variant. The `__legal` row wraps (v1.7.11), so any number of legal or policy links is fine.
- **`.back-to-top`** - floating back-to-top button.
- **`.footer__logo`** (**v1.7.20**) - the brand mark as an `<img>` in `.footer__brand`, above `.footer__brand-name`, 72px tall (fixed, so a lazy-loaded logo never shifts the footer). Give the `<img>` its width and height attributes.
- **`.page-frame`** (**v1.7.25**) - on `<body>`: the whole page (announcement bar, nav, main, footer) as a centred box over a full-page photograph, from 1024px; phones and tablets stay full width. The photo is a token in the site's `theme.css` `:root`: `--page-frame-image: url('../images/background.jpg');`. Optional `--page-frame-width` (1180px), `--page-frame-gap` (space above and below the box), `--page-frame-position`, `--page-frame-bg`. The fixed `.nav-scroll` bar keeps the box width. The look of many older client sites moving off Elementor (woodlandscounselling.co.uk, 30-10-2026).
- **`.cookie-banner`** — GDPR cookie consent.
- **`.site-credit`** — small "built by" credit row.

## Hero

Pick exactly one per page. Mobile responsive built in.

- **`.hero`** + **`.hero--fullwidth`** — full-bleed background image hero.
- **`.hero--half`** — 50/50 split (image left, text right by default). **Image clamped 85vh desktop / 55vh mobile** by default (set `max-height: none` on `.hero__inner / __image-wrap / __image / __content` in your theme.css to opt out — only when needed).
  - **v1.4 ratio modifiers**: `.hero--half--text-wide` (1.45fr / 1fr), `.hero--half--image-wide` (1fr / 1.45fr).
  - **v1.4 image-right**: `.hero--half--image-right` flips the image to the right (text-left layout).
- **`.hero--image`** — full-bg image with a dark overlay wash and centred text (no frost card).
- **`.hero--image-left` / `.hero--image-right`** — text-position modifiers (apply alongside `.hero--image`; default is centred). Named for the side the TEXT sits on.
- **`.hero--showcase`** — full-vibrancy photo with a frosted-glass floating card. `::before` is `display:none`, so there is **no darkening overlay** — the card does the separating, which is why tone matters. Needs two modifiers:
  - **tone** — **`.hero--showcase-dark`** (card `rgba(0,0,0,.55)`, white text — use over a LIGHT/bright image) or **`.hero--showcase-light`** (card `rgba(255,255,255,.65)`, dark text — use over a DARK image). Get this backwards and the card vanishes into the photo.
  - **position** — default left, or **`.hero--showcase-center`** / **`.hero--showcase-right`**. (`.hero--showcase-left` exists only as the documented default name; the bare component is already left-aligned.)
- **`.hero--banner`** — short banner-height hero (image strip 400px ≥768px, text below).
- **`.hero--minimal`** — text-only, no image.
- **`.hero--slope-dark`** / **`.hero--slope-light`** — angled panel cut behind the text, over a side image. `--dark` inverts heading/body/button colours for the dark panel; `--light` keeps standard text colours. Pair `--slope-dark` with `nav--transparent-dark` on the homepage.
- **`.hero--reverse`** — side-flip modifier. Applies to `.hero` (classic), `.hero--half`, and both slope variants; ≥768px only, so mobile stacking is unaffected.

**Portal `Hero style` → class map (all 16 values).** The brief's Hero style field is resolved here — nothing else maps it:

| Portal value | Classes |
|---|---|
| `classic` / split | `.hero` |
| `half` | `.hero--half` |
| `fullwidth` | `.hero--fullwidth` |
| `minimal` | `.hero--minimal` |
| `banner` | `.hero--banner` |
| `slope-dark` / `slope-light` | `.hero--slope-dark` / `.hero--slope-light` |
| `image-left` / `image-center` / `image-right` | `.hero--image` + `--image-left` / (none) / `--image-right` |
| `frost-dark-left/center/right` | `.hero--showcase .hero--showcase-dark` + (none) / `--showcase-center` / `--showcase-right` |
| `frost-light-left/center/right` | `.hero--showcase .hero--showcase-light` + (none) / `--showcase-center` / `--showcase-right` |

Add `hero--reverse` when the brief says Hero reversed: yes (classic / half / slope only).
- **`.hero__floats`** — wrapper inside `.hero__image-wrap` for absolute-positioned glass stat cards (`.hero__float` + `--tl/--tr/--bl/--br/--ml/--mr`). Hidden under 768px. Use for credibility numbers (years, clients, ROI).
  - **v1.4 cantilever pattern**: wrap the `<img>` in `.hero__image-clip` and add `.hero--floats-cantilever` to `.hero__image-wrap`. Then use `.hero__float--out-r / --out-l / --out-t / --out-b` on individual floats to make them hang past the image edges.
- **`.hero__heading`** — primary H1 inside the hero. **v1.4 `.hero__heading--animate`** triggers a word-by-word blur-fade entrance (auto-wired by main.js, honours `prefers-reduced-motion`).
- **`.hero__stats`** - inline stat row inside hero content.
- **`.hero__text--lead`** (**v1.7.20**) - on a `p.hero__text`: the subtitle one step up (`--text-lg`) in bold, so it reads as a lead line, not a second paragraph.
- **`.hero__ticks--bold`** (**v1.7.20**) - bolder tick pills: white pills, 16px words, green ticks. Opt-in on `ul.hero__ticks`; the plain pills are unchanged.

## Cards

- **`.card`** — generic surface card (icon-led by default). Modifiers: `--service`, `--feature`, `--highlight`, `--image-top` (photo at top, with optional `.card__badge` corner pill — `__badge--accent` for secondary tint, add `.card--portrait` for 1:1 team headshots).
- **`.icon-box`** - icon + heading + text block. Variants: `--card`, `--left`.
- **`.card__image-wrap--square`** (**v1.7.20**) - on the `.card__image-wrap` of a `.card--image-top`: a 1:1 box, so a square picture (a child's drawing, a logo) shows whole instead of cropped to 4:3.
- **`.card__icon--bold`** (**v1.7.20**) - on a `.card__icon`: a 64px solid disc in the primary colour with a 32px white icon, for bright, child-friendly sites. Works on alt sections and bands.
- **`.image-card`** — image-led card pattern.
- **`.overlay-card`** — text overlay over a photo.
- **`.bento`** — bento-grid layout for varied card sizes.
- **`.contact-card` / `.contact-cards`** — standalone contact info card / grid.

## CTA blocks

- **`.cta-banner`** — full-width gradient CTA section. Has `__buttons` for grouped CTAs.
- **`.cta-banner--split`** — variant with text left + image right (gradient fade into bg). Use for time-bound offers.
  - **v1.4** — added `min-width: 0` overflow guard on the grid + children, so heavy text content (long H2s, large buttons) no longer forces the section wider than the viewport on mobile.
- **`.cta-inline`** — inline CTA inside content. `--dark` variant for plum gradient.
- **`.cta-image`** — image-backed CTA.
- **`.cta-mid-banner`** — full-width mid-page CTA strip.

## Layout / structure

- **`.split`** — 2-column split. Variants: `--bleed` (image fills full edge — drop the container wrapper, no extra CSS needed). **Author both `.split` and `.split--reverse` with the CONTENT block FIRST in the DOM, image second** — `.split` renders image-right, `.split--reverse` flips the image left via CSS `order` at ≥768px. Content-first DOM means mobile always stacks heading-then-image (consistent + scannable); putting the `<img>` first breaks that AND (pre-fix) left every reverse image on the right. Both `.split__text` and `.split__content` are reordered by `--reverse` (fixed 2026-07-02).
- **`.split--bleed` sections clip sideways overflow (v1.7.15)** so the reveal's 34px slide cannot give the page a horizontal scroll. Never fix that by clipping html or body. Since v1.7.16 the bleed photo fills the band's full height at 768px and up (never shorter than the old 4:3), so long text no longer leaves it floating.
- **`.split__image`** + `--portrait` / `--landscape` / `--square`.
- **`.story-split`** — narrative two-column with lead text.
- **`.story-text`** — centred header + pull-quote left / body right.
- **`.text-block`** — generic text block. Variant: `--center`.
- **`.two-col-text`** — heading spans full width, body text splits into 2 columns via `__columns` (1-col mobile).
- **`.about-hero`** — about-page hero pattern (image + text).
- **`.about-split-third`** — 1fr image / 2fr text full-bleed split.
- **`.intro`** — homepage welcome split (image + text). Use `__inner--reversed` to swap sides.
- **`.info-band`** — horizontal feature strip with icons. Variants: `--light`, `--primary`. **Canonical markup: the band is FULL-WIDTH (place it directly in the `<section>`, NOT inside a `.container`) and the items sit in `.container.info-band__inner` — i.e. put the `container` class ON `.info-band__inner`.** Wrapping the band in a container makes the coloured background a narrow centred box instead of stretching the section. `.info-band__inner` now self-centres (max-width + auto margins) as a safety net even without `.container` (fixed 2026-07-02). **A standalone bridging band (e.g. a value strip between the page-header and the first content section) should sit FLUSH — place it directly in `<main>`, NOT inside a padded `.section`, and do NOT put `.reveal` on the band itself** (the reveal's translateY leaves dead space above/below the coloured strip). Only wrap it in a `.section` when it genuinely belongs to a headed content section (e.g. a "why reviews matter" block) — and even then close the heading's section first so the band bridges flush to the next section. **v1.7.6** — the `--primary` gradient's light stop is tokenised as **`--info-band-from`** (default `var(--color-primary-dark)`), so a site can warm or cool the band from its own `theme.css` `:root` without forking components.css: `:root { --info-band-from: #976c5c; }`. Text on the `--primary` variant is now pure white for BOTH the title and the sub-line — a lighter stop pushed the inverse-cream title to ~4.3:1 and the old 70%-white sub-line to ~3.1:1, under AA; hierarchy comes from size and typeface, not opacity. `.info-band__title` is `--text-lg`.
- **`.divider`** - section divider rule.
- **`.divider--line`** (**v1.7.22**) - a thin rule between two parts of the text in one column: `div.divider.divider--line`, no SVG inside. It takes the text's colour, faintly, so it reads on white and on a colour band. Plain `.divider` is the wave or shape between bands and draws nothing without its SVG.
- **`.band`** + **`.band--1`** to **`.band--4`** (**v1.7.20**) - puts a whole band in one of four brand colours: `<section class="section band band--2">`, and the same classes work on `.hero` and `.page-header` (an orange hero, a coral quote band, a lime services band). Each slot defaults to a palette colour (1 primary, 2 secondary, 3 accent, 4 bg-dark). A site retargets a slot with tokens only, in its `theme.css` `:root`: `--band-2-bg: #FF5757; --band-2-text: #2A1535;`. `--band-N-text` is white by default: give a light colour a dark ink so its text stays at 4.5:1. The band's own heading, label, intro, quote (mark included), hero words and outline buttons take the band's text colour, and so do headings, paragraphs and ticked lists in any of its text columns, including what a client adds (**v1.7.23**); a quote on its own panel (`.blockquote` without `--pull`) keeps the panel's colours; cards and steps inside it keep their own surface. Bands are exempt from the alternation safety net (each is its own background), and `validate_site.py` counts each slot as its own background, so two adjacent bands of the same slot still fail. Use for bright, bold brands (children's services); a calm site still alternates `.section` / `.section--alt`.

## Process / steps

- **`.approach-grid`** + **`.approach-item`** — text-only numbered steps (no images). 1-col mobile, 2-col desktop. Use for "How I work" lists, and for any numbered sequence the source copy has written out as `1. … 2. … 3. …` inside plain paragraphs — that is the canonical "sequences to steps" swap. Markup per item: `__number` div + `<h3>` + `<p>`, in that order. **v1.7.7** — carries `align-content: start`. Cards are stretched to the tallest in their row, and without it the surplus height inflated the heading row and left an ~80px hole under the `h3` of any shorter card. Don't remove it, and keep the theme-preview demo's items uneven in length: an even-length demo hid this for months.
- **`.process-grid`** + **`.process-step`** — 3- or 4-step (`--4`) with **image per step**. Number badge top-left, photo, title, body. Use for "How it works" with visuals.
  - **v1.4 `.process-step--num-centered`** — moves the number from absolute top-left of the image into the body, centered above the title (transparent bg, white border, inherits `currentColor`). Cleaner stepper aesthetic on dark cards.
- **`.process-spine`** + **`.process-spine__step / __num / __body / __title / __text`** — vertical numbered process with a connector rail down the centre between number nodes. No images, single column. Use for editorial/B2B "methodology" sections where the steps deserve more drama than `.process-grid` (e.g. Hercules Power-First Development). Honours `.section--dark` / `.bg-dark` for inverted treatment.
- **`.steps` / `.step`** — generic step widget. **v1.7.27 `.steps--numerals`** - a large light numeral (write `01`, `02`, `03` in `.step__number`) instead of the dark circle, full-size step titles, all centred. Token `--step-numeral-color` (accent by default). Not with `--connected`. Also **v1.7.27 `--card-title-gap`** sets the space under `.card__title` (default 0.5rem).

## Comparison / timelines

- **`.timeline-compress`** + **`.timeline-compress__row / __label / __bar / __fill / __value`** — side-by-side horizontal bars comparing two durations. Use `__row--baseline` for the comparison bar (greyed) and `__row--us` for the brand bar (gradient, larger, primary colour). Set bar widths via inline `style="width:X%"` on the `__fill`. Designed for "industry standard vs us" speed claims (e.g. Hercules: 5–7 yrs vs 24–36 mos). Honours `.section--dark` / `.bg-dark`.

## Stats / numbers

- **`.stats`** + **`.stat`** — big-number row. 2-col mobile, 4-col desktop. Slots: `__number` (use `--accent` for orange), `__label`, `__sub` (small caption), `__icon`. Use `.stat--card` for boxed look.
  - **v1.4 counter animation**: add `data-target="49"` and optional `data-suffix="+"` to `.stat__number` (initial text content can be `0`). main.js animates count-up from 0 to target on scroll-into-view. Honours `prefers-reduced-motion`.

## Services / pricing / FAQ

- **`.services-layout`** + **`.services-sidebar`** — services-page wrapper with sticky sidebar nav. Sidebar JS-generated from `[id^="service-"]` sections.
- **`.service-section`** + **`.service-detail`** — individual service block. Use `.service-detail__header` for inline icon+title.
- **`.pricing-card`** + **`.pricing-grid`** — pricing tiers. Variants: `--featured` (highlighted card), `--2`, `--3`, `--4` for column counts. **Card count must match grid modifier** (use `--2` for 2 cards, not `--3`).
- **`.treatment-list`** — vertical stacked menu of treatments/services. Each `__item` is a rounded white box: `__head` (title-left + price-right flex row, with a 2px dotted leader between them) → `__summary` (short description) → `__details` native `<details>` with `<summary>` styled as "Read more" toggle, expanding to `__body` for long-form copy. Slots: `__title`, `__price`, `__duration` (small inline next to price), `__summary`, `__details`, `__body`. Solves the uniform-content-length problem of `pricing-grid` for spa/clinic menus where treatment descriptions vary widely in length. **No JS needed** — uses native `<details>`/`<summary>`. Group multiple lists under section headings (e.g. "Signature Rituals" / "Essentials") for menu segmentation. **Three image variants:** default (no image), `--image-square` (140px square thumbnail left, content right), `--image-circle` (140px round thumbnail left, content right). Image variants need an extra `__image` element wrapping an `<img>` and a `__content` element wrapping the rest — see master CSS. All variants stack the image above the content on mobile (<640px). Added v1.5.1, image variants v1.5.2.
- **`.pricing-single`** - single-tier pricing block. **v1.7.25:** it and `.pricing-grid` get 32px of space below when anything follows them.
- **`.fee-table` / `.fee-item`** — fee list pattern (alternative to pricing-card).
- **`.comparison-table` / `.comparison`** — side-by-side comparison.
- **`.details-table` / `.details-row`** — generic detail rows.
- **`.accordion`** — expandable Q&A: `accordion__item` > `accordion__trigger` (button with `aria-expanded` + `accordion__icon` svg) + `accordion__content`. JS-driven (main.js wires `.accordion__trigger`).
- **`.faq-item`** — STATIC Q&A list (`__question` + `__answer`, always open, no toggle). Not interactive — use `.accordion` for expand/collapse.
- **`.accordion-grid`** — side-by-side accordions (2-col desktop, 1-col mobile).

## Testimonials / social proof

- **`.testimonials`** + **`.testimonial`** — testimonial section. Variant: `--avatar` for photo + quote.
- **`.testimonial-grid`** — multi-card grid.
- **`.testimonial-carousel`** — slider variant. **Never use on demo homepages** — always 3 cards in `grid--3` instead.
- **`.google-reviews`** — Google Reviews embed slot styling.
- **`.trust-bar`** - logo strip (single row, static).
  - **v1.7.20 `.trust-bar--colour`** - shows the logos in their own colours at full strength (the plain strip greys and fades them until hover). Use for registration and membership bodies, whose logos and small print should read as issued.
- **`.logo-ticker`** + **`__viewport`** + **`__track`** + **`__item`** + **`__logo`** + **`__pill`** — infinite-scroll horizontal marquee. Pauses on hover. Falls back to scrollable list for `prefers-reduced-motion`. Use real `<img class="logo-ticker__logo">` OR `.logo-ticker__pill` text fallback.
  - **v1.4 modifiers**: `.logo-ticker--no-fade` drops the gradient edge mask (use when you want logos to bleed to the screen edge). `.logo-ticker--no-pause` keeps the animation running on hover.
- **`.rated-pill`** — inline award/rating badge ("Rated #1 by …"). `__icon` + `__highlight` for emphasised text. Variant: `--accent`.

## Team

- **`.team-grid`** — team grid layout.
- **`.team-list` / `.team-list-item` / `.team-member`** — list-style team patterns.
- For 3-up portrait cards, use **`.card--image-top.card--portrait`** (preferred — covers both services + team with one component).
- **`.team-card`** — hover-intensity hook, NOT a standalone component: it has no base rule and must never be given one. Always written alongside `.card` (creativewellness.co.uk/about.html uses `card card--image-top card--portrait team-card`), so `.card` supplies the surface and `.card:hover` the default -2px lift; `.team-card` only upgrades that lift to -4px. Reach for `.card--image-top.card--portrait` first and add this if a team row should lift harder than the rest of the page. Don't delete it as an orphan — a live client site depends on it.

## Forms

- **`.form`** — form wrapper. `__group`, `__label`, `__select`, `__textarea`, `__row`, `__hint`, `__consent`, `__group--checkbox`. Variant: `--full-width`.
- **`.contact-form-card`** — boxed form pattern.
- **`.contact-grid`** — form + contact info side-by-side.
- **`.contact-info__*`** — heading, intro, item, icon, label, text slots.
- **`.map-placeholder`** — map iframe slot.

## Blog

- **`.blog-grid`** + **`.blog-card`**: blog index listing. Slots: `__image`, `__category` (v1.7.14, small primary-colour label above the date), `__date`, `__title`, `__excerpt`, `__link`. `.blog-empty` is the no-posts message and spans the whole grid. Since v1.7.15 the Read more link is pinned to the bottom of each card and a lone card on the last row is centred.
- **`.blog-filters`** + **`.blog-filter`** (`--active`) (v1.7.14): category filter pills, same look as `.shop-filter`. A SIBLING above `.blog-grid` (`<div class="container blog-filters">`), never inside it. `BlogListingHtml` emits it with its click script once a blog has 2+ categories and removes both when it drops to one; do not hand-place it.
- **`.blog-post`** + slots `__hero`, `__meta`, `__author`, `__share` — single post page.

## Gallery / media

- **`.gallery`** + **`.gallery__item`** — responsive image grid (1:1 default). Click-to-zoom via `.lightbox` (auto-wired by main.js — needs `<img>` children, not CSS bg). Aspect modifiers: `__item--landscape` (4:3), `__item--portrait` (3:4), `__item--wide` (16:9). Optional `__caption` overlay (fades in on hover). `--collapsible` + `--expanded` for mobile show-more pattern.
- **`.lightbox`** + **`__open`** + **`__img`** + **`__close`** — full-screen image viewer (markup must exist on page for gallery clicks to work; main.js wires it).
  - **v1.4** — adds optional `.lightbox__prev` and `.lightbox__next` buttons (auto-wired when present, plus `ArrowLeft`/`ArrowRight` keyboard nav). Subtle entrance animation (`opacity 0 + scale 0.94 → 1`) on `.lightbox--open .lightbox__img`. Both honour `prefers-reduced-motion`.
- **`.gallery-grid` / `.gallery-item` / `.gallery-empty` / `.gallery-lightbox`** — Images-panel admin gallery (separate from public `.gallery`).
- **`.video-embed`** — responsive 16:9 iframe wrapper. Variant: `--placeholder`.
- **`.video-split`** — video + text split.
- **`.text-photo`** (**v1.7.22**) - one photo inside a column of text, between paragraphs: `img.text-photo` as a child of the text column. As wide as the column, its own shape, rounded like the other photos; a very tall photo is cut to 600px, keeping its upper part. A wide photo as a band of its own is `.photo-band`.
- **`.text-photo--natural`** (**v1.7.25**) - on an `img.text-photo`: shown at its own width, centred, never stretched past it. For a photo narrower than its column (a real room photographed at 600px in a 752px reading column).
- **`.photo-band`** (**v1.7.19**) - one wide photo as its own band, optional caption. `section.section.photo-band > .container > figure.photo-band__figure > img.photo-band__img` + optional `figcaption.photo-band__caption`. 21:9 on desktop, 4:3 on phones, rounded like the other photos. `--full` runs it edge to edge with no rounding (drops the band's top and bottom padding). For a single photo between text sections; three or more photos are a `.gallery`.

## Shop (v1.6 — Shop upgrade feature)

Markup for these is GENERATED by the editor (`api/controllers/ShopHtmlBuilder.php`, pinned by `ShopHtmlBuilderTest`) and the cart UI is DOM-injected by `js/shop.js` — don't hand-author shop pages. `js/shop.js` is a framework file but is only referenced (with `data-site-id` + `data-api-base` attrs) on shop pages of shop-enabled sites; it ships inertly to everyone else on template update. Note: `EditOperationParser::COMPONENT_GUIDE` deliberately does NOT include these — shop pages are panel-managed, not chat-edited.

- **`.product-card`** — listing card; the whole card is an `<a>` to `shop/{slug}.html`. Children: `__image-wrap` (1:1) > `__image` (or `__image-placeholder`), reuses `.card__badge` (+`--accent`) for Sale / Sold out, `__body` > `__category` + `__title` + `.product-price`. Carries `data-category` for the filter. Use inside `.grid--3`.
- **`.product-price`** — `__amount` (heading font, bold) + optional `__compare` (`<s>` strikethrough). `--sale` tints the amount accent. Bigger sizing auto-applies inside `.product-layout__info`.
- **`.product-layout`** — detail-page 2-col grid (`__gallery` 1.05fr / `__info` 1fr), stacks <860px.
- **`.product-description`** — the prose block under the buy row in `.product-layout__info` (light text, relaxed line-height). ShopHtmlBuilder wraps the product's own description in it, so it only ever appears on a generated `shop/{slug}.html`.
- **`.gallery--product`** — modifier on the existing `.gallery`: 2-up at all breakpoints, first image spans full width. Pairs with the standard `.lightbox` markup (main.js wires zoom).
- **`.product-options`** + **`.product-option`** (`__label` + reused `.form__select` with `data-option-group` / `data-price-delta` per `<option>`) — option dropdowns shop.js reads on add-to-basket.
- **`.qty-stepper`** — `__btn` (`data-qty="-1"/"+1"`) + `__input` (spinners hidden). Used on product pages and inside the cart drawer.
- **`.product-buy`** — qty stepper + `.product-add` button row. Sold-out products render `.product-soldout` (badge-style) instead. **`.product-add` carries no CSS rule and is not supposed to** — ShopHtmlBuilder emits it as `class="btn btn--primary product-add"`, so the look comes entirely from `.btn--primary` and the class exists only as the hook shop.js binds add-to-basket to (`buyBox.querySelector('.product-add')`). Don't "fix" the missing rule.
- **`.shop-filters`** + **`.shop-filter`** (`--active`) — category filter pills on shop.html (visual cousin of the blog filter, separate classes so blog CSS changes can't break shop).
- **`.nav__basket`** (+`-count`, `--floating` fallback) — basket icon button injected by shop.js into the site nav just before `.nav__toggle` (works in default and two-tier navs; top-right desktop, beside the hamburger on mobile). Icon always visible on shop-enabled sites; count pill hides at 0. v1.6.1 — replaces the v1.6.0 floating cart-fab button, **which no longer exists anywhere**: no rule in components.css, no reference in js/shop.js, and no client site's HTML ever carried it (it was DOM-injected only), so there is nothing to migrate and nothing to look for. Name left unlinked deliberately — it is history, not a selector. Since v1.6.1 the shop scaffold loads shop.js on EVERY page, so the basket follows visitors site-wide.
- **`.cart-drawer`** (+`__overlay`, `--open`, `__header`/`__title`/`__close`, `__items`, `__item` + `__item-name`/`__item-options`/`__item-price`/`__item-controls`/`__item-remove`, `__footer` + `__subtotal`/`__note`/`__error`/`__checkout`, `__empty`) — slide-in basket panel, injected by shop.js.
- **`.shop-result`** — centred content block for `shop/success.html` / `shop/cancelled.html` (success page carries `[data-shop-clear-cart]` which shop.js uses to empty the basket).
- **`.shop-empty`** — friendly empty-catalogue state on shop.html.

## Booking (v1.7 — Booking upgrade feature)

Markup for these is GENERATED by the editor (`api/controllers/BookingHtmlBuilder.php`, pinned by `BookingHtmlBuilderTest`) and the widget UI is DOM-injected by `js/booking.js` into `[data-booking-widget]` — don't hand-author booking pages. `js/booking.js` is a framework file but is only referenced (with `data-site-id` + `data-api-base` attrs) on `booking.html` + the `booking/*` pages of booking-enabled sites (NOT site-wide, unlike shop.js — there is no cross-page state); it ships inertly to everyone else on template update. Like shop, `EditOperationParser::COMPONENT_GUIDE` deliberately does NOT include these — booking pages are panel-managed, not chat-edited.

- **`.booking-widget`** — 720px-centred wrapper injected into `[data-booking-widget]`. Contains `.booking-steps` (Service/Day/Time/Details indicator: `__item` + `--active`/`--done`), a visually-hidden `.booking-live` aria-live region, and the `.booking-stage`. **`.booking-stage` carries no CSS rule and is not supposed to** — it is a bare mount div whose `innerHTML` booking.js swaps for each step (`mount.querySelector('.booking-stage')`), so every visual property belongs to whatever the step renders inside it. Don't "fix" the missing rule.
- **`.booking-service-card`** — step-1 service chooser; whole card is a `<button>`. Children: `__name`, optional `__desc`, `__meta` (duration `.booking-pill` + `__price`). Single column mobile, 2-up ≥768px.
- **`.booking-pill`** — small accent pill for durations (locks to `--aesthetic-radius-pill`).
- **`.booking-cal`** — step-2 month calendar card: `__head` (`__nav` 44px prev/next buttons + `__month`), `__grid` (`role="grid"`, Mon-first) of `__dow` headers and `__day` cells (`--available` tappable with `__dot`, `--muted` disabled, `--blank` leading gap). Colour is never the sole availability indicator (dot + disabled state).
- **`.booking-slots`** + **`.booking-slot`** — step-3 time pills (44px+ tap targets, auto-fill grid).
- **`.booking-summary`** (+`__price`) — selection recap box on the details step, the confirmed state, and the cancel/success pages.
- **`.booking-form`** — step-4 details form; reuses the framework `.form__group/__label/__input/__textarea` family + `.booking-submit` (full-width `.btn--primary`). `.booking-hp` is the off-screen honeypot; `.booking-policy-note` shows the cancellation policy inline. v1.7.2: booking.js also renders the practitioner's custom questions here (`custom_fields` from the public services config — text/textarea reuse the `.form__*` family; tick boxes use **`.booking-checkbox`**, a flex label that is the whole tap target with a 20px accent-coloured box — built for required "I agree to the terms"-style consents).
- **`.booking-loading`** (+`__spinner`), **`.booking-alert`** (+`--error`), **`.booking-empty`**, **`.booking-empty-month`**, **`.booking-confirmed`** — widget states. Spinner honours `prefers-reduced-motion`.
- **`.booking-result`** — centred content block for `booking/success.html` (`[data-booking-success]` summary mount), `booking/cancelled.html`, and `booking/cancel.html` (`[data-booking-cancel]` mount, driven by `?token=`).
- **`.booking-policy`** / **`.booking-noscript`** — static cancellation-policy section and the no-JS service-list fallback on booking.html.
- **Booking flow parts** — the widget's own furniture, all emitted by js/booking.js and none of them ever hand-authored. They are listed so the index accounts for every rule in the booking block, **not** so a page can pick one: outside `[data-booking-widget]` (or `booking/cancel.html`) they have nothing to sit in. Treat them as sub-elements of `.booking-widget`, the way `__item` belongs to its block.
  - **`.booking-heading`** (+ **`__hint`**) — the `<h2>` at the top of every step ("Choose a service", "Pick a day", "Your details", "You're booked!"). `--text-2xl`. `__hint` is the small light sub-line inside it carrying the context for that step (chosen service name, the long-form date, the appointment being changed).
  - **`.booking-back`** — the left-arrow "Back" control above a step. A borderless accent-coloured text button (`--text-sm`, semibold) that underlines on hover, carrying `data-back` with the step to return to.
  - **`.booking-services`** — the step-1 grid the `.booking-service-card`s sit in. Single column, 2 up at ≥768px. Pure layout, no surface of its own.
  - **`.booking-manage-actions`** — on `booking/cancel.html`, the wrapping flex row holding the two `.btn`s (Change the time / Cancel this appointment, and the Yes / Keep my appointment pair on the confirm step).
  - **`.booking-cancel-link`** — modifier on the destructive `.btn--secondary` inside that row. Nothing but `opacity: 0.85`, to sit the cancel action behind the primary rather than beside it as an equal.
  - **`.booking-resched-day`** — one day's group in the reschedule list: a small light semibold `<h3>` date label above that day's `.booking-slots` grid.

## Content blocks

- **`.highlight-box`** — emphasis block. **Must contain `__heading` + `__content` children.** Never bare h3/p directly. Heading colours auto-invert.
- **`.blockquote`** - pull-quote. Variant: `--pull` (large pull-quote).
  - **v1.7.20 `.blockquote--bold`** - with `--pull`: the quote upright and bold (`--text-lg` on phones, `--text-2xl` from 768px) instead of italic. Use when the heading font has no italic (Baloo 2, most rounded display fonts), or the browser fakes a slanted one. Full width on phones. Its mark is a short rule (`--blockquote-rule-color`, default the text colour) instead of the quote glyph.
- **`.checklist`** + **`.checklist-grid`** — bulleted check lists. Inline SVG ticks supported (svg constrained to 20px). Use it for any list the source copy has buried inside a sentence as a comma run ("the signs are x, y and z") — lead in with the sentence up to a colon, then the items. **v1.7.7** — `:not(.checklist-grid) > .checklist:not(:last-child)` carries `margin-bottom: var(--space-md)` so a list followed by more content clears it. Both exclusions matter: a checklist that ends its container keeps `margin: 0`, and one inside `.checklist-grid` is spaced by the grid's own `gap` (the unscoped version double-spaced and grew the grid by 16px).
  - **v1.7.22 `.checklist--numbered`** - the same list with 1, 2, 3 in the circle where the tick sits: `ol.checklist.checklist--numbered > li.checklist__item`. Never type the numbers. For steps that each have a title and a description, use `.approach-grid` or `.process-spine`.
- **`.quals-list`** - qualifications list with icons. **v1.7.25:** exactly three boxes sit three across from 1024px (widened past a narrow container up to 1040px); the third takes the full row on tablets. Not inside a split column. The header logo (`.nav__logo`) is capped at 56px (`--nav-logo-height`) in the same release. **v1.7.26:** header height is `--nav-height` (default 72px); set 88px in theme.css to give a 56px logo 16px of white space above and below.
- **`.alert`** — notice block. Variants: `--info`, `--success`, `--warning`, `--error`, `--themed`.
- **`.badge`** — small inline badge. Variants: `--primary`, `--secondary`, `--accent`, `--outline`, `--subtle`, `--success`, `--warning`, `--error`. `.badge-group` for grouped badges.
- **Inline content links** (**v1.7.4**) — a plain `<a>` (no class) inside `<main>` prose (`main p a`, or a classless `main li a`) automatically gets the brand colour + underline + 3px offset, hover to `--color-primary-dark`. This exists because base.css resets `a { color: inherit; text-decoration: none }` (so nav/buttons/cards don't go blue+underlined); the rule restores the link affordance for body copy only. **Classed links are untouched** — `.btn`, `.nav__link`, card links, `.breadcrumbs__item a`, `.skip-link`, etc. keep their own styling, and the footer is outside `<main>`. The explicit `.link` class is still available for links you want styled in non-`<main>` contexts. Blog post bodies (`.blog-post__body a`) and legal pages (`.privacy-content a`) have their own equivalent rules.

## Global base rules (base.css, not components)

Not components, but listed here so nobody re-solves them with a one-off in a client site.

- **Headings wrap long tokens** (**v1.7.8**) — the shared `h1, h2, h3, h4, h5, h6` rule carries `overflow-wrap: break-word`. A heading containing a domain, an email address or any long hyphen-free string used to run past its container and give the whole page horizontal scroll on mobile (hit on touch-physique: 394px inside a 375px viewport). You do **not** need a per-site wrap rule, and you should not shorten a heading just to dodge this. `break-word`, not `anywhere`, so ordinary headings are unaffected and min-content sizing is untouched. Regression witness lives in `theme-preview.html` under Typography — a deliberately narrow 190px box; don't widen it.

## Utility / specialised

- **`.btn--whatsapp`** — WhatsApp green button.
- **`.location`** — location info pattern.
- **`.privacy-content`** — long-form policy/legal content styling.
- **`.legal-content`** — heading/paragraph rhythm wrapper for legal pages (cookies/privacy body copy).
- **`.error-page`** — 404 page styling.
- **`.reveal`** + **`--visible`** — scroll-reveal wrapper (paired with main.js intersection observer). Fades + lifts the element on scroll into view and staggers a cascade across its child grid/list items (`.grid--*`, `.steps`, `.pricing-grid`, `.team-grid`, `.testimonial-grid`, `.quals-list`, `.checklist-grid`, `.fee-table`). **v1.5.5 — directional split reveal:** when a `.reveal` section contains a `.split`, the text column slides in from the left and the image from the right (reversed splits flip the directions); gated to ≥768px, so the stacked mobile split just fades up and never creates a horizontal scrollbar. Honours `prefers-reduced-motion`. **v1.5.5** — the observer is now fully IntersectionObserver-driven; the old synchronous on-load `getBoundingClientRect()` pre-reveal loop was removed because it measured below-the-fold sections as in-viewport before images reserved their height and revealed the whole page at once on load. A guarded post-load safety net reveals only genuinely above-the-fold content. **`.reveal-trigger`** — add alongside `.reveal` (`class="reveal reveal-trigger"`) on a wrapper around a grid/list to fire the children cascade on the *wrapper's* entry without animating the wrapper itself. Use when the list sits far below its section heading (otherwise the section-level `.reveal` fires the cascade while the items are still off-screen).
- **`.hide-mobile`** / **`.hide-tablet`** / **`.hide-desktop`** (**v1.7.25**) - hide an element below 768px, from 768 to 1024px, or from 1025px: Elementor's own Hide On switches at its own breakpoints, so a converted site keeps content shown on one screen size only. Combine them (`hide-tablet hide-desktop` = phones only). Sparingly: duplicated content must be edited twice.
- **`.grid--4` / `.grid--5` / `.grid--bento`** — generic grid column counts.
- **`.section-subtitle`** - the intro line under a section heading (styled in base.css). Inside a `.band` it takes the band's text colour.
- **`.section-label`** — small uppercase text label above a heading. **v1.4 `.section-label--pill`** turns it into a dark-navy pill (matches hero label aesthetic). Color variants: `--pill-primary`, `--pill-accent`.
- **`.pill--glow`** — **v1.4** — animated box-shadow ring on any pill / badge / `.section-label`. Drives the "campaign" / "limited spaces" feel. Color variants: `--glow-accent` (orange), `--glow-primary` (blue). Override with `--pill-glow-rgb: R,G,B` for any other tint. Honours `prefers-reduced-motion`.

## Signature components (added 2026-10-07)

Seven patterns the originals we are asked to match use and the library lacked. All token-driven, additive, no script. Demo blocks: `theme-preview.html` > "Signature components". Use each only with facts the client has supplied (Content Integrity): real press outlets, a real rating, real testimonial videos.

- **`.day-schedule`** + `__item`, `__time`, `__card`, `__title`, `__text` - hour-by-hour cards on a vertical rail ("a day at the retreat", "class timetable"). Markup is an `<ol>` of `<li class="day-schedule__item">`. `--grid` turns it into a 2/3-column card grid with the time as a chip. Use instead of a bullet list of times.
- **`.stats--warm`** (on `.stats`, with the normal `.stat` / `__number` / `__label` / `__sub` children) - quiet tinted strip, big accent numbers, hairline dividers, small caps labels. Counter animation (`data-target`) works unchanged. Use instead of `.stat--card` when the look is warm or editorial.
- **`.video-carousel`** + `__item`, `__media`, `__quote`, `__name`, `__role`, `__play` - swipeable row of portrait video testimonials. Native scroll-snap and native `<video controls preload="none" poster>`, no JS. For a poster that links out, put an `<a>` + `<img>` + `<span class="video-carousel__play">` inside `__media`. Give the region `role="region" aria-label`.
- **`.press-bar`** + `__label`, `__list`, `__item`, `__outlet`, `__quote` - "As featured in" strip with an optional one-line quote per outlet; sits directly under the hero. `__outlet` is text or a logo `<img>` (greyscaled). Only outlets the client has actually been featured in.
- **`.arch-media`** + `__img`, `__badge`, `__badge-value`, `__badge-label` - photo cropped to an arch with a floating proof badge (rating, years, clients). Put it in a two-column band beside text. `--right` moves the badge to the right edge. Badge text must be a client-supplied fact.
- **`.service-list`** + `__item`, `__link`, `__body`, `__title`, `__text`, `__arrow`; `--numbered` - hairline-divided rows with a CSS-generated 01, 02, 03 number, title, one line and an arrow. Use instead of a grid of identical icon cards when the offer is a list. Never type the numbers.
- **`.blog-grid--editorial`** + **`.blog-card--editorial`** (+ **`.blog-card--feature`** on the first card for a wide lead story) with new slots **`.blog-card__meta`** (flex row) and **`.blog-card__read-time`** - magazine-style cards: no card chrome, category and read time above a larger headline. Opt-in; the plain `.blog-card` is unchanged. The portal's blog listing generator does not emit these classes; hand-placed on build-time pages only.

## v1.7.20: Token hooks (theme.css only)

Each falls back to the old value, so a site changes only when its `theme.css` `:root` sets one:

- **`--btn-radius`** - the corner of every `.btn` (default `--aesthetic-radius`). Set `999px` for pill buttons that match a pill-shaped header button.
- **`--btn-accent-text`** / **`--btn-accent-hover-text`** - the ink on `.btn--accent` (default the inverse text colour). Set a dark ink when the secondary colour is light (an orange or lime accent fails 4.5:1 with white).
- **`--nav-name-color`**, **`--nav-title-size`**, **`--nav-title-transform`**, **`--nav-title-tracking`** - the brand name colour and the tagline under it (default heading colour; 16px uppercase, 0.08em tracking, capped at 0.03em on phones; **v1.7.24**). A long tagline in sentence case with no tracking stays on one line. Since **v1.7.24** no framework text is under 16px: `--text-xs` is 16px (was 13px), pinned by `api/tests/MinimumTextSizeTest.php`; never set a smaller size in a site's `theme.css`.
- **`--font-signature`**, **`--signature-style`**, **`--signature-size`** - the `.signature` line in a split (default the heading font, italic, `--text-xl`). For a handwritten signature import a script font (e.g. Caveat) in `theme.css` and set `--signature-style: normal`.
- **`--hero-actions-justify`** - the hero buttons' alignment on phones (default centred). Set `flex-start` when the hero text is left-aligned.
- **`--nav-two-tier-padding`** / **`--nav-top-padding`** - the two-tier header's outer padding and the space above its brand row (default 20px each, which leaves about 48px empty above the logo). **`--nav-name-size`** - the brand name (default `--text-lg`).
- **`--form-check-size`** / **`--form-check-accent`** - the consent tick box size and tick colour (default the browser's own, about 13px). Set 20px or more for an easy tap target.
- **`--page-header-padding`** / **`--page-header-padding-desktop`** - the top and bottom padding of `.page-header` (default 96px on phones, `--space-3xl` from 768px). Tighten the phone value when the title band pushes the first content (a contact form) too far down.
- **`--nav-bar-bg`** / **`--nav-bar-text`** (**v1.7.25**) - the menu row of a `.nav--two-tier` in its own colour, with the brand row above left as it is (a white name bar over a sage menu bar, woodlandscounselling.co.uk). Desktop only (1100px+); dropdown panels keep their colours. Keep `--nav-bar-text` at 4.5:1 on the bar.
- **`--hero-slope-panel`** (**v1.7.25**) - the angled panel of `.hero--slope-light` (default a 12% tint of the primary). Set `var(--color-bg-alt)` when the primary is a deep red that tints it pink.
- **`--trust-bar-logo-height`** (**v1.7.25**) - logo height in `.trust-bar` (default 52px, 60px from 768px). Raise it when a membership logo carries small print.
- **`--heading-weight`**, **`--hero-heading-color`**, **`--footer-brand-color`**, **`--nav-title-color`**, **`--nav-title-font`**, **`--intro-align`** (**v1.7.25**) - heading weight (h1 to h6 and the brand name; 400 for a regular-weight serif), the light hero h1 colour, the `.footer--simple` brand name colour, the tagline colour and font, and the vertical alignment of `.intro__inner` (start puts a portrait level with the heading). Added so a converted site keeps its own look in tokens, not in new components.
- **`--nav-call-phone-display`** (**v1.7.25**) - set `flex` to show tap-to-call (the `.nav__contact-item` holding a `tel:` link) on its own line under the brand below 900px, where the two-tier contact row is otherwise hidden.
- **`--nav-title-phone-display`** - set `none` to drop the tagline under the brand name below 480px, where a logo, a name and a two-line tagline outgrow the 72px bar (default shown).

## v1.7.26: the looks Elementor sites are built from

Added when Rick rejected the first rebuild of woodlandscounselling.co.uk beside her original (30-10-2026): the library had drawn its own nearest version of her header, hero, sidebar, tabs and footer. Each is a structure many Elementor sites share; every size and colour is a token, so the next site sets numbers in `theme.css` and adds no CSS. **Measure the original first with `scripts/style_parity.py`** and set the tokens from its numbers.

- **`.nav--brand-place`** (with `.nav--two-tier`) - the brand stack: name, tagline and the place on three lines at the left, phone and email top right, a round social icon under them; phones get one centred column and a centred menu button in the coloured bar. The FIRST `.nav__contact-item` is the place (icon hidden), the LAST holds the social link. The bar colour runs the full header width. Tokens: `--nav-top-padding`, `--nav-top-padding-bottom`, `--nav-place-gap`, `--nav-contact-size`, `--nav-social-bg`, `--nav-social-size`, `--nav-toggle-bg`, `--nav-toggle-bar`, and for the bar `--nav-link-size`, `--nav-link-weight`, `--nav-link-padding`, `--nav-link-gap`, `--nav-bar-padding`, `--nav-active-line` (0% hides the line under the current page). `nav_style` in build-spec: `two-tier brand-place`.
- **`.hero--slope-cut`** (with `.hero--slope-light`) - Elementor's two-column hero with a slanted panel: photo left with one rounded corner and no shadow, the panel cut on a slant behind it, text in the panel; phones get the photo edge to edge, then the panel. Tokens: `--hero-cut-image-width`, `--hero-cut-image-height`, `--hero-cut-image-radius`, `--hero-cut-top` / `--hero-cut-bottom` (where the slant meets each edge), `--hero-cut-content-padding`, `--hero-cut-padding`, `--hero-cut-heading-size`, `--hero-cut-heading-gap`, `--hero-lead-size`, `--hero-cut-image-height-mobile`.
- **`.sidebar-layout`** + `__main` + `__aside` - the page's text in a wide column with a narrow column beside it (69% / 24% by default: `--sidebar-main`, `--sidebar-aside`); the aside follows the text below 1025px. Main column tokens: `--prose-h2-size`, `--prose-h2-weight`, `--prose-h3-size`, `--prose-h3-gap`, `--prose-h3-after`, `--prose-p-gap`. A `.signature` line works inside `__main`.
- **`.profile-card`** + `__image`, `__name`, `__meta` - a portrait, the name, a line of credentials in capitals and a button, centred, no frame (the about-me card beside a therapist's text). Tokens: `--profile-name-size`, `--profile-meta-size`, `--profile-meta-weight`.
- **`.tabs`** + `__list`, `__tab`, `__panel` - tabbed text: titles as a column of pills beside the panel from 768px, each panel under its own title on phones. main.js switches them (arrow keys too); without JavaScript every panel shows. Markup carries `role="tablist"`, `role="tab"` with `aria-selected` and `aria-controls`, `role="tabpanel"`. Tokens: `--tabs-list-width`, `--tabs-radius`, `--tabs-panel-bg`, `--tabs-active-bg`. Use for an Elementor tabs widget; an accordion stays `.accordion`.
- **`.section--muted`** - a band in the light grey surface colour (`--color-surface-alt`), a third background beside plain and `--alt`; the alternation safety net and `validate_site.py` treat it as its own background.
- **`.section.cta-mid-banner`** now takes `--cta-band-bg` (a flat colour instead of the gradient) and `--cta-band-padding`; **`.cta-mid-banner--center-mobile`** centres it on phones; **`.btn--outline-light`** is the outlined white button of many CTA strips.
- **`.footer--card`** (with `.footer--simple`) - the footer's contents in a white card on the band colour, everything centred: name, phone and email on their own lines (`.footer__link` with an icon), a round social icon **`.footer__social`**, the legal links in the primary colour, the copyright. Tokens: `--footer-card-bg`, `--footer-card-padding`, `--footer-name-size`.
- **`.card--icon-bare`** (with `.card--feature`) - the card icon on its own, no circle, at `--card-icon-size`.
- **`.contact-columns`** (with `.container.grid.grid--2`) - a contact page in the old site's own two columns (details, form, opening times, map in her order); a `.map-placeholder` inside fills its column. **`.contact-form-card--muted`** - the form on the light grey surface, no frame. Tokens: `--contact-columns-gap`, `--contact-map-height`, `--contact-form-radius`.
- **`.accordion--boxed`** - Elementor's nested accordion: each title in a thin box, plus at the left, the open panel on the light grey surface (`--accordion-border`, `--accordion-title-size`, `--accordion-panel-padding`).
- **`.checklist--solid`** - a details list with filled icons (phone, clock, pin) in the primary colour, not ticks; **`.checklist--heading`** sets its words in the heading font (`--checklist-heading-size`).
- **`.container--content`** with `style="--content-width: 960px"` - a section's own column width carried from the old site (Elementor's `--content-width`).
- Plain `ul`/`ol` (no class) inside `.sidebar-layout__main` or `.accordion__content` show bullets and numbers, indented (`--prose-list-indent`, `--prose-list-gap`).
- **`.as-h1`** as the other `.as-hN`. Token hooks: `--page-header-title-width`, `--content-link-decoration` / `--content-link-color`, `--footer-legal-size`, `--footer-card-padding-mobile`, `--cta-band-heading-gap`, `--h2-gap`, `--form-input-padding`, `--form-input-radius`, `--form-input-size`, `--form-textarea-height`, `--form-label-weight`, `--form-label-color`, `--form-label-gap`, `--form-input-line-height`, `--form-gap`, `--form-top`, `--contact-form-padding`, `--prose-li-gap`, `--prose-li-line-height`, `--trust-bar-padding`, `--profile-card-padding-bottom` (only a card ending in a button), `--accordion-icon-color`, `--prose-h2-gap`, `--prose-h2-line-height`, `--prose-list-heading-gap`; main.js reads **`--reveal-root-margin`** / **`--reveal-threshold`** (default `0px 0px -10% 0px` / 0.08) so a site can show a section the moment it enters the screen.
- **`.text-note`** - a paragraph in small print (`--text-note-size`), for a notice the old site set smaller than its body.
- **`.as-h2`** / **`.as-h3`** / **`.as-h4`** - a heading drawn at another level's size, so a page keeps a valid heading order while each heading looks as the old site drew it (the converter writes `h2.as-h3` when an old page went straight from its title to h3s).
- Token hooks: **`--page-frame-fluid`** (the page box as a share of the window, Elementor's 90%) and **`--page-frame-shadow`**; **`--container-gutter`**; **`--section-padding`** / **`--section-padding-desktop`**; **`--h1-weight`**, **`--h2-weight`**, **`--h3-weight`**, **`--heading-tracking`**, **`--nav-name-weight`**, **`--nav-name-tracking`**, **`--strong-weight`**; **`--btn-font-size`**, **`--btn-weight`**, **`--btn-transform`**, **`--btn-tracking`**, **`--btn-padding`**; **`--page-header-rule-width`** / **`-height`** / **`-gap`**; **`--checklist-icon-size`**; **`--card-text-size`**; **`--nav-brand-gap`**; **`--form-label-size`**.

## v1.5 — Aesthetic dials

Per-site aesthetic variation via three CSS custom-property dials. Defaults preserve the v1.4 "soft modern" look — existing sites are unchanged unless their `theme.css` opts in.

- **`--aesthetic-radius`** — corner rounding for cards, buttons, form inputs (default `14px`).
- **`--aesthetic-shadow-card`** — elevation style on cards (default layered soft shadow).
- **`--aesthetic-border-width`** — border thickness on cards / inputs / pills (default `1px`).
- **`--aesthetic-radius-pill`** — fixed at `999px`. Pills (`.rated-pill`, `.badge`, `.card__badge`, `.announcement-bar__pill`, `.logo-ticker__pill`) ALWAYS read this — the dial never squares them. Brutalist sites still have pill-shaped pills.

Components currently honouring the dials: `.card` (and all `--service / --feature / --highlight / --image-top` variants), `.btn` (all variants), `.form__input / __textarea / __select`, plus the pill exceptions above.

**Five preset aesthetics** ship as JSON in `themes/aesthetics/`:
- `soft.json` — default (current look)
- `sharp.json` — zero-radius, hard offset shadows. Architectural / B2B feel.
- `brutalist.json` — zero-radius, no shadows, 3px borders. Editorial / contemporary.
- `luxe.json` — 20px radius, deep soft shadows. Hospitality / wellness / boutique.
- `editorial.json` — 6px radius, near-flat shadow. Magazine / longform feel.

Test live at `theme-preview.html` via the new "Aesthetic" dropdown in the top control bar. To apply per site, drop in `theme.css`:

```css
:root {
  --aesthetic-radius: 0;
  --aesthetic-shadow-card: 0 2px 0 rgba(0,0,0,0.10);
  --aesthetic-border-width: 1px;
}
```

Or load a preset JSON via JS at runtime. **Hardcoded values are out of scope for this round** on: gallery items, lightbox, pricing cards, testimonials, faq, alerts, hero floats, cta-banner, contact-form-card, highlight-box. Extend later if demand emerges.

## v1.4 framework upgrade summary

This release adds JS-driven enhancements that auto-activate when authors use the right markup, plus a handful of CSS modifiers. **No HTML changes are required for existing sites — everything is opt-in via class names or `data-*` attributes.**

- **Lightbox**: prev/next buttons + arrow-key nav + entrance animation
- **Stats**: count-up on scroll via `data-target` / `data-suffix`
- **Hero heading**: word-by-word blur-fade via `.hero__heading--animate`
- **Hero floats**: cantilever past image edges via `.hero__image-clip` + `.hero--floats-cantilever`
- **Hero column ratio**: `.hero--half--text-wide` / `--image-wide`, plus `.hero--half--image-right` flip
- **Section label**: `.section-label--pill` modifier + colour variants
- **Logo ticker**: `--no-fade` and `--no-pause` opt-out modifiers
- **Process step**: `--num-centered` modifier (number above title, transparent bg)
- **`.cta-banner--split`**: mobile overflow guard (`min-width: 0` on grid + children)
- **`.pill--glow`** utility: animated glow ring for any pill

---

## Rules when adding a new component

1. **GREP FIRST.** Run `grep -E "^\.<name>" master-site-template/css/components.css` before writing CSS for a name. Don't duplicate existing class names.
2. **Tokens only.** No hardcoded colours, spacing, or font-families. Theme switchers must work without per-component overrides.
3. **BEM naming.** `block__element--modifier`. Match the existing patterns.
4. **Sync chain (every CSS edit):** master-site-template/css/components.css → api/template-files/components.css → bump version + framework hash in api/template-version.php → SCP both + template-version.php to server → add demo block to theme-preview.html → **add entry to this COMPONENTS.md** → if the component is something a client might ask the chat editor to add (cards, testimonials, FAQs, CTAs, lists, pricing), update `EditOperationParser::COMPONENT_GUIDE` in api/controllers/EditOperationParser.php too.
5. **No new components in a single client's theme.css** — they belong in the shared library or nowhere.
