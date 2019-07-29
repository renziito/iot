<?php

class Assets extends AssetsBundle {

  public $js      = [];
  public $css     = [];
  public $depends = [];

  /**
   *
   * @var type 
   */
  public $controller = [
      "profile" => [
          "js"      => ["profile.min.js"],
          "css"     => [],
          "depends" => ["jquery-validation"],
      ],
      "password" => [
          "js"      => ["password.min.js"],
          "css"     => [],
          "depends" => ["jquery-validation"],
      ]
  ];
  public $action     = [];

}
