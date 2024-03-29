<?php

class ActionsQuery {

  public static function getIdByKey($action_key) {
    return Yii::app()->db->createCommand()
        ->select("action_id")
        ->from("rbac_actions")
        ->where("status = 1 and action_key = :key", [
            ":key" => $action_key
        ])
        ->queryScalar();
  }

  public static function getAll() {
    $command = Yii::app()->db->createCommand()
      ->select()
      ->from("rbac_actions a")
      ->join("rbac_group_actions ga", "ga.groupaction_id = a.groupaction_id")
      ->where("a.action_status = 1 and a.status = 1");

    $command->order("ga.groupaction_order,a.action_id");
    return $command->queryAll();
  }

  /**
   * search
   */
  public static function search($param) {
    $sql = "SELECT 
              datos.*
            FROM (
                  select 
                    a.action_id
                    ,ga.groupaction_id
                    ,ga.groupaction_name
                    ,a.action_name
                    ,a.action_key
                    ,a.action_description
                    ,concat(a.action_name,action_key,COALESCE(a.action_description,'')) as concatenado
                  from rbac_actions a
                  inner join rbac_group_actions ga on (
                    ga.groupaction_id = a.groupaction_id
                  )
                  where a.status = 1
                )as datos
            WHERE UPPER(datos.concatenado) LIKE UPPER(:term)
            ORDER BY {$param['column']} {$param['order']}";

    $term = ($param['term'] == "") ? '%%' : addcslashes($param['term'], '%_');

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":term", $term, PDO::PARAM_STR);

    return $command->queryAll();
  }

}
