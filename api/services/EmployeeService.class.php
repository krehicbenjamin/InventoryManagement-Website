<?php

require_once dirname(__FILE__)."/../dao/BaseDao.class.php";
require_once dirname(__FILE__)."/../dao/EmployeeDao.class.php";

class EmployeeService extends BaseService
{
    public function __construct()
    {
        $this->dao=new EmployeeDao();
    }

    public function getEmployees($search, $offset, $limit)
    {
        if($search)
        {
            return $this->dao->searchEmployeesByName($search, $offset, $limit);
        }else
        {
            return $this->dao->getAllEmployeesPaginated($offset, $limit);
        }
    }

    public function add($employee)
    {
        if(!isset($employee['name'])) throw new \Exception("Name is missing", 1);
        return parent::add($employee);
    }

    public function update($id, $employee)
    {
        return parent::update($id, $employee);
    }

    public function getById($id)
    {
        return parent::getById($id);
    }
}
