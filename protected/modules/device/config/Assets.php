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
      "overview.index" => [
          "js"      => ["device.list"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin"],
      ],
      "manage.create" => [
          "js"      => ["device.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "responsable.index" => [
          "js"      => ["device.responsable"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin"],
      ]
  ];

}
