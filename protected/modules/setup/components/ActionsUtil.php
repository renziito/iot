<?php

class ActionsUtil {

  public static function group($actions = []) {
    $group = [];
    foreach ($actions as $key => $action) {
      $item[$action["groupaction_id"]][$action["action_id"]] = $action;

      $group[$action["groupaction_id"]] = [
          "name"  => $action["groupaction_name"],
          "items" => $item[$action["groupaction_id"]]
      ];
    }

    return $group;
  }

}
