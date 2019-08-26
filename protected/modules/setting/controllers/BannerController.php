<?php

class BannerController extends Auth {

  public function actionIndex() {
    $this->container_fluid = false;
    $this->current_title   = "Lista de Banners";
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

        $image = Images::create($file);

        if ($image->error) {
          throw new Exception("No hemos podido guardar la imagen.", 500);
        }

        $model->setAttributes($post);
        $model->image_id = $image->data->image_id;

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación" . json_encode($model->getErrors()), 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/banner"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/banner/create"));
      }
    }

    $this->render("create", ["model" => (new BannersModel())]);
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = BannersModel::model()->findByPk($id);

    if (!$model || $model->status == Globals::STATUS_INACTIVE) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("BannersModel")) {
      try {

        $file = CUploadedFile::getInstance($model, "image_id");

        if ($file) {
          $image = Images::create($file);

          if ($image->error) {
            throw new Exception("No hemos podido guardar la imagen.", 500);
          }
          $model->image_id = $image->data->image_id;
        }


        $model->banner_title       = $post["banner_title"];
        $model->banner_description = $post["banner_description"];

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/banner"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/banner/update/id/{$id}"));
      }
    }

    $this->current_title = $model->banner_title;
    $this->render("update", compact("model"));
  }

  public function actionDelete($id) {
    $model = BannersModel::model()->findByPk($id);

    if (!$model || $model->status == Globals::STATUS_INACTIVE) {
      throw new CHttpException(404, "Página no encontrada");
    }

    $model->status = Globals::STATUS_INACTIVE;

    if (!$model->save()) {
      Yii::app()->user->setFlash("danger", "No se pudo completar la operación");
    } else {
      Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
    }
    $this->redirect(Yii::app()->createUrl("setting/banner"));
  }

  public function actionSort() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrá");
    }

    try {
      if (!$post = Yii::app()->request->getPost("BannersModel")) {
        throw Exception("Método no permitido", 500);
      }

      $order = 1;
      foreach ($post["order"] as $id) {
        $model = BannersModel::model()->findByPk($id);
        if ($model) {
          $model->banner_order = $order;

          if (!$model->save()) {
            
          }

          $order++;
        }
      }

      Response::JSON(false, 200, "success");
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
