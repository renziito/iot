<div class="form-group row">
  <label for="TypeDevicesModel_typedevice_denomination" class="col-md-3 control-label">Denominación</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'typedevice_denomination', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="TypeDevicesModel_typedevice_origin" class="col-md-3 control-label">Origen</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'typedevice_origin', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="TypeDevicesModel_typedevice_modem" class="col-md-3 control-label">¿Modem?</label>
  <div class="col-md-9">
    <?=
    $form->dropDownList($model, "typedevice_modem", ["NO", "SI"], [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="TypeDevicesModel_typedevice_maintenance_frequency" class="col-md-3 control-label">Frecuencia de Mantenimiento</label>
  <div class="col-md-9">
    <?=
    $form->dropDownList($model, "typedevice_maintenance_frequency",Date::getMonthAll(), [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>