<div class="form-group row">
  <label for="CardsModel_card_title" class="col-md-3 control-label">Titulo</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'card_title', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="CardsModel_banner_description" class="col-md-3 control-label">Resumen</label>
  <div class="col-md-9">
    <?=
    $form->textArea($model, 'card_description', [
        "class" => "form-control",
        "style" => "min-height: 80px",
    ]);
    ?>
  </div>
</div>