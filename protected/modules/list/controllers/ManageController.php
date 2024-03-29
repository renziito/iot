<?php

class ManageController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionCreate() {
    $this->container_fluid = false;
    $this->current_title   = "Crear Lista";

    $model = new ListsModel;
    if ($post  = Yii::app()->request->getPost("ListsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }

        new LogEvent("LIST_CREATE", $model->list_id, "Creó la lista {ln}",
          [
            "ln" => $model->list_name
          ]
        );

        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("list"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("list/manage/create"));
      }
    }
    $this->render("create", compact("model"));
  }

  public function actionUpdate($id) {
    $model = ListsModel::model()->findByPk($id);

    if (!$model || !ListsQuery::isAdmin($model->list_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("ListsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }

        new LogEvent("LIST_UPDATE", $model->list_id, "Actualizó la lista {ln}",
          [
            "ln" => $model->list_name
          ]
        );

        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("list"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("list/manage/update"));
      }
    }

    $this->layout          = "/layouts/update";
    $this->container_fluid = false;
    $this->current_title   = $model->list_name;

    $this->render("update", compact("model"));
  }

  public function actionDelete() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      if (!$id = Yii::app()->request->getPost("id"))
        throw new Exception("Metodo no permitido", 403);

      $model = ListsModel::model()->findByPk($id);

      if (!$model || !ListsQuery::isAdmin($model->list_id))
        throw new Exception("Metodo no permitido", 403);

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save())
        throw new Exception("La operación no pudo completarse correctamente", 500);

      new LogEvent("LIST_UPDATE", $model->list_id, "Eliminó la lista {ln}",
        [
          "ln" => $model->list_name
        ]
      );

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionUsers($id) {
    $model = ListsModel::model()->findByPk($id);

    if (!$model || !ListsQuery::isAdmin($model->list_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }
    
    $this->layout          = "/layouts/update";
    $this->container_fluid = false;
    $this->current_title   = "Asignar Usuarios";

    $this->render("users", compact("model"));
  }

  public function actionDevices($id) {
    $model = ListsModel::model()->findByPk($id);

    if (!$model || !ListsQuery::isAdmin($model->list_id)) {
      throw new CHttpException(404, "Página no encontrada");
    }
    
    $this->layout          = "/layouts/update";
    $this->container_fluid = false;
    $this->current_title   = "Asignar Dispositivos";

    $this->render("devices", compact("model"));
  }

  public function actionListUsersAdmin($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = UserQuery::getAllUnassignedListByRole(RolesQuery::getIdByKey("ADMIN"), $id);
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

      $users = UserQuery::getAllUnassignedListByRole(RolesQuery::getIdByKey("VISOR"), $id);
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

      $model = new ListUsersModel;

      $model->user_id = $post["user_id"];
      $model->list_id = $post["list_id"];
      $model->role_id = RolesQuery::getIdByKey("ADMIN");

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      new LogEvent("LIST_ASSIGN_USERS", $model->list_id, "Agregó al usuario {un} como administrador al listo {ln}",
        [
          "ln" => ListsQuery::getNameById($model->list_id),
          "un" => UserQuery::getFullNameByID($model->user_id)
        ]
      );

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

      $model = new ListUsersModel;

      $model->user_id = $post["user_id"];
      $model->list_id = $post["list_id"];
      $model->role_id = RolesQuery::getIdByKey("VISOR");

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      new LogEvent("LIST_ASSIGN_USERS", $model->list_id, "Agregó al usuario {un} como visualizador al listo {ln}",
        [
          "ln" => ListsQuery::getNameById($model->list_id),
          "un" => UserQuery::getFullNameByID($model->user_id)
        ]
      );

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionListAssignedUsersAdmin($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $users = ListsQuery::getAllAssignedUsersByRole($id, RolesQuery::getIdByKey("ADMIN"));
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"     => $user["listuser_id"],
            "name"   => "{$user["user_firstname"]} {$user["user_lastname"]}",
            "email"  => $user["user_email"],
            "img"    => $user["user_img_profile"],
            "active" => (bool) (Yii::app()->user->id == $user["user_id"])
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

      $users = ListsQuery::getAllAssignedUsersByRole($id, RolesQuery::getIdByKey("VISOR"));
      $data  = [];

      foreach ($users as $user) {
        $data[] = [
            "id"    => $user["listuser_id"],
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

      $model = ListUsersModel::model()->findByPk($post["id"]);

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("La operación no pudo completarse correctamente", 403);
      }

      new LogEvent("LIST_ASSIGN_USERS", $model->list_id, "Retiró al usuario {un} del listo {ln}",
        [
          "ln" => ListsQuery::getNameById($model->list_id),
          "un" => UserQuery::getFullNameByID($model->user_id)
        ]
      );

      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
