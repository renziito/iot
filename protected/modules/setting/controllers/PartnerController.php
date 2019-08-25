<?php

class PartnerController extends Auth {

  public function actionIndex() {
    $this->current_title = "Lista de Instituciones";
    $this->render("index");
  }

  public function actionList() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = PartnersQuery::getAll();

      foreach ($data as $row => $item) {
        $data[$row]["iurl"] = Utils::buildUrlThumbnail("storage/images", $item["iname"], "XS");
      }

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionCreate() {
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("PartnersModel")) {
      try {
        $model = new PartnersModel;

        $file = CUploadedFile::getInstance($model, "image_id");

        if (!$file) {
          throw new Exception("No hemos podido encontrar el archivo seleccionado.", 500);
        }

        $image = Images::create($file, [
              "XS" => 50,
              "SM" => 100,
              "MD" => 150,
        ]);

        if ($image->error) {
          throw new Exception("No hemos podido guardar la imagen.", 500);
        }

        $model->setAttributes($post);
        $model->image_id = $image->data->image_id;

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/partner"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/partner/create"));
      }
    }

    $this->current_title = "Nueva Institución";
    $this->render("create", ["model" => (new PartnersModel())]);
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = PartnersModel::model()->findByPk($id);

    if (!$model || $model->status == Globals::STATUS_INACTIVE) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("PartnersModel")) {
      try {
        $file = CUploadedFile::getInstance($model, "image_id");

        if ($file) {
          $image = Images::create($file, [
                "XS" => 50,
                "SM" => 100,
                "MD" => 150,
          ]);

          if ($image->error) {
            throw new Exception("No hemos podido guardar la imagen.", 500);
          }

          $model->image_id = $image->data->image_id;
        }

        $model->partner_name        = $post["partner_name"];
        $model->partner_url         = $post["partner_url"];
        $model->partner_description = $post["partner_description"];

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación" . json_encode($model->getErrors()), 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/partner"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/partner/update/id/{$id}"));
      }
    }

    $this->current_title = $model->partner_name;
    $this->render("update", compact("model"));
  }

  public function actionDelete() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$id = Yii::app()->request->getPost("id")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = PartnersModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "pid" => $model->partner_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
