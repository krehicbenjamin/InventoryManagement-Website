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
        $this->insert("products", $product);
    }

    public function getAllProducts()
    {
        return $this->getAll("products");
    }

    public function searchProductsBySupplier($search, $offset, $limit)
    {
        return $this->query("SELECT * FROM products
                             WHERE supplier_id LIKE CONCAT('%', :supplier_id, '%') LIMIT ${limit} OFFSET ${offset}",
                             ["supplier_id" => $search]);
    }

    public function getAllProductsPaginated($offset = 0, $limit = 30)
    {
      return $this->getAllPaginated("products", $offset, $limit);
    }

    public function updateProduct($id, $product)
    {
        $this->update($id, $product);
    }

}
