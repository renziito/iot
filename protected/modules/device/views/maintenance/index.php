<?php
$this->breadcrumbs = [
    "Dispositivos" => Yii::app()->createUrl("device"),
    "Mantenimiento"
];
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="text-right">
          <button id="btncreateResponsable" class="btn btn-default btn-sm">
            <i class="fa fa-plus"></i>
            Nuevo Responsable
          </button>
          <button id="btnAdd" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i>
            Agregar Mantenimiento
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbDeviceMaintenances"></table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$this->renderPartial("modals/md-maintenance", ["device" => $model,"model" => new DeviceMaintenancesModel()]);
$this->renderPartial("application.modules.manager.views.overview.modals.md-create",["model" => (new ResponsablesModel())]);
?>