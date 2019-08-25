<?php

class ApiQuery {

  public static function getAllBanners() {
    return Yii::app()->db->createCommand()
        ->select("
          b.banner_id as bid
          ,b.banner_title as btitle
          ,b.banner_description as bdescription
          ,i.image_id as iid
          ,i.image_name as iname
        ")
        ->from("banners b")
        ->join("images i", "i.image_id = b.image_id")
        ->where("b.status = :status and b.active = :active", [
            ":status" => Globals::STATUS_ACTIVE,
            ":active" => Globals::STATUS_ACTIVE
        ])
        ->order("b.banner_order asc")
        ->queryAll();
  }

  public static function getAllContents() {
    return CardsQuery::getAll();
  }

  public static function getAllPartnes() {
    return PartnersQuery::getAll();
  }

}
