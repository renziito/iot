<?php
$this->breadcrumbs = [
    "Listas" => Yii::app()->createUrl("list"),
    "Actualizar Lista"
];
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <?php 
        $this->renderPartial("partial/_form", compact("model"));
        ?>
      </div>
    </div>
  </div>
</div>