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

      $data   = ProjectsQuery::getAll();
      $update = $update = $device = $users  = $delete = true;
      if (!Yii::app()->user->sudo) {
        $update = (bool) (Yii::app()->user->checkAccess(["PROJECT_UPDATE"]));
        $device = (bool) (Yii::app()->user->checkAccess(["PROJECT_ASSIGN_DEVICES"]));
        $users  = (bool) (Yii::app()->user->checkAccess(["PROJECT_ASSIGN_USERS"]));
        $delete = (bool) (Yii::app()->user->checkAccess(["PROJECT_DELETE"]));
      }

      foreach ($data as $key => $val) {
        $data[$key]["update"]  = $update;
        $data[$key]["devices"] = $device;
        $data[$key]["users"]   = $users;
        $data[$key]["delete"]  = $delete;
      }


      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
