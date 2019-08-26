<?php

class DeviceController extends Auth {

  public function actionIndex() {
    $this->current_title = "Tipos de Dispositivos";

    $this->render("index");
  }

  public function actionList() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = TypeDevicesQuery::getAll();

      foreach ($data as $key => $item) {
        $data[$key]["month"] = Date::getMonthById($item["dmonth"]);
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListVariables($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = TypeDevicesQuery::getAllVariables($id);

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionCreate() {
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("TypeDevicesModel")) {
      try {
        $model = new TypeDevicesModel();

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/device/variables/id/{$model->typedevice_id}"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/device/create"));
      }
    }

    $this->layout        = "/layouts/create";
    $this->current_title = "Nuevo Tipo de Dispositivo";
    $this->render("create", ["model" => (new TypeDevicesModel())]);
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = TypeDevicesModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("TypeDevicesModel")) {
      try {

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
      }
      $this->redirect(Yii::app()->createUrl("setting/device/update/id/{$id}"));
    }

    $this->layout        = "/layouts/update";
    $this->current_title = $model->typedevice_denomination;
    $this->render("update", compact("model"));
  }

  public function actionDelete() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$id = Yii::app()->request->getPost("id")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = TypeDevicesModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "did" => $model->typedevice_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionDeleteVariable() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$id = Yii::app()->request->getPost("id")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = TypeDeviceVariablesModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "dvid" => $model->typedevicevariable_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionVariables($id) {
    $this->container_fluid = false;

    $model = TypeDevicesModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("TypeDeviceVariablesModel")) {
      try {
        $modelVariable = new TypeDeviceVariablesModel;

        $modelVariable->setAttributes($post);

        if (!$modelVariable->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
      }
      $this->redirect(Yii::app()->createUrl("setting/device/variables/id/{$id}"));
    }

    $this->layout        = "/layouts/update";
    $this->current_title = $model->typedevice_denomination;
    $this->render("device", compact("model"));
  }

}
