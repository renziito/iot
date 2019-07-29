<?php

class PasswordController extends Auth {

  public function actionIndex() {
    $model = new PasswordModel;
    $this->render("index", compact("model"));
  }

  public function actionUpdate() {

    if (!$post = Yii::app()->request->getPost("PasswordModel")) {
      $this->redirect(Yii::app()->baseUrl);
    }

    $errors      = [];
    $transaction = Yii::app()->db->beginTransaction();
    try {
      $model = new PasswordModel;
      $model->setAttributes($post);
      if (!$model->validate())
        throw new Exception(json_encode($model->getErrors()), 900);

      $user = UsersModel::model()->findByPk(Yii::app()->user->id);

      $user->user_password     = password_hash($model->new_password, PASSWORD_DEFAULT);
      $user->user_date_updated = date("Y-m-d H:i:s");

      if (Yii::app()->user->change_password)
        $user->user_must_change_password = Globals::STATUS_INACTIVE;

      if (!$user->save())
        throw new Exception(json_encode($model->getErrors()), 900);

      if (Yii::app()->user->change_password)
        Yii::app()->user->setState("change_password", Globals::STATUS_INACTIVE);

      $transaction->commit();
      Yii::app()->user->setFlash('success', 'La contraseña ha sido cambiada exitosamente');
      $this->redirect(Yii::app()->baseUrl);
    } catch (Exception $ex) {
      $transaction->rollback();
      Console::log($ex->getMessage(),true);
      yii::app()->user->setFlash("errorChangePassword", $ex->getMessage());
      $this->redirect(Yii::app()->createUrl("changePassword"));
    }
  }

}
