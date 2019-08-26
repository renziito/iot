<?php

class VariableController extends Auth {

  public function actionIndex() {
    $this->current_title = "Lista de Variables";

    $this->render("index");
  }

  public function actionList() {
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);

      $data = TypeVariablesQuery::getAll();

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

  public function actionCreate() {
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("TypeVariablesModel")) {
      try {
        $model = new TypeVariablesModel();

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/variable"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/variable/create"));
      }
    }

    $this->current_title = "Nueva Variable";
    $this->render("create", ["model" => (new TypeVariablesModel())]);
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = TypeVariablesModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("TypeVariablesModel")) {
      try {

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/variable"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/variable/update/id/{$id}"));
      }
    }

    $this->current_title = $model->typevariable_denomination;
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

      $model = TypeVariablesModel::model()->findByPk($id);

      if (!$model) {
        throw new Exception("No hemos podido encontrar el registro", 500);
      }

      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }

      $data = [
          "vid" => $model->typevariable_id
      ];

      Response::JSON(false, 200, "La operación se completó exitosamente.", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
