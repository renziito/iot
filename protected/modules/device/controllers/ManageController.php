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
        $this->redirect(Yii::app()->createUrl("device"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("device/manage/create"));
      }
    }

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

}
