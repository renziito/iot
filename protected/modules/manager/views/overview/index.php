<?php
$this->breadcrumbs = [
    "Responsables"
];
?>
<div class="row">
  <?php if (Yii::app()->user->checkAccess(["RESPONSABLE_CREATE"])):
    ?>
    <div class="col-12">
      <div class="text-right">
        <button id="btnManagerCreate" class="btn btn-success text-white">
          <i class="fa fa-plus"></i>&nbsp;
          Nuevo Responsable
        </button>
      </div>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbManagers"></table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
$this->renderPartial("modals/md-create",["model" => (new ResponsablesModel())]);
$this->renderPartial("modals/md-update");
?>