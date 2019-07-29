<?php

/**
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package APP\Components
 */
class Folder {

  public static function create($urlDIr, $recursivo = true) {
    if (!is_dir($urlDIr)) {
      return mkdir($urlDIr, 0777, $recursivo);
    }
    return true;
  }
  
  public static function move($sourceDir, $destDir) {
    if (!is_dir($sourceDir)) {
      return rename($sourceDir, $destDir);
    }
    return true;
  }

  public static function delete($dirPath) {
    if (!is_dir($dirPath)) {
      throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
      $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
      if (is_dir($file)) {
        self::delete($file);
      } else {
        unlink($file);
      }
    }
    return rmdir($dirPath);
  }

}
