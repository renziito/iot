<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Config
 */
return [
    /* User */
    'changePassword'                         => 'user/password',
    /* Login */
    'signin'                                 => 'login/validate',
    'logout'                                 => 'login/logout',
//    'http://<client_name:\w+>.serviciosvirtuales.local/login' => 'login/index',
    /* System */
    '<controller:\w+>/<id:\d+>'              => '<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
    '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
];
