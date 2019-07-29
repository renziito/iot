<?php 
$this->breadcrumbs = [
    "Sistema" => Yii::app()->createUrl("setup"),
    "Usuarios" => $this->createUrl("index"),
    "Nuevo"
];
?>
<div class="row">
  <div class="col-12">
    <div class="text-right mrg-btm-15">
      <a href="<?= Yii::app()->createUrl("setup/user") ?>" class="btn btn-sm btn-default">
        <i class="fa fa-reply"></i>&nbsp;
        Volver al listado
      </a>
    </div>
  </div>
</div>
<?= $this->renderPartial("partials/_form", compact("model")) ?>
