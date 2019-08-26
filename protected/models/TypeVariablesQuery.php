<?php

class TypeVariablesQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          v.typevariable_id as vid
          ,v.typevariable_denomination as vdenomination
          ,v.typevariable_key as vkey
          ,v.active
        ")
        ->from("type_variables v")
        ->where("v.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

  public static function getAllNotAsigned($typedevice_id) {
    return Yii::app()->db->createCommand()
        ->select("
          v.typevariable_id as vid
          ,v.typevariable_denomination as vdenomination
          ,v.typevariable_key as vkey
          ,v.active
        ")
        ->from("type_variables v")
        ->where("v.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->andWhere("not exists (select tdv.typedevicevariable_id from type_device_variables tdv where tdv.typevariable_id = v.typevariable_id and tdv.typedevice_id = :id and tdv.status = :estado)",[
            ":id" => $typedevice_id,
            ":estado" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

}
