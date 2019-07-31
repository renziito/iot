<?php
$form  = $this->beginWidget('CActiveForm', [
    'id'          => 'form-project',
    'htmlOptions' => [
        'role'  => 'form',
        'class' => 'form-horizontal'
    ]
  ]);
?>
<div class="form-group row">
  <label for="ProjectsModel_project_name" class="col-md-2 control-label">Nombre</label>
  <div class="col-md-10">
    <?=
    $form->textField($model, "project_name", [
        "class"       => "form-control",
        "placeholder" => "Nombre del Proyecto"
    ])
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="ProjectsModel_project_code" class="col-md-2 control-label">ID</label>
  <div class="col-md-10">
    <?php
    $token = Utils::token("sha1", uniqid(), 10);
    if (!isset($model->project_code)) {
      $model->project_code = $token;
    }
    ?>
    <?= $form->textField($model, "project_code", ["class" => "form-control", "readonly" => true]) ?>
  </div>
</div>
<div class="form-group row">
  <label for="ProjectsModel_project_resumen" class="col-md-2 control-label">Descripción</label>
  <div class="col-md-10">
    <?= $form->textArea($model, "project_resumen", ["class" => "form-control", "rows" => 3]) ?>
  </div>
</div>
<div class="text-right mt-5">
  <a href="<?= Yii::app()->createUrl("project") ?>" class="btn btn-link">
    <strong>Cancelar</strong>
  </a>
  <button type="submit" class="btn btn-success">
    <i class="fa fa-save"></i>&nbsp;
    Guardar
  </button>
</div>
</form><?php $this->endWidget(); ?>