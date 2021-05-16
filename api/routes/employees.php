<?php
/**
 * @OA\Info(title="SE_PROJECT API", version="1.0")
 * @OA\OpenApi(
 *    @OA\Server(url="http://localhost:8082/SE_PROJECT/api/", description="Development Environment" ),
 *    @OA\Server(url="https://", description="Production Environment" )
 * ),
 * @OA\SecurityScheme(securityScheme="ApiKeyAuth", type="apiKey", in="header", name="Authentication" )
 */

/**
 * @OA\Post(path="/register", tags={"login"},
 *   @OA\RequestBody(description="Basic user info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="account", required="true", type="string", example="My Test Account",	description="Name of the account" ),
 *     				 @OA\Property(property="name", required="true", type="string", example="First Last Name",	description="Name of the user`" ),
 *    				 @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has been created.")
 * )
 */
Flight::route('POST /register', function(){
    $data = Flight::request()->data->getData();
    Flight::employeeService()->register($data);
  });

/**
 * @OA\Post(path="/login", tags={"login"},
 *   @OA\RequestBody(description="Basic customer info", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="User's email address" ),
 *             @OA\Property(property="password", required="true", type="string", example="12345",	description="Password" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Message that user has been legged in.")
 * )
 */
Flight::route('POST /login', function(){
  Flight::json(Flight::jwt(Flight::employeeService()->login(Flight::request()->data->getData())));
});

?>