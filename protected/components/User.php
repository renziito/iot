<?php

class User {

  public static function imagenProfile($size = false) {
    $imgProfile = Yii::app()->user->img_profile;
    return self::buildImagenProfiler($imgProfile, $size);
  }

  public static function buildImagenProfiler($imgProfile, $size = false) {
    if (strpos($imgProfile, "{size}")) {
      if ($size) {
        $imgProfile = str_replace(["{size}", "{thumb}"], [$size, "thumb"], $imgProfile);
      } else {
        $imgProfile = str_replace(["_{size}", "/{thumb}/"], ["", "/"], $imgProfile);
      }
    }
    return $imgProfile;
  }

  public static function generateNewPassword() {
    return Utils::token("sha1", uniqid(), 8);
  }

  public static function navigation($controller) {
    $data            = [];
    $depends         = 0;
    $controller_name = $controller->id;
    $action_name     = $controller->action->id;
    $module_name     = "";
    if ($controller_name != "error") {
      $module_name = (!is_null($controller->module->id)) ? $controller->module->id : '';
    }
    $navigation   = UserQuery::getNavigationByRole(Yii::app()->user->id, Yii::app()->user->role()->role_id);
    $actionActive = NavigationQuery::validateActive($controller_name, $action_name, $module_name);

    foreach ($navigation as $row => $item) {
      $active = ($item["action_id"] == $actionActive) ? true : false;

      $id    = (int) $item["navigation_id"];
      $level = (int) $item["navigation_level"];
      $dep   = (int) $item["navigation_depends"];

      $dataItem = [
          "id"     => $id,
          "name"   => $item["navigation_name"],
          "items"  => false,
          "icon"   => $item["navigation_icon"],
          "url"    => is_null($item["navigation_url"]) ? false : $item["navigation_url"],
          "active" => $active
      ];

      if ($dep !== 0) {
        $data = self::buildNavigation($item, $dataItem, $data, $active);
      } else {
        $data[$id] = $dataItem;
      }
    }
    
    return $data;
  }

  public static function buildNavigation($item, $data = [], $navigation = [], $active) {
    $id    = (int) $item["navigation_id"];
    $level = (int) $item["navigation_level"];
    $dep   = (int) $item["navigation_depends"];

    $dataDep = NavigationQuery::getById($dep);

    if ($dataDep) {
      $idDep    = (int) $dataDep["navigation_id"];
      $levelDep = (int) $dataDep["navigation_level"];
      $depDep   = (int) $dataDep["navigation_depends"];

      $dataItem = [
          "id"     => $idDep,
          "name"   => $dataDep["navigation_name"],
          "items"  => false,
          "icon"   => $dataDep["navigation_icon"],
          "url"    => is_null($dataDep["navigation_url"]) ? false : $dataDep["navigation_url"],
          "active" => $active
      ];

      if ($depDep !== 0) {
        $navigation = self::buildNavigation($dataDep, $dataItem, $navigation, $active);
      } else {
        if (!isset($navigation[$idDep])) {
          $navigation[$idDep] = $dataItem;
        }
        $navigation[$idDep]["items"][$id] = $data;
        if ($active) {
          $navigation[$idDep]["active"] = $active;
        }
      }
    }

    return $navigation;
  }

}
