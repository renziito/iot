<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'controllers' => ["dashboard/overview"],
          'users'       => ['@'],
      ],
  ];

}
