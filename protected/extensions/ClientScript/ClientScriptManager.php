<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Extensions\ClientsScript
 */
class ClientScriptManager extends CClientScript {

  public function init() {
    if ((!Yii::app()->getController()->module ) || Yii::app()->getController()->module->id != "gii") {
      $this->setCoreScriptUrl(Yii::app()->getBaseUrl());
    }
  }

  public function registerModuleScript($depend) {
    $controller = Yii::app()->getController();

    if ($controller->module) {
      $urlConfigModule  = "application.modules.{$controller->module->id}.config";
      $pathConfigModule = Yii::getPathOfAlias($urlConfigModule);
      if (is_dir($pathConfigModule)) {
        $fileAssets = $pathConfigModule . DIRECTORY_SEPARATOR . 'Assets.php';
        if (is_file($fileAssets)) {
          Yii::import($urlConfigModule . ".Assets");
          $assets          = new Assets($controller);
          $assets->depends = array_merge($assets->depends, [$depend]);
          $this->addPackage($controller->module->id, $assets->register());
          $this->registerPackage($controller->module->id);
        }
      }
    } else {
      $this->registerPackage($depend);
    }
  }

}
