<?php

require_once dirname(__FILE__)."/BaseDao.class.php";

class SupplierDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct("suppliers");
    }

    public function getSuppliersById($id)
    {
        return $this->queryUnique("SELECT * FROM suppliers WHERE id = :id", ["id" => $id]);
    }

    public function getSuppliersByName($name)
    {
        return $this->queryUnique("SELECT * FROM suppliers WHERE name = :name", ["name" => $name]);
    }

    public function insertSupplier($supplier)
    {
        $this->insert($supplier, "suppliers");
    }

    public function getAllSuppliers(){
        return $this->getAll("suppliers");
    }

    public function searchSuppliersByName($search){
        return $this->query("SELECT * FROM suppliers
                             WHERE name LIKE CONCAT('%', :name, '%')",
                             ["name" => $search]);
    }

}
