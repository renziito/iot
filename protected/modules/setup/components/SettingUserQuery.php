<?php

class SettingUserQuery {

  public static function getAll() {
    return Yii::app()->db->createCommand()
        ->select("
            vu.user_id as id
            ,vu.role_name as r_name
            ,vu.user_firstname as firstname
            ,vu.user_lastname as lastname
            ,vu.user_username as usrname
            ,vu.user_email as email
            ,vu.user_date_lastlogin as lastlogin
            ,vu.user_date_registered as date_registered
            ,vu.user_date_updated as date_updated
            ,vu.user_img_profile as img_profile
            ,vu.user_status as status")
        ->from("vw_user vu")
        ->where("vu.role_id <> 1")
        ->queryAll();
  }

}
