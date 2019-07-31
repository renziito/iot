<?php

class ProjectsQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          project_name as name
          ,project_code as code
          ,project_resumen as description
          ,project_id as id
          ")
        ->from("projects")
        ->where("status = 1")
        ->queryAll();
  }

}
