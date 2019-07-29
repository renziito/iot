<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Models
 */
class LoginModel extends CFormModel {

  public $username;
  public $password;
  public $rememberMe;
  private $_identity;

  /**
   * Declares the validation rules.
   * The rules state that username and password are required,
   * and password needs to be authenticated.
   */
  public function rules() {
    return array(
        // username and password are required
        array('username, password', 'required'),
        // rememberMe needs to be a boolean
        array('rememberMe', 'boolean'),
        // password needs to be authenticated
        array('password', 'authenticate'),
    );
  }

  /**
   * Declares attribute labels.
   */
  public function attributeLabels() {
    return array(
        'username'   => 'NOMBRE DE USUARIO',
        'password'   => 'CONTRASEÑA',
        'rememberMe' => 'Remember me next time',
    );
  }

  /**
   * Authenticates the password.
   * This is the 'authenticate' validator as declared in rules().
   */
  public function authenticate($attribute, $params) {
    if (!$this->hasErrors()) {
      $this->_identity = new UserIdentity($this->username, $this->password);
      if ($this->_identity->authenticate() !== 0)
        $this->addError('password', $this->_identity->message);
    }
  }

  /**
   * Logs in the user using the given username and password in the model.
   * @return boolean whether login is successful
   */
  public function login() {
    if ($this->_identity === null) {
      $this->_identity = new UserIdentity($this->username, $this->password);
      $this->_identity->authenticate();
    }
    if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
      $duration = $this->rememberMe ? 60 * 60 * 24 : 60 * 60 * 1;
      Yii::app()->user->login($this->_identity, $duration);
      return true;
    } else
      return false;
  }

}
