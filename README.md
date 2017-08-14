# maisontuckerhouse

#### Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

#### TODO

- [ ] Home page
- [ ] Figure out `index.php` title issue
- [x] Add pretty language switcher link
  - [ ] Move this somewhere else? Immediately left of the "Donate" button maybe? Breakpoint may need to change then...
- [ ] Button shortcode (options for colour, style, and block/inline)

#### Notes

- Home/Accueil and Blog/Blogue separation works great
  - visiting `maisontuckerhouse.dev` takes you to the home page, in the language you were in when you last visited
  - Blog and Blogue display correctly / as expected
  - Clicking the logo takes you to the home page
  - visiting `/home` or `/accueil` takes you to the correct page, same with `/blog` and `/blogue`
  - Visiting `/index.php` in either language takes you to the home page for that language, but **visiting `/<lang>/index.php` takes you to a post index/archive page with no special body classes and the title set to the title of the most recent post**
