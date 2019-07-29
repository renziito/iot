<?php

class NavigationQuery {

  public static function getById($navigation_id) {
    return Yii::app()->db->createCommand()
            ->select()
            ->from("navigations")
            ->where("navigation_status = :status and status = :status and navigation_id = :id", [
              ":id"     => $navigation_id,
              ":status" => Globals::STATUS_ACTIVE
            ])
            ->queryRow();
  }

  public static function validateActive($controller, $action, $module) {
    $sql = "call sp_navigation_active(:controller,:action,:module);";

    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":controller", $controller, PDO::PARAM_STR);
    $command->bindParam(":action", $action, PDO::PARAM_STR);
    $command->bindParam(":module", $module, PDO::PARAM_STR);

    return $command->queryScalar();
  }

  public static function getDataByAction($action_id) {
    $sql     = "select n.* 
            from navigation_actions na
            inner join navigations n on(
                n.navigation_id = na.navigation_id
                and n.navigation_status is true
                and n.status is true
            )
            where na.status is true 
            and na.action_id = :action_id;";
    $command = Yii::app()->db->createCommand($sql);
    $command->bindParam(":action_id", $action_id, PDO::PARAM_INT);

    return $command->queryRow();
  }

  public static function getFavoritesByUserID($user_id) {
    return Yii::app()->db->createCommand()
            ->select()
            ->from("navigation_favorites")
            ->where("status is true")
            ->andWhere("user_id = :id", [":id" => $user_id])
            ->queryAll();
  }

  public static function validateFavorite($user_id, $url) {
    return Yii::app()->db->createCommand()
            ->select("navigationfavorite_id")
            ->from("navigation_favorites")
            ->where("status is true")
            ->andWhere("user_id = :id", [":id" => $user_id])
            ->andWhere("navigationfavorite_url = :url", [":url" => $url])
            ->queryScalar();
  }

}
