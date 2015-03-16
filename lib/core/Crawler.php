<?php
/**
 * Implementation of the `ajaxCrawler\core\Crawler` class.
 * @module core.Crawler
 */
namespace ajaxCrawler\core;

// Module dependencies.
use yii\base\InvalidCallException;
use yii\base\Object;
use yii\web\HttpException;

/**
 * Crawls Web pages and returns their content.
 * @class ajaxCrawler.core.Crawler
 * @extends yii.base.Object
 * @constructor
 */
class Crawler extends Object {

  /**
   * The string prefixed to every cache key in order to avoid name collisions.
   * @property CACHE_KEY_PREFIX
   * @type string
   * @static
   * @final
   */
  const CACHE_KEY_PREFIX='ajaxCrawler\core\Crawler:';

  /**
   * The name of the query parameter providing an escaped fragment.
   * @property ESCAPED_FRAGMENT
   * @type string
   * @static
   * @final
   */
  const ESCAPED_FRAGMENT='_escaped_fragment_';

  /**
   * The underlying cache component that is used to cache the snapshots.
   * @property cache
   * @type yii.caching.Cache
   * @private
   */
  private $cache;

  /**
   * The identifier of the cache application component that is used to cache the snapshots.
   * If set to `null`, caching is disabled.
   * @property cacheId
   * @type string
   * @default null
   */
  public $cacheId=null;

  /**
   * The time in seconds that the snapshots can remain valid in cache.
   * If set to `0`, the cache never expires.
   * @property cachingDuration
   * @type int
   * @default 0
   */
  public $cachingDuration=0;

  /**
   * Value indicating whether to process escaped fragments in URLs.
   * @property decodeEscapedFragments
   * @type bool
   * @default true
   */
  public $decodeEscapedFragments=true;

  /**
   * The path or alias to the PhantomJS program.
   * @property phantomjsPath
   * @type string
   */
  private $phantomjsPath;

  public function getPhantomjsPath() {
    if(!isset($this->phantomjsPath)) {
      switch(mb_strtolower(PHP_OS)) {
        case 'winnt':
          $this->setPhantomjsPath('@root/bin/phantomjs.exe');
          break;

        case 'darwin':
          $this->setPhantomjsPath('@root/bin/phantomjs.osx');
          break;

        case 'linux':
        default:
          $this->phantomjsPath='/usr/bin/phantomjs';
          break;
      }
    }

    return $this->phantomjsPath;
  }

  public function setPhantomjsPath($value) {
    $this->phantomjsPath=\Yii::getAlias($value);
  }

  /**
   * Loads the web page located at the specified URL and returns its HTML content.
   * @method fetch
   * @param {string} url The URL to be loaded.
   * @throws {yii.web.HttpException} A network error occurred.
   */
  public function fetch($url) {
    $key=static::CACHE_KEY_PREFIX.$url;
    $value=$this->cache->get($key);

    if(!is_string($value)) {
      $command=sprintf(
        '"%s" --config="%s" "%s" "%s"',
        $this->getPhantomjsPath(),
        \Yii::getAlias('@root/etc/crawler.json'),
        \Yii::getAlias('@ajaxCrawler/core/Crawler.js'),
        $this->decodeEscapedFragments ? static::decodeEscapedFragment($url) : $url
      );

      exec($command, $output, $exitCode);
      if($exitCode) throw new HttpException($exitCode);

      $value=implode(PHP_EOL, $output);
      $this->cache->set($key, $value, $this->cachingDuration);
    }

    return $value;
  }

  /**
   * Initializes the application component.
   * @method init
   * @throws {yii.base.InvalidCallException} The underlying cache component is invalid.
   */
  public function init() {
    if(!is_string($this->cacheId)) $this->cache=\Yii::createObject('yii\caching\DummyCache');
    else {
      $this->cache=\Yii::$app->get($this->cacheId);
      if(!$this->cache instanceof \yii\caching\Cache)
        throw new InvalidCallException(\Yii::t('yii', 'Invalid cache component "{cacheId}".', [ 'cacheId'=>$this->cacheId ]));
    }

    parent::init();
  }

  /**
   * Replaces the escaped fragment found in query string by the corresponding decoded hash fragment.
   * @method decodeEscapedFragment
   * @param {string} $url The URL to process.
   * @return {string} The processed URL.
   * @static
   */
  public static function decodeEscapedFragment($url) {
    $escapedFragment=mb_strpos($url, static::ESCAPED_FRAGMENT);
    if($escapedFragment!==false) {
      $baseUrl=rtrim(mb_substr($url, 0, $escapedFragment), '&');
      $fragment=rawurldecode(mb_substr($url, $escapedFragment+mb_strlen(static::ESCAPED_FRAGMENT)+1));
      $url="$baseUrl#!$fragment";
    }

    return $url;
  }
}
