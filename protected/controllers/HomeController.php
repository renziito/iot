<?php

class HomeController extends Auth {

  public $layout = "//layouts/landing";

  public function actionIndex() {
    $this->render("index");
  }

}
