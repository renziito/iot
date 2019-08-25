<div class="form-group row">
  <label for="PartnersModel_partner_name" class="col-md-3 control-label">Nombre</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'partner_name', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="PartnersModel_partner_url" class="col-md-3 control-label">URL</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'partner_url', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="PartnersModel_partner_description" class="col-md-3 control-label">Resumen</label>
  <div class="col-md-9">
    <?=
    $form->textArea($model, 'partner_description', [
        "class" => "form-control",
        "style" => "min-height: 80px",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="PartnersModel_image_id" class="col-md-3 control-label">Imagen</label>
  <div class="col-md-9">
    <?php
    $url = "https://via.placeholder.com/500x300";
    if (isset($model->image_id)) {
      $image = ImagesModel::model()->findByPk($model->image_id);
      if ($image) {
        $url = Utils::buildUrlThumbnail("storage/images", $image->image_name, "MD");
      }
    }
    ?>
    <div class="mb-2">
      <img id="partnerPreview" class="img-thumbnail" src="<?= $url ?>" width="50%">
    </div>
    <div>
      <?=
      $form->fileField($model, 'image_id', [
          "style"       => "width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;",
          "accept"      => "image/*",
          "data-exists" => isset($model->image_id) ? 1 : 0
      ]);
      ?>
    </div>
    <button id="btnPartnerChangeImage" type="button" class="btn btn-dark">Cambiar</button>
  </div>
</div>