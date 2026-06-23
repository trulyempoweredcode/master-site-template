# Demo Design Tokens

When a client picks one of the 9 design examples on the onboarding form (https://www.therapywebgenie.com/design-examples/), look up that style here and apply these tokens to their build.

The client's "any changes you want" answer takes precedence — treat these as the **default baseline**, then layer their requested deltas on top (e.g. "like style 4 but warmer colours" → use style 4 fonts/hero/nav, swap the palette).

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
