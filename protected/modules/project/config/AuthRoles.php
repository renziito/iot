<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'actions'     => ["delete"],
          'controllers' => ["project/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_DELETE"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["update"],
          'controllers' => ["project/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_UPDATE"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["create"],
          'controllers' => ["project/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_CREATE"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => [
              "users",
              "ssignedUsersAdmin",
              "assignedUsersVisor",
              "listAssignedUsersAdmin",
              "listAssignedUsersVisor",
              "listUsersAdmin",
              "ListUsersVisor",
              "unassignedUser"
          ],
          'controllers' => ["project/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_ASSIGN_USERS"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["devices", "assignDevice"],
          'controllers' => ["project/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_ASSIGN_DEVICES"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["index", "list"],
          'controllers' => ["project/overview"],
          'expression'  => 'Yii::app()->user->checkAccess(["PROJECT_VIEW"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ]
  ];

}
