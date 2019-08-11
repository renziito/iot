<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class UserIdentity extends CUserIdentity {

  /**
   *
   * @var int 
   */
  private $_id;

  /**
   *
   * @var string 
   */
  public $message = '';

  /**
   * 
   * @return int
   */
  public function authenticate() {
    //Validar la existencia de la cuenta, si la cuenta está bloqueada temporal o permanentemente.
    $validate = UserQuery::validateUsername($this->username);
    
    //Si obtienen resultados y la cuenta existe y está activa
    if (!empty($validate) AND ! ((boolean) $validate['error'])) {
      //Validación de la contraseña
      if (password_verify($this->password, $validate['password'])) {

        $account_ID = Utils::token("sha1", "{$validate["user_id"]}~" . uniqid(), 40);
        $session    = UserQuery::createSession([
              "user_id"                     => $validate["user_id"],
              "usersession_token"           => $account_ID,
              "usersession_host"            => Utils::realIP(),
              "usersession_os"              => Yii::app()->browser->getPlatform(),
              "usersession_browser"         => Yii::app()->browser->getBrowser(),
              "usersession_browser_version" => Yii::app()->browser->getVersion(),
              "usersession_geoip"           => json_encode(Utils::geoIP(Utils::realIP())),
              "usersession_device"          => (Yii::app()->browser->isMobile()) ? "mobile" : "desktop",
              "usersession_date_expired"    => date_format(date_create(date('Y-m-d H:i:s', strtotime("+1 day", strtotime(Date::getDateTime())))), 'Y-m-d H:i:s')
        ]);

        if ($session) {
          $userInfo = UserQuery::getByID($validate["user_id"]);

          $userRole = UserQuery::getRoleByID($validate["user_id"]);
          $sudo = User::isSudo($userRole["role_key"]);

          $this->errorCode = self::ERROR_NONE;
          $this->_id       = $validate["user_id"];
          $this->setState("firstname", $userInfo["user_firstname"]);
          $this->setState("fullname", "{$userInfo["user_firstname"]} {$userInfo["user_lastname"]}");
          $this->setState("session_ID", $session->usersession_id);
          $this->setState("account_ID", $account_ID);
          $this->setState("sudo", $sudo);
          $this->setState("lastname", $userInfo["user_lastname"]);
          $this->setState("email", $userInfo["user_email"]);
          $this->setState("img_profile", $userInfo["user_img_profile"]);
          $this->setState("change_password", (boolean) $userInfo["user_must_change_password"]);
        } else {
          
        }
      } else {
        $this->errorCode = self::ERROR_PASSWORD_INVALID;
        $this->message   = "La contraseña es incorrecta, Vuelva a intentar.";
      }
    } else {
      $this->errorCode = self::ERROR_USERNAME_INVALID;
      $this->message   = $validate['message'];
    }

    return $this->errorCode;
  }

  /**
   * 
   * @return int
   */
  public function getId() {
    return $this->_id;
  }

}
