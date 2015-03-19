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

  /**
   * The namespace that controller classes are located in.
   * @property controllerNamespace
   * @type string
   */
  public $controllerNamespace='ajaxCrawler\cli\controllers';

  /**
   * Whether to enable the commands provided by the core framework.
   * @property enableCoreCommands
   * @type bool
   */
  public $enableCoreCommands=false;

  /**
   * Initializes the application.
   * @method init
   */
  public function init() {
    $this->controllerMap['cache']='yii\console\controllers\CacheController';
    parent::init();
  }
}
