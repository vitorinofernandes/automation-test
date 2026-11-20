# automation-test

WordPress block theme **Stavanger Elektro** (`stavanger-elektro`) for automation-test (http://localhost/automation-test), built from the Figma design "Stavanger elektro".

The theme lives in the repository root. Changes arrive as pull requests into `main` and are reviewed and merged on GitHub.

## Structure

- `style.css`: theme header and base CSS (header, footer, mobile adaptations)
- `theme.json`: colours, fonts, font sizes, spacing and layout widths from Figma
- `functions.php`: theme setup, menus and stylesheet
- `parts/header.html`, `parts/footer.html`: hold only the `se/site-header` and `se/site-footer` blocks (Nav and Footer from Figma)
- `templates/`: `index`, `page`, `front-page`, `single`, `404`
- `assets/fonts/`: self-hosted Hanken Grotesk (400, 500) and Space Mono (400), WOFF2
- `assets/icons/`: SVG icons and the white logo exported from Figma

## Design tokens

- Colours: Brand Green `#014225`, Dark Green `#012D19` (footer, reels, solid header), Text `#1F2B25`, Copper `#D99A62` (buttons), Sand `#F6F5EF`, Mint `#97FDCF`, Mint Light `#C1FEE3`, Grey 300 `#C3CBC7`, Grey 500 `#747474`, Footer Text `#FEECEC`, Star `#F4DE1D`, Black `#111111`, White `#FFFFFF`, and the green scale `primary-50` to `primary-950`
- Fonts: Hanken Grotesk (text), Space Mono (labels, kept in the design's case)
- Font sizes: 13, 14, 15, 16, 18, 20, 24, 30, 40, 56, 60, 64, 72, 80 px (24 px and up scale down on mobile)
- Body: 16 px / 21.6 px, letter spacing -0.2 px. Headings 400: h1 72 px (-2.9 px), h2 56 px (-1.7 px), h3 30 px (-0.6 px)
- Buttons: `#D99A62`, text `#012D19` 16 px / 500, square corners, 48 px high, padding 0 18 0 24
- Page: 1440 px design, 40 px side padding (16 px below 900 px), wide width 1360 px

## Header

`se/site-header` is transparent and sits over the first section when a page starts with a full-width section (`se/hero`, `se/stats`, `se/testimonial`, `se/reels`, `se/contact`; filter `se_header_overlay_blocks`); elsewhere it has a solid `#012D19` background. Its "Header style" field forces `overlay` or `solid`. Below 900 px the links collapse behind a menu button (full-width panel, Escape closes).

## Blocks

Reuse a block from this list before building a new one. Add every new block here.

All blocks live in `blocks/<name>/` (`block.json` + `render.php`), are registered in `functions.php`, and are edited in the block sidebar (generic editor: `assets/js/se-editor.js`). Styles: `assets/css/blocks.css`; behaviour: `assets/js/se-blocks.js`.

| Block | Use |
| --- | --- |
| `se/site-header` | Site header (template part): logo, menu items (label + url), phone, main button, mobile menu; transparent or solid |
| `se/site-footer` | Site footer (template part): logo, tagline, social links, Services and Shortcuts link lists, contact details, bottom line with legal links |
| `se/hero` | Hero: heading, bullets, CTA, phone, background video and poster |
| `se/services` | "What we do" carousel of service cards, each with an illustration plus an optional second image (El-kontroll: clipboard + meter); image fields take a URL or a theme path like `assets/illustrations/x.svg` |
| `se/stats` | "Why homeowners choose us" key figures, optional background photo |
| `se/marquee` | Scrolling strip of trust labels |
| `se/statement` | Large statement headline, optional inline pill image/video (two spots), optional highlighted start with grey fade-out for the rest |
| `se/recent-work` | Recent work, 4-item project grid |
| `se/testimonial` | One customer quote with CTA |
| `se/pricing` | Price explorer (option C): service list and detail panel with an illustration per service |
| `se/faq` | "Ask an electrician" questions and answer card |
| `se/reels` | Instagram handle with a row of self-hosted video tiles (video, poster, duration each); four placeholder tiles until filled |
| `se/contact` | Booking card from the design (Figma 230:3561): heading, form fields (label, placeholder, type `text`/`tel`/`email`/`select`/`textarea`, comma-separated options, Contact Form 7 field name, required `yes`/`no`), privacy note and send button label; background photo with green shade; van callout ("That's us — call…" link, `showHotspot` `yes`/`no`). The form is sent to the Contact Form 7 form set in Form ID (hash or ID), which validates it and sends the mail; fields without a name take the form's fields in order, and a select uses the form field's own options when it has them |

Image and video fields take a Media Library URL; empty images show a grey placeholder.

When you change CSS or JS, raise `Version` in `style.css`: it is the cache-busting version for the theme's stylesheets and scripts, so the site loads the new files.
