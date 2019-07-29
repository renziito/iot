<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class Builder extends CController {

  /**
   * @var string the default layout for the controller view. Defaults to '//layouts/column1',
   * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
   */
  public $layout = '//layouts/main';

  /**
   * @var array context menu items. This property will be assigned to {@link CMenu::items}.
   */
  public $menu = array();

  /**
   * @var array the breadcrumbs of the current page. The value of this property will
   * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
   * for more details on how to specify this property.
   */
  public $breadcrumbs         = [];
  public $section_breadcrumbs = true;
  public $link_favorites      = false;
  public $container_fluid     = true;
  public $current_title       = false;

  public function beforeAction($action) {
    if (
      !Yii::app()->user->isGuest &&
      $this->id != "password" &&
      (isset($this->module->id) && $this->module->id != "user")
    ) {

      if (Yii::app()->user->change_password) {
        Yii::app()->request->redirect(Yii::app()->createUrl("/changePassword"));
      }
    }
    return true;
  }

}
