<?php
$this->breadcrumbs = [
    "Listas" => Yii::app()->createUrl("list"),
    "Actualizar Lista"
];
?>
<div class="row">
  <div class="col-12">
    <div class="text-right">
      <button></button>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <h4 class="card-title mb-4">Datos Generales</h4>
        <?php 
        $this->renderPartial("partial/_form", compact("model"));
        ?>
      </div>
    </div>
  </div>
</div>