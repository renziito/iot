<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LocationController
 *
 * @author francisco
 */
class LocationController extends Auth {

  public function actionGetProvinces($id) {

    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }
    try {
      $rows = Location::listProvinces($id);

      $data = [
          'items' => []
      ];
      foreach ($rows as $id => $value) {
        $data['items'][] = ["id" => $id, "name" => $value];
      }

      Response::JSON(false, 200, "Provincias Obtenidas", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }
  
  public function actionGetDistricts($id) {

    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }
    try {
      $rows = Location::listDistricts($id);

      $data = [
          'items' => []
      ];
      foreach ($rows as $id => $value) {
        $data['items'][] = ["id" => $id, "name" => $value];
      }

      Response::JSON(false, 200, "Distritos Obtenidos", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
