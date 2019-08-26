<?php
$this->breadcrumbs = [
    "Dispositivos" => Yii::app()->createUrl("device"),
    "Responsables"
];
?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="text-right">
          <button id="btnAddUser" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i>
            Agregar Responsable
          </button>
        </div>
        <div class="table-responsive">
          <table class="table" id="tbDeviceResponsables"></table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$this->renderPartial("modals/md-add-user");
?>