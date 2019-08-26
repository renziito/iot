<?php
$this->breadcrumbs = [
    "Configuración"        => "#",
    "Tipo de Dispositivos" => Yii::app()->createUrl("setting/device"),
    "Variables"
];
?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-block">
        <?php
        $form              = $this->beginWidget('CActiveForm', [
            'id'          => 'form-device-variable',
            'htmlOptions' => [
                'role'    => 'form',
                'enctype' => 'multipart/form-data',
                'class'   => 'form-horizontal form-product'
            ]
        ]);
        ?>
        <div class="row">
          <div class="col-12 col-md-5">
            <label class="control-label">Busca la variable y luego presiona el botón "Agregar variable" para que sea agregada a la lista.</label>
          </div>
          <div class="col-12 col-md-7"></div>
          <div class="col-12 col-md-5">
            <?= CHtml::hiddenField("TypeDeviceVariablesModel[typedevice_id]", $model->typedevice_id, [])?>
            <select id="cboVariables" name="TypeDeviceVariablesModel[typevariable_id]" class="form-control">
              <option value="">Buscar...</option>
              <?php foreach (TypeVariablesQuery::getAllNotAsigned($model->typedevice_id) as $variable): ?>
                <option value="<?= $variable["vid"] ?>"><?= $variable["vdenomination"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-12 col-md-7">
            <button class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i>
              Agregar Variable
            </button>
          </div>
        </div>
        <?php $this->endWidget(); ?>
        <hr>
        <div class="table-responsive">
          <table class="table" id="tbDeviceVariables"></table>
        </div>
      </div>
    </div>
  </div>
</div>