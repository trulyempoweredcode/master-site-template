# Client Brief

Copy this file to `D:\claude-custom-projects\Ai-Editor-Sites\{domain}\client-brief.md` and fill in for each client.

---

```
Business name:
Domain:

Site type: static | wordpress
  static    = flat HTML + GitHub Pages. Build with SITE-BUILD-PROMPT.md.
  wordpress = Elementor clone of the atomic master. Build with WP-SITE-BUILD-PROMPT.md instead.
MCP server: (wordpress only — the per-client novamira-* server name, from portal f_novamira_mcp)

Build target: (wordpress only — the install the build happens on, from portal f_wp_url)
  Portal f_wp_url:
  Probed site_url():
  Verified on:
  Both lines must be present and identical before ANY write. Blank f_wp_url = STOP and ask.
  A probed value matching the client's live domain = STOP, you are pointed at their live site.

Scenario: (1 | 2 | 3)
  1 = New site — pull content from client's existing website
  2 = New site — content supplied in local folder (also used for a wireframe conversion)
  3 = Existing site built by us — convert to current template system

Existing site URL: (for scenario 1, or blank)
Content folder: (for scenario 2, e.g. D:\claude-custom-projects\Ai-Editor-Sites\{domain}\portal-content\)
Existing repo: (for scenario 3, e.g. trulyempoweredcode/acme.co.uk — or the wireframe repo)

Content source: existing site | supplied | both
Content rewrite: full | light | none
Voice/tone: warm | clinical | formal | conversational | authoritative | nurturing | blend | "extract from content"  (how the copy should read — default: extract from the client's existing copy)
Photos: existing only | client supplied | generate all | mixed | none
Image style: warm | professional | clinical | lifestyle | luxury | rustic | minimal | vibrant

Style direction: (free-text overall look & feel steer, or blank — e.g. "clean and airy, lots of whitespace, calming, like example.com")
  NOTE: every design field below is an optional override. A set value = follow exactly.
  Blank, "Auto", or "you recommend" = the builder decides from the client's brand, sector, audience and content.
Palette: (e.g. calm-sage, or blank / "Auto" / "you recommend")
Font pairing: (e.g. classic-elegance, or blank / "Auto" / "you recommend")
Aesthetic: soft | sharp | editorial | luxe | brutalist | blank / "Auto"  (corner radius / shadow / border feel — builder-chosen by default; not captured on the admin form)
Hero style: (e.g. split, fullwidth, image, or blank / "Auto" / "you recommend")
Hero reversed: yes | no
Nav style: default | two-tier
Transparent nav: yes | no
Blog needed: yes | no
Google Analytics ID: (if known)

Client notes:
(paste client's free-text responses from intake form)

Dev notes:
(your technical notes, component preferences, special instructions)
```
