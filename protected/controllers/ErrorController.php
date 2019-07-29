<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Controllers
 */
class ErrorController extends Auth {

  public $defaultAction       = 'show';
  public $layout              = "//layouts/error";
  public $section_breadcrumbs = false;

  public function actionShow() {
    if ($error = Yii::app()->errorHandler->error) {
//      if (Yii::app()->request->isAjaxRequest) {
//        Response::JSON(TRUE, $error["code"], $error["message"], []);
//      } else {
        if ((int) $error["code"] == 403) {
          if (Yii::app()->user->change_password) {
            Yii::app()->request->redirect(Yii::app()->createUrl("/changePassword"));
          }
          $this->layout = "//layouts/main";
          $this->render("403", [
              'error' => $error
          ]);
        } elseif ((int) $error["code"] == 404) {
          $this->render("404", [
              'error' => $error
          ]);
        } else {
          $this->render("500", [
              'error' => $error
          ]);
        }
//      }
    } else {
      $this->redirect(Yii::app()->createUrl("dashboard"));
    }
  }

}
