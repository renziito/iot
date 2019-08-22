<?php

class ManageController extends Auth {

  public function actionCreate() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$post = Yii::app()->request->getPost("ResponsablesModel")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = new ResponsablesModel;

      $model->setAttributes($post);

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "rid"       => $model->responsable_id,
          "rname"     => $model->responsable_name,
          "rposition" => $model->responsable_position,
          "rphone"    => $model->responsable_phone
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionUpdate() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$post = Yii::app()->request->getPost("ResponsablesModel")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = ResponsablesModel::model()->findByPk($post["responsable_id"]);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->setAttributes($post);

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "rid"       => $model->responsable_id,
          "rname"     => $model->responsable_name,
          "rposition" => $model->responsable_position,
          "rphone"    => $model->responsable_phone
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionDelete() {
    if (!Yii::app()->request->isAjaxRequest) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      if (!$id = Yii::app()->request->getPost("id")) {
        throw new Exception("Método no permitido", 500);
      }

      $model = ResponsablesModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "rid" => $model->responsable_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
