<?php
/**
 * Implementation of the `ajaxCrawler\cli\controllers\SnapshotController` class.
 * @module cli.controllers.SnapshotController
 */
namespace ajaxCrawler\cli\controllers;

// Module dependencies.
use yii\console\Controller;
use yii\console\Exception;

/**
 * Manages the HTML snapshots.
 * @class ajaxCrawler.cli.controllers.SnapshotController
 * @extends yii.console.Controller
 * @constructor
 */
class SnapshotController extends Controller {

  /**
   * Stores a snapshot identified by an URL into cache if the cache does not contain this URL.
   * @method actionCreate
   * @param {string} $url An URL identifying the snapshot to be cached.
   * @return {int} The exit code.
   */
  public function actionCreate($url) {
    try {
      $crawler=\Yii::$app->get('crawler');
      echo 'Add to cache: ';
      $crawler->add($url);
      echo 'OK', PHP_EOL;
      return static::EXIT_CODE_NORMAL;
    }

    catch(\Exception $e) {
      echo $e->getMessage(), PHP_EOL;
      return static::EXIT_CODE_ERROR;
    }
  }

  /**
   * Deletes a snapshot with the specified URL from cache.
   * @method actionDelete
   * @param {string} $url An URL identifying the snapshot to be deleted from cache.
   * @return {int} The exit code.
   */
  public function actionDelete($url) {
    try {
      $crawler=\Yii::$app->get('crawler');
      echo 'Delete from cache: ';
      echo $crawler->delete($url) ? 'OK' : 'Error', PHP_EOL;
      return static::EXIT_CODE_NORMAL;
    }

    catch(\Exception $e) {
      echo $e->getMessage(), PHP_EOL;
      return static::EXIT_CODE_ERROR;
    }
  }

  /**
   * Stores a snapshot identified by an URL into cache.
   * @method actionUpdate
   * @param {string} $url An URL identifying the snapshot to be cached.
   * @return {int} The exit code.
   */
  public function actionUpdate($url) {
    try {
      $crawler=\Yii::$app->get('crawler');
      echo 'Store to cache: ';
      echo $crawler->set($url) ? 'OK' : 'Error', PHP_EOL;
      return static::EXIT_CODE_NORMAL;
    }

    catch(\Exception $e) {
      echo $e->getMessage(), PHP_EOL;
      return static::EXIT_CODE_ERROR;
    }
  }

  /**
   * Retrieves a snapshot from cache with a specified URL.
   * @method actionView
   * @param {string} $url An URL identifying the cached snapshot.
   * @return {int} The exit code.
   */
  public function actionView($url) {
    try {
      $crawler=\Yii::$app->get('crawler');
      echo $crawler->get($url), PHP_EOL;
      return static::EXIT_CODE_NORMAL;
    }

    catch(\Exception $e) {
      echo $e->getMessage(), PHP_EOL;
      return static::EXIT_CODE_ERROR;
    }
  }
}
