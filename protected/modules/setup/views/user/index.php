<?php 
$this->breadcrumbs = [
    "Sistema" => Yii::app()->createUrl("setup"),
    "Usuarios"
];
?>
<div class="row">
  <div class="col-12">
    <div class="text-right">
      <a href="<?=Yii::app()->createUrl("setup/user/create")?>" class="btn btn-success text-white">
        <i class="fa fa-plus"></i>&nbsp;
        Nuevo Usuario
      </a>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <div class="table-responsive">
          <table class="table" id="tbUsers"></table>
        </div>
      </div>
    </div>
  </div>
</div>