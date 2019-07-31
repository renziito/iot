<?php
$this->breadcrumbs = [
    "Proyectos"
];
?>
<div class="row">
  <?php
  if (
    Yii::app()->user->checkAccess(["PROJECT_CREATE"])
  ):
    ?>
    <div class="col-12">
      <div class="text-right">
        <a href="<?= Yii::app()->createUrl("project/manage/create") ?>" class="btn btn-success text-white">
          <i class="fa fa-plus"></i>&nbsp;
          Nuevo Proyecto
        </a>
      </div>
    </div>
<?php endif; ?>
  <div class="col-12">
    <div class="table-responsive">
      <table class="table" id="tbProjects"></table>
    </div>
  </div>
</div>