<?php

class CardsQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          card_id as cid
          ,card_title as ctitle
          ,card_description as cdescription
          ,card_order csort
        ")
        ->from("cards")
        ->where("status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

}
