<?php

class OverviewController extends Auth {

  public function actionIndex() {
    $this->container_fluid = false;
    $this->render("index");
  }

}
