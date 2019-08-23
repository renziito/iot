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
      "banner" => [
          "js"      => [],
          "css"     => [],
          "depends" => [],
      ]
  ];
  public $action     = [
      "banner.index" => [
          "js"      => ["banner.list"],
          "css"     => [],
          "depends" => ["sortable"],
      ],
      "banner.create" => [
          "js"      => ["banner.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ]
  ];

}
