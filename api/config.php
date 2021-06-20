<?php
class Config{
  const DATE_FORMAT = "Y:m:d H:i:s";
  const DB_HOST = "remotemysql.com";
  const DB_USERNAME = "PwyF2MRTXB";
  const DB_PASSWORD = "ZW4KmDmyDA";
  const DB_SCHEME = "PwyF2MRTXB";

  const JWT_SECRET = "This is a secret";
  const JWT_TOKEN_TIME = 604800;

  public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }
}
?>
