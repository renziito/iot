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
      "user" => [
          "js"      => ["user"],
          "css"     => [],
          "depends" => ["jquery-validation", "alertPlugin", "datepiker"],
      ]
  ];
  public $action     = [
      "user.index"   => [
          "js"      => ["user.list"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin"],
      ],
      "user.create"  => [
          "js"      => ["user.create"],
          "css"     => [],
          "depends" => [],
      ],
      "user.update"  => [
          "js"      => ["user.update"],
          "css"     => [],
          "depends" => [],
      ],
      "role.index"   => [
          "js"      => ["role.index"],
          "css"     => [],
          "depends" => ["jquery-validation", "tablePlugin"],
      ],
      "role.setting" => [
          "js"      => ["role.setting"],
          "css"     => [],
          "depends" => [],
      ],
      "action.index" => [
          "js"      => ["action.index"],
          "css"     => [],
          "depends" => ["jquery-validation", "tablePlugin"],
      ],
  ];

}
