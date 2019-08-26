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
      "overview" => [
          "js"      => [],
          "css"     => [],
          "depends" => [],
      ]
  ];
  public $action     = [
      "manage.create" => [
          "js"      => ["device.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ]
  ];

}
