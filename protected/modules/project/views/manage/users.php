<?php
$this->breadcrumbs = [
    "Proyectos" => Yii::app()->createUrl("project"),
    $model->project_name
];
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <h4 class="mb-0">Administradores</h4>
        <div class="text-right mb-4">
          <button class="btn btn-default">
            <i class="fa fa-plus"></i>
            Agregar Administrador
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbProjectUsers"></table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <h4 class="mb-0">Visualizadores</h4>
        <div class="text-right mb-4">
          <button class="btn btn-default">
            <i class="fa fa-plus"></i>
            Agregar Visualizador
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbProjectUsers"></table>
        </div>
      </div>
    </div>
  </div>
</div>