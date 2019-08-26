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

  public static function getAllNotAssignedDevice($device_id) {
    return Yii::app()->db->createCommand()
        ->select("
          r.responsable_id as rid
          ,r.responsable_name rname
          ,r.responsable_phone rphone
          ,r.responsable_position rposition
        ")
        ->from("responsables r")
        ->where("r.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->andWhere("not exists (select dr.responsable_id from device_responsables dr where dr.responsable_id = r.responsable_id and dr.status = 1 and dr.device_id = :id)", [
            ":id" => $device_id
        ])
        ->queryAll();
  }

}
