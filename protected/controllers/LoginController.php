<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Controllers
 */
class LoginController extends Auth {

  public $layout = "//layouts/login";

  public function actionIndex($continue = false) {
    $this->render("index", ["model" => (new LoginModel), "continue" => $continue]);
  }

  public function actionValidate($continue = false) {

    if ($post = Yii::app()->request->getPost("LoginModel")) {
      $model = new LoginModel;
      $model->setAttributes($post);

      if ($model->validate() && $model->login()) {
        if ($continue)
          $this->redirect(rawurldecode($continue));

        $this->redirect(Yii::app()->createUrl("dashboard"));
      } else {
        yii::app()->user->setFlash("errorLogin", $model->errors);
        if ($continue)
          $this->redirect(["/login?continue=" . rawurlencode($continue)]);

        $this->redirect(["/login"]);
      }
    } else {
      throw new CHttpException(404, "Página No Encontrada");
    }
  }

  public function actionLogout() {
    if (!Yii::app()->user->isGuest) {
      UserQuery::closeSession(Yii::app()->user->id, Yii::app()->user->account_ID);
    }
    Yii::app()->user->logout(false);
    $this->redirect(["/login"]);
  }

  public function beforeAction($action) {
    if (!yii::app()->user->isGuest && ($this->action->id !== "logout")) {
      $this->redirect(Yii::app()->createUrl("dashboard"));
    }
    return true;
  }

}
