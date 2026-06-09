# Component Library Index

Source of truth: `master-site-template/css/components.css`. Demos at `theme-preview.html`.

**Use this doc to pick a component before designing a section. Don't improvise — if nothing here fits, flag it before building.**

> **For client briefs and live theming** — open `master-site-template/theme-preview.html`. It's the single demo page: palette generator + theme switcher at the top, live-updating component preview, then a sticky-tab catalogue of every component organised by category. (The old `showcase.html` redirects here — kept for old bookmarks.)

Every component is token-driven (uses `var(--color-*)`, `var(--space-*)`, `var(--radius-*)`, `var(--font-*)`). Modifiers follow BEM (`__child`, `--variant`).

---

## Site chrome

- **`.nav`** — top navigation. Variants: `--two-tier` (brand bar + nav bar with contact info), `--branded`, `--transparent`, `--transparent-dark`, `--transparent-light`. Hierarchical config via DB `nav_config_json`.
- **`.nav-scroll`** — sticky condensed nav that slides in on scroll. Use `--visible` to toggle.
- **`.announcement-bar`** — slim full-width promo strip above nav. Variants: `--secondary`, `--subtle`, `--accent`. Supports rich layout: `__inner` + `__msg` + `__pill` + `__link` for promo + CTA. Or use plain centred text + `<a>`.
- **`.skip-link`** — accessibility skip-to-content.
- **`.breadcrumbs`** — page trail. `__item`, `__separator`, `__item--active`.
- **`.page-header`** — title block at top of inner pages. Variants: `--dark`, `--image`. Use `.page-header__meta` utility for readable text on dark/image variants.
- **`.footer`** — site footer (multi-column). Variant: `--simple` for a single-line variant.
- **`.back-to-top`** — floating back-to-top button.
- **`.cookie-banner`** — GDPR cookie consent.
- **`.site-credit`** — small "built by" credit row.

## Hero

Pick exactly one per page. Mobile responsive built in.

- **`.hero`** + **`.hero--fullwidth`** — full-bleed background image hero.
- **`.hero--half`** — 50/50 split (image left, text right by default). **Image clamped 85vh desktop / 55vh mobile** by default (set `max-height: none` on `.hero__inner / __image-wrap / __image / __content` in your theme.css to opt out — only when needed).
  - **v1.4 ratio modifiers**: `.hero--half--text-wide` (1.45fr / 1fr), `.hero--half--image-wide` (1fr / 1.45fr).
  - **v1.4 image-right**: `.hero--half--image-right` flips the image to the right (text-left layout).
- **`.hero--image`** — full-bg image with centred text overlay (no frost card).
- **`.hero--image-left` / `.hero--image-right`** — image-side modifiers (apply to `.hero--image`).
- **`.hero--showcase`** — frost (glassmorphism) card variants over an image.
- **`.hero--banner`** — short banner-height hero.
- **`.hero--minimal`** — text-only, no image.
- **`.hero--slope-light`** — angled panel cut.
- **`.hero__floats`** — wrapper inside `.hero__image-wrap` for absolute-positioned glass stat cards (`.hero__float` + `--tl/--tr/--bl/--br/--ml/--mr`). Hidden under 768px. Use for credibility numbers (years, clients, ROI).
  - **v1.4 cantilever pattern**: wrap the `<img>` in `.hero__image-clip` and add `.hero--floats-cantilever` to `.hero__image-wrap`. Then use `.hero__float--out-r / --out-l / --out-t / --out-b` on individual floats to make them hang past the image edges.
- **`.hero__heading`** — primary H1 inside the hero. **v1.4 `.hero__heading--animate`** triggers a word-by-word blur-fade entrance (auto-wired by main.js, honours `prefers-reduced-motion`).
- **`.hero__stats`** — inline stat row inside hero content.

## Cards

- **`.card`** — generic surface card (icon-led by default). Modifiers: `--service`, `--feature`, `--highlight`, `--image-top` (photo at top, with optional `.card__badge` corner pill — `__badge--accent` for secondary tint, add `.card--portrait` for 1:1 team headshots).
- **`.icon-box`** — icon + heading + text block. Variants: `--card`, `--left`.
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

