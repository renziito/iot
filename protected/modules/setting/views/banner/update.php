<?php
$this->breadcrumbs = [
    "Configuración del Sitio" => Yii::app()->createUrl("setting"),
    "Banners"                 => Yii::app()->createUrl("setting/banner"),
    "Actualizar"
];
?>
<?php
$form              = $this->beginWidget('CActiveForm', [
    'id'          => 'form-banner',
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
        <h4 class="card-title mb-4">Datos Generales</h4>
        <?php
        $this->renderPartial("partials/_form", compact("model", "form"));
        ?>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="text-right">
      <a href="<?= Yii::app()->createUrl("setting/banner") ?>" class="btn">
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