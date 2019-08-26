<?php
$id = Utils::_get("id");

$tabs = [
    [
        "name"   => "Datos Generales",
        "url"    => Yii::app()->createUrl("list/manage/update/id/{$id}"),
        "active" => ($this->module->id == "list" && $this->id == "manage" && $this->action->id == "update")
    ],
    [
        "name"   => "Usuarios",
        "url"    => Yii::app()->createUrl("list/manage/users/id/{$id}"),
        "active" => ($this->module->id == "list" && $this->id == "manage" && $this->action->id == "users")
    ],
    [
        "name"   => "Responsables",
        "url"    => Yii::app()->createUrl("list/responsable/index/id/{$id}"),
        "active" => ($this->module->id == "list" && $this->id == "responsable")
    ],
    [
        "name"   => "Dispositivos",
        "url"    => Yii::app()->createUrl("list/manage/devices/id/{$id}"),
        "active" => ($this->module->id == "list" && $this->id == "manage" && $this->action->id == "devices")
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