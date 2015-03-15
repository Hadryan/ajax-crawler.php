<?php
/**
 * Implementation of the `ajaxCrawler\server\controllers\SnapshotController` class.
 * @module server.controllers.SnapshotController
 */
namespace ajaxCrawler\server\controllers;

// Module dependencies.
use yii\rest\Controller;

/**
 * Manages the HTML snapshots.
 * @class ajaxCrawler.server.controllers.SnapshotController
 * @extends yii.rest.Controller
 * @constructor
 */
class SnapshotController extends Controller {

  public function actions() {
    return [
      'options'=>[
        'class'=>'yii\rest\OptionsAction',
        'collectionOptions'=>[ 'GET', 'HEAD', 'OPTIONS', 'POST' ],
        'resourceOptions'=>[ 'DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'PUT' ]
      ]
    ];
  }

  protected function verbs() {
    return [
      'create'=>[ 'POST' ],
      'delete'=>[ 'DELETE' ],
      'index'=>[ 'GET', 'HEAD' ],
      'update'=>[ 'PATCH', 'PUT' ],
      'view'=>[ 'GET', 'HEAD' ]
    ];
  }

  /**
   * TODO
   * @method actionIndex
   * @return {array} The response data.
   */
  public function actionCreate() {
    return '';
  }
  public function actionDelete($id) {
    return '';
  }
  public function actionIndex() {
    return '';
  }
  public function actionUpdate($id) {
    return '';
  }
  public function actionView($id) {
    return '';
  }
}
