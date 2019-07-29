<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class Files {

  public static function getExtension($file) {
    $array = explode(".", $file);
    $total = count($array);
    if ($total > 0) {
      return $array[$total - 1];
    } else {
      return "";
    }
  }

  public static function getName($file) {
    $array  = explode(".", $file);
    $total  = count($array);
    $nombre = substr($file, 0, -(strlen($array[$total - 1]) + 1));
    return $nombre;
  }

  /**
   * Se recibe el nombre del file para poder extraer su nombre y su extension mediante un arreglo.['nombre] y ['extension']
   * @param string $nombrefile
   * @return array
   */
  public static function getNameExtensionFile($nombrefile) {
    $array             = explode(".", $nombrefile);
    $total             = count($array);
    $data['nombre']    = substr($nombrefile, 0, -(strlen($array[$total - 1]) + 1));
    $data['extension'] = $array[$total - 1];
    if ($total > 0) {
      return $data;
    } else {
      return array();
    }
  }

  public static function obtenerMimeTypeporExtension($extension) {
    $mimetype = "";
    switch ($extension) {
      case 'pdf':
        $mimetype = "application/pdf";
        break;
      case 'doc':
        $mimetype = "application/msword";
        break;
      case 'docx':
        $mimetype = "application/msword";
        break;
      case 'zip':
        $mimetype = "application/zip";
        break;
    }
    return $mimetype;
  }

  public static function validate($urlServerFile, $urlWebFile, $urlDefaultFile = false) {

    if (is_file($urlServerFile)) {
      return $urlWebFile;
    }

    return $urlDefaultFile;
  }

  public static function delete($file) {
    if (is_file($file)) {
      return unlink($file);
    }
    return false;
  }

  public static function rename($oldNameFile, $newNameFile) {
    if (is_file($oldNameFile)) {
      return rename($oldNameFile, $newNameFile);
    }
    return false;
  }

  public static function move($origin, $destination) {
    return self::rename($origin, $destination);
  }

}
