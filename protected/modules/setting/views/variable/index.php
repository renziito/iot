<?php
$this->breadcrumbs = [
    "Configuración" => "#",
    "Variables"
];
?>

<div class="row">
  <div class="col-12">
    <div class="text-right">
      <a href="<?=Yii::app()->createUrl("setting/variable/create")?>" class="btn btn-success text-white">
        <i class="fa fa-plus"></i>&nbsp;
        Nueva Variable
      </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbVariables"></table>
        </div>
      </div>
    </div>
  </div>
</div>