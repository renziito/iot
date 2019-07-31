<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Extensions\User
 */
class UserManager extends CWebUser {

  public $logoutUrl;

  public function init() {
    parent::init();
    $this->logoutUrl = Yii::app()->baseUrl . "/logout";
    $this->loginUrl  = Yii::app()->baseUrl . "/{$this->loginUrl}";

    if (
      (!$this->isGuest && APP_ENVIROMENT == Environments::DEVELOPMENT) ||
      ($this->isGuest && APP_ENVIROMENT == Environments::DEVELOPMENT)
    ) {
      defined('APP_DEBUG') or define('APP_DEBUG', true);
    } else {
      defined('APP_DEBUG') or define('APP_DEBUG', false);
    }

    if (!$this->getIsGuest() && !$this->checkStatus()) {
      $this->logout(false);
      Yii::app()->request->redirect(Yii::app()->request->hostInfo . $this->logoutUrl);
    }
  }

  public function role() {
    $role = UserQuery::getRoleByID($this->id);
    return (object) $role;
  }

  private function checkStatus() {
    $sessionActive = UserQuery::getSessionByToken($this->getState("account_ID"));
    if (
      $sessionActive &&
      $sessionActive["usersession_status"] == Globals::STATUS_ACTIVE &&
      strtotime('now') <= (new DateTime($sessionActive["usersession_date_expired"]))->format("U")
    ) {
      return true;
    }

    return false;
  }

  public function checkAccess($operation, $params = array(), $allowCaching = true) {
    if (is_string($operation)) {
      return ($this->role()->role_key == $operation);
    } elseif (is_array($operation)) {
      return UserQuery::validatePermissionByActionKey($this->id, $operation);
    } else {
      parent::checkAccess($operation, $params, $allowCaching);
    }
  }

}
