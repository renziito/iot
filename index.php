<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP
 */
require_once(dirname(__FILE__) . '/protected/components/Environments.php');
$environment = new Environments(Environments::DEVELOPMENT);

// change the following paths if necessary
require_once(dirname(__FILE__) . '/protected/vendor/autoload.php');
$yii = dirname(__FILE__) . '/protected/vendor/yiisoft/yii/framework/yii.php';

//Enviroment
defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
defined('APP_ENVIROMENT') or define('APP_ENVIROMENT', $environment->getMode());
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', $environment->getTraceLevel());

require_once($yii);
Yii::createWebApplication($environment->getConfig())->run();
