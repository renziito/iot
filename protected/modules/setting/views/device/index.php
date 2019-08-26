<?php
$this->breadcrumbs = [
    "Configuración" => "#",
    "Tipo de Dispositivos"
];
?>

<div class="row">
  <div class="col-12">
    <div class="text-right">
      <a href="<?=Yii::app()->createUrl("setting/device/create")?>" class="btn btn-success text-white">
        <i class="fa fa-plus"></i>&nbsp;
        Nuevo Tipo de Dispositivo
      </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbDevices"></table>
        </div>
      </div>
    </div>
  </div>
</div>