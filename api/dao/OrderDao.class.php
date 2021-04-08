<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class OrderDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("orders");
    }

    public function getOrderById($id)
    {
        return $this->queryUnique("SELECT * FROM orders WHERE id = :id", ["id" => $id]);
    }

    public function insertOrder($order)
    {
        $this->insert($order, "orders");
    }

    public function getAllOrders(){
        return $this->getAll("orders");
    }

    public function searchOrdersByCustomer($search){
        return $this->query("SELECT * FROM orders
                             WHERE customer_id LIKE CONCAT('%', :customer_id, '%')",
                             ["customer_id" => $search]);
    }

}
