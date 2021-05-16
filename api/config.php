<?php
class Config{
  const DATE_FORMAT = "Y:m:d H:i:s";
  const DB_HOST = "localhost";
  const DB_USERNAME = "SE_project";
  const DB_PASSWORD = "123456";
  const DB_SCHEME = "softwareengineering";

  const JWT_SECRET = "This is a secret";
  const JWT_TOKEN_TIME = 604800;
  
  public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
  }
}
?>
