<?php
$id = Utils::_get("id");

$tabs = [
    [
        "name"   => "Datos Generales",
        "url"    => Yii::app()->createUrl("setting/device/update/id/{$id}"),
        "active" => ($this->module->id == "setting" && $this->id == "device" && $this->action->id == "update")
    ],
    [
        "name"   => "Variables",
        "url"    => Yii::app()->createUrl("setting/device/variables/id/{$id}"),
        "active" => ($this->module->id == "setting" && $this->id == "device" && $this->action->id == "variables")
    ]
];
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row justify-content-center">
  <div class="col-12">
    <div class="card mb-0">
      <div class="tab-primary pt-1">
        <ul class="nav nav-tabs" role="tablist">
          <?php foreach ($tabs as $tab): ?>
            <li class="nav-item">
              <a href="<?= $tab["url"] ?>" class="nav-link <?= ($tab["active"]) ? "active" : "" ?>"><?= $tab["name"] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?= $content ?>
<?php $this->endContent(); ?>