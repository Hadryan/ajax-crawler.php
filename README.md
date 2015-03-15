# AJAX-Crawler.php
An AJAX website crawler with cache for [Google indexation](https://developers.google.com/webmasters/ajax-crawling/docs/specification), in [PHP](https://php.net).

## Requirements
- The latest [PHP](https://php.net) and [Composer](https://getcomposer.org) versions.
- The latest [PhantomJS](http://phantomjs.org) version on Linux systems.
- A Web server supporting URL rewriting, like [Apache](https://httpd.apache.org) or [IIS](http://www.iis.net).

## Installing

#### Linux Systems
The PhantomJS binaries are provided for OSX and Windows operating systems.
On Linux systems, you must install the PhantomJS binary prior to use this project.
On Debian based systems, you can use the following command:

```shell
$ sudo apt-get install phantomjs
```

#### Production Environment
From a command prompt, run the following commands at the project root:

```shell
$ composer global require "fxp/composer-asset-plugin"
$ composer install --no-dev
```

#### Development Environment
If you plan to modify the sources or to run the unit tests, use the following commands:

```shell
$ composer global require "fxp/composer-asset-plugin"
$ composer install
```

## Libraries
- [Yii Framework](http://www.yiiframework.com)
- [PhantomJS](http://phantomjs.org)

## Directory Tree

#### `etc` folder
Contains the configuration files:
- `app.json`: contains the settings of this project.
- `crawler.json`: contains the settings of the PhantomJS program.

Subfolders provide overrides for different environments:
- `dev`: the development environment.
- `prod`: the production environment.

#### `lib` folder
Contains the sources:
- `cli`: contains the sources of the console application.
- `core`: contains the shared sources.
- `server`: contains the sources of the server application.

#### Other  folders
- `bin`: contains the command line programs.
- `doc`: contains the documentation.
- `var`: contains the temporary files.
- `www`: contains the Web root.
