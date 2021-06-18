<?php

/**
 * @OA\Get(path="/articles",
 *  @OA\Response(response="200", description="Get all products")
 * )
 */
Flight::route('GET /products', function(){
    Flight::json(Flight::articleService()->getAll());
});


/**
 * @OA\Get(path="/articles/{id}",
 *  @OA\Response(response="200", description="Get all products")
 * )
 */
Flight::route('GET /products/@id', function($id){
    Flight::json(Flight::productService()->getById($id));
});

/**
 * @OA\Post(path="/products",
 *   @OA\RequestBody(description="Information about the product", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *    				 @OA\Property(property="name", required="true", type="string", example="T-shirt",	description="Name of the product" ),
 *             @OA\Property(property="current_quantity", required="true", type="integer", example="50",	description="Number of product items in stock" ),
 *             @OA\Property(property="supplier_id", required="true", type="integer", example="50",	description="Id of the supplier" ),
 *            @OA\Property(property="status", required="true", type="string", example="AVAILABLE",	description= "Is the product currently available for sale/discontinued" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Succesfully added new product")
 * )
 */
Flight::route('POST /products', function(){
  Flight::json(Flight::productService()->insertProduct(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/products/{id},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Update a product in the database corresponding to id")
 * )
 */
Flight::route('PUT /products/@id', function($id){
  Flight::json(Flight::productService()->updateProduct($id, Flight::request()->data->getData()));
});
