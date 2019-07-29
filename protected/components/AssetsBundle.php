<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class AssetsBundle {

  public $js         = [];
  public $css        = [];
  public $depends    = [];
  public $controller = [];
  public $action     = [];
  private $class;

  public function __construct($controller) {
    $this->class = $controller;
    $this->normalize();
    $this->registerJS();
    $this->registerCSS();
    $this->registerDepends();
  }

  private function normalize() {
    $this->normalizeFile($this->js, 'js');
    $this->normalizeFile($this->css, 'css');

    foreach ($this->controller as $ctrls => &$obj) {
      $this->normalizeFile($obj['js'], 'js');
      $this->normalizeFile($obj['css'], 'css');
    }

    foreach ($this->action as $actns => &$obj) {
      $this->normalizeFile($obj['js'], 'js');
      $this->normalizeFile($obj['css'], 'css');
    }
  }

  private function normalizeFile(&$files_arr, $dir) {
    if (isset($this->class->module))
      foreach ($files_arr as $key => &$val)
        $val = $dir . '/modules/' . $this->class->module->id . '/' . $val;
    else
      foreach ($files_arr as $key => &$val)
        $val = $dir . '/' . $val;
  }

  private function registerJS() {
    if (!empty($this->controller) && isset($this->controller[$this->class->id]) && isset($this->controller[$this->class->id]["js"])) {
      $this->js = array_merge(
        $this->js, $this->controller[$this->class->id]["js"]);
    }
    if (!empty($this->action) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]["js"])) {
      $this->js = array_merge(
        $this->js, $this->action["{$this->class->id}.{$this->class->action->id}"]["js"]);
    }
  }

  private function registerCSS() {
    if (!empty($this->controller) && isset($this->controller[$this->class->id]) && isset($this->controller[$this->class->id]["css"])) {
      $this->css = array_merge(
        $this->css, $this->controller[$this->class->id]["css"]);
    }
    if (!empty($this->action) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]["css"])) {
      $this->css = array_merge(
        $this->css, $this->action["{$this->class->id}.{$this->class->action->id}"]["css"]);
    }
  }

  private function registerDepends() {
    if (!empty($this->controller) && isset($this->controller[$this->class->id]) && isset($this->controller[$this->class->id]["depends"])) {
      $this->depends = array_merge($this->depends, $this->controller[$this->class->id]["depends"]);
    }
    if (!empty($this->action) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]) && isset($this->action["{$this->class->id}.{$this->class->action->id}"]["depends"])) {
      $this->depends = array_merge($this->depends, $this->action["{$this->class->id}.{$this->class->action->id}"]["depends"]);
    }
  }

  public function register() {
    return [
        "baseUrl" => "static",
        "js"      => $this->js,
        "css"     => $this->css,
        "depends" => $this->depends
    ];
  }

}
