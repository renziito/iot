<div class="form-group row">
  <label for="TypeVariablesModel_typevariable_denomination" class="col-md-3 control-label">Denominación</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'typevariable_denomination', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="TypeVariablesModel_typevariable_key" class="col-md-3 control-label">Key</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'typevariable_key', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="TypeVariablesModel_active" class="col-md-3 control-label">¿Visible?</label>
  <div class="col-md-9">
    <div class="toggle-checkbox toggle-success checkbox-inline">
      <?=
      $form->checkBox($model, 'active', [
          "class" => "",
      ]);
      ?>
      <label for="TypeVariablesModel_active"></label>
    </div>
  </div>
</div>