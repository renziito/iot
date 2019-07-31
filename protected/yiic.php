<?php

// change the following paths if necessary
require_once(dirname(__FILE__) . '/components/Environments.php');
$env_mode    = Environments::DEVELOPMENT;
$environment = new Environments($env_mode);
// change the following paths if necessary
$yiic=dirname(__FILE__).'/vendor/yiisoft/yii/framework/yiic.php';
$config      = $environment->getConsoleConfig();
require_once($yiic);
