<?php

class ManageController extends Auth {

  public function actionIndex() {
    $this->render("index");
  }

  public function actionCreate() {
    $this->container_fluid = false;
    $this->current_title   = "Crear Proyecto";

    $model = new ProjectsModel;
    if ($post  = Yii::app()->request->getPost("ProjectsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }
        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("project"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("project/manage/create"));
      }
    }
    $this->render("create", compact("model"));
  }

  public function actionUpdate($id) {
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException("Página no encontrada", 404);
    }
    
    if ($post  = Yii::app()->request->getPost("ProjectsModel")) {
      $transaction = Yii::app()->db->beginTransaction();
      try {
        $model->setAttributes($post);

        if (!$model->save()) {
          throw new Exception("No se pudo completar la operación");
        }
        $transaction->commit();
        Yii::app()->user->setFlash("success", "La operación se completó exitosamente.");
        $this->redirect(Yii::app()->createUrl("project"));
      } catch (Exception $ex) {
        $transaction->rollback();
        Yii::app()->user->setFlash("danger", "{$ex->getCode()}: {$ex->getMessage()}");
        $this->redirect(Yii::app()->createUrl("project/manage/update"));
      }
    }
    
    $this->container_fluid = false;
    $this->current_title   = $model->project_name;

    $this->render("update", compact("model"));
  }
  
  public function actionDelete(){
    try {
      if (!Yii::app()->request->isAjaxRequest)
        throw new Exception("Metodo no permitido", 403);
      
      if (!$id = Yii::app()->request->getPost("id"))
        throw new Exception("Metodo no permitido", 403);

      $model = ProjectsModel::model()->findByPk($id);
      
      if (!$model)
        throw new Exception("Metodo no permitido", 403);
      
      $model->status = Globals::STATUS_INACTIVE;
      
      if (!$model->save())
        throw new Exception("La operación no pudo completarse correctamente", 500);
      
      Response::JSON(FALSE, 200, "La operación se completó exitosamente.", []);
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }
  
  public function actionUsers($id){
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException("Página no encontrada", 404);
    }
    
    $this->container_fluid = false;
    $this->current_title   = "Asignar Usuarios";

    $this->render("users", compact("model"));
  }
  
  public function actionDevices($id){
    $model = ProjectsModel::model()->findByPk($id);

    if (!$model) {
      throw new CHttpException("Página no encontrada", 404);
    }
    
    $this->container_fluid = false;
    $this->current_title   = "Asignar Dispositivos";

    $this->render("devices", compact("model"));
  }

}
