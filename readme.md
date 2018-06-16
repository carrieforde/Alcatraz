# Alcatraz #

**Contributors:** [carrieforde](https://profiles.wordpress.org/carrieforde), [braad](https://profiles.wordpress.org/braad), [jgonzo127](https://profiles.wordpress.org/jgonzo127)  
**Tags:** translation-ready, custom-background, upload-custom-logo, header-layout options, navigation-style-options, layout-options, theme-options, custom-menu, threaded-comments, responsive, mobile-first, retina-ready  

**Requires at least:** 4.0  
**Tested up to:** 4.9  
**Stable tag:** 1.0.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Alcatraz is a theme designed and developed with the WordPress theme developer in mind.

## Description ##

Alcatraz is a developer's theme packed with all kinds of goodies to improve your development workflow:

- Theme hooks
- Lightweight CSS Normalization with [Sanitize.css](https://github.com/jonathantneal/sanitize.css)
- Sass
  * Sensible configuration
  * Flexible architecture
  * Linting with [Stylelint](https://stylelint.io/)
  * Compilation
  * Minification
- JavaScript
  * Focused on Vanilla JS, but ready for anything (including jQuery & React!)
  * Supports ES Next with Babel
  * Linting with [ESLint](https://eslint.org/)
  * Concatenation
  * Uglification / minification
- Icon (SVG) concatenation & minification
- Image minification
- Test-driven development (TDD) support with [Jest](https://facebook.github.io/jest/)
- Type-checking support using [Flow](https://flow.org/en/)

## Pre-Installation ##

Because Alcatraz is meant as a developer's theme, a basic grasp of the command line as well as the following dependencies is beneficial:

* [Node](http://node.js)
* [Webpack](https://webpack.js.org/)
* [Sass](http://sass-lang.com)

## Installation ##

Alcatraz uses git submodules to manage some of the themes' optional dependencies like Better Font Awesome and CMB2. In order to use these features, you will need to init the submodules. To do so:

1. Open your command line program and navigate to your theme directory:
```sh
cd /your-project/wp-content/themes/alcatraz
```

2. Init the submodules:
```sh
git submodule update --init --recursive
```

Alcatraz uses NPM to manage the Bourbon and Neat libraries, and Node to run the Grunt tasks. You will need to install these dependencies before beginning developement.

Alcatraz uses NPM to manage external dependencies. You will need to install these packages before beginning development:

```sh
npm install
```
1. Move onto activating your theme!

## Activation ##

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

## Frequently Asked Questions ##

### Does this theme support any plugins? ###

Alcatraz supports all of the plugins.

## Changelog ##

### 1.0.0 ###
* Initial release

## Credits ##

* Based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* sanitize.scss https://www.npmjs.com/package/sanitize.scss, (C) Jonathan Neal https://github.com/jonathantneal/sanitize.css
* [Bourbon and Neat](http://bourbon.io/), (C) 2011-2017 thoughtbot, inc., [MIT](http://opensource.org/licenses/MIT)
* [Better Font Awesome](https://github.com/MickeyKay/better-font-awesome-library), Mickey Kay
* [CMB2](https://github.com/WebDevStudios/cmb2), WebDevStudios
