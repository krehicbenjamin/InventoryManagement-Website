<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class CustomerDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("customers");
    }

    public function getCustomersById($id)
    {
        return $this->queryUnique("SELECT * FROM customers WHERE id = :id", ["id" => $id]);
    }

    public function insertCustomer($customer)
    {
        return $this->insert("customers", $customer);
    }

    public function getAllCustomers()
    {
        return $this->getAll("customers");
    }

    public function searchCustomersByName($search, $offset, $limit){
        return $this->query("SELECT * FROM customers
                             WHERE name LIKE CONCAT('%', :name, '%') LIMIT ${limit} OFFSET ${offset}",
                             ["name" => $search]);
    }

    public function getAllCustomersPaginated($offset = 0, $limit = 30)
    {
      return $this->getAllPaginated("customers", $offset, $limit);
    }

}
