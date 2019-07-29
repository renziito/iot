<?php 
$this->breadcrumbs = [
    "Sistema" => Yii::app()->createUrl("setup"),
    "Roles"
];
?>
<div class="row">
  <div class="col-12">
    <div class="text-right">
      <button id="btn-create" class="btn btn-success text-white">
        <i class="fa fa-plus"></i>&nbsp;
        Nuevo Rol
        </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbRoles"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->renderPartial("modals/md-manage-role");
$this->renderPartial("modals/md-delete-role");
?>