<?php

class IotController extends Auth {

  public function actionDevices($api_key, $code) {
    try {

      if ($api_key . "=" !== base64_encode(hash_hmac("sha1", "demo", Globals::SECRET, true))) {
        throw new Exception("method not allowed", 403);
      }

      if (!$post = Yii::app()->request->getPost("iot")) {
        throw new Exception("method not allowed", 403);
      }

      if (!$id = DevicesQuery::getIdByCode($code)) {
        throw new Exception("method not allowed", 403);
      }

      $utc  = Date::getDateTime();
      $rows = 0;
      foreach ($post as $variable => $value) {
        $variable_id = TypeVariablesQuery::getIdByKey($variable);

        if ($variable_id) {
          $model = new DeviceActivitiesModel;

          $model->device_id            = $id;
          $model->deviceactivity_value = $value;
          $model->typevariable_id      = $variable_id;
          $model->date_created         = $utc;

          if (!$model->save()) {
            
          } else {
            $rows++;
          }
        }
      }

      $data = [
          "datetime"      => $utc,
          "total"         => count($post),
          "rows_affected" => $rows
      ];

      Response::JSON(FALSE, 200, "success", compact("data"));
    } catch (Exception $ex) {
      Response::Error($ex);
    }
  }

}
