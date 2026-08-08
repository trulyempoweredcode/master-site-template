# Demo Design Tokens

When a client picks one of the 9 design examples on the onboarding form (https://www.therapywebgenie.com/design-examples/), look up that style here and apply these tokens to their build.

The client's "any changes you want" answer takes precedence — treat these as the **default baseline**, then layer their requested deltas on top (e.g. "like style 4 but warmer colours" → use style 4 fonts/hero/nav, swap the palette).

## THE DEMO IS THE SPEC — read this before using the table

**This table is a token lookup, and a token lookup is NOT a design brief.** Palette and fonts are the
smallest part of a theme. The hero type, the section pattern, the header, the footer and the component
choices all come from the demo too. **Open `Ai-Editor-Sites/demo-{name}/{page}.html` and mirror it
section-for-section** — `grep -oE '<!-- SECTION: [^>]*-->'` gives you the page plan. Capture the demo's
pages as screenshots first and use them as the bar. On 2026-08-07 a build took only the palette and font
names from this table, never opened the demo, and shipped the wrong hero, the wrong header, the wrong
footer and photo cards where the demo has icon cards. See `feedback_build_the_demo_they_picked.md`.

**A pasted demo URL beats the style number.** The design-examples link on the questionnaire has been
broken, so clients pick a number at random and then paste the demo they actually want. Trust the URL.

## Palette + font pairing SLUGS (the actual library files)

| # | Palette slug | Font pairing slug |
|---|---|---|
| 1 | `soft-blush` | `playful` |
| 2 | `forest-and-cream` | `classic-humanist` |
| 3 | `trusty-blue` | `corporate` |
| 4 | `calm-sage` | `soft-geometric` |
| 5 | `bold-navy` | `clean-bold` |
| 6 | `warm-terracotta` | `corporate` |
| 7 | `clean-slate` | `editorial` |
| 8 | `warm-mocha` | `rounded-warm` |
| 9 | `deep-plum` | `modern-pro` |

Files live in `master-site-template/themes/palettes|fonts/` and `wordpress-master/palettes|font-pairings/`
(both platforms, same slug). `forest-and-cream` and `classic-humanist` were **added 2026-08-07** — Forest &
Cream was missing entirely despite being a style clients pick, which caused a build to approximate it with
`rich-forest` (mustard accent instead of the demo's warm tan).

**A missing slug is a LIBRARY BUG. Add it to the shared library from the demo's own `css/theme.css`
tokens — never approximate with the nearest palette, and never build a bespoke one inside a client site.**
`soft-geometric` and `rounded-warm` were **added 2026-08-08**, closing the last two gaps. Every style
1-9 now resolves to a real palette file and a real pairing file on both platforms.

**Do NOT trust the `Font Pairing:` comment in a demo's `css/theme.css` header.** demo-nutritionist says
`Minimal (Sora + Work Sans)` and demo-massage-therapist says `Friendly (Nunito + Open Sans)`, but
`minimal.json` is Inter/Inter and `friendly.json` is Poppins/Merriweather. Those comments name pairings
that exist and contain entirely different fonts, so a builder who trusts the label ships the wrong
typeface while believing it matched the demo. **The `@import` and `--font-heading` / `--font-body` lines
in the same file are the truth** — read those, not the comment.

## Lookup table

| # | Demo | Palette name | Heading font | Body font | Hero type | Reversed | Nav style | Transparent nav | Image style |
|---|------|--------------|--------------|-----------|-----------|----------|-----------|-----------------|-------------|
| 1 | demo-reflexologist | Soft Blush (mauve `#C4728A`, lavender `#A89ACD`, gold `#C9A84C`) | Baloo 2 | Nunito | `hero--half` | No | default | solid | warm portraits, soft natural light |
| 2 | demo-psychotherapist | Forest & Cream (forest `#3A6B4E`, warm tan `#C8956A`, brown `#8B7355`) | Cormorant Garamond | Source Sans 3 | `hero--fullwidth` | No | default | solid | calm studio, muted tones, portrait focus |
| 3 | demo-osteopath | Trusty Blue (blue `#3B6FA0`, tan `#D4956A`, sage `#6B8E7B`) | DM Serif Display | Inter | `hero--showcase` (dark frost) | No | two-tier | solid | clinical professional, minimal people |
| 4 | demo-nutritionist | Calm Sage (sage `#5B7B6F`, warm tan `#C4956A`, mauve `#8B6E99`) | Sora | Work Sans | `hero--half` | Yes (`hero--reverse`) | default | solid | lifestyle wellness, fresh ingredients, soft |
| 5 | demo-hypnotherapist | Bold Navy (navy `#1B3A5C`, gold `#C9A84C`, teal `#4A90A4`) | Montserrat | Source Sans 3 | `hero--image hero--image-left` | No | default | `nav--transparent-dark` | professional headshots, deep focus |
| 6 | demo-acupuncturist | Warm Terracotta (burnt orange `#B85C38`, beige `#D4A373`, green `#5D8A66`) | DM Serif Display | Inter | `hero--banner` | No | default | solid | serene treatment room, warm ambient light |
| 7 | demo-counsellor2 | Clean Slate (slate `#334155`, blue `#3B82F6`, purple `#8B5CF6`) | Lora | Montserrat | base `hero` (no modifier) | No | two-tier (`nav--branded`) | solid | modern editorial, square portrait aspect |
| 8 | demo-massage-therapist | Warm Mocha (chocolate `#6B4226`, tan `#C8976B`, rust `#B8704A`) | Nunito | Open Sans | `hero--image` | No | default | transparent-clear (inline `--nav-transparent-bg: transparent`) | spa ambiance, warm candlelit tones |
| 9 | demo-counsellor | Deep Plum (plum `#6B4C7D`, tan `#C49B6A`, sage `#7B8E6B`) | Playfair Display | Inter | `hero--half` | No | two-tier | solid | warm portraits, intimate therapy space |

## How to apply

1. Read the picked demo's `theme.css` (in `D:/claude-custom-projects/Ai-Editor-Sites/demo-{name}/css/theme.css`) and copy CSS variables verbatim into the new client's `theme.css`. Don't paraphrase hex codes from this table — open the file.
2. Mirror the demo's homepage `<header>` / `<nav>` markup (nav style + transparent variant) on every page.
3. Use the demo's hero variant on the homepage. Other pages use `hero--banner` or `hero--page-header` regardless of homepage choice (per master-site-template convention).
4. Match the image style by writing Gemini prompts that describe the demo's aesthetic — not the demo's exact subject.

## When to deviate

- Client explicitly requests a different colour, font, or hero on the form → their request wins.
- Client industry mismatch (e.g. picks demo 5 "Bold Navy" but is a children's nutritionist) → flag to admin before building. Don't silently swap.
- Client picks a style with two-tier nav but supplied <4 nav items → drop to default nav, keep palette/fonts.
