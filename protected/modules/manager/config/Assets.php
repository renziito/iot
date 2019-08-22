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
          "js"      => ["create", "update", "delete", "overview"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin", "jquery-validation"],
      ]
  ];
  public $action     = [];

}
