<?php

class ManageController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionCreate() {
    $this->container_fluid = false;
    $this->current_title   = "Crear Proyecto";

    $model = new ProjectsModel;
    if ($post  = Yii::app()->request->getPost("ProjectsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }
        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("project"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("project/manage/create"));
      }
    }
    $this->render("create", compact("model"));
  }

  public function actionUpdate($id) {
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model || !ProjectsQuery::isAdmin($model->project_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("ProjectsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }
        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("project"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("project/manage/update"));
      }
    }

    $this->container_fluid = false;
    $this->current_title   = $model->project_name;

    $this->render("update", compact("model"));
  }

  public function actionDelete() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$id = Yii::app()->request->getPost("id"))
        throw new Exception("Metodo no permitido", 403);

      $model = ProjectsModel::model()->findByPk($id);

      if (!$model || !ProjectsQuery::isAdmin($model->project_id))
        throw new Exception("Metodo no permitido", 403);

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save())
        throw new Exception("La operación no pudo completarse correctamente", 500);

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionUsers($id) {
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model || !ProjectsQuery::isAdmin($model->project_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }

    $this->container_fluid = false;
    $this->current_title   = "Asignar Usuarios";

    $this->render("users", compact("model"));
  }

  public function actionDevices($id) {
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model || !ProjectsQuery::isAdmin($model->project_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }

    $this->container_fluid = false;
    $this->current_title   = "Asignar Dispositivos";

    $this->render("devices", compact("model"));
  }

  public function actionListUsersAdmin($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = UserQuery::getAllUnassignedProjectByRole(RolesQuery::getIdByKey("ADMIN"), $id);
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"    => $user["user_id"],
            "name"  => "{$user["user_firstname"]} {$user["user_lastname"]}",
            "email" => $user["user_email"],
            "img"   => $user["user_img_profile"],
        ];
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListUsersVisor($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = UserQuery::getAllUnassignedProjectByRole(RolesQuery::getIdByKey("VISOR"), $id);
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"    => $user["user_id"],
            "name"  => "{$user["user_firstname"]} {$user["user_lastname"]}",
            "email" => $user["user_email"],
            "img"   => $user["user_img_profile"],
        ];
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionAssignedUsersAdmin() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$post = Yii::app()->request->getPost("adduser"))
        throw new Exception("Metodo no permitido", 403);

      $model = new ProjectUsersModel;

      $model->user_id    = $post["user_id"];
      $model->project_id = $post["project_id"];
      $model->role_id    = RolesQuery::getIdByKey("ADMIN");

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }
  
  public function actionAssignedUsersVisor() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$post = Yii::app()->request->getPost("adduser"))
        throw new Exception("Metodo no permitido", 403);

      $model = new ProjectUsersModel;

      $model->user_id    = $post["user_id"];
      $model->project_id = $post["project_id"];
      $model->role_id    = RolesQuery::getIdByKey("VISOR");

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListAssignedUsersAdmin($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = ProjectsQuery::getAllAssignedUsersByRole($id, RolesQuery::getIdByKey("ADMIN"));
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"    => $user["projectuser_id"],
            "name"  => "{$user["user_firstname"]} {$user["user_lastname"]}",
            "email" => $user["user_email"],
            "img"   => $user["user_img_profile"],
        ];
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListAssignedUsersVisor($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = ProjectsQuery::getAllAssignedUsersByRole($id, RolesQuery::getIdByKey("VISOR"));
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"    => $user["projectuser_id"],
            "name"  => "{$user["user_firstname"]} {$user["user_lastname"]}",
            "email" => $user["user_email"],
            "img"   => $user["user_img_profile"],
        ];
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionUnassignedUser() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$post = Yii::app()->request->getPost("removeuser"))
        throw new Exception("Metodo no permitido", 403);

      $model = ProjectUsersModel::model()->findByPk($post["id"]);

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
