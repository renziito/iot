<?php
$this->breadcrumbs = [
    "Configuración"        => "#",
    "Tipo de Dispositivos" => Yii::app()->createUrl("setting/device"),
    "Nuevo"
];

$form = $this->beginWidget('CActiveForm', [
    'id'          => 'form-device',
    'htmlOptions' => [
        'role'    => 'form',
        'enctype' => 'multipart/form-data',
        'class'   => 'form-horizontal'
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
      <a href="<?= Yii::app()->createUrl("setting/device") ?>" class="btn">
        <strong><u>Cancelar</u></strong>
      </a>
      <button type="submit" class="btn btn-sm btn-success btn-submit">
        <i class="fa fa-save"></i>&nbsp;
        Guardar y continuar
      </button>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>