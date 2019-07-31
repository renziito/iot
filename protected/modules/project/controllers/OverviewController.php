<?php

class OverviewController extends Auth {

  public function actionIndex() {
    $this->current_title = "Listado de Proyectos";
    $this->render("index");
  }

  public function actionList() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = ProjectsQuery::getAll();
      
      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
