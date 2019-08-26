<?php

class TypeDevicesQuery {

  public static function getByPk($typedevice_id) {
    return Yii::app()->db->createCommand()
        ->select("
          d.typedevice_id as did
          ,d.typedevice_denomination as ddenomination
          ,d.typedevice_origin as dorigin
          ,d.typedevice_modem as dmodem
          ,d.typedevice_maintenance_frequency as dmonth
        ")
        ->from("type_devices d")
        ->where("d.status = :status and d.typedevice_id = :id", [
            ":status" => Globals::STATUS_ACTIVE,
            ":id"     => $typedevice_id
        ])
        ->queryRow();
  }

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          d.typedevice_id as did
          ,d.typedevice_denomination as ddenomination
          ,d.typedevice_origin as dorigin
          ,d.typedevice_modem as dmodem
          ,d.typedevice_maintenance_frequency as dmonth
          ,(select count(tdv.typedevicevariable_id) from type_device_variables tdv where tdv.typedevice_id = d.typedevice_id and tdv.status = 1) as dvariable
        ")
        ->from("type_devices d")
        ->where("d.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

  public static function getAllVariables($typedevice_id) {
    return Yii::app()->db->createCommand()
        ->select("
          tdv.typedevicevariable_id dvid
          ,v.typevariable_id as vid
          ,v.typevariable_denomination as vdenomination
          ,v.typevariable_key as vkey
        ")
        ->from("type_device_variables tdv")
        ->join("type_variables v", "v.typevariable_id = tdv.typevariable_id")
        ->where("tdv.status = :status and tdv.typedevice_id = :id", [
            ":status" => Globals::STATUS_ACTIVE,
            ":id"     => $typedevice_id
        ])
        ->queryAll();
  }

}
