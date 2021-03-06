<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/SupplierDao.class.php";
require_once dirname(__FILE__)."/BaseService.class.php";

class SupplierService extends BaseService
{
    public function __construct()
    {
        $this->dao=new SupplierDao();
    }

    public function getSuppliers($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchSuppliersByName($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllSuppliersPaginated($offset, $limit);
        }
    }

    public function insertSupplier($supplier)
    {
        if(!isset($supplier['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($supplier);
    }

    public function update($id, $supplier)
    {
        return parent::update($id, $supplier);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function getAllSuppliers()
    {
      return $this->dao->getAllSuppliers();
    }
}
