<?php

class ManageController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionCreate() {
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("DevicesModel")) {
      try {
        $model = new DevicesModel();

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("device/responsable/index/id/{$model->device_id}"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("device/manage/create"));
      }
    }
    
    $this->layout = "/layouts/create";
    $this->current_title = "Nuevo Dispositivo";
    $this->render("create", ["model" => (new DevicesModel())]);
  }

  public function actionTypeDevice() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$id = Yii::app()->request->getPost("id")) {
        throw new Exception("Metodo no permitido", 403);
      }

      $data = TypeDevicesQuery::getByPk($id);

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = DevicesModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("DevicesModel")) {
      try {

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
      }
      $this->redirect(Yii::app()->createUrl("device/manage/update/id/{$id}"));
    }

    $this->layout = "/layouts/update";
    $this->current_title = $model->device_code;
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

      $model = DevicesModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "did" => $model->device_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
