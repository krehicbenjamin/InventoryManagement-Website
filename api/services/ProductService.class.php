<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/ProductDao.class.php";
require_once dirname(__FILE__)."/../dao/SupplierDao.class.php";

class ProductService extends BaseService
{
    private SupplierDao;

    public function __construct()
    {
        $this->dao=new ProductDao();
        $this->SupplierDao = new SupplierDao();
    }

    public function getProducts($search, $offset, $limit){
        if($search){
            return $this->dao->searchProductsByName($search, $offset, $limit);
        }else{
            return $this->dao->getAllProductsPaginated($offset, $limit);
        }
    }

    public function add($product){
        if(!isset($product['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($product);
    }

    public function update($id, $product){
        return parent::update($id, $product);
    }
}
