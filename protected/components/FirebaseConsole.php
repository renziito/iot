<?php


class FirebaseConsole {

  const DEFAULT_URL   = 'https://my-application-bba3f.firebaseio.com/';
  const DEFAULT_TOKEN = 'KCtREXwGyZgWw6TmozEJM6ShjYWh3fsl2uRzRXf3';
  const DEFAULT_PATH  = 'notifications/';

  public static function factory() {
    return new Firebase\FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
  }

  public static function set($path = "", $data, $options = []) {
    return self::factory()->set(self::DEFAULT_PATH . "/" . $path, $data, $options);
  }
  public static function get($path = "", $params = []) {
    return self::factory()->get(self::DEFAULT_PATH . "/" . $path, $params);
  }

  public static function push($path, $data, $options = []) {
    return self::factory()->push(self::DEFAULT_PATH . "/" . $path, $data, $options);
  }

  public static function update($path, $data, $options = []) {
    return self::factory()->update(self::DEFAULT_PATH . "/" . $path, $data, $options);
  }

  public static function delete($path, $options = []) {
    return self::factory()->delete(self::DEFAULT_PATH . "/" . $path, $options);
  }

}