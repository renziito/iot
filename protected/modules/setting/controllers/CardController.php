<?php

class CardController extends Auth {

  public function actionIndex() {
    $this->current_title = "Lista de Contenido";

    $cards = CardsQuery::getAll();

    $this->render("index", compact("cards"));
  }

  public function actionCreate() {
    $this->container_fluid = false;

    if ($post = Yii::app()->request->getPost("CardsModel")) {
      try {
        $model = new CardsModel();

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/card"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/card/create"));
      }
    }

    $this->current_title = "Nuevo Contenido";
    $this->render("create", ["model" => (new CardsModel())]);
  }

  public function actionUpdate($id) {
    $this->container_fluid = false;

    $model = CardsModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException(404, "Página no encontrada");
    }

    if ($post = Yii::app()->request->getPost("CardsModel")) {
      try {

        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación", 500);
        }

        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("setting/card"));
      } catch (Exception $ex) {
        Yii::app()->user->setFlash("danger", $ex->getMessage());
        $this->redirect(Yii::app()->createUrl("setting/card/update/{$id}"));
      }
    }

    $this->current_title = $model->card_title;
    $this->render("update", compact("model"));
  }

  public function actionDelete($id) {
    $model = CardsModel::model()->findByPk($id);

    if (!$model || $model->status == Globals::STATUS_INACTIVE) {
      throw new CHttpException(404, "Página no encontrada");
    }

    try {
      $model->status = Globals::STATUS_INACTIVE;

      if (!$model->save()) {
        throw new Exception("No se pudo completar la operación", 500);
      }
      Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
    } catch (Exception $ex) {
      Yii::app()->user->setFlash("danger", $ex->getMessage());
    }
    $this->redirect(Yii::app()->createUrl("setting/card"));
  }

}
