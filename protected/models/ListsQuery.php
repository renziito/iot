<?php

class ListsQuery {

  public static function getAll() {
    $command = Yii::app()->db->createCommand()
      ->select("
          l.list_name as name
          ,l.list_code as code
          ,l.list_resumen as description
          ,l.list_id as id
          ")
      ->from("lists l");

    if (!Yii::app()->user->sudo) {
      $user_id = Yii::app()->user->id;
      $role_id = RolesQuery::getIdByKey("ADMIN");
      $command->join("list_users lu", "lu.list_id = l.list_id and lu.user_id = :user_id and lu.status = 1 and lu.role_id = :role_id", [
          ":user_id" => $user_id,
          ":role_id" => $role_id
      ]);
    }
    $command->where("l.status = 1");


    return $command->queryAll();
  }

  public static function getNameById($list_id) {
    return Yii::app()->db->createCommand()
        ->select("list_name")
        ->from("lists lu")
        ->where("lu.list_id = :id and lu.status = 1", [
            ":id" => $list_id
        ])
        ->queryScalar();
  }

  public static function getAllAssignedUsersByRole($list_id, $role_id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("list_users lu")
        ->join("vw_user vu", "vu.user_id = lu.user_id")
        ->where("lu.list_id = :id and lu.role_id = :role_id and lu.status = 1", [
            ":id"      => $list_id,
            ":role_id" => $role_id
        ])
        ->queryAll();
  }

  public static function isAdmin($list_id) {

    if (Yii::app()->user->sudo) {
      return true;
    }

    $user_id = Yii::app()->user->id;
    $role_id = RolesQuery::getIdByKey("ADMIN");

    $command = Yii::app()->db->createCommand()
      ->select("list_id")
      ->from("list_users")
      ->where("status = 1 and list_id = :list_id and role_id = :role_id and user_id = :user_id", [
          ":list_id" => $list_id,
          ":user_id"    => $user_id,
          ":role_id"    => $role_id
      ])
      ->queryScalar();

    if (!$command) {
      return false;
    }

    return true;
  }

  public static function asignedAdminitratorToAll($user_id) {
    $status        = new stdClass();
    $status->error = false;

    try {
      $lists = self::getAll();

      foreach ($lists as $list) {
        $model = new ListUsersModel;

        $model->user_id    = $user_id;
        $model->list_id = $list["id"];
        $model->role_id    = RolesQuery::getIdByKey("ADMIN");

        if (!$model->save()) {
          throw new Exception("La operación no pudo completarse correctamente", 500);
        }
      }
    } catch (Exception $ex) {
      $status->error   = new stdClass();
      $status->code    = $ex->getCode();
      $status->message = $ex->getMessage();
    }

    return $status;
  }

  public static function unasignedToAllByRole($user_id, $role_id) {
    $status        = new stdClass();
    $status->error = false;

    try {
      $lists = ListUsersModel::model()->updateAll([
          "status" => Globals::STATUS_INACTIVE
        ], "user_id = :user_id and role_id = :role_id and status = 1", [
          ":user_id" => $user_id,
          ":role_id" => $role_id
      ]);

      if (!is_null($lists) || $lists === FALSE) {
        throw new Exception("La operación no pudo completarse correctamente", 500);
      }
    } catch (Exception $ex) {
      $status->error   = new stdClass();
      $status->code    = $ex->getCode();
      $status->message = $ex->getMessage();
    }

    return $status;
  }

}
