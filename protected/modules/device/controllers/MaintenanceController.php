<?php

class MaintenanceController extends Auth {

  public function actionIndex($id) {
    $this->container_fluid = false;

    $model = DevicesModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    $this->layout        = "/layouts/update";
    $this->current_title = $model->device_code;
    $this->render("index", compact("model"));
  }
  
  public function actionList($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = DevicesQuery::getAllMaintenance($id);

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionCreate() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$post = Yii::app()->request->getPost("DeviceMaintenancesModel"))
        throw new Exception("Metodo no permitido", 403);

      $model = new DeviceMaintenancesModel;

      $model->setAttributes($post);

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "dmid" => $model->devicemaintenance_id
      ];

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }
  
  public function actionDelete() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$id = Yii::app()->request->getPost("id"))
        throw new Exception("Metodo no permitido", 403);

      $model = DeviceMaintenancesModel::model()->findByPk($id);

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "dmid" => $model->devicemaintenance_id
      ];

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
