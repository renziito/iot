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
          "js"      => ["user.js"],
          "css"     => [],
          "depends" => ["jquery-validation", "alertPlugin"],
      ]
  ];
  public $action     = [
      "user.index"   => [
          "js"      => ["user.list.js"],
          "css"     => [],
          "depends" => ["tablePlugin", "alertPlugin"],
      ],
      "user.create"  => [
          "js"      => ["user.create.js"],
          "css"     => [],
          "depends" => [],
      ],
      "user.update"  => [
          "js"      => ["user.update.js"],
          "css"     => [],
          "depends" => [],
      ],
      "role.index"   => [
          "js"      => ["role.index.js"],
          "css"     => [],
          "depends" => ["jquery-validation", "tablePlugin"],
      ],
      "role.setting" => [
          "js"      => ["role.setting.js"],
          "css"     => [],
          "depends" => [],
      ],
      "action.index" => [
          "js"      => ["action.index.js"],
          "css"     => [],
          "depends" => ["jquery-validation", "tablePlugin"],
      ],
  ];

}
