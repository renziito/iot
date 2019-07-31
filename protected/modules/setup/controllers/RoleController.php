<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RoleController extends Auth {

  /**
   * Index
   */
  public function actionIndex() {
    $this->current_title = "Roles";
    $this->render("index");
  }

  public function actionSetting($id) {
    $model = RolesModel::model()->findByPk($id);
    if (!$model || $id == 1) {
      throw new CHttpException("Página no encontrada", 404);
    }

    $this->current_title   = $model->role_name;
    $this->container_fluid = false;

    $this->render("setting", compact("model"));
  }

  /**
   * list
   */
  public function actionList() {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Acceso no autorizado", 403);
      }

      $params['column'] = Yii::app()->request->getQuery('sort', "role_id");
      $params['order']  = Yii::app()->request->getQuery('order', 'asc');
      $params['term']   = Yii::app()->request->getQuery('search', "");

      $data = RolesQuery::search($params);

      Response::JSON(FALSE, 200, "Roles obtenidos exitosamente", compact("data"));
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

      $post = Yii::app()->request->getPost("Role");

      $model = new RolesModel();
      if ($post['id'] != "") {
        $model = RolesModel::model()->findByPk($post['id']);
      }
      $model->attributes = $post;

      if (!$model->save()) {
        throw new Exception("Error al guardar el registro en bd - " . Utils::handleErrorValidation($model), 900);
      }

      Response::JSON(FALSE, 200, "Rol creado exitosamente", []);
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

      $post = Yii::app()->request->getPost("Role");
      if ($post['id'] != "") {
        $model         = RolesModel::model()->findByPk($post['id']);
        $model->status = 0;

        if (!$model->update()) {
          throw new Exception("Error al eliminar el registro en bd - " . Utils::handleErrorValidation($model), 900);
        }
      }

      Response::JSON(FALSE, 200, "Rol eliminado exitosamente", []);
    } catch (Exception $exc) {
      Response::JSON(TRUE, $exc->getCode(), $exc->getMessage());
    }
  }

  public function actionSavePermission($id) {
    try {
      if (!Yii::app()->request->isAjaxRequest) {
        throw new Exception("Método no permitido", 403);
      }

      if (!$action = Yii::app()->request->getPost("action")) {
        throw new Exception("Método no permitido", 403);
      }
      
      $sudo = (in_array(Yii::app()->user->role()->role_key, Yii::app()->authManager->defaultRoles));
      $role = RolesModel::model()->findByPk($id);

      if (!$role || ($role->role_default == 1 && !$sudo)) {
        throw new Exception(" No tiene los permisos suficientes para realizar esta acción.", 403);
      }

      $model = PermissionsModel::model()->find("status is true and role_id = :role_id and action_id = :action_id", [
          ":role_id"   => $id,
          ":action_id" => $action["id"]
      ]);

      if (!$model) {
        $model            = new PermissionsModel;
        $model->role_id   = $id;
        $model->action_id = $action["id"];
      } else {
        $model->permission_status = $action["status"];
      }

      if (!$model->save()) {
        throw new Exception("No se pudo asignar la acción al rol seleccionado", 500);
      }

      $message = "Acción retirada correctamente";
      if ($action["status"])
        $message = "Acción asignada correctamente";

      Response::JSON(FALSE, 200, $message, []);
    } catch (Exception $ex) {
      Response::JSON(TRUE, $ex->getCode(), $ex->getMessage());
    }
  }

}
