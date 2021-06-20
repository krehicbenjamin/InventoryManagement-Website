<?php


class Order
{
  private $productDao;
  private $customerDao;
  private $employeeDao;
  private $orderToBeInserted;
  function __construct($customer_id, $product_id, $quantity)
  {
      $this->dao=new OrderDao();
      $this->orderToBeInserted = [
          "customer_id" => $customer_id,
          "product_id" => $product_id,
          "quantity" => $quantity,
          "employee_id" => 1,
          "date" => date(Config::DATE_FORMAT)
      ];
  }

  public function getOrder()
  {
      return $this->orderToBeInserted;
  }
}
