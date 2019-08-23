<?php

class BannerController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionCreate() {
    $this->container_fluid = false;
    $this->current_title   = "Crear Banner";
    
    if ($post = Yii::app()->request->getPost("BannersModel")) {
      try {
        $model = new BannersModel;

        $file = CUploadedFile::getInstance($model, "image_id");

        if (!$file) {
          throw new Exception("No hemos podido encontrar el archivo seleccionado.", 500);
        }

        $image = Images::create($file, true);

        if ($image->error) {
          throw new Exception("No hemos podido guardar la imagen.", 500);
        }

        $model->setAttributes($post);
        $model->image_id = $image->image_id;

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }
        
        Yii::app()->user->setFlash("success", "Banner guarado correctamente.");
        $this->redirect(Yii::app()->createUrl("setting/banner"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/banner/create"));
      }
    }

    $this->render("create", ["model" => (new BannersModel())]);
  }

}
