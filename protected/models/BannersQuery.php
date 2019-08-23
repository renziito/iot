<?php

class BannersQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
          b.banner_id as bid
          ,b.banner_title as btitle
          ,b.banner_description as bdescription
          ,b.banner_order as bsort
          ,b.active
          ,i.image_id as iid
          ,i.image_name as iname
        ")
        ->from("banners b")
        ->join("images i", "i.image_id = b.image_id")
        ->where("b.status = :status", [
            ":status" => Globals::STATUS_ACTIVE
        ])
        ->order("b.banner_order asc")
        ->queryAll();
  }

}
