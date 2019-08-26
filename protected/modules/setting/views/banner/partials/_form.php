<div class="form-group row">
  <label for="BannersModel_banner_title" class="col-md-3 control-label">Titulo</label>
  <div class="col-md-9">
    <?=
    $form->textField($model, 'banner_title', [
        "class" => "form-control",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="BannersModel_banner_description" class="col-md-3 control-label">Resumen</label>
  <div class="col-md-9">
    <?=
    $form->textArea($model, 'banner_description', [
        "class" => "form-control",
        "style" => "min-height: 80px",
    ]);
    ?>
  </div>
</div>
<div class="form-group row">
  <label for="BannersModel_active" class="col-md-3 control-label">¿Activo?</label>
  <div class="col-md-9">
    <div class="toggle-checkbox toggle-success checkbox-inline">
      <?=
      $form->checkBox($model, 'active', [
          "class" => "",
      ]);
      ?>
      <label for="BannersModel_active"></label>
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="BannersModel_image_id" class="col-md-3 control-label">Imagen</label>
  <div class="col-md-9">
    <?php
    $url = "https://via.placeholder.com/800x500";
    if (isset($model->image_id)) {
      $image = ImagesModel::model()->findByPk($model->image_id);
      if ($image) {
        $url = Utils::buildUrlThumbnail("storage/images", $image->image_name, "MD");
      }
    }
    ?>
    <div class="mb-2">
      <img id="bannePreview" class="img-thumbnail" src="<?= $url ?>" width="50%">
    </div>
    <div>
      <?=
      $form->fileField($model, 'image_id', [
          "style"  => "width: 0.1px;height: 0.1px;opacity: 0;overflow: hidden;",
          "accept" => "image/*",
          "data-exists" => isset($model->image_id) ? 1 : 0
      ]);
      ?>
    </div>
    <button id="btnBannerChangeImage" type="button" class="btn btn-dark">Cambiar</button>
  </div>
</div>