<?php
$this->breadcrumbs = [
    "Configuración del Sitio" => Yii::app()->createUrl("setting"),
    "Instituciones Aliadas"
];
?>

<div class="row">
  <div class="col-12">
    <div class="text-right">
      <a href="<?=Yii::app()->createUrl("setting/partner/create")?>" class="btn btn-success text-white">
        <i class="fa fa-plus"></i>&nbsp;
        Nueva Institución
      </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbPartners"></table>
        </div>
      </div>
    </div>
  </div>
</div>