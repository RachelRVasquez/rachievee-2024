[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

RachieVee 2024 WordPress Theme
===

A customized WordPress theme built from `underscores` for rachievee.com

Installation
---------------

### Requirements

Requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

### Setup

To start using all the tools that come with this theme, you need to install the necessary Node.js and Composer dependencies :

```sh
$ composer install
$ npm install
```

### Available CLI commands

CLI commands tailored for WordPress theme development :

- `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `languages/` directory.
- `npm run compile:css` : compiles SASS files to css.
- `npm run compile:rtl` : generates an RTL stylesheet.
- `npm run watch` : watches all SASS files and recompiles them to css when they change.
- `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.

### Workflow

The `npm bundle` command is what creates the final WordPress theme that is then activated on a WordPress install. It removes files and dependencies used during development. I avoided adding dependencies that couldn't be removed during the final bundle. My theme uses the [Carbon Fields plugin](https://carbonfields.net/docs/carbon-fields-plugin-quickstart/) for my homepage "intro" blurb and to make the content in my footer dynamic. I realize this is not standard for a "publicly available" WordPress theme but since it's my personal theme, I decided to make use of that tool for custom fields.
