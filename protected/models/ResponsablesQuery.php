<?php

class ResponsablesQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          responsable_id as rid
          ,responsable_name rname
          ,responsable_phone rphone
          ,responsable_position rposition
        ")
        ->from("responsables")
        ->where("status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

}
