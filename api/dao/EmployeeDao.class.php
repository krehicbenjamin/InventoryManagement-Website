<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class ProductDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("products");
    }

    public function getProductsById($id)
    {
        return $this->queryUnique("SELECT * FROM products WHERE id = :id", ["id" => $id]);
    }

    public function insertProduct($product)
    {
        $this->insert($product, "products");
    }

    public function getAllProducts(){
        return $this->getAll("products");
    }

    public function searchProductsByName($search){
        return $this->query("SELECT * FROM products
                             WHERE name LIKE CONCAT('%', :name, '%')",
                             ["name" => $search]);
    }

}
