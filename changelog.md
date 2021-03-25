# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.5.0] - 2020-11-23
### Added
- Add site icon in footer with site logo as fallback
- Add CommitLint with Conventional Commit config

### Fixed
- Update composer dependancies

### Removed
- Remove old TOC from style.css

## [1.4.1] - 2020-11-14
### Fixed
- Update node dependencies.
- Lint package.json

### Removed
- Remove node-sass dependency - it's still included by other packages.

## [1.4.0] - 2020-11-12
### Added
- Add BB pipeline config for deploy to prod and staging
- Add @wordpress-scripts package for Linting and Formating
- Add ESLint config
- Add trigger for ESLint on commit hook

### Changed
- Changed code indentaion to tab
- Foramt all SCSS according to WP Coding Standards
- Foramt all JS according to WP Coding Standards

## [1.3.0] - 2020-11-09
### Added
- Add sidebar to woocommerce pages.

### Fixed
- Fix text-domain in PHPCS config
- Run Composer update

### Changed
- Move all hooks and filters to top of files.

## [1.2.0] - 2020-11-06
### Changed
- Updated all NPM pagckages

### Fixed
- Fix all CSS errors reported by stylelint
- Fix theme function prefixes
- Fix wrong theme text domain 

### Removed
- Remove duplicate .editorconfig in theme folder.

## [1.1.0] - 2020-11-04
### Added
- Add stylelint with bootstrap rules
- Add lint-staged and husky
- Add config for running stylelint on git pre-commit

### Changed
- Update author in composer file
- Change .editorconfig indent to spaces


## [1.0.2] - 2020-09-04
### Added
- PHP Codesniffer and dependancies
- Generate .pot file composer script

### Fixed
- Text domain

## [1.0.1] - 2020-04-10
### Fixed
- Update Readme.

## [1.0.0] - 2020-04-10
### Fixed
- Updated Readme file with setup instructions
- Fix block spacing class name overwrites

### Added
- Changelog
- Coverblock overlay extension
- WooCommerce mini cart (slide-in)

### Removed
- Remove the test block Product slide-scroller from starting point
- Remove cart animations from starting point
- Remove some old not-used WooCommerce functions

## [0.1.0] - 2020-03-11
### Added
- Initial WordPress project starting point:
- _s theme
- Bootstrap
- WPack.io
- Block Editor basic functions
- WooCommerce basic functions
