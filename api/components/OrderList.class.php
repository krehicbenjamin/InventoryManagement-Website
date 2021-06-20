<?php

require_once dirname(__FILE__)."/Order.class.php";

class OrderList extends Order
{
  private $orderArray = array();
  function __construct()
  {
    $this->orderArray = [];
  }

  public function add(Order $order)
  {
      array_push($this->orderArray, $order);
  }

  public function getOrder(){
      return $this->orderArray;
  }
}
