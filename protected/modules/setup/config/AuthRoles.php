<?php

class AuthRoles {

  public static $Auth = [
      //Administracion de Roles
      ['allow',
          'actions'     => ["setting", "savePermission"],
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ROLE_PERMISSION"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["delete"],
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ROLE_DELETE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["manage"],
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ROLE_UPDATE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["manage"],
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ROLE_CREATE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["index", "list"],
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ROLE_VIEW"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      //Administracion de Usuarios
      ['allow',
          'actions'     => ["create"],
          'controllers' => ["setup/user"],
          'expression'  => 'Yii::app()->user->checkAccess(["USER_CREATE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["delete"],
          'controllers' => ["setup/user"],
          'expression'  => 'Yii::app()->user->checkAccess(["USER_DELETE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["update", "changeStatus", "resetPassword"],
          'controllers' => ["setup/user"],
          'expression'  => 'Yii::app()->user->checkAccess(["USER_UPDATE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["index", "list"],
          'controllers' => ["setup/user"],
          'expression'  => 'Yii::app()->user->checkAccess(["USER_VIEW"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
  ];

}
