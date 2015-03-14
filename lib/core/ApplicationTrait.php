<?php
/**
 * Implementation of the `ajaxCrawler\core\ApplicationTrait` trait.
 * @module core.ApplicationTrait
 */
namespace ajaxCrawler\core;

// Module dependencies.
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Provides the base methods and properties of an application.
 * @class ajaxCrawler.core.ApplicationTrait
 * @static
 */
trait ApplicationTrait {

  /**
   * Parses the application configuration.
   * @method loadConfig
   * @param {string} $path The path of the directory containing the configuration files.
   * @return {array} The parsed configuration.
   * @static
   */
  public static function loadConfig($path) {
    $files=[ 'crawler.json', YII_ENV.'/crawler.json' ];

    $settings=[];
    foreach($files as $file) {
      $filePath=\Yii::getAlias("$path/$file");
      if(is_file($filePath)) {
        $config=Json::decode(@file_get_contents($filePath));
        if(is_array($config)) $settings=ArrayHelper::merge($settings, $config);
      }
    }

    return $settings;
  }
}
