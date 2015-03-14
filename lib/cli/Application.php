<?php
/**
 * Implementation of the `ajaxCrawler\cli\Application` class.
 * @module cli.Application
 */
namespace ajaxCrawler\cli;

// Module dependencies.
use ajaxCrawler\core\ApplicationTrait;

/**
 * Defines the methods and properties of the console application.
 * @class ajaxCrawler.cli.Application
 * @extends yii.console.Application
 * @constructor
 * @param {array} [$config] The application configuration.
 */
class Application extends \yii\console\Application {
  use ApplicationTrait;
}
