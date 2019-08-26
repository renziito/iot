<?php

class ResponsableController extends Auth {

  public function actionIndex($id) {
     $this->container_fluid = false;

    $model = DevicesModel::model()->findByPk($id);
    
    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }
    
    $this->current_title = $model->device_code;
    $this->render("index", compact("model"));
    
  }

}
