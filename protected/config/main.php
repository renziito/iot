<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Config
 */
return [
    'basePath'          => dirname(__FILE__) . DIRECTORY_SEPARATOR . "..",
    'name'              => 'IOT :: Internet of Things',
    'theme'             => 'espire',
    'defaultController' => 'home',
    'language'          => 'es',
    'sourceLanguage'    => 'es',
    'timeZone'          => 'America/Lima',
    'preload'           => ['log'],
    'import'            => [
        'application.models.*',
        'application.components.*',
    ],
    'modules'           => require(dirname(__FILE__) . '/modules.php'),
    'components'        => [
        'user'         => [
            'class'                     => "ext.User.UserManager",
            'loginRequiredAjaxResponse' => 'LOGIN_REQUIRED',
            'allowAutoLogin'            => TRUE,
            'loginUrl'                  => 'login'
        ],
        'authManager'  => [
            'defaultRoles' => ['SUPERADMIN'],
        ],
        'clientScript' => [
            'class' => "ext.ClientScript.ClientScriptManager"
        ],
        'browser'      => [
            'class' => 'ext.Browser.CBrowserComponent',
        ],
        'urlManager'   => [
            'urlFormat'      => 'path',
            'showScriptName' => FALSE,
            'rules'          => require(dirname(__FILE__) . '/routes.php'),
        ],
        'db'           => [],
        'errorHandler' => [
            'errorAction' => 'error',
        ]
    ],
    'params'            => require(dirname(__FILE__) . '/params.php'),
];
