<?php

class RolesQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("rbac_roles")
        ->where("role_id <> 1 and status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

  public static function getIdByKey($role_key) {
    return Yii::app()->db->createCommand()
        ->select("role_id")
        ->from("rbac_roles")
        ->where("role_key = :key and status = :status", [
            ":status" => Globals::STATUS_ACTIVE,
            ":key"    => $role_key
        ])
        ->queryScalar();
  }

  public static function getAllActions($role_id) {
    return Yii::app()->db->createCommand()
        ->select()
        ->from("rbac_permissions")
        ->where("role_id = :id and permission_status = :status and status = :status", [
            ":id"     => $role_id,
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

  /**
   * search
   */
  public static function search($param) {
    $off = 0;
    if (Yii::app()->user->sudo) {
      $off = 1;
    }

    $sql = "SELECT 
              datos.*,
              {$off} as role_setting
            FROM (
                  select 
                    role_id
                    ,role_name
                    ,role_key
                    ,role_description
                    ,role_status
                    ,role_default
                    ,concat(role_name,role_key,COALESCE(role_description,'')) as concatenado
                  from rbac_roles
                  where status = 1
                )as datos
            WHERE role_id <> 1 AND UPPER(datos.concatenado) LIKE UPPER(:term)
            ORDER BY {$param['column']} {$param['order']}";

    $term = ($param['term'] == "") ? '%%' : addcslashes($param['term'], '%_');

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":term", $term, PDO::PARAM_STR);

    return $command->queryAll();
  }

}
