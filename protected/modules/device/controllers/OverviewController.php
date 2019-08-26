<?php

class OverviewController extends Auth {

  public function actionIndex() {
    $this->current_title = "Lista de Dispositivos";
    $this->render("index");
  }

}
