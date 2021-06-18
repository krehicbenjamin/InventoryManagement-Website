<?php

/**
 * @OA\Get(path="/articles",
 *  @OA\Response(response="200", description="Get all orders")
 * )
 */
Flight::route('GET /orders', function(){
    Flight::json(Flight::articleService()->getAll());
});


/**
 * @OA\Get(path="/articles/{id}",
 *  @OA\Response(response="200", description="Get all orders")
 * )
 */
Flight::route('GET /orders/@id', function($id){
    Flight::json(Flight::orderService()->getById($id));
});

/**
 * @OA\Post(path="/orders",
 *   @OA\RequestBody(description="Information about the order", required=true,
 *       @OA\MediaType(mediaType="application/json",
 *    			@OA\Schema(
 *             @OA\Property(property="customer_id", required="true", type="integer", example="50",	description="Id of the customer" ),
 *             @OA\Property(property="product_id", required="true", type="integer", example="50",	description="Id of the product" ),
 *             @OA\Property(property="quantity", required="true", type="integer", example="50",	description="Quantity of product ordered" ),
 *             @OA\Property(property="employee_id", required="true", type="integer", example="50",	description="Id of the employee that filled out the order" )
 *          )
 *       )
 *     ),
 *  @OA\Response(response="200", description="Succesfully added new order")
 * )
 */
Flight::route('POST /orders', function(){
  Flight::json(Flight::orderService()->insertOrder(Flight::request()->data->getData()));
});

/**
 * @OA\Put(path="/orders/{id},
 *     @OA\Parameter(@OA\Schema(type="integer"), in="path", allowReserved=true, name="id", example=1),
 *     @OA\Response(response="200", description="Update a order in the database corresponding to id")
 * )
 */
Flight::route('PUT /orders/@id', function($id){
  Flight::json(Flight::orderService()->updateOrder($id, Flight::request()->data->getData()));
});
