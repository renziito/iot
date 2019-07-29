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

}
