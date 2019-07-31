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
          <button id="btnAddUserAdmin" class="btn btn-default">
            <i class="fa fa-plus"></i>
            Agregar Administrador
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbProjectAssignedUsersAdmin"></table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <h4 class="mb-0">Visualizadores</h4>
        <div class="text-right mb-4">
          <button id="btnAddUserVisor" class="btn btn-default">
            <i class="fa fa-plus"></i>
            Agregar Visualizador
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbProjectAssignedUsersVisor"></table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$this->renderPartial("modals/md-add-user-admin");
$this->renderPartial("modals/md-add-user-visor");
?>