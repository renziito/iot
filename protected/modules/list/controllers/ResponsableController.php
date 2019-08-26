<?php

class ResponsableController extends Auth {

  public $layout          = "/layouts/update";
  public $container_fluid = false;

  public function actionIndex($id) {
    $model = ListsModel::model()->findByPk($id);

    if (!$model || !ListsQuery::isAdmin($model->list_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }
    
    $this->current_title   = "Asignar Responsables";

    $this->render("index", compact("model"));
  }

}
