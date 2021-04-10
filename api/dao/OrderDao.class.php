<?php

require_once dirname(__FILE__)."/BaseDao.class.php";
require_once dirname(__FILE__)."/EmployeeDao.class.php";
require_once dirname(__FILE__)."/CustomerDao.class.php";
require_once dirname(__FILE__)."/ProductDao.class.php";

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
        $productDao = new ProductDao();
        $product = $productDao->getProductsById($order['product_id']);
        $newQuantity = $product['current_quantity'] - $order['quantity'];
        $productDao->updateProduct($product['id'], ['current_quantity' => $newQuantity]);
        $this->insert("orders", $order);
    }

    public function getAllOrders()
    {
        return $this->getAll("orders");
    }

    public function searchOrdersByCustomer($search, $offset = 0, $limit = 30)
    {
        $customerDao = new CustomerDao();
        $customers = array();
        $customers = $customerDao->searchCustomersByName($search);
        $orders = array();
        for($i = 0; i < count($customers); $i++)
        {
            $orders[] = $this->query("SELECT * FROM orders
                                    WHERE customer_id LIKE CONCAT('%', :customer_id, '%') LIMIT ${limit} OFFSET ${offset}",
                                    ["customer_id" => $customers[$i]['id']]);
        }
        return json_encode($orders);
    }

    public function searchOrdersByProduct($search, $offset = 0, $limit = 30)
    {
        $productDao = new ProductDao();
        $products = array();
        $products = $productDao->searchProductsByName($search);
        $orders = array();
        for($i = 0; i < count($products); $i++)
        {
            $orders[] = $this->query("SELECT * FROM orders
                                    WHERE product_id LIKE CONCAT('%', :product_id, '%') LIMIT ${limit} OFFSET ${offset}",
                                    ["product_id" => $products[$i]['id']]);
        }
        return json_encode($orders);
    }

    public function searchOrdersByEmployee($search, $offset = 0, $limit = 30)
    {
        $employeeDao = new EmployeeDao();
        $employees = array();
        $employees = $employeeDao->searchEmployeesByName($search);
        $orders = array();
        for($i = 0; i < count($employees); $i++)
        {
            $orders[] = $this->query("SELECT * FROM orders
                                    WHERE employee_id LIKE CONCAT('%', :employee_id, '%') LIMIT ${limit} OFFSET ${offset}",
                                    ["employee_id" => $employees[$i]['id']]);
        }
        return json_encode($orders);
    }

    public function searchOrders($search, $offset = 0, $limit = 30)
    {
        $orders = array();

        //check if the functions return empty arrays, if not add them to orders array
        if(count(json_decode($this->searchOrdersByProduct($search, $offset, $limit), true)) != 0)
        {
            $orders[] = json_decode($this->searchOrdersByProduct($search, $offset, $limit), true);
        }
        if(count(json_decode($this->searchOrdersByCustomer($search, $offset, $limit), true)) != 0)
        {
            $orders[] = json_decode($this->searchOrdersByCustomer($search, $offset, $limit), true);
        }
        if(count(json_decode($this->searchOrdersByEmployee($search, $offset, $limit), true)) != 0){
            $orders[] = json_decode($this->searchOrdersByEmployee($search, $offset, $limit), true);
        }
        return json_encode($orders);
    }


    public function getAllOrdersPaginated($offset = 0, $limit = 30)
    {
      return $this->getAllPaginated("orders", $offset, $limit);
    }



}
