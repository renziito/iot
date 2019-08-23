<?php
$form = $this->beginWidget('CActiveForm', [
    'id'          => 'form-banner',
    'htmlOptions' => [
        'role'    => 'form',
        'enctype' => 'multipart/form-data',
        'class'   => 'form-horizontal form-product'
    ]
  ]);
?>
<div class="form-group row">
  <label for="BannersModel_image_id" class="col-md-2 control-label">Imagen</label>
  <div class="col-md-10">
    <?=
    $form->fileField($model, 'image_id', [
        "class"  => "d-nones",
        "accept" => "image/*"
    ]);
    ?>
  </div>
</div>


<button type="submit" class="btn btn-sm btn-success btn-submit">
  <i class="fa fa-save"></i>&nbsp;
  Continuar
</button>

<?php $this->endWidget(); ?>