# Existing Site Conversion Prompt

Convert an existing flat HTML website to be compatible with the AI Site Editor
by adding section comments to all pages.

## Site location

`D:\claude-custom-projects\Ai-Editor-Sites\{domain}\`

## Rules

1. **Add section comments** around every distinct content section in every `.html` page:
   - Opening: `<!-- SECTION: name -->`
   - Closing: `<!-- /SECTION: name -->`

2. **Section naming convention** — use lowercase kebab-case names that describe the section's purpose:
   - `nav` — main navigation (once per page, same on all pages)
   - `footer` — site footer (once per page, same on all pages)
   - `hero` — homepage hero/banner
   - `page-header` — inner page header (h1 + subtitle)
   - `intro`, `about`, `services`, `pricing`, `faq`, `contact-form`, `testimonials`, `team`, `cta`, `map` — content sections by purpose
   - If a page has multiple sections of the same type, append a qualifier: `cta-mid`, `cta-bottom`, `testimonials-home`

3. **Do NOT wrap these elements** (they are utilities, not editable content):
   - `<script>` tags
   - Cookie consent banner
   - Back-to-top button
   - Skip-to-content link

4. **Do NOT change** any content, styling, structure, classes, or functionality.

5. **Fix navigation paths** — ensure all inter-page `href` values are relative
   (e.g. `about.html` not `/about.html` or `https://domain.com/about.html`).

6. **Add site credit** after `<!-- /SECTION: footer -->` on every page (outside section comments so AI editor cannot modify it):
   ```html
   <div class="site-credit">
     <p>Website by <a href="https://therapywebgenie.co.uk" target="_blank" rel="noopener">Therapy Webgenie</a></p>
   </div>
   ```
   Add the `.site-credit` CSS to the site's stylesheet (see `master-site-template/css/components.css` for the styles).

7. **Create cookies-policy.html** if one doesn't exist. Use `master-site-template/cookies-policy.html` as the template. Extract the business name, email, and phone from the existing site content to populate the placeholders. Match the site's existing nav, footer, and styling. This page should be `noindex`.

8. **Update cookie banner** (if present) to link to `cookies-policy.html`. If no cookie banner exists, add one to every page before `</body>`:
   ```html
   <div class="cookie-banner" role="dialog" aria-label="Cookie consent">
     <div class="cookie-banner__inner">
       <p class="cookie-banner__text">We use cookies to improve your experience. See our <a href="cookies-policy.html">cookie policy</a> for details.</p>
       <button class="cookie-banner__accept">Accept</button>
     </div>
   </div>
   ```

9. **Ensure footer legal links** include both Privacy Policy and Cookie Policy.

10. **Update contact form** to POST to the central handler:
    - Change form `action` to `https://editmy.site/api/contact.php`
    - Add hidden field: `<input type="hidden" name="site" value="{domain}">`
    - Ensure the form has `method="POST"` and class `form`

11. **Generate robots.txt** in the site root:
    ```
    User-agent: *
    Allow: /

    Sitemap: https://www.{domain}/sitemap.xml
    ```

12. **Generate sitemap.xml** listing all public pages (exclude `cookies-policy.html`) with `<lastmod>` dates.

13. **After processing all pages**, output a summary table:

   | Page | Sections added |
   |------|----------------|
   | index.html | nav, hero, intro, services, testimonials, cta, footer |
   | about.html | nav, page-header, story, team, cta, footer |
   | ... | ... |

---

## Git Setup and Deploy

1. Initialise git repo in the client site directory (if not already a repo)
2. Create a commit with all changes
3. Create GitHub repo under `trulyempoweredcode/{domain}` organisation
4. Push to GitHub
5. Report the preview URL: `https://trulyempoweredcode.github.io/{domain}/`
6. Provide the contact form config block to add to `api/contact.php` on 20i
