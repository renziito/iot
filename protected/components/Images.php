<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class Images {

  public static function thumbnail($urlImage, $nameImage, $size, $resize = "XS") {
    Yii::import("ext.Easyimage.EasyImage");

    Folder::create("{$urlImage}/thumb/");

    $image     = $urlImage . "/" . $nameImage;
    $thumbnail = new EasyImage($image);
    $thumbnail->resize(NULL, $size, EasyImage::RESIZE_HEIGHT);
    $thumbnail->save("{$urlImage}/thumb/" . Files::getName($nameImage) . "_{$resize}." . Files::getExtension($nameImage));
  }

  public static function create(CUploadedFile $file, $thumbnail = ["XS" => 150, "SM" => 300, "MD" => 500]) {
    $path   = Yii::getPathOfAlias("webroot") . "/storage/images";
    $status = new stdClass();

    $status->data  = new stdClass();
    $status->error = false;

    try {
      Folder::create($path);

      $nameImage = uniqid() . "_" . strtotime("now") . "_" . Utils::randomNumber("5") . ".{$file->getExtensionName()}";
      $pathImage = "{$path}/{$nameImage}";

      if (!$file->saveAs($pathImage)) {
        throw new Exception("No se pudo guardar la imagen", 500);
      }

      $model = new ImagesModel;

      $model->image_mimetype  = $file->getType();
      $model->image_size      = $file->getSize();
      $model->image_extension = $file->getExtensionName();
      $model->image_name      = $nameImage;

      if (!$model->save()) {
        throw new Exception("No se pudo registrar los datos de la imagen en la base de datos", 500);
      }

      $status->data = $model;

      if ($thumbnail && is_array($thumbnail)) {
        foreach ($thumbnail as $name => $size) {
          self::thumbnail($path, "{$nameImage}", (int) $size, $name);
        }
      }
    } catch (Exception $ex) {
      $status->error = new stdClass();

      $status->error->code    = $ex->getCode();
      $status->error->message = $ex->getMessage();
    }

    return $status;
  }

}
