# SPLIT Chennai - WP Starter


## Included
- `.gitignore` - That ignores all WP core files, default themes, plugins, system files and som WP Engine specific stuff.
- `.editorconfig` - Basic editor config that works with WP Coding Standards.
- `bitbucket-pipelines.yml` - Basic config for deployment to WP Engine.
- `changelog.md` - Basic changelog following the Keep a Changelog standard.
- `composer.json` - Used for WP plugins and other PHP dependancies.
- `phpcs.xml` - Basic PHP Code Sniffer configuration using the WP Coding Standards.
- `readme.md` - This file.
- Theme starting point - See below.


## Requirements
- [Local by Flywheel](https://localwp.com/) for easy setup of local WP environment.
- npm
- PHP
- composer


## Developer tools
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) with [WP Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards) ruleset is included in the project using composer, install the requierments by running `composer install`. Install the [PHP Sniffer](https://marketplace.visualstudio.com/items?itemName=wongjn.php-sniffer) or other VS Code extension for PHPCS.
- [Stylelint](https://stylelint.io/) with Wordpress and Bootstrap rules. Install the [VS Code stylelint extension](https://marketplace.visualstudio.com/items?itemName=stylelint.vscode-stylelint) for in-line warnings and errors.
- [lint-staged](https://github.com/okonet/lint-staged) together with [husky](https://github.com/typicode/husky/tree/master) is used to run Stylelint on the `pre-commit` git hook. This will block all commits that have lint errors.
- If WP/react JS use [ESLint](https://eslint.org/) with [wordpress-eslint-plugin](https://www.npmjs.com/package/@wordpress/eslint-plugin)
- Always make sure that `WP_DEBUG` is set to `true` in your local `wp-config.php` file.


## Starter Theme
The theme is a slightly modified version of the https://underscores.me/ theme with sass and woocommerce support enabled.

**Whats been added:**

- Dev & Build tools using [Wpack.io](https://wpack.io/) (A modern front-end toolkit with webpack, wp auto enqueue, ES6+ support, SASS, typescript, HMR, etc)
- Block editor [theme support](https://developer.wordpress.org/block-editor/developers/themes/theme-support/)
- Bootstrap Framework (SASS and JS)
- Navbar & [WP Menu Walker](https://github.com/wp-bootstrap/wp-bootstrap-navwalker) that outputs the WP nav menu with bootstrap HTML.

**WooCommerce specific files and functions:** (Remove on non-WooCommerce themes)

- `/inc/woocommerce.php` - WooCommerce specific functions.
- Cart function calls in `header.php`
- `/src/sass/woocommerce.scss` - WooCommerce specific SASS.
- `/src/sass/shop/*` - WooCommerce specific SASS partials.

---

## 1 - Environment & WP Setup
1. Create project in Local by Flywheel. (Or clone a project from WP Engine).
2. Open a terminal window and navigate to the parent folder of the WP root folder. (`app` in Local by Flywheel sites)
3. `git clone` this repo.
4. `rm -rf /wp-wc-start/.git` - Remove git folder from clone.
5. Move all files from the clone to your wordpress root folder. Ex: `rsync -av ./sc-wp-start/ ./WP-ROOT-DIR/`
6. `rm -rf /sc-wp-start/` - Remove clone folder.
7. `cd WP-ROOT-DIR` - Open project folder.
8. `composer install` - Install basic WP Plugins. (If you run into permissions problems skip those plugins by removing them from the `composer.json` file)

## 2 - Theme Setup
1. Search and replace all theme folder names, function name prefixes, etc, following the [_s Getting started](https://github.com/Automattic/_s#getting-started) steps.
2. `cd wp-content/themes/THEME-NAME`
3. `npm install`

### Add Wpack.io toolkit
1. `npx @wpackio/cli` - Might not be needed after `npm install` but in case it is.
2. `npm run bootstrap` and follow the guide. Set the URL to your Local site url. 

Note: For file watch and hot-reload to work properly the Router Mode in Local by Flywheel settings has to be set to localhost.


### Config wpack.io auto enqueue of JS and CSS files.
The [WPack.io auto enqueue](https://wpack.io/guides/getting-started/#mention-entry-points) function is already included in the `theme-setup.php` and should work out of the box for enqueuing both SASS and JS files.

All SASS and JS is devided by two entry points.
- `main.js` for all front-end assets.
- `editor.js` for all editro/admin side assets.

1. Take a look at the `wpackio.project.js` and update the project names.
2. Change the project name in the `\WPackio\Enqueue()` instantiation inside `theme-setup.php`


For more details about the WPack.io Auto Enqueue functionality see the [@wpackio/scripts Documentation »](https://wpack.io/guides/using-wpackio-enqueue/).


## 3 - Start Development
1. Make sure the Local by Flywheel environment is running.
2. `npm start` inside of the theme folder to start file watch and hot reload using WPack.io.

Note: For file watch and hot-reload to work properly the Router Mode in Local by Flywheel settings has to be set to localhost, and correct URL + port configgured in the `wpackio.server.js` proxy setting.

[Wpack.io Development Documentation »](https://wpack.io/guides/start-development-server/)


## 4 - Build Production Package
- `npm run build`

---

## Project Config files

### composer.json
In project root folder.
Used for installing initial plugins and dev tools.

### theme-name/wpackio.project.js
Configuration file for the Wpack.io tool kit.
Webpack, ES6, React, Autoload enqueue, SASS, TypeScript, Hot Module Replacement, ect.

### bitbucket-pipelines.yml
BitBucket pipeline startingpoint for deploy to WP Engine using their Git Push feature.

See [WP Engines guide for deployment with bitbucket](https://wpengine.com/support/deploying-code-with-bitbucket-pipelines-wp-engine/#bitbucketsetup)


---

## ToDo
- Add [ESlint with WP config](https://developer.wordpress.org/block-editor/packages/packages-eslint-plugin/)
- Add [commitlint](https://github.com/conventional-changelog/commitlint)
- Auto-generate .pot files in BitBucket pipeline.
- Add NPM script for bumping of version.
- Auto-run [PHPCS on commit](https://sebastiandedeyne.com/running-php-cs-fixer-on-every-commit-with-husky-and-lint-staged/)
- Integrate Cypress for functional testing?
