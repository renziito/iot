<?php

class ProfileController extends Auth {

  public function actionIndex() {
    $model = UsersModel::model()->findByPk(Yii::app()->user->id);
    $this->render('index', compact("model"));
  }

  public function actionUpdate() {
    if (!$post = Yii::app()->request->getPost("UsersModel")) {
      $this->redirect(Yii::app()->baseUrl);
    }

    $transaction = Yii::app()->db->beginTransaction();
    try {
      $model = UsersModel::model()->findByPk(Yii::app()->user->id);
      $model->setAttributes($post);

      $file = CUploadedFile::getInstance($model, "user_img_profile");


      if ($file) {
        $path           = Yii::getPathOfAlias("webroot");
        $pathUser       = "storage/profiles";
        $pathUserFull   = $path . "/" . $pathUser;
        $nameImgProfile = Utils::token("sha1", $model->user_id, 10);
        $extImgProfile  = $file->getExtensionName();
        
        Folder::create($pathUserFull);

        if (!$file->saveAs($pathUserFull . "/{$nameImgProfile}.{$extImgProfile}")) {
          throw new Exception("La imagen de perfil no se ha guardado, intente nuevamente.", 500);
        }

        Images::thumbnail($pathUserFull, "{$nameImgProfile}.{$extImgProfile}", 35, "XS");
        Images::thumbnail($pathUserFull, "{$nameImgProfile}.{$extImgProfile}", 150, "SM");
        Images::thumbnail($pathUserFull, "{$nameImgProfile}.{$extImgProfile}", 300, "MD");

        $model->user_img_profile = "{$pathUser}/{thumb}/{$nameImgProfile}_{size}.{$extImgProfile}";
      }

      if (!$model->save()) {
        throw new Exception("No se pudo actualizar sus datos, intente nuevamente.", 500);
      }
      
      Yii::app()->user->setState("img_profile", $model->user_img_profile);

      $transaction->commit();
      Yii::app()->user->setFlash('success', 'Los datos se actualizaron correctamente');
      $this->redirect(Yii::app()->createUrl("user/profile"));
    } catch (Exception $ex) {
      $transaction->rollback();
      yii::app()->user->setFlash("danger", $ex->getMessage());
      $this->redirect(Yii::app()->createUrl("user/profile"));
    }
  }

  public function beforeAction($action) {
    if (Yii::app()->user->change_password) {
      Yii::app()->request->redirect(Yii::app()->createUrl("/changePassword"));
    }

    return true;
  }

}
