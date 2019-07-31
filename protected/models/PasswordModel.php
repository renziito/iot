<?php

class PasswordModel extends CFormModel {

  public $password;
  public $new_password;
  public $confirm_new_password;

  public function rules() {
    return array(
        array('password,new_password,confirm_new_password', 'required'),
        array('new_password', 'length', 'min' => 6),
        array('new_password', 'length', 'max' => 20),
        array('password', 'compare'),
        array('new_password', 'confirm'),
        array('new_password', 'must_not_same')
    );
  }

  public function attributeLabels() {
    return array(
        'password'             => 'Contraseña Actual',
        'new_password'         => 'Contraseña Nueva',
        'confirm_new_password' => 'Confirmar Contraseña Nueva',
    );
  }

  public function confirm() {
    if ($this->new_password != $this->confirm_new_password) {
      $this->addError('confirm_new_password', "La nueva contraseña no coincide");
    }
  }

  public function must_not_same() {
    if ($this->password == $this->new_password) {
      $this->addError('new_password', "La nueva contraseña no debe ser igual a la actual");
    }
  }

  public function compare() {
    $password = UserQuery::getPassword(Yii::app()->user->id);
    if (!password_verify($this->password, $password)) {
      $this->addError('password', "La contraseña actual es incorrecta.");
    }
  }

}
