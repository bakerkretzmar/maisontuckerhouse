# maisontuckerhouse

#### Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

#### TODO

- [x] Add pretty language switcher link
- [x] Button shortcode (options for colour, style, and block/inline)
- [ ] Redirect message in French saying that this page isn't in French yet
- [ ] Link to **much simpler** tutorials and help sites in the docs, not the Codex
- [ ] Docs: image context
- [ ] Add thumbnail support to posts, post lists
- [x] Translatable ACF fields
- [x] Search title when there **are** results
- [x] Fix image captions inside page edit screen
- [x] Try facebook feed in sidebar
- [x] Make signup form pretty
- [ ] DOCS
  - [ ] Custom sidebars
- [ ] Check Diana's notes txt
- [ ] 

#### Notes

- Home/Accueil and Blog/Blogue separation works great
  - visiting `maisontuckerhouse.dev` takes you to the home page, in the language you were in when you last visited
  - Blog and Blogue display correctly / as expected
  - Clicking the logo takes you to the home page
  - visiting `/home` or `/accueil` takes you to the correct page, same with `/blog` and `/blogue`
  - Visiting `/index.php` in either language takes you to the home page for that language, but **visiting `/<lang>/index.php` takes you to a post index/archive page with no special body classes and the title set to the title of the most recent post**
