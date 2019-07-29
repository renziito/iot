<?php

class UserController extends Auth {

  public function actionIndex() {
    $this->link_favorites = true;
    $this->current_title = "Usuarios";
    $this->render("index");
  }

  public function actionList() {
    try {

      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = SettingUserQuery::getAll();

      foreach ($data as $key => $row) {
        $data[$key]["img_profile"] = User::buildImagenProfiler($row["img_profile"], "XS");
      }

      Response::JSON(FALSE, 200, "success data", ["data" => $data]);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionCreate() {
    $this->link_favorites = true;
    $this->current_title   = "Nuevo Usuario";
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("UsersModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model = new UsersModel;
        $model->setAttributes($post);

        if ($dataEmail = UserQuery::getByEmail($model->user_email)) {
          throw new Exception("El correo electrónico <strong>{$model->user_email}</strong> ya fue registrado con otro usuario (ID: {$dataEmail["user_id"]}).", 500);
        }

        if ($dataUsername = UserQuery::getByUsername($model->user_username)) {
          throw new Exception("El nombre de usuario <strong>{$model->user_username}</strong> ya fue registrado (ID: {$dataEmail["user_id"]}).", 500);
        }

        $model->user_password        = password_hash($model->user_password, PASSWORD_DEFAULT);
        $model->user_date_registered = Date::getDateTime();

        if (!$model->save())
          throw new Exception("No se pudo crear el usuario {$model->user_username}", 500);

        $modelRole = new UserRolesModel;

        $modelRole->user_id = $model->user_id;
        $modelRole->role_id = $post["role_id"];

        if (!$modelRole->save())
          throw new Exception("No se pudo crear el usuario {$model->user_username}", 500);

        $transaction->commit();

        FirebaseConsole::set(strtotime("now"), Utils::templateNotification("success", "Ha creado un nuevo usuario"));

        if (isset($post["send_mail"]) && $post["send_mail"] == Globals::STATUS_ACTIVE) {
          $mailer = Mailer::send($model->user_email, "La contraseña de su cuenta es: {$post["user_password"]}", "Bienvenido {$model->user_firstname}");

          if (!$mailer["estado"]) {
            Yii::app()->user->setFlash("warning", "El usuario <strong>{$model->user_username}</strong> ha sido creado correctamente pero no se logró enviar el correo: {$mailer["mensaje"]}");
          } else {
            Yii::app()->user->setFlash("success", "El usuario <strong>{$model->user_username}</strong> ha sido creado correctamente");
          }
        }
        $this->redirect(Yii::app()->createUrl("setup/user"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setup/user/create"));
      }
    }

    $model = new UsersModel;
    $this->render("create", compact("model"));
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = UsersModel::model()->findByPk($id);

    if (!$model) {
      $this->redirect(Yii::app()->createUrl("setup/user"));
    }

    if ($post = Yii::app()->request->getPost("UsersModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {

        if ($model->user_email != $post["user_email"]) {
          if ($dataEmail = UserQuery::getByEmail($post["user_email"]))
            throw new Exception("El correo electrónico <strong>{$post["user_email"]}</strong> ya fue registrado con otro usuario (ID: {$dataEmail["user_id"]}).", 500);
        }

        if ($model->user_username != $post["user_username"]) {
          if ($dataUsername = UserQuery::getByUsername($post["user_username"]))
            throw new Exception("El nombre de usuario <strong>{$post["user_username"]}</strong> ya fue registrado (ID: {$dataEmail["user_id"]}).", 500);
        }

        $model->user_firstname    = $post["user_firstname"];
        $model->user_lastname     = $post["user_lastname"];
        $model->user_username     = $post["user_username"];
        $model->user_email        = $post["user_email"];
        $model->user_status       = $post["user_status"];
        $model->user_date_updated = Date::getDateTime();

        if (!$model->save())
          throw new Exception("No se pudo actualizar el usuario {$model->user_username}", 500);

        $modelRole = UserRolesModel::model()->find("user_id = :id and userrole_status = 1 and status = 1", [":id" => $model->user_id]);

        $modelRole->role_id = $post["role_id"];

        $transaction->commit();

        FirebaseConsole::set(strtotime("now"), Utils::templateNotification("success", "Actualizó un usuario"));

        Yii::app()->user->setFlash("success", "El usuario <strong>{$model->user_username}</strong> ha sido actualizado correctamente");
        $this->redirect(Yii::app()->createUrl("setup/user"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setup/user/update/id/{$id}"));
      }
    }

    $this->current_title = "{$model->user_firstname} {$model->user_lastname}";
    $this->render("update", compact("model"));
  }

  public function actionChangeStatus($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Método no permitido", 403);

      if (!$status = Yii::app()->request->getPost("status"))
        throw new Exception("Parámetros enviados presentan errores. Intente nuevamente", 403);


      $model = UsersModel::model()->findByPk($id);

      if (!$model)
        throw new Exception("Método no permitido", 403);

      $model->user_status       = $status;
      $model->user_date_updated = Date::getDateTime();

      if (!$model->save())
        throw new Exception("No se pudo desactivar al usuario <strong>{$model->user_username}</strong>", 403);

      UserQuery::closeAllSessions($id);

      Response::JSON(FALSE, 200, "Los datos del usuario <strong>{$model->user_username}</strong> han sido actualizados con éxito.", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionResetPassword($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Método no permitido", 403);

      if (!$post = Yii::app()->request->getPost("UserUpdate"))
        throw new Exception("Parámetros enviados presentan errores. Intente nuevamente", 403);
      
      $model = UsersModel::model()->findByPk($id);

      if (!$model)
        throw new Exception("Método no permitido", 403);

      $model->user_password = password_hash($post["new_password"], PASSWORD_DEFAULT);

      if (isset($post["must_change_password"]) && $post["must_change_password"] == Globals::STATUS_ACTIVE) {
        $model->user_must_change_password = $post["must_change_password"];
      }

      $model->user_date_updated = Date::getDateTime();

      if (!$model->save())
        throw new Exception("No se pudo reestablecer la contraseña correctamente", 403);

      $message = "Se reestableció la contraseña";
      if (isset($post["send_mail"]) && $post["send_mail"] == Globals::STATUS_ACTIVE) {
        $mailer = Mailer::send($model->user_email, "La contraseña de su cuenta es: {$post["new_password"]}", "Bienvenido {$model->user_firstname}");

        if (!$mailer["estado"]) {
          $message .= " pero no se pudo enviar el correo. ";
        }
      }

      UserQuery::closeAllSessions($id);

      Response::JSON(FALSE, 200, $message, []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionDelete($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Método no permitido", 403);

      $model = UsersModel::model()->findByPk($id);

      if (!$model)
        throw new Exception("Método no permitido", 403);

      $model->user_status       = Globals::STATUS_INACTIVE;
      $model->status            = Globals::STATUS_INACTIVE;
      $model->user_date_updated = Date::getDateTime();

      if (!$model->save())
        throw new Exception("No se pudo eliminar al usuario <strong>{$model->user_username}</strong>", 500);

      UserQuery::closeAllSessions($id);

      Response::JSON(FALSE, 200, "Usuario <strong>{$model->user_username}</strong> eliminado.", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionGetNewPassword() {
    Response::JSON(FALSE, 200, "generate new password success", ["new_password" => User::generateNewPassword()], true);
  }

}
