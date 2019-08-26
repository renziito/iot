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
      "banner.index"     => [
          "js"      => ["banner.list"],
          "css"     => [],
          "depends" => ["sortable"],
      ],
      "banner.create"    => [
          "js"      => ["banner.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "card.index"       => [
          "js"      => ["card.list"],
          "css"     => [],
          "depends" => ["alertPlugin", "tablePlugin"],
      ],
      "partner.index"    => [
          "js"      => ["partner.list"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin"],
      ],
      "partner.create"   => [
          "js"      => ["partner.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "partner.update"   => [
          "js"      => ["partner.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "variable.index"   => [
          "js"      => ["variable.list"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin"],
      ],
      "variable.create"  => [
          "js"      => ["variable.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "variable.update"  => [
          "js"      => ["variable.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "device.index"     => [
          "js"      => ["device.list"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin"],
      ],
      "device.create"    => [
          "js"      => ["device.create"],
          "css"     => [],
          "depends" => ["alertPlugin", "jquery-validation"],
      ],
      "device.variables" => [
          "js"      => ["device.variable"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin", "select2", "jquery-validation"],
      ],
  ];

}
