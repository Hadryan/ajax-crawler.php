<?php
/**
 * Entry point of the server application.
 * @module www.index
 */
use ajaxCrawler\server\Application;

// Set the environment.
$remoteAddress=(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? 'HTTP_X_FORWARDED_FOR' : 'REMOTE_ADDR');
$devEnvironment=in_array(getenv($remoteAddress), [ '127.0.0.1', '::1' ]);

define('YII_DEBUG', $devEnvironment);
define('YII_ENV', getenv('YII_ENV') ?: ($devEnvironment ? 'dev' : 'prod'));

// Load the dependencies.
$rootPath=dirname(__DIR__);
require_once $rootPath.'/vendor/autoload.php';
require_once $rootPath.'/vendor/yiisoft/yii2/Yii.php';

// Start the application.
Yii::setAlias('@root', $rootPath);
Yii::setAlias('@ajaxCrawler', '@root/lib');

$config=Application::parseConfig('@root/etc');
$config['basePath']=Yii::getAlias('@ajaxCrawler/server');
(new Application($config))->run();
