<?php

class ResponsableController extends Auth {

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

  public function actionCreate() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }
    
    try {
      if (!$post = Yii::app()->request->getPost("adduser"))
        throw new Exception("Metodo no permitido", 403);

      $model = new DeviceResponsablesModel;
      
      $model->setAttributes($post);
      
      if(!$model->save()){
        throw new Exception("No se pudo completar la operación", 500);
      }
      
      $data = [
          "drid" => $model->deviceresponsable_id
      ];

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionList($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = DevicesQuery::getAllResponsables($id);

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListResponsables($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = ResponsablesQuery::getAllNotAssignedDevice($id);

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
