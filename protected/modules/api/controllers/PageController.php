<?php

class PageController extends Auth {

  public function actionBanners() {
    $data = ApiQuery::getAllBanners();

    foreach ($data as $row => $item) {
      $data[$row]["iurl"] = Utils::buildUrlThumbnail("storage/images", $item["iname"], "MD");
    }

    Response::JSON(false, 200, "success", compact("data"));
  }

  public function actionPartners() {
    $data = ApiQuery::getAllPartnes();

    foreach ($data as $row => $item) {
      $data[$row]["iurl"] = Utils::buildUrlThumbnail("storage/images", $item["iname"], "MD");
    }

    Response::JSON(false, 200, "success", compact("data"));
  }

  public function actionContents() {
    $data = ApiQuery::getAllContents();

    Response::JSON(false, 200, "success", compact("data"));
  }
  
  public function actionLists() {
    $data = ApiQuery::getAllLists();

    Response::JSON(false, 200, "success", compact("data"));
  }

}
