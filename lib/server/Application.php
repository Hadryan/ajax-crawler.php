<?php
/**
 * Implementation of the `ajaxCrawler\server\Application` class.
 * @module server.Application
 */
namespace ajaxCrawler\server;

// Module dependencies.
use ajaxCrawler\core\ApplicationTrait;

/**
 * Defines the methods and properties of the server application.
 * @class ajaxCrawler.server.Application
 * @extends yii.web.Application
 * @constructor
 * @param {array} [$config] The application configuration.
 */
class Application extends \yii\web\Application {
  use ApplicationTrait;

  public function __construct($config=[]) {
    parent::__construct($config);
    $this->on('afterRequest', [ $this, 'onAfterRequest' ]);
  }

  /**
   * The namespace that controller classes are located in.
   * @property controllerNamespace
   * @type string
   */
  public $controllerNamespace=__NAMESPACE__.'\controllers';

  /**
   * Raised after the application successfully handles a request.
   * @method onAfterRequest
   * @param {yii.base.Event} $event The event parameter.
   */
  public function onAfterRequest($event) {
    $response=\Yii::$app->response;
    $settings=\Yii::$app->params;

    if(isset($settings['accessControl'])) {
      $access=$settings['accessControl'];
      $controls=[
        'allow-headers'=>isset($access['allowHeaders']) ? $access['allowHeaders'] : 'x-requested-with',
        'allow-methods'=>isset($access['allowMethods']) ? $access['allowMethods'] : 'GET',
        'allow-origin'=>isset($access['allowOrigin']) ? $access['allowOrigin'] : '*'
      ];

      foreach($controls as $key=>$value) $response->headers['access-control-'.$key]=$value;
    }
  }
}
