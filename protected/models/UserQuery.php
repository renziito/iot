<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Models
 */
class UserQuery {

  public static function getAllByRole($role_id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user u")
        ->where("u.role_id = :role_id", [":role_id" => $role_id])
        ->queryAll();
  }

  public static function getAllUnassignedProjectByRole($role_id, $project_id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user u")
        ->where("u.role_id = :role_id and u.user_id not in (select user_id from project_users pu where pu.project_id = :project_id and pu.status = 1)", [
            ":role_id"    => $role_id,
            ":project_id" => $project_id
        ])
        ->queryAll();
  }

  public static function getByID($id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user u")
        ->where("u.user_id = :id", [":id" => $id])
        ->queryRow();
  }
  
  public static function getFullNameByID($id) {
    return Yii::app()->db->createCommand()
        ->select("concat(u.user_firstname,' ',u.user_lastname) as user_fullname")
        ->from("users u")
        ->where("u.user_id = :id and status = 1", [":id" => $id])
        ->queryScalar();
  }

  public static function getByEmail($email) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user u")
        ->where("u.user_email = :email", [":email" => $email])
        ->queryRow();
  }

  public static function getByUsername($username) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user u")
        ->where("u.user_username = :username", [":username" => $username])
        ->queryRow();
  }

  public static function getPassword($id) {
    return Yii::app()->db->createCommand()
        ->select("u.user_password")
        ->from("users u")
        ->where("u.user_id = :id", [":id" => $id])
        ->andWhere("u.status = :status", [":status" => Globals::STATUS_ACTIVE])
        ->queryScalar();
  }

  public static function getRoleByID($id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user_roles")
        ->where("user_id = :id", [":id" => $id])
        ->andWhere("userrole_status = 1")
        ->queryRow();
  }

  public static function getNavigationByRole($id, $role_id) {
    if (Yii::app()->user->sudo) {
      $sql = "select n.*, na.action_id
              from navigations n
              inner join navigation_actions na on (na.navigation_id = n.navigation_id and na.status = 1)
              where n.navigation_status = 1
              and n.status = 1
              order by 
                n.navigation_level
                ,n.navigation_order
                ,n.navigation_depends;";
    } else {
      $sql = "call sp_user_navigation(:user_id,:role_id);";
    }

    $command = Yii::app()->db->createCommand($sql);
    if (!Yii::app()->user->sudo) {
      $command->bindParam(":user_id", $id, PDO::PARAM_INT);
      $command->bindParam(":role_id", $role_id, PDO::PARAM_INT);
    }

    return $command->queryAll();
  }

  public static function getPermission($id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("vw_user_role_permissions")
        ->where("user_id = :id", [":id" => $id])
        ->andWhere("role_status = 1 and permission_status = 1 and action_status = 1")
        ->queryAll();
  }

  public static function validatePermissionByActionKey($id, $actions = []) {
    $in_build    = [];
    $andWhere    = "";
    $value_build = [];

    if (Yii::app()->user->sudo) {
      return true;
    }

    foreach ($actions as $key => $action) {
      $in_build[]                    = ":action_{$key}";
      $value_build[":action_{$key}"] = $action;
    }

    if (count($in_build) > 0)
      $andWhere = "action_key in (" . implode(",", $in_build) . ")";


    $query = Yii::app()->db->createCommand()
      ->select("count(*) as total")
      ->from("vw_user_role_permissions")
      ->where("user_id = :id", [":id" => $id])
      ->andWhere("role_status = 1 and permission_status = 1 and action_status = 1")
      ->andWhere($andWhere, $value_build);

    return $query->queryScalar();
  }

  public static function validateUsername($username) {
    $sql     = "call sp_user_auth(:username);";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindValue(":username", $username, PDO::PARAM_STR);

    return $command->queryRow();
  }

  public static function createSession($params) {
    $model = new UserSessionsModel;
    $model->setAttributes($params);
    $model->save();
    return $model;
  }

  public static function closeSession($user_id, $token) {
    return Yii::app()->db->createCommand()
        ->update("user_sessions", ["usersession_status" => 0], "user_id = :user_id and usersession_token = :token", [":user_id" => $user_id, ":token" => $token]
    );
  }

  public static function closeAllSessions($user_id) {
    return Yii::app()->db->createCommand()
        ->update("user_sessions", ["usersession_status" => 0], "user_id = :user_id and usersession_status = 1 and status = 1", [":user_id" => $user_id]
    );
  }

  public static function getSessionByToken($token) {
    return Yii::app()->db->createCommand()
        ->from("user_sessions")
        ->where("status = 1 and usersession_token = :token", [":token" => $token])
        ->queryRow();
  }

}
