<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/OrderDao.class.php";
require_once dirname(__FILE__)."/../dao/ProductDao.class.php";
require_once dirname(__FILE__)."/../dao/CustomerDao.class.php";
require_once dirname(__FILE__)."/../dao/EmployeeDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class OrderService extends BaseService
{
    private $productDao;
    private $customerDao;
    private $employeeDao;
    public function __construct()
    {
        $this->dao=new OrderDao();
        $this->productDao = new ProductDao();
        $this->customerDao = new CustomerDao();
        $this->employeeDao = new EmployeeDao();
    }

    public function getOrders($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchOrders($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllOrdersPaginated($offset, $limit);
        }
    }

    public function add($order)
    {
        if(!isset($order['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($order);
    }

    public function update($id, $order)
    {
        return parent::update($id, $order);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }
}
