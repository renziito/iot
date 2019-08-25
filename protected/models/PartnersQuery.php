<?php

class PartnersQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          p.partner_id as pid
          ,p.partner_name as pname
          ,p.partner_description as pdescription
          ,p.partner_url as purl
          ,p.image_id  as iid
          ,i.image_name as iname
        ")
        ->from("partners p")
        ->join("images i", "i.image_id = p.image_id")
        ->where("p.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->queryAll();
  }

}
