# Tucker House Theme Documentation

Welcome! This page (hopefully!) explains all of the features and functionality of this WordPress theme. If there's anything missing, you can look it up on the [WordPress Codex](https://codex.wordpress.org/) or email Jacob at [jacobtbk@gmail.com](mailto:jacobtbk@gmail.com).

##### Contents
  * [Pages](#pages)
  * [Posts](#posts)
  * [Media](#media)
  * [Sidebars](#sidebars)
  * [Widgets](#widgets)
  * [Shortcodes](#shortcodes)
  * [Plugins](#plugins)
  * [Languages](#languages)
  * [Administration](#administration)
  * [Odds and Ends](#miscellaneous)

##### WordPress Codex

WordPress is open-source and has extensive documentation online, most of which is _excellent_. The official reference for most things WordPress is the WordPress Codex, at [codex.wordpress.org](https://codex.wordpress.org/). This is a good first place to look for advice about any issues with WordPress, and it's also a great resource to learn about the features built into WordPress and the various options available to you. These docs will mostly give brief summaries and then link to the Codex, except for the features built specifically for this theme.

### Pages

Pages are where all of the main _static_ content of the site goes. Once the site is set up, the pages and their structure and content should rarely change. Pages appear very similar to posts when browsing the site, the main difference being that they don't display a publication date. Most of the main menu items are pages.

##### Page Options

This theme adds a few options to all pages, which appear in a the "Page Options" section of the Page editing screen, in the smaller right-side column:

**Sponsor Logos**: This option allows you to display a footer on the page that shows a thank-you message and the logos of Tucker House's sponsors and partners. This option is set individually for each page. The images displayed in the sponsor footer are all of the media uploads with the media tag "Sponsor Logo" selected. See the Media section of these docs for more info about tagging media.

**Sidebars**: By default, every page displays the "Primary" sidebar. The Sidebars option on each page allows you to override this setting and display a custom sidebar instead. See the Sidebars section of these docs for more info.

##### Excerpts

The Page editing screen includes a field called the "Excerpt." This is a preview or short summary of the content of the page. It's used to populate the cards on the home page of the site, so it's only necessary on pages that are featured there. If a page is featured, the excerpt will appear on the card in between the page's title and the "More" button. If the page is not featured (or if it is and you don't mind this part of the card being blank), you can leave the Excerpt blank.

<a href="#tucker-house-theme-documentation">Top</a>

### Posts

Posts are very similar to pages, but their content is generally narrative, time-specific, or very focused. Posts can be linked to in menus just like pages, and they appear on the [Blog page](https://maisontuckerhouse.ca/en/blog/) of the site in reverse chronological order (although this page, as of Fall 2017, is itself not linked to from anywhere, essentially hiding it). Posts display their publication date and author. Like pages, they can contain buttons, galleries, and other custom content, and they can display custom sidebars.

<a href="#top">Top</a>

### Media

##### Uploading

In general, only upload media files that will be embedded or linked to directly. This WordPress site should not be where you store or organize photos, and you should aim to upload as _few_ media files as possible. That being said, when you do upload media files, always upload the full-resolution, highest-quality versions of those files, becayse WordPress and the EWWW plugin automatically resize and compress images for use.

Try to title media files briefly but accurately, and **always** include the title in the `Alt Text` field (this is displayed when the image doesn't load, or to screen-reader technologies). When writing captions, remember that the caption will be attached to that image every time and place that it is displayed, so it should be specific to the image, rather than the context in which the image is being used.

##### Image Options

Like with Pages, this theme adds some options to each uploaded media file. These options appear underneath the other image settings in the Media section or attachment editor of the admin area.

**Link**: Here you can enter a link to associate with this particular media file. The link can be to another page or post of this website, or any external website. If that particular media file has been tagged to display in the slider or cards on the home page, this link will be what that image leads to—either by clicking on the title of the image, if it's in the slider, or the "More" button, if it's a card.

**Tags**: As it's set up right now, this theme has three possible media tags: "Frontpage Cards," "Frontpage Slider," and "Sponsor Logo." These tags enable you to use images in different places around the site.

Tagging an image with "Frontpage Cards" will cause it to appear as one of the three cards on the home page of the site. If an image is tagged this way, the image Title will be the title of the card, the Caption will be the smaller subtitle text on the card, and the Link will be where the "More" button on the card leads.

Tagging and image with "Frontpage Slider" will cause it to appear in the main image gallery slider on the home page of the site. If an image is tagged this way, the image Title will be the main title text display over the image in the slider, the Caption will be the smaller subtitle text, and the Link will be where the main title text link leads.

Tagging an image with "Sponsor Logo" will cause it to appear in the Sponsor Logos page footer. Images tagged this way will populate this footer on every page with the Sponsor Logos option selected.

In all of these areas, images will appear in reverse chronological order, with the most recent displayed first. This makes uploading 'new' content intuitive, because by default it will display first. Unfortunately, it makes displaying slides, cards, and logos in a customer order somewhat complicated. Images are displayed with the most recently _uploaded_ first, so to reorder images, you will need to plan ahead and upload or re-upload them in the order you want them displayed.

##### Galleries

Image galleries are a feature that is built into WordPress! When editing a page or post, in the Add Media popup, the Create Gallery tab allows you to select images to display in a custom gallery on that page. These galleries are separated from one another and specific to where they're embedded, so there is no list of them anywhere and they can't be reused or edited all together.

The gallery will be embedded in the page or post wherever you insert it, and it will display to users as a small slider. The options for each image in these galleries _are_ synced with that image's other appearances, so changing the caption here, for example, will also change it on a home page card that that image is attached to. If you need different captions or other options for the images in a gallery, you will have to upload the image again with these options. Make sure that before inserting the gallery, you set the Link To field to "None" and the Size to "Full Size."

<a href="#top">Top</a>

### Sidebars

Sidebars are displayed in the Widgets screen: they are the outer boxes in the right-side column. This theme has four built-in sidebars: **Primary**, **Footer 1**, **Footer 2**, and **Footer 3**. They all behave the same way, they're just displayed in different places on the site.

Sidebars are basically 'widget areas'—they don't necessarily show up on the 'side' of the site, and they don't do anything special on their own, they just let you organize widgets. Every sidebar can contain any number of widgets, which you can add by dragging them in from the left-side column of the Widgets screen.

Sidebars can be created and edited in the Widgets screen of the admin area, which is under the Appearance header. The Custom Sidebars plugin allows you to created and edit as many sidebars as you need. To use these sidebars, while editing a page or post, select your desired sidebar from the Sidebars options panel. By default, or if you leave this dropdown empty, the "Primary" sidebar will be displayed.

The **Primary** sidebar is displayed on the right side of most pages and posts on the site, and typically contains buttons, social links, recent posts, etc. The three **Footer** sidebars fill the dark green footer area of the site, and appear on every page. The only reason there are three of them is to make laying out the footer easier—the **Footer** sidebars appear in order as 1/3-width columns.

<a href="#top">Top</a>

### Widgets

Widgets are small 'blocks' that can add content or functionality to a site. They can be added and reordered inside sidebars to create custom layouts. WordPress comes with many widgets built in, like the Menu, Categories, and Meta widgets.

Plugins can also add widgets—in this case, the Polylang translation plugin provides a Language Switcher widget. When added, this widget displays a dropdown menu of available languages, and selecting one will switch the site into that language.

This theme adds two custom widgets: TH Custom Button and TH Social Buttons. TH Custom Button adds a customizable button to whichever sidebar it's added to. The widget editor allows you to select the button text, link, colour, and style. TH Social Buttons adds a group of links to social media platforms, and the editor allows you to customize the links the these platforms.

<a href="#top">Top</a>

### Shortcodes

Shortcodes are a feature of WordPress that allow you to very easily embed custom content and functionality directly in posts and page content. They are invoked with square brackets, and displayed to users as whatever content they represent.

Plugins can add shortcodes—in this case, the Column Shortcodes allows you to create columns inside post and page content. This plugin's interface is very intuitive, and there is good documentation for it online if you run into problems.

This theme also adds one custom shortcode, "button." This shortcode inserts a custom button into the page or post content. In its simplest form, it looks like this:

`[button title="Button" link="https://maisontuckerhouse.ca"]`

In the webpage displayed to the user, this entire tag, from the opening to closing square bracket, will be replaced with a custom button. The button's title field is the text that will be displayed on the button, and the link can be any valid URL and will be what clicking on the button links to.

By default, buttons are green, filled in, and shrink to the width of their title text. These options can all be overridden by passing options to the button shortcode, like this:

`[button red block outline title="Big Red Outline" link="https://example.com"]`

The options "red," "block," and "outline" will make the button red, make it expand to fill the full width of wherever it is, and make it outlined rather than filled in. These options can be left out or applied in any combination (and any order) to create a variety of custom buttons.

<a href="#top">Top</a>

### Plugins

Several plugins have been installed to add functionality to the site or optimize its performance. It shouldn't be necessary for you to adjust any plugin settings or features, and doing so can affect how the site works or looks. If you need to make any changes to plugins or plugin settings, be careful, or email me first!

For more information about some specific plugins and what they do, see the Administration section below.

<a href="#top">Top</a>

### Languages

The site is available in English and French thanks to the translation plugin Polylang. Polylang allows you to translate almost every part of the site into French, so that it can be displayed in either language and everything else will stay the same. For the most part this translation interface is very intuitive—every post and page displays a small translation field, linking to the page or post in the other language if it exists, and providing a button to create it in the other language if it doesn't. Many of the theme's internal functions like category and tag names can also be translated.

Translation is also available for media uploads! Many of the media fields, like the Title and Caption, can be translated. WordPress keeps only one copy of the media file itself, but will display the Title, Caption, and other information in English or French based on the context in which it's being displayed.

Some content can't be translated, notably the menus and the static homepage. English and French menus must be created and updated independently. Widgets can be created in English and French, and can individually be set to display on the English site, French site, or both (this is useful if they don't contain any text—for example, social buttons). Static content on the homepage can only be updated by editing the theme directly, so email me if this needs to be changed!

##### URL Translation

Links to specific pages on the site are set up to automatically include a prefix for the language: `/en/` or `/fr/`. Because we're using the free version of Polylang, pages must be named different in each language. The silver lining here is that because every page has its own unique name, you don't ever need to type in the language prefix—https://maisontuckerhouse.ca/countryfun/ redirects to https://maisontuckerhouse.ca/en/countryfun/ automatically.

WordPress's two 'special' kinds of pages, the Home page and the Blog page, also support this translation scheme: the English home page is `/home`, the French home page is `/accueil`, the English blog page is `/blog`, and the French blog page is `/blogue`. WordPress obeys the page _name_ you enter, not the language prefix, so visiting `/en/blogue` takes you to the French blog page. Clicking on the Maison Tucker House logo always returns you to the home page in the current language.

<a href="#top">Top</a>

### Administration

##### Menus

This theme provides only one menu location (in English and in French), the main header navigation menu. (You can created more menus and put them elsewhere.)

The main navigation menu should be only two levels deep: the first level of menu items, which creates the main links at the top of the site, and the second level of menu sub-items, which provides dropdown links from these main items. The menu setup is somewhat tricky, and there are a few things that are very important to remember when editing the menus:
- **The 'Donate' and 'Contact' menu items must be last, in that order.** The last two menu items are set to display as buttons. This styling is based on their position in the menu, not their content, so the last two menu items, whatever they are, will always be styled that way.
- **Main menu items cannot link to anything if they have sub-items.** This is very important. Any menu item with a dropdown is simply a placeholder to access the dropdown menu—it can't link to anything. If it is set to link to a page, or anything else, this content will be inaccessible. Main menu items should be added as "Custom Links" and the URL set to "#". Links to actual content should be added normally as sub-items of these main menu items. Main menu items _can_ be normal links, if you want, _as long as they have no sub-items_!
- **The main menu can only be two levels deep.** Do not add sub-sub-items to menu sub-items. It will look very weird and cause problems with the menu dropdowns.

##### Plugins

**Advanced Custom Fields**: This plugin enables the custom media tagging and page options.

**EWWW Image Optimizer**: This plugin automatically compresses every image uploaded to the site, and manages the multiple different sized copies of each image that WordPress creates automatically. Thanks to this plugin, you can and should upload all images in as high a resolution as possible!

**Polylang**: As described above, this plugin manages the translation of the site.

**Soil**: This plugin contains a variety of optimizations for WordPress itself, which make the site faster and the theme much simpler to develop.

**WP Pusher**: This allows me to make edits to the theme remotely. The site's theme is linked to a [public code repository hosted on Bitbucket](https://bitbucket.org/bakerkretzmar/maisontuckerhouse). When I push changes to the theme to this repository, it notifies WordPress, and the WP Pusher plugin pulls in those changes automatically. The code that is publicly available in this repo only contains the layouts, functionality, and styles of the site—none of its content. (And it's secure—anyone can look up that repo and look at the code, but only I can make changes to it.)

**Wordfence Security**: This plugin is deactivated currently because it slows the site down significantly, and in my experience it isn't necessary. It can be enabled and configured relatively quickly if need be, however the main issue it addressed in the past (spam comments and logins) are mostly resolved by other changes and plugins—in particular disabling comments site-wide and hiding the default login URL with the WPS Hide Login plugin.

**WPS Hide Login**: This plugin changes the login URL of the site and disables the WordPress default, /wp-login.php. The customized login URL can be edited at the very bottom of the General settings pane.

**Yoast SEO**: This plugin provides an interface for editing the meta information of each page and post that is displayed to search engines and web browsers. It is incredibly complex and powerful, but in most cases, overkill.

<a href="#top">Top</a>

### Odds and Ends

:-)

##### Bugs

Some WordPress pages can also be visited directly by their full URLs, for example `https://maisontuckerhouse.ca/index.php`. Currently, visiting `/index.php` takes you to the home page in the current language, but if you manually type in the language prefix to try to visit `/en/index.php` or `/fr/index.php`, this causes an error that unfortunately isn't handled nicely with pretty 404 or other error page. I'm not sure if this is due to a bug in Polylang or a bug in my theme, but I'm confident that it's limited to this one specific case and shouldn't cause any issues.

<a href="#top">Top</a>
