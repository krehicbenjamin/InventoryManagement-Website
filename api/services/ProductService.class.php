<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/ProductDao.class.php";
require_once dirname(__FILE__)."/../dao/SupplierDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class ProductService extends BaseService
{
    private $supplierDao;

    public function __construct()
    {
        $this->dao = new ProductDao();
        $this->supplierDao = new SupplierDao();
    }

    public function getProducts($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchProductsByName($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllProductsPaginated($offset, $limit);
        }
    }

    public function add($product)
    {
        if(!isset($product['name'])) throw new \Exception("Name is missing", 1);
        $supplier = $this->supplierDao->getSuppliersByName($product['supplier_name']);

        return parent::add([
            'name' => $product['name'],
            'current_quantity' => $product['current_quantity'],
            'supplier_id' => $supplier['id']
        ]);
    }

    public function update($id, $product)
    {
        return parent::update($id, $product);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }
}
