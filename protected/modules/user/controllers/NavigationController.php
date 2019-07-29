<?php

class NavigationController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionSaveFavorite() {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Método no permitido", 403);
      }

      $post = Yii::app()->request->getPost("favorite");
      if (!$post) {
        throw new Exception("Método no permitido", 403);
      }

      $model = new NavigationFavoritesModel;

      $model->user_id                 = Yii::app()->user->id;
      $model->navigationfavorite_name = $post["name"];
      $model->navigationfavorite_url  = $post["url"];

      if (!$model->save()) {
        throw new Exception("No se pudo guardar el acceso directo", 500);
      }
      Response::JSON(false, 200, "success", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
