# Alcatraz

**Contributors:** [carrieforde](https://profiles.wordpress.org/carrieforde), [braad](https://profiles.wordpress.org/braad), [jgonzo127](https://profiles.wordpress.org/jgonzo127)  
**Tags:** two-columns, left-sidebar, right-sidebar, flexible-header, accessibility-ready, custom-menu, custom-logo, editor-style, featured-images, theme-options, threaded-comments, translation-ready  

**Requires at least:** 4.0  
**Tested up to:** 4.9  
**Stable tag:** 1.0.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Alcatraz is a theme designed and developed with the WordPress theme developer in mind. Use Alcatraz as a starter theme, or use it in conjunction with [alcatraz-child](https://github.com/carrieforde/alcatraz-child) to quickly spin up a custom theme.

## Description

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
- [Webpack](https://webpack.js.org/)

## Pre-Installation

Because Alcatraz is meant as a developer's theme, a basic grasp of the command line as well as the following dependencies is beneficial:

* [Node](http://node.js) / [NPM](https://npmjs.org)
* [Webpack](https://webpack.js.org/)
* [Sass](http://sass-lang.com)

## Getting Started

To get started, clone this repo to your computer:  

```sh
git clone https://github.com/carrieforde/Alcatraz.git alcatraz
```

Once you have cloned the project, move into the project folder, and install the Node dependencies:

```sh
cd /path/to/project
npm install
```

If you would like to use any of Alcatraz's optional dependencies, like Better Font Awesome or CMB2, you'll need to init their submodules:  

```sh
cd /path/to/project
git submodule update --init --recursive
```

Finally, after running `npm install`, you'll need to tell Webpack about your local site domain so you can use BrowserSync to monitor changes during development:  

1. Search for `https://alcatraz.test` in `webpack.config.js` and replace it with the URL for your local site.
1. Run `npm run dev` to kick of `webpack` and begin development.


### Using Alcatraz as a starter theme
If you want to use `Alcatraz` as a starter theme, you'll like want to replace all instances of `Alcatraz` the name of your new theme. You'll need to do a six-step find and replace to capture all instances of `alcatraz` throughout the theme:  

1. Search for `'ALCATRAZ_'` (capitalization matters!) to capture the theme constants.
1. Search for `'alcatraz'` (inside single quotations) to capture the text domain.
1. Search for `alcatraz_` to capture all the function names.
1. Search for `Text Domain: alcatraz` in style.css.
1. Search for ` alcatraz` (with a space before it) to capture DocBlocks.
1. Search for `alcatraz-` to capture prefixed handles.


## NPM Scripts
Alcatraz comes with a host of NPM script commands to perform various development tasks.

### `npm run build`
Generates bundled, production-ready files with `webpack`.

### `npm run dev`
Uses `webpack` to spin up a development server at `http://localhost:3000`, and initiates `webpack --watch`. Changes to files in `./src` will be bundled automatically, and the site will be reloaded.

### `npm eslint`
Runs ESLint against all JavaScript files in the `/src` directory. Only errors will be displayed in the console.

#### `npm eslint:fix`
A subtask for ESLint that not only checks for JavaScript linting errors, but also auto-fixes any fixable issues.

### `npm format`
Keep formatting consistent between developers with Prettier. Enforces whether to use tabs or spaces, the number of spaces to use, single vs. double quotes, etc. Automatically fixes JS, JSX, and SCSS files.

### `npm run stylelint`
Runs Stylelint to enforce rules for style files (.css, .scss, etc.) in the `/src` directory. Flags errors in the console.

#### `npm run stylelint:fix`
A subtask for Stylelint that not only checks against style rules, but automatically fixes fixable issues.

## Linting
Alcatraz includes style and JavaScript linting by default using Stylelint and ES Lint, respectively. Alcatraz adheres to the [WordPress Coding Standards](https://codex.wordpress.org/WordPress_Coding_Standards)

### Stylelint

#### Customizing Rules
https://stylelint.io/user-guide/configuration/#configuration

#### Disabling Rules
https://stylelint.io/user-guide/configuration/#turning-rules-off-from-within-your-css

### ESLint

#### Customizing Rules
https://eslint.org/docs/user-guide/configuring

#### Disabling Rules
https://eslint.org/docs/user-guide/configuring


## Activation

1. In your admin panel, go to Appearance > Themes and click the Add New button.
1. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
1. Click Activate to use your new theme right away.

## Changelog

### 1.0.0
* Initial release

## Credits

* Based on Underscores http://underscores.me/, (C) 2012-2018 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* sanitize.scss https://www.npmjs.com/package/sanitize.scss, (C) Jonathan Neal https://github.com/jonathantneal/sanitize.css
* [Aurora Utilities](https://www.npmjs.com/package/aurora-utilities)
* [Better Font Awesome](https://github.com/MickeyKay/better-font-awesome-library), Mickey Kay
* [CMB2](https://github.com/CMB2/CMB2)
