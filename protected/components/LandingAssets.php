<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class LandingAssets {

  public static $js      = ["js/app.js","js/landing.js"];
  public static $css     = [];
  public static $depends = ["bootstrap", "glide", "placeholder"];

  public static function registerScript() {
    Yii::app()->clientScript->addPackage("landing", [
        "baseUrl" => 'static',
        "js"      => self::$js,
        "css"     => self::$css,
        "depends" => self::$depends
    ]);
  }

}
