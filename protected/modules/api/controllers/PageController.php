<?php

class PageController extends Auth {

  public function actionBanners() {
    $data = ApiQuery::getAllBanners();
    
    foreach($data as $row => $item){
      $data[$row]["iurl"] = Utils::buildUrlThumbnail("storage/images", $item["iname"], "MD");
    }
    
    Response::JSON(false,200,"success", compact("data"));
  }

}
