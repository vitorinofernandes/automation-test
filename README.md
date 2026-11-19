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

_No blocks yet._
