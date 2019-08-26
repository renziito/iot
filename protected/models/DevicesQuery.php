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

}
