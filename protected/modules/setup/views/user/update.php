<?php 
$this->breadcrumbs = [
    "Sistema" => Yii::app()->createUrl("setting"),
    "Usuarios" => $this->createUrl("index"),
    "Editar"
];
?>
<div class="row">
  <div class="col-12">
    <div class="text-right mrg-btm-15">
      <a href="<?= Yii::app()->createUrl("setup/user") ?>" class="btn btn-sm btn-default">
        <i class="fa fa-reply"></i>&nbsp;
        Volver al listado
      </a>
      <button id="btn-user-delete" data-id='<?=$model->user_id?>' class="btn btn-sm btn-danger">
        <i class="fa fa-trash"></i>&nbsp;
        Eliminar Usuario
      </button>
    </div>
  </div>
</div>
<?= $this->renderPartial("partials/_form", compact("model")) ?>
<?= $this->renderPartial("modals/md-reset-password", compact("model")) ?>
