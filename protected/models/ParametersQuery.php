<?php

class ParametersQuery {

  public static function getAll($parameter_key) {
    return Yii::app()->db->createCommand()
        ->select("parameter_value, parameter_name")
        ->from("parameters")
        ->where("status is true")
        ->andWhere("parameter_key = :key", [":key" => $parameter_key])
        ->queryAll();
  }

}
