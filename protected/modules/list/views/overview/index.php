<?php
$this->breadcrumbs = [
    "Listas"
];
?>
<div class="row">
  <?php if (Yii::app()->user->checkAccess(["LIST_CREATE"])):
    ?>
    <div class="col-12">
      <div class="text-right">
        <a href="<?= Yii::app()->createUrl("list/manage/create") ?>" class="btn btn-success text-white">
          <i class="fa fa-plus"></i>&nbsp;
          Nueva Lista
        </a>
      </div>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <div class="table-responsive">
      <table class="table" id="tbLists"></table>
    </div>
  </div>
</div>