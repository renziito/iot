<?php

class DevicesQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          d.device_id as did
          ,d.device_code as dcode
          ,d.device_serie as dserie
          ,d.device_latitude as dlatitude
          ,d.device_longitude as dlongitude
          ,d.device_number_modem as dmodemnumber
          ,d.device_provider_modem as dmodemprovider
          ,d.device_status as dstatus
          ,td.typedevice_denomination dtypename
          ,td.typedevice_id as dtypeid
          ,td.typedevice_modem as dtypmodem
        ")
        ->from("devices d")
        ->join("type_devices td", "td.typedevice_id = d.typedevice_id")
        ->where("d.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

  public static function getAllResponsables($device_id) {
    return Yii::app()->db->createCommand()
        ->select("
          dr.deviceresponsable_id as drid
          ,dr.device_id as did
          ,r.responsable_id as rid
          ,r.responsable_name rname
          ,r.responsable_phone rphone
          ,r.responsable_position rposition
        ")
        ->from("device_responsables dr")
        ->join("responsables r", "r.responsable_id = dr.responsable_id")
        ->where("dr.status = :status and dr.device_id = :id", [
            ":status" => Globals::STATUS_ACTIVE,
            ":id"     => $device_id
        ])
        ->queryAll();
  }

}
