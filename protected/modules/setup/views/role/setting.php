<?php
$this->breadcrumbs = [
    "Sistema" => Yii::app()->createUrl("setup"),
    "Roles"   => $this->createUrl("index"),
    "Configuración"
];
?>
<div class="row">
  <?php if (!Yii::app()->user->sudo && $model->role_default == 1): ?>
    <div class="col-12">
      <div class="alert alert-warning">
        La configuración del rol <strong><?= $model->role_name ?></strong> no puede ser edita por usted. No tiene los permisos suficientes para realizar esta acción.
      </div>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <div class="text-right mrg-btm-15">
      <a href="<?= Yii::app()->createUrl("setup/role") ?>" class="btn btn-sm btn-default">
        <i class="fa fa-reply"></i>&nbsp;
        Volver al listado
      </a>
    </div>
  </div>
  <div class="col-12">
    <?php
    $roleActions = CHtml::listData(RolesQuery::getAllActions($model->role_id), "action_id", "action_id");
    ?>
    <?php foreach (ActionsUtil::group(ActionsQuery::getAll()) as $row => $group): ?>
      <div class="card">
        <div class="card-heading border bottom">
          <div class="card-title"><?= $group["name"] ?></div>
        </div>
        <div class="card-body">
          <div class="row">
            <?php foreach ($group["items"] as $row => $action): ?>
              <?php
              $checked  = (isset($roleActions[$action["action_id"]])) ? " checked='' " : "";
              $disabled = (!Yii::app()->user->sudo && $model->role_default == 1) ? "disabled" : "";
              ?>
              <div class="col-12 col-md-4">
                <div class="checkbox ">
                  <input class="actions <?= $disabled ?>" <?= (!empty($disabled)) ? "disabled=''" : "" ?> id="action-<?= $action["action_id"] ?>" value="<?= $action["action_id"] ?>" name="actions[<?= $action["action_id"] ?>]" type="checkbox" <?= $checked ?>>
                  <label for="action-<?= $action["action_id"] ?>"><?= $action["action_name"] ?></label>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
