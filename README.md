# automation-test

WordPress block theme **Stavanger Elektro** (`stavanger-elektro`) for automation-test (http://localhost/automation-test), built from the Figma design "Stavanger elektro".

The theme lives in the repository root. Changes arrive as pull requests into `main` and are reviewed and merged on GitHub.

## Structure

- `style.css`: theme header and base CSS (header, footer, mobile adaptations)
- `theme.json`: colours, fonts, font sizes, spacing and layout widths from Figma
- `functions.php`: theme setup, menus and stylesheet
- `parts/header.html`, `parts/footer.html`: Nav and Footer from Figma, editable in the Site Editor
- `templates/`: `index`, `page`, `front-page`, `single`, `404`
- `assets/fonts/`: self-hosted Hanken Grotesk (400, 500) and Space Mono (400), WOFF2

## Design tokens

- Colours: Brand Green `#014225`, Black `#111111`, White `#FFFFFF`, and the green scale `primary-50` to `primary-950`
- Fonts: Hanken Grotesk (text), Space Mono (labels)
- Font sizes: 13, 14, 15, 16, 30, 56, 72 px (the large ones scale down on mobile)

## Blocks

Reuse a block from this list before building a new one. Add every new block here.

All blocks live in `blocks/<name>/` (`block.json` + `render.php`), are registered in `functions.php`, and are edited in the block sidebar (generic editor: `assets/js/se-editor.js`). Styles: `assets/css/blocks.css`; behaviour: `assets/js/se-blocks.js`.

| Block | Use |
| --- | --- |
| `se/hero` | Hero: heading, bullets, CTA, phone, background video and poster |
| `se/services` | "What we do" carousel of service cards, each with an illustration |
| `se/stats` | "Why homeowners choose us" key figures, optional background photo |
| `se/marquee` | Scrolling strip of trust labels |
| `se/statement` | Large statement headline, optional inline pill image/video (two spots), optional highlighted start with grey fade-out for the rest |
| `se/recent-work` | Recent work, 4-item project grid |
| `se/testimonial` | One customer quote with CTA |
| `se/pricing` | Price explorer (option C): service list and detail panel with an illustration per service |
| `se/faq` | "Ask an electrician" questions and answer card |
| `se/reels` | Instagram handle with a row of self-hosted video tiles (video, poster, duration each); four placeholder tiles until filled |
| `se/contact` | Heading and Contact Form 7 form (set the form ID), optional background photo with green overlay |

Image and video fields take a Media Library URL; empty images show a grey placeholder.

When you change CSS or JS, raise `Version` in `style.css`: it is the cache-busting version for the theme's stylesheets and scripts, so the site loads the new files.
