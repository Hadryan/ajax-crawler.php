#!/usr/bin/env php
<?php
/**
 * Entry point of the console application.
 * @module bin.cli
 */
use ajaxCrawler\cli\Application;

// Set the environment.
$devEnvironment=in_array('--debug', $argv);
define('YII_DEBUG', $devEnvironment);
define('YII_ENV', $devEnvironment ? 'dev' : 'prod');

// Load the dependencies.
$rootPath=dirname(__DIR__);
require_once $rootPath.'/vendor/autoload.php';
require_once $rootPath.'/vendor/yiisoft/yii2/Yii.php';

// Start the application.
Yii::setAlias('@root', $rootPath);
Yii::setAlias('@ajaxCrawler', '@root/lib');

$config=Application::parseConfig('@root/etc');
$config['basePath']=Yii::getAlias('@ajaxCrawler/cli');
$exitCode=(new Application($config))->run();
exit($exitCode);
