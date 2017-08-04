# maisontuckerhouse

#### Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

#### TODO

- [x] Sponsor logo image layout system – ask Diana
  - [x] Use image tags
    - [x] Add link and tag fields to images with ACF
  - [x] Random or chronological order
  - [x] Generous whitespace
- [ ] Home page
- [ ] Homepage slider with tagged images, chronological order
- [ ] ~~Make footer buttons actually `$white`~~
- [ ] ~~Add `-webkit-font-smoothing: antialiased` *everywhere*~~
- [x] `@font-face` statements in their own file, imported first/second
- [ ] Figure out `index.php` title issue
- [x] Add pretty language switcher link
  - [ ] Move this somewhere else? Immediately left of the "Donate" button maybe? Breakpoint may need to change then...

#### Notes

- Home/Accueil and Blog/Blogue separation works great
  - visiting `maisontuckerhouse.dev` takes you to the home page, in the language you were in when you last visited
  - Blog and Blogue display correctly / as expected
  - Clicking the logo takes you to the home page
  - visiting `/home` or `/accueil` takes you to the correct page, same with `/blog` and `/blogue`
  - Visiting `/index.php` in either language takes you to the home page for that language, but **visiting `/<lang>/index.php` takes you to a post index/archive page with no special body classes and the title set to the title of the most recent post**
