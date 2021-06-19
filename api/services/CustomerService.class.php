<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/CustomerDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class CustomerService extends BaseService
{
    public function __construct()
    {
        $this->dao=new CustomerDao();
    }

    public function getCustomers($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchCustomersByName($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllCustomersPaginated($offset, $limit);
        }
    }

    public function insertCustomer($customer)
    {
        if(!isset($customer['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($customer);
    }

    public function update($id, $customer)
    {
        return parent::update($id, $customer);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getAllCustomers()
    {
      return $this->dao->getAllCustomers();
    }

}
