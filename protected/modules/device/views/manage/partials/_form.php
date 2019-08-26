<div class="form-group row">
  <label for="DevicesModel_typedevice_id" class="col-md-3 control-label">Tipo de Dispositivo</label>
  <div class="col-md-9">
    <?=
    $form->dropDownList($model, 'typedevice_id', DeviceUtil::listTypeDevice(), [
        "class" => "form-control",
        "empty" => "Seleccionar Tipo"
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="DevicesModel_device_code" class="col-md-3 control-label">Código</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_code', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="DevicesModel_device_serie" class="col-md-3 control-label">Serie</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_serie', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="DevicesModel_device_latitude" class="col-md-3 control-label">Latitud</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_latitude', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="DevicesModel_device_longitude" class="col-md-3 control-label">Longitud</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_longitude', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="DevicesModel_device_status" class="col-md-3 control-label">Estado</label>
  <div class="col-md-9">
    <?=
    $form->dropDownList($model, 'device_status', DeviceUtil::listStatus(), [
        "class" => "form-control"
    ]);
    ?>
  </div>
</div>
<?php
$modem = false;
if(isset($model->typedevice_id)){
  $type = TypeDevicesModel::model()->findByPk($model->typedevice_id);
  if($type){
    $modem = ($type->typedevice_modem == 1) ? true : false;
  }
}
?>
<div class="form-group row modem-required <?=($modem)?"":"d-none"?>">
  <label for="DevicesModel_device_number_modem" class="col-md-3 control-label">Número Modem</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_number_modem', [
        "class" => "form-control modem",
    ]);
    ?>
  </div>
</div>
<div class="form-group row modem-required <?=($modem)?"":"d-none"?>">
  <label for="DevicesModel_device_provider_modem" class="col-md-3 control-label">Proveedor Modem</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'device_provider_modem', [
        "class" => "form-control modem",
    ]);
    ?>
  </div>
</div>