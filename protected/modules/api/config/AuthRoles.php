<?php

class AuthRoles {

  public static $Auth = [
      ['allow',
          'controllers' => ["api/page","api/iot"],
          'users'       => ['*'],
      ]
  ];

}
