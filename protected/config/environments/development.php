<?php

return [
  'components' => [
    'db' => [
      'connectionString' => 'mysql:host=127.0.0.1;dbname=iot',
      'emulatePrepare'   => true,
      'username'         => 'root',
      'password'         => '123456',
      'charset'          => 'utf8',
    ]
  ]
];
