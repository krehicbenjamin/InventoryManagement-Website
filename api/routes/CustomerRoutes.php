<?php

/**
 * @OA\Get(path="/articles",
 *  @OA\Response(response="200", description="Get all customers")
 * )
 */
Flight::route('GET /customers', function(){
    Flight::json(Flight::customerService()->getAllCustomers());
});


/**
 * @OA\Get(path="/articles/{id}",
 *  @OA\Response(response="200", description="Get all customers")
 * )
 */
Flight::route('GET /customers/@id', function($id){
    Flight::json(Flight::customerService()->getById($id));
});

/**
 * @OA\Post(path="/customers",
 *   @OA\RequestBody(description="Information about the customer", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="Veleprodaja d.o.o.",	description="Name of customer" ),
 *    				 @OA\Property(property="address", required="true", type="string", example="Trg solidarnosti 14",	description="Customers address" ),
*    				   @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="Customers email address" ),
*    				 @OA\Property(property="phone", required="true", type="string", example="033/123-456",	description="Customers phone number" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Succesfully added new customer")
 * )
 */
Flight::route('POST /customers', function(){
  Flight::json(Flight::customerService()->insertCustomer(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/customers/{id},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Update a customer in the database corresponding to id")
 * )
 */
Flight::route('PUT /customers/@id', function($id){
  Flight::json(Flight::customerService()->updateCustomer($id, Flight::request()->data->getData()));
});
