<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/OrderDao.class.php";
require_once dirname(__FILE__)."/../dao/ProductDao.class.php";
require_once dirname(__FILE__)."/../dao/CustomerDao.class.php";
require_once dirname(__FILE__)."/../dao/EmployeeDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";
require_once dirname(__FILE__)."/../components/OrderList.class.php";
require_once dirname(__FILE__)."/ProductService.class.php";

class OrderService extends BaseService
{
    private $productDao;
    private $customerDao;
    private $employeeDao;
    private $orderList;
    private $productService;
    public function __construct()
    {
        $this->dao=new OrderDao();
        $this->productDao = new ProductDao();
        $this->customerDao = new CustomerDao();
        $this->employeeDao = new EmployeeDao();
        $this->orderList = new OrderList();
        $this->productService = new ProductService();
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

    public function insertOrder($order)
    {
        $customer = $this->customerDao->getCustomerByName($order["customer_name"]);
        $products =  $order['products'];

        foreach ($products as $name => $quantity) {
          $product = $this->productDao->getProductByName($name);
          try {
              $this->productService->sellProduct($product['id'], $quantity);
          } catch (\Exception $e) {
              throw new \Exception($e->getMessage(), 1);
          }
            $this->orderList->add(new Order(
              $customer['id'],
              $product['id'],
              $quantity
            ));
        }
        $orders = array();
        foreach ($this->orderList->getOrder() as $order) {
            array_push($orders, parent::add($order->getOrder()));
        }

        return $orders;
    }

    public function update($id, $order)
    {
        return parent::update($id, $order);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getAllOrders()
    {
      return $this->dao->getAllOrders();
    }
}