- **`.split`** — 2-column split. Variants: `--bleed` (image fills full edge — drop the container wrapper, no extra CSS needed).
- **`.split__image`** + `--portrait` / `--landscape` / `--square`.
- **`.story-split`** — narrative two-column with lead text.
- **`.story-text`** — centred header + pull-quote left / body right.
- **`.text-block`** — generic text block. Variant: `--center`.
- **`.two-col-text`** — heading spans full width, body text splits into 2 columns via `__columns` (1-col mobile).
- **`.about-hero`** — about-page hero pattern (image + text).
- **`.about-split-third`** — 1fr image / 2fr text full-bleed split.
- **`.intro`** — homepage welcome split (image + text). Use `__inner--reversed` to swap sides.
- **`.info-band`** — horizontal feature strip with icons. Variants: `--light`, `--primary`.
- **`.divider`** — section divider rule.

## Process / steps

- **`.approach-grid`** + **`.approach-item`** — text-only numbered steps (no images). 1-col mobile, 2-col desktop. Use for "How I work" lists.
- **`.process-grid`** + **`.process-step`** — 3- or 4-step (`--4`) with **image per step**. Number badge top-left, photo, title, body. Use for "How it works" with visuals.
  - **v1.4 `.process-step--num-centered`** — moves the number from absolute top-left of the image into the body, centered above the title (transparent bg, white border, inherits `currentColor`). Cleaner stepper aesthetic on dark cards.
- **`.process-spine`** + **`.process-spine__step / __num / __body / __title / __text`** — vertical numbered process with a connector rail down the centre between number nodes. No images, single column. Use for editorial/B2B "methodology" sections where the steps deserve more drama than `.process-grid` (e.g. Hercules Power-First Development). Honours `.section--dark` / `.bg-dark` for inverted treatment.
- **`.steps` / `.step`** — generic step widget.

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
- **`.pricing-single`** — single-tier pricing block.
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
- **`.trust-bar`** — logo strip (single row, static).
- **`.logo-ticker`** + **`__viewport`** + **`__track`** + **`__item`** + **`__logo`** + **`__pill`** — infinite-scroll horizontal marquee. Pauses on hover. Falls back to scrollable list for `prefers-reduced-motion`. Use real `<img class="logo-ticker__logo">` OR `.logo-ticker__pill` text fallback.
  - **v1.4 modifiers**: `.logo-ticker--no-fade` drops the gradient edge mask (use when you want logos to bleed to the screen edge). `.logo-ticker--no-pause` keeps the animation running on hover.
- **`.rated-pill`** — inline award/rating badge ("Rated #1 by …"). `__icon` + `__highlight` for emphasised text. Variant: `--accent`.

## Team

- **`.team-grid`** — team grid layout.
- **`.team-list` / `.team-list-item` / `.team-member`** — list-style team patterns.
- For 3-up portrait cards, use **`.card--image-top.card--portrait`** (preferred — covers both services + team with one component).

## Forms

- **`.form`** — form wrapper. `__group`, `__label`, `__select`, `__textarea`, `__row`, `__hint`, `__consent`, `__group--checkbox`. Variant: `--full-width`.
- **`.contact-form-card`** — boxed form pattern.
- **`.contact-grid`** — form + contact info side-by-side.
- **`.contact-info__*`** — heading, intro, item, icon, label, text slots.
- **`.map-placeholder`** — map iframe slot.

## Blog

- **`.blog-grid`** + **`.blog-card`** — blog index listing. Slots: `__image`, `__date`, `__title`, `__excerpt`, `__link`.
- **`.blog-post`** + slots `__hero`, `__meta`, `__author`, `__share` — single post page.

## Gallery / media

