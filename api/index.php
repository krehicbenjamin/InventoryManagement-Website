<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);

 require dirname(__FILE__)."/../vendor/autoload.php";
 use \Firebase\JWT\JWT;



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

Flight::map('header', function($name){
  $headers = getallheaders();
  return @$headers[$name];
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
/* require routes */
require_once dirname(__FILE__)."/routes/CustomerRoutes.php";
require_once dirname(__FILE__)."/routes/EmployeeRoutes.php";
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/OrderRoutes.php";
require_once dirname(__FILE__)."/routes/ProductRoutes.php";
require_once dirname(__FILE__)."/routes/SupplierRoutes.php";

/* require BLL */

require_once dirname(__FILE__)."/services/CustomerService.class.php";
require_once dirname(__FILE__)."/services/EmployeeService.class.php";
require_once dirname(__FILE__)."/services/OrderService.class.php";
require_once dirname(__FILE__)."/services/ProductService.class.php";
require_once dirname(__FILE__)."/services/SupplierService.class.php";


/* register services */
Flight::register("customerService", "CustomerService");
Flight::register("employeeService", "EmployeeService");
Flight::register("orderService", "OrderService");
Flight::register("productService", "ProductService");
Flight::register("supplierService", "SupplierService");


Flight::start();
