<?php

class OverviewController extends Auth {

  public function actionIndex() {
    $this->current_title = "Sistema de Información Climático";
    $this->render('index');
  }

}
