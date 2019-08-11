<?php

class ProjectsQuery {

  public static function getAll() {
    $command = Yii::app()->db->createCommand()
      ->select("
          p.project_name as name
          ,p.project_code as code
          ,p.project_resumen as description
          ,p.project_id as id
          ")
      ->from("projects p");

    if (!Yii::app()->user->sudo) {
      $user_id = Yii::app()->user->id;
      $role_id = RolesQuery::getIdByKey("ADMIN");
      $command->join("project_users pu", "pu.project_id = p.project_id and pu.user_id = :user_id and pu.status = 1 and pu.role_id = :role_id", [
          ":user_id" => $user_id,
          ":role_id" => $role_id
      ]);
    }
    $command->where("p.status = 1");


    return $command->queryAll();
  }

  public static function getNameById($project_id) {
    return Yii::app()->db->createCommand()
        ->select("project_name")
        ->from("projects pu")
        ->where("pu.project_id = :id and pu.status = 1", [
            ":id" => $project_id
        ])
        ->queryScalar();
  }

  public static function getAllAssignedUsersByRole($project_id, $role_id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("project_users pu")
        ->join("vw_user vu", "vu.user_id = pu.user_id")
        ->where("pu.project_id = :id and pu.role_id = :role_id and pu.status = 1", [
            ":id"      => $project_id,
            ":role_id" => $role_id
        ])
        ->queryAll();
  }

  public static function isAdmin($project_id) {

    if (Yii::app()->user->sudo) {
      return true;
    }

    $user_id = Yii::app()->user->id;
    $role_id = RolesQuery::getIdByKey("ADMIN");

    $command = Yii::app()->db->createCommand()
      ->select("project_id")
      ->from("project_users")
      ->where("status = 1 and project_id = :project_id and role_id = :role_id and user_id = :user_id", [
          ":project_id" => $project_id,
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
      $projects = self::getAll();

      foreach ($projects as $project) {
        $model = new ProjectUsersModel;

        $model->user_id    = $user_id;
        $model->project_id = $project["id"];
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
      $projects = ProjectUsersModel::model()->updateAll([
          "status" => Globals::STATUS_INACTIVE
        ], "user_id = :user_id and role_id = :role_id and status = 1", [
          ":user_id" => $user_id,
          ":role_id" => $role_id
      ]);

      if (!is_null($projects) || $projects === FALSE) {
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