- **`.gallery`** + **`.gallery__item`** — responsive image grid (1:1 default). Click-to-zoom via `.lightbox` (auto-wired by main.js — needs `<img>` children, not CSS bg). Aspect modifiers: `__item--landscape` (4:3), `__item--portrait` (3:4), `__item--wide` (16:9). Optional `__caption` overlay (fades in on hover). `--collapsible` + `--expanded` for mobile show-more pattern.
- **`.lightbox`** + **`__open`** + **`__img`** + **`__close`** — full-screen image viewer (markup must exist on page for gallery clicks to work; main.js wires it).
  - **v1.4** — adds optional `.lightbox__prev` and `.lightbox__next` buttons (auto-wired when present, plus `ArrowLeft`/`ArrowRight` keyboard nav). Subtle entrance animation (`opacity 0 + scale 0.94 → 1`) on `.lightbox--open .lightbox__img`. Both honour `prefers-reduced-motion`.
- **`.gallery-grid` / `.gallery-item` / `.gallery-empty` / `.gallery-lightbox`** — Images-panel admin gallery (separate from public `.gallery`).
- **`.video-embed`** — responsive 16:9 iframe wrapper. Variant: `--placeholder`.
- **`.video-split`** — video + text split.

## Content blocks

- **`.highlight-box`** — emphasis block. **Must contain `__heading` + `__content` children.** Never bare h3/p directly. Heading colours auto-invert.
- **`.blockquote`** — pull-quote. Variant: `--pull` (large pull-quote).
- **`.checklist`** + **`.checklist-grid`** — bulleted check lists. Inline SVG ticks supported (svg constrained to 20px).
- **`.quals-list`** — qualifications list with icons.
- **`.alert`** — notice block. Variants: `--info`, `--success`, `--warning`, `--error`, `--themed`.
- **`.badge`** — small inline badge. Variants: `--primary`, `--secondary`, `--accent`, `--outline`, `--subtle`, `--success`, `--warning`, `--error`. `.badge-group` for grouped badges.

## Utility / specialised

- **`.btn--whatsapp`** — WhatsApp green button.
- **`.location`** — location info pattern.
- **`.privacy-content`** — long-form policy/legal content styling.
- **`.legal-content`** — heading/paragraph rhythm wrapper for legal pages (cookies/privacy body copy).
- **`.error-page`** — 404 page styling.
- **`.reveal`** + **`--visible`** — scroll-reveal wrapper (paired with main.js intersection observer). Fades + lifts the element on scroll into view and staggers a cascade across its child grid/list items (`.grid--*`, `.steps`, `.pricing-grid`, `.team-grid`, `.testimonial-grid`, `.quals-list`, `.checklist-grid`, `.fee-table`). **v1.5.5 — directional split reveal:** when a `.reveal` section contains a `.split`, the text column slides in from the left and the image from the right (reversed splits flip the directions); gated to ≥768px, so the stacked mobile split just fades up and never creates a horizontal scrollbar. Honours `prefers-reduced-motion`. **v1.5.5** — the observer is now fully IntersectionObserver-driven; the old synchronous on-load `getBoundingClientRect()` pre-reveal loop was removed because it measured below-the-fold sections as in-viewport before images reserved their height and revealed the whole page at once on load. A guarded post-load safety net reveals only genuinely above-the-fold content. **`.reveal-trigger`** — add alongside `.reveal` (`class="reveal reveal-trigger"`) on a wrapper around a grid/list to fire the children cascade on the *wrapper's* entry without animating the wrapper itself. Use when the list sits far below its section heading (otherwise the section-level `.reveal` fires the cascade while the items are still off-screen).
- **`.grid--4` / `.grid--5` / `.grid--bento`** — generic grid column counts.
- **`.section-label`** — small uppercase text label above a heading. **v1.4 `.section-label--pill`** turns it into a dark-navy pill (matches hero label aesthetic). Color variants: `--pill-primary`, `--pill-accent`.
- **`.pill--glow`** — **v1.4** — animated box-shadow ring on any pill / badge / `.section-label`. Drives the "campaign" / "limited spaces" feel. Color variants: `--glow-accent` (orange), `--glow-primary` (blue). Override with `--pill-glow-rgb: R,G,B` for any other tint. Honours `prefers-reduced-motion`.

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
