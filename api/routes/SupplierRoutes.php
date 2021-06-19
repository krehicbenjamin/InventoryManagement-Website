<?php

/**
 * @OA\Get(path="/articles",
 *  @OA\Response(response="200", description="Get all suppliers")
 * )
 */
Flight::route('GET /suppliers', function(){
    Flight::json(Flight::supplierService()->getAllSuppliers());
});


/**
 * @OA\Get(path="/articles/{id}",
 *  @OA\Response(response="200", description="Get all suppliers")
 * )
 */
Flight::route('GET /suppliers/@id', function($id){
    Flight::json(Flight::supplierService()->getById($id));
});

/**
 * @OA\Post(path="/suppliers",
 *   @OA\RequestBody(description="Information about the supplier", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="Veleprodaja d.o.o.",	description="Name of supplier" ),
 *    				 @OA\Property(property="address", required="true", type="string", example="Trg solidarnosti 14",	description="Suppliers address" ),
*    				   @OA\Property(property="email", required="true", type="string", example="myemail@gmail.com",	description="Suppliers email address" ),
*    				 @OA\Property(property="phone", required="true", type="string", example="033/123-456",	description="Suppliers phone number" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Succesfully added new supplier")
 * )
 */
Flight::route('POST /suppliers', function(){
  Flight::json(Flight::supplierService()->insertSupplier(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/suppliers/{id},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Update a supplier in the database corresponding to id")
 * )
 */
Flight::route('PUT /suppliers/@id', function($id){
  Flight::json(Flight::supplierService()->updateSupplier($id, Flight::request()->data->getData()));
});
