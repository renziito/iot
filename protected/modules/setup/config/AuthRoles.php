<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'controllers' => ["setup/role"],
          'expression'  => 'Yii::app()->user->checkAccess(["ADMIN_ROLES"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'controllers' => ["setup/user"],
          'expression'  => 'Yii::app()->user->checkAccess(["ADMIN_USERS"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
  ];

}
