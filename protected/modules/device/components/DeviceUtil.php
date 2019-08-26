<?php

class DeviceUtil {

  public static function listStatus() {
    return [
        DeviceConst::STATUS_ACTIVE      => "Operativo",
        DeviceConst::STATUS_MAINTENANCE => "En mantenimiento",
        DeviceConst::STATUS_INACTIVE    => "Desactivado"
    ];
  }

  public static function listTypeDevice() {
    $data = [];

    foreach (TypeDevicesQuery::getAll() as $type) {
      $data[$type["did"]] = $type["ddenomination"];
    }

    return $data;
  }

}
