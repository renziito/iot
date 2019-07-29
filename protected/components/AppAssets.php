<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class AppAssets {

  public static $js      = [];
  public static $css     = [];
  public static $depends = ["espire"];

  public static function registerScript() {
    Yii::app()->clientScript->addPackage("app", [
        "baseUrl" => 'static',
        "js"      => self::$js,
        "css"     => self::$css,
        "depends" => self::$depends
    ]);
  }

}
