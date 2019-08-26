<?php
$this->breadcrumbs = [
    "Dispositivos" => Yii::app()->createUrl("device"),
    "Actualizar"
];

$form = $this->beginWidget('CActiveForm', [
    'id'          => 'form-device',
    'htmlOptions' => [
        'role'    => 'form',
        'enctype' => 'multipart/form-data',
        'class'   => 'form-horizontal form-product'
    ]
  ]);
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <?php
        $this->renderPartial("partials/_form", compact("model", "form"));
        ?>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="text-right">
      <a href="<?= Yii::app()->createUrl("device") ?>" class="btn">
        <strong><u>Cancelar</u></strong>
      </a>
      <button type="submit" class="btn btn-sm btn-success btn-submit">
        <i class="fa fa-save"></i>&nbsp;
        Actualizar
      </button>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>