<?php

class LogEvent {

  private $_category;
  private $_code;
  private $_message;
  private $_params;

  public function __construct($category, $code, $message, $params = []) {
    $this->_category = $category;
    $this->_code     = $code;
    $this->_message  = $message;
    $this->_params   = $params;

    $this->create();
  }

  private function create() {
    $model = new LogEventsModel;

    $model->usersession_id   = Yii::app()->user->session_ID;
    $model->action_id        = $this->getCategory();
    $model->logevent_code    = $this->_code;
    $model->logevent_message = $this->_message;
    $model->logevent_params  = json_encode($this->_params);

    $model->logevent_date_created = Date::getDateTime();

    $model->save();
  }

  private function getCategory() {
    return ActionsQuery::getIdByKey($this->_category);
  }

}
