<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ActionController extends Auth {

  /**
   * Index
   */
  public function actionIndex() {
    $this->current_title = "Acciones";
    $this->render("index");
  }

  /**
   * list
   */
  public function actionlist() {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Acceso no autorizado", 403);
      }

      $params['column'] = Yii::app()->request->getQuery('sort', "action_id");
      $params['order']  = Yii::app()->request->getQuery('order', 'asc');
      $params['term']   = Yii::app()->request->getQuery('search', "");

      $data['data'] = ActionsQuery::search($params);

      Response::JSON(FALSE, 200, "Acciones obtenidas exitosamente", $data);
    } catch (Exception $exc) {
      Response::JSON(TRUE, $exc->getCode(), $exc->getMessage());
    }
  }

  /**
   * create
   */
  public function actionManage() {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Acceso no autorizado", 403);
      }

      $post = Yii::app()->request->getPost("Action");
      

      $model = new ActionsModel();
      if ($post['id'] != "") {
        $model = ActionsModel::model()->findByPk($post['id']);
      }
      $model->attributes = $post;

      if (!$model->save()) {
        throw new Exception("Error al guardar el registro en bd - " . Utils::handleErrorValidation($model), 900);
      }

      Response::JSON(FALSE, 200, "Acción creada exitosamente", []);
    } catch (Exception $exc) {
      Response::JSON(TRUE, $exc->getCode(), $exc->getMessage());
    }
  }

  /**
   * delete
   */
  public function actionDelete() {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Acceso no autorizado", 403);
      }

      $post = Yii::app()->request->getPost("Action");
      if ($post['id'] != "") {
        $model         = ActionsModel::model()->findByPk($post['id']);
        $model->status = 0;

        if (!$model->update()) {
          throw new Exception("Error al eliminar el registro en bd - " . Utils::handleErrorValidation($model), 900);
        }
      }

      Response::JSON(FALSE, 200, "Acción eliminada exitosamente", []);
    } catch (Exception $exc) {
      Response::JSON(TRUE, $exc->getCode(), $exc->getMessage());
    }
  }

}
