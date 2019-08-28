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
      "overview.index"    => [
          "js"      => ["device.list"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin"],
      ],
      "manage.create"     => [
          "js"      => ["device.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "responsable.index" => [
          "js"      => ["manager/create", "device.responsable"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin", "jquery-validation"],
      ],
      "maintenance.index" => [
          "js"      => ["manager/create", "device.maintenance"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin", "datepiker", "select2", "jquery-validation"],
      ]
  ];

}
