<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'controllers' => ["user/password","user/profile","user/navigation"],
          'users'       => ['@'],
      ],
  ];

}
