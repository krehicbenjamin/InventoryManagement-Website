<<?php

Flight::route('GET /swagger', function(){
  $openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
  header('Content-Type: application/json');
  echo $openapi->toJson();
});

Flight::route('GET /', function(){
  Flight::redirect('/docs');
});

//utility function for reading queries from URL
Flight::map('query', function($name, $default_value = null){
    $request = Flight::request();
    $query_param = @$request->query->getData()[$name];
    $query_param = $query_param ? $query_param : $default_value;
    return $query_param;
});

//utility function for generating jwt token
Flight::map('jwt', function($user){
  $jwt = JWT::encode(["exp" => (time() + Config::JWT_TOKEN_TIME),
  "id" => $user["id"], "r" => $user["role"]], Config::JWT_SECRET);
  return ["token" => $jwt];
});

/* error handling for our API
Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});
*/
Flight::start();
