<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'actions'     => ["delete"],
          'controllers' => ["list/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_DELETE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["update"],
          'controllers' => ["list/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_UPDATE"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["create"],
          'controllers' => ["list/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_CREATE"]);',
          'roles'       => ["ADMIN"],
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
          'controllers' => ["list/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_ASSIGN_USERS"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["devices", "assignDevice"],
          'controllers' => ["list/manage"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_ASSIGN_DEVICES"]);',
          'roles'       => ["ADMIN"],
          'users'       => ['@'],
      ],
      ['allow',
          'actions'     => ["index", "list"],
          'controllers' => ["list/overview"],
          'expression'  => 'Yii::app()->user->checkAccess(["LIST_VIEW"]);',
          'roles'       => ["ADMIN", "VISOR"],
          'users'       => ['@'],
      ]
  ];

}
